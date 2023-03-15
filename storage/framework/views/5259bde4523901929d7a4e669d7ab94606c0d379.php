
<?php $__env->startSection('title', 'Merchant Payment Dues'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                <h4 class="mb-sm-0">Merchants Dues Summary</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Payments</a></li>
                        <li class="breadcrumb-item active">Merchant Dues Summary</li>
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
                <div class="card-body">
                    <div class="row ">
                        <div class="col-lg-10">
                            <h3>Merchants Dues Summary</h3>
                            <p class="text-success">Here is the list of the merchants whom need to pay</p>
                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-primary" href="<?php echo e(route('payment.merchant.invoice')); ?>">Invoices</a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <?php if($results): ?>
                        <div class="table-responsive ">
                            <table  id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Payment Method</th>
                                        
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>

                                <tbody id="reqtablenew">
                                    <?php
                                $i = 0;
                                    foreach($results as $result) {

                                      /*.....total return delivery charge.....*/

                                      $returnDelCharge = DB::table('parcels')->where([
                                          ['merchantId', '=', $result->id],
                                          ['status', '>', '5'],
                                          ['status', '<', '9'],
                                      ])->sum('deliveryCharge');

                                      $return_charge = DB::table('parcels')->where([
                                          ['merchantId', '=', $result->id],
                                          ['status', '>', '5'],
                                          ['status', '<', '9'],
                                      ])->sum('return_charge');

                                    //   dd($return_charge);

                                      /*.....total return delivery charge.....*/


                                      /*.....total delivered prepaid parcel delivery charge.....*/

                                      $prepDelAmount = App\Models\Parcel::where(['merchantId'=>$result->id,'status'=>4,'percelType'=>1])->sum('deliveryCharge');



                                      /*.....total delivered prepaid parcel delivery charge.....*/

                                      /*.....total marchant amount....*/
                                      $totalamount = App\Models\Parcel::where(['merchantId'=>$result->id,'status'=>4])->sum('merchantAmount') - ($returnDelCharge + $prepDelAmount+$return_charge);
                                    //   dd($totalamount);
                                      /*.....total marchant amount....*/

                                      $allPaidParcels = App\Models\Parcel::where(['merchantId'=>$result->id,'merchantpayStatus'=>1])->get();

                                      $total = 0;
                                      $totalDel = 0;
                                      foreach($allPaidParcels as $key=>$parcel) {
                                          if(($parcel->status > 5 && $parcel->status < 9) || ($parcel->percelType == 1 && $parcel->status == 4) ) {
                                              $totalDel += $parcel->deliveryCharge;
                                            //   dd($parcel->deliveryCharge-$parcel->return_charge);
                                          }else {
                                              if($parcel->percelType == 2 && $parcel->status == 4) {
                                                  $total += $parcel->merchantAmount;
                                              }
                                          }
                                      }


                                      $merchantPaid = $total - $totalDel;

                                      $merchantUnPaid= $totalamount - $merchantPaid;
                                    //   dd($merchantUnPaid);
                                       ?>
                                    <tr>

                                        <td><?php echo e($result->companyName); ?></td>
                                        <td>
                                            <?php if($result->paymentMethod == 1): ?>
                                                Bank
                                            <?php elseif($result->paymentMethod == 2): ?>
                                                Bkash
                                            <?php elseif($result->paymentMethod == 3): ?>
                                                Rocket
                                            <?php elseif($result->paymentMethod == 4): ?>
                                                Cash
                                            <?php else: ?>
                                                Not set yet
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="text-center">
                                            <a href="<?php echo e(route('payment.merchant.due', $result->id)); ?>"
                                                class="btn btn-success"><i class="bx bx-dollar-circle"></i> Make Payment</a>
                                        </td>
                                    </tr>
                                    <?php }
                                ?>
                                </tbody>
                            </table>
                            <?php echo e($results->links()); ?>


                        </div>
                    <?php else: ?>
                        <p>No new payment is avaiable</p>
                    <?php endif; ?>
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

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home3/sensorbd/public_html/resources/views/backend/pages/superadmin/payments/merchant/merchant_due_payment.blade.php ENDPATH**/ ?>