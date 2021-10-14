<?php
include('includes/functions.php');
//verifica se o usuário já está logado
use App\Controllers\User;

spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

session_start();
    $user = new User();
    $nomeOk = true;
    $emailOk = true;
    $senhaOk = true;
    $emailExiste = true;
    $nomeExiste = true;
    $email = '';
    $nome = '';
    $usuario = $user->read();
if($_POST){
    //pega informações dos usuários registrados
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $verify = $_POST['verify'];
    //verifica se um email foi digitado
    foreach ($usuario as $info) {
      if ($_POST['email'] == $info['email']) {
        $emailExiste = false;
      }
      if ($_POST['nome'] == $info['nome']) {
       $nomeExiste = false;
      }
    }
    if(empty($_POST['email'])){
    $emailOk = false;
    }
    //verifica se um nome foi digitado
    if(empty($_POST['nome'])){
    $nomeOk = false;
    }
    //verifica se a senha é válida e sua validação estão corretas
    if(strlen($senha) < 5 or $senha != $verify or empty($senha)){
    $senhaOk = false;
    }
    //adiciona o usuário a lista de usuários
    if($nomeOk and $senhaOk and $emailOk){
        $encrypt_senha = password_hash($senha, PASSWORD_DEFAULT);
        $user->register($nome,$email,$encrypt_senha);
        header('location: ./registrar.php');
    }
}
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
      <div class="registar container">
        <form action="registrar.php" method="post">
          <label for="email">Digite um email</label><br>
            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="nome@gmail.com"><br>
            <?= ($emailOk ? '' : '<span class="erro">Email inválido</span>'.'<br>');  ?>
            <?= ($emailExiste ? '' : '<span class="erro">Email já registrado</span>'.'<br>');  ?>
          <label for="nome">Digite um nome</label><br>
            <input type="text" name="nome" value="<?php echo $nome; ?>" placeholder="nome"><br>
            <?= ($nomeOk ? '' : '<span class="erro">Coloque um nome</span>'.'<br>');  ?>
            <?= ($nomeExiste ? '' : '<span class="erro">Nome já cadastrado</span>'.'<br>');  ?>
          <label for="senha">Digite uma senha</label><br>
            <input type="password" name="senha" placeholder="senha123"><br>
          <label for="verify">Redigite a senha</label><br>
            <input type="password" name="verify" placeholder="senha123"><br>
            <?= ($senhaOk ? '' : '<span class="erro">Senha ou validação incorreta</span>'.'<br>');  ?>
          <button type="submit" name="button">Enviar</button>
        </form>
      </div>
        <div class="user_info container">
        <?php foreach($usuario as $user):?>
        		<article class="user">
              <span> Usuário: <?php echo $user['nome'];?></span>
                <p> E-mail: <?php echo $user['email'];?></p>
              <?php if ($user['user']):?>
                <a href="mailto:<?php echo $user['email']; ?> " target="_blank">Administrador (contato)</a>
              <?php else:?>
              <a href="delete.php?user=<?php echo $user['id'];?>">Apagar usuário</a>
              <?php endif; ?>
        		</article>
      		<?php endforeach;?>
       </div>
     </div>
  </body>
</html>
