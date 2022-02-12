<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InvestasiFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        // $kel = $this->db->table('kelkec')->select('')->where('parent <>', '');
        $kec = $this->db->table('kelkec')->select('*')->where('parent', '');
        for ($i = 0; $i < 100; $i++) {
            $arr_nominal    =   ['100', '1000', '10000', '200', '2000', '3000', '4000', '5000'];
            $industri = $faker->numberBetween(1, 5);
            $tahun  =   $faker->numberBetween(2016, 2022);
            $kel    =   $faker->randomElement(['HELEDULAA SELATAN', 'HELEDULAA UTARA', 'MOODU', 'TAMALATE']);
            $komoditi   =   $faker->randomElement(['Makanan', 'Kerajinan', 'Alat Berat']);
            $produk =   $faker->randomElement(['Roti Goreng', 'Kameja Karawo', 'Las Besi']);
            $bbu =   $faker->randomElement(['PO', 'UD', 'PT']);
            // $kec    =   $faker->randomElement($kec);
            $data   =   [
                'tahun' =>  $tahun,
                'nama_pemilik'  =>  $faker->name(),
                'nama_ikm'  =>  $faker->company(),
                'alamat'    =>  $faker->address(),
                'keldesa'   =>  $kel,
                'kecamatan' =>  'KOTA TIMUR',
                'telp'      =>  $faker->phoneNumber(),
                'komoditi'  =>  $komoditi,
                'produk'    =>  $produk,
                'bentuk_badan_usaha'    =>  $bbu,
                'tahun_izin'    =>  '2020',
                'kode_kbli' =>  $faker->randomNumber(4),
                'kbli'  =>  $faker->sentence(3),
                'tkl'   =>  $faker->randomNumber(2),
                'tkp'   =>  $faker->randomNumber(2),
                'nilai_investasi' => $faker->randomElement($arr_nominal),
                'jumlah_produksi'   => $faker->randomNumber('3'),
                'satuan'    =>  'KG',
                'nilai_produksi'    =>  $faker->randomElement($arr_nominal),
                'nilai_bbbp'    =>  $faker->randomElement($arr_nominal),
                'user_id'   =>  '5',
                'kabkota_id'    => '1',
                'industri_id'   => $industri
            ];
            $this->db->table('investasi')->insert($data);
        }
    }
}
