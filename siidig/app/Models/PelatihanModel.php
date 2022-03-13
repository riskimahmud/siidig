<?php

namespace App\Models;

use CodeIgniter\Model;

class PelatihanModel extends Model
{
    protected $table      = 'pelatihan';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'body', 'status', 'lokasi', 'tgl_pelaksanaan', 'gambar'];
}
