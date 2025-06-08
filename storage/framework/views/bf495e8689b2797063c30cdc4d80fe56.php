<?php $__env->startSection('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/styleHome.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="message-container">
        <div class="message-box">
            <form action="<?php echo e(route('inboxmessage')); ?>" method="GET" class="tweet-form" style="margin-left:auto;">
                <div class="tweet-input-section">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search Direct Messages"class="search-input">
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
    
    <div class="personal-container">
        <div class="profil-container">
            <div class="profil">
                <?php if($user->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" class="avatar">
                <?php else: ?>
                    <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                <?php endif; ?>
                <div class="packs-name">
                    <a href="<?php echo e(route('showprofile', $user->id)); ?>">
                        <p class="name"><?php echo e($user->name); ?></p>
                    </a>
                    <p class="username"><?php echo e('@' . $user->username); ?></p>
                </div>
                <div class="icon">
                    <ion-icon name="sunny-outline"></ion-icon>
                </div>
            </div>
        </div>

        <div class="chat">
        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if($message->sender_id == auth()->id()): ?>
                <div class="message-item">
                    <div class="message-header-right">
                        <div class="header-profile">
                            <form action = "<?php echo e(route('deletemessage',['user' => auth()->user()->id,'message' => $message->id])); ?>" method="POST" onsubmit="return confirm('Are you sure to delete this message?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="Submit" class="delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon>
                                </button>
                            </form>
                            <div class="packs-name">
                                <p class="name"><?php echo e(auth()->user()->name); ?></p>
                                <p class="username"><?php echo e('@' . auth()->user()->username); ?></p>
                                <p class="username"><?php echo e($message->created_at->format('d M Y H:i')); ?></p>
                            </div>
                            <?php if(auth()->user()->avatar): ?>
                                <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" class="avatar">
                            <?php else: ?>
                                <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                            <?php endif; ?>
                         </div> 
                    </div>
                   <div class="message-body-right">
                        <p><?php echo e($message->message); ?></p>
                     </div>
                </div>
            <?php else: ?>
            <div class="message-item">
                <div class="message-header-left">
                    <?php if($user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" class="avatar">
                    <?php else: ?>
                        <img src="<?php echo e(asset('image/profilepicture.jpg')); ?>" class="avatar">
                    <?php endif; ?>
                    <div class="packs-name">
                        <p class="name"><?php echo e($user->name); ?></p>
                        <p class="username"><?php echo e('@' . $user->username); ?></p>
                        <p class="username"><?php echo e($message->created_at->format('d M Y H:i')); ?></p>
                    </div>
                </div>
                <div class="message-body-left">
                    <p><?php echo e($message->message); ?></p>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="message-item">
                <p>Oops! You don't have any messages yet.Start a conversation!</p>
            </div>
        <?php endif; ?>
    </div>
        <div class="pembatas">
            <p>===</p>
        </div>
        <div class="input">
            <form action="<?php echo e(route('postmessage', $user->id)); ?>" method="POST" class="message-form">
                <?php echo csrf_field(); ?>
                <div class="message-actions">
                    <textarea type="text" name="message" placeholder="Tulis pesan..." class="message-input"></textarea>
                    <button type="submit" class="submit-btn">Kirim</button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app-3', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views\messages\show-messages.blade.php ENDPATH**/ ?>