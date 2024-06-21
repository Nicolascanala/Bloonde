<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    /**
     * Función re-utilizable para success JSON Response
     *
     * @param string $status
     * @param string|null $message
     * @param mixed $data
     * @param integer $statusCode
     * @return JsonResponse
     */
    public static function success(string $status = 'success', string $message = null, mixed $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Función re-utilizable para error JSON Response
     *
     * @param string $status
     * @param string|null $message
     * @param integer $statusCode
     * @return JsonResponse
     */
    public static function error(string $status = 'error', string $message = null, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $statusCode);
    }
}
