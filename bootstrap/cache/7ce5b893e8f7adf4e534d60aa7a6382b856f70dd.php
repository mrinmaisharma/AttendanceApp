<?php $__env->startSection('title', 'Dashboard'); ?>


<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                    Asperiores repellendus molestiae exercitationem voluptatem tempora quo dolore nostrum dolor consequuntur itaque, alias fugit. 
                    Architecto rerum animi velit, beatae corrupti quos nam saepe asperiores aliquid quae culpa ea reiciendis ipsam numquam laborum aperiam. 
                    Id tempore consequuntur velit vitae corporis, aspernatur praesentium ratione!
                    <br><span class="pull-right"><strong>~ Author</strong></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>