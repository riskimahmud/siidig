<?php

namespace App\Controllers;

use App\Models\AplikasiModel;

class Aplikasi extends BaseController
{
    protected $aplikasi;

    public function __construct()
    {
        $this->aplikasi = new AplikasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Aplikasi',
            'data' => $this->aplikasi->findAll()
        ];
        return view('backend/aplikasi/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Aplikasi',
            'validation' => $this->validation
        ];
        return view('backend/aplikasi/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('aplikasi')) {
            return redirect()->to('aplikasi/tambah')->withInput();
        }

        $data = $this->request->getPost();

        $gambar = $this->request->getFile('gambar');

        $image = \Config\Services::image();
        $newName = $gambar->getRandomName();
        $image->withFile($gambar)->resize(180, 100, true, 'auto')->save('uploads/aplikasi/' . $newName);
        $data['gambar'] = $newName;

        $this->aplikasi->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Aplikasi berhasil ditambah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('aplikasi');
    }

    public function ubah($id = null)
    {
        $aplikasi = $this->aplikasi->find($id);
        if ($id === null || empty($aplikasi)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Ubah Aplikasi',
            'validation' => $this->validation,
            'data' => $aplikasi
        ];
        return view('backend/aplikasi/ubah', $data);
    }

    public function update()
    {
        if (!$this->validate('aplikasi_update')) {
            return redirect()->to('aplikasi/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $data = $this->request->getPost();
        $data['excerpt'] = character_limiter(strip_tags($this->request->getPost('body')), 100);

        $gambar = $this->request->getFile('gambar');
        if ($gambar->getError() !== 4) {
            $aplikasi = $this->aplikasi->find($this->request->getPost('id'));
            unlink('./uploads/aplikasi/' . $aplikasi['gambar']);
            $image = \Config\Services::image();
            $newName = $gambar->getRandomName();
            $image->withFile($gambar)->resize(180, 100, true, 'auto')->save('uploads/aplikasi/' . $newName);
            $data['gambar'] = $newName;
        }

        $this->aplikasi->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Aplikasi berhasil diubah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('aplikasi');
    }

    public function hapus($id = null)
    {
        $aplikasi = $this->aplikasi->find($id);
        if ($id === null || empty($aplikasi)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        unlink('./uploads/aplikasi/' . $aplikasi['gambar']);

        $this->aplikasi->delete($id);
        $notifikasi = array(
            "status" => "success", "msg" => "Aplikasi berhasil dihapus",
        );
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('aplikasi');
    }
}
