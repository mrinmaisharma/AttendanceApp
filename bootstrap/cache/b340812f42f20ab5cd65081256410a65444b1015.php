<?php $__env->startSection('title', 'Trainers'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-md-12">
            <a href="/master/trainer/add" class="btn mb-1 btn-rounded btn-outline-info">
                <i class="fa fa-plus"></i> Add Trainer
            </a>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Trainer Details</h4>
                    <div class="table-responsive"> 
                        <?php if(count($trainers)): ?>
                        <table class="zero-configuration table table-hover table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Phone No.</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($trainer['name']); ?></td>
                                    <td><?php echo e($trainer['phn_number']); ?></td>
                                    <td><?php echo e($trainer['email']); ?></td>
                                    <td>
                                        <button type="button" class="btn mb-1 btn-rounded btn-primary" data-toggle="modal" data-target="#view-trainer<?php echo e($trainer['id']); ?>">
                                            View Details
                                        </button>
                                        <div class="modal fade" id="view-trainer<?php echo e($trainer['id']); ?>" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" style="color:inherit;"><strong><?php echo e($trainer['name']); ?></strong></h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body row">
                                                        <div class="col-11">
                                                            <table class="table" style="background-color: transparent;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td><strong>Full Name</strong></td>
                                                                        <td><?php echo e($trainer['name']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Username</strong></td>
                                                                        <td><?php echo e($trainer['username']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Phone Number</strong></td>
                                                                        <td><?php echo e($trainer['phn_number']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>WhatsApp Number</strong></td>
                                                                        <td><?php echo e(($trainer['whatsapp_number'] == null) ? '--' : $trainer['whatsapp_number']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Email</strong></td>
                                                                        <td><?php echo e($trainer['email']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Address</strong></td>
                                                                        <td><?php echo e(($trainer['address'] == null) ? '--' : $trainer['address']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>City</strong></td>
                                                                        <td><?php echo e(($trainer['city'] == null) ? '--' : $trainer['city']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>State</strong></td>
                                                                        <td><?php echo e(($trainer['state'] == null) ? '--' : $trainer['state']); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Pincode</strong></td>
                                                                        <td><?php echo e(($trainer['pincode'] == null) ? '--' : $trainer['pincode']); ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                            </tbody>
                        </table>
                        <?php else: ?>
                        <h5 class="text-center">No Records found</h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>