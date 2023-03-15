
<?php $__env->startSection('title', 'Divisions'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Divisions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Divisions</a></li>
                        <li class="breadcrumb-item active">Divisions</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Divisions Create</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('division.store')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="form-group">
                            <!-- Buttons Input -->
                            <div class="input-group">
                                <button class="btn btn-primary" type="submit" id="button-addon1">Add Division</button>
                                <input type="text" name="name" class="form-control" placeholder="Division name">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Divisions List -->
            <div class="card">
                <div class="card-body">
                    <h4>All Division List</h4>
                    <table id="datatable" class="table table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                    <td><?php echo e($division->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($division->created_at)->diffForHumans()); ?></td>
                                    <td>
                                        <!-- Dropdown Variant -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="mdi mdi-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php echo e(route('division.edit',$division->id)); ?>"><i class=" bx bx-edit-alt"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="<?php echo e(route('division.delete',$division->id)); ?>"><i class=" bx bx-trash"></i>
                                                    Delete</a>
                                            </div>
                                        </div><!-- /btn-group -->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <?php echo $__env->make('backend.layouts.datatable_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function () {
            $("#datatable").DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/areas/division/division.blade.php ENDPATH**/ ?>