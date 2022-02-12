<?php

namespace App\Controllers;

class Ajax extends BaseController
{
    public function __construct()
    {
        if (session()->get('user')["level"] == "opd") {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anda tidak memiliki akses', 0);
        }
    }

    public function cari_pegawai_by_skpd()
    {
        $unor   =   $this->request->getPost('unor');
        $where  =   ["unorid" => $unor, "statuspns" => "1"];
        $field  =   "newsid , nama, nip2";
        $data   =   $this->simpeg_model->select_field($field, "r_dip", "getResult", $where);
        $ret["data"]   =   $data;

        return json_encode($ret);
    }

    public function cari_jabatan_by_skpd()
    {
        $unor   =   $this->request->getPost('unor');
        $tmp_eselon  =   $this->request->getPost('eselon');
        $where  =   ["unor" => $unor];

        $eselon =   strtolower(str_replace(".", "", $tmp_eselon));
        // $eselon = "iia";
        $field  =   "anjab.id as id, anjab.$eselon, esl_$eselon.nm_$eselon as text";
        $where["$eselon <>"]  = "0";

        // if ($jenis == "Administrasi") {
        //     $field  =   "anjab.id as id, anjab.pelaksana, pelaksana.nmpelaksana as text";
        //     $where["pelaksana <>"]  = "00.00.000";
        // } else {
        //     $field  =   "anjab.id as id, anjab.fungsional, fungsional.nmfungsional as text";
        //     $where["fungsional <>"]  = "0";
        // }
        $data   =   $this->ecd_model->select_data_join($field, "anjab", "getResult", [
            [
                "table" =>  "esl_$eselon",
                "cond"  =>  "anjab.$eselon = esl_$eselon.id_$eselon",
                "type"  =>  "LEFT"
            ],
        ], $where, null, null, ["esl_$eselon.id_$eselon"]);
        $ret["data"]   =   $data;

        return json_encode($ret);
    }

    public function cari_spt()
    {
        $id = $this->request->getPost('kode');
        $pengajuan = $this->crud_model->select_data("pengajuan", "getRow", ["pengajuan_id" => $id, "status" => "4"]);
        $data['pengajuan']  =   $pengajuan;
        return view('backend/cari_spt', $data);
    }
}
