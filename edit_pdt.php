<?php
include('functions.php');
session_start();
if (!$_SESSION) {
header('location: login.php');
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
<?php include('header.php');
$produto = call_pdt($_GET['id']);
foreach ($produto as $pdt) {} ?>
<div class="container">
  <form action="item.php?id=<?php echo $produto['id'];?>" method="post" enctype="multipart/form-data">
    <label for="pdt">Nome</label><br>
      <input type="text" name="novo_pdt" value="<?php echo $produto['produto'];?>"><br>
    <label for="descricao">Descrição do produto</label><br>
      <input type="text" name="novo_descricao" value="<?php echo $produto['descricao']; ?>"><br>
    <label for="preco">Preço do Produto</label><br>
      <input type="number" name="novo_preco" value="<?php echo $produto['preco']; ?>"><br>
    <label for="foto">Foto</label><br>
    <img src="<?php echo $produto['foto'];?>" alt="">
      <input type="file" name="novo_foto"><br>
    <button type="submit" name="button">Salvar alterações</button>
    <a href="item.php?id=<?php echo $produto['id'];?>">Voltar e descartar alterações</a>
  </form>
      </div>
    </div>
  </body>
</html>
