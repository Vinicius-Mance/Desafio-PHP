<?php
//página feita para remoção de produtos e usuários
use App\Controllers\User;

spl_autoload_register(function ($class_name) {
  include $class_name . '.php';
});

$user = new User();


// include('includes/functions.php');
//caso o usuário não estiver logado, retorno a página de login
 session_start();
 if (!$_SESSION) {
 header('location: ./index.php');
 }
//apagar produto/item



//remoção de usuários
if ($_GET['user']) {
      $user->delete($_GET['user']);
      header('location: ./registrar.php');
}
    


 ?>
</body>
</html>
