<?php $__env->startSection('title', 'Students'); ?>


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
                                        <th scope="col">Action</th>
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
                                            <a href="/student/<?php echo e($student['id']); ?>/profile" data-toggle="tooltip" title="View Details">
                                                <span class="btn btn-primary mr-1 btn-rounded btn-sm" data-toggle="modal" data-target="#viewStudentModal<?php echo e($student['id']); ?>">
                                                    <i class="icon-eye"></i>
                                                </span>
                                            </a>
                                            <a href="/student/<?php echo e($student['id']); ?>/edit" data-toggle="tooltip" title="Edit">
                                                <span class="btn btn-warning mr-1 btn-rounded btn-sm" style="color:#fff">
                                                    <i class="icon-note"></i>
                                                </span>
                                            </a>
                                            <span data-toggle="tooltip" title="Delete">
                                                <span class="btn btn-danger btn-rounded btn-sm" data-toggle="modal" data-target="#deleteStudentModal<?php echo e($student['id']); ?>">
                                                    <i class="icon-trash"></i>
                                                </span>
                                            </span>

                                            <!-- Delete Modal -->
                                            <div id="deleteStudentModal<?php echo e($student['id']); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-md">
                                                    <!-- Modal content-->
                                                    <form action="/student/<?php echo e($student['id']); ?>/delete" method="post">
                                                        <input type="hidden" name="token" value="<?php echo e(App\Classes\CSRFToken::_token()); ?>">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" style="color:inherit;"><strong>Delete Student</strong></h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this student?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger btn-sm">Yes</button>
                                                                <button type="button" class="btn btn-sm" data-dismiss="modal">No</button>
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>