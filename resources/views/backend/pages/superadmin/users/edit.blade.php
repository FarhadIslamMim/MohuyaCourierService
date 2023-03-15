@extends('backend.layouts.master')
@section('title', 'Users add')
@section('custom-styles')
    @include('backend.layouts.datatable_styles')
@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Users Add</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data" name="editForm">
                @csrf
                <input type="hidden" value="{{ $user->id }}" name="hidden_id">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit info of <strong>{{ $user->name }}</strong>
                            </h3>
                        </div>
                        <div class="main-body">
                            <div class="row gy-3">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            value="{{ $user->name }}">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>
                                <!-- column end -->

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username"
                                            class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}"
                                            value="{{ $user->username }}">
                                        @if ($errors->has('username'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            value="{{ $user->email }}">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone"
                                            class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                            value="{{ $user->phone }}">
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" id="designation"
                                            class="form-control {{ $errors->has('designation') ? ' is-invalid' : '' }}"
                                            value="{{ $user->designation }}">
                                        @if ($errors->has('designation'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('designation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role_id"
                                            class="form-control select2 {{ $errors->has('role_id') ? ' is-invalid' : '' }}"
                                            value="{{ $user->role_id }}">
                                            <option value="">===select role===</option>
                                            @foreach ($user_role as $key => $value)
                                                <option value="{{ $value->id }}"
                                                    @if (old('role_id', $user->role_id) == $value->id) selected @endif>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('role_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('role_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="password">Password </label>
                                        <i class="fa fa-eye" id="password_toggle"
                                            style="position:absolute;right:25px; top:40px; cursor: pointer;"></i>
                                        <input type="password" name="password" id="password"
                                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="password">Confirm Password </label>
                                        <i class="fa fa-eye" id="confirm_toggle"
                                            style="position:absolute;right:25px; top:40px; cursor: pointer;"></i>
                                        <input type="password" name="confirmed" id="confirmed" class="form-control">
                                    </div>
                                </div>
                                <!-- column end -->

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="custom-label">
                                            <label>Publication Status</label>
                                        </div>
                                        <div class="box-body pub-stat display-inline">
                                            <input class=""
                                                type="radio" id="active" name="status" value="1"
                                                @if ($user->status == 1) checked @endif>
                                            <label for="active">Active</label>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="box-body pub-stat display-inline">
                                            <input class=""
                                                type="radio" name="status" value="0"
                                                @if ($user->status == 0) checked @endif id="inactive">
                                            <label for="inactive">Inactive</label>
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- column end -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image"
                                            class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"
                                            value="{{ old('image') }}">
                                        <img src="{{ asset($user->image) }}" class="backend_image" alt="">
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Permissions
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="flat-green" id="checkAll"> Check
                                        All
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header">
                                        Dashboard
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#dashboard">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="dashboard" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input dashboard"
                                                        name="permission[]" value="dashboard" id="dashboard"
                                                        {{ $user->can('dashboard') ? 'checked' : '' }}>
                                                    Dashboard
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Website
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#website">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="website" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="website" id="website"
                                                        {{ $user->can('website') ? 'checked' : '' }}>
                                                    Website
                                                </label>
                                            </div>
                                            {{-- <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox"
                                                    class="form-check-input website"
                                                    name="permission[]" value="terms_condition"
                                                    id="terms_condition"
                                                    {{ $user->can('terms_condition') ? 'checked' : '' }}>
                                                Terms & Condition
                                            </label>
                                        </div> --}}
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="setting" id="setting"
                                                        {{ $user->can('setting') ? 'checked' : '' }}>
                                                    Setting
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="logo" id="logo"
                                                        {{ $user->can('logo') ? 'checked' : '' }}>
                                                    Logo
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="logo_add" id="logo_add"
                                                        {{ $user->can('logo_add') ? 'checked' : '' }}>
                                                    logo_add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="logo_edit" id="logo_edit"
                                                        {{ $user->can('logo_edit') ? 'checked' : '' }}>
                                                    Logo edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="logo_delete" id="logo_delete"
                                                        {{ $user->can('logo_delete') ? 'checked' : '' }}>
                                                    Logo delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="slider" id="slider"
                                                        {{ $user->can('slider') ? 'checked' : '' }}>
                                                    Slider
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="slider_add" id="slider_add"
                                                        {{ $user->can('slider_add') ? 'checked' : '' }}>
                                                    Slider add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="slider_edit" id="slider_edit"
                                                        {{ $user->can('slider_edit') ? 'checked' : '' }}>
                                                    Slider edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="slider_delete" id="slider_delete"
                                                        {{ $user->can('slider_delete') ? 'checked' : '' }}>
                                                    Slider delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="slogan" id="slogan"
                                                        {{ $user->can('slogan') ? 'checked' : '' }}>
                                                    Slogan
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="feature" id="feature"
                                                        {{ $user->can('feature') ? 'checked' : '' }}>
                                                    Feature
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="feature_add" id="feature_add"
                                                        {{ $user->can('feature_add') ? 'checked' : '' }}>
                                                    Feature add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="feature_edit" id="feature_edit"
                                                        {{ $user->can('feature_edit') ? 'checked' : '' }}>
                                                    Feature edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="feature_delete" id="feature_delete"
                                                        {{ $user->can('feature_delete') ? 'checked' : '' }}>
                                                    Feature delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="hub_area" id="hub_area"
                                                        {{ $user->can('hub_area') ? 'checked' : '' }}>
                                                    Hub area
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="hub_area_add" id="hub_area_add"
                                                        {{ $user->can('hub_area_add') ? 'checked' : '' }}>
                                                    Hub area add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="hub_area_edit" id="hub_area_edit"
                                                        {{ $user->can('hub_area_edit') ? 'checked' : '' }}>
                                                    Hub area edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="hub_area_delete" id="hub_area_delete"
                                                        {{ $user->can('hub_area_delete') ? 'checked' : '' }}>
                                                    Hub area delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="service" id="service"
                                                        {{ $user->can('service') ? 'checked' : '' }}>
                                                    Service
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="service_add" id="service_add"
                                                        {{ $user->can('service_add') ? 'checked' : '' }}>
                                                    Service add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="service_edit" id="service_edit"
                                                        {{ $user->can('service_edit') ? 'checked' : '' }}>
                                                    Service edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="service_delete" id="service_delete"
                                                        {{ $user->can('service_delete') ? 'checked' : '' }}>
                                                    Service delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="create_page" id="create_page"
                                                        {{ $user->can('create_page') ? 'checked' : '' }}>
                                                    Create page
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="create_page_add" id="create_page_add"
                                                        {{ $user->can('create_page_add') ? 'checked' : '' }}>
                                                    Create page add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="create_page_edit"
                                                        id="create_page_edit"
                                                        {{ $user->can('create_page_edit') ? 'checked' : '' }}>
                                                    Create page edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input website"
                                                        name="permission[]" value="create_page_delete"
                                                        id="create_page_delete"
                                                        {{ $user->can('create_page_delete') ? 'checked' : '' }}>
                                                    Create page delete
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Panel User
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#panel_user">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="panel_user" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input panel_user"
                                                        name="permission[]" value="panel_user" id="panel_user"
                                                        {{ $user->can('panel_user') ? 'checked' : '' }}>
                                                    Panel User
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input panel_user"
                                                        name="permission[]" value="user_add" id="user_add"
                                                        {{ $user->can('user_add') ? 'checked' : '' }}>
                                                    User add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input panel_user"
                                                        name="permission[]" value="user_edit" id="user_edit"
                                                        {{ $user->can('user_edit') ? 'checked' : '' }}>
                                                    User edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input panel_user"
                                                        name="permission[]" value="user_delete" id="user_delete"
                                                        {{ $user->can('user_delete') ? 'checked' : '' }}>
                                                    User delete
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Bulk SMS
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#bulk_sms">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="bulk_sms" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input bulk_sms"
                                                        name="permission[]" value="bulk_sms" id="bulk_sms"
                                                        {{ $user->can('bulk_sms') ? 'checked' : '' }}>
                                                    Bulk SMS
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input bulk_sms"
                                                        name="permission[]" value="send_sms" id="send_sms"
                                                        {{ $user->can('send_sms') ? 'checked' : '' }}>
                                                    Send SMS
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input bulk_sms"
                                                        name="permission[]" value="sms_balance" id="sms_balance"
                                                        {{ $user->can('sms_balance') ? 'checked' : '' }}>
                                                    SMS Balance
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Merchant
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#merchant">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="merchant" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input merchant"
                                                        name="permission[]" value="merchant" id="merchant"
                                                        {{ $user->can('merchant') ? 'checked' : '' }}>
                                                    Merchant
                                                </label>
                                            </div>

                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input merchant"
                                                        name="permission[]" value="merchant_add" id="merchant_add"
                                                        {{ $user->can('merchant_add') ? 'checked' : '' }}>
                                                    Merchant add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input merchant"
                                                        name="permission[]" value="merchant_edit" id="merchant_edit"
                                                        {{ $user->can('merchant_edit') ? 'checked' : '' }}>
                                                    Merchant edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input merchant"
                                                        name="permission[]" value="merchant_delete" id="merchant_delete"
                                                        {{ $user->can('merchant_delete') ? 'checked' : '' }}>
                                                    Merchant delete
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Delivery Charge
                                        <a class="card-link pull-right" data-bs-toggle="collapse"
                                            href="#delivery_charge">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="delivery_charge" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input delivery_charge"
                                                        name="permission[]" value="delivery_charge" id="delivery_charge"
                                                        {{ $user->can('delivery_charge') ? 'checked' : '' }}>
                                                    Delivery charge
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input delivery_charge"
                                                        name="permission[]" value="delivery_charge_edit"
                                                        id="delivery_charge_edit"
                                                        {{ $user->can('delivery_charge_edit') ? 'checked' : '' }}>
                                                    Delivery charge edit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Discount
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#discount">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="discount" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input discount"
                                                        name="permission[]" value="discount_edit" id="discount_edit"
                                                        {{ $user->can('discount_edit') ? 'checked' : '' }}>
                                                    Discount
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input discount"
                                                        name="permission[]" value="promotional_discount_add"
                                                        id="promotional_discount_add"
                                                        {{ $user->can('promotional_discount_add') ? 'checked' : '' }}>
                                                    Promotional Discount add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input discount"
                                                        name="permission[]" value="promotional_discount_edit"
                                                        id="promotional_discount_edit"
                                                        {{ $user->can('promotional_discount_edit') ? 'checked' : '' }}>
                                                    Promotional Discount edit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Area Panel
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#area_panel">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="area_panel" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="area_panel" id="area_panel"
                                                        {{ $user->can('area_panel') ? 'checked' : '' }}>
                                                    Area Panel
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="division" id="division"
                                                        {{ $user->can('division') ? 'checked' : '' }}>
                                                    Division
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="division_add" id="division_add"
                                                        {{ $user->can('division_add') ? 'checked' : '' }}>
                                                    Division add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="division_edit" id="division_edit"
                                                        {{ $user->can('division_edit') ? 'checked' : '' }}>
                                                    Division edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="division_delete" id="division_delete"
                                                        {{ $user->can('division_delete') ? 'checked' : '' }}>
                                                    Division delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="district" id="district"
                                                        {{ $user->can('district') ? 'checked' : '' }}>
                                                    District
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="district_add" id="district_add"
                                                        {{ $user->can('district_add') ? 'checked' : '' }}>
                                                    District add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="district_edit" id="district_edit"
                                                        {{ $user->can('district_edit') ? 'checked' : '' }}>
                                                    District edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="district_delete" id="district_delete"
                                                        {{ $user->can('district_delete') ? 'checked' : '' }}>
                                                    District delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="thana" id="thana"
                                                        {{ $user->can('thana') ? 'checked' : '' }}>
                                                    Thana
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="thana_add" id="thana_add"
                                                        {{ $user->can('thana_add') ? 'checked' : '' }}>
                                                    Thana add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="thana_edit" id="thana_edit"
                                                        {{ $user->can('thana_edit') ? 'checked' : '' }}>
                                                    Thana edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="thana_delete" id="thana_delete"
                                                        {{ $user->can('thana_delete') ? 'checked' : '' }}>
                                                    Thana delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="area" id="area"
                                                        {{ $user->can('area') ? 'checked' : '' }}>
                                                    Area
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="area_add" id="area_add"
                                                        {{ $user->can('area_add') ? 'checked' : '' }}>
                                                    Area add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="area_edit" id="area_edit"
                                                        {{ $user->can('area_edit') ? 'checked' : '' }}>
                                                    Area edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input area_panel"
                                                        name="permission[]" value="area_delete" id="area_delete"
                                                        {{ $user->can('area_delete') ? 'checked' : '' }}>
                                                    Area delete
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        HR
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#hr">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="hr" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="hr" id="hr"
                                                        {{ $user->can('hr') ? 'checked' : '' }}>
                                                    HR
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="department" id="department"
                                                        {{ $user->can('department') ? 'checked' : '' }}>
                                                    Department
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="department_add" id="department_add"
                                                        {{ $user->can('department_add') ? 'checked' : '' }}>
                                                    Department add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="department_edit" id="department_edit"
                                                        {{ $user->can('department_edit') ? 'checked' : '' }}>
                                                    Department edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="department_delete"
                                                        id="department_delete"
                                                        {{ $user->can('department_delete') ? 'checked' : '' }}>
                                                    Department delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="employee" id="employee"
                                                        {{ $user->can('employee') ? 'checked' : '' }}>
                                                    Employee
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="employee_add" id="employee_add"
                                                        {{ $user->can('employee_add') ? 'checked' : '' }}>
                                                    Employee add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="employee_edit" id="employee_edit"
                                                        {{ $user->can('employee_edit') ? 'checked' : '' }}>
                                                    Employee edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="employee_delete" id="employee_delete"
                                                        {{ $user->can('employee_delete') ? 'checked' : '' }}>
                                                    Employee delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="agent" id="agent"
                                                        {{ $user->can('agent') ? 'checked' : '' }}>
                                                    Agent
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="agent_add" id="agent_add"
                                                        {{ $user->can('agent_add') ? 'checked' : '' }}>
                                                    Agent add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="agent_edit" id="agent_edit"
                                                        {{ $user->can('agent_edit') ? 'checked' : '' }}>
                                                    Agent edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="agent_delete" id="agent_delete"
                                                        {{ $user->can('agent_delete') ? 'checked' : '' }}>
                                                    Agent delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="pickupman" id="pickupman"
                                                        {{ $user->can('pickupman') ? 'checked' : '' }}>
                                                    Pickupman
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="pickupman_add" id="pickupman_add"
                                                        {{ $user->can('pickupman_add') ? 'checked' : '' }}>
                                                    Pickupman add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="pickupman_edit" id="pickupman_edit"
                                                        {{ $user->can('pickupman_edit') ? 'checked' : '' }}>
                                                    Pickupman edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="pickupman_delete"
                                                        id="pickupman_delete"
                                                        {{ $user->can('pickupman_delete') ? 'checked' : '' }}>
                                                    Pickupman delete
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="deliveryman" id="deliveryman"
                                                        {{ $user->can('deliveryman') ? 'checked' : '' }}>
                                                    Deliveryman
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="deliveryman_add" id="deliveryman_add"
                                                        {{ $user->can('deliveryman_add') ? 'checked' : '' }}>
                                                    Deliveryman add
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="deliveryman_edit"
                                                        id="deliveryman_edit"
                                                        {{ $user->can('deliveryman_edit') ? 'checked' : '' }}>
                                                    Deliveryman edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input hr"
                                                        name="permission[]" value="deliveryman_delete"
                                                        id="deliveryman_delete"
                                                        {{ $user->can('deliveryman_delete') ? 'checked' : '' }}>
                                                    Deliveryman delete
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        Parcel Manage
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#parcel_manage">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="parcel_manage" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input parcel_manage"
                                                        name="permission[]" value="parcel_manage" id="parcel_manage"
                                                        {{ $user->can('parcel_manage') ? 'checked' : '' }}>
                                                    Parcel manage
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input parcel_manage"
                                                        name="permission[]" value="parcel_create" id="parcel_create"
                                                        {{ $user->can('parcel_create') ? 'checked' : '' }}>
                                                    Parcel create
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input parcel_manage"
                                                        name="permission[]" value="parcel_edit" id="parcel_edit"
                                                        {{ $user->can('parcel_edit') ? 'checked' : '' }}>
                                                    Parcel edit
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input parcel_manage"
                                                        name="permission[]" value="multiple_parcel_pick"
                                                        id="multiple_parcel_pick"
                                                        {{ $user->can('multiple_parcel_pick') ? 'checked' : '' }}>
                                                    Multiple parcel pick
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Payment
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#payment">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="payment" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input payment"
                                                        name="permission[]" value="payment" id="payment"
                                                        {{ $user->can('payment') ? 'checked' : '' }}>
                                                    Payment
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input payment"
                                                        name="permission[]" value="payment_to_merchant"
                                                        id="payment_to_merchant"
                                                        {{ $user->can('payment_to_merchant') ? 'checked' : '' }}>
                                                    Payment to merchant
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input payment"
                                                        name="permission[]" value="payment_to_pickupman"
                                                        id="payment_to_pickupman"{{ $user->can('payment_to_pickupman') ? 'checked' : '' }}>
                                                    Payment to Pickupman
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input payment"
                                                        name="permission[]" value="payment_to_deliveryman"
                                                        id="payment_to_deliveryman"{{ $user->can('payment_to_deliveryman') ? 'checked' : '' }}>
                                                    Payment to Deliveryman
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Report
                                        <a class="card-link pull-right" data-bs-toggle="collapse" href="#report">
                                            <i class="la la-plus"></i>
                                        </a>
                                    </div>
                                    <div id="report" class="collapse" data-bs-parent="#accordion">
                                        <div class="card-body">
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input report"
                                                        name="permission[]" value="report" id="report"
                                                        {{ $user->can('report') ? 'checked' : '' }}>
                                                    Report
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input report"
                                                        name="permission[]" value="summary_report" id="summary_report"
                                                        {{ $user->can('summary_report') ? 'checked' : '' }}>
                                                    Summary Report
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input report"
                                                        name="permission[]" value="merchant_based_report"
                                                        id="merchant_based_report"
                                                        {{ $user->can('merchant_based_report') ? 'checked' : '' }}>
                                                    Merchant Based Report
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input report"
                                                        name="permission[]" value="pickupman_based_report"
                                                        id="pickupman_based_report"
                                                        {{ $user->can('pickupman_based_report') ? 'checked' : '' }}>
                                                    Pickupman Based Report
                                                </label>
                                            </div>
                                            <div class="form-check-inline">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input report"
                                                        name="permission[]" value="deliveryman_based_report"
                                                        id="deliveryman_based_report"
                                                        {{ $user->can('deliveryman_based_report') ? 'checked' : '' }}>
                                                    Deliveryman Based Report
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
