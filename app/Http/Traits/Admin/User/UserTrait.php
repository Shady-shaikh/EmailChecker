<?php

namespace App\Http\Traits\Admin\User;

use App\Models\User;
use App\Services\Admin\User\UserService;
use Illuminate\Support\Facades\DB;

trait UserTrait
{
    //

    function createUser($request)
    {
        try {
            if (UserService::createUser($request)) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    function getUserById($id)
    {
        try {
            if ($user = UserService::getUserById($id)) {
                return $user;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
    function updateUser($request, $user)
    {
        try {
            if (UserService::updateUser($request, $user)) {
                return true;
            }
            DB::rollback();
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    function deleteUser($id)
    {
        if (UserService::deleteUser($id)) {
            return true;
        }
        DB::rollback();
        return false;
    }
}
