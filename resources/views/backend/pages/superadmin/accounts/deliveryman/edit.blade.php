@extends('backend.layouts.master')
@section('title', 'Deliveryman Expenses Create')
@section('custom-styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Deliveryman Expense Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a>
                        </li>
                        <li class="breadcrumb-item active">Deliveryman Expense Create</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="print">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dman.expense.update') }}" method="POST">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="row gy-4">
                            <input type="text" name="expense_id" value="{{$data->id}}" hidden>
                            <div class="col-lg-6">
                                <label for="deliveryman">Date of expense</label>
                                <input type="date" value="{{ $data->date }}" name="date" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="deliveryman">Oil/Fule Cost</label>
                                <input type="number" value="{{$data->oil_cost}}" name="oil_cost" placeholder="0.00"
                                    class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="others">Other Costs</label>
                                <input type="number" value="{{$data->other_costs}}" name="other_costs" placeholder="0.00"
                                    class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" value="Update Expense" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom-scripts')

@endsection
