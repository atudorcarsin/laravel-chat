<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, Message $message): bool {}

    public function create(User $user): bool {}

    public function update(User $user, Message $message): bool {}

    public function delete(User $user, Message $message): bool {}

    public function restore(User $user, Message $message): bool {}

    public function forceDelete(User $user, Message $message): bool {}
}
