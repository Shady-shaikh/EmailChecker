<?php

namespace App\Services\Frontend\EmailUserMapping;

use App\Models\EmailUserMapping;
use App\Models\MemberShip;
use Illuminate\Support\Facades\DB;

/**
 * Class EmailBankService.
 */
class EmailUserMappingService
{
    public static function checkEmailExistsAgainstUser($email,$user_id)
    {
        try {
            return  EmailUserMapping::where([
                'email_data_bank_id' => $email->id,
                'user_id' => $user_id,
            ])->first();
        } catch (\Exception $e) {
            return false;
        }
    }
    public static  function getCountAgainstUser(){
        try {
            return  count(EmailUserMapping::where('user_id',auth()->id())->get());
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getEmailLimitCountAgainstUser(){
        try {
            $membership =  MemberShip::where('user_id',auth()->id())->latest()->first();
            return $membership->getPlan->getFeature->email_limit;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function storeEmailAgainstUser($email,$user_id)
    {
        try {
            DB::beginTransaction();
            DB::commit();
            return  EmailUserMapping::create([
                'email_data_bank_id' => $email->id,
                'user_id' => $user_id,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
