<?php

namespace SRC\Domain\Subscription;

interface Repository
{
    public function save(InputData $inputData): bool;
}