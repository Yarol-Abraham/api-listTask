<?php


namespace Model;

class Usuarios extends ActiveRecord{

    protected static $table = "usuarios";
    protected static $columns = [
        "id",
        "usuario",
        "correo",
        "password"
    ];

    public $id;
    public $usuario;
    public $correo;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario = $args['usuario'] ?? null;
        $this->correo = $args['correo'] ?? null;
        $this->password = $args['password'] ?? null;
    }
   
    


}