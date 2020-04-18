<?php
require_once 'Email.php';

$error = false;
$success = false;
$msg = '';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $graduated = $_POST['graduated'] == 'S' ? true : false;
    $state = $_POST['state'];
    $identifier = str_replace(['.', '-'], '', $_POST['identifier']);

    if (empty($name)) {
        $error = true;
        $msg = "Erro ao efetuar inscrição";
    }

    if (empty($email)) {
        $error = true;
        $msg = "Erro ao efetuar inscrição";
    }

    if (empty($birth_date)) {
        $error = true;
        $msg = "Erro ao efetuar inscrição";
    }

    if (empty($graduated)) {
        $error = true;
        $msg = "Erro ao efetuar inscrição";
    }

    if (empty($state)) {
        $error = true;
        $msg = "Erro ao efetuar inscrição";
    }

    if (empty($identifier)) {
        $error = true;
        $msg = "Erro ao efetuar inscrição";
    }

    if (!$error) {
        $link = mysqli_connect("db", "root", "root", "phpbr_event");

        mysqli_query($link, "INSERT INTO subscription (name, email, identifier, birth_date, graduated, state)
                        VALUES ('".$name."', '".$email."', ".$identifier.", '".$birth_date."', ".$graduated.", '".$state."')");

        if (mysqli_error($link)) {
            $error = true;
            $msg = "Houve um erro ao efetuar inscrição";
        } else {
            $msg = "Inscrição realizada com sucesso";
            $success = true;
            switch ($state) {
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
            $email->send($email, $msgEmail);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>Inscrições para o PHP papho | PHP Brasil</title>
  </head>
  <body>
    <section class="main">
      <form action="" method="POST">
        <div class="box">
          <div class="box-header">
            <img src="images/logo-phpbr.png" alt="PHP Brasil" />
            <h2><i class="fa fa-code"></i> Inscrições para o PHP papho</h2>
          </div>
          <div class="box-body">
            <div class="form-group row" style="display: <?=$success ? 'block' : 'none'?>" >
              <div class="col-sm-12">
                <p class="msg msg-success"><?=$msg?></p>
              </div>
            </div>
            <div class="form-group row" style="display: <?=$error ? 'block' : 'none'?>" >
              <div class="col-sm-12">
                <p class="msg msg-error"><?=$msg?></p>
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-3 col-form-label">Nome:</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  placeholder="Digite seu nome..."
                />
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">E-mail:</label>
              <div class="col-sm-9">
                <input
                  type="email"
                  class="form-control"
                  name="email"
                  required
                  placeholder="user@domain.com"
                  id="email"
                />
              </div>
            </div>
            <div class="form-group row">
              <label for="cpf" class="col-sm-3 col-form-label">CPF:</label>
              <div class="col-sm-9">
                <input
                  type="text"
                  required
                  class="form-control"
                  placeholder="999.999.999-81"
                  id="cpf"
                  name="identifier"
                />
              </div>
            </div>
            <div class="form-group row">
              <label for="state" class="col-sm-3 col-form-label">Estado</label>
              <div class="col-sm-9">
                <select id="state" name="state" class="form-control">
                  <option value="">:: Selecione ::</option>
                  <option value="BA">Bahia (BA)</option>
                  <option value="CE">Ceará (CE)</option>
                  <option value="PE">Pernambuco (PE)</option>
                  <option value="RN">Rio Grande do Norte (RN)</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="birth_date" class="col-sm-3 col-form-label"
                >Data Nasc.:</label
              >
              <div class="col-sm-9">
                <input
                  type="date"
                  name="birth_date"
                  required
                  class="form-control"
                  placeholder="12/04/1990"
                  id="birth_date"
                />
              </div>
            </div>
            <div class="form-group row">
              <label for="graduated" class="col-sm-3 col-form-label"
                >É Graduado ?</label
              >
              <div class="col-sm-9">
                <select id="graduated" name="graduated" class="form-control">
                  <option value="">:: Selecione ::</option>
                  <option value="S">Sim</option>
                  <option value="N">Não</option>
                </select>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-lg btn-block gold">
              <i class="fa fa-check-circle"></i> Me Inscrever Agora!
            </button>
          </div>
        </div>
      </form>
    </section>
  </body>
</html>
