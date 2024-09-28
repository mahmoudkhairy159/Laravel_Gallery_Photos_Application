<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Photo;
use App\Models\PhotoLike;
use Prettus\Repository\Eloquent\BaseRepository;

class PhotoLikeRepository extends BaseRepository
{
    public function model()
    {
        return PhotoLike::class;
    }
    //thought_likes
    public function likeOrDislike(int $thought_id)
    {
        try {
            DB::beginTransaction();

            $thought = Photo::findOrFail($thought_id);
            $user_id = Auth::id();

            $data['thought_id'] = $thought->id;
            $data['user_id'] = $user_id;
            // Check if the user has already reacted to the Photo
            $existingReaction = $this->model->where('thought_id', $thought->id)->where('user_id', $user_id)->first();

            if ($existingReaction) {
                // delete existing reaction (dislike)
                $updated = $existingReaction->delete();
            } else {
                // Create new reaction (like)
                $updated = $this->model->create($data);

            }
            DB::commit();
            return $updated;
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return false;
        }
    }


    //thought_likes
     /***********************thought_likes**************************/

     public function getLikesByPhotoId(int $thought_id)
     {

         return $this->model->where('thought_id', $thought_id)->with(['user' =>
         function ($query) {
             $query->select('id', 'name', 'image');
         }]);
     }
     /***********************End thought_likes**************************/

}
