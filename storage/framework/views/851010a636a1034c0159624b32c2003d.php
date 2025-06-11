<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pingy</title>
  <link rel="stylesheet" href="<?php echo e(asset('css/styleLayout.css')); ?>">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <?php echo $__env->yieldContent('head'); ?> 
</head>
<body>
<div class="layout">
  <nav class="sidebar">
    <ul class="navbar">
      <li class="navbar-brand">
        <a href="#" class ="brand-text">Pingys</a>
      </li>
      <?php if(request()->routeIs('home') ||request()->routeIs('homefollowing')): ?>
        <li class="nav-item">
          <a href="<?php echo e(route('home', auth()->user()->id)); ?>" class="item-icon"><ion-icon name="home"></ion-icon></a>
          <a href="<?php echo e(route('home', auth()->user()->id)); ?>" class="item-link">Home</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a href="<?php echo e(route('home', auth()->user()->id)); ?>" class="item-icon"><ion-icon name="home-outline"></ion-icon></a>
          <a href="<?php echo e(route('home', auth()->user()->id)); ?>" class="item-link">Home</a>
        </li>
       <?php endif; ?>
      <?php if(request()->routeIs('explore')): ?>
        <li class="nav-item">
          <a href="<?php echo e(route('explore')); ?>" class="item-icon"><ion-icon name="search"></ion-icon></a>
          <a href="<?php echo e(route('explore')); ?>" class="item-link">Explore</a>
        </li>
      <?php else: ?>
      <li class="nav-item">
          <a href="<?php echo e(route('explore')); ?>" class="item-icon"><ion-icon name="search-outline"></ion-icon></a>
          <a href="<?php echo e(route('explore')); ?>" class="item-link">Explore</a>
      </li>
      <?php endif; ?>
      <?php if(request()->routeIs('inboxmessage') || request()->routeIs('showmessage')): ?>
      <li class="nav-item">
        <a href="<?php echo e(route('inboxmessage')); ?>" class="item-icon"><ion-icon name="mail"></ion-icon></a>
        <a href="<?php echo e(route('inboxmessage')); ?>" class="item-link">Messages</a>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a href="<?php echo e(route('inboxmessage')); ?>" class="item-icon"><ion-icon name="mail-outline"></ion-icon></a>
        <a href="<?php echo e(route('inboxmessage')); ?>" class="item-link">Messages</a>
      </li>
      <?php endif; ?>
      <?php if(request()->routeIs('showbookmarks')): ?>
      <li class="nav-item">
        <a href="<?php echo e(route('showbookmarks', auth()->user()->id)); ?>" class="item-icon"><ion-icon name="bookmark"></ion-icon></a>
        <a href="<?php echo e(route('showbookmarks', auth()->user()->id)); ?>" class="item-link">Bookmarks</a>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a href="<?php echo e(route('showbookmarks', auth()->user()->id)); ?>" class="item-icon"><ion-icon name="bookmark-outline"></ion-icon></a>
        <a href="<?php echo e(route('showbookmarks', auth()->user()->id)); ?>" class="item-link">Bookmarks</a>
      </li>
      <?php endif; ?>
      <?php if(request()->routeIs('showprofile') || request()->routeIs('mediaprofile') || request()->routeIs('showprofile') || request()->routeIs('likeprofile') || request()->routeIs('updateprofile')): ?>
      <li class="nav-item">
        <a href="<?php echo e(route('showprofile', auth()->user()->id)); ?>" class="item-icon">
          <ion-icon name="person"></ion-icon>
        </a>
        <a href="<?php echo e(route('showprofile', auth()->user()->id)); ?>" class="item-link">Profile</a>
      </li>
      <?php else: ?>
      <li class="nav-item">
        <a href="<?php echo e(route('showprofile', auth()->user()->id)); ?>" class="item-icon">
          <ion-icon name="person-outline"></ion-icon>
        </a>
        <a href="<?php echo e(route('showprofile', auth()->user()->id)); ?>" class="item-link">Profile</a>
      </li>
      <?php endif; ?>

      <li class="nav-item">
        <form action="<?php echo e(route('logout')); ?>" method="POST" ">
        <?php echo csrf_field(); ?>
            <button type="submit" class="logout-btn" >
                <span class="item-icon"><ion-icon name="log-out-outline"></ion-icon></span>
                Logout
            </button>
        </form>
      </li>
      <li>
       <a href="<?php echo e(route('gettweet')); ?>" class="tweet-btn">POST</a>
      </li>
    </ul>
    <a href="#" class="profile-btn">
     <div class="profile-info">
      <?php if(Auth::user()->avatar): ?>
        <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" alt="Profile Image" class="profile-img" width="35" height="35">
      <?php else: ?>
        <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" alt="Default Profile" class="profile-img" width="35" height="35">
      <?php endif; ?>
    <div class="profile-name">
        <p class="names"><?php echo e(Auth::user()->name); ?></p>
        <p class="username"><?php echo e('@'.Auth::user()->username); ?></p> 
    </div>
  </div>
    </a>
  </nav>
   <main class="main-content">
      <?php echo $__env->yieldContent('content'); ?>
  </main>
<div class="sidebar-2">
    <div class="card">
        <h3>Who to Follow</h3>
          <?php $__currentLoopData = $suggestusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="suggestion-card">
                <div class="info">
                    <?php if($user->avatar): ?>
                      <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="Profile Image" class="profile-img" width="35" height="35">
                    <?php else: ?>
                      <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" alt="Default Profile" class="profile-img" width="35" height="35">
                    <?php endif; ?>
                    <div>
                        <a href="<?php echo e(route('showprofile', $user->id)); ?>"><strong><?php echo e($user->name); ?></strong><br>
                        <span style="color: gray;"><?php echo e('@'.$user->username); ?></span></a>
                    </div>
                </div>
                <form action="<?php echo e(route('follow',$user)); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <?php if(auth()->user()->isFollowing($user)): ?>
                    <button type="submit" class="btn-sm-primary">UnFollow</button>
                  <?php else: ?>
                      <button type="submit" class="btn-sm-primary">Follow</button>
                  <?php endif; ?>
                </form>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="card">
        <h3>What’s happening</h3>
        <?php $__currentLoopData = $tweetstrending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="trend">
            <div class="label">Trending in Indonesia</div>
            <div class="body-count">
              <a href="<?php echo e(route('showcomment', ['tweet' => $tweet->id])); ?>" style ="color:#716a6a"><span><?php echo e(Str::limit($tweet->body, 30)); ?></span></a>
              <small class ="count-trend"><?php echo e($tweet->likes_count + $tweet->comments_count); ?> Interactions</small>
            </div>  
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
</div>
</body>
</html>
<?php /**PATH C:\New folder\htdocs\UAS\Pingy\resources\views/layouts/app.blade.php ENDPATH**/ ?>