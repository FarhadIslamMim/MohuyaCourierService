@extends('backend.layouts.master')
@section('title', 'Deliveryman Manage')
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
            background-color: #aba9a9;
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Deliveryman Manage</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Deliveryman</a></li>
                        <li class="breadcrumb-item active">Deliveryman Manage</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Deliveryman Manage content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Deliveryman Manage</h3>
                </div>
                <div class="card-body">
                    @include('backend.layouts.notifications')
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Mobile No</th>
                                <th>Agents</th>
                                <th>Parcel Weight</th>
                                <th>Extra Amount</th>
                                <th>Per parcel amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="reqtablenew">
                                @foreach ($show_datas as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>
                                            @foreach ($value->agents ?? [] as $item)
                                                @foreach ($item->agentDetails as $item2)
                                                   <span class="badge badge-outline-success"> {{$item2->name ?? ""}}</span>
                                                @endforeach
                                            @endforeach
                                        </td>
                                        <td>{{ $value->max_weight ?? 0}} kg</td>
                                        <td>{{ $value->extra_weight_charge ?? 0}} tk</td>
                                        <td>{{ $value->per_parcel_amount ?? 0 }} tk</td>
                                        <td>
                                            @if ($value->status == 1)
                                                Active
                                            @else
                                                @lang('lang.inactive')
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Group Buttons Sizing -->
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="{{ route('deliveryman.show', $value->id) }}" title="Details"><i
                                                        class="la la-eye"></i></a>
                                                <a class="btn btn-primary" href="{{ route('deliveryman.edit', $value->id) }}" title="Edit"><i
                                                        class="la la-edit"></i></a>
                                                <a href="{{ route('deliveryman.delete', $value->id) }}"
                                                    onclick="return confirm('Are you delete this this?')"
                                                    class="btn btn-danger"><i class="la la-trash"></i></a>

                                            </div>

                                        </td>
                                    </tr>
                                @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deliveryman Manage content end -->

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#reqtablenew tr').click(function () {
                $('#reqtablenew tr').removeClass("row_active");
                $(this).addClass("row_active");
            });
        });
    </script>
@endsection
