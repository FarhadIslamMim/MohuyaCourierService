@extends('backend.layouts.master')
@section('title', 'Pickupman Expenses Create')
@section('custom-styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Pickupman Expense Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Accounts</a>
                        </li>
                        <li class="breadcrumb-item active">Pickupman Expense Create</li>
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
                    <form action="{{ route('pman.expense.store') }}" method="POST">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <label for="Pickupman">Date of expense</label>
                                <input type="date" value="{{ old('date') }}" name="date" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="Pickupman">Select Pickupman</label>
                                <select name="pickupman_id" class="form-control select2">
                                    <option value="">Select Pickupman</option>
                                    @foreach ($pickupmans as $pickupman)
                                        <option value="{{ $pickupman->id }}">{{ $pickupman->name }}
                                            -{{ $pickupman->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="Pickupman">Oil/Fule Cost</label>
                                <input type="number" value="{{ old('oil_cost') }}" name="oil_cost" placeholder="0.00"
                                    class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="others">Other Costs</label>
                                <input type="number" value="{{ old('other_costs') }}" name="other_costs" placeholder="0.00"
                                    class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" value="Add Expense" class="btn btn-primary">
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
