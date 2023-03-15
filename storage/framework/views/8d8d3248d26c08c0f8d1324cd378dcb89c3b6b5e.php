
<?php $__env->startSection('title', 'Deliveryman Update'); ?>
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
                <h4 class="mb-sm-0">Deliveryman Update</h4>
                
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Deliveryman</a></li>
                        <li class="breadcrumb-item active">Deliveryman Update</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel Update content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Deliveryman Update</h4>
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
                    <form role="form" action="<?php echo e(route('deliveryman.update')); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="row gy-4">
                                        <input type="hidden" name="hidden_id" value="<?php echo e($edit_data->id); ?>">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Deliveryman name <span class="text-danger">*</span>
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
                                                    value="<?php echo e(old('name', $edit_data->email)); ?>">
                                                <?php if($errors->has('email')): ?>
                                                    <span class="invalid-feedback">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="phone">Mobile No.<span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="phone" id="phone"
                                                    class="form-control <?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('name', $edit_data->phone)); ?>" required>
                                                <?php if($errors->has('phone')): ?>
                                                    <span class="invalid-feedback">
                                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        

                                        

                                        

                                        

                                        


                                        

                                        

                                        

                                        
                                        
                                        

                                        

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="per_parcel_amount">Per parcel amount <span class="text-danger">*</span></label>
                                                <input type="number" name="per_parcel_amount" id="per_parcel_amount"
                                                    class="form-control <?php echo e($errors->has('per_parcel_amount') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('per_parcel_amount', $edit_data->per_parcel_amount)); ?>" required>
                                                <?php if($errors->has('per_parcel_amount')): ?>
                                                    <span class="invalid-feedback">
                                                        <strong><?php echo e($errors->first('per_parcel_amount')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="gross_salary">Gross Salary</label>
                                                <input type="number" name="gross_salary" id="gross_salary"
                                                    class="form-control <?php echo e($errors->has('gross_salary') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('gross_salary', $edit_data->gross_salary)); ?>">
                                                <?php if($errors->has('gross_salary')): ?>
                                                    <span class="invalid-feedback">
                                                        <strong><?php echo e($errors->first('gross_salary')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="gross_salary">Included Max Weight <span class="text-danger">*</span></label>
                                                <select name="max_weight" class="form-control select2" >
                                                    <option value="" selected disabled>Select Max Weight</option>
                                                    <option value="1" <?php echo e(($edit_data->max_weight === '1') ? 'Selected' : ''); ?>>Max 1 Kg</option>
                                                    <option value="2" <?php echo e(($edit_data->max_weight === '2') ? 'Selected' : ''); ?>>Max 2 Kg</option>
                                                    <option value="3" <?php echo e(($edit_data->max_weight === '3') ? 'Selected' : ''); ?>>Max 3 Kg</option>
                                                    <option value="4" <?php echo e(($edit_data->max_weight === '4') ? 'Selected' : ''); ?>>Max 4 Kg</option>
                                                    <option value="5" <?php echo e(($edit_data->max_weight === '5') ? 'Selected' : ''); ?>>Max 5 Kg</option>
                                                    <option value="6" <?php echo e(($edit_data->max_weight === '6') ? 'Selected' : ''); ?>>Max 6 Kg</option>
                                                    <option value="7" <?php echo e(($edit_data->max_weight === '7') ? 'Selected' : ''); ?>>Max 7 Kg</option>
                                                    <option value="8" <?php echo e(($edit_data->max_weight === '8') ? 'Selected' : ''); ?>>Max 8 Kg</option>
                                                    <option value="9" <?php echo e(($edit_data->max_weight === '9') ? 'Selected' : ''); ?>>Max 9 Kg</option>
                                                    <option value="10" <?php echo e(($edit_data->max_weight === '10') ? 'Selected' : ''); ?>>Max 10 Kg</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="gross_salary">Extra Price <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control"  value="<?php echo e($edit_data->extra_weight_charge ?? 0); ?>" placeholder="price" name="extra_weight_charge">
                                            </div>
                                        </div>
                                        

                                        

                                        
                                        
                                        
                                        
                                        
                                        <div class="table-reponsive">
                                            
                                            <div class="table-responsive">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title"> Others Information </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row gy-4">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="division_id"> Division <span
                                                                            class="text-danger">*</span> </label>
                                                                    <select name="division_id" id="division_id"
                                                                        class="form-control select2 <?php echo e($errors->has('division_id') ? ' is-invalid' : ''); ?>"
                                                                        value="<?php echo e(old('division_id')); ?>" required>
                                                                        <option value="">Select Division</option>
                                                                        <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($division->id); ?>"
                                                                                <?php if(old('division_id', $edit_data->division_id) == $division->id): ?> selected <?php endif; ?>>
                                                                                <?php echo e($division->name); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                    <?php if($errors->has('division_id')): ?>
                                                                        <span class="invalid-feedback">
                                                                            <strong><?php echo e($errors->first('division_id')); ?></strong>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="district_id">District<span
                                                                            class="text-danger">*</span> </label>

                                                                    <select name="district_id" id="district_id"
                                                                        class="form-control select2 <?php echo e($errors->has('district_id') ? ' is-invalid' : ''); ?>"
                                                                        value="<?php echo e(old('district_id')); ?>" required>
                                                                        <option value="">Select Division</option>
                                                                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($district->id); ?>"
                                                                                <?php if(old('district_id', $edit_data->district_id) == $district->id): ?> selected <?php endif; ?>>
                                                                                <?php echo e($district->name); ?>

                                                                            </option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="agent_id">Agent<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <select data-choices name="agent_id[]" id="agent_id"
                                                                        class="form-control multi_select2"
                                                                        data-type="select-multiple" data-choices-removeItem
                                                                        multiple required>
                                                                        <option value="">Agent Select</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="area_id"> Area <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <select name="area_id[]" id="area_id"
                                                                        class="form-control multi_select2" multiple
                                                                        required>
                                                                        <option value="">Select Area</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="password">Password <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="password" name="password" id="password"
                                                                        class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                                                        value="" autocomplete="new-password">
                                                                    <?php if($errors->has('password')): ?>
                                                                        <span class="invalid-feedback">
                                                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="confirm"> Confirm Password <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="password" name="confirm" id="confirm"
                                                                        class="form-control <?php echo e($errors->has('confirm') ? ' is-invalid' : ''); ?>"
                                                                        value="" autocomplete="new-password">
                                                                    <?php if($errors->has('confirm')): ?>
                                                                        <span class="invalid-feedback">
                                                                            <strong><?php echo e($errors->first('confirm')); ?></strong>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <div class="custom-label">
                                                                                <label> Status <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="box-body pub-stat display-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" id="active"
                                                                                    name="status" value="1"
                                                                                    <?php if(old('status', $edit_data->status) == 1): ?> checked <?php endif; ?>>
                                                                                <label for="active">Active</label>
                                                                                <?php if($errors->has('status')): ?>
                                                                                    <span class="invalid-feedback">
                                                                                        <strong><?php echo e($errors->first('status')); ?></strong>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="box-body pub-stat display-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="status"
                                                                                    value="0" id="inactive"
                                                                                    <?php if(old('status', $edit_data->status) == 0): ?> checked <?php endif; ?>>
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

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="image"> Deliveryman Photo <span class="text-danger">*</span>
                                        </label>
                                        <div>
                                            <img src="<?php echo e(asset($edit_data->image)); ?>" id="image_show" alt="Photo"
                                                width="100" height="100">
                                        </div>
                                        <br>
                                        <br>
                                        <input type="file" name="image" id="image"
                                            class="form-control <?php echo e($errors->has('image') ? ' is-invalid' : ''); ?>"
                                            value="<?php echo e(old('image')); ?>">
                                        <?php if($errors->has('image')): ?>
                                            <span class="invalid-feedback">
                                                <strong><?php echo e($errors->first('image')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Deliveryman</button>
                        </div>
                    </form>


                    
                    <template id="template_education">
                        <tr class="education_item">
                            <td class="text-left">
                                <input type="text" name="exam_name[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="group[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="gpa[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="year[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="board[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <button type="button" class="btn btn-sm btn-danger remove_education">x</button>
                            </td>
                        </tr>
                    </template>
                    <template id="template_experience">
                        <tr class="experience_item">
                            <td class="text-left">
                                <input type="text" name="company_name[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="designations[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="date" name="start_date[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="date" name="end_date[]" class="form-control">
                            </td>
                            <td class="text-left">
                                <button type="button" class="btn btn-sm btn-danger remove_experience">x</button>
                            </td>
                        </tr>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <!-- percel Update content end -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        $(function() {

            $('.multi_select2').select2({
                closeOnSelect: true,
            });

            // Education part
            $('body').on('click', '.add_education', function() {
                var html = $('#template_education').html();
                $('#education_container').append(html);
            });

            $('body').on('click', '.remove_education', function() {
                $(this).closest('.education_item').remove();
                // if ($('.education_item').length <= 1 ) {
                //     $('.remove_education').hide();
                // }
            });

            // Experience Part
            $('body').on('click', '.add_experience', function() {
                var html = $('#template_experience').html();
                $('#experience_container').append(html);
            });

            $('body').on('click', '.remove_experience', function() {
                $(this).closest('.experience_item').remove();
                // if ($('.experience_item').length <= 1 ) {
                //     $('.remove_experience').hide();
                // }
            });

            $('#agent_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#agent_id > option").prop("selected", "selected");
                    $("#agent_id").trigger("change");
                }
            });

            $('#area_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#area_id > option").prop("selected", "selected");
                    $("#area_id").trigger("change");
                }
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
                var options = '<option value="" class="agent_list">All</option>';
                var selected = <?php echo json_encode($agent_id); ?>;
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_district_agents')); ?>",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    response.forEach(function(item, i) {
                        if (jQuery.inArray(item.id, selected) != '-1') {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' - ' + item.phone + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' - ' + item.phone + ' </option>';
                        }
                    });
                    $('#agent_id').html(options);
                    $('#agent_id').trigger('change');
                });
            });

            $('body').on('change', '#agent_id', function() {
                var agent_id = $('#agent_id').val();
                var options = '<option value="" class="area_list">All</option>';
                var selected = <?php echo json_encode($area_id); ?>;
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_agent_areas')); ?>",
                    data: {
                        'agent_id': agent_id
                    },
                }).done(function(response) {
                    response.forEach(function(item, i) {
                        if (jQuery.inArray(item.id, selected) != '-1') {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' (' + item.thana.name + ') </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' (' + item.thana.name + ') </option>';
                        }
                    });
                    $('#area_id').html(options);
                });

            });
        })

        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/deliveryman/edit.blade.php ENDPATH**/ ?>