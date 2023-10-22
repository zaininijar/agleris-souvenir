<?php

function idr_format($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}


function time_sice($timestamp)
{
    date_default_timezone_set('Asia/Jakarta');
    $currentTimestamp = time();
    $timeDiff = $currentTimestamp - strtotime($timestamp);

    if ($timeDiff < 60) {
        return $timeDiff . " detik yang lalu";
    } elseif ($timeDiff < 3600) {
        $minutes = floor($timeDiff / 60);
        return $minutes . " menit yang lalu";
    } elseif ($timeDiff < 86400) {
        $hours = floor($timeDiff / 3600);
        return $hours . " jam yang lalu";
    } else {
        $days = floor($timeDiff / 86400);
        return $days . " hari yang lalu";
    }

}
