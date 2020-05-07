<?php
 include('functions.php');
 session_start();
 if (!$_SESSION) {
 header('location: login.php');
 }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <title>Function</title>
  </head>
  <body>
    <div class="site">
      <div class="container">
        <?php
        if ($_POST['delete']) {
        $produto = call_pdt($_GET['id']);
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
                echo "<pre>";
                var_dump($data);
                echo "<pre>";
                break;
                  }
                }
              }
            }
          }
        header('location: produto.php');
       ?>
       </div>
     </div>
  </body>
</html>
