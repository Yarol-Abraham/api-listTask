<?php

namespace MVC;

use Controllers\ErrorController;

class Router {

    public $get_url = [];
    public $post_url = [];

    public function Set_get($url, $fn)
    {
        $this->get_url[$url] = $fn;
    }

    public function Set_post($url, $fn)
    {
        $this->post_url[$url] = $fn;
    }

    protected function RunController($fn)
    {
        if($fn) return call_user_func($fn, $this);
        call_user_func([ErrorController::class, "index"], $this);
    } 

    public function Route()
    {
        $currentRouter = $_SERVER["PATH_INFO"];
        $methodRequest = $_SERVER["REQUEST_METHOD"];
        $fn = null; // get string method class

        if($methodRequest === "GET") $fn = $this->get_url[$currentRouter] ?? null;
        if($methodRequest === "POST") $fn = $this->post_url[$currentRouter] ?? null;

        $this->RunController($fn);

    }


}