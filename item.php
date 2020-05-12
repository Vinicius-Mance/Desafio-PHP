<?php
  //página para visualização de item individualmente
   include('includes/functions.php');
   //verifica se o usuário está logado
   session_start();
   if (!$_SESSION) {
   header('location: login.php');
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
        $produto = call_pdt($_GET['id']);
        if ($produto): ?>
        <article>
            <span> Nome: <?php echo $produto['produto']; ?> </span><br>
            <span> Preço: <?php echo 'R$: '.number_format($produto['preco'], 2, ',', '.'); ?></span><br>
            <span>Descrição: <?php echo $produto['descricao']; ?></span><br>
          <form action="delete.php?id=<?php echo $_GET['id'];?>" method="post">
            <label class="warn" for="delete">Para apagar, escreva o nome do produto como escrito</label>
              <input type="text" name="delete">
            <button class="apagar" type="submit">Apagar produto</button>
            <a href="edit_pdt.php?id=<?php echo $_GET['id'];?>">Editar</a>
          </form>
        </article>
        <?php endif;?>
       </div>
            <img src="<?php echo $produto['foto'] ?>" alt="<?php echo $produto['produto']; ?>">
        </div>
     </div>
  </body>
</html>
