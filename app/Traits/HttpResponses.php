<?php

namespace App\Traits;

trait HttpResponses {
    protected function sucess($data, $message = null ,$code = 200)
    {
        return response()->json([
            'status' => 'Request was sucessful',
            'message' => $message,
            'data' => $data
        ], $code);
    } 

    protected function error($data, $message = null ,$code)
    {
        return response()->json([
            'status' => 'Error has ocurred',
            'message' => $message,
            'data' => $data
        ], $code);
    } 
}