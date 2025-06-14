<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleHome.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="tweet-container">
    <div class="tweet-list">
        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="tweet-item">
                <div class="tweet-header">
                    <?php if($notif->user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $notif->user->avatar)); ?>" class="avatar">
                    <?php else: ?>
                        <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                    <?php endif; ?>
                    <div class="packs-name">
                        <a href="<?php echo e(route('showprofile', $notif->user->id)); ?>">
                            <p class="name"><?php echo e($notif->user->name); ?></p>
                        </a>
                        <p class="username"><?php echo e('@' . $notif->user->username); ?> - <?php echo e($notif->created_at->diffForHumans()); ?></p>
                    </div>
                </div>
                <div class="tweet-body">
                    <?php if($notif->body): ?>
                        <p>Comment Your Tweet :"<?php echo e($notif->body); ?>"</p>
                        <form action="<?php echo e(route('deletenotifcomment', ['user' => auth()->id(), 'comment' => $notif->id])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button class="like-btn" style ="margin-left:500px"><ion-icon name="close-circle-outline"></ion-icon></button>
                        </form>
                    <?php else: ?>
                        <p>Liked Your tweet</p>
                        <form action="<?php echo e(route('deletenotiflike', ['user' => auth()->id(), 'like' => $notif->id])); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button class="like-btn" style="margin-left:500px"><ion-icon name="close-circle-outline"></ion-icon></button>
                        </form>
                    <?php endif; ?>
                    <?php if($notif->tweet->tweetImage): ?>
                        <div class="tweet-image">
                            <img src="<?php echo e(asset('storage/' . $notif->tweet->tweetImage)); ?>"alt="Tweet image" style="width: 100%; max-width: 675px; max-height:900px; border-radius: 10px; margin-top: 10px;">
                        </div>
                    <?php endif; ?>
                    <a href="<?php echo e(route('showcomment', $notif->tweet->id)); ?>">See Details Tweet</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="message-item">
                <p>No notifications to display at this time!</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/notification.blade.php ENDPATH**/ ?>