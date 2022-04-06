<?php

namespace App\Controllers;

use App\Models\KabkotaModel;
use App\Models\KemasanModel;

class Kemasan extends BaseController
{
    protected $kemasan;
    protected $kabkota;

    public function __construct()
    {
        $this->kemasan = new KemasanModel();
        $this->kabkota = new KabkotaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Perusahaan Yang Sudah Mendapat Fasilitasi Kemasan',
            'data' => $this->kemasan->findAll()
        ];
        return view('backend/kemasan/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Perusahaan Yang Sudah Mendapat Fasilitasi Kemasan',
            'validation' => $this->validation,
            'kabkota' => $this->kabkota->findAll()
        ];
        return view('backend/kemasan/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('kemasan')) {
            // dd($this->request->getVar());
            return redirect()->to('fas-kemasan/tambah')->withInput();
        }

        $this->kemasan->save($this->request->getPost());

        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil ditambah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('fas-kemasan');
    }

    public function ubah($id = null)
    {
        $kemasan = $this->kemasan->find($id);
        if ($id === null || empty($kemasan)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Ubah Perusahaan Yang Sudah Mendapat Fasilitasi Kemasan',
            'validation' => $this->validation,
            'data' => $kemasan,
            'kabkota' => $this->kabkota->findAll()
        ];
        return view('backend/kemasan/ubah', $data);
    }

    public function update()
    {
        if (!$this->validate('kemasan')) {
            return redirect()->to('fas-kemasan/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $this->kemasan->save($this->request->getPost());

        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil diubah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('fas-kemasan');
    }

    public function hapus($id = null)
    {
        $kemasan = $this->kemasan->find($id);
        if ($id === null || empty($kemasan)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->kemasan->delete($id);
        $notifikasi = array(
            "status" => "success", "msg" => "Perusahaan berhasil dihapus",
        );
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('fas-kemasan');
    }
}
