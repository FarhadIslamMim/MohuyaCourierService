<div class="header">
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg py-md-0 py-1 bg-white navbar-light-cs">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img width="50px" src="{{ asset($setting->logo) }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                @if (Session::get('merchantId'))
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link btn btn-ui-color" href="{{ route('merchant.home') }}">Dashboard</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="{{ route('home.parcel.tracking') }}">Tracking ID</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('merchant.percel.create') }}">Create
                                Parcel</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('percels') }}">All orders</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('merchant.percel.import') }}">Import
                                Order</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('merchant.profile') }}">Profile</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('signout') }}">Signout</a>
                        </li>
                    </ul>
                @elseif (Session::get('deliverymanId'))
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link btn btn-ui-color" href="{{ route('deliveryman.home') }}">Dashboard</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="{{ route('home.parcel.tracking') }}">Tracking ID</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="{{ route('deliveryman.parcel.pending') }}">Assigend Parcel</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('deliveryman.percels') }}">
                                Parcels</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('signout') }}">Signout</a>
                        </li>
                    </ul>
                @elseif (Session::get('pickupmanId'))
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link btn btn-ui-color" href="{{ route('pickupman.home') }}">Dashboard</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="{{ route('home.parcel.tracking') }}">Tracking ID</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="{{ route('pickupman.parcel.pending') }}">Assigend Parcel</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('pickupman.percels') }}">
                                Parcels</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('signout') }}">Signout</a>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="{{ route('home.parcel.tracking') }}">Tracking ID</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link btn btn-outline-success"
                                href="{{ route('merchant.register.page') }}">Signup</a>
                        </li>
                        <li class="nav-item mx-lg-2 py-lg-3 py-md-2 py-1">
                            <a class="nav-link btn btn-ui-color" href="{{ route('signin') }}">Signin</a>
                        </li>
                    </ul>
                @endif



            </div>
        </div>
    </nav>

</div>
