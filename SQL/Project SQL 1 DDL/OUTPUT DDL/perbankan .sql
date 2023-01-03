-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Sep 2022 pada 08.31
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perbankan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang_bank`
--

CREATE TABLE `cabang_bank` (
  `kode_cabang` varchar(20) NOT NULL,
  `nama_cabang` varchar(45) NOT NULL,
  `alamat_cabang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cabang_bank`
--

INSERT INTO `cabang_bank` (`kode_cabang`, `nama_cabang`, `alamat_cabang`) VALUES
('BRUB', 'Bank Rut Unit Boyolali', 'jl. Ahmad yani 45'),
('BRUK', 'Bank Rut Unit Klaten', 'jl. Suparman 23'),
('BRUS', 'Bank Rut Unit Surakarta', 'jl. Slamet Riyadi 18'),
('BRUW', 'Bank Rut Unit Wonogiri', 'Jalan A. Yani No.23'),
('BRUY', 'Bank Rut Unit Yogyakarta', 'jl. Anggrek 21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `nama_nasabah` varchar(45) NOT NULL,
  `alamat_nasabah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nama_nasabah`, `alamat_nasabah`) VALUES
(1, 'Sutopo', 'Jl. Jendral Sudirman 12'),
(2, 'Maryati', 'Jl. MT. Haryono 31'),
(3, 'Suparman', 'Jl. Hasanudin 81'),
(4, 'Kartika Padmasari', 'Jl. Manggis 15'),
(5, 'Budi Eko Prayogo', 'Jl. Kantil 30'),
(6, 'Satria Eka Jaya', 'Jl. Slamet Riyadi 45'),
(8, 'Sari Murti', 'Jl. Pangandaran 11'),
(9, 'Canka Lokananta', 'Jl. Tidar 86'),
(10, 'Budi Murtono', 'Jl. Merak 22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nasabah_has_rekening`
--

CREATE TABLE `nasabah_has_rekening` (
  `id_nasabahFK` int(11) NOT NULL,
  `no_rekeningFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nasabah_has_rekening`
--

INSERT INTO `nasabah_has_rekening` (`id_nasabahFK`, `no_rekeningFK`) VALUES
(1, 104),
(2, 103),
(3, 105),
(3, 106),
(4, 101),
(4, 107),
(5, 102),
(5, 107),
(6, 109),
(7, 111),
(8, 112),
(9, 110),
(10, 108),
(10, 113);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `no_rekening` int(11) NOT NULL,
  `kode_cabangFK` varchar(20) DEFAULT NULL,
  `pin` varchar(20) NOT NULL DEFAULT '1234',
  `saldo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`no_rekening`, `kode_cabangFK`, `pin`, `saldo`) VALUES
(101, 'BRUS', '1111', 500000),
(102, 'BRUS', '2222', 350000),
(103, 'BRUS', '3333', 750000),
(104, 'BRUM', '4444', 900000),
(105, 'BRUW', '5555', 200000),
(106, 'BRUS', '6666', 300000),
(107, 'BRUS', '7777', 100000),
(108, 'BRUB', '0000', 500000),
(109, 'BRUS', '9999', 0),
(110, 'BRUY', '1234', 550000),
(111, 'BRUK', '4321', 150000),
(112, 'BRUK', '0123', 300000),
(113, 'BRUY', '8888', 255000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` bigint(20) UNSIGNED NOT NULL,
  `no_rekeningFK` int(11) DEFAULT NULL,
  `id_nasabahFK` int(11) DEFAULT NULL,
  `jenis_transaksi` varchar(20) NOT NULL DEFAULT 'debit',
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `jumlah` int(11) NOT NULL CHECK (`jumlah` >= 20000)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `no_rekeningFK`, `id_nasabahFK`, `jenis_transaksi`, `tanggal`, `jumlah`) VALUES
(1, 105, 3, 'debit', '2009-11-10 00:00:00', 50000),
(2, 103, 2, 'debit', '2009-11-10 00:00:00', 40000),
(3, 101, 4, 'kredit', '2009-11-12 00:00:00', 20000),
(4, 106, 3, 'debit', '2009-11-13 00:00:00', 50000),
(5, 107, 5, 'kredit', '2009-11-13 00:00:00', 30000),
(6, 104, 1, 'kredit', '2009-11-15 00:00:00', 200000),
(7, 110, 9, 'kredit', '2009-11-15 00:00:00', 150000),
(8, 102, 5, 'debit', '2009-11-16 00:00:00', 20000),
(9, 105, 3, 'kredit', '2009-11-18 00:00:00', 50000),
(10, 107, 4, 'debit', '2009-11-19 00:00:00', 100000),
(11, 103, 2, 'debit', '2009-11-19 00:00:00', 100000),
(12, 104, 1, 'debit', '2009-11-19 00:00:00', 50000),
(13, 107, 4, 'kredit', '2009-11-20 00:00:00', 200000),
(14, 105, 3, 'debit', '2009-11-21 00:00:00', 40000),
(15, 104, 1, 'kredit', '2009-11-22 00:00:00', 100000),
(16, 101, 4, 'kredit', '2009-11-22 00:00:00', 20000),
(17, 103, 2, 'debit', '2009-11-22 00:00:00', 50000),
(18, 102, 5, 'debit', '2009-11-25 00:00:00', 50000),
(19, 108, 10, 'debit', '2009-11-26 00:00:00', 100000),
(20, 106, 3, 'kredit', '2009-11-27 00:00:00', 50000),
(21, 103, 2, 'kredit', '2009-11-28 00:00:00', 200000),
(22, 105, 3, 'kredit', '2009-11-28 00:00:00', 100000),
(23, 102, 5, 'debit', '2009-11-30 00:00:00', 20000),
(24, 104, 1, 'debit', '2009-12-01 00:00:00', 50000),
(25, 103, 2, 'debit', '2009-12-02 00:00:00', 40000),
(26, 101, 4, 'debit', '2009-12-04 00:00:00', 50000),
(27, 103, 2, 'kredit', '2009-12-05 00:00:00', 100000),
(28, 102, 5, 'kredit', '2009-12-05 00:00:00', 200000),
(29, 109, 7, 'debit', '2009-12-05 00:00:00', 100000),
(30, 110, 9, 'debit', '2009-12-06 00:00:00', 20000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cabang_bank`
--
ALTER TABLE `cabang_bank`
  ADD PRIMARY KEY (`kode_cabang`),
  ADD UNIQUE KEY `nama_cabang` (`nama_cabang`);

--
-- Indeks untuk tabel `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indeks untuk tabel `nasabah_has_rekening`
--
ALTER TABLE `nasabah_has_rekening`
  ADD PRIMARY KEY (`id_nasabahFK`,`no_rekeningFK`);

--
-- Indeks untuk tabel `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`no_rekening`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
