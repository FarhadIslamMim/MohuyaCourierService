<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="<?php echo e(route('superadmin.dashboard')); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(asset($setting->logo)); ?>" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset($setting->logo)); ?>" alt="" height="60">
                
            </span>
        </a>
        <!-- Light Logo-->
        <a href="<?php echo e(route('superadmin.dashboard')); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(asset($setting->logo)); ?>" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(asset($setting->logo)); ?>" alt="" height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard')): ?>
                    <li class="menu-title"><span data-key="t-menu"><?php echo e(__('lang.dashboard')); ?></span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/delivery-charge/dc*') ? 'active' : ''); ?>"
                            href="<?php echo e(route('superadmin.dashboard')); ?>">
                            <i data-feather="home" class="icon-dual"></i> <span
                                data-key="t-dashboards"><?php echo e(__('lang.dashboard')); ?></span>
                        </a>
                    </li> <!-- end Dashboard Menu -->
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('parcel_manage')): ?>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span
                            data-key="t-pages"><?php echo e(__('lang.parcel_management')); ?></span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/delivery-charge/dc*') ? 'active' : ''); ?> <?php echo e(request()->is('superadmin/percel*') ? 'active' : ''); ?>"
                            href="#sidebarAuth" data-bs-toggle="collapse" role="button"
                            aria-expanded="<?php echo e(request()->is('superadmin/percel*') ? 'true' : 'false'); ?>"
                            aria-controls="sidebarAuth">
                            <i data-feather="users" class="icon-dual"></i> <span
                                data-key="t-authentication"><?php echo e(__('lang.parcel_manage')); ?></span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/percel*') ? 'show' : ''); ?>"
                            id="sidebarAuth">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item ">
                                    <a href="<?php echo e(route('percel.create')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/percel/create') ? 'active' : ''); ?>"
                                        aria-expanded="false"> <?php echo e(__('lang.parcel_create')); ?> </a>
                                </li>
                                <?php $__currentLoopData = $perceltypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perceltype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $percelcount = App\Models\Parcel::where('status', $perceltype->id)->count();
                                    ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('percel.manage', $perceltype->slug)); ?>"
                                            class="nav-link <?php echo e(request()->is('superadmin/percel/percel-manage/' . $perceltype->slug . '') ? 'active' : ''); ?>"
                                            aria-expanded="false"> Parcel <?php echo e($perceltype->title); ?>

                                            (<?php echo e($percelcount); ?>)
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery_charge')): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/delivery-charge/dc*') ? 'active' : ''); ?> <?php echo e(request()->is('superadmin/delivery-charge/dc*') ? 'active' : ''); ?>"
                            href="#delivery_charge" data-bs-toggle="collapse" role="button"
                            aria-expanded="<?php echo e(request()->is('superadmin/delivery-charge/dc*') ? 'true' : 'false'); ?>"
                            aria-controls="delivery_charge">
                            <i class="las la-money-bill"></i> <span
                                data-key="t-pages"><?php echo e(__('lang.delivery_charge')); ?></span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/delivery-charge/dc*') ? 'show' : ''); ?>"
                            id="delivery_charge">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('dc.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/delivery-charge/dc/deliverycharge-manage') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        <?php echo e(__('lang.delivery_charge')); ?> </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('dcp.index')); ?>"
                                        class="nav-link  <?php echo e(request()->is('superadmin/delivery-charge/dcp/delivery-charge-package-manage') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        <?php echo e(__('lang.delivery_package_charge')); ?> </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment')): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/payments*') ? 'active' : ''); ?> <?php echo e(request()->is('superadmin/payments*') ? 'active' : ''); ?>"
                            href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarPages">
                            <i data-feather="dollar-sign" class="dollar-sign"></i> <span data-key="t-pages">Payments</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/payments*') ? 'show' : ''); ?>"
                            id="sidebarPages">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('payment.merchant.due.show')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/payments/merchant-due-payment-show') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Merchant Payments </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?php echo e(route('payments.deliveryman.index')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/payments/deliveryman-payments') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Deliveryman Payments </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('payment.pickupman.index')); ?>"
                                        class="nav-link  <?php echo e(request()->is('superadmin/payments/pickupman-payments') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Pickupman Payments </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('payment.agent.index')); ?>"
                                        class="nav-link  <?php echo e(request()->is('superadmin/payments/agent-payments') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Agent Payments </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('report')): ?>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/report*') ? 'active' : ''); ?>"
                            href="#reports" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="reports">
                            <i data-feather="file-text" class="file-text"></i> <span data-key="t-pages">Reports</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/report*') ? 'show' : ''); ?>"
                            id="reports">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('report.summary')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/report/summary') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Summary Reports </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('report.merchant')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/report/merchant') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Merchant Reports </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('report.agent')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/report/agent') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Agent Reports </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('report.deliveryman')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/report/deliveryman') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Deliveryman Reports </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('report.pickupman')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/report/pickupman') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Pickupman Reports </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e(request()->is('superadmin/import/dc*') ? 'active' : ''); ?>"
                        href="#import" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="import">
                        <i class="bx bx-import"></i> <span data-key="t-pages">Import</span>
                    </a>
                    <div class="collapse menu-dropdown" id="import">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="<?php echo e(route('admin.import.parcel')); ?>" class="nav-link" data-key="t-starter">
                                    Import Percel </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('hr')): ?>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Human
                            Resource</span>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/merchant*') ? 'active' : ''); ?>"
                            href="#merchants" data-bs-toggle="collapse" role="button"
                            aria-expanded="<?php echo e(request()->is('superadmin/merchant*') ? 'true' : 'false'); ?>"
                            aria-controls="merchants">
                            <i data-feather="users" class="icon-dual"></i> <span data-key="t-base-ui">Merchant</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/merchant*') ? 'show' : ''); ?>"
                            id="merchants">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('merchant.create')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/merchant/merchant-create') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Merchant Create </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('merchant.manage')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/merchant/merchant-manage') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Manage Merchant </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/deliveryman*') ? 'active' : ''); ?>"
                            href="#deliveryman" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="deliveryman">
                            <i data-feather="truck" class="icon-dual"></i> <span data-key="t-base-ui">Deliveryman</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/deliveryman*') ? 'show' : ''); ?>"
                            id="deliveryman">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('deliveryman.create')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/deliveryman/deliveryman-create') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Deliveryman Create </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('deliveryman.manage')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/deliveryman/deliveryman-manage') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Manage Deliveryman </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/pickupman*') ? 'active' : ''); ?>"
                            href="#pickupman" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="pickupman">
                            <i data-feather="box" class="icon-dual"></i> <span data-key="t-base-ui">Pickupmans</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/pickupman*') ? 'show' : ''); ?>"
                            id="pickupman">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('pickupman.create')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/pickupman/pickupman-create') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Pickupman Create </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('pickupman.manage')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/pickupman/pickupman-manage') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Manage Pickupmans </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/employee*') ? 'active' : ''); ?>"
                            href="#employees" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="employees">
                            <i data-feather="briefcase" class="icon-dual"></i> <span
                                data-key="t-base-ui">Employees</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/employee*') ? 'show' : ''); ?>"
                            id="employees">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('employee.create')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/employee/employee-create') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Employee Create </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('employee.manage')); ?> <?php echo e(request()->is('superadmin/employee/employee-manage') ? 'active' : ''); ?>"
                                        class="nav-link" data-key="t-starter">
                                        Manage Employee </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/agent*') ? 'active' : ''); ?>"
                            href="#agents" data-bs-toggle="collapse" role="button"
                            aria-expanded="<?php echo e(request()->is('superadmin/agent*') ? 'true' : 'false'); ?>"
                            aria-controls="agents">
                            <i data-feather="rss" class="icon-dual"></i> <span data-key="t-base-ui">Data Entry</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/agent*') ? 'show' : ''); ?>"
                            id="agents">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('agent.create')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/agent/agent-create') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Data Entry Create </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('agent')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/agent/agent') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Manage Data Entry </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/attendence*') ? 'active' : ''); ?>"
                            href="#attendence" data-bs-toggle="collapse" role="button"
                            aria-expanded="<?php echo e(request()->is('superadmin/attendence*') ? 'true' : 'false'); ?>"
                            aria-controls="attendence">
                            <i data-feather="file-plus" class="icon-dual"></i> <span
                                data-key="t-base-ui">Attendence</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/attendence*') ? 'show' : ''); ?>"
                            id="attendence">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('attendence.create')); ?>"
                                        class="nav-link <?php echo e(request()->is('superadmin/attendence/take-attendence') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Take Attendence </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('attendence.index')); ?>"
                                        class="nav-link  <?php echo e(request()->is('superadmin/attendence/manage-attendence') ? 'active' : ''); ?>"
                                        data-key="t-starter">
                                        Manage Attendence </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/employee-salary*') ? 'active' : ''); ?>"
                            href="#salary" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="salary">
                            <i data-feather="aperture" class="icon-dual"></i> <span data-key="t-base-ui">
                                Salary</span>
                        </a>
                        <div class="collapse menu-dropdown <?php echo e(request()->is('superadmin/employee-salary*') ? 'show' : ''); ?>"
                            id="salary">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('employee.salary.sheet')); ?>"
                                        class="nav-link { (request()->is('superadmin/employee-salary-sheet')) ? 'active' : '' }}"
                                        data-key="t-starter">
                                        Salary </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('employee.salary.create')); ?>"
                                        class="nav-link { (request()->is('superadmin/employee-create-salary')) ? 'active' : '' }}"
                                        data-key="t-starter">
                                        Create Salary </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('employee.advance.salary.create')); ?>"
                                        class="nav-link { (request()->is('superadmin/employee-advance-salary')) ? 'active' : '' }}"
                                        data-key="t-starter">
                                        Advance Salary </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('area_panel')): ?>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Area Control</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/areas*') ? 'active' : ''); ?>"
                            href="#areas" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="areas">
                            <i data-feather="globe" class="icon-dual"></i> <span data-key="t-base-ui">Areas</span>
                        </a>
                        <div class="collapse menu-dropdown mega-dropdown-menu <?php echo e(request()->is('superadmin/areas*') ? 'show' : ''); ?>"
                            id="areas">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('division.index')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/areas/division') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Division</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('district.index')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/areas/district') ? 'active' : ''); ?>"
                                                data-key="t-alerts">District</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('thana.index')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/areas/thana') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Thana</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('area.index')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/areas/area') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Area</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('area.import')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/areas/import-areas') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Import Areas</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('panel_user')): ?>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">User Control</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/users*') ? 'active' : ''); ?>"
                            href="#users" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="users">
                            <i data-feather="user-plus" class="icon-dual"></i> <span data-key="t-base-ui">Users</span>
                        </a>
                        <div class="collapse menu-dropdown mega-dropdown-menu  <?php echo e(request()->is('superadmin/users*') ? 'show' : ''); ?>"
                            id="users">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul class="nav nav-sm flex-column">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user_add')): ?>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('users.create')); ?>"
                                                    class="nav-link  <?php echo e(request()->is('superadmin/users/users-create') ? 'active' : ''); ?>"
                                                    data-key="t-alerts">Add User</a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('panel_user')): ?>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('users.manage')); ?>"
                                                    class="nav-link <?php echo e(request()->is('superadmin/users/users') ? 'active' : ''); ?>"
                                                    data-key="t-alerts">Manage</a>
                                            </li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bulk_sms')): ?>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Short Message
                            Service</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/sms*') ? 'active' : ''); ?>"
                            href="#sms" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sms">
                            <i data-feather="message-circle" class="icon-dual"></i> <span data-key="t-base-ui">SMS</span>
                        </a>
                        <div class="collapse menu-dropdown mega-dropdown-menu <?php echo e(request()->is('superadmin/sms*') ? 'show' : ''); ?> "
                            id="sms">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul class="nav nav-sm flex-column">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('send_sms')): ?>
                                            <li class="nav-item">
                                                <a href="<?php echo e(route('sms.manage')); ?>"
                                                    class="nav-link <?php echo e(request()->is('superadmin/sms/sms') ? 'active' : ''); ?>"
                                                    data-key="t-alerts">SMS</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Accounts
                        Management</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo e(request()->is('superadmin/accounts*') ? 'active' : ''); ?>"
                        href="#sidebarUI" data-bs-toggle="collapse" role="button" aria-expanded="false"
                        aria-controls="sidebarUI">
                        <i data-feather="pie-chart" class="icon-dual"></i> <span data-key="t-base-ui">Accounts</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu  <?php echo e(request()->is('superadmin/accounts*') ? 'show' : ''); ?>"
                        id="sidebarUI">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li
                                        class="nav-item  <?php echo e(request()->is('superadmin/accounts/income*') ? 'active' : ''); ?>">
                                        <a href="#income" class="nav-link" data-bs-toggle="collapse" role="button"
                                            aria-expanded="true" aria-controls="income"
                                            data-key="t-level-1.2">Incomes</a>
                                        <div class="menu-dropdown collapse <?php echo e(request()->is('superadmin/accounts/income*') ? 'show' : ''); ?>"
                                            id="income" style="">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('income.head.index')); ?>"
                                                        class="nav-link <?php echo e(request()->is('superadmin/accounts/income/income-head') ? 'active' : ''); ?>">Income
                                                        Category</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('income.index')); ?>"
                                                        class="nav-link  <?php echo e(request()->is('superadmin/accounts/income/income') ? 'active' : ''); ?>">Incomes</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-item <?php echo e(request()->is('superadmin/accounts/expense*') ? 'active' : ''); ?>">
                                        <a href="#expense" class="nav-link" data-bs-toggle="collapse" role="button"
                                            aria-expanded="true" aria-controls="expense"
                                            data-key="t-level-1.2">Expense</a>
                                        <div class="menu-dropdown collapse <?php echo e(request()->is('superadmin/accounts/expense*') ? 'show' : ''); ?>"
                                            id="expense" style="">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('expense.head.index')); ?>"
                                                        class="nav-link <?php echo e(request()->is('superadmin/accounts/expense/expense-head') ? 'active ' : ''); ?>">Expense
                                                        Category</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('expense.index')); ?>"
                                                        class="nav-link <?php echo e(request()->is('superadmin/accounts/expense/expense') ? 'active ' : ''); ?>">Expenses</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-item <?php echo e(request()->is('superadmin/accounts/deliveryman-expense*') ? 'active' : ''); ?>">
                                        <a href="#deliveryman_expense" class="nav-link" data-bs-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="deliveryman_expense"
                                            data-key="t-level-1.2">Deliveryman Expense</a>
                                        <div class="menu-dropdown collapse <?php echo e(request()->is('superadmin/accounts/deliveryman-expense*') ? 'show' : ''); ?>"
                                            id="deliveryman_expense" style="">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('dman.expense.create')); ?>"
                                                        class="nav-link <?php echo e(request()->is('superadmin/accounts/deliveryman-expense/expense-create') ? 'active ' : ''); ?>">Add
                                                        Deliveryman Expense</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('dman.expense.index')); ?>"
                                                        class="nav-link <?php echo e(request()->is('superadmin/accounts/deliveryman-expense/expense') ? 'active ' : ''); ?>">Deliveryman
                                                        Expenses</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-item <?php echo e(request()->is('superadmin/accounts/pickupman-expense*') ? 'active' : ''); ?>">
                                        <a href="#pickupman_expense" class="nav-link" data-bs-toggle="collapse"
                                            role="button" aria-expanded="true" aria-controls="pickupman_expense"
                                            data-key="t-level-1.2">Pickupman Expense</a>
                                        <div class="menu-dropdown collapse <?php echo e(request()->is('superadmin/accounts/pickupman-expense*') ? 'show' : ''); ?>"
                                            id="pickupman_expense" style="">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('pman.expense.create')); ?>"
                                                        class="nav-link <?php echo e(request()->is('superadmin/accounts/pickupman-expense/expense-create') ? 'active ' : ''); ?>">Add
                                                        Pickupman Expense</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="<?php echo e(route('pman.expense.index')); ?>"
                                                        class="nav-link <?php echo e(request()->is('superadmin/accounts/pickupman-expense/expense') ? 'active ' : ''); ?>">pickupman
                                                        Expenses</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('accounts.trial.balance')); ?>"
                                            class="nav-link  <?php echo e(request()->is('superadmin/accounts/trial-balance') ? 'active ' : ''); ?>"
                                            data-key="t-alerts">Trial Balance</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('accounts.ledger')); ?>"
                                            class="nav-link <?php echo e(request()->is('superadmin/accounts/ledger') ? 'active ' : ''); ?>"
                                            data-key="t-alerts">Profit & Loss</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('accounts.cash.book')); ?>"
                                            class="nav-link <?php echo e(request()->is('superadmin/accounts/cash-book') ? 'active ' : ''); ?>"
                                            data-key="t-alerts">Cashbook</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('setting')): ?>
                    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Site
                            Settings</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link <?php echo e(request()->is('superadmin/settings*') ? 'active' : ''); ?>"
                            href="#settings" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="settings">
                            <i data-feather="settings" class="icon-dual"></i> <span data-key="t-base-ui">Settings</span>
                        </a>
                        <div class="collapse menu-dropdown mega-dropdown-menu <?php echo e(request()->is('superadmin/settings*') ? 'show' : ''); ?>"
                            id="settings">
                            <div class="row">
                                <div class="col-lg-4">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('site.settings')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/settings/settings') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Settings</a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('slider.index')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/settings/sliders') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Sliders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('feature.index')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/settings/features') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Features</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('hub.index')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/settings/hub/hub') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Hub Areas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('service.index')); ?>"
                                                class="nav-link <?php echo e(request()->is('superadmin/settings/services/services') ? 'active' : ''); ?>"
                                                data-key="t-alerts">Services</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<?php /**PATH F:\MIM Larvel\Mohuya Courier\MohuyaCourierService\resources\views/backend/layouts/sidebar.blade.php ENDPATH**/ ?>