<?php

  use App\Controllers\User;

  spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
  });

  session_start();
  $loginOk = true;
  $email= '';

  if($_POST) {
    $user = new User();

    $mail = filter_var($_POST['login'], FILTER_SANITIZE_STRIPPED);
    $password = filter_var($_POST['senha'], FILTER_SANITIZE_STRIPPED);

    $user->login($mail, $password);
  }


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <div class="site">
      <div class="login">
        <form method="post">
          <label for="login">Digite seu email ou nome</label><br>
            <input type="text" name="login" value="<?php echo $email; ?>" placeholder="nome@gmail.com"><br>
          <label for="senha">Digite sua senha</label><br>
            <input type="password" name="senha" placeholder="senha123"><br>
          <?= ($loginOk ? '' : '<span class="erro">Email, nome ou senha inválidos</span>'.'<br>');  ?>
          <button type="submit" name="button">Enviar</button><br>
          <p>Caso não seja registrado, ou não consegue logar, peça ajuda a um
          <a href="https://github.com/Vinicius-Mance" target="_blank">administrador</a></p>
        </form>
       </div>
     </div>
  </body>
</html>
