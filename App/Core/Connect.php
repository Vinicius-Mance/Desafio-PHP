<?php

namespace App\Core;

use PDO;
use PDOException;


class Connect {

 static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)){
            try {
                self::$instance = new PDO(
                    "mysql:host=twtraders.mysql.database.azure.com;dbname=fiap",
                    "billygates@twtraders",
                    "Wind@2021"
                );
            }catch ( PDOException $exception ){
                die("<h1>Erro Ao Conectar</h1>" . $exception->getMessage());
            }
        }
        return self::$instance;
 }
}
