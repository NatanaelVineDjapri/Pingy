@extends('layouts.app-4') 

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    @yield('head')

@endsection
@section('content')
<div class="content">
    <div class="container">
        <div class="feed-toggle">
            <a href="{{ route('home', auth()->user()->id) }}">For You</a>
            <a href="{{ route('homefollowing', auth()->user()->id) }}">Following</a>
        </div>
    </div>
    <div class="tweet-container">
        <div class="tweet-box">
            <form action="{{ route('posttweet') }}" method="POST" enctype="multipart/form-data" class="tweet-form">
                @csrf
                <div class="tweet-input-section">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="avatar">
                    @else
                        <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                    @endif
                    <textarea name="body" rows="3" placeholder="What's happening?" maxlength="255">{{ old('body') }}</textarea>
                </div>
                <div class="tweet-actions">
                    <label for="tweetImage" class="upload-label"><ion-icon name="camera-outline"></ion-icon></label>
                    <input type="file" name="tweetImage" accept="image/*" id="tweetImage" style="display:none;">
                    <button type="submit" class="tweet-submit-btn">Tweet</button>
                </div>
            </form>

            @if(session('previewPath'))
                <div class="image-preview">
                    <img src="{{ asset('storage/' . session('previewPath')) }}" alt="Preview" class="tweet-image"/>
                </div>
            @endif
        </div>
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
                                <button type="submit" class="like-btn" ><ion-icon name="bookmark-outline"></ion-icon></button>
                            @endif
                        </form>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div></div>
@endsection

