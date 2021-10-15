<?php

use App\Controllers\Products;

spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

  $products = new Products();

  //pagina para editar informações de um produto
  include('includes/functions.php');
  //verifica se o usuário está logado
  session_start();
  if (!$_SESSION) {
  header('location: ./index.php');
  }
  //informações a serem impressas na tela

  $produto = $products->selectPdt($_GET['id']);
  foreach($produto as $pdt){}
  //verifica se há alterações
  if ($_POST) {
    $pdt = $_POST['pdt'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    //verifica se o nome não está vazio
    if (empty($_POST['pdt'])) {
        $pdt = $produto['produto'];
    }
    //verifica se o preço não foi apagado
    if (empty($_POST['preco']) or $_POST['preco'] <= 0) {
      $preco = $produto['preco'];
    }

  //verifica se o produto existe no catálogo
  if ($produto) {
      //procura o item em questão e troca suas informações
      $products->updatePdt($_GET["id"],$pdt,$preco,$descricao);
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/item.css">
  <meta charset="utf-8">
  <title>Upload de produtos</title>
</head>
<body>
<div class="site">
<?php include('includes/header.php');?>
<div class="content">
<div class="container">
  <form method="post" enctype="multipart/form-data">
    <label for="pdt">Nome</label><br>
      <input type="text" name="pdt" value="<?php echo $produto['nome'];?>"><br>
    <label for="descricao">Descrição do produto</label><br>
      <textarea name="descricao"  value="<?php echo $produto['descricao']; ?>"><?php echo $produto['descricao']; ?></textarea>
    <label for="preco">Preço do Produto (R$)</label><br>
      <input type="number" name="preco" value="<?php echo $produto['preco'];?>"><br>
    <button type="submit" name="button">Salvar alterações</button>
    <a href="item.php?id=<?php echo $produto['id'];?>">Voltar ao item</a>
  </form>
    </div>
  </body>
</html>
