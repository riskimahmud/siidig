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

    public function cari()
    {
        $data   =   [];
        $status  =   $this->request->getPost('status');
        $keperluan  =   $this->request->getPost('keperluan');
        $satuan  =   $this->request->getPost('satuan');
        $tanggal  =   $this->request->getPost('tanggal');

        $sql  =   "select user.no_identitas, user.nama, pengajuan.tgl_pengajuan, satuan.nama_satuan, keperluan.keperluan, pengajuan.status from pengajuan join user on pengajuan.user_id = user.user_id join satuan on pengajuan.satuan_id  = satuan.satuan_id join keperluan on pengajuan.keperluan_id = keperluan.keperluan_id where pengajuan_id <> 0";

        if ($status != "semua") {
            $sql .= " and pengajuan.status = '$status'";
        }

        if ($keperluan != "semua") {
            $sql .= " and pengajuan.keperluan_id = '$keperluan'";
        }

        if ($satuan != "semua") {
            $sql .= " and pengajuan.satuan_id = '$satuan'";
        }

        if ($tanggal !== "") {
            $explode    =   explode(" - ", $tanggal);
            $dari       =   $explode[0];
            $sampai     =   $explode[1];
            $sql .= " and tgl_pengajuan BETWEEN '$dari' AND '$sampai'";
        }

        $pengajuan      =   $this->crud_model->select_custom($sql, "getResultArray");
        if (!empty($pengajuan)) {
            foreach ($pengajuan as $key => $value) {
                $pengajuan[$key]['tgl_pengajuan'] = tgl_indonesia($value['tgl_pengajuan']);
                $pengajuan[$key]['status'] = statusPengajuan($value['status']);
            }
        }
        $data["pengajuan"]  =   $pengajuan;
        echo json_encode($data);
    }

    public function cetak()
    {
        $status  =   $this->request->getPost('status');
        $satuan  =   $this->request->getPost('satuan');
        $tanggal  =   $this->request->getPost('tanggal');

        $sql  =   "select user.no_identitas, user.nama, pengajuan.tgl_pengajuan, satuan.nama_satuan, keperluan.keperluan, pengajuan.status from pengajuan join user on pengajuan.user_id = user.user_id join satuan on pengajuan.satuan_id  = satuan.satuan_id join keperluan on pengajuan.keperluan_id = keperluan.keperluan_id where pengajuan_id <> 0";

        if ($status != "semua") {
            $sql .= " and pengajuan.status = '$status'";
        }

        if ($satuan != "semua") {
            $sql .= " and pengajuan.satuan_id = '$satuan'";
        }

        if ($tanggal !== "") {
            $explode    =   explode(" - ", $tanggal);
            $dari       =   $explode[0];
            $sampai     =   $explode[1];
            $sql .= " and tgl_pengajuan BETWEEN '$dari' AND '$sampai'";
        }

        $pengajuan      =   $this->crud_model->select_custom($sql);
        $data["pengajuan"]  =   $pengajuan;
        return view('backend/laporan/cetak', $data);
    }
}
