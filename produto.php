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
    <?php include('header.php');?>
      <div class="container">
        <?php
        $produtos = fetch_pdt(); ?>
        <?php if ($produtos): ?>
        <?php foreach($produtos as $item):
          $_GET['id'] = $item['id'];?>
        <article>
          <span> Produto: <?php echo $item['produto']; ?> </span>
            <p> Preço: <?php echo $item['preco']; ?></p>
            <span><?php echo $item['descricao']; ?></span>
              <a href="item.php?id=<?php echo $_GET['id'];?>">Ver mais</a>
        </article>
        <?php endforeach;?>
        <?php else: echo'<h1>Não há nenhum produto salvo.
        <a href="upload.php"> Coloque um agora!</a> </h1>';
          endif;?>
       </div>
     </div>
  </body>
</html>
