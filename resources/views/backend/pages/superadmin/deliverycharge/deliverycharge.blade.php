@extends('backend.layouts.master')
@section('title', 'Delivery Charge')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Delivery Charge</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Delivery Charge</a></li>
                        <li class="breadcrumb-item active">Manage</li>
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
                    <div class="">
                        <h3>Delivery Charge Manage</h3>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('dc.create') }}" class="btn btn-success">Delivery Charge Create</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('backend.layouts.notifications')
                    <table id="example1" class="table table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Delivery Charge Head</th>
                                <th>Delivery Charge</th>
                                <th>Extra Delivery Charge</th>
                                <th>COD (%) </th>
                                <th>Return Chage (%) </th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($show_data as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $value->deliveryChargeHead->name ?? '' }}
                                        ({{ $value->deliveryChargeHead->service_time ?? '' }})
                                    </td>
                                    <td>{{ $value->deliverycharge }}</td>
                                    <td>{{ $value->extradeliverycharge }}</td>
                                    <td>{{ $value->cod_charge }} % </td>
                                    <td>{{ $value->return_charge ?? 0 }} % </td>
                                    <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success btn-sm" href="{{ route('dc.edit', $value->id) }}"
                                                title="Edit"><i class="las la-edit"></i></a>
                                            <a class="btn btn-info btn-sm"
                                                onclick="return confirm('Are you delete this this?')"
                                                href="{{ route('dc.delete', $value->id) }}" title="Delete"><i
                                                    class="las la-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tfoot>
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
