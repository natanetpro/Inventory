<?php

namespace App\Http\Controllers\Fomatter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'Success',
            'message' => null
        ],
        'data' => null
    ];

    public static function success($data, $message, $code = 200)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['status'] = 'Success';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    public static function error($message, $code = 400)
    {
        self::$response['meta']['code'] = $code;
        self::$response['meta']['status'] = 'Error';
        self::$response['meta']['message'] = $message;

        return response()->json(self::$response, $code);
    }
}
