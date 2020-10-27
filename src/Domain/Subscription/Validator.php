<?php

namespace SRC\Domain\Subscription;

interface Validator
{
    public function validate(InputData $inputData): bool;
}