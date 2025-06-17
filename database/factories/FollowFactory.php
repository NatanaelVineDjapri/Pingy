<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FollowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $user = User::factory()->create();
        $following = User::factory()->create();
         
        while($user->id === $following->id) {
            $following = User::factory()->create();
        }
        return [
            'user_id' => $user->id,
            'following_user_id' =>$following->id,
        ];
    }
}
