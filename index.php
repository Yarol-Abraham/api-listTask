<?php

require "./includes/app.php";

use MVC\Router;
use Controllers\UsuarioController;
use Controllers\LoginController;

$router = new Router();
// ----- Usuarios -----
$router->Set_get("/user/get", [UsuarioController::class, "GetUser"]);
// ----- Autenticación -----
$router->Set_post("/auth/login", [LoginController::class, "Login"]);

$router->Route();