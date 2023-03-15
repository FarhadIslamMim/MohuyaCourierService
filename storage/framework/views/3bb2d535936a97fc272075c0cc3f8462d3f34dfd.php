
<?php $__env->startSection('title', 'Packages'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Packages</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel</a></li>
                        <li class="breadcrumb-item active">Packages</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Package content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Packages</h3>
                    <a href="<?php echo e(route('dcp.create')); ?>" class="btn btn-success">Create New Package</a>
                    <br>
                    <br>
                    <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>Delivery Head</th>
                                <th>Assigned Areas</th>
                                <th>Delivery Charge</th>
                                <th>COD Charge</th>
                                <th>Extra Delivery Charge</th>
                                <th>Return Charge</th>
                                <th>Weights Excluded</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $delivery_package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($dp->package_name); ?></td>
                                    <td><?php echo e($dp->getDeliveryHead->name); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $dp->getDeliveryAreas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge badge-soft-primary">
                                                <?php echo e($item->getThanas->name ?? ''); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $dp->getDistricts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge badge-soft-primary">
                                                <?php echo e($district->getDistricts->name ?? ''); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($dp->delivery_charge); ?></td>
                                    <td><?php echo e($dp->cod_charge); ?></td>
                                    <td><?php echo e($dp->extra_delivery_charge); ?></td>
                                    <td><?php echo e($dp->return_charge); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $dp->getWeights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge badge-soft-danger">
                                                <?php echo e($weight->weight_id); ?> Kg,
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            
                                            <a href="<?php echo e(route('dcp.delete', $dp->id)); ?>" class="btn btn-primary"><i
                                                    class="las la-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Package content end -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <?php echo $__env->make('backend.layouts.datatable_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/package/package.blade.php ENDPATH**/ ?>