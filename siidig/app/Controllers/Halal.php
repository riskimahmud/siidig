<?php

namespace App\Controllers;

use App\Models\HalalModel;

class Halal extends BaseController
{
    protected $halal;

    public function __construct()
    {
        $this->halal = new HalalModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Perusahaan Yang Sudah Mendapat Sertifikasi Halal',
            'data' => $this->halal->findAll()
        ];
        return view('backend/halal/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Perusahaan Yang Sudah Mendapat Sertifikasi Halal',
            'validation' => $this->validation
        ];
        return view('backend/halal/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('halal')) {
            // dd($this->request->getVar());
            return redirect()->to('fas-halal/tambah')->withInput();
        }

        $this->halal->save($this->request->getPost());

        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil ditambah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('fas-halal');
    }

    public function ubah($id = null)
    {
        $halal = $this->halal->find($id);
        if ($id === null || empty($halal)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Ubah Perusahaan Yang Sudah Mendapat Sertifikasi Halal',
            'validation' => $this->validation,
            'data' => $halal
        ];
        return view('backend/halal/ubah', $data);
    }

    public function update()
    {
        if (!$this->validate('halal')) {
            return redirect()->to('fas-halal/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $this->halal->save($this->request->getPost());

        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil diubah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('fas-halal');
    }

    public function hapus($id = null)
    {
        $halal = $this->halal->find($id);
        if ($id === null || empty($halal)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->halal->delete($id);
        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil dihapus",
        );
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('fas-halal');
    }
}
