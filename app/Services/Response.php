<?php

namespace App\Services;

class Response 
{
    public static function success($data, $message)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
    }
    public static function error($message)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => []
        ]);
    }
}