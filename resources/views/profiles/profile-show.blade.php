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
                    <a href="{{ url()->previous() }}" class="item-icon">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </a>
                    <a href="{{ url()->previous() }}" class="item-link">{{ $user->name }}</a>
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
                            <a href="{{ route('editprofile', $user->id) }}" class="follow-btn">
                                Edit Profile
                            </a>
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
                @foreach ($tweets as $tweet)
                    <div class="tweet">
                        <div>
                            @if ($tweet->user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="avi" />
                            @else
                                <img src="{{ asset('image/profilepicture.jpg') }}" class="avi" />
                            @endif
                        </div>
                        <div class="tweetbody">
                            <div class="packs-name">
                                <p class="name">{{ $tweet->user->name }}</p>
                                <p class="username">
                                    {{ '@' . $tweet->user->username }} -
                                    @if ($tweet->created_at->diffInHours() < 24)
                                        {{ $tweet->created_at->diffForHumans() }}
                                    @else
                                        {{ $tweet->created_at->format('M, d Y') }}
                                    @endif
                                </p>
                            </div>
                            <div class="tweetcontent">{{ $tweet->body }}</div>
                            @if ($tweet->tweetImage)
                                <div class="tweet-image">
                                    <img
                                        src="{{ asset('storage/' . $tweet->tweetImage) }}"
                                        alt="Tweet image"
                                        style="
                                            max-width: 80%;
                                            border-radius: 10px;
                                            margin-top: 10px;
                                        "
                                    />
                                </div>
                            @endif

                            <ul class="retweeticons">
                                <li>
                                    <a href="{{ route('showcomment', ['tweet' => $tweet->id]) }}">
                                        <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                                    </a>
                                    <span>{{ $tweet->comments_count }}</span>
                                </li>
                                <li>
                                    @php
                                        $retweet = auth()
                                            ->user()
                                            ->retweetTweets->contains($tweet->id);
                                    @endphp

                                    <form
                                        action="{{ route('postretweet', $tweet->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @if ($retweet)
                                            <button type="submit" class="delete-btn">
                                                <ion-icon name="repeat-sharp"></ion-icon>
                                            </button>
                                        @else
                                            <button type="submit" class="delete-btn">
                                                <ion-icon name="repeat"></ion-icon>
                                            </button>
                                        @endif
                                    </form>
                                    <span>{{ $tweet->retweets_count }}</span>
                                </li>
                                <li>
                                    @php
                                        $liked = auth()
                                            ->user()
                                            ->likedTweets->contains($tweet->id);
                                    @endphp

                                    <form
                                        action="{{ route('liketweet', $tweet->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @if ($liked)
                                            <button type="submit" class="delete-btn">
                                                <ion-icon name="heart"></ion-icon>
                                            </button>
                                        @else
                                            <button type="submit" class="delete-btn">
                                                <ion-icon name="heart-outline"></ion-icon>
                                            </button>
                                        @endif
                                    </form>

                                    <span>{{ $tweet->likes_count }}</span>
                                </li>

                                <li>
                                    @php
                                        $bookmarked = auth()
                                            ->user()
                                            ->bookmarkedTweets->contains($tweet->id);
                                    @endphp

                                    <form
                                        action="{{ route('postbookmarks', $tweet->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @if ($bookmarked)
                                            <button type="submit" class="delete-btn">
                                                <ion-icon name="bookmark"></ion-icon>
                                            </button>
                                        @else
                                            <button type="submit" class="delete-btn">
                                                <ion-icon name="bookmark-outline"></ion-icon>
                                            </button>
                                        @endif
                                    </form>
                                </li>
                                @if (auth()->id() === $tweet->user->id)
                                    <li>
                                        <form
                                            action="{{ route('deletetweet', $tweet->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure to delete this tweet?');"
                                            class="delete-form"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('edittweet', $tweet->id) }}"
                                            class="edit-btn"
                                        >
                                            <ion-icon name="create-outline"></ion-icon>
                                        </a>
                                    </li>
                                @endif

                                @if ($tweet->updated_at != $tweet->created_at)
                                    <small style="color: gray; font-style: italic">(edited)</small>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
@endsection
