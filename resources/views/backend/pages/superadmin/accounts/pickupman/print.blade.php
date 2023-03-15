@extends('backend.layouts.master')
@section('title', 'Expense Print')
@section('custom-styles')
    <script>
        window.print();
        //window.onfocus=function(){ window.close();}
    </script>
    <style type="text/css" media="print">
        @page {
            size: A4;
            /* auto is the initial value */

            /* this affects the margin in the printer settings */
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
    <style type="text/css" media="print">
        body {
            color: #000 !important;
            font-size: 16px !important;
        }

        .table-bordered,
        .table-bordered>tbody>tr>td,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>td,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border: 2px solid #000 !important;
            padding: 5px !important;
        }

        .table-bordered>tbody>tr>td,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>td,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border-left: 2px solid #000 !important;
            border-right: 2px solid #000 !important;
            border-top: 2px solid #000 !important;
            border-bottom: 2px solid #000 !important;
        }
    </style>

    <style type="text/css" media="all">
        .table-bordered,
        .table-bordered>tbody>tr>td,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>td,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border: 1px solid #000 !important;
            padding: 5px !important;
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Expense Print</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Expense Print</a>
                        </li>
                        <li class="breadcrumb-item active">Print</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="print_area">
                    <div class="print-header">
                        <div class="text-center">
                            <img width="80px" src="{{ asset($setting->logo) }}" alt="logo">
                            <h4>{{ $setting->name }}</h4>
                            <small>{{ $setting->address }} <br> Mobile : {{ $setting->mobile_no }}</small>
                            <br>
                            <br>
                            <p><b>Pickupman Expense Invoice</b></p>
                        </div>
                    </div>
                    <div class="print-body">
                        <div class="col-lg-12">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="text-align: left;">Pickupman :
                                            <b>{{ $pickupman->pickupmanDetails->name }}</b> <br>
                                            <span>Phone Number : {{ $pickupman->pickupmanDetails->phone }} </span>
                                        </td>
                                        <td style="text-align: right;">From
                                            <b>{{ $start_date }} </b> - To <b> {{ $end_date }}</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-12 mt-3">
                                    <!-- Striped Rows -->
                                    <table class="table table-bordered border-secondary table-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Oil Cost</th>
                                                <th scope="col">Others</th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $item)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ date('d-M-Y', strtotime($item->date)) }}</td>
                                                    <td>{{ $item->oil_cost }} tk.</td>
                                                    <td>{{ $item->other_costs }} tk.</td>
                                                    <td>{{ $item->oil_cost + $item->other_costs }} tk.</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-end" colspan="4"><b>Grand Total = </b></td>
                                                <td><b>{{ $grand_total }}/-</b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <b>Amount in words</b>
                                <p>{{ $words }} Taka Only.</p>

                                <div class="col-lg-12">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    Authorized By
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    @section('custom-scripts')
    @endsection
