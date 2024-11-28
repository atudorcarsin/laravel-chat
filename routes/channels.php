<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

//Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});

Broadcast::channel('chats.{id}', function (User $user, int $id) {

    return Chat::whereId($id)->first()->user_one_id === $user->id
        || Chat::whereId($id)->first()->user_two_id === $user->id;
});
