<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberShip extends Model
{
    use HasFactory;

    protected $table = 'memberships';
    protected $fillable = ['user_id', 'plan_id', 'start_subscription_date', 'end_subscription_date'];

    function getPlan()
    {
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }
    function getUser()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
