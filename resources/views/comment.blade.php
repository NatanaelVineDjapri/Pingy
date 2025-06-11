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
                    <a href="{{route('showprofile', $tweet->user->id)}}"><p class="name">{{ $tweet->user->name }}</p></a> 
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
                    <a href="{{ route('showcomment', ['tweet' => $tweet->id]) }}"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></a>
                    <span>{{ $tweet->comments_count }}</span>

                     @php
                        $retweet = auth()->user()->retweetTweets->contains($tweet->id);
                     @endphp
                    <form action="{{route('postretweet',$tweet->id)}}" method="POST">
                        @csrf
                        @if($retweet)
                            <button type="submit" class="like-btn"><ion-icon name="repeat-sharp" ></ion-icon></button>
                        @else
                            <button type="submit" class="like-btn"><ion-icon name="repeat" ></ion-icon></button>
                        @endif
                    </form>
                    <span>{{ $tweet->retweets_count }}</span>
                            
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
                            <div class="user-info">
                                @if($comment->user->avatar)
                                    <img src="{{ asset('storage/' . $comment->user->avatar) }}" class="avatar2">
                                @else
                                    <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar2">
                                @endif
                                <div class="packs-name">
                                    <a href="{{route('showprofile', $comment->user->id)}}""><p class="name">{{ $comment->user->name }}</p></a> 
                                    <p class="username">{{ '@' . $comment->user->username }} - {{ $comment->created_at->format('M,d Y') }}</p>
                                </div>
                            </div>
                            <p class="comment-body">{{
                            $comment->body }}</p>
                            @if (auth()->id() === $comment->user_id)
                                <form action="{{ route('deletecomment', [$comment->tweet, $comment]) }}" method="POST" onsubmit="return confirm('Are you sure to delete this comment?');" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"   class="delete-btn">Delete</button>
                                </form>
                            @endif
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

