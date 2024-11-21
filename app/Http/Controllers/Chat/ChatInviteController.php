<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreChatInviteRequest;
use App\Models\ChatInvite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class ChatInviteController extends Controller
{
    public function index()
    {
        return Inertia::render('ChatInvites/Index', [
            'incomingInvites' => ChatInvite::with(['sender', 'receiver'])->whereReceiverId(request()->user()->id)->simplePaginate(8),
        ]);
    }

    public function store(StoreChatInviteRequest $request)
    {
        ChatInvite::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->invitedUser()->id,
        ]);

        Session::flash('message', 'Invite successfully sent.');
    }

    public function create()
    {
        //
    }

    public function show(ChatInvite $ChatInvite)
    {
        //
    }

    public function edit(ChatInvite $ChatInvite)
    {
        //
    }

    public function update(ChatInvite $request, ChatInvite $ChatInvite)
    {
        //
    }

    public function destroy(ChatInvite $chatinvite): void
    {
        if (request()->user()->cannot('delete', $chatinvite)) {
            abort(403);
        }

        $chatinvite->delete();
    }
}
