@extends('backend.layouts.master')
@section('title', 'Divisions')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Divisions</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Divisions</a></li>
                        <li class="breadcrumb-item active">Divisions</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Divisions Create</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('division.store')}}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="form-group">
                            <!-- Buttons Input -->
                            <div class="input-group">
                                <button class="btn btn-primary" type="submit" id="button-addon1">Add Division</button>
                                <input type="text" name="name" class="form-control" placeholder="Division name">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Divisions List -->
            <div class="card">
                <div class="card-body">
                    <h4>All Division List</h4>
                    <table id="datatable" class="table table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($divisions as $division)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $division->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($division->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- Dropdown Variant -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="mdi mdi-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('division.edit',$division->id)}}"><i class=" bx bx-edit-alt"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="{{route('division.delete',$division->id)}}"><i class=" bx bx-trash"></i>
                                                    Delete</a>
                                            </div>
                                        </div><!-- /btn-group -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function () {
            $("#datatable").DataTable();
        });
    </script>
@endsection
