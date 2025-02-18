<?php

namespace App\Http\Controllers\Admin\Role;

use App\DataTables\Admin\Role\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Http\Traits\Admin\Role\RoleTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use RoleTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $data)
    {
        return $data->render('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        try {
            if ($this->createRole($request)) {
                return redirect()->route('roles.index')->with('success', 'Role created successfully.');
            }
            return redirect()->back()->with('error', 'Something went wrong');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            if ($role = $this->getRoleById($id)) {
                return view('admin.role.show', compact('role'));
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return view('admin.dashboard.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            if ($role = $this->getRoleById($id)) {
                return view('admin.role.update', compact('role'));
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return view('admin.dashboard.404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            if ($role = $this->getRoleById($id)) {
                if ($this->updateRole($request, $role)) {
                    return redirect()->route('roles.index')->with('success', 'Role updated successfully');
                }
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            if ($this->getRoleById($id)) {
                if ($this->deleteRole($id)) {
                    return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
                }
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
