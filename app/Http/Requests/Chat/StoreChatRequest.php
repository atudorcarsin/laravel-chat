<?php

namespace App\Http\Requests\Chat;

use Illuminate\Foundation\Http\FormRequest;

class StoreChatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userOne' => ['required', 'exists:users,id', 'integer'],
            'userTwo' => ['required', 'exists:users,id', 'integer'],
        ];
    }
}
