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
                                    <?php
                                        $user=user();
                                        $trainer_id = \App\Models\Trainer::where('username', $user['username'])->first()['id'];
                                        ?>
                                    <?php $__currentLoopData = \App\Models\Batch::where('trainer_id', $trainer_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <?php if($attendance->batch['trainer_id'] == $trainer_id): ?>
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
                                            </td>
                                        </tr>
                                        <?php endif; ?>
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
<?php echo $__env->make('trainer.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>