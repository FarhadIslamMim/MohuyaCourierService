@extends('backend.layouts.master')
@section('title', 'Update Feature')
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
                        <li class="breadcrumb-item active">Feature Edit</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4>Edit Feature</h4>
                <br>
                @include('backend.layouts.notifications')
                <form action="{{ route('feature.update') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="text" value="{{$feature->id}}" name="id" hidden>
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <label for="">Feature Title</label>
                            <input type="text" name="title" value="{{ $feature->title }}" class="form-control"
                                placeholder="Feature Title">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Sub Title</label>
                            <input type="text" name="subtitle" value="{{ $feature->subtitle }}"
                                class="form-control" placeholder="Subtitle">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Feature Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" @if ($feature->status === 1) @selected(true) @endif>Active
                                </option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input type="submit" class="btn btn-success" value="Update feature">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
