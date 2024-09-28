<?php

namespace App\Repositories;

use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\DB;
use App\Models\PhotoComment;
use Prettus\Repository\Eloquent\BaseRepository;

class PhotoCommentRepository extends BaseRepository
{
    use UploadFileTrait;
    public function model()
    {
        return PhotoComment::class;
    }
    /*****************************************Retrieving For Admins **************************************/

    public function getByUserId($user_id)
    {
        return  $this->model
            ->with([
                'parentComment',
                'user' => function ($query) {
                    $query->select('id', 'name', 'image');
                },
            ])
            ->whereDoesntHave('parentComment')
            ->where(function ($query) {
                // Exclude comments with parent_comment_id having a value and parentComment being null
                $query->whereNull('parent_comment_id')
                    ->orWhereHas('parentComment');
            })
            ->withCount(['replies' => function ($query) {
                $query->where('deleted_at', null);
            }])->where('user_id', $user_id)
            ->filter(request()->all())
            ->orderBy('created_at', 'desc');
    }
    public function getByPhotoId($thought_id)
    {
        return  $this->model
            ->with([
                'parentComment',
                'user' => function ($query) {
                    $query->select('id', 'name', 'image');
                },
            ])
            ->whereDoesntHave('parentComment')
            ->where(function ($query) {
                // Exclude comments with parent_comment_id having a value and parentComment being null
                $query->whereNull('parent_comment_id')
                    ->orWhereHas('parentComment');
            })
            ->withCount(['replies' => function ($query) {
                $query->where('deleted_at', null);
            }])->where('thought_id', $thought_id)
            ->filter(request()->all())
            ->orderBy('created_at', 'desc');
    }
    /*****************************************End  Retrieving For Admins **************************************/
    /*****************************************Retrieving For Users **************************************/

    public function getActiveByUserId($user_id)
    {
        return  $this->model
            ->active()
            ->with([
                'parentComment'
            ])->withWhereHas('user', function ($query) {
                $query->active()->select('id', 'name', 'image');
            })
            ->whereDoesntHave('parentComment')
            ->where(function ($query) {
                // Exclude comments with parent_comment_id having a value and parentComment being null
                $query->whereNull('parent_comment_id')
                    ->orWhereHas('parentComment');
            })
            ->withCount(['replies' => function ($query) {
                $query->where('deleted_at', null)->whereHas('user', function ($query) {
                    $query->active();
                });
            }])->where('user_id', $user_id)
            ->filter(request()->all())
            ->orderBy('created_at', 'desc');
    }
    public function getActiveByPhotoId($thought_id)
    {
        return  $this->model
            ->active()
            ->with([
                'parentComment',
            ])->withWhereHas('user', function ($query) {
                $query->active()->select('id', 'name', 'image');
            })
            ->whereDoesntHave('parentComment')
            ->where(function ($query) {
                // Exclude comments with parent_comment_id having a value and parentComment being null
                $query->whereNull('parent_comment_id')
                    ->orWhereHas('parentComment');
            })
            ->withCount(['replies' => function ($query) {
                $query->where('deleted_at', null)->whereHas('user', function ($query) {
                    $query->active();
                });
            }])->where('thought_id', $thought_id)
            ->filter(request()->all())
            ->orderBy('created_at', 'desc');
    }
    /*****************************************End  Retrieving For Users **************************************/
    /******************************Trashed model SoftDeletes**********************************/
    public function getOnlyTrashed()
    {
        return $this->model
            ->onlyTrashed()
            ->filter(request()->all())
            ->orderBy('deleted_at', 'desc');
    }
    public function forceDelete(int $id)
    {
        try {
            DB::beginTransaction();
            $model = $this->model->withTrashed()->findOrFail($id);
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
    /*******************************EndTrashed model SoftDeletes********************************/



    /**********************************************comment replies ***********************************/
    public function reply(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $comment = $this->model->findOrFail($id);
            // add reply
            $data['parent_comment_id'] = $comment->parent_comment_id != null ? $comment->parent_comment_id : $comment->id;
            $data['thought_id'] = $comment->thought_id;
            $replied = $this->model->create($data);
            DB::commit();
            return $replied->refresh();
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    /*****************Retrieving For Admins *********************/

    public function getRepliesByCommentId($comment_id)
    {
        return  $this->model
            ->with([
                'parentComment',
                'user' => function ($query) {
                    $query->select('id', 'name', 'image');
                },
            ])
            ->where(function ($query) {
                // Exclude comments with parent_comment_id having a value and parentComment being null
                $query->whereNull('parent_comment_id')
                    ->orWhereHas('parentComment');
            })
            ->withCount(['replies' => function ($query) {
                $query->where('deleted_at', null);
            }])->where('parent_comment_id', $comment_id)
            ->filter(request()->all())
            ->orderBy('created_at', 'asc');
    }
    /*****************End Retrieving For Admins *********************/

    /*****************Retrieving For Users *********************/

    public function getActiveRepliesByCommentId($comment_id)
    {
        return  $this->model
            ->active()
            ->with([
                'parentComment'
            ])->withWhereHas('user', function ($query) {
                $query->active()->select('id', 'name', 'image');
            })
            ->where(function ($query) {
                // Exclude comments with parent_comment_id having a value and parentComment being null
                $query->whereNull('parent_comment_id')
                    ->orWhereHas('parentComment');
            })
            ->withCount(['replies' => function ($query) {
                $query->where('deleted_at', null)->whereHas('user', function ($query) {
                    $query->active();
                });
            }])->where('parent_comment_id', $comment_id)
            ->filter(request()->all())
            ->orderBy('created_at', 'asc');
    }
    /*****************End Retrieving For Users *********************/
    /**********************************************End comment replies ***********************************/
}
