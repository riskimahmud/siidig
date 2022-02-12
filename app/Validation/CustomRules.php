<?php

namespace App\Validation;

use App\Models\KelKecModel;

class CustomRules
{
    // Rule is to validate mobile number digits
    public function kelurahanValidation(string $str, string $fields, array $data)
    {
        $kelkec = new KelKecModel();
        $where_id = [];
        if (isset($data['id'])) {
            $where_id = ['id <>' => $data['id']];
        }
        $cek = $kelkec->where(array_merge($where_id, ['nama_kelkec' => $str, 'kabkota_id' => user("kabkota_id")]))->first();
        if ($cek) {
            return false;
        } else {
            return true;
        }
    }
}
