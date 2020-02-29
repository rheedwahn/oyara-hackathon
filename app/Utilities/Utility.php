<?php

namespace App\Utilities;

class Utility
{
    public static function generateReference()
    {
        return mt_rand(100000000, 999999999).strtotime(date('Y-m-d H:i:s'));
    }

    public static function generateAccountNumber()
    {
        return mt_rand(1111111111, 9999999999);
    }
}
