<?php

namespace App\Repositories;

use App\Models\Task;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class TaskRepository extends BaseRepository
{
    public function model()
    {
        return Task::class;
    }
    /*****************************************Retrieving For Users **************************************/
    public function getByUserId(int $userId)
    {
        return $this->model->where('user_id', $userId)->filter(request()->all())->when(request()->categoryIds, function ($query, $categoryIds) {
            $query->withWhereHas('category', function ($query) use ($categoryIds) {
                $query->whereIn('id', $categoryIds);
            });
        });
    }

    /*****************************************End Retrieving For Users **************************************/

    public function  updateStatus(int $id,$data)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->findOrFail($id);
            $model->status=$data['status'];
            $updated = $model->save();
            DB::commit();
            return  $updated;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }
}
