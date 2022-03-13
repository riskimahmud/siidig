<?php

namespace App\Models;

use CodeIgniter\Model;

class SiinasModel extends Model
{
    protected $table      = 'siinas';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = ['nama_perusahaan', 'alamat_kantor', 'alamat_pabrik', 'kode_kbli', 'bidang_usaha', 'tanggal_registrasi'];
}
