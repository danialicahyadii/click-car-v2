<?php

namespace App\Helpers;

class KodePemesananHelper
{
    public static function generateKodePemesanan()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        $randomNumber = rand(0, 9);
        $kodePemesanan = $randomString . $randomNumber;

        return $kodePemesanan;
    }
}
