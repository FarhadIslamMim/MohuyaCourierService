@extends('backend.layouts.master')
@section('title', 'Hubs')
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Settings</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a>
                        </li>
                        <li class="breadcrumb-item active">Hubs</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Hubs</h4>
                <a class="btn btn-primary" href="{{ route('hub.create') }}">Create Hubs</a>
                @include('backend.layouts.notifications')
            </div>
            <div class="card-body">
                <h4>Manage your Hubs</h4>

                <!-- Striped Rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Adress</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hubs as $hub)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $hub->title }}</td>
                                <td>{{ $hub->subtitle }}</td>
                                <td>
                                    @if ($hub->status == 1)
                                        <span class="badge badge-soft-success">Active</span>
                                    @else
                                        <span class="badge badge-soft-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('hub.edit', $hub->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('hub.delete', $hub->id) }}" class="btn btn-primary">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
