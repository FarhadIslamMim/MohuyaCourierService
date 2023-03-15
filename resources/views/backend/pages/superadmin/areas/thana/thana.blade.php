@extends('backend.layouts.master')
@section('title', 'Thana')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thana</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Thana</a></li>
                        <li class="breadcrumb-item active">Thana</li>
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
                    <h4>Thana Create</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('thana.store') }}" method="post">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="division" class="form-label">Select Division</label>
                                        <select name="division_id" id="division_id" class="form-control select2">
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
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

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="division" class="form-label">Delivery Charge</label>
                                        <select name="deliverycharge_id" id="deliverycharge_id" class="form-control select2"
                                            required>
                                            @foreach ($delivery_charges as $delivery_charge)
                                                <option value="{{ $delivery_charge->id }}">
                                                    {{ $delivery_charge->deliveryChargeHead->name ?? '' }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="name" class="form-label">Thana Name</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div>
                                        <input type="submit" value="New Thana" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Districts List -->
            <div class="card">
                <div class="card-body">
                    <h4>All Division List</h4>
                    <table id="datatable" class="table table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Division</th>
                                <th scope="col">District</th>
                                <th scope="col">Thana</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($thanas as $thana)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $thana->division->name ?? '' }}</td>
                                    <td>{{ $thana->district->name ?? '' }}</td>
                                    <td>{{ $thana->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($thana->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <!-- Dropdown Variant -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="mdi mdi-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('thana.edit', $thana->id) }}"><i
                                                        class=" bx bx-edit-alt"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="{{ route('thana.delete', $thana->id) }}"><i
                                                        class=" bx bx-trash"></i>
                                                    Delete</a>
                                            </div>
                                        </div><!-- /btn-group -->
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
