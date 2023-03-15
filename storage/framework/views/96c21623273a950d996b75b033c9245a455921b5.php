
<?php $__env->startSection('title', 'Merchant Update'); ?>
<?php $__env->startSection('custom-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Merchant Update</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Merchant</a></li>
                        <li class="breadcrumb-item active">Merchant Update</li>
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
                    <h4>Merchant Update</h4>
                    <br>
                    <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form role="form" action="<?php echo e(route('merchant.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row gy-4">
                                        <input type="hidden" value="<?php echo e($merchantInfo->id); ?>" name="hidden_id">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="companyName">Company Name</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('companyName') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e($merchantInfo->companyName); ?>" id="companyName"
                                                    name="companyName" placeholder="Company name"
                                                    data-error="Please enter company name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="trade_license_no">Trade License No.</label>
                                                <input type="text" placeholder="Trade License No" id="trade_licence_no"
                                                    class="form-control <?php echo e($errors->has('trade_licence_no') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('trade_licence_no')); ?>" name="trade_licence_no">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" placeholder="Website" id="website"
                                                    class="form-control <?php echo e($errors->has('website') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('website', $merchantInfo->website)); ?>" name="website">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pickup_thana">Select Pickup Thana *</label>
                                                <select name="pickup_thana_id" id="pickup_thana_id"
                                                    class="form-control select2" >
                                                    <option value=""> Select pickup thana * </option>
                                                    <?php $__currentLoopData = $thanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($thana->id); ?>"
                                                            <?php if(old('pickup_thana_id', $merchantInfo->pickup_thana_id) == $thana->id): ?> selected <?php endif; ?>>
                                                            <?php echo e($thana->name); ?>

                                                            (<?php echo e($thana->district->name ?? ''); ?>)
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pickLocation">Pickup location *</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('pickLocation') ? ' is-invalid' : ''); ?>"
                                                    id="pickLocation" name="pickLocation"
                                                    value="<?php echo e(old('pickLocation', $merchantInfo->pickLocation)); ?>"
                                                    placeholder="Pickup location"
                                                    data-error="Please enter your pick location" >
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pickup Reference</label>
                                                <select type="text" name="pickupPreference" class="form-control select2">
                                                    <option value="1"
                                                        <?php if(old('pickupPreference', $merchantInfo->pickupPreference) == 1): ?> selected <?php endif; ?>>
                                                        As per request</option>
                                                    <option value="2"
                                                        <?php if(old('pickupPreference', $merchantInfo->pickupPreference) == 2): ?> selected <?php endif; ?>>
                                                        Daily
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="facebook_page">Facebook Page</label>
                                                <input type="text" placeholder="Facebook page" id="facebook_page"
                                                    class="form-control <?php echo e($errors->has('facebook_page') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('facebook_page', $merchantInfo->facebook_page)); ?>"
                                                    name="facebook_page">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4>Personal Information</h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="firstName"
                                                    value="<?php echo e($merchantInfo->firstName); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Mobile No</label>
                                                <input type="text" name="phoneNumber"
                                                    value="0<?php echo e($merchantInfo->phoneNumber); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""> Father Name </label>
                                                <input type="text" placeholder="Fathers name" id="fathers_name"
                                                    class="form-control <?php echo e($errors->has('fathers_name') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('fathers_name')); ?>" name="fathers_name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""> Mother Name </label>
                                                <input type="text" placeholder="Mothers name" id="mothers_name"
                                                    class="form-control <?php echo e($errors->has('mothers_name') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('mothers_name')); ?>" name="mothers_name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="text" name="email" value="<?php echo e($merchantInfo->emailAddress); ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Comission (%)</label>
                                                <input type="number" step="any" name="del_commission"
                                                    value="<?php echo e($merchantInfo->del_commission); ?>" class="form-control">
                                            </div>
                                        </div>
                                          <input type="hidden" step="any" name="fixed_charge" value="0" class="form-control" placeholder="70">
                                        <input type="hidden" step="any" name="cod_commission"
                                             value="0" class="form-control">
















                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Inside City Package</label>
                                                <select name="inside_city" class="form-control select2">
                                                    <option value="">Select Package</option>
                                                    <?php $__currentLoopData = $inside_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($dp->id); ?>"
                                                            <?php echo e($dp->id == $merchantInfo->inside_city ? 'Selected' : ''); ?>>
                                                            <?php echo e($dp->package_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City sub Package</label>
                                                <select name="sub_city" class="form-control select2">
                                                    <option value="">Select Package</option>
                                                    <?php $__currentLoopData = $sub_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($dp->id); ?>"
                                                            <?php echo e($dp->id == $merchantInfo->sub_city ? 'Selected' : ''); ?>>
                                                            <?php echo e($dp->package_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Outside City</label>
                                                <select name="outside_city" class="form-control select2">
                                                    <option value="">Select Package</option>
                                                    <?php $__currentLoopData = $outside_city; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($dp->id); ?>"
                                                            <?php echo e($dp->id == $merchantInfo->outside_city ? 'Selected' : ''); ?>>
                                                            <?php echo e($dp->package_name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-12 mt-5">
                                            <p> <b>NID/ Birth Certificate No/ Driving License No.</b> <span
                                                    class="text-danger">*</span> </p>
                                            <div class="row gy-4">
                                                <div class="col-md-12">
                                                    <div class="row gy-4">
                                                        <div class="col-md-12">
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input identification_type"
                                                                    type="radio" id="nid"
                                                                    name="identification_type" value="1"
                                                                    <?php if(old('identification_type', $merchantInfo->identification_type) == 1): ?> checked <?php endif; ?>>
                                                                <label class="form-check-label" for="nid">
                                                                    NID </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input identification_type"
                                                                    type="radio" id="birth_certificate"
                                                                    name="identification_type" value="2"
                                                                    <?php if(old('identification_type', $merchantInfo->identification_type) == 2): ?> checked <?php endif; ?>>
                                                                <label class="form-check-label" for="birth_certificate">
                                                                    Birth Certificate </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <input class="form-check-input identification_type"
                                                                    type="radio" id="driving_licence"
                                                                    name="identification_type" value="3"
                                                                    <?php if(old('identification_type', $merchantInfo->identification_type) == 3): ?> checked <?php endif; ?>>
                                                                <label class="form-check-label" for="driving_licence">
                                                                    Driving License </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12 nid_part">
                                                                    <div
                                                                        class="form-group <?php echo e($errors->has('nidnumber') ? ' is-invalid' : ''); ?>">
                                                                        <input class="form-control" type="text"
                                                                            name="nidnumber"
                                                                            value="<?php echo e(old('nidnumber', $merchantInfo->nidnumber)); ?>"
                                                                            placeholder="NID No.">
                                                                        <?php if($errors->has('nidnumber')): ?>
                                                                            <span class="invalid-feedback">
                                                                                <strong><?php echo e($errors->first('nidnumber')); ?></strong>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 nid_part">
                                                                    <div
                                                                        class="form-group <?php echo e($errors->has('nid_photo') ? ' is-invalid' : ''); ?>">
                                                                        <label for="nid_photo"> NID Front Photo
                                                                            <!--<span-->
                                                                            <!--        class="text-danger">*</span> -->
                                                                            <small>
                                                                                Size (324x204)</small>
                                                                        </label>
                                                                        <input class="form-control" type="file"
                                                                            name="nid_photo" id="nid_photo"
                                                                            accept="image/*">

                                                                        <?php if($errors->has('nid_photo')): ?>
                                                                            <span class="invalid-feedback">
                                                                                <strong><?php echo e($errors->first('nid_photo')); ?></strong>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div>
                                                                        <img id="nid_photo_show"
                                                                            src="<?php echo e(asset($merchantInfo->nid_photo)); ?>"
                                                                            alt="NID Photo">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 nid_part">
                                                                    <div
                                                                        class="form-group <?php echo e($errors->has('nid_photo_back') ? ' is-invalid' : ''); ?>">
                                                                        <label for="nid_photo_back"> NID Second Photo
                                                                            <!--<span class="text-danger">*</span>-->
                                                                            <small>
                                                                                Size (324x204)</small>
                                                                        </label>
                                                                        <input class="form-control" type="file"
                                                                            name="nid_photo_back" id="nid_photo_back"
                                                                            accept="image/*">

                                                                        <?php if($errors->has('nid_photo_back')): ?>
                                                                            <span class="invalid-feedback">
                                                                                <strong><?php echo e($errors->first('nid_photo_back')); ?></strong>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div>
                                                                        <img id="nid_photo_back_show"
                                                                            src="<?php echo e(asset($merchantInfo->nid_photo_back)); ?>"
                                                                            alt="NID Photo Back">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 birth_certificate_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group <?php echo e($errors->has('birth_certificate_no') ? ' is-invalid' : ''); ?>">
                                                                        <input class="form-control" type="text"
                                                                            name="birth_certificate_no"
                                                                            value="<?php echo e(old('birth_certificate_no', $merchantInfo->birth_certificate_no)); ?>"
                                                                            placeholder="Birth Certificate No.">

                                                                        <?php if($errors->has('birth_certificate_no')): ?>
                                                                            <span class="invalid-feedback">
                                                                                <strong><?php echo e($errors->first('birth_certificate_no')); ?></strong>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 birth_certificate_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group <?php echo e($errors->has('birth_certificate_photo') ? ' is-invalid' : ''); ?>">
                                                                        <label for=""> Birth Certificate Photo<span
                                                                                class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="birth_certificate_photo"
                                                                            id="birth_certificate_photo" accept="image/*">

                                                                        <?php if($errors->has('birth_certificate_photo')): ?>
                                                                            <span class="invalid-feedback">
                                                                                <strong><?php echo e($errors->first('birth_certificate_photo')); ?></strong>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div>
                                                                        <img id="birth_certificate_photo_show"
                                                                            src="<?php echo e(asset($merchantInfo->birth_certificate_photo)); ?>"
                                                                            alt="Birth certificate photo">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 driving_licence_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group <?php echo e($errors->has('driving_licence_no') ? ' is-invalid' : ''); ?>">
                                                                        <input class="form-control" type="text"
                                                                            name="driving_licence_no"
                                                                            value="<?php echo e(old('driving_licence_no', $merchantInfo->driving_licence_no)); ?>"
                                                                            placeholder="Driving License No.">

                                                                        <?php if($errors->has('driving_licence_no')): ?>
                                                                            <span class="invalid-feedback">
                                                                                <strong><?php echo e($errors->first('driving_licence_no')); ?></strong>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 driving_licence_part"
                                                                    style="display: none;">
                                                                    <div
                                                                        class="form-group <?php echo e($errors->has('driving_licence_photo') ? ' is-invalid' : ''); ?>">
                                                                        <label for=""> Driving License Photo<span
                                                                                class="text-danger">*</span> <small>
                                                                                Size (324x204)</small> </label>
                                                                        <input class="form-control" type="file"
                                                                            name="driving_licence_photo"
                                                                            id="driving_licence_photo" accept="image/*">

                                                                        <?php if($errors->has('driving_licence_photo')): ?>
                                                                            <span class="invalid-feedback">
                                                                                <strong><?php echo e($errors->first('driving_licence_photo')); ?></strong>
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div>
                                                                        <img id="driving_licence_photo_show"
                                                                            src="<?php echo e(asset($merchantInfo->driving_licence_photo)); ?>"
                                                                            alt="Driving licence photo">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                    value="<?php echo e(old('division_id')); ?>" >
                                                    <option value="">Division</option>
                                                    <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($division->id); ?>"
                                                            <?php if(old('division_id', $merchantInfo->division_id) == $division->id): ?> selected <?php endif; ?>>
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
                                                <label for="district_id">District<span class="text-danger">*</span>
                                                </label>
                                                <select name="district_id" id="district_id" class="form-control select2">
                                                    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($district->id); ?>"
                                                            <?php if(old('district_id', $merchantInfo->district_id) == $district->id): ?> selected <?php endif; ?>>
                                                            <?php echo e($district->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="thana_id">Thana</label>
                                                <select name="thana_id" id="thana_id" class="form-control select2">
                                                    <option value="">Select Thana</option>
                                                    <?php $__currentLoopData = $thanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thana): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($thana->id); ?>"
                                                            <?php if(old('thana_id', $merchantInfo->thana_id) == $thana->id): ?> selected <?php endif; ?>>
                                                            <?php echo e($thana->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                                    value="<?php echo e(old('present_address', $merchantInfo->present_address)); ?>"
                                                    placeholder="Present Address"
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
                                                    value="<?php echo e(old('permanent_address', $merchantInfo->permanent_address)); ?>"
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
                                                    value="<?php echo e(old('password')); ?>" name="password"
                                                    data-error="Please enter your Password">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" placeholder="Confirm Password" id="confirmed"
                                                    class="form-control <?php echo e($errors->has('confirmed') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('confirmed')); ?>" name="confirmed"
                                                    data-error="Please enter your Confirm Password">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="paymentMethod">Payment Method</label>
                                            <select name="paymentMethod" id="paymentMethod"
                                                class="custom-select form-control <?php echo e($errors->has('paymentMethod') ? ' is-invalid' : ''); ?>"
                                                value="<?php echo e(old('paymentMethod')); ?>" placeholder="Payment Method ">
                                                <option value=""><?php echo app('translator')->get('common.payment_mode'); ?> </option>
                                                <option value="1" <?php if($merchantInfo->paymentMethod == 1): ?> selected <?php endif; ?>>
                                                    Bank
                                                </option>
                                                <option value="2" <?php if($merchantInfo->paymentMethod == 2): ?> selected <?php endif; ?>>
                                                    Bkash
                                                    <?php if($merchantInfo->bkashNumber): ?>
                                                       ( 0<?php echo e($merchantInfo->bkashNumber); ?> )
                                                    <?php endif; ?>
                                                </option>
                                                <option value="3" <?php if($merchantInfo->paymentMethod == 3): ?> selected <?php endif; ?>>
                                                    Nagad
                                                    <?php if($merchantInfo->nogodNumber): ?>
                                                        ( 0<?php echo e($merchantInfo->nogodNumber); ?> )
                                                    <?php endif; ?>
                                                </option>
                                                <option value="4" <?php if($merchantInfo->paymentMethod == 4): ?> selected <?php endif; ?>>
                                                    Cash</option>
                                                <option value="5" <?php if($merchantInfo->paymentMethod == 5): ?> selected <?php endif; ?>>
                                                    Others</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('bank_name') ? ' is-invalid' : ''); ?>"
                                                    id="bank_name"
                                                    value="<?php echo e(old('bank_name', $merchantInfo->nameOfBank)); ?>"
                                                    name="bank_name" placeholder="Bank Name"
                                                    data-error="Please enter your bank name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="branch_name">Branch Name</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('branch_name') ? ' is-invalid' : ''); ?>"
                                                    id="branch_name"
                                                    value="<?php echo e(old('branch_name', $merchantInfo->bankBranch)); ?>"
                                                    name="branch_name" placeholder="Branch Name"
                                                    data-error="Please enter your branch name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="Accoun">Account Holder Name</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('ac_holder_name') ? ' is-invalid' : ''); ?>"
                                                    id="ac_holder_name"
                                                    value="<?php echo e(old('ac_holder_name', $merchantInfo->bankAcHolder)); ?>"
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
                                                    id="bank_ac_no"
                                                    value="<?php echo e(old('bank_ac_no', $merchantInfo->bankAcNo)); ?>"
                                                    name="bank_ac_no" placeholder="Bank account no"
                                                    data-error="Please enter your bank account no.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bkash_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="bkashNumber">Bkash Number</label>
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('bkashNumber') ? ' is-invalid' : ''); ?>"
                                                    id="bkashNumber"
                                                    value=" 0<?php echo e(old('bkashNumber', $merchantInfo->bkashNumber)); ?>"
                                                    name="bkashNumber" placeholder="Enter bkash number"
                                                    data-error="Please enter your bkash number">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 nagad_info" style="display: none;">
                                            <label for="Nagad">Nagad Number</label>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control <?php echo e($errors->has('nogodNumber') ? ' is-invalid' : ''); ?>"
                                                    id="nogodNumber"
                                                    value=" 0<?php echo e(old('nogodNumber', $merchantInfo->nogodNumber)); ?>"
                                                    name="nogodNumber" placeholder="Enter Nagad Number"
                                                    data-error="Please enter your nagad number">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input class="" type="radio" id="active" name="status"
                                                value="1" <?php if(old('status', $merchantInfo->status) == 1): ?> checked <?php endif; ?>>
                                            <label for="active">Active</label>
                                            <?php if($errors->has('status')): ?>
                                                <span class="invalid-feedback">
                                                    <strong><?php echo e($errors->first('status')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                            <input class="" type="radio" name="status" value="0"
                                                <?php if(old('status', $merchantInfo->status) == 0): ?> checked <?php endif; ?>>
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
                            <button type="submit" class="btn btn-primary">Update merchant</button>
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
                var selected = '<?php echo e(old('area_id', $merchantInfo->area_id)); ?>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_thana_areas_final')); ?>",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    console.log(response);
                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#area_id').html(options);
                });
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/sensorbd/public_html/resources/views/backend/pages/superadmin/merchants/edit.blade.php ENDPATH**/ ?>