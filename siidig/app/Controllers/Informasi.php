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
