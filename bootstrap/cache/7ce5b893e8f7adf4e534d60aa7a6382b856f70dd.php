<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('data-page-id', 'dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Batches</h3>
                    <div class="d-inline-block">
                        <br>
                        <h2 class="text-white">0</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="icon-grid"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-7">
                <div class="card-body">
                    <h3 class="card-title text-white">Trainers</h3>
                    <div class="d-inline-block">
                        <br>
                        <h2 class="text-white">0</h2>
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
    
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>