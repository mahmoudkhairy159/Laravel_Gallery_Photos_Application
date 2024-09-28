<div class="col-lg-12 mb-4 mb-lg-0">
    <div class="card">
        <div class="card">
            <div class="card-header">
                <h5>All Tasks</h5>
                <div class="d-flex align-items-center justify-content-end">
                    <a href="{{ route('user.tasks.create') }}" class="btn btn-primary waves-effect waves-light mx-1">
                        Create Task <i class="ti ti-plus me-0 ti-xs"></i>
                    </a>
                    <button class="btn btn-secondary waves-effect waves-light mx-1" data-bs-toggle="modal"
                        data-bs-target="#createCategoryModal">Create New Category</button>
                </div>

                <!-- Accordion for Filters -->
                <div class="accordion mt-3" id="filterAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFilters">
                            <button class="accordion-button collapsed fw-bold fs-4 py-3 px-5 text-white bg-primary"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilters"
                                    aria-expanded="false" aria-controls="collapseFilters">
                                🔍 Task Filters
                            </button>
                        </h2>
                        <div id="collapseFilters" class="accordion-collapse collapse" aria-labelledby="headingFilters"
                            data-bs-parent="#filterAccordion">
                            <div class="accordion-body">
                                <form action="{{ route('user.tasks.index') }}" method="GET">
                                    <div class="row mt-4">

                                        <!-- Search Filter -->
                                        <div class="row mb-3">
                                            <label class="col-sm-1 col-form-label" for="Search">Title</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ request('search') }}" name="search"
                                                    id="search" class="form-control"
                                                    placeholder="Enter Search Value (title, description)" />
                                            </div>
                                            <!-- Category Filter -->
                                            <label class="col-sm-1 col-form-label" for="Categories">Categories</label>
                                            @if ($categories->count() > 0)
                                                <div class="col-sm-3">
                                                    <select id="selectpickerMultiple" name="categoryIds[]"
                                                        class="selectpicker" data-style="btn-default" multiple
                                                        data-icon-base="ti" data-tick-icon="ti-check text-white">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ request('categoryIds') && in_array($category->id, request('categoryIds')) ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>



                                        <!-- Status Filter -->
                                        <div class="row mb-3">
                                            <label class="col-sm-1 col-form-label" for="Status">Status</label>
                                            <div class="col-sm-3">
                                                <select name="status" id="status" class="form-select">
                                                    <option value="" selected>All</option>
                                                    <option value="pending"
                                                        {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="in_progress"
                                                        {{ request('status') == 'in_progress' ? 'selected' : '' }}>In
                                                        Progress</option>
                                                    <option value="completed"
                                                        {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                </select>
                                            </div>
                                            <!-- Priority Filter -->
                                            <label class="col-sm-1 col-form-label" for="Priority">Priority</label>
                                            <div class="col-sm-3">
                                                <select name="priority" id="priority" class="form-select">
                                                    <option value="" selected>All</option>
                                                    <option value="low"
                                                        {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                                    <option value="medium"
                                                        {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium
                                                    </option>
                                                    <option value="high"
                                                        {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                                                </select>
                                            </div>
                                            <!-- Due Date Filter -->
                                            <label class="col-sm-1 col-form-label" for="DueDate">Due Date</label>
                                            <div class="col-sm-3">
                                                <input type="date" name="due_date" class="form-control"
                                                    value="{{ request('due_date') }}" placeholder="From">
                                            </div>
                                        </div>
                                        <!-- Filter Buttons -->
                                        <div class="row mb-3 justify-content-start">
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                <a href="{{ route('user.tasks.index', ['clear_filters' => 1]) }}"
                                                    class="btn btn-secondary">Clear</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            @if ($items->count() > 0)
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Change Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ Illuminate\Support\Str::limit($item->title, 50) }}</td>
                                    <td>{{ Illuminate\Support\Str::limit($item->description, 50) }}</td>
                                    <td>{{ $item->due_date }}</td>
                                    <td>{{ $item->priority }}</td>
                                    <td>
                                        @if ($item->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($item->status == 'in_progress')
                                            <span class="badge bg-warning">In Progress</span>
                                        @else
                                            <span class="badge bg-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button to Open Modal -->
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#updateStatusModal{{ $item->id }}">
                                            Change Status
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="updateStatusModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateStatusModalLabel">Update Task
                                                            Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('user.tasks.updateStatus', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" id="status" name="status"
                                                                    required>
                                                                    <option value="pending"
                                                                        {{ $item->status == 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                    <option value="in_progress"
                                                                        {{ $item->status == 'in_progress' ? 'selected' : '' }}>
                                                                        In Progress</option>
                                                                    <option value="completed"
                                                                        {{ $item->status == 'completed' ? 'selected' : '' }}>
                                                                        Completed</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="btn-group text-start">
                                        <div class="row justify-content-start align-content-center ">
                                            <div class="col-3">
                                                <a href="{{ route('user.tasks.show', $item->id) }}" class="btn"><i
                                                        class="ti ti-eye ti-sm me-1"></i></a>
                                            </div>
                                            <div class="col-3">
                                                <a href="{{ route('user.tasks.edit', $item->id) }}" class="btn"><i
                                                        class="ti ti-edit ti-sm me-1"></i></a>
                                            </div>
                                            <div class="col-3">
                                                <form action="{{ route('user.tasks.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn"><i
                                                            class="ti ti-trash ti-sm "></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div
                        class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                        {!! $items->appends(request()->query())->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            @else
                <div class="container-xxl container-p-y text-center">
                    <div class="misc-wrapper">
                        <h2 class="mb-1 mx-2">No Tasks Found!</h2>
                    </div>
                </div>
            @endif
        </div>
        <!-- Create Category Modal -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('user.categories.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="name"
                                    placeholder="Enter category name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
