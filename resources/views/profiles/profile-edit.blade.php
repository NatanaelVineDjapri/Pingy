@extends('layouts.app') 

@section('head')
    <link rel="stylesheet" href="{{ asset('css/styleProfileEdit.css') }}">
    @yield('head')


@endsection
<!-- <link rel="stylesheet" href="{{ asset('css/styleProfileEdit.css') }}">
@yield('head') -->

@section('content')
<div class="container">
    <div class="edit-profile-wrapper">
        <div class="edit-profile-card">
            <div class="edit-profile-header">Edit Profile</div>
            <div class="edit-profile-body">
                <form method="POST" action="{{ route('updateprofile', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name" class="label">Name</label>
                        <input id="name" type="text" class="input" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="username" class="label">Username</label>
                        <input id="username" type="text" class="input" name="username" value="{{ old('username', $user->username) }}" required>
                        @error('username')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="label">Bio</label>
                        <textarea id="description" class="input" name="description" rows="3">{{ old('description', $user->description) }}</textarea>
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="label">Profile Image</label>
                        <input id="avatar" type="file" class="input" name="avatar">
                        @error('avatar')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="banner" class="label">Banner Image</label>
                        <input id="banner" type="file" class="input" name="banner">
                        @error('banner')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn">Update Profile</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

