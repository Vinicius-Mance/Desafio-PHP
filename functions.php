<?php
//códigos de registro
  function fetch_user(){
      $data = file_get_contents("user.json");
      $usuarios = json_decode($data, true);
      return $usuarios;
  }

//upload de imagem
function upload_img($img){
  $valid=["image/jpeg","image/png","image/jpg"];
  if ($img['error']==0){
    if (array_search($img['type'], $valid) === false ){exit;}
    // if (move_uploaded_file($img['tmp_name'], 'img/'.$img['name'])){}
    else {
    move_uploaded_file($img['tmp_name'], 'img/'.$img['name']);
    }
  }
}

//adicionar usuário
  function add_user($nome, $email, $senha){
      $usuarios = fetch_user();
      $user = ['nome'=>$nome, 'email'=>$email,'senha'=>$senha];
      $usuarios[]= $user;
      $data = json_encode($usuarios);
      if($data){file_put_contents('user.json', $data);}
  }
 ?>
