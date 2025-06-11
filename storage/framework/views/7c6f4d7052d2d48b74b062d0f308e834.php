<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleHome.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="comment-container">
        <div class="tweet-box">
            <form action="<?php echo e(route('explore')); ?>" method="GET" class="tweet-form" style="margin-left:auto;">
                <div class="tweet-input-section">
                    <?php if(Auth::user()->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" class="avatar">
                    <?php else: ?>
                        <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                    <?php endif; ?>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search users..." style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc;">
                </div>
                <div class="tweet-actions" style="justify-content: flex-end;">
                    <button type="submit" class="tweet-submit-btn">Search</button>
                </div>
            </form>
        </div>

        <div class="tweet-list">
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="tweet-item">
                    <div class="tweet-header">
                        <?php if($user->avatar): ?>
                            <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" class="avatar">
                        <?php else: ?>
                            <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                        <?php endif; ?>
                        <div class="packs-name">
                            <a href="<?php echo e(route('showprofile', $user->id)); ?>">
                                <p class="name"><?php echo e($user->name); ?></p>
                            </a>
                            <p class="username"><?php echo e('@'.$user->username); ?></p>
                        </div>
                        <form action="<?php echo e(route('follow',$user)); ?>" method="POST" style="margin-left:auto;">
                        <?php echo csrf_field(); ?>
                        <?php if(auth()->user()->id!==$user->id): ?>
                            <?php if(auth()->user()->isFollowing($user)): ?>
                                <button type="submit" class="btn-sm-primary">UnFollow</button>
                            <?php else: ?>
                                <button type="submit" class="btn-sm-primary">Follow</button>
                            <?php endif; ?>
                        <?php endif; ?>
                        </form>
                    </div>
                 </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php if(request('search')): ?>
                <div class="message-item">
                    <p class ="search-empty"style="padding: 20px; color: #fba7c9;">No users found for <strong>"<?php echo e(request('search')); ?>"</strong></p>
                </div>    
                <?php endif; ?>
            <?php endif; ?>
            <div class="card">
            <h3>What’s happening</h3>
            <?php $__currentLoopData = $tweetstrending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="trend">
                <div class="label">Trending in Indonesia</div>
                <div class="body-count">
                <a href="<?php echo e(route('showcomment', ['tweet' => $tweet->id])); ?>">
                    <?php if(!empty($tweet->body)): ?>
                        <span><?php echo e(Str::limit($tweet->body, 30)); ?></span>
                    <?php else: ?>
                        <span style ="color:#e74c3c; font-style:italic;">No caption provided</span>
                    <?php endif; ?>
                </a>
                <small class ="count-trend"><?php echo e($tweet->likes_count + $tweet->comments_count); ?> Interactions</small>
                </div>  
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS GIT\New\Pingy\resources\views/explore.blade.php ENDPATH**/ ?>