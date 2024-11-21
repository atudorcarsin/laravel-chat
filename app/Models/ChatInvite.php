<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatInvite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function scopeInitiated(Builder $query, User $one, User $two): Builder
    {
        return $query->where(fn ($invite) => $invite
            ->whereSenderId($one->id)
            ->whereReceiverId($two->id))
            ->orWhere(fn ($invite) => $invite
                ->whereSenderId($two->id)
                ->whereReceiverId($one->id));
    }
}
