<?php

namespace SRC\Application\Boundery;

use SRC\Domain\Subscription\InputData;

class InputBoundery implements InputData
{
    private string $name;

    private string $email;

    private string $identifier;

    private string $state;

    private string $birthDate;

    private string $graduated;

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name ? $name : '';

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email ? $email : '';

        return $this;
    }

    public function getIdentifier(): string
    {
        return str_replace(['.', '-'], '', $this->identifier);
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier ? $identifier : '';

        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state ? $state : '';

        return $this;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    /**
     * @param string $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate ? $birthDate : '';;

        return $this;
    }

    public function getGraduated(): bool
    {
        return $this->graduated == 'S';
    }

    /**
     * @param string $graduated
     */
    public function setGraduated($graduated)
    {
        $this->graduated = $graduated ? $graduated : '';

        return $this;
    }
}