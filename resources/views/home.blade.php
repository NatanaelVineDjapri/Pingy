@extends('layouts.app') 

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    @yield('head')

@endsection
@section('content')
<div class="tweet-container">
    <div class="tweet-list">
        @foreach ($tweets as $tweet)
        <div class="tweet-item">
            <div class="tweet-header">
                 @if($tweet->user->avatar)
                    <img src="{{ asset('storage/' . $tweet->user->avatar) }}" class="avatar">
                @else
                    <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                @endif
                <div class="packs-name">
                    <p class="name">{{ $tweet->user->name }}</p> 
                    <p class="username">{{ '@' . $tweet->user->username }} - {{ $tweet->created_at->format('M,d Y') }}</p>
                </div>
            </div>
            <div class="tweet-body">
                <p>{{ $tweet->body }}</p>
                @if($tweet->tweetImage)
                <div class="tweet-image">
                    <img src="{{ asset('storage/' . $tweet->tweetImage) }}"  alt="Tweet image" style="width: 100%; max-width: 675px;max-height:500px;border-radius: 10px; margin-top: 10px;">
                </div>
                @endif
                <ul class="retweeticons">
                    <a href="{{ route('showcomment', ['tweet' => $tweet->id]) }}"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></a>
                    <span>{{ $tweet->comments_count }}</span>

                    <ion-icon name="repeat-outline"></ion-icon>
                    <span>{{ $tweet->comments_count }}</span>
                            
                    @php
                        $liked = auth()->user()->likedTweets->contains($tweet->id);
                    @endphp
                    <form action="{{route('liketweet',$tweet->id)}}" method="POST">
                        @csrf
                        @if($liked)
                            <button type="submit" class="like-btn"><ion-icon name="heart-outline" ></ion-icon></button>
                        @else
                            <button type="submit" class="like-btn"><ion-icon name="heart-half-outline" ></ion-icon></button>
                        @endif
                    </form>
                    <span>{{ $tweet->likes_count }}</span>

                    <ion-icon name="bookmark-outline"></ion-icon>
                    <span>{{ $tweet->comments_count }}</span>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

