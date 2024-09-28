<?php

namespace App\Repositories;

use App\Models\Photo;
use App\Models\PhotoSave;
use Prettus\Repository\Eloquent\BaseRepository;

class PhotoSaveRepository extends BaseRepository
{

    public function model()
    {
        return PhotoSave::class;
    }
    public function checkExistingSavedPhoto($Photo_id, $user_id)
    {
        return  $this->model->where('Photo_id', $Photo_id)->where('user_id', $user_id)->first();
    }
    public function getSavedPhotoByUserId($user_id)
    {
        $PhotoIds = $this->model->where('user_id', $user_id)->pluck('Photo_id')->toArray();
        return     Photo::whereIn('id', $PhotoIds)
        ->withCount(['likes', 'shares', 'comments' => function ($query) {
                        $query->where('parent_comment_id',null)->where('deleted_at',null);
            }])
        ->paginate();
    }

    public function getSavedPhotoByUserIdV2($user_id)
{
    return Photo::whereHas('saves', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
        ->withCount(['likes', 'shares', 'comments' => function ($query) {
                        $query->where('parent_comment_id',null)->where('deleted_at',null);
            }])
        ->filter(request()->all())
        ->join('photo_saves', 'Photos.id', '=', 'saves.Photo_id')
        ->orderBy('saves.created_at', 'desc')
        // ->select('Photos.*')
        ->paginate();
}

}
