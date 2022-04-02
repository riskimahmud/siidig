<?php

namespace App\Controllers;

use App\Models\InformasiModel;

class Informasi extends BaseController
{
    protected $info;

    public function __construct()
    {
        $this->info = new InformasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Informasi',
            'data' => $this->info->findAll()
        ];
        return view('backend/informasi/index', $data);
    }

    public function ubah($id = null)
    {
        $info = $this->info->find($id);
        if ($id === null || empty($info)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Ubah Informasi',
            'validation' => $this->validation,
            'data' => $info
        ];
        return view('backend/informasi/ubah', $data);
    }

    public function update()
    {
        if (!$this->validate('informasi')) {
            return redirect()->to('informasi/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $data = $this->request->getPost();
        $this->info->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Informasi berhasil diubah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('informasi');
    }

    public function get_info()
    {
        $slug = $this->request->getVar('slug');
        $db = \Config\Database::connect();
        $builder = $db->table('informasi');
        $builder->where('slug', $slug);
        $data = $builder->get()->getRowArray();

        $data['body'] = '<div class="blog-content mt30">' . $data['body'];
        // $data['body'] = "<div class='blog-content'><p>" . $data['body'];

        if ($slug == "halal") {
            $tabel = $db->table('halal')->get()->getResultArray();

            $data['body'] .= $data['body'];
            $data['body'] .= '<br><h6 class="text-center">Perusahaan Yang Sudah Mendapat Fasilitasi Halal</h6><br>';
            $data['body'] .= '
            <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Perusahaan</th>
                        <th>Nama Pemilik</th>
                        <th>Nomor Sertifikat</th>
                        <th>Skala Usaha</th>
                        <th>Alamat</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
            ';
            $no = 1;
            foreach ($tabel as $t) {
                $data['body'] .= "<tr>";
                $data['body'] .= "<td>{$no}</td>";
                $data['body'] .= "<td>{$t['nama_perusahaan']}</td>";
                $data['body'] .= "<td>{$t['nama_pemilik']}</td>";
                $data['body'] .= "<td width='200'>{$t['nomor_sertifikat']}</td>";
                $data['body'] .= "<td>{$t['skala_usaha']}</td>";
                $data['body'] .= "<td>{$t['alamat']}</td>";
                $data['body'] .= "<td>{$t['tahun']}</td>";
                $data['body'] .= "</tr>";
                $no++;
            }

            $data['body'] .= '</tbody></table></div>';
        }

        if ($slug == "kemasan") {
            $tabel = $db->table('kemasan')->get()->getResultArray();

            $data['body'] = $data['body'];
            $data['body'] .= '<br><h6 class="text-center">Perusahaan Yang Sudah Mendapat Fasilitasi Kemasan</h6><br>';
            $data['body'] .= '
            <div class="table-responsive">
            <table class="table table-bordered" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Perusahaan</th>
                        <th>Nama Pemilik</th>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Jenis Kemasan</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
            ';
            $no = 1;
            foreach ($tabel as $t) {
                $data['body'] .= "<tr>";
                $data['body'] .= "<td>{$no}</td>";
                $data['body'] .= "<td>{$t['nama_perusahaan']}</td>";
                $data['body'] .= "<td>{$t['nama_pemilik']}</td>";
                $data['body'] .= "<td>{$t['produk']}</td>";
                $data['body'] .= "<td>{$t['ukuran']}</td>";
                $data['body'] .= "<td>{$t['jenis_kemasan']}</td>";
                $data['body'] .= "<td>{$t['tahun']}</td>";
                $data['body'] .= "</tr>";
                $no++;
            }

            $data['body'] .= '</tbody></table></div>';
        }

        $data['body'] .= "</div>";

        if (empty($data)) {
            $res = [
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ];
        } else {
            $res = [
                'status' => true,
                'data' => $data,
                'message' => 'Data ditemukan',
            ];
        }
        return $this->response->setJSON($res);
    }
}
