<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_invites', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'sender_id')->constrained('users');
            $table->foreignIdFor(User::class, 'receiver_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_invites');
    }
};
