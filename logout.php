<?php
  //página feita para logout de usuários
  // devido minha falta de conhecimento em php, criar um link para agir como botão foi a minha alternativa
  session_start();
  unset($_SESSION);
  session_destroy();
  header('location: ./index.php');
  die;
 ?>
