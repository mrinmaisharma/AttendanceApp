<?php $__env->startSection('title', 'Batches'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid batches">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <?php if(count($batches)): ?>
        <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <span class="float-right total-students text-pale-sky">
                        <i class="fa fa-users mr-3"></i>
                        <span class="label gradient-8 btn-rounded"><?php echo e(count($batch['students'])); ?></span>
                    </span>
                    <h5 class="card-title" style="color:inherit"><strong><?php echo e($batch['name']); ?></strong></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Trainer: <?php echo e(($batch['trainer'] == null) ? "Not Assigned" : $batch['trainer']->name); ?></h6>
                    <div class="row">
                        <div class="col-12">
                            <span class="card-text pull-left d-inline"><small class="text-muted">Start Date: <?php echo e($batch['start_date']); ?></small></span>
                            <a href="#" class="badge badge-pill badge-primary pull-right" style="margin: 0.1rem 0;">View Details</a>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn mb-1 btn-rounded btn-outline-info" data-toggle="modal" data-target="#assignTrainerModal<?php echo e($batch['id']); ?>" style="margin-top:1em; font-size:0.8rem;">Assign Trainer</button>
                            <a href="/master/student/add?batch_id=<?php echo e($batch['id']); ?>" class="btn mb-1 btn-rounded btn-outline-primary float-right"style="margin-top:1em; font-size:0.8rem;">+ Students</a>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="assignTrainerModal<?php echo e($batch['id']); ?>" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="/batch/<?php echo e($batch['id']); ?>/assign/trainer" method="post">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" style="collor:inherit"><strong>Assign Trainer</strong></h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="token" value="<?php echo e(\App\CLasses\CSRFToken::_token()); ?>">
                                        <div class="form-group row">
                                            <label class="col-md-4 offset-md-1 col-form-label" for="Trainer">
                                                Trainer <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control" name="trainer_id" id="trainer" required>
                                                    <option value="" selected>---Select Trainer---</option>
                                                    <?php $__currentLoopData = \App\Models\Trainer::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($trainer['id']); ?>"><?php echo e($trainer['name']); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Assign</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <div class="col-md-12"><h3 class="text-center">No batch created</h3></div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>