<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

class DashboardRepository extends BaseRepository
{


    public function model()
    {
        return Task::class;
    }


    public function getStatisticsCount()
    {
        return [
            'tasks_count' => $this->countTasks(),
            'categories_count' => $this->countCategories(),
        ];
    }

    protected function countTasks()
    {
        return $this->model->count();
    }
    protected function countCategories()
    {
        return Category::count();
    }

}
