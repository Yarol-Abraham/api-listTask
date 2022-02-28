<?php

namespace Controllers;

use Model\Usuarios;

class UsuarioController extends ResponseController
{

    public static function GetUser()
    {
        $id = $_GET['id'] ?? null;

        if($id === null) return ResponseController::sendError([ "message" => "el id no existe en el servidor" ]);
        
        if(!is_numeric($id)) return ResponseController::sendError([ "message" => "Id inválido" ]);

        $usuario = new Usuarios();
        $getUser = $usuario->GetDoc($id);
        
        if(array_keys($getUser)[0] === "message") return ResponseController::sendError($getUser);

        ResponseController::sendSuccess($getUser);
    }

}