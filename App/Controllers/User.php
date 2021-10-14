<?php

namespace App\Controllers;

require ("App/Core/Connect.php");

use App\Core\Connect;
use PDO;

class User extends Connect
{
    public function read() {
        $db = self::getInstance();
        $query = $db->query("SELECT * FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);
        return $query;
    }

    public function login(string $mail,string $pass) {
        $db = self::getInstance();
        $sql = "SELECT * FROM usuarios WHERE email = :mail AND senha = :senha";
        $stmt = $db->prepare($sql);

        $stmt->bindValue(":mail", $mail );
        $stmt->bindValue(":senha", $pass );

        $stmt->execute();

        if($stmt->rowCount() == 1){
            $dados = $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION["logado"] = true;
            $_SESSION["administrador"] = ['nome' => $dados->nome];
            header("Location: registrar.php");
        }else {
                echo "<script>alert('Falha, Login e/ou Senha errada')</script>";
        }
    }
}