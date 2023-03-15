@extends('backend.layouts.master')
@section('title', 'Areas')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Area</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Areas</a></li>
                        <li class="breadcrumb-item active">Areas</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <!-- Areas List -->
            <div class="card">
                <div class="card-header">
                    <div class="text-end">
                        <a href="{{route('area.create')}}" class="btn btn-success">Add new area</a>
                    </div>
                </div>
                <div class="card-body">
                    <h4>All Areas List</h4>
                    @include('backend.layouts.notifications')
                    <div class="table-responsive">
                        <table id="datatable" class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Thana</th>
                                    {{-- <th scope="col">Coverage</th>
                                    <th scope="col">Delivery Type</th>
                                    <th scope="col">Pickup </th> --}}
                                    <th scope="col">District</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(function() {

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('area.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'thana.name',
                        name: 'name'
                    },
                    // {
                    //     data: 'coverage',
                    //     name: 'name'
                    // },
                    // {
                    //     data: 'delivery_type',
                    //     name: 'name'
                    // },
                    // {
                    //     data: 'pickup',
                    //     name: 'pickup'
                    // },
                    {
                        data: 'district.name',
                        name: 'name'
                    },
                    {
                        data: 'division.name',
                        name: 'name'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>

@endsection
