<?php

namespace SRC\Controller;

use \SRC\Model\Subscription;

class SubscriptionController extends Controller
{
    private $subscription;

    private $request;

    public function __construct(Subscription $subscription, \PlugRoute\Http\Request $request)
    {
        $this->subscription = $subscription;
        $this->request = $request;
    }

    public function index()
    {
        return $this->view('index');
    }

    public function register()
    {
        $response = $this->subscription->register($this->request->all());

        return $this->view('index', $response);
    }
}