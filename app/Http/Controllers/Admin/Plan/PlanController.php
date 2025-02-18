<?php

namespace App\Http\Controllers\Admin\Plan;

use App\Http\Controllers\Controller;


use App\DataTables\Admin\Plan\PlanDataTable;
use App\Http\Requests\Admin\Plan\PlanRequest;
use App\Http\Traits\Admin\Plan\PlanTrait;

class PlanController extends Controller
{
    use PlanTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(PlanDataTable $data)
    {
        return $data->render('admin.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        try {
            if ($this->createPlan($request)) {
                return redirect()->route('plans.index')->with('success', 'Plan created successfully.');
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
            if ($plan = $this->getPlanById($id)) {
                return view('admin.plan.show', compact('plan'));
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
            if ($plan = $this->getPlanById($id)) {
                return view('admin.plan.update', compact('plan'));
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return view('admin.dashboard.404');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, string $id)
    {

        try {
            if ($plan = $this->getPlanById($id)) {
                if ($this->updatePlan($request, $plan)) {
                    return redirect()->route('plans.index')->with('success', 'Plan updated successfully');
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
            if ($this->getPlanById($id)) {
                if ($this->deletePlan($id)) {
                    return redirect()->route('plans.index')->with('success', 'Plan deleted successfully');
                }
            }
            return view('admin.dashboard.404');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
