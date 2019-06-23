<?php $__env->startSection('title', 'Batches'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <span class="float-right total-students text-pale-sky">
                        <i class="fa fa-users mr-3"></i>
                        <span class="label gradient-8 btn-rounded">0</span>
                    </span>
                    <h5 class="card-title">Batch A</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Trainer: Nihal Jaiswal</h6>
                    <p class="card-text d-inline"><small class="text-muted">Batch Start 15th August</small></p>
                    <a href="#" class="badge badge-pill badge-primary float-right">View Details</a>

                    <button type="button" class="btn mb-1 btn-rounded btn-outline-info" data-toggle="modal" data-target="#basicModal" style="margin-top:1em; font-size:0.8rem;">Assign Trainer</button>
                    <button type="button" class="btn mb-1 btn-rounded btn-outline-primary float-right"style="margin-top:1em; font-size:0.8rem;">+ Students</button>
                    <!-- Modal -->
                    <div class="modal fade" id="basicModal" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>

                                    
                                </div>

                                <div class="dropdown">
                                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Select Trainer</button>
                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 37px, 0px);"><a class="dropdown-item" href="#">Link 1</a> <a class="dropdown-item" href="#">Link 2</a> <a class="dropdown-item" href="#">Link 3</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Another link</a>
                                    </div></>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Assign</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>