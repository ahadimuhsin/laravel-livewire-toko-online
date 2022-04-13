<?php

use Illuminate\Support\Facades\Request;

//Menu yg aktif
function setActive($path)
{
    return  Request::is($path. '*') ? 'active' : '';
}

//convert mata uang ke rupiah
function money_id($str)
{
    return 'Rp. ' .number_format($str, '0', '', '.');
}

//format tanggal indonesia
function TanggalID ($format, $tanggal= "now")
{
    $en = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb",
"Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

    $id = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat",
    "Sabtu", "Januari", "Februari", "Maret", "April", "Mei",
    "Juni", "Juli", "Agustus", "September", "Oktober", "November",
    "Desember");

    return str_replace($en, $id, date($format, strtotime($tanggal)));
}

?>
