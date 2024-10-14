<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text_content' => ['required'], //
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
