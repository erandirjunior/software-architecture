<?php

namespace SRC\Model;

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
        $connection = new Connection();
        $mysqlConnection = $connection->getConnection();

        $data['identifier'] = $this->prepareIdentifierValue($data['identifier']);
        $data['graduated'] = $this->prepareGraduatedValue($data['graduated']);

        mysqli_query($mysqlConnection,"INSERT INTO subscription 
                                                      (name, email, identifier, birth_date, graduated, state)
                                                  VALUES 
                                                      ('".$data['name']."', '".$data['email']."',
                                                      ".$data['identifier'].", '".$data['birth_date']."',
                                                      ".$data['graduated'].", '".$data['state']."
                                                      ')");

        if (mysqli_error($mysqlConnection)) {
            return false;
        }

        $this->sendEmail($data);

        return true;
    }

    private function prepareGraduatedValue($value)
    {
        return $value == 'S' ? 'true' : 'false';
    }

    private function prepareIdentifierValue($value)
    {
        return str_replace(['.', '-'], '', $value);
    }

    private function sendEmail($data)
    {
        switch ($data['state']) {
            case 'CE':
                $msgEmail = 'Cabra bom, você está inscrito!';
                break;
            case 'BA':
                $msgEmail = 'Meu rei, você está inscrito!';
                break;
            default:
                $msgEmail = 'Gente boa, você está inscrito!';
        }

        $email = new Email();
        $email->send($data['email'], $msgEmail);
    }
}