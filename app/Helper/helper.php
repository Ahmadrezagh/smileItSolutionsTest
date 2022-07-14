<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

if (!function_exists('responseMessage')) {
    function responseMessage(string $message, int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message
        ], $status);
    }
}

if (!function_exists('resourceJson')) {
    function resourceJson($resource): JsonResource
    {
        return new JsonResource($resource);
    }
}
