<?php

namespace App\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static success(array $data): JsonResponse;
 * @method static error(string $message, array $data = [], int $code = \App\Services\ApiResponse::DEFAULT_ERROR): JsonResponse;
 */
class ApiResponse extends Facade
{

    public static function getFacadeAccessor(): string
    {
        return \App\Services\ApiResponse::class;
    }
}
