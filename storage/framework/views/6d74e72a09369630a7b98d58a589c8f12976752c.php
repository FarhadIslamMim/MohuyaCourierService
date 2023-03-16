
<?php $__env->startSection('title', 'Percels'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <section class="section bg-light">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card-header">
                            <button class="btn btn-primary printBtn" type="button"><i class="bx bx-printer"></i>
                                Print</button>
                            <br>
                        </div>
                        <div class="card-body" style="height:288px">
                            <div id="printTable"
                                style="width:288px; height:288px; background:#fff; border:1px solid #282828;">
                                <div style="border-bottom:1px solid black">
                                    <table>
                                        <tr>
                                            <td style="width:70px; border-right:1px solid black"><img style="width: 45px;"
                                                    src="<?php echo e(asset($setting->logo)); ?>" alt="<?php echo e($setting->name); ?>">
                                            </td>
                                            <td style="width:280px">
                                                <strong style="font-size:15px"> <?php echo e($setting->name ?? ''); ?></strong><br>
                                                <strong style="font-size:12px">
                                                    Merchant:<?php echo e($show_data->merchant->companyName ?? ''); ?></strong><br>
                                                <span style="font-size: 12px">Phone :
                                                    0<?php echo e($show_data->merchant->phoneNumber ?? ''); ?>

                                                </span>
                                                <span style="font-size: 12px">
                                                    Area:&nbsp;<?php echo e($show_data->merchant->area->name ?? ''); ?>

                                                </span>, &nbsp;
                                                <span style="font-size: 12px">
                                                    Thana:&nbsp;<?php echo e($show_data->merchant->thana->name ?? ''); ?>, </span>
                                                <span style="font-size: 12px">
                                                    District:&nbsp;<?php echo e($show_data->merchant->district->name ?? ''); ?>

                                                </span>&nbsp;

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div style="border-bottom-style:double">
                                    <table>
                                        <tr>
                                            <td style="width:245px; border-right:1px solid black">
                                                <strong style="font-size:11px">CUSTOMER:
                                                    <?php echo e($show_data->recipientName ?? ''); ?></strong><br>
                                                <span style="font-size:11px">
                                                    <?php echo e($show_data->recipientPhone ?? ''); ?></span><br>
                                                <span style="font-size:11px">
                                                    <?php echo e($show_data->recipientAddress ?? ''); ?></span><br>
                                                <span style="font-size:11px;">
                                                    <?php echo e($show_data->alternative_mobile_no ?? ''); ?> (Alt.
                                                    No.)</span>

                                            </td>
                                            <td style="width:150px">
                                                <strong style="font-size:11px">AREA:
                                                    <?php echo e($show_data->area->name ?? ''); ?></strong><br>
                                                <strong style="font-size:11px">Thana:
                                                    <?php echo e($show_data->area->thana->name ?? ''); ?></strong><br>
                                                <strong style="font-size:11px">Disctrict:
                                                    <?php echo e($show_data->district->name ?? ''); ?></strong><br>


                                            </td>
                                        </tr>

                                    </table>
                                </div>
                                <div style="border-bottom:1px solid black">
                                    <table>
                                        <tr>
                                            <td style="width:288px;">
                                                <strong
                                                    style="font-size:12px">INVOICE:<?php echo e($show_data->invoiceNo ?? ''); ?></strong><br>

                                            </td>
                                            <td style="width:125px"> <strong style="font-size:12px">&nbsp;
                                                    CASH:<?php echo e($show_data->cod ?? ''); ?></strong><br>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div>

                                    <div style=" padding-top:0px">
                                        <table>
                                            <tr>
                                                <td style="width:160px; padding-left:5px; margin-right:10px; height:50px ;">
                                                    
                                                    <?php echo QrCode::size(50)->generate(route('home.parcel.tracking') . '?tracking_id=' . $show_data->trackingCode); ?>


                                                </td>
                                                <td style="width:200px;">
                                                    <?php echo '<img width="135px" src="data:image/png;base64,' .
                                                        DNS1D::getBarcodePNG("$show_data->trackingCode", 'C128', 1, 40) .
                                                        '" alt="barcode"   />'; ?>

                                                    <p><?php echo e($setting->tracking_prefix); ?>-<?php echo e(date('Y')); ?>Y<?php echo e(date('m')); ?>MON<?php echo e(date('d')); ?>D
                                                    </p>
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
    </section>
    <!-- percel create content end -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom-modal'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script>
        $('.printBtn').on('click', function() {
            $(this).css('display', 'none');
            $('.bx').hide();
            $('footer').css('display', 'none');
            $('nav').css('display', 'none');
            window.print();
            $(this).css('display', 'inline-block');
            $('.bx').show();

            $('.main-footer').css('display', 'block');
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/pages/agent/percel/lable.blade.php ENDPATH**/ ?>