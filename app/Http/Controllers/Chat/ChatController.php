<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreChatRequest;
use App\Models\Chat;
use App\Models\ChatInvite;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('Chats/Index', [
            'hasIncomingInvites' => (ChatInvite::whereReceiverId(request()->user()->id)->count() !== 0),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreChatRequest $request)
    {
        $request = $request->validated();

    }

    public function show(Chat $chat)
    {
        //
    }

    public function edit(Chat $chat)
    {
        //
    }

    public function update(Request $request, Chat $chat)
    {
        //
    }

    public function destroy(Chat $chat)
    {
        //
    }
}
