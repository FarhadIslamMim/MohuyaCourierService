
<?php $__env->startSection('title', 'Users Management'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users Management</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $show_datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($value->name); ?></td>
                                    <td><?php echo e($value->email); ?></td>
                                    <td><?php echo e($value->phone); ?></td>
                                    <td><?php echo e($value->status == 1 ? 'Active' : 'Inactive'); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_edit')): ?>
                                            <?php if($value->status == 1): ?>
                                                <form action="<?php echo e(url('superadmin/user/inactive')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="hidden_id" value="<?php echo e($value->id); ?>">
                                                    <button type="submit" class="btn btn-primary" title="unpublished"><i
                                                            class="la la-thumbs-up"></i></button>
                                                </form>
                                            <?php else: ?>
                                                <form action="<?php echo e(url('superadmin/user/active')); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="hidden_id" value="<?php echo e($value->id); ?>">
                                                    <button type="submit" class="btn btn-success" title="published"><i
                                                            class="la la-thumbs-down"></i></button>
                                                </form>
                                            <?php endif; ?>

                                            <a class="btn btn-info" href="<?php echo e(route('users.edit',$value->id)); ?>"
                                                title="Edit"><i class="la la-edit"></i></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_delete')): ?>
                                            <form action="<?php echo e(url('superadmin/user/delete')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="hidden_id" value="<?php echo e($value->id); ?>">
                                                <button type="submit" onclick="return confirm('Are you delete this this?')"
                                                    class="btn btn-danger" title="Delete"><i
                                                        class="la la-trash"></i></button>
                                            </form>
                                        <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/users/users.blade.php ENDPATH**/ ?>