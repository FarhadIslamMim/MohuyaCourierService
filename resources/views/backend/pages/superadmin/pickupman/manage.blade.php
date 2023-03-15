@extends('backend.layouts.master')
@section('title', 'Pickupman Manage')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Pickupman Manage</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pickupman</a></li>
                        <li class="breadcrumb-item active">Pickupman Manage</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Pickupman Manage content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Pickupman Manage</h3>
                </div>
                <div class="card-body">
                    @include('backend.layouts.notifications')
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Mobile No</th>
                            <th>Agents</th>
                            <th>Per percel amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($show_datas as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>
                                        @foreach ($value->agents ?? [] as $item)
                                            @foreach ($item->agentDetails as $item2)
                                                @if ($item2)
                                                    <span class="badge badge-outline-success">
                                                        {{ $item2->name ?? '' }}</span>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>{{ $value->per_parcel_amount }}</td>
                                    <td>
                                        @if ($value->status == 1)
                                            Active
                                        @else
                                            @lang('common.inactive')
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Group Buttons Sizing -->
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a class="btn btn-primary" href="{{ route('pickupman.show', $value->id) }}"
                                                title="Details"><i class="la la-eye"></i></a>
                                            <a class="btn btn-primary" href="{{ route('pickupman.edit', $value->id) }}"><i
                                                    class="la la-edit"></i></a>
                                            {{-- <a href="{{ route('pickupman.delete', $value->id) }}"
                                                onclick="return confirm('Are you delete this this?')"
                                                class="btn btn-danger"><i class="la la-trash"></i></a> --}}

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
    <!-- Pickupman Manage content end -->

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
@endsection
