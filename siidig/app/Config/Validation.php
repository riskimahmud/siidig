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

    public $siinas = [
        'nama_perusahaan' => ['label' => 'Nama Perusahaan', 'rules' => 'trim|required'],
        'alamat_kantor' => ['label' => 'Alamat Kantor', 'rules' => 'trim|required'],
        'alamat_pabrik' => ['label' => 'Alamat Pabrik', 'rules' => 'trim|required'],
        'kode_kbli' => ['label' => 'Kode KBLI', 'rules' => 'trim|required|numeric|max_length[5]'],
        'bidang_usaha' => ['label' => 'Bidang Usaha', 'rules' => 'trim|required'],
        'tanggal_registrasi' => ['label' => 'Tanggal Registrasi', 'rules' => 'trim|required']
    ];

    public $blog = [
        'title' => ['label' => 'Title', 'rules' => 'required'],
        'slug' => ['label' => 'Slug', 'rules' => 'required|is_unique[berita.slug,id,{id}]'],
        'body' => ['label' => 'Body', 'rules' => 'required'],
        'gambar' => ['label' => 'Gambar', 'rules' => 'uploaded[gambar]|max_size[gambar,5120]|is_image[gambar]']
    ];

    public $blog_update = [
        'title' => ['label' => 'Title', 'rules' => 'required'],
        'slug' => ['label' => 'Slug', 'rules' => 'required|is_unique[berita.slug,id,{id}]'],
        'body' => ['label' => 'Body', 'rules' => 'required'],
        'gambar' => ['label' => 'Gambar', 'rules' => 'permit_empty|max_size[gambar,5120]|is_image[gambar]']
    ];

    public $pelatihan = [
        'title' => ['label' => 'Title', 'rules' => 'required'],
        'slug' => ['label' => 'Slug', 'rules' => 'required|is_unique[pelatihan.slug,id,{id}]'],
        'body' => ['label' => 'Body', 'rules' => 'required'],
        'lokasi' => ['label' => 'Lokasi', 'rules' => 'required'],
        'tgl_pelaksanaan' => ['label' => 'Tgl Pelaksanaan', 'rules' => 'required|valid_date'],
        'gambar' => ['label' => 'Gambar', 'rules' => 'uploaded[gambar]|max_size[gambar,5120]|is_image[gambar]']
    ];

    public $pelatihan_update = [
        'title' => ['label' => 'Title', 'rules' => 'required'],
        'slug' => ['label' => 'Slug', 'rules' => 'required|is_unique[pelatihan.slug,id,{id}]'],
        'body' => ['label' => 'Body', 'rules' => 'required'],
        'lokasi' => ['label' => 'Lokasi', 'rules' => 'required'],
        'tgl_pelaksanaan' => ['label' => 'Tgl Pelaksanaan', 'rules' => 'required|valid_date'],
        'gambar' => ['label' => 'Gambar', 'rules' => 'permit_empty|max_size[gambar,5120]|is_image[gambar]']
    ];

    public $aplikasi = [
        'nama_aplikasi' => ['label' => 'Nama Aplikasi', 'rules' => 'required'],
        'link' => ['label' => 'Link Aplikasi', 'rules' => 'required|valid_url'],
        'gambar' => ['label' => 'Gambar', 'rules' => 'uploaded[gambar]|max_size[gambar,5120]|is_image[gambar]']
    ];

    public $aplikasi_update = [
        'nama_aplikasi' => ['label' => 'Nama Aplikasi', 'rules' => 'required'],
        'link' => ['label' => 'Link Aplikasi', 'rules' => 'required|valid_url'],
        'gambar' => ['label' => 'Gambar', 'rules' => 'permit_empty|max_size[gambar,5120]|is_image[gambar]']
    ];

    public $header = [
        'title' => ['label' => 'Title', 'rules' => 'permit_empty'],
        'subtitle' => ['label' => 'Link', 'rules' => 'permit_empty'],
        'link' => ['label' => 'Link', 'rules' => 'permit_empty|valid_url'],
        'gambar' => ['label' => 'Gambar', 'rules' => 'uploaded[gambar]|max_size[gambar,5120]|is_image[gambar]']
    ];

    public $header_update = [
        'title' => ['label' => 'Title', 'rules' => 'permit_empty'],
        'subtitle' => ['label' => 'Link', 'rules' => 'permit_empty'],
        'link' => ['label' => 'Link', 'rules' => 'permit_empty|valid_url'],
        'gambar' => ['label' => 'Gambar', 'rules' => 'permit_empty|max_size[gambar,5120]|is_image[gambar]']
    ];
}
