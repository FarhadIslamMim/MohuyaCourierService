@extends('frontend.layouts.master')
@section('title', 'Percels')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}">
@endsection
@section('content')
    <div class="dashboard">
        <div class="aside">
            <div class="container">
                <div class="main-content">
                    <div class="row">
                        {{-- @include('frontend.pages.deliveryman.layouts.sidebar') --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h5>Your todays report</h5>
                                        <p>Date : {{ date('d-m-Y') }}</p>
                                        <br>
                                        <div class="table-responsive">
                                            <div class="tab-inner">
                                                <table id="example" class="table table-striped table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Track ID</th>
                                                            <th>Date</th>
                                                            <th>Company Name</th>
                                                            <th>Mobile No</th>
                                                            <th width="150">Address </th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Charge</th>
                                                            <th>Partial Return</th>
                                                            <th>Sub Total</th>
                                                            <th>Last Update</th>
                                                            <th>Payment status</th>
                                                            <th>Assign Type</th>
                                                            <th>Note</th>
                                                            <th>More</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allparcel as $key => $value)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $value->trackingCode }}</td>
                                                                <td>{{ $value->created_at }}</td>
                                                                <td>{{ $value->companyName }}</td>
                                                                <td>{{ $value->recipientPhone }}</td>
                                                                <td>
                                                                    @if ($value->delivery_address)
                                                                        {{ $value->delivery_address . ',' }}
                                                                    @endif
                                                                    @if ($value->area)
                                                                        {{ $value->area . ',' }}
                                                                    @endif
                                                                    @if ($value->thana)
                                                                        {{ $value->thana . ',' }}
                                                                    @endif
                                                                    @if ($value->district)
                                                                        {{ $value->district . ',' }}
                                                                    @endif
                                                                    @if ($value->division)
                                                                        {{ $value->division . '.' }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $parcelstatus = App\Models\Parceltype::find($value->status);
                                                                    @endphp
                                                                    {{ $parcelstatus->title }}
                                                                </td>
                                                                <td> {{ $value->cod }}</td>
                                                                <td> {{ $value->deliveryCharge + $value->codCharge }}</td>
                                                                <td> {{ $value->partial_return_amount }}</td>
                                                                <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge + $value->partial_return_amount) }}
                                                                </td>
                                                                <td>{{ date('F d, Y', strtotime($value->updated_at)) }}
                                                                </td>
                                                                <td>
                                                                    @if ($value->merchantpayStatus == null)
                                                                        NULL
                                                                    @elseif($value->merchantpayStatus == 0)
                                                                        Processing
                                                                    @else
                                                                        Paid
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    @if ($value->pickupmanId && $value->deliverymanId == null)
                                                                        <p>Pickupman Assign</p>
                                                                    @elseif($value->deliverymanId && $value->pickupmanId == null)
                                                                        <p>Deliveryman Assign</p>
                                                                    @elseif($value->deliverymanId && $value->pickupmanId)
                                                                        <p>Pickupman Assign</p>
                                                                        <p>Deliveryman Assign</p>
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    @php
                                                                        $parcelnote = App\Models\Parcelnote::where('parcelId', $value->id)
                                                                            ->orderBy('id', 'DESC')
                                                                            ->first();
                                                                    @endphp
                                                                    @if (!empty($parcelnote))
                                                                        {{ $parcelnote->note }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <button class="btn btn-info" href="#"
                                                                        data-toggle="modal"
                                                                        data-target="#merchantParcel{{ $value->id }}"
                                                                        title="View"><i class="fa fa-eye"></i></button>
                                                                    <div id="merchantParcel{{ $value->id }}"
                                                                        class="modal fade" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Parcel Details
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <table class="table table-bordered">
                                                                                        <tr>
                                                                                            <td>Merchant Name</td>
                                                                                            <td>{{ $value->firstName }}
                                                                                                {{ $value->lastName }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Merchant Phone</td>
                                                                                            <td>{{ $value->phoneNumber }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Merchant Email</td>
                                                                                            <td>{{ $value->emailAddress }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Company</td>
                                                                                            <td>{{ $value->companyName }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Recipient Name</td>
                                                                                            <td>{{ $value->recipientName }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Recipient Address</td>
                                                                                            <td>{{ $value->recipientAddress }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>COD</td>
                                                                                            <td>{{ $value->cod }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>C. Charge</td>
                                                                                            <td>{{ $value->codCharge }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>D. Charge</td>
                                                                                            <td>{{ $value->deliveryCharge }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Sub Total</td>
                                                                                            <td>{{ $value->merchantAmount }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Paid</td>
                                                                                            <td>{{ $value->merchantPaid }}
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Due</td>
                                                                                            <td>{{ $value->merchantDue }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-danger"
                                                                                        data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Modal end -->
                                                                    @if (in_array($value->status, [1]) && $value->merchantPaid == 0)
                                                                        <button class="btn btn-danger" title="Action"
                                                                            data-toggle="modal"
                                                                            data-target="#sUpdateModal{{ $value->id }}"><i
                                                                                class="fa fa-sync-alt"></i></button>
                                                                    @endif

                                                                    <!-- Modal -->
                                                                    <div id="sUpdateModal{{ $value->id }}"
                                                                        class="modal fade" role="dialog">
                                                                        <div class="modal-dialog">
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">
                                                                                        @lang('common.parcel_status_update')
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ url('pickupman/parcel/status-update') }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                            name="hidden_id"
                                                                                            value="{{ $value->id }}">
                                                                                        <input type="hidden"
                                                                                            name="customer_phone"
                                                                                            value="{{ $value->recipientPhone }}">
                                                                                        <div class="form-group">
                                                                                            <select name="status"
                                                                                                onchange="percelDelivery(this)"
                                                                                                class="form-control"
                                                                                                id="">
                                                                                                @foreach ($parceltypes->whereIn('id', [1, 2]) as $key => $ptvalue)
                                                                                                    <option
                                                                                                        value="{{ $ptvalue->id }}"
                                                                                                        @if ($value->status == $ptvalue->id) selected="selected" @endif>
                                                                                                        {{ $ptvalue->title }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                        <div class="form-group mrt-15">
                                                                                            <textarea name="note" class="form-control" cols="30" placeholder="@lang('common.note')"></textarea>
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                        <div class="form-group">
                                                                                            <div id="customerpaid"
                                                                                                style="display: none;">
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    value="{{ old('customerpay') }}"
                                                                                                    id="customerpay"
                                                                                                    name="customerpay"
                                                                                                    placeholder="customer pay" /><br />
                                                                                            </div>
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                        <div class="form-group">
                                                                                            <button
                                                                                                class="btn btn-success">Update</button>
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-danger"
                                                                                        data-dismiss="modal">Close</button>
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
                        </div>
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
