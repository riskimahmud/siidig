<?php

namespace App\Controllers;

use App\Models\InvestasiModel;
use App\Models\KabkotaModel;

class Admin extends BaseController
{
    private $investasi;
    private $kabkota;

    public function __construct()
    {
        $this->investasi = new InvestasiModel();
        $this->kabkota = new KabkotaModel();
        // if (session()->get('user')["level"] == "opd") {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses', 0);
        // }
    }

    public function laporan_investasi()
    {
        $data['title'] = "Daftar Investasi";

        $where = [];
        $tahun = $this->request->getVar('tahun') ? $this->request->getVar('tahun') : date("Y");
        $kabkota = $this->request->getVar('kabkota');
        if ($kabkota != "") {
            $where['kabkota_id'] = $kabkota;
        }
        // dd($this->investasi);
        $where['tahun'] = $tahun;

        $data['filter'] = $this->request->getGet();

        $data['tahun'] = $tahun;
        $data['kabkota'] = $this->kabkota->findAll();
        $data['data'] = $this->investasi->where($where)->findAll();
        // dd($data);
        return view('backend/laporan/index', $data);
    }

    public function laporan_investasi_detail($id = null)
    {
        $investasi = $this->investasi->where('investasi.id', $id)->join('kabkota', 'kabkota.id = investasi.kabkota_id')->join('industri', 'industri.id = investasi.industri_id')->first();
        if (empty($investasi)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $data = [
            'title' => 'Detail Investasi',
            'data' => $investasi
        ];

        // dd($data);
        return view('backend/laporan/detail', $data);
    }
}
