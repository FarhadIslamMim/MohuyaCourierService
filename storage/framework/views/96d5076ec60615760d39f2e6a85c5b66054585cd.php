
<?php $__env->startSection('title', 'Agent Create'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <style>

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Data Entry Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Entry</a></li>
                        <li class="breadcrumb-item active">Data Entry Create</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel create content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Agent Create</h4>
                    <br>
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form role="form" action="<?php echo e(route('agent.store')); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Agent Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name"
                                            class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('name')); ?>" required>
                                        <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <!-- column end -->
                                
                                <!-- column end -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Mobile No. <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="phone" id="phone"
                                            class="form-control <?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('phone')); ?>" required>
                                        <?php if($errors->has('phone')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('phone')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                

                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="designation">Per Parcel Amount</label>
                                        <input type="text" name="per_percel_amount" id="per_percel_amount"
                                            class="form-control <?php echo e($errors->has('per_percel_amount') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('per_percel_amount')); ?>">
                                        <?php if($errors->has('per_percel_amount')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('per_percel_amount')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address"> Address </label>
                                        <input type="text" name="address" id="address"
                                            class="form-control <?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('address')); ?>" autocomplete="new-address">
                                        <?php if($errors->has('address')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('address')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                
                                
                                

                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password"
                                            class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('password')); ?>" autocomplete="new-password" required>
                                        <?php if($errors->has('password')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="confirm"> Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="confirm" id="confirm"
                                            class="form-control <?php echo e($errors->has('confirm') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('confirm')); ?>" autocomplete="new-password" required>
                                        <?php if($errors->has('confirm')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('confirm')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="custom-label">
                                            <label> Status </label>
                                        </div>
                                        <div class="box-body pub-stat display-inline">
                                            <input class="" type="radio" id="active" name="status"
                                                value="1" <?php if(old('status', 1) == 1): ?> checked <?php endif; ?>>
                                            <label for="active">Active</label>
                                            <?php if($errors->has('status')): ?>
                                                <span class="invalid-feedback">
                                                    <strong><?php echo e($errors->first('status')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="box-body pub-stat display-inline">
                                            <input class="" type="radio" name="status" value="0"
                                                <?php if(old('status', 1) == 0): ?> checked <?php endif; ?>>
                                            <label for="inactive">Inactive</label>
                                            <?php if($errors->has('status')): ?>
                                                <span class="invalid-feedback">
                                                    <strong><?php echo e($errors->first('status')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create Data Entry</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        $(function() {
            $('.multi_select2').select2({
                closeOnSelect: false,
            });
            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_division_districts')); ?>",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#district_id').html(options);
                });
            })
            // Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value=""> Select thana </option>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_district_thanas')); ?>",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#thana_id').html(options);
                });
            })
            // Get Area
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_thana_areas')); ?>",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#area_id').html(options);
                });
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/agents/create.blade.php ENDPATH**/ ?>