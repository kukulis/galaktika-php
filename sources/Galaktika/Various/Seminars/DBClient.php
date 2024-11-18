<?php

namespace Galaktika\Various\Seminars;

use PDO;

class DBClient
{
    private PDO $pdo;

    /**
     * @return Product[]
     */
    public function getProducts() : array{
        $sql = "SELECT * FROM products";
        // exeucte sql and return prroducts from DB
        return [];
    }
}