<?php
 include('includes/functions.php');
 session_start();
 if (!$_SESSION) {
 header('location: login.php');
 }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/produto.css">
    <meta charset="utf-8">
    <title>Function</title>
  </head>
  <body>
    <div class="site">
    <?php include('includes/header.php');
        $produtos = fetch_pdt();
          if ($produtos):?>
          <div class="container">
            <article id="label">
              <span>Item</span>
              <span>Preço</span>
              <span>Descrição</span>
            </article>
          <?php foreach($produtos as $item):
          $_GET['id'] = $item['id'];?>
        <article>
          <span><a href="item.php?id=<?php echo $_GET['id'];?>"><?php echo $item['produto'];?></a></span>
          <span><?php echo 'R$ '.number_format($item['preco'], 2, ',', '.');?></span>
          <span><?php echo $item['descricao'];?></span>
        </article>
        <?php endforeach;endif;?>
       </div>
        <a id="add" href="upload.php">Adicionar produto</a>
     </div>
  </body>
</html>
