-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2020 at 07:27 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dblabkessampel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(5) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `role`, `telepon`, `foto`) VALUES
(1, 'admin', 'admin', 'admin', 1, '08123456789', NULL),
(2, 'Agus', 'agus', '12345', 2, '44444', NULL),
(3, 'Elly', 'elly', '54321', 3, '454545', NULL),
(4, 'Yuli Purnomo', 'yulip', '12345678', 1, '34543535', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bayar_klinik`
--

CREATE TABLE `bayar_klinik` (
  `id_bayar` int(10) NOT NULL,
  `id_kunjungan` varchar(20) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayar_klinik`
--

INSERT INTO `bayar_klinik` (`id_bayar`, `id_kunjungan`, `tgl_bayar`, `total_bayar`) VALUES
(1, '1', '2020-06-26', 293500),
(2, '2', '2020-06-26', 248500),
(3, '3', '2020-07-11', 295000);

-- --------------------------------------------------------

--
-- Table structure for table `dokinvestasi`
--

CREATE TABLE `dokinvestasi` (
  `id` int(11) NOT NULL,
  `no_register` varchar(50) NOT NULL,
  `kode_ppu` varchar(50) NOT NULL,
  `kode_fasilitas` varchar(50) NOT NULL,
  `tanggal_pencairan` date NOT NULL,
  `plafond` double NOT NULL,
  `no_perjanjian` varchar(50) NOT NULL,
  `tanggal_perjanjian` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_modified` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Belum Selesai','Telah Selesai') NOT NULL DEFAULT 'Belum Selesai'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `dokinvestasi`
--

INSERT INTO `dokinvestasi` (`id`, `no_register`, `kode_ppu`, `kode_fasilitas`, `tanggal_pencairan`, `plafond`, `no_perjanjian`, `tanggal_perjanjian`, `created_at`, `last_modified`, `status`) VALUES
(1, 'REG00001', 'PPU001', 'FAS001', '2019-03-25', 10000000, '000/111/222', '2019-02-25', '2019-02-25 10:20:21', '2019-02-25 10:20:21', 'Belum Selesai'),
(2, 'REG00002', 'PPU002', 'FAS001', '2019-01-25', 7500000, '123/II/1000', '2019-03-25', '2019-02-25 11:36:52', '2019-02-25 11:36:52', 'Belum Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `dokjaminan`
--

CREATE TABLE `dokjaminan` (
  `id` int(11) NOT NULL,
  `no_register` varchar(50) NOT NULL,
  `kode_jaminan` varchar(100) NOT NULL,
  `nama_jaminan` varchar(100) NOT NULL,
  `jenis_jaminan` int(11) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `nilai_pasar` double NOT NULL,
  `nilai_likuidasi` double NOT NULL,
  `status` enum('Tersedia','Dipinjam','Keluar') NOT NULL DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `dokjaminan`
--

INSERT INTO `dokjaminan` (`id`, `no_register`, `kode_jaminan`, `nama_jaminan`, `jenis_jaminan`, `keterangan`, `nilai_pasar`, `nilai_likuidasi`, `status`) VALUES
(1, 'REG00001', 'JAM00001', 'Motor XXX', 1, 'Motor Mulus', 10000000, 9000000, 'Tersedia'),
(2, 'REG00002', 'JAM00002', 'Laptop Acer', 4, 'Laptop Acer Swift 3', 8500000, 7000000, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `faktur_laborat`
--

CREATE TABLE `faktur_laborat` (
  `id` int(11) NOT NULL,
  `norm` varchar(25) NOT NULL,
  `noktp` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `umur` int(5) DEFAULT NULL,
  `status_marital` varchar(20) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `pekerjaan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `fileinvestasi`
--

CREATE TABLE `fileinvestasi` (
  `id` int(11) NOT NULL,
  `no_register` varchar(50) NOT NULL,
  `jenis_dokumen` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `fileinvestasi`
--

INSERT INTO `fileinvestasi` (`id`, `no_register`, `jenis_dokumen`, `filename`) VALUES
(1, 'REG00001', 3, 'BeritaAcaraRekon.pdf'),
(2, 'REG00001', 2, 'BeritaAcaraRekon_Edit.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `filejaminan`
--

CREATE TABLE `filejaminan` (
  `id` int(11) NOT NULL,
  `kode_jaminan` varchar(100) NOT NULL,
  `jenis_dokumen` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `filejaminan`
--

INSERT INTO `filejaminan` (`id`, `kode_jaminan`, `jenis_dokumen`, `filename`) VALUES
(1, 'JAM00002', 3, '5678-13780-1-SM.pdf'),
(2, 'JAM00002', 2, 'doc.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_klinik`
--

CREATE TABLE `hasil_klinik` (
  `id_hasilklinik` int(10) NOT NULL,
  `id_kunjungan` varchar(20) NOT NULL,
  `no_rm` varchar(25) NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `nilai_normal` varchar(25) DEFAULT NULL,
  `hasil_pemeriksaan` varchar(20) NOT NULL,
  `keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_klinik`
--

INSERT INTO `hasil_klinik` (`id_hasilklinik`, `id_kunjungan`, `no_rm`, `kode_produk`, `nilai_normal`, `hasil_pemeriksaan`, `keterangan`) VALUES
(1, '1', 'RM00006', 'PD0005', '500-900 MLGR', '750', 'good'),
(2, '1', 'RM00006', 'PD0007', '150-200 mgr ', '180', 'baik'),
(3, '1', 'RM00006', 'PD0008', '100-150 mgr', '200', 'tinggi');

-- --------------------------------------------------------

--
-- Table structure for table `jenisdokinvestasi`
--

CREATE TABLE `jenisdokinvestasi` (
  `id` int(11) NOT NULL,
  `jenis_dokumen` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `jenisdokinvestasi`
--

INSERT INTO `jenisdokinvestasi` (`id`, `jenis_dokumen`, `status`) VALUES
(1, 'Dokumen Investasi', 1),
(2, 'Identitas PPU', 1),
(3, 'Dokumen Profil Usaha', 1),
(4, 'Dokumen Legal', 1),
(5, 'Dokumen Perizinan Usaha', 1),
(6, 'Surat - Menyurat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenisdokjaminan`
--

CREATE TABLE `jenisdokjaminan` (
  `id` int(11) NOT NULL,
  `jenis_dokumen` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `jenisdokjaminan`
--

INSERT INTO `jenisdokjaminan` (`id`, `jenis_dokumen`, `status`) VALUES
(1, 'Jenis Jaminan', 1),
(2, 'Dokumen Pendukung', 1),
(3, 'Laporan Hasil Penilaian', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenisfasilitas`
--

CREATE TABLE `jenisfasilitas` (
  `id` int(11) NOT NULL,
  `kode_fasilitas` varchar(50) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jenisjaminan`
--

CREATE TABLE `jenisjaminan` (
  `id` int(11) NOT NULL,
  `jenis_jaminan` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `jenisjaminan`
--

INSERT INTO `jenisjaminan` (`id`, `jenis_jaminan`, `status`) VALUES
(1, 'Tanah HM', 1),
(2, 'Mobil', 1),
(3, 'Motor', 1),
(4, 'Laptop', 1),
(5, 'Mesin Cuci', 1);

-- --------------------------------------------------------

--
-- Table structure for table `katagori_tarif`
--

CREATE TABLE `katagori_tarif` (
  `id` int(5) NOT NULL,
  `id_parent` varchar(10) DEFAULT NULL,
  `kode_katagori` varchar(10) NOT NULL,
  `nama_katagori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `katagori_tarif`
--

INSERT INTO `katagori_tarif` (`id`, `id_parent`, `kode_katagori`, `nama_katagori`) VALUES
(1, '', 'KT001', 'LOKET ADMINISTRASI '),
(2, NULL, 'KT002', 'PEMERIKSAAN LABORATORIUM KLINIK'),
(3, NULL, 'KT003', 'PEMERIKSAAN KUALITAS LINGKUNGAN'),
(4, NULL, 'KT004', 'PEMERIKSAAN MAKANAN DAN MINUMAN'),
(6, 'KT002', 'C1001', 'HEMATOLOGI RUTIN  '),
(7, 'KT002', 'C1002', 'TEST HEMOSTATIS'),
(9, 'KT002', 'C1003', 'PEMERIKSAAN ANEMIA'),
(10, 'KT002', 'C1004', 'PEMERIKSAAN GOLONGAN DARAH'),
(11, 'KT002', 'C1005', 'SKRINING FEBIS'),
(12, 'KT002', 'C1006', 'PEMERIKSAAN HATI SEDERHANA'),
(13, 'KT002', 'C1007', 'PEMERIKSAAN HATI LANJUTAN'),
(15, 'KT001', 'PD00099', 'COBA PROGRAM BOSS'),
(16, '', 'KT0909', 'TEST BROOOOO'),
(17, 'C1002', 'KT09091', 'COBA TEST  TANGGAL 16-10-2019');

-- --------------------------------------------------------

--
-- Table structure for table `komponen_tarif`
--

CREATE TABLE `komponen_tarif` (
  `id` int(5) NOT NULL,
  `kode_produk` varchar(10) DEFAULT NULL,
  `totalharga` int(20) NOT NULL,
  `sim` int(10) DEFAULT NULL,
  `bhp` int(10) DEFAULT NULL,
  `js` int(10) DEFAULT NULL,
  `jp` int(10) DEFAULT NULL,
  `lainya` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `komponen_tarif`
--

INSERT INTO `komponen_tarif` (`id`, `kode_produk`, `totalharga`, `sim`, `bhp`, `js`, `jp`, `lainya`) VALUES
(1, 'PD0002', 3500, 50000, 0, 100088, 200099, 0),
(2, 'PD0004', 60000, 10000, 0, 20000, 30000, 0),
(3, 'BH0009', 5000, 0, 0, 2000, 3000, 0),
(4, 'PD0007', 45000, 0, 5000, 10000, 20000, 10000),
(5, 'PD0005', 125000, 0, 25000, 30000, 70000, 0),
(6, 'PD0008', 60000, 0, 10000, 10000, 30000, 10000),
(7, 'PD0001', 5000, 0, 0, 2000, 3000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan_klinik`
--

CREATE TABLE `kunjungan_klinik` (
  `id` int(11) NOT NULL,
  `tgl_kunjungan` date NOT NULL,
  `no_rm` varchar(25) NOT NULL,
  `no_kunjungan` varchar(25) NOT NULL,
  `pasien_lama` tinyint(1) NOT NULL,
  `bayar` varchar(1) DEFAULT NULL,
  `batal` varchar(1) DEFAULT NULL,
  `print` int(1) DEFAULT NULL,
  `print_ulang` int(1) DEFAULT NULL,
  `verifikasi` int(1) DEFAULT NULL,
  `entry` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kunjungan_klinik`
--

INSERT INTO `kunjungan_klinik` (`id`, `tgl_kunjungan`, `no_rm`, `no_kunjungan`, `pasien_lama`, `bayar`, `batal`, `print`, `print_ulang`, `verifikasi`, `entry`) VALUES
(1, '2020-06-26', 'RM00006', '000001', 1, '1', NULL, NULL, NULL, NULL, 1),
(2, '2020-06-26', 'RM00001', '000001', 1, '1', NULL, NULL, NULL, NULL, NULL),
(3, '2020-07-11', 'RM-0000099', '000001', 0, '1', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kunjungan_laborat`
--

CREATE TABLE `kunjungan_laborat` (
  `id` int(11) NOT NULL,
  `tgl_kunjungan` datetime NOT NULL,
  `id_kunjungan` varchar(25) NOT NULL,
  `noreg` varchar(25) NOT NULL,
  `pasien_lama` tinyint(1) NOT NULL,
  `sampel` int(1) NOT NULL,
  `bayar` varchar(15) NOT NULL,
  `batal` varchar(15) NOT NULL,
  `entry` int(1) NOT NULL,
  `verifikasi` int(1) NOT NULL,
  `print` int(1) NOT NULL,
  `print_ulang` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `id_role`, `id_modul`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 8),
(7, 1, 6),
(8, 1, 7),
(9, 1, 9),
(10, 2, 1),
(11, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `metode`
--

CREATE TABLE `metode` (
  `id` int(5) NOT NULL,
  `kode_metode` varchar(20) NOT NULL,
  `nama_metode` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `metode`
--

INSERT INTO `metode` (`id`, `kode_metode`, `nama_metode`, `keterangan`, `status`) VALUES
(1, 'MTD001', 'OMEGATAMA JOSS', 'CV. Orbit Megah Pratama JOSS', 'AKTIF JOSS'),
(2, 'MTD002', 'CV KAPISAN ', 'CV. KARYA PRATAMA INSANI', 'AKTIF'),
(3, 'MTD003', 'CEK DARAH', 'CV. Orbit Megah Pratama', 'AKTIF'),
(4, 'MTD004', 'MENGGUNAKAN JARING', 'CARA MENANGKAP IKAN', 'AKTIF'),
(5, 'MTD005', 'METODE NATURAL', 'TEST TEST TEST', 'AKTIF'),
(6, 'MTD006', 'METODE KIMIA', 'TEST TEST TEST', 'AKTIF'),
(7, 'MTD007', 'METODE BIO ', 'TEST TEST TEST', 'AKTIF'),
(8, 'MTD008', 'METODE TOMSON', 'TEST TEST TEST', 'AKTIF'),
(9, 'MTD009', 'METODE HARRY JONSON', 'TEST TEST TEST', 'AKTIF'),
(10, 'MTD010', 'METODE OMEGATAMA 1', 'TEST TEST TEST', 'AKTIF'),
(11, 'MTD012', 'METODE OMEGATAMA 2', 'TEST TEST TEST', 'AKTIF'),
(12, 'MTD011', 'METODE OMEGATAMA 3', 'TEST TEST TEST', 'AKTIF'),
(13, 'MTD013', 'Metode Elektrikal', 'UJI COBA BRO', 'AKTIF'),
(14, 'MTD0098', 'METODE ALAMI DAN NATURAL SEKALI', 'UJI COBA BRO', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `isparent` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `nama`, `url`, `icon`, `isparent`) VALUES
(1, 'Home', 'index.php', 'mdi mdi-home', 0),
(2, 'Master Data', '#', 'mdi mdi-file-document', 1),
(3, 'Pelayanan Klinik', '#', 'mdi mdi-email', 1),
(4, 'Pelayanan Laborat', '#', 'mdi mdi-sync', 1),
(5, 'Kassa Klinik', 'kassa.php', 'mdi mdi-bookmark-check', 0),
(6, 'Pengaturan', '#', 'mdi mdi-settings', 1),
(7, 'Logout', 'logout.php', 'mdi mdi-logout-variant', 0),
(8, 'Laporan', '#', 'mdi mdi-archive', 1),
(9, 'Laporan', '#', 'mdi mdi-archive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilainormal`
--

CREATE TABLE `nilainormal` (
  `id` int(5) NOT NULL,
  `kode_nrujukan` varchar(10) DEFAULT NULL,
  `produktarif` varchar(50) DEFAULT 'NULL',
  `nilairujukan` varchar(50) NOT NULL,
  `satuan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `nilainormal`
--

INSERT INTO `nilainormal` (`id`, `kode_nrujukan`, `produktarif`, `nilairujukan`, `satuan`) VALUES
(1, 'PD0001', '0', '5000', '0'),
(2, 'PD0002', '0', '2500', '0'),
(3, 'PD0012', '5000', '65000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pasienklinik`
--

CREATE TABLE `pasienklinik` (
  `id` int(11) NOT NULL,
  `tgl_pendaftaran` datetime NOT NULL,
  `norm` varchar(25) NOT NULL,
  `identitas` varchar(10) NOT NULL,
  `no_identitas` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `umur` int(5) DEFAULT NULL,
  `status_marital` varchar(20) NOT NULL,
  `pendidikan` varchar(20) NOT NULL,
  `pekerjaan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pasienklinik`
--

INSERT INTO `pasienklinik` (`id`, `tgl_pendaftaran`, `norm`, `identitas`, `no_identitas`, `nama`, `alamat`, `telpon`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tgl_lahir`, `umur`, `status_marital`, `pendidikan`, `pekerjaan`) VALUES
(1, '2020-05-19 12:51:58', 'RM00001', 'KTP', '231331313133313', 'ARJUNA WIWAHA KUTSA', 'JL. MAJAPAHIT NO. 222 SEMARANG', '0817384913', 'Laki-laki', 'Islam', 'Kudus', '1975-02-01', 0, 'Kawin', 'Sarjana S1', 'Apoteker'),
(2, '2020-05-19 14:27:30', 'RM-00002', 'KTP', '12313131313', 'BIMA ONTO WIJOYO', 'JL. DIPONEGORONO. 125', '0815432435', 'Laki-laki', 'Islam', 'Semarang', '1980-08-26', 0, 'Kawin', 'Sarjana S1', 'Perawat'),
(3, '2020-05-19 14:45:16', 'RM00003', 'KTP', 'P8876543PSS', 'YUDISTIRA', 'JL. Diponegoro No. 125, Ungaran', '0815432435', 'Laki-laki', 'Islam', 'Demak', '1970-01-12', 0, 'Kawin', 'S3', 'Dokter'),
(4, '2020-05-20 09:40:10', 'RM00004', 'KTP', '2121333333333', 'SEMAR KUNCUNG PUTIH', 'JL. ATAS ANGIN NO. 1, JONGRING SALOKO', '0817384913', 'Laki-laki', 'Islam', 'Pajajaran', '1980-11-12', 0, 'Kawin', 'Sarjana S1', 'Wiraswasta'),
(5, '2020-05-20 10:04:15', 'RM00005', 'KTP', '09898798761111', 'BATORO KRESNO', 'JL. Diponegoro No. 125, Ungaran', '08187655432', 'Laki-laki', 'Islam', 'Semarang', '1987-05-20', 0, 'Kawin', 'Sarjana S1', 'Petani'),
(6, '2020-05-20 13:05:57', 'RM00006', 'KTP', '000980000', 'SRIKANDI ', 'JL. KAKP II NO. 1 SEBANTENGAN, UNGARAN', '0817384913', 'Perempuan', 'Islam', 'ARAB', '1981-01-01', 0, 'Kawin', 'Sarjana S1', 'Guru/Dosen'),
(7, '2020-07-11 12:57:01', 'RM-0000099', 'KTP', '1918171615', 'SRINTIL KONTAL KANTIL', 'Semarang , Jl. Duren sawit no. 330', '08187655432 111', 'Perempuan', 'Islam', 'ARAB', '1970-07-11', 0, 'Kawin', 'Deploma D3', 'Pedagang');

-- --------------------------------------------------------

--
-- Table structure for table `pasienlaborat`
--

CREATE TABLE `pasienlaborat` (
  `id` int(11) NOT NULL,
  `tglreg` datetime NOT NULL,
  `kelcus` varchar(25) NOT NULL,
  `noreg` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pasienlaborat`
--

INSERT INTO `pasienlaborat` (`id`, `tglreg`, `kelcus`, `noreg`, `nama`, `alamat`, `telpon`, `email`) VALUES
(1, '2020-03-10 15:39:44', '1', '00001', 'PUSKESMAS LEYANGAN', 'JL. DIPONEGORONO. 125', '0815432435', 'user@user.com'),
(2, '2020-03-10 16:24:28', '3', '00002', 'RONNY', 'JL. DIPONEGORONO. 125', '0817384913333', 'user@user.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaranjaminan`
--

CREATE TABLE `pengeluaranjaminan` (
  `id` int(11) NOT NULL,
  `no_register` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pengeluaranjaminan`
--

INSERT INTO `pengeluaranjaminan` (`id`, `no_register`, `waktu`) VALUES
(1, 'REG00002', '2019-03-02 16:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `pinjamandokumen`
--

CREATE TABLE `pinjamandokumen` (
  `id` int(11) NOT NULL,
  `jenis_dokumen` enum('Dokumen Investasi','Dokumen Jaminan') NOT NULL,
  `kode` varchar(200) NOT NULL,
  `keperluan` varchar(200) NOT NULL,
  `tanggalpinjam` date NOT NULL,
  `tanggalkembali` date NOT NULL,
  `status` enum('Belum Dikembalikan','Telah Dikembalikan') NOT NULL DEFAULT 'Belum Dikembalikan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pinjamandokumen`
--

INSERT INTO `pinjamandokumen` (`id`, `jenis_dokumen`, `kode`, `keperluan`, `tanggalpinjam`, `tanggalkembali`, `status`) VALUES
(1, 'Dokumen Jaminan', 'JAM00001', 'Penelitian Jaminan', '2019-03-03', '2019-03-30', 'Belum Dikembalikan');

-- --------------------------------------------------------

--
-- Table structure for table `produk_tarif`
--

CREATE TABLE `produk_tarif` (
  `id` int(5) NOT NULL,
  `kode_katagori` varchar(10) NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `pemeriksaan` int(1) NOT NULL DEFAULT 1,
  `nama_produk` varchar(50) NOT NULL,
  `min_rujukan` varchar(10) NOT NULL,
  `max_rujukan` varchar(10) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `produk_tarif`
--

INSERT INTO `produk_tarif` (`id`, `kode_katagori`, `kode_produk`, `pemeriksaan`, `nama_produk`, `min_rujukan`, `max_rujukan`, `satuan`) VALUES
(1, 'KT001', 'PD0001', 0, 'Berkas RM Baru', '', '', ''),
(2, 'KT001', 'PD0002', 0, 'Berkas RM Lama', '', '', ''),
(3, 'KT001', 'PD0003', 0, 'Konsultasi Pemeriksaan Laboratorium', '1000', '1500', 'mgr'),
(4, 'KT001', 'PD0004', 0, 'Periksa Dokter', '', '', ''),
(5, 'C1001', 'PD0005', 1, 'Hema Analyzer 18 P', '500', '900', 'MLGR'),
(6, 'C1001', 'PD0006', 1, 'Hema Analyzer 18 P + LED', '', '', ''),
(8, 'C1001', 'PD0007', 1, 'LED ', '150', '200', 'mgr '),
(9, 'C1002', 'PD0008', 1, 'CT', '100', '150', 'mgr'),
(10, 'C1002', 'PD0009', 1, 'BT', '', '', ''),
(11, 'C1003', 'PD0010', 1, 'MDT (1P)', '', '', ''),
(12, 'C1003', 'PD0011', 1, 'MDT + Retikulosit (2P)', '', '', ''),
(13, 'C1003', 'PD0012', 1, 'Retikulosit (1P)', '', '', ''),
(14, 'KT001', 'BH0009', 0, 'Biaya entry data', '', '', ''),
(15, 'C1001', 'BH0002', 1, 'TEST DATA ', '', '', ''),
(18, 'C1001', 'PD99991', 1, 'BARU COBA ENTRY BARU', '500', '780', 'mlgr '),
(19, 'C1005', 'PD0199099', 1, 'COBA PRODUK 02102019', '100', '200', 'mlgr'),
(20, 'KT001', 'PD87654310', 1, 'REKAM MEDIS MAP PLASTIK KUNING BANGET', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Admin'),
(2, 'Pendaftaran'),
(3, 'Pemeriksaan');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_submodul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id`, `id_role`, `id_submodul`) VALUES
(2, 1, 1),
(3, 1, 11),
(5, 1, 8),
(6, 1, 12),
(7, 1, 13),
(8, 1, 18),
(9, 1, 22),
(10, 1, 23),
(11, 1, 16),
(12, 1, 17),
(14, 1, 19),
(15, 1, 14),
(16, 1, 20),
(17, 1, 21),
(18, 1, 9),
(19, 1, 15),
(20, 1, 24),
(21, 1, 25),
(22, 1, 26),
(23, 2, 18);

-- --------------------------------------------------------

--
-- Table structure for table `submodul`
--

CREATE TABLE `submodul` (
  `id` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `isparent` int(1) NOT NULL DEFAULT 0,
  `submodul` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `submodul`
--

INSERT INTO `submodul` (`id`, `id_modul`, `nama`, `url`, `isparent`, `submodul`) VALUES
(1, 2, 'Master Tenaga Medis', 'datatm.php', 0, 0),
(3, 3, 'Surat Masuk', 'suratmasuk.php', 0, 0),
(4, 3, 'Surat Keluar', 'suratkeluar.php', 0, 0),
(5, 5, 'Input Pelunasan', 'inputpelunasan.php', 0, 0),
(6, 5, 'Riwayat Pelunasan', 'riwayatpelunasan.php', 0, 0),
(7, 6, 'Pengaturan Sistem', 'pengaturansistem.php', 0, 0),
(8, 2, 'Katagori Tarif', 'katagori.php', 0, 0),
(9, 4, 'Pemeriksaan Laborat', 'periksa_laborat.php', 0, 0),
(11, 2, 'Metode Pemeriksaan', 'metode.php', 0, 0),
(12, 2, 'Produk Tarif', 'produk.php', 0, 0),
(13, 2, 'Tarif ', 'tarif.php', 0, 0),
(14, 3, 'Kassa Klinik', 'kassa.php', 0, 0),
(15, 4, 'Hasil Laborat', 'hasil_laborat.php', 0, 0),
(16, 6, 'Tambah Kategori Dokumen Jaminan', 'tambahjenisdokjam.php', 0, 0),
(17, 6, 'Kategori Dokumen Jaminan', 'jenisdokjam.php', 0, 0),
(18, 3, 'Pendaftaran Klinik', 'pendaftaran_klinik.php', 0, 0),
(19, 3, 'Pemeriksaan Klinik', 'pemeriksaan_klinik.php', 0, 0),
(20, 8, 'Data Jaminan', 'tambahjaminan.php', 0, 0),
(21, 8, 'Upload Jaminan', 'uploadjaminan.php', 0, 0),
(22, 4, 'Pendaftaran Laborat', 'pendaftaran_laborat.php', 0, 0),
(23, 4, 'Penerimaan Sampel', 'terima_sampel.php', 0, 0),
(24, 6, 'Upload Dokumen', 'uploadberkas.php', 0, 0),
(25, 9, 'Pelunasan', 'pengeluaranjaminan.php', 0, 0),
(26, 5, 'Riwayat Pengeluaran', 'riwayatpengeluaran.php', 0, 0),
(27, 4, 'Pendaftaran Laborat', 'daftarlaborat.php', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suratmenyurat`
--

CREATE TABLE `suratmenyurat` (
  `id` int(11) NOT NULL,
  `jenis_surat` enum('Surat Masuk','Surat Keluar') NOT NULL,
  `kode_ppu` varchar(50) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `suratmenyurat`
--

INSERT INTO `suratmenyurat` (`id`, `jenis_surat`, `kode_ppu`, `nomor_surat`, `tanggal_surat`, `perihal`, `keterangan`, `filename`) VALUES
(1, 'Surat Masuk', 'PPU002', '01/II/JKV/2018/01/001', '2019-03-03', 'Perihal Ini Bapak Sumaryono', 'Surat Untuk Bapak Sumaryono', 'opd_all.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tenaga_medis`
--

CREATE TABLE `tenaga_medis` (
  `id` int(11) NOT NULL,
  `nip_nik` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telpon` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `profesi` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tenaga_medis`
--

INSERT INTO `tenaga_medis` (`id`, `nip_nik`, `nama`, `alamat`, `telpon`, `jenis_kelamin`, `profesi`, `status`) VALUES
(1, '00001', 'Sadewa Alfansuri PS Za', 'Jl. Semnagat mama no 1', '0817384913', 'Laki-laki', 'Dokter', 'AKTIF'),
(2, '00002', 'Clara Nila PS', 'Jl. Semnagat mama no 1', '0815432435', 'Perempuan', 'Dokter', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_klinik`
--

CREATE TABLE `transaksi_klinik` (
  `id` int(11) NOT NULL,
  `id_kunjungan` int(11) NOT NULL,
  `kode_tarif` varchar(25) NOT NULL,
  `qty` int(5) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `transaksi_klinik`
--

INSERT INTO `transaksi_klinik` (`id`, `id_kunjungan`, `kode_tarif`, `qty`, `total`) VALUES
(1, 1, 'PD0002', 1, 3500),
(2, 1, 'PD0004', 1, 60000),
(3, 1, 'PD0005', 1, 125000),
(4, 1, 'PD0007', 1, 45000),
(5, 1, 'PD0008', 1, 60000),
(6, 2, 'PD0002', 1, 3500),
(7, 2, 'PD0004', 1, 60000),
(8, 2, 'PD0005', 1, 125000),
(9, 2, 'PD0008', 1, 60000),
(10, 3, 'PD0001', 1, 5000),
(11, 3, 'PD0004', 1, 60000),
(12, 3, 'PD0005', 1, 125000),
(13, 3, 'PD0007', 1, 45000),
(14, 3, 'PD0008', 1, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_laborat`
--

CREATE TABLE `transaksi_laborat` (
  `id` int(15) NOT NULL,
  `id_kunjungan` int(15) NOT NULL,
  `kode_tarif` varchar(25) NOT NULL,
  `qty` int(5) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_laborat`
--

INSERT INTO `transaksi_laborat` (`id`, `id_kunjungan`, `kode_tarif`, `qty`, `total`) VALUES
(1, 0, 'PD0001', 1, 5000),
(2, 0, 'PD0004', 1, 60000),
(3, 0, 'PD0005', 1, 125000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `bayar_klinik`
--
ALTER TABLE `bayar_klinik`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `dokinvestasi`
--
ALTER TABLE `dokinvestasi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `dokjaminan`
--
ALTER TABLE `dokjaminan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `faktur_laborat`
--
ALTER TABLE `faktur_laborat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `fileinvestasi`
--
ALTER TABLE `fileinvestasi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `filejaminan`
--
ALTER TABLE `filejaminan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hasil_klinik`
--
ALTER TABLE `hasil_klinik`
  ADD PRIMARY KEY (`id_hasilklinik`);

--
-- Indexes for table `jenisdokinvestasi`
--
ALTER TABLE `jenisdokinvestasi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenisdokjaminan`
--
ALTER TABLE `jenisdokjaminan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenisfasilitas`
--
ALTER TABLE `jenisfasilitas`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jenisjaminan`
--
ALTER TABLE `jenisjaminan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `katagori_tarif`
--
ALTER TABLE `katagori_tarif`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `komponen_tarif`
--
ALTER TABLE `komponen_tarif`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kunjungan_klinik`
--
ALTER TABLE `kunjungan_klinik`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kunjungan_laborat`
--
ALTER TABLE `kunjungan_laborat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idmodulmenu` (`id_modul`) USING BTREE;

--
-- Indexes for table `metode`
--
ALTER TABLE `metode`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `nilainormal`
--
ALTER TABLE `nilainormal`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pasienklinik`
--
ALTER TABLE `pasienklinik`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pasienlaborat`
--
ALTER TABLE `pasienlaborat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pengeluaranjaminan`
--
ALTER TABLE `pengeluaranjaminan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `pinjamandokumen`
--
ALTER TABLE `pinjamandokumen`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `produk_tarif`
--
ALTER TABLE `produk_tarif`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idsubmodulmenu` (`id_submodul`) USING BTREE;

--
-- Indexes for table `submodul`
--
ALTER TABLE `submodul`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idmodul` (`id_modul`) USING BTREE;

--
-- Indexes for table `suratmenyurat`
--
ALTER TABLE `suratmenyurat`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tenaga_medis`
--
ALTER TABLE `tenaga_medis`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `transaksi_klinik`
--
ALTER TABLE `transaksi_klinik`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `transaksi_laborat`
--
ALTER TABLE `transaksi_laborat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bayar_klinik`
--
ALTER TABLE `bayar_klinik`
  MODIFY `id_bayar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dokinvestasi`
--
ALTER TABLE `dokinvestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dokjaminan`
--
ALTER TABLE `dokjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faktur_laborat`
--
ALTER TABLE `faktur_laborat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fileinvestasi`
--
ALTER TABLE `fileinvestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `filejaminan`
--
ALTER TABLE `filejaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hasil_klinik`
--
ALTER TABLE `hasil_klinik`
  MODIFY `id_hasilklinik` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenisdokinvestasi`
--
ALTER TABLE `jenisdokinvestasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jenisdokjaminan`
--
ALTER TABLE `jenisdokjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenisfasilitas`
--
ALTER TABLE `jenisfasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenisjaminan`
--
ALTER TABLE `jenisjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `katagori_tarif`
--
ALTER TABLE `katagori_tarif`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `komponen_tarif`
--
ALTER TABLE `komponen_tarif`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kunjungan_klinik`
--
ALTER TABLE `kunjungan_klinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kunjungan_laborat`
--
ALTER TABLE `kunjungan_laborat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `metode`
--
ALTER TABLE `metode`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilainormal`
--
ALTER TABLE `nilainormal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pasienklinik`
--
ALTER TABLE `pasienklinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pasienlaborat`
--
ALTER TABLE `pasienlaborat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengeluaranjaminan`
--
ALTER TABLE `pengeluaranjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pinjamandokumen`
--
ALTER TABLE `pinjamandokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk_tarif`
--
ALTER TABLE `produk_tarif`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `submodul`
--
ALTER TABLE `submodul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `suratmenyurat`
--
ALTER TABLE `suratmenyurat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tenaga_medis`
--
ALTER TABLE `tenaga_medis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi_klinik`
--
ALTER TABLE `transaksi_klinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi_laborat`
--
ALTER TABLE `transaksi_laborat`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `idmodulmenu` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`);

--
-- Constraints for table `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `idsubmodulmenu` FOREIGN KEY (`id_submodul`) REFERENCES `submodul` (`id`);

--
-- Constraints for table `submodul`
--
ALTER TABLE `submodul`
  ADD CONSTRAINT `idmodul` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
