@extends('user.layouts.layoutMaster')

@section('title', 'Create New Task')

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
                        <a href="{{ route('user.tasks.index') }}">Tasks Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Create Task</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card mb-4">
        <h5 class="card-header">Create Task</h5>
        <form class="card-body" action="{{ route('user.tasks.store') }}" method="Photo" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="title">Task Title <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <input type="text" value="{{ old('title') }}" name="title" id="title"
                        class="form-control @error('title') is-invalid @enderror" placeholder="Enter Task Title" required />
                    @error('title')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="description">Description</label>
                <div class="col-sm-9">
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Enter Task Description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="due_date">Due Date</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-merge">
                        <input type="text" name="due_date" id="bs-datepicker-basic" placeholder="MM/DD/YYYY"
                            class="form-control @error('due_date') is-invalid @enderror" />
                    </div>
                    @error('due_date')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="reminder_time">Reminder Time</label>
                <div class="col-sm-9">
                    <div class="input-group input-group-merge">
                        <input type="text" name="reminder_time" id="flatpickr-datetime" placeholder="MM/DD/YYYY"
                            class="form-control flatpickr-datetime @error('reminder_time') is-invalid @enderror" />
                    </div>
                    @error('reminder_time')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="priority">Priority <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror"
                        required>
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="status">Status <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                        required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <div class="text-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" for="Category">Category<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                    <select id="category_id" name="category_id"
                        class="select2 form-select form-select-lg category_id @error('category_id') is-invalid @enderror"
                        data-allow-clear="true">
                        <option value="" selected>-- No Category --</option> <!-- Allow empty selection -->
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
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
