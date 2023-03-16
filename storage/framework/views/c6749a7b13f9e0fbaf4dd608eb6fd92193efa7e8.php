
<?php $__env->startSection('title', 'Agent Create'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000 !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000 !important;
        }

        .select2-results__option:before {
            content: "";
            display: inline-block;
            position: relative;
            height: 20px;
            width: 20px;
            border: 2px solid #e9e9e9;
            border-radius: 4px;
            background-color: #fff;
            margin-right: 20px;
            vertical-align: middle;
        }

        .select2-results__option[aria-selected=true]:before {
            font-family: fontAwesome;
            content: "✓";
            color: #fff;
            background-color: #5897FB;
            border: 0;
            display: inline-block;
            padding-left: 3px;
        }

        .select2-container .select2-selection--multiple {
            height: 150px !important;
            margin: 0;
            padding: 0;
            line-height: inherit;
            border-radius: 0;
            overflow: scroll;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Agent Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Agent</a></li>
                        <li class="breadcrumb-item active">Agent Create</li>
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
                    <h4>Agent Update</h4>
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
                    <form role="form" action="<?php echo e(route('agent.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-sm-6">
                                    <input type="hidden" value="<?php echo e($edit_data->id); ?>" name="hidden_id">

                                    <div class="form-group">
                                        <label for="name">Agent Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" id="name"
                                            class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('name', $edit_data->name)); ?>" required>
                                        <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <!-- column end -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email address </label>
                                        <input type="email" name="email" id="email"
                                            class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('email', $edit_data->email)); ?>">
                                        <?php if($errors->has('email')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Mobile No. <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="phone" id="phone"
                                            class="form-control <?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('phone', $edit_data->phone)); ?>" required>
                                        <?php if($errors->has('phone')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('phone')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="alternative_phone"> Alternative Mobile No.</label>
                                        <input type="text" name="alternative_phone" id="alternative_phone"
                                            class="form-control <?php echo e($errors->has('alternative_phone') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('alternative_phone', $edit_data->alternative_phone)); ?>">
                                        <?php if($errors->has('alternative_phone')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('alternative_phone')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                

                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="designation">Per Parcel Amount</label>
                                        <input type="text" name="per_percel_amount" id="per_percel_amount"
                                            class="form-control <?php echo e($errors->has('per_percel_amount') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e($edit_data->per_percel_amount); ?>">
                                        <?php if($errors->has('per_percel_amount')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('per_percel_amount')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                

                                
                                
                                

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="address"> Address </label>
                                        <input type="text" name="address" id="address"
                                            class="form-control <?php echo e($errors->has('address') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('address', $edit_data->address)); ?>" autocomplete="new-address">
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
                                            value="<?php echo e(old('password')); ?>" autocomplete="new-password">
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
                                            value="<?php echo e(old('confirm')); ?>" autocomplete="new-password">
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
                            <button type="submit" class="btn btn-primary">Update Agent</button>
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
                var selected = '<?php echo e(old('district_id', $edit_data->district_id)); ?>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_division_districts')); ?>",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    response.forEach(function(item, i) {
                        if (item.id == selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#district_id').html(options);
                    $('#district_id').trigger('change');
                });
            })
            $('#division_id').trigger('change');

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
                    console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#thana_id').html(options);
                    $('#thana_id').trigger('change');
                });
            })
            // Get Area
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                var selected = <?php echo json_encode($thana_ids); ?>;

                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_thana_areas')); ?>",
                    data: {
                        'district_id': district_id,
                    },
                }).done(function(response) {
                    console.log("response " + response);
                    response.forEach(function(item, i) {

                        if (jQuery.inArray(item.id, selected) != '-1') {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                });
            })
            $('#thana_id').trigger('change');
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/agents/edit.blade.php ENDPATH**/ ?>