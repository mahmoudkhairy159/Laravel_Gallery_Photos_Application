<?php

namespace App\Repositories;

use App\Models\Gallery;
use Prettus\Repository\Eloquent\BaseRepository;

class GalleryRepository extends BaseRepository
{
    public function model()
    {
        return Gallery::class;
    }
    /*****************************************Retrieving For Users **************************************/
    public function getByUserId(int $userId)
    {
        return $this->model->where('user_id', $userId)->filter(request()->all());
    }

    /*****************************************End Retrieving For Users **************************************/


}
