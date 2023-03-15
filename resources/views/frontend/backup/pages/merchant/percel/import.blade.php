@extends('frontend.layouts.master')
@section('title', 'Percel Import')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}">
@endsection
@section('content')
    <div class="dashboard">
        <aside>
            <div class="container">
                <div class="main-content">
                    <div class="row">
                        {{-- @include('frontend.pages.merchant.layouts.sidebar') --}}
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Bulk Import</h4>
                                </div>
                                <div class="card-body">
                                    @include('frontend.layouts.notifications')
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form">
                                                <form action="{{ route('merchant.percel.import.store') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="csv_file">Select CSV File</label>
                                                        <input type="file" name="bulk_file" accept=".csv"
                                                            class="form-control-file">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" value="Import" class="btn btn-info">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <h5>Instructions</h5>
                                            <p>Please follow the instructions</p>
                                            <ul>
                                                <ol>* <a class="text-green" href="{{ asset('public/sample.csv') }}">Download
                                                        the sample file(.csv)</a>
                                                </ol>
                                                <ol>* Fillup the form with details</ol>
                                                <ol>* Product Price and Weight is double (0.00)</ol>
                                                <ol>* Save and Import</ol>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')

    <script>
        $(document).ready(function() {
            $("#example").DataTable();
        });
    </script>
@endsection
