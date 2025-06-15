<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pingy</title>
  <link rel="stylesheet" href="{{ asset('css/styleLayout-2.css') }}">
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
        <a href="#" class ="brand-text">Pingys</a>
      </li>
      @if (request()->routeIs('home') ||request()->routeIs('homefollowing'))
        <li class="nav-item">
          <a href="{{ route('home', auth()->user()->id) }}" class="item-icon"><ion-icon name="home"></ion-icon></a>
          <a href="{{ route('home', auth()->user()->id) }}" class="item-link">Home</a>
        </li>
      @else
        <li class="nav-item">
          <a href="{{ route('home', auth()->user()->id) }}" class="item-icon"><ion-icon name="home-outline"></ion-icon></a>
          <a href="{{ route('home', auth()->user()->id) }}" class="item-link">Home</a>
        </li>
       @endif
      @if (request()->routeIs('explore'))
        <li class="nav-item">
          <a href="{{ route('explore') }}" class="item-icon"><ion-icon name="search"></ion-icon></a>
          <a href="{{ route('explore') }}" class="item-link">Explore</a>
        </li>
      @else
      <li class="nav-item">
          <a href="{{ route('explore') }}" class="item-icon"><ion-icon name="search-outline"></ion-icon></a>
          <a href="{{ route('explore') }}" class="item-link">Explore</a>
      </li>
      @endif
      @if (request()->routeIs('inboxmessage') || request()->routeIs('showmessage'))
      <li class="nav-item">
        <a href="{{ route('inboxmessage') }}" class="item-icon"><ion-icon name="mail"></ion-icon></a>
        <a href="{{ route('inboxmessage') }}" class="item-link">Messages</a>
      </li>
      @else
      <li class="nav-item">
        <a href="{{ route('inboxmessage') }}" class="item-icon"><ion-icon name="mail-outline"></ion-icon></a>
        <a href="{{ route('inboxmessage') }}" class="item-link">Messages</a>
      </li>
      @endif
      @if (request()->routeIs('showbookmarks'))
      <li class="nav-item">
        <a href="{{ route('showbookmarks', auth()->user()->id) }}" class="item-icon"><ion-icon name="bookmark"></ion-icon></a>
        <a href="{{ route('showbookmarks', auth()->user()->id) }}" class="item-link">Bookmarks</a>
      </li>
      @else
      <li class="nav-item">
        <a href="{{ route('showbookmarks', auth()->user()->id) }}" class="item-icon"><ion-icon name="bookmark-outline"></ion-icon></a>
        <a href="{{ route('showbookmarks', auth()->user()->id) }}" class="item-link">Bookmarks</a>
      </li>
      @endif
      @if (request()->routeIs('shownotification'))
      <li class="nav-item">
        <a href="{{ route('shownotification', auth()->user()->id) }}" class="item-icon"><ion-icon name="notifications"></ion-icon></a>
        <a href="{{ route('shownotification', auth()->user()->id) }}" class="item-link">Notifications</a>
      </li>
      @else
      <li class="nav-item">
        <a href="{{ route('shownotification', auth()->user()->id) }}" class="item-icon"><ion-icon name="notifications-outline"></ion-icon></a>
        <a href="{{ route('shownotification', auth()->user()->id) }}" class="item-link">Notifications</a>
      </li>
      @endif
      @if (request()->routeIs('showprofile') || request()->routeIs('mediaprofile') || request()->routeIs('showprofile') || request()->routeIs('likeprofile') || request()->routeIs('updateprofile'))
      <li class="nav-item">
        <a href="{{ route('showprofile', auth()->user()->id) }}" class="item-icon">
          <ion-icon name="person"></ion-icon>
        </a>
        <a href="{{ route('showprofile', auth()->user()->id) }}" class="item-link">Profile</a>
      </li>
      @else
      <li class="nav-item">
        <a href="{{ route('showprofile', auth()->user()->id) }}" class="item-icon">
          <ion-icon name="person-outline"></ion-icon>
        </a>
        <a href="{{ route('showprofile', auth()->user()->id) }}" class="item-link">Profile</a>
      </li>
      @endif
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
        <img src="{{ asset('image/profilepicture.jpg') }}" alt="Default Profile" class="profile-img" width="35" height="35">
      @endif
    <div class="profile-name">
        <p class="names">{{ Auth::user()->name }}</p>
        <p class="username">{{ '@'.Auth::user()->username }}</p> 
    </div>
  </div>
    </a>
  </nav>
   <main class="main-content">
      @yield('content')
  </main>
<div class="sidebar-2">
    <div class="card">
        <h3>Who to Follow</h3>
          @foreach ($suggestusers as $user)
            <div class="suggestion-card">
                <div class="info">
                    @if($user->avatar)
                      <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Image" class="profile-img" width="35" height="35">
                    @else
                      <img src="{{ asset('image/profilepicture.jpg') }}" alt="Default Profile" class="profile-img" width="35" height="35">
                    @endif
                    <div>
                        <a href="{{route('showprofile', $user->id)}}"><strong>{{ $user->name }}</strong><br>
                        <span style="color: gray;">{{'@'.$user->username }}</span></a>
                    </div>
                </div>
                <form action="{{route('follow',$user)}}" method="POST">
                  @csrf
                  @if(auth()->user()->isFollowing($user))
                    <button type="submit" class="btn-sm-primary">UnFollow</button>
                  @else
                      <button type="submit" class="btn-sm-primary">Follow</button>
                  @endif
                </form>
            </div>
          @endforeach
          <a>Show More</a>
    </div>
</div>
</div>
</body>
</html>
