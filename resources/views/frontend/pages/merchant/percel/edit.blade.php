@extends('frontend.layouts.master')
@section('title', 'Edit Parcel')
@section('custom-styles')
@endsection
@section('main-content')
    <div class="section bg-light  mt-5">
        <div class="container">
            <div class="row">
                {{-- @include('frontend.pages.merchant.layouts.sidebar') --}}
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit Parcel</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row addpercel-inner">
                                        <div class="col-lg-7 col-md-12 col-sm-12">
                                            <div class="fraud-search">
                                                {{-- @include('frontend.layouts.notifications') --}}
                                                <form action="{{ route('merchant.percel.update') }}" method="POST"
                                                    name="editForm">
                                                    @csrf
                                                    <input type="hidden" value="{{ $parceledit->id }}" name="hidden_id">
                                                    <input type="hidden" id="merchant_id"
                                                        value="{{ $parceledit->merchantId }}" name="merchant_id">

                                                    <div class="row gy-4">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="invoiceNo">Invoice No</label>
                                                                <input type="text"
                                                                    class="form-control invoiceNo {{ $errors->has('invoiceNo') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('invoiceNo', $parceledit->invoiceNo) }}"
                                                                    name="invoiceNo" placeholder="Invoice No">
                                                                @if ($errors->has('invoiceNo'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('invoiceNo') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div>
                                                                <h6> weight </h6>
                                                            </div>
                                                            <div class="form-group">
                                                                <select name="weight_id"
                                                                    class="form-control select2 weight_id {{ $errors->has('weight_id') ? ' is-invalid' : '' }}"
                                                                    id="weight_id" required>
                                                                    @foreach ($weights as $weight)
                                                                        <option value="{{ $weight->id }}"
                                                                            @if (old('weight_id', $parceledit->weight->id ?? '') == $weight->value) selected @endif>
                                                                            {{ $weight->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('weight_id'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('weight_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div>
                                                                <h6> Cash Collection </h6>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="number" step="any"
                                                                    class="form-control productPrice {{ $errors->has('productPrice') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('productPrice', $parceledit->cod) }}"
                                                                    name="cod" placeholder="Cash Collection" required>
                                                                @if ($errors->has('productPrice'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('productPrice') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Delivery Charge</label>
                                                                <input type="number" id="deliveryChargeInput"
                                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                    value="{{ number_format($parceledit->deliveryCharge, 2) }}"
                                                                    name="deliveryCharge">
                                                                @if ($errors->has('deliveryCharge'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('deliveryCharge') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
 --}}

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Customer Name</label>
                                                                <input type="text"
                                                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('name', $parceledit->recipientName) }}"
                                                                    name="name" placeholder="Name *">
                                                                @if ($errors->has('name'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Phone Number <span class="text-danger">(Max:11 Character)</span></label>
                                                                <input type="text" id="req3"
                                                                    class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('phonenumber', $parceledit->recipientPhone) }}"
                                                                    name="phonenumber" placeholder=" Mobile No. *">
                                                                @if ($errors->has('phonenumber'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('phonenumber') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Alternative Phone No <span class="text-danger">(Max:11 Character)</span></label>
                                                                <input type="text" id="req4"
                                                                    class="form-control{{ $errors->has('alternative_mobile_no') ? ' is-invalid' : '' }}"
                                                                    value="{{ old('alternative_mobile_no', $parceledit->alternative_mobile_no) }}"
                                                                    name="alternative_mobile_no"
                                                                    placeholder="@lang('Alternative Mobile No.')">
                                                                @if ($errors->has('alternative_mobile_no'))
                                                                    <span class="invalid-feedback">
                                                                        <strong>{{ $errors->first('alternative_mobile_no') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
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
                                                        <div class="col-sm-6 inCityDhaka box">
                                                            <label for="">In City</label>
        
                                                            <div class="form-group">
                                                                <select name="thana_id" class="form-control select2 thana_id"
                                                                    id="thana_id" required>
                                                                    <option value=""></option>
                                                                    @foreach ($inCityDhaka as $inCityDhaka)
                                                                            <option value="{{ $inCityDhaka->id }}"
                                                                                @if (old('inCityDhaka') == $inCityDhaka->id) selected @endif>
                                                                                {{ $inCityDhaka->name }}
                                                                            </option>
                                                                        @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6" >
                                                            <div class="form-group">
                                                                <label for="">Delivery Address</label>
        
                                                                    <textarea type="text" name="delivery_address"
                                                                    id="delivery_address" value="{{ old('delivery_address') }}" class="form-control" placeholder="Delivery Address"
                                                                    rows="4"></textarea>
                                                            </div>
                                                        </div>
        
                                                        <div class="col-sm-6" style="">
                                                            <div class="form-group">
                                                                <label for="">Note</label>
                                                                <textarea type="text" name="note" value="{{ old('note') }}" class="form-control" placeholder="Note"
                                                                    rows="4"></textarea>
                                                            </div>
                                                        </div>




                                                        {{-- <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label for="">Division</label>
                                                                <select name="division_id"
                                                                    class="form-control select2 division_id"
                                                                    id="division_id" required>
                                                                    <option value="">Division *</option>
                                                                    @foreach ($divisions as $division)
                                                                        <option value="{{ $division->id }}"
                                                                            @if (old('division_id', $parceledit->division_id) == $division->id) selected @endif>
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
                                                            <div class="form-group">
                                                                <label for="">District</label>

                                                                <select name="district_id"
                                                                    class="form-control select2 district_id"
                                                                    id="district_id" required>
                                                                    <option value="">District *</option>
                                                                </select>
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="col-sm-6">
                                                            <label for="">Thana (Upazila)</label>

                                                            <div class="form-group">
                                                                <select name="thana_id"
                                                                    class="form-control select2 thana_id" id="thana_id"
                                                                    required>
                                                                    <option value="">Thana (Upazila)</option>
                                                                </select>
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="col-sm-6">
                                                            <label for="">Area</label>

                                                            <div class="form-group">
                                                                <select name="area_id"
                                                                    class="form-control select2 area_id" id="area_id">
                                                                    <option value="">Area </option>
                                                                </select>
                                                            </div>
                                                        </div> --}}
                                                        
                                                       
                                                        <div class="col-sm-12">
                                                            <button type="submit"
                                                                class="form-control btn btn-primary w-50">Update</button>
                                                        </div>


                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-lg-1 col-md-1 col-sm-0"></div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="card ribbon-box border shadow-none mb-lg-0">
                                                <div class="card-body">
                                                    <div class="ribbon ribbon-primary round-shape">Cost Summary</div>
                                                    <h5 class="fs-14 text-end">Total Cost for the parcel</h5>
                                                    <div class="ribbon-content mt-4 text-muted">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Delivery Charge</th>
                                                                <td class="text-right">
                                                                    <span class="pdeliverycharge">
                                                                        {{ $parceledit->deliveryCharge }} </span> tk.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>COD Charge</th>
                                                                <td class="text-right">
                                                                    <span class="pcodecharge"> 0.00 </span> tk.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total Charge</th>
                                                                <th class="text-right">
                                                                    <span class="total_charge">
                                                                        {{ $parceledit->deliveryCharge }} </span> tk.
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>Pay to merchant</th>
                                                                <th class="text-right">
                                                                    <span class="total_cash_collection">
                                                                        {{ $parceledit->cod }} </span>
                                                                    tk.
                                                                </th>
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
    </div>
@endsection
@section('custom-scripts')
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
        $(document).ready(function () {
            $("#req4").prop('maxlength','11');
            var literal = {
                req3: {
                    selector: $('#req4'),
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
        $(function() {
            $('body').on('change paste keyup', '.productPrice, .weight_id, #thana_id, #deliveryChargeInput',
                function() {
                    getparcelCharge();

                })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val();
                var thana_id = $('#thana_id').val();
                var deliverycharge = $("#deliveryChargeInput").val();
                var merchantId = $("#merchant_id").val();
                var district_id = $("#district_id").val();
                if (weight_id && productPrice && thana_id) {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('cost.calculator') }}",
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id,
                            'deliveryCharge': deliverycharge,
                            'merchantId': merchantId,
                            'district_id': district_id
                        },

                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            $('.pdeliverycharge').html(response.pdeliverycharge)
                            $('.pcodecharge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                            $('.total_cash_collection').html(response.pay_to_merchant)
                        } else {
                            alert(response.message);
                            $('.pdeliverycharge').html(0.00)
                            $('.pcodecharge').html(0.00)
                            $('.total_charge').html(0.00)
                            $('.total_cash_collection').html(0.00)

                        }

                    });
                }

            }
        })
    </script>
    <script>
        $(function() {

            // Get District
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                var selected = '{{ old('district_id', $parceledit->district_id) }}';
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
                var options = '<option value=""> Select thana </option>';
                var selected = '{{ old('thana_id', $parceledit->thana_id) }}';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_district_thanas') }}",
                    data: {
                        'district_id': district_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#thana_id').html(options);
                    $('#thana_id').trigger('change');
                });
            })
            // Get Area
            $('body').on('change', '#thana_id', function() {
                var thana_id = $('#thana_id').val();
                var options = '<option value=""> Select area </option>';
                var selected = '{{ old('area_id', $parceledit->area_id) }}';

                console.log(selected);

                $.ajax({
                    method: "GET",
                    url: "{{ route('get_thana_areas_final') }}",
                    data: {
                        'thana_id': thana_id
                    },
                }).done(function(response) {

                    response.forEach(function(item, i) {
                        if (selected == item.id) {
                            options += '<option selected value="' + item.id + '"> ' + item
                                .name + ' </option>';
                        } else {
                            options += '<option value="' + item.id + '"> ' + item.name +
                                ' </option>';
                        }
                    });
                    $('#area_id').html(options);
                });
            })
            $('#thana_id').trigger('change');

        })
    </script>

    <script>
        function getAddress() {
            var area_id = $('#area_id').val();
            var options = '';
            if (area_id) {
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_area_address') }}",
                    data: {
                        'area_id': area_id
                    },
                    cache: false,
                    dataType: "json",
                }).done(function(response) {
                    response.forEach(function(item) {
                        options += "<option>" + item.recipientAddress + "</option>"
                    })
                    $('#address_list').html(options);
                });
            }

        }
    </script>

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
