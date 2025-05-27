@extends('layouts.app') 

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleComment.css') }}">
    @yield('head')

@endsection

@section('content')
<div class="tweet-container">
    <div class="tweet-list">
        {{-- Gak perlu foreach kalau cuma 1 tweet --}}
        <div class="tweet-item">
            <div class="tweet-header">
                <img src="{{ asset('storage/' . $tweet->user->avatar) }}" class="avatar" alt="User Avatar">
                <div class="packs-name">
                    <p class="name">{{ $tweet->user->name }}</p> 
                    <p class="username">{{ '@' . $tweet->user->username }} - {{ $tweet->created_at->format('M,d Y') }}</p>
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
                    <form action="{{ route('postcomment', $tweet->id) }}" method="POST" class="comment-form">
                        @csrf
                        <input type="text" name="comment" placeholder="Tulis komentar..." required>
                        <button type="submit">Kirim</button>
                    </form>
                    @if($tweet->comments->count())
                    <ul class="comment-list">
                       @foreach ($comments as $comment)
                        <div class="comment-item">
                            <img src="{{ asset('storage/' . ($comment->user->avatar ?? 'default-avatar.png')) }}" class="avatar2" alt="User Avatar">
                            <div class="packs-name">
                                <p class="name">{{ $comment->user->name }}</p> 
                                <p class="username">{{ '@' . $comment->user->username }} - {{ $comment->created_at->format('M,d Y') }}</p>
                            </div>
                            <p class="comment-body">{{ $comment->body }}</p>
                        </div>
                         @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

