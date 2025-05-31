<?php

namespace App\Utils\Contracts;

use Illuminate\Http\Request;

interface ActionValidatorContract
{
    public function validateActionRequest(Request $request, string $requestedAction): bool;

    public function getErrorResponse(): array;
}
