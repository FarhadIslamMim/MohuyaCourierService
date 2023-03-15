@extends('frontend.layouts.master')
@section('title', 'Percel Create')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')

@endsection
@section('main-content')
    <section class="section bg-light">
        <div class="container-fluid py-4 px-4">
            <div class="row">
                <div class="col-lg-12">
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
                                    <input type="date" class="flatDate form-control" placeholder="Date From"
                                        name="startDate" value="{{ request()->get('startDate') }}">
                                </div>
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <input type="date" class="flatDate form-control" placeholder="Date To" name="endDate"
                                        value="{{ request()->get('endDate') }}">
                                </div>
                                {{-- <div class="col-sm-2">
                                    <input type="number" class="form-control" placeholder="Merchant Id"
                                        name="merchantId" value="{{ request()->get('merchantId') }}">
                                </div> --}}
                                <!-- col end -->
                                <div class="col-sm-4">
                                    <select name="merchantId" id="merchantId" class="form-control select2">
                                        <option value=""> Select Merchant</option>
                                        @foreach ($merchants as $merchant)
                                            <option value="{{ $merchant->id }}"
                                                @if (request()->get('merchantId') == $merchant->id) selected @endif>
                                                {{ $merchant->companyName }} ({{ $merchant->firstName }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-2 mt-2">
                                    <select name="per_page" id="per_page" class="form-control select2">
                                        <option value="10" @if (request()->get('per_page') == '10') selected @endif> 10
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
                                    {{-- <label for="">Select Division</label> --}}
                                    <select id="division_id" name="division_id" class="form-control select2">
                                        <option value="">Select Divison</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- col end -->
                                <!-- col end -->
                                <div class="col-sm-2 mt-2">
                                    {{-- <label for="">Select Division</label> --}}
                                    <select id="district_id" name="district_id" class="form-control select2">
                                        <option value="">Select District</option>

                                    </select>
                                </div>
                                <!-- col end -->
                                <!-- col end -->
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
                    <div class="card-body">
                        <form class="parcelForm" action="{{ route('percel.manage.select.update') }}" method="post">
                            @csrf
                            <div class="action_container my-1" style="width: 100%">
                                <div class="row">
                                    <div class="col-md-2">
                                        <select name="updstatus" class="form-control select2" style="width: 170px;">
                                            @foreach ($perceltypes as $i => $ptvalue)
                                                <option value="{{ $ptvalue->id }}">{{ $ptvalue->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-10">
                                        <button class="btn btn-primary" type="submit" name="all_submit">
                                            Update
                                        </button>

                                        <button class="btn btn-secondary generateButton" type="button">
                                            Generate Multiple Level
                                        </button>
                                        <button class="btn btn-success pickupmanAssignButton" type="button"
                                            data-bs-toggle="modal" data-bs-target="#pickupmanAssignModal">
                                            Pickupman assign
                                        </button>
                                        <button class="btn btn-info deliverymanAssignButton" type="button"
                                            data-bs-toggle="modal" data-bs-target="#deliverymanAssignModal">
                                            Deliveryman assign
                                        </button>
                                        <button class="btn btn-warning Button" type="button" data-bs-toggle="modal"
                                            data-bs-target="#agentAssignModal">
                                            Agent assign
                                        </button>
                                        <a class="btn btn-info Button" type="button" href="{{ route('scanner') }}">
                                            Scanner
                                        </a>
                                    </div>
                                </div>

                                <!--multiple parcel assign-->

                                <input type="hidden" name="pickupman_assign_id" class="pickupman_assign_id">
                                <input type="hidden" name="deliveryman_assign_id" class="deliveryman_assign_id">
                                <input type="hidden" name="agent_assign_id" class="agent_assign_id">

                                <!--multiple parcel assign-->


                            </div>
                            <div class="table-responsive">
                                <table id="datatable" class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="select-all">
                                                    <label class="form-check-label" for="responsivetableCheck"></label>
                                                </div>
                                                {{-- <input type="checkbox" id="select-all">Select all --}}
                                            </th>
                                            <th>SL</th>
                                            <th>Invoice No</th>
                                            <th width="10">Track ID</th>
                                            <th>Marchant Name</th>
                                            {{-- <th>@lang('common.company_name')</th> --}}
                                            <th>Customer</th>
                                            {{-- <th>@lang('common.recipient_name')</th> --}}
                                            {{-- <th>Customer Phone No.</th> --}}
                                            {{-- <th>@lang('common.mobile_no')</th> --}}
                                            <th>Agent</th>

                                            <th>Pickupman</th>
                                            <th>Deliveryman</th>
                                            {{-- <th width="300">Address</th> --}}
                                            <th>Created</th>
                                            <th>L. Update</th>
                                            <th>Status</th>
                                            @if ($perceltype->id == 4)
                                                <th>Rider Info</th>
                                            @endif
                                            {{-- <th>Status Description</th> --}}
                                            {{-- <th>Parcel Type</th> --}}
                                            <th>Amount</th>
                                            {{-- <th>Charge</th> --}}
                                            {{-- <th>Partial Return</th> --}}
                                            {{-- <th>Sub Total</th>/ --}}
                                            {{-- <th>Actual Price</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                                        <input type="checkbox" name="parcel_select[]"
                                                            class="parcel_check form-check-input"
                                                            value="{{ $value->id }}">
                                                    @endif
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->invoiceNo }}</td>
                                                <td>{{ $value->trackingCode }}</td>

                                                <td>{{ $merchant->companyName ?? '' }}</td>
                                                <td class="text-nowrap">
                                                    <span><i
                                                            class="las la-user"></i>{{ $value->recipientName }}</span><br>
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
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#agentModal{{ $value->id }}">{{ $agentInfo->name }}</button>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#agentModal{{ $value->id }}">Assign</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($value->pickupmanId)
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#pickupmanModal{{ $value->id }}">
                                                            {{ $pickupmanInfo->name ?? '' }}
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#pickupmanModal{{ $value->id }}">Assign</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($value->deliverymanId)
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#asignModal{{ $value->id }}">{{ $deliverymanInfo->name ?? '' }}</button>
                                                    @else
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#asignModal{{ $value->id }}">Assign</button>
                                                    @endif
                                                </td>

                                                <td>{{ date('F d, Y', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
                                                <td>{{ $perceltype->title }}</td>
                                                @if ($perceltype->id == 4)
                                                    <td class="text-nowrap">
                                                        <b> Customer paid :</b> {{ $value->collected_amount }} <br>
                                                        <b> Note :</b> {{ $value->deliveryman_note ?? 'No note' }} <br>
                                                        <b>Delivery Charge :</b>
                                                        {{ $value->deliveryCharge + $value->codCharge }}
                                                        <br>
                                                        <b>Merchant Pay:</b>
                                                        {{ $value->collected_amount - ($value->deliveryCharge + $value->codCharge) }}
                                                    </td>
                                                @endif
                                                {{-- <td>{{ $value->status_description }}</td> --}}
                                                {{-- <td>
                                                    @if ($value->percelType == 1)
                                                        Prepaid
                                                    @else
                                                        Cash collection
                                                    @endif
                                                </td> --}}
                                                <td class="text-nowrap">
                                                    @if ($value->return_charge)
                                                        <b>Collect from Merchant:</b>
                                                        {{ $value->return_charge }}
                                                    @else
                                                        <b>Total Amount :</b> {{ $value->cod }} <br>
                                                        <b>Delivery Charge :</b>
                                                        {{ $value->deliveryCharge + $value->codCharge }}
                                                        <br>
                                                        <b> Partials Return :</b> {{ $value->partial_return_amount }} <br>
                                                        @if ($perceltype->id !== 4)
                                                            {{-- <b>Merchant Pay:</b>
                                                    {{ $value->cod - ($value->deliveryCharge + $value->codCharge + $value->partial_return_amount) }} --}}
                                                        @endif
                                                    @endif
                                                </td>
                                                {{-- <td> {{ $value->deliveryCharge + $value->codCharge }}</td> --}}
                                                {{-- <td> {{ $value->partial_return_amount }}</td> --}}
                                                {{-- <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge + $value->partial_return_amount) }} --}}
                                                </td>
                                                {{-- <td>{{ $value->productPrice }}</td> --}}
                                                <td>
                                                    <!-- Group Buttons Sizing -->
                                                    <div class="btn-group btn-group-sm" role="group"
                                                        aria-label="Basic example">
                                                        <a href="{{ route('percel.edit', $value->id) }}"
                                                            class="btn btn-primary btn-block"><i
                                                                class="la la-edit"></i></a>
                                                        <button type="button" class="btn btn-primary btn-block"
                                                            href="#" data-bs-toggle="modal"
                                                            data-bs-target="#merchantParcel{{ $value->id }}"
                                                            title="View"><i class="la la-eye"></i>
                                                        </button>
                                                        <div id="merchantParcel{{ $value->id }}" class="modal fade"
                                                            role="dialog">
                                                            <div class="modal-dialog">
                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Percel Details
                                                                        </h5>
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
                                                                                    <td>{{ $value->phoneNumber }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Email address</td>
                                                                                    <td>{{ $value->emailAddress }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Company Name</td>
                                                                                    <td>{{ $value->companyName }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Receipt Name</td>
                                                                                    <td>{{ $value->recipientName }}
                                                                                    </td>
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
                                                                                    <td>{{ $value->partial_return_amount }}
                                                                                    </td>
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
                                                                                    <td>Return note</td>
                                                                                    <td>{{ $value->merchantDue }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>{{ __('lang.return_note') }}</td>
                                                                                    <td>{{ $value->partial_return_note }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>L. Update</td>
                                                                                    <td>{{ date('F d, Y', strtotime($value->updated_at)) }}
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- Modal end -->



                                                        <a target="_blank" class="btn btn-primary btn-block"
                                                            href="{{ route('percel.invioce', $value->id) }}"
                                                            title="Invoice"><i class=" ri-file-list-fill"></i></a>
                                                        <a target="_blank" class="btn btn-primary btn-block"
                                                            href="{{ route('percel.manage.generate.label', $value->id) }}"
                                                            title="label genarate"><i class="ri-barcode-fill"></i></a>
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
                                                                                <input type="text"
                                                                                    name="partial_return_amount"
                                                                                    value="0" class="form-control">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for=""> Return Note </label>
                                                                                <input type="text"
                                                                                    name="partial_return_note"
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
                    </div>
                </div>

            </div>
        </div>
    @endsection
    @section('custom-scripts')
        @include('backend.layouts.datatable_scripts')

        <script>
            $(document).ready(function() {
                $("#example").DataTable();
            });
        </script>
    @endsection
