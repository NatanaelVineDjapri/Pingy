 

<?php $__env->startSection('head'); ?>
    <title>Followers - Following | Pingy</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleComment.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="tweet-container">
    <div class="tweet-list">
        <div class="tweet-item">
            <div class="tweet-header">
                <div class="packs-name">
                    <p class="name">Following</p>
                </div>
            </div>
            <div class="tweet-body">
                <?php $__empty_1 = true; $__currentLoopData = $user->following; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $followingUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="followers-header">
                        <?php if($followingUser->avatar): ?>
                            <img src="<?php echo e(asset('storage/' . $followingUser->avatar)); ?>" class="avatar">
                        <?php else: ?>
                            <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                        <?php endif; ?>
                        <div class="packs-name">
                            <a href="<?php echo e(route('showprofile', $followingUser->id)); ?>">
                                <p class="name"><?php echo e($followingUser->name); ?></p>
                            </a>
                            <p class="username"><?php echo e('@'.$followingUser->username); ?></p>
                        </div>
                        <form action="<?php echo e(route('follow',$followingUser)); ?>" method="POST" style="margin-left:auto;">
                            <?php echo csrf_field(); ?>
                            <?php if(auth()->user()->isFollowing($followingUser)): ?>
                                <button type="submit" class="btn-sm-primary">UnFollow</button>
                            <?php else: ?>
                                <button type="submit" class="btn-sm-primary">Follow</button>
                             <?php endif; ?>
                        </form>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php if(auth()->id() === $user->id): ?>
                            <p class="tweet-text">Start following people to discover amazing content!</p>
                        <?php else: ?>
                            <p class="tweet-text">This user hasn't followed anyone yet.</p>
                        <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="tweet-item">
            <div class="tweet-header">
                <div class="packs-name">
                    <p class="name">Followers</p>
                </div>
            </div>
            <div class="tweet-body">
                <?php $__empty_1 = true; $__currentLoopData = $user->followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="followers-header">
                        <?php if($follower->avatar): ?>
                            <img src="<?php echo e(asset('storage/' . $follower->avatar)); ?>" class="avatar">
                        <?php else: ?>
                            <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                        <?php endif; ?>
                        <div class="packs-name">
                            <a href="<?php echo e(route('showprofile', $follower->id)); ?>">
                                <p class="name"><?php echo e($follower->name); ?></p>
                            </a>
                            <p class="username"><?php echo e('@'. $follower->username); ?></p>
                        </div>
                        <form action="<?php echo e(route('follow',$follower)); ?>" method="POST" style="margin-left:auto;">
                            <?php echo csrf_field(); ?>
                            <?php if(auth()->user()->isFollowing($follower)): ?>
                                <button type="submit" class="btn-sm-primary">UnFollow</button>
                            <?php else: ?>
                                <button type="submit" class="btn-sm-primary">Follow</button>
                             <?php endif; ?>
                        </form>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php if(@auth()->id() === $user->id): ?>
                            <p class="tweet-text">Invite others to follow you and share your journey!</p>
                        <?php else: ?>
                            <p class="tweet-text">This user doesnt have any followers yet.Be their first follower!</p>
                        <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/follow-show.blade.php ENDPATH**/ ?>