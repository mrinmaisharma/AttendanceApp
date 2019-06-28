<?php $__env->startSection('title', 'View Attendance'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="/view/attendance" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    Batch:
                                </label>
                                <br>
                                <select class="form-control" name="batch_id" id="batch">
                                    <option value="" <?php echo e(($batch!=null) ? '' : 'selected'); ?>>Select Batch</option>
                                    <?php $__currentLoopData = \App\Models\Batch::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($batch!=null): ?>
                                            <option value="<?php echo e($b['id']); ?>" <?php echo e(($b['id'] == $batch['id']) ? 'selected': ''); ?>><?php echo e($b['name']); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($b['id']); ?>"><?php echo e($b['name']); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    Date of Attendance
                                </label>
                                <br>
                                <div class="input-group">
                                    <input value="<?php echo e(($request_date != null ? $request_date: '')); ?>" type="text" style="padding-left:1rem" autocomplete="off" 
                                    class="form-control datepicker" name="date_of_attd" placeholder="yyyy-mm-dd">
                                    <span class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-calendar-check"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button class="btn mt-2 btn-primary" type="submit">Show</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- <form action="/attendance/export" method="post">
                        <input type="hidden" name="export" value="1">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-file-excel-o"></i> Export all to excel
                        </button> -->
                    </form>
                    <div class="table-responsive"> 
                        <?php if(count($attendances)): ?>
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-hover table-bordered zero-configuration verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php
                                                $doa=new \Carbon\Carbon($attendance['date_of_attd']);
                                                $attendance['date_of_attd']=$doa->toFormattedDateString();
                                            ?>
                                            <td><?php echo e($attendance['date_of_attd']); ?></td>
                                            <td><?php echo e($attendance['student']['username']); ?></td>
                                            <td><?php echo e($attendance['student']['name']); ?></td>
                                            <td>
                                                <?php echo e($attendance['status']); ?>

                                                <span data-toggle="tooltip" title="Edit">
                                                    <span class="btn ml-2 btn-warning btn-rounded btn-sm" style="color:#fff" data-toggle="modal" 
                                                    data-target="#editAttendanceModal<?php echo e($attendance['id']); ?>">
                                                        <i class="icon-note"></i>
                                                    </span>
                                                </span>
                                                <!-- Edit Attendance -->
                                                <div id="editAttendanceModal<?php echo e($attendance['id']); ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog modal-md">
                                                        <!-- Modal content-->
                                                        <form action="/attendance/<?php echo e($attendance['id']); ?>/edit" method="post">
                                                            <input type="hidden" name="token" value="<?php echo e(App\Classes\CSRFToken::_token()); ?>">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" style="color:inherit;"><strong>Rectifiy Attendance</strong></h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for="status<?php echo e($attendance['id']); ?>">Attendance: </label>
                                                                    <select class="ml-3" id="status<?php echo e($attendance['id']); ?>" style="padding: 0.5rem; height: 1rem !important; min-height: 0;" name="status">
                                                                        <option value="present" <?php echo e(($attendance['status'] == 'present') ? 'selected': ''); ?>>Present</option>
                                                                        <option value="absent" <?php echo e(($attendance['status'] == 'absent') ? 'selected': ''); ?>>Absent</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                    <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <h5 class="text-center">No Records found</h5>
                        <?php endif; ?>
                    </div>
                    <div>
                        <br>
                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>