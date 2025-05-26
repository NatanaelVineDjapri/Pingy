@extends('layouts.app') 

@section('content')
<div class="tweet-container">
    <!-- <h2 class="home-title">Home</h2> -->

    {{-- Form buat tweet baru --}}
    <div class="tweet-box">
        <form action="{{ route('posttweet') }}" method="POST" enctype="multipart/form-data" class="tweet-form">
            @csrf
            <div class="tweet-input-section">
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="avatar" alt="User Avatar">
                <textarea name="body" rows="3" placeholder="What's happening?" maxlength="255">{{ old('body') }}</textarea>
            </div>
            <!-- @error('body')
                <div class="error">{{ $message }}</div>
            @enderror -->

            <div class="tweet-actions">
                <label for="tweetImage" class="upload-label"><ion-icon name="camera-outline"></ion-icon></label>
                <input type="file" name="tweetImage" accept="image/*" id="tweetImage" style="display:none;">
                <button type="submit" class="tweet-submit-btn">Tweet</button>
            </div>
            <!-- @error('tweetImage')
                <div class="error">{{ $message }}</div>
            @enderror -->
        </form>

        @if(session('previewPath'))
            <div class="image-preview">
                <img src="{{ asset('storage/' . session('previewPath')) }}" alt="Preview" class="tweet-image"/>
            </div>
        @endif
    </div>

    {{-- Daftar tweet user --}}
        <div class="tweet-list">
            @foreach ($tweets as $tweet)
            <div class="tweet-item">
                <div class="tweet-header">
                     <img src="{{ asset('storage/' . $tweet->user->avatar) }}" class="avatar" alt="User Avatar">
                    <div class="packs-name">
                        <p class="name">{{ $tweet->user->name }}</p> 
                        <p class="username">{{'@'. $tweet->user->username }} - {{ $tweet->created_at->format('M,d Y') }}</p>
                    </div>
                </div>

                <div class="tweet-body">
                    <p>{{ $tweet->body }}</p>
                    @if($tweet->tweetImage)
                        <div class="tweet-image">
                                    <img src="{{ asset('storage/' . $tweet->tweetImage) }}" alt="Tweet image" style="max-width: 80%; border-radius: 10px; margin-top: 10px;">
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

<style>
    body {
        background-color: #f5f8fa;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    .tweet-container {
        padding: 20px;
        /* margin-left: 200px; */
        padding-right: 50px;
        max-width: 600px;
        margin-left: 100px;
        border-right:2px solid white;
        
        
    }
    .home-title {
        font-size: 1.5rem;
        font-weight: 700;
        border-bottom: 1px solid #e6ecf0;
        padding-bottom: 10px;
    }
    .tweet-box {
        background-color: #fff;
        border: 1px solid #e6ecf0;
        border-radius: 16px;
        padding: 15px;
        margin-bottom: 20px;
    }
    .tweet-input-section {
        display: flex;
        gap: 10px;
    }
    .tweet-input-section textarea {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        resize: none;
        border: none;
        border-radius: 12px;
        background-color: #f5f8fa;
        outline: none;
    }
    .avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        object-fit: cover;
    }
    .upload-label {
        cursor: pointer;
        font-size: 1.2rem;
        color: #1da1f2;
        margin-right: auto;
    }
    .tweet-submit-btn {
        background-color: #1da1f2;
        border: none;
        padding: 8px 16px;
        color: white;
        border-radius: 9999px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .tweet-submit-btn:hover {
        background-color: #0d8ddc;
    }
    .tweet-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }
    .image-preview {
        margin-top: 10px;
    }
    .tweet-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .tweet-item {
        background-color: #fff;
        border: 1px solid #e6ecf0;
        border-radius: 16px;
        padding: 15px;
        /* display: flex; */
        gap: 10px;
        align-items:flex-start;
    }
    .tweet-body {
        flex-grow: 1;
        display: flex;
    flex-direction: column;
    }
    .tweet-body p {
        margin: 0 0 5px 0;
        white-space: pre-wrap;
        font-size: 1rem;
    }
    .tweet-image {
        max-width: 100%;
        border-radius: 12px;
        margin-top: 10px;
        display:block;
    }
    .delete-form {
        margin-top: 5px;
    }
    .delete-btn {
        background: none;
        border: none;
        color: #e0245e;
        font-size: 0.9rem;
        cursor: pointer;
        padding: 0;
    }
    .delete-btn:hover {
        text-decoration: underline;
    }
    .error {
        color: red;
        font-size: 0.85rem;
        margin-top: 4px;
    }
    .no-tweet {
        text-align: center;
        color: #657786;
    }
    .tweet-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.packs-name {
    display: inline-flex;
    /* align-items:center */
    /* flex-direction: column; */
    padding-top: 0; /* jangan kasih padding-top biar sejajar vertikal */
    /* gap:2px; */

}
.username{
    color: rgb(113, 106, 106);
    margin-left: 10px;
    font-weight: 300px;
    font-size: 12px;
    margin-top:2.5px;
}

</style>
