<?php

namespace App\Controllers;

use App\Models\HeaderModel;

class Header extends BaseController
{
    protected $header;

    public function __construct()
    {
        $this->header = new HeaderModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Header',
            'data' => $this->header->findAll()
        ];
        return view('backend/header/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Header',
            'validation' => $this->validation
        ];
        return view('backend/header/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('header')) {
            return redirect()->to('header/tambah')->withInput();
        }

        $data = $this->request->getPost();

        $gambar = $this->request->getFile('gambar');

        $newName = $gambar->getRandomName();
        $gambar->move('uploads/header/', $newName);
        $data['gambar'] = $newName;

        $this->header->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Header berhasil ditambah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('header');
    }

    public function ubah($id = null)
    {
        $header = $this->header->find($id);
        if ($id === null || empty($header)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Ubah Header',
            'validation' => $this->validation,
            'data' => $header
        ];
        return view('backend/header/ubah', $data);
    }

    public function update()
    {
        if (!$this->validate('header_update')) {
            return redirect()->to('header/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $data = $this->request->getPost();

        $gambar = $this->request->getFile('gambar');
        if ($gambar->getError() !== 4) {
            $header = $this->header->find($this->request->getPost('id'));
            unlink('./uploads/header/' . $header['gambar']);
            $newName = $gambar->getRandomName();
            $gambar->move('uploads/header/', $newName);
            $data['gambar'] = $newName;
        }

        $this->header->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Header berhasil diubah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('header');
    }

    public function hapus($id = null)
    {
        $header = $this->header->find($id);
        if ($id === null || empty($header)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        unlink('./uploads/header/' . $header['gambar']);

        $this->header->delete($id);
        $notifikasi = array(
            "status" => "success", "msg" => "Header berhasil dihapus",
        );
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('header');
    }
}
