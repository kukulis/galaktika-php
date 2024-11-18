<?php

namespace Galaktika\Various\Seminars\Bad;

use PDO;

class DBService
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return Product[]
     */
    public function getProducts($ids) : array{
        $idsStr = implode(',', $ids);
        $sql = "SELECT * FROM products where id in ($idsStr)";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, Product::class);
    }
}