<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    const SUCCESS_CODE = 200;
    const DEFAULT_ERROR = 400;
    const SIGN_SECRET = 'Secret code for sign, that can be stored in env!';

    public function success(array $data = []): JsonResponse
    {
        $response = [
            'code' => self::SUCCESS_CODE,
            'data' => $data,
        ];

        return response()->json($this->signData($response));
    }

    public function error(string $message, array $data = [], int $code = self::DEFAULT_ERROR): JsonResponse
    {
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($this->signData($response));
    }

    private function signData(array $data): array
    {
        $sign = md5(json_encode($data) . self::SIGN_SECRET);
        $data['sign'] = $sign;
        return $data;
    }
}
