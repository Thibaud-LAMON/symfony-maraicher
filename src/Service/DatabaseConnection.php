<?php

/**
 *L'utilisation de doctrine étant prohibée, cette classe permet la connection d'autres classes à la base de données
 */

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
