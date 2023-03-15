@extends('backend.layouts.master')
@section('title', 'Profile')
@section('custom-styles')
@endsection
@section('main-content')
    <div class="container-fluid">
        <div class="profile-foreground position-relative mx-n4 mt-n4">
            <div class="profile-wid-bg">
                <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
            </div>
        </div>
        <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
            <div class="row g-4">
                <div class="col-auto">
                    <div class="avatar-lg">
                        <img src="{{ asset($employee->image) }}" alt="user-img" class="img-thumbnail rounded-circle" />
                    </div>
                </div>
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1">{{ $employee->name }}</h3>
                        <p class="text-white-75">employee</p>
                        <div class="hstack text-white-50 gap-1">
                            <div class="me-2"><i
                                    class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ $employee->present_address }}
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-12 col-lg-auto order-last order-lg-0">
                    <div class="row text text-white-50 text-center">
                        <div class="col-lg-6 col-4">
                            <div class="p-2">
                                <h4 class="text-white mb-1">24.3K</h4>
                                <p class="fs-14 mb-0">Followers</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-4">
                            <div class="p-2">
                                <h4 class="text-white mb-1">1.3K</h4>
                                <p class="fs-14 mb-0">Following</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->

            </div>
            <!--end row-->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div>
                    <div class="d-flex">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Overview</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Educations</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab">
                                    <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Working Experience</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                    <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span
                                        class="d-none d-md-inline-block">Gurantor Information</span>
                                </a>
                            </li>
                        </ul>
                        <div class="flex-shrink-0">
                            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-success"><i
                                    class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content pt-4 text-muted">
                        <div class="tab-pane active" id="overview-tab" role="tabpanel">
                            <div class="row">
                                <div class="col-xxl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-3">Info</h5>
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Full Name :</th>
                                                            <td class="text-muted">{{ $employee->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Mobile :</th>
                                                            <td class="text-muted">{{ $employee->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">E-mail :</th>
                                                            <td class="text-muted">{{ $employee->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Location :</th>
                                                            <td class="text-muted">{{ $employee->present_address }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Joining Date</th>
                                                            <td class="text-muted">
                                                                {{ date('d-m-Y', strtotime($employee->created_at)) }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->



                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">Agents</h5>
                                            <div class="d-flex flex-wrap gap-2 fs-15">
                                                @foreach ($employee->agentDetails() ?? [] as $agent)
                                                    <span class="badge badge-soft-success">{{ $agent->name }}</span>
                                                @endforeach
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->



                                </div>
                                <!--end col-->
                                <div class="col-xxl-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Assigned Areas</h4>
                                        </div>
                                        <div class="card-body">

                                            @foreach ($employee->areaDetails() as $area)
                                                <span class="badge badge-soft-success">{{ $area->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <div class="tab-pane fade" id="activities" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Educations</h5>
                                    @if ($employee->educations)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-left"> Exam Name</th>
                                                    <th class="text-left"> Group Name </th>
                                                    <th class="text-left"> GPA </th>
                                                    <th class="text-left"> Passing Year </th>
                                                    <th class="text-left"> Board </th>
                                                </tr>
                                            </thead>
                                            <tbody id="education_container">
                                                @foreach ($employee->educations ?? [] as $education)
                                                    <tr class="education_item">
                                                        <td class="text-left">
                                                            {{ $education->exam_name }}
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $education->group }}
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $education->gpa }}
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $education->year }}
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $education->board }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif

                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="projects" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xxl-3 col-sm-6">
                                            <div class="card profile-project-card shadow-none profile-project-primary">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Chat App Update</a>
                                                            </h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">2 year
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-warning fs-10">
                                                                Inprogress</div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-1.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-3.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title rounded-circle bg-light text-primary">
                                                                                J
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div class="card profile-project-card shadow-none profile-project-success">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">ABC Project
                                                                    Customization</a></h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">2 month
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-primary fs-10">
                                                                Progress</div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-8.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-7.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-6.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title rounded-circle bg-primary">
                                                                                2+
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div class="card profile-project-card shadow-none profile-project-info">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Client - Frank
                                                                    Hook</a></h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">1 hr
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-info fs-10">New
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-4.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title rounded-circle bg-light text-primary">
                                                                                M
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-3.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div class="card profile-project-card shadow-none profile-project-primary">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Velzon Project</a>
                                                            </h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">11 hr
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-success fs-10">
                                                                Completed</div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-7.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-5.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div class="card profile-project-card shadow-none profile-project-success">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Brand Logo Design</a>
                                                            </h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">10 min
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-info fs-10">New
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-7.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-6.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title rounded-circle bg-light text-primary">
                                                                                E
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div class="card profile-project-card shadow-none profile-project-info">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Chat App</a></h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">8 hr
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-warning fs-10">
                                                                Inprogress</div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title rounded-circle bg-light text-primary">
                                                                                R
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-3.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-8.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div class="card profile-project-card shadow-none profile-project-primary">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Project Update</a>
                                                            </h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">48 min
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-warning fs-10">
                                                                Inprogress</div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-6.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-5.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-4.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div class="card profile-project-card shadow-none profile-project-success">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Client - Jennifer</a>
                                                            </h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">30 min
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-primary fs-10">
                                                                Process</div>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-1.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div
                                                class="card profile-project-card shadow-none mb-xxl-0   profile-project-info">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Bsuiness Template -
                                                                    UI/UX design</a></h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">7 month
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-success fs-10">
                                                                Completed</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-2.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-3.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-4.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title rounded-circle bg-primary">
                                                                                2+
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div
                                                class="card profile-project-card shadow-none mb-xxl-0  profile-project-success">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Update Project</a>
                                                            </h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">1 month
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-info fs-10">New
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-7.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid">
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title rounded-circle bg-light text-primary">
                                                                                A
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div
                                                class="card profile-project-card shadow-none mb-sm-0  profile-project-secondary">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">Bank Management
                                                                    System</a></h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">10 month
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-success fs-10">
                                                                Completed</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-7.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-6.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-5.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title rounded-circle bg-primary">
                                                                                2+
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-3 col-sm-6">
                                            <div
                                                class="card profile-project-card shadow-none mb-0  profile-project-primary">
                                                <div class="card-body p-4">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                                            <h5 class="fs-14 text-truncate"><a href="#"
                                                                    class="text-dark">PSD to HTML
                                                                    Convert</a></h5>
                                                            <p class="text-muted text-truncate mb-0">Last
                                                                Update : <span class="fw-semibold text-dark">29 min
                                                                    Ago</span></p>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-2">
                                                            <div class="badge badge-soft-info fs-10">New
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex mt-4">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div>
                                                                    <h5 class="fs-12 text-muted mb-0">
                                                                        Members :</h5>
                                                                </div>
                                                                <div class="avatar-group">
                                                                    <div class="avatar-group-item">
                                                                        <div class="avatar-xs">
                                                                            <img src="assets/images/users/avatar-7.jpg"
                                                                                alt=""
                                                                                class="rounded-circle img-fluid" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div><!-- end card -->
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                            <div class="mt-4">
                                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                                    <li class="page-item disabled">
                                                        <a href="javascript:void(0);" class="page-link"><i
                                                                class="mdi mdi-chevron-left"></i></a>
                                                    </li>
                                                    <li class="page-item active">
                                                        <a href="javascript:void(0);" class="page-link">1</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link">2</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link">3</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link">4</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link">5</a>
                                                    </li>
                                                    <li class="page-item">
                                                        <a href="javascript:void(0);" class="page-link"><i
                                                                class="mdi mdi-chevron-right"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="documents" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                                        <div class="flex-shrink-0">
                                            <input class="form-control d-none" type="file" id="formFile">
                                            <label for="formFile" class="btn btn-primary"><i
                                                    class="ri-upload-2-fill me-1 align-bottom"></i> Upload
                                                File</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-borderless align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col">File Name</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Size</th>
                                                            <th scope="col">Upload Date</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-light text-primary rounded fs-20">
                                                                            <i class="ri-file-zip-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0)"
                                                                                class="link-secondary">Artboard-documents.zip</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>Zip File</td>
                                                            <td>4.57 MB</td>
                                                            <td>12 Dec 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink15" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink15">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-light text-primary rounded fs-20">
                                                                            <i class="ri-file-pdf-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);"
                                                                                class="link-secondary">Bank
                                                                                Management System</a></h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>PDF File</td>
                                                            <td>8.89 MB</td>
                                                            <td>24 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink3" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink3">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-light text-primary rounded fs-20">
                                                                            <i class="ri-video-line"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);"
                                                                                class="link-secondary">Tour-video.mp4</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>MP4 File</td>
                                                            <td>14.62 MB</td>
                                                            <td>19 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink4" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink4">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-light text-primary rounded fs-20">
                                                                            <i class="ri-file-excel-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);"
                                                                                class="link-secondary">Account-statement.xsl</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>XSL File</td>
                                                            <td>2.38 KB</td>
                                                            <td>14 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink5" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink5">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle text-muted"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a>
                                                                        </li>
                                                                        <li class="dropdown-divider"></li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-light text-primary rounded fs-20">
                                                                            <i class="ri-folder-line"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);"
                                                                                class="link-secondary">Project
                                                                                Screenshots Collection</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>Floder File</td>
                                                            <td>87.24 MB</td>
                                                            <td>08 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink6" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink6">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-light text-primary rounded fs-20">
                                                                            <i class="ri-image-2-fill"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0);"
                                                                                class="link-secondary">Velzon-logo.png</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>PNG File</td>
                                                            <td>879 KB</td>
                                                            <td>02 Nov 2021</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-light btn-icon"
                                                                        id="dropdownMenuLink7" data-bs-toggle="dropdown"
                                                                        aria-expanded="true">
                                                                        <i class="ri-equalizer-fill"></i>
                                                                    </a>
                                                                    <ul class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenuLink7">
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-eye-fill me-2 align-middle"></i>View</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="text-center mt-3">
                                                <a href="javascript:void(0);" class="text-primary "><i
                                                        class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i>
                                                    Load more </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end tab-pane-->
                    </div>
                    <!--end tab-content-->
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div><!-- container-fluid -->
@endsection
@section('custom-scripts')
@endsection
