@extends('backend.layouts.master')
@section('title', 'Deliveryman Expenses')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the initial value */

            /* this affects the margin in the printer settings */
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Deliveryman Expense</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a>
                        </li>
                        <li class="breadcrumb-item active">Deliveryman Expense</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-body">
                <form action="" method="get">
                    <div class="row gy-2">
                        <div class="col-lg-3">
                            <label for="selectDeliveryman">Select Deliveryman</label>
                            <select name="deliveryman_id" class="form-control select2">
                                <option value="" disabled selected>Select Deliveryman</option>
                                @foreach ($deliverymans as $deliveryman)
                                    <option value="{{$deliveryman->id}}">
                                        {{ $deliveryman->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label for="Start Date">Start Date</label>
                            <input type="date" name="start_date" value="{{ $start_date }}" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label for="Start Date">End Date</label>
                            <input type="date" name="end_date" value="{{ $end_date }}" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label for="Start Date"> </label><br>
                            <input type="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if(count($expenses) > 0)
            <div class="card">
                <div class="card-body">
                    <!-- Striped Rows -->
                    @include('backend.layouts.notifications')
                    <div class="print">
                        <div class="text-end">
                            <a class="btn btn-primary"
                               href="{{ url('superadmin/accounts/deliveryman-expense/print?deliveryman_id=' . $deliveryman_id . '&start_date=' . $start_date . '&end_date=' . $end_date . '') }}"><i
                                    class="las la-print"></i> Print</a>
                        </div>
                        <br>
                        <table id="expenses" class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Rider</th>
                                <th scope="col">Date</th>
                                <th scope="col">Oil Cost</th>
                                <th scope="col">Others</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($expenses as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->deliverymanDetails->name }}</td>
                                    <td>{{ date('d M Y', strtotime($item->date)) }}</td>
                                    <td>{{ $item->oil_cost }} tk.</td>
                                    <td>{{ $item->other_costs }} tk.</td>
                                    <td>{{ $item->oil_cost + $item->other_costs }} tk.</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success" href="{{ route('dman.expense.edit', $item->id) }}" title="Edit"><i class="las la-edit"></i></a>
                                            <a class="btn btn-danger"
                                               href="{{ route('dman.expense.delete', $item->id) }}" title="Delete"><i class="las la-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5" class="text-end">
                                    <p><b>Total</b></p>
                                </td>
                                <td>
                                    <p><b>{{ $grand_total }} tk.</b></p>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $("#expenses").DataTable();
        });
    </script>
@endsection
