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
    <title>Function</title>
  </head>
  <body>
    <div class="site">
      <div class="container">
        <form class="" action="functions.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome do produto</label><br>
        <input type="text" name="nome_pdt" placeholder="nome do produto"><br>
        <label for="descricao">Descrição do produto</label><br>
        <input type="text" name="descricao" placeholder="descrição produto"><br>
        <label for="preco">Preço do produto</label><br>
        <input type="number" name="preco" placeholder="preço do produto"><br>
        <label for="foto">Foto do produto</label><br>
        <input type="file" name="foto">
        <button type="submit" name="button">Enviar</button>
        </form>
        <a href="logout.php">Logout</a>
          <?php
          if ($_FILES) {
            $foto = $_FILES['foto'];
          }
          if($_POST){
              $email = $_POST['email'];
              $nome = $_POST['nome'];
              $senha = $_POST['senha'];
              $verify = $_POST['verify'];

              $emailOk = true;
              $nomeOk = true;
              $senhaOk = true;

              if(empty($_POST['nome'])){
                  $nomeOk = false;
              }
              if(strlen($senha) < 5 or $senha != $verify){
                  $senhaOk = false;
              }
              if($nomeOk and $senhaOk and $emailOk){
                    upload_foto($foto);
                  $encrypt_senha= password_hash($senha, PASSWORD_DEFAULT);
                  add_user($nome,$email,$encrypt_senha);
                  header('location: login.php');
              }
          } //fechamendo if ($_POST)
            ?>
       </div>
     </div>
  </body>
</html>
