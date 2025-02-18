<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;

class Common
{
    public static function csvToArray($csvFilePath)
    {
        $csvFile = fopen($csvFilePath, 'r');
        $data = [];
        $columnName = true;
        while (($line = fgetcsv($csvFile)) !== false) {
            if ($columnName) {
                $columnName = false;
                continue;
            }
            $email = trim($line[0]);
            if ($email) {
                $data[] = $email;
            }
        }
        fclose($csvFile);
        return $data;
    }

    public static function checkEmailValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        list($user, $domain) = explode('@', $email);

        if (!checkdnsrr($domain, 'MX') && !checkdnsrr($domain, 'A')) {
            return false;
        }

        if (filter_var($domain, FILTER_VALIDATE_IP)) {
            return false;
        }
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email:rfc,dns',
        ]);
        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
