@extends('backend.layouts.master')
@section('title', 'Dashbaord')
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ __('lang.dashboard') }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('lang.dashboard') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('lang.dashboard') }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                @include('backend.layouts.notifications')
                                <br>
                                <h4 class="fs-16 mb-1">{{ __('lang.Hi') }}, {{ Auth::user()->name }}</h4>
                                <p class="text-muted mb-0">
                                    {{ __('lang.Here is  what is happening with your business today') }}</p>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">{{ __('lang.Parcel Status of Today') }}</h4>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <div class="row">
                    @foreach ($perceltypes as $key => $value)
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            @php
                                $percelCount = App\Models\Parcel::where('status', $value->id)
                                    ->whereDate('updated_at', Carbon\Carbon::today())
                                    ->count();
                                
                            @endphp
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                {{ $value->title }}</p>
                                        </div>
                                        {{-- <div class="flex-shrink-0">
                                            <h5 class="text-success fs-14 mb-0">
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                +16.24 %
                                            </h5>
                                        </div> --}}
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="{{ $percelCount }}">{{ $percelCount }}
                                                </span>
                                                @if ($key == 1 && $today_picked_amount)
                                                    / {{ $today_picked_amount }}৳
                                                @endif
                                                @if ($key == 2 && $today_transit_amount)
                                                    / {{ $today_transit_amount }}৳
                                                @endif
                                            </h4>
                                            <a href="{{ route('percel.manage', $value->slug) }}"
                                                class="link-secondary text-decoration-underline">View
                                                {{ $value->title }}</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span
                                                class="avatar-title @if ($key == 8) bg-soft-danger @endif bg-soft-primary rounded fs-3">
                                                @switch($key)
                                                    @case(0)
                                                        <i class="bx bx-dollar-circle text-primary"></i>
                                                    @break

                                                    @case(1)
                                                        <i class="bx bx-task text-primary"></i>
                                                    @break

                                                    @case(2)
                                                        <i class=" bx bx-transfer text-primary"></i>
                                                    @break

                                                    @case(3)
                                                        <i class="las la-biking text-primary"></i>
                                                    @break

                                                    @case(4)
                                                        <i class="bx bx-pause-circle text-primary"></i>
                                                    @break

                                                    @case(5)
                                                        <i class="bx bx-sync text-primary"></i>
                                                    @break

                                                    @case(6)
                                                        <i class="las la-bezier-curve text-primary"></i>
                                                    @break

                                                    @case(7)
                                                        <i class="las la-reply text-primary"></i>
                                                    @break

                                                    @case(8)
                                                        <i class=" las la-ban text-danger"></i>
                                                    @break

                                                    @case(9)
                                                        <i class="bx bx bx-cycling text-primary"></i>
                                                    @break

                                                    @default
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    @endforeach
                </div> <!-- end row-->

                {{-- charts --}}
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daily Parcel Status</h4>
                            </div>
                            <div class="card-header">
                                {!! $parcel_status->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Parcel Status</h4>
                            </div>
                            <div class="card-header">
                                {!! $total_parcel_status->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <h4>Deliveryman Location</h4>
                        <div id="mymap" class="gmaps"></div>
                    </div>
                    <div class="col-xl-6">

                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                            </div><!-- end card header -->

                            <div class="card-header p-0 border-0 bg-soft-light">
                                <div class="row g-0 text-center">
                                    <div class="col-6 col-sm-4">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">৳ <span class="counter-value"
                                                    data-target="{{ $totalamounts }}">0</span></h5>
                                            <p class="text-muted mb-0">Total Amounts</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-4">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">৳<span class="counter-value"
                                                    data-target="{{ $merchantsdue }}">0</span>
                                            </h5>
                                            <p class="text-muted mb-0">Merchant Due</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-4">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">৳ <span class="counter-value"
                                                    data-target="{{ $merchantspaid }}">0</span></h5>
                                            <p class="text-muted mb-0">Merchant Paid Amount</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                            </div><!-- end card header -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
            </div> <!-- end .h-100-->

        </div> <!-- end col -->

    </div>

@endsection
@section('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.1.2/chart.umd.js"></script>


    <!-- google maps api -->
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCYLaFasHgwDRkehXx8UL9rio6KqOcNC94"></script>

    <script src="https://themesbrand.com/velzon/html/galaxy/assets/libs/gmaps/gmaps.min.js"></script>


    <!-- gmaps init -->
    <script>
        var locations = <?php echo json_encode($d_location); ?>;
        var mymap = new GMaps({
            el: '#mymap',
            lat: 23.8167407,
            lng: 90.4284267,
            zoom: 6
        });

        // console.log(image);

        $.each(locations, function(index, value) {
            var icon = {
                url: "{{ asset('') }}" + value.image, // url
                scaledSize: new google.maps.Size(60, 60), // scaled size
                origin: new google.maps.Point(12, 12), // origin
                anchor: new google.maps.Point(12, 12) // anchor
            };

            mymap.addMarker({
                lat: value.latitude,
                lng: value.longitude,
                title: value.location,
                label: {
                    text: value.name,
                    color: '#ffff',
                    fillColor: '#282828'
                },
                animation: google.maps.Animation.DROP,
                icon: icon,
                click: function(e) {
                    alert('Deliveryman ' + value.name);
                }
            });
        });
    </script>

    {!! $parcel_status->script() !!}
    {!! $total_parcel_status->script() !!}
@endsection
