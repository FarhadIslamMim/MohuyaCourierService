@extends('backend.layouts.master')
@section('title', 'Hub Create')
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
                        <li class="breadcrumb-item active">Hub Create</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Hub</h4>
            </div>
            <div class="card-body">
                <h4>Create Hub</h4>
                <br>
                @include('backend.layouts.notifications')
                <form action="{{ route('hub.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <label for="">Hub Name</label>
                            <input type="text" name="title" class="form-control" placeholder="Feature name">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Address</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Heading Text">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="submit" class="btn btn-success" value="Add Hub">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
