<?php

namespace App\Services\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class PlanService.
 */
class UserService
{

    public static function createUser($request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if (!empty($request->role)) {
                if (!$user->syncRoles([$request->role])) {
                    DB::rollback();
                    return false;
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function getUserById($id)
    {
        try {
            $user = User::find($id);
            if (!empty($user)) {
                return $user;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function updateUser($request, $user)
    {
        try {
            DB::beginTransaction();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make($request->password);

            $user->save();

            if (!empty($request->role)) {
                if (!$user->syncRoles([$request->role])) {
                    DB::rollback();
                    return false;
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function deleteUser($id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            if (!($user->roles)->isEmpty()) {
                if (!$user->roles()->detach([$user->roles->first()->id])) {
                    DB::rollback();
                    return false;
                }
            }
            $user->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
