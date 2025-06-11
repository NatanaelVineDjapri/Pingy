 

<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleHome.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="tweet-container">
    <div class="tweet-list">
        <?php $__empty_1 = true; $__currentLoopData = $bookmarked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="tweet-item">
            <div class="tweet-header">
                 <?php if($tweet->user->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . $tweet->user->avatar)); ?>" class="avatar">
                <?php else: ?>
                    <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                <?php endif; ?>
                <div class="packs-name">
                    <a href="<?php echo e(route('showprofile', $tweet->user->id)); ?>"><p class="name"><?php echo e($tweet->user->name); ?></p></a>
                    <p class="username"><?php echo e('@' . $tweet->user->username); ?> - 
                    <?php if($tweet->created_at->diffInHours() < 24): ?>
                        <?php echo e($tweet->created_at->diffForHumans()); ?>

                    <?php else: ?>
                        <?php echo e($tweet->created_at->format('M, d Y')); ?>

                    <?php endif; ?> 
                    </p>
                </div>
            </div>
            <div class="tweet-body">
                <p><?php echo e($tweet->body); ?></p>
                <?php if($tweet->tweetImage): ?>
                <div class="tweet-image">
                    <img src="<?php echo e(asset('storage/' . $tweet->tweetImage)); ?>"  alt="Tweet image" style="width: 100%; max-width: 675px;max-height:900px;border-radius: 10px; margin-top: 10px;">
                </div>
                <?php endif; ?>
                <ul class="retweeticons">
                    <a href="<?php echo e(route('showcomment', ['tweet' => $tweet->id])); ?>"><ion-icon name="chatbubble-ellipses-outline"></ion-icon></a>
                    <span><?php echo e($tweet->comments_count); ?></span>
        
                    <ion-icon name="repeat-outline"></ion-icon>
                    <span><?php echo e($tweet->comments_count); ?></span>
                            
                    <?php
                        $liked = auth()->user()->likedTweets->contains($tweet->id);
                    ?>
                    <form action="<?php echo e(route('liketweet',$tweet->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if($liked): ?>
                            <button type="submit" class="like-btn"><ion-icon name="heart" ></ion-icon></button>
                        <?php else: ?>
                            <button type="submit" class="like-btn"><ion-icon name="heart-outline" ></ion-icon></button>
                        <?php endif; ?>
                    </form>
                    <span><?php echo e($tweet->likes_count); ?></span>
                
                    <?php
                         $bookmarked = auth()->user()->bookmarkedTweets->contains($tweet->id);
                    ?>
                    <form action="<?php echo e(route('postbookmarks', $tweet->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php if($bookmarked): ?>
                            <button type="submit" ><ion-icon name="bookmark"></ion-icon></button>
                        <?php else: ?>
                            <button type="submit"><ion-icon name="bookmark-outline"></ion-icon></button>
                        <?php endif; ?>
                    </form>
                </ul>
            </div>
        </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="message-item">
                <p>No bookmarked tweets found. Bookmark tweets to easily find them again!</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\New folder\htdocs\UAS\Pingy\resources\views/bookmark.blade.php ENDPATH**/ ?>