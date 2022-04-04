<?php

namespace App\Controllers;

use App\Models\HalalModel;
use App\Models\KabkotaModel;
use App\Models\KemasanModel;

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

        $data = [
            'data' => $statistik_investasi,
            'title_chart' => $title_chart,
            'title' => 'Statistik Industri Provinsi Gorontalo',
            'kabkota' => $this->kabkota->findAll(),
            'series' => $series,
            'series_tk_unitusaha' => $series_tk_unitusaha,
            'series_tk_now' => $series_tk_now,
            'xaxis' => $xaxis,
            'count' => $this->crud_model->select_data('grafik_tahunan', 'getRow', false, null, ['tahun' => 'DESC']),
            'filter' => $this->request->getGet()
        ];
        return view('frontend/home', $data);
    }

    public function statistik()
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

        $data = [
            'data' => $statistik_investasi,
            'title_chart' => $title_chart,
            'title' => 'Statistik',
            'kabkota' => $this->kabkota->findAll(),
            'series' => $series,
            'series_tk_unitusaha' => $series_tk_unitusaha,
            'series_tk_now' => $series_tk_now,
            'xaxis' => $xaxis,
            'count' => $this->crud_model->select_data('grafik_tahunan', 'getRow', false, null, ['tahun' => 'DESC']),
            'filter' => $this->request->getGet()
        ];
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
}
