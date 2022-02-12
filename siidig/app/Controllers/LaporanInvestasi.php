<?php

namespace App\Controllers;

use App\Models\IndustriModel;
use App\Models\InvestasiModel;
use App\Models\KelKecModel;
use CodeIgniter\Controller;

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

        $tahun = $this->request->getPost('tahun') ? $this->request->getPost('tahun') : date("Y");
        // dd($this->investasi);
        $user = [];
        if (user("level") == "user") {
            $user = ['user_id' => user("user_id")];
        }

        $data['tahun'] = $tahun;
        $data['data'] = $this->investasi->where(array_merge($user, ['tahun' => $tahun]))->findAll();
        $data['base'] = $this->base;
        return view('backend/' . $this->folder . '/index', $data);
    }

    // detail
    public function detail($id)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $investasi = $this->investasi->find($id);
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
        $this->session->remove('data_import');
        $file = $this->request->getFile('excel');
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file->getTempName());
        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow(); // e.g. 10

        // echo $worksheet->getCellByColumnAndRow(2, 2)->getValue();
        $data_import = [];
        for ($row = 2; $row <= $highestRow; ++$row) {
            $baris = [
                'nama' => $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
                'umur' => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                'hobi' => $worksheet->getCellByColumnAndRow(3, $row)->getValue()
            ];
            if ($row == "2") {
                $baris['error'] = 'Data tidak valid';
            }
            array_push($data_import, $baris);
        }

        $data['title'] = "Verifikasi Data Import";
        $data['base'] = $this->base;
        $data['data'] = $data_import;
        $this->session->set('data_import', $data_import);
        return view('backend/' . $this->folder . '/verifikasi_import', $data);
    }
}
