<?php

namespace SRC\Controller;

abstract class Controller
{
    protected function view(string $view, array $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        if (file_exists("../src/View/{$view}.php")) {
            require_once "../src/View/{$view}.php";
        } else {
            throw new \Exception("view {$view} não encontrada");
        }
    }
}