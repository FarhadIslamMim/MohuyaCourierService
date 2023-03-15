
<?php $__env->startSection('title', 'Site Setting'); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Site Setting</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Site Settings</a>
                        </li>
                        <li class="breadcrumb-item active">Site Setting</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Site Settings</h4>
            </div>
            <div class="card-body">
                <form role="form" action="<?php echo e(route('site.settings.update')); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="box-content">
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Setting Information</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="name"> Company Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="<?php echo e(old('name', $setting->name ?? '')); ?>">
                                                    <?php if($errors->has('name')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('name')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> Mobile No.</label>
                                                    <input type="text" name="mobile_no" id="mobile_no"
                                                        value="<?php echo e(old('mobile_no', $setting->mobile_no ?? '')); ?>"
                                                        class="form-control">
                                                    <?php if($errors->has('mobile_no')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('mobile_no')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> Email Address</label>
                                                    <input type="text" name="email" id="email"
                                                        value="<?php echo e(old('email', $setting->email ?? '')); ?>"
                                                        class="form-control">
                                                    <?php if($errors->has('email')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> Website </label>
                                                    <input type="text" name="web" id="web"
                                                        value="<?php echo e(old('web', $setting->web ?? '')); ?>" class="form-control">
                                                    <?php if($errors->has('web')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('web')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> Address </label>
                                                    <textarea name="address" id="address" class="form-control" rows="5"><?php echo old('address', $setting->address ?? ''); ?></textarea>
                                                    <?php if($errors->has('address')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('address')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> Address Bangla </label>
                                                    <textarea name="address_bn" id="address_bn" class="form-control" rows="5"><?php echo old('address_bn', $setting->address_bn ?? ''); ?></textarea>
                                                    <?php if($errors->has('address_bn')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('address_bn')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name"> Delivery Amount Show? </label>
                                                    <select name="delivery_charge_amount_show" id=""
                                                        class="form-control select2">
                                                        <option
                                                            <?= $setting->delivery_charge_amount_show == 1 ? "selected='selected'" : '' ?>
                                                            value="1"> Show </option>
                                                        <option
                                                            <?= $setting->delivery_charge_amount_show == 0 ? "selected='selected'" : '' ?>
                                                            value="0"> Hide </option>
                                                    </select>
                                                    <?php if($errors->has('delivery_charge_amount_show')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('delivery_charge_amount_show')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="box-content">
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Logo </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    
                                                    <?php if($setting->logo): ?>
                                                        <div class="logo">
                                                            <img src="<?php echo e(asset($setting->logo)); ?>" height="100"
                                                                width="100" alt="Logo">
                                                        </div>
                                                    <?php endif; ?>

                                                    <input type="file" name="logo" id="logo" value=""
                                                        class="form-control">
                                                    <?php if($errors->has('logo')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('logo')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content">
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Social Information </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mt-2">
                                                    <label for="name"> Facebook </label>
                                                    <input type="text" name="facebook" id="facebook"
                                                        value="<?php echo e(old('facebook', $setting->facebook ?? '')); ?>"
                                                        class="form-control">
                                                    <?php if($errors->has('facebook')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('facebook')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="name"> Twitter </label>
                                                    <input type="text" name="twitter" id="twitter"
                                                        value="<?php echo e(old('twitter', $setting->twitter ?? '')); ?>"
                                                        class="form-control">
                                                    <?php if($errors->has('twitter')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('twitter')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="name">Google Plus </label>
                                                    <input type="text" name="google_plus" id="google_plus"
                                                        value="<?php echo e(old('google_plus', $setting->google_plus ?? '')); ?>"
                                                        class="form-control">
                                                    <?php if($errors->has('google_plus')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('google_plus')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="name"> Instagram </label>
                                                    <input type="text" name="instagram" id="instagram"
                                                        value="<?php echo e(old('instagram', $setting->instagram ?? '')); ?>"
                                                        class="form-control">
                                                    <?php if($errors->has('instagram')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('instagram')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="name"> Tracking Prefix </label>
                                                    <input type="text" name="tracking_prefix" id="tracking_prefix"
                                                        value="<?php echo e(old('tracking_prefix', $setting->tracking_prefix ?? '')); ?>"
                                                        class="form-control">
                                                    <?php if($errors->has('instagram')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($errors->first('tracking_prefix')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="box-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/settings/sitesettings.blade.php ENDPATH**/ ?>