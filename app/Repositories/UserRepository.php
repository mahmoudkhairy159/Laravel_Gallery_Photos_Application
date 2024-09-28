<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    use UploadFileTrait;
    public function model()
    {
        return User::class;
    }
    public function createOne(array $data)
    {

        try {
            DB::beginTransaction();
            if (request()->hasFile('image')) {
                $data['image'] = $this->uploadFile(request()->file('image'), (string)User::FILES_DIRECTORY);
            }
            $created = $this->model->create($data);
            DB::commit();
            return $created;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }
    public function updateOne(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            $user = $this->model->findOrFail($id);
            if (request()->hasFile('image')) {
                if ($user->image) {
                    $this->deleteFile($user->image,User::FILES_DIRECTORY);
                }
                $data['image'] = $this->uploadFile(request()->file('image'),(string)User::FILES_DIRECTORY);
            }
            $updated = $user->update($data);
            DB::commit();

            return  $updated;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            DB::beginTransaction();

            $user = $this->model->findOrFail($id);
            if ($user->image) {
                $this->deleteFile($user->image,User::FILES_DIRECTORY);
            }
            $deleted = $user->delete();
            DB::commit();
            return  $deleted;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }
    public function updateProfileImage(int $id)
    {
        try {
            DB::beginTransaction();

            $user = $this->model->findOrFail($id);
            if ($user->image) {
                $this->deleteFile($user->image,User::FILES_DIRECTORY);
            }
            $data['image'] = $this->uploadFile(request()->file('image'), (string)User::FILES_DIRECTORY);

            $updated=$user->update($data);

            DB::commit();

            return $updated;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }
    public function deleteProfileImage(int $id)
    {
        try {
            DB::beginTransaction();

            $user = $this->model->findOrFail($id);
            if ($user->image) {
                $this->deleteFile($user->image,User::FILES_DIRECTORY);
            }
            $data['image'] = null;
            $deleted=$user->update($data);
            DB::commit();

            return  $deleted;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
        }
    }
    public function changePassword(string $newPassword, int $id)
    {
        try {
            DB::beginTransaction();

            $user = $this->model->findOrFail($id);
            $user->password = $newPassword;
            $user->save();
            DB::commit();
            return $user;
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
    }


}
