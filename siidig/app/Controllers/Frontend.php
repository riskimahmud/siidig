<?php

namespace App\Controllers;

class Frontend extends BaseController
{
    public function index()
    {
        $data = [
            'header' => $this->crud_model->select_data('header', 'getResultArray', ['status' => 'publish']),
            'pelatihan' => $this->crud_model->select_data('pelatihan', 'getResultArray', ['status' => 'publish', 'tgl_pelaksanaan >=' => date("Y-m-d")], null, ['tgl_pelaksanaan' => 'DESC'], 3),
            'berita' => $this->crud_model->select_data('berita', 'getResultArray', ['status' => 'publish'], null, ['created_at' => 'DESC'], 3),
            'aplikasi' => $this->crud_model->select_data('aplikasi', 'getResultArray'),
            'count' => $this->crud_model->select_data('grafik_tahunan', 'getRow', false, null, ['tahun' => 'DESC'])
        ];
        return view('frontend/home', $data);
    }
}
