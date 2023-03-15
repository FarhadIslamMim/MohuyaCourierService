@extends('frontend.layouts.master')
@section('title', 'Parcel Create')
@section('custom-styles')

@endsection
@section('main-content')
    <div class="section bg-light">
        <div class="container">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Parcel Create</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row gy-2">
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        @include('frontend.layouts.notifications')
                                        <form action="{{ route('merchant.percel.store') }}" method="POST">
                                            @csrf
                                            <div class="col-sm-12">
                                                <h4> Parcel Information </h4>
                                            </div>
                                            <input type="text" hidden value="{{ Session::get('merchantId') }}" id="merchantId">
                                            <div class="row gy-4">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Invoice No</label>
                                                        <input type="text"
                                                            class="form-control invoiceNo {{ $errors->has('invoiceNo') ? ' is-invalid' : '' }}"
                                                            value="{{ old('invoiceNo') }}" name="invoiceNo"
                                                            placeholder="Invoice No.">
                                                        @if ($errors->has('invoiceNo'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('invoiceNo') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Parcel Weight</label>

                                                        <select name="weight_id"
                                                            class="form-control select2 weight_id {{ $errors->has('weight_id') ? ' is-invalid' : '' }}"
                                                            id="weight_id" required>
                                                            @foreach ($weights as $weight)
                                                                <option value="{{ $weight->id }}">
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
                                                    <div class="form-group">
                                                        <label for="">Cash Collection</label>
                                                        <input type="number" step="any"
                                                            class="form-control productPrice {{ $errors->has('productPrice') ? ' is-invalid' : '' }}"
                                                            value="{{ old('productPrice') }}" name="productPrice"
                                                            placeholder="Total Cash Collection" required>
                                                        @if ($errors->has('productPrice'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('productPrice') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Customer Name</label>
                                                        <input type="text"
                                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            value="{{ old('name') }}" id="name" name="name"
                                                            placeholder="Customer Name *" autocomplete="off">
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
                                                            class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }} phonenumber"
                                                            value="{{ old('phonenumber') }}"
                                                            name="phonenumber" placeholder="Mobile No. *" autocomplete="off">
                                                        @if ($errors->has('phonenumber'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('phonenumber') }}</strong>
                                                            </span>
                                                        @endif
                                                        <div id="customer_list"></div>

                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Alternative Phone No <span class="text-danger">(Max:11 Character)</span></label>
                                                        <input type="text" id="req4"
                                                            class="form-control {{ $errors->has('alternative_mobile_no') ? ' is-invalid' : '' }}"
                                                            value="{{ old('alternative_mobile_no') }}"
                                                            name="alternative_mobile_no"
                                                            placeholder="Alternative mobile no." autocomplete="off">
                                                        @if ($errors->has('alternative_mobile_no'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('alternative_mobile_no') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- <div class="col-sm-6">
                                                    <label for="">Picked By</label>

                                                    <div class="form-group">
                                                        <select name="pickedBy" class="form-control select2 pickedBy"
                                                            id="pickedBy" required>
                                                            <option value="">Picked By</option>
                                                        </select>
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="col-sm-6">
                                                    <label for="">Delivery By</label>

                                                    <div class="form-group">
                                                        <select name="deliveryBy" class="form-control select2 deliveryBy"
                                                            id="deliveryBy" required>
                                                            <option value="">Delivery By</option>
                                                        </select>
                                                    </div>
                                                </div> --}}

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
                                                <div class="col-sm-6">
                                                    <label for="">District</label>

                                                    <div class="form-group">
                                                        <select name="district_id" class="form-control select2 district_id"
                                                            id="district_id" required>
                                                            <option value="">District *</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Thana (Upazila)</label>

                                                    <div class="form-group">
                                                        <select name="thana_id" class="form-control select2 thana_id"
                                                            id="thana_id" required>
                                                            <option value="">Thana (Upazila) </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Area</label>

                                                    <div class="form-group">
                                                        <select name="area_id" class="form-control select2 area_id"
                                                            id="area_id">
                                                            <option value="">Area </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Delivery Address</label>

                                                            <textarea type="text" name="delivery_address"
                                                            id="delivery_address" value="{{ old('delivery_address') }}" class="form-control" placeholder="Delivery Address"
                                                            rows="4"></textarea>
                                                    </div>
                                                </div> --}}




                                               
                                                

                                            </div>
                                            <div class="col-sm-12">
                                                <br>
                                                <button type="submit" class="btn btn-success w-50">Create
                                                    Parcel</button>
                                            </div>
                                        </form>
                                    </div>


                                    

                                    {{-- delivery chage --}}
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
                                                                <span class="pdeliverycharge"> 0.00 </span> tk.
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
                                                                <span class="total_charge"> 0.00 </span> tk.
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>Pay to merchant</th>
                                                            <td class="text-right">
                                                                <b> <span class="merchant_pay"> 0.00 </span> tk.</b>
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
            $('body').on('keyup', '.phonenumber', function() {
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
                    },
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
                        $(".phonenumber").val(response.recipientPhone);
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


            $('body').on('change paste keyup', '.productPrice, .weight_id, #thana_id', function() {
                getparcelCharge();
            })

            function getparcelCharge() {
                var weight_id = $('.weight_id').val();
                var productPrice = $('.productPrice').val() || 0;
                var thana_id = $('#thana_id').val();
                var merchantId = $("#merchantId").val();
                var district_id = $("#district_id").val();

                if (weight_id && productPrice && thana_id) {
                    console.log(weight_id);
                    $.ajax({
                        method: "GET",
                        url: "{{ route('cost.calculator') }}",
                        data: {
                            'weight_id': weight_id,
                            'productPrice': productPrice,
                            'thana_id': thana_id,
                            'merchantId':merchantId,
                            'district_id':district_id,
                        },
                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            console.log(response);

                            $('.pdeliverycharge').html(response.pdeliverycharge)
                            $('.pcodecharge').html(response.pcodecharge)
                            $('.total_charge').html(response.total_charge)
                            $('.merchant_pay').html(response.pay_to_merchant)
                        } else {
                            alert(response.message);
                            $('.pdeliverycharge').html(0.00)
                            $('.pcodecharge').html(0.00)
                            $('.total_charge').html(0.00)
                            $('.merchant_pay').html(0.00)

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
                console.log("helo");
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

    {{-- <script>
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
    </script> --}}
@endsection
