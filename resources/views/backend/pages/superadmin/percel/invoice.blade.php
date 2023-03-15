@extends('backend.layouts.master')
@section('title', 'Parcel Edit')
@section('custom-styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Parcel Edit</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Percel</a></li>
                        <li class="breadcrumb-item active">Parcel Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel create content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12  text-left">
                            <a role="button" class="btn btn-info btn-sm" onclick="getPrint()">Print</a>
                        </div>
                    </div>

                    <hr>
                    <div id="print_area">
                        <div class="row">
                            <div class="col-xl-12" style="width: 60%; float: left;">
                                <div>
                                    <img src="{{asset('uploads/logo/logo.png')}}" alt="logo" height="50"/>
{{--                                    <img src="@foreach ($whitelogo as $wlogo)--}}
{{--                                    {{ asset($wlogo->image) }} @endforeach" alt="Logo" height="50">--}}
                                </div>

                                <div class="company_info">
                                    {{ $setting->address }} <br>
                                    <br>
                                    <b>
                                        Merchant Information
                                    </b> <br>
                                    Name : {{ $show_data->firstName }} <br>
                                    Mobile No: {{ $show_data->phoneNumber }} <br>
                                    Company Name : {{ $show_data->companyName }} <br>
                                </div>
                            </div>

                            <div class="col-sm-4" style="width: 40%; float: left;">
                                <h4> Invoice NO: {{ $show_data->invoiceNo }}</h4>
                                <div>
                                    <b>Tracking ID:</b> SC-54114 <br>
                                    <b>Invoice Date:</b> {{ date('d M Y', strtotime($show_data->created_at)) }} <br>
                                </div>
                                <div class="supplier_info">
                                    <b> Customer Information </b> <br>
                                    Name : {{ $show_data->recipientName }} <br>
                                    Mobile No : {{ $show_data->recipientPhone }} <br>
                                    Address : {{ $show_data->delivery_address }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-left"> Status</th>
                                            <th class="text-left"> Total Amount</th>
                                            <th class="text-left"> Total Collection</th>
                                            <th class="text-left"> Partials Return</th>
                                            <th class="text-left"> Delivery Charge </th>
                                            <th class="text-left"> COD Charge</th>
                                            <th class="text-left"> Amount </th>
                                            <th class="text-left"> Paid </th>
                                            <th class="text-left"> Due </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left"> {{ $show_data->title }} </td>
                                            <td class="text-left"> {{ $show_data->cod }} </td>
                                            <td class="text-left"> {{ $show_data->collected_amount ?? ''}} </td>
                                            <td class="text-left"> {{ $show_data->partial_return_amount ?? ''}} </td>
                                            <td class="text-left"> {{ $show_data->deliveryCharge }} </td>
                                            <td class="text-left"> {{ $show_data->codCharge }} </td>
                                            <td class="text-left"> {{ $show_data->merchantAmount }} </td>
                                            <td class="text-left"> {{ $show_data->merchantPaid }} </td>
                                            <td class="text-left"> {{ $show_data->merchantDue }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->

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
