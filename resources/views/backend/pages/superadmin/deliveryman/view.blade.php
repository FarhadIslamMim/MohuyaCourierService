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
                        <img src="{{ asset($deliveryman->image) }}" alt="user-img" class="img-thumbnail rounded-circle" />
                    </div>
                </div>
                <!--end col-->
                <div class="col">
                    <div class="p-2">
                        <h3 class="text-white mb-1">{{ $deliveryman->name }}</h3>
                        <p class="text-white-75">Deliveryman</p>
                        <div class="hstack text-white-50 gap-1">
                            <div class="me-2"><i
                                    class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ $deliveryman->present_address }}
                            </div>
                            <div>
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
                        </ul>
                        <div class="flex-shrink-0">
                            <a href="{{ route('deliveryman.edit', $deliveryman->id) }}" class="btn btn-success"><i
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
                                                            <td class="text-muted">{{ $deliveryman->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Mobile :</th>
                                                            <td class="text-muted">{{ $deliveryman->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">E-mail :</th>
                                                            <td class="text-muted">{{ $deliveryman->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Location :</th>
                                                            <td class="text-muted">{{ $deliveryman->present_address }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="ps-0" scope="row">Joining Date</th>
                                                            <td class="text-muted">
                                                                {{ date('d-m-Y', strtotime($deliveryman->created_at)) }}
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
                                                @foreach ($deliveryman->agentDetails() ?? [] as $agent)
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

                                            @foreach ($deliveryman->areaDetails() as $area)
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
                                    @if (count($deliveryman->educations) > 0)
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
                                                @foreach ($deliveryman->educations ?? [] as $education)
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
                                    @else
                                        <div class="alert alert-info">
                                            <p>Education is empty</p>
                                        </div>
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
                                    <h5 class="card-title mb-3">Experience</h5>
                                    @if (count($deliveryman->experiences) > 0)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-left"> Company Name</th>
                                                    <th class="text-left"> Designation</th>
                                                    <th class="text-left"> Date from </th>
                                                    <th class="text-left"> Date to </th>
                                                </tr>
                                            </thead>
                                            <tbody id="education_container">
                                                @foreach ($deliveryman->experiences ?? [] as $experience)
                                                    <tr class="education_item">
                                                        <td class="text-left">
                                                            {{ $experience->company_name }}
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $experience->designation }}
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $experience->start_date }}
                                                        </td>
                                                        <td class="text-left">
                                                            {{ $experience->end_date }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-info">
                                            <p>Experience is empty</p>
                                        </div>
                                    @endif

                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
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
