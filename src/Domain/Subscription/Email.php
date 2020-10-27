<?php

namespace SRC\Domain\Subscription;

interface Email
{
    public function sendEmail(string $email, string $msg);
}