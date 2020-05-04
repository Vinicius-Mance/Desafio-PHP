<?php
  session_start();
  if (!$_SESSION) {
  header('location: login.php');
  }
  echo "Bem vindo(a) ".$_SESSION['nome'];
 ?>
 <head>
   <link rel="stylesheet" href="css/style.css">
 </head>
<body>
<a href="upload.php">Upload de produtos</a>
<a href="produto.php">Visualisação de produtos</a>
</body>
