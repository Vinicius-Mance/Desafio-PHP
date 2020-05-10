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
    <meta charset="utf-8">
    <title>Function</title>
  </head>
  <body>
    <div class="site">
      <?php include('includes/header.php');?>
      <div class="container">
        <?php
        $produto = call_pdt($_GET['id']);
        if ($produto): ?>
        <article>
          <span> Produto: <?php echo $produto['produto']; ?> </span>
            <p> Preço: <?php echo $produto['preco']; ?></p>
            <span><?php echo $produto['descricao']; ?></span>
            <img src="<?php echo $produto['foto'] ?>" alt="">
            <form action="delete.php?id=<?php echo $_GET['id'];?>" method="post">
              <label for="delete">Para apagar, escreva o nome do produto como escrito</label>
              <input type="text" name="delete">
            <button type="submit">Apagar produto</button>
            </form>
            <a href="edit_pdt.php?id=<?php echo $_GET['id'];?>">Editar</a>
        </article>
        <?php endif;?>
       </div>
     </div>
  </body>
</html>
