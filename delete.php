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
      <div class="container">
        <?php
        $produto = call_pdt($_GET['id']);
        if ($produto) {
        if ($_GET) {
        if ($_GET['delete'] == $produto['produto']) {
        $files = fetch_pdt();
        $teste = strpos($files,$_GET['id']);
        echo $teste;
            }
          }
        }
        //  header('location: produto.php'); ?>
       </div>
     </div>
  </body>
</html>
