<?php $__env->startSection('title', 'Mark Attendance'); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Select Batch</label>
                <div class="dropdown">
                    <select class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <div class="dropdown-menu dropdown-menu-right " x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-3px, 37px, 0px);">
                            <option>Machine Learning</option>
                            <option>Python</option>
                        </div>
                    </select>
                    <a href="" class="btn btn-primary"><i class="fa fa-plus"></i> Add Batch</a>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Batch Students</h4>
                    <div class="table-responsive"> 

                        <table class="zero-configuration table table-hover table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Roll No.</th>
                                    <th scope="col">Phone No.</th>
                                    <th scope="col">Mark Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td>Rahul</td>
                                    <td>123</td>
                                    <td>8102248110
                                    <td>
                                        <div class="dropdown">
                                            <select class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <div class="dropdown-menu dropdown-menu-right " x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-3px, 37px, 0px);">
                                                    <option>Present</option>
                                                    <option>Absent</option>
                                                </div>      
                                            </select>
                                            
                                        </div>
                                    </td>
                                </tr>
                                                    
                            </tbody>
                        </table>
                        
                        
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="" class="btn mb-1 btn-success float-right">Submit</a>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>