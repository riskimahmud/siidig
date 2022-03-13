<?php

namespace App\Controllers;

use App\Models\KabkotaModel;
use App\Models\UserModel;

class Login extends BaseController
{
    protected $base = 'frontend';
    protected $konten = '/frontend';
    protected $userModel;
    protected $kabkota;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kabkota = new KabkotaModel();
    }

    public function index()
    {
        if (!session()->has('user')) {
            $data = [];
            $data['title'] = "Login";
            return view("login", $data);
        } else {
            return redirect()->to('backend');
        }
    }

    public function do_login()
    {
        $username = $this->request->getVar('username');
        $cek_username = $this->userModel->cekUsername($username);
        if (!empty($cek_username)) {
            $password = password_verify($this->request->getVar("password"), $cek_username['password']);
            if ($password) {
                $data = $cek_username;
                if ($data['status'] == "0") {
                    $notifikasi = array(
                        "status" => "danger", "msg" => "Akun anda sedang di nonaktifkan",
                    );
                    session()->setFlashdata('notifikasi', $notifikasi);
                    return redirect()->to('/login');
                } else {
                    $this->userModel->update($data['id'], ['last_login' => date("Y-m-d H:i:s")]);
                    $session_user = [
                        "user_id" => $data["id"],
                        "username" => $data["username"],
                        "nama" => $data["nama"],
                        "level" => $data["level"],
                        "kabkota_id" => $data["kabkota_id"],
                    ];
                    if ($data['level'] == "user") {
                        $nama_kabkota = $this->kabkota->where('id', $data['kabkota_id'])->findColumn('nama_kabkota');
                        $session_user["nama_kabkota"] = $nama_kabkota;
                    }
                    // dd($session_user);
                    $this->session->set('user', $session_user);
                    // echo "ini";
                    return redirect()->to('/beranda');
                }
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Username atau Password Salah",
                );
                session()->setFlashdata('notifikasi', $notifikasi);
                return redirect()->to('/login');
            }
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "Username tidak terdaftar",
            );
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $notifikasi = array(
            "status" => "info", "msg" => "Selamat Tinggal. Anda Berhasil Keluar",
        );

        $this->session->setFlashdata("notifikasi", $notifikasi);
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
