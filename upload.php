<?php
include('includes/functions.php');
//verifica se o usuário está logado
session_start();
if (!$_SESSION) {
header('location: login.php');
}
    $pdtOK = true;
    $precoOK = true;
    $fotoOK = true;
    $enviarOK = true;

    $pdt = '';
    $descricao = '';
    $preco = '';
//verifica se um dos campos foi preenchido
if($_POST or $_FILES){
  $pdt = $_POST['pdt'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $foto = $_FILES['foto'];
    //verifica se o nome foi preenchido
    if (empty($pdt)){
      $pdtOK = false;
    }
    //verifica se o preço é valido (um número e maior que zero)
    if (empty($preco) or $preco < 0 and is_numeric($preco)){
      $precoOK = false;
    }
    //verifica se uma imagem foi enviada
      if ($foto['error']==0){
        $valid=["image/jpeg","image/png","image/jpg"];
        if (array_search($foto['type'], $valid) === false ){exit;}
        } else {
      $fotoOK = false;}
    //adiciona o produto no catálogo
    if ($pdtOK and $precoOK and $fotoOK){
        move_uploaded_file($foto['tmp_name'], 'img/'.$foto['name']);
      $foto = 'img/'.$foto['name'];
        add_pdt($pdt, $preco, $foto,$descricao);
        header('location: upload.php');
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
    <label for="pdt">Nome do produto</label><br>
      <input type="text" name="pdt" value="<?php echo $pdt; ?>"><br>
        <?php echo ($pdtOK ? '' : '<span id="produtoNome" class="erro">Coloque um nome</span>'.'<br>');?>
    <label for="descricao">Descrição do produto</label><br>
      <textarea name="descricao"><?php echo $descricao; ?></textarea><br>
    <label for="preco">Preço do Produto (R$)</label><br>
      <input type="number" name="preco" value="<?php echo $preco; ?>"><br>
        <?php  echo ($precoOK ? '' : '<span id="produtoPreco" class="erro">Coloque um preço</span>'.'<br>');?>
    <label for="foto">Foto do produto</label><br>
      <input type="file" name="foto" id="foto-upload"><br>
      <?php  echo ($fotoOK ? '' : '<span id="produtoImagem" class="erro">Envie uma imagem</span>'.'<br>');?>
    <button type="submit" name="button">Enviar</button>
    <button type="reset" name="button">Reset</button>
  </form>
      </div>
         <div>
            <script>
                document.getElementById("foto-upload").onchange = (evt) => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                    document.getElementById("foto-load").src = e.target.result;};
                    reader.readAsDataURL(evt.target.files[0]);};
            </script>
          <img src="css/img/placeholder.png" id="foto-load">
        </div>
      </div>
    </div>
  </body>
</html>
