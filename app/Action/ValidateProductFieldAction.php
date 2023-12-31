<?php

namespace App\Action;

use App\Models\CustomField;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ValidateProductFieldAction
{
    /**
     * @throws ValidationException
     */
    public static function execute(CustomField $productField, string $value): void
    {
        $validator = Validator::make(
            [
                $productField->name => $value,
            ],
            [
                $productField->name => $productField->validation,
            ],
        );

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }
    }
}
