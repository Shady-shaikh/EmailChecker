<?php

namespace App\Jobs;

use App\Helpers\Common;
use App\Http\Traits\Frontend\VerifyEmail\VerifyEmailTrait;
use App\Models\CSVUpload;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCsvEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, VerifyEmailTrait;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $csvUploads = CSVUpload::where('processed', 0)->get();
        foreach ($csvUploads as $csvUpload) {
            $filePath = $csvUpload->file_path . '/' . $csvUpload->file_name;

            if (file_exists($filePath)) {
                $emails = Common::csvToArray($filePath);
                $userId = $csvUpload->uploaded_by;
                foreach ($emails as $email) {
                    $checkEmailExists = $this->checkEmailExist($email);
                    if ($checkEmailExists) {
                        if (!$this->checkEmailExistsAgainstUser($checkEmailExists, $userId)) {
                            $this->storeEmailAgainstUser($checkEmailExists, $userId);
                        }
                    } else {
                        $storeEmail = $this->storeEmail($email);
                        if ($storeEmail) {
                            $this->storeEmailAgainstUser($storeEmail, $userId);
                        }
                    }
                }
                $csvUpload->update(['processed' => 1]);
            }
        }
    }
}
