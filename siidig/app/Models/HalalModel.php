<?php

namespace App\Models;

use CodeIgniter\Model;

class HalalModel extends Model
{
    protected $table      = 'halal';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = ['nama_perusahaan', 'nama_pemilik', 'nomor_sertifikat', 'skala_usaha', 'alamat', 'tahun'];
}
