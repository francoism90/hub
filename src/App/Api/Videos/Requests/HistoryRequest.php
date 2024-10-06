<?php

namespace App\Api\Videos\Request;

use Elegant\Sanitizer\Laravel\SanitizesInput;
use Illuminate\Foundation\Http\FormRequest;

class HistoryRequest extends FormRequest
{
    use SanitizesInput;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'time' => 'nullable|float',
        ];
    }

    public function filters(): array
    {
        return [
            'time' => 'empty_string_to_null|cast:float',
        ];
    }
}
