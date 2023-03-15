<nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset($setting->logo)); ?>" class="card-logo card-logo-dark" alt="logo dark" height="40">
            <img src="<?php echo e(asset($setting->logo)); ?>" class="card-logo card-logo-light" alt="logo light" height="40">

        </a>

        <button class="navbar-toggler py-1 fs-20 text-body" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <?php if(Session::get('merchantId')): ?>
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="<?php echo e(route('home')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('home.parcel.tracking')); ?>">Track Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('merchant.percel.create')); ?>">Create Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('marchant.percels')); ?>">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('merchant.percel.import')); ?>">Import Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('merchant.payment.invoice')); ?>">Payments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('merchant.profile')); ?>">Profile</a>
                    </li>
                </ul>

                <div class="">
                    <a href="<?php echo e(route('signout')); ?>"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signout</a>
                    <a href="<?php echo e(route('merchant.home')); ?>" class="btn btn-primary">Dashboard</a>
                </div>
            <?php elseif(Session::get('deliverymanId')): ?>
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="<?php echo e(route('home')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('home.parcel.tracking')); ?>">Track Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('deliveryman.percels')); ?>">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('deliveryman.assignable')); ?>">Assignable Parcels
                             <span class="badge bg-success rounded-circle"><?php echo e(Session::get('parcel_count')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('deliveryman.payment.invoice')); ?>">Payment Invoices
                            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('deliveryman.profile')); ?>">Profile</a>
                    </li>
                </ul>

                <div class="">
                    <a href="<?php echo e(route('signout')); ?>"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signout</a>
                    <a href="<?php echo e(route('deliveryman.home')); ?>" class="btn btn-primary">Dashboard</a>
                </div>
            <?php elseif(Session::get('pickupmanId')): ?>
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="<?php echo e(route('home')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('home.parcel.tracking')); ?>">Track Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('pickupman.percels')); ?>">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('pickupman.assignable')); ?>">Assignable Parcels
                         <span class="badge bg-success rounded-circle"><?php echo e(Session::get('parcel_count')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('pickupman.payment.invoice')); ?>">Payment Invoices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('pickupman.profile')); ?>">Profile</a>
                    </li>
                </ul>

                <div class="">
                    <a href="<?php echo e(route('signout')); ?>"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signout</a>
                    <a href="<?php echo e(route('pickupman.home')); ?>" class="btn btn-primary">Dashboard</a>
                </div>
            <?php elseif(Session::get('agentId')): ?>
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="<?php echo e(route('home')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('home.parcel.tracking')); ?>">Track Parcel</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Parcel
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="<?php echo e(route('agent.percel.create')); ?>">Create Parcel</a>
                            </li>
                            <?php $__currentLoopData = $perceltypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perceltype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $percelcount = App\Models\Parcel::where(['status' => $perceltype->id, 'agentId' => Session::get('agentId')])->count();
                                ?>

                                <li><a href="<?php echo e(route('agent.percel.index', $perceltype->slug)); ?>"
                                        class="dropdown-item" aria-expanded="false"> Parcel <?php echo e($perceltype->title); ?>

                                        (<?php echo e($percelcount); ?>)
                                    </a></li>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </li>
                </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Reports
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo e(route('agent.report.deliveryman')); ?>">Deliveryman
                                Report</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('agent.report.pickupman')); ?>">Pickupman
                                Report</a></li>
                    </ul>


                </li>
                <li class="nav-item">
                    <a class="nav-link fs-15" href="<?php echo e(route('agent.paracel.assignable')); ?>">Assign Parcel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-15" href="<?php echo e(route('agent.import.parcel')); ?>">Import Parcel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-15" href="<?php echo e(route('agent.payment.invoice')); ?>">Payments</a>
                </li>
                </ul>

                <div class="">
                    <a href="<?php echo e(route('signout')); ?>"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signout</a>
                    <a href="<?php echo e(route('agent.home')); ?>" class="btn btn-primary">Dashboard</a>
                </div>
            <?php else: ?>
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                    <li class="nav-item">
                        <a class="nav-link fs-15 active" href="<?php echo e(route('home')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('home')); ?>#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('home.parcel.tracking')); ?>">Track Parcel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('home')); ?>#hubs">Hubs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-15" href="<?php echo e(route('home')); ?>#contact">Contact</a>
                    </li>
                </ul>
                <div class="">
                    <a href="<?php echo e(route('signin')); ?>"
                        class="btn btn-link fw-medium text-decoration-none text-dark">Signin</a>
                    <a href="<?php echo e(route('merchant.register.page')); ?>" class="btn btn-primary">Merchant Register</a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('superadmin.dashboard')); ?>" class="btn btn-success">
                            <i class=" bx bx-user"></i> Dashboard</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</nav>
<?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/frontend/layouts/navbar.blade.php ENDPATH**/ ?>