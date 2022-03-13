<?php

namespace App\Controllers;

use App\Models\SiinasModel;

class Siinas extends BaseController
{
    protected $siinas;

    public function __construct()
    {
        $this->siinas = new SiinasModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Perusahaan Yang Masuk dalam SIINAS',
            'data' => $this->siinas->findAll()
        ];
        return view('backend/siinas/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Perusahaan Yang Masuk dalam SIINAS',
            'validation' => $this->validation
        ];
        return view('backend/siinas/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('siinas')) {
            return redirect()->to('siinas/tambah')->withInput();
        }

        $this->siinas->save($this->request->getPost());

        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil ditambah ke SIINAS",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('siinas');
    }

    public function ubah($id = null)
    {
        $siinas = $this->siinas->find($id);
        if ($id === null || empty($siinas)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Ubah Perusahaan Yang Masuk dalam SIINAS',
            'validation' => $this->validation,
            'data' => $siinas
        ];
        return view('backend/siinas/ubah', $data);
    }

    public function update()
    {
        if (!$this->validate('siinas')) {
            return redirect()->to('siinas/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $this->siinas->save($this->request->getPost());

        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil diubah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('siinas');
    }

    public function hapus($id = null)
    {
        $siinas = $this->siinas->find($id);
        if ($id === null || empty($siinas)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->siinas->delete($id);
        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil dihapus",
        );
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('siinas');
    }
}
