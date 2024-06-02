-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2024 pada 19.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simci4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon_aslab`
--

CREATE TABLE `calon_aslab` (
  `id_caslab` int(11) NOT NULL,
  `nim_caslab` char(15) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `no_whatsapp` char(20) DEFAULT NULL,
  `prodi` varchar(255) DEFAULT NULL,
  `ipk` char(5) DEFAULT NULL,
  `identitas` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `transkip` varchar(255) DEFAULT NULL,
  `sertifikat` varchar(255) DEFAULT NULL,
  `lab_komp` longtext DEFAULT NULL,
  `lab_teknik` longtext DEFAULT NULL,
  `lab_ph` longtext DEFAULT NULL,
  `pernah_asprak` varchar(255) DEFAULT NULL,
  `motivasi_jadi_aslab` longtext DEFAULT NULL,
  `deskripsi_diri` longtext DEFAULT NULL,
  `pengalaman_organisasi` longtext DEFAULT NULL,
  `screenshoot_ig` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboran`
--

CREATE TABLE `laboran` (
  `nip_laboran` char(15) NOT NULL,
  `nama_laboran` varchar(255) NOT NULL,
  `foto_laboran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laboran`
--

INSERT INTO `laboran` (`nip_laboran`, `nama_laboran`, `foto_laboran`) VALUES
('12345678', 'Administrator', 'assets/images/administrator.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_login`
--

CREATE TABLE `riwayat_login` (
  `id_riwayat` int(11) NOT NULL,
  `ip_address` char(30) DEFAULT NULL,
  `browser` char(50) DEFAULT NULL,
  `platform` char(50) DEFAULT NULL,
  `tanggal_login` datetime DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `organisasi` varchar(255) DEFAULT NULL,
  `geolocation` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_akses` char(10) NOT NULL,
  `jabatan` char(10) DEFAULT NULL,
  `status_akun` int(11) NOT NULL,
  `nip_laboran` char(15) DEFAULT NULL,
  `id_aslab` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `jenis_akses`, `jabatan`, `status_akun`, `nip_laboran`, `id_aslab`) VALUES
('admin', '$2y$10$xBQnTJNheU1keIdYFN2TL.594mhGnxCc6cw4KuEW/ykowV3P3qYfO', 'laboran', 'Admin', 1, '12345678', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `calon_aslab`
--
ALTER TABLE `calon_aslab`
  ADD PRIMARY KEY (`id_caslab`);

--
-- Indeks untuk tabel `laboran`
--
ALTER TABLE `laboran`
  ADD PRIMARY KEY (`nip_laboran`);

--
-- Indeks untuk tabel `riwayat_login`
--
ALTER TABLE `riwayat_login`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `calon_aslab`
--
ALTER TABLE `calon_aslab`
  MODIFY `id_caslab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_login`
--
ALTER TABLE `riwayat_login`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
