<?php if(isset($errors) && count($errors) || \App\Classes\Session::has('error')): ?>
   <?php //var_dump($_SESSION['EMAIL_VERIFY_OTP']);exit; ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <button class="close" data-dismiss="alert" aria-label="close" style="font-size:1.6rem;color:#000">&times;</button>
        <strong>Error!</strong>
        <?php if(\App\Classes\Session::has('error')): ?>
           <?php echo \App\Classes\Session::flash('error'); ?>
        <?php else: ?>
           <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_array): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php $__currentLoopData = $error_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php echo e($error_item); ?> <br/>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
<?php elseif(isset($success) || \App\Classes\Session::has('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
        <button class="close" data-dismiss="alert" aria-label="close" style="font-size:1.6rem;color:#000">&times;</button>
        <strong>Success!</strong>
        <?php if(isset($success)): ?>
           <?php echo e($success); ?>

        <?php elseif(\App\Classes\Session::has('success')): ?>
           <?php echo e(\App\Classes\Session::flash('success')); ?>

        <?php endif; ?>
    </div>
<?php endif; ?>