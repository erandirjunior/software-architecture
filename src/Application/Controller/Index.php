<?php

namespace SRC\Application\Controller;

use SRC\Application\Presenter\View;

class Index
{
    public function index(View $view)
    {
        return $view->loadView('index');
    }
}