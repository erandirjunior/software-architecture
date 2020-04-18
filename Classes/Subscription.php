<?php

require_once 'Connection.php';
require_once 'Email.php';

class Subscription
{
    public function registry(array $data)
    {
        $registrySaveWithSuccess = $this->registryIfNameNotEmpty($data);

        if ($registrySaveWithSuccess) {
            $return = [
                'sucess' => true,
                'error' => false,
                'msg' => "Sucesso ao efetuar inscrição"
            ];
        } else {
            $return = [
                'sucess' => false,
                'error' => true,
                'msg' => "Houve um erro ao efetuar inscrição"
            ];
        }

        return $return;
    }

    private function registryIfNameNotEmpty($data)
    {
        if (empty($data['name'])) {
            return false;
        }

        return $this->registryIfEmailNotEmpty($data);
    }

    private function registryIfEmailNotEmpty($data)
    {
        if (empty($data['email'])) {
            return false;
        }

        return $this->registryIfIdentifierNotEmpty($data);
    }

    private function registryIfIdentifierNotEmpty($data)
    {
        if (empty($data['identifier'])) {
            return false;
        }

        return $this->registryIfStateNotEmpty($data);
    }

    private function registryIfStateNotEmpty($data)
    {
        if (empty($data['state'])) {
            return false;
        }

        return $this->registryIfBirthDateNotEmpty($data);
    }

    private function registryIfBirthDateNotEmpty($data)
    {
        if (empty($data['birth_date'])) {
            return false;
        }

        return $this->registryIfGraduatedNotEmpty($data);
    }

    private function registryIfGraduatedNotEmpty($data)
    {
        if (empty($data['graduated'])) {
            return false;
        }

        return $this->saveSubscription($data);
    }

    private function saveSubscription($data)
    {
        $connection = new Connection();

        $data['identifier'] = $this->prepareIdentifierValue($data['identifier']);
        $data['graduated'] = $this->prepareGraduatedValue($data['graduated']);

        mysqli_query($connection->getConnection(),"INSERT INTO subscription 
                                                      (name, email, identifier, birth_date, graduated, state)
                                                  VALUES 
                                                      ('".$data['name']."', '".$data['email']."',
                                                      ".$data['identifier'].", '".$data['birth_date']."',
                                                      ".$data['graduated'].", '".$data['state']."
                                                      ')");

        if (mysqli_error($connection)) {
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