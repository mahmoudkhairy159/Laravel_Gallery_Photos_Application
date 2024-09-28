@extends('user.layouts.layoutMaster')

@section('title', "Task Details")

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1">
    <h1 class="h2">Task Details</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('user.tasks.index') }}" class="btn btn-outline-primary">Back to Task List</a>
            <a href="{{ route('user.tasks.edit', $item->id) }}" class="btn btn-outline-secondary">Edit Task</a>
            <a href="{{ route('user.tasks.create') }}" class="btn btn-outline-success">Create Task</a>
        </div>
    </div>
</div>

<div class="card mb-4">
    <h5 class="card-header">Task Information</h5>
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Title:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext">{{ $item->title }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Description:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext">{{ $item->description }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Due Date:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($item->due_date)->format('d M, Y') }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Reminder Time:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext">{{ $item->reminder_time ? $item->reminder_time : 'N/A' }}</p>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Priority:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext">{{ ucfirst($item->priority) }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Status:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext">{{ ucfirst($item->status) }}</p>
            </div>
        </div>


        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Category:</label>
            <div class="col-sm-9">
                <p class="form-control-plaintext">{{ $category->name??'NA' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
