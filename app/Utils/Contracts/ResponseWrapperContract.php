<?php

namespace App\Utils\Contracts;

interface ResponseWrapperContract
{
    public static function wrapError(string $message): array;

    public static function wrapSuccess(string $message): array;
}
