
<?php $__env->startSection('title', 'Percel Create'); ?>
<?php $__env->startSection('custom-styles'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <div class="section bg-light">
        <div class="container">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Percel Create</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row gy-2">
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <?php echo $__env->make('frontend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <form action="<?php echo e(route('agent.percel.store')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="row gy-4">
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="merchantId"><?php echo e(__('lang.merchant')); ?> <span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                    <select class="form-control select2"
                                                                        value="<?php echo e(old('merchantId')); ?>" name="merchantId"
                                                                        id="merchantId">
                                                                        <option value="">
                                                                            <?php echo e(__('lang.select_merchant')); ?></option>
                                                                        <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($value->id); ?>"
                                                                                <?php if(old('merchantId') == $value->id): ?> selected <?php endif; ?>>
                                                                                <?php echo e($value->companyName); ?>

                                                                                (0<?php echo e($value->phoneNumber); ?>)
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
                                                                    <label for="weight_id"><?php echo e(__('lang.weight')); ?><span
                                                                            class="text-danger">*</span></label>
                                                                    <select
                                                                        class="form-control select2 weight_id <?php echo e($errors->has('weight_id') ? ' is-invalid' : ''); ?>"
                                                                        value="<?php echo e(old('weight_id')); ?>" name="weight_id"
                                                                        id="weight_id">
                                                                        

                                                                        <?php $__currentLoopData = $weights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($weight->id); ?>"
                                                                                <?php if(old('weight_id') == $weight->id): ?> selected <?php endif; ?>>
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
                                                                        <label
                                                                            for="productPrice"><?php echo e(__('lang.cash_collection')); ?><span
                                                                                class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="number"
                                                                            class="form-control productPrice"
                                                                            id="productPrice" name="productPrice"
                                                                            placeholder="Enter Cash Collection">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div class="form-group">
                                                                    <div>
                                                                        <label
                                                                            for="invoiceNo"><?php echo e(__('lang.invoice_no')); ?></label>
                                                                        <input type="number" class="form-control invoiceNo"
                                                                            id="invoiceNo" name="invoiceNo"
                                                                            placeholder="00">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- form group -->
                                                            <div class="col-xxl-6 col-md-6">
                                                                <label for="name"> <?php echo e(__('lang.customer_name')); ?> <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control <?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('name')); ?>" name="name"
                                                                    id="name"
                                                                    placeholder="<?php echo e(__('lang.customer_name')); ?>" required>
                                                                <?php if($errors->has('name')): ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>

                                                            <div class="col-xxl-6 col-md-6">
                                                                <label for="phonenumber"><?php echo e(__('lang.mobile_no')); ?> <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input minlength="11" maxlength="11" type="text"
                                                                    class="form-control <?php echo e($errors->has('phonenumber') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('phonenumber')); ?>" name="phonenumber"
                                                                    id="phonenumber"
                                                                    placeholder="<?php echo e(__('lang.mobile_no')); ?>" required>
                                                                <?php if($errors->has('phonenumber')): ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($errors->first('phonenumber')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                                <div id="customer_list"></div>

                                                            </div>
                                                            <div class="col-xxl-6 col-md-6">
                                                                <label
                                                                    for="alternative_mobile_no"><?php echo e(__('lang.alternative_mobile_no')); ?></label>
                                                                <input type="text"
                                                                    class="form-control <?php echo e($errors->has('alternative_mobile_no') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('alternative_mobile_no')); ?>"
                                                                    name="alternative_mobile_no" id="alternative_mobile_no"
                                                                    placeholder="<?php echo e(__('lang.alternative_mobile_no')); ?>">
                                                                <?php if($errors->has('alternative_mobile_no')): ?>
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong><?php echo e($errors->first('alternative_mobile_no')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                            
                                                            <div class="col-sm-12">
                                                                <div>
                                                                    <label><input type="radio" name="colorRadio" value="inCityDhaka" checked="checked"> Inside Dhaka</label>
                                                                    <label><input type="radio" name="colorRadio" value="outCityDhaka"> Out Side Dhaka</label>
                                                                    
                                                                </div>
                                                            </div>



                                                            <div class="row outCityDhaka box" style=" display: none;" >
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



                                                             
                                                            
                                                            <div class="col-sm-6" >
                                                                <div class="form-group">
                                                                    <label for="">Delivery Address</label>

                                                                        <textarea type="text" name="delivery_address"
                                                                        id="delivery_address" value="<?php echo e(old('delivery_address')); ?>" class="form-control" placeholder="Delivery Address"
                                                                        rows="4"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-6 col-md-6">
                                                                <label for="note"><?php echo e(__('lang.note')); ?>

                                                                    (<?php echo e(__('lang.maximum_300_characters')); ?>)</label>
                                                                <textarea rows="4" type="text" class="form-control <?php echo e($errors->has('note') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('note')); ?>" name="note" placeholder="<?php echo e(__('lang.note')); ?>"><?php echo e(old('note')); ?></textarea>
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
                                                <button type="submit" class="btn btn-primary">Create Percel</button>
                                            </div>
                                        </form>
                                    </div>


                                    
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="card ribbon-box border shadow-none mb-lg-0">
                                            <div class="card-body">
                                                <div class="ribbon ribbon-primary round-shape">
                                                    <?php echo e(__('lang.cost_summary')); ?></div>
                                                <h5 class="fs-14 text-end"><?php echo e(__('lang.Total_Cost_for_the_percel')); ?></h5>
                                                <div class="ribbon-content mt-4 text-muted">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th><?php echo e(__('lang.delivery_charge')); ?></th>
                                                            <td class="text-right">
                                                                <span class="delivery_charge"> 0.00 </span> tk.
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo e(__('lang.cod_charge')); ?></th>
                                                            <td class="text-right">
                                                                <span class="cod_charge"> 0.00 </span> tk.
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo e(__('lang.total_charge')); ?></th>
                                                            <th class="text-right">
                                                                <span class="total_charge"> 0.00 </span> tk.
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th><?php echo e(__('lang.pay_to_merchant')); ?></th>
                                                            <td class="text-right">
                                                                <b> <span class="pay_to_merchant"> 0.00 </span> tk.</b>
                                                            </td>
                                                        </tr>
                                                    </table>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        $(function() {

            $('body').on('keyup', '#phonenumber', function() {
                let phone_number = $(this).val();
                $.ajax({
                    type: "get",
                    url: "<?php echo e(route('get_customer_details')); ?>",
                    data: {
                        'phone_number': phone_number,

                    },
                    dataType: "html",
                    success: function(response) {
                        $("#customer_list").html(response);
                    }
                });


            });

            $('body').on('click', '#customer_id', function() {
                var id = $(this).attr('customer-id');
                $('.list-group').remove();
                $.ajax({
                    type: "get",
                    url: "<?php echo e(route('set_customer_details')); ?>",
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $("#phonenumber").val(response.recipientPhone);
                        $("#name").val(response.recipientName);
                        $("#delivery_address").val(response.delivery_address);
                        $("#division_id").val(response.division_id).change();

                        getDistrict(response.division_id, response.district_id);
                        getThana(response.district_id, response.thana_id);
                        getArea(response.thana_id, response.area_id);


                    }
                });
            });

            function getDistrict(division_id, district_id) {
                var options = '';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_division_districts')); ?>",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    var selected = district_id;
                    response.forEach(function(item, i) {
                        if (item.id === selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#district_id').html(options);
                });
            }

            function getThana(district_id, thana_id) {
                var options = '';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_district_thanas')); ?>",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    var selected = thana_id;
                    response.forEach(function(item, i) {
                        if (item.id === selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                });
            }

            function getArea(thana_id, area_id) {
                var options = '';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_thana_areas_final')); ?>",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    var selected = area_id;
                    response.forEach(function(item, i) {
                        if (item.id === selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#area_id').html(options);
                });

            }

            $('body').on('change paste keyup',
                '.productPrice, .weight_id, #thana_id, #division_id, #district_id, #merchantId',
                function() {
                    getparcelCharge();
                })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var thana_id = $('#thana_id').val();
                var division_id = $('#division_id').val();
                var district_id = $('#district_id').val();
                var merchantId = $('#merchantId').val();

                if (weight_id && productPrice && thana_id && merchantId) {
                    $.ajax({
                        method: "GET",
                        url: '<?php echo e(route('cost.calculator')); ?>',
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id,
                            'merchantId': merchantId,
                            'division_id': division_id,
                            'district_id': district_id,

                        },
                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            $('.delivery_charge').html(response.pdeliverycharge)
                            $('.cod_charge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                            $('.pay_to_merchant').html(response.pay_to_merchant)
                        } else {
                            alert(response.message);
                            $('.delivery_charge').html(0.00)
                            $('.cod_charge').html(0.00)
                            $('.total_charge').html(0.00)
                        }

                    });
                }

            }
        })
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

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/pages/agent/percel/create.blade.php ENDPATH**/ ?>