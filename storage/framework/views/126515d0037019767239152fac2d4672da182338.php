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
        <?php if($agent_details): ?>
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
                                            </b>#0<?php echo e($agent_details->agent_payment_invoice ?? ''); ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <p class="invoice-date"><b>Date:
                                            </b><?php echo e(date('d-m-Y', strtotime($agent_details->updated_at ?? ''))); ?>

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
                                        <?php echo e($agent_details->agent->name ?? ''); ?><br />
                                        <?php echo e($agent_details->agent->phone ?? ''); ?><br />
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
                            <tr>
                                <th>Order Info</th>
                                <th>Tracking ID</th>
                                <th>Parcel Type</th>
                                <th>Paid</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td width="250">
                                        <?php echo e(ucfirst($item->recipientName)); ?>

                                        <p class="m-0 text-muted">
                                            <?php echo e($item->recipientAddress); ?>, <br> Phone :
                                            <?php echo e($item->recipientPhone); ?>

                                        </p>
                                    </td>
                                    <td width="120">
                                        <p>TC : <?php echo e($item->trackingCode); ?></p>
                                    </td>
                                    <td width="60"><?php echo e($item->parcelStatus->title); ?>

                                    </td>
                                    <td class="text-center" width="10">
                                        <?php echo e($item->agent_paid); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right"><b>Total = </b></td>
                                <td>
                                    <b><strong><?php echo e(number_format($amounts->sum('agent_paid'), 2)); ?></strong></b>
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
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            })
        }
    })
    $(function () {
        // 'use strict';
        window.print()
    })
</script>
</body>

</html>

<?php /**PATH /home3/sensorbd/public_html/resources/views/backend/pages/superadmin/payments/agent/payment_invoice_print.blade.php ENDPATH**/ ?>