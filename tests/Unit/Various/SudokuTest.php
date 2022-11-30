<?php

namespace Tests\Unit\Util\Various;

use Galaktika\Various\Sudoku;
use PHPUnit\Framework\TestCase;

class SudokuTest extends TestCase
{
    public function testSolve()
    {
        $sudoku = new Sudoku();

        $solved = $sudoku->solve([
            [5, 3, 0, 0, 7, 0, 0, 0, 0],
            [6, 0, 0, 1, 9, 5, 0, 0, 0],
            [0, 9, 8, 0, 0, 0, 0, 6, 0],
            [8, 0, 0, 0, 6, 0, 0, 0, 3],
            [4, 0, 0, 8, 0, 3, 0, 0, 1],
            [7, 0, 0, 0, 2, 0, 0, 0, 6],
            [0, 6, 0, 0, 0, 0, 2, 8, 0],
            [0, 0, 0, 4, 1, 9, 0, 0, 5],
            [0, 0, 0, 0, 8, 0, 0, 7, 9],
        ]);

        Sudoku::printMatrix($solved);


        $expected = [
            [5, 3, 4, 6, 7, 8, 9, 1, 2],
            [6, 7, 2, 1, 9, 5, 3, 4, 8],
            [1, 9, 8, 3, 4, 2, 5, 6, 7],
            [8, 5, 9, 7, 6, 1, 4, 2, 3],
            [4, 2, 6, 8, 5, 3, 7, 9, 1],
            [7, 1, 3, 9, 2, 4, 8, 5, 6],
            [9, 6, 1, 5, 3, 7, 2, 8, 4],
            [2, 8, 7, 4, 1, 9, 6, 3, 5],
            [3, 4, 5, 2, 8, 6, 1, 7, 9],
        ];

        $this->assertEquals($expected,$solved);
    }


    public function _testSingleStep() {
        $matrixStr =
        "5 3 0 0 7 8 0 0 0 
6 0 0 1 9 5 0 0 0 
0 9 8 0 0 0 0 6 0 
8 0 0 0 6 0 0 0 3 
4 0 0 8 5 3 0 0 1 
7 8 0 0 2 0 0 0 6 
9 6 0 0 0 0 2 8 4 
0 8 0 4 1 9 3 3 5 
0 0 0 0 8 0 4 7 9";

        $rowsStrArray = explode("\n", $matrixStr);

        $matrix = [];
        foreach ($rowsStrArray as $rowStr ) {
//            $matrix[] = array_map( 'intval', array_filter(array_map( 'trim',  ), fn($elem) => $elem === ''));
            $row = explode(' ', $rowStr);
            $row = array_filter($row, fn($e) => $e !== '');
            $row = array_map( 'intval', $row );
            $matrix[] = $row;
        }

        $sudoku = new Sudoku();

        $sudoku->initialize($matrix);
        $sudoku->validateGroups();

        $this->fail("Exception should been thrown");
    }

    public function testMoreComplex() {
        $matrixStr = "6 0 0 1 0 8 2 0 3 
1 2 0 0 4 0 0 9 0 
8 0 3 2 0 5 4 0 0 
5 1 4 6 0 7 0 0 9 
0 3 0 0 0 0 0 5 0 
7 0 0 8 0 3 1 0 2 
0 0 1 7 0 2 9 0 6 
0 8 0 0 3 0 7 2 0 
3 0 2 9 0 4 0 0 5";

        $rowsStrArray = explode("\n", $matrixStr);

        $matrix = [];
        foreach ($rowsStrArray as $rowStr ) {
//            $matrix[] = array_map( 'intval', array_filter(array_map( 'trim',  ), fn($elem) => $elem === ''));
            $row = explode(' ', $rowStr);
            $row = array_filter($row, fn($e) => $e !== '');
            $row = array_map( 'intval', $row );
            $matrix[] = $row;
        }

        $sudoku = new Sudoku();

        $result = $sudoku->solve($matrix);

        $sudoku->validateGroups();

        Sudoku::printMatrix($result);

        $this->assertTrue(true);
    }

    public function testMoreComplex2() {
        $matrixStr="0 0 8 0 3 0 5 4 0
3 5 0 4 0 7 9 0 0
4 1 0 0 0 8 0 0 2
0 4 3 5 0 2 0 6 0
5 0 0 0 0 0 0 0 8
0 6 0 3 8 9 4 1 5
1 0 0 8 0 0 0 2 7
0 0 5 6 0 3 1 9 4
6 2 9 1 7 0 8 0 0";

        $matrix = $this->strToMatrix($matrixStr);

        $sudoku = new Sudoku();

        $result = $sudoku->solve($matrix);

        $sudoku->validateGroups();

        Sudoku::printMatrix($result);

        $this->assertTrue(true);
    }

    public function testMoreComplex3() {
        $matrixStr = "3 1 9 8 6 2 5 4 7 
0 0 0 3 0 0 0 8 0 
8 2 5 9 7 4 1 3 6 
0 0 1 5 0 3 8 0 0 
5 0 8 4 0 6 0 0 0 
0 0 2 7 8 1 6 5 0 
7 5 6 1 3 8 4 9 2 
0 0 0 2 0 0 3 6 8 
2 8 3 6 4 9 7 1 5 ";

        $matrix = $this->strToMatrix($matrixStr);

        $sudoku = new Sudoku();

        $result = $sudoku->solve($matrix);

        $sudoku->validateGroups();

        Sudoku::printMatrix($result);

        $this->assertTrue(true);
    }

    private function strToMatrix($matrixStr) : array {
        $rowsStrArray = explode("\n", $matrixStr);

        $matrix = [];
        foreach ($rowsStrArray as $rowStr ) {
//            $matrix[] = array_map( 'intval', array_filter(array_map( 'trim',  ), fn($elem) => $elem === ''));
            $row = explode(' ', $rowStr);
            $row = array_filter($row, fn($e) => $e !== '');
            $row = array_map( 'intval', $row );
            $matrix[] = $row;
        }

        return $matrix;
    }
}