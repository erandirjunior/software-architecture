<?php

namespace SRC\Infrastructure\Persistence;

class Connection implements \SRC\Application\Repository\Connection
{
    public function getConnection()
    {
        try {
            $pdo = new \PDO("mysql:host=db;dbname=phpbr_event", "root", "root");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}