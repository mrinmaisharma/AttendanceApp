<?php $__env->startSection('title', 'Batches'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid batches">
    <div class="row">
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
                    <div class="row">
                        <div class="col-12">
                            <span class="card-text pull-left d-inline"><small class="text-muted">Start Date: <?php echo e($batch['start_date']); ?></small></span>
                        </div>
                        <div class="col-12">
                            <br>
                        </div>
                        <div class="col-md-12 text-center">
                            <a href="/batch/<?php echo e($batch['id']); ?>/students" class="btn btn-sm mb-1 btn-rounded btn-outline-primary pull-left" style="margin: 0.1rem 0;">View Students</a>
                            <?php if($batch['end_date']==null): ?>
                            <a href="/batch/<?php echo e($batch['id']); ?>/mark/attendance" class="btn btn-sm mb-1 btn-rounded btn-outline-danger pull-right" style="margin: 0.1rem 0;">Mark Attendance</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <div class="col-md-12"><h3 class="text-center">No batch is assigned to you.</h3></div>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('trainer.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>