<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreChatRequest;
use App\Http\Resources\ChatResource;
use App\Http\Resources\UserResource;
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
            'chats' => ChatResource::collection(Chat::with('userOne', 'userTwo')
                ->where(['user_one_id' => request()->user()->id])->orWhere(['user_two_id' => request()->user()->id])
                ->simplePaginate(10)),
            'currentUser' => new UserResource(request()->user()),
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

    public function show(Chat $chat, int $start, int $length)
    {
        Gate::authorize('view', [Chat::class, $chat]);

        return new ChatResource($chat->load([
            'messages' => fn ($query) => $query->orderBy('id', 'desc')->offset($start)->limit($length),
            'userOne',
            'userTwo',
        ]));
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
