@extends('backend.layouts.master')
@section('title', 'Create Slider')
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
                        <li class="breadcrumb-item active">Slider Create</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Sliders</h4>
            </div>
            <div class="card-body">
                <h4>Create slider</h4>
                <br>
                @include('backend.layouts.notifications')
                <form action="{{ route('slider.store') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <label for="">Slider Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Slider name">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Heading Text</label>
                            <input type="text" name="heading_text" class="form-control" placeholder="Heading Text">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Secondary Text</label>
                            <input type="text" name="secondary_text" class="form-control" placeholder="Heading Text">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Slider Image</label>
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
                            <input type="submit" class="btn btn-success" value="Add Slider">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
