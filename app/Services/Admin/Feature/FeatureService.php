<?php

namespace App\Services\Admin\Feature;

use App\Models\Feature;
use Illuminate\Support\Facades\DB;

class FeatureService
{
    public static function addFeature($request, $plan_id)
    {

        try {
            $feature =  new Feature();
            $feature->plan_id = $plan_id;
            $feature->email_limit = $request->email_limit;
            DB::beginTransaction();
            if ($feature->save()) {
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

    public static function getFeaturesById($id)
    {
        $feature =  Feature::where('plan_id', $id)->get();
        if (!empty($feature)) {
            return $feature;
        }
        return false;
    }

    public static function updateFeature($request, $plan_id)
    {

        try {
            DB::beginTransaction();
            $feature =   Feature::where('plan_id', $plan_id)->first();
            $feature->plan_id = $plan_id;
            $feature->email_limit = $request->email_limit;
            if ($feature->save()) {
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

    public static function deleteFeature($plan_id)
    {
        try {
            DB::beginTransaction();
            $feature = Feature::where('plan_id', $plan_id)->first();
            if ($feature) {
                if ($feature->delete()) {
                    DB::commit();
                    return true;
                }
                DB::rollback();
                return false;
            }
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}
