@extends('backend.layouts.master')
@section('title', 'Districts')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Districts</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Districts</a></li>
                        <li class="breadcrumb-item active">Districts</li>
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
                    <h4>Districts Create</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('district.store') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="row gy-4">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div>
                                        <label for="division" class="form-label">Select Division</label>
                                        <select name="division_id" class="form-control select2">
                                            @foreach ($divisions as $division)
                                                <option value="{{$division->id}}">{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div>
                                        <label for="name" class="form-label">District Name</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div>
                                        <label for="name" class="form-label">-</label> <br>
                                        <input type="submit" value="New District" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Districts List -->
            <div class="card">
                <div class="card-body">
                    <h4>All Division List</h4>
                    <table id="datatable" class="table table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Division</th>
                                <th scope="col">District Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($districts as $district)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $district->division->name ?? '' }}</td>
                                    <td>{{ $district->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($district->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- Dropdown Variant -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="mdi mdi-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('district.edit', $district->id) }}"><i
                                                        class=" bx bx-edit-alt"></i>
                                                    Edit</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('district.delete', $district->id) }}"><i
                                                        class=" bx bx-trash"></i>
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
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>
@endsection
