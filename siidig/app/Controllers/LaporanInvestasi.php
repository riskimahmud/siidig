<?php

namespace App\Controllers;

use App\Models\IndustriModel;
use App\Models\InvestasiModel;
use App\Models\KelKecModel;
use CodeIgniter\Controller;
use PhpParser\Node\Stmt\Continue_;

class LaporanInvestasi extends BaseController
{
    protected $folder = "investasi";
    protected $base = "investasi";
    protected $user;
    protected $kelkec;
    protected $investasi;
    protected $industri;

    public function __construct()
    {
        $this->kelkec = new KelKecModel();
        $this->investasi = new InvestasiModel();
        $this->industri = new IndustriModel();
    }

    public function index()
    {
        $data['title'] = "Daftar Investasi";

        $tahun = $this->request->getGet('tahun') ? $this->request->getGet('tahun') : date("Y");
        $filter = [
            'tahun' => $tahun
        ];
        $where = [
            'tahun' => $tahun
        ];
        $like = [];
        if (user("level") == "user") {
            $where['user_id'] = user("user_id");
        }

        $industri = $this->request->getGet('industri');
        if ($industri != "") {
            $where['industri_id'] = $industri;
            $filter['industri'] = $industri;
        }

        $kecamatan = $this->request->getGet('kecamatan');
        if ($kecamatan != "") {
            $where['kecamatan'] = $kecamatan;
            $filter['kecamatan'] = $kecamatan;
        }

        $kelurahan = $this->request->getGet('kelurahan');
        if ($kelurahan != "") {
            $where['keldesa'] = $kelurahan;
            $filter['kelurahan'] = $kelurahan;
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

            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        // 'color' => ['#000'],
                    ],
                ],
            ];

            $worksheet = $spreadsheet->getActiveSheet();

            $worksheet->getStyle('A1:U1')->applyFromArray($styleArray);
            $worksheet->getColumnDimension('B')->setAutoSize(true);
            $worksheet->getColumnDimension('C')->setAutoSize(true);

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
                $worksheet->getStyle('A5' . ':' . 'U' . ($x - 1))->applyFromArray($styleArray);
            }

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('laporan.xlsx');

            $name = "laporan.xlsx";
            return $this->response->download("laporan.xlsx", null)->setFileName("Laporan Investasi.xlsx");
            unlink($name);
        }

        $data['tahun'] = $tahun;
        $data['industri_option'] = $industri;
        $data['filter'] = $filter;
        $data['data'] = $this->investasi->where($where)->like($like)->findAll();
        $data['base'] = $this->base;
        $data['industri'] = $this->industri->findAll();
        $data['kecamatan'] = $this->kelkec->where(['kabkota_id' => user('kabkota_id'), 'parent' => ''])->orderBy('nama_kelkec', 'ASC')->findAll();
        if ($kecamatan != "") {
            $data['kelurahan'] = $this->kelkec->where(['kabkota_id' => user('kabkota_id'), 'parent' => $kecamatan])->orderBy('nama_kelkec', 'ASC')->findAll();
        } else {
            $data['kelurahan'] = $this->kelkec->where(['kabkota_id' => user('kabkota_id'), 'parent <>' => ''])->orderBy('nama_kelkec', 'ASC')->findAll();
        }
        $data['badan_usaha'] = ['Koperasi', 'Perjan', 'Perum', 'Persero', 'CV', 'PO', 'PT', 'Kelompok'];
        return view('backend/' . $this->folder . '/index', $data);
    }

    // detail
    public function detail($id)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $db = \Config\Database::connect();
        $builder = $db->table('investasi');
        $builder->select('industri.*, investasi.*');
        $builder->where('investasi.id', $id);
        $builder->join('industri', 'industri.id = investasi.industri_id');
        $investasi = $builder->get()->getRowArray();
        // $investasi = $this->investasi->join('industri', 'industri.id = investasi.industri_id')->find($id);
        if (empty($investasi)) {
            return redirect()->to("/investasi");
        }

        $data['title']  =   "Detail Investasi";
        $data['data']   =   $investasi;
        $data['base']   =   $this->base;
        return view('backend/' . $this->folder . '/detail', $data);
    }

    public function tambah()
    {
        $data['title'] = "Tambah Laporan Investasi";
        $data['validation'] = \Config\Services::validation();
        $data['base'] = $this->base;
        $data['kelkec'] = $this->kelkec->where(['parent <>' => '', 'kabkota_id' => user("kabkota_id")])->findAll();
        $data['industri'] = $this->industri->findAll();
        return view('backend/' . $this->folder . '/tambah', $data);
    }

    public function store()
    {
        if (!$this->validate('investasi_user')) {
            return redirect()->to('/investasi/tambah')->withInput();
        }

        $data = $this->request->getPost();
        $kelkec = $this->kelkec->find($data['kelkec']);
        $data['keldesa'] = $kelkec['nama_kelkec'];
        $data['kecamatan'] = $kelkec['parent'];

        $tambah = $this->investasi->insert($data);
        if ($tambah) {
            $notifikasi = array(
                "status" => "success", "msg" => "Laporan Investasi berhasil ditambah",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => $this->title . " gagal ditambah",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/investasi');
    }

    // ubah
    public function ubah($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $investasi = $this->investasi->where('user_id', user("user_id"))->find($id);
        if (empty($investasi)) {
            return redirect()->to("/investasi");
        }


        // $data["title"] = "Ubah " . $this->title . " " . ucfirst($level);
        $data['validation'] = \Config\Services::validation();
        $data['title'] = "Ubah Investasi";
        $data["data"] = $investasi;
        $data['base'] = $this->base;
        $data['kelkec'] = $this->kelkec->where(['parent <>' => '', 'kabkota_id' => user("kabkota_id")])->findAll();
        $data['industri'] = $this->industri->findAll();
        return view('backend/' . $this->folder . '/ubah', $data);
    }

    // update
    public function update()
    {
        if (!$this->validate('investasi_user')) {
            return redirect()->to('/investasi/tambah')->withInput();
        }

        $data = $this->request->getPost();
        $kelkec = $this->kelkec->find($data['kelkec']);
        $data['keldesa'] = $kelkec['nama_kelkec'];
        $data['kecamatan'] = $kelkec['parent'];

        // dd($data);

        $ubah = $this->investasi->save($data);
        if ($ubah) {
            $notifikasi = array(
                "status" => "success", "msg" => "Laporan Investasi berhasil diubah",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => $this->title . " gagal diubah",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/investasi');
    }

    // hapus
    public function hapus($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $investasi = $this->investasi->where('user_id', user("user_id"))->find($id);
        if (empty($investasi)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        } else {
            $hapus = $this->investasi->delete($id);
            if ($hapus) {
                $notifikasi = array(
                    "status" => "success", "msg" => "Investasi berhasil dihapus",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => $this->title . " gagal dihapus",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/investasi');
        }
    }

    // import
    public function import()
    {
        $data['title'] = "Import Data Laporan Investasi";
        $data['validation'] = \Config\Services::validation();
        $data['base'] = $this->base;
        $data['industri'] = $this->industri->findAll();
        return view('backend/' . $this->folder . '/import', $data);
    }

    public function do_import()
    {
        if (!$this->validate([
            'tahun' => ['label' => 'Tahun', 'rules' => 'required'],
            'industri' => ['label' => 'Tahun', 'rules' => 'required'],
            'excel' => 'uploaded[excel]|max_size[excel,1024]|mime_in[excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|ext_in[excel,xlsx]'
        ])) {
            return redirect()->to('/investasi/import')->withInput();
        }

        $file = $this->request->getFile('excel');
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file->getTempName());
        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow(); // e.g. 10

        // echo $worksheet->getCellByColumnAndRow(2, 2)->getValue();
        $data_import = [];
        for ($row = 3; $row <= $highestRow; ++$row) {
            if ($worksheet->getCellByColumnAndRow(17, $row)->getFormattedValue() >= "10000000") {
                continue;
            }

            if ($worksheet->getCellByColumnAndRow(17, $row)->getFormattedValue() == "" && $worksheet->getCellByColumnAndRow(14, $row)->getValue() == "" && $worksheet->getCellByColumnAndRow(3, $row)->getValue() == "" && $worksheet->getCellByColumnAndRow(13, $row)->getValue() == "") {
                break;
            }

            $baris = [
                // 'no' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
                'nama_ikm' => strtoupper($worksheet->getCellByColumnAndRow(2, $row)->getValue()),
                'nama' => strtoupper($worksheet->getCellByColumnAndRow(3, $row)->getValue()),
                'alamat' => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                'keldes' => strtoupper($worksheet->getCellByColumnAndRow(5, $row)->getValue()),
                'kecamatan' => strtoupper($worksheet->getCellByColumnAndRow(6, $row)->getValue()),
                'telp' => $worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                'bentuk_badan_usaha' => $worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                'tahun_izin' => $worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                'kode_kbli' => $worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                'kbli' => $worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                'komoditi' => $worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                'produk' => $worksheet->getCellByColumnAndRow(14, $row)->getValue(),
                'tkl' => $worksheet->getCellByColumnAndRow(15, $row)->getValue(),
                'tkp' => $worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                'nilai_investasi' => $worksheet->getCellByColumnAndRow(17, $row)->getFormattedValue(),
                'jumlah_produksi' => $worksheet->getCellByColumnAndRow(18, $row)->getFormattedValue(),
                'satuan' => $worksheet->getCellByColumnAndRow(19, $row)->getValue(),
                'nilai_produksi' => $worksheet->getCellByColumnAndRow(20, $row)->getFormattedValue(),
                'nilai_bbbp' => $worksheet->getCellByColumnAndRow(21, $row)->getFormattedValue(),
                'kabkota_id' => user("kabkota_id"),
                'user_id' => user("user_id"),
                'tahun' => $this->request->getPost('tahun'),
                'industri_id' => $this->request->getPost('industri'),
            ];
            array_push($data_import, $baris);
        }
        // dd($data_import);

        $import = $this->investasi->insertBatch($data_import);
        if ($import) {
            $notifikasi = array(
                "status" => "success", "msg" => "Investasi berhasil diimport",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => $this->title . " gagal diimport",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/investasi');
        // dd($data_import);
    }

    // download template excel
    public function download_template()
    {
        return $this->response->download('uploads/template-investasi.xlsx', null)->setFileName('FORMAT.xlsx');
    }

    // hapus semua dalam daftar
    public function hapus_semua()
    {
    }

    public function get_kelurahan()
    {
        $kec = $this->request->getPost('kec');
        if ($kec == "") {
            $kel = $this->kelkec->where(['kabkota_id' => user("kabkota_id"), 'parent <>' => ''])->findAll();
        } else {
            $kel = $this->kelkec->where(['parent' => $kec])->findAll();
        }
        $data = [
            'data' => $kel
        ];

        return $this->response->setJSON($data);
    }
}
