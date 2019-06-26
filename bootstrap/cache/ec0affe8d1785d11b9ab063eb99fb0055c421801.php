<?php $__env->startSection('title', 'Trainers'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('includes.form_alert', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col-md-12">
            <a href="/master/student/add" class="btn mb-1 btn-rounded btn-outline-info">
                <i class="fa fa-plus"></i> Add Student
            </a>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Student Details</h4>
                    <div class="table-responsive"> 
                        <?php if(count($students)): ?>
                        <div class="table-responsive">
                            <table id="myDataTable" class="table table-hover table-bordered zero-configuration table-striped verticle-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Phone No.</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Batch Alloted</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($student['name']); ?></td>
                                        <td><?php echo e($student['phn_number']); ?></td>
                                        <td><?php echo e($student['email']); ?></td>
                                        <td><?php echo e($student['batch']['name']); ?></td>
                                        <td>
                                            <a href="/student/<?php echo e($student['id']); ?>/profile" class="btn mb-1 btn-rounded btn-primary">
                                                View Details
                                            </a>
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>