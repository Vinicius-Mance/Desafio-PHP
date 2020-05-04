<?php
//códigos de registro
  function fetch_user(){
      $data = file_get_contents("user.json");
      $usuarios = json_decode($data, true);
      return $usuarios;
  }


  function add_user($nome, $email, $senha){
      $usuarios = fetch_user();
      $user = ['nome'=>$nome, 'email'=>$email,'senha'=>$senha];
      $usuarios[]= $user;
      $data = json_encode($usuarios);
      if($data){file_put_contents('user.json', $data);}
  }
// session_start();
// unset($_SESSION);
// session_destroy();
// session_write_close();
// header('Location: /');
// die;
 ?>
<!-- <a href="logout.php">Logout</a> -->
