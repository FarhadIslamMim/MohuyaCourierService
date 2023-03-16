
<?php $__env->startSection('title', 'Percels'); ?>
<?php $__env->startSection('custom-styles'); ?>
    <?php echo $__env->make('backend.layouts.datatable_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <section class="section bg-light">
        <div class="container-fluid py-2">
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-edit mrt-30">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form action="" class="filte-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="row gy-4">
                                            <h4>Search</h4>

                                            <input type="hidden" value="1" name="filter_id">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">Invoice No.</label>
                                                    <input type="text" class="form-control" placeholder="Invoice NO"
                                                        name="invoiceNo" value="<?php echo e(request()->get('invoiceNo')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">Tracking ID</label>

                                                    <input type="text" class="form-control" placeholder="Track ID"
                                                        name="trackId" value="<?php echo e(request()->get('trackId')); ?>">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">Mobile No</label>

                                                    <input type="number" class="form-control" placeholder="Mobile No"
                                                        name="phoneNumber" value="<?php echo e(request()->get('phoneNumber')); ?>">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">Start Date</label>

                                                    <input type="date" class="flatDate form-control"
                                                        placeholder="Date from" name="startDate"
                                                        value="<?php echo e(request()->get('startDate')); ?>">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">End Date</label>

                                                    <input type="date" class="flatDate form-control"
                                                        placeholder="Date to" name="endDate"
                                                        value="<?php echo e(request()->get('endDate')); ?>">
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

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <br>
                                    <br>
                                    <h3>All Percel List</h3>
                                    <div class="tab-inner table-responsive">
                                        <?php echo $__env->make('frontend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <table id="example" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Invoice No.</th>
                                                    <th>Tracking ID</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th width="100px">Status</th>
                                                    
                                                    <th>Total</th>
                                                    <th>Collected Amount</th>
                                                    
                                                    <th>Partial Return</th>
                                                    
                                                    <th>L. Update</th>
                                                    
                                                    <th>Note</th>
                                                    <th>More</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $allparcel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td><?php echo e($value->invoiceNo); ?></td>
                                                        <td><?php echo e($value->trackingCode); ?></td>
                                                        <td><?php echo e(date('d-m-Y', strtotime($value->created_at))); ?></td>
                                                        <td width="300px">
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
                                                        <td>
                                                            <?php
                                                                $parcelstatus = App\Models\Parceltype::find($value->status);
                                                            ?>
                                                            <?php echo e($parcelstatus->title); ?>

                                                            <?php if($value->status_description): ?>
                                                                <p class="desc text-start text-primary">[
                                                                    <?php echo e($value->status_description); ?> ]
                                                                </p>
                                                            <?php endif; ?>

                                                        </td>
                                                        
                                                        <td> <?php echo e($value->cod); ?></td>
                                                        <td> <?php echo e($value->collected_amount ?? '0'); ?></td>
                                                        
                                                        </td>
                                                        <td> <?php echo e($value->partial_return_amount); ?></td>
                                                        
                                                        </td>
                                                        <td><?php echo e(date('F d, Y', strtotime($value->updated_at))); ?>

                                                        </td>
                                                        
                                                        <td>
                                                            <?php
                                                                $parcelnote = App\Models\Parcelnote::where('parcelId', $value->id)
                                                                    ->orderBy('id', 'DESC')
                                                                    ->first();
                                                            ?>
                                                            <?php if(!empty($parcelnote)): ?>
                                                                <?php echo e($parcelnote->note); ?>

                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">

                                                                
                                                                
                                                                
                                                                <button class="btn btn-sm btn-sm btn-info" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#merchantParcel<?php echo e($value->id); ?>"
                                                                    title="View"><i class="las la-eye"></i></button>
                                                                <div id="merchantParcel<?php echo e($value->id); ?>"
                                                                    class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Parcel
                                                                                    Details</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <table class="table table-bordered">
                                                                                    <tr>
                                                                                        <td>Merchant Name</td>
                                                                                        <td><?php echo e($value->firstName); ?>

                                                                                            <?php echo e($value->lastName); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Merchant Phone</td>
                                                                                        <td>0<?php echo e($value->phoneNumber); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Merchant Email</td>
                                                                                        <td><?php echo e($value->emailAddress); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Company</td>
                                                                                        <td><?php echo e($value->companyName); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Recipient Name</td>
                                                                                        <td><?php echo e($value->recipientName); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Recipient Address</td>
                                                                                        <td><?php echo e($value->recipientAddress); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>COD</td>
                                                                                        <td><?php echo e($value->cod); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                    
                                                                                    
                                                                                    
                                                                                    <tr>
                                                                                        <td>Total Collected amount</td>
                                                                                        <td><?php echo e($value->merchantPaid); ?>

                                                                                        </td>
                                                                                    </tr>
                                                                                    
                                                                                </table>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal end -->
                                                                <?php if(in_array($value->status, [2, 3, 5, 6, 7, 8]) && $value->merchantPaid == 0): ?>
                                                                    <button class="btn btn-sm btn-success" title="Action"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#partial_payment<?php echo e($value->id); ?>   ">Partial
                                                                        Return</button>
                                                                <?php endif; ?>
                                                                <!-- Modal -->
                                                                <div id="partial_payment<?php echo e($value->id); ?>"
                                                                    class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    Partial Return</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="<?php echo e(route('deliveryman.partial.return')); ?>"
                                                                                    method="POST">

                                                                                    <?php echo csrf_field(); ?>
                                                                                    <input type="hidden" name="parcel_id"
                                                                                        value="<?php echo e($value->id); ?>">
                                                                                    <div class="form-group">
                                                                                        <label for=""> Partial
                                                                                            Return
                                                                                            Amount</label>
                                                                                        <input type="text"
                                                                                            name="partial_return_amount"
                                                                                            value="0"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for=""> Return Note
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="partial_return_note"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="form-group">
                                                                                        <button type="submit"
                                                                                            class="btn btn-success prSubmit">Update</button>
                                                                                    </div>

                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal end -->
                                                                <!-- Modal -->
                                                                <div id="sUpdateModal<?php echo e($value->id); ?>"
                                                                    class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    Status Update</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row gy-4">
                                                                                    <form
                                                                                        action="<?php echo e(route('deliveryman.parcel.statusupdate')); ?>"
                                                                                        method="POST">
                                                                                        <?php echo csrf_field(); ?>
                                                                                        <input type="hidden"
                                                                                            name="hidden_id"
                                                                                            value="<?php echo e($value->id); ?>">
                                                                                        <input type="hidden"
                                                                                            name="customer_phone"
                                                                                            value="<?php echo e($value->recipientPhone); ?>">
                                                                                        <div class="col-lg-12">
                                                                                            <select name="status"
                                                                                                onchange="parcelDelivery(this)"
                                                                                                class="form-control"
                                                                                                id="delivery_status">
                                                                                                <?php $__currentLoopData = $parceltypes->whereNotIn('id', [9]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ptvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <option
                                                                                                        value="<?php echo e($ptvalue->id); ?>"
                                                                                                        <?php if($value->status == $ptvalue->id): ?> selected="selected" <?php endif; ?>
                                                                                                        <?php if($value->status > $ptvalue->id && in_array($ptvalue->id, [1, 2, 6, 7, 8])): ?> disabled <?php endif; ?>>
                                                                                                        <?php echo e($ptvalue->title); ?>

                                                                                                    </option>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-lg-12"
                                                                                            id="collected_amount">
                                                                                            <label for="">Collected
                                                                                                Amount</label>
                                                                                            <input name="collected_amount"
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                value="<?php echo e($value->cod); ?>">
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                        <div class="col-lg-12">
                                                                                            <label
                                                                                                for="">Note</label>
                                                                                            <textarea name="deliveryman_note" class="form-control" cols="30" placeholder="Note"></textarea>
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                        
                                                                                        <br>
                                                                                        <!-- form group end -->
                                                                                        <div class="col-lg-12">
                                                                                            <button
                                                                                                class="btn btn-sm btn-success">Update</button>
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal end -->

                                                                <!-- <?php if($value->status >= 2): ?>
    -->
                                                                <!--<a class="btn btn-sm btn-primary" a href="<?php echo e(url('deliveryman/parcel/invoice/' . $value->id)); ?>"  title="Invoice"><i class="fas fa-list"></i></a>-->
                                                                <!--
    <?php endif; ?>-->
                                                                
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- row end -->
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
        $(document).ready(function() {
            $("#example").DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/pages/agent/percel/todayparcel.blade.php ENDPATH**/ ?>