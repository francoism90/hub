<?php

declare(strict_types=1);

namespace App\Api\Activities\Requests;

use Domain\Activities\Enums\ActivityType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'model' => 'required|string|min:8|max:255',
            'type' => ['required', Rule::enum(ActivityType::class)],
            'force' => 'nullable|boolean',
        ];
    }
}
