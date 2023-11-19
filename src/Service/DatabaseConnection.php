<?php

namespace App\Service;

use PDO;

class DatabaseConnection {
    private $connection;

    public function __construct() {
        $this->connection = new PDO('mysql:host=localhost;dbname=maraicher', 'root', '');
    }

    public function getConnection() {
        return $this->connection;
    }
}
