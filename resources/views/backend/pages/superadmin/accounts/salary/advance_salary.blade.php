@extends('backend.layouts.master')
@section('title', 'Advance Salary')
@section('custom-styles')

@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Employees Salary</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Employees Salary</a>
                        </li>
                        <li class="breadcrumb-item active">Advance</li>
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
                    <form method="get" action="">
                        {{-- @csrf --}}
                        <div class="row gy-4">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}">
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
                            <div class="col-lg-3" id="employees_list">
                                <div class="form-group">
                                    <label for="employees">Select Employee</label>
                                    <select name="employee_id" class="form-control select2">
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="deliveryman_list">
                                <div class="form-group">
                                    <label for="deliverymans">Select deliveryman</label>
                                    <select name="deliveryman_id" class="form-control select2">
                                        <option value="">Select deliveryman</option>
                                        @foreach ($deliverymans as $deliveryman)
                                            <option value="{{ $deliveryman->id }}">{{ $deliveryman->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3" id="pickupman_list">
                                <div class="form-group">
                                    <label for="pickupmans">Select pickupman</label>
                                    <select name="pickupman_id" class="form-control select2">
                                        <option value="">Select pickupman</option>
                                        @foreach ($pickupmans as $pickupman)
                                            <option value="{{ $pickupman->id }}">{{ $pickupman->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">&nbsp;</label>
                                    <br>
                                    <input type="submit" value="Create Advance" class="btn btn-primary">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                @include('backend.layouts.notifications')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if ($data)
            <div class="card">
                <div class="card-header">
                    <h4>Advance Salary</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee.advance.salary.store') }}" method="post">
                        @csrf
                        <input type="text" name="selection" value="{{$selection}}" hidden>
                        <div class="row gy-2">
                            <input type="date" name="advance_date" value="{{ $date }}" hidden>
                            <input type="text" name="employee_id" value="{{ $data[0]->id }}" hidden>
                            <div class="col-lg-4">
                                <label for="">Employee Name</label>
                                <h5>{{ $data[0]->name }}</h5>
                            </div>
                            <div class="col-lg-4">
                                <label for="Total Advance">Total Advance</label>
                                <input type="number" readonly value="{{ $data[0]->advanceSalary->sum('advance_amount') }}"
                                    class="form-control">
                            </div>

                            <div class="col-lg-4">
                                <label for="Amount">Amount</label>
                                <input type="number" name="advance_amount" value="0" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="control-label">&nbsp;</label>
                                <br>
                                <input type="submit" value="Take Advance" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>

@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function() {
            $("#employees_list").hide();
            $("#deliveryman_list").hide();
            $("#pickupman_list").hide();

            $("#role_select").on('change', function() {
                let id = $(this).val();
                if (id == 1) {
                    $("#employees_list").show();
                    $("#deliveryman_list").hide();
                    $("#pickupman_list").hide();

                }
                if (id == 2) {
                    $("#employees_list").hide();
                    $("#deliveryman_list").show();
                    $("#pickupman_list").hide();

                }
                if (id == 3) {
                    $("#employees_list").hide();
                    $("#deliveryman_list").hide();
                    $("#pickupman_list").show();

                }
                if (id == 0) {
                    $("#employees_list").hide();
                    $("#deliveryman_list").hide();
                    $("#pickupman_list").hide();
                }

            });
        });
    </script>
@endsection
