<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'chat_id' => Chat::factory(),
            'text_content' => $this->faker->text(), //
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
