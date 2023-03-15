
<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('custom-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <div class="section mt-5">
        <div class="container">
            <article>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Welcome, <?php echo e($merchant_info->firstName); ?></h3>
                            </div>
                            <div class="card-body">
                                <h5>Today Parcel Details</h5>
                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/today/parcels')); ?>"  target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Parcel</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span><?php echo e($today_placepercel); ?> / <?php echo e(number_format($today_parcel_total,2)); ?></span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=pending')); ?>"  target="_blank">
                                            <div class="card card-animate bg-success">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Pending</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span><?php echo e($today_pendingparcel); ?>

                                                                    <?php if($today_pendingparcel_amount): ?>
                                                                      / <?php echo e(number_format($today_pendingparcel_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=picked')); ?>">
                                            <div class="card card-animate bg-green">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Picked</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span><?php echo e($today_picked); ?>

                                                                    <?php if($today_picked_amount): ?>
                                                                        / <?php echo e(number_format($today_picked_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>


                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=in-transit')); ?>"  target="_blank">
                                            <div class="card card-animate bg-info">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Transit</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e($today_transit); ?>

                                                                    <?php if($today_transit_amount): ?>
                                                                        / <?php echo e(number_format($today_transit_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=hold')); ?>">
                                            <div class="card card-animate bg-warning">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Hold</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                <?php echo e($today_totalhold); ?>

                                                                  <?php if($today_hold_amount): ?>
                                                                        / <?php echo e(number_format($today_hold_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=deliverd')); ?>"  target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Delivered</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e($today_deliverd); ?>

                                                                    <?php if($today_delivered_amount): ?>
                                                                        / <?php echo e(number_format($today_delivered_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=hold')); ?>"  target="_blank">
                                            <div class="card card-animate bg-danger">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Cancel</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e($today_cancelparcel); ?>

                                                                   <?php if($today_cancel_amount): ?>
                                                                        / <?php echo e(number_format($today_cancel_amount,2)); ?>

                                                                   <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-5">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=return-pending')); ?>" target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-small text-white-50 mb-0"> Return to Pending</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>
                                                                    <?php echo e($today_return_to_pending); ?>

                                                                    <?php if($today_return_to_pending_amount): ?>
                                                                       /<?php echo e(number_format($today_return_to_pending_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                                r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-5">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=return-to-hub')); ?>"  target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-small text-white-50 mb-0"> Return to Hub</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e($today_return_to_hub); ?>

                                                                    <?php if($today_return_to_hub_amount): ?>
                                                                       / <?php echo e(number_format($today_return_to_hub_amount,2)); ?>

                                                                    <?php endif; ?>

                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                                r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-5">
                                        <a href="<?php echo e(url('merchant/today/parcels?parcel_type=return-to-merchant')); ?>"  target="_blank">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-small text-white-50 mb-0"> Return to
                                                                Merchant</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e($today_parcelreturn); ?>

                                                                    <?php if($today_parcelreturn_amount): ?>
                                                                        / <?php echo e(number_format($today_parcelreturn_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Partial Return
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e(number_format($today_partial_return,2)); ?>

                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="#">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e(number_format($todayamount,2)); ?>

                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="#">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Paid Amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e(number_format($today_paid,2)); ?>

                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="#">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Today Unpaid amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                    <?php echo e(number_format($today_unpaid,2)); ?>

                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5>All Parcel Information</h5>
                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels')); ?>">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Parcel</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>
                                                                    <?php echo e($placepercel); ?>

                                                                    <?php if($placepercel_amount): ?>
                                                                      / <?php echo e(number_format($placepercel_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=pending')); ?>">
                                            <div class="card card-animate bg-success">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Pending</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                <?php echo e($pendingparcel); ?>

                                                                <?php if($pendingparcel_amount): ?>
                                                                    / <?php echo e(number_format($pendingparcel_amount,2)); ?>

                                                                <?php endif; ?>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=picked')); ?>">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total picked</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                <?php echo e($parcle_picked); ?>

                                                                <?php if($parcel_picked_total_amount): ?>
                                                                    / <?php echo e(number_format($parcel_picked_total_amount,2)); ?>

                                                                <?php endif; ?>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=transit')); ?>">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Transit</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                <?php echo e($parcle_transit); ?>

                                                                    <?php if($parcel_transit_total_amount): ?>
                                                                        / <?php echo e(number_format($parcel_transit_total_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=deliverd')); ?>">
                                            <div class="card card-animate bg-info">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Delivered</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                <?php echo e($deliverd); ?>

                                                                <?php if($total_delivered_amount): ?>
                                                                    / <?php echo e(number_format($total_delivered_amount,2)); ?>

                                                                <?php endif; ?>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=return-pending')); ?>">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Returned to Pending
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>
                                                                <?php echo e($return_pending); ?>

                                                                    <?php if($return_pending_amount): ?>
                                                                        / <?php echo e(number_format($return_pending_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=return-to-hub')); ?>">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Returned to Hub
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                <?php echo e($return_hub); ?>

                                                                    <?php if($return_hub_amount): ?>
                                                                        / <?php echo e(number_format($return_hub_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=return-to-merchant')); ?>">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Returned to Merchant
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white">
                                                                <span>
                                                                <?php echo e($parcelreturn); ?>

                                                                <?php if($parcelreturn_amount): ?>
                                                                   / <?php echo e(number_format($parcelreturn_amount,2)); ?>

                                                                <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=cancelled')); ?>">
                                            <div class="card card-animate bg-danger">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Canceled</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                <?php echo e($cancelparcel); ?>

                                                                    <?php if($cancelparcel_amount): ?>
                                                                        / <?php echo e(number_format($cancelparcel_amount,2)); ?>

                                                                    <?php endif; ?>
                                                                </span>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="<?php echo e(url('merchant/parcels?parcel_type=hold')); ?>">
                                            <div class="card card-animate bg-success">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Hold</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span>
                                                                <?php echo e($totalhold); ?>

                                                                <?php if($total_hold_count_amount): ?>
                                                                    / <?php echo e(number_format($total_hold_count_amount,2)); ?>

                                                                <?php endif; ?>
                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Partial Return
                                                            </p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                    class="counter-value"
                                                                    data-target="<?php echo e($total_partial_return); ?>"><?php echo e($total_partial_return); ?>

                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                    class="counter-value"
                                                                    data-target="<?php echo e($totalamount); ?>">
                                                                    <?php echo e($totalamount); ?>

                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Paid Amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                    class="counter-value"
                                                                    data-target="<?php echo e($total_paid); ?>"><?php echo e($total_paid); ?>

                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 col-md-6">
                                        <a href="">
                                            <div class="card card-animate bg-primary">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <p class="fw-medium text-white-50 mb-0">Total Unpaid amount</p>
                                                            <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                    class="counter-value"
                                                                    data-target="<?php echo e($total_unpaid); ?>"><?php echo e($total_unpaid); ?>

                                                            </h2>
                                                        </div>
                                                        <div>
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span
                                                                    class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-clock text-white">
                                                                        <circle cx="12" cy="12"
                                                                            r="10">
                                                                        </circle>
                                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </a>
                                    </div>
                                </div> <!-- end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya\resources\views/frontend/pages/merchant/dashboard/home.blade.php ENDPATH**/ ?>