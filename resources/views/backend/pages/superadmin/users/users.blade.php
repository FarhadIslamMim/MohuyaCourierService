@extends('backend.layouts.master')
@section('title', 'Users Management')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users Management</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped custom-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($show_datas as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('user_edit')
                                            @if ($value->status == 1)
                                                <form action="{{ url('superadmin/user/inactive') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                                                    <button type="submit" class="btn btn-primary" title="unpublished"><i
                                                            class="la la-thumbs-up"></i></button>
                                                </form>
                                            @else
                                                <form action="{{ url('superadmin/user/active') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                                                    <button type="submit" class="btn btn-success" title="published"><i
                                                            class="la la-thumbs-down"></i></button>
                                                </form>
                                            @endif

                                            <a class="btn btn-info" href="{{ route('users.edit',$value->id) }}"
                                                title="Edit"><i class="la la-edit"></i></a>
                                            </li>
                                        @endcan
                                        @can('user_delete')
                                            <form action="{{ url('superadmin/user/delete') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="hidden_id" value="{{ $value->id }}">
                                                <button type="submit" onclick="return confirm('Are you delete this this?')"
                                                    class="btn btn-danger" title="Delete"><i
                                                        class="la la-trash"></i></button>
                                            </form>
                                        @endcan
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
@endsection
@section('custom-scripts')

@endsection
