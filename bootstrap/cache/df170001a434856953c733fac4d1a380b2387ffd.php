<?php $__env->startSection('title', 'Profile'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>    
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3" src="/images/avatar/default.png" width="80" height="80" alt="">
                        <div class="media-body">
                            <h3 class="mb-0"><?php echo e($trainer['name']); ?></h3>
                            <p class="text-muted mb-0"><?php echo e(user()['role']); ?></p>
                        </div>
                    </div>
                    
                    <div class="row mb-5">
                        <div class="col">
                            <div class="card card-profile text-center">
                                <span class="mb-1 text-warning"><i class="icon-grid"></i></span>
                                <h3 class="mb-0"><?php echo e(count($batches)); ?></h3>
                                <p class="text-muted">Batches</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-profile text-center">
                                <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                <h3 class="mb-0"><?php echo e($countOfStudents); ?></h3>
                                <p class="text-muted px-4">Students</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <p class="text-muted mb-0 text-center"><?php echo e($trainer['address']); ?></p>
                            <p class="text-muted mb-0 text-center"><?php echo e($trainer['city']); ?></p>
                            <p class="text-muted mb-0 text-center"><?php echo e($trainer['state']); ?></p>
                            <p class="text-muted mb-0 text-center"><?php echo e($trainer['pincode']); ?></p>
                            <br>
                            <br>
                        </div>
                        <div class="col-12 text-center">
                            <a href="/trainer/profile/<?php echo e($trainer['id']); ?>/edit" class="btn btn-danger px-5">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr>
                            <td><strong class="text-dark mr-4">Username</strong></td>
                            <td width="25">:</td>
                            <td><?php echo e($trainer['username']); ?></td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">Phone Number</strong></td>
                            <td width="25">:</td>
                            <td><?php echo e($trainer['phn_number']); ?></td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">WhatsApp Number</strong></td>
                            <td width="25">:</td>
                            <td><?php echo e($trainer['whatsapp_number']); ?></td>
                        </tr>
                        <tr>
                            <td><strong class="text-dark mr-4">Email</strong></td>
                            <td width="25">:</td>
                            <td><?php echo e($trainer['email']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="/change/password" method="post">
                        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                        <input type="hidden" name="username" value="<?php echo e($trainer['username']); ?>">
                        <h4 style="color: inherit;"><strong>Change Password</strong></h4>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-old-password">Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="oldPassword" pattern="((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$)"
                                title="UpperCase, LowerCase, Number/SpecialChar and min 6 Chars." minlength="6" required placeholder="Enter your current password.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-password">New Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="newPassword" pattern="((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$)"
                                title="UpperCase, LowerCase, Number/SpecialChar and min 6 Chars." minlength="6" required placeholder="Choose a safe one..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-confirm-password">Confirm Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" name="confirmPassword" pattern="((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$)"
                                title="UpperCase, LowerCase, Number/SpecialChar and min 6 Chars." minlength="6" required placeholder="Confirm new password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('trainer.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>