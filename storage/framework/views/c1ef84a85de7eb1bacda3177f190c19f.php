 

<?php $__env->startSection('content'); ?>
<div class="tweet-container">
    <div class="tweet-list">
        <?php $__currentLoopData = $tweets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tweet-item">
            <div class="tweet-header">
                <img src="<?php echo e(asset('storage/' . $tweet->user->avatar)); ?>" class="avatar" alt="User Avatar">
                <div class="packs-name">
                    <p class="name"><?php echo e($tweet->user->name); ?></p> 
                    <p class="username"><?php echo e('@' . $tweet->user->username); ?> - <?php echo e($tweet->created_at->format('M,d Y')); ?></p>
                </div>
            </div>
            <div class="tweet-body">
                <p><?php echo e($tweet->body); ?></p>
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
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<style>
    body {
    background-color: #f5f8fa;
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
}

.tweet-container {
    padding: 20px;
    max-width: 600px;
    margin-left: 100px;
    padding-right: 50px;
    border-right: 2px solid white;
}

.tweet-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.tweet-item {
    background-color: #fff;
    border: 1px solid #e6ecf0;
    border-radius: 16px;
    padding: 15px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.tweet-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
}

.packs-name {
    display: flex;
    flex-direction: column;
}

.name {
    font-weight: bold;
    font-size: 1rem;
    margin: 0;
}

.username {
    color: #717171;
    font-size: 12px;
    margin-top: 2px;
}

.tweet-body {
    display: flex;
    flex-direction: column;
}

.tweet-body p {
    margin: 0 0 5px 0;
    white-space: pre-wrap;
    font-size: 1rem;
}

.tweet-image {
    display: block;
    margin-top: 10px;
}

.tweet-img {
    max-width: 80%;
    border-radius: 10px;
}

.retweeticons {
    margin-top: 10px;
    display: flex;
    gap: 15px;
    margin-left: 10px;
    cursor: pointer;
    padding-top:5px
}



.delete-btn ion-icon {
    font-size: 17px;
    color: #fba7c9;
}


</style>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/home.blade.php ENDPATH**/ ?>