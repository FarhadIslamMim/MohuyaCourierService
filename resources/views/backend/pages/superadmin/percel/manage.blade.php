@extends('backend.layouts.master')
@section('title', 'Parcel Manage')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .row_active{
            background-color: #908d8d;
        }
    </style>
@endsection
@section('main-content')
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
            @include('backend.layouts.notifications')
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="" class="filte-form">
                    @csrf
                    <div class="row">
                        <input type="hidden" value="1" name="filter_id">
                        <div class="col-sm-2">
                            <input type="text" class="form-control" placeholder="Tracking ID" name="trackId"
                                   value="{{ request()->get('trackId') }}">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="number" class="form-control" placeholder="Mobile No." name="phoneNumber"
                                   value="{{ request()->get('phoneNumber') }}">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="date" class="flatDate form-control" placeholder="Date From" name="startDate"
                                   value="{{ request()->get('startDate') }}">
                        </div>
                        <!-- col end -->
                        <div class="col-sm-2">
                            <input type="date" class="flatDate form-control" placeholder="Date To" name="endDate"
                                   value="{{ request()->get('endDate') }}">
                        </div>
                        <div class="col-sm-4">
                            <select name="merchantId" id="merchantId" class="form-control select2">
                                <option value=""> Select Merchant</option>
                                @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->id }}" @if (request()->get('merchantId') == $merchant->id) selected @endif>
                                        {{ $merchant->companyName }} ({{ $merchant->firstName }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <select name="per_page" id="per_page" class="form-control select2">
                                <option value="15" @if (request()->get('per_page') == '15') selected @endif> 15
                                </option>
                                <option value="25" @if (request()->get('per_page') == '25') selected @endif> 25
                                </option>
                                <option value="50" @if (request()->get('per_page') == '50') selected @endif> 50
                                </option>
                                <option value="100" @if (request()->get('per_page') == '100') selected @endif>
                                    100 </option>
                                <option value="300" @if (request()->get('per_page') == '300') selected @endif>
                                    300 </option>
                                <option value="all" @if (request()->get('per_page') == 'all') selected @endif>
                                    All </option>
                            </select>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <select id="division_id" name="division_id" class="form-control select2">
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <select id="district_id" name="district_id" class="form-control select2">
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="col-sm-2 mt-2">
                            {{-- <label for="">Select Division</label> --}}
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
                <form class="parcelForm" action="{{ route('percel.manage.select.update') }}" method="post">
                    @csrf
                    <div class="action_container my-1" style="width: 100%">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="updstatus" class="form-control select2" style="width: 170px;">
                                    <option value="" disabled selected>---Select One---</option>
                                    @foreach ($perceltypes as $i => $ptvalue)
                                        <option value="{{ $ptvalue->id }}">{{ $ptvalue->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-10">
                                <button class="btn btn-primary" type="submit" name="all_submit">Update</button>
                                <button class="btn btn-secondary generateButton" type="button">Generate Multiple Level</button>
                                <button class="btn btn-success pickupmanAssignButton" type="button" data-bs-toggle="modal" data-bs-target="#pickupmanAssignModal">Pickupman assign</button>
                                <button class="btn btn-info deliverymanAssignButton" type="button" data-bs-toggle="modal" data-bs-target="#deliverymanAssignModal">Deliveryman assign</button>
                                <button class="btn btn-warning Button" type="button" data-bs-toggle="modal" data-bs-target="#agentAssignModal">Agent assign</button>
                                <a class="btn btn-info Button" type="button" href="{{ route('scanner') }}">Scanner</a>
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
                                @if ($perceltype->id == 4)
                                    <th>Collected Amount</th>
                                @endif
                                <th>Actions</th>
                             </tr>
                            </thead>
                            <tbody id="reqtablenew">

                            @foreach ($show_data as $key => $value)
                                @php
                                    $merchant = App\Models\Merchant::find($value->merchantId);
                                    $agentInfo = App\Models\Agent::find($value->agentId);
                                    $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
                                    $pickupmanInfo = App\Models\Pickupman::find($value->pickupmanId);

                                    $deliverymans = App\Models\Deliveryman::where('status', 1)->get();
                                    $pickupmans = App\Models\Pickupman::where('status', 1)->get();
                                    $agents = App\Models\Agent::where('status', 1)->get();
                                @endphp
                                <tr>
                                    <td>
                                        @if ($value->status != 4)
                                            <input type="checkbox" name="parcel_select[]" class="parcel_check form-check-input" value="{{ $value->id }}">
                                        @endif
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->invoiceNo }}</td>
                                    <td>{{ $value->trackingCode }}</td>
                                    <td>{{ $merchant->companyName ?? '' }}</td>
                                    <td class="text-nowrap">
                                        <span><i class="las la-user"></i>{{ $value->recipientName }}</span><br>
                                        <span><i class="las la-phone"></i>{{ $value->recipientPhone }}
                                            @if ($value->alternative_mobile_no)
                                                , {{ $value->alternative_mobile_no }}
                                            @endif
                                            </span><br>
                                        <span><i class=" bx bx-location-plus"></i>
                                                @if ($value->delivery_address)
                                                {{ $value->delivery_address }},
                                            @endif
                                                <br>

                                                @if ($value->area_id)
                                                {{ $value->area ?? ' No Area' }},
                                            @endif
                                            {{-- MF Change start --}}
                                            @if ($value->thana_id)
                                                {{ $value->thana ?? ' No Thana' }},
                                            @endif
                                            @if ($value->district_id)
                                                {{ $value->district ?? 'No District' }},
                                            @endif
                                            @if ($value->division_id)
                                                {{ $value->division ?? 'No Division' }}
                                            @endif
                                            {{-- MF Change end --}}
                                            </span>
                                    </td>
                                    <td>
                                        @if ($value->agentId)
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agentModal{{ $value->id }}">{{ $agentInfo->name }}</button>
                                        @else
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#agentModal{{ $value->id }}">Assign</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($value->pickupmanId)
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pickupmanModal{{ $value->id }}">{{ $pickupmanInfo->name ?? '' }}</button>
                                        @else
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pickupmanModal{{ $value->id }}">Assign</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($value->deliverymanId)
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#asignModal{{ $value->id }}">{{ $deliverymanInfo->name ?? '' }}</button>
                                        @else
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#asignModal{{ $value->id }}">Assign</button>
                                        @endif
                                    </td>

                                    <td>{{ date('d M Y g:h:s A', strtotime($value->created_at)) }}</td>
                                    <td>{{ date('d M Y g:h:s A', strtotime($value->updated_at)) }}</td>
                                    <td>{{ $perceltype->title }}</td>
                                    <td class="text-nowrap">
                                        @if ($value->return_charge)
                                            <b>Collect from Merchant:</b>
                                            {{ ($value->deliveryCharge + $value->return_charge) }}
                                        @else
                                            <b>Total Amount :</b> {{ $value->cod }} <br>
                                            <b> Parcel Note: </b> {{ $value->note }} <br>
                                            <b>Delivery Charge :</b> {{ $value->deliveryCharge + $value->codCharge }}<br>
                                            <b> Partials Return :</b> {{ $value->partial_return_amount }} <br>
                                            <b>Return Note :</b> {{ $value->partial_return_note }}
                                        @endif
                                    </td>
                                    @if ($perceltype->id == 4)
                                        <td class="text-nowrap">
                                            <b> Customer paid :</b> {{ $value->collected_amount }} <br>
                                            <b> Delivery Note :</b> {{ $value->deliveryman_note ?? 'No note' }} <br>
                                            <!--<b>Delivery Charge :</b> {{ $value->deliveryCharge + $value->codCharge }}-->
                                            <!--<br>-->
                                            <b>Merchant Pay:</b>
                                            {{ $value->collected_amount - ($value->deliveryCharge + $value->codCharge) }}
                                        </td>
                                    @endif
                                    <td>
                                        <!-- Group Buttons Sizing -->
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a target="_blank" class="btn btn-primary btn-block"
                                               href="{{ route('percel.invioce', $value->id) }}" title="Invoice">
                                                <i class=" ri-file-list-fill"></i>
                                            </a>
                                            <a target="_blank" class="btn btn-primary btn-block"
                                               href="{{ route('percel.manage.generate.label', $value->id) }}"
                                               title="label generate"><i class="ri-barcode-fill"></i></a>

                                            <a href="{{ route('percel.edit', $value->id) }}" class="btn btn-primary btn-block" title="Edit" target="_blank"><i class="la la-edit"></i></a>
                                            <button type="button" class="btn btn-primary btn-block" href="#" data-bs-toggle="modal" data-bs-target="#merchantParcel{{ $value->id }}" title="View"><i class="la la-eye"></i></button>
                                            @if ($perceltype->id == 2 || $perceltype->id == 3)
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#sUpdateModal{{ $value->id }}" class="btn btn-info btn-block" title="Delivered"><i class="ri-bike-line"></i></a>
                                            @endif
                                            <div id="merchantParcel{{ $value->id }}" class="modal fade"
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
                                                                        <td>{{ $value->firstName }}
                                                                            {{ $value->lastName }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Mobile No</td>
                                                                        <td>{{ $value->phoneNumber }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Email address</td>
                                                                        <td>{{ $value->emailAddress }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Company Name</td>
                                                                        <td>{{ $value->companyName }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Receipt Name</td>
                                                                        <td>{{ $value->recipientName }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Recipient Address</td>
                                                                        <td>{{ $value->recipientAddress }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>COD</td>
                                                                        <td>{{ $value->cod }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Cod Charge</td>
                                                                        <td>{{ $value->codCharge }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Delivery Charge</td>
                                                                        <td>Partial Return</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Sub Total</td>
                                                                        <td>{{ $value->partial_return_amount }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Paid</td>
                                                                        <td>{{ $value->merchantAmount }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Due</td>
                                                                        <td>{{ $value->merchantPaid }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ __('lang.weight') }}</td>
                                                                        <td>{{ $value->productWeight }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>{{ __('lang.return_note') }}</td>
                                                                        <td>{{ $value->partial_return_note }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Last Update</td>
                                                                        <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
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
                                            <div id="sUpdateModal{{ $value->id }}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Status Update</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row gy-4">
                                                                <form>
                                                                    @csrf
                                                                    <input type="hidden" name="updstatus_delivery" value="4">
                                                                    <input type="hidden" name="deliveryman_id" value="{{ $value->deliverymanId }}">
                                                                    <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                                                                    <input type="hidden" name="customer_phone" value="{{ $value->recipientPhone }}">

                                                                    <div class="col-lg-12" id="collected_amount">
                                                                        <label for="">Collected Amount</label>
                                                                        <input name="collected_amount" type="number" class="form-control" value="{{ $value->cod }}">
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
                                            @if (in_array($value->status, [2, 3]))
                                                @can('parcel_edit')
                                                    <button title="Partial Return" type="button"
                                                            class="btn btn-primary btn-block" data-bs-toggle="modal"
                                                            data-bs-target="#partial_return{{ $value->id }}"><i
                                                            class=" las la-dollar-sign"></i>
                                                    </button>
                                                @endcan
                                            @endif
                                            <div id="partial_return{{ $value->id }}" class="modal fade"
                                                 role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"> Partial Return </h5>
                                                        </div>
                                                        <form action="{{ route('parcel.partial.return') }}"
                                                              method="POST">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="parcel_id"
                                                                       value="{{ $value->id }}">
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
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="pagination-area">
                    <div class="pagination-wrapper d-flex justify-content-center align-items-center">
                        @if (request()->get('per_page') != 'all')
                            {{ $show_data->links() }}
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- percel create content end -->
@endsection

{{-- custom modal --}}
@section('custom-modal')

    <!-- modal section-->
    @foreach ($show_data as $key => $value)
        @php
            $merchant = App\Models\Merchant::find($value->merchantId);
            $agentInfo = App\Models\Agent::find($value->agentId);
            $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
            $pickupmanInfo = App\Models\Pickupman::find($value->pickupmanId);
            $pickupmen = App\Models\Pickupman::where('district_id', $value->district_id)->get();
        @endphp
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
                                        @foreach ($pickupmans as $pmaninfo)
                                            <option value="{{ $pmaninfo->id }}">
                                                {{ $pmaninfo->name }}</option>
                                        @endforeach
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
                                        @foreach ($deliverymans as $dmaninfo)
                                            <option value="{{ $dmaninfo->id }}">
                                                {{ $dmaninfo->name }}</option>
                                        @endforeach
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
                                        @foreach ($agents as $agentinfo)
                                            <option value="{{ $agentinfo->id }}">
                                                {{ $agentinfo->name }}</option>
                                        @endforeach
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
        <div id="pickupmanModal{{ $value->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pickupman Assign</h5>
                    </div>
                    <div class="modal-body">
                        <form id="pickupman" action="{{ route('percel.pickupman.assign') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                            <input type="hidden" name="merchant_phone" value="{{ $merchant->phoneNumber ?? '' }}">
                            <div class="form-group">
                                <select name="pickupmanId" class="form-control select2" id="">
                                    <option value="">Select</option>
                                    @foreach ($pickupmen as $key => $pickupman)
                                        <option value="{{ $pickupman->id }}">{{ $pickupman->name }} -
                                            {{ $pickupman->phone }}</option>
                                    @endforeach
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
        <div id="asignModal{{ $value->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                @php
                    $parcel_deliverymen = App\Models\Deliveryman::where('district_id', $value->district_id)->get();
                @endphp
                    <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deliveryman assign</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('percel.deliveryman.assign') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                            <input type="hidden" name="merchant_phone" value="{{ $merchant->phoneNumber ?? '' }}">
                            <div class="form-group">
                                <select name="deliverymanId" class="form-control select2" id="">
                                    <option value="">Select</option>
                                    @foreach ($parcel_deliverymen as $key => $deliveryman)
                                        <option value="{{ $deliveryman->id }}">{{ $deliveryman->name }} -
                                            {{ $deliveryman->phone }}</option>
                                    @endforeach
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
        <div id="agentModal{{ $value->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                @php
                    $parcel_agents = App\Models\Agent::where('district_id', $value->district_id)->get();
                @endphp
                    <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Agent Assign</h5>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('percel.agent.assign') }}" method="POST">
                            @csrf
                            <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                            <input type="hidden" name="merchant_phone" value="{{ $merchant->phoneNumber ?? '' }}">
                            <div class="form-group">
                                <select name="agentId" class="form-control" id="">
                                    <option value="">Select</option>
                                    @foreach ($parcel_agents as $key => $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }} -
                                            {{ $agent->phone }}</option>
                                    @endforeach
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
    @endforeach


    {{-- partial returns modal --}}

@endsection
{{-- custom modal end --}}
@section('custom-scripts')

    @include('backend.layouts.datatable_scripts')
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
                    url: "{{ route('get_division_districts') }}",
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
                    url: "{{ route('get_district_thanas') }}",
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
                    url: "{{ route('get_thana_deliverymen_pickupman') }}",
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
                let url = '{{ route('percel.manage.generate.multi.label') }}';
                form.attr('action', url);
                form.submit();
            });

            // pickupman assign
            pmanBtn.on('click', function() {
                let tempPman = $('.multi_pickupman_id').val();
                pmanInput.val(tempPman);
                let url = '{{ route('percel.manage.assign.pickupman.multi') }}';
                form.attr('action', url);
                form.submit();
            });

            // deliveryman assign
            dmanBtn.on('click', function() {
                let tempDman = $('.multi_deliveryman_id').val();
                dmanInput.val(tempDman);
                let url = '{{ route('percel.manage.assign.deliveryman.multi') }}';
                form.attr('action', url);
                form.submit();

            });

            // agent assign
            agentBtn.on('click', function() {
                let tempAgent = $('.multi_agent_id').val();
                agentInput.val(tempAgent);
                let url = '{{ route('percel.manage.assign.agent.multi') }}';
                form.attr('action', url);
                form.submit();
            });

            // partian return submit
            prSubmit.on('click', function() {
                let url = '{{ route('parcel.partial.return') }}';
                form.attr('action', url);
                form.submit();
            });

            // partian return submit
            deliverySubmit.on('click', function() {
                let url = '{{ route('deliver.percel') }}';
                form.attr('action', url);
                form.submit();
            });

        });
    </script>
@endsection
