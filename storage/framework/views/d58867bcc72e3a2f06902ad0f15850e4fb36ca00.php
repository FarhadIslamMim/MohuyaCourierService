
<?php $__env->startSection('title', 'Tracking'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <style>
        .track-left h4,
        .track-right h4 {
            border-bottom: 8px solid #8F0D0D;
            display: inline-block;
            padding-bottom: 10px;
        }

        .tracking-step-left {
            width: 25%;
            float: left;
            border-right: 3px solid #ddd;
            position: relative;
            padding-bottom: 15px;
        }

        .tracking-step-left::after {
            position: absolute;
            top: 50%;
            right: -15px;
            height: 30px;
            width: 30px;
            background: #f5ab35;
            border-radius: 50%;
            font-family: "Font Awesome 5 Free";
            content: "0";
            text-align: center;
            color: #fff;
            line-height: 30px;
            transform: translateY(-37px);
        }

        .tracking-step-right {
            width: 70%;
            float: right;
        }

        .tracking-step {
            overflow: hidden;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <section class="section">
        <article>
            <!-- Breadcrumb -->
            <section class="theme-breadcrumb pad-50 bg-info py-4">
                <div class="container ">
                    <div class="row">
                        <div class="col-sm-8 pull-left">
                            <div class="title-wrap py-4">
                                <h2 class="section-title_2 no-margin"> Parcel tracking </h2>
                                <p class="fs-16 no-margin"> Track your parcel & see the current condition </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.Breadcrumb -->

            <!-- Tracking -->
            <section class="py-5 pb-120 tracking-wrap">
                <div class="container ">
                    <div class="row pad-10">
                        <div class="col-md-8 col-md-offset-2 tracking-form wow fadeInUp" data-wow-offset="50"
                            data-wow-delay=".30s">
                            <h4> Track your percel </h4> <span class="font2-light fs-12">Now you can track your
                                percel easily</span>
                            <form class="" method="GET" action="">
                                <div class="row">
                                    <div class="col-md-7 col-sm-7">
                                        <div class="form-group">
                                            <input type="text" name="tracking_id" placeholder="Enter your tracking ID"
                                                required="" class="form-control box-shadow">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <button class="btn btn-success">Track your parcel</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-7 pad-30 ">
                            <br>
                            <br>
                            <?php $__currentLoopData = $trackInfos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trackInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tracking-step">
                                    <div class="tracking-step-left">
                                        <strong><?php echo e(date('h:i A', strtotime($trackInfo->created_at))); ?></strong>
                                        <p><?php echo e(date('M d, Y', strtotime($trackInfo->created_at))); ?></p>
                                    </div>
                                    <div class="tracking-step-right">
                                        <p><?php echo e($trackInfo->note); ?></p>
                                        <p><?php echo e($trackInfo->remark); ?></p>
                                        <p class="track_dec"><?php echo e($trackInfo->description); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="col-md-5 pad-30 wow fadeInRight" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="prod-info white-clr">
                                <ul>
                                    <li> <span class="title-2">Tracking id:</span> <span class="fs-16">
                                            <?php echo e($tracking_data->trackingCode ?? 'Your tracking code'); ?>

                                        </span> </li>
                                    <li> <span class="title-2">Customer Name:</span> <span class="fs-16">
                                            <?php echo e($tracking_data->recipientName ?? 'Customer name'); ?>

                                        </span> </li>
                                    <li> <span class="title-2">Address:</span> <span
                                            class="fs-16"><?php echo e($tracking_data->delivery_address ?? 'Address'); ?></span></li>
                                    <li> <span class="title-2">Create date:</span> <span
                                            class="fs-16"><?php echo e($tracking_data->created_at ?? 'Created Date'); ?></span></li>
                                    <li> <span class="title-2">order status:</span> <span class="fs-16 theme-clr">
                                            <?php if($tracking_data): ?>
                                                <?php if($tracking_data->status == 1): ?>
                                                    Pending
                                                <?php elseif($tracking_data->status == 2): ?>
                                                    Picked
                                                <?php elseif($tracking_data->status == 3): ?>
                                                    In Transit
                                                <?php elseif($tracking_data->status == 4): ?>
                                                    Delivered
                                                <?php else: ?>
                                                    Status
                                                <?php endif; ?>
                                            <?php else: ?>
                                                Status
                                            <?php endif; ?>

                                        </span> </li>
                                    <?php
                                        if ($tracking_data) {
                                            $deliverymanInfo = App\Models\Deliveryman::find($tracking_data->deliverymanId);
                                        }
                                    ?>
                                    <li> <span class="title-2">Deliveryman:</span> <span
                                            class="fs-16"><?php echo e($deliverymanInfo->name ?? 'Rider name'); ?></span> </li>
                                    <li> <span class="title-2">Phone:</span> <span
                                            class="fs-16"><?php echo e($deliverymanInfo->phone ?? 'Rider Phone'); ?></span> </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- /.Tracking -->

        </article>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/pages/tracking.blade.php ENDPATH**/ ?>