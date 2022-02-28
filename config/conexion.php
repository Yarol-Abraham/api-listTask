<?php
namespace Config;

use FFI\Exception;
use PDO;

class Conectar { 
 
    protected function Conexion()
    {
        try
        {
            $conectar = new PDO("mysql:local=localhost;dbname=listtask","root","");
            return $conectar;
        }catch(Exception $ex){
            echo "error en la base de datos: " . $ex->getMessage();
            die();
        }
    }

}