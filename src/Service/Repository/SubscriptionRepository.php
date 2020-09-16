<?php

namespace SRC\Service\Repository;

use SRC\Service\Persistence\Connection;

class SubscriptionRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    public function save($data)
    {
        $stmt = $this->connection->prepare("INSERT INTO subscription 
                                                      (name, email, identifier, birth_date, graduated, state)
                                                  VALUES 
                                                      (?, ?, ?, ?, ?, ?)");

        $stmt->bindValue(1, $data['name']);
        $stmt->bindValue(2, $data['email']);
        $stmt->bindValue(3, $data['identifier']);
        $stmt->bindValue(4, $data['birth_date']);
        $stmt->bindValue(5, $data['graduated']);
        $stmt->bindValue(6, $data['state']);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}