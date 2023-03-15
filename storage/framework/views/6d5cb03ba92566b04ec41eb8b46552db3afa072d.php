
<?php $__env->startSection('title', 'Percels'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .row_active{
            background-color: #908d8d;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <section class="section bg-light mt-5">
        <div class="container-fluid py-4 px-5 mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form action="" class="filte-form">
                                    <?php echo csrf_field(); ?>
                                    <div class="row gy-4 ">
                                        <h4>Search</h4>
                                        <div class="col-sm-6 col-lg-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <input type="hidden" value="1" name="filter_id">

                                                <label for="invoiceNo">Invoice No.</label>
                                                <input type="text" class="form-control" placeholder="Invoice NO"
                                                    name="invoiceNo" value="<?php echo e(request()->get('invoiceNo')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="invoiceNo">Tracking ID</label>

                                                <input type="text" class="form-control" placeholder="Track ID"
                                                    name="trackId" value="<?php echo e(request()->get('trackId')); ?>">
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-6 col-lg-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="invoiceNo">Mobile No</label>

                                                <input type="number" class="form-control" placeholder="Mobile No"
                                                    name="phoneNumber" value="<?php echo e(request()->get('phoneNumber')); ?>">
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-6 col-lg-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="invoiceNo">Start Date</label>

                                                <input type="date" class="flatDate form-control" placeholder="Date from"
                                                    name="startDate" value="<?php echo e(request()->get('startDate')); ?>">
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="invoiceNo">End Date</label>

                                                <input type="date" class="flatDate form-control" placeholder="Date to"
                                                    name="endDate" value="<?php echo e(request()->get('endDate')); ?>">
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-2 d-flex align-items-center">
                                            <div class="form-group ">
                                                <label for="">&nbsp; </label> <br>
                                                <button type="submit" class="btn signin-button btn-success">Search
                                                </button>
                                            </div>
                                        </div>
                                        <!-- col end -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- row end -->
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <br>
                            <h3>All Parcel List</h3>
                            <div class="table-responsive">
                                <?php echo $__env->make('frontend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <table id="datatable" class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Invoice No.</th>
                                        <th>Tracking ID</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Rider</th>
                                        <th>Amount</th>
                                        
                                        <th>Payment Status</th>
                                        <th>Note</th>
                                        <th>More</th>
                                    </tr>
                                     </thead>
                                     <tbody id="reqtablenew">
                                     <?php $__currentLoopData = $allparcel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <tr class="py-2">
                                             <td style="font-size: 12px"><?php echo e($loop->iteration); ?></td>
                                             <td style="font-size: 12px"><?php echo e($value->invoiceNo); ?></td>
                                             <td style="font-size: 12px"><a
                                                     href="<?php echo e(route('home.parcel.tracking.id', '?tracking_id=' . $value->trackingCode)); ?>"><?php echo e($value->trackingCode); ?></a>
                                             </td>
                                             <td style="font-size: 12px"><?php echo e(\Carbon\Carbon::parse($value->created_at)->format('d M Y g:h:s A')); ?></td>
                                             <td style="font-size: 12px" width="540px">
                                                    <span><i class="las la-user"></i> Name :
                                                        <?php echo e($value->recipientName); ?></span>
                                                 <br>
                                                 <span><i class="las la-phone"></i> Phone :
                                                        <?php echo e($value->recipientPhone); ?>

                                                     <?php if($value->alternative_mobile_no): ?>
                                                         ,
                                                         <?php echo e($value->alternative_mobile_no); ?>

                                                     <?php endif; ?>
                                                    </span>
                                                 <br>
                                                 <span> <i class="las la-location-arrow"></i> Address :
                                                        <?php if($value->delivery_address): ?>
                                                         <?php echo e($value->delivery_address); ?>,
                                                     <?php endif; ?>
                                                     <?php if($value->area_id): ?>
                                                         <?php echo e($value->area); ?>,
                                                     <?php endif; ?>
                                                     <?php if($value->thana_id): ?>
                                                         <?php echo e($value->thana); ?>,
                                                     <?php endif; ?>
                                                     <?php if($value->district_id): ?>
                                                         <?php echo e($value->district); ?>,
                                                     <?php endif; ?>
                                                     <?php if($value->division_id): ?>
                                                         <?php echo e($value->division); ?>

                                                     <?php endif; ?>
                                                    </span>
                                             </td>
                                             <td style="font-size: 12px">
                                                 <?php
                                                     $parcelstatus = App\Models\Parceltype::find($value->status);
                                                 ?>
                                                 <?php echo e($parcelstatus->title ?? ''); ?>

                                                 <?php if($value->status_description): ?>
                                                     <p class="desc text-start text-primary">[
                                                         <?php echo e($value->status_description); ?> ]
                                                     </p>
                                                 <?php endif; ?>

                                             </td>
                                             <td style="font-size: 12px" width="100px">
                                                 <?php
                                                     $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
                                                 ?>
                                                 <?php if($value->deliverymanId): ?>
                                                     <?php echo e($deliverymanInfo->name ?? ''); ?>

                                                 <?php else: ?>
                                                     Not Assign
                                                 <?php endif; ?>
                                             </td>
                                             <td style="font-size: 12px" width="300px">
                                                 <?php if($value->return_charge): ?>
                                                     <b>Collect from Merchant:</b>
                                                     <?php echo e($value->deliveryCharge + $value->return_charge); ?>

                                                 <?php else: ?>
                                                     <br>
                                                     <b>Total Amount :</b> <?php echo e($value->cod); ?> <br>
                                                     <?php if($value->status == 4): ?>
                                                         <b> Customer paid :</b> <?php echo e($value->collected_amount); ?> <br>
                                                     <?php endif; ?>
                                                     <b> Partials Return :</b> <?php echo e($value->partial_return_amount); ?> <br>
                                                     <b>Delivery Charge :</b>
                                                     <?php echo e($value->deliveryCharge + $value->codCharge); ?>

                                                     <br>
                                                     <?php if($value->partial_return_note): ?>
                                                         <b> P. Note :</b> <?php echo e($value->partial_return_note); ?>

                                                     <?php endif; ?>
                                                     <br>
                                                 <?php endif; ?>
                                                 <?php if($value->status == 4): ?>
                                                     <b> D.Note :</b> <?php echo e($value->deliveryman_note ?? 'No note'); ?> <br>

                                                     <br>
                                                     
                                                 <?php endif; ?>
                                                 

                                             </td>
                                             
                                             <td style="font-size: 12px">
                                                 <?php if($value->merchantpayStatus == 1 && ($value->percelType == 2 && $value->status == 4)): ?>
                                                     Paid
                                                 <?php elseif($value->merchantpayStatus == 1 && (($value->status > 5 && $value->status < 9) || $value->percelType == 1)): ?>
                                                     Service charge adjustment
                                                 <?php else: ?>
                                                     Unknown process
                                                 <?php endif; ?>
                                             </td>
                                             <td style="font-size: 12px">
                                                 <?php echo e($value->note); ?>

                                             </td>

                                             <td style="font-size: 12px">
                                                 <div class="btn-group">
                                                     <a href="<?php echo e(route('merchant.invoice', $value->id)); ?>"
                                                        class="btn btn-sm btn-success" title="Invoice" target="_blank"><i class="las la-file-pdf"></i></a>


                                                     <?php if($value->status == 1): ?>
                                                         <a href="<?php echo e(route('merchant.percel.edit', $value->id)); ?>"
                                                            class="btn btn-sm btn-info" target="_blank"><i
                                                                 class="las la-edit" title="Edit"></i></a>
                                                     <?php endif; ?>
                                                     <!--<?php if($value->status >= 2): ?>-->
                                                     <!--    <a class="btn btn-sm btn-success" a-->
                                                     <!--        href="<?php echo e(route('merchant.invoice', $value->id)); ?>"-->
                                                     <!--        title="Invoice" target="_blank"><i class="las la-list"></i></a>-->
                                                     <!--<?php endif; ?>-->
                                                     <?php if($value->status < 2): ?>
                                                         <a class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to Cancel ?')"
                                                            href="<?php echo e(route('merchant.percel.cancel', $value->id)); ?>"
                                                            title="Cancel" target="_blank" > Cancel </a>
                                                     <?php endif; ?>
                                                 </div>

                                                 

                                             </td>
                                         </tr>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
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
                var minDate, maxDate;
                //
                // // Custom filtering function which will search data in column four between two values
                // $.fn.dataTable.ext.search.push(
                //     function(settings, data, dataIndex) {
                //         var min = $('#start_date').val();
                //         var max = $('#end_date').val();
                //         var date_db = data[3] || 0; // use data for the date column
                //         if (min == "" && max == "") {
                //             return true;
                //         }
                //         if (min == "" && date_db <= max) {
                //             return true;
                //         }
                //         if (max == "" && date_db >= min) {
                //             return true;
                //         }
                //         if (date_db <= max && date_db >= min) {
                //             return true;
                //         }
                //         return false;
                //     });
                $(document).ready(function() {
                    // Create date inputs
                    minDate = $("#start_date").val();
                    maxDate = $("#end_date").val();
                    // DataTables initialisation
                    var table = $('#datatable').DataTable();

                    // Refilter the table
                    $('#start_date, #end_date').on('change', function() {
                        table.draw();
                    });
                });


                document.addEventListener("DOMContentLoaded", function() {
                    new DataTable("#datatable", {
                        pagingType: "full_numbers",
                        fixedHeader: !0,
                        dom: "Bfrtip",
                        buttons: ["copy", "csv", "excel", "print", "pdf"],
                    });
                });
            </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/pages/merchant/percel/allpercels.blade.php ENDPATH**/ ?>