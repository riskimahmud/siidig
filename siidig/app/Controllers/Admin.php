<?php

namespace App\Controllers;

use App\Models\EcdModel;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\TemplateProcessor;

class Admin extends BaseController
{
    protected $arr_status = ["menunggu", "proses", "disetujui", "selesai", "tolak", "batalkan"];

    public function __construct()
    {
        if (session()->get('user')["level"] == "opd") {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses', 0);
        }
    }

    // filter pengajuan by skpd
    public function filter($url = "pengajuan")
    {
        $skpd   =   $this->request->getPost('skpd');
        $this->session->set('filter_skpd', $skpd);
        $this->session->set('filter_url', $url);
        return redirect()->to('/' . $url);
    }

    // hapus filter pengajuan by skpd
    public function hapus_filter($url = "pengajuan")
    {
        $this->session->remove('filter_skpd');
        return redirect()->to('/' . $url);
    }

    // pengajuan
    public function pengajuan($status = null)
    {
        $data['title'] = "Pengajuan";
        $data["status"]    =   "0";
        $where  =   ["user_id <>" => "1"];

        if (cekSession("filter_skpd")) {
            if (getSession("filter_url") != "pengajuan") {
                $this->session->remove('filter_skpd');
                $this->session->remove('filter_url');
            } else {
                $where["unorid_lama"]   =   getSession("filter_skpd");
            }
        }

        if ($status !== null && in_array($status, $this->arr_status)) {
            $data["status"] =   $status;
            if ($status == "menunggu") {
                $where["status"]    =   "1";
            } elseif ($status == "proses") {
                $where["status"]    =   "2";
            } elseif ($status == "disetujui") {
                $where["status"]    =   "3";
            } elseif ($status == "selesai") {
                $where["status"]    =   "4";
            } elseif ($status == "tolak") {
                $where["tolak"]    =   "1";
            } elseif ($status == "batalkan") {
                $where["status"]    =   "0";
            }
        }

        $data['data']   =   $this->crud_model->select_data("pengajuan", "getResult", $where, null, ["create_at" => "DESC"]);
        $data['skpd']   =   $this->simpeg_model->select_data("unor", "getResult", false, null, ["unorname" => "ASC"]);
        return view('backend/admin/pengajuan', $data);
    }

