<?php

namespace App\Http\Traits\Admin\Plan;

use App\Services\Admin\Feature\FeatureService;
use App\Services\Admin\Plan\PlanService;
use Illuminate\Support\Facades\DB;

trait PlanTrait
{
    //

    function createPlan($request)
    {
        try {
            DB::beginTransaction();
            if ($plan_id = PlanService::createPlan($request)) {
                if (!FeatureService::addFeature($request, $plan_id)) {
                    DB::rollback();
                }
                DB::commit();
                return true;
            }
            DB::rollback();
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    function getPlanById($id)
    {
        try {
            if ($plan = PlanService::getPlanById($id)) {
                return $plan;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
    function updatePlan($request, $plan)
    {
        try {
            DB::beginTransaction();
            if ($plan_id = PlanService::updatePlan($request, $plan)) {
                if (!FeatureService::updateFeature($request, $plan_id)) {
                    DB::rollback();
                }
                DB::commit();
                return true;
            }
            DB::rollback();
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    function deletePlan($id)
    {
        DB::beginTransaction();
        if (PlanService::deletePlan($id)) {
            if (FeatureService::getFeaturesById($id)) {
                if (!FeatureService::deleteFeature($id)) {
                    DB::rollback();
                }
            }
            DB::commit();
            return true;
        }
        DB::rollback();
        return false;
    }
}
