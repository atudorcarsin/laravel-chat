<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MessageController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        //
    }

    public function store(MessageRequest $request)
    {
        Message::create([
            'chat_id' => $request->chat_id,
            'user_id' => $request->user()->id,
            'text_content' => $request->text_content,
        ]);
    }

    public function show(Message $message)
    {
        //
    }

    public function update(MessageRequest $request, Message $message)
    {
        //
    }

    public function destroy(Message $message)
    {
        //
    }
}
