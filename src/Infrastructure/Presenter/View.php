<?php

namespace SRC\Infrastructure\Presenter;

class View implements \SRC\Application\Presenter\View
{
    public function loadView(string $view, array $data = [])
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