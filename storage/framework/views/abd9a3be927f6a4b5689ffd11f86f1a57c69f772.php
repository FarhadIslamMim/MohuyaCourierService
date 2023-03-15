
<?php $__env->startSection('title', 'Edit Parcel'); ?>
<?php $__env->startSection('custom-styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <div class="section bg-light  mt-5">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Parcel</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row addpercel-inner">
                                        <div class="col-lg-7 col-md-12 col-sm-12">
                                            <div class="fraud-search">
                                                
                                                <form action="<?php echo e(route('merchant.percel.update')); ?>" method="POST"
                                                    name="editForm">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" value="<?php echo e($parceledit->id); ?>" name="hidden_id">
                                                    <input type="hidden" id="merchant_id"
                                                        value="<?php echo e($parceledit->merchantId); ?>" name="merchant_id">

                                                    <div class="row gy-4">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="invoiceNo">Invoice No</label>
                                                                <input type="text"
                                                                    class="form-control invoiceNo <?php echo e($errors->has('invoiceNo') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('invoiceNo', $parceledit->invoiceNo)); ?>"
                                                                    name="invoiceNo" placeholder="Invoice No">
                                                                <?php if($errors->has('invoiceNo')): ?>
                                                                    <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('invoiceNo')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div>
                                                                <h6> weight </h6>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="weight_id"
                                                                    class="form-control select2 weight_id <?php echo e($errors->has('weight_id') ? ' is-invalid' : ''); ?>"
                                                                    id="weight_id" required>
                                                                    <?php $__currentLoopData = $weights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($weight->id); ?>"
                                                                            <?php if(old('weight_id', $parceledit->weight->id ?? '') == $weight->value): ?> selected <?php endif; ?>>
                                                                            <?php echo e($weight->name); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <?php if($errors->has('weight_id')): ?>
                                                                    <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('weight_id')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div>
                                                                <h6> Cash Collection </h6>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="number" step="any"
                                                                    class="form-control productPrice <?php echo e($errors->has('productPrice') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('productPrice', $parceledit->cod)); ?>"
                                                                    name="cod" placeholder="Cash Collection" required>
                                                                <?php if($errors->has('productPrice')): ?>
                                                                    <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('productPrice')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Customer Name</label>
                                                                <input type="text"
                                                                    class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('name', $parceledit->recipientName)); ?>"
                                                                    name="name" placeholder="Name *">
                                                                <?php if($errors->has('name')): ?>
                                                                    <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Phone Number <span class="text-danger">(Max:11 Character)</span></label>
                                                                <input type="text" id="req3"
                                                                    class="form-control<?php echo e($errors->has('phonenumber') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('phonenumber', $parceledit->recipientPhone)); ?>"
                                                                    name="phonenumber" placeholder=" Mobile No. *">
                                                                <?php if($errors->has('phonenumber')): ?>
                                                                    <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('phonenumber')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Alternative Phone No <span class="text-danger">(Max:11 Character)</span></label>
                                                                <input type="text" id="req4"
                                                                    class="form-control<?php echo e($errors->has('alternative_mobile_no') ? ' is-invalid' : ''); ?>"
                                                                    value="<?php echo e(old('alternative_mobile_no', $parceledit->alternative_mobile_no)); ?>"
                                                                    name="alternative_mobile_no"
                                                                    placeholder="<?php echo app('translator')->get('Alternative Mobile No.'); ?>">
                                                                <?php if($errors->has('alternative_mobile_no')): ?>
                                                                    <span class="invalid-feedback">
                                                                        <strong><?php echo e($errors->first('alternative_mobile_no')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Division</label>
                                                                <select name="division_id"
                                                                    class="form-control select2 division_id"
                                                                    id="division_id" required>
                                                                    <option value="">Division *</option>
                                                                    <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($division->id); ?>"
                                                                            <?php if(old('division_id', $parceledit->division_id) == $division->id): ?> selected <?php endif; ?>>
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
                                                                <label for="">District</label>

                                                                <select name="district_id"
                                                                    class="form-control select2 district_id"
                                                                    id="district_id" required>
                                                                    <option value="">District *</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="">Thana (Upazila)</label>

                                                            <div class="form-group">
                                                                <select name="thana_id"
                                                                    class="form-control select2 thana_id" id="thana_id"
                                                                    required>
                                                                    <option value="">Thana (Upazila)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="">Area</label>

                                                            <div class="form-group">
                                                                <select name="area_id"
                                                                    class="form-control select2 area_id" id="area_id">
                                                                    <option value="">Area </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Delivery Address</label>

                                                                <!--<input type="text" name="delivery_address"-->
                                                                <!--    id="delivery_address"-->
                                                                <!--    value="<?php echo e($parceledit->delivery_address); ?>"-->
                                                                <!--    list="address_list" class="form-control"-->
                                                                <!--    placeholder="Delivery Address *"-->
                                                                <!--    autocomplete="new-password" required />-->

                                                                <textarea type="text" name="delivery_address" class="form-control" placeholder="Note" rows="3"><?php echo e(old('delivery_address', $parceledit->delivery_address)); ?></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Parcel note</label>
                                                                <textarea type="text" name="note" class="form-control" placeholder="Note" rows="3"><?php echo e(old('note', $parceledit->note)); ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <button type="submit"
                                                                class="form-control btn btn-primary w-50">Update</button>
                                                        </div>


                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-lg-1 col-md-1 col-sm-0"></div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="card ribbon-box border shadow-none mb-lg-0">
                                                <div class="card-body">
                                                    <div class="ribbon ribbon-primary round-shape">Cost Summary</div>
                                                    <h5 class="fs-14 text-end">Total Cost for the parcel</h5>
                                                    <div class="ribbon-content mt-4 text-muted">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Delivery Charge</th>
                                                                <td class="text-right">
                                                                    <span class="pdeliverycharge">
                                                                        <?php echo e($parceledit->deliveryCharge); ?> </span> tk.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>COD Charge</th>
                                                                <td class="text-right">
                                                                    <span class="pcodecharge"> 0.00 </span> tk.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Charge</th>
                                                                <th class="text-right">
                                                                    <span class="total_charge">
                                                                        <?php echo e($parceledit->deliveryCharge); ?> </span> tk.
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Pay to merchant</th>
                                                                <th class="text-right">
                                                                    <span class="total_cash_collection">
                                                                        <?php echo e($parceledit->cod); ?> </span>
                                                                    tk.
                                                                </th>
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
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(asset( 'assets/phone/validate.js' )); ?>"></script>
    <script>
        $(document).ready(function () {
            $("#req3").prop('maxlength','11');
            var literal = {
                req3: {
                    selector: $('#req3'),
                    length: {
                        value: 11,
                        message: 'Only 11 characters are allowed,And Must be a digit'
                    },
                    digit: {}
                },
            };
            var result = $.validate.rules(literal, { mode: 'bootstrap' });
            console.log(result);
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#req4").prop('maxlength','11');
            var literal = {
                req3: {
                    selector: $('#req4'),
                    length: {
                        value: 11,
                        message: 'Only 11 characters are allowed,And Must be a digit'
                    },
                    digit: {}
                },
            };
            var result = $.validate.rules(literal, { mode: 'bootstrap' });
            console.log(result);
        });
    </script>


    <script>
        $(function() {
            $('body').on('change paste keyup', '.productPrice, .weight_id, #thana_id, #deliveryChargeInput',
                function() {
                    getparcelCharge();

                })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val();
                var thana_id = $('#thana_id').val();
                var deliverycharge = $("#deliveryChargeInput").val();
                var merchantId = $("#merchant_id").val();
                var district_id = $("#district_id").val();
                if (weight_id && productPrice && thana_id) {
                    $.ajax({
                        method: "GET",
                        url: "<?php echo e(route('cost.calculator')); ?>",
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id,
                            'deliveryCharge': deliverycharge,
                            'merchantId': merchantId,
                            'district_id': district_id
                        },

                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            $('.pdeliverycharge').html(response.pdeliverycharge)
                            $('.pcodecharge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                            $('.total_cash_collection').html(response.pay_to_merchant)
                        } else {
                            alert(response.message);
                            $('.pdeliverycharge').html(0.00)
                            $('.pcodecharge').html(0.00)
                            $('.total_charge').html(0.00)
                            $('.total_cash_collection').html(0.00)

                        }

                    });
                }

            }
        })
    </script>
    <script>
        $(function() {

            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                var selected = '<?php echo e(old('district_id', $parceledit->district_id)); ?>';
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
                var selected = '<?php echo e(old('thana_id', $parceledit->thana_id)); ?>';
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
                var selected = '<?php echo e(old('area_id', $parceledit->area_id)); ?>';

                console.log(selected);

                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_thana_areas_final')); ?>",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {

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

    <script>
        function getAddress() {
            var area_id = $('#area_id').val();
            var options = '';
            if (area_id) {
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_area_address')); ?>",
                    data: {
                        'area_id': area_id
                    },
                    cache: false,
                    dataType: "json",
                }).done(function(response) {
                    response.forEach(function(item) {
                        options += "<option>" + item.recipientAddress + "</option>"
                    })
                    $('#address_list').html(options);
                });
            }

        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/pages/merchant/percel/edit.blade.php ENDPATH**/ ?>