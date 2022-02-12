<?php

namespace App\Controllers;

use App\Models\KabkotaModel;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $folder = "users";
    protected $title = "Users";
    protected $base = "users";
    protected $user;
    protected $kabkota;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->kabkota = new KabkotaModel();
    }

    public function index()
    {
        $data['title'] = "Daftar Users";
        // $data['data'] = $this->crud_model->select_field($field, "user", "getResult", ["level" => $level]);

        $data['data'] = $this->user->where('level', 'user')->all();
        $data['base'] = $this->base;
        // dd($data);
        return view('backend/' . $this->folder . '/index', $data);
    }

    // tambah skpd
    public function tambah()
    {
        $validation = [
            'kabkota' => [
                'label' => 'Kabupaten / Kota',
                'rules' => 'trim|required'
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'trim|required|is_unique[user.username,id,{id}]',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'trim|required',
            ],
        ];

        if ($this->request->getVar('submit') && $this->validate($validation)) {
            // dd($this->request->getPost());
            $data = [
                'kabkota_id' => $this->request->getPost('kabkota'),
                "username" => $this->request->getPost('username'),
                "password" => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                "nama" => $this->request->getPost('nama'),
            ];

            $tambah = $this->user->insert($data);
            if ($tambah) {
                $notifikasi = array(
                    "status" => "success", "msg" => $this->title . " berhasil ditambah",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => $this->title . " gagal ditambah",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/users');
        } else {
            $data['validation'] = \Config\Services::validation();
            // $data['title'] = "Tambah " . $this->title . " " . ucfirst($level);
            $data['title'] = "Tambah User";
            $data['kabkota'] = $this->kabkota->findAll();
            $data['base'] = $this->base;
            // dd($data);
            return view('backend/' . $this->folder . '/tambah', $data);
        }
    }

    // edit
    public function ubah($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
        $user = $this->user->where('level', 'user')->find($id);
        if (empty($user)) {
            return redirect()->to("/users");
        }

        $validation = [
            'kabkota' => [
                'label' => 'Kabupaten / Kota',
                'rules' => 'trim|required'
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'trim|required|is_unique[user.username,id,{id}]',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'permit_empty|min_length[8]',
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'trim|required',
            ],
        ];

        if ($this->request->getVar('submit') && $this->validate($validation)) {
            $data = [
                "id" => $this->request->getPost('id'),
                "username" => $this->request->getPost('username'),
                "nama"  => $this->request->getPost('nama'),
                "kabkota_id" => $this->request->getPost('kabkota')
            ];

            if ($this->request->getPost('password')) {
                $data["password"] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }

            $ubah = $this->user->save($data);
            if ($ubah) {
                $notifikasi = array(
                    "status" => "success", "msg" => $this->title . " berhasil diubah",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => $this->title . " gagal diubah",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/users');
        } else {
            $data['validation'] = \Config\Services::validation();
            // $data["title"] = "Ubah " . $this->title . " " . ucfirst($level);
            $data['title'] = "Ubah Users";
            $data["data"] = $user;
            $data['kabkota'] = $this->kabkota->findAll();
            $data["base"] = $this->base;
            return view('backend/' . $this->folder . '/ubah', $data);
        }
    }

    // hapus
    public function hapus($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
        $user = $this->user->where('level', 'user')->find($id);
        if (empty($user)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        } else {
            $hapus = $this->user->delete($id);
            if ($hapus) {
                $notifikasi = array(
                    "status" => "success", "msg" => $this->title . " berhasil dihapus",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => $this->title . " gagal dihapus",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/users');
        }
    }

    // reset password
    public function reset_password($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
        $user = $this->user->where('level', 'user')->find($id);
        if (empty($user)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        } else {
            $ubah = $this->user->update($id, ["password" => password_hash("12345678", PASSWORD_DEFAULT)]);
            if ($ubah) {
                $notifikasi = array(
                    "status" => "success", "msg" => "Password berhasil direset",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Password gagal direset",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/users');
        }
    }

    // toggle status
    public function toggle_status($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
        $user = $this->user->where('level', 'user')->find($id);
        if (empty($user)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        } else {
            if ($user['status'] == "1") {
                $data = ["status" => "0"];
            } else {
                $data = ["status" => "1"];
            }
            $ubah = $this->user->update($id, $data);
            if ($ubah) {
                $notifikasi = array(
                    "status" => "success", "msg" => "Status User berhasil diubah",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Status User gagal diubah",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/users');
        }
    }
}
