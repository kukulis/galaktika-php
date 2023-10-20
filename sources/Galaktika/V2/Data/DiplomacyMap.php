<?php

namespace Galaktika\V2\Data;

class DiplomacyMap implements IDiplomacyMap
{
    private string $id;

    /** @var int[]  */
    private array $relations=[];

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getRelations(): array
    {
        return $this->relations;
    }

    /**
     * @param array $relations
     */
    public function setRelations(array $relations): void
    {
        $this->relations = $relations;
    }

    public function getRelation(Race $race1, Race $race2): int
    {
        if ( $race1 === $race2) {
            return self::ALLIES;
        }
        $key = self::getRelationKey($race1, $race2);

        if ( !array_key_exists($key, $this->relations)) {
            return self::ENEMY;
        }

        return $this->relations[$key];
    }

    public static function getRelationKey ( Race $race1, Race $race2 ) : string {
        return sprintf ('%s_%s', $race1->getId(), $race2->getId());
    }
}