<nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset($setting->logo) }}" class="card-logo card-logo-dark" alt="logo dark" height="40">
            <img src="{{ asset($setting->logo) }}" class="card-logo card-logo-light" alt="logo light" height="40">

        </a>

        <button class="navbar-toggler py-1 fs-20 text-body" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            @if (Session::get('merchantId'))
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('home.parcel.tracking') }}">Track Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('merchant.percel.create') }}">Create Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('marchant.percels') }}">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('merchant.percel.import') }}">Import Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('merchant.payment.invoice') }}">Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('merchant.profile') }}">Profile</a>
                    </li>
                </ul>

                <div class="">
                    <a href="{{ route('signout') }}"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signout</a>
                    <a href="{{ route('merchant.home') }}" class="btn btn-primary">Dashboard</a>
                </div>
            @elseif (Session::get('deliverymanId'))
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('home.parcel.tracking') }}">Track Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('deliveryman.percels') }}">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('deliveryman.assignable') }}">Assignable Parcels
                             <span class="badge bg-success rounded-circle">{{ Session::get('parcel_count') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('deliveryman.payment.invoice') }}">Payment Invoices
                            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('deliveryman.profile') }}">Profile</a>
                    </li>
                </ul>

                <div class="">
                    <a href="{{ route('signout') }}"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signout</a>
                    <a href="{{ route('deliveryman.home') }}" class="btn btn-primary">Dashboard</a>
                </div>
            @elseif (Session::get('pickupmanId'))
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('home.parcel.tracking') }}">Track Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('pickupman.percels') }}">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('pickupman.assignable') }}">Assignable Parcels
                         <span class="badge bg-success rounded-circle">{{ Session::get('parcel_count') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('pickupman.payment.invoice') }}">Payment Invoices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('pickupman.profile') }}">Profile</a>
                    </li>
                </ul>

                <div class="">
                    <a href="{{ route('signout') }}"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signout</a>
                    <a href="{{ route('pickupman.home') }}" class="btn btn-primary">Dashboard</a>
                </div>
            @elseif (Session::get('agentId'))
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('home.parcel.tracking') }}">Track Parcel</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Parcel
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('agent.percel.create') }}">Create Parcel</a>
                            </li>
                            @foreach ($perceltypes as $perceltype)
                                @php
                                    $percelcount = App\Models\Parcel::where(['status' => $perceltype->id, 'agentId' => Session::get('agentId')])->count();
                                @endphp

                                <li><a href="{{ route('agent.percel.index', $perceltype->slug) }}"
                                        class="dropdown-item" aria-expanded="false"> Parcel {{ $perceltype->title }}
                                        ({{ $percelcount }})
                                    </a></li>
                                {{-- <li><a class="dropdown-item" href="{{ route('agent.percel.create') }}">Create Parcel</a> --}}
                            @endforeach
                    </li>
                </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Reports
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('agent.report.deliveryman') }}">Deliveryman
                                Report</a></li>
                        <li><a class="dropdown-item" href="{{ route('agent.report.pickupman') }}">Pickupman
                                Report</a></li>
                    </ul>


                </li>
                <li class="nav-item">
                    <a class="nav-link fs-15" href="{{ route('agent.paracel.assignable') }}">Assign Parcel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-15" href="{{ route('agent.import.parcel') }}">Import Parcel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-15" href="{{ route('agent.payment.invoice') }}">Payments</a>
                </li>
                </ul>

                <div class="">
                    <a href="{{ route('signout') }}"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signout</a>
                    <a href="{{ route('agent.home') }}" class="btn btn-primary">Dashboard</a>
                </div>
            @else
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('home') }}#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('home.parcel.tracking') }}">Track Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('home') }}#hubs">Hubs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="{{ route('home') }}#contact">Contact</a>
                    </li>
                </ul>
                <div class="">
                    <a href="{{ route('signin') }}"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signin</a>
                    <a href="{{ route('merchant.register.page') }}" class="btn btn-primary">Merchant Register</a>
                    @auth
                        <a href="{{ route('superadmin.dashboard') }}" class="btn btn-success">
                            <i class=" bx bx-user"></i> Dashboard</a>
                    @endauth
                </div>
            @endif
        </div>

    </div>
</nav>
