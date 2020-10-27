<?php

namespace SRC\Infrastructure\Controller;

use PlugRoute\Http\Request;
use SRC\Infrastructure\Email\Email;
use SRC\Infrastructure\Persistence\Connection;
use SRC\Infrastructure\Validation\Validator;
use SRC\Infrastructure\Presenter\View;

class Registry
{
    public function register(Request $request)
    {
        $email = new Email();
        $validator = new Validator();
        $connection = new Connection();
        $controller = new \SRC\Application\Controller\Registry(
            $validator,
            $email,
            $connection
        );

        return $controller->register(new View(), $request->all());
    }
}