@extends('frontend.layouts.master')
@section('title', 'Percel Create')
@section('custom-styles')

@endsection
@section('main-content')
    <div class="section bg-light">
        <div class="container">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Percel Create</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row gy-2">
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        @include('frontend.layouts.notifications')
                                        <form action="{{ route('agent.percel.store') }}" method="POST">
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="row gy-4">
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="merchantId">{{ __('lang.merchant') }} <span
                                                                            class="text-danger">
                                                                            *</span></label>
                                                                    <select class="form-control select2"
                                                                        value="{{ old('merchantId') }}" name="merchantId"
                                                                        id="merchantId">
                                                                        <option value="">
                                                                            {{ __('lang.select_merchant') }}</option>
                                                                        @foreach ($merchants as $value)
                                                                            <option value="{{ $value->id }}"
                                                                                @if (old('merchantId') == $value->id) selected @endif>
                                                                                {{ $value->companyName }}
                                                                                (0{{ $value->phoneNumber }})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    @if ($errors->has('merchantId'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('merchantId') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div class="form-group">
                                                                    <label for="weight_id">{{ __('lang.weight') }}<span
                                                                            class="text-danger">*</span></label>
                                                                    <select
                                                                        class="form-control select2 weight_id {{ $errors->has('weight_id') ? ' is-invalid' : '' }}"
                                                                        value="{{ old('weight_id') }}" name="weight_id"
                                                                        id="weight_id">
                                                                        {{-- <option value="">@lang('lang.select')</option> --}}

                                                                        @foreach ($weights as $weight)
                                                                            <option value="{{ $weight->id }}"
                                                                                @if (old('weight_id') == $weight->id) selected @endif>
                                                                                {{ $weight->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    @if ($errors->has('merchantId'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('merchantId') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div class="form-group">
                                                                    <div>
                                                                        <label
                                                                            for="productPrice">{{ __('lang.cash_collection') }}<span
                                                                                class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="number"
                                                                            class="form-control productPrice"
                                                                            id="productPrice" name="productPrice"
                                                                            placeholder="Enter Cash Collection">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-6 col-md-6">
                                                                <div class="form-group">
                                                                    <div>
                                                                        <label
                                                                            for="invoiceNo">{{ __('lang.invoice_no') }}</label>
                                                                        <input type="number" class="form-control invoiceNo"
                                                                            id="invoiceNo" name="invoiceNo"
                                                                            placeholder="00">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- form group -->
                                                            <div class="col-xxl-6 col-md-6">
                                                                <label for="name"> {{ __('lang.customer_name') }} <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('name') }}" name="name"
                                                                    id="name"
                                                                    placeholder="{{ __('lang.customer_name') }}" required>
                                                                @if ($errors->has('name'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>

                                                            <div class="col-xxl-6 col-md-6">
                                                                <label for="phonenumber">{{ __('lang.mobile_no') }} <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <input minlength="11" maxlength="11" type="text"
                                                                    class="form-control {{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('phonenumber') }}" name="phonenumber"
                                                                    id="phonenumber"
                                                                    placeholder="{{ __('lang.mobile_no') }}" required>
                                                                @if ($errors->has('phonenumber'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                                                    </span>
                                                                @endif
                                                                <div id="customer_list"></div>

                                                            </div>
                                                            <div class="col-xxl-6 col-md-6">
                                                                <label
                                                                    for="alternative_mobile_no">{{ __('lang.alternative_mobile_no') }}</label>
                                                                <input type="text"
                                                                    class="form-control {{ $errors->has('alternative_mobile_no') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('alternative_mobile_no') }}"
                                                                    name="alternative_mobile_no" id="alternative_mobile_no"
                                                                    placeholder="{{ __('lang.alternative_mobile_no') }}">
                                                                @if ($errors->has('alternative_mobile_no'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('alternative_mobile_no') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            
                                                            <div class="col-sm-12">
                                                                <div>
                                                                    <label><input type="radio" name="colorRadio" value="inCityDhaka" checked="checked"> Inside Dhaka</label>
                                                                    <label><input type="radio" name="colorRadio" value="outCityDhaka"> Out Side Dhaka</label>
                                                                    
                                                                </div>
                                                            </div>



                                                            <div class="row outCityDhaka box" style=" display: none;" >
                                                                <div class="col-sm-6 ">
                                                                    <div class="form-group">
                                                                        <label for="">Division</label>
                                                                        
                
                                                                        <select name="division_id" class="form-control select2 division_id"
                                                                            id="division_id" required>
                                                                            <option value="">Division *</option>
                                                                            @foreach ($divisions as $division)
                                                                                <option value="{{ $division->id }}"
                                                                                    @if (old('division_id') == $division->id) selected @endif>
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
                                                                <div class="col-sm-6 ">
                                                                    <label for="">District</label>
                
                                                                    <div class="form-group">
                                                                        <select name="district_id" class="form-control select2 district_id"
                                                                            id="district_id" required>
                                                                            <option value="">District *</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 ">
                                                                    <label for="">Thana (Upazila)</label>
                
                                                                    <div class="form-group">
                                                                        <select name="thana_id" class="form-control select2 thana_id"
                                                                            id="thana_id" required>
                                                                            <option value="">Thana (Upazila) </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 ">
                                                                    <label for="">Area</label>
                
                                                                    <div class="form-group">
                                                                        <select name="area_id" class="form-control select2 area_id"
                                                                            id="area_id">
                                                                            <option value="">Area </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                             {{-- In City  --}}
                                                            {{-- <div class="col-sm-6 inCityDhaka box">
                                                                <label for="">Thana (Upazila)</label>

                                                                <div class="form-group">
                                                                    <select name="thana_id" class="form-control select2 thana_id"
                                                                        id="thana_id" required>
                                                                        <option value="">Thana (Upazila) </option>
                                                                        @foreach ($inCityDhaka as $inCityDhaka)
                                                                                <option value="{{ $inCityDhaka->id }}"
                                                                                    @if (old('inCityDhaka') == $inCityDhaka->id) selected @endif>
                                                                                    {{ $inCityDhaka->name }}
                                                                                </option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-sm-6" >
                                                                <div class="form-group">
                                                                    <label for="">Delivery Address</label>

                                                                        <textarea type="text" name="delivery_address"
                                                                        id="delivery_address" value="{{ old('delivery_address') }}" class="form-control" placeholder="Delivery Address"
                                                                        rows="4"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-xxl-6 col-md-6">
                                                                <label for="note">{{ __('lang.note') }}
                                                                    ({{ __('lang.maximum_300_characters') }})</label>
                                                                <textarea rows="4" type="text" class="form-control {{ $errors->has('note') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('note') }}" name="note" placeholder="{{ __('lang.note') }}">{{ old('note') }}</textarea>
                                                                @if ($errors->has('note'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('note') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>


                                                            <div class="col-sm-6">
                                                                <label for="">Picked By</label>
                    
                                                                <div class="form-group">
                                                                    <select name="pickedBy" class="form-control select2 pickedBy"
                                                                        id="pickedBy">
                                                                        <option value="">Picked By</option>
                                                                        @foreach ($pickup_man as $pickup_man)
                                                                        <option value="{{ $pickup_man->id }}"
                                                                            @if (old('pickup_man') == $pickup_man->id) selected @endif>
                                                                            {{ $pickup_man->name }}
                                                                        </option>
                                                                    @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                    
                                                            <div class="col-sm-6">
                                                                <label for="">Delivery By</label>
                    
                                                                <div class="form-group">
                                                                    <select name="deliveryBy" class="form-control select2 deliveryBy"
                                                                        id="deliveryBy">
                                                                        <option value="">Delivery By</option>
                    
                                                                        @foreach ($delivery_man as $delivery_man)
                                                                        <option value="{{ $delivery_man->id }}"
                                                                            @if (old('delivery_man') == $delivery_man->id) selected @endif>
                                                                            {{ $delivery_man->name }}
                                                                        </option>
                                                                    @endforeach
                    
                                                                    </select>
                                                                </div>
                                                            </div>



                                                            {{-- <div class="col-sm-6">
                                                                <div>
                                                                    <label for="division_id">{{ __('lang.division') }}
                                                                        <span class="text-danger">*</span> </label>
                                                                    <select name="division_id" id="division_id"
                                                                        class="form-control select2 {{ $errors->has('division_id') ? ' is-invalid' : '' }}"
                                                                        value="{{ old('division_id') }}" required>
                                                                        <option value="">
                                                                            {{ __('lang.select_division') }}</option>
                                                                        @foreach ($divisions as $division)
                                                                            <option value="{{ $division->id }}"
                                                                                @if (old('division_id') == $division->id) selected @endif>
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
                                                            </div> --}}

                                                            {{-- <div class="col-sm-6">
                                                                <div>
                                                                    <label
                                                                        for="district_id">{{ __('lang.district') }}<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <select name="district_id" id="district_id"
                                                                        class="form-control select2" required>
                                                                        <option value="">
                                                                            {{ __('lang.select_district') }}</option>
                                                                    </select>
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="col-sm-6">
                                                                <div>
                                                                    <label for="thana_id">{{ __('lang.thana') }} (Upazila)<span
                                                                            class="text-danger">*</span> </label>
                                                                    <select name="thana_id" id="thana_id"
                                                                        class="form-control select2" required>
                                                                        <option value="">
                                                                           {{ __('lang.select_thana') }} (Upazila)</option>
                                                                    </select>
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="col-sm-6">
                                                                <div>
                                                                    <label for="area_id">{{ __('lang.area') }}</label>
                                                                    <select name="area_id" id="area_id"
                                                                        class="form-control select2">
                                                                        <option value="">
                                                                            {{ __('lang.select_area') }}</option>
                                                                    </select>
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="col-xxl-6 col-md-6">
                                                                <label
                                                                    for="delivery_address">{{ __('lang.delivery_address') }}
                                                                    ({{ __('lang.maximum_500_characters') }}) <span
                                                                        class="text-danger">*</span></label>
                                                                <textarea type="text" class="form-control {{ $errors->has('delivery_address') ? ' is-invalid' : '' }}"
                                                                    name="delivery_address" id="delivery_address" placeholder="{{ __('lang.delivery_address') }}">{{ old('delivery_address') }}</textarea>


                                                                @if ($errors->has('delivery_address'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('delivery_address') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div> --}}
                                                            <!-- form group -->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Create Percel</button>
                                            </div>
                                        </form>
                                    </div>


                                    {{-- delivery chage --}}
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="card ribbon-box border shadow-none mb-lg-0">
                                            <div class="card-body">
                                                <div class="ribbon ribbon-primary round-shape">
                                                    {{ __('lang.cost_summary') }}</div>
                                                <h5 class="fs-14 text-end">{{ __('lang.Total_Cost_for_the_percel') }}</h5>
                                                <div class="ribbon-content mt-4 text-muted">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>{{ __('lang.delivery_charge') }}</th>
                                                            <td class="text-right">
                                                                <span class="delivery_charge"> 0.00 </span> tk.
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __('lang.cod_charge') }}</th>
                                                            <td class="text-right">
                                                                <span class="cod_charge"> 0.00 </span> tk.
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __('lang.total_charge') }}</th>
                                                            <th class="text-right">
                                                                <span class="total_charge"> 0.00 </span> tk.
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ __('lang.pay_to_merchant') }}</th>
                                                            <td class="text-right">
                                                                <b> <span class="pay_to_merchant"> 0.00 </span> tk.</b>
                                                            </td>
                                                        </tr>
                                                    </table>
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
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(function() {

            $('body').on('keyup', '#phonenumber', function() {
                let phone_number = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('get_customer_details') }}",
                    data: {
                        'phone_number': phone_number,

                    },
                    dataType: "html",
                    success: function(response) {
                        $("#customer_list").html(response);
                    }
                });


            });

            $('body').on('click', '#customer_id', function() {
                var id = $(this).attr('customer-id');
                $('.list-group').remove();
                $.ajax({
                    type: "get",
                    url: "{{ route('set_customer_details') }}",
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $("#phonenumber").val(response.recipientPhone);
                        $("#name").val(response.recipientName);
                        $("#delivery_address").val(response.delivery_address);
                        $("#division_id").val(response.division_id).change();

                        getDistrict(response.division_id, response.district_id);
                        getThana(response.district_id, response.thana_id);
                        getArea(response.thana_id, response.area_id);


                    }
                });
            });

            function getDistrict(division_id, district_id) {
                var options = '';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    var selected = district_id;
                    response.forEach(function(item, i) {
                        if (item.id === selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#district_id').html(options);
                });
            }

            function getThana(district_id, thana_id) {
                var options = '';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    var selected = thana_id;
                    response.forEach(function(item, i) {
                        if (item.id === selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                });
            }

            function getArea(thana_id, area_id) {
                var options = '';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_areas_final') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {
                    var selected = area_id;
                    response.forEach(function(item, i) {
                        if (item.id === selected) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#area_id').html(options);
                });

            }

            $('body').on('change paste keyup',
                '.productPrice, .weight_id, #thana_id, #division_id, #district_id, #merchantId',
                function() {
                    getparcelCharge();
                })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var thana_id = $('#thana_id').val();
                var division_id = $('#division_id').val();
                var district_id = $('#district_id').val();
                var merchantId = $('#merchantId').val();

                if (weight_id && productPrice && thana_id && merchantId) {
                    $.ajax({
                        method: "GET",
                        url: '{{ route('cost.calculator') }}',
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id,
                            'merchantId': merchantId,
                            'division_id': division_id,
                            'district_id': district_id,

                        },
                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            $('.delivery_charge').html(response.pdeliverycharge)
                            $('.cod_charge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                            $('.pay_to_merchant').html(response.pay_to_merchant)
                        } else {
                            alert(response.message);
                            $('.delivery_charge').html(0.00)
                            $('.cod_charge').html(0.00)
                            $('.total_charge').html(0.00)
                        }

                    });
                }

            }
        })
    </script>
    <script>
        $(function() {
            // Get Merchant details
            $('body').on('change', '#merchantId', function() {
                var merchantId = $('#merchantId').val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_merchant_details') }}",
                    data: {
                        'merchantId': merchantId
                    },
                }).done(function(response) {
                    // console.log(response.pickLocation);
                    if (response.pickLocation) {
                        $('#pickLocation').val(response.pickLocation);
                    }
                })
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
    });
    </script>
@endsection
