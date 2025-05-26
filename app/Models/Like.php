<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\tweet;
class Like extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'tweet_id',
        'liked',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tweet(){
        return $this->belongsTo(Tweet::class);
    }
}
