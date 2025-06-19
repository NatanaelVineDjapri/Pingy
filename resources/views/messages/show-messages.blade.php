@extends('layouts.app-3')

@section('head')
    <title>Messages | Pingy</title>
    <link rel="stylesheet" href="{{ asset('css/styleHome.css') }}" />
@endsection

@section('content')
    <div class="message-container">
        <div class="message-box">
            <form
                action="{{ route('inboxmessage') }}"
                method="GET"
                class="tweet-form"
                style="margin-left: auto"
            >
                <div class="tweet-input-section">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search Direct Messages"
                        class="search-input"
                    />
                </div>
                <div class="message-actions" style="justify-content: flex-end">
                    <button type="submit" class="message-submit-btn">Search</button>
                </div>
            </form>
        </div>
        <div class="tweet-list">
            @forelse ($users as $user)
                <div class="tweet-item">
                    <div class="tweet-header">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar" />
                        @else
                            <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar" />
                        @endif
                        <div class="packs-name">
                            <a href="{{ route('showmessage', $user->id) }}">
                                <p class="name">{{ $user->name }}</p>
                            </a>
                            <p class="username">{{ '@' . $user->username }}</p>
                        </div>
                    </div>
                </div>
            @empty
                @if (request('search'))
                    <p class="search-empty" style="padding: 20px; color: white">
                        No users found for
                        <strong>"{{ request('search') }}"</strong>
                    </p>
                @endif
            @endforelse
            <div class="message">
                @forelse ($contacts as $contact)
                    <div class="message-item">
                        <div class="tweet-header">
                            @if ($contact->avatar)
                                <img
                                    src="{{ asset('storage/' . $contact->avatar) }}"
                                    class="avatar"
                                />
                            @else
                                <img
                                    src="{{ asset('image/profilepicture.jpg') }}"
                                    class="avatar"
                                />
                            @endif
                            <div class="packs-name">
                                <a href="{{ route('showmessage', $contact->id) }}">
                                    <p class="name">{{ $contact->name }}</p>
                                </a>
                                <p class="username">{{ '@' . $contact->username }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="message-item">
                        <p>No messages yet. Sorry!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="personal-container">
        <div class="profil-container">
            <div class="profil">
                @if ($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="avatar" />
                @else
                    <img src="{{ asset('image/profilepicture.jpg') }}" class="avatar" />
                @endif
                <div class="packs-name">
                    <a href="{{ route('showprofile', $user->id) }}">
                        <p class="name">{{ $user->name }}</p>
                    </a>
                    <p class="username">{{ '@' . $user->username }}</p>
                </div>
                <div class="icon">
                    <ion-icon name="sunny-outline"></ion-icon>
                </div>
            </div>
        </div>
        <div class="chat">
            @forelse ($messages as $message)
                @if ($message->sender_id == auth()->id())
                    <div class="message-item">
                        <div class="message-header-right">
                            <div class="header-profile">
                                <form
                                    action="{{ route('deletemessage', ['user' => auth()->user()->id, 'message' => $message->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure to delete this message?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="Submit" class="delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon>
                                    </button>
                                </form>
                                <div class="packs-name">
                                    <p class="name">{{ auth()->user()->name }}</p>
                                    <p class="username">{{ '@' . auth()->user()->username }}</p>
                                    <p class="username">
                                        {{ $message->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>

                                @if (auth()->user()->avatar)
                                    <img
                                        src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                        class="avatar"
                                    />
                                @else
                                    <img
                                        src="{{ asset('image/profilepicture.jpg') }}"
                                        class="avatar"
                                    />
                                @endif
                            </div>
                        </div>
                        <div class="message-body-right">
                            <p>{{ $message->message }}</p>
                        </div>
                    </div>
                @else
                    <div class="message-item">
                        <div class="message-header-left">
                            @if ($user->avatar)
                                <img
                                    src="{{ asset('storage/' . $user->avatar) }}"
                                    class="avatar"
                                />
                            @else
                                <img
                                    src="{{ asset('image/profilepicture.jpg') }}"
                                    class="avatar"
                                />
                            @endif
                            <div class="packs-name">
                                <p class="name">{{ $user->name }}</p>
                                <p class="username">{{ '@' . $user->username }}</p>
                                <p class="username">
                                    {{ $message->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="message-body-left">
                            <p>{{ $message->message }}</p>
                        </div>
                    </div>
                @endif
            @empty
                <div class="message-item">
                    <p>Oops! You don't have any messages yet.Start a conversation!</p>
                </div>
            @endforelse
        </div>
        <div class="pembatas">
            <p>===</p>
        </div>
        <div class="input">
            <form
                action="{{ route('postmessage', $user->id) }}"
                method="POST"
                class="message-form"
            >
                @csrf
                <div class="message-actions">
                    <textarea
                        type="text"
                        name="message"
                        placeholder="Tulis pesan..."
                        class="message-input"
                    ></textarea>
                    <button type="submit" class="submit-btn">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
