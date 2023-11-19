<?php

namespace App\Service;

use PDO;
class DatabaseService
{
    private PDO $pdo;

    public function __construct(){
        $databaseUrl = getenv('DATABASE_URL');
        $this->pdo = new PDO($databaseUrl);
    }

    public function getPdo(): PDO{
        return $this->pdo;
    }
}