<?php

namespace App\Services\Frontend\EmailDataBank;

use App\Models\EmailDataBank;
use Illuminate\Support\Facades\DB;

/**
 * Class EmailBankService.
 */
class EmailBankService
{

    public static function checkEmailExist($email)
    {
        try{
            return EmailDataBank::where('email', $email)->first();
        }catch (\Exception $e) {
            return false;
        }
    }

    public static function storeEmail($email,$status)
    {
        try {
            DB::beginTransaction();
            $storeEmail = EmailDataBank::create([
                'email' => $email,
                'status' => $status,
            ]);
            if ($storeEmail) {
                DB::commit();
                return $storeEmail;
            }
            DB::rollback();
            return false;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public static function fetchEmails($request){
        try{
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $emailsQuery = EmailDataBank::query();
            if ($query != 'undefined') {
                $emailsQuery->where('email', 'like', '%' . $query . '%');
            }
            $emailsQuery->whereHas('getEmailUserMapping', function ($subQuery) {
                $subQuery->where('user_id', auth()->id());
            });
            return $emailsQuery->paginate(5);
        }catch (\Exception $e){
            return false;
        }
    }

}
