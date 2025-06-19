@extends('layouts.app')

@section('head')
    <title>Profile | Pingy</title>
    <link rel="stylesheet" href="{{ asset('css/styleProfileShowEdit.css') }}" />
    @yield('head')
@endsection

@section('content')
    <div class="flexcontainer">
        <div class="middlecontainer">
            <section class="headsec">
                <div class="header-title">
                    <a href="{{ route('home', auth()->user()->id) }}" class="item-icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </a>
                    <a href="{{ route('home', auth()->user()->id) }}" class="item-link">
                        {{ $user->name }}
                    </a>
                </div>
            </section>
            <section class="twitterprofile">
                <div class="headerprofileimage">
                    @if ($user->banner)
                        <img
                            src="{{ asset('storage/' . $user->banner) }}"
                            alt="header"
                            id="headerimage"
                            class="header-a"
                        />
                    @else
                        <img
                            src="{{ asset('image/banner.jpg') }}"
                            alt="header default"
                            id="headerimage"
                            class="header-b"
                        />
                    @endif

                    @if ($user->avatar)
                        <img
                            src="{{ asset('storage/' . $user->avatar) }}"
                            alt="profile pic"
                            id="profilepic"
                        />
                    @else
                        <img
                            src="{{ asset('image/profilepicture.jpg') }}"
                            alt="profile pic"
                            id="profilepic"
                        />
                    @endif
                    <div class="editprofile">
                        @if (Auth::id() == $user->id)
                            <a href="{{ route('editprofile', $user->id) }}">Edit Profile</a>
                        @else
                            <form action="{{ route('follow', $user) }}" method="POST">
                                @csrf
                                @if (auth()->user()->isFollowing($user))
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
                        <p>{{ '@' . $user->username }}</p>
                    </div>
                    <p>{{ $user->description }}</p>
                    <span>
                        <i class="fa fa-calendar"></i>
                        Joined {{ $user->created_at->format('F Y') }}
                    </span>
                    <div class="nawa">
                        <div>
                            <a href="{{ route('showfollow', $user->id) }}">
                                {{ $user->following_count }}
                                <span>Following</span>
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('showfollow', $user->id) }}">
                                {{ $user->followers_count }}
                                <span>Followers</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="tweets">
                <div class="heading">
                    <a href="{{ route('showprofile', $user->id) }}"><p>Tweets</p></a>
                    <a href="{{ route('retweetprofile', $user->id) }}"><p>Tweets and Replies</p></a>
                    <a href="{{ route('mediaprofile', $user->id) }}"><p>Media</p></a>
                    <a href="{{ route('likeprofile', $user->id) }}"><p>Likes</p></a>
                </div>
            </section>
            <section class="mytweets">
                <div class="image-container">
                    @foreach ($tweetImage as $index => $image)
                        <div class="tweet-image">
                            <a href="{{ asset('/storage/' . $image->tweetImage) }}" target="_blank">
                                <img
                                    src="{{ asset('storage/' . $image->tweetImage) }}"
                                    alt="Tweet image"
                                    style="
                                        width: 200px;
                                        height: 200px;
                                        border-radius: 10px;
                                        margin-top: 10px;
                                        object-fit: cover;
                                    "
                                />
                            </a>
                        </div>
                        @if (($index + 1) % 3 === 0)
                            <hr style="border-bottom: 1px solid; width: 94.5%" />
                        @endif
                    @endforeach
                </div>
            </section>
        </div>
    </div>
@endsection
