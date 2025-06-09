<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Like;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        fake()->unique(true);
            User::factory()->count(500)->create()->each(function($user){
            Tweet::factory(rand(5,20))->create(['user_id'=>$user->id]);

            $allTweets = Tweet::all();
            $likeCount = min(rand(5, 150), $allTweets->count());
            $randomTweet = $allTweets->random($likeCount)->pluck('id');
            foreach ($randomTweet as $tweetId) {
                Like::factory()->create([
                    'user_id' => $user->id,
                    'tweet_id' => $tweetId,
                ]);
            }
            $commentCount = min(rand(10, 200), $allTweets->count());
            $commentTweet = $allTweets->random($commentCount)->pluck('id');
            foreach($commentTweet as $tweetId){
                Comment::factory()->create([
                    'user_id'=>$user->id,
                    'tweet_id'=>$tweetId,
                ]);
            }
            $user->following()->attach(
                User::inRandomOrder()->where('id', '!=', $user->id)->take(rand(10, 100))->pluck('id')
            );
        //     $followUsers = User::where('id','!=',$user->id)->get();
        //     $followingCount = min(rand(10,100),$followUsers->count());

        //     $followTarget = $followUsers->random($followingCount)->pluck('id');

        //     foreach($followTarget as $target){
        //         Follow::factory()->create([
        //             'user_id'=>$user->id,
        //             'following_user_id' => $target,
        //         ]);
        //     }
         });
    }
}
