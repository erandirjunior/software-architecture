<?php

require_once '../vendor/autoload.php';

use \PlugRoute\PlugRoute;
use \PlugRoute\RouteContainer;
use \PlugRoute\Http\RequestCreator;

$route = new PlugRoute(new RouteContainer(), RequestCreator::create());

$route->get('/', 'SRC\Infrastructure\Controller\Index@index');

$route->post('/', 'SRC\Infrastructure\Controller\Registry@register');

$route->on();