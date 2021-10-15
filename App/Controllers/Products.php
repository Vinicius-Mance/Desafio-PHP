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

    public function create(string $name, string $preco, string $foto, string $descricao) {
        $db = self::getInstance();
        $sql = "INSERT INTO produtos(nome, preco, foto, descricao) values (:name, :price, :photo, :descricao)";

        $stmt = $db->prepare($sql);

        $stmt->bindValue(":name", $name );
        $stmt->bindValue(":price", $preco);
        $stmt->bindValue(":photo", $foto);
        $stmt->bindValue(":descricao", $descricao);

        $stmt->execute();

        if($stmt->rowCount() == 1){
            $dados = $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION["logado"] = true;
            $_SESSION["administrador"] = ['nome' => $dados->nome];
            header("Location: produto.php");
        } else {
                echo "<script>alert('Falha, Login e/ou Senha errada')</script>";
        }
  }

  public function selectPdt($id) {
      $db = self::getInstance();
      $sql = "SELECT * FROM produtos WHERE id = :id";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(":id",$id);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function updatePdt($id, string $name, string $preco, string $descricao) {
      $db = self::getInstance();
      $sql = "UPDATE produtos SET nome = :name, preco = :price, descricao = :descricao  WHERE id = :id";

      $stmt = $db->prepare($sql);
      $stmt->bindValue(":id", $id);
      $stmt->bindValue(":name", $name );
      $stmt->bindValue(":price", $preco);
      $stmt->bindValue(":descricao", $descricao);

      $stmt->execute();

      if($stmt->rowCount() == 1){
          $dados = $stmt->fetch(PDO::FETCH_OBJ);
          $_SESSION["logado"] = true;
          $_SESSION["administrador"] = ['nome' => $dados->nome];
          header("Location: produto.php");
      } else {
              echo "<script>alert('Falha, Login e/ou Senha errada')</script>";
      }
  }

}
