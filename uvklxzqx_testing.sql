-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2022 at 02:03 PM
-- Server version: 10.3.34-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uvklxzqx_testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(3) NOT NULL,
  `nama_aplikasi` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_aplikasi`, `link`, `gambar`) VALUES
(1, 'Google', 'https://google.com', '1647178917_7986080aea17c31d7261.png');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `status` enum('draft','hidden','publish') NOT NULL DEFAULT 'publish',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `title`, `slug`, `excerpt`, `body`, `gambar`, `penulis`, `status`, `created_at`) VALUES
(2, 'Berita 1', 'berita-1', 'Ini Isi Berita', '<div>Ini Isi Berita</div>', '1647181761_7300be74f2bdb81f79e0.jpg', 'Riski Mahmud', 'publish', '2022-03-13 22:10:57'),
(3, 'Berita 2', 'berita-2', 'Ini Berita 2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed expedita in soluta&#8230;', '<div>Ini Berita 2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed expedita in soluta aliquam, maiores animi ducimus dolorum quae ab quasi, at quis velit tempore accusamus, minima sapiente quos quod vero facere error voluptas debitis nihil? Voluptatum, incidunt! Commodi nesciunt praesentium ipsum dolores, alias nulla, vel similique omnis magnam quam fuga unde quos facere laboriosam neque exercitationem architecto quia atque eos? Provident ab vel at dignissimos labore porro, doloribus deserunt itaque aut repellat perferendis accusantium consequuntur suscipit quod doloremque aliquam neque, consectetur quos facere ea optio quam! Illum repellat laudantium quidem ipsum corporis, dolorum, voluptatum sed modi eos sint ducimus?</div>', '1647181785_31669f0bd45ffe3de092.jpg', 'Nirmala', 'publish', '2022-03-13 22:19:53'),
(4, 'Berita 3', 'berita-3', 'Ini berita 3 Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sed expedita in soluta&#8230;', '<div>I<strong>ni berita 3 Lorem ipsum <br></strong>dolor sit amet consectetur <em>adipisicing </em>elit. Aliquid sed expedita in soluta aliquam, maiores animi ducimus dolorum quae ab quasi, at quis velit tempore accusamus, minima sapiente quos quod vero facere error voluptas debitis nihil? Voluptatum, incidunt! Commodi nesciunt praesentium ipsum dolores, alias nulla, vel similique omnis magnam quam fuga unde quos facere laboriosam neque exercitationem architecto quia atque eos? Provident ab vel at dignissimos labore porro, doloribus deserunt itaque aut repellat perferendis accusantium consequuntur suscipit quod doloremque aliquam neque, consectetur quos facere ea optio quam! Illum repellat laudantium quidem ipsum corporis, dolorum, voluptatum sed modi eos sint ducimus?</div>', '1647181749_59efd4429b4115416335.jpg', 'Riski Mahmud', 'publish', '2022-03-13 22:22:20'),
(5, 'Berita 4', 'berita-4', 'Ini Berita 4&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet rerum sed, fuga asperiores&#8230;', '<div><strong>Ini Berita 4&nbsp;</strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet rerum sed, fuga asperiores blanditiis consequuntur vitae delectus ipsa dolorum, harum repellat nobis temporibus doloremque nam quo vero quis, esse necessitatibus quod. Harum nam libero delectus, esse rerum quae aliquid nulla voluptatem consequuntur fuga aut ratione eveniet obcaecati similique sequi dolor nobis, rem provident tenetur beatae accusantium qui! Fugiat earum nemo aperiam doloribus alias a eaque voluptatibus, dolorem rerum, nesciunt dicta quam nihil. Ea facere laudantium temporibus enim ex veniam est explicabo tempore recusandae excepturi dolorem, quibusdam, accusantium id, illo omnis. Itaque commodi adipisci tempore incidunt delectus. Cum modi accusamus assumenda?</div>', '1647182099_7853e60a4d9b74d800ba.jpg', 'Nirmala Karaenggauk', 'publish', '2022-03-13 22:34:59');

-- --------------------------------------------------------

--
-- Stand-in structure for view `grafik_all`
-- (See below for the actual view)
--
CREATE TABLE `grafik_all` (
`id` int(2)
,`nama_kabkota` char(255)
,`industri_id` int(2)
,`nama_industri` varchar(100)
,`nilai_investasi` decimal(32,0)
,`unit_usaha` bigint(21)
,`tenaga_kerja` double
,`tenaga_kerja_perempuan` double
,`tenaga_kerja_laki` double
,`jumlah_produksi` decimal(32,0)
,`nilai_produksi` decimal(32,0)
,`nilai_bbbp` decimal(32,0)
,`tahun` year(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `grafik_industri`
-- (See below for the actual view)
--
CREATE TABLE `grafik_industri` (
`id` int(2)
,`nama_industri` varchar(100)
,`nilai_investasi` decimal(32,0)
,`unit_usaha` bigint(21)
,`tenaga_kerja` double
,`tenaga_kerja_perempuan` double
,`tenaga_kerja_laki` double
,`jumlah_produksi` decimal(32,0)
,`nilai_produksi` decimal(32,0)
,`nilai_bbbp` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `grafik_industri_tahunan`
-- (See below for the actual view)
--
CREATE TABLE `grafik_industri_tahunan` (
`industri_id` int(2)
,`nama_industri` varchar(100)
,`nilai_investasi` decimal(32,0)
,`unit_usaha` bigint(21)
,`tenaga_kerja` double
,`tenaga_kerja_perempuan` double
,`tenaga_kerja_laki` double
,`jumlah_produksi` decimal(32,0)
,`nilai_produksi` decimal(32,0)
,`nilai_bbbp` decimal(32,0)
,`tahun` year(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `grafik_kabkota`
-- (See below for the actual view)
--
CREATE TABLE `grafik_kabkota` (
`id` int(2)
,`nama_kabkota` char(255)
,`nilai_investasi` decimal(32,0)
,`unit_usaha` bigint(21)
,`tenaga_kerja` double
,`tenaga_kerja_perempuan` double
,`tenaga_kerja_laki` double
,`jumlah_produksi` decimal(32,0)
,`nilai_produksi` decimal(32,0)
,`nilai_bbbp` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `grafik_kabkota_tahunan`
-- (See below for the actual view)
--
CREATE TABLE `grafik_kabkota_tahunan` (
`id` int(2)
,`nama_kabkota` char(255)
,`nilai_investasi` decimal(32,0)
,`unit_usaha` bigint(21)
,`tenaga_kerja` double
,`tenaga_kerja_perempuan` double
,`tenaga_kerja_laki` double
,`jumlah_produksi` decimal(32,0)
,`nilai_produksi` decimal(32,0)
,`nilai_bbbp` decimal(32,0)
,`tahun` year(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `grafik_tahunan`
-- (See below for the actual view)
--
CREATE TABLE `grafik_tahunan` (
`nilai_investasi` decimal(32,0)
,`tenaga_kerja` double
,`tenaga_kerja_perempuan` double
,`tenaga_kerja_laki` double
,`jumlah_produksi` decimal(32,0)
,`nilai_produksi` decimal(32,0)
,`nilai_bbbp` decimal(32,0)
,`unit_usaha` bigint(21)
,`tahun` year(4)
);

-- --------------------------------------------------------

--
-- Table structure for table `header`
--

CREATE TABLE `header` (
  `id` int(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `status` enum('draft','publish','hidden') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `industri`
--

CREATE TABLE `industri` (
  `id` int(2) NOT NULL,
  `nama_industri` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `industri`
--

INSERT INTO `industri` (`id`, `nama_industri`) VALUES
(1, 'INDUSTI SANDANG'),
(2, 'INDUSTRI PANGAN'),
(3, 'INDUSTRI KIMIA & BAHAN BANGUNAN'),
(4, 'INDUSTRI KERAJINAN'),
(5, 'INDUSTRI LOGAM & ELEKTRONIK');

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` int(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `title`, `slug`, `body`) VALUES
(1, 'Pengurusan Fasilitasi Kemasan', 'kemasan', '<div>Fasilitasi Kemasan</div>'),
(2, 'Fasilitasi Halal', 'halal', '<div>Fasilitasi Halal</div>'),
(3, 'Fasilitasi PKP', 'pkp', '<div>Fasilitasi PKP</div>'),
(4, 'Fasilitasi HAKI', 'haki', '<div>Fasilitasi HAKI</div>');

-- --------------------------------------------------------

--
-- Table structure for table `investasi`
--

