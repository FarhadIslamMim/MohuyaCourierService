
<?php $__env->startSection('title', 'Merchant Create'); ?>
<?php $__env->startSection('custom-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Merchant Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Merchant</a></li>
                        <li class="breadcrumb-item active">Merchant Create</li>
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
                    <h4>Merchant Create</h4>
                    <br>
                    <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form role="form" action="<?php echo e(route('merchant.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="companyName">Company Name</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('companyName') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('companyName')); ?>" id="companyName" name="companyName"
                                                    placeholder="Company name" required
                                                    data-error="Please enter company name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">Name</label>

                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('firstName') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('firstName')); ?>" id="firstName" name="firstName"
                                                    placeholder="Name" required data-error="Please enter your Name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">Phone Number</label>
                                                <input type="text" placeholder="Phone Number*" id="phoneNumber"
                                                    class="form-control <?php echo e($errors->has('phoneNumber') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('phoneNumber')); ?>" name="phoneNumber" required
                                                    data-error="Please enter your Phone *">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emailAddress">Email Address</label>
                                                <input type="text" placeholder="Email Address" id="emailAddress"
                                                    class="form-control <?php echo e($errors->has('emailAddress') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('emailAddress')); ?>" name="emailAddress"
                                                    data-error="Please enter your email">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        <div class="col-md-12">
                                            
                                            
                                                

                                                
                                                
                                                
                                                
                                                
                                                    
                                                </div>
                                                <div class="col-md-12 driving_licence_part" style="display: none;">
                                                    <div
                                                        class="form-group <?php echo e($errors->has('driving_licence_no') ? ' is-invalid' : ''); ?>">
                                                        <input class="form-control" type="text"
                                                            name="driving_licence_no"
                                                            value="<?php echo e(old('driving_licence_no')); ?>"
                                                            placeholder="Driving License">

                                                        <?php if($errors->has('driving_licence_no')): ?>
                                                            <span class="invalid-feedback">
                                                                <strong><?php echo e($errors->first('driving_licence_no')); ?></strong>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 driving_licence_part" style="display: none;">
                                                    <div
                                                        class="form-group <?php echo e($errors->has('driving_licence_photo') ? ' is-invalid' : ''); ?>">
                                                        <label for=""> Driving License Photo <span
                                                                class="text-danger">*</span> <small> Size
                                                                (324x204)</small> </label>
                                                        <input class="form-control" type="file"
                                                            name="driving_licence_photo" id="driving_licence_photo"
                                                            accept="image/*">

                                                        <?php if($errors->has('driving_licence_photo')): ?>
                                                            <span class="invalid-feedback">
                                                                <strong><?php echo e($errors->first('driving_licence_photo')); ?></strong>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <img width="324px" id="driving_licence_photo_show"
                                                            src="<?php echo e(asset('public/no_image.jpg')); ?>"
                                                            alt="Driving licence photo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="division_id"> Division <span class="text-danger">*</span>
                                                </label>
                                                <select name="division_id" id="division_id"
                                                    class="form-control select2 <?php echo e($errors->has('division_id') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('division_id')); ?>" required>
                                                    <option value="">Division</option>

                                                    <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($division->id); ?>"><?php echo e($division->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <div></div>
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
                                                <label for="district_id">District<span class="text-danger">*</span>
                                                </label>
                                                <select name="district_id" id="district_id" class="form-control select2"
                                                    required>
                                                    <option value="">Selcect District </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="thana_id">Thana</label>
                                                <select name="thana_id" id="thana_id" class="form-control select2">
                                                    <option value="">Select Thana</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="area_id">Area</label>
                                                <select name="area_id" id="area_id" class="form-control select2">
                                                    <option value="">Area</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="present_addres">Present Address</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('present_address') ? ' is-invalid' : ''); ?>"
                                                    id="present_address" name="present_address"
                                                    value="<?php echo e(old('present_address')); ?>" placeholder="Present Address"
                                                    data-error="Please enter your present address">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address">Permanent Address</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('permanent_address') ? ' is-invalid' : ''); ?>"
                                                    id="permanent_address" name="permanent_address"
                                                    value="<?php echo e(old('permanent_address')); ?>"
                                                    placeholder="Permanent Address"
                                                    data-error="Please enter your permanent address">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password *</label>
                                                <input type="password" placeholder="Password" id="password"
                                                    class="form-control <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('password')); ?>" name="password" required
                                                    data-error="Please enter your Password">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" placeholder="Confirm Password" id="confirmed"
                                                    class="form-control <?php echo e($errors->has('confirmed') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('confirmed')); ?>" name="confirmed" required
                                                    data-error="Please enter your Confirm Password">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="paymentMethod">Payment Method</label>
                                            <select name="paymentMethod" id="paymentMethod"
                                                class="custom-select form-control <?php echo e($errors->has('paymentMethod') ? ' is-invalid' : ''); ?>"
                                                value="<?php echo e(old('paymentMethod')); ?>" placeholder="Payment Method ">
                                                <option value="" selected>Payment Method </option>
                                                <option value="1">Bank</option>
                                                <option value="2">Bkash</option>
                                                <option value="3">Nagad</option>
                                                <option value="4">Cash</option>
                                                <option value="5">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('bank_name') ? ' is-invalid' : ''); ?>"
                                                    id="bank_name" value="<?php echo e(old('bank_name')); ?>" name="bank_name"
                                                    placeholder="Bank Name" data-error="Please enter your bank name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="branch_name">Branch Name</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('branch_name') ? ' is-invalid' : ''); ?>"
                                                    id="branch_name" value="<?php echo e(old('branch_name')); ?>" name="branch_name"
                                                    placeholder="Branch Name" data-error="Please enter your branch name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="Accoun">Account Holder Name</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('ac_holder_name') ? ' is-invalid' : ''); ?>"
                                                    id="ac_holder_name" value="<?php echo e(old('ac_holder_name')); ?>"
                                                    name="ac_holder_name" placeholder="Account holder name"
                                                    data-error="Please enter your A/C Holder name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="Bank">Bank Account Number</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('bank_ac_no') ? ' is-invalid' : ''); ?>"
                                                    id="bank_ac_no" value="<?php echo e(old('bank_ac_no')); ?>" name="bank_ac_no"
                                                    placeholder="Bank account no"
                                                    data-error="Please enter your bank account no.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bkash_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="bkashNumber">Bkash Number</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('bkashNumber') ? ' is-invalid' : ''); ?>"
                                                    id="bkashNumber" value="<?php echo e(old('bkashNumber')); ?>" name="bkashNumber"
                                                    placeholder="Enter bkash number"
                                                    data-error="Please enter your bkash number">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 nagad_info" style="display: none;">
                                            <label for="Nagad">Nagad Number</label>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('nogodNumber') ? ' is-invalid' : ''); ?>"
                                                    id="nogodNumber" value="<?php echo e(old('nogodNumber')); ?>" name="nogodNumber"
                                                    placeholder="Enter Nagad Number"
                                                    data-error="Please enter your nagad number">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create new merchant</button>
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
        // NID Photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#nid_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#nid_photo").change(function() {
                readURL(this);
            });
        })
        // NID Photo Back Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#nid_photo_back_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#nid_photo_back").change(function() {
                readURL(this);
            });
        })
        // Birth certificate photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#birth_certificate_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#birth_certificate_photo").change(function() {
                readURL(this);
            });
        })
        // Driving licence photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#driving_licence_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#driving_licence_photo").change(function() {
                readURL(this);
            });
        })
    </script>
    <script>
        $(function() {
            $('body').on('click', '.identification_type', function() {
                var identification_type = $('input[name="identification_type"]:checked').val();
                if (identification_type == 1) {
                    $('.nid_part').show();
                    $('.birth_certificate_part').hide();
                    $('.driving_licence_part').hide();
                } else if (identification_type == 2) {
                    $('.nid_part').hide();
                    $('.birth_certificate_part').show();
                    $('.driving_licence_part').hide();
                } else {
                    $('.nid_part').hide();
                    $('.birth_certificate_part').hide();
                    $('.driving_licence_part').show();
                }
            })

            $('body').on('change', '#paymentMethod', function() {
                var paymentMethod = $('#paymentMethod').val();
                if (paymentMethod == 1) {
                    $('.bank_info').show();
                    $('.bkash_info').hide();
                    $('.nagad_info').hide();
                } else if (paymentMethod == 2) {
                    $('.bank_info').hide();
                    $('.bkash_info').show();
                    $('.nagad_info').hide();
                } else if (paymentMethod == 3) {
                    $('.bank_info').hide();
                    $('.bkash_info').hide();
                    $('.nagad_info').show();
                } else {
                    $('.bank_info').hide();
                    $('.bkash_info').hide();
                    $('.nagad_info').hide();
                }
            })

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
                    $('#thana_id').trigger('change');
                });
            })
            // Get Area
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_thana_areas_final')); ?>",
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

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/merchants/create.blade.php ENDPATH**/ ?>