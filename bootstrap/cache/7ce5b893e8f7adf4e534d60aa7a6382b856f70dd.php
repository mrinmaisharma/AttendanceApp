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
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="/master/batch/create" method="post">
                        <input type="hidden" name="token" value="<?php echo e(\App\CLasses\CSRFToken::_token()); ?>">
                        <h4 style="color: inherit;"><strong>Create Batch</strong></h4>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="batch_name">Batch Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" autocomplete="off" class="form-control" id="batch_name" name="name" required placeholder="Batch Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="start_date">Start Date<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control datepicker" name="start_date" id="startDate" placeholder="yyyy-mm-dd" required>
                                    <span class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label" for="val-confirm-password">End Date
                            </label>
                            <div class="col-lg-6">
                            <div class="input-group">
                                    <input type="text" autocomplete="off" class="form-control datepicker" name="end_date" id="endDate" placeholder="yyyy-mm-dd">
                                    <span class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </span>
                                    </span>
                                </div>
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title" style="color: inherit;"><strong>Active Batches</strong></h4>
                    <div class="table-responsive" style="overflow:auto; height:15.5rem; max-height:15.5rem">
                        <table class="table header-border table-hover verticle-middle">
                            <tbody>
                                <tr>
                                    <td>Python &amp; data-structure</td>
                                    <td style="text-align:center">
                                        <span class="total-students text-pale-sky">
                                            <i class="fa fa-users mr-3"></i>
                                            <span class="label gradient-8 btn-rounded">0</span>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>