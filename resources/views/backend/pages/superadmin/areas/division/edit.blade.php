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
                    <form action="{{ route('division.update') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="form-group">
                            <!-- Buttons Input -->
                            <input type="text" name="id" hidden value="{{$division->id}}">
                            <div class="input-group">
                                <button class="btn btn-primary" type="submit" id="button-addon1">Update Division</button>
                                <input type="text" name="name" class="form-control" placeholder="Division name" value="{{$division->name}}">
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
