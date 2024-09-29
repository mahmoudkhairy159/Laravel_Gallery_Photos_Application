<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Website\PhotoComment\StorePhotoCommentReplyRequest;
use App\Http\Requests\Website\PhotoComment\StorePhotoCommentRequest;
use App\Http\Requests\Website\PhotoComment\UpdatePhotoCommentRequest;
use App\Repositories\PhotoCommentRepository;



class PhotoCommentController extends Controller
{
   


    protected $photoCommentRepository;

    protected $_config;
    protected $guard;
    protected $per_page;

    public function __construct(PhotoCommentRepository $photoCommentRepository)
    {
        $this->guard = 'user-api';
        request()->merge(['token' => 'true']);
        Auth::setDefaultDriver($this->guard);
        $this->_config = request('_config');
        $this->photoCommentRepository = $photoCommentRepository;
        $this->per_page = config('pagination.default');
        // permissions
        $this->middleware('auth:' . $this->guard)->except([
            'getByPhotoId',
            'getByUserId',
            'show'
        ]);
    }

    public function getByPhotoId($photo_id)
    {
        try {
            if (!auth()->guard($this->guard)->check()) {
                request()->merge(['page' => 1]);
            }
            $data = $this->photoCommentRepository->getActiveByPhotoId($photo_id)->paginate($this->per_page);
            // return $this->successResponse(new PhotoCommentCollection($data));
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
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
            $data = $this->photoCommentRepository->getActiveByUserId($user_id)->paginate($this->per_page);
            // return $this->successResponse(new PhotoCommentCollection($data));
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
    public function store(StorePhotoCommentRequest $request)
    {
        try {
            $data =  $request->validated();
            $data['user_id'] = auth()->guard($this->guard)->id();
            $created = $this->photoCommentRepository->create($data);

            // if ($created) {
            //     // Prepare the data and send the notification
            //     $root_id = $created->photo->id;
            //     $this->prepareAndSendNotification($created, $created->photo->user,  NotificationTypeEnum::THOUGHT_COMMENTED,$root_id);
            //     return $this->successResponse(
            //         new PhotoCommentResource($created),
            //         __("photo.photoComments.created-successfully"),
            //         201
            //     );
            // } {
            //     return $this->messageResponse(
            //         __("photo.photoComments.created-failed"),
            //         false,
            //         400
            //     );
            // }
        } catch (Exception $e) {
            // return  $this->messageResponse( $e->getMessage());

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
            $data = $this->photoCommentRepository->active()->findOrFail($id);
            // return $this->successResponse(new PhotoCommentResource($data));
        } catch (Exception $e) {
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
    public function update(UpdatePhotoCommentRequest $request, $id)
    {
        try {
            $data['user_id'] = auth()->guard($this->guard)->id();
            $photoComment = $this->photoCommentRepository->where('user_id', $data['user_id'])->find($id);
            if (!$photoComment) {
                return abort(404);
            }
            $data =  $request->validated();
            $updated = $this->photoCommentRepository->update($data, $id);

            // if ($updated) {
            //     return $this->successResponse(
            //         new PhotoCommentResource($updated),
            //         __("photo.photoComments.updated-successfully"),
            //         200
            //     );
            // } {
            //     return $this->messageResponse(
            //         __("photo.photoComments.updated-failed"),
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
            $data['user_id'] = auth()->guard($this->guard)->id();
            $photoComment = $this->photoCommentRepository->where('user_id', $data['user_id'])->findOrFail($id);
            $deleted = $this->photoCommentRepository->delete($id);
            if ($deleted) {
                return $this->messageResponse(
                    __("photo.photoComments.deleted-successfully"),
                    true,
                    200
                );
            } {
                return $this->messageResponse(
                    __("photo.photoComments.deleted-failed"),
                    false,
                    400
                );
            }
        } catch (Exception $e) {

            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }
    //////////////////////////////////comment_replies/////////////////////////////////////////////////////////
    public function reply(StorePhotoCommentReplyRequest $request, $comment_id)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();
            $replied = $this->photoCommentRepository->reply($data, $comment_id);
            if ($replied) {
                // return $this->successResponse(
                //     new PhotoCommentResource($replied),
                //     __("photo.photoComments.created-successfully"),
                //     201
                // );
            } {
                // return $this->messageResponse(
                //     __("photo.photoComments.created-failed"),
                //     false,
                //     400
                // );
            }
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }
    public function getRepliesByCommentId($comment_id)
    {
        try {
            if (!auth()->guard($this->guard)->check()) {
                request()->merge(['page' => 1]);
            }
            $data = $this->photoCommentRepository->getActiveRepliesByCommentId($comment_id)->paginate($this->per_page);
            // return $this->successResponse(new PhotoCommentCollection($data));
        } catch (Exception $e) {
            return $this->errorResponse(
                [],
                __('app.something-went-wrong'),
                500
            );
        }
    }
    //////////////////////////////////comment_replies/////////////////////////////////////////////////////////

}
