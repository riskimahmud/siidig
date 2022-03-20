<?php

namespace App\Controllers;

use App\Models\KabkotaModel;

class Statistik extends BaseController
{
    protected $kabkota;

    public function __construct()
    {
        $this->kabkota = new KabkotaModel();
    }

    public function index()
    {
        // $data = [];
        $where = [];
        // d($this->request->getGet());
        if (user('level') == "user") {
            $where['id'] = user('kabkota_id');
            $kabkota = $this->kabkota->find(user('kabkota_id'));
            $title_chart_next = ' di ' . ucwords(strtolower($kabkota['nama_kabkota']));
        } else {
            $kabkota = $this->request->getGet('kabkota');
            if ($kabkota != "") {
                $where['id'] = $kabkota;
                $kabkota = $this->kabkota->find($kabkota);
                $title_chart_next = ' di ' . ucwords(strtolower($kabkota['nama_kabkota']));
            }
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
            $title_chart_industri = 'Statistik Industri' . $title_chart_next;
            $statisktik_industri = $this->crud_model->select_data('grafik_all', 'getResult', $where, null, ['tahun' => 'ASC']);
        } else {
            $title_chart = 'Statistik Investasi';
            $statistik_investasi = $this->crud_model->select_data('grafik_tahunan', 'getResult', false, null, ['tahun' => 'ASC']);
            $title_chart_industri = 'Statistik Industri';
            $statisktik_industri = $this->crud_model->select_data('grafik_industri_tahunan', 'getResultArray', false, null, ['tahun' => 'ASC']);
        }

        // $sandang = [];
        // $pangan = [];

        // $tahun = $this->crud_model->select_custom("select distinct(tahun) from grafik_industri_tahunan order by tahun ASC");
        // foreach ($statisktik_industri as $si) {
        //     $sandang[] = null;
        //     $pangan[] = null;
        //     if ($si['industri_id'] == "1") {
        //         $sandang[] = $si['nilai_investasi'];
        //     }


        // }

        // d($sandang);
        // return false;


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
        // dd($data);
        return view('backend/statistik', $data);
    }
}
