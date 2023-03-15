
<?php $__env->startSection('title', 'Merchant Manage'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Merchant Manage</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Merchant</a></li>
                        <li class="breadcrumb-item active">Merchant Manage</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Merchant Manage content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Merchant Manage</h3>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Mobile No</th>
                                <th>Email Address</th>
                                <th>Commission</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($value->firstName); ?> <?php echo e($value->lastName); ?></td>
                                    <td><?php echo e($value->companyName); ?></td>
                                    <td>0<?php echo e($value->phoneNumber); ?></td>
                                    <td><?php echo e($value->emailAddress); ?></td>
                                    <td><?php echo e(number_format($value->del_commission)); ?> % </td>
                                    <td class="text-nowrap">
                                        <?php if($value->bkashNumber): ?>
                                        <b>Bkash:</b> 0<?php echo e($value->bkashNumber); ?>

                                        <?php elseif($value->nogodNumber): ?>
                                        <b>Nagad:</b> 0<?php echo e($value->nogodNumber); ?>

                                        <?php elseif($value->nameOfBank): ?>
                                        <b>Bank Info :</b><br>
                                        <b>Bank Name:</b> <?php echo e($value->nameOfBank); ?><br>
                                        <b>Branch Name:</b> <?php echo e($value->bankBranch); ?><br>
                                        <b>Account Name:</b> <?php echo e($value->bankAcHolder); ?><br>
                                        <b>AC Number:</b><?php echo e($value->bankAcNo); ?><br>
                                        <?php else: ?>
                                            Cash
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($value->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                    <td>
                                        <ul class="action_buttons dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">Actions
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                
                                                <li>
                                                    <a class="dropdown-item thumbs_up"
                                                        href="<?php echo e(route('merchant.edit',$value->id)); ?>"
                                                        title="Edit"><i class="la la-edit"> </i> Edit</a>
                                                </li>
                                                





                                                <li>
                                                    <a class="dropdown-item edit_icon"
                                                        href="<?php echo e(url('superadmin/report/merchant?merchant_id='. $value->id)); ?>"
                                                        title="View"><i class="la la-list"></i> Reports</a>
                                                </li>
                                            </ul>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Merchant Manage content end -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <?php echo $__env->make('backend.layouts.datatable_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/sensorbd/public_html/resources/views/backend/pages/superadmin/merchants/merchants.blade.php ENDPATH**/ ?>