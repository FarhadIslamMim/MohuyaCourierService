@extends('frontend.layouts.master')
@section('title', 'Signin')
@section('content')
    <article>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="wrap">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100 text-center">
                                    <a href="https://www.onepointitbd.com/"><img class="py-4" width="100px"
                                            src="{{ asset('assets/button_image.png') }}" alt=""></a>
                                    <br>
                                    <h3>Signin to your account</h3>
                                </div>
                            </div>
                            <form action="{{ route('frontend.auth.check') }}" class="signin-form" method="post">
                                @csrf
                                <br>
                                @include('frontend.layouts.notifications')
                                <div class="form-group mb-2">
                                    <label class="form-control-placeholder" for="phone">Select Role</label>
                                    <select name="role" class="form-control">
                                        <option value="0">Select Role</option>
                                        <option value="1">Merchant</option>
                                        <option value="2">Deliverman</option>
                                        <option value="3">Pickupman</option>
                                        <option value="4">Agents</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-control-placeholder" for="phone">Phone</label>
                                    <input type="text" name="users" class="form-control" placeholder="PHone number"
                                        required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>

                                    <input name="password" id="password-field" type="password" class="form-control"
                                        required>
                                </div>
                                <div class="form-group mb-2">
                                    <button type="submit" class=" btn btn-block signin_button rounded submit px-3">Sign
                                        In</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
@section('custom-scripts')
    <script>
        (function($) {

            "use strict";

            $(".toggle-password").click(function() {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

        })(jQuery);
    </script>
@endsection
