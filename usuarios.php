<?php
include('functions.php');
session_start();
if (!$_SESSION) {
header('location: login.php');
}
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
    <div class="container">
    <?php $usuarios = fetch_user();
      foreach($usuarios as $user): ?>
      <article>
        <span> Usuário: <?php echo $user['nome']; ?> </span>
          <p> E-mail: <?php echo $user['email']; ?></p>
            <a href="#">Editar usuário</a>
      </article>
    <?php endforeach;?>
    </div>
  </div>
  </body>
</html>
