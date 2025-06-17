<?php $__env->startSection('head'); ?>
    <title>Messages | Pingy</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleHome.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="message-container">
        <div class="message-box">
            <form action="<?php echo e(route('inboxmessage')); ?>" method="GET" class="tweet-form" style="margin-left:auto;">
                <div class="tweet-input-section">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search users..." style="width: 100%; padding: 10px; border-radius: 10px; border: 1px solid #ccc;">
                </div>
                <div class="message-actions" style="justify-content: flex-end;">
                    <button type="submit" class="message-submit-btn">Search</button>
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
                            <a href="<?php echo e(route('showmessage', $user->id)); ?>">
                                <p class="name"><?php echo e($user->name); ?></p>
                            </a>
                            <p class="username"><?php echo e('@' . $user->username); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php if(request('search')): ?>
                    <p class="search-empty" style="padding: 20px; color:white;">
                        No users found for <strong>"<?php echo e(request('search')); ?>"</strong>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
             <div class="message">
                <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="message-item">
                <div class="tweet-header">
                    <?php if($contact->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $contact->avatar)); ?>" class="avatar">
                    <?php else: ?>
                        <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                    <?php endif; ?>
                    <div class="packs-name">
                        <a href="<?php echo e(route('showmessage', $contact->id)); ?>">
                            <p class="name"><?php echo e($contact->name); ?></p>
                        </a>
                        <p class="username"><?php echo e('@'.$contact->username); ?></p>
                    </div>
                </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="message-item">
                    <p>No messages yet. Sorry!</p>
                </div>
                <?php endif; ?>
             </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-3', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views/messages/inbox-messages.blade.php ENDPATH**/ ?>