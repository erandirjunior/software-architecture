<?php

namespace SRC\Application\Presenter;

interface View
{
    public function loadView(string $view, array $data = []);
}