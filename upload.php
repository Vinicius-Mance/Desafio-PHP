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
  $nome_pdt = $_POST['nome_pdt'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $foto = $_FILES['foto'];

  $nome_pdtOK = false;
  $precoOK = false;
  $fotoOK = false;
  if (empty($nome_pdt) == false){
    $nome_pdtOK = true;
  }
  if ($preco > 0 and is_numeric($preco)){
    $precoOK = true;
  }
  if (empty($foto) == false){
    $fotoOK = true;
  }
  if ($nome_pdtOK and $precoOK and $fotoOK){
      upload_img($foto);
  }
}

?>
      </div>
    </div>
  </body>
</html>
