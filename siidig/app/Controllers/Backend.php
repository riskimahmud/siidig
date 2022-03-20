<?php

namespace App\Controllers;

use App\Models\UserModel;
use PhpOffice\PhpWord\Element\ListItemRun;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Shared\Html;

class Backend extends BaseController
{
    protected $user;
    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $data['title'] = "Beranda";
        $nilai_investasi = [];
        $jumlah_produksi = [];
        $nilai_produksi = [];
        $nilai_bbbp = [];
        $unit_usaha = [];
        $tenaga_kerja = [];
        $tahun = [];
        if (user("level") == "user") {
            $data['statistik_all']  =   $this->crud_model->select_data('grafik_kabkota_tahunan', 'getRow', ['id' => user("kabkota_id")], null, ['tahun' => 'DESC']);
            $grafik_tahunan =   $this->crud_model->select_data('grafik_kabkota_tahunan', 'getResult', ['id' => user("kabkota_id")], null, ['tahun' => 'ASC']);
            foreach ($grafik_tahunan as $gt) {
                array_push($nilai_investasi, intval($gt->nilai_investasi . '000'));
                array_push($jumlah_produksi, intval($gt->jumlah_produksi . '000'));
                array_push($nilai_produksi, intval($gt->nilai_produksi . '000'));
                array_push($nilai_bbbp, intval($gt->nilai_bbbp . '000'));
                array_push($unit_usaha, intval($gt->unit_usaha));
                array_push($tenaga_kerja, intval($gt->tenaga_kerja));
                array_push($tahun, intval($gt->tahun));
            }
            $series1 = [
                ['name' => 'Nilai Investasi', 'data' => $nilai_investasi],
                ['name' => 'Jumlah Produksi', 'data' => $jumlah_produksi],
                ['name' => 'Nilai Produksi', 'data' => $nilai_produksi],
                ['name' => 'Nilai BBBP', 'data' => $nilai_bbbp],
            ];
            $series2 = [
                ['name' => 'Unit Usaha', 'data' => $unit_usaha],
                ['name' => 'Tenaga Kerja', 'data' => $tenaga_kerja],
            ];
            $data['series1'] =   $series1;
            $data['series2'] =   $series2;
            $data['xaxis']  =   $tahun;
        } else {
            $data['statistik_all']  =   $this->crud_model->select_data('grafik_tahunan', 'getRow', null, null, ['tahun' => 'DESC']);
            $grafik_tahunan =   $this->crud_model->select_data('grafik_tahunan', 'getResult', null, null, ['tahun' => 'ASC']);
            foreach ($grafik_tahunan as $gt) {
                array_push($nilai_investasi, intval($gt->nilai_investasi));
                array_push($jumlah_produksi, intval($gt->jumlah_produksi));
                array_push($nilai_produksi, intval($gt->nilai_produksi));
                array_push($nilai_bbbp, intval($gt->nilai_bbbp));
                array_push($unit_usaha, intval($gt->unit_usaha));
                array_push($tenaga_kerja, intval($gt->tenaga_kerja));
                array_push($tahun, intval($gt->tahun));
            }
            $series1 = [
                ['name' => 'Nilai Investasi', 'data' => $nilai_investasi],
                ['name' => 'Jumlah Produksi', 'data' => $jumlah_produksi],
                ['name' => 'Nilai Produksi', 'data' => $nilai_produksi],
                ['name' => 'Nilai BBBP', 'data' => $nilai_bbbp],
            ];
            $series2 = [
                ['name' => 'Unit Usaha', 'data' => $unit_usaha],
                ['name' => 'Tenaga Kerja', 'data' => $tenaga_kerja],
            ];
            $data['series1'] =   $series1;
            $data['series2'] =   $series2;
            $data['xaxis']  =   $tahun;
        }
        // dd($data);
        return view('backend/beranda', $data);
    }

    public function coba()
    {
        echo phpinfo();
    }

    // profil
    public function profil()
    {
        if (user("user_id")) {
            if ($this->request->getVar('submit') && $this->validate('profil')) {
                $data = [
                    "id"    => $this->request->getPost('id'),
                    "nama" => $this->request->getPost('nama'),
                    "email" => $this->request->getPost('email'),
                    "username" => $this->request->getPost('username'),
                ];

                if ($this->request->getPost('password')) {
                    $data["password"] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                }

                $ubah = $this->user->save($data);
                if ($ubah) {
                    $notifikasi = array(
                        "status" => "success", "msg" => "Profil berhasil diubah",
                    );
                } else {
                    $notifikasi = array(
                        "status" => "danger", "msg" => "Profil gagal diubah",
                    );
                }
                session()->setFlashdata('notifikasi', $notifikasi);
                return redirect()->to('/profil');
            } else {
                $data['validation'] = \Config\Services::validation();
                $data["title"] = "Profil";
                $data["data"] = $this->user->find(user("user_id"));
                // $data["base"] = $this->base;
                return view('backend/profil', $data);
            }
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
    }

    public function cek_tmt()
    {
        $msg    =   '';
        $cek_tmt    =   $this->crud_model->select_data("pengajuan", "getNumRows", [
            "tmt <="    =>  date("Y-m-d"),
            "sinkron_simpeg"    =>  ""
        ]);
        $cek_pelantikan    =   $this->crud_model->select_data("pelantikan", "getNumRows", [
            "tgl_berlaku <="    =>  date("Y-m-d"),
            "sinkron_simpeg"    =>  ""
        ]);

        // $msg    =   "";

        if ($cek_tmt > 0) {
            $pegawai    =   $this->crud_model->select_field("nama, nip", "pengajuan", "getResult", [
                "tmt <="    =>  date("Y-m-d"),
                "sinkron_simpeg"    =>  ""
            ]);
            $msg    .=  "SPT dari :\n";
            $no_peg =   1;
            foreach ($pegawai as $peg) {
                if ($no_peg > 1) {
                    $msg    .=  "\n";
                }
                $msg    .=  $peg->nip . ", " . $peg->nama;
                $no_peg++;
            }
            $msg .= "\nBelum di Sinkron\n\n";
        }

        if ($cek_pelantikan > 0) {
            $msg    .=  "Ada $cek_pelantikan Pelantikan Yang Belum Di Sinkron";
        }

        if ($cek_tmt > 0 || $cek_pelantikan > 0) {
            $url = "https://api.telegram.org/bot1868733615:AAHZ3HM2Y_3xrYCuXj-RWqAQ5Tldnh4EzIE/sendMessage?parse_mode=markdown&chat_id=440788483";
            $url = $url . "&text=" . urlencode($msg);
            $ch = curl_init();
            $optArray = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
            );
            curl_setopt_array($ch, $optArray);
            $result = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);

            if ($err) {
                echo 'Pesan gagal terkirim, error :' . $err;
            } else {
                echo 'Pesan terkirim';
            }
        }
    }

    public function cek_spt($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pengajuan = $this->crud_model->select_data("pengajuan", "getRow", ["pengajuan_id" => $id, "status" => "4"]);
        if (empty($pengajuan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan', 0);
        }

        $data['pengajuan']  =   $pengajuan;
        return view('cek_spt', $data);
    }
}
