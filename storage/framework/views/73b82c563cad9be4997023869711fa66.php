 

<?php $__env->startSection('content'); ?>
<div class="tweet-container">
    <h2>Home</h2>

    
    <form action="<?php echo e(route('posttweet')); ?>" method="POST" enctype="multipart/form-data" class="tweet-form">
        <?php echo csrf_field(); ?>

        <textarea name="body" rows="3" placeholder="What's happening?" maxlength="255"><?php echo e(old('body')); ?></textarea>
        <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <input type="file" name="tweetImage" accept="image/*" id="tweetImage" style="display:none;">
        <label for="tweetImage" class="upload-label">📷 Add Image</label>
        <?php $__errorArgs = ['tweetImage'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="error"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <button type="submit" class="tweet-submit-btn">Tweet</button>
    </form>

    
    <?php if(session('previewPath')): ?>
        <div class="image-preview">
            <p>Image preview:</p>
            <img src="<?php echo e(asset('storage/' . session('previewPath'))); ?>" alt="Preview" style="max-width:200px;"/>
        </div>
    <?php endif; ?>

    
    <div class="tweet-list">
        <?php $__empty_1 = true; $__currentLoopData = $tweets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tweet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="tweet-item">
            <div class="tweet-body">
                <p><?php echo e($tweet->body); ?></p>
                <?php if($tweet->tweetImage): ?>
                    <img src="<?php echo e(asset('storage/' . $tweet->tweetImage)); ?>" alt="Tweet Image" class="tweet-image"/>
                <?php endif; ?>
            </div>
            <form action="<?php echo e(route('deletetweet', $tweet->id)); ?>" method="POST" onsubmit="return confirm('Are you sure to delete this tweet?');" class ="delete-form">                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="delete-btn">Delete</button>
            </form>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p>No tweets yet. Start tweeting!</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<style>
    .tweet-container {
        padding: 20px;
        max-width: 600px;
        margin-left: 280px; /* kasih space buat sidebar */
    }
    .tweet-form textarea {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        resize: none;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 5px;
    }
    .upload-label {
        cursor: pointer;
        display: inline-block;
        margin-bottom: 10px;
        color: #1da1f2;
    }
    .tweet-submit-btn {
        background-color: #1da1f2;
        border: none;
        padding: 8px 15px;
        color: white;
        border-radius: 20px;
        font-weight: 700;
        cursor: pointer;
        float: right;
    }
    .tweet-list {
        margin-top: 30px;
    }
    .tweet-item {
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .tweet-body p {
        margin: 0 0 5px 0;
        white-space: pre-wrap;
    }
    .tweet-image {
        max-width: 100%;
        border-radius: 10px;
        margin-top: 5px;
    }
    .delete-btn {
        background: transparent;
        border: none;
        color: red;
        cursor: pointer;
        font-size: 0.9rem;
    }
    .error {
        color: red;
        font-size: 0.8rem;
        margin-bottom: 5px;
    }
</style>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/tweets.blade.php ENDPATH**/ ?>