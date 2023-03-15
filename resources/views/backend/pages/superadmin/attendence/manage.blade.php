@extends('backend.layouts.master')
@section('title', 'Employee Attendance')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Attendance</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Attendance</a></li>
                        <li class="breadcrumb-item active">Manage Attendance</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row print_hide">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row gy-4">
                            <div class="col-lg-3" id="role_list">
                                <div class="form-group">
                                    <label for="employees">Select Role</label>
                                    <select name="selection" class="form-control select2" id="role_select">
                                        @if ($selection)
                                            <option value="{{ $selection }}">
                                                @switch($selection)
                                                    @case(1)
                                                        Employees
                                                    @break

                                                    @case(2)
                                                        Deliveryman
                                                    @break

                                                    @case(3)
                                                        Pickupman
                                                    @break

                                                    @default
                                                        Select Role
                                                @endswitch
                                            </option>
                                        @endif
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
                            <div class="form-group col-lg-3">
                                <label for="search_date">Start Date</label>
                                <input type="date" name="start_date"
                                    class="form-control">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="search_date">End Date</label>
                                <input type="date" name="end_date" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control">
                            </div>
                            <div class="form-group col-lg-2">
                                <label class="control-label">&nbsp;</label>
                                <br>
                                <input type="submit" value="Search" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                    <div class="form-group col-lg-2">
                        <label class="control-label">&nbsp;</label>
                        <br>
                        <button type="button" class="btn btn-sm btn-info text-right" onclick="startPrint()">Print </button>
                    </div>
                </div>
            </div>

            @if (count($attendences) > 0)
                <div class="card print_area">
                    <div class="card-header">
                        <h3>Manage Attendance</h3>
                        @include('backend.layouts.notifications')
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">In time</th>
                                    <th scope="col">Out time</th>
                                    <th scope="col">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendences as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}
                                        </th>
                                        <td>{{ date('d M Y g:i a', strtotime($item->date)) }}</td>
                                        <td>

                                            @if ($item->status === 'Present')
                                                <h5><span
                                                        class="badge text-bg-success rounded-pill badge-outline-success">Present</span>
                                                </h5>
                                            @else
                                                <h5><span
                                                        class="badge text-bg-danger rounded-pill badge-outline-danger">Absent</span>
                                                </h5>
                                            @endif
                                        </td>
                                        <td>{{ $item->starttime ?? '-' }}</td>
                                        <td>{{ $item->endtime ?? '-' }}</td>
                                        <td>{{ $item->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            @endif
        </div>
    </div>
@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
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
    function startPrint() {
        $('.print_hide').hide();
        $('body').html($('.print_area').html());
        window.print();
        window.location.replace(APP_URL)
    }
</script>


@endsection
