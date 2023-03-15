<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo e($setting->name); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="One Point Courier Mangement System" name="description" />
    <meta content="One Point IT Soultions" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset($setting->logo)); ?>" type="image/x-icon">

    <?php echo $__env->make('frontend.layouts.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('custom-styles'); ?>
</head>

<body>
    <div id="smooth-wrapper">
        <div id="smooth-content">
            <!-- Begin page -->
            <div class="layout-wrapper landing">
                <?php echo $__env->make('frontend.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!-- end navbar -->

                <?php echo $__env->yieldContent('main-content'); ?>
                <!-- Start footer -->
                <?php echo $__env->make('frontend.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--end back-to-top-->

            </div>
            <!-- end layout wrapper -->

            <?php echo $__env->yieldContent('custom-modal'); ?>
        </div>
    </div>
    <!-- JAVASCRIPT -->
    <?php echo $__env->make('frontend.layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!--Swiper slider js-->
    <script src="<?php echo e(asset('assets/backend/libs/swiper/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/pages/landing.init.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/pages/swiper.init.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js"></script>
    
    <?php echo $__env->yieldContent('custom-scripts'); ?>
</body>

</html>
<?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/layouts/master.blade.php ENDPATH**/ ?>