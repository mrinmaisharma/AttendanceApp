<?php $__env->startSection('title', 'Edit Student'); ?>

<?php $__env->startSection('data-page-id', 'editStudent'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h3 style="color: inherit;" class="text-center"><strong>Edit Student</strong></h4>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="/student/<?php echo e($student['id']); ?>/edit" method="post">
                        <input type="hidden" name="token" value="<?php echo e(\App\CLasses\CSRFToken::_token()); ?>">
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="batch">
                                Batch <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <select class="form-control" name="batch_id" id="batch" required>
                                    <option value="" <?php echo e(($student!=null) ? 'selected': ''); ?>>Select Batch</option>
                                    <?php $__currentLoopData = \App\Models\Batch::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($student!=null): ?>
                                            <option value="<?php echo e($b['id']); ?>" <?php echo e(($b['id'] == $student['batch_id']) ? 'selected': ''); ?>><?php echo e($b['name']); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($b['id']); ?>"><?php echo e($b['name']); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="fullname">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['name']); ?>" type="text" autocomplete="off" 
                                class="form-control" id="fullname" 
                                name="name" placeholder="Full Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="username">
                                Username <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['username']); ?>" type="text" autocomplete="off" 
                                class="form-control" id="username" 
                                name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="phn_number">
                                Phone Number <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['phn_number']); ?>" type="tel" autocomplete="off" 
                                class="form-control" id="phn_number" 
                                name="phn_number" maxlength="10" pattern="[0-9]{10}" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="whatsapp_number">
                                WhatsApp Number
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['whatsapp_number']); ?>" type="tel" autocomplete="off" 
                                class="form-control" id="whatsapp_number" 
                                name="whatsapp_number" maxlength="10" pattern="[0-9]{10}" placeholder="WhatsApp Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="email">
                                Email <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['email']); ?>" type="text" autocomplete="off" 
                                class="form-control" id="email" 
                                name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="institute">
                                Institute <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['institute']); ?>" type="text" autocomplete="off" 
                                class="form-control" id="institute" 
                                name="institute" placeholder="Institute" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="address">
                                Address
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['address']); ?>" type="text" autocomplete="off" 
                                class="form-control" id="address" 
                                name="address" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="city">
                                City
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['city']); ?>" type="text" autocomplete="off" 
                                class="form-control" id="city" 
                                name="city" placeholder="City">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="state">
                                State
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['state']); ?>" type="text" autocomplete="off" 
                                class="form-control" id="state" 
                                name="state" placeholder="State">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="pincode">
                                Pincode
                            </label>
                            <div class="col-md-6">
                                <input value="<?php echo e($student['pincode']); ?>" type="text" autocomplete="off" 
                                class="form-control" id="pincode" 
                                name="pincode" min="100000" max="999999" maxlength="6" pattern="[0-9]{6}" placeholder="Pincode">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-5">
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
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>