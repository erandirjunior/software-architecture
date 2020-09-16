<?php

namespace SRC\Model;

use SRC\Service\Email\Email;
use SRC\Service\Persistence\Connection;
use SRC\Service\Repository\SubscriptionRepository;
use SRC\Service\Validation\Validator;

class Subscription
{
    public function register(array $data)
    {
        $registrySaveWithSuccess = $this->saveSubscriptionIfDataAreValid($data);

        if ($registrySaveWithSuccess) {
            return ['success' => 'Sucesso ao efetuar inscrição'];
        }

        return ['error' => 'Houve um erro ao efetuar inscrição'];
    }

    private function saveSubscriptionIfDataAreValid(array $data)
    {
        $validator = new Validator();

        if (!$validator->validate($data)) {
            return false;
        }

        return $this->saveSubscription($data);
    }

    private function saveSubscription($data)
    {
        $data['identifier'] = $this->prepareIdentifierValue($data['identifier']);
        $data['graduated'] = $this->prepareGraduatedValue($data['graduated']);

        $repository = new SubscriptionRepository(new Connection());

        if (!$repository->save($data)) {
            return false;
        }

        $this->sendEmail($data);

        return true;
    }

    private function prepareGraduatedValue($value)
    {
        return $value == 'S' ? true : false;
    }

    private function prepareIdentifierValue($value)
    {
        return str_replace(['.', '-'], '', $value);
    }

    private function sendEmail($data)
    {
        $states = [
            'CE' => 'Cabra bom, você está inscrito!',
            'BA' => 'Meu rei, você está inscrito!',
        ];

        $email = new Email();

        if (!empty($states[$data['email']])) {
             return $email->send($data['email'], $states[$data['email']]);
        }

        $email->send($data['email'], 'Parabéns, inscrição realizada com sucesso!');
    }
}