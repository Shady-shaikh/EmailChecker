<?php

namespace App\Http\Traits\Frontend\MemberShip;

use App\Services\Frontend\MemberShip\MemberShipService;

trait MemberShipTrait
{
    //
    public function storeFreeMemberShip($user_id)
    {
        try {
            if (MemberShipService::storeFreeMemberShip($user_id)) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function storeMemberShip($user_id, $plan_id)
    {
        try {
            if (MemberShipService::storeMemberShip($user_id, $plan_id)) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
