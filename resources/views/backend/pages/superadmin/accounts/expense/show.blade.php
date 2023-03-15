@extends('backend.layouts.master')
@section('title', 'Expenses')
@section('custom-styles')
    <script>
        window.print();
        //window.onfocus=function(){ window.close();}
    </script>
    <style type="text/css" media="print">
        @page {
            size: auto;
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
                <h4 class="mb-sm-0">Expenses</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Expenses</a>
                        </li>
                        <li class="breadcrumb-item active">Manage</li>
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
                            <p>{{ $setting->address }} <br> Mobile : {{ $setting->mobile_no }}</p>
                            <p><b>Expense Invoice</b></p>
                        </div>
                    </div>
                    <div class="print-body">
                        <div class="row">
                            @foreach ($invoices as $invoice)
                                <div class="col-lg-12">
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: left;">Invoice # <b>{{ $invoice->invoice_id }}</td>
                                                <td style="text-align: right;">Date #
                                                    <b>{{ date('d-m-Y', strtotime($date->date_of_expense)) }}</b>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <!-- Striped Rows -->
                                    <table class="table table-bordered border-secondary table-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Remark</th>
                                                <th class="text-end" scope="col">Quantity</th>
                                                <th class="text-end" scope="col">Amount</th>
                                                <th class="text-end" scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice->getExpenseDetails as $item)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>{{ $item->getHeadDetails->expense_head }}</td>
                                                    <td class="text-end">{{ $item->remarks }}</td>
                                                    <td class="text-end">{{ $item->quantity }}</td>
                                                    <td class="text-end">{{ $item->amount }}/-</td>
                                                    <td class="text-end">{{ $item->quantity * $item->amount }}/-</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-end" colspan="4"><b>Grand Total = </b></td>
                                                <td class="text-end"><b>{{ $grand_total }}/-</b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @endforeach
                            <b>Amount in words</b>
                            <p>{{ $words }} Taka Only.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-scripts')
@endsection
