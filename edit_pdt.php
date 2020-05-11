<?php
include('includes/functions.php');
session_start();
if (!$_SESSION) {
header('location: login.php');
}
$produto = call_pdt($_GET['id']);
foreach($produto as $pdt){}
if ($_POST or $_FILES) {
  $pdt = $_POST['pdt'];
  $preco = $_POST['preco'];
  $descricao = $_POST['descricao'];
  $foto = $_FILES['foto'];
  if (empty($_POST['pdt'])) {
      $pdt = $produto['produto'];
  }
  if (empty($_POST['preco'])) {
    $preco = $produto['preco'];
  }
  if ($foto['error']==0){
    $valid=["image/jpeg","image/png","image/jpg"];
    if (array_search($foto['type'], $valid) === false){
    exit;}
    else {
    unlink($produto['foto']);
    $foto = $_FILES['foto'];
    move_uploaded_file($foto['tmp_name'], 'img/'.$foto['name']);
    $foto = 'img/'.$foto['name'];
    }
  } else {
    $foto = $produto['foto'];
  }
if ($produto) {
    $files = fetch_pdt();
    foreach($files as $item => $info) {
      if($info['id'] == $_GET['id']) {
      $new_info = ['produto'=>$pdt,'preco'=>$preco,'foto'=>$foto,'descricao'=>$descricao];
      $new_file = array_replace($files[$item],$new_info);
      unset($files[$item]);
      array_values($new_file);
      $files[]= $new_file;
      $data = json_encode($files);
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
