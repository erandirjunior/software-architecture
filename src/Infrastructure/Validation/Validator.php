<?php

namespace SRC\Infrastructure\Validation;

use SRC\Domain\Subscription\InputData;

class Validator implements \SRC\Domain\Subscription\Validator
{
    public function validate(InputData $inputData): bool
    {
        if (empty($inputData->getName())) {
            return false;
        }

        if (empty($inputData->getEmail())) {
            return false;
        }

        if (empty($inputData->getState())) {
            return false;
        }

        if (empty($inputData->getGraduated())) {
            return false;
        }

        if (empty($inputData->getBirthDate())) {
            return false;
        }

        if (empty($inputData->getIdentifier())) {
            return false;
        }

        return true;
    }
}