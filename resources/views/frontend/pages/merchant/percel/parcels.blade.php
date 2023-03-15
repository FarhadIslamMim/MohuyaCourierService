@extends('frontend.layouts.master')
@section('title', 'Percel Create')
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
    <section class="section bg-light  mt-5">
        <div class="container-fluid py-4 px-4">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h5>All Today Parcel Details</h5>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form action="" class="filte-form">
                                        @csrf
                                        <div class="row gy-4">
                                            <input type="hidden" value="1" name="filter_id">
                                            <div class="col-sm-2">
                                                <label for="ionvoiceNo">Invoice No</label>
                                                <input type="text" class="form-control" placeholder="Invoice No"
                                                    name="invoiceNo" value="{{ request()->get('invoiceNo') }}">
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="trackID">Tracking ID</label>
                                                <input type="text" class="form-control" placeholder="Tracking ID"
                                                    name="trackId" value="{{ request()->get('trackId') }}">
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <label for="phoneNumer">Customer Phone No</label>
                                                <input type="number" class="form-control" placeholder="Phone number"
                                                    name="phoneNumber" value="{{ request()->get('phoneNumber') }}">
                                            </div>
                                            <!-- col end -->
{{--                                            <div class="col-sm-2">--}}
{{--                                                <label for="startDate">Start Date</label>--}}
{{--                                                <input type="date" class="flatDate form-control"--}}
{{--                                                    placeholder="@lang('common.date_from')" name="startDate"--}}
{{--                                                    value="{{ request()->get('startDate') }}">--}}
{{--                                            </div>--}}
                                            <!-- col end -->
{{--                                            <div class="col-sm-2">--}}
{{--                                                <label for="endDate">End Date</label>--}}
{{--                                                <input type="date" class="flatDate form-control"--}}
{{--                                                    placeholder="@lang('common.date_to')" name="endDate"--}}
{{--                                                    value="{{ request()->get('endDate') }}">--}}
{{--                                            </div>--}}
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <label for="">&nbsp; </label> <br>
                                                <button type="submit" class="btn btn-success">Search
                                                </button>
                                            </div>
                                            <!-- col end -->
                                        </div>
                                    </form>
                                </div>
                                <br>
                                <br>
                            </div>
                            <!-- row end -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <br>

                                <div class="table-responsive">
                                    @include('frontend.layouts.notifications')
                                    <table id="datatable" class="table table-bordered table-sm table-hover">
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
                                                {{-- <th>L. Update</th> --}}
                                                <th>Payment Status</th>
                                                <th>Note</th>
                                                <th>More</th>
                                            </tr>
                                        </thead>
                                        <tbody id="reqtablenew">
                                            @foreach ($allparcel as $key => $value)
                                                <tr class="py-2">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $value->invoiceNo }}</td>
                                                    <td><a
                                                            href="{{ route('home.parcel.tracking.id', '?tracking_id=' . $value->trackingCode) }}">{{ $value->trackingCode }}</a>
                                                    </td>
                                                    <td> {{  \Carbon\Carbon::parse($value->created_at)->format('d M Y g:h:s A')}}</td>
                                                    <td width="300px">
                                                        <span><i class="las la-user"></i> Name :
                                                            {{ $value->recipientName }}</span>
                                                        <br>
                                                        <span><i class="las la-phone"></i> Phone :
                                                            {{ $value->recipientPhone }}
                                                            @if ($value->alternative_mobile_no)
                                                                ,
                                                                {{ $value->alternative_mobile_no }}
                                                            @endif
                                                        </span>
                                                        <br>
                                                        <span> <i class="las la-location-arrow"></i> Address :
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
                                                        </span>
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
                                                    <td width="100px">
                                                        @php
                                                            $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
                                                        @endphp
                                                        @if ($value->deliverymanId)
                                                            {{ $deliverymanInfo->name ?? '' }}
                                                        @else
                                                            Not Assign
                                                        @endif
                                                    </td>
                                                    <td width="170px">
                                                        @if ($value->return_charge)
                                                            <b>COD</b> : {{ $value->cod }} <br>
                                                            <b>Delivery Charge</b> :
                                                            {{ $value->deliveryCharge}}<br>
                                                            <b>Return Charge</b> :
                                                            {{ $value->return_charge}}<br>
                                                            <b>Collect from Merchant:</b>
                                                            -{{ $value->deliveryCharge + $value->return_charge }}
                                                            <br>
                                                            {{-- <b>Cod Charge</b> :
                                                            {{ $value->deliveryCharge + $value->codCharge }}<br> --}}
                                                            {{-- <b>Partial Return</b> :
                                                            {{ $value->partial_return_amount }}<br> --}}
                                                            {{-- <b>Payble Amount</b> :
                                                            -{{ $value->deliveryCharge + $value->return_charge }} --}}
                                                        @else
                                                            <b>COD</b> : {{ $value->cod }} <br>
                                                            <b>Cod Charge</b> :
                                                            {{ $value->deliveryCharge + $value->codCharge }}<br>
                                                            <b>Partial Return</b> :
                                                            {{ $value->partial_return_amount }}<br>
                                                            <b>Payble Amount</b> :
                                                            {{ $value->cod - ($value->deliveryCharge + $value->codCharge + $value->partial_return_amount) }}
                                                        @endif
                                                    </td>
                                                    {{-- <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td> --}}
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
                                                        {{$value->note}}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('merchant.invoice', $value->id) }}"
                                                           class="btn btn-sm btn-secondary" title="Invoice" target="_blank"><i class="las la-file-pdf"></i></a>

                                                        @if ($value->status == 1)
                                                            <a href="{{ route('merchant.percel.edit', $value->id) }}"
                                                                class="btn btn-sm btn-primary" title="Edit"  target="_blank"><i
                                                                    class="las la-edit"></i></a>
                                                        @endif
                                                        @if ($value->status >= 2)
                                                            <a class="btn btn-sm btn-success" a
                                                                href="{{ route('merchant.invoice', $value->id) }}"
                                                                title="Invoice"  target="_blank"><i class="las la-eye"></i></a>
                                                        @endif
                                                        @if ($value->status < 2)
                                                            <a class="btn btn-sm btn-danger" style="margin-top: 5px"
                                                                onclick="return confirm('Do you want to Cancel ?')"
                                                                href="{{ route('merchant.percel.cancel', $value->id) }}"
                                                                title="Cancel"> Cancel </a>
                                                        @endif
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
    </section>
    @endsection
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
    @endsection
