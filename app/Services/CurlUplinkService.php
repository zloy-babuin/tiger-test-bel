<?php

namespace App\Services;

use App\Services\Contracts\UplinkServiceContract;
use App\Utils\Contracts\ResponseWrapperContract;
use App\Utils\ResponseWrapper;

final class CurlUplinkService implements UplinkServiceContract
{
    public static function proxy(string $content): array
    {
        $url = config('uplink.url');

        $wrapperClass = app(ResponseWrapperContract::class);

        if (empty($url)) {
            return $wrapperClass::wrapError('Uplink not configured');
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $content,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Content-Length: ' . strlen($content)
            ],
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_FAILONERROR => false,
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($error) {
            return $wrapperClass::wrapError('Uplink connection error');
        }

        if ($httpCode >= 400) {
            return $wrapperClass::wrapError('Invalid uplink request');
        }

        $decoded = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $wrapperClass::wrapError('Uplink data error');
        }

        return $decoded;
    }
}