CREATE TABLE `investasi` (
  `id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `nama_ikm` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `keldesa` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `komoditi` varchar(100) NOT NULL,
  `produk` varchar(255) NOT NULL,
  `bentuk_badan_usaha` varchar(20) NOT NULL,
  `tahun_izin` year(4) DEFAULT NULL,
  `kode_kbli` varchar(50) NOT NULL,
  `kbli` varchar(255) NOT NULL,
  `tkl` varchar(2) NOT NULL,
  `tkp` varchar(2) NOT NULL,
  `nilai_investasi` int(11) NOT NULL,
  `jumlah_produksi` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `nilai_produksi` int(11) NOT NULL,
  `nilai_bbbp` int(11) NOT NULL,
  `user_id` int(3) NOT NULL,
  `kabkota_id` int(2) NOT NULL,
  `industri_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `investasi`
--

INSERT INTO `investasi` (`id`, `tahun`, `nama_ikm`, `nama_pemilik`, `alamat`, `keldesa`, `kecamatan`, `telp`, `komoditi`, `produk`, `bentuk_badan_usaha`, `tahun_izin`, `kode_kbli`, `kbli`, `tkl`, `tkp`, `nilai_investasi`, `jumlah_produksi`, `satuan`, `nilai_produksi`, `nilai_bbbp`, `user_id`, `kabkota_id`, `industri_id`) VALUES
(1, 2022, 'Perum Rahayu Firmansyah (Persero) Tbk', 'Bajragin Nainggolan', 'Kpg. Moch. Ramdan No. 303, Cimahi 10195, Sumut', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0976 9749 8728', 'Makanan', 'Las Besi', 'PO', 2020, '1220', 'Sit et vel.', '3', '41', 1000, 585, 'KG', 4000, 4000, 5, 1, 4),
(2, 2022, 'CV Mayasari Sihotang Tbk', 'Adhiarja Budiyanto', 'Dk. Pelajar Pejuang 45 No. 439, Administrasi Jakarta Selatan 71891, Bali', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0232 7348 611', 'Kerajinan', 'Las Besi', 'PT', 2020, '1047', 'Incidunt voluptatem suscipit consequatur.', '93', '83', 2000, 398, 'KG', 10000, 200, 5, 1, 5),
(3, 2022, 'PT Situmorang Astuti', 'Ina Permata', 'Ki. Fajar No. 153, Serang 72669, Sulbar', 'TAMALATE', 'KOTA TIMUR', '(+62) 962 6009 998', 'Alat Berat', 'Roti Goreng', 'PT', 2020, '4851', 'Corporis aliquam aliquam at est.', '73', '82', 200, 921, 'KG', 3000, 5000, 5, 1, 4),
(4, 2022, 'PT Latupono', 'Tira Ella Lailasari S.Gz', 'Ds. Abdul No. 947, Sorong 95448, Jabar', 'TAMALATE', 'KOTA TIMUR', '0204 3233 329', 'Makanan', 'Las Besi', 'PT', 2020, '1821', 'Sint delectus fugit.', '20', '57', 4000, 942, 'KG', 4000, 100, 5, 1, 3),
(5, 2022, 'Perum Simbolon Tbk', 'Cawisadi Kuswoyo', 'Jr. Dipatiukur No. 396, Banda Aceh 14937, Sumsel', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 314 0393 6400', 'Makanan', 'Las Besi', 'PT', 2020, '1102', 'Officia vel magnam.', '69', '20', 1000, 501, 'KG', 2000, 100, 5, 1, 2),
(6, 2022, 'PT Mangunsong', 'Argono Rusman Hidayanto S.E.I', 'Ds. BKR No. 652, Bima 96045, Sulsel', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 661 6631 4919', 'Alat Berat', 'Kameja Karawo', 'UD', 2020, '189', 'Ratione ratione eligendi ut.', '24', '97', 1000, 572, 'KG', 200, 3000, 5, 1, 1),
(7, 2022, 'PD Halimah (Persero) Tbk', 'Lukman Eluh Manullang M.TI.', 'Kpg. Madrasah No. 347, Pekanbaru 75077, Banten', 'MOODU', 'KOTA TIMUR', '0752 7387 842', 'Kerajinan', 'Roti Goreng', 'PT', 2020, '3283', 'Consequatur explicabo expedita voluptatem.', '76', '22', 2000, 222, 'KG', 200, 5000, 5, 1, 5),
(8, 2022, 'PD Setiawan Wulandari', 'Sabrina Laksmiwati S.Farm', 'Psr. Suryo Pranoto No. 950, Banjarbaru 95214, Riau', 'MOODU', 'KOTA TIMUR', '(+62) 20 7361 101', 'Kerajinan', 'Las Besi', 'UD', 2020, '9447', 'At exercitationem sit aliquam.', '57', '79', 1000, 454, 'KG', 3000, 2000, 5, 1, 2),
(9, 2022, 'CV Puspita', 'Cemeti Taswir Habibi S.Sos', 'Jln. Abang No. 594, Gunungsitoli 39535, Papua', 'MOODU', 'KOTA TIMUR', '0404 7745 385', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '4994', 'Dolor doloribus assumenda suscipit quia.', '58', '10', 2000, 365, 'KG', 5000, 4000, 5, 1, 3),
(10, 2022, 'Perum Safitri (Persero) Tbk', 'Mahfud Sirait', 'Jr. Sudiarto No. 467, Bengkulu 75759, Jabar', 'HELEDULAA UTARA', 'KOTA TIMUR', '0687 2396 159', 'Makanan', 'Kameja Karawo', 'PO', 2020, '553', 'Aperiam commodi esse quia.', '23', '27', 100, 171, 'KG', 5000, 3000, 5, 1, 2),
(11, 2022, 'PT Napitupulu Winarno', 'Yani Yulianti', 'Jr. Ters. Buah Batu No. 301, Malang 97690, Malut', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 559 6167 4686', 'Alat Berat', 'Roti Goreng', 'UD', 2020, '6772', 'Officiis cumque est explicabo.', '21', '79', 4000, 999, 'KG', 4000, 10000, 5, 1, 2),
(12, 2022, 'PT Kurniawan (Persero) Tbk', 'Viktor Vinsen Simbolon S.Pt', 'Ds. Jakarta No. 197, Probolinggo 31162, Jateng', 'MOODU', 'KOTA TIMUR', '0736 8244 603', 'Kerajinan', 'Las Besi', 'PO', 2020, '2311', 'Accusantium voluptate culpa.', '94', '41', 10000, 692, 'KG', 2000, 4000, 5, 1, 3),
(13, 2022, 'CV Prakasa', 'Yance Shakila Permata', 'Psr. Madrasah No. 512, Kotamobagu 77996, Sumsel', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0930 4419 5663', 'Alat Berat', 'Las Besi', 'UD', 2020, '6153', 'Eos labore voluptatibus et.', '25', '62', 200, 583, 'KG', 10000, 5000, 5, 1, 1),
(14, 2022, 'PT Wasita Prasetya (Persero) Tbk', 'Jamalia Pertiwi', 'Ki. Ciumbuleuit No. 235, Kotamobagu 10444, Sulut', 'MOODU', 'KOTA TIMUR', '(+62) 617 4824 955', 'Alat Berat', 'Roti Goreng', 'PT', 2020, '502', 'Nam sapiente sit.', '11', '75', 1000, 523, 'KG', 200, 3000, 5, 1, 5),
(15, 2022, 'Perum Usada', 'Latika Riyanti', 'Ds. Sutarto No. 412, Pagar Alam 74207, Sultra', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 456 6878 5295', 'Kerajinan', 'Las Besi', 'PT', 2020, '8355', 'Impedit vitae sint architecto.', '72', '1', 100, 649, 'KG', 5000, 10000, 5, 1, 1),
(16, 2022, 'PD Sihombing Tbk', 'Mala Yulianti M.Ak', 'Jr. Bass No. 171, Malang 30032, Jabar', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 426 8043 393', 'Makanan', 'Las Besi', 'PO', 2020, '245', 'Ipsam iure maiores.', '14', '59', 3000, 350, 'KG', 200, 200, 5, 1, 5),
(17, 2022, 'UD Agustina', 'Gatot Sihombing M.TI.', 'Psr. Bank Dagang Negara No. 561, Banjarmasin 27385, Lampung', 'MOODU', 'KOTA TIMUR', '(+62) 900 7098 492', 'Makanan', 'Las Besi', 'PT', 2020, '3655', 'Omnis et nostrum eos.', '95', '69', 100, 470, 'KG', 1000, 200, 5, 1, 3),
(18, 2022, 'CV Anggraini', 'Gaduh Prasetya', 'Gg. Soekarno Hatta No. 149, Tebing Tinggi 76129, Jabar', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0620 5956 8408', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '1857', 'Velit cumque et.', '2', '86', 3000, 653, 'KG', 3000, 1000, 5, 1, 5),
(19, 2022, 'UD Hariyah Ramadan', 'Harsaya Jaswadi Kuswoyo S.Gz', 'Psr. Honggowongso No. 626, Dumai 67220, Jatim', 'TAMALATE', 'KOTA TIMUR', '0559 6736 354', 'Kerajinan', 'Roti Goreng', 'PO', 2020, '8716', 'Dolorem excepturi similique.', '89', '80', 5000, 463, 'KG', 4000, 5000, 5, 1, 4),
(20, 2022, 'Perum Prakasa', 'Nilam Diana Prastuti', 'Ds. Abang No. 339, Tanjung Pinang 96406, DIY', 'MOODU', 'KOTA TIMUR', '0304 3572 911', 'Makanan', 'Roti Goreng', 'PO', 2020, '3160', 'Eius a.', '16', '72', 5000, 87, 'KG', 5000, 5000, 5, 1, 3),
(21, 2022, 'PT Sinaga (Persero) Tbk', 'Marsudi Cecep Damanik', 'Jr. Basket No. 635, Padang 21934, Kalsel', 'TAMALATE', 'KOTA TIMUR', '0315 8201 866', 'Alat Berat', 'Roti Goreng', 'UD', 2020, '4098', 'Qui adipisci doloribus ut.', '50', '37', 5000, 697, 'KG', 1000, 1000, 5, 1, 4),
(22, 2022, 'Perum Yulianti Pradipta (Persero) Tbk', 'Halim Narpati', 'Ds. Adisucipto No. 253, Padangsidempuan 22059, Aceh', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 587 5802 5025', 'Kerajinan', 'Las Besi', 'PT', 2020, '8670', 'Aliquam repellat accusantium illo laborum.', '58', '14', 2000, 576, 'KG', 10000, 4000, 5, 1, 4),
(23, 2022, 'PT Budiyanto Padmasari', 'Wirda Yunita Rahimah', 'Jr. Teuku Umar No. 222, Kotamobagu 25984, Sulteng', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0292 6301 374', 'Alat Berat', 'Las Besi', 'PT', 2020, '4309', 'Vel quo voluptates sint.', '70', '83', 100, 811, 'KG', 4000, 2000, 5, 1, 5),
(24, 2022, 'Perum Maheswara Wulandari', 'Rahmi Hastuti', 'Jr. Basuki No. 994, Depok 44069, Sulut', 'HELEDULAA UTARA', 'KOTA TIMUR', '0732 6777 821', 'Alat Berat', 'Roti Goreng', 'PT', 2020, '8728', 'Sed labore sit quia.', '58', '29', 10000, 537, 'KG', 100, 4000, 5, 1, 2),
(25, 2022, 'PT Halimah Yuliarti', 'Winda Susanti', 'Dk. Cokroaminoto No. 175, Singkawang 17554, Bengkulu', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 843 1586 140', 'Makanan', 'Roti Goreng', 'UD', 2020, '5986', 'Est eligendi praesentium exercitationem.', '18', '63', 3000, 947, 'KG', 2000, 1000, 5, 1, 2),
(26, 2022, 'Perum Maryati Mulyani Tbk', 'Zahra Sudiati', 'Jln. Untung Suropati No. 324, Bengkulu 92715, Banten', 'TAMALATE', 'KOTA TIMUR', '(+62) 464 9651 2885', 'Makanan', 'Las Besi', 'PT', 2020, '5741', 'Tempora voluptas est.', '4', '88', 100, 98, 'KG', 200, 4000, 5, 1, 1),
(27, 2022, 'PT Simbolon Tbk', 'Mahesa Ganep Wasita S.Ked', 'Psr. Cikutra Barat No. 607, Metro 68304, Kepri', 'MOODU', 'KOTA TIMUR', '(+62) 286 0514 8748', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '9788', 'Eaque expedita dolor.', '85', '35', 5000, 586, 'KG', 2000, 1000, 5, 1, 4),
(28, 2022, 'PT Hutasoit Prasasta Tbk', 'Laila Lalita Kuswandari S.Farm', 'Psr. Kalimalang No. 146, Administrasi Jakarta Selatan 71855, Maluku', 'MOODU', 'KOTA TIMUR', '(+62) 650 2189 612', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '965', 'Veritatis asperiores neque exercitationem.', '95', '35', 10000, 993, 'KG', 3000, 10000, 5, 1, 2),
(29, 2022, 'PD Andriani Hidayanto Tbk', 'Nadia Usyi Andriani M.Kom.', 'Kpg. Untung Suropati No. 122, Samarinda 52269, NTT', 'MOODU', 'KOTA TIMUR', '(+62) 500 0901 073', 'Makanan', 'Roti Goreng', 'UD', 2020, '2175', 'Qui consequatur sint aut.', '79', '58', 2000, 588, 'KG', 1000, 100, 5, 1, 3),
(30, 2022, 'Perum Nasyidah Firmansyah (Persero) Tbk', 'Langgeng Damanik', 'Jln. Thamrin No. 805, Padang 26146, Sumut', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0328 2806 170', 'Makanan', 'Kameja Karawo', 'PT', 2020, '8990', 'Ea adipisci pariatur.', '30', '57', 10000, 242, 'KG', 100, 1000, 5, 1, 2),
(31, 2022, 'Perum Zulkarnain', 'Jane Hani Maryati', 'Jr. Baik No. 788, Semarang 59481, NTB', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0652 8810 3976', 'Kerajinan', 'Roti Goreng', 'PO', 2020, '8203', 'Debitis commodi sit quis.', '85', '44', 3000, 583, 'KG', 1000, 1000, 5, 1, 5),
(32, 2022, 'PD Widiastuti (Persero) Tbk', 'Padmi Lalita Maryati', 'Kpg. Adisucipto No. 737, Lhokseumawe 16508, Sumsel', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 510 8314 878', 'Kerajinan', 'Roti Goreng', 'PO', 2020, '9910', 'Debitis assumenda veniam.', '19', '47', 10000, 201, 'KG', 3000, 100, 5, 1, 1),
(33, 2022, 'CV Kuswandari', 'Aslijan Lasmono Gunawan S.Gz', 'Jln. Abdul Rahmat No. 123, Bekasi 74277, Sulsel', 'TAMALATE', 'KOTA TIMUR', '(+62) 298 7298 818', 'Makanan', 'Las Besi', 'PT', 2020, '6842', 'Et maxime ipsa aut.', '82', '66', 3000, 804, 'KG', 100, 200, 5, 1, 4),
(34, 2022, 'UD Pertiwi', 'Maria Purwanti', 'Kpg. Gardujati No. 416, Gorontalo 54639, Jatim', 'TAMALATE', 'KOTA TIMUR', '(+62) 895 159 342', 'Makanan', 'Kameja Karawo', 'PO', 2020, '8169', 'Id et eaque numquam provident.', '75', '91', 200, 815, 'KG', 10000, 10000, 5, 1, 1),
(35, 2022, 'PD Handayani Yuniar (Persero) Tbk', 'Rahmi Purnawati S.H.', 'Dk. Setiabudhi No. 282, Ambon 79852, DIY', 'MOODU', 'KOTA TIMUR', '(+62) 702 5920 094', 'Kerajinan', 'Las Besi', 'PO', 2020, '4291', 'Et ut qui id.', '53', '74', 5000, 371, 'KG', 2000, 100, 5, 1, 5),
(36, 2022, 'PD Wijayanti Usamah', 'Kani Wirda Hasanah S.Psi', 'Ds. Bayan No. 307, Ternate 92461, Maluku', 'HELEDULAA UTARA', 'KOTA TIMUR', '0830 5295 667', 'Makanan', 'Kameja Karawo', 'PO', 2020, '1316', 'Possimus non in explicabo.', '11', '83', 200, 639, 'KG', 2000, 200, 5, 1, 2),
(37, 2022, 'Perum Astuti Irawan (Persero) Tbk', 'Iriana Sudiati S.Kom', 'Dk. K.H. Maskur No. 553, Bitung 89632, Gorontalo', 'TAMALATE', 'KOTA TIMUR', '025 0870 793', 'Kerajinan', 'Kameja Karawo', 'PT', 2020, '3862', 'Et in aut.', '51', '19', 1000, 446, 'KG', 5000, 100, 5, 1, 2),
(38, 2022, 'PD Simanjuntak Laksita', 'Ilyas Samosir', 'Jln. Nanas No. 904, Padangsidempuan 84291, Sumbar', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 833 7094 540', 'Alat Berat', 'Roti Goreng', 'PO', 2020, '1004', 'Veritatis repellat necessitatibus iusto.', '23', '32', 10000, 919, 'KG', 2000, 4000, 5, 1, 1),
(39, 2022, 'CV Budiyanto', 'Endah Karen Purwanti', 'Jr. Bambu No. 709, Ternate 76304, Sulbar', 'TAMALATE', 'KOTA TIMUR', '0902 5335 8051', 'Makanan', 'Las Besi', 'PO', 2020, '4523', 'Distinctio qui quae.', '98', '18', 3000, 596, 'KG', 5000, 3000, 5, 1, 1),
(40, 2022, 'Perum Suwarno Handayani', 'Siska Novitasari', 'Jln. Barasak No. 619, Palembang 75235, Maluku', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 787 3012 016', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '9530', 'Omnis aperiam odio et.', '64', '14', 100, 298, 'KG', 200, 100, 5, 1, 2),
(41, 2022, 'PT Prastuti', 'Darmanto Mujur Saefullah S.Psi', 'Psr. Flores No. 348, Madiun 89547, Sulsel', 'MOODU', 'KOTA TIMUR', '021 9363 347', 'Alat Berat', 'Roti Goreng', 'PT', 2020, '5976', 'Saepe facilis velit.', '97', '32', 5000, 321, 'KG', 1000, 100, 5, 1, 2),
(42, 2022, 'CV Laksmiwati Riyanti Tbk', 'Jelita Nasyiah', 'Jr. Basuki Rahmat  No. 490, Banda Aceh 19764, Papua', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0682 1672 6025', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '90', 'Impedit consequatur saepe error.', '8', '44', 100, 902, 'KG', 2000, 4000, 5, 1, 2),
(43, 2022, 'PT Nuraini Susanti Tbk', 'Karman Jefri Prasetya S.T.', 'Jr. Ahmad Dahlan No. 38, Gunungsitoli 80021, Banten', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0741 7326 437', 'Makanan', 'Las Besi', 'PO', 2020, '3503', 'Officia labore laborum.', '15', '81', 10000, 617, 'KG', 1000, 3000, 5, 1, 5),
(44, 2022, 'UD Sihombing', 'Dalima Maryati', 'Gg. Untung Suropati No. 980, Pekanbaru 27326, DKI', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0337 4774 8882', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '418', 'Possimus eveniet perferendis.', '32', '50', 100, 564, 'KG', 10000, 4000, 5, 1, 2),
(45, 2022, 'CV Nashiruddin (Persero) Tbk', 'Cawisono Galih Kurniawan', 'Dk. HOS. Cjokroaminoto (Pasirkaliki) No. 662, Jambi 28798, NTT', 'MOODU', 'KOTA TIMUR', '(+62) 893 557 371', 'Makanan', 'Roti Goreng', 'PO', 2020, '5404', 'Occaecati quia eum est.', '73', '49', 1000, 542, 'KG', 1000, 10000, 5, 1, 5),
(46, 2022, 'UD Suartini', 'Harto Samosir', 'Ki. Cikutra Barat No. 848, Pagar Alam 22346, DIY', 'TAMALATE', 'KOTA TIMUR', '(+62) 732 5479 626', 'Alat Berat', 'Roti Goreng', 'PO', 2020, '4554', 'Quo eum perferendis.', '18', '41', 4000, 529, 'KG', 3000, 2000, 5, 1, 4),
(47, 2022, 'CV Salahudin', 'Halima Michelle Melani S.H.', 'Jln. Sutarjo No. 760, Kendari 64584, Jabar', 'HELEDULAA UTARA', 'KOTA TIMUR', '0354 1228 517', 'Makanan', 'Kameja Karawo', 'PT', 2020, '4379', 'Quasi repudiandae vel.', '30', '24', 2000, 602, 'KG', 5000, 4000, 5, 1, 5),
(48, 2022, 'PD Maulana Wasita', 'Margana Saadat Adriansyah M.TI.', 'Ki. Kusmanto No. 884, Tegal 21382, DKI', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 734 7729 2468', 'Kerajinan', 'Las Besi', 'PO', 2020, '448', 'Doloribus porro.', '72', '68', 100, 573, 'KG', 3000, 4000, 5, 1, 4),
(49, 2022, 'Perum Tampubolon', 'Gawati Purwanti', 'Kpg. Ciumbuleuit No. 759, Tomohon 53727, Pabar', 'MOODU', 'KOTA TIMUR', '0526 2772 162', 'Makanan', 'Kameja Karawo', 'PT', 2020, '3693', 'Excepturi eveniet harum.', '63', '96', 5000, 925, 'KG', 5000, 100, 5, 1, 4),
(50, 2022, 'Perum Wijayanti (Persero) Tbk', 'Cornelia Hartati', 'Ds. Gremet No. 361, Bitung 84356, Aceh', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 594 1658 761', 'Alat Berat', 'Las Besi', 'PO', 2020, '2910', 'Vel dolores ea.', '74', '22', 2000, 926, 'KG', 1000, 200, 5, 1, 4),
(51, 2019, 'CV Usamah (Persero) Tbk', 'Hafshah Novitasari', 'Jr. Jakarta No. 79, Banda Aceh 38766, Kepri', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 715 7270 9578', 'Makanan', 'Kameja Karawo', 'PO', 2020, '2352', 'Tempora esse inventore et.', '23', '20', 5000, 993, 'KG', 10000, 100, 5, 1, 2),
(52, 2021, 'PT Permata Lestari', 'Uchita Tari Namaga S.Farm', 'Jr. Suniaraja No. 579, Cilegon 33530, Jambi', 'MOODU', 'KOTA TIMUR', '(+62) 699 6420 289', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '4470', 'Debitis excepturi.', '81', '41', 200, 659, 'KG', 4000, 4000, 5, 1, 2),
(53, 2020, 'CV Saefullah (Persero) Tbk', 'Yahya Dabukke S.Psi', 'Ds. Cokroaminoto No. 159, Sukabumi 58519, Pabar', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 244 6121 721', 'Alat Berat', 'Las Besi', 'PT', 2020, '1643', 'Id et quo possimus.', '29', '76', 1000, 896, 'KG', 200, 2000, 5, 1, 1),
(54, 2016, 'Perum Hakim Wahyuni Tbk', 'Unjani Titi Suryatmi', 'Dk. Pelajar Pejuang 45 No. 775, Dumai 20309, Sumbar', 'HELEDULAA UTARA', 'KOTA TIMUR', '0484 0295 9253', 'Alat Berat', 'Roti Goreng', 'PT', 2020, '7810', 'Quia qui hic esse.', '61', '69', 2000, 493, 'KG', 4000, 100, 5, 1, 3),
(55, 2018, 'PD Sudiati Purnawati', 'Victoria Palastri', 'Kpg. Yogyakarta No. 221, Bengkulu 12948, Kalsel', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 523 6823 979', 'Kerajinan', 'Kameja Karawo', 'UD', 2020, '9902', 'Dolor et.', '68', '83', 2000, 942, 'KG', 100, 3000, 5, 1, 4),
(56, 2017, 'CV Pertiwi Fujiati (Persero) Tbk', 'Faizah Yuliarti S.Psi', 'Psr. Uluwatu No. 350, Probolinggo 10660, DKI', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 215 6778 9139', 'Alat Berat', 'Kameja Karawo', 'UD', 2020, '8072', 'Nostrum omnis aut.', '60', '84', 10000, 685, 'KG', 4000, 100, 5, 1, 2),
(57, 2016, 'Perum Wacana Wulandari (Persero) Tbk', 'Oliva Palastri', 'Ki. Dewi Sartika No. 456, Tegal 54464, Banten', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0300 0318 0389', 'Alat Berat', 'Kameja Karawo', 'PT', 2020, '2123', 'Alias rerum quidem rem.', '81', '95', 1000, 391, 'KG', 1000, 100, 5, 1, 3),
(58, 2016, 'UD Narpati', 'Jaga Estiono Nugroho M.Ak', 'Ki. Yap Tjwan Bing No. 279, Parepare 93997, Sulteng', 'TAMALATE', 'KOTA TIMUR', '(+62) 403 5361 3807', 'Alat Berat', 'Las Besi', 'PO', 2020, '6725', 'Commodi repudiandae molestiae numquam.', '44', '59', 3000, 883, 'KG', 2000, 2000, 5, 1, 1),
(59, 2022, 'UD Yulianti (Persero) Tbk', 'Eman Samosir', 'Dk. Salam No. 936, Subulussalam 91097, Bengkulu', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 409 9072 3059', 'Kerajinan', 'Roti Goreng', 'UD', 2020, '6424', 'Maxime veniam ratione maiores et.', '29', '78', 3000, 456, 'KG', 1000, 1000, 5, 1, 1),
(60, 2018, 'CV Simbolon', 'Kania Ellis Nurdiyanti M.Ak', 'Dk. Fajar No. 572, Lhokseumawe 80207, Papua', 'TAMALATE', 'KOTA TIMUR', '0703 3293 1415', 'Alat Berat', 'Roti Goreng', 'UD', 2020, '9578', 'Neque dolores id sapiente sit.', '24', '69', 5000, 321, 'KG', 5000, 10000, 5, 1, 1),
(61, 2021, 'UD Hartati', 'Digdaya Lurhur Hidayanto', 'Psr. Moch. Toha No. 259, Lubuklinggau 95845, Maluku', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 899 4841 6968', 'Alat Berat', 'Roti Goreng', 'PO', 2020, '2594', 'Temporibus nesciunt quia.', '68', '37', 3000, 120, 'KG', 200, 1000, 5, 1, 5),
(62, 2017, 'CV Hutasoit Oktaviani', 'Raisa Keisha Yuniar S.Sos', 'Jln. Adisucipto No. 806, Bekasi 14005, Kalteng', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0547 8813 204', 'Makanan', 'Las Besi', 'PT', 2020, '582', 'Tenetur non consequatur.', '21', '83', 1000, 411, 'KG', 1000, 10000, 5, 1, 4),
(63, 2020, 'UD Winarsih Januar Tbk', 'Cici Mayasari S.Sos', 'Jln. Cikutra Timur No. 224, Bitung 48000, Kalsel', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0550 2458 478', 'Alat Berat', 'Roti Goreng', 'PT', 2020, '4562', 'Qui iste suscipit ullam.', '76', '77', 200, 270, 'KG', 200, 3000, 5, 1, 2),
(64, 2019, 'UD Namaga', 'Faizah Lailasari', 'Ds. Sampangan No. 490, Banjar 95776, Papua', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 551 6276 180', 'Makanan', 'Las Besi', 'PT', 2020, '4448', 'Dolores iusto est.', '51', '65', 4000, 851, 'KG', 5000, 100, 5, 1, 2),
(65, 2021, 'PD Purnawati Hassanah', 'Gara Pratama', 'Psr. Tubagus Ismail No. 729, Kupang 32812, Kalsel', 'TAMALATE', 'KOTA TIMUR', '0202 1674 1348', 'Kerajinan', 'Las Besi', 'PO', 2020, '437', 'Minus quidem facilis doloribus sed.', '92', '42', 100, 543, 'KG', 4000, 100, 5, 1, 1),
(66, 2019, 'UD Pradipta', 'Usyi Sudiati', 'Dk. Astana Anyar No. 886, Prabumulih 48457, Sulteng', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0848 0835 547', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '1230', 'Voluptate aut distinctio.', '9', '64', 1000, 622, 'KG', 10000, 4000, 5, 1, 3),
(67, 2021, 'PT Kusumo Tbk', 'Chelsea Riyanti', 'Gg. Nanas No. 875, Bau-Bau 24487, Jatim', 'HELEDULAA UTARA', 'KOTA TIMUR', '0887 708 500', 'Makanan', 'Kameja Karawo', 'PT', 2020, '5928', 'Iste fugiat.', '5', '8', 100, 916, 'KG', 4000, 3000, 5, 1, 5),
(68, 2019, 'UD Farida Kuswoyo', 'Omar Mahfud Prasasta', 'Ki. Salak No. 697, Bima 52720, Kalteng', 'MOODU', 'KOTA TIMUR', '0898 3148 821', 'Kerajinan', 'Roti Goreng', 'PO', 2020, '2091', 'Aut sit iure fugiat.', '93', '5', 1000, 63, 'KG', 3000, 2000, 5, 1, 4),
(69, 2022, 'CV Farida', 'Cakrawala Ramadan', 'Psr. Sudirman No. 808, Pagar Alam 95165, Malut', 'MOODU', 'KOTA TIMUR', '0230 8117 9804', 'Makanan', 'Las Besi', 'PT', 2020, '753', 'Tempora facilis sit.', '67', '11', 100, 847, 'KG', 10000, 5000, 5, 1, 2),
(70, 2019, 'Perum Puspita (Persero) Tbk', 'Candrakanta Santoso', 'Dk. Kyai Gede No. 983, Banda Aceh 22758, Aceh', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 902 1378 4681', 'Kerajinan', 'Kameja Karawo', 'PT', 2020, '613', 'Repellat est quasi ut.', '88', '69', 2000, 95, 'KG', 4000, 2000, 5, 1, 1),
(71, 2022, 'PD Zulaika', 'Labuh Gunarto', 'Psr. Dahlia No. 59, Bandung 47722, Lampung', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0279 6380 040', 'Makanan', 'Roti Goreng', 'PO', 2020, '9879', 'Quaerat non voluptatem non.', '66', '42', 4000, 939, 'KG', 100, 2000, 5, 1, 3),
(72, 2022, 'PT Lailasari Saputra (Persero) Tbk', 'Lintang Salsabila Mandasari S.E.', 'Ds. Abdul Muis No. 436, Palopo 67536, Bengkulu', 'MOODU', 'KOTA TIMUR', '(+62) 844 060 333', 'Makanan', 'Las Besi', 'PO', 2020, '7714', 'Eos voluptate aperiam qui.', '87', '53', 4000, 410, 'KG', 4000, 3000, 5, 1, 5),
(73, 2019, 'UD Puspasari Waskita (Persero) Tbk', 'Uchita Usamah S.Psi', 'Psr. Tentara Pelajar No. 210, Palu 43699, Babel', 'MOODU', 'KOTA TIMUR', '0345 2492 298', 'Makanan', 'Las Besi', 'PO', 2020, '7372', 'Consequuntur illum quos.', '62', '11', 4000, 331, 'KG', 5000, 4000, 5, 1, 3),
(74, 2019, 'Perum Pangestu', 'Kemal Thamrin', 'Jln. Sentot Alibasa No. 427, Cirebon 48000, Lampung', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0505 4759 0914', 'Alat Berat', 'Las Besi', 'PO', 2020, '7004', 'Beatae et voluptas.', '47', '35', 5000, 249, 'KG', 4000, 1000, 5, 1, 3),
(75, 2016, 'CV Napitupulu Budiman', 'Hafshah Yolanda S.H.', 'Psr. Salak No. 460, Administrasi Jakarta Timur 25674, Sulbar', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 394 2465 662', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '538', 'Tempora omnis nisi.', '13', '40', 100, 854, 'KG', 2000, 3000, 5, 1, 3),
(76, 2021, 'UD Haryanto', 'Hartaka Sitompul', 'Jr. Sutan Syahrir No. 334, Tidore Kepulauan 95851, Bengkulu', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 948 2204 941', 'Alat Berat', 'Las Besi', 'PO', 2020, '9304', 'Earum dolore ut.', '48', '6', 5000, 10, 'KG', 10000, 1000, 5, 1, 2),
(77, 2019, 'Perum Wijayanti Tbk', 'Ganep Saptono', 'Dk. Bakaru No. 577, Kupang 36589, Banten', 'MOODU', 'KOTA TIMUR', '0875 2259 733', 'Makanan', 'Roti Goreng', 'PO', 2020, '1562', 'Autem nulla molestiae.', '52', '64', 10000, 560, 'KG', 200, 5000, 5, 1, 4),
(78, 2021, 'CV Maryati', 'Bagya Budiman', 'Kpg. Suprapto No. 144, Bontang 50174, Babel', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 726 8598 798', 'Alat Berat', 'Las Besi', 'UD', 2020, '3537', 'Similique in incidunt.', '94', '16', 3000, 918, 'KG', 1000, 1000, 5, 1, 1),
(79, 2021, 'UD Mustofa Saragih', 'Restu Hastuti', 'Psr. Sugiyopranoto No. 754, Pagar Alam 16610, DKI', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 356 4010 809', 'Kerajinan', 'Kameja Karawo', 'PT', 2020, '5559', 'Ullam quisquam consequatur.', '9', '83', 100, 671, 'KG', 10000, 2000, 5, 1, 2),
(80, 2019, 'PT Sihombing', 'Dalimin Prasetyo', 'Dk. Yoga No. 86, Solok 70757, Sulsel', 'TAMALATE', 'KOTA TIMUR', '025 0956 9360', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '3189', 'Consequuntur eveniet excepturi.', '29', '98', 100, 295, 'KG', 4000, 200, 5, 1, 4),
(81, 2016, 'PD Saputra Utami', 'Halima Vicky Rahimah', 'Jr. Sutoyo No. 498, Padangpanjang 50741, Jateng', 'MOODU', 'KOTA TIMUR', '0377 3682 6778', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '1039', 'Et aut aspernatur.', '74', '59', 10000, 896, 'KG', 1000, 4000, 5, 1, 4),
(82, 2020, 'PT Lailasari Oktaviani', 'Jail Halim Mansur', 'Jln. Sampangan No. 77, Salatiga 13749, Sumut', 'TAMALATE', 'KOTA TIMUR', '0967 8882 4425', 'Makanan', 'Roti Goreng', 'UD', 2020, '3694', 'Ut dolorem eum.', '94', '58', 10000, 561, 'KG', 1000, 4000, 5, 1, 1),
(83, 2016, 'UD Wibowo Irawan', 'Jarwadi Dirja Irawan M.Kom.', 'Ds. Fajar No. 305, Sabang 25838, Sumut', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0883 7906 237', 'Kerajinan', 'Roti Goreng', 'PT', 2020, '5573', 'Eos animi esse.', '59', '11', 5000, 685, 'KG', 10000, 200, 5, 1, 2),
(84, 2020, 'PD Puspita Anggraini (Persero) Tbk', 'Mulyono Salahudin M.Farm', 'Dk. Bakau Griya Utama No. 859, Makassar 78956, Sulut', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 824 801 264', 'Makanan', 'Kameja Karawo', 'PO', 2020, '236', 'Sequi minima dolore est.', '66', '1', 1000, 378, 'KG', 10000, 5000, 5, 1, 2),
(85, 2020, 'PT Agustina Halimah (Persero) Tbk', 'Padma Astuti', 'Jr. Dago No. 365, Parepare 26217, Sulsel', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 858 0257 698', 'Alat Berat', 'Kameja Karawo', 'UD', 2020, '6727', 'Fugiat ut ut doloremque.', '34', '34', 3000, 817, 'KG', 3000, 3000, 5, 1, 5),
(86, 2022, 'PD Lazuardi (Persero) Tbk', 'Yuni Patricia Utami', 'Jr. Raya Setiabudhi No. 562, Cirebon 87230, Gorontalo', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 24 7295 0801', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '9413', 'Soluta iusto ducimus.', '4', '83', 1000, 993, 'KG', 4000, 10000, 5, 1, 5),
(87, 2020, 'PD Halimah Rajasa Tbk', 'Cinta Ira Rahimah', 'Jln. Baya Kali Bungur No. 254, Langsa 23090, Kaltara', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 23 2223 363', 'Kerajinan', 'Roti Goreng', 'PO', 2020, '5809', 'Sequi excepturi eum.', '34', '69', 2000, 916, 'KG', 3000, 10000, 5, 1, 4),
(88, 2017, 'CV Puspasari Tbk', 'Martana Sihombing', 'Kpg. Baing No. 247, Pagar Alam 74758, Bengkulu', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0946 6932 309', 'Alat Berat', 'Las Besi', 'PO', 2020, '9836', 'Ea itaque distinctio.', '73', '62', 5000, 600, 'KG', 100, 3000, 5, 1, 1),
(89, 2022, 'PT Kusmawati Situmorang', 'Talia Nuraini M.Kom.', 'Gg. Barasak No. 840, Pangkal Pinang 59506, Aceh', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 680 0819 9328', 'Kerajinan', 'Las Besi', 'PT', 2020, '3183', 'Non repudiandae totam.', '26', '14', 3000, 600, 'KG', 10000, 10000, 5, 1, 4),
(90, 2016, 'PT Saputra Sirait', 'Cahyanto Simbolon', 'Dk. Raya Setiabudhi No. 9, Manado 87006, Kepri', 'MOODU', 'KOTA TIMUR', '0992 2210 602', 'Makanan', 'Roti Goreng', 'PO', 2020, '5794', 'Commodi nulla earum distinctio.', '45', '57', 100, 859, 'KG', 1000, 1000, 5, 1, 2),
(91, 2017, 'UD Suwarno Sirait', 'Adinata Firgantoro', 'Ds. Cihampelas No. 43, Pasuruan 69719, Kalteng', 'TAMALATE', 'KOTA TIMUR', '(+62) 487 4858 233', 'Kerajinan', 'Roti Goreng', 'PT', 2020, '8458', 'Et minus culpa unde.', '59', '33', 4000, 750, 'KG', 4000, 3000, 5, 1, 5),
(92, 2020, 'PD Budiman Tbk', 'Slamet Jaya Sinaga', 'Dk. Jend. Sudirman No. 127, Metro 88423, Sumbar', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 367 8717 2977', 'Makanan', 'Las Besi', 'PO', 2020, '9133', 'Neque quam sed.', '66', '31', 4000, 333, 'KG', 1000, 100, 5, 1, 1),
(93, 2022, 'UD Melani Tbk', 'Janet Melani', 'Psr. Yosodipuro No. 921, Jayapura 50431, Jatim', 'HELEDULAA UTARA', 'KOTA TIMUR', '0961 9737 9137', 'Makanan', 'Las Besi', 'UD', 2020, '3251', 'Qui sint vel occaecati commodi.', '98', '77', 5000, 756, 'KG', 200, 2000, 5, 1, 3),
(94, 2020, 'PT Rahmawati', 'Hairyanto Mumpuni Setiawan M.Pd', 'Kpg. Sutoyo No. 335, Sukabumi 42502, Jambi', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 879 346 818', 'Makanan', 'Roti Goreng', 'UD', 2020, '5446', 'Et quia accusantium quis.', '75', '19', 200, 922, 'KG', 100, 2000, 5, 1, 1),
(95, 2017, 'UD Agustina Oktaviani Tbk', 'Citra Genta Wahyuni S.Pt', 'Jln. Raya Ujungberung No. 41, Palu 22281, Kepri', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0916 6804 552', 'Alat Berat', 'Kameja Karawo', 'PO', 2020, '8127', 'Quam animi et deleniti.', '12', '38', 2000, 935, 'KG', 4000, 200, 5, 1, 2),
(96, 2019, 'CV Lestari Hardiansyah Tbk', 'Hadi Prakasa', 'Dk. Dahlia No. 683, Denpasar 15519, Banten', 'TAMALATE', 'KOTA TIMUR', '(+62) 364 5648 353', 'Alat Berat', 'Roti Goreng', 'PO', 2020, '8297', 'Ut eveniet quam.', '4', '74', 3000, 211, 'KG', 2000, 10000, 5, 1, 1),
(97, 2021, 'UD Rajasa Tbk', 'Hari Nashiruddin S.T.', 'Ki. Kartini No. 763, Padang 24618, Sumut', 'TAMALATE', 'KOTA TIMUR', '0303 8764 732', 'Alat Berat', 'Las Besi', 'PO', 2020, '7670', 'Dolorem quis eos delectus.', '78', '3', 1000, 383, 'KG', 100, 1000, 5, 1, 3),
(98, 2021, 'UD Pratiwi Handayani Tbk', 'Cahyadi Saefullah', 'Ds. Jayawijaya No. 944, Mataram 89221, Sumbar', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0844 9752 080', 'Kerajinan', 'Roti Goreng', 'PO', 2020, '6581', 'Aut labore sed.', '10', '80', 200, 803, 'KG', 1000, 100, 5, 1, 1),
(99, 2020, 'UD Winarsih Handayani Tbk', 'Tri Tampubolon', 'Dk. Nanas No. 199, Tidore Kepulauan 31299, NTT', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0849 7082 7174', 'Alat Berat', 'Las Besi', 'PO', 2020, '2409', 'Eum provident cumque.', '92', '43', 3000, 338, 'KG', 3000, 2000, 5, 1, 2),
(100, 2021, 'PT Saragih (Persero) Tbk', 'Qori Anggraini', 'Gg. Babadak No. 601, Magelang 81521, Jambi', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 908 4231 2646', 'Makanan', 'Roti Goreng', 'PO', 2020, '4243', 'Nisi corporis sit velit.', '13', '7', 100, 206, 'KG', 200, 3000, 5, 1, 5),
(101, 2017, 'UD Agustina Tbk', 'Padma Purwanti', 'Kpg. Elang No. 70, Blitar 22143, Jabar', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 20 0985 982', 'Alat Berat', 'Roti Goreng', 'UD', 2020, '9044', 'Quisquam quia eligendi delectus.', '39', '59', 4000, 866, 'KG', 1000, 4000, 5, 1, 1),
(102, 2018, 'PT Firmansyah Tbk', 'Ella Sabrina Hartati', 'Ds. Rajawali Timur No. 737, Tual 75009, Bengkulu', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0231 1717 959', 'Makanan', 'Las Besi', 'PO', 2020, '1726', 'Aut quia vel aperiam.', '19', '64', 1000, 918, 'KG', 100, 2000, 5, 1, 4),
(103, 2017, 'Perum Safitri (Persero) Tbk', 'Indah Lestari S.Ked', 'Ki. Bappenas No. 178, Administrasi Jakarta Selatan 30768, Malut', 'TAMALATE', 'KOTA TIMUR', '0731 3982 0069', 'Alat Berat', 'Kameja Karawo', 'UD', 2020, '5515', 'Suscipit voluptates.', '59', '82', 4000, 711, 'KG', 4000, 5000, 5, 1, 2),
(104, 2018, 'UD Hartati Nashiruddin', 'Umi Cinta Suartini', 'Gg. Baja No. 105, Payakumbuh 79794, Aceh', 'MOODU', 'KOTA TIMUR', '0595 9151 5102', 'Makanan', 'Kameja Karawo', 'PO', 2020, '2286', 'Velit fuga qui ut.', '85', '64', 4000, 259, 'KG', 1000, 5000, 5, 1, 5),
(105, 2016, 'Perum Hassanah Tbk', 'Radit Rusman Pratama S.Sos', 'Gg. Adisucipto No. 42, Gunungsitoli 75247, Kaltim', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 25 5454 1529', 'Kerajinan', 'Las Besi', 'PT', 2020, '6379', 'Tempora aliquid quisquam.', '11', '74', 200, 633, 'KG', 2000, 100, 5, 1, 4),
(106, 2019, 'Perum Wijayanti', 'Lidya Astuti M.M.', 'Jln. Kebonjati No. 701, Pagar Alam 10578, Malut', 'HELEDULAA UTARA', 'KOTA TIMUR', '0881 598 484', 'Kerajinan', 'Las Besi', 'PT', 2020, '3855', 'Hic inventore assumenda.', '8', '53', 200, 365, 'KG', 1000, 10000, 5, 1, 5),
(107, 2018, 'PT Sihotang Jailani', 'Narji Vero Prasasta', 'Jln. Ters. Buah Batu No. 689, Kotamobagu 15681, Sulteng', 'MOODU', 'KOTA TIMUR', '(+62) 439 6950 1747', 'Kerajinan', 'Roti Goreng', 'PT', 2020, '9725', 'Provident assumenda aperiam.', '64', '66', 4000, 500, 'KG', 1000, 3000, 5, 1, 5),
(108, 2021, 'CV Oktaviani Tbk', 'Nadine Wulandari', 'Kpg. K.H. Wahid Hasyim (Kopo) No. 716, Langsa 47557, Kaltim', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0691 2255 1682', 'Alat Berat', 'Kameja Karawo', 'UD', 2020, '7645', 'Nam praesentium deleniti qui.', '7', '49', 4000, 646, 'KG', 4000, 2000, 5, 1, 3),
(109, 2019, 'PT Mulyani Usamah', 'Emong Marpaung M.M.', 'Kpg. Krakatau No. 442, Pagar Alam 18451, Lampung', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 206 8835 104', 'Makanan', 'Las Besi', 'PT', 2020, '5124', 'Optio expedita sed quisquam occaecati.', '5', '7', 2000, 651, 'KG', 200, 5000, 5, 1, 3),
(110, 2022, 'CV Sirait Maryadi', 'Ade Nasyidah S.Pt', 'Dk. Jend. A. Yani No. 87, Tangerang Selatan 16744, Maluku', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0825 927 179', 'Alat Berat', 'Kameja Karawo', 'UD', 2020, '5504', 'Eaque sapiente et molestiae.', '49', '28', 2000, 989, 'KG', 4000, 3000, 5, 1, 4),
(111, 2020, 'Perum Utami (Persero) Tbk', 'Gaduh Prasetya', 'Ki. Sadang Serang No. 34, Tebing Tinggi 80955, Malut', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 807 899 322', 'Makanan', 'Las Besi', 'UD', 2020, '7264', 'Atque cum.', '42', '92', 2000, 884, 'KG', 1000, 4000, 5, 1, 5),
(112, 2021, 'CV Nainggolan', 'Hairyanto Habibi M.TI.', 'Ds. Teuku Umar No. 201, Padangsidempuan 76480, Jatim', 'TAMALATE', 'KOTA TIMUR', '0437 4031 484', 'Alat Berat', 'Las Besi', 'PO', 2020, '3920', 'Tenetur iste.', '50', '56', 10000, 294, 'KG', 200, 4000, 5, 1, 1),
(113, 2018, 'CV Pangestu Farida', 'Nrima Harto Dongoran S.IP', 'Dk. Kyai Gede No. 665, Bima 86882, NTT', 'MOODU', 'KOTA TIMUR', '0512 1699 1662', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '7968', 'Aliquid voluptas et exercitationem.', '16', '81', 1000, 66, 'KG', 4000, 200, 5, 1, 1),
(114, 2017, 'PD Lazuardi', 'Unjani Novitasari S.Ked', 'Gg. Nakula No. 39, Manado 14583, Sulsel', 'TAMALATE', 'KOTA TIMUR', '0364 6773 0470', 'Alat Berat', 'Las Besi', 'PT', 2020, '5286', 'Dolore quisquam et consequatur.', '57', '66', 10000, 203, 'KG', 10000, 3000, 5, 1, 4),
(115, 2020, 'CV Wahyuni', 'Gaduh Marsito Gunarto', 'Dk. Untung Suropati No. 612, Makassar 84174, NTT', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 427 8267 0802', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '6935', 'Explicabo est iure.', '1', '12', 100, 40, 'KG', 10000, 4000, 5, 1, 5),
(116, 2022, 'CV Novitasari (Persero) Tbk', 'Tira Rahmawati S.Pd', 'Jln. Baiduri No. 475, Batam 30314, DIY', 'MOODU', 'KOTA TIMUR', '020 4524 7207', 'Kerajinan', 'Las Besi', 'PT', 2020, '8188', 'Et et quia veniam.', '2', '93', 100, 367, 'KG', 100, 2000, 5, 1, 4),
(117, 2021, 'PT Anggraini', 'Zalindra Suartini S.E.I', 'Jr. Camar No. 806, Lubuklinggau 27876, Jabar', 'TAMALATE', 'KOTA TIMUR', '0836 4487 273', 'Alat Berat', 'Las Besi', 'PO', 2020, '3515', 'Voluptas sed fugiat.', '26', '38', 100, 65, 'KG', 1000, 5000, 5, 1, 5),
(118, 2019, 'CV Siregar Nuraini', 'Tari Utami S.H.', 'Jr. Dr. Junjunan No. 902, Samarinda 96217, Maluku', 'TAMALATE', 'KOTA TIMUR', '(+62) 497 5983 5991', 'Alat Berat', 'Roti Goreng', 'PO', 2020, '4752', 'Autem optio.', '39', '75', 3000, 725, 'KG', 5000, 10000, 5, 1, 2),
(119, 2020, 'CV Budiman', 'Tiara Yulianti', 'Gg. Madiun No. 68, Batam 26484, Maluku', 'TAMALATE', 'KOTA TIMUR', '(+62) 995 8243 142', 'Alat Berat', 'Kameja Karawo', 'PT', 2020, '2260', 'Maiores fugit.', '33', '89', 4000, 189, 'KG', 200, 100, 5, 1, 4),
(120, 2016, 'PD Budiyanto Uyainah', 'Mahmud Nababan', 'Gg. Baja No. 650, Tidore Kepulauan 75827, DIY', 'TAMALATE', 'KOTA TIMUR', '0518 1292 7842', 'Alat Berat', 'Las Besi', 'UD', 2020, '6418', 'Accusantium quibusdam porro totam.', '29', '51', 100, 943, 'KG', 3000, 3000, 5, 1, 5),
(121, 2019, 'PT Saefullah (Persero) Tbk', 'Victoria Padmasari', 'Psr. Padma No. 550, Tegal 79746, Papua', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 310 4901 678', 'Kerajinan', 'Las Besi', 'PT', 2020, '6115', 'Aut et omnis nihil.', '83', '43', 100, 36, 'KG', 5000, 5000, 5, 1, 5),
(122, 2019, 'CV Simbolon Samosir', 'Wulan Lestari S.IP', 'Jr. Baja No. 491, Makassar 88716, Jambi', 'MOODU', 'KOTA TIMUR', '0854 628 169', 'Kerajinan', 'Las Besi', 'UD', 2020, '561', 'Et dolor veritatis.', '9', '8', 10000, 752, 'KG', 4000, 3000, 5, 1, 1),
(123, 2017, 'PD Widodo Tamba (Persero) Tbk', 'Zulfa Dewi Zulaika S.H.', 'Dk. Banal No. 614, Ambon 67894, Kalsel', 'HELEDULAA UTARA', 'KOTA TIMUR', '0716 6987 587', 'Makanan', 'Kameja Karawo', 'PT', 2020, '1540', 'Atque deleniti ratione dolores.', '15', '38', 5000, 344, 'KG', 10000, 1000, 5, 1, 3),
(124, 2021, 'CV Prasasta Wibisono (Persero) Tbk', 'Tomi Samosir', 'Jln. Arifin No. 70, Sabang 93700, Jabar', 'MOODU', 'KOTA TIMUR', '020 3826 868', 'Makanan', 'Las Besi', 'PT', 2020, '7939', 'Iste consequatur voluptatibus.', '46', '91', 1000, 166, 'KG', 3000, 200, 5, 1, 1),
(125, 2018, 'CV Yuniar (Persero) Tbk', 'Kalim Sirait S.H.', 'Jln. Madiun No. 669, Banda Aceh 51446, Riau', 'TAMALATE', 'KOTA TIMUR', '026 6570 718', 'Kerajinan', 'Kameja Karawo', 'UD', 2020, '7509', 'Inventore omnis nihil.', '41', '21', 10000, 68, 'KG', 100, 5000, 5, 1, 3),
(126, 2018, 'Perum Riyanti Nababan (Persero) Tbk', 'Mutia Wulandari', 'Gg. Hang No. 175, Bandar Lampung 15001, Sulsel', 'HELEDULAA UTARA', 'KOTA TIMUR', '0407 9212 670', 'Makanan', 'Las Besi', 'PT', 2020, '103', 'Temporibus ipsam assumenda autem.', '94', '10', 1000, 76, 'KG', 10000, 2000, 5, 1, 2),
(127, 2016, 'PD Waluyo Rahayu', 'Ajimin Sihombing M.M.', 'Kpg. Reksoninten No. 57, Manado 12489, Kalsel', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 813 938 920', 'Alat Berat', 'Las Besi', 'PO', 2020, '5016', 'Porro ut est.', '9', '93', 3000, 520, 'KG', 10000, 5000, 5, 1, 5),
(128, 2021, 'PT Zulkarnain Lailasari Tbk', 'Kayla Yulianti', 'Psr. Radio No. 267, Semarang 83005, Bengkulu', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 536 6915 5631', 'Alat Berat', 'Roti Goreng', 'PO', 2020, '5676', 'Facere non maiores.', '12', '70', 1000, 980, 'KG', 100, 3000, 5, 1, 2),
(129, 2018, 'PT Prasasta Tbk', 'Eko Wahyudin', 'Ds. Aceh No. 355, Makassar 15743, Bengkulu', 'HELEDULAA UTARA', 'KOTA TIMUR', '0960 4357 4621', 'Makanan', 'Kameja Karawo', 'UD', 2020, '9639', 'Quam temporibus praesentium quia.', '11', '22', 200, 781, 'KG', 100, 3000, 5, 1, 4),
(130, 2016, 'PD Hardiansyah Wasita Tbk', 'Yahya Permadi', 'Jr. Badak No. 497, Makassar 80246, Kaltara', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0493 1503 965', 'Makanan', 'Roti Goreng', 'UD', 2020, '8981', 'Nobis dolorum qui dolor.', '89', '21', 1000, 337, 'KG', 5000, 5000, 5, 1, 4),
(131, 2022, 'Perum Nasyidah Pratiwi Tbk', 'Hendra Irawan', 'Kpg. Taman No. 183, Tanjung Pinang 84614, Malut', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 595 2087 446', 'Kerajinan', 'Roti Goreng', 'UD', 2020, '5069', 'Consectetur vitae veniam ut.', '9', '96', 1000, 702, 'KG', 1000, 100, 5, 1, 4),
(132, 2016, 'UD Ardianto Puspasari', 'Icha Oktaviani M.Kom.', 'Kpg. Bara Tambar No. 567, Pangkal Pinang 24614, Pabar', 'HELEDULAA UTARA', 'KOTA TIMUR', '0504 9650 5047', 'Kerajinan', 'Kameja Karawo', 'UD', 2020, '904', 'Dolorem commodi hic.', '69', '77', 10000, 6, 'KG', 10000, 2000, 5, 1, 5),
(133, 2017, 'PT Yuniar Megantara', 'Tugiman Samsul Latupono', 'Psr. Kartini No. 955, Payakumbuh 85263, Malut', 'MOODU', 'KOTA TIMUR', '(+62) 795 4425 8684', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '525', 'A qui ea voluptatem.', '78', '23', 10000, 491, 'KG', 200, 200, 5, 1, 2),
(134, 2016, 'UD Mardhiyah Hasanah (Persero) Tbk', 'Dadap Kurniawan', 'Psr. Bacang No. 535, Singkawang 76295, Sumut', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0223 8230 750', 'Kerajinan', 'Las Besi', 'PO', 2020, '7921', 'Architecto maxime perferendis quo.', '5', '58', 200, 381, 'KG', 5000, 10000, 5, 1, 5),
(135, 2021, 'UD Saptono Mangunsong Tbk', 'Nyana Simbolon', 'Gg. Bara Tambar No. 845, Padang 40484, Malut', 'HELEDULAA UTARA', 'KOTA TIMUR', '0502 2944 3695', 'Alat Berat', 'Las Besi', 'UD', 2020, '8669', 'Dolore maxime dolore omnis.', '27', '50', 2000, 93, 'KG', 4000, 10000, 5, 1, 5),
(136, 2021, 'UD Permata Siregar', 'Marsito Hutagalung', 'Psr. Pasir Koja No. 237, Depok 11104, Gorontalo', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 27 0492 9880', 'Makanan', 'Las Besi', 'PT', 2020, '3526', 'Quo dolorum non quisquam.', '31', '81', 1000, 348, 'KG', 3000, 100, 5, 1, 4),
(137, 2016, 'CV Puspita Hakim', 'Bala Elvin Winarno', 'Jr. Ujung No. 586, Denpasar 66526, Jateng', 'TAMALATE', 'KOTA TIMUR', '0562 1359 1250', 'Makanan', 'Las Besi', 'UD', 2020, '5124', 'Sed consequatur ullam nulla.', '65', '38', 100, 198, 'KG', 10000, 200, 5, 1, 5),
(138, 2019, 'PT Widodo Mangunsong (Persero) Tbk', 'Jessica Michelle Purwanti', 'Jln. Bappenas No. 575, Manado 48361, Banten', 'HELEDULAA UTARA', 'KOTA TIMUR', '0910 4475 0724', 'Alat Berat', 'Kameja Karawo', 'PT', 2020, '9619', 'Suscipit voluptatem eligendi.', '5', '1', 5000, 913, 'KG', 100, 3000, 5, 1, 4),
(139, 2020, 'UD Simbolon', 'Lutfan Tamba', 'Ki. Halim No. 286, Sorong 20559, Pabar', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 635 5495 348', 'Kerajinan', 'Las Besi', 'PT', 2020, '9158', 'Aspernatur qui.', '52', '44', 5000, 849, 'KG', 2000, 2000, 5, 1, 3),
(140, 2022, 'CV Oktaviani Santoso (Persero) Tbk', 'Olivia Suartini S.Farm', 'Ki. Raden No. 301, Denpasar 18006, Banten', 'TAMALATE', 'KOTA TIMUR', '0865 4030 354', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '4616', 'Molestiae impedit iure autem.', '44', '55', 4000, 375, 'KG', 3000, 5000, 5, 1, 5),
(141, 2020, 'PT Damanik', 'Hafshah Rahmi Mandasari', 'Psr. Babakan No. 226, Pariaman 19107, Jambi', 'MOODU', 'KOTA TIMUR', '(+62) 815 035 542', 'Makanan', 'Kameja Karawo', 'PT', 2020, '1589', 'Qui quidem ducimus molestiae.', '52', '63', 4000, 869, 'KG', 200, 3000, 5, 1, 2),
(142, 2020, 'UD Rajasa Tbk', 'Jasmin Purnawati', 'Ki. Basket No. 213, Padang 25237, NTB', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 710 8480 5715', 'Makanan', 'Kameja Karawo', 'PT', 2020, '5964', 'Nemo repellendus provident voluptas.', '79', '71', 5000, 572, 'KG', 5000, 200, 5, 1, 1),
(143, 2022, 'CV Kuswandari Widodo', 'Cemeti Suryono', 'Gg. Villa No. 227, Palu 16631, Aceh', 'HELEDULAA SELATAN', 'KOTA TIMUR', '0753 6403 420', 'Kerajinan', 'Kameja Karawo', 'PO', 2020, '6896', 'Adipisci cupiditate quidem.', '18', '36', 1000, 4, 'KG', 5000, 5000, 5, 1, 2),
(144, 2018, 'PT Kuswandari Wibowo Tbk', 'Luluh Umaya Wibowo S.Ked', 'Kpg. Halim No. 399, Medan 62238, Bali', 'TAMALATE', 'KOTA TIMUR', '(+62) 756 2361 684', 'Kerajinan', 'Roti Goreng', 'UD', 2020, '9850', 'Est non excepturi perspiciatis.', '76', '63', 4000, 314, 'KG', 100, 5000, 5, 1, 3),
(145, 2019, 'UD Pudjiastuti (Persero) Tbk', 'Kusuma Januar S.E.I', 'Kpg. Baik No. 684, Cimahi 29633, Kalsel', 'MOODU', 'KOTA TIMUR', '(+62) 688 2431 6629', 'Alat Berat', 'Roti Goreng', 'PT', 2020, '1475', 'Earum hic ducimus quaerat.', '60', '66', 2000, 215, 'KG', 4000, 4000, 5, 1, 4),
(146, 2022, 'Perum Pudjiastuti', 'Samsul Pranowo', 'Kpg. Sutami No. 839, Tegal 69048, Aceh', 'MOODU', 'KOTA TIMUR', '0455 3661 4937', 'Kerajinan', 'Kameja Karawo', 'UD', 2020, '905', 'Voluptates vitae sit.', '30', '60', 200, 364, 'KG', 4000, 200, 5, 1, 4),
(147, 2020, 'CV Padmasari', 'Wahyu Pradipta S.T.', 'Ki. Yos No. 83, Gunungsitoli 26774, Pabar', 'HELEDULAA SELATAN', 'KOTA TIMUR', '(+62) 235 0950 0939', 'Kerajinan', 'Las Besi', 'UD', 2020, '398', 'Voluptate consequatur maiores.', '7', '12', 10000, 172, 'KG', 200, 2000, 5, 1, 3),
(148, 2020, 'PT Purnawati Pratiwi Tbk', 'Ajiono Nugroho', 'Psr. Rumah Sakit No. 707, Binjai 13466, Kalsel', 'HELEDULAA UTARA', 'KOTA TIMUR', '(+62) 693 0146 768', 'Alat Berat', 'Las Besi', 'PT', 2020, '7876', 'Ut minima ducimus.', '13', '9', 100, 326, 'KG', 10000, 4000, 5, 1, 2),
(149, 2018, 'Perum Yolanda Habibi Tbk', 'Dartono Thamrin', 'Ki. Babadak No. 562, Subulussalam 20561, Kaltara', 'MOODU', 'KOTA TIMUR', '0505 3892 9512', 'Kerajinan', 'Las Besi', 'PO', 2020, '9289', 'Libero et vel.', '18', '59', 200, 76, 'KG', 100, 2000, 5, 1, 4),
(150, 2019, 'PT Najmudin Pangestu', 'Waluyo Jailani', 'Kpg. Asia Afrika No. 916, Banjarmasin 74411, Lampung', 'TAMALATE', 'KOTA TIMUR', '0943 8856 7245', 'Kerajinan', 'Las Besi', 'UD', 2020, '6993', 'Ea ut.', '19', '78', 100, 452, 'KG', 10000, 2000, 5, 1, 3),
(155, 2020, 'KASMA', '', 'TRANS SULAWESI', '', 'MANANGGU', '082292360182', 'INDUSTRI MINYAK GORENG KELAPA', 'MINYAK KELAPA', 'PO', NULL, '10423', '', '', '2', 1000, 100, 'BOTOL', 1000, 800, 5, 1, 2),
(156, 2020, 'IND TAHU', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI TAHU KEDELAI', 'TAHU', 'PO', NULL, '10392', '', '2', '', 500, 432000, 'BIJI', 86400, 1000, 5, 1, 2),
(157, 2020, 'SUROSO TAHU', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI TAHU KEDELAI', 'TAHU', 'PO', NULL, '10392', '', '2', '', 5000, 540, 'BIJI', 8100, 2000, 5, 1, 2),
(158, 2020, 'SURIYATI KUE', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'KUE KERING', 'PO', NULL, '10710', '', '', '2', 500, 1000, 'BUNGKUS', 5000, 1500, 5, 1, 2),
(159, 2020, 'MARYAM THALIB', '', '', '', 'MANANGGU', '', '', 'BAGEA', 'PO', NULL, '', '', '', '2', 5000, 1500, 'BUNGKUS', 5000, 1750, 5, 1, 2),
(160, 2020, '', '', '', '', 'MANANGGU', '', '', 'BAGEA', 'PO', NULL, '', '', '', '2', 5000, 1500, 'BUNGKUS', 5000, 1750, 5, 1, 2),
(161, 2020, '', '', '', '', 'MANANGGU', '', '', 'KERIPIK PISANG', 'PO', NULL, '', '', '', '2', 5000, 1500, 'BUNGKUS', 7500, 1750, 5, 1, 2),
(162, 2020, 'BUMDES', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'MINYAK KELAPA', 'MINYAK KELAPA', 'PO', NULL, '10423', '', '3', '3', 500, 192, 'BOTOL', 2000, 1500, 5, 1, 2),
(163, 2020, 'RATNA', '', '', '', 'MANANGGU', '', 'INDUSTRI MINYAK GORENG KELAPA', 'MINYAK KELAPA', 'PO', NULL, '10423', '', '', '2', 5000, 200, 'BOTOL', 2000, 1500, 5, 1, 2),
(164, 2020, 'JAMARUDIN', '', '', '', 'MANANGGU', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '', 6000, 1000, 'KG', 1500, 850, 5, 1, 2),
(165, 2020, 'PANYO', '', '', '', 'MANANGGU', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '', 6000, 1000, 'KG', 5000, 1750, 5, 1, 2),
(166, 2020, 'ATNAN', '', '', '', 'MANANGGU', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '1', '', 3000, 250, 'KG', 5000, 1750, 5, 1, 2),
(167, 2020, 'SALEH PAHANGGA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '1', 1000, 72000, 'BIJI', 10000, 5000, 5, 1, 2),
(168, 2020, 'MUIS PAHANGGA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '1', 5000, 72000, 'BIJI', 10000, 5000, 5, 1, 2),
(169, 2020, 'HASAN PAHANGGA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '1', 5000, 72000, 'BIJI', 10000, 5000, 5, 1, 2),
(170, 2020, 'AMALIA\'S FOOD', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI PENGOLAHAN DAN PENGAWETAN LAINNYA UNTUK IKAN', 'SAMBAL ROWA', 'PO', NULL, '10219', '', '', '5', 5000, 6000, 'BOTOL', 30000, 5000, 5, 1, 2),
(171, 2020, 'ADRIAN PAHANGGA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'GULA AREN', 'PO', NULL, '10722', '', '2', '', 6000, 1000, 'KG', 5000, 850, 5, 1, 2),
(172, 2020, 'AKO', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'GULA AREN', 'PO', NULL, '10722', '', '2', '', 6000, 1000, 'KG', 5000, 850, 5, 1, 2),
(173, 2020, 'ATTE CAKE', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI PEMBUATAN KUE BASAH DAN KERING', 'KUE', 'PO', NULL, '10761', '', '', '4', 2500, 500, 'KG', 2700, 1083, 5, 1, 2),
(174, 2020, 'UDIN PAHANGGA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '1', 6000, 1000, 'KG', 20000, 12500, 5, 1, 2),
(175, 2020, 'DARWIN PAHANGGA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 6000, 1000, 'KG', 2500, 1000, 5, 1, 2),
(176, 2020, 'IBRAHIM PAHANGGA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '1', 6000, 1000, 'KG', 5000, 850, 5, 1, 2),
(177, 2020, 'BASIR PAHANGGA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 6000, 1000, 'KG', 5000, 1500, 5, 1, 2),
(178, 2020, 'KARIM', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'GULA AREN', 'PO', NULL, '10722', '', '2', '', 6000, 1000, 'KG', 5000, 1500, 5, 1, 2),
(179, 2020, 'RAMIN ', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'GULA AREN', 'PO', NULL, '10722', '', '2', '', 6000, 1000, 'KG', 5000, 1000, 5, 1, 2),
(180, 2020, 'RAMU', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '1', 1000, 72000, 'BIJI', 2500, 1000, 5, 1, 2),
(181, 2020, 'NURMAWATI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI MAKANAN DAN MASAKAN OLAHAN', 'DODOL ', 'PO', NULL, '10750', '', '', '2', 5000, 3000, 'BKS', 1000, 500, 5, 1, 2),
(182, 2020, 'HENDRISTON', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '1', '', 20000, 5000, 'GALON', 5000, 850, 5, 1, 2),
(183, 2020, 'TEGUH      ', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '2', '', 20000, 5000, 'GALON', 5000, 850, 5, 1, 2),
(184, 2020, 'SUWARDI      DEPOT AIR', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '1', '', 20000, 5000, 'GALON', 7500, 2000, 5, 1, 2),
(185, 2020, 'PONI KOPI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '1', '1', 2500, 500, 'KG', 5000, 850, 5, 1, 2),
(186, 2020, 'ANWAR KOPI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '1', '1', 2500, 500, 'KG', 5000, 850, 5, 1, 2),
(187, 2020, 'DINO KOPI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '1', '1', 2500, 500, 'KG', 2500, 900, 5, 1, 2),
(188, 2020, 'MASRI KOPI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '1', '1', 2500, 500, 'KG', 5000, 900, 5, 1, 2),
(189, 2020, 'ENGKI KOPI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '1', '1', 2500, 600, 'KG', 5000, 850, 5, 1, 2),
(190, 2020, 'MUSTIN RO', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '1', '', 20000, 5000, 'GALON', 5000, 850, 5, 1, 2),
(191, 2020, 'FARID RO', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '2', '', 20000, 5000, 'GALON', 5000, 850, 5, 1, 2),
(192, 2020, 'SUARDI ', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '1', '', 20000, 5000, 'GALON', 5000, 850, 5, 1, 2),
(193, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUAT KUE KERING ( CURUTI)', 'CURUTI', 'PO', NULL, '', '', '', '1', 500, 80, 'TOPLES', 3000, 500, 5, 1, 2),
(194, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUAT KUE KERING (BISKUIT MENTEGA)', 'BISKUIT MENTEGA', 'PO', NULL, '', '', '', '', 1000, 120, 'TOPLES', 3500, 1000, 5, 1, 2),
(195, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUAT KUE KERING (BISKUIT MENTEGA)', 'BISKUIT MENTEGA', 'PO', NULL, '', '', '', '', 1000, 120, 'TOPLES', 3500, 1000, 5, 1, 2),
(196, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUAT KUE KERING (BISKUIT MENTEGA)', 'BISKUIT MENTEGA', 'PO', NULL, '', '', '', '', 1000, 120, 'TOPLES', 3500, 1000, 5, 1, 2),
(197, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUAT KUE KERING (BISKUIT MENTEGA)', 'BISKUIT MENTEGA', 'PO', NULL, '', '', '', '', 1000, 120, 'TOPLES', 3500, 1000, 5, 1, 2);
INSERT INTO `investasi` (`id`, `tahun`, `nama_ikm`, `nama_pemilik`, `alamat`, `keldesa`, `kecamatan`, `telp`, `komoditi`, `produk`, `bentuk_badan_usaha`, `tahun_izin`, `kode_kbli`, `kbli`, `tkl`, `tkp`, `nilai_investasi`, `jumlah_produksi`, `satuan`, `nilai_produksi`, `nilai_bbbp`, `user_id`, `kabkota_id`, `industri_id`) VALUES
(198, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUAT KERUPUK /KRIPIK PEYE DAN SEJENISNYA', 'KERUPUK BAWANG', 'PO', NULL, '', '', '', '', 500, 600, 'BUNGKUS', 3500, 500, 5, 1, 2),
(199, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGAWETAN ABON ROWA', 'ABON ROWA', 'PO', NULL, '', '', '2', '2', 5000, 800, 'KALENG', 35000, 5000, 5, 1, 2),
(200, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(201, 2020, 'DESSERT', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(202, 2020, '', '', '', '', 'TILAMUTA', '', '', 'MINYAK KELAPA', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(203, 2020, '', '', '', '', 'TILAMUTA', '', '', 'MINYAK KELAPA', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(204, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUAT KERUPUK /KRIPIK PEYE DAN SEJENISNYA', 'KRIPIK PISANG', 'PO', NULL, '', '', '', '', 2500, 300, 'BUNGKUS', 4500, 2500, 5, 1, 2),
(205, 2020, '', '', '', '', 'TILAMUTA', '', '', 'GULA-GULA SOBA', 'PO', NULL, '', '', '', '', 2500, 300, 'BUNGKUS', 4500, 2500, 5, 1, 2),
(206, 2020, '', '', '', '', 'TILAMUTA', '', '', 'ES  MAMBO', 'PO', NULL, '', '', '', '', 2500, 300, 'BUNGKUS', 4500, 2500, 5, 1, 2),
(207, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(208, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(209, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(210, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(211, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(212, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(213, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(214, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(215, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(216, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(217, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(218, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(219, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(220, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(221, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(222, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(223, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENJUALAN KUE BASAH,KERING DAN LAIN LAIN', 'KUE BASAH', 'PO', NULL, '47242', '', '1', '3', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 2),
(224, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PABRIK ROTI', 'ROTI', 'PO', NULL, '', '', '2', '2', 5000, 18, 'BKS', 30000, 5000, 5, 1, 2),
(225, 2020, 'ROTI BALINDA', '', '', '', 'TILAMUTA', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'ROTI', 'PO', NULL, '10710', '', '3', '1', 5000, 28800, 'BIJI', 10500, 2500, 5, 1, 2),
(226, 2020, 'PIA RIZKI', '', '', '', 'TILAMUTA', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'PIA', 'PO', NULL, '10710', '', '', '2', 1000, 2500, 'BIJI', 30000, 5000, 5, 1, 2),
(227, 2020, 'ELY\'S KUE', '', '', '', 'TILAMUTA', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'KUE KERING', 'PO', NULL, '10710', '', '', '2', 500000, 1000, 'BUNGKUS', 55000, 5000, 5, 1, 2),
(228, 2020, 'RIEKA COOKIES N FOOD', '', '', '', 'TILAMUTA', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'KUE KERING', 'PO', NULL, '10710', '', '', '', 0, 0, '', 5000, 1500, 5, 1, 2),
(229, 2020, 'KEDAI SYIFA', '', '', '', 'TILAMUTA', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'KUE KERING', 'PO', NULL, '10710', '', '', '', 0, 0, '', 0, 0, 5, 1, 2),
(230, 2020, 'ZIVANKA', '', '', '', 'TILAMUTA', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'KUE KERING', 'PO', NULL, '10710', '', '', '', 0, 0, '', 0, 0, 5, 1, 2),
(231, 2020, 'ISMAIL', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '', 5000, 800, 'BIJI', 0, 0, 5, 1, 2),
(232, 2020, 'DIKO', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '', 5000, 800, 'BIJI', 25000, 1000, 5, 1, 2),
(233, 2020, 'HAMZAH', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '', 5000, 800, 'BIJI', 25000, 1000, 5, 1, 2),
(234, 2020, 'JAHI PAHANGGA', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '2', 5000, 72000, 'BIJI', 25000, 1000, 5, 1, 2),
(235, 2020, 'WIN-WIN BAKERY', '', '', '', 'TILAMUTA', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'ROTI', 'PO', NULL, '10710', '', '10', '', 10000, 3600000, 'BUNGKUS', 25000, 1500, 5, 1, 2),
(236, 2020, 'SUNDARI', '', '', '', 'TILAMUTA', '', 'INDUSTRI TEMPE KEDELAI', 'TEMPE', 'PO', NULL, '10391', '', '', '1', 1000, 500, 'KILOGRAM', 55000, 5000, 5, 1, 2),
(237, 2020, 'SAHRUDIN', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '', 5000, 187500, 'KG', 30000, 5000, 5, 1, 2),
(238, 2020, 'ACO', '', '', '', 'TILAMUTA', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERUPUK', 'PO', NULL, '10794', '', '1', '', 5000, 180, 'KILOGRAM', 36000, 24000, 5, 1, 2),
(239, 2020, 'CONFIDENCE', '', '', '', 'TILAMUTA', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '2', '3', 5000, 5000, 'BKS', 10000, 5000, 5, 1, 2),
(240, 2020, 'INSAN CITA', '', '', '', 'TILAMUTA', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '2', '3', 5000, 5000, 'BKS', 5000, 2000, 5, 1, 2),
(241, 2020, 'ELAS', '', '', '', 'TILAMUTA', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '1', '4', 5000, 5000, 'BKS', 21600, 10000, 5, 1, 2),
(242, 2020, 'WIRABA', '', '', '', 'TILAMUTA', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '3', '1', 5000, 5000, 'BKS', 10000, 1000, 5, 1, 2),
(243, 2020, 'EKHA FOOD', '', '', '', 'TILAMUTA', '', 'INDUSTRI MAKANAN DAN MASAKAN OLAHAN', 'ABON,AYAM GEPREK', 'PO', NULL, '10750', '', '1', '2', 10000, 5000, 'BUAH', 8000, 1000, 5, 1, 2),
(244, 2020, 'PAPPER COOKIES', '', '', '', 'TILAMUTA', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KUE KERING', 'PO', NULL, '10794', '', '1', '4', 5000, 5000, 'BKS', 7000, 1000, 5, 1, 2),
(245, 2020, 'TI TETTY', '', '', '', 'TILAMUTA', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KUE KERING', 'PO', NULL, '10794', '', '1', '4', 5000, 5000, 'BKS', 5000, 1000, 5, 1, 2),
(246, 2020, 'MEUBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUATAN KUE KERING DAN BASAH', 'KUE KERING', 'PO', NULL, '47242', '', '', '2', 5000, 10000, 'BUAH', 17000, 5000, 5, 1, 2),
(247, 2020, 'KARYA BERSAMA', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGASAPAN IKAN', 'IKAN TILAPO', 'PO', NULL, '10212', '', '5', '3', 5000, 28800, 'EKOR', 7000, 1000, 5, 1, 2),
(248, 2020, 'ZAIPON SAGELA', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGASAPAN IKAN', 'SAGELA/ROWA', 'PO', NULL, '10212', '', '10', '', 50000, 60, 'EKOR', 7000, 1000, 5, 1, 2),
(249, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGOLAHAN DAN PENAGWETAN ABON IKAN', 'ABON IKAN', 'PO', NULL, '15123', '', '', '1', 1500, 120, 'BKS', 7500, 2000, 5, 1, 2),
(250, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA AREN', 'GULA MERAH', 'PO', NULL, '15422', '', '1', '', 500, 63360, 'BUAH', 10000, 6912, 5, 1, 2),
(251, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA AREN', 'GULA MERAH', 'PO', NULL, '15422', '', '1', '', 500, 4700, 'BIJI', 60000, 25000, 5, 1, 2),
(252, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA AREN', 'GULA MERAH', 'PO', NULL, '15422', '', '1', '', 500, 6300, 'BIJI', 60000, 25000, 5, 1, 2),
(253, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA AREN', 'GULA MERAH', 'PO', NULL, '15422', '', '1', '', 500, 4000, 'BIJI', 4500, 1500, 5, 1, 2),
(254, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI GULA AREN', 'GULA MERAH', 'PO', NULL, '15422', '', '1', '', 500, 4800, 'BIJI', 10000, 500, 5, 1, 2),
(255, 2020, 'AZILLA CAKE', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUATAN KUE KERING DAN BASAH', 'KUE KERING', '', NULL, '47242', '', '', '2', 10000, 10000, 'BUAH', 10000, 500, 5, 1, 2),
(256, 2020, 'HOKI', '', '', '', 'TILAMUTA', '', 'INDUSTRI MAKANAN DAN MASAKAN OLAHAN', 'AYAM KENTUCKY', '', NULL, '10750', '', '1', '2', 10000, 5000, 'BUAH', 10000, 500, 5, 1, 2),
(257, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUATAN KUE KERING DAN BASAH', 'KUE KERING', '', NULL, '47242', '', '', '2', 5000, 10000, 'BUAH', 10000, 500, 5, 1, 2),
(258, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUATAN KUE KERING DAN BASAH', 'KUE KERING', '', NULL, '47242', '', '', '2', 5000, 10000, 'BUAH', 10000, 500, 5, 1, 2),
(259, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI PEMBUATAN KUE KERING DAN BASAH', 'KUE KERING', '', NULL, '47242', '', '', '2', 5000, 10000, 'BUAH', 10000, 500, 5, 1, 2),
(260, 2020, '', '', '', '', 'TILAMUTA', '', 'INDSTRI PENGERINGAN IKAN TERI', 'IKAN TERI', 'PO', NULL, '', '', '2', '', 1000, 800, 'kg', 10000, 500, 5, 1, 2),
(261, 2020, '', '', '', '', 'TILAMUTA', '', 'INDSTRI PENGERINGAN IKAN TERI', 'IKAN TERI', 'PO', NULL, '', '', '2', '', 1000, 840, 'kg', 15000, 5000, 5, 1, 2),
(262, 2020, '', '', '', '', 'TILAMUTA', '', 'INDSTRI PENGERINGAN IKAN TERI', 'IKAN TERI', 'PO', NULL, '', '', '1', '', 1000, 800, 'kg', 17000, 5000, 5, 1, 2),
(263, 2020, 'RAIS RO', '', '', '', 'TILAMUTA', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '2', '', 20000, 5000, 'GALON', 7500, 2000, 5, 1, 2),
(264, 2020, 'DEPOT  AIR MINUM', '', '', '', '', '', 'RO', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', '', NULL, '11050', '', '2', '', 60000, 15000, 'BOTOL', 7500, 2000, 5, 1, 2),
(265, 2020, 'SALMAN', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '2', '', 3500, 240, 'KG', 7500, 2000, 5, 1, 2),
(266, 2020, 'USMAN', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '1', '', 3500, 240, 'KG', 36000, 500, 5, 1, 2),
(267, 2020, 'JOHN KOPI', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '2', '', 3500, 240, 'KG', 36000, 500, 5, 1, 2),
(268, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '11050', '', '3', '', 60000, 15, 'BOTOL', 36000, 500, 5, 1, 2),
(269, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '11050', '', '3', '', 60000, 15, 'BOTOL', 25000, 5000, 5, 1, 2),
(270, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '11050', '', '2', '', 60000, 15, 'BOTOL', 45000, 12000, 5, 1, 2),
(271, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '11050', '', '1', '', 60000, 15, 'BOTOL', 15000, 10000, 5, 1, 2),
(272, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '11050', '', '1', '', 60000, 15, 'BOTOL', 15000, 10000, 5, 1, 2),
(273, 2020, 'ISMAN RO', '', '', '', 'TILAMUTA', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '1', '', 20000, 5000, 'GALON', 15000, 10000, 5, 1, 2),
(274, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '00011', '', '2', '', 60000, 15000, 'BOTOL', 45000, 12000, 5, 1, 2),
(275, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '00011', '', '3', '', 60000, 15000, 'BOTOL', 45000, 12000, 5, 1, 2),
(276, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '00011', '', '2', '', 60000, 15000, 'BOTOL', 45000, 12000, 5, 1, 2),
(277, 2020, 'DEPOT AIR MINUM', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGISIAN AIR MINUM DAN MINERAL', 'RO', 'PO', NULL, '00011', '', '2', '', 6000, 15000, 'BOTOL', 45000, 12000, 5, 1, 2),
(278, 2020, 'ASIA', '', 'TRANS SULAWESI', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI MINYAK GORENG KELAPA', 'MINYAK KELAPA', 'PO', NULL, '10423', '', '', '2', 5000, 200, 'BOTOL', 2000, 1500, 5, 1, 2),
(279, 2020, '', '', 'TRANS SULAWESI', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI PENGOLAHAN DAN PENGAWETAN LAINNYA UNTUK IKAN', 'ABON ', 'PO', NULL, '10219', '', '5', '5', 2500, 360, 'bks', 9000, 2000, 5, 1, 2),
(280, 2020, 'SAGELA BANGGA II', '', '', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI PENGASAPAN IKAN', 'SAGELA/ROWA', 'PO', NULL, '10212', '', '8', '2', 50000, 60000, 'EKOR', 60000, 25000, 5, 1, 2),
(281, 2020, 'IKAN ROA', '', '', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI PENGOLAHAN DAN PENGAWETAN LAINNYA UNTUK IKAN', 'ABON ROWA', 'PO', NULL, '10219', '', '', '4', 2500, 5000, 'PAK', 5000, 3000, 5, 1, 2),
(282, 2020, 'SAGELA ', '', '', '', 'PAGUYAMAN PANTAI', 'KAB. BOALEMO', 'INDUSTRI PENGASAPAN IKAN', 'SAGELA/ROWA', 'PO', 2016, '10212', '', '8', '2', 50000, 60000, 'EKOR', 60000, 25000, 5, 1, 2),
(283, 2020, '', '', '', '', 'PAGUYAMAN PANTAI', 'KAB. BOALEMO', 'INDUSTRI PENGASAPAN IKAN', 'SAGELA/ROWA', 'PO', 2016, '10212', '', '8', '2', 50000, 60000, 'EKOR', 60000, 25000, 5, 1, 2),
(284, 2020, 'RO NAZWA', '', 'TRANS SULAWESI', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', 2015, '11050', '', '1', '', 20000, 5000, 'GALON', 25000, 5000, 5, 1, 2),
(285, 2020, 'RO NELCO', '', 'TRANS SULAWESI', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', 2014, '11050', '', '1', '', 20000, 5000, 'GALON', 25000, 5000, 5, 1, 2),
(286, 2020, 'ZAINATUN', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '', '1', 5000, 5000, 'BKS', 2700, 1083, 5, 1, 2),
(287, 2020, 'PAINEM', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '', '1', 5000, 5000, 'BKS', 7000, 1000, 5, 1, 2),
(288, 2020, 'JASMIRAH', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '', '1', 10000, 5000, 'BKS', 7000, 1000, 5, 1, 2),
(289, 2020, 'RINI', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '', '1', 5000, 5000, 'BKS', 7000, 1000, 5, 1, 2),
(290, 2020, 'KAMSI', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '15496', '', '1', '1', 5000, 5000, 'BKS', 7000, 1000, 5, 1, 2),
(291, 2020, 'SUKRAN TAHU', '', '', '', 'WONOSARI', '', 'INDUSTRI TAHU KEDELAI', 'TAHU', 'PO', NULL, '10392', '', '6', '', 10000, 540, 'Kg', 7000, 1000, 5, 1, 2),
(292, 2020, 'IND.TAHU', '', '', '', 'WONOSARI', '', 'IND MAKANAN DR KEDELE DAN KACANG2 LAINNYA SELAIN KECAP TEMPE', 'TAHU', 'PO', NULL, '15495', '', '', '3', 9000, 540, 'Kg', 8100, 316666, 5, 1, 2),
(293, 2020, 'SUHARTI KRIPIK', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '', '1', 5000, 5000, 'BKS', 45000, 1000, 5, 1, 2),
(294, 2020, 'EDI WIDODO', '', '', '', 'WONOSARI', '', 'INDUSTRI TEPUNG BERAS DAN TEPUNG JAGUNG', 'TEPUNG BERAS', 'PO', NULL, '10633', '', '4', '', 20000, 25, 'KG', 7000, 1000, 5, 1, 2),
(295, 2020, 'ADI PRACOYO', '', '', '', 'WONOSARI', '', 'INDUSTRI PENGGILINGAN DAN PEMBERSIHAN JAGUNG', 'PENGGILINGAN JAGUNG', 'PO', NULL, '10632', '', '2', '1', 20000, 30, 'TON', 20000, 5000, 5, 1, 2),
(296, 2020, 'TEGUH MARGININGSIH', '', '', '', 'WONOSARI', '', 'INDUSTRI TEPUNG BERAS DAN TEPUNG JAGUNG', 'TEPUNG BERAS', 'PO', NULL, '10633', '', '2', '1', 20000, 50, 'KG', 25000, 5000, 5, 1, 2),
(297, 2020, 'GINEM KERUPUK', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '', '2', 2000, 100, 'BKS', 50000, 7500, 5, 1, 2),
(298, 2020, 'SAYUTI', '', '', '', 'WONOSARI', '', 'INDUSTRI MAKANAN DAN MASAKAN OLAHAN', 'CARANG MAS (UBI)', 'PO', NULL, '10750', '', '5', '', 500000, 36000, 'BKS', 5000, 500000, 5, 1, 2),
(299, 2020, 'BUGIMIN', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'REMPEYEK', 'PO', NULL, '10794', '', '3', '', 30000, 36000, 'BKS', 360000, 250000, 5, 1, 2),
(300, 2020, 'NGADIEM', '', '', '', 'WONOSARI', '', 'INDUSTRI MAKANAN DAN MASAKAN OLAHAN', 'CETILAN (TERIGU)', 'PO', NULL, '10750', '', '3', '', 300000, 36000, 'BKS', 36000, 11500, 5, 1, 2),
(301, 2020, 'INDUSTRI TAHU', '', '', '', 'WONOSARI', '', 'INDUSTRI TAHU KEDELAI', 'TAHU', 'PO', NULL, '10392', '', '2', '', 20000, 432000, 'BIJI', 360000, 150000, 5, 1, 2),
(302, 2020, 'HASNUL', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK SINGKONG', 'PO', NULL, '10794', '', '5', '', 30000, 72000, 'BKS', 400000, 250000, 5, 1, 2),
(303, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK   SINGKONG', 'PO', NULL, '15496', '', '', '1', 2000, 200, 'BKS', 500000, 250000, 5, 1, 2),
(304, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK   TERIGU', 'PO', NULL, '15496', '', '', '1', 2000, 100, 'BKS', 72000, 15000, 5, 1, 2),
(305, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK   TEPUNG', 'PO', NULL, '', '', '', '1', 2000, 100, 'BKS', 7500, 500, 5, 1, 2),
(306, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI MIE BASAH', 'MIE', 'PO', NULL, '', '', '', '1', 1000, 50, 'KILO', 5000, 500, 5, 1, 2),
(307, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI MIE BASAH', 'MIE', 'PO', NULL, '', '', '', '1', 1000, 50, 'KILO', 5000, 500, 5, 1, 2),
(308, 2020, 'KRIPIK VINA', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '3', '', 1500, 6000, 'BKS', 5000, 500, 5, 1, 2),
(309, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '3', '', 1500, 6000, 'BKS', 5000, 500, 5, 1, 2),
(310, 2020, 'GP. SINAR MINI', '', '', '', 'WONOSARI', '', 'INDUSTRI PENGGILINGAN PADI DAN PENYOSOHAN BERAS', 'PADI', 'PO', NULL, '10631', '', '4', '', 25000, 23, 'TON', 4500, 2100, 5, 1, 2),
(311, 2020, 'SUKARTI', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERUPUK', 'PO', NULL, '10794', '', '', '1', 1000, 7200, 'BKS', 4500, 2100, 5, 1, 2),
(312, 2020, 'HASLAH', '', '', '', 'WONOSARI', '', 'INDUSTRI PENGGILINGAN PADI DAN PENYOSOHAN BERAS', 'PADI', 'PO', NULL, '10631', '', '1', '', 25000, 8, 'TON', 11250, 5512, 5, 1, 2),
(313, 2020, 'SITI', '', '', '', 'WONOSARI', '', 'INDUSTRI TEMPE KEDELAI', 'TEMPE', 'PO', NULL, '10391', '', '', '3', 500000, 1880, 'TON', 360000, 500000, 5, 1, 2),
(314, 2020, 'RIDWAN', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '3', '', 5000, 14400, 'BKS', 3750, 1837, 5, 1, 2),
(315, 2020, 'MAHPUDIN', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK', 'PO', NULL, '10794', '', '3', '', 5000, 14400, 'BKS', 900000, 500000, 5, 1, 2),
(316, 2020, 'YULIONO', '', '', '', 'WONOSARI', '', 'INDUSTRI PENGOLAHAN DAN PENGAWETAN LAINMNYA BUAH-BUAHAN DAN SAYURAN', 'PISANG SALE  (DOMPO)', 'PO', NULL, '10399', '', '4', '', 500000, 9600, 'BUNGKUS', 14400, 5000, 5, 1, 2),
(317, 2020, 'KARMAN', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK SINGKONG', 'PO', NULL, '10794', '', '3', '', 5000, 36000, 'BKS', 14400, 2500, 5, 1, 2),
(318, 2020, 'KLPOK ERLIN', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK  PISANG', 'PO', NULL, '10794', '', '', '10', 5000, 108000, 'BKS', 480000, 200000, 5, 1, 2),
(319, 2020, 'KLPOK SABIN', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK SINGKONG', 'PO', NULL, '10794', '', '5', '', 5000, 72000, 'BKS', 3600, 2500, 5, 1, 2),
(320, 2020, 'AGUS', '', '', '', 'WONOSARI', '', 'INDUSTRI PENGOLAHAN KOPI DAN TEH', 'KOPI BUBUK', 'PO', NULL, '10761', '', '2', '', 150000, 240, 'KG', 1080, 250, 5, 1, 2),
(321, 2020, 'RAIS', '', '', '', 'WONOSARI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '', 5000, 25200, 'BIJI', 7200, 2500, 5, 1, 2),
(322, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERUPUK', 'PO', NULL, '15496', '', '1', '', 5000, 5500, 'BKS', 12000, 7000, 5, 1, 2),
(323, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KRIPIK SINGKONG', 'PO', NULL, '15496', '', '2', '', 5000, 5000, 'BKS', 63000, 20000, 5, 1, 2),
(324, 2020, 'IND.TAHU', '', '', '', 'WONOSARI', '', 'INDUSTRI TAHU KEDELAI', 'TAHU', 'PO', NULL, '10392', '', '3', '', 9000, 18000, 'KG', 8500, 1000, 5, 1, 2),
(325, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK SINGKONG', 'PO', NULL, '15496', '', '', '1', 5000, 5500, 'BKS', 7000, 1000, 5, 1, 2),
(326, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK SINGKONG', 'PO', NULL, '15496', '', '', '3', 5000, 5000, 'BKS', 45000, 1000, 5, 1, 2),
(327, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK SINGKONG', 'PO', NULL, '15496', '', '', '1', 5000, 5500, 'BKS', 8500, 1000, 5, 1, 2),
(328, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK PISANG', 'PO', NULL, '15496', '', '', '1', 5000, 5000, 'BKS', 7000, 1000, 5, 1, 2),
(329, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KERIPIK SINGKONG', 'PO', NULL, '15496', '', '', '2', 5000, 5500, 'BKS', 8500, 1000, 5, 1, 2),
(330, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI PEMBUAT STIK JAGUNG DAN SEJENISNYA', 'STIK JAGUNG', 'PO', NULL, '15496', '', '', '1', 5000, 5000, 'BKS', 7000, 1000, 5, 1, 2),
(331, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI PEMBUAT KUE KERING', 'KUE KERING', 'PO', NULL, '', '', '', '1', 5000, 120, 'BKS', 8500, 1000, 5, 1, 2),
(332, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI PEMBUAT KUE KERING', 'KUE KERING', 'PO', NULL, '', '', '', '2', 5000, 135, 'BKS', 7000, 1000, 5, 1, 2),
(333, 2020, 'KABUL', '', '', '', 'WONOSARI', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '1', '', 20000, 5000, 'GALON', 8500, 1000, 5, 1, 2),
(334, 2020, 'ISMET D NUSI', '', '', '', 'WONOSARI', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '2', '', 20000, 5000, 'GALON', 7000, 1000, 5, 1, 2),
(335, 2020, 'TEPUNG PISANG', '', '', '', 'BOTUMOITO', '', 'INDUSTRI KERUPUK DAN SEJENISNYA', 'KRIPIK PISANG', 'PO', NULL, '15496', '', '1', '2', 1000, 500, 'BUNGKUS', 2500, 500000, 5, 1, 2),
(336, 2020, 'ROTI COFFE', '', '', '', 'BOTUMOITO', '', 'INDUSTRI PRODUK ROTI DAN KUE', 'ROTI', 'PO', NULL, '10614', '', '', '1', 1000, 590, 'BIJI', 3000, 1500, 5, 1, 2),
(337, 2020, 'KARTI N', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '2', 5000, 72000, 'BIJI', 2500, 500000, 5, 1, 2),
(338, 2020, '', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '4', '', 5000, 72000, 'BIJI', 3000, 1500, 5, 1, 2),
(339, 2020, 'HAMSIR ', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '4', '', 5000, 86400, 'BIJI', 15000, 10000, 5, 1, 2),
(340, 2020, 'SUARDI', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'GULA       MERAH', 'INDUSTRI GULA AREN', 'PO', NULL, '15422', '', '1', '1', 500, 720, 'BIJI', 15000, 1000, 5, 1, 2),
(341, 2020, 'SAURIN', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'GULA     MERAH', 'INDUSTRI GULA AREN', 'PO', NULL, '15422', '', '1', '1', 500, 720, 'BIJI', 10000, 5000, 5, 1, 2),
(342, 2020, 'SARCI', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'GULA    MERAH', 'INDUSTRI GULA AREN', 'PO', NULL, '15422', '', '1', '1', 500, 720, 'BIJI', 5500, 1200, 5, 1, 2),
(343, 2020, 'YUNUS', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '3', '2', 5000, 72000, 'BIJI', 18000, 650, 5, 1, 2),
(344, 2020, '', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'GULA MERAH', 'INDUSTRI GULA AREN', 'PO', NULL, '15422', '', '1', '1', 5000, 7201, 'BIJI', 18000, 650, 5, 1, 2),
(345, 2020, '', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'GULA MERAH', 'INDUSTRI GULA AREN', 'PO', NULL, '15422', '', '1', '', 5000, 7201, 'BIJI', 18000, 650, 5, 1, 2),
(346, 2020, '', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'GULA MERAH', 'INDUSTRI GULA AREN', 'PO', NULL, '15422', '', '1', '', 5000, 7201, 'BIJI', 15000, 7500, 5, 1, 2),
(347, 2020, '', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'GULA MERAH', 'INDUSTRI GULA AREN', 'PO', NULL, '15422', '', '1', '', 5000, 7201, 'BIJI', 18000, 6500, 5, 1, 2),
(348, 2020, '', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'GULA MERAH', 'INDUSTRI GULA AREN', 'PO', NULL, '15422', '', '1', '', 5000, 7201, 'BIJI', 18000, 6500, 5, 1, 2),
(349, 2020, '', '', '', '', 'BOTUMOITO', '', 'KUE KERING', 'INDUSTRI PEMBUAT KUE KERING', 'PO', NULL, '10710', '', '', '1', 500, 450, 'BIJI', 18000, 6500, 5, 1, 2),
(350, 2020, '', '', '', '', 'BOTUMOITO', '', 'KUE KERING', 'INDUSTRI PEMBUAT KUE KERING', 'PO', NULL, '10710', '', '', '1', 1000, 65, 'TOPLES', 18000, 6500, 5, 1, 2),
(351, 2020, '', '', '', '', 'BOTUMOITO', '', 'KUE KERING', 'INDUSTRI PEMBUAT KUE KERING', 'PO', NULL, '10710', '', '', '1', 1000, 50, 'TOPLES', 18000, 6500, 5, 1, 2),
(352, 2020, '', '', '', '', 'BOTUMOITO', '', 'KUE KERING', 'INDUSTRI PEMBUAT KUE KERING', 'PO', NULL, '10710', '', '', '1', 1000, 35, 'TOPLES', 3000, 500, 5, 1, 2),
(353, 2020, 'SALMIN', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '', 5000, 7200, 'BIJI', 2500, 500, 5, 1, 2),
(354, 2020, 'UMAR', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '', 5000, 7201, 'BIJI', 2000, 500, 5, 1, 2),
(355, 2020, 'SAMAN', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '', 5000, 7202, 'BIJI', 1500, 500, 5, 1, 2),
(356, 2020, 'KALI', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '', 5000, 7203, 'BIJI', 1500, 500, 5, 1, 2),
(357, 2020, 'WAWAN KRIPIK', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK  PISANG', 'PO', NULL, '10794', '', '5', '', 5000, 72000, 'BKS', 10000, 5000, 5, 1, 2),
(358, 2020, 'MANISAN KOLANG KALING', '', '', '', 'BOTUMOITO', '', 'INDUSTRI BAHAN MAKANAN HASIL PERANIAN DLL', 'MANISAN KOLANG KALING', '', NULL, '4631', '', '1', '1', 2500, 500, 'CUP', 20000, 8000, 5, 1, 2),
(359, 2020, 'MANISAN KOLANG KALING', '', '', '', 'BOTUMOITO', '', 'INDUSTRI BAHAN MAKANAN HASIL PERANIAN DLL', 'MANISAN KOLANG KALING', '', NULL, '4631', '', '1', '1', 2500, 500, 'CUP', 5000, 1000, 5, 1, 2),
(360, 2020, '', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA AREN', 'GULA   MERAH', 'PO', NULL, '15422', '', '1', '', 500, 7200, 'BIJI', 18000, 5000, 5, 1, 2),
(361, 2020, 'HARIYONO ', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'GULA   MERAH', 'PO', NULL, '10722', '', '1', '1', 5000, 7201, 'BIJI', 18000, 6500, 5, 1, 2),
(362, 2020, 'ASTIN', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'GULA   MERAH', 'PO', NULL, '10722', '', '1', '2', 5000, 7200, 'BIJI', 20000, 1000, 5, 1, 2),
(363, 2020, 'YANCE', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'GULA   MERAH', 'PO', NULL, '10722', '', '1', '1', 5000, 7201, 'BIJI', 18000, 1000, 5, 1, 2),
(364, 2020, 'TENI', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'GULA   MERAH', 'PO', NULL, '10722', '', '1', '1', 5000, 7202, 'BIJI', 7200, 2500, 5, 1, 2),
(365, 2020, 'WARCO', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'GULA   MERAH', 'PO', NULL, '10722', '', '1', '1', 5000, 7203, 'BIJI', 5000, 2000, 5, 1, 2),
(366, 2020, 'IWIN', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'GULA   MERAH', 'PO', NULL, '10722', '', '1', '1', 5000, 7200, 'BIJI', 5000, 2000, 5, 1, 2),
(367, 2020, 'RAMAN', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'GULA   MERAH', 'PO', NULL, '10722', '', '1', '1', 5000, 7201, 'BIJI', 18000, 500, 5, 1, 2),
(368, 2020, 'YASRIN', '', '', '', 'BOTUMOITO', '', 'INDUSTRI GULA MERAH', 'GULA   MERAH', 'PO', NULL, '10722', '', '1', '1', 5000, 7202, 'BIJI', 18000, 6500, 5, 1, 2),
(369, 2020, 'UD. BAHARI', '', '', '', 'DULUPI', '', 'INDUSTRI PENGOLAHAN ES SEJENISNYA YANG DAPAT DIMAKAN', 'ES', 'PO', NULL, '10532', '', '10', '', 100000, 1000, 'BUAH', 1000, 800, 5, 1, 2),
(370, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '', 5000, 1440, 'BIJI', 2500, 1500, 5, 1, 2),
(371, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 55000, 5000, 5, 1, 2),
(372, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 5000, 1000, 5, 1, 2),
(373, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 5000, 1000, 5, 1, 2),
(374, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 7650, 6520, 5, 1, 2),
(375, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(376, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(377, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(378, 2020, 'WAWAN PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(379, 2020, 'ELIS PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(380, 2020, 'RONI PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(381, 2020, 'HAMID PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(382, 2020, 'IKSAN PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(383, 2020, 'SUTARJO PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(384, 2020, 'ANSWAR PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(385, 2020, 'HARUNA PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(386, 2020, 'KADIR PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(387, 2020, 'ISHAK PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(388, 2020, 'YENI PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(389, 2020, 'SAMSUDIN PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(390, 2020, 'UMAR PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(391, 2020, 'HAMZAH PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(392, 2020, 'ARDUN PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(393, 2020, 'ARIPIN PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '1', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(394, 2020, 'ANDRIUS PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '1', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(395, 2020, 'RIKSON PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(396, 2020, 'ASTEN PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(397, 2020, 'YUSUF PAHANGGA', '', '', '', 'DULUPI', '', 'INDUSTRI GULA MERAH', 'Gula Merah', 'PO', NULL, '10722', '', '2', '2', 5000, 63360, 'BIJI', 10000, 5000, 5, 1, 2),
(398, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI KERUPUK, KERIPIK, PEYEK DAN SEJENISNYA', 'KERIPIK   PISANG', 'PO', NULL, '10794', '', '', '1', 30000, 72000, 'BKS', 10000, 5000, 5, 1, 2),
(399, 2020, 'LISPAN RO', '', '', '', 'DULUPI', '', 'INDUSTRI AIR MINUM DAN AIR MINERAL', 'AIR ISI ULANG', 'PO', NULL, '11050', '', '2', '', 200000, 5000, 'GALON', 10000, 5000, 5, 1, 2),
(400, 2020, 'BURHAN BATA', '', 'TRANS SULAWESI', '', 'MANANGGU', '085256395377', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '6', '2', 5000, 21600, 'BUAH', 10080, 1200, 5, 1, 3),
(401, 2020, 'KARIM BATA', '', 'TRANS SULAWESI', '', 'MANANGGU', '085396281353', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '4', '', 2500, 14400, 'BUAH', 8000, 1000, 5, 1, 3),
(402, 2020, 'ROMIN', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 10000, 2500, 'BUAH', 43200, 20000, 5, 1, 3),
(403, 2020, 'BATU BATA', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 25000, 400000, 'BIJI', 150000, 85000, 5, 1, 3),
(404, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 15000, 8500, 5, 1, 3),
(405, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 60000, 25000, 5, 1, 3),
(406, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 160000, 50000, 5, 1, 3),
(407, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 160000, 50000, 5, 1, 3),
(408, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 160000, 50000, 5, 1, 3),
(409, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(410, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(411, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(412, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(413, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(414, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(415, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(416, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(417, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(418, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(419, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(420, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(421, 2020, 'CRD', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '', '4', 2000, 180000, 'BUAH', 72000, 35000, 5, 1, 3),
(422, 2020, 'JAFAR', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 1500, 150000, 'BUAH', 72000, 35000, 5, 1, 3),
(423, 2020, 'HASAN ', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 7000, 180000, 'BUAH', 72000, 35000, 5, 1, 3),
(424, 2020, 'RISAN', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 2500, 180000, 'BUAH', 72000, 35000, 5, 1, 3),
(425, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '2', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(426, 2020, '', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '4', '', 2000, 180, 'bh', 72000, 35000, 5, 1, 3),
(427, 2020, 'YAMIN', '', '', '', 'MANANGGU', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 2000, 120000, 'BUAH', 72000, 35000, 5, 1, 3),
(428, 2020, 'UD. CEMARA HIJAU', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI PENGGERGAJIAN KAYU', 'SOMEL', 'PO', NULL, '16101', '', '', '7', 50000, 1800, 'M3', 72000, 35000, 5, 1, 3),
(429, 2020, 'ZUBAIR', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '3', '', 25000, 96, 'BUAH', 72000, 35000, 5, 1, 3),
(430, 2020, 'NIRWAN', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 5000, 120, 'BUAH', 72000, 32000, 5, 1, 3),
(431, 2020, 'RAMAN MEUBEL', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '1', '', 10000, 120, 'BUAH', 60000, 25000, 5, 1, 3),
(432, 2020, 'MEUBEL USMAN', '', 'TRANS SULAWESI', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '1', '', 5000, 6, 'UNIT', 72000, 32000, 5, 1, 3),
(433, 2020, 'MEUBEL SAFRUDIN', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 5000, 576, 'UNIT', 72000, 32000, 5, 1, 3),
(434, 2020, 'MEUBEL THAMRIN', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '6', '', 5000, 576, 'UNIT', 72000, 32000, 5, 1, 3),
(435, 2020, 'ROMIN', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 10000, 576, 'UNIT', 72000, 32000, 5, 1, 3),
(436, 2020, '', '', '', '', 'MANANGGU', '', '', 'MEUBEL KAYU', 'PO', NULL, '', '', '4', '', 15000, 1000, 'BUAH', 2250, 1500, 5, 1, 3),
(437, 2020, '', '', '', '', 'MANANGGU', '', '', 'MEUBEL KAYU', 'PO', NULL, '', '', '4', '', 15000, 1000, 'BUAH', 72000, 15000, 5, 1, 3),
(438, 2020, '', '', '', '', 'MANANGGU', '', '', 'MEUBEL KAYU', 'PO', NULL, '', '', '5', '', 15000, 1000, 'BUAH', 72000, 15000, 5, 1, 3),
(439, 2020, 'USAHA CEMPAKA', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '4', '', 5000, 15, 'BUAH', 72000, 15000, 5, 1, 3),
(440, 2020, 'BERKAT PROFIL', '', '', '', 'MANANGGU', '', 'INDUSTRI PEMBUATAN PROFIL', 'PROFIL KAYU', 'PO', NULL, '25994', '', '5', '', 5000, 72, 'M3', 72000, 15000, 5, 1, 3),
(441, 2020, 'PROFIL INDAH', '', '', '', 'MANANGGU', '', 'INDUSTRI PEMBUATAN PROFIL', 'PROFIL KAYU', 'PO', NULL, '25994', '', '10', '', 8000, 120, 'M3', 50000, 20000, 5, 1, 3),
(442, 2020, 'STIN', '', '', '', 'MANANGGU', '', 'INDUSTRI PENGGERGAJIAN KAYU', 'SOMEL', 'PO ', NULL, '16101', '', '2', '', 25000, 60, 'LEMBAR', 160, 5000, 5, 1, 3),
(443, 2020, 'MAYTUAH PROFIL', '', '', '', 'MANANGGU', '', 'INDUSTRI PEMBUATAN PROFIL', 'PROFIL KAYU', 'PO', NULL, '25994', '', '', '2', 10000, 24, 'M3', 48000, 28000, 5, 1, 3),
(444, 2020, 'DEBI MEUBEL', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 1000, 96, 'UNIT', 96000, 45000, 5, 1, 3),
(445, 2020, 'RAHMAN MEUBEL', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '3', '', 10000, 48, 'UNIT', 48000, 28000, 5, 1, 3),
(446, 2020, 'DJABIR MEUBEL', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '1', '', 1000, 96, 'UNIT', 7200, 3000, 5, 1, 3),
(447, 2020, 'WISAN', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 10000, 48, 'UNIT', 7200, 3000, 5, 1, 3),
(448, 2020, 'SONI MEUBEL', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 10000, 1080, 'UNIT', 864000, 5000, 5, 1, 3),
(449, 2020, 'RAHIM ', '', '', '', 'MANANGGU', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '1', '', 10000, 48, 'UNIT', 96000, 45000, 5, 1, 3),
(450, 2020, 'HASWAN', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(451, 2020, 'YUSUF', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(452, 2020, 'SAIDI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(453, 2020, 'NOLDI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(454, 2020, 'GAFAR', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(455, 2020, 'SUKO', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(456, 2020, 'UMAN', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(457, 2020, 'SUNI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 2000, 130000, 'BUAH', 7200, 3000, 5, 1, 3),
(458, 2020, 'ENDI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(459, 2020, 'HARLIN', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '', '1', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(460, 2020, 'MANGGATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 1000, 360000, 'BUAH', 7200, 3000, 5, 1, 3),
(461, 2020, 'SI TOU TUMOU', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '7', '', 1000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(462, 2020, 'CIRO BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '7', '', 5000, 120000, 'BUAH', 7200, 3000, 5, 1, 3),
(463, 2020, 'RISNA BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 5000, 100000, 'BUAH', 1200, 700, 5, 1, 3),
(464, 2020, 'YUSRAN BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(465, 2020, 'WAWAN BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(466, 2020, 'RUSTAM BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(467, 2020, 'SYAIFUL BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 10000, 180000, 'BUAH', 1200, 5000, 5, 1, 3),
(468, 2020, 'WIWIN BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '1', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(469, 2020, 'AJIS BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO ', NULL, '23921', '', '2', '', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(470, 2020, 'SATRIS BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 10000, 180000, 'BUAH', 85000, 3000, 5, 1, 3),
(471, 2020, 'SAPRUDIN BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 10000, 180000, 'BUAH', 85000, 3000, 5, 1, 3),
(472, 2020, 'SOFYAN BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(473, 2020, 'RISMAN BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '1', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(474, 2020, 'AZAN BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '1', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(475, 2020, 'SAFI\'I                                         ', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '1', 10000, 180000, 'BUAH', 7200, 3000, 5, 1, 3),
(476, 2020, 'ASNA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 5000, 360000, 'BUAH', 7200, 3000, 5, 1, 3),
(477, 2020, 'RAPI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 5000, 360000, 'BUAH', 7200, 3000, 5, 1, 3);
INSERT INTO `investasi` (`id`, `tahun`, `nama_ikm`, `nama_pemilik`, `alamat`, `keldesa`, `kecamatan`, `telp`, `komoditi`, `produk`, `bentuk_badan_usaha`, `tahun_izin`, `kode_kbli`, `kbli`, `tkl`, `tkp`, `nilai_investasi`, `jumlah_produksi`, `satuan`, `nilai_produksi`, `nilai_bbbp`, `user_id`, `kabkota_id`, `industri_id`) VALUES
(478, 2020, 'RUSNI ', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 5000, 360000, 'BUAH', 7200, 3000, 5, 1, 3),
(479, 2020, 'KAJO          BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 5000, 360000, 'BUAH', 7200, 3000, 5, 1, 3),
(480, 2020, 'ISMAIL      ', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 5000, 360000, 'BUAH', 7200, 3000, 5, 1, 3),
(481, 2020, '\"SIMPONI\"', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '20', '', 50000, 4320, 'biji', 7200, 3000, 5, 1, 3),
(482, 2020, 'SAFII', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '20', '', 50000, 4320, 'biji', 7200, 3000, 5, 1, 3),
(483, 2020, 'DUTA BANGUNAN', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '4', '', 50000, 172800, 'BIJI', 7200, 3000, 5, 1, 3),
(484, 2020, 'ASWIN', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '3', '', 10000, 750, 'BUAH', 7200, 3000, 5, 1, 3),
(485, 2020, 'TARA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 5000, 300000, 'BUAH', 7200, 3000, 5, 1, 3),
(486, 2020, 'BANTAI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '2', 3000, 300000, 'BUAH', 15000, 5000, 5, 1, 3),
(487, 2020, 'RUSMAN', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '6', '', 3000, 300000, 'BUAH', 14100, 3000, 5, 1, 3),
(488, 2020, 'FIRDAUS', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 3000, 300000, 'BUAH', 25000, 3000, 5, 1, 3),
(489, 2020, 'RAM', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '4', '', 3000, 300000, 'BUAH', 35000, 3000, 5, 1, 3),
(490, 2020, 'PANO', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 3000, 300000, 'BUAH', 35000, 3000, 5, 1, 3),
(491, 2020, 'ABD. RAHMAN BATA', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '5', '', 3000, 300000, 'BUAH', 35000, 3000, 5, 1, 3),
(492, 2020, 'RUSTAM BATAKO', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '3', '', 20000, 36000, 'BUAH', 5000, 3000, 5, 1, 3),
(493, 2020, 'RAHMAN', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '3', '', 20000, 36000, 'BUAH', 2160, 1500, 5, 1, 3),
(494, 2020, 'SAM MEBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 5000, 38, 'BUAH', 2160, 1500, 5, 1, 3),
(495, 2020, 'RUSTAM MEBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 5000, 38, 'BUAH', 2500, 1500, 5, 1, 3),
(496, 2020, 'MEUBEL JERI', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI PENGGERGAJIAN KAYU', 'SOMEL', 'PO', NULL, '16101', '', '4', '', 5000, 6, 'M3', 14100, 3000, 5, 1, 3),
(497, 2020, 'KEYSYA ', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '', '3', 15000, 48, 'BUAH', 4320, 3000, 5, 1, 3),
(498, 2020, 'GARIN MEUBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '6', '', 15000, 120, 'BUAH', 72000, 35000, 5, 1, 3),
(499, 2020, 'SYAMSUDIN MEUBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 4000, 48, 'BUAH', 25000, 10000, 5, 1, 3),
(500, 2020, 'HERMAN MEUBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '2', '', 10000, 120, 'BUAH', 25000, 10000, 5, 1, 3),
(501, 2020, 'KUBE', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 5000, 38, 'BUAH', 8000, 2500, 5, 1, 3),
(502, 2020, 'YASIN MEUBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 5000, 38, 'BUAH', 80000, 40000, 5, 1, 3),
(503, 2020, 'UCU MEUBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 5000, 38, 'BUAH', 80000, 40000, 5, 1, 3),
(504, 2020, 'MEUBEL PARTO', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 4000, 48, 'BUAH', 80000, 40000, 5, 1, 3),
(505, 2020, 'MEUBEL \"CEMPAKA\"', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '5', '', 2000, 24, 'unit', 80000, 40000, 5, 1, 3),
(506, 2020, 'SUPRIYANTO MEUBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 20000, 38, 'BUAH', 80000, 40000, 5, 1, 3),
(507, 2020, 'KONA MEUBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '2', '', 20000, 38, 'BUAH', 80000, 40000, 5, 1, 3),
(508, 2020, 'UTUN MEUBEL', '', '', '', 'PAGUYAMAN', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '3', '', 15000, 38, 'BUAH', 80000, 40000, 5, 1, 3),
(509, 2020, 'SAHIRA', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 5000, 27000, 'BUAH', 55000, 3500, 5, 1, 3),
(510, 2020, 'SAMAT', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 5000, 27000, 'BUAH', 60000, 3500, 5, 1, 3),
(511, 2020, 'ASMUR', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 5000, 28800, 'BUAH', 75000, 5000, 5, 1, 3),
(512, 2020, 'ABDULLAH', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '4', '', 3000, 32400, 'BUAH', 65000, 3500, 5, 1, 3),
(513, 2020, 'DESI', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '4', '', 4000, 32400, 'BUAH', 55000, 5000, 5, 1, 3),
(514, 2020, 'BATU BATA', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 1000, 400000, 'BIJI', 55000, 5000, 5, 1, 3),
(515, 2020, 'BATU BATA', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 1000, 400000, 'BIJI', 55000, 5000, 5, 1, 3),
(516, 2020, 'BATU BATA', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 1000, 400000, 'BIJI', 55000, 5000, 5, 1, 3),
(517, 2020, 'BATU BATA', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 1000, 400000, 'BIJI', 55000, 5000, 5, 1, 3),
(518, 2020, 'RAMLIN BATA', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 1000, 400000, 'BIJI', 85000, 5000, 5, 1, 3),
(519, 2020, 'BATU BATA', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 1000, 400000, 'BIJI', 75000, 2500, 5, 1, 3),
(520, 2020, 'RAMSAI', '', '', '', 'TILAMUTA', '', 'INDUSTRI PUPUK LAINNYA', 'INSEKTISIDA', 'PO', NULL, '20129', '', '3', '', 2500, 300, 'LITER', 20000, 3000, 5, 1, 3),
(521, 2020, 'ASWIN', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 3),
(522, 2020, 'HUSIN', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '4', '', 3500, 36000, 'BUAH', 18000, 2000, 5, 1, 3),
(523, 2020, 'ALEX', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '4', '', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 3),
(524, 2020, 'SUDIN', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '4', '', 1000, 27000, 'BUAH', 6000, 3000, 5, 1, 3),
(525, 2020, 'FARID', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 4000, 27000, 'BUAH', 3000, 3000, 5, 1, 3),
(526, 2020, 'WONG MOBE', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '1', 1000, 28800, 'BUAH', 60000, 4000, 5, 1, 3),
(527, 2020, 'USMAN', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '4', '', 5000, 80000, 'BUAH', 60000, 4000, 5, 1, 3),
(528, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', '', NULL, '26322', '', '2', '', 1000, 28800, 'BUAH', 3500, 1000, 5, 1, 3),
(529, 2020, 'KERAJINAN', '', '', '', 'TILAMUTA', '', 'INDUSTRI BARANG DARI SEMEN DAN KAPUR UNTUK KONSTRUKSI', 'BETON UKIR', 'PO', NULL, '23953', '', '2', '', 10000, 3300, 'BUAH', 55000, 2500, 5, 1, 3),
(530, 2020, 'WAASI', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 1000, 14000, 'BUAH', 6000, 2500, 5, 1, 3),
(531, 2020, 'WILSON', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '1', '', 500, 18, 'BIJI', 60000, 4000, 5, 1, 3),
(532, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '1', '', 3800, 80000, 'BIJI', 14400, 3600, 5, 1, 3),
(533, 2020, 'BATU BATA', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 7500, 80000, 'BIJI', 72000, 5000, 5, 1, 3),
(534, 2020, 'MEUBEL\"MEKAR JAYA\"', '', '', '', 'TILAMUTA', '', 'INDUSTRI BARANG BANGUNAN DARI KAYU', 'KUSEN', 'PO', NULL, '16221', '', '1', '', 15000, 1000, 'BUAH', 5000, 3000, 5, 1, 3),
(535, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'BATU BATA', 'PO', NULL, '26322', '', '3', '', 1000, 200000, 'BIJI', 3500, 1000, 5, 1, 3),
(536, 2020, 'WILANDRY', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '3', '', 5000, 180, 'BUAH', 19000, 3000, 5, 1, 3),
(537, 2020, 'MEUBEL \"HERLIN\"', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '', '2', 5000, 48, 'UNIT', 25000, 5000, 5, 1, 3),
(538, 2020, 'SILVA MEUBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '4', '1', 10000, 100, 'UNIT', 12000, 1500, 5, 1, 3),
(539, 2020, 'ANEKA MEUBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '4', '', 3000, 13, 'UNIT', 6000, 1000, 5, 1, 3),
(540, 2020, 'MEUBEL A2', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '2', '', 3000, 40, 'BUAH', 8100, 500, 5, 1, 3),
(541, 2020, 'MARTEN    PORABOT', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'PERABOT RT', 'PO', NULL, '36101', '', '2', '', 3000, 40, 'BUAH', 5000, 1000, 5, 1, 3),
(542, 2020, 'SAMSUDIN MEBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '1', '', 5000, 36, 'BUAH', 5000, 1000, 5, 1, 3),
(543, 2020, 'SOMEL MELATI', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGGERGAJIAN KAYU', 'SOMEL', 'PO', NULL, '16101', '', '6', '', 10000, 48, 'M3', 5000, 1000, 5, 1, 3),
(544, 2020, 'MEBEL RIZKIA', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '4', '', 10000, 48, 'BUAH', 7500, 5000, 5, 1, 3),
(545, 2020, 'MEUBEL \"RAHMATULLAH\"', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '4', '', 10000, 384, 'UNIT', 5000, 1000, 5, 1, 3),
(546, 2020, 'HARTATI SOMEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGGERGAJIAN KAYU', 'SOMEL', 'PO', NULL, '16101', '', '6', '1', 20000, 48, 'M3', 5000, 1000, 5, 1, 3),
(547, 2020, 'SUDIYONO SOME;', '', '', '', 'TILAMUTA', '', 'INDUSTRI PENGGERGAJIAN KAYU', 'SOMEL', 'PO', NULL, '16101', '', '6', '1', 20000, 48, 'M3', 10000, 2000, 5, 1, 3),
(548, 2020, 'USAHA BERSAMA', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '', '6', 5000, 24, 'UNIT', 60000, 5000, 5, 1, 3),
(549, 2020, 'KISMAN MEBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '2', '', 7500, 50, 'UNIT', 50000, 5000, 5, 1, 3),
(550, 2020, 'YAMIN MEBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 2500, 4, 'UNIT', 100000, 10000, 5, 1, 3),
(551, 2020, 'DIKO MEBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '1', '', 1500, 20, 'UNIT', 20000, 5000, 5, 1, 3),
(552, 2020, 'AHMAD MEBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '3', '', 3000, 4, 'UNIT', 6000, 1000, 5, 1, 3),
(553, 2020, 'SETIA KAWAN', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '5', '', 10000, 40, 'BUAH', 6000, 1000, 5, 1, 3),
(554, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI  FURNITUR  DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '36101', '', '2', '', 2500, 25, 'BUAH', 28800, 7200, 5, 1, 3),
(555, 2020, 'MEUBEL RAHMAT', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL', 'PO', NULL, '31001', '', '4', '', 10000, 36, 'BUAH', 28800, 7200, 5, 1, 3),
(556, 2020, 'SINAR MURNI', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '4', '', 10000, 36, 'BUAH', 27000, 10800, 5, 1, 3),
(557, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'KURSI SOFA', 'PO', NULL, '36101', '', '4', '', 10000, 36, 'STEL', 28800, 7200, 5, 1, 3),
(558, 2020, '', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '36101', '', '2', '', 10000, 48, 'BUAH', 28800, 7200, 5, 1, 3),
(559, 2020, 'YASIN MEBEl', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '2', '', 10000, 48, 'BUAH', 27000, 15000, 5, 1, 3),
(560, 2020, 'IRHAM MEBEl', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '2', '', 1000, 24, 'BUAH', 5500, 4000, 5, 1, 3),
(561, 2020, 'UNE MEBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '2', '', 1000, 24, 'BUAH', 55000, 5000, 5, 1, 3),
(562, 2020, 'RAHIM MEBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '2', '', 1000, 24, 'BUAH', 6000, 1000, 5, 1, 3),
(563, 2020, 'LINE MEBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '1', '', 1000, 25, 'BUAH', 5000, 2000, 5, 1, 3),
(564, 2020, 'HAMDAN MEUBEL', '', '', '', 'TILAMUTA', '', 'INDUSTRI FURNITUR DARI KAYU', 'Perabot Rumah Tangga', 'PO', NULL, '31001', '', '3', '', 10000, 120, 'BUAH', 5500, 4000, 5, 1, 3),
(565, 2020, 'KASNARI', '', '', '', 'WONOSARI', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '4', '', 50000, 172800, 'BIJI', 1080, 300, 5, 1, 3),
(566, 2020, 'LASRI', '', '', '', 'WONOSARI', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '', '4', 5000, 15000, 'BUAH', 4320, 3000, 5, 1, 3),
(567, 2020, 'KELI BATA', '', '', '', 'WONOSARI', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '2', 5000, 15000, 'BUAH', 48000, 33750, 5, 1, 3),
(568, 2020, 'JON', '', '', '', 'WONOSARI', '', 'INDUSTRI OVEN, PERAPIAN DAN TUNGKU PEMBAKAR SEJENIS YANG TIDAK MENGGUNAKAN ARUS LISTRIK', 'TUNGKU', 'PO', NULL, '28151', '', '1', '', 1000, 12000, 'UNIT', 48000, 33750, 5, 1, 3),
(569, 2020, 'IDRIS', '', '', '', 'WONOSARI', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '1', '', 25000, 72000, 'BIJI', 5400, 3000, 5, 1, 3),
(570, 2020, 'SUDIRMAN BATA', '', '', '', 'WONOSARI', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 1000, 72000, 'BIJI', 5400, 3000, 5, 1, 3),
(571, 2020, 'ASDI  ARSAD', '', '', '', 'WONOSARI', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 5000, 50000, 'BIJI', 6000, 5000, 5, 1, 3),
(572, 2020, 'UMARA BATA', '', '', '', 'WONOSARI', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 5000, 72000, 'BIJI', 10800, 2500, 5, 1, 3),
(573, 2020, 'ABDUH RAHMAN ', '', '', '', 'WONOSARI', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '3', '', 5000, 100000, 'BIJI', 21600, 10000, 5, 1, 3),
(574, 2020, 'SURATNA', '', '', '', 'WONOSARI', '', 'INDUSTRI PUPUK LAINNYA', 'PUPUK ORGANIK', 'PO', NULL, '20129', '', '7', '', 25000, 288, 'TON', 21600, 10000, 5, 1, 3),
(575, 2020, 'MEUBEL MAIL', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '5', '', 50000, 15, 'UNIT', 21600, 10000, 5, 1, 3),
(576, 2020, 'ALEX MEUBEL', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '5', '', 5000, 24, 'UNIT', 21600, 10000, 5, 1, 3),
(577, 2020, '', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '36101', '', '4', '', 50000, 15, 'UNIT', 5760, 2500, 5, 1, 3),
(578, 2020, 'ROHMA INDAH', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '5', '', 15000, 40, 'UNIT', 30000, 10000, 5, 1, 3),
(579, 2020, 'JATI INDAH', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '4', '', 30000, 32, 'UNIT', 21600, 10000, 5, 1, 3),
(580, 2020, 'SALIM MEBEL', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '4', '', 30000, 32, 'UNIT', 4320, 3000, 5, 1, 3),
(581, 2020, 'WINONO MEUBEL', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '4', '', 30000, 32, 'UNIT', 4500, 3000, 5, 1, 3),
(582, 2020, 'Meubel \"MUBESTRI\"', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 20000, 240, 'UNIT', 18750, 3750, 5, 1, 3),
(583, 2020, 'MEUBEL FADILAH', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '', '1', 20000, 240, 'UNIT', 12000, 1500, 5, 1, 3),
(584, 2020, 'MEUBEL DARMA KENCANA', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '4', '', 1000, 18000, 'UNIT', 18750, 3750, 5, 1, 3),
(585, 2020, 'MEUBEL JON', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '5', '', 25000, 24, 'UNIT', 100000, 48000, 5, 1, 3),
(586, 2020, 'PT. ASRA KARYA', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '1', '', 75000, 40, 'UNIT', 50000, 24000, 5, 1, 3),
(587, 2020, 'MEUBEL KOMSANA', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 2500, 24, 'UNIT', 40000, 19200, 5, 1, 3),
(588, 2020, 'MEUBEL TRAY', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '', '1', 25000, 24, 'UNIT', 40000, 19200, 5, 1, 3),
(589, 2020, 'MEUBEL SARTON', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '4', '', 5000, 120, 'UNIT', 40000, 19200, 5, 1, 3),
(590, 2020, 'MEUBEL SULEMAN', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '10', '', 5000, 96, 'UNIT', 18750, 10000, 5, 1, 3),
(591, 2020, 'MEUBEL ALEX', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '3', '', 5000, 72, 'UNIT', 40000, 19200, 5, 1, 3),
(592, 2020, 'HARTO MEUBEL', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 5000, 5000000, 'UNIT', 18750, 10000, 5, 1, 3),
(593, 2020, 'JAYA KARYA MEBEL', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 10000, 8, 'UNIT', 24000, 2000, 5, 1, 3),
(594, 2020, 'MEUBEL SANDI', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 80000, 48, 'UNIT', 72000, 48000, 5, 1, 3),
(595, 2020, 'MERANTI INDAH', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '6', '', 15000, 72, 'UNIT', 3600, 1500, 5, 1, 3),
(596, 2020, 'ZAINUDIN MEUBEL', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 10000, 48, 'UNIT', 30000, 14400, 5, 1, 3),
(597, 2020, 'MEUBEL KOMSANA', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 2500, 24, 'UNIT', 50000, 24000, 5, 1, 3),
(598, 2020, 'MEUBEL TRAY', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '', '1', 25000, 24, 'UNIT', 30000, 14400, 5, 1, 3),
(599, 2020, 'YOFISTA', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '', '1', 15000, 32, 'UNIT', 30000, 14400, 5, 1, 3),
(600, 2020, 'ARMAN MEUBEL', '', '', '', 'WONOSARI', '', 'INDUSTRI PENGGERGAJIAN KAYU', 'SOMEL', 'PO', NULL, '16101', '', '12', '', 5000, 8, 'M3', 10000, 7500, 5, 1, 3),
(601, 2020, 'SAMSUDIN MEUBEL', '', '', '', 'WONOSARI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 80000, 48, 'UNIT', 144000, 10000, 5, 1, 3),
(602, 2020, 'HADILU', '', '', '', 'BOTUMOITO', '', 'BATU BATA', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'PO', NULL, '26322', '', '3', '', 5000, 360000, 'BIJI', 45000, 1000, 5, 1, 3),
(603, 2020, '', '', '', '', 'BOTUMOITO', '', 'BATU BATA', 'INDUSTRI BATU BATA DARI TANAH LIAT', 'PO', NULL, '26322', '', '4', '', 500, 20000, 'BIJI', 5000, 2500, 5, 1, 3),
(604, 2020, 'IND.  BATU BATA', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '1', '', 25000, 240000, 'BIJI', 90000, 1500, 5, 1, 3),
(605, 2020, '', '', '', '', 'BOTUMOITO', '', 'INDUSTRI  PEMBUAT BATAKO', 'BATOKO', 'PO', NULL, '23951', '', '3', '', 3000, 380, 'BIJI', 85000, 50000, 5, 1, 3),
(606, 2020, 'MARANTI  INDAH', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '8', '', 40000, 62, 'BUAH', 90000, 1500, 5, 1, 3),
(607, 2020, 'RISPAN NONU', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '1', '', 20000, 60, 'BUAH', 90000, 1500, 5, 1, 3),
(608, 2020, 'CV. SINAR ALINGKO', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '6', '', 50000, 84, 'BUAH', 25000, 1500, 5, 1, 3),
(609, 2020, 'SAHRUDIN MEUBEL', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '1', '', 20000, 60, 'BUAH', 90000, 2500, 5, 1, 3),
(610, 2020, 'SAPRUDIN MEUBEL', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '3', '', 50000, 84, 'BUAH', 18000, 1500, 5, 1, 3),
(611, 2020, 'DUCE MEUBEL', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 20000, 60, 'BUAH', 90000, 1500, 5, 1, 3),
(612, 2020, 'UD. IDRIK', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '10', '', 25000, 120, 'BUAH', 35000, 1500, 5, 1, 3),
(613, 2020, 'USAHA BARU', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI BARANG BANGUNAN DARI KAYU', 'KUSEN RUMAH', 'PO', NULL, '16221', '', '5', '', 4000, 150, 'BUAH', 50000, 1500, 5, 1, 3),
(614, 2020, 'KARYA MURNI', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI ROTAN DAN ATAU BAMBU', 'KURSI ROTAN', 'PO', NULL, '31002', '', '5', '', 50000, 48, 'SET', 100000, 5000, 5, 1, 3),
(615, 2020, 'AGUS MEBEL', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '3', '', 10000, 60, 'BUAH', 12000, 1500, 5, 1, 3),
(616, 2020, 'FAHRUDIN MEBEL', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '3', '', 10000, 60, 'BUAH', 70000, 20000, 5, 1, 3),
(617, 2020, '', '', '', '', 'BOTUMOITO', '', 'MEUBEL KAYU', 'INDUSTRI FURNITUR DARI KAYU', 'PO', NULL, '36103', '', '4', '', 10000, 60, 'BUAH', 43200, 14400, 5, 1, 3),
(618, 2020, 'JUANDA', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '10', '', 10000, 72, 'UNIT', 56000, 15000, 5, 1, 3),
(619, 2020, 'MEUBEL ', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '2', '', 5000, 120, 'UNIT', 54000, 18000, 5, 1, 3),
(620, 2020, 'KUBE MAJU  BER SAMA', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '8', '2', 20000, 960, 'UNIT', 76000, 10000, 5, 1, 3),
(621, 2020, 'RAMLI MEUBEL', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '1', '', 10000, 36, 'UNIT', 54000, 18000, 5, 1, 3),
(622, 2020, 'IND. MEUBEL KAYU', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '4', '', 10000, 24000, 'UNIT', 76000, 5000, 5, 1, 3),
(623, 2020, 'MEUBEL MOOTILANGO', '', 'TRANS SULAWESI', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '1', '', 10000, 36000, 'UNIT', 54000, 18000, 5, 1, 3),
(624, 2020, 'UD. ARIF', '', '', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '6', '', 20000, 96, 'BUAH', 85000, 36000, 5, 1, 3),
(625, 2020, 'UD. IDRIK', '', '', '', 'BOTUMOITO', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '36101', '', '10', '', 25000, 120, 'BUAH', 50000, 10000, 5, 1, 3),
(626, 2020, 'YERI', '', '', '', 'DULUPI', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATU BATA', 'PO', NULL, '23921', '', '2', '', 5000, 300000, 'BUAH', 8000, 2500, 5, 1, 3),
(627, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI BARANG DARI SEMEN', 'BATAKO', 'PO', NULL, '23951', '', '3', '', 10000, 750, 'BUAH', 25000, 10000, 5, 1, 3),
(628, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI BATU BATA DARI TANAH LIAT/KERAMIK', 'BATAKO', 'PO', NULL, '23921', '', '2', '', 5000, 27000, 'BUAH', 25000, 10000, 5, 1, 3),
(629, 2020, 'MULYADIN MEBEL', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '3', '', 7500, 36, 'BUAH', 60000, 3500, 5, 1, 3),
(630, 2020, 'MARGA  JAYA', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 10000, 48, 'BUAH', 28800, 15000, 5, 1, 3),
(631, 2020, 'TERATAI INDAH', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '1', '', 10000, 48, 'BUAH', 38400, 22000, 5, 1, 3),
(632, 2020, 'ALWIN MEBEL', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '3', '', 15000, 600, 'BUAH', 38400, 15000, 5, 1, 3),
(633, 2020, 'MEUBEL', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '1', '', 1000, 24, 'unit', 60000, 35000, 5, 1, 3),
(634, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 20000, 60, 'BUAH', 36000, 22500, 5, 1, 3),
(635, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '2', '', 20000, 60, 'BUAH', 108000, 75000, 5, 1, 3),
(636, 2020, 'AMU MEBEL', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '4', '', 15000, 600, 'BUAH', 35000, 22000, 5, 1, 3),
(637, 2020, '', '', '', '', 'DULUPI', '', 'INDUSTRI FURNITUR DARI KAYU', 'PROFIL', 'PO', NULL, '31001', '', '4', '', 15000, 600, 'BUAH', 5760, 1500, 5, 1, 3),
(638, 2020, 'MEUBEL GAFAR YASIN', '', 'TRANS SULAWESI', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'MEUBEL KAYU', 'PO', NULL, '31001', '', '1', '', 5000, 3, 'BUAH', 2250, 1500, 5, 1, 3),
(639, 2020, 'MEUBEL YAYAN', '', 'TRANS SULAWESI', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'PERABOT RUMAH TANGGA', 'PO', NULL, '31001', '', '1', '', 5000, 3, 'BUAH', 2250, 1500, 5, 1, 3),
(640, 2020, 'MEUBEL RUSLI', '', 'TRANS SULAWESI', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'PERABOT RUMAH TANGGA', 'PO', NULL, '31001', '', '3', '', 20000, 15, 'BUAH', 2250, 1500, 5, 1, 3),
(641, 2020, 'MEUBEL ARSON', '', '', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'PERABOT RUMAH TANGGA', 'PO', NULL, '31001', '', '2', '', 10000, 6, 'BUAH', 3750, 4000, 5, 1, 3),
(642, 2020, 'MEUBEL CINDRA', '', '', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'PERABOT RUMAH TANGGA', 'PO', NULL, '31001', '', '2', '', 10000, 6, 'BUAH', 3750, 4000, 5, 1, 3),
(643, 2020, 'JAFAR', '', '', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'PERABOT RUMAH TANGGA', 'PO', NULL, '31001', '', '2', '', 10000, 6, 'BUAH', 18750, 12000, 5, 1, 3),
(644, 2020, 'FIRMAN JAYA', '', '', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'PERABOT RUMAH TANGGA', 'PO', NULL, '31001', '', '', '2', 10000, 6, 'BUAH', 3750, 4000, 5, 1, 3),
(645, 2020, 'MEUBUL\'FIRMAN JAYA\"', '', '', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '6', '', 15000, 120, 'UNIT', 7500, 4000, 5, 1, 3),
(646, 2020, 'MEUBEL \"Karim\"', '', '', '', 'PAGUYAMAN PANTAI', '', 'INDUSTRI FURNITUR DARI KAYU', 'LEMARI', 'PO', NULL, '31001', '', '3', '', 10000, 108, 'UNIT', 7500, 4000, 5, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kabkota`
--

CREATE TABLE `kabkota` (
  `id` int(2) NOT NULL,
  `nama_kabkota` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kabkota`
--

INSERT INTO `kabkota` (`id`, `nama_kabkota`) VALUES
(1, 'KOTA GORONTALO'),
(2, 'KABUPATEN GORONTALO'),
(3, 'KABUPATEN BONE BOLANGO'),
(4, 'KABUPATEN BOALEMO'),
(5, 'KABUPATEN POHUWATO'),
(6, 'KABUPATEN GORONTALO UTARA');

-- --------------------------------------------------------

--
-- Table structure for table `kelkec`
--

CREATE TABLE `kelkec` (
  `id` int(4) NOT NULL,
  `nama_kelkec` varchar(100) NOT NULL,
  `parent` varchar(100) NOT NULL,
  `kabkota_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelkec`
--

INSERT INTO `kelkec` (`id`, `nama_kelkec`, `parent`, `kabkota_id`) VALUES
(1, 'KOTA TIMUR', '', 1),
(2, 'KOTA UTARA', '', 1),
(7, 'KOTA SELATAN', '', 1),
(8, 'KOTA BARAT', '', 1),
(9, 'SIPATANA', '', 1),
(10, 'KOTA TENGAH', '', 1),
(11, 'DUMBORAYA', '', 1),
(12, 'DUNGINGI', '', 1),
(13, 'HELEDULAA SELATAN', 'KOTA TIMUR', 1),
(14, 'HELEDULAA UTARA', 'KOTA TIMUR', 1),
(15, 'MOODU', 'KOTA TIMUR', 1),
(16, 'TAMALATE', 'KOTA TIMUR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `email`, `telp`, `pesan`, `created_at`, `status`) VALUES
(1, 'Riski Mahmud', 'riski@gmail.com', '081234567890', 'Haloo', '2022-03-21 12:02:27', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE `pelatihan` (
  `id` int(4) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `tgl_pelaksanaan` date NOT NULL,
  `status` enum('draft','publish','hidden') NOT NULL DEFAULT 'draft',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelatihan`
--

INSERT INTO `pelatihan` (`id`, `title`, `slug`, `body`, `gambar`, `lokasi`, `tgl_pelaksanaan`, `status`, `created_at`) VALUES
(6, 'Pelatihan Desain Grafis', 'pelatihan-desain-grafis', '<div><strong>Pelatihan Desain Grafis </strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat explicabo soluta quisquam dolore ut, reprehenderit provident doloribus odio repudiandae facere ex vero quas, sed laudantium possimus. Totam unde et aliquam impedit perspiciatis assumenda laborum, incidunt dicta ad quasi quam quod iusto aut, mollitia, excepturi tempore quae nihil error! Quos harum nulla maiores deleniti asperiores nobis pariatur sequi omnis dolorem consequuntur! Cupiditate iste, magni et reprehenderit aliquid, dolorem, inventore eos culpa pariatur harum ad atque ut ullam. Vitae autem iure vel animi. Iure exercitationem magnam provident minima optio tenetur expedita repudiandae cumque reiciendis? Nemo libero culpa quia illum debitis, veniam eaque!</div>', '1647183230_3797697b72c9e1c2c3cf.jpg', 'Kota Gorontalo', '2022-03-14', 'draft', '2022-03-13 22:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `siinas`
--

CREATE TABLE `siinas` (
  `id` int(3) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat_kantor` tinytext NOT NULL,
  `alamat_pabrik` tinytext NOT NULL,
  `kode_kbli` varchar(10) NOT NULL,
  `bidang_usaha` varchar(255) NOT NULL,
  `tanggal_registrasi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siinas`
--

INSERT INTO `siinas` (`id`, `nama_perusahaan`, `alamat_kantor`, `alamat_pabrik`, `kode_kbli`, `bidang_usaha`, `tanggal_registrasi`) VALUES
(2, 'PR Bengkel Las Berlian', 'JALAN PASAR KAMIS, POPODU, BULANGO TIMUR, Kabupaten Bone Bolango', 'JALAN PASAR KAMIS, POPODU, BULANGO TIMUR, Kabupaten Bone Bolango', '25920', 'Bengkel Las', '2022-01-20 09:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` char(255) NOT NULL,
  `password` char(255) NOT NULL,
  `nama` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `level` char(20) NOT NULL DEFAULT 'user',
  `kabkota_id` int(2) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`, `status`, `level`, `kabkota_id`, `last_login`) VALUES
(1, 'admin', '$2y$10$5GhjSSNHbAbdA/M/kXsg9.QW91cFMsADHstSEBTzh1S5FkPRHVyaG', 'Administrator', '', '1', 'admin', NULL, '2022-04-01 14:59:00'),
(5, 'riski', '$2y$10$xBalFfnYz/G5gn86dHSkwOUWK3y9BtnpdHxqW4Zh0roYLVgzo9duG', 'Riski Mahmud', 'riski@gm.com', '1', 'user', 1, '2022-04-01 13:40:22');

-- --------------------------------------------------------

--
-- Structure for view `grafik_all`
--
DROP TABLE IF EXISTS `grafik_all`;

CREATE VIEW `grafik_all`  AS SELECT `kabkota`.`id` AS `id`, `kabkota`.`nama_kabkota` AS `nama_kabkota`, `industri`.`id` AS `industri_id`, `industri`.`nama_industri` AS `nama_industri`, sum(`investasi`.`nilai_investasi`) AS `nilai_investasi`, count(`investasi`.`nama_ikm`) AS `unit_usaha`, sum(`investasi`.`tkp`) + sum(`investasi`.`tkl`) AS `tenaga_kerja`, sum(`investasi`.`tkp`) AS `tenaga_kerja_perempuan`, sum(`investasi`.`tkl`) AS `tenaga_kerja_laki`, sum(`investasi`.`jumlah_produksi`) AS `jumlah_produksi`, sum(`investasi`.`nilai_produksi`) AS `nilai_produksi`, sum(`investasi`.`nilai_bbbp`) AS `nilai_bbbp`, `investasi`.`tahun` AS `tahun` FROM ((`investasi` join `kabkota` on(`kabkota`.`id` = `investasi`.`kabkota_id`)) join `industri` on(`industri`.`id` = `investasi`.`industri_id`)) GROUP BY `kabkota`.`id`, `industri`.`id`, `investasi`.`tahun` ;

-- --------------------------------------------------------

--
-- Structure for view `grafik_industri`
--
DROP TABLE IF EXISTS `grafik_industri`;

CREATE VIEW `grafik_industri`  AS SELECT `industri`.`id` AS `id`, `industri`.`nama_industri` AS `nama_industri`, sum(`investasi`.`nilai_investasi`) AS `nilai_investasi`, count(`investasi`.`nama_ikm`) AS `unit_usaha`, sum(`investasi`.`tkp`) + sum(`investasi`.`tkl`) AS `tenaga_kerja`, sum(`investasi`.`tkp`) AS `tenaga_kerja_perempuan`, sum(`investasi`.`tkl`) AS `tenaga_kerja_laki`, sum(`investasi`.`jumlah_produksi`) AS `jumlah_produksi`, sum(`investasi`.`nilai_produksi`) AS `nilai_produksi`, sum(`investasi`.`nilai_bbbp`) AS `nilai_bbbp` FROM (`investasi` join `industri` on(`industri`.`id` = `investasi`.`industri_id`)) GROUP BY `investasi`.`industri_id` ;

-- --------------------------------------------------------

--
-- Structure for view `grafik_industri_tahunan`
--
DROP TABLE IF EXISTS `grafik_industri_tahunan`;

CREATE VIEW `grafik_industri_tahunan`  AS SELECT `industri`.`id` AS `industri_id`, `industri`.`nama_industri` AS `nama_industri`, sum(`investasi`.`nilai_investasi`) AS `nilai_investasi`, count(`investasi`.`nama_ikm`) AS `unit_usaha`, sum(`investasi`.`tkp`) + sum(`investasi`.`tkl`) AS `tenaga_kerja`, sum(`investasi`.`tkp`) AS `tenaga_kerja_perempuan`, sum(`investasi`.`tkl`) AS `tenaga_kerja_laki`, sum(`investasi`.`jumlah_produksi`) AS `jumlah_produksi`, sum(`investasi`.`nilai_produksi`) AS `nilai_produksi`, sum(`investasi`.`nilai_bbbp`) AS `nilai_bbbp`, `investasi`.`tahun` AS `tahun` FROM (`investasi` join `industri` on(`industri`.`id` = `investasi`.`industri_id`)) GROUP BY `investasi`.`industri_id`, `investasi`.`tahun` ;

-- --------------------------------------------------------

--
-- Structure for view `grafik_kabkota`
--
DROP TABLE IF EXISTS `grafik_kabkota`;

CREATE VIEW `grafik_kabkota`  AS SELECT `kabkota`.`id` AS `id`, `kabkota`.`nama_kabkota` AS `nama_kabkota`, sum(`investasi`.`nilai_investasi`) AS `nilai_investasi`, count(`investasi`.`nama_ikm`) AS `unit_usaha`, sum(`investasi`.`tkp`) + sum(`investasi`.`tkl`) AS `tenaga_kerja`, sum(`investasi`.`tkp`) AS `tenaga_kerja_perempuan`, sum(`investasi`.`tkl`) AS `tenaga_kerja_laki`, sum(`investasi`.`jumlah_produksi`) AS `jumlah_produksi`, sum(`investasi`.`nilai_produksi`) AS `nilai_produksi`, sum(`investasi`.`nilai_bbbp`) AS `nilai_bbbp` FROM (`investasi` join `kabkota` on(`kabkota`.`id` = `investasi`.`kabkota_id`)) GROUP BY `kabkota`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `grafik_kabkota_tahunan`
--
DROP TABLE IF EXISTS `grafik_kabkota_tahunan`;

CREATE VIEW `grafik_kabkota_tahunan`  AS SELECT `kabkota`.`id` AS `id`, `kabkota`.`nama_kabkota` AS `nama_kabkota`, sum(`investasi`.`nilai_investasi`) AS `nilai_investasi`, count(`investasi`.`nama_ikm`) AS `unit_usaha`, sum(`investasi`.`tkp`) + sum(`investasi`.`tkl`) AS `tenaga_kerja`, sum(`investasi`.`tkp`) AS `tenaga_kerja_perempuan`, sum(`investasi`.`tkl`) AS `tenaga_kerja_laki`, sum(`investasi`.`jumlah_produksi`) AS `jumlah_produksi`, sum(`investasi`.`nilai_produksi`) AS `nilai_produksi`, sum(`investasi`.`nilai_bbbp`) AS `nilai_bbbp`, `investasi`.`tahun` AS `tahun` FROM (`investasi` join `kabkota` on(`kabkota`.`id` = `investasi`.`kabkota_id`)) GROUP BY `kabkota`.`id`, `investasi`.`tahun` ;

-- --------------------------------------------------------

--
-- Structure for view `grafik_tahunan`
--
DROP TABLE IF EXISTS `grafik_tahunan`;

CREATE VIEW `grafik_tahunan`  AS SELECT sum(`investasi`.`nilai_investasi`) AS `nilai_investasi`, sum(`investasi`.`tkl`) + sum(`investasi`.`tkp`) AS `tenaga_kerja`, sum(`investasi`.`tkp`) AS `tenaga_kerja_perempuan`, sum(`investasi`.`tkl`) AS `tenaga_kerja_laki`, sum(`investasi`.`jumlah_produksi`) AS `jumlah_produksi`, sum(`investasi`.`nilai_produksi`) AS `nilai_produksi`, sum(`investasi`.`nilai_bbbp`) AS `nilai_bbbp`, count(`investasi`.`nama_ikm`) AS `unit_usaha`, `investasi`.`tahun` AS `tahun` FROM `investasi` GROUP BY `investasi`.`tahun` ORDER BY `investasi`.`tahun` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industri`
--
ALTER TABLE `industri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investasi`
--
ALTER TABLE `investasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabkota`
--
ALTER TABLE `kabkota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelkec`
--
ALTER TABLE `kelkec`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siinas`
--
ALTER TABLE `siinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `header`
--
ALTER TABLE `header`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `industri`
--
ALTER TABLE `industri`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `investasi`
--
ALTER TABLE `investasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=647;

--
-- AUTO_INCREMENT for table `kabkota`
--
ALTER TABLE `kabkota`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelkec`
--
ALTER TABLE `kelkec`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `siinas`
--
ALTER TABLE `siinas`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
