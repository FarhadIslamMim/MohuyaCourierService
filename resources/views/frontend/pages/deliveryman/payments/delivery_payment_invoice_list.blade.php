@extends('frontend.layouts.master')
@section('title', 'Invoices')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        #reqtablenew > tr:hover{
            /*background-color: #abcaab;*/
        }
        .row_active{
            background-color: #d1c9c9;
        }
    </style>
@endsection
@section('main-content')
    <section class="section mt-5">
        <div class="container">
            <h4>Payment Invoices</h4>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Deliveryman Payment Invoice</h4>
                        </div>
                        <div class="card-body">
                            <!-- Basic example -->

                            <form action="{{route('deliveryman.payment.invoice')}}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Start Date</span>
                                            <input type="date" id="" name="start_date" value="{{ request()->get('start_date') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">End Date</span>
                                            <input type="date" id="" name="end_date" value="{{ request()->get('end_date') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-block signin_button btn-success">Search</button>
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
                                        <th scope="col">Deliveryman Name</th>
                                        <th scope="col">Payment Date</th>
                                        <th scope="col">Download</th>
                                    </tr>
                                </thead>
                                <tbody id="reqtablenew">
                                @if(count($invoices) > 0)
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td> invoice#0{{ $invoice->id ?? '' }}</td>
                                            <td>{{ $invoice->getPercelDetails->deliveryman->name ?? 'No name' }}</td>
                                            <td> {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('deliveryman.payment.invoice.details', $invoice->id) }}"
                                                    class="btn btn-info" target="_blank"><i class="las la-file-pdf fs-18"></i></a>

                                                 <a href="{{ route('deliveryman.payment.invoice.download', $invoice->id) }}"
                                                    class="btn btn-danger" target="_blank"><i class="las la-download fs-18"></i></a>
                                             </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" style="text-align: center;color: red"> No Data Available</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-scripts')

    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function () {
            $('#reqtablenew tr').click(function () {
                $('#reqtablenew tr').removeClass("row_active");
                $(this).addClass("row_active");
            });
        });
    </script>
    {{-- Datatable --}}
    <script>
{{--        var minDate, maxDate;--}}

{{--        // Custom filtering function which will search data in column four between two values--}}
{{--        $.fn.dataTable.ext.search.push(--}}
{{--            function(settings, data, dataIndex) {--}}
{{--                var min = $('#start_date').val();--}}
{{--                var max = $('#end_date').val();--}}
{{--                var date_db = data[3] || 0; // use data for the date column--}}
{{--                if (min == "" && max == "") {--}}
{{--                    return true;--}}
{{--                }--}}
{{--                if (min == "" && date_db <= max) {--}}
{{--                    return true;--}}
{{--                }--}}
{{--                if (max == "" && date_db >= min) {--}}
{{--                    return true;--}}
{{--                }--}}
{{--                if (date_db <= max && date_db >= min) {--}}
{{--                    return true;--}}
{{--                }--}}
{{--                return false;--}}
{{--            });--}}
        $(document).ready(function() {
            // Create date inputs
            minDate = $("#start_date").val();
            maxDate = $("#end_date").val();
            // DataTables initialisation
            var table = $('#datatable').DataTable();

            // Refilter the table
            $('#start_date, #end_date').on('change', function() {
                table.draw();
            });
        });


        document.addEventListener("DOMContentLoaded", function() {
            new DataTable("#datatable", {
                pagingType: "full_numbers",
                fixedHeader: !0,
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "print", "pdf"],
            });
        });
    </script>

@endsection
