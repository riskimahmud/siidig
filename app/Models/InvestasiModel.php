<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestasiModel extends Model
{
    protected $table      = 'investasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun', 'nama_ikm', 'nama_pemilik', 'alamat', 'keldesa', 'kecamatan', 'telp', 'komoditi', 'produk', 'bentuk_badan_usaha', 'tahun_izin', 'kode_kbli', 'kbli', 'tkl', 'tkp', 'nilai_investasi', 'jumlah_produksi', 'satuan', 'nilai_produksi', 'nilai_bbbp', 'user_id', 'kabkota_id', 'industri_id'];

    public function all()
    {
    }
}
