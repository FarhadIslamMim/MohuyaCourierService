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
                        <li class="breadcrumb-item active">Employee Attendance</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row gy-2">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="search_date">Search</label>
                                    <input type="date" name="date"
                                        value="@if ($date) {{ $date }}@else{{ Carbon\Carbon::now()->format('Y-m-d') }} @endif"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4" id="role_list">
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
                            <div class="col-lg-4">
                                <label for="space">&nbsp</label><br>
                                <input type="submit" value="Search" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Take Attendance</h3>
                    @include('backend.layouts.notifications')
                    @if ($date)
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                @if (count($attendences) > 0)
                                    <form action="{{ route('attendence.update') }}" method="post">
                                        @csrf
                                        <input type="text" name="date" value="{{ $date }}" hidden>
                                        <input type="text" name="selection" value="{{ $selection }}" hidden>
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Employee</th>
                                                            <th>Present</th>
                                                            <th>Absent</th>
                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Reason</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($attendences as $attendence)
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                <td>{{ $attendence->employeData->name }} <input
                                                                        name="id[{{ $attendence->id }}]" type="text"
                                                                        hidden value="{{ $attendence->id }}"></td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="radio"
                                                                            @if ($attendence->status === 'Present') checked="true" @endif
                                                                            value="Present"
                                                                            name="status[{{ $attendence->id }}]">
                                                                    </div>
                                                                </td>
                                                                <td><input type="radio"
                                                                        @if ($attendence->status === 'Absent') checked="true" @endif
                                                                        value="Absent"
                                                                        name="status[{{ $attendence->id }}]" />
                                                                </td>
                                                                <td>
                                                                    <input type="time" class="form-control"
                                                                        name="starttime[{{ $attendence->id }}]"
                                                                        value="{{ $attendence->starttime }}">
                                                                </td>
                                                                <td>
                                                                    <input type="time" class="form-control"
                                                                        name="endtime[{{ $attendence->id }}]"
                                                                        value="{{ $attendence->endtime }}">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        @if ($attendence->note) value="{{ $attendence->note }}" @endif
                                                                        name="note[{{ $attendence->id }}]"
                                                                        placeholder="Reason">
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" value="Update Attendance" class="btn btn-primary">
                                        </div>
                                    </form>
                                @else
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Date - {{ $date }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('attendence.store') }}" method="post">
                                                @csrf
                                                <input type="text" name="date" value="{{ $date }}" hidden>
                                                <input type="text" name="selection" value="{{ $selection }}" hidden>
                                                <div class="form-group">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Employee</th>
                                                                <th>
                                                                    <input type="checkbox" id="selectAll"> Present
                                                                </th>
                                                                <th> <input type="checkbox" id="checkAll"> Absent</th>
                                                                <th>Start Time</th>
                                                                <th>End Time</th>
                                                                <th>Reason</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($employees as $employee)
                                                                <tr>
                                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                                    <td>{{ $employee->name }} <input name="employee_id[]"
                                                                            type="text" hidden
                                                                            value="{{ $employee->id }}"></td>
                                                                    <td>
                                                                            <input type="radio" class="selectall"  value="Present"
                                                                                name="status[{{ $employee->id }}]">
                                                                    </td>
                                                                    <td><input type="radio" required value="Absent"
                                                                            name="status[{{ $employee->id }}]" /></td>
                                                                    <td>
                                                                        <input type="time" class="form-control"
                                                                            name="starttime[{{ $employee->id }}]">
                                                                    </td>
                                                                    <td>
                                                                        <input type="time" class="form-control"
                                                                            name="endtime[{{ $employee->id }}]">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control"
                                                                            name="note[{{ $employee->id }}]"
                                                                            placeholder="Reason">
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" value="Create Attendance"
                                                        class="btn btn-primary">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
  <script>
      $('#selectAll').click(function () {
          $('.selectall').prop('checked', this.checked);
          $('#checkAll').prop("checked", false);
      });
      $('#checkAll').click(function () {
          $('input:radio').prop('checked', this.checked);
          $('#selectAll').prop("checked", false);
      });
  </script>
@endsection
