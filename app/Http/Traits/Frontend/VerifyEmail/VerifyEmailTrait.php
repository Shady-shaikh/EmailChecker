<?php

namespace App\Http\Traits\Frontend\VerifyEmail;

use App\Helpers\Common;
use App\Services\Frontend\CsvUpload\CsvUploadService;
use App\Services\Frontend\EmailDataBank\EmailBankService;
use App\Services\Frontend\EmailUserMapping\EmailUserMappingService;

trait VerifyEmailTrait
{
    public function checkEmailExist($email)
    {
        try {
            return EmailBankService::checkEmailExist($email);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function checkEmailExistsAgainstUser($email, $user_id)
    {
        try {
            return EmailUserMappingService::checkEmailExistsAgainstUser($email, $user_id);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function storeEmailAgainstUser($email, $user_id)
    {
        try {
            return EmailUserMappingService::storeEmailAgainstUser($email, $user_id);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function fetchEmails($request)
    {
        try {
            return EmailBankService::fetchEmails($request);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function storeEmail($email)
    {
        try {
            $status=0;
            if(!Common::checkEmailValid($email)){
                $status = 2;
            }
            return EmailBankService::storeEmail($email,$status);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function handleSingleEmail($request)
    {
        try {
            $email = $request->email;
            $checkEmailExists = $this->checkEmailExist($email);

            if ($checkEmailExists) {
                if (!$this->checkEmailExistsAgainstUser($checkEmailExists, auth()->id())) {
                    if ($this->storeEmailAgainstUser($checkEmailExists, auth()->id())) {
                        return redirect()->back()->with('success', 'Email validated successfully');
                    }
                    return redirect()->back()->with('error', 'Email validation was unsuccessful');
                }
                return redirect()->back()->with('success', 'Email is already validated');
            }

            $storeEmail = $this->storeEmail($email);
            if ($storeEmail && $this->storeEmailAgainstUser($storeEmail, auth()->id())) {
                return redirect()->back()->with('success', 'Email validated successfully');
            }
            return redirect()->back()->with('error', 'Emails validation was unsuccessful');
        } catch (\Exception $e) {
            return false;
        }
    }

    public function validateCSVUpload($request)
    {

        try {
            $csvFile = $request->file('csv_file');
            if (!$csvFile->isValid() || $csvFile->getClientOriginalExtension() != 'csv') {
                return ['error' => 'Invalid file upload.'];
            }

            $file = fopen($csvFile->getRealPath(), 'r');
            $header = fgetcsv($file);
            if (!$header || $header[0] !== 'Emails') {
                fclose($file);
                return ['error' => 'Invalid CSV header. Expected "Emails".'];
            }
            fclose($file);

            $userVerifiedEmailCount = EmailUserMappingService::getCountAgainstUser();
            $planEmailLimit = EmailUserMappingService::getEmailLimitCountAgainstUser();
            if ($planEmailLimit <= $userVerifiedEmailCount) {
                return ['error' => 'CSV file exceeds the maximum row limit of your plan.'];
            }

            $emails = Common::csvToArray($csvFile->getRealpath());
            if (empty($emails)) {
                return ['error' => 'No emails found in the CSV'];
            }

            return true;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function handleCsvUpload($request)
    {

        try {
            $csvFile = $request->file('csv_file');
            if (!CsvUploadService::uploadCsvAndStore($csvFile)) {
                return redirect()->back()->with('error', 'CSV upload was unsuccessful');
            }
            return redirect()->back()->with('success', 'CSV file verified and uploaded successfully');
        } catch (\Exception $e) {
            return false;
        }
    }
}
