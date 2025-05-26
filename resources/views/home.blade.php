@extends('layouts.app') 

@section('content')
<div class="tweet-container">
    <div class="tweet-list">
        @foreach ($tweets as $tweet)
        <div class="tweet-item">
            <div class="tweet-header">
                <img src="{{ asset('storage/' . $tweet->user->avatar) }}" class="avatar" alt="User Avatar">
                <div class="packs-name">
                    <p class="name">{{ $tweet->user->name }}</p> 
                    <p class="username">{{ '@' . $tweet->user->username }} - {{ $tweet->created_at->format('M,d Y') }}</p>
                </div>
            </div>
            <div class="tweet-body">
                <p>{{ $tweet->body }}</p>
                @if($tweet->tweetImage)
                <div class="tweet-image">
                    <img src="{{ asset('storage/' . $tweet->tweetImage) }}" class="tweet-img" alt="Tweet image">
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

<style>
    body {
    background-color: #f5f8fa;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

.tweet-container {
    padding: 20px;
    max-width: 600px;
    margin-left: 100px;
    padding-right: 50px;
    border-right: 2px solid white;
}

.tweet-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.tweet-item {
    background-color: #fff;
    border: 1px solid #e6ecf0;
    border-radius: 16px;
    padding: 15px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.tweet-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
}

.packs-name {
    display: flex;
    flex-direction: column;
}

.name {
    font-weight: bold;
    font-size: 1rem;
    margin: 0;
}

.username {
    color: #717171;
    font-size: 12px;
    margin-top: 2px;
}

.tweet-body {
    display: flex;
    flex-direction: column;
}

.tweet-body p {
    margin: 0 0 5px 0;
    white-space: pre-wrap;
    font-size: 1rem;
}

.tweet-image {
    display: block;
    margin-top: 10px;
}

.tweet-img {
    max-width: 80%;
    border-radius: 10px;
}

</style>