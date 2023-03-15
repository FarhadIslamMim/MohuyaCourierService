@extends('frontend.layouts.master')
@section('title', 'Pending Parcel')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        #reqtablenew > tr:hover{
            /*background-color: #abcaab;*/
        }
        .row_active{
            background-color: #d1c9c9;
        }
    </style>
@endsection
@section('main-content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-edit mt-5">
                            <div class="row">
                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form action="" class="filte-form">
                                        @csrf
                                        <div class="row gy-4">
                                            <h4>Search </h4>
                                            <input type="hidden" value="1" name="filter_id">
{{--                                            <div class="col-sm-2">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="invoiceNo">Invoice No.</label>--}}
{{--                                                    <input type="text" class="form-control" placeholder="Invoice NO"--}}
{{--                                                           name="invoiceNo" value="{{ request()->get('invoiceNo') }}">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">Tracking ID</label>

                                                    <input type="text" class="form-control" placeholder="Track ID"
                                                           name="trackId" value="{{ request()->get('trackId') }}">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">Mobile No</label>

                                                    <input type="number" class="form-control" placeholder="Mobile No"
                                                           name="phoneNumber" value="{{ request()->get('phoneNumber') }}">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">Start Date</label>

                                                    <input type="date" class="flatDate form-control"
                                                           placeholder="Date from" name="startDate"
                                                           value="{{ request()->get('startDate') }}">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">End Date</label>

                                                    <input type="date" class="flatDate form-control"
                                                           placeholder="Date to" name="endDate"
                                                           value="{{ request()->get('endDate') }}">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="">&nbsp; </label> <br>
                                                    <button type="submit"
                                                            class="btn btn-block signin_button btn-success">Search
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- col end -->
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <br>
                                    <h3>All Parcel List</h3>
                                    <div class="tab-inner table-responsive">
                                        @include('frontend.layouts.notifications')
                                        <table id="example" class="table table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('lang.sl') }}</th>
                                                    <th>{{ __('lang.track_id') }}</th>
                                                    <th>{{ __('lang.date') }}</th>
                                                    <th>{{ __('lang.company_name') }}</th>
                                                    <th>Customer Details </th>
                                                    <th width="150">Customer Address </th>
                                                    <th>{{ __('lang.status') }}</th>
                                                    <th>{{ __('lang.total') }}</th>
                                                    {{-- <th>{{ __('lang.charge') }}</th>
                                                    <th>{{ __('lang.sub_total') }}</th> --}}
                                                    <th>Last Update</th>
                                                    <th>{{ __('lang.note') }}</th>
                                                    <th>{{ __('lang.more') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="reqtablenew">

                                                @foreach ($allparcel as $key => $value)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $value->trackingCode }}</td>
                                                        <td>

                                                            {{ date('d M Y g:i:s a', strtotime($value->created_at)) }}
                                                        </td>
                                                        <td>{{ $value->companyName }}</td>
                                                        <td> {{$value->recipientName?? '' }} {{ $value->recipientPhone ?? '' }} </td>
                                                        <td>
                                                            @if ($value->delivery_address)
                                                                {{ $value->delivery_address . ',' }}
                                                            @endif
                                                            @if ($value->area)
                                                                {{ $value->area . ',' }}
                                                            @endif
                                                            @if ($value->thana)
                                                                {{ $value->thana . ',' }}
                                                            @endif
                                                            @if ($value->district)
                                                                {{ $value->district . ',' }}
                                                            @endif
                                                            @if ($value->division)
                                                                {{ $value->division . '.' }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $parcelstatus = App\Models\Parceltype::find($value->status);
                                                            @endphp
                                                            {{ $parcelstatus->title }}
                                                        </td>
                                                        <td> {{ $value->cod }}</td>
                                                        {{-- <td> {{ $value->deliveryCharge + $value->codCharge }}</td>
                                                        <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge) }} --}}
                                                        </td>
                                                        <td>{{ date('F d, Y', strtotime($value->updated_at)) }}</td>
                                                        <td>
                                                            {{$value->note}}
{{--                                                            @php--}}
{{--                                                                $parcelnote = \App\Models\Parcelnote::where('parcelId', $value->id)--}}
{{--                                                                    ->orderBy('id', 'DESC')--}}
{{--                                                                    ->first();--}}
{{--                                                            @endphp--}}
{{--                                                            @if (!empty($parcelnote))--}}
{{--                                                                {{ $parcelnote->note }}--}}
{{--                                                            @endif--}}
                                                        </td>
                                                        <td>
                                                            <!--<button class="btn btn-info" href="#"  data-bs-toggle="modal" data-bs-target="#merchantParcel{{ $value->id }}" title="View"><i class="fa fa-eye"></i></button>-->
                                                            <div id="merchantParcel{{ $value->id }}" class="modal fade"
                                                                role="dialog">
                                                                <div class="modal-dialog">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Parcel Details</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <table class="table table-bordered">
                                                                                <tr>
                                                                                    <td>Merchant Name</td>
                                                                                    <td>{{ $value->firstName }}
                                                                                        {{ $value->lastName }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Merchant Phone</td>
                                                                                    <td>{{ $value->phoneNumber }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Merchant Email</td>
                                                                                    <td>{{ $value->emailAddress }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Company</td>
                                                                                    <td>{{ $value->companyName }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Recipient Name</td>
                                                                                    <td>{{ $value->recipientName }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Recipient Address</td>
                                                                                    <td>{{ $value->recipientAddress }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>COD</td>
                                                                                    <td>{{ $value->cod }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>C. Charge</td>
                                                                                    <td>{{ $value->codCharge }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>D. Charge</td>
                                                                                    <td>{{ $value->deliveryCharge }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Sub Total</td>
                                                                                    <td>{{ $value->merchantAmount }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Paid</td>
                                                                                    <td>{{ $value->merchantPaid }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Due</td>
                                                                                    <td>{{ $value->merchantDue }}</td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal end -->
                                                            <a href="javascript:void(0)" class="btn btn-info" title="Action"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#sUpdateModal{{ $value->id }}">
                                                                {{ __('lang.assign_me') }}
                                                        </a>

                                                            <!-- Modal -->
                                                            <div id="sUpdateModal{{ $value->id }}" class="modal fade"
                                                                role="dialog">
                                                                <div class="modal-dialog">
                                                                    <!-- Modal content-->
                                                                    <form action="{{ route('deliveryman.assignme') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ __('lang.deliveryman_assign') }}
                                                                                </h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <input type="hidden" name="hidden_id"
                                                                                    value="{{ $value->id }}">
                                                                                <input type="hidden" name="deliverymanId"
                                                                                    value="{{ session()->get('deliverymanId') }}">
                                                                                {{-- <input type="hidden" name="merchant_phone" value="{{ $merchant->phoneNumber }}"> --}}

                                                                                <!-- form group end -->
                                                                                <div class="form-group mrt-15">
                                                                                    <textarea name="note" class="form-control" cols="30" placeholder="{{ __('lang.note') }}"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger pull-left"
                                                                                    data-bs-dismiss="modal">{{ __('lang.close') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-success pull-right">
                                                                                    {{ __('lang.assign_me') }} </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- Modal end -->


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- row end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function () {
            $('#reqtablenew tr').click(function () {
                $('#reqtablenew tr').removeClass("row_active");
                $(this).addClass("row_active");
            });
        });
    </script>


    <script>
        $('#select-all').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $(document).ready(function() {
            $("#example").DataTable();

            let form = $('.parcelForm');
            let assignme = $('.assignme');
            assignme.on('click', function() {
                let url = '{{ route('pickupman.assignme') }}';
                form.attr('action', url);
                form.submit();
            });
        });
    </script>
@endsection
