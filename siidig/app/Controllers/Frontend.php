<?php

namespace App\Controllers;

use App\Models\HalalModel;
use App\Models\KabkotaModel;
use App\Models\KemasanModel;
use App\Models\SiinasModel;

class Frontend extends BaseController
{
    private $kabkota;
    private $halal;
    private $kemasan;

    public function __construct()
    {
        $this->halal = new HalalModel();
        $this->kemasan = new KemasanModel();
        $this->kabkota = new KabkotaModel();
    }

    public function landing()
    {
        $data = [
            'title' => 'Statistik Industri Provinsi Gorontalo'
        ];
        return view('frontend/landing', $data);
    }

    public function index()
    {
        // $data = [
        //     'header' => $this->crud_model->select_data('header', 'getResultArray', ['status' => 'publish']),
        //     'pelatihan' => $this->crud_model->select_data('pelatihan', 'getResultArray', ['status' => 'publish', 'tgl_pelaksanaan >=' => date("Y-m-d")], null, ['tgl_pelaksanaan' => 'DESC'], 3),
        //     'berita' => $this->crud_model->select_data('berita', 'getResultArray', ['status' => 'publish'], null, ['created_at' => 'DESC'], 3),
        //     'aplikasi' => $this->crud_model->select_data('aplikasi', 'getResultArray'),
        //     'count' => $this->crud_model->select_data('grafik_tahunan', 'getRow', false, null, ['tahun' => 'DESC'])
        // ];
        $where = [];
        $title_chart_next = '';
        // d($this->request->getGet());
        $kabkota = $this->request->getGet('kabkota');
        if ($kabkota != "") {
            $where['id'] = $kabkota;
            $kabkota = $this->kabkota->find($kabkota);
            $title_chart_next .= ' di ' . ucwords(strtolower($kabkota['nama_kabkota']));
        }

        $dari_tahun = $this->request->getGet('dari_tahun');
        if ($dari_tahun != "") {
            $where['tahun >='] = $dari_tahun;
            $title_chart_next .= ' dari tahun ' . $dari_tahun;
        }

        $sampai_tahun = $this->request->getGet('sampai_tahun');
        if ($sampai_tahun != "") {
            $where['tahun <='] = $sampai_tahun;
            $title_chart_next .= ' sampai tahun ' . $sampai_tahun;
        }

        if (count($where) > 0) {
            $title_chart = 'Statistik Investasi' . $title_chart_next;
            $statistik_investasi = $this->crud_model->select_data('grafik_kabkota_tahunan', 'getResult', $where, null, ['tahun' => 'ASC']);
        } else {
            $title_chart = 'Statistik Investasi';
            $statistik_investasi = $this->crud_model->select_data('grafik_tahunan', 'getResult', false, null, ['tahun' => 'ASC']);
        }


        $nilai_investasi = [];
        $jumlah_produksi = [];
        $nilai_produksi = [];
        $nilai_bbbp = [];
        $tenaga_kerja_laki = [];
        $tenaga_kerja_perempuan = [];
        $tenaga_kerja = [];
        $unit_usaha = [];
        $xaxis = [];

        foreach ($statistik_investasi as $s) {
            $xaxis[] = $s->tahun;
            $nilai_investasi[] = $s->nilai_investasi;
            $nilai_produksi[] = $s->nilai_produksi;
            $nilai_bbbp[] = $s->nilai_bbbp;
            $jumlah_produksi[] = $s->jumlah_produksi;

            $tenaga_kerja_laki[] = $s->tenaga_kerja_laki;
            $tenaga_kerja_perempuan[] = $s->tenaga_kerja_perempuan;
            $tenaga_kerja[] = $s->tenaga_kerja;
            $unit_usaha[] = $s->unit_usaha;
        }

        $series = [
            [
                'name' => 'Nilai Investasi',
                'data' => $nilai_investasi
            ],
            [
                'name' => 'Nilai Produksi',
                'data' => $nilai_produksi
            ],
            [
                'name' => 'Nilai BBBP',
                'data' => $nilai_bbbp
            ],
            [
                'name' => 'Jumlah Produksi',
                'data' => $jumlah_produksi
            ],
        ];

        $series_tk_unitusaha = [
            [
                'name' => 'Unit Usaha',
                'data' => $unit_usaha
            ],
            [
                'name' => 'Tenaga Kerja',
                'data' => $tenaga_kerja
            ],
        ];


        // echo json_encode($series, JSON_NUMERIC_CHECK);
        // return;
        // dd($series);
        $statistik_tk_now = end($statistik_investasi);
        $series_tk_now = [
            [
                'name' => 'Laki-laki',
                'y' => ($statistik_tk_now) ? $statistik_tk_now->tenaga_kerja_laki : null
            ],
            [
                'name' => 'Perempuan',
                'y' => ($statistik_tk_now) ? $statistik_tk_now->tenaga_kerja_perempuan : null
            ],
        ];
        // dd($statistik_tk_now);

        $sandang = ['name' => 'SANDANG'];
        $pangan = ['name' => 'PANGAN'];
        $kimia = ['name' => 'KIMIA & BAHAN BANGUNAN'];
        $kerajinan = ['name' => 'KERAJINAN'];
        $logam = ['name' => 'INDUSTRI LOGAM & ELEKTRONIK'];
        $furniture = ['name' => 'FURNITURE'];
        $xaxis_industri = [];

        $tahun = $this->crud_model->select_custom("select distinct(tahun) from grafik_industri_tahunan order by tahun ASC");
        // $industri = $this->crud_model->select_custom("select * from industri");
        foreach ($tahun as $t) {
            $xaxis_industri[] = $t->tahun;
            if ($kabkota != "") {
                $q_sandang = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '1', 'tahun' => $t->tahun]));
            } else {
                $q_sandang = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '1', 'tahun' => $t->tahun]);
            }
            (empty($q_sandang)) ? $sandang['data'][] = 0 : $sandang['data'][] = $q_sandang->nilai_investasi;

            if ($kabkota != "") {
                $q_pangan = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '2', 'tahun' => $t->tahun]));
            } else {
                $q_pangan = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '2', 'tahun' => $t->tahun]);
            }
            (empty($q_pangan)) ? $pangan['data'][] = 0 : $pangan['data'][] = $q_pangan->nilai_investasi;

            if ($kabkota != "") {
                $q_kimia = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '3', 'tahun' => $t->tahun]));
            } else {
                $q_kimia = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '3', 'tahun' => $t->tahun]);
            }
            (empty($q_kimia)) ? $kimia['data'][] = 0 : $kimia['data'][] = $q_kimia->nilai_investasi;

            if ($kabkota != "") {
                $q_kerajinan = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '4', 'tahun' => $t->tahun]));
            } else {
                $q_kerajinan = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '4', 'tahun' => $t->tahun]);
            }
            (empty($q_kerajinan)) ? $kerajinan['data'][] = 0 : $kerajinan['data'][] = $q_kerajinan->nilai_investasi;

            if ($kabkota != "") {
                $q_logam = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '5', 'tahun' => $t->tahun]));
            } else {
                $q_logam = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '5', 'tahun' => $t->tahun]);
            }
            (empty($q_logam)) ? $logam['data'][] = 0 : $logam['data'][] = $q_logam->nilai_investasi;

            if ($kabkota != "") {
                $q_furniture = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '6', 'tahun' => $t->tahun]));
            } else {
                $q_furniture = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '6', 'tahun' => $t->tahun]);
            }
            (empty($q_furniture)) ? $furniture['data'][] = 0 : $furniture['data'][] = $q_furniture->nilai_investasi;
        }
        $series_industri = [$sandang, $pangan, $kimia, $kerajinan, $logam, $furniture];

        // untuk tabel
        $kabupaten_kota = $this->kabkota->findAll();
        // $tabel_unit_usaha = [
        //     ['Kota Gorontalo', 3132, 2926, 3448, 3515, 3549],
        //     ['Kab. Gorontalo', 3295, 3442, 3558, 3928, 4144],
        // ];
        // dd($kabupaten_kota);
        $tabel_unit_usaha = [];
        $tabel_tk = [];
        $tabel_tk_gender = [];
        $tabel_investasi = [];
        $tabel_produksi = [];
        foreach ($kabupaten_kota as $kk) {
            $tabel_unit_usaha[$kk['nama_kabkota']] = [];
            $tabel_tk[$kk['nama_kabkota']] = [];
            $tabel_tk_gender[$kk['nama_kabkota']] = [];
            $tabel_investasi[$kk['nama_kabkota']] = [];
            $tabel_produksi[$kk['nama_kabkota']] = [];
        }
        foreach ($tahun as $t) {
            foreach ($kabupaten_kota as $kk) {
                // echo $t->tahun . " - " . $kk['nama_kabkota'] . "<br>";
                $data = $this->crud_model->select_data('grafik_kabkota_tahunan', 'getRow', ['tahun' => $t->tahun, 'id' => $kk['id']]);
                if (empty($data)) {
                    $tabel_unit_usaha[$kk['nama_kabkota']][] = 0;
                    $tabel_tk[$kk['nama_kabkota']][] = 0;
                    $tabel_tk_gender[$kk['nama_kabkota']][] = 0;
                    $tabel_tk_gender[$kk['nama_kabkota']][] = 0;
                    $tabel_investasi[$kk['nama_kabkota']][] = 0;
                    $tabel_produksi[$kk['nama_kabkota']][] = 0;
                } else {
                    $tabel_unit_usaha[$kk['nama_kabkota']][] = $data->unit_usaha;
                    $tabel_tk[$kk['nama_kabkota']][] = $data->tenaga_kerja;
                    $tabel_tk_gender[$kk['nama_kabkota']][] = $data->tenaga_kerja_laki;
                    $tabel_tk_gender[$kk['nama_kabkota']][] = $data->tenaga_kerja_perempuan;
                    $tabel_investasi[$kk['nama_kabkota']][] = $data->nilai_investasi;
                    $tabel_produksi[$kk['nama_kabkota']][] = $data->nilai_produksi;
                }
            }
        }
        // d($tahun);
        // return false;

        $data = [
            'data' => $statistik_investasi,
            'title_chart' => $title_chart,
            'title' => 'Statistik Industri Provinsi Gorontalo',
            'kabkota' => $this->kabkota->findAll(),
            'series' => $series,
            'series_tk_unitusaha' => $series_tk_unitusaha,
            'series_tk_now' => $series_tk_now,
            'xaxis' => $xaxis,
            'series_industri' => $series_industri,
            'count' => $this->crud_model->select_data('grafik_tahunan', 'getRow', false, null, ['tahun' => 'DESC']),
            'filter' => $this->request->getGet(),

            'tahun_tabel' => $tahun,
            'tabel_unit_usaha' => $tabel_unit_usaha,
            'tabel_tk' => $tabel_tk,
            'tabel_tk_gender' => $tabel_tk_gender,
            'tabel_investasi' => $tabel_investasi,
            'tabel_produksi' => $tabel_produksi,
        ];
        return view('frontend/home', $data);
    }

    public function statistik_lama()
    {
        $where = [];
        // d($this->request->getGet());
        $kabkota = $this->request->getGet('kabkota');
        if ($kabkota != "") {
            $where['id'] = $kabkota;
            $kabkota = $this->kabkota->find($kabkota);
            $title_chart_next = ' di ' . ucwords(strtolower($kabkota['nama_kabkota']));
        }

        $dari_tahun = $this->request->getGet('dari_tahun');
        if ($dari_tahun != "") {
            $where['tahun >='] = $dari_tahun;
            $title_chart_next .= ' dari tahun ' . $dari_tahun;
        }

        $sampai_tahun = $this->request->getGet('sampai_tahun');
        if ($sampai_tahun != "") {
            $where['tahun <='] = $sampai_tahun;
            $title_chart_next .= ' sampai tahun ' . $sampai_tahun;
        }

        if (count($where) > 0) {
            $title_chart = 'Statistik Investasi' . $title_chart_next;
            $statistik_investasi = $this->crud_model->select_data('grafik_kabkota_tahunan', 'getResult', $where, null, ['tahun' => 'ASC']);
        } else {
            $title_chart = 'Statistik Investasi';
            $statistik_investasi = $this->crud_model->select_data('grafik_tahunan', 'getResult', false, null, ['tahun' => 'ASC']);
        }


        $nilai_investasi = [];
        $jumlah_produksi = [];
        $nilai_produksi = [];
        $nilai_bbbp = [];
        $tenaga_kerja_laki = [];
        $tenaga_kerja_perempuan = [];
        $tenaga_kerja = [];
        $unit_usaha = [];
        $xaxis = [];

        foreach ($statistik_investasi as $s) {
            $xaxis[] = $s->tahun;
            $nilai_investasi[] = $s->nilai_investasi;
            $nilai_produksi[] = $s->nilai_produksi;
            $nilai_bbbp[] = $s->nilai_bbbp;
            $jumlah_produksi[] = $s->jumlah_produksi;

            $tenaga_kerja_laki[] = $s->tenaga_kerja_laki;
            $tenaga_kerja_perempuan[] = $s->tenaga_kerja_perempuan;
            $tenaga_kerja[] = $s->tenaga_kerja;
            $unit_usaha[] = $s->unit_usaha;
        }

        $series = [
            [
                'name' => 'Nilai Investasi',
                'data' => $nilai_investasi
            ],
            [
                'name' => 'Nilai Produksi',
                'data' => $nilai_produksi
            ],
            [
                'name' => 'Nilai BBBP',
                'data' => $nilai_bbbp
            ],
            [
                'name' => 'Jumlah Produksi',
                'data' => $jumlah_produksi
            ],
        ];

        $series_tk_unitusaha = [
            [
                'name' => 'Unit Usaha',
                'data' => $unit_usaha
            ],
            [
                'name' => 'Tenaga Kerja',
                'data' => $tenaga_kerja
            ],
        ];

        $statistik_tk_now = end($statistik_investasi);
        $series_tk_now = [
            [
                'name' => 'Laki-laki',
                'y' => ($statistik_tk_now) ? $statistik_tk_now->tenaga_kerja_laki : null
            ],
            [
                'name' => 'Perempuan',
                'y' => ($statistik_tk_now) ? $statistik_tk_now->tenaga_kerja_perempuan : null
            ],
        ];

        $sandang = ['name' => 'SANDANG'];
        $pangan = ['name' => 'PANGAN'];
        $kimia = ['name' => 'KIMIA & BAHAN BANGUNAN'];
        $kerajinan = ['name' => 'KERAJINAN'];
        $logam = ['name' => 'INDUSTRI LOGAM & ELEKTRONIK'];
        $xaxis_industri = [];

        $tahun = $this->crud_model->select_custom("select distinct(tahun) from grafik_industri_tahunan order by tahun ASC");
        $industri = $this->crud_model->select_custom("select * from industri");
        foreach ($tahun as $t) {
            $xaxis_industri[] = $t->tahun;
            if ($kabkota != "") {
                $q_sandang = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '1', 'tahun' => $t->tahun]));
            } else {
                $q_sandang = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '1', 'tahun' => $t->tahun]);
            }
            (empty($q_sandang)) ? $sandang['data'][] = 0 : $sandang['data'][] = $q_sandang->nilai_investasi;

            if ($kabkota != "") {
                $q_pangan = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '2', 'tahun' => $t->tahun]));
            } else {
                $q_pangan = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '2', 'tahun' => $t->tahun]);
            }
            (empty($q_pangan)) ? $pangan['data'][] = 0 : $pangan['data'][] = $q_pangan->nilai_investasi;

            if ($kabkota != "") {
                $q_kimia = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '3', 'tahun' => $t->tahun]));
            } else {
                $q_kimia = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '3', 'tahun' => $t->tahun]);
            }
            (empty($q_kimia)) ? $kimia['data'][] = 0 : $kimia['data'][] = $q_kimia->nilai_investasi;

            if ($kabkota != "") {
                $q_kerajinan = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '4', 'tahun' => $t->tahun]));
            } else {
                $q_kerajinan = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '4', 'tahun' => $t->tahun]);
            }
            (empty($q_kerajinan)) ? $kerajinan['data'][] = 0 : $kerajinan['data'][] = $q_kerajinan->nilai_investasi;

            if ($kabkota != "") {
                $q_logam = $this->crud_model->select_data('grafik_all', 'getRow', array_merge($where, ['industri_id' => '5', 'tahun' => $t->tahun]));
            } else {
                $q_logam = $this->crud_model->select_data('grafik_industri_tahunan', 'getRow', ['industri_id' => '5', 'tahun' => $t->tahun]);
            }
            (empty($q_logam)) ? $logam['data'][] = 0 : $logam['data'][] = $q_logam->nilai_investasi;
        }
        $series_industri = [$sandang, $pangan, $kimia, $kerajinan, $logam];

        $data = [
            'data' => $statistik_investasi,
            'title_chart' => $title_chart,
            'title' => 'Statistik',
            'kabkota' => $this->kabkota->findAll(),
            'series' => $series,
            'series_tk_unitusaha' => $series_tk_unitusaha,
            'series_tk_now' => $series_tk_now,
            'series_industri' => $series_industri,
            'xaxis' => $xaxis,
            'count' => $this->crud_model->select_data('grafik_tahunan', 'getRow', false, null, ['tahun' => 'DESC']),
            'filter' => $this->request->getGet()
        ];

        // echo json_encode($data['series_industri'], JSON_NUMERIC_CHECK);
        // return false;
        // dd($data);
        return view('frontend/statistik', $data);
    }

    public function pelatihan($id = null)
    {
        if ($id !== null) {
            $pelatihan = $this->crud_model->select_data('pelatihan', 'getRow', ['status' => 'publish', 'slug' => $id]);
            $title = $pelatihan->title;
        } else {
            $pelatihan = $this->crud_model->select_data('pelatihan', 'getResult', ['status' => 'publish'], null, ['tgl_pelaksanaan' => 'DESC']);
            $title = 'Pelatihan';
        }

        $data = [
            'title' => $title,
            'data' => $pelatihan
        ];
        if ($id !== null) {
            return view('frontend/detail_pelatihan', $data);
        } else {
            return view('frontend/pelatihan', $data);
        }
    }

    public function berita($id = null)
    {
        if ($id !== null) {
            $berita = $this->crud_model->select_data('berita', 'getRow', ['status' => 'publish', 'slug' => $id]);
            if (!empty($berita)) {
                $this->crud_model->update_data('berita', ['hits' => $berita->hits + 1], ['id' => $berita->id]);
            }
        } else {
            $berita = $this->crud_model->select_data('berita', 'getResult', ['status' => 'publish'], null, ['created_at' => 'DESC']);
        }

        $data = [
            'data' => $berita
        ];
        if ($id !== null) {
            return view('frontend/detail_berita', $data);
        } else {
            return view('frontend/berita', $data);
        }
    }

    // kirim pesan
    public function kontak()
    {
        if (!$this->validate([
            'nama' => 'required',
            'telp' => 'required|min_length[9]|numeric',
            'email'    => 'required|valid_email',
            'pesan' => 'required'
        ])) {
            $data = [
                'success' => false,
                'data' => [],
                'msg' => "Gagal."
            ];
            return $this->response->setJSON($data);
        }

        $data_kontak = [
            'nama' => $this->request->getPost('nama'),
            'telp' => $this->request->getPost('telp'),
            'email' => $this->request->getPost('email'),
            'pesan' => $this->request->getPost('pesan'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $this->crud_model->insert_data('kontak', $data_kontak);

        $data = [
            'success' => true,
            'data' => [],
            'msg' => "Thanks for contact us. We get back to you"
        ];

        return $this->response->setJSON($data);
    }

    public function halal()
    {
        $data = [
            'title' => 'Fasilitasi Halal',
            'data' => $this->halal->findAll()
        ];
        return view('frontend/halal', $data);
    }

    public function kemasan()
    {
        $data = [
            'title' => 'Fasilitasi Kemasan',
            'data' => $this->kemasan->findAll()
        ];
        return view('frontend/kemasan', $data);
    }

    public function siinas()
    {
        $siinas = new SiinasModel();
        $data = [
            'title' => 'Perusahaan Yang Terdaftar di SIINAS',
            'data' => $siinas->findAll()
        ];
        return view('frontend/siinas', $data);
    }

    // cetak rekapan PDF
    public function cetak_pdf($id)
    {
        $daftar = ['investasi', 'produksi', 'unit_usaha', 'tenaga_kerja', 'tenaga_kerja_gender'];
        if (in_array($id, $daftar)) {
            if ($id == "tenaga_kerja_gender") {
                $title = "REKAPAN Tenaga Kerja (Jenis Kelamin)";
            } else {
                $title = "ReKAPAN " . str_replace("_", " ", $id);
            }
            $tahun = $this->crud_model->select_custom("select distinct(tahun) from grafik_industri_tahunan order by tahun ASC");
            $kabupaten_kota = $this->kabkota->findAll();

            foreach ($tahun as $t) {
                foreach ($kabupaten_kota as $kk) {
                    // echo $t->tahun . " - " . $kk['nama_kabkota'] . "<br>";
                    $data = $this->crud_model->select_data('grafik_kabkota_tahunan', 'getRow', ['tahun' => $t->tahun, 'id' => $kk['id']]);
                    if (empty($data)) {
                        $tabel_unit_usaha[$kk['nama_kabkota']][] = 0;
                        $tabel_tk[$kk['nama_kabkota']][] = 0;
                        $tabel_tk_gender[$kk['nama_kabkota']][] = 0;
                        $tabel_tk_gender[$kk['nama_kabkota']][] = 0;
                        $tabel_investasi[$kk['nama_kabkota']][] = 0;
                        $tabel_produksi[$kk['nama_kabkota']][] = 0;
                    } else {
                        $tabel_unit_usaha[$kk['nama_kabkota']][] = $data->unit_usaha;
                        $tabel_tk[$kk['nama_kabkota']][] = $data->tenaga_kerja;
                        $tabel_tk_gender[$kk['nama_kabkota']][] = $data->tenaga_kerja_laki;
                        $tabel_tk_gender[$kk['nama_kabkota']][] = $data->tenaga_kerja_perempuan;
                        $tabel_investasi[$kk['nama_kabkota']][] = $data->nilai_investasi;
                        $tabel_produksi[$kk['nama_kabkota']][] = $data->nilai_produksi;
                    }
                }
            }

            $data = [
                'tahun_tabel' => $tahun,
                'tabel_unit_usaha' => $tabel_unit_usaha,
                'tabel_tk' => $tabel_tk,
                'tabel_tk_gender' => $tabel_tk_gender,
                'tabel_investasi' => $tabel_investasi,
                'tabel_produksi' => $tabel_produksi,
                'id' => $id,
                'title' => $title
            ];
            // return view('frontend/home', $data);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml(view('cetak_pdf', $data));
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            // return $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
            $dompdf->stream();
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
    }
}
