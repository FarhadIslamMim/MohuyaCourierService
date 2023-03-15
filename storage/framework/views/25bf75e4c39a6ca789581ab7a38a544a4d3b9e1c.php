
<?php $__env->startSection('title', 'Pickupman Manage'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Pickupman Manage</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pickupman</a></li>
                        <li class="breadcrumb-item active">Pickupman Manage</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Pickupman Manage content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Pickupman Manage</h3>
                </div>
                <div class="card-body">
                    <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Mobile No</th>
                            <th>Agents</th>
                            <th>Per percel amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $show_datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($value->name); ?></td>
                                    <td><?php echo e($value->email); ?></td>
                                    <td><?php echo e($value->phone); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $value->agents ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $item->agentDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($item2): ?>
                                                    <span class="badge badge-outline-success">
                                                        <?php echo e($item2->name ?? ''); ?></span>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($value->per_parcel_amount); ?></td>
                                    <td>
                                        <?php if($value->status == 1): ?>
                                            Active
                                        <?php else: ?>
                                            <?php echo app('translator')->get('common.inactive'); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Group Buttons Sizing -->
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a class="btn btn-primary" href="<?php echo e(route('pickupman.show', $value->id)); ?>"
                                                title="Details"><i class="la la-eye"></i></a>
                                            <a class="btn btn-primary" href="<?php echo e(route('pickupman.edit', $value->id)); ?>"><i
                                                    class="la la-edit"></i></a>
                                            

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
    <!-- Pickupman Manage content end -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <?php echo $__env->make('backend.layouts.datatable_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/pickupman/manage.blade.php ENDPATH**/ ?>