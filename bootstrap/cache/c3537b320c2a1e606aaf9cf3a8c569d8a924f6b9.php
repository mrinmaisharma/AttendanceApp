<?php $__env->startSection('title', 'Add Trainer'); ?>

<?php $__env->startSection('data-page-id', 'addTrainer'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h3 style="color: inherit;" class="text-center"><strong>Add Trainer</strong></h4>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <form action="/master/trainer/add" method="post">
                        <input type="hidden" name="token" value="<?php echo e(\App\CLasses\CSRFToken::_token()); ?>">
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="fullname">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" 
                                class="form-control" id="fullname" 
                                name="name" placeholder="Full Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="username">
                                Username <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" 
                                class="form-control" id="username" 
                                name="username" placeholder="Username" required>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="password">
                                Password <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="password" pattern="((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$)" 
                                class="form-control" id="password" 
                                name="password" title="UpperCase, LowerCase, Number/SpecialChar and min 6 Chars." minlength="6" placeholder="Create Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="phn_number">
                                Phone Number <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="tel" autocomplete="off" 
                                class="form-control" id="phn_number" 
                                name="phn_number" maxlength="10" pattern="[0-9]{10}" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="whatsapp_number">
                                WhatsApp Number
                            </label>
                            <div class="col-md-6">
                                <input type="tel" autocomplete="off" 
                                class="form-control" id="whatsapp_number" 
                                name="whatsapp_number" maxlength="10" pattern="[0-9]{10}" placeholder="WhatsApp Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="email">
                                Email <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" 
                                class="form-control" id="email" 
                                name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="address">
                                Address
                            </label>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" 
                                class="form-control" id="address" 
                                name="address" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="city">
                                City
                            </label>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" 
                                class="form-control" id="city" 
                                name="city" placeholder="City">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="state">
                                State
                            </label>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" 
                                class="form-control" id="state" 
                                name="state" placeholder="State">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 offset-md-1 col-form-label" for="pincode">
                                Pincode
                            </label>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" 
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