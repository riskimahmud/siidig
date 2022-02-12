<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Validation\CustomRules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $profil = [
        'username' => [
            'label' => 'Username',
            'rules' => 'trim|required|is_unique[user.username,id,{id}]',
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'trim|permit_empty|min_length[8]',
        ],
        'nama' => [
            'label' => 'Nama',
            'rules' => 'trim|required',
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|is_unique[user.email,id,{id}]',
        ],
    ];

    public $kelkec = [
        'nama_kelkec' => [
            'label' => 'Nama Kelurahan / Kecamatan',
            'rules' => 'trim|required|kelurahanValidation[nama_kelkec]',
            'errors' => [
                'kelurahanValidation' => 'Nama Kelurahan / Kecamatan sudah ada',
            ]
        ],
        'parent' => [
            'label' => 'Parent',
            'rules' => 'trim|required_without[tanpa_parent]'
        ],
        'tanpa_parent' => [
            'label' => 'Tanpa Parent',
            'rules' => 'trim'
        ]
    ];

    public $investasi_user = [
        'industri_id' => ['label' => 'Industri', 'rules' => 'trim|required'],
        'nama_pemilik' => ['label' => 'Nama Pemilik', 'rules' => 'trim|required'],
        'nama_ikm' => ['label' => 'Nama Perusahaan', 'rules' => 'trim|required'],
        'alamat' => ['label' => 'Alamat', 'rules' => 'trim|required'],
        'kelkec' => ['label' => 'Kelurahan / Kecamatan', 'rules' => 'trim|required'],
        'telp' => ['label' => 'Telp', 'rules' => 'trim|permit_empty|numeric|min_length[8]'],
        'komoditi' => ['label' => 'Komoditi', 'rules' => 'trim|permit_empty'],
        'produk' => ['label' => 'Produk', 'rules' => 'trim|required'],
        'bentuk_badan_usaha' => ['label' => 'Bentuk Badan Usaha', 'rules' => 'trim|permit_empty'],
        'tahun_izin' => ['label' => 'Tahun Izin', 'rules' => 'trim|permit_empty|numeric|max_length[4]'],
        'kode_kbli' => ['label' => 'Kode KBLI', 'rules' => 'trim|permit_empty|numeric|max_length[6]'],
        'kbli' => ['label' => 'KBLI', 'rules' => 'trim'],
        'tkl' => ['label' => 'TK Laki-laki', 'rules' => 'trim|required|numeric'],
        'tkp' => ['label' => 'TK Perempuan', 'rules' => 'trim|required|numeric'],
        'nilai_investasi' => ['label' => 'Nilai Investasi', 'rules' => 'trim|required|integer'],
        'jumlah_produksi' => ['label' => 'Jumlah Produksi', 'rules' => 'trim|required|integer'],
        'satuan' => ['label' => 'Satuan', 'rules' => 'trim|required'],
        'nilai_produksi' => ['label' => 'Nilai Produksi', 'rules' => 'trim|required|integer'],
        'nilai_bbbp' => ['label' => 'Nilai BB/BP', 'rules' => 'trim|required|integer'],
    ];
}
