<?php

namespace SRC\Domain\Subscription;

interface InputData
{
    public function getName(): string;

    public function getEmail(): string;

    public function getIdentifier(): string;

    public function getState(): string;

    public function getBirthDate(): string;

    public function getGraduated(): bool;
}