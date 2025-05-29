@extends('layouts.app') 


@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleTweets.css') }}">
    @yield('head')
@endsection

@section('content')
<div class="tweet-container">
    <div class="tweet-box">
        <form action="{{ route('posttweet') }}" method="POST" enctype="multipart/form-data" class="tweet-form">
            @csrf
            <div class="tweet-input-section">
                 @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="avatar">
                @else
                    <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                @endif
                <textarea name="body" rows="3" placeholder="What's happening?" maxlength="255">{{ old('body') }}</textarea>
            </div>
            <div class="tweet-actions">
                <label for="tweetImage" class="upload-label"><ion-icon name="camera-outline"></ion-icon></label>
                <input type="file" name="tweetImage" accept="image/*" id="tweetImage" style="display:none;">
                <button type="submit" class="tweet-submit-btn">Tweet</button>
            </div>
        </form>

        @if(session('previewPath'))
            <div class="image-preview">
                <img src="{{ asset('storage/' . session('previewPath')) }}" alt="Preview" class="tweet-image"/>
            </div>
        @endif
    </div>
    <div class="tweet-list">
         @foreach ($tweets as $tweet)
        <div class="tweet-item">
            <div class="tweet-header">
                 @if($tweet->user->avatar)
                        <img src="{{ asset('storage/' . $tweet->user->avatar) }}" class="avatar">
                    @else
                        <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar">
                    @endif
                <div class="packs-name">
                    <p class="name">{{ $tweet->user->name }}</p> 
                    <p class="username">{{'@'. $tweet->user->username }} - {{ $tweet->created_at->format('M,d Y') }}</p>
                </div>
            </div>
            <div class="tweet-body">
                <p>{{ $tweet->body }}</p>
                @if($tweet->tweetImage)
                    <div class="tweet-image">
                        <img src="{{ asset('storage/' . $tweet->tweetImage) }}" alt="Tweet image" style="width: 100%; max-width: 675px;max-height:500px;border-radius: 10px; margin-top: 10px;">
                    </div>
                @endif
                <form action="{{ route('deletetweet', $tweet->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this tweet?');" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
