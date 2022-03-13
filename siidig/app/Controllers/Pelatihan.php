<?php

namespace App\Controllers;

use App\Models\PelatihanModel;

class Pelatihan extends BaseController
{
    protected $pelatihan;

    public function __construct()
    {
        $this->pelatihan = new PelatihanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pelatihan',
            'data' => $this->pelatihan->findAll()
        ];
        return view('backend/pelatihan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Pelatihan',
            'validation' => $this->validation
        ];
        return view('backend/pelatihan/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('pelatihan')) {
            return redirect()->to('pelatihan/tambah')->withInput();
        }

        $data = $this->request->getPost();

        $gambar = $this->request->getFile('gambar');
        $image = \Config\Services::image();
        $newName = $gambar->getRandomName();
        $image->withFile($gambar)->fit(370, 220)->save('uploads/pelatihan/thumb_' . $newName);
        $gambar->move('uploads/pelatihan/', $newName);
        $data['gambar'] =   $newName;

        $this->pelatihan->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Pelatihan berhasil ditambah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('pelatihan');
    }

    public function ubah($id = null)
    {
        $pelatihan = $this->pelatihan->find($id);
        if ($id === null || empty($pelatihan)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Ubah Pelatihan',
            'validation' => $this->validation,
            'data' => $pelatihan
        ];
        return view('backend/pelatihan/ubah', $data);
    }

    public function update()
    {
        if (!$this->validate('pelatihan_update')) {
            return redirect()->to('pelatihan/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $data = $this->request->getPost();

        $gambar = $this->request->getFile('gambar');
        if ($gambar->getError() !== 4) {
            $pelatihan = $this->pelatihan->find($this->request->getPost('id'));
            unlink('./uploads/pelatihan/' . $pelatihan['gambar']);
            unlink('./uploads/pelatihan/thumb_' . $pelatihan['gambar']);
            $image = \Config\Services::image();
            $newName = $gambar->getRandomName();
            $image->withFile($gambar)->fit(370, 220)->save('uploads/pelatihan/thumb_' . $newName);
            $gambar->move('uploads/pelatihan/', $newName);
            $data['gambar'] =   $newName;
        }

        $this->pelatihan->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Pelatihan berhasil diubah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('pelatihan');
    }

    public function hapus($id = null)
    {
        $pelatihan = $this->pelatihan->find($id);
        if ($id === null || empty($pelatihan)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        unlink('./uploads/pelatihan/' . $pelatihan['gambar']);
        unlink('./uploads/pelatihan/thumb_' . $pelatihan['gambar']);

        $this->pelatihan->delete($id);
        $notifikasi = array(
            "status" => "success", "msg" => "Pelatihan berhasil dihapus",
        );
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('pelatihan');
    }
}
