<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Task\StoreTaskRequest;
use App\Http\Requests\Website\Task\UpdateTaskRequest;
use App\Http\Requests\Website\Task\UpdateTaskStatusRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    protected $_config;
    protected $taskRepository;
    protected $categoryRepository;

    public function __construct(TaskRepository $taskRepository,CategoryRepository $categoryRepository)
    {
        $this->_config = request('_config');
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;

        $this->middleware('auth');
    }

    public function index()
    {
        $userId=auth()->id();
        $items = $this->taskRepository->getByUserId($userId)->paginate();
        $categories = $this->categoryRepository->getByUserId($userId)->get();
        return view($this->_config['view'], compact('items','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId=auth()->id();
        $categories = $this->categoryRepository->getByUserId($userId)->get();
        return view($this->_config['view'],compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {

        $data = $request->validated();
        $data['user_id']=auth()->id();
        $created =  $this->taskRepository->create($data);

        if (!$created) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Task Created SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userId = auth()->id();
        $item = $this->taskRepository->getByUserId($userId)->with('category')->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], ['item' => $item, 'category' => $item->category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userId = auth()->id();
        $categories = $this->categoryRepository->getByUserId($userId)->get();
        $item = $this->taskRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], ['item' => $item, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $userId = auth()->id();
        $item = $this->taskRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        $data = $request->validated();

        $updated =  $this->taskRepository->update($data, $id);
        if (!$updated) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Task Updated SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }
    /**
     * Update status of the specified resource in storage.
     */
    public function updateStatus(UpdateTaskStatusRequest $request, string $id)
    {
        $userId = auth()->id();
        $item = $this->taskRepository->where('user_id',$userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        $data = $request->validated();

        $updated =  $this->taskRepository->update($data, $id);
        if (!$updated) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Task Updated SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = auth()->id();
        $item = $this->taskRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        $deleted =  $this->taskRepository->delete($id);
        if (!$deleted) {
            request()->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        request()->session()->put('success', 'Task Deleted SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }
}
