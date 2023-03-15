
<?php $__env->startSection('title', 'Delivery Charge'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Delivery Charge</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Delivery Charge</a></li>
                        <li class="breadcrumb-item active">Manage</li>
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
                    <div class="">
                        <h3>Delivery Charge Manage</h3>
                    </div>
                    <div class="text-end">
                        <a href="<?php echo e(route('dc.create')); ?>" class="btn btn-success">Delivery Charge Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <table id="example1" class="table table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Delivery Charge Head</th>
                                <th>Delivery Charge</th>
                                <th>Extra Delivery Charge</th>
                                <th>COD (%) </th>
                                <th>Return Chage (%) </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $show_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <?php echo e($value->deliveryChargeHead->name ?? ''); ?>

                                        (<?php echo e($value->deliveryChargeHead->service_time ?? ''); ?>)
                                    </td>
                                    <td><?php echo e($value->deliverycharge); ?></td>
                                    <td><?php echo e($value->extradeliverycharge); ?></td>
                                    <td><?php echo e($value->cod_charge); ?> % </td>
                                    <td><?php echo e($value->return_charge ?? 0); ?> % </td>
                                    <td><?php echo e($value->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success btn-sm" href="<?php echo e(route('dc.edit', $value->id)); ?>"
                                                title="Edit"><i class="las la-edit"></i></a>
                                            <a class="btn btn-info btn-sm"
                                                onclick="return confirm('Are you delete this this?')"
                                                href="<?php echo e(route('dc.delete', $value->id)); ?>" title="Delete"><i
                                                    class="las la-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tfoot>
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

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/sensorbd/public_html/resources/views/backend/pages/superadmin/deliverycharge/deliverycharge.blade.php ENDPATH**/ ?>