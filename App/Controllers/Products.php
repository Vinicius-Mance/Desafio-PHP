<?php

namespace App\Controllers;

require ("App/Core/Connect.php");

use App\Core\Connect;
use PDO;

class Products extends Connect
{
    public function list() {
        $db = self::getInstance();
        $query = $db->query("SELECT * FROM produtos")->fetchAll(PDO::FETCH_ASSOC);
        return $query;
    }

    public function create(string $mail,string $pass) {

        $db = self::getInstance();
        $sql = "INSERT INTO produtos () VALUES ()";
        $stmt = $db->prepare($sql);

        $stmt->bindValue(":coluna", $variavel );
        $stmt->bindValue(":coluna", $variavel );

        $stmt->execute();

        if($stmt->rowCount() == 1){
            
            header("Location: registrar.php");
        }else {
                echo "<script>alert('Falha, cadastrar produto')</script>";
        }
    }
}