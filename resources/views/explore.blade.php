@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}">
    @yield('head')
@endsection

@section('content')
    <div class="tweet-container">
        <div class="tweet-box">
            <form action="{{ route('explore') }}" method="GET" class="tweet-form">
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
                    </div>
                </div>
            @empty
                @if(request('search'))
                    <p class ="search-empty"style="padding: 20px; color:white;">No users found for <strong>"{{ request('search') }}"</strong></p>
                @endif
            @endforelse
        </div>
    </div>
@endsection
