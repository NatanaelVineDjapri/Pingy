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
                <a href="{{ route('home', auth()->user()->id) }}" class="item-icon"><ion-icon name="arrow-back-outline"></ion-icon></a>
                <a href="{{ route('home', auth()->user()->id) }}" class="item-link">{{ $user->name }}</a>
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
                    <div><a href="{{ route('showfollow', $user->id) }}">{{ $user->following_count }}<span> Following</span></a></div>
                    <div><a href="{{ route('showfollow', $user->id) }}">{{ $user->followers_count }}<span> Followers</span></a></div>
                </div>
            </div>
        </section>
        <section class="tweets">
            <div class="heading">
                <a href="{{route('showprofile',$user->id)}}"><p>Tweets</p></a>
                <a href=""><p>Tweets and Replies</p></a>
                <a href="{{route('mediaprofile',$user->id)}}"><p>Media</p></a>
                <a href="{{route('likeprofile',$user->id)}}" ><p>Likes</p></a>
            </div>
        </section>
        <section class="mytweets">
            @foreach($likeTweets as $like)
                <div class="tweet">
                    <div>
                    @if($like->user->avatar)
                        <img src="{{ asset('storage/' . $like->user->avatar) }}" class="avi">
                    @else
                        <img src="{{ asset('image/profilepicture.jpg') }}" class="avi">
                    @endif
                    </div>
                    <div class="tweetbody">
                        <div class="packs-name">
                            <p class="name">{{ $like->user->name }}</p> 
                            <p class ="username">{{'@'. $like->user->username }} - {{ $like->created_at->format('M,d Y') }}</p>
                        </div>
                        <div class="tweetcontent">{{ $like->body }}</div>
                        @if($like->tweetImage)
                            <div class="tweet-image">
                                <img src="{{ asset('storage/' . $like->tweetImage) }}" alt="Tweet image" style="max-width: 80%; border-radius: 10px; margin-top: 10px;">
                            </div>
                        @endif
                        <ul class="retweeticons">
                        <li>
                            <a href="{{ route('showcomment', ['tweet' => $like->id]) }}"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></a>
                            <span>{{ $like->comments_count }}</span>
                        </li>
                        <li>
                            <ion-icon name="repeat-outline"></ion-icon>
                            <span>{{ $like->comments_count }}</span>
                        </li>
                        <li>
                            @php
                                $liked = auth()->user()->likedTweets->contains($like->id);
                            @endphp
                                <form action="{{route('liketweet',$like->id)}}" method="POST">
                                @csrf
                                @if($liked)
                                    <button type="submit" class="delete-btn"><ion-icon name="heart"></ion-icon></button>
                                @else
                                    <button type="submit" class="delete-btn"><ion-icon name="heart-outline"></ion-icon></button>
                                @endif
                                </form>
                            <span>{{ $like->likes_count }}</span>
                        </li>
                        <li>
                            <ion-icon name="bookmark-outline"></ion-icon>
                            <span>{{ $like->likes_count }}</span>
                        </li>
                        @if($like->updated_at != $like->created_at)
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
