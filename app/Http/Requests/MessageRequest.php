<?php

namespace App\Http\Requests;

use App\Models\Chat;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'chat_id' => 'required|integer|exists:chats,id',
            'text_content' => 'required|string|max:256',
        ];
    }

    public function authorize(): bool
    {
        if (! Chat::find($this->chat_id)) {
            return false;
        }
        if ($this->user()->id != Chat::find($this->chat_id)->first()->userOne->id
            && $this->user()->id != Chat::find($this->chat_id)->first()->userTwo->id) {
            return false;
        }

        return true;
    }
}
