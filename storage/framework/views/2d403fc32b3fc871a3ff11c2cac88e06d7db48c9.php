
<?php $__env->startSection('title', 'Parcel Manage'); ?>
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
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Parcel Manage</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel</a></li>
                        <li class="breadcrumb-item active">Parcel Manage</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- parcel create content start -->
    <div class="row">
        <div class="col-xl-12">
            <?php echo $__env->make('backend.layouts.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="" class="filte-form">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <input type="hidden" value="1" name="filter_id">
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="Tracking ID" name="trackId"
                                   value="<?php echo e(request()->get('trackId')); ?>">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="number" class="form-control" placeholder="Mobile No." name="phoneNumber"
                                   value="<?php echo e(request()->get('phoneNumber')); ?>">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="date" class="flatDate form-control" placeholder="Date From" name="startDate"
                                   value="<?php echo e(request()->get('startDate')); ?>">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="date" class="flatDate form-control" placeholder="Date To" name="endDate"
                                   value="<?php echo e(request()->get('endDate')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <select name="merchantId" id="merchantId" class="form-control select2">
                                <option value=""> Select Merchant</option>
                                <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($merchant->id); ?>" <?php if(request()->get('merchantId') == $merchant->id): ?> selected <?php endif; ?>>
                                        <?php echo e($merchant->companyName); ?> (<?php echo e($merchant->firstName); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <select name="per_page" id="per_page" class="form-control select2">
                                <option value="15" <?php if(request()->get('per_page') == '15'): ?> selected <?php endif; ?>> 15
                                </option>
                                <option value="25" <?php if(request()->get('per_page') == '25'): ?> selected <?php endif; ?>> 25
                                </option>
                                <option value="50" <?php if(request()->get('per_page') == '50'): ?> selected <?php endif; ?>> 50
                                </option>
                                <option value="100" <?php if(request()->get('per_page') == '100'): ?> selected <?php endif; ?>>
                                    100 </option>
                                <option value="300" <?php if(request()->get('per_page') == '300'): ?> selected <?php endif; ?>>
                                    300 </option>
                                <option value="all" <?php if(request()->get('per_page') == 'all'): ?> selected <?php endif; ?>>
                                    All </option>
                            </select>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <select id="division_id" name="division_id" class="form-control select2">
                                <option value="">Select Division</option>
                                <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($division->id); ?>"><?php echo e($division->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <select id="district_id" name="district_id" class="form-control select2">
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="col-sm-2 mt-2">
                            
                            <select id="thana_id" name="thana_id" class="form-control select2">
                                <option value="">Select Thana</option>
                            </select>
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2 my-2">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        <!-- col end -->
                    </div>
                </form>
            </div>
            <br>
            <div class="card-body">
                <form class="parcelForm" action="<?php echo e(route('percel.manage.select.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="action_container my-1" style="width: 100%">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="updstatus" class="form-control select2" style="width: 170px;">
                                    <option value="" disabled selected>---Select One---</option>
                                    <?php $__currentLoopData = $perceltypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ptvalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ptvalue->id); ?>"><?php echo e($ptvalue->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-10">
                                <button class="btn btn-primary" type="submit" name="all_submit">Update</button>
                                <button class="btn btn-secondary generateButton" type="button">Generate Multiple Level</button>
                                <button class="btn btn-success pickupmanAssignButton" type="button" data-bs-toggle="modal" data-bs-target="#pickupmanAssignModal">Pickupman assign</button>
                                <button class="btn btn-info deliverymanAssignButton" type="button" data-bs-toggle="modal" data-bs-target="#deliverymanAssignModal">Deliveryman assign</button>
                                <button class="btn btn-warning Button" type="button" data-bs-toggle="modal" data-bs-target="#agentAssignModal">Agent assign</button>
                                <a class="btn btn-info Button" type="button" href="<?php echo e(route('scanner')); ?>">Scanner</a>
                            </div>
                        </div>
                        <!--multiple parcel assign-->
                        <input type="hidden" name="pickupman_assign_id" class="pickupman_assign_id">
                        <input type="hidden" name="deliveryman_assign_id" class="deliveryman_assign_id">
                        <input type="hidden" name="agent_assign_id" class="agent_assign_id">
                        <!--multiple parcel assign-->
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead class="table-light">
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="select-all">
                                        <label class="form-check-label" for="responsivetableCheck"></label>
                                    </div>
                                </th>
                                <th>SL</th>
                                <th>Invoice No</th>
                                <th width="10">Track ID</th>
                                <th>Merchant Name</th>
                                <th>Customer</th>
                                <th>Agent</th>
                                <th>Pickupman</th>
                                <th>Deliveryman</th>
                                <th>Created Date</th>
                                <th>Last Update</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <?php if($perceltype->id == 4): ?>
                                    <th>Collected Amount</th>
                                <?php endif; ?>
                                <th>Actions</th>
                             </tr>
                            </thead>
                            <tbody id="reqtablenew">

                            <?php $__currentLoopData = $show_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $merchant = App\Models\Merchant::find($value->merchantId);
                                    $agentInfo = App\Models\Agent::find($value->agentId);
                                    $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
                                    $pickupmanInfo = App\Models\Pickupman::find($value->pickupmanId);

                                    $deliverymans = App\Models\Deliveryman::where('status', 1)->get();
                                    $pickupmans = App\Models\Pickupman::where('status', 1)->get();
                                    $agents = App\Models\Agent::where('status', 1)->get();
                                ?>
                                <tr>
                                    <td>
                                        <?php if($value->status != 4): ?>
                                            <input type="checkbox" name="parcel_select[]" class="parcel_check form-check-input" value="<?php echo e($value->id); ?>">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($value->invoiceNo); ?></td>
                                    <td><?php echo e($value->trackingCode); ?></td>
                                    <td><?php echo e($merchant->companyName ?? ''); ?></td>
                                    <td class="text-nowrap">
                                        <span><i class="las la-user"></i><?php echo e($value->recipientName); ?></span><br>
                                        <span><i class="las la-phone"></i><?php echo e($value->recipientPhone); ?>

                                            <?php if($value->alternative_mobile_no): ?>
                                                , <?php echo e($value->alternative_mobile_no); ?>

                                            <?php endif; ?>
                                            </span><br>
                                        <span><i class=" bx bx-location-plus"></i>
                                                <?php if($value->delivery_address): ?>
                                                <?php echo e($value->delivery_address); ?>,
                                            <?php endif; ?>
                                                <br>

                                                <?php if($value->area_id): ?>
                                                <?php echo e($value->area ?? ' No Area'); ?>,
                                            <?php endif; ?>
                                            
                                            <?php if($value->thana_id): ?>
                                                <?php echo e($value->thana ?? ' No Thana'); ?>,
                                            <?php endif; ?>
                                            <?php if($value->district_id): ?>
                                                <?php echo e($value->district ?? 'No District'); ?>,
                                            <?php endif; ?>
                                            <?php if($value->division_id): ?>
                                                <?php echo e($value->division ?? 'No Division'); ?>

                                            <?php endif; ?>
                                            
                                            </span>
                                    </td>
                                    <td>
                                        <?php if($value->agentId): ?>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agentModal<?php echo e($value->id); ?>"><?php echo e($agentInfo->name); ?></button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agentModal<?php echo e($value->id); ?>">Assign</button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($value->pickupmanId): ?>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pickupmanModal<?php echo e($value->id); ?>"><?php echo e($pickupmanInfo->name ?? ''); ?></button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pickupmanModal<?php echo e($value->id); ?>">Assign</button>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($value->deliverymanId): ?>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#asignModal<?php echo e($value->id); ?>"><?php echo e($deliverymanInfo->name ?? ''); ?></button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#asignModal<?php echo e($value->id); ?>">Assign</button>
                                        <?php endif; ?>
                                    </td>

                                    <td><?php echo e(date('d M Y g:h:s A', strtotime($value->created_at))); ?></td>
                                    <td><?php echo e(date('d M Y g:h:s A', strtotime($value->updated_at))); ?></td>
                                    <td><?php echo e($perceltype->title); ?></td>
                                    <td class="text-nowrap">
                                        <?php if($value->return_charge): ?>
                                            <b>Collect from Merchant:</b>
                                            <?php echo e(($value->deliveryCharge + $value->return_charge)); ?>

                                        <?php else: ?>
                                            <b>Total Amount :</b> <?php echo e($value->cod); ?> <br>
                                            <b> Parcel Note: </b> <?php echo e($value->note); ?> <br>
                                            <b>Delivery Charge :</b> <?php echo e($value->deliveryCharge + $value->codCharge); ?><br>
                                            <b> Partials Return :</b> <?php echo e($value->partial_return_amount); ?> <br>
                                            <b>Return Note :</b> <?php echo e($value->partial_return_note); ?>

                                        <?php endif; ?>
                                    </td>
                                    <?php if($perceltype->id == 4): ?>
                                        <td class="text-nowrap">
                                            <b> Customer paid :</b> <?php echo e($value->collected_amount); ?> <br>
                                            <b> Delivery Note :</b> <?php echo e($value->deliveryman_note ?? 'No note'); ?> <br>
                                            <!--<b>Delivery Charge :</b> <?php echo e($value->deliveryCharge + $value->codCharge); ?>-->
                                            <!--<br>-->
                                            <b>Merchant Pay:</b>
                                            <?php echo e($value->collected_amount - ($value->deliveryCharge + $value->codCharge)); ?>

                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <!-- Group Buttons Sizing -->
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a target="_blank" class="btn btn-primary btn-block"
                                               href="<?php echo e(route('percel.invioce', $value->id)); ?>" title="Invoice">
                                                <i class=" ri-file-list-fill"></i>
                                            </a>
                                            <a target="_blank" class="btn btn-primary btn-block"
                                               href="<?php echo e(route('percel.manage.generate.label', $value->id)); ?>"
                                               title="label generate"><i class="ri-barcode-fill"></i></a>

                                            <a href="<?php echo e(route('percel.edit', $value->id)); ?>" class="btn btn-primary btn-block" title="Edit" target="_blank"><i class="la la-edit"></i></a>
                                            <button type="button" class="btn btn-primary btn-block" href="#" data-bs-toggle="modal" data-bs-target="#merchantParcel<?php echo e($value->id); ?>" title="View"><i class="la la-eye"></i></button>
                                            <?php if($perceltype->id == 2 || $perceltype->id == 3): ?>
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#sUpdateModal<?php echo e($value->id); ?>" class="btn btn-info btn-block" title="Delivered"><i class="ri-bike-line"></i></a>
                                            <?php endif; ?>
                                            <div id="merchantParcel<?php echo e($value->id); ?>" class="modal fade"
                                                 role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Parcel Details</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <td>Merchant Name</td>
                                                                        <td><?php echo e($value->firstName); ?>

                                                                            <?php echo e($value->lastName); ?>

                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Mobile No</td>
                                                                        <td><?php echo e($value->phoneNumber); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Email address</td>
                                                                        <td><?php echo e($value->emailAddress); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Company Name</td>
                                                                        <td><?php echo e($value->companyName); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Receipt Name</td>
                                                                        <td><?php echo e($value->recipientName); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Recipient Address</td>
                                                                        <td><?php echo e($value->recipientAddress); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>COD</td>
                                                                        <td><?php echo e($value->cod); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Cod Charge</td>
                                                                        <td><?php echo e($value->codCharge); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Delivery Charge</td>
                                                                        <td>Partial Return</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sub Total</td>
                                                                        <td><?php echo e($value->partial_return_amount); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Paid</td>
                                                                        <td><?php echo e($value->merchantAmount); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Due</td>
                                                                        <td><?php echo e($value->merchantPaid); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><?php echo e(__('lang.weight')); ?></td>
                                                                        <td><?php echo e($value->productWeight); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><?php echo e(__('lang.return_note')); ?></td>
                                                                        <td><?php echo e($value->partial_return_note); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Last Update</td>
                                                                        <td><?php echo e(date('F d, Y', strtotime($value->updated_at))); ?></td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="sUpdateModal<?php echo e($value->id); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Status Update</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row gy-4">
                                                                <form>
                                                                    <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="updstatus_delivery" value="4">
                                                                    <input type="hidden" name="deliveryman_id" value="<?php echo e($value->deliverymanId); ?>">
                                                                    <input type="hidden" name="hidden_id" value="<?php echo e($value->id); ?>">
                                                                    <input type="hidden" name="customer_phone" value="<?php echo e($value->recipientPhone); ?>">

                                                                    <div class="col-lg-12" id="collected_amount">
                                                                        <label for="">Collected Amount</label>
                                                                        <input name="collected_amount" type="number" class="form-control" value="<?php echo e($value->cod); ?>">
                                                                    </div>
                                                                    <!-- form group end -->
                                                                    <div class="col-lg-12">
                                                                        <label for="">Note</label>
                                                                        <textarea name="deliveryman_note" class="form-control" cols="30" placeholder="Note"></textarea>
                                                                    </div>
                                                                    <br>
                                                                    <!-- form group end -->
                                                                    <div class="col-lg-12">
                                                                        <button class="btn btn-sm btn-success deliverySubmit">Update</button>
                                                                    </div>
                                                                    <!-- form group end -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal end -->
                                            <?php if(in_array($value->status, [2, 3])): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('parcel_edit')): ?>
                                                    <button title="Partial Return" type="button"
                                                            class="btn btn-primary btn-block" data-bs-toggle="modal"
                                                            data-bs-target="#partial_return<?php echo e($value->id); ?>"><i
                                                            class=" las la-dollar-sign"></i>
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <div id="partial_return<?php echo e($value->id); ?>" class="modal fade"
                                                 role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Partial Return </h5>
                                                        </div>
                                                        <form action="<?php echo e(route('parcel.partial.return')); ?>"
                                                              method="POST">
                                                            <div class="modal-body">
                                                                <?php echo csrf_field(); ?>
                                                                <input type="hidden" name="parcel_id"
                                                                       value="<?php echo e($value->id); ?>">
                                                                <div class="form-group">
                                                                    <label for=""> Partial Return
                                                                        Amount</label>
                                                                    <input type="text" name="partial_return_amount"
                                                                           value="0" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for=""> Return Note </label>
                                                                    <input type="text" name="partial_return_note"
                                                                           class="form-control">
                                                                </div>
                                                                <br>
                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                            class="btn btn-success prSubmit">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="pagination-area">
                    <div class="pagination-wrapper d-flex justify-content-center align-items-center">
                        <?php if(request()->get('per_page') != 'all'): ?>
                            <?php echo e($show_data->links()); ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- percel create content end -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('custom-modal'); ?>

    <!-- modal section-->
    <?php $__currentLoopData = $show_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $merchant = App\Models\Merchant::find($value->merchantId);
            $agentInfo = App\Models\Agent::find($value->agentId);
            $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
            $pickupmanInfo = App\Models\Pickupman::find($value->pickupmanId);
            $pickupmen = App\Models\Pickupman::where('district_id', $value->district_id)->get();
        ?>
            <!--pickupman assign modal-->

        <!-- Modal -->
        <div class="modal fade" id="pickupmanAssignModal" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Pickupman
                            assign</h5>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Pickupman</label>
                                    <select name="multi_pickupman_id" class="form-control multi_pickupman_id">
                                        <option value="">Select pickupman</option>
                                        <?php $__currentLoopData = $pickupmans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pmaninfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pmaninfo->id); ?>">
                                                <?php echo e($pmaninfo->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" data-bs-dismiss="modal"
                                class="btn btn-primary pmanSubmitBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!--pickupman assign modal-->


        <!--deliveryman assign modal-->

        <!-- Modal -->
        <div class="modal fade" id="deliverymanAssignModal" data-bs-backdrop="static" data-bs-keyboard="false"
             tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">
                            Deliveryman Assign</h5>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Deliveryman</label>
                                    <select name="multi_deliveryman_id" class="form-control multi_deliveryman_id">
                                        <option value="">Select deliveryman</option>
                                        <?php $__currentLoopData = $deliverymans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dmaninfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($dmaninfo->id); ?>">
                                                <?php echo e($dmaninfo->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" data-bs-dismiss="modal"
                                class="btn btn-primary dmanSubmitBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!--deliveryman assign modal-->

        <!--agent assign modal-->

        <!-- Modal -->
        <div class="modal fade" id="agentAssignModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title text-light" id="staticBackdropLabel">Agent
                            assign</h5>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Agent</label>
                                    <select name="multi_agent_id" class="form-control multi_agent_id">
                                        <option value="">Select Agent</option>
                                        <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agentinfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($agentinfo->id); ?>">
                                                <?php echo e($agentinfo->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" data-bs-dismiss="modal"
                                class="btn btn-primary agentSubmitBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!--agent assign modal-->


        <!-- Modal -->
        <div id="pickupmanModal<?php echo e($value->id); ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pickupman Assign</h5>
                    </div>
                    <div class="modal-body">
                        <form id="pickupman" action="<?php echo e(route('percel.pickupman.assign')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="hidden_id" value="<?php echo e($value->id); ?>">
                            <input type="hidden" name="merchant_phone" value="<?php echo e($merchant->phoneNumber ?? ''); ?>">
                            <div class="form-group">
                                <select name="pickupmanId" class="form-control select2" id="">
                                    <option value="">Select</option>
                                    <?php $__currentLoopData = $pickupmen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pickupman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($pickupman->id); ?>"><?php echo e($pickupman->name); ?> -
                                            <?php echo e($pickupman->phone); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <!-- form group end -->
                            <br>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                            <!-- form group end -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->

        <!-- Modal -->
        <div id="asignModal<?php echo e($value->id); ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <?php
                    $parcel_deliverymen = App\Models\Deliveryman::where('district_id', $value->district_id)->get();
                ?>
                    <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deliveryman assign</h5>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('percel.deliveryman.assign')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="hidden_id" value="<?php echo e($value->id); ?>">
                            <input type="hidden" name="merchant_phone" value="<?php echo e($merchant->phoneNumber ?? ''); ?>">
                            <div class="form-group">
                                <select name="deliverymanId" class="form-control select2" id="">
                                    <option value="">Select</option>
                                    <?php $__currentLoopData = $parcel_deliverymen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $deliveryman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($deliveryman->id); ?>"><?php echo e($deliveryman->name); ?> -
                                            <?php echo e($deliveryman->phone); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <!-- form group end -->
                            <!-- form group end -->
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                            <!-- form group end -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->

        <!-- Modal -->
        <div id="agentModal<?php echo e($value->id); ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <?php
                    $parcel_agents = App\Models\Agent::where('district_id', $value->district_id)->get();
                ?>
                    <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agent Assign</h5>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('percel.agent.assign')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="hidden_id" value="<?php echo e($value->id); ?>">
                            <input type="hidden" name="merchant_phone" value="<?php echo e($merchant->phoneNumber ?? ''); ?>">
                            <div class="form-group">
                                <select name="agentId" class="form-control" id="">
                                    <option value="">Select</option>
                                    <?php $__currentLoopData = $parcel_agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($agent->id); ?>"><?php echo e($agent->name); ?> -
                                            <?php echo e($agent->phone); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <br>

                            <!-- form group end -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                            <!-- form group end -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    

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
        $(document).ready(function() {
            $("#datatable").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel',
                ],
                searching: true,
                paging: false,
            });
        });
    </script>


    <script>
        $(function() {
            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_division_districts')); ?>",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#district_id').html(options);
                });
            })
            //Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value=""> Select Thana </option>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_district_thanas')); ?>",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#thana_id').html(options);
                });
            })
            // Get Deliveryman & Pickupman
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var deliverymans = '<option value=""> Select Deliveryman </option>';
                var pickupmans = '<option value=""> Select Pickupman </option>';
                $.ajax({
                    method: "GET",
                    url: "<?php echo e(route('get_thana_deliverymen_pickupman')); ?>",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response.deliverymens);
                    var deliveryman_data = response.deliverymens;
                    var pickupman_data = response.pickupmens;
                    if (deliveryman_data) {
                        deliveryman_data.forEach(function(item, i) {
                            deliverymans += '<option value="' + item.id + '"> ' + item
                                .name + ' - ' + item.phone + ' </option>';
                        });
                    }
                    if (pickupman_data) {
                        pickupman_data.forEach(function(item, i) {
                            pickupmans += '<option value="' + item.id + '"> ' + item.name +
                                ' - ' + item.phone + ' </option>';
                        });
                    }
                    $('#deliverymen_id').html(deliverymans);
                    $('#pickupman_id').html(pickupmans);
                });
            })
        })
    </script>
    <script>
        //custome script
        $('#select-all').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('.partial_return').click(function() {
            // alert('done');
            $('#partial_return').modal('show');
        })

        // function selectRow(parent) {
        //     let par = parent;
        //     document.getElementByTagName('tr').style.background = "#ffffff";
        //     par.style.background = "#ddd";
        // }

        //   function clearSelect(parent) {
        //       console.log(parent);
        //       let par = parent;
        //       par.style.background = "#fff";
        //   }

        $(document).ready(function() {
            // $('table tr').each(function(a, b) {
            //     $(b).click(function() {
            //         $('table tr').css('background', '#ffffff');
            //         $(this).css('background', '#ddd');
            //     });
            // });


            //form
            let form = $('.parcelForm');
            let generateBtn = $('.generateButton');
            let pmanBtn = $('.pmanSubmitBtn');
            let dmanBtn = $('.dmanSubmitBtn');
            let agentBtn = $('.agentSubmitBtn');
            let prSubmit = $('.prSubmit');
            let deliverySubmit = $('.deliverySubmit');
            // hidden input field

            let pmanInput = $('.pickupman_assign_id');
            let dmanInput = $('.deliveryman_assign_id');
            let agentInput = $('.agent_assign_id');

            // hidden input field

            generateBtn.on('click', function() {
                let url = '<?php echo e(route('percel.manage.generate.multi.label')); ?>';
                form.attr('action', url);
                form.submit();
            });

            // pickupman assign
            pmanBtn.on('click', function() {
                let tempPman = $('.multi_pickupman_id').val();
                pmanInput.val(tempPman);
                let url = '<?php echo e(route('percel.manage.assign.pickupman.multi')); ?>';
                form.attr('action', url);
                form.submit();
            });

            // deliveryman assign
            dmanBtn.on('click', function() {
                let tempDman = $('.multi_deliveryman_id').val();
                dmanInput.val(tempDman);
                let url = '<?php echo e(route('percel.manage.assign.deliveryman.multi')); ?>';
                form.attr('action', url);
                form.submit();

            });

            // agent assign
            agentBtn.on('click', function() {
                let tempAgent = $('.multi_agent_id').val();
                agentInput.val(tempAgent);
                let url = '<?php echo e(route('percel.manage.assign.agent.multi')); ?>';
                form.attr('action', url);
                form.submit();
            });

            // partian return submit
            prSubmit.on('click', function() {
                let url = '<?php echo e(route('parcel.partial.return')); ?>';
                form.attr('action', url);
                form.submit();
            });

            // partian return submit
            deliverySubmit.on('click', function() {
                let url = '<?php echo e(route('deliver.percel')); ?>';
                form.attr('action', url);
                form.submit();
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/pages/superadmin/percel/manage.blade.php ENDPATH**/ ?>