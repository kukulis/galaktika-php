<?php

namespace Galaktika\Various;

class Sudoku
{
    private const SIZE = 9;
    private const SQ_SIZE = 3;

    /**
     * @var Cell[][]
     */
    private array $cellsMatrix;

    /**
     * @var Cell[][]
     */
    private array $cellGroups;

    /**
     * We assign a set of possible values for each cell.
     * In the begining it is {1..9}
     * Then we do fix possible values, by removing already available values in the same row, column or square in other cells.
     * If in the remaining cells we have sets where a *single* value is contained, then we add this value to solutions.
     * We also apply second level analyser, when we check same column, row or square sets, and if we find that some value
     * is only available in one cell. If so, we add it to the solution.
     * @param int[][] $board
     * @return int[][]
     */
    public function solve(array $board)
    {
        $this->initialize($board);

        $unresolvedCount = $this->countUnsolvedCells();

        while ($unresolvedCount > 0) {
            $this->fixSets();
            $solvedCount = $this->solveSingles();
//            $this->printCellsMatrix();
//            $this->validateGroups();

            if ( $solvedCount > 0 ) {
                $unresolvedCount -= $solvedCount;
                continue;
            }
//            echo "-- level 2 changes --\n";
            $solvedCount += $this->solvePossibleSingles();
//            $this->printCellsMatrix();
//            $this->validateGroups();
            $unresolvedCount -= $solvedCount;

            if ($solvedCount == 0) {
                break;
            }
        }

        // now we need to transform back to the numbers
        return $this->transformCellsMatrixToNumbersMatrix($this->cellsMatrix);
    }

    /**
     * @param int[][] $matrix
     */
    public function initialize(array $matrix)
    {
        $cm = $this->initializeCellsMatrix($matrix);
        $this->buildCellGroups($cm);
        $this->validateCellGroups();
    }

    /**
     * If in the remaining cells we have sets where a *single* value is contained, then we add this value to solutions.
     * @return int
     */
    private function solveSingles(): int
    {
        $solved = 0;
        for ($i = 0; $i < self::SIZE; $i++) {
            for ($j = 0; $j < self::SIZE; $j++) {
                $cell = $this->cellsMatrix[$i][$j];
                if ($cell->getValue() == 0 && count($cell->getPossibleValues()) == 1) {
                    $solved++;
                    $cell->setValue($cell->getFirstValue());
                    $cell->clearPossibleValues();
                }
            }
        }

        return $solved;
    }

    /**
     * For each group: if we find that some value is only available in a single cell, we add this value to the solution.
     * @return int
     */
    private function solvePossibleSingles(): int
    {
        $count = 0;
        $groupNumber = 0;
        foreach ($this->cellGroups as $group) {
            $count += $this->solvePossibleSinglesInGroup($group);
            $groupNumber ++;
        }

        return $count;
    }

    /**
     * If we find that some value is only available in a single cell, we add this value to the solution.
     * @param Cell[] $group
     */
    private function solvePossibleSinglesInGroup(array $group)
    {
        $count = 0;

        for ($number = 1; $number <= self::SIZE; $number++) {
            $numberCount = 0;

            foreach ($group as $cell) {
                if ($cell->getValue() == 0 && $cell->hasPossibleValue($number)) {
                    $numberCount++;
                }
            }

            if ($numberCount == 1) {
                // now lets find again that cell and make this number as a solution
                foreach ($group as $cell) {
                    if ($cell->getValue() == 0 && $cell->hasPossibleValue($number)) {
                        $cell->setValue($number);
                        $cell->clearPossibleValues();
                        $count++;
                    }
                }
            }
        }

        return $count;
    }

    /**
     * @param int[][] $board
     * @return Cell[][]
     */
    private function initializeCellsMatrix(array $board): array
    {
        $this->cellsMatrix = [];
        for ($row = 0; $row < self::SIZE; $row++) {
            $rowArray = [];
            for ($column = 0; $column < self::SIZE; $column++) {
                $rowArray[] = new Cell($row, $column, $board[$row][$column]);
            }
            $this->cellsMatrix[] = $rowArray;
        }

        return $this->cellsMatrix;
    }

    /***
     * @param Cell[][] $cm
     */
    private function buildCellGroups(array $cm)
    {
        $this->cellGroups = [];
        // rows
        for ($i = 0; $i < self::SIZE; $i++) {
            $row = [];
            for ($j = 0; $j < self::SIZE; $j++) {
                $row[] = $cm[$i][$j];
            }
            $this->cellGroups[] = $row;
        }

        // columns
        for ($j = 0; $j < self::SIZE; $j++) {
            $row = [];
            for ($i = 0; $i < self::SIZE; $i++) {
                $row[] = $cm[$i][$j];
            }
            $this->cellGroups[] = $row;
        }


        // squares
        for ($sqi = 0; $sqi < self::SQ_SIZE; $sqi++) {
            for ($sqj = 0; $sqj < self::SQ_SIZE; $sqj++) {
                $square = [];
                for ($i = $sqi * self::SQ_SIZE; $i < ($sqi + 1) * self::SQ_SIZE; $i++) {
                    for ($j = $sqj * self::SQ_SIZE; $j < ($sqj + 1) * self::SQ_SIZE; $j++) {
                        $square[] = $cm[$i][$j];
                    }
                }

                $this->cellGroups[] = $square;
            }
        }
    }

