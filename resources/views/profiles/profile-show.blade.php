@extends('layouts.app') 

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleProfileShowEdit_v2.css') }}">
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
                <img src="{{ asset('storage/' . $user->banner) }}" alt="header" id="headerimage">
                <img src="{{ asset('storage/' . $user->avatar) }}" alt="profile pic" id="profilepic">
                <div class="editprofile">
                    @if(Auth::id() == $user->id)
                        <a href="{{ route('editprofile', $user->id) }}">Edit Profile</a>
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
                <p>Tweets</p>
                <p>Tweets and Replies</p>
                <p>Media</p>
                <p>Likes</p>
            </div>
        </section>

        <section class="mytweets">
            @foreach($tweets as $tweet)
                <div class="tweet">
                    <div><img src="{{ asset('storage/' . $user->avatar) }}" class="avi"></div>
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
                            <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                            <span>{{ $tweet->comments_count }}</span>


                            <ion-icon name="repeat-outline"></ion-icon>
                            <span>{{ $tweet->comments_count }}</span>
                            
                            <ion-icon name="heart-outline"></ion-icon>
                             <span>{{ $tweet->likes_count }}</span>

                            <ion-icon name="bookmark-outline"></ion-icon>
                             <span>{{ $tweet->comments_count }}</span>

                             <form action="{{ route('deletetweet', $tweet->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this tweet?');" class ="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                            <form action="" method="POST"  class ="delete-form">
                                @csrf
                                @method('UPDATE')
                                <button type="submit" class="delete-btn"><ion-icon name="create-outline"></ion-icon></ion-icon></button>
                            </form>
                            
                        </ul>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
</div>
@endsection
