<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Create default response success
     *
     * @param array|null $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function ok($data = null, $message = 'success', $code = 200)
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    /**
     * Create default response failed
     *
     * @param string|array $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function oops($message = '', $code = 400)
    {
        return response()->json([
            'code'    => $code,
            'message' => $message,
            'data'    => null
        ], $code);
    }

    /**
     * Create default response invalid input
     *
     * @param array $errors
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function invalid($errors = [], $code = 422)
    {
        return response()->json([
            'code'    => $code,
            'message' => 'Unprocessable Entities',
            'errors'  => $errors,
        ], $code);
    }
}
