@extends('backend.layouts.master')
@section('title', 'Expense')
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
                <h4 class="mb-sm-0">Expense</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Expense</a>
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
            <div class="card-header">
                <form action="{{route('expense.index')}}" method="GET">
                    @csrf
                    <div class="row print_hide">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Start Date</span>
                                                    <input type="date" name="start_date" value="{{ request()->get('start_date') }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">End Date</span>
                                                    <input type="date" name="end_date" value="{{ request()->get('end_date') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <button type="submit" class="btn btn-block signin_button btn-primary">Search</button>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group">
                                                    <button type="button" class="btn btn-block signin_button btn-primary" onclick="startPrint()">Print </button>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="input-group">
                                                    <a href="{{ route('expense.create') }}" class="btn btn-success"><i class="bx bxs-plus-square"></i>
                                                        Add Expense</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body ">
                @include('backend.layouts.notifications')
                @if (count($expense_invoices) > 0)
                    <table id="datatable" class="table table-bordered print_area">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Invoice No</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Heads</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="reqtablenew">
                            @foreach ($expense_invoices as $data)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>{{ $data->invoice_id }}</td>
                                    <td>{{ $data->getExpenseDetails[0]->grand_total}}</td>
                                    <td>
                                        @foreach ($data->getExpenseDetails as $head_details)
                                            {{ $head_details->getHeadDetails->expense_head }},
                                        @endforeach
                                    </td>
                                    <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('expense.show', $data->invoice_id) }}" class="btn btn-info"><i
                                                    class="las la-print"></i></a>
                                            <a href="{{ route('expense.edit', $data->invoice_id) }}"
                                                class="btn btn-success">Edit</a>
                                            <a href="{{ route('expense.delete', $data->invoice_id) }}"
                                                class="btn btn-primary">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#reqtablenew tr').click(function () {
                $('#reqtablenew tr').removeClass("row_active");
                $(this).addClass("row_active");
            });
        });

        function startPrint() {
            $('.print_hide').hide();
            // $('.btn_off').hide();
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
