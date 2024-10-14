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
        //
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
