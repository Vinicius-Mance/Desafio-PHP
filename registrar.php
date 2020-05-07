<?php
include('functions.php');
session_start();
if (!$_SESSION) {
header('location: login.php');
}

if($_POST){
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $verify = $_POST['verify'];

    $emailOk = false;
    $senhaOk = false;
    $nomeOk = false;
    if(empty($_POST['email']) === false){
    $emailOk = true;
    }
    if(empty($_POST['nome']) === false){
    $nomeOk = true;
    }
    if(strlen($senha) > 5 or $senha == $verify){
    $senhaOk = true;
    }
    if($nomeOk and $senhaOk and $emailOk){
        $encrypt_senha= password_hash($senha, PASSWORD_DEFAULT);
        add_user($nome,$email,$encrypt_senha);
        header('location: login.php');
    }
} //fechamendo if ($_POST)
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <title>Registrar-se</title>
  </head>
  <body>
    <div class="site">
<?php include('header.php');?>
      <div class="container">
        <form class="" action="registrar.php" method="post">
        <label for="email">Digite seu email</label><br>
          <input type="email" name="email"><br>
        <label for="nome">Digite seu nome</label><br>
          <input type="text" name="nome"><br>
        <label for="senha">Digite sua senha</label><br>
          <input type="password" name="senha"><br>
        <label for="verify">Digite sua senha novamente</label><br>
          <input type="password" name="verify"><br>
        <button type="submit" name="button">Enviar</button>
        </form>
        </div>
        <div class="container">
        <?php $usuarios = fetch_user();
           foreach($usuarios as $user):?>
      		<article>
            <span> Usuário: <?php echo $user['nome']; ?> </span>
              <p> E-mail: <?php echo $user['email']; ?></p>
                <a href="alterar_user.php">Modificar usuário</a>
      		</article>
      		<?php endforeach;?>
       </div>
     </div>
  </body>
</html>
