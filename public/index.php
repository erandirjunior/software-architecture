<?php

require_once '../vendor/autoload.php';

use \PlugRoute\PlugRoute;
use \PlugRoute\RouteContainer;
use \PlugRoute\Http\RequestCreator;

$route = new PlugRoute(new RouteContainer(), RequestCreator::create());

$route->get('/', 'SRC\Controller\SubscriptionController@index');

$route->post('/', 'SRC\Controller\SubscriptionController@register');

$route->on();