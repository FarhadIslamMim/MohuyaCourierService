@extends('backend.layouts.master')
@section('title', 'SMS')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">SMS</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">SMS</a>
                        </li>
                        <li class="breadcrumb-item active">Manage</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>SMS</h4>
                <div class="alert">
                    <p>Your current SMS Blance is <span class="badge badge-label bg-success">{{ $tempBalance }}</span> </p>
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-lg-4">
                        @include('backend.layouts.notifications')
                        <form action="{{ route('sms.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number (Start number with 01)</label>
                                <input type="text" class="form-control" placeholder="0100000000" name="phonenumber">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="sms">Your message</label>
                                <textarea name="sms" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="bx bx-message-rounded-detail"> Send</i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-8">
                        <h4>Manage your SMS</h4>

                        <!-- Striped Rows -->
                        <table id="datatable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">SMS ID</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">SMS</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sms_message as $sms)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>SC-00{{ $sms->id }}</td>
                                        <td>0{{ $sms->number }}</td>
                                        <td> {{ substr($sms->sms, 0, 35) }} @if (strlen($sms->sms) > 35)
                                                ....<button sms_data="{{ $sms->sms }}"
                                                    class="btn btn-sm rounded-pill btn-light readbtn ">
                                                    Read Full</button>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="{{ $sms->status == 1 ? 'badge rounded-pill text-bg-success' : 'badge rounded-pill text-bg-danger' }}">
                                                {{ $sms->status == 1 ? 'Sent' : 'Not Send' }}
                                            </span>

                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('sms.resend', $sms->id) }}"><i class="bx bx-sync"></i>
                                                    Resend</a>
                                                <a href="{{ route('sms.delete', $sms->id) }}" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are You Sure ?')"><i class="bx bx-trash"></i>
                                                    Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
