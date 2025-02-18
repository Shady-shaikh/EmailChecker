<?php

namespace App\Http\Traits\Admin\Role;

use App\Services\Admin\Role\RoleService;

trait RoleTrait
{
    //

    function createRole($request)
    {
        try {
            if (RoleService::createRole($request)) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    function getRoleById($id)
    {
        try {
            if ($role = RoleService::getRoleById($id)) {
                $role->permissions =$role->permissions;
                return $role;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
    function updateRole($request, $role)
    {
        try {
            if (RoleService::updateRole($request, $role)) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    function deleteRole($id)
    {
        if (RoleService::deleteRole($id)) {
            return true;
        }
        return false;
    }
}
