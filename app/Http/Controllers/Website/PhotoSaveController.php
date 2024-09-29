<?php

namespace App\Http\Controllers\Website;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PhotoRepository;
use App\Repositories\PhotoSaveRepository;

class PhotoSaveController extends Controller
{


    protected $photoSaveRepository;
    protected $photoRepository;

    protected $_config;
    protected $guard;

    public function __construct(PhotoSaveRepository $photoSaveRepository, PhotoRepository $photoRepository)
    {
        $this->guard = 'user-api';
        request()->merge(['token' => 'true']);
        Auth::setDefaultDriver($this->guard);
        $this->_config = request('_config');
        $this->photoSaveRepository = $photoSaveRepository;
        $this->photoRepository = $photoRepository;
        // permissions
        $this->middleware('auth:' . $this->guard);
    }
    public function getMySavedPhotos()
    {
        try {
            $user_id = auth()->guard($this->guard)->id();
            $data =  $this->photoSaveRepository->getSavedPhotoByUserIdV2($user_id);
            // return $this->successResponse(new PhotoCollection($data));
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }
    public function save($photo_id)
    {
        try {

            $photo = $this->photoRepository->find($photo_id);
            if (!$photo) {
                return abort(404);
            }
            $data['user_id'] = auth()->guard($this->guard)->id();
            $data['photo_id'] = $photo->id;
            $existingSavedPhoto =  $this->photoSaveRepository->checkExistingSavedPhoto($photo_id,$data['user_id']);
            // if ($existingSavedPhoto) {
            //     return $this->messageResponse(
            //         __('photo.photos.already-saved'),
            //         false,
            //         400
            //     );
            // }
            // // SAVE NEW THOUGHT
            // $this->photoSaveRepository->create($data);
            // return $this->messageResponse(
            //     __('photo.photos.saved-successfully'),
            //     true,
            //     200
            // );
        } catch (Exception $e) {
            //return  $this->messageResponse( $e->getMessage());

            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }
    public function unsave($photo_id)
    {
        try {
            $user_id = auth()->guard($this->guard)->id();
            $existingSavedPhoto =  $this->photoSaveRepository->checkExistingSavedPhoto($photo_id, $user_id);
            // if (!$existingSavedPhoto) {
            //     return $this->messageResponse(
            //         __('photo.photos.not-saved'),
            //         true,
            //         404
            //     );
            // }
            // $existingSavedPhoto->delete();
            // return $this->messageResponse(
            //     __('photo.photos.unsaved-successfully'),
            //     true,
            //     200
            // );
        } catch (Exception $e) {
            //return  $this->messageResponse( $e->getMessage());
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }

}
