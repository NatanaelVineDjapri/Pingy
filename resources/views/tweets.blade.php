@extends('layouts.app') 

@section('content')
<div class="tweet-container">
    <h2>Home</h2>

    {{-- Form buat tweet baru --}}
    <form action="{{ route('posttweet') }}" method="POST" enctype="multipart/form-data" class="tweet-form">
        @csrf

        <textarea name="body" rows="3" placeholder="What's happening?" maxlength="255">{{ old('body') }}</textarea>
        @error('body')
            <div class="error">{{ $message }}</div>
        @enderror

        <input type="file" name="tweetImage" accept="image/*" id="tweetImage" style="display:none;">
        <label for="tweetImage" class="upload-label">📷 Add Image</label>
        @error('tweetImage')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="tweet-submit-btn">Tweet</button>
    </form>

    {{-- Jika ada preview image dari session --}}
    @if(session('previewPath'))
        <div class="image-preview">
            <p>Image preview:</p>
            <img src="{{ asset('storage/' . session('previewPath')) }}" alt="Preview" style="max-width:200px;"/>
        </div>
    @endif

    {{-- Daftar tweet user --}}
    <div class="tweet-list">
        @forelse ($tweets as $tweet)
        <div class="tweet-item">
            <div class="tweet-body">
                <p>{{ $tweet->body }}</p>
                @if($tweet->tweetImage)
                    <img src="{{ asset('storage/' . $tweet->tweetImage) }}" alt="Tweet Image" class="tweet-image"/>
                @endif
            </div>
            <form action="{{ route('deletetweet', $tweet->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this tweet?');" class ="delete-form">                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Delete</button>
            </form>
        </div>
        @empty
        <p>No tweets yet. Start tweeting!</p>
        @endforelse
    </div>
</div>
@endsection

{{-- Styling dasar supaya rapi --}}
<style>
    .tweet-container {
        padding: 20px;
        max-width: 600px;
        margin-left: 280px; /* kasih space buat sidebar */
    }
    .tweet-form textarea {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        resize: none;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 5px;
    }
    .upload-label {
        cursor: pointer;
        display: inline-block;
        margin-bottom: 10px;
        color: #1da1f2;
    }
    .tweet-submit-btn {
        background-color: #1da1f2;
        border: none;
        padding: 8px 15px;
        color: white;
        border-radius: 20px;
        font-weight: 700;
        cursor: pointer;
        float: right;
    }
    .tweet-list {
        margin-top: 30px;
    }
    .tweet-item {
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .tweet-body p {
        margin: 0 0 5px 0;
        white-space: pre-wrap;
    }
    .tweet-image {
        max-width: 100%;
        border-radius: 10px;
        margin-top: 5px;
    }
    .delete-btn {
        background: transparent;
        border: none;
        color: red;
        cursor: pointer;
        font-size: 0.9rem;
    }
    .error {
        color: red;
        font-size: 0.8rem;
        margin-bottom: 5px;
    }
</style>
