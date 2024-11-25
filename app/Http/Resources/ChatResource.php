<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'user_one' => new UserResource($this->whenLoaded('userOne')),
            'user_two' => new UserResource($this->whenLoaded('userTwo')),
        ];
    }
}
