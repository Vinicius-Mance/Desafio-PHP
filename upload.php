<?php
session_start();
if (!$_SESSION) {
header('location: login.php');
}
include('functions.php')
 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <meta charset="utf-8">
  <title>Upload de produtos</title>
</head>
<body>
<div class="site">
<div class="container">
  <form action="" method="post" enctype="multipart/form-data">
    <label for="nome_pdt">Nome do produto</label><br>
      <input type="text" name="nome_pdt"><br>
    <label for="descricao">Descrição do produto</label><br>
      <input type="text" name="descricao"><br>
    <label for="preco">Preço do Produto</label><br>
      <input type="number" name="preco"><br>
    <label for="foto">Foto</label><br>
      <input type="file" name="foto"><br>
    <button type="submit" name="button">Enviar</button>
  </form>
<a href="logout.php">Logout</a>
<?php
if($_POST){
if ($_FILES) {
  $foto = $_FILES['foto'];
  upload_img($foto);
  }
} else{die();}

?>
      </div>
    </div>
  </body>
</html>
