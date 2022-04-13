<?php

namespace App\Controllers;

use App\Models\IndustriModel;
use App\Models\InvestasiModel;
use App\Models\KabkotaModel;

class Admin extends BaseController
{
    private $investasi;
    private $kabkota;
    private $industri;

    public function __construct()
    {
        $this->investasi = new InvestasiModel();
        $this->kabkota = new KabkotaModel();
        $this->industri = new IndustriModel();
        // if (session()->get('user')["level"] == "opd") {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses', 0);
        // }
    }

    public function laporan_investasi()
    {
        $data['title'] = "Daftar Investasi";

        // $where = [];
        $tahun = $this->request->getVar('tahun') ? $this->request->getVar('tahun') : date("Y");
        $filter = ['tahun' => $tahun];
        $where = ['tahun' => $tahun];
        $like = [];

        $kabkota = $this->request->getVar('kabkota');
        if ($kabkota != "") {
            $filter['kabkota'] = $kabkota;
            $where['kabkota_id'] = $kabkota;
        }

        $industri = $this->request->getGet('industri');
        if ($industri != "") {
            $where['industri_id'] = $industri;
            $filter['industri'] = $industri;
        }

        $bentuk_badan_usaha = $this->request->getGet('bentuk_badan_usaha');
        if ($bentuk_badan_usaha != "") {
            $where['bentuk_badan_usaha'] = $bentuk_badan_usaha;
            $filter['bentuk_badan_usaha'] = $bentuk_badan_usaha;
        }

        $komoditi = $this->request->getGet('komoditi');
        if ($komoditi != "") {
            $like['komoditi'] = $komoditi;
            $filter['komoditi'] = $komoditi;
        }

        $produk = $this->request->getGet('produk');
        if ($produk != "") {
            $like['produk'] = $produk;
            $filter['produk'] = $produk;
        }

        $cetak = $this->request->getGet('cetak');
        if ($cetak != "") {
            $data_investasi = $this->investasi->where($where)->like($like)->join('kabkota', 'kabkota.id = investasi.kabkota_id')->findAll();
            // dd($data_investasi);
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('uploads/template-cetak-investasi.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getCell('A1')->setValue('Laporan Investasi');

            if (!empty($data_investasi)) {
                $no = 1;
                $x = 5;
                foreach ($data_investasi as $row) {
                    $worksheet->setCellValue('A' . $x, $no++);
                    $worksheet->setCellValue('B' . $x, $row['nama_ikm']);
                    $worksheet->setCellValue('C' . $x, $row['nama_pemilik']);
                    $worksheet->setCellValue('D' . $x, $row['alamat']);
                    $worksheet->setCellValue('E' . $x, $row['keldesa']);
                    $worksheet->setCellValue('F' . $x, $row['kecamatan']);
                    $worksheet->setCellValue('G' . $x, $row['nama_kabkota']);
                    $worksheet->setCellValue('H' . $x, $row['telp']);
                    $worksheet->setCellValue('I' . $x, $row['bentuk_badan_usaha']);
                    $worksheet->setCellValue('J' . $x, $row['tahun_izin']);
                    $worksheet->setCellValue('K' . $x, $row['kode_kbli']);
                    $worksheet->setCellValue('L' . $x, $row['kbli']);
                    $worksheet->setCellValue('M' . $x, $row['komoditi']);
                    $worksheet->setCellValue('N' . $x, $row['produk']);
                    $worksheet->setCellValue('O' . $x, $row['tkl']);
                    $worksheet->setCellValue('P' . $x, $row['tkp']);
                    $worksheet->setCellValue('Q' . $x, $row['nilai_investasi']);
                    $worksheet->setCellValue('R' . $x, $row['jumlah_produksi']);
                    $worksheet->setCellValue('S' . $x, $row['satuan']);
                    $worksheet->setCellValue('T' . $x, $row['nilai_produksi']);
                    $worksheet->setCellValue('U' . $x, $row['nilai_bbbp']);
                    $x++;
                }
            }

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('laporan.xlsx');

            $name = "laporan.xlsx";
            return $this->response->download("laporan.xlsx", null)->setFileName("Laporan Investasi.xlsx");
            unlink($name);
        }

        $data['tahun'] = $tahun;
        $data['kabkota'] = $this->kabkota->findAll();
        $data['industri'] = $this->industri->findAll();
        $data['data'] = $this->investasi->where($where)->like($like)->findAll();
        $data['filter'] = $filter;
        $data['badan_usaha'] = ['Koperasi', 'Perjan', 'Perum', 'Persero', 'CV', 'PO', 'PT', 'Kelompok'];
        // dd($data);
        return view('backend/laporan/index', $data);
    }

    public function laporan_investasi_detail($id = null)
    {
        $investasi = $this->investasi->where('investasi.id', $id)->join('kabkota', 'kabkota.id = investasi.kabkota_id')->join('industri', 'industri.id = investasi.industri_id')->first();
        if (empty($investasi)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $data = [
            'title' => 'Detail Investasi',
            'data' => $investasi
        ];

        // dd($data);
        return view('backend/laporan/detail', $data);
    }

    public function cetak_investasi()
    {
        dd($this->request->getVar());
    }
}
