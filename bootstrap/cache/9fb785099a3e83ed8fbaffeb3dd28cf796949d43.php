<?php $__env->startSection('title', 'Batches'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-black float-right">4565</h3>
                    <h5 class="card-title">Batch A</h5>
                    
                    <h6 class="card-subtitle mb-2 text-muted">Trainer: Nihal Jaiswal</h6>
                    
                    <p class="card-text d-inline"><small class="text-muted">Batch Start 15th August</small>
                    </p><a href="#" class="card-link float-right"><small>View Details</small></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>