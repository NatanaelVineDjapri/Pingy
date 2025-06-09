@extends('layouts.app-2')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    @yield('head')
@endsection

@section('content')
    <div class="comment-container">
        <div class="tweet-box">
            <form action="{{ route('explore') }}" method="GET" class="tweet-form" style="margin-left:auto;">
                <div class="tweet-input-section">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="avatar">
                    @else
                        <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc;">
                </div>
                <div class="tweet-actions" style="justify-content: flex-end;">
                    <button type="submit" class="tweet-submit-btn">Search</button>
                </div>
            </form>
        </div>

        <div class="tweet-list">
            @forelse ($users as $user)
                <div class="tweet-item">
                    <div class="tweet-header">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar">
                        @else
                            <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                        @endif
                        <div class="packs-name">
                            <a href="{{ route('showprofile', $user->id) }}">
                                <p class="name">{{ $user->name }}</p>
                            </a>
                            <p class="username">{{'@'.$user->username }}</p>
                        </div>
                        <form action="{{route('follow',$user)}}" method="POST" style="margin-left:auto;">
                        @csrf
                        @if(auth()->user()->id!==$user->id)
                            @if(auth()->user()->isFollowing($user))
                                <button type="submit" class="btn-sm-primary">UnFollow</button>
                            @else
                                <button type="submit" class="btn-sm-primary">Follow</button>
                            @endif
                        @endif
                        </form>
                    </div>
                 </div>
            @empty
                @if(request('search'))
                <div class="message-item">
                    <p class ="search-empty"style="padding: 20px; color: #fba7c9;">No users found for <strong>"{{ request('search') }}"</strong></p>
                </div>    
                @endif
            @endforelse
            <div class="card">
            <h3>What’s happening</h3>
            @foreach($tweetstrending as $tweet)
            <div class="trend">
                <div class="label">Trending in Indonesia</div>
                <div class="body-count">
                <a href="{{ route('showcomment', ['tweet' => $tweet->id]) }}">
                    @if(!empty($tweet->body))
                        <span>{{ Str::limit($tweet->body, 30) }}</span>
                    @else
                        <span style ="color:#e74c3c; font-style:italic;">No caption provided</span>
                    @endif
                </a>
                <small class ="count-trend">{{ $tweet->likes_count + $tweet->comments_count }} Interactions</small>
                </div>  
            </div>
            @endforeach
    </div>
        </div>
    </div>
@endsection
