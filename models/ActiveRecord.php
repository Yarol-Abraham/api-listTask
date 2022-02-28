<?php

namespace Model;

use Config\Conectar;
use Exception;

class ActiveRecord extends Conectar
{
    protected static $db;
    protected static $table = '';
    protected static $columns = [];
    protected static $MESSAGE_ERROR_DB = [ 'message' => "Ha ocurrido un error inesperado!" ];

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function CreateDoc() // TODO: SIN TERMINAR
    {
        $atributes = $this->Atributes();
        $sql = "INSERT INTO " . static::$table . " (";
        $sql .= "usuario,correo,password) VALUES('";
        $sql .= join("', '", array_values($atributes));
        debugear($sql);
    }

    public function GetDoc($id)
    {
        try
        {
            $conectar = parent::Conexion();
            $sql = "SELECT * FROM " . static::$table . " WHERE id='" . $id . "'";
            $stmt = $conectar->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();

            if(is_array($result) and count($result) > 0) return $result;
            
            return [ "message" => "No se encontraron resultados" ];
        
        }catch(Exception $ex)
        {
            if(DEVELOPMENT === "DEV") debugear($ex->getMessage());
            return  self::$MESSAGE_ERROR_DB;
        }   
    }

    public function WhereDoc($field, $value)
    {
        try
        {
            $conectar = parent::Conexion();
            $sql = "SELECT * FROM " . static::$table . " WHERE ";
            $sql .= $field . "=?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $value);
            $stmt->execute();
            $result = $stmt->fetch();

            if(is_array($result) and count($result) > 0) return $result;
            
            return [ "message" => "No se encontro el registro con {$value}" ];
            
        }catch(Exception $ex)
        {
            if(DEVELOPMENT === "DEV") debugear($ex->getMessage());
            return  self::$MESSAGE_ERROR_DB;
        }
    }

    protected function Atributes()
    {
        $atributes = [];
        
        foreach(static::$columns as $column)
        {
            if($column === 'id') continue;
            $atributes[$column] = $this->$column;
        }
        
        return $atributes;
    }
    
    public function synchronize($args = [])
    {
        foreach($args as $key => $value)
        {
            if(property_exists($this, $key) && !is_null($value)) $this->$key = $value;
        }
    }

}