    private function validateCellGroups()
    {
        // after building cell groups we should have 27 cell groups, 9 cells each

        if (count($this->cellGroups) != self::SIZE * self::SQ_SIZE) {
            throw new \Exception(
                sprintf(
                    'Instead of having %s cell groups, we have only %s',
                    self::SIZE * self::SQ_SIZE,
                    count($this->cellGroups)
                )
            );
        }

        $cellGroupIndex = 0;
        foreach ($this->cellGroups as $cellGroup) {
            if (count($cellGroup) != self::SIZE) {
                throw new \Exception(
                    sprintf(
                        'The cell group number %s has %s cells instead of %s',
                        $cellGroupIndex,
                        count($cellGroup),
                        self::SIZE
                    )
                );
            }
            $cellGroupIndex++;
        }
    }

    private function countUnsolvedCells(): int
    {
        $count = 0;
        for ($i = 0; $i < self::SIZE; $i++) {
            for ($j = 0; $j < self::SIZE; $j++) {
                if ($this->cellsMatrix[$i][$j]->getValue() == 0) {
                    $count++;
                }
            }
        }

        return $count;
    }

    private function fixSets()
    {
        foreach ($this->cellGroups as $cellGroup) {
            $this->fixCellGroup($cellGroup);
        }
    }

    /**
     * @param Cell[] $group
     */
    private function fixCellGroup(array $group)
    {
        $solvedValues = [];
        foreach ($group as $cell) {
            if ($cell->getValue() != 0) {
                $solvedValues[] = $cell->getValue();
            }
        }

        foreach ($group as $cell) {
            if ($cell->getValue() == 0) {
                $cell->removeFromPossibleValues($solvedValues);
            }
        }
    }


    /**
     * @param Cell[][] $cellMatrix
     * @return int[][]
     */
    private function transformCellsMatrixToNumbersMatrix(array $cellMatrix): array
    {
        $matrix = [];
        foreach ($cellMatrix as $row) {
            $numbersRow = [];
            foreach ($row as $cell) {
                $numbersRow[] = $cell->getValue();
            }

            $matrix[] = $numbersRow;
        }

        return $matrix;
    }

    /**
     * @param int [][] $matrix
     */
    public static function printMatrix(array $matrix)
    {
        foreach ($matrix as $row) {
            foreach ($row as $cell) {
                echo $cell . " ";
            }
            echo "\n";
        }
        echo "\n";
    }

    private function printCellsMatrix()
    {
        foreach ($this->cellsMatrix as $row) {
            foreach ($row as $cell) {
                echo $cell->getValue() . " ";
            }
            echo "\n";
        }
        echo "\n";
    }

    public function validateGroups()
    {
        $groupIndex = 0;
        foreach ($this->cellGroups as $group) {
            $this->validateGroup($group);
            $groupIndex++;
        }
    }

    /**
     * @param Cell[] $group
     */
    public function validateGroup(array $group)
    {
        $valuesSet = [];

        foreach ($group as $cell) {
            if ($cell->getValue() == 0) {
                continue;
            }

            if (array_key_exists($cell->getValue(), $valuesSet)) {
                $groupMark = [];
                foreach ($group as $c) {
                    $groupMark[] = sprintf('(%s,%s: %s)', $c->getRow(), $c->getColumn(), $c->getValue());
                }

                throw new \Exception(
                    sprintf('duplicate value [%s] in group [%s]', $cell->getValue(), join(';', $groupMark))
                );
            }

            $valuesSet[$cell->getValue()] = 1;
        }
    }
}

/**
 * A separate class for cell.
 * It is used for a reason, that objects are not copied but only references are copied. So we may have
 * same object in multiple places; we may have same cell in the several places.
 */
class Cell
{
    private int $row;
    private int $column;
    private int $value;
    private array $possibleValues = [];

    /**
     * @param int $row
     * @param int $column
     * @param int $value
     */
    public function __construct(int $row, int $column, int $value)
    {
        $this->row = $row;
        $this->column = $column;
        $this->value = $value;

        if ($this->value == 0) {
            $this->possibleValues = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        }
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getColumn(): int
    {
        return $this->column;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): Cell
    {
        $this->value = $value;

        return $this;
    }

    public function removeFromPossibleValues(array $removeValues)
    {
        $this->possibleValues = array_diff($this->possibleValues, $removeValues);
    }

    public function getPossibleValues(): array
    {
        return $this->possibleValues;
    }

    public function hasPossibleValue($possibleValue): bool
    {
        return array_search($possibleValue, $this->possibleValues);
    }

    public function clearPossibleValues()
    {
        $this->possibleValues = [];
    }

    public function getFirstValue(): int
    {
        return reset($this->possibleValues);
    }
}