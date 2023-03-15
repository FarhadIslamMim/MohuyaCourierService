@extends('backend.layouts.master')
@section('title', 'Employee Salary')
@section('custom-styles')

@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Employee Salary</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Employee Salary</a>
                        </li>
                        <li class="breadcrumb-item active">Salary</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="form">
                    <form method="get" action="" enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <select name="salary_year" class="form-control">
                                        <option selected disabled>Select Year</option>
                                        @for ($year = 2020; $year <= date('Y'); $year++)
                                            <option value="{{ $year }}"
                                                {{ request()->get('salary_year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="">Select Month</option>
                                        {{--
                                        <option value="{{ $month}}"
                                            {{ request()->get('month') == $month ? 'selected' : '' }}>
                                            {{ $month }}</option> --}}
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="role_list">
                                <div class="form-group">
                                    <label for="employees">Select Role</label>
                                    <select name="selection" class="form-control select2" id="role_select">
                                        <option value="0">Select Role</option>
                                        <option value="1">Employees</option>
                                        <option value="2">Deliveryman</option>
                                        <option value="3">Pickupman</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">&nbsp;</label>
                                    <br>
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Employee Salary</h4>
            </div>
            <div class="card-body">
                @if (count($sheets) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">Status</th>
                                <th scope="col">Boucher No</th>
                                <th scope="col">Year</th>
                                <th scope="col">Month</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Pay Date</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sheets as $data)
                                <tr>
                                    <th scope="row">
                                        <div>
                                            {{-- <a href="{{route('employee.salary.sheet.details', $data->invoice_no)}}" class="badge badge-info" href="">View</a> --}}
                                            <a href="{{ url("superadmin/employee-salary/employee-salary-details/{$data->invoice_no}/{$selection}") }}"
                                                class="btn btn-info btn-sm" href="">View</a>
                                            @if ($data->status == 0)
                                                <a data-id="{{ $data->invoice_no }}" data-selection={{ $selection }}
                                                    data-bs-toggle="modal" data-bs-target="#pay" href="javascript:void(0)"
                                                    class="btn btn-success btn-sm invoice_id" href="">Pay</a>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($data->status == 1)
                                            <div class="badge badge-soft-primary">Paid</div>
                                        @else
                                            <div class="badge badge-soft-info">Pending</div>
                                        @endif
                                    </td>
                                    <td>{{ $data->invoice_no }}</td>
                                    <td>{{ $data->year }}</td>
                                    <td>{{ $data->month }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->pay_date }}</td>
                                    <td>{{ $data->payment_method }}</td>
                                    <td>
                                        {{-- <a href="{{ route('admin.employee.salary.export', $data->boucher_no) }}"
                                            class="btn btn-primary"> <i class="fa fa-download"></i> Download
                                            Excel
                                            <i class="fa fa-file-excel"></i></a> --}}
                                    </td>

                                </tr>
                            @endforeach

                    </table>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Action</th>
                                <th scope="col">Status</th>
                                <th scope="col">Boucher No</th>
                                <th scope="col">Year</th>
                                <th scope="col">Month</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Pay Date</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salary_sheets as $data)
                                <tr>
                                    <th scope="row">
                                        <div class="btn-group">
                                            <a href="{{ url("superadmin/employee-salary/employee-salary-sheet/{$data->invoice_no}/{$role}") }}"
                                                class="badge badge-info" href="">View</a>
                                            <a href="{{ url("superadmin/employee-salary/employee-salary-sheet/{$data->invoice_no}/{$role}") }}"
                                                class="btn btn-info btn-sm" href="">View</a>
                                            @if ($data->status == 0)
                                                <a data-id="{{ $data->invoice_no }}" data-bs-toggle="modal"
                                                    data-bs-target="#pay" href="javascript:void(0)"
                                                    class="btn btn-success btn-sm invoice_id" href="">Pay</a>
                                            @endif
                                        </div>
                                    </th>
                                    <td>
                                        @if ($data->status == 1)
                                            <div class="badge badge-soft-primary">Paid</div>
                                        @else
                                            <div class="badge badge-soft-info">Pending</div>
                                        @endif
                                    </td>
                                    <td>{{ $data->invoice_no }}</td>
                                    <td>{{ $data->year }}</td>
                                    <td>{{ $data->month }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->payment_date }}</td>
                                    <td>{{ $data->payment_method }}</td>
                                    <td>
                                        {{-- <a href="{{ route('admin.employee.salary.export', $data->boucher_no) }}"
                                            class="btn btn-primary"> <i class="fa fa-download"></i> Download
                                            Excel
                                            <i class="fa fa-file-excel"></i></a> --}}
                                    </td>

                                </tr>
                            @endforeach

                    </table>
                @endif
            </div>
        </div>
    </div>


    {{-- pay modal --}}
    <!-- Grids in modals -->
    <div class="modal fade" id="pay" tabindex="-1" aria-labelledby="payement" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="payement">Pay the salary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee.salary.sheet.paid') }}" method="post">
                        @csrf
                        <input type="text" id="invoice_id" name="invoice_id" hidden>
                        <input type="text" id="selection_id" name="selection_id" hidden>
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="payment_date" class="form-label">Payment Date</label>
                                    <input type="date" class="form-control" name="payment_date" id="payment_date"
                                        placeholder="Payment Date">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="lastName" class="form-label">Payment Method</label>
                                    <select name="payment_method" name="payment_method" class="form-control">
                                        <option value="Cash">Cash</option>
                                        <option value="Bkash">Bkash</option>
                                        <option value="Nagad">Nagad</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Pay</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function() {
            $('.invoice_id').on('click', function() {
                let id = $(this).attr('data-id');
                let selection = $(this).attr('data-selection');
                $("#invoice_id").val(id);
                $("#selection_id").val(selection);
            });
        });
    </script>
@endsection
