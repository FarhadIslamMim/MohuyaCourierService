<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Invoice </title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/invoice/app.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/invoice/style.css')); ?>" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>

<body>
<div class="invoice-container-wrap">
    <div class="invoice-container">
        <?php if($merchant_details): ?>
            <main>
                <div class="as-invoice invoice_style1">
                    <div class="download-inner" id="download_section">
                        <header class="as-header header-layout1">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto">
                                    <div class="header-logo">
                                        <img src="<?php echo e(asset($setting->logo)); ?>" alt="" width="80px"
                                             height="80px">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h1 class="big-title">Invoice</h1>
                                </div>
                            </div>
                            <div class="header-bottom">
                                <div class="row align-items-center">
                                    <div class="col">
                                    </div>
                                    <div class="col-auto">
                                        <p class="invoice-number me-4"><b>Invoice No:
                                            </b>#0<?php echo e($merchant_details->paymentInvoice ?? ''); ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <p class="invoice-date"><b>Date:
                                            </b><?php echo e(date('d-m-Y', strtotime($merchant_details->updated_at ?? ''))); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <div class="row justify-content-between mb-4">
                            <div class="col-auto">
                                <div class="invoice-left">
                                    <b>Invoiced To:</b>
                                    <address>
                                        <?php echo e($merchant_details->merchant->companyName ?? ''); ?><br />
                                        <?php echo e($merchant_details->merchant->pickLocation ?? ''); ?><br />
                                    </address>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="invoice-right" style="width: 360px;">
                                    <b>Pay from:</b>
                                    <address>
                                        <?php echo e($setting->name); ?><br />
                                        <?php echo e($setting->address); ?>,<br />
                                    </address>
                                </div>
                            </div>
                        </div>
                        <table class="invoice-table">
                            <thead>
                            <tr style="font-size:0.85em; text-align: center;">
                                <th>Tracking ID</th>
                                <th>Customer  <br>Information</th>
                                <th>Parcel Type</th>
                                <th>Parcel Amount</th>
                                <th>Partial Return</th>
                                <th>Collected Amount</th>
                                <th>Cod Charge</th>
                                <th>Delivery Charge</th>
                                <th>Return Charge</th>
                                <th>Merchant Pay</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center" width="10"><?php echo e($item->trackingCode); ?> </td>
                                    <td width="10">
                                        <?php echo e(ucfirst($item->recipientName)); ?>

                                        <p class="m-0 text-muted">
                                            <?php echo e($item->recipientAddress); ?>, <br> Phone :
                                            <?php echo e($item->recipientPhone); ?>

                                        </p>
                                    </td>
                                    <td class="text-center" width="10"><?php echo e($item->parcelStatus->title); ?> </td>
                                    <td class="text-center" width="10"><?php echo e($item->cod); ?> </td>
                                    <td class="text-center" width="10"><?php echo e($item->partial_return_amount); ?> </td>
                                    <td class="text-center" width="10"><?php echo e($item->collected_amount); ?> </td>
                                    <td class="text-center" width="10"><?php echo e($item->ccharge); ?> </td>
                                    <td class="text-center" width="10"><?php echo e($item->deliveryCharge); ?> </td>
                                    <td class="text-center" width="10">
                                        <?php if($item->return_charge): ?>
                                            <?php echo e($item->return_charge); ?>

                                        <?php else: ?>
                                            0
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-right" width="10">
                                        <?php if($item->collected_amount): ?>
                                            <?php echo e($item->collected_amount - ($item->deliveryCharge + $item->ccharge)); ?>

                                        <?php else: ?>
                                            - <?php echo e($item->return_charge + $item->deliveryCharge); ?>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right"><b>Total = </b></td>
                                <td>
                                    <b><strong><?php echo e(number_format($amounts->sum('cod'), 2)); ?></strong></b>
                                </td>
                                <td>
                                    <b><strong><?php echo e(number_format($amounts->sum('partial_return_amount'), 2)); ?></strong></b>
                                </td>
                                <td>
                                    <b><strong><?php echo e(number_format($amounts->sum('collected_amount'), 2)); ?></strong></b>
                                </td>
                                <td>
                                    <b><strong><?php echo e(number_format($data_value->sum('c_charge'), 2)); ?></strong></b>
                                </td>
                                <td>
                                    <b><strong><?php echo e(number_format($amounts->sum('deliveryCharge'), 2)); ?></strong></b>
                                </td>
                                <td>
                                    <b> <strong>
                                            <?php echo e(number_format($amounts->sum('return_charge'))); ?>

                                        </strong></b>
                                </td>
                                <td>
                                    <?php
                                        $totalAmount =  $amounts->sum('collected_amount') - ($amounts->sum('deliveryCharge') + $amounts->sum('return_charge') + $data_value->sum('c_charge'))
                                    ?>
                                    <b><strong><?php echo e(number_format($totalAmount,2)); ?></strong></b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row justify-content-between">
                        </div>
                        <p class="invoice-note mt-3">
                            <b>NOTE: </b>This is computer generated receipt and does not require physical signature.
                        </p>
                        <div class="body-shape1">
                            <small>Developed by- One Point IT Solutions</small>
                        </div>
                    </div>
                </div>
            </main>
        <?php else: ?>
            <div class="alert alert-info">We didn't found any invoice for that merchant. Please go back</div>
        <?php endif; ?>
    </div>
</div>
</body>

</html>
<?php /**PATH /home3/sensorbd/public_html/resources/views/backend/pages/superadmin/payments/merchant/pdf.blade.php ENDPATH**/ ?>