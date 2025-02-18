<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    function getFeature()
    {
        return $this->hasOne(Feature::class, 'plan_id', 'id');
    }
}
