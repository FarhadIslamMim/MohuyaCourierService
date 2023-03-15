@extends('backend.layouts.master')
@section('title', 'Edit Thana')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Thana</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Area</a></li>
                        <li class="breadcrumb-item active">Edit Thana</li>
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
                    <h4>Edit Thana</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('thana.update') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <input type="text" hidden value="{{$thanas->id}}" name="id">
                                <div class="form-group">
                                    <div>
                                        <label for="division" class="form-label">Select Division</label>
                                        <select name="division_id" id="division_id" class="form-control select2" required>
                                            <option value="">Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"
                                                    @if (old('division_id', $thanas->division_id) == $division->id) selected @endif>
                                                    {{ $division->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="division" class="form-label">Select District</label>
                                        <select name="district_id" id="district_id" class="form-control select2">
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}"
                                                    @if (old('district_id', $thanas->district_id) == $district->id) selected @endif>
                                                    {{ $district->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="name" class="form-label">Thana Name</label>
                                        <select name="deliverycharge_id" id="deliverycharge_id" class="form-control select2"
                                            required>
                                            <option value=""> Delivery Charge </option>
                                            @foreach ($delivery_charges as $delivery_charge)
                                                <option value="{{ $delivery_charge->id }}"
                                                    @if ($thanas->deliverycharge_id == $delivery_charge->id) selected @endif>
                                                    {{ $delivery_charge->deliveryChargeHead->name ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="name" class="form-label">Thana Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$thanas->name}}" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <input type="submit" value="Update Thana" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    @include('backend.layouts.datatable_scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable();
        });
    </script>

    <script>
        $(function() {
            $('body').on('change', '#division_id', function() {
                var division_id = $('#division_id').val();
                var options = '<option value=""> Select district </option>';
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_division_districts') }}",
                    data: {
                        'division_id': division_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    response.forEach(function(item, i) {
                        options += '<option value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    });
                    $('#district_id').html(options);
                });
            })
        })
    </script>
@endsection
