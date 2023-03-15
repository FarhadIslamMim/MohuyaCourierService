@extends('backend.layouts.master')
@section('title', 'Merchant Create')
@section('custom-styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Merchant Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Merchant</a></li>
                        <li class="breadcrumb-item active">Merchant Create</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel create content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Merchant Create</h4>
                    <br>
                    @include('backend.layouts.notifications')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form role="form" action="{{ route('merchant.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="companyName">Company Name</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('companyName') ? ' is-invalid' : '' }}"
                                                    value="{{ old('companyName') }}" id="companyName" name="companyName"
                                                    placeholder="Company name" required
                                                    data-error="Please enter company name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firstName">Name</label>

                                                <input type="text"
                                                    class="form-control {{ $errors->has('firstName') ? ' is-invalid' : '' }}"
                                                    value="{{ old('firstName') }}" id="firstName" name="firstName"
                                                    placeholder="Name" required data-error="Please enter your Name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phoneNumber">Phone Number</label>
                                                <input type="text" placeholder="Phone Number*" id="phoneNumber"
                                                    class="form-control {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                                    value="{{ old('phoneNumber') }}" name="phoneNumber" required
                                                    data-error="Please enter your Phone *">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emailAddress">Email Address</label>
                                                <input type="text" placeholder="Email Address" id="emailAddress"
                                                    class="form-control {{ $errors->has('emailAddress') ? ' is-invalid' : '' }}"
                                                    value="{{ old('emailAddress') }}" name="emailAddress"
                                                    data-error="Please enter your email">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fatherName">Father Name</label>
                                                <input type="text" placeholder="Father Name" id="fathers_name"
                                                    class="form-control {{ $errors->has('fathers_name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('fathers_name') }}" name="fathers_name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_name">Mother Name</label>
                                                <input type="text" placeholder="Mother Name" id="mothers_name"
                                                    class="form-control {{ $errors->has('mothers_name') ? ' is-invalid' : '' }}"
                                                    value="{{ old('mothers_name') }}" name="mothers_name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="trade_license_no">Trade License No.</label>
                                                <input type="text" placeholder="Trade License No" id="trade_licence_no"
                                                    class="form-control {{ $errors->has('trade_licence_no') ? ' is-invalid' : '' }}"
                                                    value="{{ old('trade_licence_no') }}" name="trade_licence_no">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="website">Website</label>
                                                <input type="text" placeholder="Website" id="website"
                                                    class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}"
                                                    value="{{ old('website') }}" name="website">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pickup_thana">Select Pickup Thana *</label>
                                                <select name="pickup_thana_id" id="pickup_thana_id"
                                                    class="form-control select2" required>
                                                    <option value=""> Select pickup thana * </option>
                                                    @foreach ($thanas as $thana)
                                                        <option value="{{ $thana->id }}"> {{ $thana->name }}
                                                            ({{ $thana->district->name ?? '' }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pickLocation">Pickup location *</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('pickLocation') ? ' is-invalid' : '' }}"
                                                    id="pickLocation" name="pickLocation"
                                                    value="{{ old('pickLocation') }}" placeholder="Pickup location"
                                                    data-error="Please enter your pick location" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="facebook_page">Facebook Page</label>
                                                <input type="text" placeholder="Facebook page" id="facebook_page"
                                                    class="form-control {{ $errors->has('facebook_page') ? ' is-invalid' : '' }}"
                                                    value="{{ old('facebook_page') }}" name="facebook_page">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            {{-- <p> <b>NID/ Birth Certificate No/ Driving License No.</b> <span
                                                    class="text-danger">*</span> </p> --}}
                                            {{-- <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input identification_type" type="radio"
                                                            id="nid" name="identification_type" value="1"
                                                            @if (old('identification_type', 1) == 1) checked @endif>
                                                        <label class="form-check-label" for="nid"> NID
                                                        </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input identification_type" type="radio"
                                                            id="birth_certificate" name="identification_type"
                                                            value="2"
                                                            @if (old('identification_type', 1) == 2) checked @endif>
                                                        <label class="form-check-label" for="birth_certificate">
                                                            Birth Certificate </label>
                                                    </div>
                                                    <div class="form-check-inline">
                                                        <input class="form-check-input identification_type" type="radio"
                                                            id="driving_licence" name="identification_type"
                                                            value="3"
                                                            @if (old('identification_type', 1) == 3) checked @endif>
                                                        <label class="form-check-label" for="driving_licence">
                                                            Driving License </label>
                                                    </div>
                                                </div> --}}
                                                {{-- <br>
                                                <br> --}}

                                                {{-- <div class="col-md-12 nid_part">
                                                    <div
                                                        class="form-group {{ $errors->has('nidnumber') ? ' is-invalid' : '' }}">
                                                        <input class="form-control" type="text" name="nidnumber"
                                                            value="{{ old('nidnumber') }}" placeholder="NID Number">
                                                        @if ($errors->has('nidnumber'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('nidnumber') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-md-6 nid_part">
                                                    <div
                                                        class="form-group {{ $errors->has('nid_photo') ? ' is-invalid' : '' }}">
                                                        <label for="nid_photo"> NID Front Part 
                                                            <small> Size
                                                                (324x204)</small> </label>
                                                        <input class="form-control" type="file" name="nid_photo"
                                                            id="nid_photo" accept="image/*">

                                                        @if ($errors->has('nid_photo'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('nid_photo') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <img width="324px" id="nid_photo_show" src="{{ asset('public/no_image.jpg') }}"
                                                            alt="NID Photo">
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-md-6 nid_part">
                                                    <div
                                                        class="form-group {{ $errors->has('nid_photo_back') ? ' is-invalid' : '' }}">
                                                        <label for="nid_photo_back"> NID Back Part
                                                            <small> Size
                                                                (324x204)</small> </label>
                                                        <input class="form-control" type="file" name="nid_photo_back"
                                                            id="nid_photo_back" accept="image/*">

                                                        @if ($errors->has('nid_photo_back'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('nid_photo_back') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <img width="324px" id="nid_photo_back_show"
                                                            src="{{ asset('public/no_image.jpg') }}"
                                                            alt="NID Photo Back">
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-md-12 birth_certificate_part" style="display: none;">
                                                    <div
                                                        class="form-group {{ $errors->has('birth_certificate_no') ? ' is-invalid' : '' }}">
                                                        <input class="form-control" type="text"
                                                            name="birth_certificate_no"
                                                            value="{{ old('birth_certificate_no') }}"
                                                            placeholder="Birth Certificate No.">

                                                        @if ($errors->has('birth_certificate_no'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('birth_certificate_no') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="col-md-6 birth_certificate_part" style="display: none;">
                                                    <div
                                                        class="form-group {{ $errors->has('birth_certificate_photo') ? ' is-invalid' : '' }}">
                                                        <label for=""> Birth Certificate Photo <span
                                                                class="text-danger">*</span> <small> Size
                                                                (324x204)</small> </label>
                                                        <input class="form-control" type="file"
                                                            name="birth_certificate_photo" id="birth_certificate_photo"
                                                            accept="image/*">

                                                        @if ($errors->has('birth_certificate_photo'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('birth_certificate_photo') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div> --}}
                                                    {{-- <div>
                                                        <img width="324px" id="birth_certificate_photo_show"
                                                            src="{{ asset('public/no_image.jpg') }}"
                                                            alt="Birth certificate photo">
                                                    </div> --}}
                                                </div>
                                                <div class="col-md-12 driving_licence_part" style="display: none;">
                                                    <div
                                                        class="form-group {{ $errors->has('driving_licence_no') ? ' is-invalid' : '' }}">
                                                        <input class="form-control" type="text"
                                                            name="driving_licence_no"
                                                            value="{{ old('driving_licence_no') }}"
                                                            placeholder="Driving License">

                                                        @if ($errors->has('driving_licence_no'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('driving_licence_no') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 driving_licence_part" style="display: none;">
                                                    <div
                                                        class="form-group {{ $errors->has('driving_licence_photo') ? ' is-invalid' : '' }}">
                                                        <label for=""> Driving License Photo <span
                                                                class="text-danger">*</span> <small> Size
                                                                (324x204)</small> </label>
                                                        <input class="form-control" type="file"
                                                            name="driving_licence_photo" id="driving_licence_photo"
                                                            accept="image/*">

                                                        @if ($errors->has('driving_licence_photo'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('driving_licence_photo') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <img width="324px" id="driving_licence_photo_show"
                                                            src="{{ asset('public/no_image.jpg') }}"
                                                            alt="Driving licence photo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="division_id"> Division <span class="text-danger">*</span>
                                                </label>
                                                <select name="division_id" id="division_id"
                                                    class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                                    value="{{ old('division_id') }}" required>
                                                    <option value="">Division</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}">{{ $division->name }}
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
                                                <label for="district_id">District<span class="text-danger">*</span>
                                                </label>
                                                <select name="district_id" id="district_id" class="form-control select2"
                                                    required>
                                                    <option value="">Selcect District </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="thana_id">Thana</label>
                                                <select name="thana_id" id="thana_id" class="form-control select2">
                                                    <option value="">Select Thana</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="area_id">Area</label>
                                                <select name="area_id" id="area_id" class="form-control select2">
                                                    <option value="">Area</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="present_addres">Present Address</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('present_address') ? ' is-invalid' : '' }}"
                                                    id="present_address" name="present_address"
                                                    value="{{ old('present_address') }}" placeholder="Present Address"
                                                    data-error="Please enter your present address">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="permanent_address">Permanent Address</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('permanent_address') ? ' is-invalid' : '' }}"
                                                    id="permanent_address" name="permanent_address"
                                                    value="{{ old('permanent_address') }}"
                                                    placeholder="Permanent Address"
                                                    data-error="Please enter your permanent address">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password *</label>
                                                <input type="password" placeholder="Password" id="password"
                                                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    value="{{ old('password') }}" name="password" required
                                                    data-error="Please enter your Password">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" placeholder="Confirm Password" id="confirmed"
                                                    class="form-control {{ $errors->has('confirmed') ? ' is-invalid' : '' }}"
                                                    value="{{ old('confirmed') }}" name="confirmed" required
                                                    data-error="Please enter your Confirm Password">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="paymentMethod">Payment Method</label>
                                            <select name="paymentMethod" id="paymentMethod"
                                                class="custom-select form-control {{ $errors->has('paymentMethod') ? ' is-invalid' : '' }}"
                                                value="{{ old('paymentMethod') }}" placeholder="Payment Method ">
                                                <option value="" selected>Payment Method </option>
                                                <option value="1">Bank</option>
                                                <option value="2">Bkash</option>
                                                <option value="3">Nagad</option>
                                                <option value="4">Cash</option>
                                                <option value="5">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('bank_name') ? ' is-invalid' : '' }}"
                                                    id="bank_name" value="{{ old('bank_name') }}" name="bank_name"
                                                    placeholder="Bank Name" data-error="Please enter your bank name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="branch_name">Branch Name</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('branch_name') ? ' is-invalid' : '' }}"
                                                    id="branch_name" value="{{ old('branch_name') }}" name="branch_name"
                                                    placeholder="Branch Name" data-error="Please enter your branch name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="Accoun">Account Holder Name</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('ac_holder_name') ? ' is-invalid' : '' }}"
                                                    id="ac_holder_name" value="{{ old('ac_holder_name') }}"
                                                    name="ac_holder_name" placeholder="Account holder name"
                                                    data-error="Please enter your A/C Holder name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bank_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="Bank">Bank Account Number</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('bank_ac_no') ? ' is-invalid' : '' }}"
                                                    id="bank_ac_no" value="{{ old('bank_ac_no') }}" name="bank_ac_no"
                                                    placeholder="Bank account no"
                                                    data-error="Please enter your bank account no.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 bkash_info" style="display: none;">
                                            <div class="form-group">
                                                <label for="bkashNumber">Bkash Number</label>
                                                <input type="text"
                                                    class="form-control {{ $errors->has('bkashNumber') ? ' is-invalid' : '' }}"
                                                    id="bkashNumber" value="{{ old('bkashNumber') }}" name="bkashNumber"
                                                    placeholder="Enter bkash number"
                                                    data-error="Please enter your bkash number">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 nagad_info" style="display: none;">
                                            <label for="Nagad">Nagad Number</label>
                                            <div class="form-group">
                                                <input type="text"
                                                    class="form-control {{ $errors->has('nogodNumber') ? ' is-invalid' : '' }}"
                                                    id="nogodNumber" value="{{ old('nogodNumber') }}" name="nogodNumber"
                                                    placeholder="Enter Nagad Number"
                                                    data-error="Please enter your nagad number">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create new merchant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->

@endsection
@section('custom-scripts')
    <script>
        // NID Photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#nid_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#nid_photo").change(function() {
                readURL(this);
            });
        })
        // NID Photo Back Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#nid_photo_back_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#nid_photo_back").change(function() {
                readURL(this);
            });
        })
        // Birth certificate photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#birth_certificate_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#birth_certificate_photo").change(function() {
                readURL(this);
            });
        })
        // Driving licence photo Show
        $(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#driving_licence_photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#driving_licence_photo").change(function() {
                readURL(this);
            });
        })
    </script>
    <script>
        $(function() {
            $('body').on('click', '.identification_type', function() {
                var identification_type = $('input[name="identification_type"]:checked').val();
                if (identification_type == 1) {
                    $('.nid_part').show();
                    $('.birth_certificate_part').hide();
                    $('.driving_licence_part').hide();
                } else if (identification_type == 2) {
                    $('.nid_part').hide();
                    $('.birth_certificate_part').show();
                    $('.driving_licence_part').hide();
                } else {
                    $('.nid_part').hide();
                    $('.birth_certificate_part').hide();
                    $('.driving_licence_part').show();
                }
            })

            $('body').on('change', '#paymentMethod', function() {
                var paymentMethod = $('#paymentMethod').val();
                if (paymentMethod == 1) {
                    $('.bank_info').show();
                    $('.bkash_info').hide();
                    $('.nagad_info').hide();
                } else if (paymentMethod == 2) {
                    $('.bank_info').hide();
                    $('.bkash_info').show();
                    $('.nagad_info').hide();
                } else if (paymentMethod == 3) {
                    $('.bank_info').hide();
                    $('.bkash_info').hide();
                    $('.nagad_info').show();
                } else {
                    $('.bank_info').hide();
                    $('.bkash_info').hide();
                    $('.nagad_info').hide();
                }
            })

            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#district_id').html(options);
                });
            })
            // Get Thana
            $('body').on('change', '#district_id', function() {
                var district_id = $('#district_id').val();
                var options = '<option value=""> Select thana </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#thana_id').html(options);
                    $('#thana_id').trigger('change');
                });
            })
            // Get Area
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_areas_final') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#area_id').html(options);
                });
            })

        })
    </script>
@endsection
