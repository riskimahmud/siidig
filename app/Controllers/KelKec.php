<?php

namespace App\Controllers;

use App\Models\KelKecModel;

class KelKec extends BaseController
{
    protected $folder = "kelkec";
    protected $base = "kelkec";
    protected $kelkec;

    public function __construct()
    {
        $this->kelkec = new KelKecModel();
    }

    public function index()
    {
        $data['title'] = "Daftar Kelurahan / Kecamatan";
        $data['data'] = $this->kelkec->where('kabkota_id', user("kabkota_id"))->orderBy('parent', 'ASC')->orderBy('nama_kelkec', 'ASC')->findAll();
        $data['base'] = $this->base;
        // dd($data);
        return view('backend/' . $this->folder . '/index', $data);
    }

    public function tambah()
    {
        $data['validation'] = \Config\Services::validation();
        $data['title'] = "Tambah Kelurahan / Kecamatan";
        $data['parent'] = $this->kelkec->where(['parent' => '', 'kabkota_id' => user("kabkota_id")])->findAll();
        $data['base'] = $this->base;
        return view('backend/' . $this->folder . '/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('kelkec')) {
            return redirect()->to('/kelkec/tambah')->withInput();
        }

        $data = $this->request->getPost();
        $data['nama_kelkec'] = strtoupper($data['nama_kelkec']);

        $tambah = $this->kelkec->insert($data);
        if ($tambah) {
            $notifikasi = array(
                "status" => "success", "msg" => "Kelurahan / Kecamtan berhasil ditambah",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => $this->title . " gagal ditambah",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/kelkec');
    }

    // edit
    public function ubah($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $kelkec = $this->kelkec->where('kabkota_id', user("kabkota_id"))->find($id);
        if (empty($kelkec)) {
            return redirect()->to("/kelkec");
        }


        // $data["title"] = "Ubah " . $this->title . " " . ucfirst($level);
        $data['validation'] = \Config\Services::validation();
        $data['title'] = "Ubah Kelurahan / Kecamatan";
        $data["data"] = $kelkec;
        $data['parent'] = $this->kelkec->where(['parent' => '', 'kabkota_id' => user("kabkota_id")])->findAll();
        $data['base'] = $this->base;
        return view('backend/' . $this->folder . '/ubah', $data);
    }

    // update
    public function update()
    {
        if (!$this->validate('kelkec')) {
            return redirect()->to('/kelkec/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $data = $this->request->getPost();
        $data['nama_kelkec'] = strtoupper($data['nama_kelkec']);

        $update = $this->kelkec->update($this->request->getPost('id'), $data);
        if ($update) {
            $notifikasi = array(
                "status" => "success", "msg" => "Kelurahan / Kecamtan berhasil ditambah",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => $this->title . " gagal ditambah",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/kelkec');
    }

    // hapus
    public function hapus($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
        $data = $this->kelkec->where('kabkota_id', user("kabkota_id"))->find($id);
        if (empty($data)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        } else {
            $hapus = $this->kelkec->delete($id);
            if ($hapus) {
                $notifikasi = array(
                    "status" => "success", "msg" => "Kelurahan / Kecamatan berhasil dihapus",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => $this->title . " gagal dihapus",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/kelkec');
        }
    }
}
