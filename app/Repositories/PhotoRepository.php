<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\Models\Photo;
use Prettus\Repository\Eloquent\BaseRepository;

class PhotoRepository extends BaseRepository
{
    public $retrievedData = [
        'id',
        'user_id',
        'body',
        'image',
        'visibility',
        'created_at',
        'updated_at'
    ];
    public function model()
    {
        return Photo::class;
    }
    /*****************************************Retrieving For Admins **************************************/
    public function getAll()
    {
        $this->makeDefaultSortByColumn();
        return $this->model->select($this->retrievedData)
            ->with(['parentPhoto',  'user' => function ($query) {
                $query->select('id', 'name', 'image');
            },])
            ->withCount(['likes', 'shares', 'comments' => function ($query) {
                $query->where('parent_comment_id', null)->where('deleted_at', null);
            }])
            ->filter(request()->all());



    }
    public function getOneById($id)
    {
        return $this->model
            ->where('id', $id)
            ->where(function ($query) {
                // Exclude Photos with parent_photo_id having a value and parentPhoto being null
                $query->whereNull('parent_photo_id')
                    ->orWhereHas('parentPhoto');
            })
            ->with(['parentPhoto', 'user' => function ($query) {
                $query->select('id', 'name', 'image');
            },])
            ->withCount(['likes', 'shares', 'comments' => function ($query) {
                $query->whereDoesntHave('parentComment')->where('deleted_at', null);
            }])
            ->first();
    }
    public function getPhotosByUserId(int $user_id)
    {
        $this->makeDefaultSortByColumn();

        return $this->model
            ->select($this->retrievedData)
            ->where('user_id', $user_id)
            ->with(['parentPhoto',  'user' => function ($query) {
                $query->select('id', 'name', 'image');
            },])
            ->where(function ($query) {
                // Exclude Photos with parent_photo_id having a value and parentPhoto being null
                $query->whereNull('parent_photo_id')
                    ->orWhereHas('parentPhoto');
            })
            ->withCount(['likes', 'shares', 'comments' => function ($query) {
                $query->whereDoesntHave('parentComment')->where('deleted_at', null);
            }])
            ->filter(request()->all());
    }


    /*****************************************End Retrieving For Admins **************************************/
    /*****************************************Retrieving For Users **************************************/
    public function getAllActive()
    {
        $this->makeDefaultSortByColumn();

        return $this->model->select($this->retrievedData)
            ->with(['parentPhoto',])
            ->where(function ($query) {
                // Exclude Photos with parent_photo_id having a value and parentPhoto being null
                $query->whereNull('parent_photo_id')
                    ->orWhereHas('parentPhoto');
            })
            ->withWhereHas(
                'user',
                function ($query) {
                    $query->select('id', 'name', 'image');
                }
            )

            ->withCount(['likes', 'shares', 'comments' => function ($query) {
                $query->where('parent_comment_id', null)->where('deleted_at', null)->whereHas('user', function ($query) {
                    $query;
                });
            }])
            ->filter(request()->all());
    }
    public function getTrending()
    {
        $this->makeDefaultSortByColumn();

        return $this->model
            ->select($this->retrievedData)
            ->with(['parentPhoto'])
            ->withWhereHas(
                'user',
                function ($query) {
                    $query->select('id', 'name', 'image');
                }
            )
            ->where(function ($query) {
                // Exclude Photos with parent_photo_id having a value and parentPhoto being null
                $query->whereNull('parent_photo_id')
                    ->orWhereHas('parentPhoto');
            })
            ->withCount(['likes', 'shares', 'comments' => function ($query) {
                $query->where('parent_comment_id', null)->where('deleted_at', null)->whereHas('user', function ($query) {
                    $query;
                });
            }])
            ->filter(request()->all());
    }
    public function getActiveOneById($id)
    {
        return $this->model
            ->where('id', $id)
            ->where(function ($query) {
                // Exclude Photos with parent_photo_id having a value and parentPhoto being null
                $query->whereNull('parent_photo_id')
                    ->orWhereHas('parentPhoto');
            })
            ->with(['parentPhoto',  'user' => function ($query) {
                $query->select('id', 'name', 'image');
            },])
            ->withCount(['likes', 'shares', 'comments' => function ($query) {
                $query->where('parent_comment_id', null)->where('deleted_at', null)->whereHas('user', function ($query) {
                    $query;
                });
            }])
            ->first();
    }

    public function getActivePhotosByUserId(int $user_id)
    {
        $this->makeDefaultSortByColumn();
        return $this->model
            ->select($this->retrievedData)

            ->where('user_id', $user_id)
            ->with(['parentPhoto'])->withWhereHas(
                'user',
                function ($query) {
                    $query->select('id', 'name', 'image');
                }
            )->where(function ($query) {
                // Exclude Photos with parent_photo_id having a value and parentPhoto being null
                $query->whereNull('parent_photo_id')
                    ->orWhereHas('parentPhoto');
            })->withCount(['likes', 'shares', 'comments' => function ($query) {
                $query->where('parent_comment_id', null)->where('deleted_at', null);
            }])->filter(request()->all());
    }

    /*****************************************End Retrieving For Users **************************************/
    public function createOne(array $data)
    {
        try {
            DB::beginTransaction();

            if (request()->hasFile('image')) {
                $data['image'] = $this->uploadFile(request()->file('image'), Photo::FILES_DIRECTORY);
            }
            $created = $this->model->create($data);
            DB::commit();

            return $created->refresh();;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }


    public function updateOne(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $user_id = auth()->id();
            $Photo = $this->model->where('user_id',  $user_id)->findOrFail($id);
            if (request()->hasFile('image')) {
                if ($Photo->image) {
                    $this->deleteFile($Photo->image);
                }
                $data['image'] = $this->uploadFile(request()->file('image'), Photo::FILES_DIRECTORY);
            }
            $updated = $Photo->update($data);
            DB::commit();
            return $Photo->refresh();
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }
    public function deleteOne(int $id)
    {
        try {
            DB::beginTransaction();

            $user_id = auth()->id();
            $Photo = $this->model->where('user_id',  $user_id)->findOrFail($id);
            // if ($Photo->parent_photo_id == null) {
            //     if ($Photo->image) {
            //         $this->deleteFile($Photo->image);
            //     }
            // }
            $deleted = $Photo->delete();
            DB::commit();
            return  $deleted;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }


    //shared Photos
    public function share(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            $Photo = $this->model->findOrFail($id);
            // Share the Photo
            $data['parent_photo_id'] = $Photo->parent_photo_id != null ? $Photo->parent_photo_id : $Photo->id;
            $shared = $this->model->create($data);
            DB::commit();
            return $shared->refresh();
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }



    /*************************************Trashed model SoftDeletes*********************************/
    public function getOnlyTrashed()
    {
        return $this->model
            ->onlyTrashed()
            ->select($this->retrievedData)
            ->filter(request()->all())
            ->orderBy('deleted_at', 'desc');
    }
    public function forceDelete(int $id)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->withTrashed()->findOrFail($id);
            if ($model->parent_photo_id == null) {
                if ($model->image) {
                    $this->deleteFile($model->image);
                }
            }
            $deleted = $model->forceDelete();
            DB::commit();
            return  $deleted;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }
    public function restore(int $id)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->withTrashed()->findOrFail($id);
            $restored = $model->restore();
            DB::commit();
            return  $restored;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    /******************************End Trashed model SoftDeletes******************************/

    private  function makeDefaultSortByColumn($column = 'created_at')
    {
        request()->merge([
            'sortBy' => request()->input('sortBy', $column)
        ]);
    }
}
