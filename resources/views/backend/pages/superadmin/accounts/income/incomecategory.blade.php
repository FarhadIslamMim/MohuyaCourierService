@extends('backend.layouts.master')
@section('title', 'Income Head')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Income Head</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Income Head</a>
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
                <h4>Income Head</h4>
            </div>
            <div class="card-body">
                <div class="form">
                    <form method="post" @if ($income_head_data) action="{{ route('income.head.update') }}" @endif
                        action="{{ route('income.head.store') }}">
                        @csrf
                        @include('backend.layouts.notifications')
                        <div class="form-group row gy-4">
                            <label for="income_head" class="col-sm-4 col-form-label">Income Head
                                (Category)</label>
                            <div class="col-sm-6">
                                <input type="text" name="id" hidden
                                    @if ($income_head_data) value="{{ $income_head_data->id }}" @endif>

                                <input type="text" class="form-control" name="income_head" id="income_head"
                                    placeholder="Income category"
                                    @if ($income_head_data) value="{{ $income_head_data->income_head }}" @endif>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" @if ($income_head_data) value="Update" @endif
                                    class="btn btn-primary" value="Add Head">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4>income Head List</h4>
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Head Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($income_heads as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->income_head }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('income.head.edit', $item->id) }}" class="btn btn-success">
                                                <i class="la la-edit"></i></a>
                                            <a href="{{ route('income.head.delete', $item->id) }}" class="btn btn-info"><i
                                                    class="la la-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                    {{ $income_heads->links() }}
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
