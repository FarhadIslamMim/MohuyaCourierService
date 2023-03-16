
<?php $__env->startSection('title', 'Parcel Invoice'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <style>
        .table {
            border: 2px solid #282828;
            width: 100%;
        }

        .table tr {
            border: 2px solid #282828;
        }

        .table td {
            border: 2px solid #282828;
        }

        /* @media  print {
            @page  {
                size: 210mm 91mm ;
                margin: 2px;
            }
        } */

        #print_area {
            width: 210mm;
            height: 90mm;
            overflow: hidden;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Parcel Invoice</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel</a></li>
                        <li class="breadcrumb-item active">Parcel Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-8 mt-5 ml-5">
        <div style="width:600px; margin:auto;">
                <div class="row">
                    <div class="col-sm-12 col-xs-12  text-left">
                        <a role="button" class="btn btn-info btn-sm" onclick="getPrint()">Print</a>
                    </div>
                </div>
                <hr>
                <div id="print_area">
                    <div class="print_size" style="width: 210mm; height:99mm; font-size:10px">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12" style="display: flex;gap: 20px;align-items: flex-start;">
                                        <div>
                                            <img src="<?php echo e(asset($setting->logo)); ?>" class="card-logo card-logo-dark"
                                                 alt="logo dark" height="55">
                                        </div>
                                        <div class="company_info" style="width: 361px; height:50px">
                                            <?php echo e($setting->address); ?> <br>
                                            Phone: 01404477009<br>
                                            Email: sensorcourier@gmail.com<br>
                                            <p>www.sensorbd.com</p>
                                            <br>
                                            <br>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <b>
                                        Shipped from : <?php echo e($show_data->companyName); ?> <br>
                                    </b>
                                    Name : <?php echo e($show_data->firstName); ?> <br>
                                    Contact No: 0<?php echo e($show_data->phoneNumber); ?> <br>
                                    Alternative Contact No: <?php echo e($show_data->otherphoneNumber ?? 'none'); ?> <br>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-right: 0px;">
                                    <div class="supplier_info">
                                        <b> Customer Information </b> <br>
                                        Name : <?php echo e($show_data->recipientName); ?> <br>
                                        Mobile No : <?php echo e($show_data->recipientPhone); ?> <br>
                                        Delivery Address : <?php echo e($show_data->delivery_address); ?>

                                    </div>
                                </td>
                                <td style="border-left: 0px;" class="text-end">
                                    <?php echo QrCode::size(50)->generate(route('home.parcel.tracking') . '?tracking_id=' . $show_data->trackingCode); ?>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <b> Invoice NO: <?php echo e($show_data->invoiceNo); ?></b>
                                        <b>Tracking ID:</b><?php echo e($show_data->trackingCode); ?> <br>
                                        <b>Invoice Date:</b> <?php echo e(date('d M Y g:i:s a', time())); ?> <br>
                                        <p>Weight : <?php echo e($show_data->productWeight); ?> kg</p>
                                        <h3>Collectable Amount : <?php echo e($show_data->cod); ?></h3>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-lg-12">
                                        <?php echo '<img width="135px" src="data:image/png;base64,' .
                                            DNS1D::getBarcodePNG("$show_data->trackingCode", 'C128', 1, 40) .
                                            '" alt="barcode"/>'; ?>

                                        <p><?php echo e($setting->tracking_prefix); ?>-<?php echo e(date('Y')); ?>Y<?php echo e(date('m')); ?>MON<?php echo e(date('d')); ?>D
                                        </p>
                                        <div class="percel_details">
                                            Order Date : <?php echo e(date('d M Y g:h:s a', strtotime($show_data->created_at))); ?><br>
                                            <div style="line-height:10px">
                                                Area : <?php echo e($show_data->area ?? 'No area assigned'); ?>,
                                                Thana : <?php echo e($show_data->thana ?? 'No thana assigned'); ?>,
                                                District : <?php echo e($show_data->district ?? 'No district assigned'); ?>,
                                                Division : <?php echo e($show_data->division ?? 'No division assigned'); ?>,
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    
                </div>

            </div>
    </div>
    <!-- percel create content start -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        function getPrint() {
            var html = $('body').html($('#print_area').html());
            window.print(html);
            window.location.replace('<?php echo url()->full(); ?>');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/pages/agent/percel/new_invoice.blade.php ENDPATH**/ ?>