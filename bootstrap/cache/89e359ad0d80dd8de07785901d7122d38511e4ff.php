<?php $__env->startSection('title', 'Mark Attendance'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <form action="/batch/<?php echo e($batch['id']); ?>/mark/attendance" method="post">
        <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
        <input type="hidden" name="batch_id" value="<?php echo e($batch['id']); ?>">
        <div class="row">
            <div class="col-md-12">
                <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-4">
                <label>
                    Date of Attendance
                    <div class="input-group">
                        <input type="text" value="<?php echo e(date('Y-m-d', time())); ?>" style="padding-left:1rem" autocomplete="off" 
                        class="form-control datepicker" name="date_of_attd" placeholder="yyyy-mm-dd" required>
                        <span class="input-group-append">
                            <span class="input-group-text">
                                <i class="mdi mdi-calendar-check"></i>
                            </span>
                        </span>
                    </div>
                </label>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><strong>Batch:</strong> <?php echo e($batch['name']); ?></h4>
                        <div class="table-responsive"> 
                            <?php if(count($students)): ?>
                            <div class="table-responsive">
                                <table id="myDataTable" class="table table-hover table-bordered zero-configuration verticle-middle">
                                    <thead>
                                        <tr>
                                            <th scope="col">#Id</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($student['id']); ?></td>
                                            <td><?php echo e($student['username']); ?></td>
                                            <td><?php echo e($student['name']); ?></td>
                                            <td class="text-center">
                                                <select style="padding: 0.5rem; height: 1rem !important; min-height: 0;" name="status<?php echo e($student['id']); ?>">
                                                    <option value="present">Present</option>
                                                    <option value="absent">Absent</option>
                                                </select>
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
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('trainer.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>