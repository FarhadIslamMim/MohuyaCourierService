
<?php $__env->startSection('title', 'Invoices'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/libs/@simonwep/pickr/themes/monolith.min.css')); ?>" />
    <!-- 'monolith' theme -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        #reqtablenew > tr:hover{
            /*background-color: #abcaab;*/
        }
        .row_active{
            background-color: #aba9a9;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Merchant Invoice</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Merchant</a></li>
                        <li class="breadcrumb-item active">Merchant Invoice</li>
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
                    <h4>Merchant Payment Invoice</h4>
                </div>
                <div class="card-body">
                    <!-- Basic example -->
                    <form action="<?php echo e(route('payment.merchant.invoice')); ?>" method="GET">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-group">
                                     <select class="form-control select2" name="merchant_id">
                                         <option value="" selected disabled>Select Merchant</option>
                                         <?php $__currentLoopData = $merchant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                             <option value="<?php echo e($item->id); ?>"><?php echo e($item->companyName); ?></option>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Start Date</span>
                                    <input type="date" name="start_date" value="<?php echo e(request()->get('start_date')); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">End Date</span>
                                    <input type="date" name="end_date" value="<?php echo e(request()->get('end_date')); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-block signin_button btn-success">Search & Refresh</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Invoice NO</th>
                                <th scope="col">Merchant Name</th>
                                <th scope="col">Payment Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="reqtablenew">
                        <?php if(count($invoices) > 0): ?>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                                    <td> invoice#0<?php echo e($invoice->id ?? ''); ?></td>
                                    <td><?php echo e($invoice->getPercelDetails->merchant->companyName ?? 'No name'); ?></td>
                                    <td> <?php echo e(\Carbon\Carbon::parse($invoice->created_at)->format('d M Y g:i:s A')); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('payment.merchant.invoice.export',encrypt($invoice->id))); ?>"
                                            class="btn btn-danger" target="_blank"><i class="fa fa-file-pdf-o"></i></a>

                                        <a href="<?php echo e(route('payment.merchant.invoice.print',encrypt($invoice->id))); ?>"
                                           class="btn btn-primary" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                        <a href="<?php echo e(route('payment.merchant.invoice.download',encrypt($invoice->id))); ?>"
                                           class="btn btn-success" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center;color: red"> No Data Available</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <?php echo $__env->make('backend.layouts.datatable_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function () {
            $('#reqtablenew tr').click(function () {
                $('#reqtablenew tr').removeClass("row_active");
                $(this).addClass("row_active");
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new DataTable("#datatable", {
                pagingType: "full_numbers",
                fixedHeader: !0,
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "print",],
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/sensorbd/public_html/resources/views/backend/pages/superadmin/payments/merchant/merchant_payment_invoice.blade.php ENDPATH**/ ?>