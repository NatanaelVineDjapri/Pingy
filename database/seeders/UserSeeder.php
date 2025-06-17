<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Retweet;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        User::factory()->count(500)->create()->each(function($user)
        {
            Tweet::factory(rand(5,20))->create(['user_id'=>$user->id]);

            $allTweets = Tweet::all();

            $likeCount = min(rand(15, 150), $allTweets->count());

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
            
            $retweetCount = min(rand(15, 150), $allTweets->count());

            $randomTweet = $allTweets->random($retweetCount)->pluck('id');

            foreach ($randomTweet as $tweetId) {
                Retweet::factory()->create([
                    'user_id' => $user->id,
                    'tweet_id' => $tweetId,
                ]);
            }
         });
    }
}
