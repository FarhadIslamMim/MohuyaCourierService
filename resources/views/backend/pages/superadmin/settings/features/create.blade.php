@extends('backend.layouts.master')
@section('title', 'Features Create')
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
                        <li class="breadcrumb-item active">Features Create</li>
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
            </div>
            <div class="card-body">
                <h4>Create Feature</h4>
                <br>
                @include('backend.layouts.notifications')
                <form action="{{ route('feature.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Feature name">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Sub Title</label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Heading Text">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Feature Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="submit" class="btn btn-success" value="Add Feature">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
