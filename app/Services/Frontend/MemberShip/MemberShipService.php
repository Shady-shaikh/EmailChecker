<?php

namespace App\Services\Frontend\MemberShip;

use App\Models\MemberShip;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;

/**
 * Class MembershipService.
 */
class MemberShipService
{

    public static function storeFreeMemberShip($user_id)
    {
        try {
            DB::beginTransaction();
            $plan = Plan::where('price', 0)->first();
            if (!empty($plan)) {
                MemberShip::create([
                    'user_id' => $user_id,
                    'plan_id' => $plan->id,
                    'start_subscription_date' => date('Y-m-d'),
                    'end_subscription_date' => date('Y-m-d', strtotime('+1 week')),
                ]);
                DB::commit();
                return true;
            }
            DB::rollBack();
            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function storeMemberShip($user_id, $plan_id)
    {
        try {
            DB::beginTransaction();
            MemberShip::create([
                'user_id' => $user_id,
                'plan_id' => $plan_id,
                'start_subscription_date' => date('Y-m-d'),
                'end_subscription_date' => date('Y-m-d', strtotime('+1 Year')),
            ]);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
