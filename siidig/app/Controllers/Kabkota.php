<?php

namespace App\Controllers;

use App\Models\KabkotaModel;

class Kabkota extends BaseController
{
    protected $kabkota;

    public function __construct()
    {
        $this->kabkota = new KabkotaModel();
    }

    public function index()
    {
        $data['title'] = "Daftar Kabupaten/Kota";

        $data['data'] = $this->kabkota->findAll();
        // dd($data);
        return view('backend/kabkota/index', $data);
    }
}
