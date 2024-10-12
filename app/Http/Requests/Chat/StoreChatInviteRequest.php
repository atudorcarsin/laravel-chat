<?php

namespace App\Http\Requests\Chat;

use App\Models\Chat;
use App\Models\ChatInvite;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreChatInviteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:32', 'alpha_dash:ascii', 'exists:users,username'],
        ];
    }

    public function withValidator($validator): void
    {
        if ($validator->errors()->isEmpty()) {
            $validator->after(fn ($validator) => $this->doesntExist($validator));
        }
    }

    private function doesntExist($validator): void
    {
        $invitedUser = $this->invitedUser();

        $chat = Chat::initiated($this->user(), $invitedUser);

        $invite = ChatInvite::initiated($this->user(), $invitedUser);

        if ($chat->exists() || $invite->exists()) {
            $validator->errors()->add('username', 'Chat or invite already exists');
        }
    }

    public function invitedUser(): User
    {
        return User::whereUsername($this->get('username'))->first();
    }
}
