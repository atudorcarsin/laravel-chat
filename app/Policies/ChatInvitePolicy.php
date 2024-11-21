<?php

namespace App\Policies;

use App\Models\ChatInvite;
use App\Models\User;

class ChatInvitePolicy
{
    public function viewAny(User $user): bool
    {
        //
    }

    public function view(User $user, ChatInvite $ChatInvite): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, ChatInvite $ChatInvite): bool
    {
        //
    }

    public function delete(User $user, ChatInvite $ChatInvite): bool
    {
        return ($user->id === $ChatInvite->sender_id) || ($user->id === $ChatInvite->receiver_id);
    }

    public function restore(User $user, ChatInvite $ChatInvite): bool
    {
        //
    }

    public function forceDelete(User $user, ChatInvite $ChatInvite): bool
    {
        //
    }
}
