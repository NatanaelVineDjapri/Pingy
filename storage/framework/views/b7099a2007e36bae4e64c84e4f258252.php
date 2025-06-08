 

<?php $__env->startSection('head'); ?>
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
                <a href=""><p>Tweets and Replies</p></a>
                <a href="<?php echo e(route('mediaprofile',$user->id)); ?>"><p>Media</p></a>
                <a href="<?php echo e(route('likeprofile',$user->id)); ?>"><p>Likes</p></a>
            </div>
        </section>
        <section class="mytweets">
            <div class="image-container">
            <?php $__currentLoopData = $tweetImage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tweet-image">
                        <a href="<?php echo e(asset('/storage/'.$image->tweetImage)); ?>" target="_blank"><img src="<?php echo e(asset('storage/' . $image->tweetImage)); ?>" alt="Tweet image" style="width: 200px; height:200px;border-radius: 10px; margin-top: 10px; object-fit:cover ; "></a>
                    </div>
                    <?php if(($index + 1) % 3 ===0): ?>
                         <hr style="border-bottom: 1px solid ; width: 94.5%;">
                    <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views\profiles\profile-media.blade.php ENDPATH**/ ?>