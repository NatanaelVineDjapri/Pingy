<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/styleForgetPass.css')); ?>">
    <title>Forget Password Page-Pingy</title>
</head>

<body>
    <video class="video-bg" autoplay muted loop>
    <source src="image/video1.mp4" type="video/mp4">
  </video>

    <div class="container" id="container">
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1 class="h1-pinkys">Forgot Your Password, Pingys?</h1>
                    <p>No worries! Just fill in the form and we'll help you reset it</p>
                </div>
            </div>
        </div>
        <div class="form-container sign-up">
            <form method="POST" action="<?php echo e(route('submitforgetpassword')); ?>">
                <?php echo csrf_field(); ?>
                <h1 class ="h1-pink">Reset Password</h1>
                <input type="text" name="username" placeholder="Username" value="<?php echo e(old('username')); ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required>
                <input type="date" name="dob" placeholder="Date of Birth" value="<?php echo e(old('dob')); ?>" required>
                <input type="password" name="password" placeholder="New Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <button type="submit">Confirmed</button>
                    <?php if($errors->reset->any()): ?>
                        <div class = "error_situation">
                             <?php $__currentLoopData = $errors->reset->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p><?php echo e($error); ?></p>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         </div>
                    <?php endif; ?>
            </form>
        </div>
</body>

</html><?php /**PATH C:\xampp\htdocs\UAS_BACKEND\pingy\resources\views\auth\forget-password.blade.php ENDPATH**/ ?>