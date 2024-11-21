<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreChatRequest;
use App\Models\Chat;
use App\Models\ChatInvite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('Chats/Index', [
            'hasIncomingInvites' => (ChatInvite::whereReceiverId(request()->user()->id)->count() !== 0),
            'chats' => Chat::with('userOne', 'userTwo')
                ->where(['user_one_id' => request()->user()->id])->orWhere(['user_two_id' => request()->user()->id])
                ->simplePaginate(10),
            'currentUser' => request()->user(),
        ]);
    }

    public function store(StoreChatRequest $request)
    {
        Gate::authorize('create', [Chat::class, $request->receiverId]);
        Chat::create([
            'user_one_id' => $request->senderId,
            'user_two_id' => $request->receiverId,
        ]);
        ChatInvite::whereReceiverId($request->receiverId)->whereSenderId($request->senderId)->delete();

        return redirect(route('chats.index'));
    }

    public function create()
    {
        //
    }

    public function show(Chat $chat)
    {
        Gate::authorize('view', [Chat::class, $chat]);

        return $chat->load('messages', 'userOne', 'userTwo');

        //return redirect(route('chats.index'))->with('chat', $chat->load('messages', 'userOne', 'userTwo'));
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
