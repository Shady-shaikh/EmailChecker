<?php

namespace App\Services\Admin\Role;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

/**
 * Class PlanService.
 */
class RoleService
{

    public static function createRole($request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create([
                'name' => $request->name ?? '',
                'display_name' => $request->display_name ?? '', // optional
                'description' =>  $request->description ?? '', // optional
            ]);
            if (!$role) {
                DB::rollback();
                return false;
            }
            DB::commit();
            if (!empty($$request->permission)) {
                $role->syncPermissions($request->permission);
            }
            return $role->id;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function getRoleById($id)
    {
        try {
            $plan =  Role::find($id);
            if (!empty($plan)) {
                return $plan;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function updateRole($request, $role)
    {
        try {
            DB::beginTransaction();
            unset($role['permissions']);
            $role->fill($request->all());
            if ($role->save()) {
                if (!empty($$request->permission)) {
                    $role->syncPermissions($request->permission);
                }
                DB::commit();
                return $role->id;
            }
            DB::rollback();
            return false;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function deleteRole($id)
    {
        try {
            DB::beginTransaction();
            $role =  Role::find($id);
            if ($role->delete()) {
                DB::commit();
                return true;
            }
            DB::rollback();
            return false;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
