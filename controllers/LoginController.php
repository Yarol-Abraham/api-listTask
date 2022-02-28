<?php

namespace Controllers;

use Model\Usuarios;

class LoginController extends ResponseController
{
    
    public static function Login() 
    {
        if($_SERVER["REQUEST_METHOD"] === "POST" )
        {
            $user = new Usuarios();
            $user->synchronize($_POST);
            // verificar que los campos existan
            if(!$user->correo || !$user->password)
                return ResponseController::sendError([ "message" => "correo o contraseña no son correctas" ]);

            // verificar si existe el usuario con el correo ingresado
            $getUser = $user->WhereDoc("correo", $user->correo);
            if(array_keys($getUser)[0] === "message") return ResponseController::sendError($getUser);
            
            // verificar que las contraseñas sean iguales
            if($getUser["password"] !== $user->password) 
                return ResponseController::sendError([ "message" => "correo o contraseña no son correctas" ]);

            session_start();
            
            //  ResponseController::sendSuccess($data);
        }
    }
    
}