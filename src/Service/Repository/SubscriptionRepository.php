<?php

namespace SRC\Service\Repository;

use SRC\Model\Connection;

class SubscriptionRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    public function save($data)
    {
        mysqli_query($this->connection,"INSERT INTO subscription 
                                                      (name, email, identifier, birth_date, graduated, state)
                                                  VALUES 
                                                      ('".$data['name']."', '".$data['email']."',
                                                      ".$data['identifier'].", '".$data['birth_date']."',
                                                      ".$data['graduated'].", '".$data['state']."
                                                      ')");

        if (mysqli_error($this->connection)) {
            return false;
        }

        return true;
    }
}