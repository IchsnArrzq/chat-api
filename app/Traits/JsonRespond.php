<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait JsonRespond
{
    public function respond(array $data = [], int $status = Response::HTTP_OK, array $headers = [])
    {
        return response()->json($data, $status, $headers);
    }
}
