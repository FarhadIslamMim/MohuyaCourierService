@extends('backend.layouts.master')
@section('title', 'Delivery Charge Edit')
@section('custom-styles')

@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Delivery Charge </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Delivery Charge </a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- Merchant Manage content start -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dc.store') }}" method="POST" enctype="multipart/form-data" name="editForm">
                        @csrf
                        @include('backend.layouts.notifications')

                        <div class="main-body">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="delivery_charge_head_id">Delivery Charge Head</label>
                                        <select name="delivery_charge_head_id" id="delivery_charge_head_id"
                                            class="form-control">
                                            @foreach ($delivery_charge_heads as $delivery_charge_head)
                                                <option value="{{ $delivery_charge_head->id }}">
                                                    {{ $delivery_charge_head->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('delivery_charge_head_id'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('delivery_charge_head_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="subtitle"> @lang('common.weight') (name) </label>
                                    <input type="text" name="weight" id="weight"
                                        class="form-control {{ $errors->has('weight') ? ' is-invalid' : '' }}"
                                        value="{{ old('weight', $edit_data->weight) }}">
                                    @if ($errors->has('weight'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="deliverycharge">Delivery Charge </label>
                                        <input type="text" name="deliverycharge" id="deliverycharge"
                                            class="form-control {{ $errors->has('deliverycharge') ? ' is-invalid' : '' }}"
                                            value="">
                                        @if ($errors->has('deliverycharge'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('deliverycharge') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="extradeliverycharge">Extra Delivery Charge
                                        </label>
                                        <input type="text" name="extradeliverycharge" id="extradeliverycharge"
                                            class="form-control {{ $errors->has('extradeliverycharge') ? ' is-invalid' : '' }}"
                                            value="">
                                        @if ($errors->has('extradeliverycharge'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('extradeliverycharge') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cod_charge">COD Charge (%) </label>
                                        <input type="number" step="any" name="cod_charge" id="cod_charge"
                                            class="form-control {{ $errors->has('cod_charge') ? ' is-invalid' : '' }}"
                                            value="">
                                        @if ($errors->has('cod_charge'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('cod_charge') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="cod_charge">Return Charge (%) </label>
                                        <input type="number" step="any" name="return_charge" id="return_charge"
                                            class="form-control {{ $errors->has('return_charge') ? ' is-invalid' : '' }}"
                                            value="">
                                        @if ($errors->has('return_charge'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('return_charge') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="custom-label">
                                            <label>Status</label>
                                        </div>
                                        <div class="box-body pub-stat display-inline">
                                            <input class="" type="radio" id="active" name="status"
                                                value="1" checked>
                                            <label for="active">Active</label>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="box-body pub-stat display-inline">
                                            <input class="" type="radio" name="status" value="0"
                                                id="inactive">
                                            <label for="inactive">Inactive</label>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mrt-15">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Merchant Manage content end -->

@endsection
@section('custom-scripts')

@endsection
