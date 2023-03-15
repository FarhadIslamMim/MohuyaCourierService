@extends('backend.layouts.master')
@section('title', 'Pickupman Payment Summary')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        #reqtablenew > tr:hover{
            /*background-color: #abcaab;*/
        }
        .row_active{
            background-color: #aba9a9;
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Pickupman Payment </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Payments</a></li>
                        <li class="breadcrumb-item active">Pickupman Payment </li>
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
                    <div class="row ">
                        <div class="col-lg-10">
                            <h3>Pickupman Payment</h3>
                            <p class="text-success">Here is the list of the pickupman whom need to pay</p>
                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-primary" href="{{ route('payment.pickupman.invoice') }}">Invoices</a>
                        </div>
                    </div>
                    <br>
                    <br>

                    <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th width="100">Name</th>
                                <th>Mobile no</th>
                                <th width="20" class="text-right"> Total <br> Parcel </th>
                                <th width="20" class="text-right"> Total <br> Amount</th>
                                <th width="20" class="text-right">Parcel <br> Paid </th>

                                <th width="20" class="text-right">Total Paid
                                </th>
                                <th width="20" class="text-right">Due <br> Parcel</th>
                                <th width="20" class="text-right">Total Due
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="reqtablenew">
                            @foreach ($pickupmen as $key => $pickupman)
                                @php
                                    $paymentSummary = $pickupman->paymentSummary();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-nowrap">{{ $pickupman->name }}</td>
                                    <td>{{ $pickupman->phone }}</td>
                                    <td class="text-right">{{ $paymentSummary['total_parcel'] }}</td>
                                    <td class="text-right">{{ $paymentSummary['total_amount'] }} tk.</td>
                                    <td class="text-right">{{ $paymentSummary['total_parcel_paid'] }}</td>
                                    <td class="text-right">{{ $paymentSummary['total_paid'] }} tk.</td>
                                    <td class="text-right">{{ $paymentSummary['due_parcel'] }}</td>
                                    <td class="text-right">{{ $paymentSummary['total_due'] }} tk.</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{url('/superadmin/payments/pickupman-payments/all',$pickupman->id)}}"
                                                class="btn btn-sm btn-primary">
                                                All Parcels
                                            </a>
                                            <br>
                                            <a href="{{url('/superadmin/payments/pickupman-payments/paid',$pickupman->id)}}"
                                                class="btn btn-sm btn-success">
                                                Paid Parcels
                                            </a>
                                            <br>

                                            <a href="{{url('/superadmin/payments/pickupman-payments/due',$pickupman->id)}}"
                                                class="btn btn-sm btn-warning">
                                                Due Parcels
                                            </a>
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
    <!-- percel create content end -->

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
        $(document).ready(function () {
            $("#datatable").DataTable();
        });
    </script>
@endsection
