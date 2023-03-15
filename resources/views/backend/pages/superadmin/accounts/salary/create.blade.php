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
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Create Salary Sheet</h4>
                        <p>Please fillup the form with correct data. </p>
                        @if ($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        <form method="get" action="" enctype="multipart/form-data">

                            <div class="form">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('employee.salary.store') }}" method="post">
                    @csrf
                    @include('backend.layouts.notifications')
                    @if (count($salary_message) > 0)
                        <input type="text" name="year" value="{{ $salary_year }}" hidden>
                        <input type="text" name="month" value="{{ $Orginal_month }}" hidden>
                        <div class="text-center">
                            <h4>Salary Sheet Create</h4>
                            <p>Year {{ $salary_year }} - Month {{ $Orginal_month }}</p>
                        </div>
                        <div class="row">
                            @foreach ($salary_message as $data)
                                @if ($data['exists'] == true)
                                    <div class="card">
                                        <div class="card-header"><b>{{ $data['name'] }}</b></div>
                                        <div class="alert alert-danger">{{ $data['message'] }}</div>
                                    </div>
                                @else
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>{{ $data['name'] }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <input type="text" name="employee_id[]" value="{{ $data['id'] }}"
                                                        hidden>
                                                    <input type="text" name="selection" value="{{ $data['selection'] }}"
                                                        hidden>
                                                    <div class="row gy-3">
                                                        <div class="col-lg-3">
                                                            <label for="Gross Salary">Gross Salary</label>
                                                            <input type="text" readonly disabled class="form-control"
                                                                id="gross_salary_{{ $data['id'] }}"
                                                                value="{{ $data['gross_salary'] }}"
                                                                onkeyup="salaryFineAndTotalSalary({{ $data['id'] }})" />
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="Advance Salary">Advance Salary</label>
                                                            <input type="text" readonly disabled class="form-control"
                                                                id="advance_{{ $data['id'] }}"
                                                                onkeyup="salaryFineAndTotalSalary({{ $data['advance_salary'] }})"
                                                                value="{{ $data['advance_salary'] }}" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="Gross Salary">Comission</label>
                                                            <input type="text" name="comission[]" class="form-control"
                                                                id="comission_{{ $data['id'] }}"
                                                                placeholder="Comission" value="{{ $data['comission'] }}"
                                                                onkeyup="salaryFineAndTotalSalary({{ $data['id'] }})">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="Gross Salary">Bonous</label>
                                                            <input name="bonus[]" type="text" class="form-control"
                                                                id="bonus_{{ $data['id'] }}" placeholder="Bonus"
                                                                onkeyup="salaryFineAndTotalSalary({{ $data['id'] }})">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="Gross Salary">Absent Fine
                                                                ({{ $data['absent_days'] }} days)
                                                            </label>
                                                            <input type="text" name="absent_fine[]"
                                                                value="{{ $data['fine'] }}" class="form-control"
                                                                id="absent_fine_{{ $data['id'] }}"
                                                                placeholder="Absent Fine"
                                                                onload="salaryFineAndTotalSalary({{ $data['id'] }})">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="Gross Salary">Deduction</label>
                                                            <input type="text" name="deduction[]" value=""
                                                                class="form-control" id="deduction_{{ $data['id'] }}"
                                                                placeholder="Deduction"
                                                                onkeyup="salaryFineAndTotalSalary({{ $data['id'] }})">
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label for="Gross Salary">Payble</label>
                                                            <input type="text" name="total_paid[]"
                                                                class="form-control" id="payble_{{ $data['id'] }}"
                                                                placeholder="Paybale"
                                                                >
                                                        </div>
                                                        {{-- <div class="col-lg-3">
                                                            <label for="Gross Salary">Arrear</label>
                                                            <input type="text" name="arrear[]" class="form-control"
                                                                id="unpaid_{{ $data['id'] }}" placeholder="Arrear"
                                                                value="{{ $data['gross_salary'] - $data['advance_salary'] }}">
                                                        </div> --}}
                                                        <div class="col-lg-3">
                                                            <label for="Gross Salary">Remarks</label>
                                                            <input type="text" name="remarks[]" class="form-control"
                                                                id="" placeholder="Remarks">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <h5>Total Amount</h5>
                                                    <h2><span
                                                            id="total_amount_{{ $data['id'] }}">{{ $data['gross_salary'] + $data['comission'] - ($data['advance_salary'] + $data['fine']) }}</span>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

            </div>
            @endif

            <div class="form-group">
                <input type="submit" value="Create Salary Sheet" class="btn btn-primary">
            </div>
            </form>
        </div>
    </div>
    </div>
    </form>
@endsection
@section('custom-scripts')
    <script>
        // select all
        // salary find the total
        function salaryFineAndTotalSalary(id) {

            // console.log(id);

            var gross_salary = $("#gross_salary_" + id).val();
            var advance_salary = $("#advance_" + id).val();
            var comission = $("#comission_" + id).val();
            var bonus = $('#bonus_' + id).val();
            // var unpaid = $('#unpaid_' + id).val();
            var deduction = $("#deduction_" + id).val();
            var payble = $("#payble_" + id).val();

            total_salary1 = Number(gross_salary) + Number(comission) + Number(bonus);
            // total_salary2 = Number(total_salary1) - Number(deduction) - Number(payble);
            total_salary = Number(gross_salary) - Number(advance_salary) - Number(deduction) + Number(comission) + Number(
                bonus);
            // payable = Number(payble_salary.toFixed(2));
            // due_salary = Number(payble);

            // $("#payble" + id).val(payable);
            // console.log(payble_salary);
            $("#total_amount_" + id).html(total_salary.toFixed(2));

            final_salary = Number(total_salary) - Number(payble);

            // $("#unpaid_" + id).val(final_salary);

        }
    </script>
@endsection
