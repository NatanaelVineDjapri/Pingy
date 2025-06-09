 

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
                    <a href="<?php echo e(route('showprofile', $tweet->user->id)); ?>"><p class="name"><?php echo e($tweet->user->name); ?></p></a> 
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
                    <ion-icon name="bookmark-outline"></ion-icon>
                    <span><?php echo e($tweet->comments->count()); ?></span>
                </ul>
                <div class="comment-section">
                    <form action="<?php echo e(route('postcomment', $tweet->id)); ?>" method="POST" class="comment-form">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="comment" placeholder="Tulis komentar..." required>
                        <button type="submit">Kirim</button>
                    </form>
                    <?php if($tweet->comments->count()): ?>
                    <ul class="comment-list">
                       <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="comment-item">
                            <div class="user-info">
                                <?php if($comment->user->avatar): ?>
                                    <img src="<?php echo e(asset('storage/' . $comment->user->avatar)); ?>" class="avatar2">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar2">
                                <?php endif; ?>
                                <div class="packs-name">
                                    <a href="<?php echo e(route('showprofile', $comment->user->id)); ?>""><p class="name"><?php echo e($comment->user->name); ?></p></a> 
                                    <p class="username"><?php echo e('@' . $comment->user->username); ?> - <?php echo e($comment->created_at->format('M,d Y')); ?></p>
                                </div>
                            </div>
                            <p class="comment-body"><?php echo e($comment->body); ?></p>
                            <?php if(auth()->id() === $comment->user_id): ?>
                                <form action="<?php echo e(route('deletecomment', [$comment->tweet, $comment])); ?>" method="POST" onsubmit="return confirm('Are you sure to delete this comment?');" class="delete-form">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"   class="delete-btn">Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/comment.blade.php ENDPATH**/ ?>