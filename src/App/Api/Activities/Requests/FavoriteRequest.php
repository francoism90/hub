<?php

declare(strict_types=1);

namespace App\Api\Activities\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'force' => 'nullable|boolean',
        ];
    }
}
