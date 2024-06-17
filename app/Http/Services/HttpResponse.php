<?php
namespace App\Http\Services;

class HttpResponse {

    /**
     * Send HttpResponse
     *
     * @param array $data
     * @param integer $code
     * @param array $headers
     * @return void
     */
    public static function send(
        $data = [],
        $code = 200,
        array $headers = [] )
    {
        return response()->json($data, $code, $headers);
    }

}
