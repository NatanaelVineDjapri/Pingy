 

<?php $__env->startSection('head'); ?>
    <title>Profile | Pingy</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleProfileShowEdit.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="flexcontainer">
    <div class="middlecontainer">
        <section class="headsec">
            <div class="header-title">
                <a href="<?php echo e(route('home', auth()->user()->id)); ?>" class="item-icon"><ion-icon name="arrow-back-outline"></ion-icon></a>
                <a href="<?php echo e(route('home', auth()->user()->id)); ?>" class="item-link"><?php echo e($user->name); ?></a>
            </div>
        </section>
        <section class="twitterprofile">
            <div class="headerprofileimage">
                <?php if($user->banner): ?>
                    <img src="<?php echo e(asset('storage/' . $user->banner)); ?>" alt="header" id="headerimage" class = "header-a">
                <?php else: ?>
                    <img src="<?php echo e(asset('image/banner.jpg')); ?>" alt="header default" id="headerimage" class = "header-b">
                <?php endif; ?>
                <?php if($user->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="profile pic" id="profilepic">
                <?php else: ?>
                    <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" alt="profile pic" id="profilepic">
                <?php endif; ?>
                <div class="editprofile">
                    <?php if(Auth::id() == $user->id): ?>
                        <a href="<?php echo e(route('editprofile', $user->id)); ?>">Edit Profile</a>
                    <?php else: ?>
                         <form action="<?php echo e(route('follow',$user)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php if(auth()->user()->isFollowing($user)): ?>
                        <button type="submit" class="follow-btn">UnFollow</button>
                    <?php else: ?>
                        <button type="submit" class="follow-btn">Follow</button>
                    <?php endif; ?>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="bio">
                <div class="handle">
                    <h3><?php echo e($user->name); ?></h3>
                    <p><?php echo e('@' .$user->username); ?></p>
                </div>
                <p><?php echo e($user->description); ?></p>
                <span>
                    <i class="fa fa-calendar"></i> Joined <?php echo e($user->created_at->format('F Y')); ?>

                </span>
                <div class="nawa">
                    <div><a href="<?php echo e(route('showfollow', $user->id)); ?>"><?php echo e($user->following_count); ?><span> Following</span></a></div>
                    <div><a href="<?php echo e(route('showfollow', $user->id)); ?>"><?php echo e($user->followers_count); ?><span> Followers</span></a></div>
                </div>
            </div>
        </section>
        <section class="tweets">
            <div class="heading">
                <a href="<?php echo e(route('showprofile',$user->id)); ?>"><p>Tweets</p></a>
                <a href="<?php echo e(route('retweetprofile',$user->id)); ?>"><p>Tweets and Replies</p></a>
                <a href="<?php echo e(route('mediaprofile',$user->id)); ?>"><p>Media</p></a>
                <a href="<?php echo e(route('likeprofile',$user->id)); ?>" ><p>Likes</p></a>
            </div>
        </section>
        <section class="mytweets">
            <?php $__currentLoopData = $likeTweets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $like): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tweet">
                    <div>
                    <?php if($like->user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $like->user->avatar)); ?>" class="avi">
                    <?php else: ?>
                        <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avi">
                    <?php endif; ?>
                    </div>
                    <div class="tweetbody">
                        <div class="packs-name">
                            <p class="name"><?php echo e($like->user->name); ?></p> 
                            <p class ="username"><?php echo e('@'. $like->user->username); ?> - <?php echo e($like->created_at->format('M,d Y')); ?></p>
                        </div>
                        <div class="tweetcontent"><?php echo e($like->body); ?></div>
                        <?php if($like->tweetImage): ?>
                            <div class="tweet-image">
                                <img src="<?php echo e(asset('storage/' . $like->tweetImage)); ?>" alt="Tweet image" style="max-width: 80%; border-radius: 10px; margin-top: 10px;">
                            </div>
                        <?php endif; ?>
                        <ul class="retweeticons">
                        <li>
                            <a href="<?php echo e(route('showcomment', ['tweet' => $like->id])); ?>"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></a>
                            <span><?php echo e($like->comments_count); ?></span>
                        </li>
                        <li>
                            <?php
                                $retweet = auth()->user()->retweetTweets->contains($like->id);
                            ?>
                                <form action="<?php echo e(route('postretweet',$like->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php if($retweet): ?>
                                        <button type="submit" class="delete-btn"><ion-icon name="repeat-sharp" ></ion-icon></button>
                                    <?php else: ?>
                                        <button type="submit" class="delete-btn"><ion-icon name="repeat" ></ion-icon></button>
                                    <?php endif; ?>
                                </form>
                            <span><?php echo e($like->retweets_count); ?></span>
                        </li>
                        <li>
                            <?php
                                $liked = auth()->user()->likedTweets->contains($like->id);
                            ?>
                                <form action="<?php echo e(route('liketweet',$like->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php if($liked): ?>
                                    <button type="submit" class="delete-btn"><ion-icon name="heart"></ion-icon></button>
                                <?php else: ?>
                                    <button type="submit" class="delete-btn"><ion-icon name="heart-outline"></ion-icon></button>
                                <?php endif; ?>
                                </form>
                            <span><?php echo e($like->likes_count); ?></span>
                        </li>
                        <li>
                            <ion-icon name="bookmark-outline"></ion-icon>
                            <span><?php echo e($like->likes_count); ?></span>
                        </li>
                        <?php if($like->updated_at != $like->created_at): ?>
                            <small style="color:gray; font-style:italic;">(edited)</small>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/profiles/profile-like.blade.php ENDPATH**/ ?>