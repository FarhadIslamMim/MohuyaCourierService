@extends('frontend.layouts.master')
@section('title', 'Invoice Percel')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <style>
        .table {
            border: 2px solid #282828;
            width: 100%;
        }

        .table tr {
            border: 2px solid #282828;
        }

        .table td {
            border: 2px solid #282828;
        }

        /* @media print {
            @page {
                size: 210mm 91mm ;
                margin: 2px;
            }
        } */

        #print_area {
            width: 210mm;
            height: 90mm;
            overflow: hidden;
        }
    </style>
@endsection
@section('main-content')

    <!-- percel create content start -->
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-xl-8 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12  text-left">
                            <a role="button" class="btn btn-info btn-sm" onclick="getPrint()">Print</a>
                        </div>
                    </div>
                    <hr>
                    <div id="print_area">
                        <div class="print_size" style="width: 210mm; height:99mm; font-size:10px">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <div class="col-lg-12" style="display: flex;gap: 20px;align-items: flex-start;">
                                            <div>
                                                <img src="{{ asset($setting->logo) }}" class="card-logo card-logo-dark"
                                                    alt="logo dark" height="55">
                                            </div>
                                            <div class="company_info" style="width: 361px; height:50px">
                                                {{ $setting->address }} <br>
                                                Phone: 01404477009<br>
                                                Email: sensorcourier@gmail.com<br>
                                               <p>www.sensorbd.com</p>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <b>
                                            Shipped from : {{ $show_data->companyName }} <br>
                                        </b>
                                         Name : {{ $show_data->firstName }} <br>
                                         Contact No: 0{{ $show_data->phoneNumber }} <br>
                                         Alternative Contact No: {{ $show_data->otherphoneNumber ?? 'none' }} <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-right: 0px;">
                                        <div class="supplier_info">
                                            <b> Customer Information </b> <br>
                                            Name : {{ $show_data->recipientName }} <br>
                                            Mobile No : {{ $show_data->recipientPhone }} <br>
                                            Delivery Address : {{ $show_data->delivery_address }}
                                        </div>
                                    </td>
                                    <td style="border-left: 0px;" class="text-end">
                                        {!! QrCode::size(50)->generate(route('home.parcel.tracking') . '?tracking_id=' . $show_data->trackingCode) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="col-lg-12">
                                            <b> Invoice NO: {{ $show_data->invoiceNo }}</b>
                                            <b>Tracking ID:</b>{{$show_data->trackingCode }} <br>
                                            <b>Invoice Date:</b> {{ date('d M Y g:i:s a', time()) }} <br>
                                            <p>Weight : {{ $show_data->productWeight }} kg</p>
                                            <h3>Collectable Amount : {{ $show_data->cod }}</h3>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-lg-12">
                                            {!! '<img width="135px" src="data:image/png;base64,' .
                                                DNS1D::getBarcodePNG("$show_data->trackingCode", 'C128', 1, 40) .
                                                '" alt="barcode"/>' !!}
                                            <p>{{ $setting->tracking_prefix }}-{{ date('Y') }}Y{{ date('m') }}MON{{ date('d') }}D
                                            </p>
                                            <div class="percel_details">
                                                Order Date : {{ date('d M Y g:h:s a', strtotime($show_data->created_at)) }}<br>
                                                <div style="line-height:10px">
                                                    Area : {{ $show_data->area ?? 'No area assigned' }},
                                                    Thana : {{ $show_data->thana ?? 'No thana assigned' }},
                                                    District : {{ $show_data->district ?? 'No district assigned' }},
                                                    Division : {{ $show_data->division ?? 'No division assigned' }},
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-left"> Status</th>
                                            <th class="text-left"> Total Collection</th>
                                            <th class="text-left"> Delivery Charge </th>
                                            <th class="text-left"> COD Charge</th>
                                            <th class="text-left"> Paybale Amount </th>
                                            <th class="text-left"> Paid </th>
                                            <th class="text-left"> Due </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left"> {{ $show_data->title }} </td>
                                            <td class="text-left"> {{ $show_data->collected_amount }} </td>
                                            <td class="text-left"> {{ $show_data->deliveryCharge }} </td>
                                            <td class="text-left"> {{ $show_data->codCharge }} </td>
                                            <td class="text-left"> {{ $show_data->merchantAmount }} </td>
                                            <td class="text-left"> {{ $show_data->merchantPaid }} </td>
                                            <td class="text-left"> {{ $show_data->merchantDue }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>  --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->
    <br>

@endsection
@section('custom-scripts')
    <script>
        function getPrint() {
            var html = $('body').html($('#print_area').html());
            window.print(html);
            window.location.replace('{!! url()->full() !!}');
        }
    </script>
@endsection
