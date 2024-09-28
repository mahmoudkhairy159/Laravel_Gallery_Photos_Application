@extends('user.layouts.layoutMaster')

@section('name', 'Create New Category')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/admin/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/pickr/pickr-themes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/admin/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/pickr/pickr.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/admin/js/form-layouts.js') }}"></script>
    <script src="{{ asset('assets/admin/js/forms-pickers.js') }}"></script>
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.categories.index') }}">Categories Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create Category</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card mb-4">
        <h5 class="card-header">Create Category</h5>
        <form class="card-body" action="{{ route('user.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="name">Category Name <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" value="{{ old('name') }}" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter Category Name" required />
                    @error('name')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            

            <div class="pt-4">
                <div class="row justify-content-start">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary me-sm-2 me-1">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
