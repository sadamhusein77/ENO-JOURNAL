-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Feb 2021 pada 15.49
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eno_database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `account_code` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `normal_balance` varchar(1) NOT NULL,
  `balance` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`id_account`, `account_code`, `id_class`, `account_name`, `normal_balance`, `balance`) VALUES
(1, 10000, 1, 'Cash', '1', 5000000),
(2, 11000, 1, 'Cash In Bank', '1', 5000000),
(3, 51000, 7, 'Electrity Expenses', '1', 0),
(4, 71000, 8, 'Income Revenue', '2', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cashin`
--

CREATE TABLE `cashin` (
  `id_cashin` int(11) NOT NULL,
  `no_cashin` varchar(25) NOT NULL,
  `receipt` varchar(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `total_cashin` bigint(13) NOT NULL,
  `post_date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cashin`
--

INSERT INTO `cashin` (`id_cashin`, `no_cashin`, `receipt`, `id_user`, `id_invoice`, `total_cashin`, `post_date`, `description`) VALUES
(7, '1280120210001', 'WIC', 23, 0, 60000, '2021-01-05', 'Jasa Foto Copy 300 lembar @Rp 200 = Rp 60.000\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cashout`
--

CREATE TABLE `cashout` (
  `id_cashout` int(11) NOT NULL,
  `no_cashout` varchar(30) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_document` varchar(50) NOT NULL,
  `total` bigint(13) NOT NULL,
  `post_date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cashout`
--

INSERT INTO `cashout` (`id_cashout`, `no_cashout`, `id_user`, `no_document`, `total`, `post_date`, `description`) VALUES
(6, '2270120210001', 23, '0', 300000, '0000-00-00', 'Pembayaran Listrik Toko');

-- --------------------------------------------------------

--
-- Struktur dari tabel `classaccount`
--

CREATE TABLE `classaccount` (
  `id_class` int(11) NOT NULL,
  `class_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `classaccount`
--

INSERT INTO `classaccount` (`id_class`, `class_name`) VALUES
(1, 'Current Assets'),
(2, 'Fixed Assets'),
(3, 'Equity'),
(4, 'Short Terml Loan'),
(5, 'Long Term Loan'),
(6, 'Accumulated'),
(7, 'Expenses'),
(8, 'Revenue');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_telp` varchar(13) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `post_date` date NOT NULL,
  `customer_npwp` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `customer_name`, `customer_address`, `customer_telp`, `customer_email`, `post_date`, `customer_npwp`) VALUES
(1, 'Kementrian Kelautan dan Perikanan', 'Jl. Medan Merdeka Tim. No.16, RT.7/RW.1, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110', '02147483647', 'kkp@gmail.com', '0000-00-00', 123456789123451),
(4, 'Sadam Husein', 'Jl. Mampangprapatan 18 RT/RW:008/005 No.71', '083879903136', 'sadamhusein77.sh@gmail.com', '0000-00-00', 123456789123456);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_cashin`
--

CREATE TABLE `detil_cashin` (
  `id_di` int(11) NOT NULL,
  `no_cashin` varchar(25) NOT NULL,
  `id_account` int(11) NOT NULL,
  `total` bigint(13) NOT NULL,
  `dc` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detil_cashin`
--

INSERT INTO `detil_cashin` (`id_di`, `no_cashin`, `id_account`, `total`, `dc`) VALUES
(8, '1280120210001', 2, 60000, 'D'),
(9, '1280120210001', 4, 60000, 'C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_cashout`
--

CREATE TABLE `detil_cashout` (
  `id_do` int(11) NOT NULL,
  `no_cashout` varchar(25) NOT NULL,
  `id_account` int(11) NOT NULL,
  `total` bigint(13) NOT NULL,
  `d/c` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detil_cashout`
--

INSERT INTO `detil_cashout` (`id_do`, `no_cashout`, `id_account`, `total`, `d/c`) VALUES
(1, '2270120210001', 3, 300000, 'C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_po`
--

CREATE TABLE `detil_po` (
  `id_dpo` int(11) NOT NULL,
  `no_po` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` bigint(13) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `no_invoice` varchar(30) NOT NULL,
  `total_invoice` bigint(13) NOT NULL,
  `due_date` date NOT NULL,
  `date_invoice` date NOT NULL,
  `date_payment` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detil`
--

CREATE TABLE `order_detil` (
  `id_od` int(11) NOT NULL,
  `no_order` varchar(30) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `date_order` datetime NOT NULL,
  `id_service` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_note`
--

CREATE TABLE `order_note` (
  `id_note` int(11) NOT NULL,
  `no_note` varchar(30) NOT NULL,
  `total` bigint(13) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_service`
--

CREATE TABLE `order_service` (
  `id_order` int(11) NOT NULL,
  `no_order` varchar(30) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `id_note` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_order` datetime NOT NULL,
  `status_order` tinyint(1) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id_po` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `no_po` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `total_po` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_code` varchar(6) NOT NULL,
  `role_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role_code`, `role_name`) VALUES
(1, 'ADM001', 'Administrator'),
(3, 'STF001', 'Staff'),
(4, 'SPV001', 'Supervisor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `price` bigint(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`id_service`, `service_name`, `price`) VALUES
(1, 'Print Warna', 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `gender` int(1) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `last_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `fullname`, `password`, `gender`, `address`, `email`, `foto`, `is_active`, `date_created`, `last_login`) VALUES
(19, 1, 'Sadam Husein', '$2y$10$pQlFX0hI5fwWRTw35KYR8.yeohhc7uD1F31BVTSGBEfvlXY2gnd0K', 1, 'Jl. Mampangprapatan 18 RT/RW:008/005 No. 71 Kel. Durentiga Kec. Pancoran Jakarta Selatan 12760', 'sadamhusein88.sh@gmail.com', 'bitebrands_-_logo_perusahaan_game_populer10.jpg', 1, 1609096273, 1612065183),
(23, 3, 'Husein', '$2y$10$M9dYMtS0Ju2MbMkOPj2pfuVTysTFlq2baEu26uddW3TkN8gKSrBeS', 0, 'Jl. Mampangprapatan 18', 'sadamhusein77.sh@gmail.com', 'drawn-controller-logo-9.jpg', 1, 1611029496, 1612081214),
(24, 3, 'Lucyana Aprianti', '$2y$10$oDz1iYk/sX0BcevVkiGfqOLEeOBi318M5ETMuqo5fdzrOytWFyH4u', 0, '', 'lucyanoaprianti@gmail.com', 'default.jpg', 1, 1611044102, 1611181962);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id_token`, `email`, `token`, `date_created`) VALUES
(1, 'sadamhusein88.sh@gmail.com', 'pOTu39LOooRq4BFrJS4rrTj06/YJjKSFZom/D2VwkFc=', 1609172443);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(11) NOT NULL,
  `vendor_name` varchar(50) NOT NULL,
  `vendor_address` text NOT NULL,
  `vendor_telp` varchar(13) NOT NULL,
  `vendor_email` varchar(50) NOT NULL,
  `post_date` int(11) NOT NULL,
  `vendor_npwp` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `vendor_name`, `vendor_address`, `vendor_telp`, `vendor_email`, `post_date`, `vendor_npwp`) VALUES
(1, 'PT SIDU', 'Jl. Menteng Raya Jakarta Pusat', '083879903136', 'sidu@gmail.com', 0, 12345678912345);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indeks untuk tabel `cashin`
--
ALTER TABLE `cashin`
  ADD PRIMARY KEY (`id_cashin`);

--
-- Indeks untuk tabel `cashout`
--
ALTER TABLE `cashout`
  ADD PRIMARY KEY (`id_cashout`);

--
-- Indeks untuk tabel `classaccount`
--
ALTER TABLE `classaccount`
  ADD PRIMARY KEY (`id_class`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `detil_cashin`
--
ALTER TABLE `detil_cashin`
  ADD PRIMARY KEY (`id_di`);

--
-- Indeks untuk tabel `detil_cashout`
--
ALTER TABLE `detil_cashout`
  ADD PRIMARY KEY (`id_do`);

--
-- Indeks untuk tabel `detil_po`
--
ALTER TABLE `detil_po`
  ADD PRIMARY KEY (`id_dpo`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indeks untuk tabel `order_detil`
--
ALTER TABLE `order_detil`
  ADD PRIMARY KEY (`id_od`);

--
-- Indeks untuk tabel `order_note`
--
ALTER TABLE `order_note`
  ADD PRIMARY KEY (`id_note`);

--
-- Indeks untuk tabel `order_service`
--
ALTER TABLE `order_service`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id_po`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indeks untuk tabel `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `account`
--
ALTER TABLE `account`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `cashin`
--
ALTER TABLE `cashin`
  MODIFY `id_cashin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `cashout`
--
ALTER TABLE `cashout`
  MODIFY `id_cashout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `classaccount`
--
ALTER TABLE `classaccount`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `detil_cashin`
--
ALTER TABLE `detil_cashin`
  MODIFY `id_di` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `detil_cashout`
--
ALTER TABLE `detil_cashout`
  MODIFY `id_do` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detil_po`
--
ALTER TABLE `detil_po`
  MODIFY `id_dpo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_detil`
--
ALTER TABLE `order_detil`
  MODIFY `id_od` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_note`
--
ALTER TABLE `order_note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_service`
--
ALTER TABLE `order_service`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id_po` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
