<?php
 include('includes/functions.php');
 session_start();
 if (!$_SESSION) {
 header('location: login.php');
 }

if ($_POST['delete']) {
  $produto = call_pdt($_GET['id']);
  if ($produto) {
    if ($_POST['delete'] == $produto['produto']) {
    unlink('../'.$produto['foto']);
    $files = fetch_pdt();
      foreach($files as $item => $info) {
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
header('location: produto.php');
}

if ($_GET['user']) {
  $produto = call_user($_GET['user']);
  if ($produto) {
    $files = fetch_user();
      foreach($files as $item => $info) {
        if($info['user'] == $_GET['user']) {
        unset($files[$item]);
        array_values($files);
        $data = json_encode($files);
        file_put_contents('user.json', $data);
        break;
        }
      }
    }
    header('location: registrar.php');
}

if ($_POST['user']) {
  $produto = call_user($_GET['id']);
  if ($produto) {
    if ($_POST['delete'] == $produto['produto']) {
    unlink($produto['foto']);
    $files = fetch_pdt();
      foreach($files as $item => $info) {
        if($info['id'] == $_GET['id']) {
        unset($files[$item]);
        array_values($files);
        $data = json_encode($files);
        file_put_contents('data.json', $data);
        break;
        }
      }
    }
  }
  header('location: registrar.php');
}
 ?>
</body>
</html>
