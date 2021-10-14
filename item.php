<?php
  //página para visualização de item individualmente
   include('includes/functions.php');

   use App\Controllers\Products;

   spl_autoload_register(function ($class_name) {
     include $class_name . '.php';
   });

   //verifica se o usuário está logado
   session_start();
   if (!$_SESSION) {
   header('location: ./index.php');
   }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/item.css">
    <meta charset="utf-8">
    <title>Function</title>
  </head>
  <body>
    <div class="site">
      <?php include('includes/header.php');?>
    <div class="content">
      <div class="container">
        <?php
        //busca informações a serem impressas na página
        $product = new Products();
        $produto = $product->selectPdt($_GET['id']);
         ?>
        <article>
            <span> Nome: <?php echo $produto['nome']; ?> </span><br>
            <span> Preço: <?php echo 'R$: '.number_format($produto['preco'], 2, ',', '.'); ?></span><br>
            <span>Descrição: <?php echo $produto['descricao']; ?></span><br>
          <form action="delete.php?id=<?php echo $_GET['id'];?>" method="post">
            <a href="edit_pdt.php?id=<?php echo $_GET['id'];?>">Editar</a>
          </form>
        </article>
       </div>
            <img src="<?php echo $produto['foto'] ?>" alt="<?php echo $produto['nome']; ?>">
        </div>
     </div>
  </body>
</html>
