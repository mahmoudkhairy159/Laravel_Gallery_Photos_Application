<?php

namespace App\Http\Controllers\Website;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Website\Photo\SharePhotoRequest;
use App\Http\Requests\Website\Photo\StorePhotoRequest;
use App\Http\Requests\Website\Photo\UpdatePhotoRequest;
use App\Notifications\PhotoLikedNotification;
use App\Repositories\PhotoLikeRepository;
use App\Repositories\PhotoRepository;
use App\resources\Website\Photo\PhotoCollection;
use App\resources\Website\Photo\PhotoResource;


class PhotoController extends Controller
{


    protected $photoRepository;
    protected $photoLikeRepository;

    protected $_config;
    protected $guard;
    protected $per_page;

    public function __construct(PhotoRepository $photoRepository, PhotoLikeRepository $photoLikeRepository)
    {
        $this->guard = 'user-api';
        request()->merge(['token' => 'true']);
        Auth::setDefaultDriver($this->guard);
        $this->_config = request('_config');
        $this->photoRepository = $photoRepository;
        $this->photoLikeRepository = $photoLikeRepository;
        $this->per_page = config('pagination.default');
        // permissions
        $this->middleware('auth:' . $this->guard)->except([
            'index',
            'getTrendingPhotos',
            'getByUserId',
            'show',
            'showBySlug'
        ]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            if (!auth()->guard($this->guard)->check()) {
                request()->merge(['page' => 1]);
            }
            $data = $this->photoRepository->getAllActive()->paginate($this->per_page);
            // return $this->successResponse(new PhotoCollection($data));
        } catch (Exception $e) {
            return $this->errorResponse(
                [$e->getMessage(), $e->getCode()],
                __('app.something-went-wrong'),
                500
            );
        }
    }

    /**
     * Display a ttrending listing of the resource.
     */
    public function getTrendingPhotos()
    {
        try {
            if (!auth()->guard($this->guard)->check()) {
                request()->merge(['page' => 1]);
            }
            $data = $this->photoRepository->getTrending()->paginate($this->per_page);
            // return $this->successResponse(new PhotoCollection($data));
        } catch (Exception $e) {
            return $this->errorResponse(
                [$e->getMessage(), $e->getCode()],
                __('app.something-went-wrong'),
                500
            );
        }
    }

    public function getByUserId($user_id)
    {
        try {
            if (!auth()->guard($this->guard)->check()) {
                request()->merge(['page' => 1]);
            }
            $data = $this->photoRepository->getActivePhotosByUserId($user_id)->paginate($this->per_page);
            // return $this->successResponse(new PhotoCollection($data));
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }
    public function getMyPhotos()
    {
        try {
            $user_id = auth()->guard($this->guard)->id();
            $ownedPhotos = $this->photoRepository->getActivePhotosByUserId($user_id)->paginate($this->per_page);
            // return $this->successResponse(new PhotoCollection($ownedPhotos));
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        try {
            $data =  $request->validated();
            $data['user_id'] = auth()->guard($this->guard)->id();
            $created = $this->photoRepository->createOne($data);
            // if ($created) {
            //     return $this->successResponse(
            //         new PhotoResource($created),
            //         __('photo.photos.created-successfully'),
            //         201
            //     );
            // } {
            //     return $this->messageResponse(
            //         __('photo.photos.created-failed'),
            //         false,
            //         400
            //     );
            // }
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            $data = $this->photoRepository->getActiveOneById($id);
            if (!$data) {
                return $this->messageResponse(
                    __('app.data-not-found'),
                    false,
                    404
                );
            }
            // return $this->successResponse(new PhotoResource($data));
        } catch (Exception $e) {
            dd($e->getMessage());
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, $id)
    {
        try {
            $data =  $request->validated();
            $updated = $this->photoRepository->updateOne($data, $id);

            // if ($updated) {
            //     return $this->successResponse(
            //         new PhotoResource($updated),
            //         __('photo.photos.updated-successfully'),
            //         200
            //     );
            // } {
            //     return $this->messageResponse(
            //         __('photo.photos.updated-failed'),
            //         false,
            //         400
            //     );
            // }
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $deleted = $this->photoRepository->deleteOne($id);

            // if ($deleted) {
            //     return $this->messageResponse(
            //         __('photo.photos.deleted-successfully'),
            //         true,
            //         200
            //     );
            // } {
            //     return $this->messageResponse(
            //         __('photo.photos.deleted-failed'),
            //         false,
            //         400
            //     );
            // }
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }
    /**
     * like Or Dislike the specified resource from storage.
     */
    public function likeOrDislike($photo_id)
    {
        try {
            $updated = $this->photoLikeRepository->likeOrDislike($photo_id);
            // if ($updated) {
            //     return $this->messageResponse(
            //         __('photo.photos.reaction-saved-successfully'),
            //         true,
            //         200
            //     );
            // } {

            //     return $this->messageResponse(
            //         __('photo.photos.reaction-saved-failed'),
            //         false,
            //         400
            //     );
            // }
        } catch (Exception $e) {
            // dd($e->getMessage());

            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }

    /**
     * share the specified resource from storage.
     */
    public function share(SharePhotoRequest $request, $photo_id)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            $shared = $this->photoRepository->share($data, $photo_id);
            // if ($shared) {
           
            //     return $this->successResponse(
            //         new PhotoResource($shared),
            //         __('photo.photos.shared-successfully'),
            //         200
            //     );
            // } {
            //     return $this->messageResponse(
            //         __('photo.photos.shared-failed'),
            //         false,
            //         400
            //     );
            // }
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }
}
