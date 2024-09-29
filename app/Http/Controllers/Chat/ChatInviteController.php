<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreChatInviteRequest;
use App\Models\Chat;
use App\Models\ChatInvite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatInviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('ChatInvites/Index', [
            'incomingInvites' => ChatInvite::with(['sender', 'receiver'])->whereReceiverId(request()->user()->id)->simplePaginate(8),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatInviteRequest $request)
    {
        $validated = $request->validated();

        $invitedUser = User::where('username', $validated['username'])->first();

        if (! $invitedUser) {
            return redirect(route('chats.index'));
        }

        $chat = Chat::initiated(request()->user(), $invitedUser);

        $invite = ChatInvite::initiated($request->user(), $invitedUser);

        if ($chat->doesntExist() && $invite->doesntExist()) {
            ChatInvite::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => $invitedUser->id,
            ]);
        }

        return redirect(route('chats.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ChatInvite $ChatInvite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChatInvite $ChatInvite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChatInvite $request, ChatInvite $ChatInvite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChatInvite $ChatInvite)
    {
        //
    }
}
