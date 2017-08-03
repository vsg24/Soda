<?php $__env->startSection('content'); ?>
    <br><br>
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>SECOND PAGE</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p style="font-size: medium; text-align: center">
                        This is the second page.
                        Here is a variable passed to the view: <b>Animal: </b><?php echo e($animal); ?>

                    </p>
                    <form method="post">
                        <h3>Test form</h3>
                        <?php if(isset($success) && $success): ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong> Database successfully updated.
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" placeholder="Enter a title..." required>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea id="body" name="body" class="form-control" placeholder="Enter some body text..." required></textarea>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>