-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2022 at 05:43 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fia`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `idBarang` int(11) NOT NULL,
  `namaBarang` varchar(50) NOT NULL,
  `hargaBeli` int(11) NOT NULL,
  `hargaJual` int(11) NOT NULL,
  `beratBarang` decimal(11,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `statusBarang` int(11) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdBy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`idBarang`, `namaBarang`, `hargaBeli`, `hargaJual`, `beratBarang`, `stok`, `statusBarang`, `createdDate`, `createdBy`) VALUES
(1, 'Handphone - ViVo T1 5G', 2500000, 2900000, '0.90', 100, 1, '2022-08-05 06:03:58', 'Umam'),
(2, 'Handphone - Realme GT Master', 4300000, 4800000, '0.80', 100, 1, '2022-08-05 06:06:53', 'Umam'),
(3, 'Case Vivo T1 5G - Merah', 1000, 5000, '0.10', 123, 1, '2022-08-05 06:08:10', 'Umam'),
(4, 'Case Vivo T1 5G - Biru', 1000, 5000, '0.10', 123, 1, '2022-08-05 06:09:03', 'Umam'),
(5, 'Case Realme GT Master - Hitam', 2000, 8000, '0.15', 123, 1, '2022-08-05 06:10:27', 'Umam');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurir`
--

CREATE TABLE `tb_kurir` (
  `idKurir` int(11) NOT NULL,
  `namaKurir` varchar(50) NOT NULL,
  `ongkosKirim` int(11) NOT NULL,
  `estimasi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kurir`
--

INSERT INTO `tb_kurir` (`idKurir`, `namaKurir`, `ongkosKirim`, `estimasi`) VALUES
(1, 'Choir Express', 8000, '1-2 Hari'),
(2, 'JNE\n', 9000, '1-3 Hari'),
(3, 'J&T', 9000, '1-3 Hari'),
(4, 'Si Cepat', 10000, '1-4 Hari'),
(5, 'Tiki', 11000, '2-3 Hari');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `idOrder` int(11) NOT NULL,
  `idBarang` int(11) NOT NULL,
  `idKurir` int(11) NOT NULL,
  `jumlahBeli` int(11) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `alamatPenerima` text NOT NULL,
  `noHpPenerima` varchar(15) NOT NULL,
  `totalBerat` int(11) NOT NULL,
  `totalHarga` decimal(11,2) NOT NULL,
  `createdDate` datetime NOT NULL,
  `createdBy` int(11) NOT NULL,
  `transferDate` datetime NOT NULL,
  `transferBy` int(11) NOT NULL,
  `confirmationDate` datetime NOT NULL,
  `confirmationBy` int(11) NOT NULL,
  `sendDate` datetime NOT NULL,
  `sendBy` int(11) NOT NULL,
  `finishDate` datetime NOT NULL,
  `finishBy` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `buktiTransfer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`idOrder`, `idBarang`, `idKurir`, `jumlahBeli`, `penerima`, `alamatPenerima`, `noHpPenerima`, `totalBerat`, `totalHarga`, `createdDate`, `createdBy`, `transferDate`, `transferBy`, `confirmationDate`, `confirmationBy`, `sendDate`, `sendBy`, `finishDate`, `finishBy`, `status`, `buktiTransfer`) VALUES
(1, 4, 1, 2, 'chaerul umam', 'Cipayung, Munjul', '089605428173', 0, '4808000.00', '2022-08-12 07:09:53', 1, '2022-08-12 08:42:57', 1, '2022-08-12 09:42:33', 2, '2022-08-12 10:13:19', 2, '2022-08-12 10:22:37', 'Saudara Umam', 'SUDAH DITERIMA', '1660268577989.png'),
(2, 3, 2, 5, 'chaerul umam', 'Cipayung, Munjul', '089605428173', 2, '5811000.00', '2022-08-12 10:04:13', 1, '2022-08-12 10:06:35', 1, '2022-08-12 10:06:48', 2, '2022-08-12 10:07:03', 2, '2022-08-12 10:07:16', 'Umam', 'SUDAH DITERIMA', '1660273595665.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses` varchar(15) NOT NULL,
  `createdDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `email`, `password`, `akses`, `createdDate`) VALUES
(1, 'user', 'user@user.com', '$2y$10$7pjMEffyzmMxfFNBT0l58uWs5gRgkot5EOxXxkY5ZEwe.wOjRUWvu', 'user', 0),
(2, 'admin', 'admin@admin.com', '$2y$10$7pjMEffyzmMxfFNBT0l58uWs5gRgkot5EOxXxkY5ZEwe.wOjRUWvu', 'admin', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`idBarang`);

--
-- Indexes for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  ADD PRIMARY KEY (`idKurir`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`idOrder`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `idBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  MODIFY `idKurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `idOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
