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
        <?php if($deliveryman_details): ?>
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
                                    <h1 class="big-title" >Invoice</h1>
                                </div>
                            </div>
                            <div class="header-bottom">
                                <div class="row align-items-center">
                                    <div class="col">
                                    </div>
                                    <div class="col-auto">
                                        <p class="invoice-number me-4"  style="font-size:0.975em;"><b>Invoice No:
                                            </b>#0<?php echo e($deliveryman_details->deliveryman_payment_invoice ?? ''); ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <p class="invoice-date"><b>Date:
                                            </b><?php echo e(date('d M Y', strtotime($deliveryman_details->updated_at ?? ''))); ?>

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
                                        <?php echo e($deliveryman_details->deliveryman->name ?? ''); ?><br />
                                        <?php echo e($deliveryman_details->deliveryman->phone ?? ''); ?><br />
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
                                <th>Merchant Name</th>
                                <th style="width: 20%;">Customer <br>Information</th>
                                <th>Parcel Type</th>
                                <th>Parcel Amount</th>
                                <th>Collected Amount</th>
                                <th>Partial Return</th>
                                <th>Parcel Weight</th>
                                <th>Extra Price</th>
                                <th>P Parcel Amount</th>
                                <th>Paid Amount</th>
                            </tr>
                            </thead>
                            <tbody >
                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td width="120">
                                        <p style="font-size:0.75em;"><?php echo e($item->trackingCode); ?></p>
                                    </td>
                                    <td width="120">
                                        <p style="font-size:0.75em;"><?php echo e($item->merchant->companyName); ?></p>
                                    </td>
                                    <td width="250">
                                        <?php echo e(ucfirst($item->recipientName)); ?>

                                        <p class="m-0 text-muted" style="font-size:0.75em;">
                                            <?php echo e($item->recipientAddress); ?>, <br> Phone :
                                            <?php echo e($item->recipientPhone); ?>

                                        </p>
                                    </td>
                                    <td width="60" >
                                        <p><small><?php echo e($item->parcelStatus->title); ?></small> </p>
                                    </td>
                                    <td width="120" style="font-size:0.75em;">
                                        <p><?php echo e($item->cod ?? ''); ?> </p>
                                    </td>
                                    <td width="120" style="font-size:0.75em;">
                                        <p><?php echo e($item->collected_amount ?? ''); ?> </p>
                                    </td>
                                    <td width="120" style="font-size:0.75em;">
                                        <p><?php echo e($item->partial_return_amount ?? ' '); ?></p>
                                    </td>
                                    <td width="120" style="font-size:0.75em;">
                                        <p><?php echo e($item->productWeight ?? 0); ?> kg</p>
                                    </td>
                                    <td width="120">
                                        <p style="font-size:0.75em;">
                                            <?php
                                            if ($item->productWeight <= $deliveryman_details->deliveryman->max_weight){
                                              echo '0';
                                            }else{
                                              echo $deliveryman_details->deliveryman->extra_weight_charge;
                                            }
                                            ?>
                                            tk
                                        </p>
                                    </td>
                                    <td width="120" style="font-size:0.75em;">
                                        <p>
                                            <?php echo e($deliveryman_details->deliveryman->per_parcel_amount ?? 0); ?> tk
                                        </p>
                                    </td>
                                    <td class="text-center" width="10" style="font-size:0.75em;">
                                        <p><?php echo e($item->deliveryman_paid); ?> tk</p>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right"><b>Total = </b></td>
                                <td style="font-size:0.75em;">
                                    <b><strong><?php echo e(number_format($amounts->sum('deliveryman_paid'), 2)); ?> tk</strong></b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <div class="invoice-left">
                                </div>
                            </div>
                            <div class="col-auto">
                            </div>
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
<?php /**PATH /home3/sensorbd/public_html/resources/views/backend/pages/superadmin/payments/deliveryman/deliveryman_payment_invoice.blade.php ENDPATH**/ ?>