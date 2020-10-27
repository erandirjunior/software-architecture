<?php

namespace SRC\Application\Controller;

use SRC\Application\Boundery\InputBoundery;
use SRC\Application\Presenter\View;
use SRC\Application\Repository\Repository;
use SRC\Domain\Subscription\Email;
use SRC\Domain\Subscription\Subscription;
use SRC\Domain\Subscription\Validator;
use SRC\Application\Repository\Connection;

class Registry
{
    private View $view;

    private Subscription $subscription;

    private Validator $validator;

    private Email $email;

    private Connection $connection;

    public function __construct(
        Validator $validator,
        Email $email,
        Connection $connection
    )
    {
        $this->validator = $validator;
        $this->email = $email;
        $this->connection = $connection;
    }

    public function register(View $view, array $data)
    {
        $input = new InputBoundery();
        $input->setName($data['name'])
            ->setEmail($data['email'])
            ->setIdentifier($data['identifier'])
            ->setGraduated($data['graduated'])
            ->setState($data['state'])
            ->setBirthDate($data['birth_date']);

        $repository = new Repository($this->connection);

        $this->subscription = new Subscription($this->validator, $repository, $this->email);

        $response = $this->subscription->register($input);

        return $view->loadView('index', ['response' => $response]);
    }
}