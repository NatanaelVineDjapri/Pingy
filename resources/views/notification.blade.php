@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    @yield('head')
@endsection

@section('content')
<div class="tweet-container">
    <div class="tweet-list">
        @forelse ($notifications as $notif)
            <div class="tweet-item">
                <div class="tweet-header">
                    @if($notif->user->avatar)
                        <img src="{{ asset('storage/' . $notif->user->avatar) }}" class="avatar">
                    @else
                        <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                    @endif
                    <div class="packs-name">
                        <a href="{{ route('showprofile', $notif->user->id) }}">
                            <p class="name">{{ $notif->user->name }}</p>
                        </a>
                        <p class="username">{{ '@' . $notif->user->username }} - {{ $notif->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="tweet-body">
                    @if ($notif->body)
                        <p>Comment Your Tweet :"{{ $notif->body }}"</p>
                    @else
                        <p>Liked Your tweet: {{ $notif->tweet->body }}</p>
                    @endif

                    @if($notif->tweet->tweetImage)
                        <div class="tweet-image">
                            <img src="{{ asset('storage/' . $notif->tweet->tweetImage) }}"alt="Tweet image" style="width: 100%; max-width: 675px; max-height:900px; border-radius: 10px; margin-top: 10px;">
                        </div>
                    @endif

                    <a href="{{ route('showcomment', $notif->tweet->id) }}">See Details Tweet</a>
                </div>
            </div>
        @empty
            <div class="message-item">
                <p>No notifications to display at this time!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
