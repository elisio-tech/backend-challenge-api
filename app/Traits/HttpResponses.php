<?php

namespace App\Traits;

trait HttpResponses{
    
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Sucesso na requisicao',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($data, $message = null, $code = 400)
    {
        return response()->json([
            'status' => 'Ocorreu um erro',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}