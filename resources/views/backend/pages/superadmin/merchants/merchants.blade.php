@extends('backend.layouts.master')
@section('title', 'Merchant Manage')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Merchant Manage</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Merchant</a></li>
                        <li class="breadcrumb-item active">Merchant Manage</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Merchant Manage content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Merchant Manage</h3>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Mobile No</th>
                                <th>Email Address</th>
                                <th>Commission</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($merchants as $key => $value)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->firstName }} {{ $value->lastName }}</td>
                                    <td>{{ $value->companyName }}</td>
                                    <td>0{{ $value->phoneNumber }}</td>
                                    <td>{{ $value->emailAddress }}</td>
                                    <td>{{ number_format($value->del_commission) }} % </td>
                                    <td class="text-nowrap">
                                        @if($value->bkashNumber)
                                        <b>Bkash:</b> 0{{ $value->bkashNumber }}
                                        @elseif($value->nogodNumber)
                                        <b>Nagad:</b> 0{{ $value->nogodNumber }}
                                        @elseif($value->nameOfBank)
                                        <b>Bank Info :</b><br>
                                        <b>Bank Name:</b> {{ $value->nameOfBank}}<br>
                                        <b>Branch Name:</b> {{ $value->bankBranch}}<br>
                                        <b>Account Name:</b> {{ $value->bankAcHolder}}<br>
                                        <b>AC Number:</b>{{ $value->bankAcNo}}<br>
                                        @else
                                            Cash
                                        @endif
                                    </td>
                                    <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <ul class="action_buttons dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown">Actions
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                {{-- <li>
                                                    @if ($value->status == 1)
                                                        <form action="{{ url('editor/merchant/inactive') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="hidden_id"
                                                                value="{{ $value->id }}">
                                                            <button type="submit" class="dropdown-item thumbs_up" title="unpublished"><i
                                                                    class="la la-thumbs-up"> </i>
                                                                Inactive</button>
                                                        </form>
                                                    @else
                                                        <form action="{{ url('editor/merchant/active') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="hidden_id"
                                                                value="{{ $value->id }}">
                                                            <button type="submit" class=" dropdown-item  thumbs_down" title="published"><i
                                                                    class="la la-thumbs-down"> </i>
                                                                Active</button>
                                                        </form>
                                                    @endif
                                                </li> --}}
                                                <li>
                                                    <a class="dropdown-item thumbs_up"
                                                        href="{{ route('merchant.edit',$value->id) }}"
                                                        title="Edit"><i class="la la-edit"> </i> Edit</a>
                                                </li>
                                                {{-- <li>
                                                    <a class="dropdown-item edit_icon"
                                                        href="{{ url('editor/merchant/view/' . $value->id) }}"
                                                        title="View"><i class="la la-eye"></i> View</a>
                                                </li> --}}
{{--                                                <li>--}}
{{--                                                    <a class="dropdown-item edit_icon"--}}
{{--                                                        href="{{ route('payment.merchant.invoice.export',$value->id) }}"--}}
{{--                                                        title="View"><i class="la la-list"></i> Payments</a>--}}
{{--                                                </li>--}}
                                                <li>
                                                    <a class="dropdown-item edit_icon"
                                                        href="{{ url('superadmin/report/merchant?merchant_id='. $value->id) }}"
                                                        title="View"><i class="la la-list"></i> Reports</a>
                                                </li>
                                            </ul>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Merchant Manage content end -->

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
@endsection
