@extends('user.layouts.layoutMaster')

@section('name', 'Category Details')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-1">
        <h1 class="h2">Category Details</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('user.categories.index') }}" class="btn btn-outline-primary">Back to Category List</a>
                <a href="{{ route('user.categories.edit', $item->id) }}" class="btn btn-outline-secondary">Edit Category</a>
                <a href="{{ route('user.categories.create') }}" class="btn btn-outline-success">Create Category</a>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <h5 class="card-header">Category Information</h5>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name:</label>
                <div class="col-sm-9">
                    <p class="form-control-plaintext">{{ $item->name }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card">

        <div class="card">
            <div class="card-header">

                <div class="d-flex align-items-center justify-content-end">
                    <a href="{{ route('user.tasks.create') }}" class="btn btn-primary waves-effect waves-light mx-1">Create
                        Task <i class="ti ti-plus me-0 ti-xs"></i></a>
                </div>
                <form action="">
                    <div class="row my-3">
                        <div class="col-md-6 d-flex">
                            <input type="text" value="{{ request('search') }}" name="search" id="search"
                                class="form-control" placeholder="Search Tasks" />
                            <button type="submit" class="btn btn-primary me-sm-2 me-1">Search</button>
                            <a href="{{ route('user.categories.show', ['id'=>$item->id,'clear_filters' => 1]) }}"class="btn btn-primary me-sm-2 me-1">Clear </a>

                        </div>
                    </div>
                </form>
            </div>
            @if ($tasks->count() > 0)
                <div class="card">
                    <h5 class="card-header">Tasks in this Category</h5>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($task->description, 50) }}</td>
                                        <td>{{ $task->due_date }}</td>
                                        <td>{{ $task->priority }}</td>
                                        <td>{{ $task->status ? 'Completed' : 'Pending' }}</td>
                                        <td>
                                            <a href="{{ route('user.tasks.show', $task->id) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                            <a href="{{ route('user.tasks.edit', $task->id) }}"
                                                class="btn btn-sm btn-secondary">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
            <div class="container-xxl container-p-y text-center">
                <div class="misc-wrapper">
                    <h2 class="mb-1 mx-2">No tasks found for this category!</h2>
                </div>
            </div>
            @endif
        </div>
    @endsection
