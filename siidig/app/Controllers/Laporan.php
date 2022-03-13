<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function __construct()
    {
        if (session()->get('user')["level"] == "user") {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses', 0);
        }
    }

    public function index()
    {
        $data['title'] = "Laporan";
        $data['satuan'] =   $this->crud_model->select_data("satuan", "getResult", ["aktif" => "1"]);
        $data['keperluan'] =   $this->crud_model->select_data("keperluan");
        return view('backend/laporan/index', $data);
    }
}
