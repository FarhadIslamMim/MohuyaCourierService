@extends('backend.layouts.master')
@section('title', 'Salary')
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
                <h4 class="mb-sm-0">Salary</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Salary</a>
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
                            <p><b>Salary Invoice</b></p>
                        </div>
                    </div>
                    <div class="print-body">
                        <div class="row">


                            <div class="col-lg-12 mt-3">
                                <!-- Striped Rows -->
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Employee Name</th>
                                            <th scope="col">Gross Salary</th>
                                            <th scope="col">Comission</th>
                                            <th scope="col">Bonus</th>
                                            <th scope="col">Deduction</th>
                                            <th scope="col">Total Paid</th>
                                            <th scope="col">Arrear</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Month/Year</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($salary_data as $data)
                                            <tr>
                                                <th>
                                                    {{ $loop->iteration }}
                                                </th>
                                                <th scope="row">
                                                    {{ $data->employeeDetails->name }}
                                                </th>
                                                <td> {{ $data->employeeDetails->gross_salary }}</td>
                                                <td>{{ $data->comission }}</td>
                                                <td>{{ $data->bonus }}</td>
                                                <td>{{ $data->deduction }}</td>
                                                <td>{{ $data->total_paid }}</td>
                                                <td>{{ $data->arrear }}</td>
                                                <td>{{ $data->remarks }}</td>
                                                <td>{{ $data->status }}</td>
                                                <td>{{ $data->month }}, {{ $data->year }}</td>

                                            </tr>
                                        @endforeach

                                </table>
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
