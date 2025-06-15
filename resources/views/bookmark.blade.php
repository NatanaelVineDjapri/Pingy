@extends('layouts.app') 

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    @yield('head')

@endsection
@section('content')
<div class="tweet-container">
    <div class="tweet-list">
        @forelse ($bookmarked as $tweet)
        <div class="tweet-item">
            <div class="tweet-header">
                 @if($tweet->user->avatar)
                    <img src="{{ asset('storage/' . $tweet->user->avatar) }}" class="avatar">
                @else
                    <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                @endif
                <div class="packs-name">
                    <a href="{{route('showprofile', $tweet->user->id)}}"><p class="name">{{ $tweet->user->name }}</p></a>
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
                <p>{{ $tweet->body }}</p>
                @if($tweet->tweetImage)
                <div class="tweet-image">
                    <img src="{{ asset('storage/' . $tweet->tweetImage) }}"  alt="Tweet image" style="width: 100%; max-width: 675px;max-height:900px;border-radius: 10px; margin-top: 10px;">
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
                            <button type="submit" class="like-btn"><ion-icon name="heart" ></ion-icon></button>
                        @else
                            <button type="submit" class="like-btn"><ion-icon name="heart-outline" ></ion-icon></button>
                        @endif
                    </form>
                    <span>{{ $tweet->likes_count }}</span>
                
                    @php
                         $bookmarked = auth()->user()->bookmarkedTweets->contains($tweet->id);
                    @endphp
                    <form action="{{ route('postbookmarks', $tweet->id) }}" method="POST">
                        @csrf
                        @if($bookmarked)
                            <button type="submit" class="like-btn"><ion-icon name="bookmark"></ion-icon></button>
                        @else
                            <button type="submit" class="like-btn"><ion-icon name="bookmark-outline"></ion-icon></button>
                        @endif
                    </form>
                </ul>
            </div>
        </div>
         @empty
            <div class="message-item">
                <p>No bookmarked tweets found. Bookmark tweets to easily find them again!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

