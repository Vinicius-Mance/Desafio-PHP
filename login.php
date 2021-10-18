<?php
    //página para login
    include("includes/functions.php");
    //verifica se o usuário já está logado
    session_start();
    if ($_SESSION) {
    header('location: produto.php');
    }

$loginOk = true;
  $email= '';
  //verifica se o usuário preencheu algum dos campos
    if($_POST){
        $login= $_POST['login'];
        $senha = $_POST['senha'];
        //verifica todos os usuários existentes
        $usuarios = fetch_user();
        foreach($usuarios as $user){
          if( ($user['email'] or $user['nome']) == $login and $user['senha'] == password_verify($senha,$user['senha'])){
            // leva a página de usuários após login do usuário
              $_SESSION['user'] = $user['user'];
              header('location: registrar.php');
          } else {$loginOk = false;}
      }
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
