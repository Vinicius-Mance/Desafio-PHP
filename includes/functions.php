<?php
// funções presentes usadas pelo site todo
  //retorna todos os usuários da página
  function fetch_user(){
      $data = file_get_contents("dados/user.json", true);
      $usuarios = json_decode($data, true);
      return $usuarios;
  }

//retorna informações de um usuário específico via id
  function call_user($id){
      $usuario = fetch_user();
      foreach ($usuario as $user) {
          if($user['user'] == $id){
              return $user;
          }
      }
      return false;
  }

//adiciona usuário
  function add_user($nome, $email, $senha){
      //busca dados de usuários existentes
      $usuarios = fetch_user();
      //criação de identificador para facilitar a impressão de informações
      if(empty($usuarios)){
        $id = 1;
      } else {
        $id = sizeof($usuarios) + 1;
      }
      $usuario = ['user'=>$id, 'nome'=>$nome, 'email'=>$email,'senha'=>$senha];
      $usuarios[]= $usuario;
      $data = json_encode($usuarios);
      //adicionando o usuário junto de usuários existentes
      if($data){file_put_contents('dados/user.json', $data);}
  }

//busca todos os produtos cadastrados
  function fetch_pdt(){
      $data = file_get_contents("dados/data.json", true);
      $pdt = json_decode($data, true);
      if (empty($pdt)) {
        return false;
      }
      return $pdt;
  }

//retorna informações de um produto específico via id
  function call_pdt($id){
      $produtos = fetch_pdt();
      foreach ($produtos as $item) {
          if($item['id'] == $id){
              return $item;
          }
      }
      return false;
  }

//adiciona um produto ao catálogo
  function add_pdt($pdt, $preco, $foto,$descricao=''){
      $produtos = fetch_pdt();
      //adição de id para facilitação de impressão de informações
      if(empty($produtos)){
        $id = 1;
      } else {
      $id = sizeof($produtos) + 1;
      }
      $product = ['id'=>$id,'produto'=>$pdt,'preco'=>$preco,'foto'=>$foto,'descricao'=>$descricao];
      $produtos[]= $product;
      $data = json_encode($produtos);
      //adiciona o produto junto dos outros produtos existentes
      if($data){file_put_contents('dados/data.json', $data);}
  }
 ?>
