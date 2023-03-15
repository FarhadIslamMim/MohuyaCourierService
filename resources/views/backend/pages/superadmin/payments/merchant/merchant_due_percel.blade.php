@extends('backend.layouts.master')
@section('title', 'Merchant Payment Dues')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Parcel Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel</a></li>
                        <li class="breadcrumb-item active">Parcel Create</li>
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
                <div class="card-body">
                    <h3>Merchants Dues summary</h3>

                    <form action="{{ route('payment.merchant.submit.due') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="paid_form_section col-md-8 my-5">
                                <div class="paid_description">
                                    <p><b>Total Selected Parcel : </b> <span class="total_parcel ml-2">0</span></p>
                                    <p><b>Total Amount: </b> <span class="total_amount ml-2">0</span></p>

                                    <input type="hidden" value="{{ $marchant }}" name="merchantId">
                                    <input type="hidden" value="{{ $marchant }}" name="parcelId">

                                    <input type="submit" class="btn btn-outline-success text-uppercase" name="submit"
                                        value="Paid all selected parcel">
                                </div>
                            </div>
                            <div class="col-md-4 my-5">
                                <div class="details-wrapper">

                                    <h2 class="border-bottom">Payment Method Details</h2>
                                    @if ($minfo->paymentMethod == 1)
                                        <p><b>Bank Name: </b>{{ $minfo->nameOfBank }}</p>
                                        <p><b>Branch Name: </b>{{ $minfo->bankBranch }}</p>
                                        <p><b>AC Holder Name: </b>{{ $minfo->bankAcHolder }}</p>
                                        <p><b>Bank Account No: </b>{{ $minfo->bankAcNo }}</p>
                                    @elseif ($minfo->paymentMethod == 2)
                                        <p><b>Bkash No: </b>{{ $minfo->bkashNumber }}</p>
                                    @elseif ($minfo->paymentMethod == 3)
                                        <p><b>Rocket No: </b>{{ $minfo->roketNumber }}</p>
                                    @elseif ($minfo->paymentMethod == 4)
                                        <p><b>Nagad No: </b>{{ $minfo->nogodNumber }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive pl-3 pr-3">
                            @include('backend.layouts.notifications')
                            <table id="payment" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all" class="form-check-input"></th>
                                        <th>Tracking ID</th>
                                        <th>Customer Info</th>
                                        <th>Parcel Type</th>
                                        <th>Collected Amount</th>
                                        <th>Merchant Pay Amount</th>
                                        <th>COD Charge</th>
                                        <th>Return Charge</th>
                                        <th>Delivery Charge</th>
                                        <th>Status</th>
                                        <th>Delivered Date</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($results as $parcel)
                                        <tr class="ml-1 sparent">
                                            <td><input class="pselect form-check-input" type="checkbox" name="parcel_id[]"
                                                    value="{{ $parcel->id }}"></td>
                                            <td>{{ $parcel->trackingCode }}</td>
                                            <td>
                                                <span><i class="las la-user"></i>{{ $parcel->recipientName }}</span><br>
                                                <span><i class="las la-phone"></i>{{ $parcel->recipientPhone }}
                                                    @if ($parcel->alternative_mobile_no)
                                                        , {{ $parcel->alternative_mobile_no }}
                                                    @endif
                                                </span><br>
                                                <span><i class=" bx bx-location-plus"></i>
                                                    @if ($parcel->delivery_address)
                                                        {{ $parcel->delivery_address }},
                                                    @endif

                                                </span>
                                            </td>
                                            <td>
                                                @if ($parcel->percelType == 1)
                                                    Prepaid
                                                @else
                                                    Cash Collection
                                                @endif
                                            </td>
                                            <td>{{ $parcel->collected_amount }}</td>
                                            <td>
                                                @if ($parcel->collected_amount)
                                                    {{ $parcel->collected_amount - ($parcel->deliveryCharge + $parcel->codCharge) }}
                                                @else
                                                    -{{ $parcel->deliveryCharge + $parcel->return_charge}}
                                                @endif


                                            </td>

                                            <td>{{ $parcel->codCharge }}</td>.
                                            <td>
                                                @if ($parcel->return_charge)
                                                    -{{ $parcel->return_charge }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td>{{ $parcel->deliveryCharge }}</td>
                                            <td>
                                                @if ($parcel->status == 4)
                                                    Delivered
                                                @elseif($parcel->status > 5 && $parcel->status < 9)
                                                    Return
                                                @endif
                                            </td>
                                            <td>
                                                @if ($parcel->delivery_date)
                                                    {!! date('F d, Y', strtotime($parcel->delivery_date)) !!}
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    echo date('F d, Y', strtotime($parcel->created_at));
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->

@endsection
@section('custom-scripts')

    @include('backend.layouts.datatable_scripts');

    <script>
        $(document).ready(function() {
            $('#payment').on('click', '#select-all', function(event) {

                if (this.checked) {
                    // Iterate each checkbox
                    $('#payment :checkbox').each(function() {
                        this.checked = true;
                    });
                    updateAmount();
                } else {
                    $('#payment :checkbox').each(function() {
                        this.checked = false;
                    });
                    updateAmount();
                }
            });


            $('#payment').on('click', '.pselect', function() {
                updateAmount();
            });


            function updateAmount() {
                let totalParcel = 0;
                let totalAmount = 0;
                //get all checkbox input field
                $('#payment .sparent .pselect').each(function() {
                    if (this.checked == true) {

                        totalParcel += 1;

                        let alltr = $(this).closest('tr');

                        let data = alltr.children('td').map(function() {
                            return $(this).text();
                        });

                        let parcelType = data[4].replace('\n', '').trim();
                        let status = data[10].replace('\n', '').trim();


                        if (parcelType == 'Prepaid' || status == 'Return') {
                            totalAmount -= parseInt(data[5]);

                        } else {
                            totalAmount += parseInt(data[5]);
                        }



                    }
                });

                $('.total_parcel').text(totalParcel);
                $('.total_amount').text(totalAmount);

            }
        });
    </script>

@endsection
