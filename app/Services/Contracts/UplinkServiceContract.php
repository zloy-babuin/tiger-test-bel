<?php

namespace App\Services\Contracts;

interface UplinkServiceContract
{
    public static function proxy(string $content): array;
}
