<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Services\Contracts\UplinkServiceContract;
use App\Utils\Contracts\ActionValidatorContract;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function runAction(string $action, Request $request)
    {
        $validator = app(ActionValidatorContract::class);

        if ($validator->validateActionRequest($request, $action)) {

            $proxyService = app(UplinkServiceContract::class);

            return $proxyService::proxy($request->getContent());
        }

        return $validator->getErrorResponse();
    }
}
