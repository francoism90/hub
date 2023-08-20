<?php

namespace App\Api\Http\Requests;

use Domain\Tags\Rules\TagExists;
use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'summary' => 'nullable|string|max:2048',
            'content' => 'nullable|string|max:4096',
            'season' => 'nullable|string|max:255',
            'episode' => 'nullable|string|max:255',
            'snapshot' => 'nullable|numeric|min:0|max:28800',
            'released_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*.id' => new TagExists(),
        ];
    }
}
