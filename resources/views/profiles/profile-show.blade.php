@extends('layouts.app') 

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleProfileShowEdit.css') }}">
    @yield('head')

@endsection

@section('content')
<div class="flexcontainer">
    <div class="middlecontainer">
        <section class="headsec">
            <div class="header-title">
                <a href="#" class="item-icon"><ion-icon name="arrow-back-outline"></ion-icon></a>
                <a href="#" class="item-link">{{ $user->name }}</a>
            </div>
        </section>
        <section class="twitterprofile">
            <div class="headerprofileimage">
                @if($user->banner)
                <img src="{{ asset('storage/' . $user->banner) }}" alt="header" id="headerimage">
                @else
                <img src="{{ asset('image/banner.jpg') }}" alt="header default" id="headerimage">
                @endif

                @if($user->avatar)
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="profile pic" id="profilepic">
                @else
                <img src="{{ asset('image/profilepicture.jpg') }}" alt="profile pic" id="profilepic">
                @endif
               
                <div class="editprofile">
                    @if(Auth::id() == $user->id)
                        <a href="{{ route('editprofile', $user->id) }}">Edit Profile</a>
                    @else
                         <form action="{{route('follow',$user)}}" method="POST">
                    @csrf
                    @if(auth()->user()->isFollowing($user))
                        <button type="submit" class="follow-btn">UnFollow</button>
                    @else
                        <button type="submit" class="follow-btn">Follow</button>
                    @endif
                    </form>
                    @endif
                </div>
            </div>
            <div class="bio">
                <div class="handle">
                    <h3>{{ $user->name }}</h3>
                    <p>{{ '@' .$user->username }}</p>
                </div>
                <p>{{ $user->description }}</p>
                <span>
                    <i class="fa fa-calendar"></i> Joined {{ $user->created_at->format('F Y') }}
                </span>
                <div class="nawa">
                    <div class="followers"> {{ $user->following_count }} <span>Following</span></div>
                    <div>{{ $user->followers_count }}<span> Followers</span></div>
                </div>
            </div>
        </section>
        <section class="tweets">
            <div class="heading">
                <a href=""><p>Tweets</p></a>
                <a href=""><p>Tweets and Replies</p></a>
                <a href=""><p>Media</p><a>
                <a><p>Likes</p><a>
            </div>
        </section>
        <section class="mytweets">
            @foreach($tweets as $tweet)
                <div class="tweet">
                    <div>
                    @if($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" class="avi">
                    @else
                        <img src="{{ asset('image/profilepicture.jpg') }}" class="avi">
                    @endif
                    </div>
                    <div class="tweetbody">
                        <div class="packs-name">
                            <p class="name">{{ $user->name }}</p> 
                            <p class ="username">{{'@'. $user->username }} - {{ $tweet->created_at->format('M,d Y') }}</p>
                        </div>
                        <div class="tweetcontent">{{ $tweet->body }}</div>
                        @if($tweet->tweetImage)
                            <div class="tweet-image">
                                <img src="{{ asset('storage/' . $tweet->tweetImage) }}" alt="Tweet image" style="max-width: 80%; border-radius: 10px; margin-top: 10px;">
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
                                        <button type="submit" class="delete-btn"><ion-icon name="heart-outline" style="color:white"></ion-icon></button>
                                    @else
                                        <button type="submit" class="delete-btn"><ion-icon name="heart-outline" style="color:pink"></ion-icon></button>
                                    @endif
                                    </form>
                                    <span>{{ $tweet->likes_count }}</span>
                            <ion-icon name="bookmark-outline"></ion-icon>
                             <span>{{ $tweet->likes_count }}</span>

                             <form action="{{ route('deletetweet', $tweet->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this tweet?');" class ="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                            <a href="{{ route('edittweet', $tweet->id) }}" class="edit-btn">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            @if($tweet->updated_at != $tweet->created_at)
                                <small style="color:gray; font-style:italic;">(edited)</small>
                            @endif
                        </ul>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
</div>
@endsection
