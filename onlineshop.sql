-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2022 at 03:49 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `foto_profil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `foto_profil`) VALUES
(15, 'argya', '$2y$10$72bzu82yCz0oUY3k.hMcIeFVKUiHqFGHA.Qap6/83NUymm5h9awsa', 'argya rijal rafi', '_MG_4577.JPG'),
(18, 'rijal', '$2y$10$z93mlhbMm1tTmdXXu/V3n.T9ZdKTQXT7uXS.pW/51QsV0GncZTNEK', 'inrico', '_MG_0090.JPG'),
(19, 'argya rijal', '1234', 'argya rijal rafi', 'ini gambar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chart`
--

CREATE TABLE `chart` (
  `id_chart` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chart`
--

INSERT INTO `chart` (`id_chart`, `id_pelanggan`, `id_produk`, `quantity`) VALUES
(1, 29, 27, 1),
(2, 29, 29, 2);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `alamat_rumah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `id_pelanggan`, `tanggal_pembelian`, `total_pembelian`, `id_ongkir`, `alamat_rumah`) VALUES
(38, 29, '2022-07-30', 200000, 2, 'jl ciwaruga samping komplek mustika residence'),
(39, 30, '2021-01-28', 60000, 1, 'kuningan jawbarat'),
(40, 29, '2021-01-29', 100000, 1, 'desa sindangjaya kec mangunjaya kab pangandaran'),
(41, 31, '2021-01-29', 200000, 2, 'sarijadi desa ciwaruga'),
(42, 30, '2021-01-29', 80000, 1, 'desa sindangjaya');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Cardigan'),
(2, 'baju'),
(5, 'gamis update'),
(6, 'kemeja'),
(12, 'baju abah');

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'MyKey', 0, 0, 0, NULL, 0),
(2, 1, 'zJixXtP64Y', 1, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(250) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(29, 'emans6050@gmail.com', '$2y$10$Le0WN.SWqd3pqYTbni.PHe.rLOaJHxSwia42qmNFRwZHpHjmNLo2.', 'bimo arga ', '0814132112'),
(30, 'abah@gmail.com', '$2y$10$nKp2K/pv0Z5GfOoZgOsKY.CGDH5RTnaA/mZcoIFhv1FWJ8xO64iNu', 'abah', '0813136717'),
(31, 'dani@gmail.com', '$2y$10$5bsfWxtQE.2fRTEXc5oaCubx0aRHLNdkR0HddXt8XQp3pNtTbA85i', 'dani maripola', '081545635'),
(32, 'emans6050@gmail.com', '$2y$10$UoXEDNflmU3UVBAEqXpSTeJtfemDLAJiiGGhteOqJE5R4JjTukdQu', 'argya rjal', '081394728945');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `berat` float NOT NULL,
  `sub_berat` int(11) NOT NULL,
  `sub_harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `nama`, `harga`, `berat`, `sub_berat`, `sub_harga`, `jumlah`) VALUES
(38, 33, 34, 'kerudung muslimah ', 50000, 1, 1, 50000, 1),
(39, 34, 33, 'cardigan kekinian', 70000, 1, 1, 70000, 1),
(40, 35, 27, 'cardigan pria', 50000, 1, 1, 50000, 1),
(41, 36, 27, 'cardigan pria', 50000, 1, 1, 50000, 1),
(42, 37, 28, 'cardigan all gender', 70000, 350, 350, 70000, 1),
(43, 37, 29, 'cardigan merah jambu', 50000, 150, 300, 100000, 2),
(44, 38, 24, 'cardigan coffee', 90000, 250, 250, 90000, 1),
(45, 39, 27, 'cardigan pria', 50000, 300, 300, 50000, 1),
(46, 40, 24, 'cardigan coffee', 90000, 250, 250, 90000, 1),
(47, 41, 24, 'cardigan coffee', 90000, 250, 500, 180000, 2),
(48, 42, 28, 'cardigan all gender', 70000, 350, 350, 70000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` float NOT NULL,
  `foto_produk` varchar(1000) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(27, 2, 'cardigan pria BDAH AH', 55000, 300, 'https://hm-media-prod.s3.amazonaws.com/pub/media/catalog/product/medium/edd641bdc987c5a7627fdbd9c1abdfe2037c9911_xxl-1.jpg', 'cardigan pria yang elegant dan membuat kita terliat fashionable dengan bahan sutra sehingga lembut saat di gunakan ', 21),
(28, 1, 'cardigan all gender', 70000, 350, 'https://image.made-in-china.com/202f0j00hCURWvYMgboP/European-and-American-Autumn-and-Winter-New-V-Neck-Button-Striped-Sweater-Cardigan.jpg', 'cardigan ini cocok untuk pria maupun wanita dengan bahan kain rajutan tangan sehingga terlihat lebih elegant dan nyaman di gunakan dalam cuaca panas atau pun dingin                      ', 0),
(29, 1, 'cardigan merah jambufsdsf', 50000, 150, 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//101/MTA-19182818/no_brand_cardigan-atasan_importlengan_panjang_sweater-fashion_wanita-sweater_wanita_full13_gii1v3x0.jpg', 'cardigan wanita yang lucu dan imut dengan bahan yang lembut mampu membuat anda terlihat lebih feminim       ', 3),
(30, 1, 'cardigan musim dingin UPDATE', 100000, 200, 'https://s4.bukalapak.com/img/9252523702/large/baju_musim_dingin_sale_JAKET_OUTER_CARDIGAN_FASHION_WANITA_K.png', 'cardigan ini cocok untuk musim pancaroba karena memiliki bahan dari kain wol sehingga bisa membuat anda hangat sehangat anda dalam pelukan nya               ', 4),
(31, 1, 'cardigan vanila', 65000, 400, 'https://www.ilovetall.com/media/image/27/ae/f8/ILOVETALL-Damen-Cardigan-offen-extralang-Langgr%C3%B6sse-vanilla-gelb-2621-2.jpg', 'cardigan nyaman dengan warna yang relatif lebih sejuk dan hangat saaat di gunakan         ', 5),
(33, 1, 'cardigan kekinian', 70000, 400, 'https://s1.thcdn.com/productimg/1600/1600/13331780-1024898225049843.jpg', 'cardigan yang sangat cocok untuk wanita yang luar biasa               ', 4),
(34, 0, 'kerudung muslimah update', 50000, 150, 'https://cf.shopee.co.id/file/a327492da9199d66a25c6dff3ccb47e8', 'kerudung segi empat untuk muslimah yang ingin berhijrah dengan corak bunga yang indah                                                                ', 4),
(35, 2, 'kerudung muslimah edan parah', 100000, 119, 'https://s0.bukalapak.com/img/06083920241/large/KHIMAR_TERBARU_JILBAB_MUSLIMAH_KERUDUNG_TRENDY_KHIMAR_ANNISA.jpg', 'kerudung dengan bahan sutra yang lembut dan tidak gatal saat di kenakan                      ', 10),
(36, 2, 'cardiBy.me segi4 for muslimah', 230000, 500, 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//97/MTA-7370196/mystory_mystory_larissa_hijab_muslimah_full04_tvy79ci5.jpg', 'couple muslimah style untuk sahabat atau hadiah kepada adik sangat cocok sekali dengan design yang elegant dan mewah dan bahan yang lembut        ', 9),
(37, 2, 'kerudung muslimah segi empat', 100000, 150, 'https://a.ipricegroup.com/media/Maria/koleksi_hijab_untuk_wanita_muslim.png', 'bahan ringan dan sejuk saat di kenakan dan memiliki tingkan kelembutan yang super sotf sehingga bisa membuat anda betah memakai kerudung ini meskipun di kenakan seharian       ', 11),
(38, 2, 'Kerudung cardiBy.me muslimah Update', 120000, 140, 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//94/MTA-6781261/mydailyhijab_mydailyhijab_segi_4_voal_aisyah_lasercut_hijab_muslimah_full06_ozwtiit7.jpg', 'bahan karet gelang yang istimewa sehingga bisa membuat para pengguna nya dapat ketenangan dan kedaimaian        ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'argya', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`id_chart`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chart`
--
ALTER TABLE `chart`
  MODIFY `id_chart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
