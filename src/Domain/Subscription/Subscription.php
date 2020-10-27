<?php

namespace SRC\Domain\Subscription;

class Subscription
{
    private Validator $validator;
    
    private Repository $repository;
    
    private Email $email;
    
    public function __construct(
        Validator $validator,
        Repository $repository,
        Email $email
    )
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->email = $email;
    }

    public function register(InputData $inputData): bool
    {
        return $this->saveSubscriptionIfDataAreValid($inputData);
    }

    private function saveSubscriptionIfDataAreValid($inputData): bool
    {
        if (!$this->validator->validate($inputData)) {
            return false;
        }

        return $this->saveSubscription($inputData);
    }

    private function saveSubscription($inputData): bool
    {
        if (!$this->repository->save($inputData)) {
            return false;
        }

        $this->sendEmail($inputData);

        return true;
    }

    private function sendEmail($inputData)
    {
        $states = [
            'CE' => 'Cabra bom, você está inscrito!',
            'BA' => 'Meu rei, você está inscrito!',
        ];

        if (!empty($states[$inputData->getState()])) {
            return $this->email->sendEmail($inputData->getEmail(), $inputData->getState());
        }

        $this->email->sendEmail($inputData->getEmail(), 'Parabéns, inscrição realizada com sucesso!');
    }
}