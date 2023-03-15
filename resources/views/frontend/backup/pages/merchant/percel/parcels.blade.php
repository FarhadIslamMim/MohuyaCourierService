@extends('frontend.layouts.master')
@section('title', 'Percel Create')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}">
@endsection
@section('content')
    <div class="dashboard">
        <aside>
            <div class="container">
                <div class="main-content">
                    <div class="row">
                        {{-- @include('frontend.pages.merchant.layouts.sidebar') --}}
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
                                                    <div class="row">
                                                        <input type="hidden" value="1" name="filter_id">
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control"
                                                                placeholder="@lang('common.invoiceNo')" name="invoiceNo"
                                                                value="{{ request()->get('invoiceNo') }}">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control"
                                                                placeholder="@lang('common.track_id')" name="trackId"
                                                                value="{{ request()->get('trackId') }}">
                                                        </div>
                                                        <!-- col end -->
                                                        <div class="col-sm-2">
                                                            <input type="number" class="form-control"
                                                                placeholder="@lang('common.mobile_no')" name="phoneNumber"
                                                                value="{{ request()->get('phoneNumber') }}">
                                                        </div>
                                                        <!-- col end -->
                                                        <div class="col-sm-2">
                                                            <input type="date" class="flatDate form-control"
                                                                placeholder="@lang('common.date_from')" name="startDate"
                                                                value="{{ request()->get('startDate') }}">
                                                        </div>
                                                        <!-- col end -->
                                                        <div class="col-sm-2">
                                                            <input type="date" class="flatDate form-control"
                                                                placeholder="@lang('common.date_to')" name="endDate"
                                                                value="{{ request()->get('endDate') }}">
                                                        </div>
                                                        <!-- col end -->
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-success">Search
                                                            </button>
                                                        </div>
                                                        <!-- col end -->
                                                    </div>
                                                </form>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                            <br>

                                                <div class="tab-inner table-responsive">
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
                                                                <th>Note/th>
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
                                                                    <td> {{ $value->deliveryCharge + $value->codCharge }}</td>
                                                                    <td> {{ $value->partial_return_amount }}</td>
                                                                    <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge + $value->partial_return_amount) }}
                                                                    </td>
                                                                    <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
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
                                                                    <td>
                                                                        <a href="{{ route('merchant.parcel.show', $value->id) }}"
                                                                            class="btn btn-sm btn-info"><i
                                                                                class="fa fa-eye"></i></a>
                                                                        @if ($value->status == 1)
                                                                            <a href="{{ route('merchant.percel.edit', $value->id) }}"
                                                                                class="btn btn-sm btn-primary"><i
                                                                                    class="fa fa-edit"></i></a>
                                                                        @endif
                                                                        @if ($value->status >= 2)
                                                                            <a class="btn btn-sm btn-success" a
                                                                                href="{{ url('merchant/parcel/invoice/' . $value->id) }}"
                                                                                title="Invoice"><i class="fas fa-list"></i></a>
                                                                        @endif
                                                                        @if ($value->status < 2)
                                                                            <a class="btn btn-sm btn-danger"
                                                                                onclick="return confirm('Do you want to Cancel ?')"
                                                                                href="{{ route('merchant.percel.cancel', $value->id) }}"
                                                                                title="Invoice"> Cancel </a>
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
        </aside>
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
