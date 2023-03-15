@extends('backend.layouts.master')
@section('title', 'Employee Update')
@section('custom-styles')
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #000000 !important;
        }



        .select2-results__option[aria-selected=true]:before {
            border: 0;
            display: inline-block;
            padding-left: 3px;
        }

        .select2-container .select2-selection--multiple {
            height: 150px !important;
            margin: 0;
            padding: 0;
            line-height: inherit;
            border-radius: 0;
            overflow: scroll;
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Employee Update</h4>
                {{-- @php
                    phpinfo();
                @endphp --}}
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                        <li class="breadcrumb-item active">Employee Update</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel Update content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Employee Update</h4>
                    <br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" action="{{ route('employee.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @include('backend.layouts.notifications')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="row gy-4">
                                        <input type="hidden" name="hidden_id" value="{{ $edit_data->id }}">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">Employee name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="name" id="name"
                                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->name) }}" required>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                        </div>
                                        <!-- column end -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">Email address </label>
                                                <input type="email" name="email" id="email"
                                                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->email) }}">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="phone">Mobile No.<span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="phone" id="phone"
                                                    class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->phone) }}" required>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="alternative_phone">Alternative phone number</label>
                                                <input type="text" name="alternative_phone" id="alternative_phone"
                                                    class="form-control {{ $errors->has('alternative_phone') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->alternative_phone) }}">
                                                @if ($errors->has('alternative_phone'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('alternative_phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="nid_no">NID Number</label>
                                                <input type="text" name="nid_no" id="nid_no"
                                                    class="form-control {{ $errors->has('nid_no') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->nid_no) }}">
                                                @if ($errors->has('nid_no'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fathers_name">Father Name</label>
                                                <input type="text" name="fathers_name" id="fathers_name"
                                                    class="form-control {{ $errors->has('fathers_name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->fathers_name) }}">
                                                @if ($errors->has('fathers_name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fathers_name">Father Profession</label>
                                                <input type="text" name="fathers_profession" id="fathers_profession"
                                                    class="form-control {{ $errors->has('fathers_profession') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->fathers_profession) }}">
                                                @if ($errors->has('fathers_profession'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fathers_nid_no">Father NID</label>
                                                <input type="text" name="fathers_nid_no" id="fathers_nid_no"
                                                    class="form-control {{ $errors->has('fathers_nid_no') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->fathers_nid_no) }}">
                                                @if ($errors->has('fathers_nid_no'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fathers_mobile_no">Father Mobile No.</label>
                                                <input type="text" name="fathers_mobile_no" id="fathers_mobile_no"
                                                    class="form-control {{ $errors->has('fathers_mobile_no') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->fathers_mobile_no) }}">
                                                @if ($errors->has('fathers_mobile_no'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="mothers_name">Mother Name</label>
                                                <input type="text" name="mothers_name" id="mothers_name"
                                                    class="form-control {{ $errors->has('mothers_name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->mothers_name) }}">
                                                @if ($errors->has('mothers_name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('mothers_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="mothers_profession">Mother Profession</label>
                                                <input type="text" name="mothers_profession" id="mothers_profession"
                                                    class="form-control {{ $errors->has('mothers_profession') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->mothers_profession) }}">
                                                @if ($errors->has('mothers_profession'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('mothers_profession') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="mothers_nid_no">Mother NID</label>
                                                <input type="text" name="mothers_nid_no" id="mothers_nid_no"
                                                    class="form-control {{ $errors->has('mothers_nid_no') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->mothers_nid_no) }}">
                                                @if ($errors->has('mothers_nid_no'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="mothers_mobile_no">Mother Mobile No</label>
                                                <input type="text" name="mothers_mobile_no" id="mothers_mobile_no"
                                                    class="form-control {{ $errors->has('mothers_mobile_no') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->mothers_mobile_no) }}">
                                                @if ($errors->has('mothers_mobile_no'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="birth_date">Date of Birth</label>
                                                <input type="date" name="birth_date" id="birth_date"
                                                    class="form-control {{ $errors->has('birth_date') ? ' is-invalid' : '' }}"
                                                    value="{{ old('name', $edit_data->birth_date) }}">
                                                @if ($errors->has('birth_date'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="religion">Religion</label>
                                                <select id="religion" name="religion" class="form-control select2">
                                                    <option value="Islam"
                                                        @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>Islam
                                                    </option>
                                                    <option value="Christianity"
                                                        @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>
                                                        Christian</option>
                                                    <option value="Hinduism"
                                                        @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>Hindu
                                                    </option>
                                                    <option value="Buddhism"
                                                        @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>Buddha
                                                    </option>
                                                    <option value="Godless"
                                                        @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>Atheist
                                                    </option>
                                                    <option value="Others"
                                                        @if (old('religion', $edit_data->religion) == 'Islam') selected @endif>Others
                                                    </option>
                                                </select>
                                                @if ($errors->has('religion'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="marital_status">Marital Status </label>
                                                <select id="marital_status" name="marital_status"
                                                    class="form-control select2">
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                @if ($errors->has('marital_status'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('nid') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="designation">Designation</label>
                                                <input type="text" name="designation" id="designation"
                                                    class="form-control {{ $errors->has('designation') ? ' is-invalid' : '' }}"
                                                    value="{{ old('designation', $edit_data->designation) }}">
                                                @if ($errors->has('designation'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('designation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="gross_salary">Gross Salary</label>
                                                <input type="number" name="gross_salary" id="gross_salary"
                                                    class="form-control {{ $errors->has('gross_salary') ? ' is-invalid' : '' }}"
                                                    value="{{ old('gross_salary', $edit_data->gross_salary) }}">
                                                @if ($errors->has('gross_salary'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('gross_salary') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="present_address">Present address</label>
                                                <input type="text" name="present_address" id="present_address"
                                                    class="form-control {{ $errors->has('present_address') ? ' is-invalid' : '' }}"
                                                    value="{{ old('present_address', $edit_data->present_address) }}"
                                                    autocomplete="new-present_address">
                                                @if ($errors->has('present_address'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('present_address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="permanent_address"> Permanent address </label>
                                                <input type="text" name="permanent_address" id="permanent_address"
                                                    class="form-control {{ $errors->has('permanent_address') ? ' is-invalid' : '' }}"
                                                    value="{{ old('permanent_address', $edit_data->permanent_address) }}"
                                                    autocomplete="new-permanent_address">
                                                @if ($errors->has('permanent_address'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('permanent_address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- education --}}
                                        <div class="table-responsive">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"> Educational Qualification</h3>
                                                </div>
                                                <div class="main-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-left"> Exam name <span
                                                                                class="text-danger">*</span></th>
                                                                        <th class="text-left"> Group<span
                                                                                class="text-danger">*</span></th>
                                                                        <th class="text-left"> GPA <span
                                                                                class="text-danger">*</span></th>
                                                                        <th class="text-left"> Passing year <span
                                                                                class="text-danger">*</span></th>
                                                                        <th class="text-left"> Board<span
                                                                                class="text-danger">*</span></th>
                                                                        <th class="text-left"> </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="education_container">
                                                                    @foreach ($edit_data->educations ?? [] as $education)
                                                                        <tr class="education_item">
                                                                            <td class="text-left">
                                                                                <input type="text" name="exam_name[]"
                                                                                    value="{{ $education->exam_name }}"
                                                                                    class="form-control" required>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <input type="text" name="group[]"
                                                                                    value="{{ $education->group }}"
                                                                                    class="form-control" required>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <input type="text" name="gpa[]"
                                                                                    value="{{ $education->gpa }}"
                                                                                    class="form-control" required>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <input type="text" name="year[]"
                                                                                    value="{{ $education->year }}"
                                                                                    class="form-control" required>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <input type="text" name="board[]"
                                                                                    value="{{ $education->board }}"
                                                                                    class="form-control" required>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger remove_education">x</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                                <tfoot>
                                                                    <tr>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-info add_education">
                                                                                Add more</button>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- education closed --}}
                                        {{-- experience --}}
                                        <div class="table-responsive">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title"> Experience </h3>
                                                </div>
                                                <div class="main-body">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-left"> Company Name<span
                                                                                class="text-danger">*</span> </th>
                                                                        <th class="text-left"> Designation <span
                                                                                class="text-danger">*</span></th>
                                                                        <th class="text-left"> Date from <span
                                                                                class="text-danger">*</span> </th>
                                                                        <th class="text-left"> Date to <small>
                                                                                Empty for continue</small> </th>
                                                                        <th class="text-left"> </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="experience_container">
                                                                    @foreach ($edit_data->experiences ?? [] as $experience)
                                                                        <tr class="experience_item">
                                                                            <td class="text-left">
                                                                                <input type="text"
                                                                                    name="company_name[]"
                                                                                    value="{{ $experience->company_name }}"
                                                                                    class="form-control" required>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <input type="text"
                                                                                    name="designations[]"
                                                                                    value="{{ $experience->designation }}"
                                                                                    class="form-control" required>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <input type="date" name="start_date[]"
                                                                                    value="{{ $experience->start_date }}"
                                                                                    class="form-control" required>
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <input type="date" name="end_date[]"
                                                                                    value="{{ $experience->end_date }}"
                                                                                    class="form-control">
                                                                            </td>
                                                                            <td class="text-left">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger remove_experience">x</button>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>

                                                                <tfoot>
                                                                    <tr>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-info add_experience">
                                                                                Add More</button>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>

                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- gurantor --}}
                                        <div class="table-reponsive">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Gurantor Information </h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row gy-4">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="guaranteer_information"> Gurantor Information
                                                                </label>
                                                                <input type="text" name="guaranteer_information"
                                                                    id="guaranteer_information"
                                                                    class="form-control {{ $errors->has('guaranteer_information') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('guaranteer_information', $edit_data->guaranteer_information) }}"
                                                                    autocomplete="new-guaranteer_information">
                                                                @if ($errors->has('guaranteer_information'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('guaranteer_information') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="guaranteer_name"> Name </label>
                                                                <input type="text" name="guaranteer_name"
                                                                    id="guaranteer_name"
                                                                    class="form-control {{ $errors->has('guaranteer_name') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('guaranteer_name', $edit_data->guaranteer_name) }}"
                                                                    autocomplete="new-guaranteer_name">
                                                                @if ($errors->has('guaranteer_name'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('guaranteer_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="guaranteer_relation"> Relation
                                                                </label>
                                                                <input type="text" name="guaranteer_relation"
                                                                    id="guaranteer_relation"
                                                                    class="form-control {{ $errors->has('guaranteer_relation') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('guaranteer_relation', $edit_data->guaranteer_relation) }}"
                                                                    autocomplete="new-guaranteer_relation">
                                                                @if ($errors->has('guaranteer_relation'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('guaranteer_relation') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="guaranteer_nid_no">NID Number</label>
                                                                <input type="text" name="guaranteer_nid_no"
                                                                    id="guaranteer_nid_no"
                                                                    class="form-control {{ $errors->has('guaranteer_nid_no') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('guaranteer_nid_no', $edit_data->guaranteer_nid_no) }}"
                                                                    autocomplete="new-guaranteer_nid_no">
                                                                @if ($errors->has('guaranteer_nid_no'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('guaranteer_nid_no') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="guaranteer_mobile_no">
                                                                    Mobile No.</label>
                                                                <input type="text" name="guaranteer_mobile_no"
                                                                    id="guaranteer_mobile_no"
                                                                    class="form-control {{ $errors->has('guaranteer_mobile_no') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('guaranteer_mobile_no', $edit_data->guaranteer_mobile_no) }}"
                                                                    autocomplete="new-guaranteer_mobile_no">
                                                                @if ($errors->has('guaranteer_mobile_no'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('guaranteer_mobile_no') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="guaranteer_present_address"> Present address
                                                                </label>
                                                                <input type="text" name="guaranteer_present_address"
                                                                    id="guaranteer_present_address"
                                                                    class="form-control {{ $errors->has('guaranteer_present_address') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('guaranteer_present_address', $edit_data->guaranteer_present_address) }}"
                                                                    autocomplete="new-guaranteer_present_address">
                                                                @if ($errors->has('guaranteer_present_address'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('guaranteer_present_address') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label for="guaranteer_permanent_address">
                                                                    Permanent address
                                                                    address </label>
                                                                <input type="text" name="guaranteer_permanent_address"
                                                                    id="guaranteer_permanent_address"
                                                                    class="form-control {{ $errors->has('guaranteer_permanent_address') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('guaranteer_permanent_address', $edit_data->guaranteer_permanent_address) }}"
                                                                    autocomplete="new-guaranteer_permanent_address">
                                                                @if ($errors->has('guaranteer_permanent_address'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('guaranteer_permanent_address') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- gurantor closed --}}
                                            <div class="table-responsive">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title"> Others Information </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row gy-4">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="division_id"> Division <span
                                                                            class="text-danger">*</span> </label>
                                                                    <select name="division_id" id="division_id"
                                                                        class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                                                        value="{{ old('division_id') }}" required>
                                                                        <option value="">Select Divisoin</option>
                                                                        @foreach ($divisions as $division)
                                                                            <option value="{{ $division->id }}"
                                                                                @if (old('division_id', $edit_data->division_id) == $division->id) selected @endif>
                                                                                {{ $division->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('division_id'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('division_id') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="district_id">District<span
                                                                            class="text-danger">*</span> </label>
                                                                    <select name="district_id" id="district_id"
                                                                        class="form-control select2" required>
                                                                        @foreach ($districts as $district)
                                                                        <option value="{{ $district->id }}"
                                                                            @if (old('district_id', $edit_data->division_id) == $district->id) selected @endif>
                                                                            {{ $district->name }}
                                                                        </option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="agent_id">Agent<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <select data-choices name="agent_id[]" id="agent_id"
                                                                        class="form-control multi_select2"
                                                                        data-type="select-multiple" data-choices-removeItem
                                                                        multiple required>
                                                                        <option value="">Select Agent</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="area_id"> Area <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <select name="area_id[]" id="area_id"
                                                                        class="form-control multi_select2" multiple
                                                                        required>
                                                                        <option value="">Select Area</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="password">Password <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="password" name="password" id="password"
                                                                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                                        value="" autocomplete="new-password"
                                                                        >
                                                                    @if ($errors->has('password'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="confirm"> Confirm Password <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="password" name="confirm" id="confirm"
                                                                        class="form-control {{ $errors->has('confirm') ? ' is-invalid' : '' }}"
                                                                        value="" autocomplete="new-password"
                                                                        >
                                                                    @if ($errors->has('confirm'))
                                                                        <span class="invalid-feedback">
                                                                            <strong>{{ $errors->first('confirm') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <div class="custom-label">
                                                                                <label> Status <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="box-body pub-stat display-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" id="active"
                                                                                    name="status" value="1"
                                                                                    @if (old('status', $edit_data->status) == 1) checked @endif>
                                                                                <label for="active">Active</label>
                                                                                @if ($errors->has('status'))
                                                                                    <span class="invalid-feedback">
                                                                                        <strong>{{ $errors->first('status') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="box-body pub-stat display-inline">
                                                                                <input class="form-check-input"
                                                                                    type="radio" name="status"
                                                                                    value="0" id="inactive"
                                                                                    @if (old('status', $edit_data->status) == 0) checked @endif>
                                                                                <label for="inactive">Inactive</label>
                                                                                @if ($errors->has('status'))
                                                                                    <span class="invalid-feedback">
                                                                                        <strong>{{ $errors->first('status') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- row gy closed --}}
                                </div>
                                <div class="col-xl-4">
                                    <div class="form-group">
                                        <label for="image"> Employee Photo <span
                                                class="text-danger">*</span> </label>
                                        <div>
                                            <img src="{{ asset($edit_data->image) }}" id="image_show" alt="Photo"
                                                width="100" height="100">
                                        </div>
                                        <br>
                                        <br>
                                        <input type="file" name="image" id="image"
                                            class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                            value="{{ old('image') }}">
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update Employee</button>
                        </div>
                    </form>


                    {{-- template --}}
                    <template id="template_education">
                        <tr class="education_item">
                            <td class="text-left">
                                <input type="text" name="exam_name[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="group[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="gpa[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="year[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="board[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <button type="button" class="btn btn-sm btn-danger remove_education">x</button>
                            </td>
                        </tr>
                    </template>
                    <template id="template_experience">
                        <tr class="experience_item">
                            <td class="text-left">
                                <input type="text" name="company_name[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="text" name="designations[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="date" name="start_date[]" class="form-control" required>
                            </td>
                            <td class="text-left">
                                <input type="date" name="end_date[]" class="form-control">
                            </td>
                            <td class="text-left">
                                <button type="button" class="btn btn-sm btn-danger remove_experience">x</button>
                            </td>
                        </tr>
                    </template>
                </div>
            </div>
        </div>
    </div>
    <!-- percel Update content end -->

@endsection
@section('custom-scripts')
    <script>
        $(function() {

            $('.multi_select2').select2({
                closeOnSelect: false,
            });

            $('body').on('click', '.save_btn', function() {
                var image = $('#image').val();
                if (!image) {
                    alert('Photo field is required');
                }
            });

            // Education part
            $('body').on('click', '.add_education', function() {
                var html = $('#template_education').html();
                $('#education_container').append(html);
            });

            $('body').on('click', '.remove_education', function() {
                $(this).closest('.education_item').remove();
                // if ($('.education_item').length <= 1 ) {
                //     $('.remove_education').hide();
                // }
            });

            // Experience Part
            $('body').on('click', '.add_experience', function() {
                var html = $('#template_experience').html();
                $('#experience_container').append(html);
            });

            $('body').on('click', '.remove_experience', function() {
                $(this).closest('.experience_item').remove();
                // if ($('.experience_item').length <= 1 ) {
                //     $('.remove_experience').hide();
                // }
            });

            $('#agent_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#agent_id > option").prop("selected", "selected");
                    $("#agent_id").trigger("change");
                }
            });

            $('#area_id').on("select2:select", function(e) {
                var data = e.params.data.text;
                if (data == 'All') {
                    $("#area_id > option").prop("selected", "selected");
                    $("#area_id").trigger("change");
                }
            });

            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                var selected = '{{ old('district_id') }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (item.id == selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#district_id').html(options);
                    $('#district_id').trigger('change');
                });

            })
            $('#division_id').trigger('change');

            // Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value="" class="agent_list">All</option>';
                var selected = null;
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_agents') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (jQuery.inArray(item.id, selected) != '-1') {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' - ' + item.phone + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' - ' + item.phone + ' </option>';
                        }
                    });
                    $('#agent_id').html(options);
                });


            })

            // Get Area
            $('body').on('change', '#agent_id', function() {
                var agent_id = $('#agent_id').val();
                var options = '<option value="" class="area_list">All</option>';
                var selected = null;
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_agent_areas') }}",
                    data: {
                        'agent_id': agent_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (jQuery.inArray(item.id, selected) != '-1') {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' (' + item.thana.name + ') </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' (' + item.thana.name + ') </option>';
                        }
                    });
                    $('#area_id').html(options);

                });

            })


        })

        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
