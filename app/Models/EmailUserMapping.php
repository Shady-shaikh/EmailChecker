<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailUserMapping extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','email_data_bank_id'];

    public function getEmails(){
        return $this->hasMany(EmailDataBank::class,'id','email_data_bank_id');
    }
}
