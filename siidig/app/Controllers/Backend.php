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

            // mambuat daftar tabel
            $tabel_unit_usaha = [];
            $tabel_tk = [];
            $tabel_tk_gender = [];
            $tabel_investasi = [];
            $tabel_produksi = [];

            $tahun = $this->crud_model->select_custom("select distinct(tahun) from grafik_industri_tahunan order by tahun ASC");
            $tableName = getTableNameStatistik(user("kabkota_id"));
            $kecamatan = $this->crud_model->select_custom("select DISTINCT(kecamatan) from investasi where kabkota_id = '" . user("kabkota_id") . "' order by kecamatan ASC");

            foreach ($kecamatan as $kec) {
                $tabel_unit_usaha[$kec->kecamatan] = [];
                $tabel_tk[$kec->kecamatan] = [];
                $tabel_tk_gender[$kec->kecamatan] = [];
                $tabel_investasi[$kec->kecamatan] = [];
                $tabel_produksi[$kec->kecamatan] = [];
            }
            // dd($kecamatan);
            foreach ($tahun as $t) {
                foreach ($kecamatan as $kec) {
                    $row = $this->crud_model->select_data($tableName, 'getRow', ['tahun' => $t->tahun, 'kecamatan' => $kec->kecamatan]);
                    if (empty($row)) {
                        $tabel_unit_usaha[$kec->kecamatan][] = 0;
                        $tabel_tk[$kec->kecamatan][] = 0;
                        $tabel_tk_gender[$kec->kecamatan][] = 0;
                        $tabel_tk_gender[$kec->kecamatan][] = 0;
                        $tabel_investasi[$kec->kecamatan][] = 0;
                        $tabel_produksi[$kec->kecamatan][] = 0;
                    } else {
                        $tabel_unit_usaha[$kec->kecamatan][] = $row->unit_usaha;
                        $tabel_tk[$kec->kecamatan][] = $row->jumlah_tk;
                        $tabel_tk_gender[$kec->kecamatan][] = $row->tkl;
                        $tabel_tk_gender[$kec->kecamatan][] = $row->tkp;
                        $tabel_investasi[$kec->kecamatan][] = $row->investasi;
                        $tabel_produksi[$kec->kecamatan][] = $row->nilai_produksi;
                    }
                }
            }
            // dd($tabel_investasi);
            $data['tahun_tabel'] = $tahun;
            $data['tabel_unit_usaha'] = $tabel_unit_usaha;
            $data['tabel_tk'] = $tabel_tk;
            $data['tabel_tk_gender'] = $tabel_tk_gender;
            $data['tabel_investasi'] = $tabel_investasi;
            $data['tabel_produksi'] = $tabel_produksi;
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
        // return view('frontend/testing');
        // echo phpinfo();
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

    public function kontak()
    {
        $data = [
            'title' => 'Daftar Pesan Dari User',
            'data' => $this->crud_model->select_data("kontak", "getResult", false, null, ['created_at' => 'DESC'])
        ];
        return view('backend/kontak/index', $data);
    }

    public function detail_kontak($id = null)
    {
        if ($id === null) {
            $res = [
                'status' => false,
                'message' => 'ID Kosong'
            ];
            // return json_encode($res);
            return $this->response->setJSON($res);
        }

        $data = $this->crud_model->select_data('kontak', 'getRow', ['id' => $id]);
        if ($data) {
            $this->crud_model->update_data('kontak', ['status' => '1'], ['id' => $id]);
            $res = [
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ];
        } else {
            $res = [
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ];
        }
        return $this->response->setJSON($res);
    }
}
