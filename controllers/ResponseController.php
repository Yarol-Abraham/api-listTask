<?php

namespace Controllers;

class ResponseController {
    
    protected static function sendError($data)
    {
        header('Content-Type: application/json');
        http_response_code(404);
        $res = [
            "status" => false,
            "type" => "fail",
            "data" => $data
        ];
        echo json_encode($res);
    }

    protected static function sendSuccess($data)
    {
        header('Content-Type: application/json');
        http_response_code(200);
        $res = [
            "status" => true,
            "type" => "success",
            "data" => $data
        ];
        echo json_encode($res);
    }
}