<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userOne(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    public function userTwo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    public function scopeInitiated(Builder $query, User $one, User $two): Builder
    {
        return $query->where(fn ($chat) => $chat
            ->whereUserOneId($one->id)
            ->whereUserTwoId($two->id))
            ->orWhere(fn ($chat) => $chat
                ->whereUserOneId($two->id)
                ->whereUserTwoId($one->id));
    }
}
