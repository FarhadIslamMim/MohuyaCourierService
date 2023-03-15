@extends('frontend.layouts.master')
@section('title', 'Percel Details')
@section('custom-styles')
@endsection
@section('main-content')
    <section class="section bg-light">
        <div class="container">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="track-right">
                            <h4>Percel Details</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Percel ID</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->trackingCode }}</h6>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Status</p>
                                </div>
                                <div class="col-lg-6">
                                    @php
                                        $parcelstatus = App\Models\Parceltype::find($parceldetails->status);
                                    @endphp

                                    <h6>{{ $parcelstatus->title }}</h6>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Deliveryman:</p>
                                </div>
                                @php
                                    $riderInfo = App\Models\Deliveryman::find($parceldetails->deliverymanId);
                                @endphp
                                <div class="col-lg-6">
                                    <h6>
                                        @if ($riderInfo)
                                            {{ $riderInfo->name }}
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Customer Name :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->recipientName }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Payment Status :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>
                                        @if ($parceldetails->merchantpayStatus == 1 && ($parceldetails->percelType == 2 && $parceldetails->status == 4))
                                            Paid
                                        @elseif($parceldetails->merchantpayStatus == 1 &&
                                            (($parceldetails->status > 5 && $parceldetails->status < 9) || $parceldetails->percelType == 1))
                                            Service Charge Adjustment
                                        @else
                                            Unknown Process
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Mobile No :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->recipientPhone }}</h6>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Address :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->recipientAddress }}</h6>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> Pickup address :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->pickLocation }}</h6>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> Dvision :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->division }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> District :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->district }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> Thana:</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->thana }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> Area :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->area }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> Delivery Address:</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->delivery_address }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Weight :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6> Upto {{ $parceldetails->productWeight }} kg</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p>Created Date:</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->created_at }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> COD :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->cod }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> Delivery Charge :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->deliveryCharge }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> COD Charge :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->codCharge }}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <p> Last Update :</p>
                                </div>
                                <div class="col-lg-6">
                                    <h6>{{ $parceldetails->updated_at }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('custom-scripts')

@endsection
