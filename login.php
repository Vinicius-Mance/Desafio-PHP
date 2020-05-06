<?php
    include("functions.php");
    $loginOk = true;
    if($_POST){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $usuarios = fetch_user();
        foreach($usuarios as $user){
        if($user['email'] == $email and $user['senha'] == password_verify($senha,$user['senha'])){
          session_start();
          $_SESSION['email'] = $user['email'];
          $_SESSION['nome'] = $user['nome'];
          header('location: list-user.php');
        } else {$loginOk = false;}
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <div class="site">
      <div class="container">
        <form class="" method="post">
        <label for="email">Digite seu email</label><br>
          <input type="email" name="email" placeholder="nome@gmail.com"><br>
        <label for="senha">Digite sua senha</label><br>
          <input type="password" name="senha" placeholder="senha123"><br>
        <?= ($loginOk ? '' : '<span class="erro">Email ou senha inválidos</span>'.'<br>'); ?>
        <button type="submit" name="button">Enviar</button><br>
        </form>
        <p>Não tem uma conta ainda? <a href="registrar.php">Cadastre-se</a></p>
       </div>
     </div>
  </body>
</html>
