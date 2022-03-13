<?php

namespace App\Models;

use CodeIgniter\Model;

class HeaderModel extends Model
{
    protected $table      = 'header';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'subtitle', 'link', 'gambar', 'status'];
}
