<?php
include('includes/functions.php');
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
if($_POST or $_FILES){
  $pdt = $_POST['pdt'];
  $descricao = $_POST['descricao'];
  $preco = $_POST['preco'];
  $foto = $_FILES['foto'];
    if (empty($pdt)){
      $pdtOK = false;
    }
    if (empty($preco) or $preco < 0 and is_numeric($preco)){
      $precoOK = false;
    }
      if ($foto['error']==0){
        $valid=["image/jpeg","image/png","image/jpg"];
        if (array_search($foto['type'], $valid) === false ){exit;}
        } else {
      $fotoOK = false;}
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
        <?php echo ($pdtOK ? '' : '<span class="erro">Coloque um nome</span>'.'<br>');?>
    <label for="descricao">Descrição do produto</label><br>
      <textarea name="descricao" value="<?php echo $descricao; ?>" rows="4" cols="40"></textarea><br>
    <label for="preco">Preço do Produto (R$)</label><br>
      <input type="number" name="preco" value="<?php echo $preco; ?>"><br>
        <?php  echo ($precoOK ? '' : '<span class="erro">Coloque um preço</span>'.'<br>');?>
    <label for="foto">Foto do produto</label><br>
      <input type="file" name="foto" id="foto-upload"><br>
      <?php  echo ($fotoOK ? '' : '<span class="erro">Envie uma imagem</span>'.'<br>');?>
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
