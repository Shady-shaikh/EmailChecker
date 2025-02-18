<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailDataBank extends Model
{
    use HasFactory;

    protected $table = 'email_data_bank';

    protected $fillable = ['email', 'response', 'status'];

    public function getEmailUserMapping(){
        return $this->hasOne(EmailUserMapping::class,'email_data_bank_id','id');
    }
}
