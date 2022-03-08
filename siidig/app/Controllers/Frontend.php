<?php

namespace App\Controllers;

class Frontend extends BaseController
{
    public function index()
    {
        $data = [
            'count' => $this->crud_model->select_data('grafik_tahunan', 'getRow', false, null, ['tahun' => 'DESC'])
        ];
        return view('frontend/home', $data);
    }
}
