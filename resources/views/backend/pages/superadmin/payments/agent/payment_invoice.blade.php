@extends('backend.layouts.master')
@section('title', 'Invoices')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/@simonwep/pickr/themes/monolith.min.css') }}" />
    <!-- 'monolith' theme -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        #reqtablenew > tr:hover{
            /*background-color: #abcaab;*/
        }
        .row_active{
            background-color: #aba9a9;
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Agent Invoice</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Agent</a></li>
                        <li class="breadcrumb-item active">Agent Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- percel create content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Agent Payment Invoice</h4>
                </div>
                <div class="card-body">
                    <!-- Basic example -->
                    <form action="{{route('payment.agent.invoice')}}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <select class="form-control select2" name="agent_id">
                                        <option value="" selected disabled>Select Agent</option>
                                        @foreach($agents as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Start Date</span>
                                    <input type="date" name="start_date" value="{{ request()->get('start_date') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">End Date</span>
                                    <input type="date" name="end_date" value="{{ request()->get('end_date') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <button type="submit" class="btn btn-block signin_button btn-success">Search & Refresh</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <br>
                    <table id="datatable" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Invoice NO</th>
                                <th scope="col">Agent Name</th>
                                <th scope="col">Payment Date</th>
                                <th scope="col">Download</th>
                            </tr>
                        </thead>
                        <tbody id="reqtablenew">
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td> invoice#0{{ $invoice->id ?? '' }}</td>
                                    <td>{{ $invoice->getPercelDetails->agent->name ?? 'No name' }}</td>
                                    <td> {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y g:i A') }}</td>
                                    <td>
                                         <a href="{{ route('payment.agent.invoice.export', $invoice->id) }}"
                                            class="btn btn-danger" target="_blank"><i class="fa fa-eye"></i></a>

                                        <a href="{{route('payment.agent.invoice.print', $invoice->id)}}"
                                           class="btn btn-primary" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>

                                        <a href="{{route('payment.agent.invoice.download', $invoice->id)}}"
                                           class="btn btn-success" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-scripts')

    @include('backend.layouts.datatable_scripts')
    {{-- Datatable --}}
    <script>
        $(document).ready(function () {
            $('#reqtablenew tr').click(function () {
                $('#reqtablenew tr').removeClass("row_active");
                $(this).addClass("row_active");
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new DataTable("#datatable", {
                pagingType: "full_numbers",
                fixedHeader: !0,
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "print"],
            });
        });
    </script>

@endsection
