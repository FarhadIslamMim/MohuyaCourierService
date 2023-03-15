@extends('backend.layouts.master')
@section('title', 'Import Areas')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Area</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Area</a></li>
                        <li class="breadcrumb-item active">Import Areas</li>
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
                    <h3>Import Areas</h3>
                </div>
                <div class="card-body">
                    <div class="row gy-4">
                        <div class="col-lg-5">
                            <p>Please fillup the form with correct data. </p>
                            @include('backend.layouts.notifications')
                            <div class="form">
                                <form method="post" action="{{ route('area.import.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="select_delivery_charge_head">Delivery Charge Head</label>
                                       <select class="form-control" name="delivery_charge_head">
                                            <option value="">Select Head</option>
                                            @foreach ($delivery_charge_heads as $dch)
                                                <option value="{{ $dch->id }}">{{ $dch->name }}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Select CVS *</label>
                                        <input class="form-control" name="areas_csv" type="file" id="formFile">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <input type="submit" value="Import" class="btn btn-info">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <h4>Instructions</h4>
                            <p>Please follow the instructions before uploading the file</p>
                            <ul class="list-group">
                                <li class="list-group-item"> <i class="ri-checkbox-line"></i> <a
                                        href="{{ asset('public/areas_sample.csv') }}">Download the sample file</a></li>
                                <li class="list-group-item"><i class="ri-checkbox-line"></i> Fillup the form with correct
                                    sequence of Division->Disctrict->Thana-Area</li>
                                <li class="list-group-item"><i class="ri-checkbox-line"></i> Don't use any special
                                    characters (!@#$%^&*()_) in any of the names</li>
                                <li class="list-group-item"><i class="ri-checkbox-line"></i> If you face any error it might
                                    be because of your incorrect division,
                                    district, thana or areas mis-spelling</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')

@endsection
