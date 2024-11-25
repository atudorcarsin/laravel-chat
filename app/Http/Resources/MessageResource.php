<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'text_content' => $this->text_content,
            'created_at' => $this->created_at,
            'user_id' => $this->user_id,
        ];
    }
}
