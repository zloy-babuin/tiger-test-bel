<?php

namespace App\Utils;

use App\Utils\Contracts\ActionValidatorContract;
use App\Utils\Contracts\ResponseWrapperContract;
use Illuminate\Http\Request;

final class ActionValidator implements ActionValidatorContract
{
    private const ERROR_MESSAGE = 'Invalid action';
    private const ERROR_MESSAGE_MISMATCH = 'Invalid action configuration';

    private array $error = [];

    private ResponseWrapperContract $wrapperClass;

    public function __construct()
    {
        $this->wrapperClass = app(ResponseWrapperContract::class);
    }

    public function validateActionRequest(Request $request, string $requestedAction): bool
    {

        $jsonAction = $request->input('action');

        if ($requestedAction !== $jsonAction) {
            $this->error = $this->wrapperClass::wrapError(ActionValidator::ERROR_MESSAGE_MISMATCH);

            return false;
        }

        if (in_array($requestedAction, config('uplink.allowed_actions', []))) {
            return true;
        }

        $this->error = $this->wrapperClass::wrapError(ActionValidator::ERROR_MESSAGE);

        return false;
    }

    public function getErrorResponse(): array
    {
        return $this->error;
    }
}
