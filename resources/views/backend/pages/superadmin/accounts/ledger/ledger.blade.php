@extends('backend.layouts.master')
@section('title', 'Ledger')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
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
                <h4 class="mb-sm-0">Profit & Loss</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a>
                        </li>
                        <li class="breadcrumb-item active">Profit & Loss</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="print_hide">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form action="" class="filte-form">
                            @csrf
                            <div class="row gy-4">
                                <input type="hidden" value="1" name="filter_id">
                                <!-- col end -->
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="invoiceNo">Select Option</label>
                                        <select name="period" id="brand" class="form-control select2">
                                            <option value="today">Today</option>
                                            <option value="date" >Date Wise</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="startDate" >
                                    <div class="form-group">
                                        <label for="invoiceNo">Start Date</label>
                                        <input type="date" class="flatDate form-control" placeholder="Date from"
                                               name="startDate" value="{{ request()->get('startDate') }}">
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-3"  id="endDate" >
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
                                <div class="col-sm-2 d-flex align-items-center">
                                    <div class="form-group">
                                        <label for="">&nbsp; </label> <br>
                                        <button type="button" class="btn btn-sm btn-info text-right" onclick="startPrint()">
                                            Print </button>
                                    </div>
                                </div>
                                <!-- col end -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row ">
        <div class="print print_area">
            <div class="card">
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
    @include('backend.layouts.datatable_scripts')
<script>
    $(document).ready(function(){
        $('#startDate').hide();
        $('#endDate').hide();
        $('#brand').change(function() {
            var brandValue = $(this).val();
            if(brandValue == "date") {
                $('#startDate').show();
                $('#endDate').show();
            }else {
                $('#startDate').hide();
                $('#endDate').hide();
            }
        })
    });

    function startPrint() {
        $('.print_hide').hide();
        $('body').html($('.print_area').html());
        window.print();
        window.location.replace(APP_URL)
    }

</script>
@endsection
