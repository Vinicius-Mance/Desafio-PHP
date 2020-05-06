<?php
include('functions.php');
    $pdtOK = true;
    $precoOK = true;
    $fotoOK = true;
    $enviarOK = true;
if($_POST or $_FILES){
  $pdt = $_POST['pdt'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $foto = $_FILES['foto'];
    if (empty($pdt)){
      $pdtOK = false;
    }
    if (empty($preco) or $preco < 0 and is_numeric($preco)){
      $precoOK = false;
    }
      if ($foto['error']==0){
        $valid=["image/jpeg","image/png","image/jpg"];
        if (array_search($foto['type'], $valid) === false ){exit;}
        } else {
      $fotoOK = false;}
    if ($pdtOK and $precoOK and $fotoOK){
      move_uploaded_file($foto['tmp_name'], 'img/'.$foto['name']);
      $foto = 'img/'.$foto['name'];
        add_pdt($pdt, $preco, $foto,$descricao);
        header('location: ');
    }
}
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
    <label for="pdt">Nome do produto</label><br>
      <input type="text" name="pdt"><br>
        <?php echo ($pdtOK ? '' : '<span class="erro">Coloque um nome</span>'.'<br>');?>
    <label for="descricao">Descrição do produto</label><br>
      <input type="text" name="descricao"><br>
    <label for="preco">Preço do Produto</label><br>
      <input type="number" name="preco"><br>
        <?php  echo ($precoOK ? '' : '<span class="erro">Coloque um preço</span>'.'<br>');?>
    <label for="foto">Foto</label><br>
      <input type="file" name="foto"><br>
      <?php  echo ($fotoOK ? '' : '<span class="erro">Envie uma imagem</span>'.'<br>');?>
    <button type="submit" name="button">Enviar</button>
    <button type="reset" name="button">Reset</button>
  </form>
<a href="logout.php">Logout</a>
<a href="produto.php">Visualisação de produtos</a>
      </div>
    </div>
  </body>
</html>
