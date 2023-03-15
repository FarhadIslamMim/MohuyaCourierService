@extends('frontend.layouts.master')
@section('title', 'Pending Percel')
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
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <div class="profile-edit mrt-30">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <form action="" class="filte-form">
                                                    @csrf
                                                    <div class="row gy-4">
                                                        <h4>Search</h4>
                                                        <input type="hidden" value="1" name="filter_id">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="invoiceNo">Invoice No.</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Invoice NO" name="invoiceNo"
                                                                    value="{{ request()->get('invoiceNo') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="invoiceNo">Tracking ID</label>

                                                                <input type="text" class="form-control"
                                                                    placeholder="Track ID" name="trackId"
                                                                    value="{{ request()->get('trackId') }}">
                                                            </div>
                                                        </div>
                                                        <!-- col end -->
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="invoiceNo">Mobile No</label>

                                                                <input type="number" class="form-control"
                                                                    placeholder="Mobile No" name="phoneNumber"
                                                                    value="{{ request()->get('phoneNumber') }}">
                                                            </div>
                                                        </div>
                                                        <!-- col end -->
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="invoiceNo">Start Date</label>

                                                                <input type="date" class="flatDate form-control"
                                                                    placeholder="Date from" name="startDate"
                                                                    value="{{ request()->get('startDate') }}">
                                                            </div>
                                                        </div>
                                                        <!-- col end -->
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="invoiceNo">End Date</label>

                                                                <input type="date" class="flatDate form-control"
                                                                    placeholder="Date to" name="endDate"
                                                                    value="{{ request()->get('endDate') }}">
                                                            </div>
                                                        </div>
                                                        <!-- col end -->
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <button type="submit"
                                                                    class="btn btn-block signin_button btn-success">Search
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <!-- col end -->
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <br>
                                                <h3>All Percel List</h3>
                                                <div class="tab-inner table-responsive">
                                                    @include('frontend.layouts.notifications')
                                                    <table id="example" class="table  table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Invoice No.</th>
                                                                <th>Tracking ID</th>
                                                                <th>Date</th>
                                                                <th>Customer</th>
                                                                <th>Mobile No.</th>
                                                                <th>Address</th>
                                                                <th width="100px">Status</th>
                                                                <th>Rider</th>
                                                                <th>Total</th>
                                                                <th>Charge</th>
                                                                <th>Partial Return</th>
                                                                <th>Sub Total</th>
                                                                <th>L. Update</th>
                                                                <th>Payment Status</th>
                                                                <th>Note</th>
                                                                <th>More</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($allparcel as $key => $value)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $value->invoiceNo }}</td>
                                                                    <td>{{ $value->trackingCode }}</td>
                                                                    <td>{{ $value->created_at }}</td>
                                                                    <td>
                                                                        {{ $value->recipientName }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $value->recipientPhone }}
                                                                        @if ($value->alternative_mobile_no)
                                                                            ,
                                                                            {{ $value->alternative_mobile_no }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($value->delivery_address)
                                                                            {{ $value->delivery_address }},
                                                                        @endif
                                                                        @if ($value->area_id)
                                                                            {{ $value->area }},
                                                                        @endif
                                                                        @if ($value->thana_id)
                                                                            {{ $value->thana }},
                                                                        @endif
                                                                        @if ($value->district_id)
                                                                            {{ $value->district }},
                                                                        @endif
                                                                        @if ($value->division_id)
                                                                            {{ $value->division }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @php
                                                                            $parcelstatus = App\Models\Parceltype::find($value->status);
                                                                        @endphp
                                                                        {{ $parcelstatus->title }}
                                                                        @if ($value->status_description)
                                                                            <p class="desc text-start text-primary">[
                                                                                {{ $value->status_description }} ]
                                                                            </p>
                                                                        @endif

                                                                    </td>
                                                                    <td>
                                                                        @php
                                                                            $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
                                                                        @endphp
                                                                        @if ($value->deliverymanId)
                                                                            {{ $deliverymanInfo->name ?? '' }}
                                                                        @else
                                                                            Not Asign
                                                                        @endif
                                                                    </td>
                                                                    <td> {{ $value->cod }}</td>
                                                                    <td> {{ $value->deliveryCharge + $value->codCharge }}
                                                                    </td>
                                                                    <td> {{ $value->partial_return_amount }}</td>
                                                                    <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge + $value->partial_return_amount) }}
                                                                    </td>
                                                                    <td>{{ date('F d, Y', strtotime($value->updated_at)) }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($value->merchantpayStatus == 1 && ($value->percelType == 2 && $value->status == 4))
                                                                            Paid
                                                                        @elseif($value->merchantpayStatus == 1 && (($value->status > 5 && $value->status < 9) || $value->percelType == 1))
                                                                            Service charge adjustment
                                                                        @else
                                                                            Unknown process
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

                                                                </tr>
                                                            @endforeach
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
