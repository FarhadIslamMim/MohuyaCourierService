@extends('frontend.layouts.master')
@section('title', 'Percels')
@section('custom-styles')
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
                                    <h4>Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <img class="photo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuLGj3eqsqxmOGDp6UuhpF5u4U4yhVavidzY9JynQqrpUwcWcXhWglKvqiOOGboa7sG1k&usqp=CAU" alt="Photo" width="100" height="100"> <br>
                                                    <span class="badge badge-pill badge-primary">ID - {{ $merchantInfo->id }}</span> <br>
                                                    {{ $merchantInfo->firstName }} <br>
                                                    0{{ $merchantInfo->phoneNumber }} <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th width="200"> Company Name</th>
                                                            <td> {{ $merchantInfo->companyName }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Trade License No</th>
                                                            <td> {{ $merchantInfo->trade_licence_no }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Father Name</th>
                                                            <td> {{ $merchantInfo->fathers_name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Mother Name </th>
                                                            <td> {{ $merchantInfo->mothers_name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> NID Number </th>
                                                            <td> {{ $merchantInfo->nidnumber }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Driving license no. </th>
                                                            <td> {{ $merchantInfo->driving_licence_no }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Certificate no. </th>
                                                            <td> {{ $merchantInfo->birth_certificate_no }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> DOB </th>
                                                            <td>
                                                                @if ($merchantInfo->date_of_birth)
                                                                    {{ date('d M Y', strtotime($merchantInfo->date_of_birth)) }}
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Facebook Page </th>
                                                            <td> {{ $merchantInfo->facebook_page }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Website </th>
                                                            <td> {{ $merchantInfo->website }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Division </th>
                                                            <td> {{ $merchantInfo->division->name??'' }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> District </th>
                                                            <td> {{ $merchantInfo->district->name??'' }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Thana </th>
                                                            <td> {{ $merchantInfo->thana->name??'' }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Area</th>
                                                            <td> {{ $merchantInfo->area->name??'' }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Present Address </th>
                                                            <td> {{ $merchantInfo->present_address }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Permanent Address </th>
                                                            <td> {{ $merchantInfo->permanent_address }} </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
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
@endsection
