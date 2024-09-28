<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Photo\StorePhotoRequest;
use App\Http\Requests\Website\Photo\UpdatePhotoRequest;
use App\Repositories\PhotoRepository;

class PhotoController extends Controller
{

    protected $_config;
    protected $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->_config = request('_config');
        $this->photoRepository = $photoRepository;

        $this->middleware('auth');
    }

    public function index()
    {
        $userId=auth()->id();
        $items = $this->photoRepository->getByUserId($userId)->paginate();
        return view($this->_config['view'], compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId=auth()->id();
        return view($this->_config['view']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {

        $data = $request->validated();
        $data['user_id']=auth()->id();
        $created =  $this->photoRepository->create($data);

        if (!$created) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Photo Created SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userId = auth()->id();
        $item = $this->photoRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userId = auth()->id();
        $item = $this->photoRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        return view($this->_config['view'], ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, string $id)
    {
        $userId = auth()->id();
        $item = $this->photoRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        $data = $request->validated();

        $updated =  $this->photoRepository->update($data, $id);
        if (!$updated) {
            $request->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        $request->session()->put('success', 'Photo Updated SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userId = auth()->id();
        $item = $this->photoRepository->getByUserId($userId)->find($id);
        if (!$item) {
            return abort(404);
        }
        $deleted =  $this->photoRepository->delete($id);
        if (!$deleted) {
            request()->session()->put('error', 'Something Went Wrong');
            return redirect()->back();
        }
        request()->session()->put('success', 'Photo Deleted SuccessFully');
        return redirect()->route($this->_config['redirect']);
    }
}
