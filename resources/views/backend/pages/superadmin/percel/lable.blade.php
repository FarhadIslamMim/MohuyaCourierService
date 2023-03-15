@extends('backend.layouts.master')
@section('title', 'Generate Label')
@section('custom-styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Label Generate</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel</a></li>
                        <li class="breadcrumb-item active">Label Generate</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel create content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card-header">
                <button class="btn btn-primary printBtn" type="button"><i class="bx bx-printer"></i> Print</button>
                <br>
                <br>
                <br>
            </div>
            <div class="card-body" style="height:288px">
                <div id="printTable" style="width:288px; height:288px; background:#fff; border:1px solid #282828;">
                    <div style="border-bottom:1px solid black">
                        <table>
                            <tr>
                                <td style="width:100px; border-right:1px solid black">
                                    <img style="width:100%; display: block; margin-left: auto; margin-right: auto;" src="{{ asset($setting->logo) }}" alt="{{ $setting->name }}">
                                </td>
                                <td style="width:280px">
                                    <strong style="font-size:14px; padding-left: 2px"> {{ $setting->name ?? '' }}</strong><br>
                                    <span style="font-size: 10px; padding-left: 2px ">Email : {{ $setting->email ?? '' }} </span><br>
                                    <span style="font-size: 10px; padding-left: 2px">Phone : {{ $setting->mobile_no ?? '' }} </span><br>
                                    <strong style="font-size:14px; padding-left: 2px ">Merchant: {{ $show_data->merchant->companyName ?? '' }}</strong><br>
                                    <span style="font-size: 10px; padding-left: 2px ">Phone : 0{{ $show_data->merchant->phoneNumber ?? '' }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style="border-bottom-style:double">
                        <table>
                            <tr>
                                <td style="width:245px; border-right:1px solid black;line-height: 19px;">
                                    <strong style="font-size:11px">CUSTOMER:
                                        {{ $show_data->recipientName ?? '' }}</strong><br>
                                    <span style="font-size:11px">Mob:  {{ $show_data->recipientPhone ?? '' }}</span><br>
                                    <span style="font-size:11px;">Alt. No.  {{ $show_data->alternative_mobile_no ?? '' }} </span><br>
                                    <span style="font-size:11px"> {{ $show_data->recipientAddress ?? '' }}</span>


                                </td>
                                <td style="width:150px">
                                    <strong style="font-size:11px">AREA: {{ $show_data->area->name ?? '' }}</strong><br>
                                    <strong style="font-size:11px">Thana:
                                        {{ $show_data->area->thana->name ?? '' }}</strong><br>
                                    <strong style="font-size:11px">District:
                                        {{ $show_data->district->name ?? '' }}</strong><br>
                                    <strong style="font-size:11px">Division:
                                        {{ $show_data->division->name ?? '' }}</strong><br>


                                </td>
                            </tr>

                        </table>
                    </div>
                    <div style="border-bottom:1px solid black">
                        <table>
                            <tr>
                                <td style="width:288px;">
                                    <strong style="font-size:12px">INVOICE:{{ $show_data->invoiceNo ?? '' }}</strong><br>

                                </td>
                                <td style="width:125px"> <strong style="font-size:12px">&nbsp;
                                        CASH:{{ $show_data->cod ?? '' }}</strong><br>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div>

                        <div style=" padding-top:0px">
                            <table>
                                <tr>
                                    <td style="width:160px; padding-left:5px; margin-right:10px; height:50px ;    padding-bottom: 22px;">
                                        {{-- {!! QrCode::size(80)->backgroundColor(255,90,0)->generate('https://techvblogs.com/blog/generate-qr-code') !!} --}}
                                        {!! QrCode::size(60)->generate(route('home.parcel.tracking') . '?tracking_id=' . $show_data->trackingCode) !!}

                                    </td>
                                    <td style="width:200px;">
                                        {!! '<img width="131px" src="data:image/png;base64,' .
                                            DNS1D::getBarcodePNG("$show_data->trackingCode", 'C128', 1, 40) .
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
    </div>
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
            $('.main-footer').css('display', 'none');
            window.print();
            $(this).css('display', 'inline-block');
            $('.bx').show();

            $('.main-footer').css('display', 'block');
        })
    </script>
@endsection
