<?php

namespace App\Utils;

use App\Utils\Contracts\ResponseWrapperContract;

final class ResponseWrapper implements ResponseWrapperContract
{
    public static function wrapError(string $message): array
    {
        return [
            'status' => 'error',
            'message' => $message,
        ];
    }

    public static function wrapSuccess(string $message): array
    {
        return [
            'status' => 'ok',
            'message' => $message,
        ];
    }
}
