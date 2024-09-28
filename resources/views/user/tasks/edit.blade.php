@extends('user.layouts.layoutMaster')

@section('title', "Edit Task")

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
<script src="{{asset('assets/admin/js/form-layouts.js')}}"></script>
<script src="{{asset('assets/admin/js/forms-pickers.js')}}"></script>
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
                    <a href="{{ route('user.tasks.index') }}">Task Management</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card mb-4">
    <h5 class="card-header">Edit Task</h5>
    <form class="card-body" action="{{ route('user.tasks.update', $item->id) }}" method="Photo" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="task-title">Title <span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <input type="text" value="{{ $item->title }}" name="title" id="task-title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Task Title" />
                @error('title')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="task-description">Description</label>
            <div class="col-sm-9">
                <textarea name="description" id="task-description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Task Description">{{ $item->description }}</textarea>
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
                <input type="text" name="due_date"id="bs-datepicker-basic" class="form-control flatpickr @error('due_date') is-invalid @enderror" placeholder="Select Due Date" value="{{ $item->due_date }}" />
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
                <input type="text" name="reminder_time"  class="form-control  flatpickr-datetime flatpickr @error('reminder_time') is-invalid @enderror" placeholder="Select Reminder Time" value="{{ $item->reminder_time }}" />
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
                <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror">
                    <option value="low" {{ $item->priority == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ $item->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ $item->priority == 'high' ? 'selected' : '' }}>High</option>
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
                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $item->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="category">Category<span class="text-danger">*</span></label>
            <div class="col-sm-9">
                <select id="category_id" name="category_id"
                    class="select2 form-select form-select-lg category_id @error('category_id') is-invalid @enderror"
                    data-allow-clear="true">
                    <option value="" selected>-- No Category --</option> <!-- Allow empty selection -->
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($item->category_id==$category->id) selected @endif>{{
                        $category->name }}</option>
                    @endforeach
                </select>
                @error('job_title')
                <div class="text-danger">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
        </div>


        <div class="pt-4">
            <div class="row justify-content-start">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary me-sm-2 me-1">Update Task</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
