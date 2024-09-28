@extends('user/layouts/layoutMaster')

@section('title', 'User Profile - Profile')

{{-- Vendor CSS --}}
@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
@endsection

{{-- Page-specific CSS --}}
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}">
@endsection

{{-- Vendor JS --}}
@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

{{-- Page-specific JS --}}
@section('page-script')
    <script src="{{ asset('assets/js/pages-profile.js') }}"></script>
@endsection

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">
                            <span class="menu-icon tf-icons ti ti-smart-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset('assets/admin/img/pages/profile-banner.png') }}" alt="Banner image"
                        class="rounded-top">
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img src="{{ $item->image_url ?? asset('assets/admin/img/avatars/default.png') }}" alt="User Image"
                            class="d-block ms-0 ms-sm-4 rounded user-profile-img"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ $item->name }}</h4>

                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary">
                                <i class='ti ti-user-check me-1'></i>Connected
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar  Section -->
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);">
                        <i class='ti-xs ti ti-user-check me-1'></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.categories.index') }}">
                        <i class='ti-xs ti ti-layout-grid me-1'></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.tasks.index') }}">
                        <i class='ti-xs ti ti-link me-1'></i> Tasks
                    </a>
                </li>


                <!-- Update Profile -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#updateProfileModal">
                        <i class='ti-xs ti ti-users me-1'></i> Edit Profile
                    </a>
                </li>
                @include('user.user.modals.update_profile_modal')


                <!-- Change Password  -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal">
                        <i class='ti-xs ti ti-layout-grid me-1'></i> Change Password
                    </a>
                </li>
                @include('user.user.modals.change_password_modal')
                <!-- Update Profile Image  -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#updateProfileImageModal">
                        <i class='ti-xs ti ti-layout-grid me-1'></i> Edit Profile Image
                    </a>
                </li>
                @include('user.user.modals.update_profile_image_modal')



                <!-- Delete Profile Image  -->
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal"
                        data-bs-target="#deleteProfileImageModal">
                        <i class='ti-xs ti ti-layout-grid me-1'></i> Delete Profile Image
                    </a>
                </li>

                @include('user.user.modals.delete_profile_image_modal')





            </ul>
        </div>
    </div>

    <!-- User Profile Content Section -->
    <div class="row">
        <div class="col-xl-12 col-lg-5 col-md-5">
            <!-- About User Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span> {{ $item->name }}
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span>{{ $item->email }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Profile Overview Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text text-uppercase">Overview</p>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-check"></i><span class="fw-bold mx-2">Total Categories:</span>
                            {{ $item->categories_count }}
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-check"></i><span class="fw-bold mx-2">Total Tasks:</span>
                            {{ $item->tasks_count }}
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-check"></i><span class="fw-bold mx-2">Pending Tasks:</span>
                            {{ $taskCounts['pending'] ?? 0 }}
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-check"></i><span class="fw-bold mx-2">In Progress Tasks::</span>
                            {{ $taskCounts['in_progress'] ?? 0 }}
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="ti ti-check"></i><span class="fw-bold mx-2">Completed
                                Tasks:</span>{{ $taskCounts['completed'] ?? 0 }}
                        </li>


                    </ul>
                </div>
            </div>
        </div>


    </div>
@endsection
