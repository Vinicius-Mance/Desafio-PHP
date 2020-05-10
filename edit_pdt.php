<?php
include('functions.php');
session_start();
if (!$_SESSION) {
header('location: login.php');
}
$produto = call_pdt($_GET['id']);
foreach($produto as $pdt){}
if ($_POST) {
  $pdt = $_POST['pdt'];
  $preco = $_POST['preco'];
  $descricao = $_POST['descricao'];
  $foto = $produto['foto'];
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
      file_put_contents('data.json', $data);
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
  <meta charset="utf-8">
  <title>Upload de produtos</title>
</head>
<body>
<div class="site">
<?php include('header.php');?>
<div class="container">
  <form method="post" enctype="multipart/form-data">
    <label for="pdt">Nome</label><br>
      <input type="text" name="pdt" value="<?php echo $produto['produto'];?>"><br>
    <label for="descricao">Descrição do produto</label><br>
      <input type="text" name="descricao" value="<?php echo $produto['descricao']; ?>"><br>
    <label for="preco">Preço do Produto</label><br>
      <input type="number" name="preco" value="<?php echo $produto['preco']; ?>"><br>
    <label for="foto">Foto</label><br>
    <img src="<?php echo $produto['foto'];?>" alt="">
      <input type="file" name="foto"><br>
    <button type="submit" name="button">Salvar alterações</button>
    <a href="item.php?id=<?php echo $produto['id'];?>">Voltar ao item</a>
  </form>
      </div>
    </div>
  </body>
</html>
