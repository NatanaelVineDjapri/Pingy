 

<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleComment.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="tweet-container">
    <div class="tweet-list">
        <div class="tweet-item">
            <div class="tweet-header">
                <?php if($tweet->user->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . $tweet->user->avatar)); ?>" class="avatar">
                <?php else: ?>
                    <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                <?php endif; ?>
                <div class="packs-name">
                    <p class="name"><?php echo e($tweet->user->name); ?></p> 
                    <p class="username"><?php echo e('@' . $tweet->user->username); ?> - <?php echo e($tweet->created_at->format('M,d Y')); ?></p>
                </div>
            </div>
            <div class="tweet-body">
                <p class="tweet-text"><?php echo e($tweet->body); ?></p>
                <?php if($tweet->tweetImage): ?>
                <div class="tweet-image">
                    <img src="<?php echo e(asset('storage/' . $tweet->tweetImage)); ?>" class="tweet-img" alt="Tweet image">
                </div>
                <?php endif; ?>
                <ul class="retweeticons">
                    <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                    <span><?php echo e($tweet->comments_count); ?></span>

                    <ion-icon name="repeat-outline"></ion-icon>
                    <span><?php echo e($tweet->comments_count); ?></span>
                    
                    <ion-icon name="heart-outline"></ion-icon>
                    <span><?php echo e($tweet->likes_count); ?></span>

                    <ion-icon name="bookmark-outline"></ion-icon>
                    <span><?php echo e($tweet->comments_count); ?></span>
                </ul>
                <div class="comment-section">
                    <form action="<?php echo e(route('updatetweet', $tweet->id)); ?>" method="POST" class="comment-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <textarea name="body"><?php echo e(old('body', $tweet->body)); ?></textarea>
                        <button type="submit">Update Tweet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/tweets-edit.blade.php ENDPATH**/ ?>