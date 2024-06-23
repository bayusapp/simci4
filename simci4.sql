-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2024 pada 19.02
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
-- Struktur dari tabel `aslab`
--

CREATE TABLE `aslab` (
  `nim_aslab` char(20) NOT NULL,
  `nama_aslab` varchar(255) DEFAULT NULL,
  `foto_aslab` varchar(255) DEFAULT NULL,
  `kontak_aslab` char(20) DEFAULT NULL,
  `norek_aslab` char(30) DEFAULT NULL,
  `file_ktp` varchar(255) DEFAULT NULL,
  `file_norek` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aslab`
--

INSERT INTO `aslab` (`nim_aslab`, `nama_aslab`, `foto_aslab`, `kontak_aslab`, `norek_aslab`, `file_ktp`, `file_norek`) VALUES
('1101168433', 'Ray Putra Tarigan', NULL, NULL, NULL, NULL, NULL),
('1101168449', 'Al Akbar', NULL, NULL, NULL, NULL, NULL),
('1301168590', 'Muhamad Munawir Amin', NULL, NULL, NULL, NULL, NULL),
('6701140181', 'Laily Dwi Anggaraini', NULL, NULL, NULL, NULL, NULL),
('6701143279', 'Mario Da Silva', NULL, NULL, NULL, NULL, NULL),
('6701144265', 'Bayu Setya Ajie Perdana Putra', NULL, NULL, NULL, NULL, NULL),
('6701151059', 'Dilraj Putra', NULL, NULL, NULL, NULL, NULL),
('6701152190', 'Dhea Khairinnisa', NULL, NULL, NULL, NULL, NULL),
('6701154200', 'Ahmad Adli', NULL, NULL, NULL, NULL, NULL),
('6702140027', 'Irfan Maulana Agung', NULL, NULL, NULL, NULL, NULL),
('6702140110', 'Yuantoro Kamajaya Setyana', NULL, NULL, NULL, NULL, NULL),
('6702141008', 'Abdulloh Salahul Haq', NULL, NULL, NULL, NULL, NULL),
('6702142135', 'Ridwan Abdul Malik', NULL, NULL, NULL, NULL, NULL),
('6702144105', 'Mochammad Isfan Fajar', NULL, NULL, NULL, NULL, NULL),
('6702144114', 'Choerul Umam', NULL, NULL, NULL, NULL, NULL),
('6702150003', 'Ahmad Tara Pratama', NULL, NULL, NULL, NULL, NULL),
('6702154098', 'Raden Sri Dewanto W.P', NULL, NULL, NULL, NULL, NULL),
('6702154108', 'Gilang Arievanda Pratama', NULL, NULL, NULL, NULL, NULL),
('6703144129', 'Zulfa Nur \'Aini', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aslab_list`
--

CREATE TABLE `aslab_list` (
  `id_list_aslab` int(11) NOT NULL,
  `nim_aslab` char(20) DEFAULT NULL,
  `nip_laboran` char(15) DEFAULT NULL,
  `id_lab` int(11) DEFAULT NULL,
  `tahun_ajaran` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `kode_dosen` char(3) NOT NULL,
  `nama_dosen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`kode_dosen`, `nama_dosen`) VALUES
('AAG', 'Anak Agung Gde Agung,  S.T.,  M.M.'),
('AAZ', 'Dr.eng. Alfian Akbar Gozali,    S.T.,    M.T.'),
('ADY', 'Ady Purna Kurniawan, S.T., M.T.'),
('AGD', 'Ir. R Agus Ganda Permana,  M.T.'),
('AGT', 'Agung Widyangga Rethanindita,  M. Kom'),
('AIM', 'Aris Hartaman,  S.T.,  M.T.'),
('AKE', 'Ati Mustikasari,  S.E.,  M.M.'),
('ANR', 'Dr. Asniar,  S.T.,  M.T.'),
('APJ', 'Aprianti Putri Sujana,  ,  S.Kom.,  M.T.'),
('ASL', 'Anang Sularsa,  S.T.,  M.T.'),
('ASW', 'Asti Widayanti,  S.Si.,  M.T.,  M.Ak.'),
('AUC', 'Anranur Uwaisy Marchiningrum,  S.Kom.,  M.T.'),
('AUP', 'Agus Pratondo,  S.T.,  M.T.,  Ph.D'),
('AWE', 'Dr Astri Wulandari,  S.E.,  M.M.'),
('AZD', 'Ahmad Zaky Ramdani,  MT'),
('BBP', 'Bambang Pudjoatmodjo,  S.Si.,  M.T.'),
('BSY', 'Bethani Suryawardani,  S.E.,  M.M.'),
('BYU', 'Dr. Bayu Rima Aditya,  S.T.,  M.T.'),
('CAH', 'Cahyana,  S.T.,  M.Kom.'),
('CSO', 'Cahyo Tri Satrio,  S. ST. M. Eng'),
('DDS', 'Dr. Duddy Soegiarto,  S.T.,  M.T.'),
('DED', 'Dedy Setyawan,  S.T, . M.T'),
('DFP', 'Diananda Fitria Pitari,  S.T.,  MBA.'),
('DGI', 'Dendi Gusnadi,  S.Par.,  MM.Par.'),
('DJP', 'Dr. Donni Junipriansa,  S.Pd.,  S.E.,  S.S.,  M.M.,  QWP'),
('DNN', 'Dwi Andi Nurmantris,  S.T.,  M.T.'),
('DPU', 'Desy Puspa Rahayu,  S.Pd.,  M.T.'),
('DRC', 'Devie Ryana Suchendra,  S.T.,  M.T.'),
('DRW', 'Dr. Dedy Rahman Wijaya,  S.T.,  M.T.'),
('DUM', 'Dadan Nur Ramadan,  S.Pd.,  M.T.'),
('DYD', 'Denny Darlis,  S.Si.,  M.T.'),
('EBI', 'Ema,  S.T.,  M.T.'),
('EGP', 'Erda Guslinar Perdana,  S.T.,  M.T.'),
('EHK', 'Dr. Erna Hikmawati,  S.kom.,  M.Kom.'),
('ELT', 'Elis Hernawati,  S.T.,  M.Kom.'),
('ETK', 'Entik Insanudin,  S.T.,  M.T.'),
('EVN', 'Dr. Ersy Ervina,  S.Sos.,  MM.Par.'),
('EVY', 'Eva Mardiyana,  SPar.,  M.Par'),
('FAU', 'Amir Hasanudin Fauzi,  S.T.,  M.T.'),
('FFH', 'Farid Fadhil Habibi,  S.T.,  M.B.A.'),
('FPO', 'Fery Prasetyanto,  ST,  MT'),
('FQN', 'Furqon Hensan Muttaqien,  S.Kom.,  M.Kom.'),
('FSW', 'Fitri Sukmawati,  S.E., Ak.,  M.M.'),
('FTS', 'Fitri Susanti,  S.T.,  M.T.'),
('FVW', 'Yusfi Ardiansyah,  DBA'),
('GIH', 'Gita Indah Hapsari,  S.T.,  M.T.'),
('GMS', 'Ganjar Mohamad Disastra,  S.H.,  M.M.'),
('GTR', 'Guntur Prabawa Kusuma,  S.T.,  M.T.,  Ph.D.'),
('GVA', 'Giva Andriana Mutiara,  S.T.,  M.T.,  Ph.D'),
('HFD', 'Hafidudin,  S.T.,  M.T.'),
('HMU', 'Hariandi Maulid,  S.T.,  M.Sc.'),
('HNP', 'Hanung Nindito Prasetyo,  S.Si.,  M.T.'),
('HPT', 'Hasanah Putri,  S.T.,  M.T.'),
('HRA', 'Henry Rossi Andrian,  S.T.,  M.T.'),
('HRO', 'Dr. Heru Nugroho,  S.Si.,  M.T.'),
('HTT', 'Hetti Hidayati,  S.Kom.,  M.T.'),
('IDI', 'Prof. Dr. Indrarini Dyah Irawati,  S.T.,  M.T.'),
('IFM', 'Imma Fitria Maharani,  S.Si.,  M.Pd'),
('IKE', 'Marlindia Ike Sari,  S.T.,  M.T.'),
('INE', 'Dr Inne Gartina Husein,  S.Kom.,  M.T.'),
('IRN', 'Irna Yuniar,  S.T., M.A.B.'),
('ISM', 'Dr. Ismail,  S.Si.,  M.T.'),
('IZM', 'Indra Azimi,  S.T.,  M.T.'),
('JUL', 'Setia Juli Irzal Ismail,  S.T.,  M.T.'),
('KJE', 'Kurnia Jaya Eliajar,  ST.,  MT'),
('KST', 'Kastaman,  S.T.,  M.M.'),
('LIY', 'Maulida Mazaya,  S.ST.,  Ph.D.'),
('LNH', 'Fanni Husnul Hanifa,  S.E.,  M.M.'),
('LNI', 'Leni Cahyani,  S.Sos.I.,  M.M.'),
('LSD', 'Lisda Meisaroh,  S.Si.,  M.Si.'),
('MDA', 'Magdalena Karismariyanti,  S.T.,  M.B.A.'),
('MEY', 'Mindit Eriyadi,  M.T.'),
('MFR', 'Mochammad Fahru Rizal,  S.T.,  M.T.'),
('MHI', 'Muhammad Ikhsan Sani,  S.T.,  M.T.'),
('MIA', 'Mia Rosmiati,  S.Si.,  M.T.'),
('MIQ', 'Muhammad Iqbal,  S.T.,  M.T.'),
('MQA', 'Mutia Qana\'a,  S.Psi.,  M.Psi.'),
('NLE', 'Nurlena,  S.ST.Par.,  M.Sc.'),
('NNH', 'Dr. Nina Hendrarini,  S.T.,  M.T.'),
('NPR', 'Fat\'hah Noor Prawita,  S.T.,  M.T.'),
('NSW', 'Dr. Nelsi Wisna,  S.E.,  M.Si.'),
('NVD', 'Nova Daryanti Mutiara,  ST.,  M.M'),
('PRA', 'Pramuko Aji,  S.T.,  M.T.'),
('PRI', 'Periyadi,  S.T.,  M.T.'),
('PRJ', 'Dr Prajna Deshanta Ibnugraha,  S.T.,  M.T.'),
('PRM', 'Ra. Paramita Mayadewi,  S.Kom.,  M.T.'),
('PTI', 'Patrick Adolf Telnoni,  S.T.,  M.T.'),
('PWW', 'Dr. Pikir Wisnu Wijayanto,  S.E.,  S.Pd.Ing.,  M.Hum.'),
('RBD', 'Reza Budiawan,  S.T.,  M.T.'),
('RBK', 'Raswyshnoe Boing Kotjoprayudi,  S.E.,  M.M.'),
('RDL', 'Radial Anwar,  S.Si.,  M.Sc.,  PhD.'),
('RGM', 'Ratna Gema Maulida,  S.ST.Par.,  MM.Par.'),
('RHM', 'Rochmawati,  S.T.,  M.T.'),
('RHN', 'Robbi Hendriyanto,  S.T.,  M.T.'),
('RHY', 'Rini Handayani,  S.T.,  M.T.'),
('RIM', 'Rizza Indah Mega Mandasari,  S.Kom.,  M.T.'),
('RKP', 'Riska Aprilina,  S.T.,  M.Si.'),
('RLD', 'Rikman Aherliwan Rudawan,  M.Kom'),
('RMT', 'Rohmat Tulloh,  S.T.,  M.T.'),
('ROR', 'Rio Korio Utoro,  S.KOM.,  MT'),
('RQY', 'Muhammad Rizqy Alfarisi,  S.ST.,  M.T.'),
('RSW', 'Renny Sukawati,  S.E.,  M.M.'),
('RTQ', 'Riza Taufiq,  S.Sos.,  M.M.Par.'),
('RWJ', 'Rahmadi Wijaya,  S.Si.,  M.T.'),
('RYT', 'Rahmat Hidayat,  S.E.,  M.M.'),
('RYY', 'Rennyta Yusiana,  S.E.,  M.M.'),
('SCA', 'Suci Aulia,  S.T.,  M.T.'),
('SDW', 'Sari Dewi Budiwati,  S.T.,  M.T. Ph.D'),
('SED', 'Dr. Sri Damar Setiawan,  S.T.,  M.M.'),
('SGO', 'Dr. Sugondo Hadiyoso,  S.T.,  M.T'),
('SKS', 'Siska Komala Sari,  S.T.,  M.T.'),
('SRD', 'Sri Widaningsih,  S.Psi.,  M.M.'),
('SSR', 'Simon Siregar,  S.Si.,  M.T.'),
('SWB', 'Dr. Sampurno Wibowo,  S.E.,  M.Si.'),
('SYN', 'Suryatiningsih,  S.T.,  M.T.,  OCA'),
('SZH', 'Dr Siti Zakiah,  S.Par.,  MM.Par.'),
('TAR', 'Tengku Ahmad Riza,  S.T.,  M.T.'),
('TBH', 'Tri Brotoharsono,  S.T.,  M.T.'),
('TFN', 'Toufan Diansyah Tambunan,  S.T.,  M.T.'),
('TFT', 'Tafta Zani,  M.T.'),
('TGN', 'Tedi Gunawan,  S.T.,  M.Kom.'),
('TND', 'Tri Nopiani Damayanti,  S.T.,  M.T.'),
('TPH', 'Tito Pandu Raharjo,  SST. Par.,  MM.Par.'),
('TRF', 'Dr Tora Fahrudin,  S.T.,  M.T.'),
('USA', 'Unang Sunarya,  S.T.,  M.T.,  Ph.D.'),
('VOT', 'Vany Octaviany,  S.Par.,  MM.Par'),
('WDM', 'Wardani Muhamad,  S.T.,  M.T.'),
('WHY', 'Wahyu Hidayat,  S.T.,  M.T.,  OCA'),
('WIU', 'Wawa Wikusna,  S.T.,  M.Kom.'),
('WST', 'Widya Sastika,  S.T.,  M.M.'),
('YHD', 'Yahdi Siradj,  S.T.,  M.T.'),
('YNG', 'Yuningsih,  S.S.,  M.Pd, '),
('YSN', 'Yuli Sun Hariyani,  S.T.,  M.T.,  Ph.D.'),
('YSR', 'Yuyun Siti Rohmah,  S.T.,  M.T.'),
('ZAB', 'Dr. Rizal Akbar,  S.T.,  M.M.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboran`
--

CREATE TABLE `laboran` (
  `nip_laboran` char(15) NOT NULL,
  `nama_laboran` varchar(255) NOT NULL,
  `foto_laboran` varchar(255) DEFAULT NULL,
  `kontak_laboran` char(20) DEFAULT NULL,
  `email_laboran` varchar(255) DEFAULT NULL,
  `posisi_laboran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laboran`
--

INSERT INTO `laboran` (`nip_laboran`, `nama_laboran`, `foto_laboran`, `kontak_laboran`, `email_laboran`, `posisi_laboran`) VALUES
('07820016', 'Rixard George Dillak, S.T., M.M.', NULL, NULL, NULL, 'Laboran D3 Sistem Informasi & Sistem Informasi Akuntansi'),
('12071996', 'Administrator', 'assets/images/administrator.png', '628989817181', 'bayusa@telkomuniversity.ac.id', 'System Administrator'),
('19971347', 'Luthfi Hafiyyan Nabila, S.Kom.', NULL, NULL, NULL, 'Administrasi dan Layanan Umum'),
('20810004', 'Roni Riandi, S.E.', NULL, NULL, NULL, 'Laboran D3 Teknologi Telekomunikasi'),
('20940021', 'Dhiomart Rendita Hadiyanto, A.Md.Par.', NULL, NULL, NULL, 'Laboran D3 Perhotelan'),
('22960042', 'Bayu Setya Ajie Perdana Putra, S.Kom.', 'assets/images/laboran/Bayu-Setya-Ajie-Perdana-Putra-S.Kom.png', '628989817181', 'bayusa@telkomuniversity.ac.id', 'Laboran D3 Rekayasa Perangkat Lunak Aplikasi'),
('22970027', 'Nourman Aditya Agista, A.Md.T.', NULL, NULL, NULL, 'Laboran D4 Teknologi Rekayasa Multimedia'),
('82395190', 'Muhammad Harun Arrasid, S.E.', NULL, NULL, NULL, 'Laboran D3 Manajemen Pemasaran'),
('91680026', 'Leli Lismey, S.Par.', NULL, NULL, NULL, 'Administrasi dan Layanan Umum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id_lab` int(11) NOT NULL,
  `nama_lab` varchar(255) DEFAULT NULL,
  `kode_lab` char(10) DEFAULT NULL,
  `kode_igracias` char(10) DEFAULT NULL,
  `kode_ruang` char(10) DEFAULT NULL,
  `id_lab_kategori` int(11) DEFAULT NULL,
  `id_lab_lokasi` int(11) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laboratorium`
--

INSERT INTO `laboratorium` (`id_lab`, `nama_lab`, `kode_lab`, `kode_igracias`, `kode_ruang`, `id_lab_kategori`, `id_lab_lokasi`, `id_prodi`) VALUES
(1, 'Operating System', 'A3', 'A3', 'IT1.02.25', 1, 2, 2),
(2, 'Interactive Multimedia', 'A4', 'A4', 'IT1.02.27', 1, 2, 8),
(3, 'Program Innovate Develop (PRIDE)', 'A5', 'A5', 'IT1.02.29', 1, 2, 6),
(4, 'Multimedia Technology', 'A6', 'A6', '', 1, 2, 8),
(5, 'Multimedia Design', 'A7', 'A7', 'IT1.02.26', 1, 2, 8),
(7, 'IT Infrastructure and Security', 'B2', 'B2', 'IT1.02.08', 1, 2, 1),
(8, 'Big Data', 'B3', 'B3', 'IT1.02.04', 1, 2, 1),
(9, 'Enterprise Systems', 'B4', 'B4', 'IT1.02.01', 1, 2, 3),
(10, 'Data Analytics', 'B5', 'B5', 'IT1.02.02', 1, 2, 3),
(11, 'Microelectronics', 'C1', 'C1', 'IT1.02.16', 1, 2, 2),
(12, 'Electronics', 'C2', 'C2', 'IR1.02.14', 1, 2, 2),
(13, 'MicroPLC', 'C3', 'C3', 'IT1.02.12', 1, 2, 2),
(14, 'Open Source Programming (OPERA)', 'D1', 'D1', 'IT1.02.09', 1, 2, 6),
(15, 'Comprehension, Programming and Idea (CHROME)', 'D2', 'D2', 'IT1.02.07', 1, 2, 6),
(16, 'Basic Programming and Versatile (BRAVE)', 'D3', 'D3', 'IT1.02.11', 1, 2, 6),
(17, 'Multimedia Applied Game and Education (MAGE)', 'D5', 'D5', 'IT1.02.03', 1, 2, 8),
(18, 'Business Computer', 'D4', 'D4', 'IT1.02.06', 1, 2, 4),
(20, 'Mechanic Workshop', 'G13', 'G13', 'IT1.01.26', 1, 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium_kategori`
--

CREATE TABLE `laboratorium_kategori` (
  `id_lab_kategori` int(11) NOT NULL,
  `kategori_lab` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laboratorium_kategori`
--

INSERT INTO `laboratorium_kategori` (`id_lab_kategori`, `kategori_lab`) VALUES
(1, 'Praktikum'),
(2, 'Riset'),
(3, 'Workshop');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium_lokasi`
--

CREATE TABLE `laboratorium_lokasi` (
  `id_lab_lokasi` int(11) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laboratorium_lokasi`
--

INSERT INTO `laboratorium_lokasi` (`id_lab_lokasi`, `lokasi`) VALUES
(1, 'Lantai 1'),
(2, 'Lantai 2'),
(3, 'Lantai 3'),
(4, 'Lantai 4'),
(5, 'Gedung L');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laboratorium_pic`
--

CREATE TABLE `laboratorium_pic` (
  `id_lab_pic` int(11) NOT NULL,
  `nip_laboran` char(15) DEFAULT NULL,
  `nim_aslab` char(20) DEFAULT NULL,
  `id_ta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode_mk` char(10) NOT NULL,
  `nama_mk` varchar(255) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `matakuliah`
--

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `id_prodi`) VALUES
('VAI1A4', 'Algoritma dan Pemrograman ', 3),
('VAI1B2', 'Dasar Komputer dan Jaringan', 3),
('VAI1C4', 'Prinsip Akuntansi I', 3),
('VAI1F3', 'Desain Antar Muka Pengguna', 3),
('VAI1G3', 'Basis Data Relasional', 3),
('VAI1H4', 'Prinsip Akuntansi II', 3),
('VAI2A3', 'Pemrograman Web', 3),
('VAI2B3', 'Analisis dan Perancangan Sistem Informasi ', 3),
('VAI2C2', 'Bahasa Query Terstruktur', 3),
('VAI2D3', 'Dasar Perpajakan', 3),
('VAI2H3', 'Pemrograman Web Berbasis Framework', 3),
('VAI2I3', 'Perencanaan Sumber Daya Perusahaan ', 3),
('VAI2J3', 'Perpajakan Lanjut', 3),
('VAI3A4', 'Aplikasi Sistem Informasi Akuntansi ', 3),
('VAI3D4', 'Implementasi Perencanaan Sumber Daya Perusahaan', 3),
('VEI1D3', 'Desain dan Teknologi Multimedia', 8),
('VEI1F3', 'Sistem Komputer', 8),
('VEI1G4', 'Algoritma dan Pemrograman', 8),
('VEI1H3', 'Jaringan Komputer', 8),
('VEI1I3', 'Sistem Operasi', 8),
('VEI1J2', 'Visualisasi Dijital 2D', 8),
('VEI1K2', 'Visualisasi Dijital 3D', 8),
('VEI2E3', 'Pemrograman Web Interaktif 1', 8),
('VEI2G4', 'Teknologi Audio Visual', 8),
('VEI2I4', 'Desain Antarmuka & Pengalaman Pengguna', 8),
('VEI3E3', 'Pengujian Aplikasi Multimedia', 8),
('VHI1B3', 'Reservasi Hotel', 7),
('VHI1C2', 'Operasional Penyiapan Public Area Hotel', 7),
('VHI1D3', 'Operasional Restoran I', 7),
('VHI1E3', 'Teknik Pengolahan Makanan Kontinental', 7),
('VHI1H3', 'Registrasi Hotel', 7),
('VHI1I2', 'Operasional Penyiapan Kamar Hotel', 7),
('VHI1J3', 'Operasional Restoran 2', 7),
('VHI1K3', 'Teknik Pengolahan Makanan Oriental', 7),
('VHI1L3', 'Teknik Pengolahan Roti Cepat dan Adonan Beragi', 7),
('VHI2A3', 'Layanan Informasi Hotel', 7),
('VHI2C3', 'Operasional Banquet dan Room Service Hotel', 7),
('VHI2D3', 'Teknik Pengolahan Makanan Tradisional ', 7),
('VHI2E3', 'Teknik Pengolahan Kue-Gateux dan Torte', 7),
('VII1A4', 'Implementasi Algoritma', 6),
('VII1D3', 'Alat Bantu Gambar Digital untuk Antarmuka Aplikasi', 6),
('VII1F4', 'Pemrograman Berbasis Web 1', 6),
('VII1I4', 'Sistem Basis Data 1', 6),
('VII2A4', 'Instalasi Jaringan Komputer', 6),
('VII2B4', 'Pemrograman Berbasis Web 2', 6),
('VII2C4', 'Pemrograman Berorientasi Obyek', 6),
('VII2E4', 'Pemrograman untuk Perangkat Bergerak 1', 6),
('VII2F4', 'Sistem Basis Data 2', 6),
('VII3A4', 'Pemrograman untuk Perangkat Bergerak 2', 6),
('VII3B4', 'Pemrograman Berbasis Sensor', 6),
('VIJ1G4', 'Implementasi Struktur Data', 6),
('VK11K3', 'Basis Data', 2),
('VKI1A3', 'Sistem Komputer', 2),
('VKI1B3', 'Sistem Operasi', 2),
('VKI1C3', 'Elektronika Dasar', 2),
('VKI1D3', 'Rangkaian Elektrik', 2),
('VKI1E4', 'Algoritma dan Pemrograman', 2),
('VKI1G3', 'Sistem Jaringan Komputer', 2),
('VKI1H4', 'Mikroelektronika', 2),
('VKI1I4', 'Sistem Digital', 2),
('VKI1J4', 'Algoritma Pemrograman Lanjut', 2),
('VKI2A3', 'Layanan Jaringan', 2),
('VKI2B3', 'Routing dan Switching', 2),
('VKI2C2', 'Pemrograman Web', 2),
('VKI2D4', 'Interface, Peripheral, dan Komunikasi', 2),
('VKI2E4', 'Sistem Mikrokontroler', 2),
('VKI2F3', 'Administrasi Jaringan', 2),
('VKI2G3', 'Jaringan Lanjut', 2),
('VKI2H3', 'Keamanan Jaringan', 2),
('VKI2I3', 'Sistem Kendali', 2),
('VKI2J4', 'Sistem PLC', 2),
('VPI1A4', 'Manajemen Pemasaran', 4),
('VPI1B3', 'Matematika Bisnis', 4),
('VPI1C3', 'Pengantar Ilmu Ekonomi', 4),
('VPI1F3', 'Manajemen Produk', 4),
('VPI1G3', 'Pemasaran Berbasis Komunitas', 4),
('VPI1H3', 'Pemasaran Jasa', 4),
('VPI1I3', 'Manajemen Keuangan ', 4),
('VPI1J3', 'Statistik Bisnis', 4),
('VPI2A2', 'Praktikum Aplikasi Komputer', 4),
('VPI2B4', 'Manajemen Bisnis', 4),
('VPI2C3', 'Manajemen Ritel', 4),
('VPI2D3', 'E-Commerce', 4),
('VPI2E3', 'Salesmanship', 4),
('VPI2F3', 'Perilaku Konsumen', 4),
('VPI2H3', 'Periklanan dan Promosi Penjualan', 4),
('VPI2I3', 'Pemasaran Digital', 4),
('VPI2J3', 'Komunikasi Bisnis', 4),
('VPI2K3', 'Manajemen Layanan Pelanggan ', 4),
('VPI2L3', 'M.I.C.E', 4),
('VPI3A3', 'Riset Pemasaran', 4),
('VPI3B3', 'Big Data untuk Pemasaran', 4),
('VPI3C3', 'Komunikasi Pemasaran', 4),
('VPI3D3', 'Manajemen Hubungan Pelanggan', 4),
('VPI3E3', 'Perencanaan Pemasaran', 4),
('VPI3F3', 'Manajemen Human Capital', 4),
('VSI1A4', 'Algoritma dan Pemrograman Komputer', 1),
('VSI1I3', 'Arsitektur dan Jaringan Komputer', 1),
('VSI1K3', 'Implementasi User Experience Design', 1),
('VSI1N3', 'Pengolahan Basis Data', 1),
('VSI2A4', 'Implementasi Desain Antarmuka Pengguna', 1),
('VSI2D4', 'Pemrograman Web', 1),
('VSI2J3', 'Dasar Ilmu Data', 1),
('VSI2K4', 'Dasar Pemrograman Perangkat Bergerak', 1),
('VSI3C3', 'Ilmu Data Lanjut', 1),
('VSI3E3', 'Pemrograman Basis Data', 1),
('VSI3F4', 'Pemrograman Perangkat Bergerak Lanjut', 1),
('VTI1C3', 'Rangkaian Listrik', 5),
('VTI1D2', 'Bengkel Pemrograman I', 5),
('VTI1E2', 'Bengkel Mekanikal dan Elektrikal', 5),
('VTI1H3', 'Sistem Digital', 5),
('VTI1I3', 'Elektronika Analog', 5),
('VTI1J2', 'Bengkel Elektronika', 5),
('VTI1K2', 'Bengkel Pemrograman II', 5),
('VTI2B3', 'Sistem Komunikasi', 5),
('VTI2D3', 'Aplikasi Mikrokontroler dan Antarmuka', 5),
('VTI2E3', 'Elektronika Telekomunikasi', 5),
('VTI2I3', 'Teknik Frequensi Tinggi', 5),
('VTI2J2', 'Bengkel Internet of Things', 5),
('VTI2K3', 'Jaringan Telekomunikasi', 5),
('VTI2L3', 'Jaringan Data Broadband', 5),
('VTI2M2', 'Dasar Komunikasi Multimedia', 5),
('VTI3A3', 'Sistem Komunikasi Bergerak', 5),
('VTI3B3', 'Sistem Komunikasi Optik', 5),
('VTI3D3', 'Keamanan Jaringan', 5),
('VTI3E2', 'Cloud Computing', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah_semester`
--

CREATE TABLE `matakuliah_semester` (
  `id_mk_semester` int(11) NOT NULL,
  `kode_mk` char(10) DEFAULT NULL,
  `id_ta` int(11) DEFAULT NULL,
  `kode_dosen` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `nama_prodi` varchar(255) DEFAULT NULL,
  `jenjang_prodi` char(2) DEFAULT NULL,
  `kode_prodi` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`, `jenjang_prodi`, `kode_prodi`) VALUES
(1, 'Sistem Informasi', 'D3', 'SI'),
(2, 'Teknologi Komputer', 'D3', 'TK'),
(3, 'Sistem Informasi Akuntansi', 'D3', 'SIA'),
(4, 'Manajemen Pemasaran', 'D3', 'MP'),
(5, 'Teknologi Telekomunikasi', 'D3', 'TT'),
(6, 'Rekayasa Perangkat Lunak Aplikasi', 'D3', 'RPLA'),
(7, 'Perhotelan', 'D3', 'PH'),
(8, 'Teknologi Rekayasa Multimedia', 'D4', 'TRM'),
(9, 'Sistem Informasi Kota Cerdas', 'D4', 'SIKC');

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

--
-- Dumping data untuk tabel `riwayat_login`
--

INSERT INTO `riwayat_login` (`id_riwayat`, `ip_address`, `browser`, `platform`, `tanggal_login`, `kota`, `provinsi`, `organisasi`, `geolocation`, `username`) VALUES
(1, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-13 17:46:11', 'Bojongsoang, Kec. Bojongsoang, Kabupaten Bandung', 'Jawa Barat', 'Institute of Technology Bandung', '-6.979584,107.63305', 'admin'),
(2, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-13 17:52:53', 'Dayeuhkolot, Bandung Regency, West Java', 'ID', 'Institute of Technology Bandung', '-6.978496,107.633382', 'admin'),
(3, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-13 18:04:39', 'Dayeuhkolot, Bandung Regency, West Java', 'ID', 'Institute of Technology Bandung', '-6.978496,107.633382', 'admin'),
(4, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-13 18:05:11', 'Dayeuhkolot, Bandung Regency, West Java', 'ID', 'Institute of Technology Bandung', '-6.978496,107.633382', 'admin'),
(5, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-13 18:05:55', 'Bojongsoang, Kec. Bojongsoang, Kabupaten Bandung', 'Jawa Barat', 'Institute of Technology Bandung', '-6.979584,107.63305', 'admin'),
(6, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-16 20:01:14', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'Institute of Technology Bandung', '-6.963586,107.635068', 'admin'),
(7, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-16 22:09:30', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'Institute of Technology Bandung', '-6.963592,107.635057', 'admin'),
(8, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-17 11:54:58', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'Institute of Technology Bandung', '-6.963583,107.635082', 'admin'),
(9, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-17 21:19:44', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'Institute of Technology Bandung', '-6.963589,107.635074', 'admin'),
(10, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-18 01:20:06', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'Institute of Technology Bandung', '-6.963589,107.635078', 'admin'),
(11, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-18 10:39:48', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963591,107.635069', 'admin'),
(12, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-18 10:40:45', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963594,107.635058', 'admin'),
(13, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-18 13:39:28', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963592,107.635068', 'admin'),
(14, '114.122.100.20', 'Chrome 124.0.0.0', 'Mac OS X', '2024-06-18 15:54:52', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963592,107.635079', 'admin'),
(15, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-18 22:01:59', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963592,107.635073', 'admin'),
(16, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-19 13:36:30', 'Cipagalo, Kec. Bojongsoang, Kabupaten Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.971329,107.637081', 'admin'),
(17, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-20 09:25:56', 'Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.973203,107.632872', 'admin'),
(18, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-20 11:11:17', 'Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.973197,107.632873', 'admin'),
(19, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-20 11:12:09', 'Bandung', 'West Java', 'BIZNET NETWORKS', '', 'admin'),
(20, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-20 11:14:53', 'Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.973206,107.632873', 'admin'),
(21, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-20 17:16:47', 'Bojongsoang, Kec. Bojongsoang, Kabupaten Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.979584,107.63305', 'admin'),
(22, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-21 09:44:31', 'Gg. Raden Saleh, Citeureup, Kec. Dayeuhkolot', 'Kabupaten Bandung', 'BIZNET NETWORKS', '-6.976201,107.633382', 'admin'),
(23, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-21 16:43:23', 'Bandung', 'West Java', 'BIZNET NETWORKS', '', 'admin'),
(24, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-21 20:51:59', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963589,107.635065', 'admin'),
(25, '114.122.100.20', 'Chrome 126.0.0.0', 'Mac OS X', '2024-06-21 21:54:18', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963589,107.635067', 'admin'),
(26, '114.122.100.20', 'Chrome 126.0.0.0', 'Windows 10', '2024-06-21 22:38:00', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963588,107.635059', 'admin'),
(27, '114.122.100.20', 'Chrome 126.0.0.0', 'Windows 10', '2024-06-21 23:43:33', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.96359,107.635066', 'admin'),
(28, '114.122.100.20', 'Chrome 126.0.0.0', 'Windows 10', '2024-06-22 11:05:42', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.96359,107.635056', 'admin'),
(29, '114.122.100.20', 'Chrome 126.0.0.0', 'Windows 10', '2024-06-22 11:19:53', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963591,107.635083', 'admin'),
(30, '114.122.100.20', 'Chrome 126.0.0.0', 'Windows 10', '2024-06-22 14:36:28', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963601,107.635077', 'admin'),
(31, '114.122.100.20', 'Chrome 126.0.0.0', 'Windows 10', '2024-06-22 23:42:31', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963584,107.635061', 'admin'),
(32, '114.122.100.20', 'Chrome 126.0.0.0', 'Windows 10', '2024-06-23 15:10:42', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963589,107.635065', 'admin'),
(33, '114.122.100.20', 'Chrome 126.0.0.0', 'Windows 10', '2024-06-23 21:34:59', 'Mengger, Kec. Bandung Kidul, Kota Bandung', 'Jawa Barat', 'BIZNET NETWORKS', '-6.963601,107.635065', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_ta` int(11) NOT NULL,
  `tahun_ajaran` char(15) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_ta`, `tahun_ajaran`, `is_active`) VALUES
(1, '2016/2017-1', NULL),
(2, '2016/2017-2', NULL),
(3, '2017/2018-1', NULL),
(4, '2017/2018-2', NULL),
(5, '2018/2019-1', NULL),
(6, '2018/2019-2', NULL),
(7, '2019-2020-1', NULL),
(8, '2019-2020-2', NULL),
(9, '2020/2021-1', NULL),
(10, '2020/2021-2', NULL),
(11, '2021/2022-1', NULL),
(12, '2021/2022-2', NULL),
(13, '2022/2023-1', NULL),
(14, '2022/2023-2', NULL),
(15, '2023/2024-1', NULL),
(16, '2023/2024-2', 1),
(17, '2024/2025-1', NULL),
(18, '2024/2025-2', NULL),
(19, '2025/2026-1', NULL),
(20, '2025/2026-2', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trouble_ticket`
--

CREATE TABLE `trouble_ticket` (
  `id_trouble` int(11) NOT NULL,
  `tanggal_kendala` datetime DEFAULT NULL,
  `kategori_informan` varchar(255) DEFAULT NULL,
  `nama_informan` varchar(255) DEFAULT NULL,
  `no_informan` char(20) DEFAULT NULL,
  `kendala` longtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trouble_ticket_tracking`
--

CREATE TABLE `trouble_ticket_tracking` (
  `id_track` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `kategori_petugas` varchar(255) DEFAULT NULL,
  `nama_petugas` varchar(255) DEFAULT NULL,
  `solusi` longtext DEFAULT NULL,
  `id_trouble` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `jabatan` char(10) DEFAULT NULL,
  `status_akun` int(11) NOT NULL,
  `nip_laboran` char(15) DEFAULT NULL,
  `nim_aslab` char(20) DEFAULT NULL,
  `nim_asprak` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `id_role`, `jabatan`, `status_akun`, `nip_laboran`, `nim_aslab`, `nim_asprak`) VALUES
('admin', '$2y$10$CAETIRuxJH.HRY6fY2.dkOa4iDqG7x8nZ3NQrM3qkKfCQJXTEM.qq', 1, 'Admin', 1, '12071996', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_access_menu`
--

CREATE TABLE `users_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `urutan_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_access_menu`
--

INSERT INTO `users_access_menu` (`id_access_menu`, `id_role`, `id_menu`, `urutan_menu`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 3),
(3, 1, 3, 4),
(4, 1, 4, 5),
(5, 1, 5, 6),
(6, 1, 6, 7),
(7, 1, 7, 8),
(8, 1, 8, 9),
(9, 1, 9, 10),
(10, 1, 10, 2),
(11, 2, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_menu`
--

CREATE TABLE `users_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) DEFAULT NULL,
  `url_menu` varchar(255) DEFAULT NULL,
  `icon_menu` varchar(255) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_menu`
--

INSERT INTO `users_menu` (`id_menu`, `nama_menu`, `url_menu`, `icon_menu`, `is_active`) VALUES
(1, 'Beranda', 'Beranda', 'feather icon-home', 1),
(2, 'Laboratorium', 'Laboratorium', 'feather icon-cast', 1),
(3, 'Praktikum', 'Asprak', 'feather icon-cpu', 1),
(4, 'Asisten Laboratorium', 'Aslab', 'feather icon-users', 0),
(5, 'Jadwal', 'Jadwal', 'feather icon-calendar', 0),
(6, 'Peminjaman', 'Peminjaman', 'feather icon-layers', 1),
(7, 'Trouble Ticket', 'TroubleTicket', 'feather icon-thumbs-down', 1),
(8, 'Pengaturan Aplikasi', 'Pengaturan', 'feather icon-settings', 1),
(9, 'Riwayat Login', 'RiwayatLogin', 'feather icon-clock', 1),
(10, 'Data Master', 'DataMaster', 'feather icon-book', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_menu_sub`
--

CREATE TABLE `users_menu_sub` (
  `id_menu_sub` int(11) NOT NULL,
  `nama_menu` varchar(255) DEFAULT NULL,
  `url_menu` varchar(255) DEFAULT NULL,
  `urutan_menu` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_menu_sub`
--

INSERT INTO `users_menu_sub` (`id_menu_sub`, `nama_menu`, `url_menu`, `urutan_menu`, `is_active`, `id_menu`) VALUES
(1, 'Asisten Praktikum', 'Praktikum/Asprak', 2, 1, 3),
(2, 'Mata Kuliah', 'Praktikum/Matakuliah', 1, 1, 3),
(3, 'BAP', '#', 3, 1, 3),
(4, 'Program Studi', 'DataMaster/ProgramStudi', 1, 1, 10),
(5, 'Laboran', 'DataMaster/Laboran', 4, 1, 10),
(6, 'Dosen', 'DataMaster/Dosen', 2, 1, 10),
(7, 'Mata Kuliah', 'DataMaster/MataKuliah', 3, 1, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id_role`, `nama_role`) VALUES
(1, 'Administrator'),
(2, 'Laboran'),
(3, 'Asisten Laboratorium'),
(4, 'Asisten Praktikum');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aslab`
--
ALTER TABLE `aslab`
  ADD PRIMARY KEY (`nim_aslab`);

--
-- Indeks untuk tabel `aslab_list`
--
ALTER TABLE `aslab_list`
  ADD PRIMARY KEY (`id_list_aslab`),
  ADD KEY `nim_aslab` (`nim_aslab`),
  ADD KEY `nip_laboran` (`nip_laboran`),
  ADD KEY `id_lab` (`id_lab`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`kode_dosen`);

--
-- Indeks untuk tabel `laboran`
--
ALTER TABLE `laboran`
  ADD PRIMARY KEY (`nip_laboran`);

--
-- Indeks untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`id_lab`),
  ADD KEY `id_lab_lokasi` (`id_lab_lokasi`),
  ADD KEY `id_prodi` (`id_prodi`),
  ADD KEY `id_lab_kategori` (`id_lab_kategori`);

--
-- Indeks untuk tabel `laboratorium_kategori`
--
ALTER TABLE `laboratorium_kategori`
  ADD PRIMARY KEY (`id_lab_kategori`);

--
-- Indeks untuk tabel `laboratorium_lokasi`
--
ALTER TABLE `laboratorium_lokasi`
  ADD PRIMARY KEY (`id_lab_lokasi`);

--
-- Indeks untuk tabel `laboratorium_pic`
--
ALTER TABLE `laboratorium_pic`
  ADD PRIMARY KEY (`id_lab_pic`),
  ADD KEY `nip_laboran` (`nip_laboran`),
  ADD KEY `nim_aslab` (`nim_aslab`),
  ADD KEY `id_ta` (`id_ta`);

--
-- Indeks untuk tabel `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indeks untuk tabel `matakuliah_semester`
--
ALTER TABLE `matakuliah_semester`
  ADD PRIMARY KEY (`id_mk_semester`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `riwayat_login`
--
ALTER TABLE `riwayat_login`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indeks untuk tabel `trouble_ticket`
--
ALTER TABLE `trouble_ticket`
  ADD PRIMARY KEY (`id_trouble`);

--
-- Indeks untuk tabel `trouble_ticket_tracking`
--
ALTER TABLE `trouble_ticket_tracking`
  ADD PRIMARY KEY (`id_track`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `nim_aslab` (`nim_aslab`);

--
-- Indeks untuk tabel `users_access_menu`
--
ALTER TABLE `users_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `users_menu`
--
ALTER TABLE `users_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `users_menu_sub`
--
ALTER TABLE `users_menu_sub`
  ADD PRIMARY KEY (`id_menu_sub`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aslab_list`
--
ALTER TABLE `aslab_list`
  MODIFY `id_list_aslab` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id_lab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `laboratorium_kategori`
--
ALTER TABLE `laboratorium_kategori`
  MODIFY `id_lab_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `laboratorium_lokasi`
--
ALTER TABLE `laboratorium_lokasi`
  MODIFY `id_lab_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `laboratorium_pic`
--
ALTER TABLE `laboratorium_pic`
  MODIFY `id_lab_pic` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `matakuliah_semester`
--
ALTER TABLE `matakuliah_semester`
  MODIFY `id_mk_semester` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `riwayat_login`
--
ALTER TABLE `riwayat_login`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `trouble_ticket`
--
ALTER TABLE `trouble_ticket`
  MODIFY `id_trouble` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `trouble_ticket_tracking`
--
ALTER TABLE `trouble_ticket_tracking`
  MODIFY `id_track` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users_access_menu`
--
ALTER TABLE `users_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users_menu`
--
ALTER TABLE `users_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users_menu_sub`
--
ALTER TABLE `users_menu_sub`
  MODIFY `id_menu_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aslab_list`
--
ALTER TABLE `aslab_list`
  ADD CONSTRAINT `aslab_list_ibfk_1` FOREIGN KEY (`nim_aslab`) REFERENCES `aslab` (`nim_aslab`),
  ADD CONSTRAINT `aslab_list_ibfk_2` FOREIGN KEY (`nip_laboran`) REFERENCES `laboran` (`nip_laboran`),
  ADD CONSTRAINT `aslab_list_ibfk_3` FOREIGN KEY (`id_lab`) REFERENCES `laboratorium` (`id_lab`);

--
-- Ketidakleluasaan untuk tabel `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD CONSTRAINT `laboratorium_ibfk_1` FOREIGN KEY (`id_lab_lokasi`) REFERENCES `laboratorium_lokasi` (`id_lab_lokasi`),
  ADD CONSTRAINT `laboratorium_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`),
  ADD CONSTRAINT `laboratorium_ibfk_3` FOREIGN KEY (`id_lab_kategori`) REFERENCES `laboratorium_kategori` (`id_lab_kategori`);

--
-- Ketidakleluasaan untuk tabel `laboratorium_pic`
--
ALTER TABLE `laboratorium_pic`
  ADD CONSTRAINT `laboratorium_pic_ibfk_1` FOREIGN KEY (`nip_laboran`) REFERENCES `laboran` (`nip_laboran`),
  ADD CONSTRAINT `laboratorium_pic_ibfk_2` FOREIGN KEY (`nim_aslab`) REFERENCES `aslab` (`nim_aslab`),
  ADD CONSTRAINT `laboratorium_pic_ibfk_3` FOREIGN KEY (`id_ta`) REFERENCES `tahun_ajaran` (`id_ta`);

--
-- Ketidakleluasaan untuk tabel `riwayat_login`
--
ALTER TABLE `riwayat_login`
  ADD CONSTRAINT `riwayat_login_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id_role`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`nim_aslab`) REFERENCES `aslab` (`nim_aslab`);

--
-- Ketidakleluasaan untuk tabel `users_access_menu`
--
ALTER TABLE `users_access_menu`
  ADD CONSTRAINT `users_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id_role`),
  ADD CONSTRAINT `users_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `users_menu` (`id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
