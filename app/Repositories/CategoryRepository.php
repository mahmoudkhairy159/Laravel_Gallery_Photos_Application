<?php

namespace App\Repositories;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }
    /*****************************************Retrieving For Users **************************************/
    public function getByUserId(int $userId)
    {
        return $this->model->where('user_id', $userId)->filter(request()->all());
    }

    /*****************************************End Retrieving For Users **************************************/


}
