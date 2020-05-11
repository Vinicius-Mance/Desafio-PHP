<?php
include('includes/functions.php');
session_start();
if (!$_SESSION) {
header('location: login.php');
}
    $nomeOk = true;
    $emailOk = true;
    $senhaOk = true;
    $email = '';
    $nome = '';
if($_POST){

    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $verify = $_POST['verify'];

    if(empty($_POST['email'])){
    $emailOk = false;
    }
    if(empty($_POST['nome'])){
    $nomeOk = false;
    }
    if(strlen($senha) < 5 or $senha != $verify or empty($senha)){
    $senhaOk = false;
    }
    if($nomeOk and $senhaOk and $emailOk){
        $encrypt_senha= password_hash($senha, PASSWORD_DEFAULT);
        add_user($nome,$email,$encrypt_senha);
        header('location: registrar.php');
    }
} //fechamendo if ($_POST)
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registar.css">
    <meta charset="utf-8">
    <title>Registrar-se</title>
  </head>
  <body>
    <div class="site">
<?php include('includes/header.php');?>
      <div class="registar">
        <form action="registrar.php" method="post">
        <label for="email">Digite seu email</label><br>
          <input type="email" name="email" value="<?php echo $email; ?>"><br>
          <?= ($emailOk ? '' : '<span class="erro">Email inválido</span>'.'<br>');  ?>
        <label for="nome">Digite seu nome</label><br>
          <input type="text" name="nome" value="<?php echo $nome; ?>"><br>
          <?= ($nomeOk ? '' : '<span class="erro">Preencha com um nome</span>'.'<br>');  ?>
        <label for="senha">Digite sua senha</label><br>
          <input type="password" name="senha"><br>
        <label for="verify">Digite sua senha novamente</label><br>
          <input type="password" name="verify"><br>
          <?= ($senhaOk ? '' : '<span class="erro">Senha ou validação incorreta</span>'.'<br>');  ?>
        <button type="submit" name="button">Enviar</button>
        </form>
        </div>
        <div class="user_info">
        <?php $usuario = fetch_user();
           foreach($usuario as $user):?>
      		<article class="user">
            <span> Usuário: <?php echo $user['nome'];?></span>
              <p> E-mail: <?php echo $user['email'];?></p>
            <?php if (!is_numeric($user['user'])):?>
            <a href="https://github.com/Vinicius-Mance">Administrador</a>
            <?php else:?>123456
            <a href="delete.php?user=<?php echo $user['user'];?>">Apagar usuário</a>
            <?php endif; ?>
      		</article>
      		<?php endforeach;?>
       </div>
     </div>
  </body>
</html>
