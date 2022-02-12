<?php
function jam($tanggal)
{
    if ($tanggal == "0000-00-00 00:00:00" || $tanggal == NULL) {
        $fix    =    "-";
    } else {
        $jam   = substr($tanggal, 11, 2);
        $menit = substr($tanggal, 14, 2);
        $fix    =    $jam . ':' . $menit;
    }
    return $fix;
}

function tgl_indonesia($tanggal)
{
    if ($tanggal == "0000-00-00" || $tanggal == NULL) {
        $fix    =    "-";
    } else {
        $tgl = substr($tanggal, 8, 2);
        $nama_bulan = array(
            "Januari", "Februari", "Maret", "April", "Mei",
            "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        );
        $bulan = $nama_bulan[substr($tanggal, 5, 2) - 1];
        $tahun = substr($tanggal, 0, 4);
        $fix    =    $tgl . ' ' . $bulan . ' ' . $tahun;
    }
    return $fix;
}

function tgl_indonesia_short($tanggal)
{
    if ($tanggal == "0000-00-00" || $tanggal == NULL) {
        $fix    =    "-";
    } else {
        $tgl = substr($tanggal, 8, 2);
        $nama_bulan = array(
            "Jan", "Feb", "Mar", "Apr", "Mei",
            "Jun", "Jul", "Agu", "Sep",
            "Okt", "Nov", "Des"
        );
        $bulan = $nama_bulan[substr($tanggal, 5, 2) - 1];
        $tahun = substr($tanggal, 2, 2);
        $fix    =    $tgl . ' ' . $bulan . ' ' . $tahun;
    }
    return $fix;
}

function tgl_indonesia_full($tanggal)
{
    if ($tanggal == "0000-00-00 00:00:00" || $tanggal == NULL) {
        $fix    =    "-";
    } else {
        $tgl = substr($tanggal, 8, 2);
        $nama_bulan = array(
            "Januari", "Februari", "Maret", "April", "Mei",
            "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        );
        $bulan = $nama_bulan[substr($tanggal, 5, 2) - 1];
        $tahun = substr($tanggal, 0, 4);
        $jam   = substr($tanggal, 11, 2);
        $menit = substr($tanggal, 14, 2);
        $fix    =    $tgl . ' ' . $bulan . ' ' . $tahun . ' - ' . $jam . ':' . $menit;
    }
    return $fix;
}

function tgl_indonesia_full_short($tanggal)
{
    if ($tanggal == "0000-00-00 00:00:00" || $tanggal == NULL) {
        $fix    =    "-";
    } else {
        $tgl = substr($tanggal, 8, 2);
        $nama_bulan = [
            "Jan", "Feb", "Mar", "Apr", "Mei",
            "Jun", "Jul", "Agu", "Sep",
            "Okt", "Nov", "Des"
        ];
        $bulan = $nama_bulan[substr($tanggal, 5, 2) - 1];
        $tahun = substr($tanggal, 2, 2);
        $jam   = substr($tanggal, 11, 2);
        $menit = substr($tanggal, 14, 2);
        $fix    =    $tgl . ' ' . $bulan . ' ' . $tahun . ' - ' . $jam . ':' . $menit;
    }
    return $fix;
}
