@extends('backend.layouts.master')
@section('title', 'Cashbook')
@section('custom-styles')
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
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cashbook</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a>
                        </li>
                        <li class="breadcrumb-item active">Cashbook</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="print">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Date : {{ date('d-m-Y') }}</h4>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-end">
                                <button onclick="print()" class="btn btn-primary"><i class="las la-print"></i>
                                    Print</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header card-primary">
                                    <h5>Credit</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Striped Rows -->
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Particular</th>
                                                <th scope="col">Tk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_income = $incomes + $delivery_charge + $cod + $returnCharge;
                                            @endphp
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Incomes</td>
                                                <td>{{ $incomes }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Delivery Charge</td>
                                                <td>{{ $delivery_charge }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>COD Charge</td>
                                                <td>{{ $cod }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Return Charge</td>
                                                <td>{{ $returnCharge }}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-end" colspan="2"><b>Grand Total = </b></td>
                                                <td><b>{{ $total_income }}/-</b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card ">
                                <div class="card-header card-success">
                                    <h5>Debit</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Particular</th>
                                                <th scope="col">Tk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total_expense = $expenses + $salary + $deliveryMans + $pickupmans + $pickupman_advance + $deliveryman_advance + $employee_advance + $pickupman_salary + $deliveryman_salary + $pickupman_comission + $deliveryman_comission + $agent_comission;
                                            @endphp
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Expenses</td>
                                                <td>{{ $expenses }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Employee Salary</td>
                                                <td>{{ $salary }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Deliveryman Salary</td>
                                                <td>{{ $deliveryman_salary }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Pickupman Salary</td>
                                                <td>{{ $pickupman_salary }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>Deliveryman Expense</td>
                                                <td>{{ $deliveryMans }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td>Pickupman Expense</td>
                                                <td>{{ $pickupmans }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">7</th>
                                                <td>Pickupman Advance</td>
                                                <td>{{ $pickupman_advance }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">8</th>
                                                <td>Deliveryman Advance</td>
                                                <td>{{ $deliveryman_advance }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">9</th>
                                                <td>Employee Advance</td>
                                                <td>{{ $employee_advance }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">10</th>
                                                <td>Deliveryman Comission</td>
                                                <td>{{ $deliveryman_comission }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">11</th>
                                                <td>Pickupman Comission</td>
                                                <td>{{ $pickupman_comission }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">12</th>
                                                <td>Agent Comission</td>
                                                <td>{{ $agent_comission }}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-end" colspan="2"><b>Grand Total = </b></td>
                                                <td><b>{{ $total_expense }}/-</b></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <h3>Balance : {{ $total_income - $total_expense }} tk.</h3>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-scripts')

@endsection
