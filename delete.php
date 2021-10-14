<?php
//página feita para remoção de produtos e usuários
// devido minha falta de conhecimento em php, criar um link para agir como botão foi a minha alternativa
include('includes/functions.php');
//caso o usuário não estiver logado, retorno a página de login
 session_start();
 if (!$_SESSION) {
 header('location: ./index.php');
 }
//apagar produto/item
if ($_POST['delete']) {
  $produto = call_pdt($_GET['id']);
  //verificar se o item registrado existe
  if ($produto) {
    //identificar se o item teve o nome corretamente reescrito para ser apagado
    if ($_POST['delete'] == $produto['produto']) {
    unlink($produto['foto']);
    $files = fetch_pdt();
      foreach($files as $item => $info) {
        //encontra o produto em questão e apaga-o
        if($info['id'] == $_GET['id']) {
        unset($files[$item]);
        $data = json_encode($files);
        file_put_contents('dados/data.json', $data);
        var_dump($data);
        break;
        }
      }
    }
  }
  //voltar automaticamente para a página de produtos após remoção do item
  header('location: ./produto.php');
  } else {
  //volta ao item caso o nome não foi escrito corretamente
  header('location: ./item.php?id='.$_GET['id']);
  }

//remoção de usuários
if ($_GET['user']) {
  $usuario = call_user($_GET['user']);
  if ($usuario) {
    $files = fetch_user();
      //encontra o usuário em questão e apaga-o
      foreach($files as $item => $info) {
        if($info['user'] == $_GET['user']) {
        unset($files[$item]);
        array_values($files);
        $data = json_encode($files);
        file_put_contents('dados/user.json', $data);
        break;
        }
      }
    }
    //retorna a página de usuários e cadastro
    header('location: ./registrar.php');
}
 ?>
</body>
</html>
