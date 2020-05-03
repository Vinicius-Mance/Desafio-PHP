<?php include 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <title>Function</title>
  </head>
  <body>
    <div class="site">
      <div class="container">
        <form class="" action="functions.php" method="post" enctype="multipart/form-data">
        <label for="nome">Nome do produto</label><br>
        <?php  ?>
        <input type="text" name="nome_pdt" placeholder="nome do produto"><br>
        <label for="descricao">Descrição do produto</label><br>
        <input type="text" name="descricao" placeholder="descrição produto"><br>
        <label for="preco">Preço do produto</label><br>
        <input type="number" name="preco" placeholder="preço do produto"><br>
        <label for="foto">Foto do produto</label><br>
        <input type="file" name="foto">
        <button type="submit" name="button">Enviar</button>
        </form>
          <?php
          $valid=["image/jpeg","image/png","image/jpg"];
          if ($_FILES['foto']['error']==0) {
            if (array_search($_FILES['foto']['type'], $valid) === false ) {
              echo "Extenção inválida";
              exit;
            }
            if (move_uploaded_file($_FILES['foto']['tmp_name'], 'img/'.$_FILES['foto']['name'])) {
            echo "arquivo salvo";
          }} else {
            echo "Erro ao enviar arquivo";
          }
            ?>
       </div>
     </div>
  </body>
</html>
