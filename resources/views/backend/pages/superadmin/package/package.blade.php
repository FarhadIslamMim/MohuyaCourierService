@extends('backend.layouts.master')
@section('title', 'Packages')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Packages</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Parcel</a></li>
                        <li class="breadcrumb-item active">Packages</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Package content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Packages</h3>
                    <a href="{{ route('dcp.create') }}" class="btn btn-success">Create New Package</a>
                    <br>
                    <br>
                    @include('backend.layouts.notifications')
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>Delivery Head</th>
                                <th>Assigned Areas</th>
                                <th>Delivery Charge</th>
                                <th>COD Charge</th>
                                <th>Extra Delivery Charge</th>
                                <th>Return Charge</th>
                                <th>Weights Excluded</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($delivery_package as $dp)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dp->package_name }}</td>
                                    <td>{{ $dp->getDeliveryHead->name }}</td>
                                    <td>
                                        @foreach ($dp->getDeliveryAreas as $item)
                                            <span class="badge badge-soft-primary">
                                                {{ $item->getThanas->name ?? '' }}
                                            </span>
                                        @endforeach
                                        @foreach ($dp->getDistricts as $district)
                                            <span class="badge badge-soft-primary">
                                                {{ $district->getDistricts->name ?? '' }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>{{ $dp->delivery_charge }}</td>
                                    <td>{{ $dp->cod_charge }}</td>
                                    <td>{{ $dp->extra_delivery_charge }}</td>
                                    <td>{{ $dp->return_charge }}</td>
                                    <td>
                                        @foreach ($dp->getWeights as $weight)
                                            <span class="badge badge-soft-danger">
                                                {{ $weight->weight_id }} Kg,
                                            </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            {{-- <a href="{{ route('dcp.edit', $dp->id) }}" class="btn btn-success"><i
                                                    class="las la-edit"></i></a> --}}
                                            <a href="{{ route('dcp.delete', $dp->id) }}" class="btn btn-primary"><i
                                                    class="las la-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Package content end -->

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
@endsection
