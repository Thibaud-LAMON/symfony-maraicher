<?php

namespace App\Repository;

use App\Service\DatabaseConnection;

class ProductsRepository
{
    private $dbConnection;

    public function __construct(DatabaseConnection $databaseConnection) {
        $this->dbConnection = $databaseConnection->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->dbConnection->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getName()
    {
        $stmt = $this->dbConnection->prepare("SELECT name FROM products");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getImage()
    {
        $stmt = $this->dbConnection->prepare("SELECT image FROM products");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPrice()
    {
        $stmt = $this->dbConnection->prepare("SELECT price FROM products");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}