<?php
  //pagina para editar informações de um produto
  include('includes/functions.php');
  //verifica se o usuário está logado
  session_start();
  if (!$_SESSION) {
  header('location: login.php');
  }
  //informações a serem impressas na tela
  $produto = call_pdt($_GET['id']);
  foreach($produto as $pdt){}
  //verifica se há alterações
  if ($_POST or $_FILES) {
    $pdt = $_POST['pdt'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $foto = $_FILES['foto'];
    //verifica se o nome não está vazio
    if (empty($_POST['pdt'])) {
        $pdt = $produto['produto'];
    }
    //verifica se o preço não foi apagado
    if (empty($_POST['preco']) or $_POST['preco'] <= 0) {
      $preco = $produto['preco'];
    }
    //verifica se uma nova foto foi selecionada para o produto
    if ($foto['error']==0){
      $valid=["image/jpeg","image/png","image/jpg"];
      if (array_search($foto['type'], $valid) === false){
      exit;}
      else {
      //retira a foto antiga
        unlink($produto['foto']);
      $foto = $_FILES['foto'];
      //coloca a foto nova no lugar
        move_uploaded_file($foto['tmp_name'], 'img/'.$foto['name']);
      $foto = 'img/'.$foto['name'];
      }
    } else {
      $foto = $produto['foto'];
    }
  //verifica se o produto existe no catálogo
  if ($produto) {
      $files = fetch_pdt();
      //procura o item em questão e troca suas informações
      foreach($files as $item => $info) {
        if($info['id'] == $_GET['id']) {
          $new_info = ['produto'=>$pdt,'preco'=>$preco,'foto'=>$foto,'descricao'=>$descricao];
          $new_file = array_replace($files[$item],$new_info);
            unset($files[$item]);
            array_values($new_file);
          $files[]= $new_file;
          $data = json_encode($files);
            //coloca as novas informações no arquivo json
            file_put_contents('dados/data.json', $data);
            header("location: edit_pdt.php?id=".$_GET['id']);
        break;
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/item.css">
  <meta charset="utf-8">
  <title>Upload de produtos</title>
</head>
<body>
<div class="site">
<?php include('includes/header.php');?>
<div class="content">
<div class="container">
  <form method="post" enctype="multipart/form-data">
    <label for="pdt">Nome</label><br>
      <input type="text" name="pdt" value="<?php echo $produto['produto'];?>"><br>
    <label for="descricao">Descrição do produto</label><br>
      <textarea name="descricao"  value="<?php echo $produto['descricao']; ?>"><?php echo $produto['descricao']; ?></textarea>
    <label for="preco">Preço do Produto (R$)</label><br>
      <input type="number" name="preco" value="<?php echo $produto['preco'];?>"><br>
    <label for="foto">Foto</label><br>
      <input type="file" name="foto" id="img-upload" ><br>
    <button type="submit" name="button">Salvar alterações</button>
    <a href="item.php?id=<?php echo $produto['id'];?>">Voltar ao item</a>
  </form>
      </div>
          <script>
              document.getElementById("img-upload").onchange = (evt) => {
                  const reader = new FileReader();
                  reader.onload = function (e) {
                  document.getElementById("img-load").src = e.target.result;};
                  reader.readAsDataURL(evt.target.files[0]);};
          </script>
        <img id="img-load" src="<?php echo $produto['foto'];?>" alt="">
      </div>
    </div>
  </body>
</html>
