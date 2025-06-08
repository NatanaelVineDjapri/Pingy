 


<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleTweets.css')); ?>">
    <?php echo $__env->yieldContent('head'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="tweet-container">
    <div class="tweet-box">
        <form action="<?php echo e(route('posttweet')); ?>" method="POST" enctype="multipart/form-data" class="tweet-form">
            <?php echo csrf_field(); ?>
            <div class="tweet-input-section">
                 <?php if(Auth::user()->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . Auth::user()->avatar)); ?>" class="avatar">
                <?php else: ?>
                    <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                <?php endif; ?>
                <textarea name="body" rows="3" placeholder="What's happening?" maxlength="255"><?php echo e(old('body')); ?></textarea>
            </div>
            <div class="tweet-actions">
                <label for="tweetImage" class="upload-label"><ion-icon name="camera-outline"></ion-icon></label>
                <input type="file" name="tweetImage" accept="image/*" id="tweetImage" style="display:none;">
                <button type="submit" class="tweet-submit-btn">Tweet</button>
            </div>
        </form>

        <?php if(session('previewPath')): ?>
            <div class="image-preview">
                <img src="<?php echo e(asset('storage/' . session('previewPath'))); ?>" alt="Preview" class="tweet-image"/>
            </div>
        <?php endif; ?>
    </div>
    <div class="tweet-list">
         <?php $__currentLoopData = $tweets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tweet-item">
            <div class="tweet-header">
                 <?php if($tweet->user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $tweet->user->avatar)); ?>" class="avatar">
                    <?php else: ?>
                        <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                    <?php endif; ?>
                <div class="packs-name">
                    <p class="name"><?php echo e($tweet->user->name); ?></p> 
                    <p class="username"><?php echo e('@'. $tweet->user->username); ?> - 
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
                        <img src="<?php echo e(asset('storage/' . $tweet->tweetImage)); ?>" alt="Tweet image" style="width: 100%; max-width: 675px;max-height:500px;border-radius: 10px; margin-top: 10px;">
                    </div>
                <?php endif; ?>
                <div class="delete-update">
                    <form action="<?php echo e(route('deletetweet', $tweet->id)); ?>" method="POST" onsubmit="return confirm('Are you sure to delete this tweet?');" class="delete-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                    <a href="<?php echo e(route('edittweet', $tweet->id)); ?>" class="edit-btn">
                        <p type="submit" class="delete-btn">Update</p>
                    </a>  
                </div> 
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views\tweets\tweets.blade.php ENDPATH**/ ?>