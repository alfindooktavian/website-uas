<?php

use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

/**
 * @param string $path
 * @return string
 */
if (!function_exists('setActive')) {
    function setActive($path)
    {
        return Request::is($path . '*') ? ' active' : '';
    }
}

/**
 * @param string $format
 * @param string|null $tanggal
 * @param string $bahasa
 * @return string
 */
if (!function_exists('TanggalID')) {
    function TanggalID($format, $tanggal = null, $bahasa = 'id')
    {
        $en = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $id = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Januari", "Pebruari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"];

        // mengganti kata yang berada pada array en dengan array id, fr (default id)
        $tanggal = $tanggal ? Carbon::parse($tanggal) : Carbon::now();

        return str_replace($en, $$bahasa, $tanggal->format($format));
    }
}
