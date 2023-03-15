
<?php $__env->startSection('title', 'Deliveryman Manage'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        #reqtablenew > tr:hover{
            /*background-color: #abcaab;*/
        }
        .row_active{
            background-color: #aba9a9;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Deliveryman Manage</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Deliveryman</a></li>
                        <li class="breadcrumb-item active">Deliveryman Manage</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Deliveryman Manage content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Deliveryman Manage</h3>
                </div>
                <div class="card-body">
                    <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Mobile No</th>
                                <th>Agents</th>
                                <th>Parcel Weight</th>
                                <th>Extra Amount</th>
                                <th>Per parcel amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="reqtablenew">
                                <?php $__currentLoopData = $show_datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($value->name); ?></td>
                                        <td><?php echo e($value->email); ?></td>
                                        <td><?php echo e($value->phone); ?></td>
                                        <td>
                                            <?php $__currentLoopData = $value->agents ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $item->agentDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <span class="badge badge-outline-success"> <?php echo e($item2->name ?? ""); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td><?php echo e($value->max_weight ?? 0); ?> kg</td>
                                        <td><?php echo e($value->extra_weight_charge ?? 0); ?> tk</td>
                                        <td><?php echo e($value->per_parcel_amount ?? 0); ?> tk</td>
                                        <td>
                                            <?php if($value->status == 1): ?>
                                                Active
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.inactive'); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <!-- Group Buttons Sizing -->
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="<?php echo e(route('deliveryman.show', $value->id)); ?>" title="Details"><i
                                                        class="la la-eye"></i></a>
                                                <a class="btn btn-primary" href="<?php echo e(route('deliveryman.edit', $value->id)); ?>" title="Edit"><i
                                                        class="la la-edit"></i></a>
                                                <a href="<?php echo e(route('deliveryman.delete', $value->id)); ?>"
                                                    onclick="return confirm('Are you delete this this?')"
                                                    class="btn btn-danger"><i class="la la-trash"></i></a>

                                            </div>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deliveryman Manage content end -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <?php echo $__env->make('backend.layouts.datatable_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#reqtablenew tr').click(function () {
                $('#reqtablenew tr').removeClass("row_active");
                $(this).addClass("row_active");
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/deliveryman/manage.blade.php ENDPATH**/ ?>