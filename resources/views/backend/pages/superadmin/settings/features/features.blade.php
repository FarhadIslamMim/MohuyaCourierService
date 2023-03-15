@extends('backend.layouts.master')
@section('title', 'Features')
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
                        <li class="breadcrumb-item active">Features</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Features</h4>
                <a class="btn btn-primary" href="{{ route('feature.create') }}">Create Features</a>
                @include('backend.layouts.notifications')
            </div>
            <div class="card-body">
                <h4>Manage your Features</h4>

                <!-- Striped Rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Sub Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($features as $feature)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $feature->title }}</td>
                                <td>{{ $feature->subtitle }}</td>
                                <td><img width="120px" class="img-fluid" src={{ asset($feature->image) }}></td>
                                <td>
                                    @if ($feature->status == 1)
                                        <span class="badge badge-soft-success">Active</span>
                                    @else
                                        <span class="badge badge-soft-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('feature.edit', $feature->id) }}" class="btn btn-success">Edit</a>
                                        <a href="{{ route('feature.delete', $feature->id) }}"
                                            class="btn btn-primary">Delete</a>
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
