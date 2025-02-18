<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;


use App\DataTables\Admin\User\UserDataTable;
use App\Http\Requests\Admin\User\UserRequest;
use App\Http\Traits\Admin\User\UserTrait;

class UserController extends Controller
{
    use UserTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $data)
    {
        return $data->render('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            if ($this->createUser($request)) {
                return redirect()->route('users.index')->with('success', 'User created successfully.');
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
            if ($user = $this->getUserById($id)) {
                return view('admin.user.show', compact('user'));
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return view('admin.dashboard.404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        try {
            if ($user = $this->getUserById($id)) {
                return view('admin.user.update', compact('user'));
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return view('admin.dashboard.404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {

        try {
            if ($user = $this->getUserById($id)) {
                if ($this->updateUser($request, $user)) {
                    return redirect()->route('users.index')->with('success', 'User updated successfully');
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
            if ($this->getUserById($id)) {
                if ($this->deleteUser($id)) {
                    return redirect()->route('users.index')->with('success', 'User deleted successfully');
                }
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
