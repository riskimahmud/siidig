<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    // protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama', 'email', 'status', 'level', 'kabkota_id', 'last_login'];

    public function all()
    {
        return $this->db->table('user')->select('user.*, kabkota.nama_kabkota')->join('kabkota', 'user.kabkota_id = kabkota.id')
            ->get()->getResultArray();
    }

    public function cekUsername($username)
    {
        $this->where(['username' => $username]);
        return $this->orWhere('email', $username)->first();
    }
}
