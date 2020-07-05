<?php

namespace SRC\Service\Validation;

class Validator
{
    public function validate(array $data)
    {
        foreach ($data as $value) {
            if (empty($value)) {
                return false;
            }
        }

        return true;
    }
}