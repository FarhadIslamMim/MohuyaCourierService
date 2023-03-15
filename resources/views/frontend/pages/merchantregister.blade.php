@extends('frontend.layouts.master')
@section('title', 'Merchant Registration')
@section('custom-styles')

@endsection
@section('main-content')

    <!-- Merchant Registration -->

    <section class="section mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 col-xl-6">
                <div class="card mt-">
                    <div class="card-header">
                        <h3>Merchant Account Registration</h3><br>
                    </div>
                    <div class="card-body">
                        <div class="register-page">
                            <div class="contact-top1">
                                @include('backend.layouts.notifications')
                                @if ($msg)
                                    <div class="alert alert-success alert-dismissible fade show">

                                        {{ $msg }}
                                    </div>
                                @endif
                                @if (!$verify_code)
                                    <form action="{{ route('merchant.register.page') }}" method="GET"
                                        class="contact-wthree-do">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row gy-3">
                                                @if (!$phoneNumber)
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="phoneNumber">Enter Mobile No.<span
                                                                    class="text-danger">*</span> </label>
                                                            <input id="req3" class="form-control  {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                                                type="text" name="phoneNumber"
                                                                value="{{ old('phoneNumber') }}">

                                                            @if ($errors->has('phoneNumber'))
                                                                <span class="invalid-feedback">
                                                                    <strong>{{ $errors->first('phoneNumber') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($phoneNumber)
                                                    <br>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Verify Code <span class="text-danger">*</span>
                                                            </label>
                                                            <input class="form-control" type="hidden" name="mobile_no"
                                                                value="{{ $phoneNumber }}">
                                                            <input class="form-control" type="verify" name="verify_code">
                                                        </div>
                                                    </div>
                                                @endif
                                                <br>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary">
                                                            Register
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                @if ($verify_code && Session::get('merchant_id') && $form_show)
                                    <form action="{{ route('merchant.register') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <h3 class="text-center">Merchant Account Registration</h3><br>
                                        <div class="form-group">
                                            <div class="row gy-3">
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group {{ $errors->has('companyName') ? ' is-invalid' : '' }}">
                                                        <label for="companyName">Company Name <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="companyName"
                                                            value="{{ old('companyName') }}">
                                                        @if ($errors->has('companyName'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('companyName') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group {{ $errors->has('firstName') ? ' is-invalid' : '' }}">
                                                        <label for="firstName">Name<span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="firstName"
                                                            value="{{ old('firstName') }}">

                                                        @if ($errors->has('firstName'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('firstName') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phoneNumber">Mobile No.<span
                                                                class="text-danger">*</span></label>
                                                        <input readonly
                                                            class="form-control  {{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}"
                                                            type="text" name="phoneNumber"
                                                            value="{{ old('phoneNumber', request()->get('mobile_no')) }}">
                                                        @if ($errors->has('phoneNumber'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('phoneNumber') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phoneNumber">Alternative Mobile No.<span
                                                                class="text-danger">*</span></label>
                                                        <input id="req3"
                                                            class="form-control"
                                                            type="number" name="otherphoneNumber"
                                                             >
                                                        @if ($errors->has('otherphoneNumber'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('otherphoneNumber') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div> --}}
                                               {{-- <div class="col-md-12">
                                                    <p> <b>NID/ Birth Certificate / Driving License</b> <span
                                                            class="text-danger">*</span> </p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-check-inline">
                                                                <label for="nid" class="form-check-label">
                                                                    <input type="radio" id="nid"
                                                                        class="form-check-input identification_type"
                                                                        name="identification_type" value="1"
                                                                        @if (old('identification_type', 1) == 1) checked @endif>
                                                                    NID
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label for="birth_certificate" class="form-check-label">
                                                                    <input type="radio" id="birth_certificate"
                                                                        class="form-check-input identification_type"
                                                                        name="identification_type" value="2"
                                                                        @if (old('identification_type') == 2) checked @endif>
                                                                    Birth Certificate
                                                                </label>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <label for="driving_licence" class="form-check-label">
                                                                    <input type="radio" id="driving_licence"
                                                                        class="form-check-input identification_type"
                                                                        name="identification_type" value="3"
                                                                        @if (old('identification_type') == 3) checked @endif>
                                                                    Driving License
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 nid_part">
                                                            <div
                                                                class="form-group {{ $errors->has('nidnumber') ? ' is-invalid' : '' }}">
                                                                <label for="nidnumber">NID No. <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input class="form-control" type="text"
                                                                    name="nidnumber" value="{{ old('nidnumber') }}"
                                                                    placeholder="Enter NID no.">

                                                                @if ($errors->has('nidnumber'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('nidnumber') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                         <div class="col-md-6 nid_part">
                                                            <div
                                                                class="form-group {{ $errors->has('nid_photo') ? ' is-invalid' : '' }}">
                                                                <label for="nid_photo"> NID Front Side <small> Size
                                                                        (324*204)</small> <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input class="form-control" type="file"
                                                                    name="nid_photo" id="nid_photo" accept="image/*">

                                                                @if ($errors->has('nid_photo'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('nid_photo') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <img id="nid_photo_show" style="width:120px"
                                                                    class="img-fluid"
                                                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                                                                    alt="NID Photo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 nid_part">
                                                            <div
                                                                class="form-group {{ $errors->has('nid_photo_back') ? ' is-invalid' : '' }}">
                                                                <label for="nid_photo_back"> NID Back Side <small>
                                                                        Size
                                                                        (324*204)</small> <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input class="form-control" type="file"
                                                                    name="nid_photo_back" id="nid_photo_back"
                                                                    accept="image/*">

                                                                @if ($errors->has('nid_photo_back'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('nid_photo_back') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <img style="width:120px" class="img-fluid"
                                                                    id="nid_photo_back_show"
                                                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                                                                    alt="NID Photo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 birth_certificate_part"
                                                            style="display: none;">
                                                            <div
                                                                class="form-group {{ $errors->has('birth_certificate_no') ? ' is-invalid' : '' }}">
                                                                <label for="birth_certificate_no"> Birth Certificate No
                                                                    <span class="text-danger">*</span> </label>
                                                                <input class="form-control" type="text"
                                                                    name="birth_certificate_no" id="birth_certificate_no"
                                                                    value="{{ old('birth_certificate_no') }}"
                                                                    placeholder="Birth Certificate No.">

                                                                @if ($errors->has('birth_certificate_no'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('birth_certificate_no') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 birth_certificate_part"
                                                            style="display: none;">
                                                            <div
                                                                class="form-group {{ $errors->has('birth_certificate_photo') ? ' is-invalid' : '' }}">
                                                                <label for="birth_certificate_photo">
                                                                    Birth Certificate Photo
                                                                    <span class="text-danger">*</span> <small> Size
                                                                        (324*204)</small> </label>
                                                                <input class="form-control" type="file"
                                                                    name="birth_certificate_photo"
                                                                    id="birth_certificate_photo" accept="image/*">

                                                                @if ($errors->has('birth_certificate_photo'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('birth_certificate_photo') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <img style="width:120px" class="img-fluid"
                                                                    id="birth_certificate_photo_show"
                                                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                                                                    alt="Birth
                                                                            certificate photo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 driving_licence_part"
                                                            style="display: none;">
                                                            <div
                                                                class="form-group {{ $errors->has('driving_licence_no') ? ' is-invalid' : '' }}">
                                                                <label for="driving_licence_no"> Driving license No.
                                                                    <span class="text-danger">*</span> </label>
                                                                <input class="form-control" type="text"
                                                                    name="driving_licence_no" id="driving_licence_no"
                                                                    value="{{ old('driving_licence_no') }}">

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
                                                                <label for="driving_licence_photo"> Driving license
                                                                    photo
                                                                    <span class="text-danger">*</span> <small> Size
                                                                        (324*204)</small> </label>
                                                                <input class="form-control" type="file"
                                                                    name="driving_licence_photo"
                                                                    id="driving_licence_photo" accept="image/*">

                                                                @if ($errors->has('driving_licence_photo'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('driving_licence_photo') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <img style="width:120px" class="img-fluid"
                                                                    id="driving_licence_photo_show"
                                                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                                                                    alt="Driving licence photo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <br>
                                                <br>
                                                <div class="col-lg-12 mt-4">
                                                    <h5>Address Information</h5>
                                                </div>
                                                <br>

                                                <div class="col-md-6">

                                                    <div
                                                        class="form-group {{ $errors->has('division_id') ? ' is-invalid' : '' }}">
                                                        <label for="division_id"> Division <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select type="text" name="division_id" id="division_id"
                                                            class="form-control select2" required>
                                                            <option value=""> Divison </option>
                                                            @foreach ($divisions as $key => $division)
                                                                <option value="{{ $division->id }}">
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
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group {{ $errors->has('district_id') ? ' is-invalid' : '' }}">
                                                        <label for="district_id"> District <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <select type="text" name="district_id" id="district_id"
                                                            class="form-control select2" required>
                                                            <option value=""> District</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group {{ $errors->has('thana_id') ? ' is-invalid' : '' }}">
                                                        <label for="thana_id"> Thana </label>
                                                        <select type="text" name="thana_id" id="thana_id"
                                                            class="form-control select2">
                                                            <option value=""> Thana </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group {{ $errors->has('area_id') ? ' is-invalid' : '' }}">
                                                        <label for="area_id"> Thana </label>
                                                        <select type="text" name="area_id" id="area_id"
                                                            class="form-control select2">
                                                            <option value=""> Selected Area </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div
                                                        class="form-group {{ $errors->has('pickLocation') ? ' is-invalid' : '' }}">
                                                        <label for="pickLocation">Pickup Location<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" name="pickLocation" class="form-control"
                                                            required>

                                                        @if ($errors->has('pickLocation'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('pickLocation') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="rgPayment">
                                                        <h5> How would you like to receive payment? <span
                                                                class="text-danger">*</span>
                                                        </h5>
                                                        <div class="form-check form-check-inline">
                                                            <div class="form-group">
                                                                <label for="cash"> Cash </label>
                                                                <input class="cash" type="radio" id="cash"
                                                                    name="payoption" value="4">
                                                            </div>
                                                            <div class="form-group ">
                                                                <label for="bkash"> Bkash </label>
                                                                <input class="ins_show" type="radio" id="bkash"
                                                                    name="payoption" value="2">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nagad"> Nagad </label>
                                                                <input type="radio" id="nagad" name="payoption"
                                                                    value="3">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="bank"> Bank </label>
                                                                <input type="radio" id="bank" name="payoption"
                                                                    value="1">
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="bank" style="display:none">
                                                                <div class="form-group col-lg-12">
                                                                    <label for="">Bank Name</label>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="Bank Name" name="bank_name"
                                                                        style="width:100% !important">
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                    <label for="">Branch Name</label>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="Branch Name" name="branch_name"
                                                                        style="width:100% !important">
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                    <label for="">Account Holder Name</label>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="Account holder name"
                                                                        name="ac_holder_name"
                                                                        style="width:100% !important">
                                                                </div>
                                                                <div class="form-group col-lg-12">
                                                                    <label for="">Accouont number</label>

                                                                    <input class="form-control" type="text"
                                                                        placeholder="Bank Account number"
                                                                        name="bank_ac_no" style="width:100% !important">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="ins_payment">
                                                            <div class="form-group">

                                                                <input class="form-control" type="text"
                                                                    placeholder="Bkash number" name="bNumber"
                                                                    style="width:100% !important">

                                                            </div>
                                                            <p>* Payment Message</p>
                                                            <p>* Contact with us- {{ $setting->mobile_no }} </p>
                                                        </div>

                                                        <div class="nagad" style="display:none">
                                                            <div class="form-group">

                                                                <input class="form-control" type="text"
                                                                    placeholder="Nagad number" name="nNumber"
                                                                    style="width:100% !important">

                                                            </div>
                                                            <p>* Payment Message</p>
                                                            <p>* @lang('common.payment_failed_info')- {{ $setting->mobile_no }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="col-md-12">
                                                    <h4>Set Password</h4>
                                                </div>
                                                <br>

                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                                        <label for="password">Password<span class="text-danger">*</span>
                                                        </label>
                                                        <input class="form-control" type="password" name="password"
                                                            value="{{ old('password') }}">

                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div
                                                        class="form-group {{ $errors->has('confirmed') ? ' is-invalid' : '' }}">
                                                        <label for="confirmed">Confirm Password<span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input class="form-control" type="password" name="confirmed"
                                                            value="{{ old('confirmed') }}">

                                                        @if ($errors->has('confirmed'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('confirmed') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-md-12 text-text">
                                                    <button type="submit" class="btn btn-success">
                                                        Complete Registration
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- /.Merchant Registration -->

    </section>
@endsection
@section('custom-scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset( 'assets/phone/validate.js' )}}"></script>
    <script>
        $(document).ready(function () {
            $("#req3").prop('maxlength','11');
            var literal = {
                req3: {
                    selector: $('#req3'),
                    length: {
                        value: 11,
                        message: 'Only 11 characters are allowed,And Must be a digit'
                    },
                    digit: {}
                },
            };
            var result = $.validate.rules(literal, { mode: 'bootstrap' });
            console.log(result);
        });
    </script>

    <script>
        // $('#phone').keypress(function(e) {
        //     var foo = $(this).val()
        //     if(foo.length >= 11) { //specify text limit
        //         $('#phone').addClass('input-style');
        //         if(foo.length === 0 ){
        //             $('#phone').removeClass('input-style');
        //         }
        //         // $('span').text('Length is not valid, maximum '+ foo.length +' allowed.');
        //         return false;
        //     }
        //
        //     return true;
        // });

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

            $('.select2').select2();
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

    <script>
        $('.ins_payment').hide();
        $('.cash').click(function() {
            $('.ins_payment').hide();
            $('.bank').hide();
            $('.nagad').hide();
        })
        $('.ins_show').click(function() {
            $('.ins_payment').show();
            $('.bank').hide();
            $('.nagad').hide();
        })
        $('.ins_hide').click(function() {
            $('.ins_payment').hide();
            $('.nagad').hide();
        })
        $('#bank').click(function() {
            $('.bank').show();
            $('.ins_payment').hide();
            $('.nagad').hide();

        })
        $('#nagad').click(function() {
            $('.ins_payment').hide();
            $('.bank').hide();
            $('.nagad').show();
        })
    </script>

@endsection
