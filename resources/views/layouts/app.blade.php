<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pingy</title>
  <link rel="stylesheet" href="{{ asset('css/styleLayout.css') }}">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  @yield('head') 
</head>
<body>
<div class="layout">
  <nav class="sidebar">
    <ul class="navbar">
      <li class="navbar-brand">
        <a href="#" class ="brand-text">Pinkys</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('home', auth()->user()->id) }}" class="item-icon"><ion-icon name="home-outline"></ion-icon></a>
        <a href="{{ route('home', auth()->user()->id) }}" class="item-link">Home</a>
      </li>
      <li class="nav-item">
        <a href="#" class="item-icon"><ion-icon name="search-outline"></ion-icon></a>
        <a href="#" class="item-link">Explore</a>
      </li>
      <li class="nav-item">
        <a href="#" class="item-icon"><ion-icon name="mail-outline"></ion-icon></a>
        <a href="#" class="item-link">Messages</a>
      </li>
      <li class="nav-item">
        <a href="#" class="item-icon"><ion-icon name="bookmark-outline"></ion-icon></a>
        <a href="#" class="item-link">Bookmarks</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('showprofile', auth()->user()->id) }}" class="item-icon">
          <ion-icon name="person-outline"></ion-icon>
        </a>
        <a href="{{ route('showprofile', auth()->user()->id) }}" class="item-link">Profile</a>
      </li>

      <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST" ">
        @csrf
            <button type="submit" class="logout-btn" >
                <span class="item-icon"><ion-icon name="log-out-outline"></ion-icon></span>
                Logout
            </button>
        </form>
      </li>
      <li>
       <a href="{{ route('gettweet') }}" class="tweet-btn">POST</a>
      </li>
    </ul>
    <a href="#" class="profile-btn">
     <div class="profile-info">
      @if(Auth::user()->avatar)
        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Image" class="profile-img" width="35" height="35">
      @else
        <img src="{{ asset('image/person1.jpg') }}" alt="Default Profile" class="profile-img" width="35" height="35">
      @endif
    <div>
        <p class="name">{{ Auth::user()->name }}</p>
        <p class="username">{{ Auth::user()->username }}</p> 
    </div>
</div>
    </a>
  </nav>
   <main class="main-content">
      @yield('content')
  </main>
<!-- ke3 -->
<div class="sidebar-2">
    {{-- Search Bar --}}

    {{-- You might like --}}
    <div class="card">
        <h3>You might like</h3>
        @foreach ($suggestusers as $user)
        <div class="suggestion-card" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
            <div class="info" style="display: flex; align-items: center;">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('default-avatar.png') }}"
                    alt="{{ $user->name }}'s profile picture"
                    style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;">

                <div>
                    <strong>{{ $user->name }}</strong><br>
                    <span style="color: gray;">{{'@'.$user->username }}</span>
                </div>
            </div>
        <form action="" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary">Follow</button>
        </form>
    </div>
@endforeach

        <!-- <a href="#">Show more</a> -->
    </div>

    {{-- What's happening --}}
    <div class="card">
        <h3>What’s happening</h3>
        <div class="trend">
            <div class="label">Going Public</div>
            <span>LIVE</span>
        </div>
        <div class="trend">
            <span>#SFxMuvmuv</span>
            <small>12.8K posts</small>
        </div>
        <div class="trend">
            <span>ML MM WITH SF</span>
            <small>13.9K posts</small>
        </div>
        <div class="trend">
            <span>#SFxMilkLove</span>
            <small>13.1K posts</small>
        </div>
        <div class="trend">
            <span>Ini X</span>
            <small>63K posts</small>
        </div>
        <a href="#">Show more</a>
    </div>
</div>
</div>
</body>
</html>
