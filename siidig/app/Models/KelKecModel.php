<?php

namespace App\Models;

use CodeIgniter\Model;

class KelKecModel extends Model
{
    protected $table      = 'kelkec';
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kelkec', 'parent', 'kabkota_id'];
}
