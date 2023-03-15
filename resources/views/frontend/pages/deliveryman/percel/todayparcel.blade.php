@extends('frontend.layouts.master')
@section('title', 'Percels')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}"> --}}
@endsection
@section('main-content')
    <section class="section bg-light mt-5">
        <div class="container-fluid py-2">
            {{-- @include('frontend.pages.deliveryman.layouts.sidebar') --}}
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-edit mrt-30">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <form action="" class="filte-form">
                                        @csrf
                                        <div class="row gy-4">
                                            <h4>Search</h4>

                                            <input type="hidden" value="1" name="filter_id">
{{--                                            <div class="col-sm-2">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="invoiceNo">Invoice No.</label>--}}
{{--                                                    <input type="text" class="form-control" placeholder="Invoice NO"--}}
{{--                                                        name="invoiceNo" value="{{ request()->get('invoiceNo') }}">--}}
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
                                                    <label for="invoiceNo">Start Updated Date</label>

                                                    <input type="date" class="flatDate form-control"
                                                        placeholder="Date from" name="startDate"
                                                        value="{{ request()->get('startDate') }}">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="invoiceNo">End Updated Date</label>

                                                    <input type="date" class="flatDate form-control"
                                                        placeholder="Date to" name="endDate"
                                                        value="{{ request()->get('endDate') }}">
                                                </div>
                                            </div>
                                            <!-- col end -->
                                            <div class="col-sm-2 d-flex align-items-center">
                                                <div class="form-group ">
                                                    <label for="">&nbsp; </label> <br>
                                                    <button type="submit" class="btn signin-button btn-success">Search
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- col end -->
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <br>
                                    <br>
                                    <h3>All Percel List</h3>
                                    <div class="tab-inner table-responsive">
                                        @include('frontend.layouts.notifications')
                                        <table id="example" class="table  table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Invoice No.</th>
                                                    <th>Tracking ID</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th width="100px">Status</th>
                                                    {{-- <th>Rider</th> --}}
                                                    <th>Total</th>
                                                    <th>Collected Amount</th>
                                                    {{-- <th>Charge</th> --}}
                                                    <th>Partial Return</th>
                                                    {{-- <th>Sub Total</th> --}}
                                                    <th>Last Update</th>
                                                    {{-- <th>Payment Status</th> --}}
                                                    <th>Note</th>
                                                    <th>More</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allparcel as $key => $value)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $value->invoiceNo }}</td>
                                                        <td>{{ $value->trackingCode }}</td>
                                                        <td>{{ date('d M Y g:i:s A', strtotime($value->created_at)) }}</td>
                                                        <td width="300px">
                                                            <span><i class="las la-user"></i> Name :
                                                                {{ $value->recipientName }}</span>
                                                            <br>
                                                            <span><i class="las la-phone"></i> Phone :
                                                                {{ $value->recipientPhone }}
                                                                @if ($value->alternative_mobile_no)
                                                                    ,
                                                                    {{ $value->alternative_mobile_no }}
                                                                @endif
                                                            </span>
                                                            <br>
                                                            <span> <i class="las la-location-arrow"></i> Address :
                                                                @if ($value->delivery_address)
                                                                    {{ $value->delivery_address }},
                                                                @endif
                                                                @if ($value->area_id)
                                                                    {{ $value->area }},
                                                                @endif
                                                                @if ($value->thana_id)
                                                                    {{ $value->thana }},
                                                                @endif
                                                                @if ($value->district_id)
                                                                    {{ $value->district }},
                                                                @endif
                                                                @if ($value->division_id)
                                                                    {{ $value->division }}
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $parcelstatus = App\Models\Parceltype::find($value->status);
                                                            @endphp
                                                            {{ $parcelstatus->title }}
                                                            @if ($value->status_description)
                                                                <p class="desc text-start text-primary">[
                                                                    {{ $value->status_description }} ]
                                                                </p>
                                                            @endif

                                                        </td>
                                                        {{-- <td>
                                                                        @php
                                                                            $deliverymanInfo = App\Models\Deliveryman::find($value->deliverymanId);
                                                                        @endphp
                                                                        @if ($value->deliverymanId)
                                                                            {{ $deliverymanInfo->name ?? '' }}
                                                                        @else
                                                                            Not Asign
                                                                        @endif
                                                                    </td> --}}
                                                        <td> {{ $value->cod }}</td>
                                                        <td> {{ $value->collected_amount ?? '0' }}</td>
                                                        {{-- <td> {{ $value->deliveryCharge + $value->codCharge }} --}}
                                                        </td>
                                                        <td> {{ $value->partial_return_amount }}</td>
                                                        {{-- <td> {{ $value->cod - ($value->deliveryCharge + $value->codCharge + $value->partial_return_amount) }} --}}
                                                        </td>
                                                        <td>{{ date('F d, Y', strtotime($value->updated_at)) }}
                                                        </td>
                                                        {{-- <td>
                                                                        @if ($value->merchantpayStatus == 1 && ($value->percelType == 2 && $value->status == 4))
                                                                            Paid
                                                                        @elseif($value->merchantpayStatus == 1 && (($value->status > 5 && $value->status < 9) || $value->percelType == 1))
                                                                            Service charge adjustment
                                                                        @else
                                                                            Unknown process
                                                                        @endif
                                                                    </td> --}}
                                                        <td>
                                                            @php
                                                                $parcelnote = App\Models\Parcelnote::where('parcelId', $value->id)
                                                                    ->orderBy('id', 'DESC')
                                                                    ->first();
                                                            @endphp
                                                            @if (!empty($value->deliveryman_note))
                                                                {{ $value->deliveryman_note }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">

                                                                {{-- <a href="{{ route('merchant.parcel.show', $value->id) }}"
                                                                class="btn btn-sm btn-sm btn-info"><i class="las la-eye"></i></a> --}}
                                                                {{-- @if ($value->status == 1)
                                                                <a href="{{ route('merchant.percel.edit', $value->id) }}"
                                                                    class="btn btn-sm btn-sm btn-primary"><i
                                                                        class="las la-edit"></i></a>
                                                            @endif --}}
                                                                {{-- @if ($value->status >= 2)
                                                                <a class="btn btn-sm btn-sm btn-success" a
                                                                    href="{{ url('merchant/parcel/invoice/' . $value->id) }}"
                                                                    title="Invoice"><i class="las la-list"></i></a>
                                                            @endif --}}
                                                                <button class="btn btn-sm btn-sm btn-info" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#merchantParcel{{ $value->id }}"
                                                                    title="View"><i class="las la-eye"></i></button>
                                                                <div id="merchantParcel{{ $value->id }}"
                                                                    class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Parcel
                                                                                    Details</h5>
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
                                                                                        <td>0{{ $value->phoneNumber }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Merchant Email</td>
                                                                                        <td>{{ $value->emailAddress }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Company</td>
                                                                                        <td>{{ $value->companyName }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Recipient Name</td>
                                                                                        <td>{{ $value->recipientName }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Recipient Address</td>
                                                                                        <td>{{ $value->recipientAddress }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>COD</td>
                                                                                        <td>{{ $value->cod }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    {{-- <tr>
                                                                                    <td>C. Charge</td>
                                                                                    <td>{{ $value->codCharge }}
                                                                                    </td>
                                                                                </tr> --}}
                                                                                    {{-- <tr>
                                                                                    <td>D. Charge</td>
                                                                                    <td>{{ $value->deliveryCharge }}
                                                                                    </td>
                                                                                </tr> --}}
                                                                                    {{-- <tr>
                                                                                    <td>Sub Total</td>
                                                                                    <td>{{ $value->merchantAmount }}
                                                                                    </td>
                                                                                </tr> --}}
                                                                                    <tr>
                                                                                        <td>Total Collected amount</td>
                                                                                        <td>{{ $value->merchantPaid }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    {{-- <tr>
                                                                                    <td>Due</td>
                                                                                    <td>{{ $value->merchantDue }}
                                                                                    </td>
                                                                                </tr> --}}
                                                                                </table>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal end -->
                                                                @if (in_array($value->status, [2, 3, 5, 6, 7]) && $value->merchantPaid == 0)
                                                                    <button class="btn btn-sm btn-danger" title="Action"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#sUpdateModal{{ $value->id }}   ">Action</button>
                                                                @endif
                                                                @if (in_array($value->status, [2, 3, 5, 6, 7]) && $value->merchantPaid == 0)
                                                                    <button class="btn btn-sm btn-success" title="Action"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#partial_payment{{ $value->id }}   ">Partial
                                                                        Return</button>
                                                                @endif
                                                                <!-- Modal -->
                                                                <div id="partial_payment{{ $value->id }}"
                                                                    class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    Partial Return</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form
                                                                                    action="{{ route('deliveryman.partial.return') }}"
                                                                                    method="POST">

                                                                                    @csrf
                                                                                    <input type="hidden" name="parcel_id"
                                                                                        value="{{ $value->id }}">
                                                                                    <div class="form-group">
                                                                                        <label for=""> Partial
                                                                                            Return
                                                                                            Amount</label>
                                                                                        <input type="text"
                                                                                            name="partial_return_amount"
                                                                                            value="0"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for=""> Return Note
                                                                                        </label>
                                                                                        <input type="text"
                                                                                            name="partial_return_note"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="form-group">
                                                                                        <button type="submit"
                                                                                            class="btn btn-success prSubmit">Update</button>
                                                                                    </div>

                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Modal end -->
                                                                <!-- Modal -->
                                                                <div id="sUpdateModal{{ $value->id }}"
                                                                    class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    Status Update</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row gy-4">
                                                                                    <form
                                                                                        action="{{ route('deliveryman.parcel.statusupdate') }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                            name="hidden_id"
                                                                                            value="{{ $value->id }}">
                                                                                        <input type="hidden"
                                                                                            name="customer_phone"
                                                                                            value="{{ $value->recipientPhone }}">
                                                                                        <div class="col-lg-12">
                                                                                            <select name="status"
                                                                                                onchange="parcelDelivery(this)"
                                                                                                class="form-control"
                                                                                                id="delivery_status">
                                                                                                @foreach ($parceltypes->whereNotIn('id', [9,8]) as $key => $ptvalue)
                                                                                                    <option
                                                                                                        value="{{ $ptvalue->id }}"
                                                                                                        @if ($value->status == $ptvalue->id) selected="selected" @endif
                                                                                                        @if ($value->status > $ptvalue->id && in_array($ptvalue->id, [1, 2, 6, 7])) disabled @endif>
                                                                                                        {{ $ptvalue->title }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-lg-12"
                                                                                            id="collected_amount">
                                                                                            <label for="">Collected
                                                                                                Amount</label>
                                                                                            <input name="collected_amount"
                                                                                                type="number"
                                                                                                class="form-control"
                                                                                                value="{{ $value->cod }}">
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                        <div class="col-lg-12">
                                                                                            <label
                                                                                                for="">Note</label>
                                                                                            <textarea name="deliveryman_note" class="form-control" cols="30" placeholder="Note"></textarea>
                                                                                        </div>
                                                                                        <br>
                                                                                        <!-- form group end -->
                                                                                        <div class="col-lg-12">
                                                                                            <button
                                                                                                class="btn btn-sm btn-success">Update</button>
                                                                                        </div>
                                                                                        <!-- form group end -->
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

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
    </section>
@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')

    <script>
        $(document).ready(function() {
            $("#example").DataTable();
        });
    </script>
@endsection
