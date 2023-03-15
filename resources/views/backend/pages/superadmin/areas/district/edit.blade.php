@extends('backend.layouts.master')
@section('title', 'Edit District')
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
                    <form action="{{ route('district.update') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="row gy-4">
                            <div class="col-lg-4">
                                <input type="text" hidden name="id" class="form-control"
                                    value="{{ $districts->id }}" id="name">
                                <div class="form-group">
                                    <div>
                                        <label for="division" class="form-label">Select Division</label>
                                        <select name="division_id" class="form-control select2">
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    @if (old('division_id', $districts->division_id) == $division->id) selected @endif>
                                                    {{ $division->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div>
                                        <label for="name" class="form-label">District Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $districts->name }}"
                                            id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div>
                                        <label for="name" class="form-label">-</label>
                                        <br>
                                        <input type="submit" value="Update District" class="btn btn-success" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
