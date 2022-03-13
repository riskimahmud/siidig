<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Blog extends BaseController
{
    protected $blog;

    public function __construct()
    {
        $this->blog = new BlogModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Berita',
            'data' => $this->blog->findAll()
        ];
        return view('backend/blog/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Berita',
            'validation' => $this->validation
        ];
        return view('backend/blog/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('blog')) {
            return redirect()->to('blog/tambah')->withInput();
        }

        $data = $this->request->getPost();
        $data['excerpt'] = character_limiter(strip_tags($this->request->getPost('body')), 100);

        $gambar = $this->request->getFile('gambar');
        $image = \Config\Services::image();
        $newName = $gambar->getRandomName();
        $image->withFile($gambar)->fit(450, 235)->save('uploads/berita/thumb_' . $newName);
        $gambar->move('uploads/berita/', $newName);
        $data['gambar'] =   $newName;

        $this->blog->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Berita berhasil ditambah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('blog');
    }

    public function ubah($id = null)
    {
        $blog = $this->blog->find($id);
        if ($id === null || empty($blog)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Ubah Berita',
            'validation' => $this->validation,
            'data' => $blog
        ];
        return view('backend/blog/ubah', $data);
    }

    public function update()
    {
        if (!$this->validate('blog_update')) {
            return redirect()->to('blog/ubah/' . $this->request->getPost('id'))->withInput();
        }

        $data = $this->request->getPost();
        $data['excerpt'] = character_limiter(strip_tags($this->request->getPost('body')), 100);

        $gambar = $this->request->getFile('gambar');
        if ($gambar->getError() !== 4) {
            $berita = $this->blog->find($this->request->getPost('id'));
            unlink('./uploads/berita/' . $berita['gambar']);
            unlink('./uploads/berita/thumb_' . $berita['gambar']);
            $image = \Config\Services::image();
            $newName = $gambar->getRandomName();
            $image->withFile($gambar)->fit(450, 235)->save('uploads/berita/thumb_' . $newName);
            $gambar->move('uploads/berita/', $newName);
            $data['gambar'] =   $newName;
        }

        $this->blog->save($data);

        $notifikasi = array(
            "status" => "success", "msg" => "Berita berhasil diubah",
        );

        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('blog');
    }

    public function hapus($id = null)
    {
        $blog = $this->blog->find($id);
        if ($id === null || empty($blog)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        unlink('./uploads/berita/' . $blog['gambar']);
        unlink('./uploads/berita/thumb_' . $blog['gambar']);

        $this->blog->delete($id);
        $notifikasi = array(
            "status" => "success", "msg" => "Berita berhasil dihapus",
        );
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('blog');
    }
}
