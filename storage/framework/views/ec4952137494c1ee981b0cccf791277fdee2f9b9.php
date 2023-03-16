
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
                                <h3>Welcome, <?php echo e($agentInfo->name); ?></h3>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="stats-reportList-inner">
                                            <div class="row">
                                                <div class="col-xl-3 col-md-6">
                                                    <a href="<?php echo e(route('agent.today.percel')); ?>">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today Parcel
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailyparcel); ?>"><?php echo e($dailyparcel); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="<?php echo e(route('agent.today.percel')); ?>?parcel_type=pending">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today
                                                                            Pending
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailypending); ?>"><?php echo e($dailypending); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="<?php echo e(route('agent.today.percel')); ?>?parcel_type=picked">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today Picked
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailypicked); ?>"><?php echo e($dailypicked); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a
                                                        href="<?php echo e(route('agent.today.percel')); ?>?parcel_type=in-transit">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today In
                                                                            Transit
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailyintransit); ?>"><?php echo e($dailyintransit); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="<?php echo e(route('agent.today.percel')); ?>?parcel_type=hold">
                                                        <div class="card card-animate bg-warning">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today Hold
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailyhold); ?>"><?php echo e($dailyhold); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a
                                                        href="<?php echo e(route('agent.today.percel')); ?>?parcel_type=deliverd">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today
                                                                            Delivered
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailydelivered); ?>"><?php echo e($dailydelivered); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a
                                                        href="<?php echo e(route('agent.today.percel')); ?>?parcel_type=return-pending">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today
                                                                            Return to Pending
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailyreturnpending); ?>"><?php echo e($dailyreturnpending); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a
                                                        href="<?php echo e(route('agent.today.percel')); ?>?parcel_type=return-to-hub">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today
                                                                            Return to Hub
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailyreturntohub); ?>"><?php echo e($dailyreturntohub); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end card body -->
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-xl-3 col-md-3">
                                                    <a
                                                        href="<?php echo e(route('agent.today.percel')); ?>?parcel_type=return-to-merchant">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <small>
                                                                            <p class="fw-medium text-white-50 mb-0">Today
                                                                                retrun to
                                                                                merchant</p>
                                                                        </small>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($dailyreturntomarchant); ?>"><?php echo e($dailyreturntomarchant); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="javascript:void()">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today
                                                                            Partial Return
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($daily_partial_return); ?>"><?php echo e($daily_partial_return); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="javascript:void()">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Today
                                                                            Amount
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($today_amount); ?>"><?php echo e($today_amount); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="javascript:void()">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Paid/Unpaid
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <?php echo e($total_paid); ?> / <?php echo e($total_due); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                        <!-- dashboard payment -->

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Total Parcel Details</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="stats-reportList-inner">
                                            <div class="row">
                                                <div class="col-xl-3 col-md-6">
                                                    <a href="">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total
                                                                            Parcel</p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($totalparcel); ?>"><?php echo e($totalparcel); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="?parcel_type=pending">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total
                                                                            Pending
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($totalpending); ?>"><?php echo e($totalpending); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="?parcel_type=picked">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total
                                                                            Picked
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($totalpicked); ?>"><?php echo e($totalpicked); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="?parcel_type=in-transit">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total In
                                                                            Transit
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($totaltransit); ?>"><?php echo e($totaltransit); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="?parcel_type=hold">
                                                        <div class="card card-animate bg-warning">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total Hold
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($totalhold); ?>"><?php echo e($totalhold); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="?parcel_type=deliverd">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total
                                                                            Delivered
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($totaldelivery); ?>"><?php echo e($totaldelivery); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a
                                                        href="?parcel_type=return-pending">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total
                                                                            Return to Pending
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($returnpendin); ?>"><?php echo e($returnpendin); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a
                                                        href="?parcel_type=return-to-hub">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total
                                                                            Return to Hub
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($returnhub); ?>"><?php echo e($returnhub); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end card body -->
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-xl-3 col-md-3">
                                                    <a
                                                        href="?parcel_type=return-to-merchant">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <small>
                                                                            <p class="fw-medium text-white-50 mb-0">Total
                                                                                retrun to
                                                                                merchant</p>
                                                                        </small>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($returnmerchant); ?>"><?php echo e($returnmerchant); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="javascript:void()">
                                                        <div class="card card-animate bg-success">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total
                                                                            Partial Return
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($daily_partial_return); ?>"><?php echo e($daily_partial_return); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="javascript:void()">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Total
                                                                            Amount
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <span class="counter-value"
                                                                                data-target="<?php echo e($total_amount); ?>"><?php echo e($total_amount); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                                    <a href="javascript:void()">
                                                        <div class="card card-animate bg-primary">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <div>
                                                                        <p class="fw-medium text-white-50 mb-0">Paid/Unpaid
                                                                        </p>
                                                                        <h2
                                                                            class="mt-4 ff-secondary fw-semibold text-white">
                                                                            <?php echo e($total_paid); ?> / <?php echo e($total_due); ?>

                                                                        </h2>
                                                                    </div>
                                                                    <div>
                                                                        <div class="avatar-sm flex-shrink-0">
                                                                            <span
                                                                                class="avatar-title bg-soft-light rounded-circle fs-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor" stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-clock text-white">
                                                                                    <circle cx="12" cy="12"
                                                                                        r="10">
                                                                                    </circle>
                                                                                    <polyline points="12 6 12 12 16 14">
                                                                                    </polyline>
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
                                        <!-- dashboard payment -->

                                    </div>
                                </div>
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

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/pages/agent/dashboard/home.blade.php ENDPATH**/ ?>