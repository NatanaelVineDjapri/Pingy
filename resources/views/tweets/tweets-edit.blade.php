@extends('layouts.app') 

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleComment.css') }}">
    @yield('head')

@endsection

@section('content')
<div class="tweet-container">
    <div class="tweet-list">
        <div class="tweet-item">
            <div class="tweet-header">
                @if($tweet->user->avatar)
                    <img src="{{ asset('storage/' . $tweet->user->avatar) }}" class="avatar">
                @else
                    <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                @endif
                <div class="packs-name">
                    <p class="name">{{ $tweet->user->name }}</p> 
                    <p class="username">{{ '@' . $tweet->user->username }} - 
                        @if ($tweet->created_at->diffInHours() < 24)
                            {{ $tweet->created_at->diffForHumans() }}
                        @else
                            {{ $tweet->created_at->format('M, d Y') }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="tweet-body">
                <p class="tweet-text">{{ $tweet->body }}</p>
                @if($tweet->tweetImage)
                <div class="tweet-image">
                    <img src="{{ asset('storage/' . $tweet->tweetImage) }}" class="tweet-img" alt="Tweet image">
                </div>
                @endif
                <ul class="retweeticons">
                    <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                    <span>{{ $tweet->comments_count }}</span>

                    <ion-icon name="repeat-outline"></ion-icon>
                    <span>{{ $tweet->comments_count }}</span>
                    
                    <ion-icon name="heart-outline"></ion-icon>
                    <span>{{ $tweet->likes_count }}</span>

                    <ion-icon name="bookmark-outline"></ion-icon>
                    <span>{{ $tweet->comments_count }}</span>
                </ul>
                <div class="comment-section">
                    <form action="{{ route('updatetweet', $tweet->id) }}" method="POST" class="comment-form">
                        @csrf
                        @method('PATCH')
                        <textarea name="body">{{ old('body', $tweet->body) }}</textarea>
                        <button type="submit">Update Tweet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


