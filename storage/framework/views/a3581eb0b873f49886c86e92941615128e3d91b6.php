
<?php $__env->startSection('title', 'Percel Edit'); ?>
<?php $__env->startSection('custom-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Percel Edit</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Percel</a></li>
                        <li class="breadcrumb-item active">Percel Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel create content start -->
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4>Percel Edit</h4>
                    <br>
                    <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <form role="form" action="<?php echo e(route('percel.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <input type="hidden" name="hidden_id" value="<?php echo e($edit_data->id); ?>">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row gy-4">
                                        <div class="col-xxl-6 col-md-6">
                                            <div class="form-group">
                                                <label for="merchantId">Merchant <span class="text-danger"> *</span></label>
                                                <select class="form-control select2" value="<?php echo e(old('merchantId')); ?>"
                                                    name="merchantId" id="merchantId">
                                                    <option value="">Select Merchant</option>
                                                    <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($value->id); ?>"
                                                            <?php if(old('merchantId', $edit_data->merchantId) == $value->id): ?> selected <?php endif; ?>>
                                                            <?php echo e($value->companyName); ?>

                                                            (<?php echo e($value->phoneNumber); ?>)
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <?php if($errors->has('merchantId')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('merchantId')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-md-6">
                                            <div class="form-group">
                                                <label for="weight_id">Weight<span class="text-danger">*</span></label>
                                                <select
                                                    class="form-control select2 weight_id <?php echo e($errors->has('weight_id') ? ' is-invalid' : ''); ?>"
                                                    value="<?php echo e(old('weight_id')); ?>" name="weight_id" id="weight_id">
                                                    

                                                    <?php $__currentLoopData = $weights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($weight->id); ?>"
                                                            <?php if(old('weight_id', $edit_data->weight->id ?? '') == $weight->id): ?> selected <?php endif; ?>>
                                                            <?php echo e($weight->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <?php if($errors->has('merchantId')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('merchantId')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-md-6">
                                            <div class="form-group">
                                                <div>
                                                    <label for="invoiceNo">Invoice no<span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" step="any" class="form-control invoiceNo"
                                                        id="invoiceNo" name="invoiceNo"
                                                        value="<?php echo e(old('invoiceNo', $edit_data->invoiceNo)); ?>"
                                                        placeholder="000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-6 col-md-6">
                                            <div class="form-group">
                                                <div>
                                                    <label for="productPrice">Cash Collection <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" step="any" class="form-control productPrice"
                                                        id="productPrice" name="cod"
                                                        value="<?php echo e(old('productPrice', $edit_data->cod)); ?>"
                                                        placeholder="Enter delivery Charge Collection">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- form group -->
                                        <div class="col-xxl-6 col-md-6">
                                            <label for="name"> Customer Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                value="<?php echo e(old('name', $edit_data->recipientName)); ?>" name="name"
                                                id="name" placeholder="Recipient Name" required>
                                            <?php if($errors->has('name')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-xxl-6 col-md-6">
                                            <label for="phonenumber">Mobile No. <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                class="form-control <?php echo e($errors->has('phonenumber') ? ' is-invalid' : ''); ?>"
                                                value="<?php echo e(old('phonenumber', $edit_data->recipientPhone)); ?>"
                                                name="phonenumber" id="phonenumber" placeholder="Phone Number" required>
                                            <?php if($errors->has('phonenumber')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('phonenumber')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-xxl-6 col-md-6">
                                            <label for="alternative_mobile_no">Alternavtive Mobile No.</label>
                                            <input type="text"
                                                class="form-control <?php echo e($errors->has('alternative_mobile_no') ? ' is-invalid' : ''); ?>"
                                                value="<?php echo e(old('alternative_mobile_no', $edit_data->alternative_mobile_no)); ?>"
                                                name="alternative_mobile_no" id="alternative_mobile_no"
                                                placeholder="Alternative mobile no">
                                            <?php if($errors->has('alternative_mobile_no')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('alternative_mobile_no')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>



                                
                                        
                                        <div class="col-sm-12">
                                            <div>
                                                <label><input type="radio" name="colorRadio" value="inCityDhaka"
                                                        checked="checked"> Inside Dhaka</label>
                                                <label><input type="radio" name="colorRadio" value="outCityDhaka"> Out
                                                    Side Dhaka</label>

                                            </div>
                                        </div>



                                        <div class="row outCityDhaka box" style=" display: none;">
                                            <div class="col-sm-6 ">
                                                <div class="form-group">
                                                    <label for="">Division</label>


                                                    <select name="division_id" class="form-control select2 division_id"
                                                        id="division_id" required>
                                                        <option value="">Division *</option>
                                                        <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($division->id); ?>"
                                                                <?php if(old('division_id') == $division->id): ?> selected <?php endif; ?>>
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
                                            <div class="col-sm-6 ">
                                                <label for="">District</label>

                                                <div class="form-group">
                                                    <select name="district_id" class="form-control select2 district_id"
                                                        id="district_id" required>
                                                        <option value="">District *</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <label for="">Thana (Upazila)</label>

                                                <div class="form-group">
                                                    <select name="thana_id" class="form-control select2 thana_id"
                                                        id="thana_id" required>
                                                        <option value="">Thana (Upazila) </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <label for="">Area</label>

                                                <div class="form-group">
                                                    <select name="area_id" class="form-control select2 area_id"
                                                        id="area_id">
                                                        <option value="">Area </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Delivery Address</label>

                                                <textarea type="text" name="delivery_address" id="delivery_address" value="<?php echo e(old('delivery_address')); ?>"
                                                    class="form-control" placeholder="Delivery Address" rows="4"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-md-6">
                                            <label for="note">Note (maximum 300
                                                characters)</label>
                                            <textarea rows="4" type="text" class="form-control <?php echo e($errors->has('note') ? ' is-invalid' : ''); ?>"
                                                value="<?php echo e(old('note', $edit_data->note)); ?>" name="note" placeholder="Note Optional"><?php echo e(old('note')); ?></textarea>
                                            <?php if($errors->has('note')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('note')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Picked By</label>

                                            <div class="form-group">
                                                <select name="pickedBy" class="form-control select2 pickedBy"
                                                    id="pickedBy">
                                                    <option value="">Picked By</option>
                                                    <?php $__currentLoopData = $pickup_man; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pickup_man): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($pickup_man->id); ?>"
                                                        <?php if(old('pickup_man') == $pickup_man->id): ?> selected <?php endif; ?>>
                                                        <?php echo e($pickup_man->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Delivery By</label>

                                            <div class="form-group">
                                                <select name="deliveryBy" class="form-control select2 deliveryBy"
                                                    id="deliveryBy">
                                                    <option value="">Delivery By</option>

                                                    <?php $__currentLoopData = $delivery_man; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery_man): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($delivery_man->id); ?>"
                                                        <?php if(old('delivery_man') == $delivery_man->id): ?> selected <?php endif; ?>>
                                                        <?php echo e($delivery_man->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>
                                            </div>
                                        </div>




                                        
                                        <!-- form group -->
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Percel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <!-- Rounded Ribbon -->
            <div class="card ribbon-box border shadow-none mb-lg-0">
                <div class="card-body">
                    <div class="ribbon ribbon-primary round-shape">Cost Summary</div>
                    <h5 class="fs-14 text-end">Total Cost for the percel</h5>
                    <div class="ribbon-content mt-4 text-muted">
                        <table class="table table-bordered">
                            <tr>
                                <th>Delivery Charge</th>
                                <td class="text-right">
                                    <span class="delivery_charge"> <?php echo e($edit_data->deliveryCharge); ?> </span> tk.
                                </td>
                            </tr>
                            <tr>
                                <th>COD Charge</th>
                                <td class="text-right">
                                    <span class="cod_charge"> 0.00 </span> tk.
                                </td>
                            </tr>
                            <tr>
                                <th>Total Charge</th>
                                <th class="text-right">
                                    <span class="total_charge"> <?php echo e($edit_data->deliveryCharge); ?> </span> tk.
                                </th>
                            </tr>
                            <tr>
                                <th>Pay to merchant</th>
                                <th class="text-right">
                                    <span class="total_cash_collection">
                                        <?php echo e($edit_data->cod - ($edit_data->deliveryCharge + $edit_data->codCharge)); ?>

                                    </span>
                                    tk.
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        $(function() {
            $('body').on('change paste keyup',
                '.productPrice, #total_charge_input, .weight_id, #thana_id, #merchantId',
                function() {
                    getparcelCharge();
                })

            $('body').on('change paste keyup', '#total_charge_input', function() {

                var charge = $(this).val();
                $('.delivery_charge').html(charge);
                $('.cod_charge').html();
                $('.total_charge').html(charge);
            })

            function getparcelCharge() {
                // console.log(weight_id)
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var division_id = $('#division_id').val();
                var district_id = $('#district_id').val();
                var thana_id = $('#thana_id').val();
                var merchantId = $('#merchantId').val();
                // var deliveryCharge = $('#total_charge_input').val();

                console.log(weight_id);
                if (weight_id && productPrice && thana_id && merchantId) {
                    $.ajax({
                        method: "GET",
                        url: "<?php echo e(route('cost.calculator')); ?>",
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'division_id': division_id,
                            'district_id': district_id,
                            'thana_id': thana_id,
                            'merchantId': merchantId,
                            // 'deliveryCharge': deliveryCharge,
                        },
                    }).done(function(response) {
                        console.log(response);
                        if (response.success) {
                            $('.delivery_charge').html(response.pdeliverycharge)
                            $('.cod_charge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                            $('.total_charge_input').html(response.pdeliverycharge)
                            $('.total_cash_collection').html(response.pay_to_merchant)
                        } else {
                            // alert(response.message);
                            // $('.delivery_charge').html(0.00)
                            $('.cod_charge').html(0.00)
                            $('.total_charge').html(0.00)
                            $('.total_charge_input').html(0.00)
                        }

                    });
                }

            }
        })
    </script>
    <script>
        $('body').on('change', '#percelType', function() {
            var percelType = $('#percelType').val();
            if (percelType == 1) {
                $('#amount_input').show();
                $('#cod_input').hide();
                $('#cod').val('');
            } else {
                $('#amount_input').hide();
                $('#cod_input').show();
                $('#actual_price').val('');
            }
        })

        $('#percelType').trigger('change');
    </script>
    <script>
        $(function() {
            // Get Merchant details
            $('body').on('change', '#merchantId', function() {
                var merchantId = $('#merchantId').val();
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_merchant_details')); ?>",
                    data: {
                        'merchantId': merchantId
                    },
                }).done(function(response) {
                    // console.log(response.pickLocation);
                    if (response.pickLocation) {
                        $('#pickLocation').val(response.pickLocation);
                    }
                })
            })

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
                    // console.log(response);
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
                var selected = '<?php echo e(old('thana_id', $edit_data->thana_id)); ?>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_district_thanas')); ?>",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                    $('#thana_id').trigger('change');
                });
            })
            // Get Area
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                var selected = '<?php echo e(old('area_id', $edit_data->area_id)); ?>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_thana_areas_final')); ?>",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
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
            })
            $('#thana_id').trigger('change');

        })
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/percel/edit.blade.php ENDPATH**/ ?>