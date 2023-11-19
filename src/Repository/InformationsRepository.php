<?php

namespace App\Repository;

use App\Service\DatabaseConnection;

class InformationsRepository {
    private $dbConnection;

    public function __construct(DatabaseConnection $databaseConnection) {
        $this->dbConnection = $databaseConnection->getConnection();
    }


    public function getAddress()
    {
        $stmt = $this->dbConnection->prepare("SELECT address FROM informations");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTelephone()
    {
        $stmt = $this->dbConnection->prepare("SELECT telephone FROM informations");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTimetable()
    {
        $stmt = $this->dbConnection->prepare("SELECT timetable FROM informations");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}