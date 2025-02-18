<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CSVUpload extends Model
{
    use HasFactory;

    protected $table = 'csv_upload';
    protected $fillable = ['file_name','file_path', 'uploaded_by', 'status','processed'];
}
