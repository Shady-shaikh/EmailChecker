<?php

namespace App\Services\Frontend\CsvUpload;

use App\Models\CSVUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class CsvUploadService.
 */
class CsvUploadService
{
    public static function uploadCsvAndStore($file){
        try{
            $fileName = time() . '-' . $file->getClientOriginalName();
            $filePath = public_path('csvFiles');
            $file->move($filePath, $fileName);
            DB::beginTransaction();
            $cvsUpload =  CSVUpload::create([
                'file_name'=> $fileName,
                'file_path'=> $filePath,
                'uploaded_by'=> auth()->id(),
            ]);
            if($cvsUpload){
                DB::commit();
                return true;
            }
            DB::rollback();
            return false;
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            return false;
        }
    }
}
