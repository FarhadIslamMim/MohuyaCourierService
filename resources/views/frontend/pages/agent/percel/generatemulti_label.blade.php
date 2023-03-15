@extends('frontend.layouts.master')
@section('title', 'Percels')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <section class="section bg-light">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <button class="btn btn-primary printBtn" type="button"><i class="bx bx-printer"></i> Print</button>
                        <br>
                        @foreach ($parcelList as $parcel_id)
                            <!--get data from server-->
                            @php
                                $parcel = App\Models\Parcel::where('id', $parcel_id)->first();
                            @endphp
                            <!--get data from server-->


                            <div class="col-sm-6">
                                <div class="card">

                                    <div id="printTable"
                                        style="width:288px; height:288px; background:#fff; border:1px solid #282828;">
                                        <div style="border-bottom:1px solid black">
                                            <table>
                                                <tr>
                                                    <td style="width:70px; border-right:1px solid black"><img
                                                            style="width: 45px;" src="{{ asset($setting->logo) }}"
                                                            alt="{{ $setting->name }}">
                                                    </td>
                                                    <td style="width:280px">
                                                        <strong style="font-size:15px">
                                                            {{ $setting->name ?? '' }}</strong><br>
                                                        <strong style="font-size:12px">
                                                            Merchant:{{ $parcel->merchant->companyName ?? '' }}</strong><br>
                                                        <span style="font-size: 12px">Phone :
                                                            0{{ $parcel->merchant->phoneNumber ?? '' }}
                                                        </span>
                                                        <span style="font-size: 12px">
                                                            Area:&nbsp;{{ $parcel->merchant->area->name ?? '' }}
                                                        </span>, &nbsp;
                                                        <span style="font-size: 12px">
                                                            Thana:&nbsp;{{ $parcel->merchant->thana->name ?? '' }}, </span>
                                                        <span style="font-size: 12px">
                                                            District:&nbsp;{{ $parcel->merchant->district->name ?? '' }}
                                                        </span>&nbsp;

                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div style="border-bottom:1px solid">
                                            <table>
                                                <tr>
                                                    <td
                                                        style="width:245px; border-right:1px solid black;line-height: 15px;">
                                                        <strong style="font-size:11px">CUSTOMER:
                                                            {{ $parcel->recipientName ?? '' }}</strong><br>
                                                        <span style="font-size:11px">
                                                            {{ $parcel->recipientPhone ?? '' }}</span><br>
                                                        <span style="font-size:11px">
                                                            {{ $parcel->recipientAddress ?? '' }}</span><br>
                                                        <span style="font-size:11px;">
                                                            {{ $parcel->alternative_mobile_no ?? '' }} (Alt.
                                                            No.)</span>

                                                    </td>
                                                    <td style="width:150px">
                                                        <strong style="font-size:11px">AREA:
                                                            {{ $parcel->area->name ?? '' }}</strong><br>
                                                        <strong style="font-size:11px">Thana:
                                                            {{ $parcel->area->thana->name ?? '' }}</strong><br>
                                                        <strong style="font-size:11px">Disctrict:
                                                            {{ $parcel->district->name ?? '' }}</strong><br>


                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                        <div style="border-bottom:1px solid black">
                                            <table>
                                                <tr style="line-height: 9px;">
                                                    <td style="width:288px;">
                                                        <strong
                                                            style="font-size:12px">INVOICE:{{ $parcel->invoiceNo ?? '' }}</strong><br>
                                                    </td>
                                                    <td style="width:125px"> <strong style="font-size:12px">&nbsp;
                                                            CASH:{{ $parcel->cod ?? '' }}</strong><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div>

                                            <div style=" padding-top:0px">
                                                <table>
                                                    <tr>
                                                        <td
                                                            style="width:160px; padding-left:5px; margin-right:10px; height:50px ;">
                                                            {{-- {!! QrCode::size(80)->backgroundColor(255,90,0)->generate('https://techvblogs.com/blog/generate-qr-code') !!} --}}
                                                            {!! QrCode::size(75)->generate(route('home.parcel.tracking') . '?tracking_id=' . $parcel->trackingCode) !!}

                                                        </td>
                                                        <td style="width:200px;">
                                                            {!! '<img width="131px" src="data:image/png;base64,' .
                                                                DNS1D::getBarcodePNG("$parcel->trackingCode", 'C128', 1, 40) .
                                                                '" alt="barcode"   />' !!}
                                                            <p>{{ $setting->tracking_prefix }}-{{ date('Y') }}Y{{ date('m') }}MON{{ date('d') }}D
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>


                                        </div>

                                    </div>


                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- percel create content end -->
@endsection

{{-- custom modal --}}
@section('custom-modal')

@endsection
@section('custom-scripts')
    <script>
        $('.printBtn').on('click', function() {
            $(this).css('display', 'none');
            $('.bx').hide();
            $('footer').css('display', 'none');
            $('nav').css('display', 'none');
            window.print();
            $(this).css('display', 'inline-block');
            $('.bx').show();

            $('.main-footer').css('display', 'block');
        })
    </script>
@endsection
