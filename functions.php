<?php

  // function add_pdt($nomePdt,$descricao=0,$preco,$foto){
  //     carregaUsuarios();
  //     $pdt = ['nome'=>$nomePdt, 'descricao'=>$descricao,'preco'=>$preco, 'foto'=>$foto];
  //     $produtos[]= $pdt;
  //     $data = json_encode($produtos);
  //     file_put_contents("data.json", $data);
  //     var_dump($pdt); echo "<br>";
  //     var_dump($nomePdt); echo "<br>";
  //     var_dump($descricao); echo "<br>";
  //     var_dump($preco); echo "<br>";
  //     var_dump($foto); echo "<br>";
  //     var_dump($prdutos); echo "<br>";
  //     var_dump($data); echo "<br>";
  // }

//   function verificar_campos(){
//   global $fotoOK;
//   $nomePdtOk = true;
//   $precoOk = true;
//   if($_POST){
//       if(empty($_POST['nome_pdt'])){
//           $nomePdtOk = false;
//       }
//       if (is_numeric($_POST['preco']) and $_POST['preco'] <=0) {
//         $precoOk = false;
//       }
//       if(($fotoOk and $nomePdtOk and $precoOk)==true){
//           add_pdt($_POST['nome_pdt'],$_POST['descricao'],$_POST['preco'],$img);
//       }
//    }
// }

function carregaUsuarios(){
    echo('add usuario executada');
    // Ler o arquivo para uma variável string
    $strJson = file_get_contents("../includes/usuarios.json");

    // transformar a string em array assoc (json_decode)
    $usuarios = json_decode($strJson, true);

    // retornar o array assoc
    return $usuarios;

}

/**
 * Adiciona um novo usuário no arquivo usuarios.json
 */
function addUsuario($nome, $telefone, $email, $endereço, $senha, $foto){
    //carrega usuarios usando a função anterior
    $usuarios = carregaUsuarios();

    //cria um array associativo $u com os dados passados por parâmetro
    $u = ['nome'=>$nome, 'telefone'=>$telefone, 'email'=>$email, 'endereço'=>$endereço, 'senha'=>$senha, 'foto'=>$foto];

    //adiciona $u ao final do array
    $usuarios[]= $u;

    //transforma o array de usuários de volta em string json
    $stringjson = json_encode($usuarios);

    // Verificando se existe algum caractere na stringjson.
    // se tiver, salva no arquivo usuarios.json
    if($stringjson){
        //salva a string json no arquivo usuarios.json
        file_put_contents('../includes/usuarios.json', $stringjson);
    }

}
 ?>
