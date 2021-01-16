<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{


    public function handleResponse(string $message = '', $data = [], int $httpCode = 200){
        return response()->json([
            'message' => $message,
            'data' => $data ? $data : new \stdClass(),
        ], $httpCode);
    }
}
