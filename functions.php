<?php
//códigos de registro
  function fetch_user(){
      $data = file_get_contents("user.json", true);
      $usuarios = json_decode($data, true);
      return $usuarios;
  }

//upload de imagem
function upload_img($img){
  $valid=["image/jpeg","image/png","image/jpg"];
  if ($img['error']==0){
    if (array_search($img['type'], $valid) === false ){exit;}
    else {
    move_uploaded_file($img['tmp_name'], 'img/'.$img['name']);
    return 'img/'.$img['name'];
    }
  }
}
//adicionar usuário
  function add_user($nome, $email, $senha){
      $usuarios = fetch_user();
      if(empty($usuarios)){
        $id = 1;
      } else {
        $id = sizeof($usuarios) + 1;
      }
      $usuario = ['user'=>$id, 'nome'=>$nome, 'email'=>$email,'senha'=>$senha];
      $usuarios[]= $usuario;
      $data = json_encode($usuarios);
      if($data){file_put_contents('user.json', $data);}
  }

  function fetch_pdt(){
      $data = file_get_contents("data.json", true);
      $pdt = json_decode($data, true);
      if (empty($pdt)) {
        return false;
      }
      return $pdt;
  }

  function add_pdt($pdt, $preco, $foto,$descricao=''){
      $produtos = fetch_pdt();
      if(empty($produtos)){
        $id = 1;
      } else {
      $id = sizeof($produtos) + 1;
      }
      $product = ['id'=>$id,'produto'=>$pdt,'preco'=>$preco,'foto'=>$foto,'descricao'=>$descricao];
      $produtos[]= $product;
      $data = json_encode($produtos);
      if($data){file_put_contents('data.json', $data);}
  }

  function call_pdt($id){
      $produtos = fetch_pdt();
      foreach ($produtos as $item) {
          if($item['id'] == $id){
              return $item;
          }
      }
      return false;
  }

  function call_user($id){
      $usuario = fetch_user();
      foreach ($usuario as $user) {
          if($user['user'] == $id){
              return $user;
          }
      }
      return false;
  }
 ?>
