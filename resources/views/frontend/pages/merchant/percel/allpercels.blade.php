@extends('frontend.layouts.master')
@section('title', 'Percels')
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
    <section class="section bg-light mt-5">
        <div class="container-fluid py-4 px-5 mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form action="" class="filte-form">
                                    @csrf
                                    <div class="row gy-4 ">
                                        <h4>Search</h4>
                                        <div class="col-sm-6 col-lg-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <input type="hidden" value="1" name="filter_id">

                                                <label for="invoiceNo">Invoice No.</label>
                                                <input type="text" class="form-control" placeholder="Invoice NO"
                                                    name="invoiceNo" value="{{ request()->get('invoiceNo') }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="invoiceNo">Tracking ID</label>

                                                <input type="text" class="form-control" placeholder="Track ID"
                                                    name="trackId" value="{{ request()->get('trackId') }}">
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-6 col-lg-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="invoiceNo">Mobile No</label>

                                                <input type="number" class="form-control" placeholder="Mobile No"
                                                    name="phoneNumber" value="{{ request()->get('phoneNumber') }}">
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-6 col-lg-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="invoiceNo">Start Date</label>

                                                <input type="date" class="flatDate form-control" placeholder="Date from"
                                                    name="startDate" value="{{ request()->get('startDate') }}">
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-2 d-flex align-items-center">
                                            <div class="form-group">
                                                <label for="invoiceNo">End Date</label>

                                                <input type="date" class="flatDate form-control" placeholder="Date to"
                                                    name="endDate" value="{{ request()->get('endDate') }}">
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
                                @include('frontend.layouts.notifications')

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
                                        {{-- <th>L. Update</th> --}}
                                        <th>Payment Status</th>
                                        <th>Note</th>
                                        <th>More</th>
                                    </tr>
                                     </thead>
                                     <tbody id="reqtablenew">
                                     @foreach ($allparcel as $key => $value)
                                         <tr class="py-2">
                                             <td style="font-size: 12px">{{ $loop->iteration }}</td>
                                             <td style="font-size: 12px">{{ $value->invoiceNo }}</td>
                                             <td style="font-size: 12px"><a
                                                     href="{{ route('home.parcel.tracking.id', '?tracking_id=' . $value->trackingCode) }}">{{ $value->trackingCode }}</a>
                                             </td>
                                             <td style="font-size: 12px">{{  \Carbon\Carbon::parse($value->created_at)->format('d M Y g:h:s A')}}</td>
                                             <td style="font-size: 12px" width="540px">
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
                                             <td style="font-size: 12px">
                                                 @php
                                                     $parcelstatus = App\Models\Parceltype::find($value->status);
                                                 @endphp
                                                 {{ $parcelstatus->title ?? '' }}
                                                 @if ($value->status_description)
                                                     <p class="desc text-start text-primary">[
                                                         {{ $value->status_description }} ]
                                                     </p>
                                                 @endif

                                             </td>
                                             <td style="font-size: 12px" width="100px">
                                                 @php
                                                     $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
                                                 @endphp
                                                 @if ($value->deliverymanId)
                                                     {{ $deliverymanInfo->name ?? '' }}
                                                 @else
                                                     Not Assign
                                                 @endif
                                             </td>
                                             <td style="font-size: 12px" width="300px">
                                                 @if ($value->return_charge)
                                                     <b>Collect from Merchant:</b>
                                                     {{ $value->deliveryCharge + $value->return_charge }}
                                                 @else
                                                     <br>
                                                     <b>Total Amount :</b> {{ $value->cod }} <br>
                                                     @if ($value->status == 4)
                                                         <b> Customer paid :</b> {{ $value->collected_amount }} <br>
                                                     @endif
                                                     <b> Partials Return :</b> {{ $value->partial_return_amount }} <br>
                                                     <b>Delivery Charge :</b>
                                                     {{ $value->deliveryCharge + $value->codCharge }}
                                                     <br>
                                                     @if ($value->partial_return_note)
                                                         <b> P. Note :</b> {{ $value->partial_return_note }}
                                                     @endif
                                                     <br>
                                                 @endif
                                                 @if ($value->status == 4)
                                                     <b> D.Note :</b> {{ $value->deliveryman_note ?? 'No note' }} <br>

                                                     <br>
                                                     {{-- <b>Merchant Pay:</b>
                                                     {{ $value->collected_amount - ($value->deliveryCharge + $value->codCharge) }} --}}
                                                 @endif
                                                 {{-- <b>COD</b> : {{ $value->cod }} <br> --}}

                                             </td>
                                             {{-- <td style="font-size: 12px">{{ date('F d, Y', strtotime($value->updated_at)) }}</td> --}}
                                             <td style="font-size: 12px">
                                                 @if ($value->merchantpayStatus == 1 && ($value->percelType == 2 && $value->status == 4))
                                                     Paid
                                                 @elseif($value->merchantpayStatus == 1 && (($value->status > 5 && $value->status < 9) || $value->percelType == 1))
                                                     Service charge adjustment
                                                 @else
                                                     Unknown process
                                                 @endif
                                             </td>
                                             <td style="font-size: 12px">
                                                 {{$value->note}}
                                             </td>

                                             <td style="font-size: 12px">
                                                 <div class="btn-group">
                                                     <a href="{{ route('merchant.invoice', $value->id) }}"
                                                        class="btn btn-sm btn-success" title="Invoice" target="_blank"><i class="las la-file-pdf"></i></a>


                                                     @if ($value->status == 1)
                                                         <a href="{{ route('merchant.percel.edit', $value->id) }}"
                                                            class="btn btn-sm btn-info" target="_blank"><i
                                                                 class="las la-edit" title="Edit"></i></a>
                                                     @endif
                                                     <!--@if ($value->status >= 2)-->
                                                     <!--    <a class="btn btn-sm btn-success" a-->
                                                     <!--        href="{{ route('merchant.invoice', $value->id) }}"-->
                                                     <!--        title="Invoice" target="_blank"><i class="las la-list"></i></a>-->
                                                     <!--@endif-->
                                                     @if ($value->status < 2)
                                                         <a class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Do you want to Cancel ?')"
                                                            href="{{ route('merchant.percel.cancel', $value->id) }}"
                                                            title="Cancel" target="_blank" > Cancel </a>
                                                     @endif
                                                 </div>

                                                 {{-- <a class="btn btn-sm btn-danger"
                                                                         onclick="return confirm('Do you want to Delete ?')"
                                                                         href="{{ route('merchant.percel.delete', $value->id) }}">
                                                                         Delete </a> --}}

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

{{--             <script>--}}
{{--            $(document).ready(function() {--}}
{{--                $("#example").DataTable({--}}
{{--                    dom: 'Bfrtip',--}}
{{--                    buttons: [--}}
{{--                        'copy', 'excel', 'pdfHtml5', 'print'--}}
{{--                    ],--}}
{{--                    searching: true,--}}
{{--                    paging: false,--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
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
