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
                <div class="packs-name">
                    <p class="name">Following</p>
                </div>
            </div>
            <div class="tweet-body">
                @forelse ($user->following as $followingUser)
                    <div class="followers-header">
                        @if($followingUser->avatar)
                            <img src="{{ asset('storage/' . $followingUser->avatar) }}" class="avatar">
                        @else
                            <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                        @endif
                        <div class="packs-name">
                            <a href="{{ route('showprofile', $followingUser->id) }}">
                                <p class="name">{{ $followingUser->name }}</p>
                            </a>
                            <p class="username">{{'@'.$followingUser->username }}</p>
                        </div>
                        <form action="{{route('follow',$followingUser)}}" method="POST" style="margin-left:auto;">
                            @csrf
                            @if(auth()->user()->isFollowing($followingUser))
                                <button type="submit" class="btn-sm-primary">UnFollow</button>
                            @else
                                <button type="submit" class="btn-sm-primary">Follow</button>
                             @endif
                        </form>
                    </div>
                    @empty
                        @if(auth()->id() === $user->id)
                            <p class="tweet-text">Start following people to discover amazing content!</p>
                        @else
                            <p class="tweet-text">This user hasn't followed anyone yet.</p>
                        @endif
                @endforelse
            </div>
        </div>
        <div class="tweet-item">
            <div class="tweet-header">
                <div class="packs-name">
                    <p class="name">Followers</p>
                </div>
            </div>
            <div class="tweet-body">
                @forelse ($user->followers as $follower)
                    <div class="followers-header">
                        @if($follower->avatar)
                            <img src="{{ asset('storage/' . $follower->avatar) }}" class="avatar">
                        @else
                            <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                        @endif
                        <div class="packs-name">
                            <a href="{{ route('showprofile', $follower->id) }}">
                                <p class="name">{{ $follower->name }}</p>
                            </a>
                            <p class="username">{{'@'. $follower->username }}</p>
                        </div>
                        <form action="{{route('follow',$followingUser)}}" method="POST" style="margin-left:auto;">
                            @csrf
                            @if(auth()->user()->isFollowing($followingUser))
                                <button type="submit" class="btn-sm-primary">UnFollow</button>
                            @else
                                <button type="submit" class="btn-sm-primary">Follow</button>
                             @endif
                        </form>
                    </div>
                @empty
                    @if(@auth()->id() === $user->id)
                            <p class="tweet-text">Invite others to follow you and share your journey!</p>
                        @else
                            <p class="tweet-text">This user doesnt have any followers yet.Be their first follower!</p>
                        @endif
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
