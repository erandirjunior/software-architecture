<?php

namespace SRC\Application\Repository;

use SRC\Domain\Subscription\InputData;

class Repository implements \SRC\Domain\Subscription\Repository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    public function save(InputData $inputData): bool
    {
        $stmt = $this->connection->prepare("INSERT INTO subscription 
                                                      (name, email, identifier, birth_date, graduated, state)
                                                  VALUES 
                                                      (?, ?, ?, ?, ?, ?)");

        $stmt->bindValue(1, $inputData->getName());
        $stmt->bindValue(2, $inputData->getEmail());
        $stmt->bindValue(3, $inputData->getIdentifier());
        $stmt->bindValue(4, $inputData->getBirthDate());
        $stmt->bindValue(5, $inputData->getGraduated());
        $stmt->bindValue(6, $inputData->getState());
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}