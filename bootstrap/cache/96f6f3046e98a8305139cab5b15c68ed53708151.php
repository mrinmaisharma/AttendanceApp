<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('data-page-id', 'dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">My Batches</h3>
                    <div class="d-inline-block">
                        <br>
                        <h2 class="text-white"><?php echo e(count($batches)); ?></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="icon-grid"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-7">
                <div class="card-body">
                    <h3 class="card-title text-white">Students</h3>
                    <div class="d-inline-block">
                        <br>
                        <h2 class="text-white"><?php echo e($studentCount); ?></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thought of the day</h5>
                    <p class="card-text" id="quoteOfTheDay">
                    <?php echo e($quote); ?>

                    <br>
                    <span class="pull-right"><strong>~ <?php echo e($author); ?></strong></span>
                    </p>
                    <p class="card-text d-inline"><small class="text-muted">quotes powered by: <a href="https://theysaiso.com">TheySaidSo</a></small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" style="color: inherit;"><strong>Active Batches</strong></h4>
                    <div class="table-responsive" style="overflow:auto; height:15.5rem; max-height:15.5rem">
                        <?php if(count($activeBatches)): ?>
                        <table class="table header-border table-hover verticle-middle">
                            <tbody>
                                <?php $__currentLoopData = $activeBatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($batch['name']); ?></td>
                                    <td style="text-align:center">
                                        <span class="total-students text-pale-sky">
                                            <i class="fa fa-users mr-3"></i>
                                            <span class="label gradient-8 btn-rounded"><?php echo e(count($batch['students'])); ?></span>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <h3 class="text-center">No active batches</h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>