
<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- Slider main container -->
    <div class="swiper navigation-swiper">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide" style="background: url(<?php echo e(asset($slider->image)); ?>);  background-size: cover;">
                    <div class="container">
                        <div class="slider-container text-center pb-5">
                            <h4 class="slider-sub-title"><?php echo e($slider->secondary_text); ?></h4>
                            <div class="animated-area">
                                <h1 class="slider-title"> <?php echo e($slider->heading_text); ?></h1>

                            </div>
                        </div>
                    </div>
                    <div class="background-overly"></div>
                    
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- start hero section -->
    <section class="section pb-0 hero-section" id="hero">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-10">
                    <div class="text-center pb-5">
                        <h1 class="display-6 fw-semibold mb-3 lh-base">The better way to send your parcel with
                            <span class="text-success"> <?php echo e($setting->name); ?> </span>
                        </h1>
                        <p class="lead text-muted lh-base">Be a merchant with us and send your parcel to your
                            customer.
                        </p>

                        <div class="d-flex gap-2 justify-content-center mt-4">
                            <a href="<?php echo e(route('merchant.register.page')); ?>" class="btn btn-primary">Register as
                                merchant<i class="ri-arrow-right-line align-middle ms-1"></i></a>
                            <a href="<?php echo e(route('signin')); ?>" class="btn btn-danger">Signin <i
                                    class="ri-eye-line align-middle ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end hero section -->

    <!-- About Us -->
    <section class="section bg-light py-5" id="about-us">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-6 col-sm-7 mx-auto">
                    <div>
                        <img src="<?php echo e(asset('assets/frontend/img/block/about-img.png')); ?>" width="420px"
                            class="img-fluid mx-auto">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-muted">
                        <div class="avatar-sm icon-effect mb-4">
                            <div class="avatar-title bg-transparent rounded-circle text-success h1">
                                <i class="ri-collage-line fs-36"></i>
                            </div>
                        </div>
                        <h3 class="mb-3 fs-20">About <?php echo e($setting->name); ?></h3>
                        <?php $__currentLoopData = $abouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="mb-4 ff-secondary fs-16"> <?php echo e($about->text); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="row pt-3">
                            <div class="col-3">
                                <div class="text-center">
                                    <img alt=<?php echo e($setting->name); ?> width="30px" class="img-fluid mb-3"
                                        src="<?php echo e(asset('assets/frontend/img/icons/icon-2.png')); ?>" />
                                    <p>Fast delivery</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="text-center">
                                    <img alt=<?php echo e($setting->name); ?> width="30px" class="img-fluid mb-3"
                                        src="<?php echo e(asset('assets/frontend/img/icons/icon-3.png')); ?>" />
                                    <p>secured service</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <img alt=<?php echo e($setting->name); ?> width="30px" class="img-fluid mb-3"
                                        src="<?php echo e(asset('assets/frontend/img/icons/icon-4.png')); ?>" />
                                    <p>Countrywide shipping</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <section class="py-5 bg-primary position-relative">
        <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-sm">
                    <div>
                        <h4 class="text-white mb-0 fw-semibold">Send your parcel anywhere in Bangaldesh with
                            <?php echo e($setting->name); ?> </h4>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-sm-auto">
                    <div>
                        <a href="<?php echo e(route('merchant.register.page')); ?>" target="_blank"
                            class="btn bg-gradient btn-danger"><i
                                class="ri-shopping-cart-2-line align-middle me-1"></i>Register as Marchant</a>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>

    
    <section class="section" id="delivery_charge">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 ff-secondary fw-semibold lh-base"><?php echo e($setting->name); ?>

                            Delivery Charge</h1>
                        <p class="text-muted">We provide the following delivery charge per parcel</p>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row g-3">
                <div class="col-lg-6">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQC9f1fy_AUfsLLDy-RDiScTgl49OKC7-vcnD4aiRaDS7DWTAVfW39IrVudnpsK1ycRQus&usqp=CAU"
                        class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" id="myTab" role="tablist">
                        <?php $__empty_1 = true; $__currentLoopData = $delivery_charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $delivery_charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php echo e($key == 0 ? 'active' : ''); ?>" id="home-tab"
                                    data-bs-toggle="tab" data-bs-target="#charge<?php echo e($delivery_charge->id); ?>" type="button"
                                    role="tab" aria-controls="home"
                                    aria-selected="true"><?php echo e($delivery_charge->deliveryChargeHead->name); ?></button>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <?php $__currentLoopData = $delivery_charges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade show <?php echo e($key == 0 ? 'active' : ''); ?>" id="charge<?php echo e($value->id); ?>"
                                role="tabpanel" aria-labelledby="charge">
                                <?php $__currentLoopData = $weights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="btn btn-primary">
                                        <?php echo e($weight->name); ?>

                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
    </section>
    

    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold">Our Features</h3>
                        <p class="text-muted mb-4 ff-secondary"><?php echo e($setting->name); ?> provides the following
                            featuers to
                            the
                            marchant</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row text-center">
                <?php $__currentLoopData = $featuers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 card-animate">
                        <div class="process-card mt-4">
                            <div class="avatar-sm icon-effect mx-auto mb-4">
                                <div class="avatar-title bg-transparent text-success rounded-circle h1">
                                    <i class="ri-quill-pen-line"></i>
                                </div>
                            </div>

                            <h5><?php echo e($feature->title); ?></h5>
                            <p class="text-muted ff-secondary"><?php echo e($feature->subtitle); ?>.</p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>

    
    <section class="section" id="services">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h1 class="mb-3 ff-secondary fw-semibold lh-base"><?php echo e($setting->name); ?>

                            Payments</h1>
                        <p class="text-muted">We provide the following payment methods to our marchants and customer</p>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

            <div class="row g-3">
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6">
                        <div class="d-flex p-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-md">
                                    <img src="<?php echo e($service->image); ?>" class="avatar-md rounded">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-18"><?php echo e($service->title); ?></h5>
                                <p class="text-muted my-3 ff-secondary"><?php echo e($service->text); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    

    
    <section class="section" id="hubs">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold"><?php echo e($setting->name); ?> Hub Address</h3>
                        <p class="text-muted mb-4 ff-secondary">If your'e looking for our hub addresses please find
                            them in
                            below locations</p>

                        <div class="">
                            <button type="button" class="btn btn-primary btn-label rounded-pill"><i
                                    class="ri-mail-line label-icon align-middle rounded-pill fs-16 me-2"></i> Email
                                Us</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row g-lg-5 g-4">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0 me-1">
                            <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 fw-semibold">Our Hub Addresses</h5>
                        </div>
                    </div>
                    <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                        id="genques-accordion">
                        <?php $__currentLoopData = $hubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genques-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#genques-collapseOne_<?php echo e($hub->id); ?>" aria-expanded="false"
                                        aria-controls="genques-collapseOne">
                                        <?php echo e($hub->title); ?>

                                    </button>
                                </h2>
                                <div id="genques-collapseOne_<?php echo e($hub->id); ?>" class="accordion-collapse collapse"
                                    aria-labelledby="genques-headingOne" data-bs-parent="#genques-accordion"
                                    style="">
                                    <div class="accordion-body ff-secondary">
                                        <?php echo e($hub->text); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                    <!--end accordion-->

                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    <img src="https://techbeacon.com/sites/default/files/styles/social/public/field/image/google-location-privacy.jpg?itok=g3oTUeP2"
                        alt="<?php echo e($setting->name); ?>" class="img-fluid">
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- /.hubs  -->
    <section class="section bg-light py-6" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h3 class="mb-3 fw-semibold">Get In Touch</h3>
                        <p class="text-muted mb-4 ff-secondary">We thrive when coming up with innovative ideas but
                            also
                            understand that a smart concept should be supported with faucibus sapien odio measurable
                            results.</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row gy-4">
                <div class="col-lg-4 text-center">
                    <div>
                        <div class="mt-4">
                            <h5 class="fs-13 text-muted text-uppercase">Office Address</h5>
                            <div class="ff-secondary fw-semibold"><?php echo e($setting->address); ?></div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4 text-center">
                    <div>
                        <div class="mt-4">
                            <h5 class="fs-13 text-muted text-uppercase">Phone</h5>
                            <div class="ff-secondary fw-semibold"><?php echo e($setting->mobile_no); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div>
                        <div class="mt-4">
                            <h5 class="fs-13 text-muted text-uppercase">Email</h5>
                            <div class="ff-secondary fw-semibold"><?php echo e($setting->email); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        gsap.registerPlugin(ScrollSmoother);

        // create the smooth scroller FIRST!
        let smoother = ScrollSmoother.create({
            smooth: 1.2, // seconds it takes to "catch up" to native scroll position
            effects: true // look for data-speed and data-lag attributes on elements and animate accordingly
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya\resources\views/frontend/pages/home.blade.php ENDPATH**/ ?>