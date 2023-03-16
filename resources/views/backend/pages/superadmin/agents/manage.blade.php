@extends('backend.layouts.master')
@section('title', 'Agent Manage')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Data Entry Manage</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Data Entry</a></li>
                        <li class="breadcrumb-item active">Data Entry Manage</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Agent Manage content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data Entry Manage</h3>
                </div>
                <div class="card-body">
                    @include('backend.layouts.notifications')
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Mobile No</th>
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
                                        @if ($value->status == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Group Buttons Sizing -->
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            {{-- <a class="btn btn-primary" href="{{ route('agent.show', $value->id) }}"
                                                title="Details"><i class="la la-eye"></i></a> --}}
                                            <a class="btn btn-primary" href="{{ route('agent.edit', $value->id) }}"><i
                                                    class="la la-edit"></i></a>
                                            <a href="{{ route('agent.delete', $value->id) }}"
                                                onclick="return confirm('Are you delete this this?')"
                                                class="btn btn-danger"><i class="la la-trash"></i></a>

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
    <!-- Agent Manage content end -->

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
@endsection
