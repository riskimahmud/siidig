<?php

namespace App\Models;

use CodeIgniter\Model;

class KabkotaModel extends Model
{
    protected $table      = 'kabkota';
    protected $primaryKey = 'kabkota_id';
    protected $allowedFields = ['nm_kabkota'];
    // Uncomment below if you want add primary key
    // protected $primaryKey = 'id';
}
