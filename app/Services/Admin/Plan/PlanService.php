<?php

namespace App\Services\Admin\Plan;

use App\Models\Plan;
use Illuminate\Support\Facades\DB;

/**
 * Class PlanService.
 */
class PlanService
{

    public static function createPlan($request)
    {
        try {
            DB::beginTransaction();
            $plan = new Plan();
            $plan->fill($request->all());
            if ($plan->save()) {
                DB::commit();
                return $plan->id;
            }
            DB::rollback();
            return false;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function getPlanById($id)
    {
        try {
            $plan =  Plan::find($id);
            if (!empty($plan)) {
                return $plan;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function updatePlan($request, $plan)
    {
        try {
            DB::beginTransaction();
            $plan->fill($request->all());
            if ($plan->save()) {
                DB::commit();
                return $plan->id;
            }
            DB::rollback();
            return false;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function deletePlan($id)
    {
        try {
            DB::beginTransaction();
            $plan =  Plan::find($id);
            if ($plan->delete()) {
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
