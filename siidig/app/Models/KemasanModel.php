<?php

namespace App\Models;

use CodeIgniter\Model;

class KemasanModel extends Model
{
    protected $table      = 'kemasan';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = ['nama_perusahaan', 'nama_pemilik', 'alamat', 'produk', 'no_telp', 'ukuran', 'jenis_kemasan', 'tahun', 'kabkota'];
}
