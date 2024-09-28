@extends('user.layouts.layoutMaster')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.css') }}" />
@endsection

<!-- Page -->
@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/css/pages/page-profile.css') }}" />
@endsection


@section('vendor-script')
    <script src="{{ asset('assets/admin/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/libs/bloodhound/bloodhound.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/admin/js/pages-profile.js') }}"></script>
    <script src="{{ asset('assets/admin/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/admin/js/forms-typeahead.js') }}"></script>
@endsection

@section('content')
    <div class="row justify-content-start  ">

        <!-- Total Tasks-->
        <div class="col-xl-6 col-md-4 col-6 mb-4 text-center ">
            <a href="{{ route('user.tasks.index') }}">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="badge p-2 bg-label-info mb-2 rounded"><i class="tf-icons ti ti-typography ti-md"></i>
                        </div>
                        <h5 class="card-title mb-1 pt-2">Total Tasks</h5>
                        <p class="mb-2 mt-1">{{ number_format($statisticsCount['tasks_count']) }}</p>
                    </div>
            </a>
        </div>
    </div>
    <!-- Total Tasks-->
    <!-- Total Categories-->
    <div class="col-xl-6 col-md-4 col-6 mb-4 text-center ">
        <a href="{{ route('user.categories.index') }}">
            <div class="card h-100">
                <div class="card-body">
                    <div class="badge p-2 bg-label-info mb-2 rounded"><i class="tf-icons ti ti-typography ti-md"></i>
                    </div>
                    <h5 class="card-title mb-1 pt-2">Total Categories</h5>
                    <p class="mb-2 mt-1">{{ number_format($statisticsCount['categories_count']) }}</p>
                </div>
        </a>
    </div>
    </div>
    <!-- Total Categories-->

    </div>


    <div class="row mt-3">

        <!-- Last Job Openings -->
        @include('user.dashboard.last_tasks')
        <!-- Last Job Openings -->

    </div>






@endsection
