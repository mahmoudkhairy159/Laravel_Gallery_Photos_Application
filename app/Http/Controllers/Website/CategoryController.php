<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Category\StoreCategoryRequest;
use App\Http\Requests\Website\Category\UpdateCategoryRequest;
use App\Http\Requests\Website\Category\UpdateCategoryStatusRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{

    protected $_config;
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->_config = request('_config');
        $this->categoryRepository = $categoryRepository;
        $this->middleware('auth');
    }

    public function index()
    { if (request()->has('clear_filters')) {
        return redirect()->route($this->_config['redirect']);
    }
        $userId = auth()->id();
        $items = $this->categoryRepository->getByUserId($userId)->paginate();
        return view($this->_config['view'], compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $created =  $this->categoryRepository->create($data);

        if (!$created) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Category Created SuccessFully');
        return redirect()->back();
        // return redirect()->route($this->_config['redirect']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userId = auth()->id();
        if (request()->has('clear_filters')) {
            return redirect()->route($this->_config['redirect'],$id);
        }
        $item = $this->categoryRepository->where('user_id', $userId)
            ->with(['tasks' => function ($query) {
                $query->filter(request()->all());
            }])
            ->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], ['item' => $item, 'tasks' => $item->tasks]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userId = auth()->id();
        $item = $this->categoryRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $userId = auth()->id();
        $item = $this->categoryRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        $data = $request->validated();

        $updated =  $this->categoryRepository->update($data, $id);
        if (!$updated) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Category Updated SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = auth()->id();
        $item = $this->categoryRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        $deleted =  $this->categoryRepository->delete($id);
        if (!$deleted) {
            request()->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        request()->session()->put('success', 'Category Deleted SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }
}
