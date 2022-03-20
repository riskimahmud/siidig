<?php

use Config\App;

function user($index)
{
    // $ci = &get_instance();
    if (session()->has('user')) {
        $ret    =    session()->get("user")[$index];
        return $ret;
    } else {
        return 0;
    }
}

function cekSession($index)
{
    // $ci = &get_instance();
    if (session()->has($index)) {
        return true;
    } else {
        return false;
    }
}

function getSession($index)
{
    // $ci = &get_instance();
    $ret    =    session()->get($index);
    return $ret;
}

// fungsi untuk ambil waktu yang lalu
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'sekarang';
}

function time_togo_string($datetime, $full = false)
{
    $now = new DateTime;
    $later = new DateTime($datetime);
    $diff = $later->diff($now);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' lagi' : 'sekarang';
}

function generateRandomString($length = 10, $uppercase = false)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($uppercase) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function statusUser($status)
{
    if ($status == "1") {
        $ret = '<span class="badge badge-success">Aktif</span>';
    } else {
        $ret = '<span class="badge badge-danger">Tidak Aktif</span>';
    }
    return $ret;
}

function generateBadge($class, $msg)
{
    $ret = "<span class='badge badge-$class'>$msg</span>";
    return $ret;
}

function angkaInvestasi($angka, $rp = true)
{
    if ($rp) {
        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    } else {
        $hasil_rupiah = number_format($angka, 0, ',', '.');
    }
    return $hasil_rupiah;
}

function singkat_angka($n, $format, $presisi = 1)
{
    if ($n < 900) {
        $format_angka = number_format($n, $presisi);
        $simbol = '';
    } else if ($n < 900000) {
        $format_angka = number_format($n / 1000, $presisi);
        $simbol = 'rb';
    } else if ($n < 900000000) {
        $format_angka = number_format($n / 1000000, $presisi);
        $simbol = 'jt';
    } else if ($n < 900000000000) {
        $format_angka = number_format($n / 1000000000, $presisi);
        $simbol = 'M';
    } else {
        $format_angka = number_format($n / 1000000000000, $presisi);
        $simbol = 'T';
    }

    if ($presisi > 0) {
        $pisah = '.' . str_repeat('0', $presisi);
        $format_angka = str_replace($pisah, '', $format_angka);
    }

    if ($format == "angka") {
        return $format_angka;
    } elseif ($format == "simbol") {
        return $simbol;
    } else {
        return $format_angka . $simbol;
    }
}
