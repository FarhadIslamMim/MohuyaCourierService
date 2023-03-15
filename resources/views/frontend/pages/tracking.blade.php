@extends('frontend.layouts.master')
@section('title', 'Tracking')
@section('custom-styles')
    <style>
        .track-left h4,
        .track-right h4 {
            border-bottom: 8px solid #8F0D0D;
            display: inline-block;
            padding-bottom: 10px;
        }

        .tracking-step-left {
            width: 25%;
            float: left;
            border-right: 3px solid #ddd;
            position: relative;
            padding-bottom: 15px;
        }

        .tracking-step-left::after {
            position: absolute;
            top: 50%;
            right: -15px;
            height: 30px;
            width: 30px;
            background: #f5ab35;
            border-radius: 50%;
            font-family: "Font Awesome 5 Free";
            content: "0";
            text-align: center;
            color: #fff;
            line-height: 30px;
            transform: translateY(-37px);
        }

        .tracking-step-right {
            width: 70%;
            float: right;
        }

        .tracking-step {
            overflow: hidden;
        }
    </style>
@endsection
@section('main-content')
    <section class="section">
        <article>
            <!-- Breadcrumb -->
            <section class="theme-breadcrumb pad-50 bg-info py-4">
                <div class="container ">
                    <div class="row">
                        <div class="col-sm-8 pull-left">
                            <div class="title-wrap py-4">
                                <h2 class="section-title_2 no-margin"> Parcel tracking </h2>
                                <p class="fs-16 no-margin"> Track your parcel & see the current condition </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.Breadcrumb -->

            <!-- Tracking -->
            <section class="py-5 pb-120 tracking-wrap">
                <div class="container ">
                    <div class="row pad-10">
                        <div class="col-md-8 col-md-offset-2 tracking-form wow fadeInUp" data-wow-offset="50"
                            data-wow-delay=".30s">
                            <h4> Track your percel </h4> <span class="font2-light fs-12">Now you can track your
                                percel easily</span>
                            <form class="" method="GET" action="">
                                <div class="row">
                                    <div class="col-md-7 col-sm-7">
                                        <div class="form-group">
                                            <input type="text" name="tracking_id" placeholder="Enter your tracking ID"
                                                required="" class="form-control box-shadow">
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <button class="btn btn-success">Track your parcel</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row gy-2">
                        <div class="col-md-7 pad-30 ">
                            <br>
                            <br>
                            @foreach ($trackInfos as $trackInfo)
                                <div class="tracking-step">
                                    <div class="tracking-step-left">
                                        <strong>{{ date('h:i A', strtotime($trackInfo->created_at)) }}</strong>
                                        <p>{{ date('M d, Y', strtotime($trackInfo->created_at)) }}</p>
                                    </div>
                                    <div class="tracking-step-right">
                                        <p>{{ $trackInfo->note }}</p>
                                        <p>{{ $trackInfo->remark }}</p>
                                        <p class="track_dec">{{ $trackInfo->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-5 pad-30 wow fadeInRight" data-wow-offset="50" data-wow-delay=".30s">
                            <div class="prod-info white-clr">
                                <ul>
                                    <li> <span class="title-2">Tracking id:</span> <span class="fs-16">
                                            {{ $tracking_data->trackingCode ?? 'Your tracking code' }}
                                        </span> </li>
                                    <li> <span class="title-2">Customer Name:</span> <span class="fs-16">
                                            {{ $tracking_data->recipientName ?? 'Customer name' }}
                                        </span> </li>
                                    <li> <span class="title-2">Address:</span> <span
                                            class="fs-16">{{ $tracking_data->delivery_address ?? 'Address' }}</span></li>
                                    <li> <span class="title-2">Create date:</span> <span
                                            class="fs-16">{{ $tracking_data->created_at ?? 'Created Date' }}</span></li>
                                    <li> <span class="title-2">order status:</span> <span class="fs-16 theme-clr">
                                            @if ($tracking_data)
                                                @if ($tracking_data->status == 1)
                                                    Pending
                                                @elseif ($tracking_data->status == 2)
                                                    Picked
                                                @elseif ($tracking_data->status == 3)
                                                    In Transit
                                                @elseif ($tracking_data->status == 4)
                                                    Delivered
                                                @else
                                                    Status
                                                @endif
                                            @else
                                                Status
                                            @endif

                                        </span> </li>
                                    @php
                                        if ($tracking_data) {
                                            $deliverymanInfo = App\Models\Deliveryman::find($tracking_data->deliverymanId);
                                        }
                                    @endphp
                                    <li> <span class="title-2">Deliveryman:</span> <span
                                            class="fs-16">{{ $deliverymanInfo->name ?? 'Rider name' }}</span> </li>
                                    <li> <span class="title-2">Phone:</span> <span
                                            class="fs-16">{{ $deliverymanInfo->phone ?? 'Rider Phone' }}</span> </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- /.Tracking -->

        </article>
    </section>
@endsection
@section('custom-scripts')

@endsection