    // detail pengajuan
    public function detail_pengajuan($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $data['title'] = "Detail Pengajuan";
        $where  =   ["pengajuan_id" => $id];

        $pengajuan  =   $this->crud_model->select_data("pengajuan", "getRow", $where);
        if (empty($pengajuan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $this->crud_model->update_data("pengajuan", ["lihat_admin" => "0"], ["pengajuan_id" => $id]);

        $data['data']           =   $pengajuan;
        $data['riwayat_status'] =   $this->crud_model->select_data("riwayat_status", "getResult", ["pengajuan_id" => $id]);
        $where_syarat           =   ["jenis" => $pengajuan->jenis_pengajuan];
        $where_syarat_awal      =   ["awal" => "1"];
        if ($pengajuan->unorid_lama == $pengajuan->unorid_baru) {
            $where_syarat["sama_opd"]         =   "1";
            $where_syarat_awal["sama_opd"]    =   "1";
        } else {
            $where_syarat_awal["sama_opd"]    =   "0";
        }
        $data['syarat']         =   $this->crud_model->select_data("syarat", "getResult", $where_syarat);
        $data['syarat_awal']    =   $this->crud_model->select_data("syarat", "getResult", $where_syarat_awal);

        if ($pengajuan->user_id == "1") {
            $page   =   "spt";
        } else {
            $page   =   "pengajuan";
        }
        return view('backend/admin/detail_' . $page, $data);
    }

    // proses pengajuan
    public function proses_pengajuan($pengajuan_id = null)
    {
        if ($pengajuan_id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
        $data           =   [];

        $data_pengajuan =   $this->crud_model->select_data("pengajuan", "getRow", ["pengajuan_id" => $pengajuan_id]);

        if (empty($data_pengajuan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        if ($data_pengajuan->status == "1") {
            $status_baru    =   "2";
            $data["status"]  =   "2";
            $data["lihat_user"]  =   "0";
        }

        if ($data_pengajuan->status == "2") {
            return redirect()->to('/pengajuan/' . $pengajuan_id . '/setujui-pengajuan');
        }

        $simpan = $this->crud_model->update_data("pengajuan", $data, ["pengajuan_id" => $pengajuan_id]);
        if ($simpan) {
            $this->crud_model->insert_data("riwayat_status", [
                "pengajuan_id"  =>  $pengajuan_id,
                "status"    =>  $status_baru,
                "keterangan"    =>  "Lanjut Pemberkasan. Silahkan unggah berkas",
                "create_by" =>  user("nama") . " (" . strtoupper(user("level")) . ")",
            ]);
            $notifikasi = array(
                "status" => "success", "msg" => "Pengajuan berhasil diproses",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "Pengajuan gagal diproses",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/pengajuan/' . $pengajuan_id);
    }

    // tolak pengajuan
    public function tolak_pengajuan()
    {
        $pengajuan_id   =   $this->request->getPost('pengajuan_id');
        $alasan         =   $this->request->getPost('alasan');
        $data           =   [];

        $data_pengajuan =   $this->crud_model->select_data("pengajuan", "getRow", ["pengajuan_id" => $pengajuan_id]);
        // if ($data_pengajuan->status == "1") {
        //     $data["tolak"]  =   "1";
        //     $data["lihat_user"] =   "0";
        // }

        if ($data_pengajuan->status <= "2") {
            if ($this->request->getPost('ubah_berkas')) {
                $data["tolak"] =   "1";
                $data["edit_data"]  =   "1";
            } else {
                $data["tolak"] =   "1";
                $data["edit_data"]  =   "0";
            }
            $data["lihat_user"] =   "0";
        }

        $simpan = $this->crud_model->update_data("pengajuan", $data, ["pengajuan_id" => $pengajuan_id]);
        if ($simpan) {
            $this->crud_model->insert_data("riwayat_status", [
                "pengajuan_id"  =>  $pengajuan_id,
                "status"    =>  $data_pengajuan->status,
                "tolak"     =>  $data["tolak"],
                "keterangan"    =>  $alasan,
                "create_by" =>  user("nama") . " (" . strtoupper(user("level")) . ")",
            ]);
            $notifikasi = array(
                "status" => "success", "msg" => "Pengajuan berhasil ditolak",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "Pengajuan gagal ditolak",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/pengajuan/' . $pengajuan_id);
    }

    // setujui pengajuan
    public function setujui_pengajuan($pengajuan_id = null)
    {
        if ($pengajuan_id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $data_pengajuan =   $this->crud_model->select_data("pengajuan", "getRow", ["pengajuan_id" => $pengajuan_id, "status" => "2"]);

        if (empty($data_pengajuan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        if ($this->request->getVar('submit') && $this->validate('setujui_pengajuan')) {
            $data   =   [
                "tmt"   =>  $this->request->getPost('tmt'),
                "jenis_jabatan_baru"    =>  $this->request->getPost('jenis_jabatan_baru'),
                "tugas_sebagai"    =>  $this->request->getPost('tugas_sebagai'),
                "dasar" =>  json_encode($this->request->getPost('dasar')),
                "status"    =>  "3",
                "tolak" =>  "0",
                "lihat_user"    =>  "0",
                "unit_organisasi_baru"  =>  $this->request->getPost('unor_baru')
            ];
            // dd($data);

            $simpan = $this->crud_model->update_data("pengajuan", $data, ["pengajuan_id" => $this->request->getPost('pengajuan_id')]);
            if ($simpan) {
                $this->crud_model->insert_data("riwayat_status", [
                    "pengajuan_id"  =>  $this->request->getPost('pengajuan_id'),
                    "status"    =>  $data["status"],
                    "keterangan"    =>  "Pengajuan anda telah di setujui. Harap menunggu terbitnya surat tugas.",
                    "create_by" =>  user("nama") . " (" . strtoupper(user("level")) . ")",
                ]);
                $notifikasi = array(
                    "status" => "success", "msg" => "Pengajuan berhasil disetujui",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Pengajuan gagal disetujui",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/pengajuan/' . $pengajuan_id);
        } else {
            // dd($this->request->getPost());
            $data['validation'] = $this->validation;
            $data['title'] = "Form Untuk Setujui Pengajuan";
            $data['data']   =   $data_pengajuan;
            $where_jabatan  =   ["jabatanjns" => $data_pengajuan->jenis_pengajuan];
            if ($data_pengajuan->jenis_pengajuan == "Administrasi") {
                $where_jabatan["nmjabatan"] =   "Pelaksana";
            }
            $data['jenis_jabatan']  =   $this->simpeg_model->select_data("t_jabatankategori", "getResult", $where_jabatan);
            $data['pangkat']  =   $this->simpeg_model->select_data("r_pangkat", "getRow", ["newsid" => $data_pengajuan->newsid], null, ["tmt" => "DESC"]);
            $data['tugas']  =   $this->crud_model->select_data("master", "getResult", ["jenis" => "tugas"]);
            $data['unor']  =   $this->crud_model->select_data("master", "getResult", ["jenis" => "unor"]);
            // $data['pangkat']  =   $this->simpeg_model->select_data("t_golruang");
            // dd($data);
            // $data["base"] = $this->base;
            return view('backend/admin/setujui_pengajuan', $data);
        }
    }

    // ubah data sk
    public function ubah_sk($pengajuan_id = null)
    {
        if ($pengajuan_id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $data_pengajuan =   $this->crud_model->select_data("pengajuan", "getRow", ["pengajuan_id" => $pengajuan_id, "status >=" => "2", "status <" => "4"]);

        if (empty($data_pengajuan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        if ($this->request->getVar('submit') && $this->validate('ubah_sk')) {
            $pejabat_ttd    =   $this->crud_model->select_data("pejabat", "getRow", ["pejabat_id" => $this->request->getPost('sk_jabatan_ttd')]);
            $ttd = $pejabat_ttd->nama . ";" . $pejabat_ttd->pangkat . ";" . $pejabat_ttd->nip;
            $data   =   [
                "tmt"   =>  $this->request->getPost('tmt'),
                "jenis_jabatan_baru"    =>  $this->request->getPost('jenis_jabatan_baru'),
                "tugas_sebagai"    =>  $this->request->getPost('tugas_sebagai'),
                "dasar" =>  json_encode($this->request->getPost('dasar')),
                "unit_organisasi_baru"  =>  $this->request->getPost('unor_baru'),
                "sk_nomor"  =>  $this->request->getPost('sk_nomor'),
                "sk_tgl"  =>  $this->request->getPost('sk_tgl'),
                "pejabat_id"    =>  $this->request->getPost('sk_jabatan_ttd'),
                "sk_jabatan_ttd"  =>  $pejabat_ttd->jabatan,
                "sk_ttd"  =>  $ttd,
            ];
            $tembusan   =   $this->request->getPost('tembusan');
            if ($tembusan) {
                $sk_tembusan    =   "";
                $no_tembusan = 1;
                foreach ($tembusan as $tem) :
                    if ($no_tembusan > 1) {
                        $sk_tembusan .= ";";
                    }
                    $sk_tembusan .= $tem;
                    $no_tembusan++;
                endforeach;
                $data["sk_tembusan"]    =   $sk_tembusan;
            }
            // dd($data);

            $simpan = $this->crud_model->update_data("pengajuan", $data, ["pengajuan_id" => $this->request->getPost('pengajuan_id')]);
            if ($simpan) {
                $notifikasi = array(
                    "status" => "success", "msg" => "Data SK berhasil diperbarui",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Data SK gagal diperbarui",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);

            if ($data_pengajuan->user_id == "1") {
                $page   =   "spt";
            } else {
                $page   =   "pengajuan";
            }

            return redirect()->to('/' . $page . '/' . $pengajuan_id);
        } else {
            // dd($this->request->getPost());
            $data['validation'] = $this->validation;
            $data['title'] = "Ubah Data Surat Tugas";
            $data['data']   =   $data_pengajuan;
            $data['jenis_jabatan']  =   $this->simpeg_model->select_data("t_jabatankategori", "getResult", ["jabatanjns" => $data_pengajuan->jenis_pengajuan]);
            $data['tugas']  =   $this->crud_model->select_data("master", "getResult", ["jenis" => "tugas"]);
            $data['unor']  =   $this->crud_model->select_data("master", "getResult", ["jenis" => "unor"]);
            $data['pejabat']  =   $this->crud_model->select_data("pejabat");
            // $data["base"] = $this->base;
            return view('backend/admin/ubah_sk', $data);
        }
    }

    // selesaikan dan cetak
    public function cetak($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $where  =   ["pengajuan_id" => $id];

        $pengajuan  =   $this->crud_model->select_data("pengajuan", "getRow", $where);
        if (empty($pengajuan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        if ($pengajuan->sk_nomor == "") {
            $notifikasi = array(
                "status" => "danger", "msg" => "Data SK Belum Di isi",
            );
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/spt/' . $id);
        }


        // dd($where);

        if ($pengajuan->status == "3") {
            $data_qrcode =  base_url("cek_spt/" . $id);
            $nama_qrcode =  $id;

            $this->qrcode->generateQrCode($data_qrcode, $nama_qrcode);

            $data   =   [
                "status" => "4",
                "lihat_user" => "0"
            ];
            $simpan = $this->crud_model->update_data("pengajuan", $data, ["pengajuan_id" => $id]);
            if ($simpan) {
                if ($pengajuan->user_id != "1") {
                    $this->crud_model->insert_data("riwayat_status", [
                        "pengajuan_id"  =>  $id,
                        "status"    =>  "4",
                        "tolak"     =>  "0",
                        "keterangan"    =>  "Pengajuan telah selesai",
                        "create_by" =>  user("nama") . " (" . strtoupper(user("level")) . ")",
                    ]);
                }
                $notifikasi = array(
                    "status" => "success", "msg" => "Pengajuan berhasil diselesaikan",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Pengajuan gagal diselesaikan",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
        }

        $templateProcessor = new TemplateProcessor(WRITEPATH . 'template/template-spt.docx');

        $textlines = explode('\n', $pengajuan->sk_jabatan_ttd);
        $sk_jabatan_ttd = new TextRun(array(
            'alignment' => 'center'
        ));
        $sk_jabatan_ttd->addText(array_shift($textlines), ["bold" => true]);
        foreach ($textlines as $line) {
            $sk_jabatan_ttd->addTextBreak();
            $sk_jabatan_ttd->addText($line, ["bold" => true]);
        }
        $templateProcessor->setComplexBlock("sk_jabatan_ttd", $sk_jabatan_ttd);

        // $dasar  =   json_decode($pengajuan->dasar);
        // // dd($dasar);
        // $dasar_text = "";
        // foreach ($dasar as $d) {
        //     $dasar_text .= "<w:p>
        //                         <w:pPr>
        //                         <w:numPr>
        //                             <w:ilvl w:val='0'/>
        //                             <w:numId w:val='1'/>
        //                         </w:numPr>
        //                         </w:pPr>
        //                         <w:r>
        //                         <w:t>" . htmlspecialchars($d) . "</w:t>
        //                         </w:r>
        //                     </w:p>";
        // }
        // $templateProcessor->setValue('dasar', $dasar_text);

        $dasar = json_decode($pengajuan->dasar);

        $num_dasar = 1;
        $templateProcessor->cloneRow('Rowdasar', count($dasar));
        foreach ($dasar as $d) {
            $templateProcessor->setValue("Rowdasar#" . $num_dasar, $d);
            $num_dasar++;
        }

        $ttd = explode(";", $pengajuan->sk_ttd);

        $templateProcessor->setValues([
            'sk_nomor' => strtoupper($pengajuan->sk_nomor),
            'nama' => strtoupper($pengajuan->nama),
            'nip' => $pengajuan->nip,
            'pangkat' => htmlspecialchars(getFieldSimpeg('t_golruang', 'nmgolruang', ['idgolruang' => $pengajuan->pangkat]) . " - " . $pengajuan->pangkat),
            'jabatan_lama' => htmlspecialchars($pengajuan->nama_jabatan_lama),
            'unor' => htmlspecialchars($pengajuan->unit_organisasi_lama),
            'unker' => htmlspecialchars($pengajuan->unorname_lama),
            'tmt' => tgl_indonesia($pengajuan->tmt),
            'tugas_sebagai' => htmlspecialchars($pengajuan->tugas_sebagai),
            'unker_baru' => htmlspecialchars($pengajuan->unorname_baru),
            'unor_baru' => htmlspecialchars($pengajuan->unit_organisasi_baru),
            'jabatan_baru' => htmlspecialchars($pengajuan->nama_jabatan_baru),
            'kelas_jabatan_baru' => $pengajuan->kelas_jabatan_baru . " (" . ucfirst(terbilang($pengajuan->kelas_jabatan_baru)) . ")",
            'sk_tgl' => tgl_indonesia($pengajuan->sk_tgl),
            'nama_ttd' => $ttd[0],
            'pangkat_ttd' => ($ttd[1] == "") ? "" : $ttd[1],
            'nip_ttd' => ($ttd[2] == "") ? "" : "NIP. " . $ttd[2]
        ]);

        $templateProcessor->setImageValue('qrcode', array('path' => 'upload/qrcode/' . $id . '.png', 'width' => '100', 'height' => '100', 'ratio' => true));

        // $tembusan = explode(";", $pengajuan->sk_tembusan);
        // $tembusan_text = "";
        // foreach ($tembusan as $d) {
        //     $tembusan_text .= "<w:p>
        //                         <w:pPr>
        //                         <w:numPr>
        //                             <w:ilvl w:val='0'/>
        //                             <w:numId w:val='2'/>
        //                         </w:numPr>
        //                         </w:pPr>
        //                         <w:r>
        //                         <w:t>$d</w:t>
        //                         </w:r>
        //                     </w:p>";
        // }
        // $templateProcessor->setValue('tembusan', $tembusan_text);

        $tembusan = explode(";", $pengajuan->sk_tembusan);

        $num_tembusan = 1;
        $templateProcessor->cloneRow('Rowtembusan', count($tembusan));
        foreach ($tembusan as $d) {
            $templateProcessor->setValue("Rowtembusan#" . $num_tembusan, $d);
            $num_tembusan++;
        }

        $nama_file = str_replace([" ", ".", ","], ["-", "", ""], $pengajuan->nama);
        // dd($nama_file);
        $temp_filename = 'SPT-' . $nama_file . '.docx';
        $templateProcessor->saveAs($temp_filename);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $temp_filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Content-Length: ' . filesize($temp_filename));
        readfile($temp_filename);
        unlink($temp_filename); // deletes the temporary file
        exit;
    }

    // unggah spt
    public function unggah_spt()
    {
        // dd($this->request->getFile('file_syarat'));
        $pengajuan  =   $this->crud_model->select_data("pengajuan", "getRow", ["pengajuan_id" => $this->request->getPost('pengajuan_id')]);
        if ($pengajuan->user_id == "1") {
            $page   =   "spt";
        } else {
            $page   =   "pengajuan";
        }
        if (!$this->validate('unggah_syarat')) {
            // dd($validasi->getError());
            $error = $this->validation->getError('file_syarat');
            // dd($error);
            $notifikasi = array(
                "status" => "danger", "msg" => $error,
            );
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/' . $page . '/' . $this->request->getPost('pengajuan_id'));
        } else {
            $file_syarat    =   $this->request->getFile('file_syarat');
            $nama_file      =   $file_syarat->getRandomName();

            $file_syarat->move("upload/spt", $nama_file);

            $cek_data   =   $this->crud_model->select_data("pengajuan", "getRow", [
                "pengajuan_id" => $this->request->getPost('pengajuan_id')
            ]);

            if ($cek_data->file_spt != "") {
                unlink('./upload/spt/' . $cek_data->file_spt);
                // $this->crud_model->hapus_data("upload_syarat", ["upload_syarat_id" => $cek_data->upload_syarat_id]);
            }

            $upload = $this->crud_model->update_data("pengajuan", [
                "file_spt"  =>  $nama_file
            ], ["pengajuan_id" => $this->request->getPost('pengajuan_id')]);
            if ($upload) {
                $notifikasi = array(
                    "status" => "success", "msg" => "File SPT berhasil diunggah",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "File SPT gagal diunggah",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/' . $page . '/' . $this->request->getPost('pengajuan_id'));
        }
    }

    // daftar spt pelantikan
    public function daftar_pelantikan()
    {
        $data['title'] = "Daftar SPT Pelantikan";
        $data['data']   =   $this->crud_model->select_data("pelantikan", "getResult", FALSE, null, ["create_at" => "DESC"]);
        return view('backend/admin/spt_pelantikan', $data);
    }

    // detail pelantikan
    public function detail_pelantikan($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $data['title'] = "Detail Pelantikan";
        $where  =   ["pelantikan_id" => $id];

        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", $where);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $data['data']           =   $pelantikan;
        $data['pegawai']       =   $this->crud_model->select_data("pelantikan_detail", "getResult", ["pelantikan_id" => $id]);

        return view('backend/admin/detail_pelantikan', $data);
    }

    // buat spt pelantikan
    public function buat_pelantikan()
    {
        $cek_pelantikan =   $this->crud_model->select_data("pelantikan", "getNumRows", ["selesai <>" => "1"]);
        if ($cek_pelantikan > 0) {
            $notifikasi = array(
                "status" => "danger", "msg" => "Hanya dapat memproses 1 Pelantikan. Selesaikan pelantikan yang telah diinput sebelumnya.",
            );
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/spt-pelantikan/');
        }

        if ($this->request->getVar('submit') && $this->validate('buat_pelantikan')) {
            $data   =   [
                "pelantikan_id"  =>  generateRandomString(15),
                "no_surat"    =>   $this->request->getPost('no_surat'),
                "tgl_surat"    =>   $this->request->getPost('tgl_surat'),
                "tgl_pelantikan"    =>   $this->request->getPost('tgl_pelantikan'),
                "tgl_berlaku"    =>   $this->request->getPost('tgl_berlaku'),
                "menimbang"    =>   json_encode($this->request->getPost('menimbang')),
                "mengingat"    =>   json_encode($this->request->getPost('mengingat')),
                "no_surat_tim_penilai"    =>   $this->request->getPost('no_surat_tim_penilai'),
                "tgl_surat_tim_penilai"    =>   $this->request->getPost('tgl_surat_tim_penilai'),
                "create_by" =>  user("nama") . " (Operator BKPP)"
            ];

            // dd($data);
            $simpan = $this->crud_model->insert_data("pelantikan", $data);
            if ($simpan) {
                $notifikasi = array(
                    "status" => "success", "msg" => "SPT Pelantikan berhasil dibuat",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "SPT Pelantikan gagal dibuat",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/spt-pelantikan/' . $data["pelantikan_id"]);
        } else {
            $data['validation'] = \Config\Services::validation();
            $data['title']      = "Buat SPT Pelantikan";
            // dd($data);
            return view('backend/admin/buat_pelantikan', $data);
        }
    }

    // selesai spt pelantikan
    public function selesai_pelantikan($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", ["pelantikan_id" => $id, "selesai" => ""]);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $data   =   [
            "selesai"    =>   "1"
        ];

        // dd($data);
        $simpan = $this->crud_model->update_data("pelantikan", $data, ["pelantikan_id" => $id]);
        if ($simpan) {
            $notifikasi = array(
                "status" => "success", "msg" => "SPT Pelantikan berhasil diselesaikan",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "SPT Pelantikan gagal diselesaikan",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/spt-pelantikan/' . $id);
    }

    // ubah spt pelantikan
    public function ubah_pelantikan($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", ["pelantikan_id" => $id, "selesai" => ""]);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        if ($this->request->getVar('submit') && $this->validate('buat_pelantikan')) {
            $data   =   [
                "no_surat"    =>   $this->request->getPost('no_surat'),
                "tgl_surat"    =>   $this->request->getPost('tgl_surat'),
                "tgl_pelantikan"    =>   $this->request->getPost('tgl_pelantikan'),
                "tgl_berlaku"    =>   $this->request->getPost('tgl_berlaku'),
                "menimbang"    =>   json_encode($this->request->getPost('menimbang')),
                "mengingat"    =>   json_encode($this->request->getPost('mengingat')),
                "no_surat_tim_penilai"    =>   $this->request->getPost('no_surat_tim_penilai'),
                "tgl_surat_tim_penilai"    =>   $this->request->getPost('tgl_surat_tim_penilai'),
                "create_by" =>  user("nama") . " (Operator BKPP)"
            ];

            // dd($data);
            $simpan = $this->crud_model->update_data("pelantikan", $data, ["pelantikan_id" => $id]);
            if ($simpan) {
                $notifikasi = array(
                    "status" => "success", "msg" => "SPT Pelantikan berhasil diubah",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "SPT Pelantikan gagal diubah",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/spt-pelantikan/' . $id);
        } else {
            $data['validation'] = \Config\Services::validation();
            $data['title']      = "Buat SPT Pelantikan";
            $data['data']       = $pelantikan;
            // dd($data);
            return view('backend/admin/ubah_pelantikan', $data);
        }
    }

    // hapus spt pelantikan
    public function hapus_pelantikan($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", ["pelantikan_id" => $id, "selesai" => ""]);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }


        $hapus = $this->crud_model->hapus_data("pelantikan", ["pelantikan_id" => $id]);
        if ($hapus) {
            $notifikasi = array(
                "status" => "success", "msg" => "SPT Pelantikan berhasil dihapus",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "SPT Pelantikan gagal dihapus",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/spt-pelantikan');
    }

    // tambah pegawai untuk spt pelantikan
    public function tambah_pegawai($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", ["pelantikan_id" => $id]);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        if ($this->request->getVar('submit') && $this->validate('tambah_pegawai_pelantikan')) {
            $pegawai    =   $this->simpeg_model->select_field("nip2, nama", "r_dip", "getRow", ["newsid" => $this->request->getPost('pegawai')]);

            $cek_pegawai    =   $this->crud_model->select_data("pelantikan_detail", "getNumRows", [
                "pelantikan_id" =>  $id,
                "newsid"   =>  $this->request->getPost('pegawai')
            ]);
            if ($cek_pegawai > 0) {
                $notifikasi = array(
                    "status" => "danger", "msg" => "$pegawai->nama sudah termasuk dalam daftar",
                );
            } else {
                $cek_jabatan    =   $this->crud_model->select_data("pelantikan_detail", "getNumRows", [
                    "pelantikan_id" =>  $id,
                    "id_jabatan_baru"   =>  $this->request->getPost('jabatan')
                ]);
                if ($cek_jabatan > 0) {
                    $notifikasi = array(
                        "status" => "danger", "msg" => "Jabatan sudah ditempati.",
                    );
                } else {

                    $tmp_eselon  =   $this->request->getPost('eselon');
                    $skpd_asal   =   $this->request->getPost('skpd_asal');
                    $skpd   =   $this->request->getPost('skpd');
                    $jabatan    =   $this->request->getPost('jabatan');

                    $r_jabatan      =   $this->simpeg_model->select_data("r_jabatan", "getRow", ["newsid" => $this->request->getPost('pegawai')], null, ["tmt" => "DESC"]);
                    // dd($r_jabatan);
                    $r_pangkat      =   $this->simpeg_model->select_field("pangkat", "r_pangkat", "getRow", ["newsid" => $this->request->getPost('pegawai')], null, ["tmt" => "DESC"]);

                    $data_skpd      =   $this->simpeg_model->select_data("unor", "getRow", ["unorid" => $skpd]);
                    $data_skpd_asal =   $this->simpeg_model->select_data("unor", "getRow", ["unorid" => $skpd_asal]);

                    $eselon =   strtolower(str_replace(".", "", $tmp_eselon));
                    $anjab          =   $this->ecd_model->select_data("anjab", "getRow", ["id" => $jabatan]);

                    $nama_jabatan_baru  =   getFieldEcd("esl_$eselon", "nm_$eselon", ["id_$eselon" => $anjab->$eselon]);
                    $kelas_jabatan_baru  =   getFieldEcd("esl_$eselon", "kelas$eselon", ["id_$eselon" => $anjab->$eselon]);
                    // $kelas_jabatan_baru  =   getFieldEcd("pelaksana", "kelaspelaksana", ["idpelaksana" => $anjab->pelaksana]);

                    $data   =   [
                        "pelantikan_detail_id"  =>  generateRandomString(15),
                        "pelantikan_id" =>  $id,
                        "newsid"    =>  $this->request->getPost('pegawai'),
                        "nip"   =>  $pegawai->nip2,
                        "nama"  =>  $pegawai->nama,
                        "pangkat"   =>  $r_pangkat->pangkat,
                        "id_jabatan_lama"   => (!empty($r_jabatan) && $r_jabatan->jabatanid !== NULL) ? $r_jabatan->jabatanid : '',
                        "nama_jabatan_lama" => (!empty($r_jabatan)) ? $r_jabatan->namajabatan : '',
                        "jenis_jabatan_lama"    => (!empty($r_jabatan)) ? $r_jabatan->jabatanjenis : '',
                        "eselon_lama"   => (!empty($r_jabatan)) ? getFieldSimpeg("t_eselon", "nmeselon", ["ideselon" => $r_jabatan->eselon]) : '',
                        "unorid_lama" =>  $data_skpd_asal->unorid,
                        "unorname_lama" =>  $data_skpd_asal->unorname,
                        "id_jabatan_baru"   =>  $jabatan,
                        "nama_jabatan_baru" =>  $nama_jabatan_baru,
                        "jenis_jabatan_baru"    =>  $this->request->getPost('jenis_jabatan_baru'),
                        "eselon_baru"   =>  $this->request->getPost('eselon'),
                        "kelas_jabatan_baru" =>  $kelas_jabatan_baru,
                        "unorid_baru"   =>  $skpd,
                        "unorname_baru" =>  $data_skpd->unorname,
                        "no_surat_mutasi"    =>   $this->request->getPost('no_surat_mutasi'),
                        "tgl_surat_mutasi"    =>   $this->request->getPost('tgl_surat_mutasi'),
                        "create_by" =>  user("nama") . " (Operator BKPP)"
                    ];

                    // dd($data);
                    $simpan = $this->crud_model->insert_data("pelantikan_detail", $data);
                    if ($simpan) {
                        $notifikasi = array(
                            "status" => "success", "msg" => "$pegawai->nama berhasil ditambah",
                        );
                    } else {
                        $notifikasi = array(
                            "status" => "danger", "msg" => "$pegawai->nama gagal ditambah",
                        );
                    }
                }
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/spt-pelantikan/' . $id);
        } else {
            $data['validation'] = \Config\Services::validation();
            $data['title']      = "Tambah Pegawai Untuk Pelantikan";
            $data['pelantikan'] =   $pelantikan;
            $data['skpd']    = $this->simpeg_model->select_field("unorid, unorname", "unor", "getResult");
            $data['eselon']    = $this->simpeg_model->select_data("t_eselon", "getResult", ["ideselon > " => "12", "ideselon <" => "50"]);
            $data['jenis_jabatan']    = $this->simpeg_model->select_data("t_jabatankategori");
            return view('backend/admin/tambah_pegawai_pelantikan', $data);
        }
    }

    // ubah pegawai untuk spt pelantikan
    public function ubah_pegawai($id = null, $detail_id = null)
    {
        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", ["pelantikan_id" => $id]);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pelantikan_detail  =   $this->crud_model->select_data("pelantikan_detail", "getRow", ["pelantikan_detail_id" => $detail_id]);
        if (empty($pelantikan_detail)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        if ($this->request->getVar('submit') && $this->validate('ubah_pegawai_pelantikan')) {
            $tmp_eselon  =   $this->request->getPost('eselon');
            $skpd   =   $this->request->getPost('skpd');
            $jabatan    =   $this->request->getPost('jabatan');


            $data_skpd      =   $this->simpeg_model->select_data("unor", "getRow", ["unorid" => $skpd]);

            $eselon =   strtolower(str_replace(".", "", $tmp_eselon));
            $anjab          =   $this->ecd_model->select_data("anjab", "getRow", ["id" => $jabatan]);

            $nama_jabatan_baru  =   getFieldEcd("esl_$eselon", "nm_$eselon", ["id_$eselon" => $anjab->$eselon]);
            $kelas_jabatan_baru  =   getFieldEcd("esl_$eselon", "kelas$eselon", ["id_$eselon" => $anjab->$eselon]);

            $data   =   [
                "id_jabatan_baru"   =>  $jabatan,
                "nama_jabatan_baru" =>  $nama_jabatan_baru,
                "jenis_jabatan_baru"    =>  $this->request->getPost('jenis_jabatan_baru'),
                "eselon_baru"   =>  $this->request->getPost('eselon'),
                "kelas_jabatan_baru" =>  $kelas_jabatan_baru,
                "unorid_baru"   =>  $skpd,
                "unorname_baru" =>  $data_skpd->unorname,
                "no_surat_mutasi"    =>   $this->request->getPost('no_surat_mutasi'),
                "tgl_surat_mutasi"    =>   $this->request->getPost('tgl_surat_mutasi'),
            ];

            // dd($data);
            $simpan = $this->crud_model->update_data("pelantikan_detail", $data, ["pelantikan_detail_id" => $detail_id]);
            if ($simpan) {
                $notifikasi = array(
                    "status" => "success", "msg" => "Pegawai berhasil diubah",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Pegawai gagal diubah",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/spt-pelantikan/' . $id);
        } else {
            $data['validation'] = \Config\Services::validation();
            $data['title']      = "Ubah Pegawai Untuk Pelantikan";
            $data['pelantikan'] =   $pelantikan;
            $data['detail'] =   $pelantikan_detail;
            $data['skpd']    = $this->simpeg_model->select_field("unorid, unorname", "unor", "getResult");
            $data['eselon']    = $this->simpeg_model->select_data("t_eselon", "getResult", ["ideselon > " => "12", "ideselon <" => "50"]);
            $data['jenis_jabatan']    = $this->simpeg_model->select_data("t_jabatankategori");
            return view('backend/admin/ubah_pegawai_pelantikan', $data);
        }
    }

    // hapus pegawai untuk spt pelantikan
    public function hapus_pegawai($id = null, $detail_id = null)
    {
        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", ["pelantikan_id" => $id]);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pelantikan_detail  =   $this->crud_model->select_data("pelantikan_detail", "getRow", ["pelantikan_detail_id" => $detail_id]);
        if (empty($pelantikan_detail)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $hapus = $this->crud_model->hapus_data("pelantikan_detail", ["pelantikan_detail_id" => $detail_id]);
        if ($hapus) {
            $notifikasi = array(
                "status" => "success", "msg" => "Pegawai berhasil dihapus",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "Pegawai gagal dihapus",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/spt-pelantikan/' . $id);
    }

    // cetak semua
    public function cetak_pelantikan($pelantikan_id = null)
    {
        if ($pelantikan_id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $where  =   ["pelantikan_id" => $pelantikan_id];

        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", $where);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pelantikan_detail  =   $this->crud_model->select_data("pelantikan_detail", "getResult", $where);
        if (empty($pelantikan_detail)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $templateProcessor = new TemplateProcessor(WRITEPATH . 'template/template-pelantikan.docx');


        $templateProcessor->setValues([
            'no_sk' => $pelantikan->no_surat,
            'tgl_sk' => tgl_indonesia($pelantikan->tgl_surat),
        ]);

        $menimbang = json_decode($pelantikan->menimbang);
        $mengingat = json_decode($pelantikan->mengingat);

        $num_menimbang = 1;
        $templateProcessor->cloneRow('Rowmenimbang', count($menimbang));
        foreach ($menimbang as $d) {
            $templateProcessor->setValue("Rowmenimbang#" . $num_menimbang, $d);
            $num_menimbang++;
        }

        $num_mengingat = 1;
        $templateProcessor->cloneRow('Rowmengingat', count($mengingat));
        foreach ($mengingat as $d) {
            $templateProcessor->setValue("Rowmengingat#" . $num_mengingat, $d);
            $num_mengingat++;
        }

        $num_pegawai = 1;
        $templateProcessor->cloneRow('no', count($pelantikan_detail));
        foreach ($pelantikan_detail as $d) {
            $templateProcessor->setValue("no#" . $num_pegawai, $num_pegawai);
            $templateProcessor->setValue("nama#" . $num_pegawai, $d->nama);
            $templateProcessor->setValue("nip#" . $num_pegawai, $d->nip);
            $templateProcessor->setValue("pangkat#" . $num_pegawai, $d->pangkat);
            $templateProcessor->setValue("jabatan_lama#" . $num_pegawai, htmlspecialchars($d->nama_jabatan_lama));
            $templateProcessor->setValue("unor_lama#" . $num_pegawai, htmlspecialchars($d->unorname_lama));
            $templateProcessor->setValue("eselon_lama#" . $num_pegawai, $d->eselon_lama);
            $templateProcessor->setValue("jabatan_baru#" . $num_pegawai, htmlspecialchars($d->nama_jabatan_baru));
            $templateProcessor->setValue("unor_baru#" . $num_pegawai, htmlspecialchars($d->unorname_baru));
            $templateProcessor->setValue("eselon_baru#" . $num_pegawai, $d->eselon_baru);
            $templateProcessor->setValue("no_surat_tim_penilai#" . $num_pegawai, $pelantikan->no_surat_tim_penilai);
            $templateProcessor->setValue("tgl_surat_tim_penilai#" . $num_pegawai, tgl_indonesia_short($pelantikan->tgl_surat_tim_penilai));
            $num_pegawai++;
        }

        $nama_file = str_replace([" ", ".", ","], ["-", "", ""], tgl_indonesia($pelantikan->tgl_pelantikan));
        // dd($nama_file);
        $temp_filename = 'PELANTIKAN-' . $nama_file . '.docx';
        $templateProcessor->saveAs($temp_filename);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $temp_filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Content-Length: ' . filesize($temp_filename));
        readfile($temp_filename);
        unlink($temp_filename); // deletes the temporary file
        exit;
    }

    // cetak petikan
    public function cetak_petikan($pelantikan_id = null, $pelantikan_detail_id = null)
    {
        if ($pelantikan_id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $where  =   ["pelantikan_id" => $pelantikan_id];
        $where_detail  =   ["pelantikan_id" => $pelantikan_id, "pelantikan_detail_id" => $pelantikan_detail_id];

        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", $where);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $pelantikan_detail  =   $this->crud_model->select_data("pelantikan_detail", "getRow", $where_detail);
        if (empty($pelantikan_detail)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $templateProcessor = new TemplateProcessor(WRITEPATH . 'template/template-petikan.docx');


        $templateProcessor->setValues([
            'no_surat' => $pelantikan->no_surat,
            'tgl_surat' => tgl_indonesia($pelantikan->tgl_surat),
            'nama' => $pelantikan_detail->nama,
            'nip' => $pelantikan_detail->nip,
            'pangkat' => getFieldSimpeg("t_golruang", "nmgolruang", ["idgolruang" => $pelantikan_detail->pangkat]) . ", " . $pelantikan_detail->pangkat,
            'jabatan_lama' => htmlspecialchars($pelantikan_detail->nama_jabatan_lama),
            'unor_lama' => htmlspecialchars($pelantikan_detail->unorname_lama),
            'eselon_lama' => $pelantikan_detail->eselon_lama,
            'jabatan_baru' => htmlspecialchars($pelantikan_detail->nama_jabatan_baru),
            'unor_baru' => htmlspecialchars($pelantikan_detail->unorname_baru),
            'eselon_baru' => $pelantikan_detail->eselon_baru,
            'no_surat_mutasi' => $pelantikan_detail->no_surat_mutasi,
            'tgl_surat_mutasi' => tgl_indonesia($pelantikan_detail->tgl_surat_mutasi),
        ]);

        $nama_file = str_replace([" ", ".", ","], ["-", "", ""], $pelantikan_detail->nama);
        // dd($nama_file);
        $temp_filename = 'PETIKAN-' . $nama_file . '.docx';
        $templateProcessor->saveAs($temp_filename);

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $temp_filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Content-Length: ' . filesize($temp_filename));
        readfile($temp_filename);
        unlink($temp_filename); // deletes the temporary file
        exit;
    }

    // sinkron simpeg untuk pelantikan
    public function sinkron_simpeg_pelantikan($id = null)
    {
        if ($id === null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }
        $where  =   ["pelantikan_id" => $id];

        $pelantikan  =   $this->crud_model->select_data("pelantikan", "getRow", $where);
        if (empty($pelantikan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $detail =   $this->crud_model->select_data("pelantikan_detail", "getResult", $where);
        $data   =   ["sinkron_simpeg" => "1"];

        $sinkron = $this->crud_model->update_data("pelantikan", $data, ["pelantikan_id" => $id]);
        if ($sinkron) {
            $data_simpeg_jabatan    =   [];
            $jabatanid      =   $this->simpeg_model->cek_id("r_jabatan", "id");
            $ind    =   0;
            foreach ($detail as $det) {
                // update ecd
                // $this->ecd_model->update_data("anjab", ["newsid" => 0], ["newsid" => $det->newsid], ["anjab.id" => "DESC"]);
                // $this->ecd_model->update_data("anjab", ["newsid" => $det->newsid], ["id" => $det->id_jabatan_baru], ["anjab.id" => "DESC"]);

                // update simpeg
                $this->simpeg_model->update_data("r_dip", ["unorid" => $det->unorid_baru], ["newsid" => $det->newsid]);

                $cek_nama_instansi  =   $this->crud_model->select_data("master", "getRow", ["jenis" => "unor", "nama" => $det->unit_organisasi_baru]);
                if (empty($cek_nama_instansi)) {
                    $instansi   =   $det->unit_organisasi_baru;
                } else {
                    $instansi   =   $det->unorname_baru;
                }

                $data_simpeg_jabatan[$ind]["id"]    =   $jabatanid;
                $data_simpeg_jabatan[$ind]["newsid"]    =   $det->newsid;
                $data_simpeg_jabatan[$ind]["jabatanid"]    =   $det->id_jabatan_baru;
                $data_simpeg_jabatan[$ind]["namajabatan"]    =    $det->nama_jabatan_baru;
                $data_simpeg_jabatan[$ind]["eselon"]    =   getFieldSimpeg("t_eselon", "ideselon", ["nmeselon" => $det->eselon_baru]);
                $data_simpeg_jabatan[$ind]["tmt"]   =   $pelantikan->tgl_berlaku;
                $data_simpeg_jabatan[$ind]["instansi"]   =   $instansi;
                $data_simpeg_jabatan[$ind]["sknomor"]   =   $pelantikan->no_surat;
                $data_simpeg_jabatan[$ind]["sktgl"]   =   $pelantikan->tgl_surat;
                $data_simpeg_jabatan[$ind]["pangkatgol"]   =   $det->pangkat;
                $jabatanid++;
                $ind++;
            }
            // dd($data_simpeg_jabatan);
            $this->simpeg_model->insert_batch("r_jabatan", $data_simpeg_jabatan);

            $notifikasi = array(
                "status" => "success", "msg" => "Sinkron berhasil",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "Sinkron gagal",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/spt-pelantikan/' . $id);
    }

    // daftar spt
    public function daftar_spt()
    {
        $data['title'] = "Daftar SPT";
        // $data['subtitle'] = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia iusto eaque natus laudantium, facilis a enim itaque odio ut dolorum nihil provident earum voluptates. Possimus, esse. Architecto excepturi assumenda ipsum.";
        $where  =   ["user_id" => "1"];

        if (cekSession("filter_skpd")) {
            if (getSession("filter_url") != "spt") {
                $this->session->remove('filter_skpd');
                $this->session->remove('filter_url');
            } else {
                $where["unorid_baru"]   =   getSession("filter_skpd");
            }
        }

        $data['data']   =   $this->crud_model->select_data("pengajuan", "getResult", $where, null, ["create_at" => "DESC"]);
        $data['skpd']   =   $this->simpeg_model->select_data("unor", "getResult", false, null, ["unorname" => "ASC"]);
        return view('backend/admin/spt', $data);
    }

    // buat spt
    public function buat_pengajuan()
    {
        if ($this->request->getVar('submit') && $this->validate('buat_spt')) {
            $cek_pengajuan   =   $this->crud_model->select_data("pengajuan", "getRow", ["id_jabatan_baru" => $this->request->getPost('jabatan'), "status >" => "0", "status <" => "4", "tolak" => "0", "user_id" => "1"]);
            if (!empty($cek_pengajuan)) {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Jabatan telah di tempati oleh $cek_pengajuan->nama",
                );
            } else {
                $nip    =   $this->request->getPost('nip');
                $nama   =   $this->request->getPost('nama');
                $pangkat    =   $this->request->getPost('pangkat');
                $jabatan_lama   =   $this->request->getPost('jabatan_lama');
                $unorname_lama   =   $this->request->getPost('unorname_lama');
                $unit_organisasi_lama   =   $this->request->getPost('unit_organisasi_lama');

                // $newsid =   $this->simpeg_model->cek_id("r_dip", "newsid");

                $jenis  =   $this->request->getPost('jenis');
                $skpd   =   $this->request->getPost('skpd');
                $jabatan    =   $this->request->getPost('jabatan');

                $data_skpd      =   $this->simpeg_model->select_data("unor", "getRow", ["unorid" => $skpd]);

                $anjab          =   $this->ecd_model->select_data("anjab", "getRow", ["id" => $jabatan]);

                if ($jenis == "Administrasi") {
                    $nama_jabatan_baru  =   getFieldEcd("pelaksana", "nmpelaksana", ["idpelaksana" => $anjab->pelaksana]);
                    $kelas_jabatan_baru  =   getFieldEcd("pelaksana", "kelaspelaksana", ["idpelaksana" => $anjab->pelaksana]);
                } else {
                    $nama_jabatan_baru  =   getFieldEcd("fungsional", "nmfungsional", ["idfungsional" => $anjab->fungsional]);
                    $kelas_jabatan_baru  =   getFieldEcd("fungsional", "kelasfungsional", ["idfungsional" => $anjab->fungsional]);
                }

                $data   =   [
                    "pengajuan_id"  =>  generateRandomString(15),
                    "user_id"   =>  "1",
                    "jenis_pengajuan"   =>  $jenis,
                    // "newsid"    =>  $newsid,
                    "tgl_pengajuan" => date("Y-m-d"),
                    "nip"   =>  $nip,
                    "nama"  =>  $nama,
                    "pangkat"   =>  $pangkat,
                    "nama_jabatan_lama" =>  $jabatan_lama,
                    "unorname_lama" =>  $unorname_lama,
                    "unit_organisasi_lama"  =>  $unit_organisasi_lama,
                    "id_jabatan_baru"   =>  $jabatan,
                    "nama_jabatan_baru" =>  $nama_jabatan_baru,
                    "kelas_jabatan_baru" =>  $kelas_jabatan_baru,
                    "unorid_baru"   =>  $skpd,
                    "status"    =>  "3",
                    "create_by" =>  user("nama") . " (Operator BKPP)"
                ];

                if ($data_skpd->unorid == $data_skpd->parentid || $data_skpd->parentid == "0") { // jika tidak ada parent
                    $data['unorname_baru']  =   $data_skpd->unorname;
                    $data['unit_organisasi_baru']   =   "";
                } else {
                    $unor_baru   =   $this->simpeg_model->select_data("unor", "getRow", ["unorid" => $data_skpd->parentid]);
                    $data['unorname_baru']  =   $unor_baru->unorname;
                    $data['unit_organisasi_baru']   =   $data_skpd->unorname;
                }

                // dd($data);
                $simpan = $this->crud_model->insert_data("pengajuan", $data);
                if ($simpan) {
                    $notifikasi = array(
                        "status" => "success", "msg" => "SPT berhasil dibuat",
                    );
                } else {
                    $notifikasi = array(
                        "status" => "danger", "msg" => "SPT gagal dibuat",
                    );
                }
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/spt');
        } else {
            $data['validation'] = \Config\Services::validation();
            $data['title']      = "Buat SPT";
            $data['skpd']    = $this->simpeg_model->select_field("unorid, unorname", "unor", "getResult");
            $data['pangkat']    = $this->simpeg_model->select_data("t_golruang");
            $data['unit_organisasi']    =   $this->crud_model->select_data("master", "getResult", ["jenis" => "unor"]);
            $data['tugas_sebagai']    =   $this->crud_model->select_data("master", "getResult", ["jenis" => "tugas"]);
            // dd($data);
            return view('backend/admin/buat_pengajuan', $data);
        }
    }

    // cari Jabatan kosong
    public function cari_jabatan_kosong()
    {
        $unor   =   $this->request->getPost('unor');
        $jenis  =   $this->request->getPost('jenis');
        if ($jenis == "Administrasi") {
            $field  =   "nmpelaksana";
        } else {
            $field  =   "nmfungsional";
        }
        $data = [];
        $jabatan    =   $this->ecd_model->ambil_jabatan_kosong($jenis, $unor);
        foreach ($jabatan as $jab) {
            if ($jab->ivb !== "0") {
                $parent = $jab->nm_IVb;
            } elseif ($jab->iva !== "0") {
                $parent = $jab->nm_IVa;
            } elseif ($jab->iiib !== "0") {
                $parent = $jab->nm_IIIb;
            } elseif ($jab->iiia !== "0") {
                $parent = $jab->nm_IIIa;
            } elseif ($jab->iib !== "0") {
                $parent = $jab->nm_IIb;
            } elseif ($jab->iia !== "0") {
                $parent = $jab->nm_IIa;
            }
            if ($jab->newsid == 0 || $jab->unor <> $jab->unorid) {
                array_push($data, [
                    "id"    =>  $jab->id,
                    "text"  =>  $jab->$field . " - " . $parent
                ]);
            }
        }
        $ret['data']    =   $data;

        return json_encode($ret);
    }

    // sudah masuk tmt
    public function masuk_tmt()
    {
        $data['title'] = "Pengajuan Yang Sudah Masuk TMT";
        $where  =   ["status" => "4", "tmt <=" => date("Y-m-d")];

        $data['data']   =   $this->crud_model->select_data("pengajuan", "getResult", $where, null, ["tmt" => "DESC"]);
        return view('backend/admin/tmt', $data);
    }

    // sinkron simpeg
    public function sinkron_simpeg()
    {
        $pengajuan_id   =   $this->request->getPost('pengajuan_id');
        $data_pengajuan =   $this->crud_model->select_data("pengajuan", "getRow", ["pengajuan_id" => $pengajuan_id, "status" => "4", "tmt <=" => date("Y-m-d")]);

        if (empty($data_pengajuan)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        // dd($data_pengajuan);
        $cek_nama_instansi  =   $this->crud_model->select_data("master", "getRow", ["jenis" => "unor", "nama" => $data_pengajuan->unit_organisasi_baru]);
        if (empty($cek_nama_instansi)) {
            $instansi   =   $data_pengajuan->unit_organisasi_baru;
        } else {
            $instansi   =   $data_pengajuan->unorname_baru;
        }

        if ($data_pengajuan->newsid == "") {
            // Pegawai Baru Masuk
            $data_simpeg    =   [
                "newsid"    =>  $this->simpeg_model->cek_id("r_dip", "newsid"),
                "nama"      =>  strtoupper($data_pengajuan->nama),
                "nip2"      =>  $data_pengajuan->nip,
                "unorid"    =>  $data_pengajuan->unorid_baru
            ];

            $data_ecd   =   [
                "newsid"    =>  $data_simpeg["newsid"]
            ];
            $pegawai_lama   =   FALSE;

            $sinkron    =   $this->simpeg_model->insert_data("r_dip", $data_simpeg);
            // insert tabel tambahan
            $this->simpeg_model->insert_data("r_badan", ["newsid" => $data_simpeg["newsid"]]);
            $this->simpeg_model->insert_data("r_dpendukung", ["newsid" => $data_simpeg["newsid"]]);
            $this->simpeg_model->insert_data("r_dtambahan", ["newsid" => $data_simpeg["newsid"]]);
            $this->simpeg_model->insert_data("r_ortu", ["newsid" => $data_simpeg["newsid"]]);
            $this->simpeg_model->insert_data("r_skckkir", ["newsid" => $data_simpeg["newsid"]]);
            $data_jabatan   =   [
                "id"    =>  $this->simpeg_model->cek_id("r_jabatan", "id"),
                "newsid"    =>  $data_simpeg["newsid"],
                "namajabatan"   =>  $data_pengajuan->nama_jabatan_baru,
                "jabatanjenis"  =>  $data_pengajuan->jenis_jabatan_baru,
                "tmt"   =>  $data_pengajuan->tmt,
                "instansi"  =>  $instansi,
                "skpejabat" =>  str_replace('\n', ' ', $data_pengajuan->sk_jabatan_ttd),
                "sknomor"   =>  $data_pengajuan->sk_nomor,
                "sktgl"     =>  $data_pengajuan->sk_tgl,
                "pangkatgol"    =>  $data_pengajuan->pangkat
            ];
        } else {
            // Pegawai Lama
            $data_simpeg    =   [
                "unorid"    =>  $data_pengajuan->unorid_baru
            ];

            $data_ecd   =   [
                "newsid"    =>  $data_pengajuan->newsid
            ];
            $pegawai_lama   =   TRUE;
            $sinkron    =   $this->simpeg_model->update_data("r_dip", $data_simpeg, ["newsid" => $data_pengajuan->newsid]);
            $data_jabatan   =   [
                "id"    =>  $this->simpeg_model->cek_id("r_jabatan", "id"),
                "newsid"    =>  $data_pengajuan->newsid,
                "namajabatan"   =>  $data_pengajuan->nama_jabatan_baru,
                "jabatanjenis"  =>  $data_pengajuan->jenis_jabatan_baru,
                "tmt"   =>  $data_pengajuan->tmt,
                "instansi"  =>  $instansi,
                "skpejabat" =>  str_replace('\n', ' ', $data_pengajuan->sk_jabatan_ttd),
                "sknomor"   =>  $data_pengajuan->sk_nomor,
                "sktgl"     =>  $data_pengajuan->sk_tgl,
                "pangkatgol"    =>  $data_pengajuan->pangkat
            ];
        }

        if ($sinkron) {
            if ($pegawai_lama) {
                $this->ecd_model->update_data("anjab", ["newsid" => 0], ["newsid" => $data_pengajuan->newsid]);
            }
            $this->simpeg_model->insert_data("r_jabatan", $data_jabatan);
            $data_anjab =   $this->ecd_model->select_data("anjab", "getRow", ["id" => $data_pengajuan->id_jabatan_baru]);
            $this->ecd_model->insert_data("anjab", [
                "id" => $this->ecd_model->cek_id("anjab", "id"),
                "jab" => $data_anjab->jab,
                "unor" => $data_anjab->unor,
                "ib" => $data_anjab->ib,
                "ia" => $data_anjab->ia,
                "iib" => $data_anjab->iib,
                "iia" => $data_anjab->iia,
                "iiib" => $data_anjab->iiib,
                "iiia" => $data_anjab->iiia,
                "ivb" => $data_anjab->ivb,
                "iva" => $data_anjab->iva,
                "pelaksana" => $data_anjab->pelaksana,
                "fungsional" => $data_anjab->fungsional,
                "newsid" => $data_ecd["newsid"],
            ]);
            // $this->ecd_model->update_data("anjab", $data_ecd, ["id" => $data_pengajuan->id_jabatan_baru], ["anjab.id" => "DESC"]);
            $this->crud_model->update_data("pengajuan", ["sinkron_simpeg" => "1"], ["pengajuan_id" => $this->request->getPost('pengajuan_id')]);
            $notifikasi = array(
                "status" => "success", "msg" => "Data berhasil di sinkron",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "Data gagal di sinkron",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/tmt');
    }

    // laporan
    public function laporan()
    {
        $data['title'] = "Laporan";
        $status =   [
            "semua" =>  "Semua",
            "1"     =>  "Menunggu",
            "2"     =>  "Proses",
            "3"     =>  "Disetujui",
            "4"     =>  "Selesai",
            "tolak" =>  "Ditolak",
            "0"     =>  "Dibatalkan"
        ];
        $data['status'] =   $status;
        $data['skpd']   =   $this->simpeg_model->select_data("unor", "getResult", false, null, ["unorname" => "ASC"]);
        // dd($data);
        return view('backend/admin/laporan', $data);
    }

    // cari laporan
    public function cari_laporan()
    {
        $where  =   ["pengajuan_id <>" => ""];
        if ($this->request->getPost('skpd_asal') != "") {
            $where["unorid_lama"]   =   $this->request->getPost('skpd_asal');
        }

        if ($this->request->getPost('skpd_tujuan') != "") {
            $where["unorid_baru"]   =   $this->request->getPost('skpd_tujuan');
        }

        if ($this->request->getPost('tgl_pengajuan') != "") {
            $where["tgl_pengajuan"]   =   $this->request->getPost('tgl_pengajuan');
        }

        if ($this->request->getPost('tgl_tmt') != "") {
            $where["tmt"]   =   $this->request->getPost('tgl_tmt');
        }

        if ($this->request->getPost('status') == "tolak") {
            $where["tolak"]   =   "1";
        }

        if ($this->request->getPost('status') != "tolak" && $this->request->getPost('status') != "semua") {
            $where["status"]   =   $this->request->getPost('status');
        }

        $data['data']   =   $this->crud_model->select_data("pengajuan", "getResult", $where);
        return view('backend/admin/cetak_laporan', $data);
    }

    // cek spt
    public function cek_spt_admin()
    {
        if ($this->request->getVar('submit') && $this->validate('cek_spt')) {
        } else {
            $data['validation'] = \Config\Services::validation();
            $data['title'] = "Cek SPT";
            return view('backend/cek_spt', $data);
        }
    }

    // kunci jabatan
    public function kunci_jabatan()
    {
        $data['title'] = "Daftar Jabatan Yang Dikunci";
        $data['data']   =   $this->crud_model->select_data("kunci_jabatan", "getResult", FALSE, null, ["create_at" => "DESC"]);
        return view('backend/admin/kunci_jabatan', $data);
    }

    // tambah kunci jabatan
    public function tambah_kunci_jabatan()
    {
        if ($this->request->getVar('submit') && $this->validate('kunci_jabatan')) {
            $cek = getDataEcd("anjab", ["id" => $this->request->getPost('jabatan')]);
            if ($this->request->getPost('jenis') == "Administrasi") {
                $nama_jabatan   =   getFieldEcd("pelaksana", "nmpelaksana", ["idpelaksana" => $cek->pelaksana]);
            } else {
                $nama_jabatan   =   getFieldEcd("fungsional", "nmfungsional", ["idfungsional" => $cek->fungsional]);
            }

            if ($cek->ivb !== "0") {
                $parent = getParentJabatan("esl_ivb", "id_IVb", $cek->ivb, "nm_IVb", FALSE);
            } elseif ($cek->iva !== "0") {
                $parent = getParentJabatan("esl_iva", "id_IVa", $cek->iva, "nm_IVa", FALSE);
            } elseif ($cek->iiib !== "0") {
                $parent = getParentJabatan("esl_iiib", "id_IIIb", $cek->iiib, "nm_IIIb", FALSE);
            } elseif ($cek->iiia !== "0") {
                $parent = getParentJabatan("esl_iiia", "id_IIIa", $cek->iiia, "nm_IIIa", FALSE);
            } elseif ($cek->iib !== "0") {
                $parent = getParentJabatan("esl_iib", "id_IIb", $cek->iib, "nm_IIb", FALSE);
            } elseif ($cek->iia !== "0") {
                $parent = getParentJabatan("esl_iia", "id_IIa", $cek->iia, "nm_IIa", FALSE);
            }

            $data   =   [
                "kunci_jabatan_id"  =>  $this->crud_model->cek_id("kunci_jabatan", "kunci_jabatan_id"),
                "unorid"   =>  $this->request->getPost('skpd'),
                "unorname"   =>  getFieldSimpeg("unor", "unorname", ["unorid" => $this->request->getPost('skpd')]),
                "jenis_jabatan"   =>  $this->request->getPost('jenis'),
                "anjab_id"   =>  $this->request->getPost('jabatan'),
                "nama_jabatan"  =>  $nama_jabatan,
                "jabatan_parent" => $parent
            ];

            $simpan = $this->crud_model->insert_data("kunci_jabatan", $data);
            if ($simpan) {
                $notifikasi = array(
                    "status" => "success", "msg" => "Jabatan berhasil dikunci",
                );
            } else {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Jabatan gagal dikunci",
                );
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/kunci-jabatan');
        } else {
            $data['validation'] = \Config\Services::validation();
            $data['title']      = "Tambah Jabatan Yang Dikunci";
            $data['skpd']    = $this->simpeg_model->select_field("unorid, unorname", "unor", "getResult");
            return view('backend/admin/buat_kunci', $data);
        }
    }

    // hapus kunci jabatan
    public function hapus_kunci_jabatan($id = null)
    {
        $cek = $this->crud_model->select_data("kunci_jabatan", "getRow", ["kunci_jabatan_id" => $id]);
        if (empty($cek)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Akses ditolak', 0);
        }

        $hapus = $this->crud_model->hapus_data("kunci_jabatan", ["kunci_jabatan_id" => $id]);
        if ($hapus) {
            $notifikasi = array(
                "status" => "success", "msg" => "Jabatan berhasil dihapus dari daftar kunci",
            );
        } else {
            $notifikasi = array(
                "status" => "danger", "msg" => "Jabatan gagal dihapus dari daftar kunci",
            );
        }
        session()->setFlashdata('notifikasi', $notifikasi);
        return redirect()->to('/kunci-jabatan');
    }

    // buat pengajuan khusus
    public function buat_pengajuan_khusus()
    {
        if ($this->request->getVar('submit') && $this->validate('buat_spt_khusus')) {
            $cek_pengajuan   =   $this->crud_model->select_data("pengajuan", "getRow", ["id_jabatan_baru" => $this->request->getPost('jabatan'), "status >" => "0", "status <=" => "4", "tolak" => "0", "sinkron_simpeg <>" => "1"]);
            if (!empty($cek_pengajuan)) {
                $notifikasi = array(
                    "status" => "danger", "msg" => "Jabatan telah di tempati oleh $cek_pengajuan->nama",
                );
            } else {
                $unor   =   $this->request->getPost('unor');
                $newsid =   $this->request->getPost('pegawai');
                $jenis  =   $this->request->getPost('jenis');
                $skpd   =   $this->request->getPost('skpd');
                $jabatan    =   $this->request->getPost('jabatan');

                $data_pegawai   =   $this->simpeg_model->select_data("r_dip", "getRow", ["newsid" => $newsid]);
                $data_skpd      =   $this->simpeg_model->select_data("unor", "getRow", ["unorid" => $skpd]);
                $r_jabatan      =   $this->simpeg_model->select_data("r_jabatan", "getRow", ["newsid" => $newsid], null, ["tmt" => "DESC"]);
                $r_pangkat      =   $this->simpeg_model->select_field("pangkat", "r_pangkat", "getRow", ["newsid" => $newsid], null, ["tmt" => "DESC"]);

                $anjab          =   $this->ecd_model->select_data("anjab", "getRow", ["id" => $jabatan]);

                $nama_pegawai   =   "";
                ($data_pegawai->gelardpn != "") ? $nama_pegawai .= $data_pegawai->gelardpn . ". " : "";
                $nama_pegawai   .=   $data_pegawai->nama;
                ($data_pegawai->gelarblk != "") ? $nama_pegawai .= " " . $data_pegawai->gelarblk : "";

                if ($jenis == "Administrasi") {
                    $nama_jabatan_baru  =   getFieldEcd("pelaksana", "nmpelaksana", ["idpelaksana" => $anjab->pelaksana]);
                    $kelas_jabatan_baru  =   getFieldEcd("pelaksana", "kelaspelaksana", ["idpelaksana" => $anjab->pelaksana]);
                } else {
                    $nama_jabatan_baru  =   getFieldEcd("fungsional", "nmfungsional", ["idfungsional" => $anjab->fungsional]);
                    $kelas_jabatan_baru  =   getFieldEcd("fungsional", "kelasfungsional", ["idfungsional" => $anjab->fungsional]);
                }

                $data   =   [
                    "pengajuan_id"  =>  generateRandomString(15),
                    "jenis_pengajuan"   =>  $jenis,
                    "tgl_pengajuan" =>  date("Y-m-d"),
                    "user_id"   =>  user("user_id"),
                    "newsid"    =>  $newsid,
                    "tgl_pengajuan" =>  date("Y-m-d"),
                    "nip"       =>  $data_pegawai->nip2,
                    "nama"      =>  $nama_pegawai,
                    "pangkat"   =>  $r_pangkat->pangkat,
                    "id_jabatan_lama"   => (empty($r_jabatan) || $r_jabatan->jabatanid === null) ? '0' : $r_jabatan->jabatanid,
                    "nama_jabatan_lama" => (empty($r_jabatan) || $r_jabatan->namajabatan === null) ? '0' : $r_jabatan->namajabatan,
                    "jenis_jabatan_lama"    => (empty($r_jabatan) || $r_jabatan->jabatanjenis === null) ? '0' : $r_jabatan->jabatanjenis,
                    "unorid_lama"   =>  $this->request->getPost('unker'),
                    "unorname_lama" =>  getFieldSimpeg("unor", "unorname", ["unorid" => $this->request->getPost('unker')]),
                    "unit_organisasi_lama" =>  $unor,
                    "id_jabatan_baru"   =>  $jabatan,
                    "nama_jabatan_baru" =>  $nama_jabatan_baru,
                    "kelas_jabatan_baru" =>  $kelas_jabatan_baru,
                    "unorid_baru"   =>  $skpd,
                    "status"    =>  "3",
                    "unorname_baru" =>  $data_skpd->unorname,
                    "create_by" =>  user("nama") . " (Operator BKPP)"
                ];

                // dd($data);
                // upload berkas
                $syarat =   $this->request->getFileMultiple("syarat");
                $upload_syarat_id   =   $this->crud_model->cek_id("upload_syarat", "upload_syarat_id");
                $data_syarat    =   [];
                foreach ($syarat as $key => $v) {
                    // $data_syarat["syarat_id"][] =   $syarat_id[$key];
                    $nama_file      =   $v->getRandomName();
                    $v->move("upload/syarat", $nama_file);
                    $data_syarat[$key]  =   [
                        "upload_syarat_id"  => $upload_syarat_id,
                        "syarat_id" =>  "1",
                        "pengajuan_id"  =>  $data["pengajuan_id"],
                        "file"  =>  $nama_file
                    ];
                    // $data_syarat    =   []
                    $upload_syarat_id++;
                }
                $simpan = $this->crud_model->insert_data("pengajuan", $data);
                if ($simpan) {
                    $this->crud_model->insert_batch("upload_syarat", $data_syarat);
                    $notifikasi = array(
                        "status" => "success", "msg" => "SPT berhasil dibuat",
                    );
                } else {
                    $notifikasi = array(
                        "status" => "danger", "msg" => "SPT gagal dibuat",
                    );
                }
            }
            session()->setFlashdata('notifikasi', $notifikasi);
            return redirect()->to('/spt');
        } else {
            $data['validation'] = \Config\Services::validation();
            $data['title']      = "Buat SPT Khusus";
            $data['unor']   =   $this->simpeg_model->select_field("unorid, unorname", "unor", "getResult");
            $data['pegawai']    =   [];
            $data['skpd_asal']    = $this->simpeg_model->select_field("unorid, unorname", "unor", "getResult");
            $skpd    = $this->simpeg_model->select_field("unorid, unorname", "unor", "getResult");
            $data["skpd"]   =   $skpd;
            // $data['syarat'] =   $this->crud_model->select_data("syarat", "getResult", ["awal" => "1"]);
            $data['unit_organisasi']    =   $this->crud_model->select_data("master", "getResult", ["jenis" => "unor"]);
            // dd($data);
            return view('backend/admin/buat_pengajuan_khusus', $data);
        }
    }
}
