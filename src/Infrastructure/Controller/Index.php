<?php

namespace SRC\Infrastructure\Controller;

use SRC\Infrastructure\Presenter\View;

class Index
{
    public function index()
    {
        $controller = new \SRC\Application\Controller\Index();

        return $controller->index(new View());
    }
}