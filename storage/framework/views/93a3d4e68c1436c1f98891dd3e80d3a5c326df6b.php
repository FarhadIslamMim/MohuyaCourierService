
<?php $__env->startSection('title', 'Profile'); ?>
<?php $__env->startSection('custom-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <div class="container-fluid">
        <div class="profile-foreground position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg">
                <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
            </div>
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="avatar-lg">
                        <img src="<?php echo e(asset($deliveryman->image)); ?>" alt="user-img" class="img-thumbnail rounded-circle" />
                    </div>
                </div>
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1"><?php echo e($deliveryman->name); ?></h3>
                        <p class="text-white-75">Deliveryman</p>
                        <div class="hstack text-white-50 gap-1">
                            <div class="me-2"><i
                                    class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i><?php echo e($deliveryman->present_address); ?>

                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->

            </div>
            <!--end row-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="d-flex">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Overview</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Educations</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab">
                                    <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Working Experience</span>
                                </a>
                            </li>
                        </ul>
                        <div class="flex-shrink-0">
                            <a href="<?php echo e(route('deliveryman.edit', $deliveryman->id)); ?>" class="btn btn-success"><i
                                    class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane active" id="overview-tab" role="tabpanel">
                            <div class="row">
                                <div class="col-xxl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Info</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Full Name :</th>
                                                            <td class="text-muted"><?php echo e($deliveryman->name); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Mobile :</th>
                                                            <td class="text-muted"><?php echo e($deliveryman->phone); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">E-mail :</th>
                                                            <td class="text-muted"><?php echo e($deliveryman->email); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Location :</th>
                                                            <td class="text-muted"><?php echo e($deliveryman->present_address); ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Joining Date</th>
                                                            <td class="text-muted">
                                                                <?php echo e(date('d-m-Y', strtotime($deliveryman->created_at))); ?>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->



                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">Agents</h5>
                                            <div class="d-flex flex-wrap gap-2 fs-15">
                                                <?php $__currentLoopData = $deliveryman->agentDetails() ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span class="badge badge-soft-success"><?php echo e($agent->name); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->



                                </div>
                                <!--end col-->
                                <div class="col-xxl-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Assigned Areas</h4>
                                        </div>
                                        <div class="card-body">

                                            <?php $__currentLoopData = $deliveryman->areaDetails(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="badge badge-soft-success"><?php echo e($area->name); ?></span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <div class="tab-pane fade" id="activities" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Educations</h5>
                                    <?php if(count($deliveryman->educations) > 0): ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-left"> Exam Name</th>
                                                    <th class="text-left"> Group Name </th>
                                                    <th class="text-left"> GPA </th>
                                                    <th class="text-left"> Passing Year </th>
                                                    <th class="text-left"> Board </th>
                                                </tr>
                                            </thead>
                                            <tbody id="education_container">
                                                <?php $__currentLoopData = $deliveryman->educations ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="education_item">
                                                        <td class="text-left">
                                                            <?php echo e($education->exam_name); ?>

                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo e($education->group); ?>

                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo e($education->gpa); ?>

                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo e($education->year); ?>

                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo e($education->board); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <div class="alert alert-info">
                                            <p>Education is empty</p>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="projects" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Experience</h5>
                                    <?php if(count($deliveryman->experiences) > 0): ?>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-left"> Company Name</th>
                                                    <th class="text-left"> Designation</th>
                                                    <th class="text-left"> Date from </th>
                                                    <th class="text-left"> Date to </th>
                                                </tr>
                                            </thead>
                                            <tbody id="education_container">
                                                <?php $__currentLoopData = $deliveryman->experiences ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="education_item">
                                                        <td class="text-left">
                                                            <?php echo e($experience->company_name); ?>

                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo e($experience->designation); ?>

                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo e($experience->start_date); ?>

                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo e($experience->end_date); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <div class="alert alert-info">
                                            <p>Experience is empty</p>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end tab-pane-->

                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/deliveryman/view.blade.php ENDPATH**/ ?>