<?php $__env->startSection('content'); ?>
    <!-- Header -->
    <header>
        <div class="container" id="maincontent" tabindex="-1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">
                        <h1 class="name">Soda</h1>
                        <hr class="star-light">
                        <span class="skills">simple , fast, mvc, framework</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>