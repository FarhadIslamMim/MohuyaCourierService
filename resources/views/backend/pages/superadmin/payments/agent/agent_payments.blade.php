@extends('backend.layouts.master')
@section('title', 'Agent Payment Summary')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Agent Payment Summary</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Payments</a></li>
                        <li class="breadcrumb-item active">Agent Payment Summary</li>
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
                    <div class="row ">
                        <div class="col-lg-10">
                            <h3>Agent Payment Summary</h3>
                            <p class="text-success">Here is the list of the Agent whom need to pay</p>
                        </div>
                    </div>
                    <br>
                    <br>

                    <div class="table-responsive">
                        <form action="{{ route('payment.agent.done') }}" method="POST">
                            @csrf
                            @include('backend.layouts.notifications')
                            <div class="row">
                                @if ($type != 'paid')
                                    <div class="paid_form_section col-md-8 my-5">
                                        <div class="paid_description">
                                            <p><b>Total select percel : </b> <span class="total_parcel ml-2">0</span></p>
                                            <p><b>Total Amount : </b> <span class="total_amount ml-2">0</span></p>

                                            <input type="hidden" value="{{ $agent->id ?? '' }}" name="agentId">
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                onclick="return confirm('Do you want to paid all selected parcel?')">
                                                Parcel Paid </button>
                                            {{-- <input type="submit" class="btn btn-outline-success text-uppercase" name="submit" value="Paid all selected parcel"> --}}
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-4 my-5">
                                    <div class="details-wrapper">

                                        <h2 class="border-bottom">Payment method details</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive pl-3 pr-3">
                                @if (count($TrackingDatas) > 0)
                                    <table id="payment" class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th>Tracking ID</th>
                                                <th>Customer Details</th>
                                                <th>Merchant</th>
                                                <th class="text-right">Total Collection</th>
                                                <th class="text-right">Agent Total</th>
                                                <th class="text-right">Paid</th>
                                                <th class="text-right"> due </th>
                                                <th>Status</th>
                                                <th>Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($agent_parcels as $parcel)
                                                <tr class="ml-1 sparent">
                                                    <td>
                                                        @if ($parcel->agent_due > 0)
                                                            <input class="pselect" type="checkbox" name="parcel_id[]"
                                                                value="{{ $parcel->id }}">
                                                        @endif

                                                    </td>
                                                    <td>{{ $parcel->trackingCode }}</td>
                                                    <td>{{ $parcel->recipientName }}
                                                        <br>
                                                        @php
                                                            echo substr($parcel->recipientAddress, 0);
                                                        @endphp
                                                        <br>
                                                    </td>
                                                    <td>
                                                        {{ $parcel->merchant->companyName }}
                                                        <br>
                                                        0{{ $parcel->merchant->phoneNumber }}
                                                    </td>
                                                    <td class="text-right">{{ $parcel->cod }}</td>
                                                    <td class="text-right">{{ $parcel->agent_amount }}</td>
                                                    <td class="text-right">
                                                        {{ $parcel->agent_paid }}
                                                    </td>
                                                    <td class="text-right">{{ $parcel->agent_due }}</td>
                                                    <td>
                                                        {{ $parcel->parcelStatus->title ?? '' }}
                                                    </td>
                                                    <td>
                                                        @if ($parcel->agent_paid > 0)
                                                            <a href="{{ url('superadmin/agent-payment-invoice/' . $parcel->id) }}"
                                                                target="_blank" class="btn btn-sm btn-info">
                                                                Invoice
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="ml-1 sparent">
                                                <th class="text-right" colspan="4">Total</th>
                                                <th class="text-right">{{ $agent_parcels->sum('cod') }}</th>
                                                <th class="text-right">{{ $agent_parcels->sum('agent_amount') }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $agent_parcels->sum('agent_paid') }}
                                                </th>
                                                <th class="text-right">{{ $agent_parcels->sum('agent_due') }}</th>
                                                <th> </th>
                                                <th> </th>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <br>
                                    {{-- {{ $agent_parcels->links() }} --}}
                                @endif
                                @if (count($agent_parcels) > 0)
                                    <table id="payment" class="table table-striped datatable">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th>Tracking ID</th>
                                                <th>Customer Details</th>
                                                <th>Merchant</th>
                                                <th class="text-right">Total Collection</th>
                                                <th class="text-right">agent Total</th>
                                                <th class="text-right">Paid</th>
                                                <th class="text-right"> due </th>
                                                <th>Status</th>
                                                <th>Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($agent_parcels as $parcel)
                                                <tr class="ml-1 sparent">
                                                    <td>
                                                        @if ($parcel->agent_due > 0)
                                                            <input class="pselect" type="checkbox" name="parcel_id[]"
                                                                value="{{ $parcel->id }}">
                                                        @endif

                                                    </td>
                                                    <td>{{ $parcel->trackingCode }}</td>
                                                    <td>{{ $parcel->recipientName }}
                                                        <br>
                                                        @php
                                                            echo substr($parcel->recipientAddress, 0);
                                                        @endphp
                                                        <br>
                                                    </td>
                                                    <td>
                                                        {{ $parcel->merchant->companyName ?? '' }}
                                                        <br>
                                                        0{{ $parcel->merchant->phoneNumber ?? '' }}
                                                    </td>
                                                    <td class="text-right">{{ $parcel->cod }}</td>
                                                    <td class="text-right">{{ $parcel->agent_amount }}</td>
                                                    <td class="text-right">
                                                        {{ $parcel->agent_paid }}
                                                    </td>
                                                    <td class="text-right">{{ $parcel->agent_due }}</td>
                                                    <td>
                                                        {{ $parcel->parcelStatus->title ?? '' }}
                                                    </td>
                                                    <td>
                                                        @if ($parcel->agent_paid > 0)
                                                            <a href="{{ route('agent_payment_invoice', $parcel->id) }}"
                                                                target="_blank" class="btn btn-sm btn-info">
                                                                Invoice
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="ml-1 sparent">
                                                <th class="text-right" colspan="4">Total</th>
                                                <th class="text-right">{{ $agent_parcels->sum('cod') }}</th>
                                                <th class="text-right">{{ $agent_parcels->sum('agent_amount') }}
                                                </th>
                                                <th class="text-right">
                                                    {{ $agent_parcels->sum('agent_paid') }}
                                                </th>
                                                <th class="text-right">{{ $agent_parcels->sum('agent_due') }}</th>
                                                <th> </th>
                                                <th> </th>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <br>
                                    {{-- {{ $agent_parcels->links() }} --}}
                                @endif
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- percel create content end -->

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $(".datatable").DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            // $('#payment').DataTable({
            //     "paging": true,
            //     "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            // });


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

                        totalAmount += parseFloat(data[5]);

                    }
                });

                $('.total_parcel').text(totalParcel);
                $('.total_amount').text(totalAmount);

            }
        });
    </script>
@endsection
