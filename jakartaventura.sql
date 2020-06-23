-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 Mar 2019 pada 14.50
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jakartaventura`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(5) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `password`, `role`, `telepon`, `foto`) VALUES
(1, 'admin', 'admin', 'admin', 1, '08123456789', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokinvestasi`
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('Belum Selesai','Telah Selesai') NOT NULL DEFAULT 'Belum Selesai'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokinvestasi`
--

INSERT INTO `dokinvestasi` (`id`, `no_register`, `kode_ppu`, `kode_fasilitas`, `tanggal_pencairan`, `plafond`, `no_perjanjian`, `tanggal_perjanjian`, `created_at`, `last_modified`, `status`) VALUES
(1, 'REG00001', 'PPU001', 'FAS001', '2019-03-25', 10000000, '000/111/222', '2019-02-25', '2019-02-25 10:20:21', '2019-02-25 10:20:21', 'Belum Selesai'),
(2, 'REG00002', 'PPU002', 'FAS001', '2019-01-25', 7500000, '123/II/1000', '2019-03-25', '2019-02-25 11:36:52', '2019-02-25 11:36:52', 'Belum Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokjaminan`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokjaminan`
--

INSERT INTO `dokjaminan` (`id`, `no_register`, `kode_jaminan`, `nama_jaminan`, `jenis_jaminan`, `keterangan`, `nilai_pasar`, `nilai_likuidasi`, `status`) VALUES
(1, 'REG00001', 'JAM00001', 'Motor XXX', 1, 'Motor Mulus', 10000000, 9000000, 'Tersedia'),
(2, 'REG00002', 'JAM00002', 'Laptop Acer', 4, 'Laptop Acer Swift 3', 8500000, 7000000, 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fileinvestasi`
--

CREATE TABLE `fileinvestasi` (
  `id` int(11) NOT NULL,
  `no_register` varchar(50) NOT NULL,
  `jenis_dokumen` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fileinvestasi`
--

INSERT INTO `fileinvestasi` (`id`, `no_register`, `jenis_dokumen`, `filename`) VALUES
(1, 'REG00001', 3, 'BeritaAcaraRekon.pdf'),
(2, 'REG00001', 2, 'BeritaAcaraRekon_Edit.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `filejaminan`
--

CREATE TABLE `filejaminan` (
  `id` int(11) NOT NULL,
  `kode_jaminan` varchar(100) NOT NULL,
  `jenis_dokumen` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `filejaminan`
--

INSERT INTO `filejaminan` (`id`, `kode_jaminan`, `jenis_dokumen`, `filename`) VALUES
(1, 'JAM00002', 3, '5678-13780-1-SM.pdf'),
(2, 'JAM00002', 2, 'doc.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisdokinvestasi`
--

CREATE TABLE `jenisdokinvestasi` (
  `id` int(11) NOT NULL,
  `jenis_dokumen` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenisdokinvestasi`
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
-- Struktur dari tabel `jenisdokjaminan`
--

CREATE TABLE `jenisdokjaminan` (
  `id` int(11) NOT NULL,
  `jenis_dokumen` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenisdokjaminan`
--

INSERT INTO `jenisdokjaminan` (`id`, `jenis_dokumen`, `status`) VALUES
(1, 'Jenis Jaminan', 1),
(2, 'Dokumen Pendukung', 1),
(3, 'Laporan Hasil Penilaian', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisfasilitas`
--

CREATE TABLE `jenisfasilitas` (
  `id` int(11) NOT NULL,
  `kode_fasilitas` varchar(50) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenisfasilitas`
--

INSERT INTO `jenisfasilitas` (`id`, `kode_fasilitas`, `nama_fasilitas`) VALUES
(1, 'FAS001', 'Jakarta');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisjaminan`
--

CREATE TABLE `jenisjaminan` (
  `id` int(11) NOT NULL,
  `jenis_jaminan` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenisjaminan`
--

INSERT INTO `jenisjaminan` (`id`, `jenis_jaminan`, `status`) VALUES
(1, 'Tanah HM', 1),
(2, 'Mobil', 1),
(3, 'Motor', 1),
(4, 'Laptop', 1),
(5, 'Mesin Cuci', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `id_role`, `id_modul`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 8),
(4, 1, 3),
(5, 1, 4),
(6, 1, 5),
(7, 1, 6),
(8, 1, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

CREATE TABLE `modul` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `isparent` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id`, `nama`, `url`, `icon`, `isparent`) VALUES
(1, 'Home', 'index.php', 'mdi mdi-home', 0),
(2, 'Dokumen Investasi', 'berkas.php', 'mdi mdi-file-document', 1),
(3, 'Surat Menyurat', 'surat.php', 'mdi mdi-email', 1),
(4, 'Pinjaman Dokumen', 'pinjaman.php', 'mdi mdi-sync', 1),
(5, 'Pengeluaran Dokumen', 'pelunasan.php', 'mdi mdi-bookmark-check', 1),
(6, 'Pengaturan', 'pengaturan.php', 'mdi mdi-settings', 1),
(7, 'Logout', 'javascript:logout()', 'mdi mdi-logout-variant', 0),
(8, 'Dokumen Jaminan', 'tambahjaminan.php', 'mdi mdi-archive', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaranjaminan`
--

CREATE TABLE `pengeluaranjaminan` (
  `id` int(11) NOT NULL,
  `no_register` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaranjaminan`
--

INSERT INTO `pengeluaranjaminan` (`id`, `no_register`, `waktu`) VALUES
(1, 'REG00002', '2019-03-02 16:23:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjamandokumen`
--

CREATE TABLE `pinjamandokumen` (
  `id` int(11) NOT NULL,
  `jenis_dokumen` enum('Dokumen Investasi','Dokumen Jaminan') NOT NULL,
  `kode` varchar(200) NOT NULL,
  `keperluan` varchar(200) NOT NULL,
  `tanggalpinjam` date NOT NULL,
  `tanggalkembali` date NOT NULL,
  `status` enum('Belum Dikembalikan','Telah Dikembalikan') NOT NULL DEFAULT 'Belum Dikembalikan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pinjamandokumen`
--

INSERT INTO `pinjamandokumen` (`id`, `jenis_dokumen`, `kode`, `keperluan`, `tanggalpinjam`, `tanggalkembali`, `status`) VALUES
(1, 'Dokumen Jaminan', 'JAM00001', 'Penelitian Jaminan', '2019-03-03', '2019-03-30', 'Belum Dikembalikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ppu`
--

CREATE TABLE `ppu` (
  `id` int(11) NOT NULL,
  `kode_ppu` varchar(50) NOT NULL,
  `nama_ppu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ppu`
--

INSERT INTO `ppu` (`id`, `kode_ppu`, `nama_ppu`) VALUES
(1, 'PPU001', 'Karyanto'),
(2, 'PPU002', 'Sumaryono');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `submenu`
--

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_submodul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `submenu`
--

INSERT INTO `submenu` (`id`, `id_role`, `id_submodul`) VALUES
(1, 1, 10),
(2, 1, 1),
(3, 1, 11),
(4, 1, 2),
(5, 1, 12),
(6, 1, 8),
(7, 1, 13),
(8, 1, 14),
(9, 1, 15),
(10, 1, 9),
(11, 1, 16),
(12, 1, 17),
(14, 1, 18),
(15, 1, 19),
(16, 1, 20),
(17, 1, 21),
(18, 1, 22),
(19, 1, 23),
(20, 1, 24),
(21, 1, 25),
(22, 1, 26);

-- --------------------------------------------------------

--
-- Struktur dari tabel `submodul`
--

CREATE TABLE `submodul` (
  `id` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `isparent` int(1) NOT NULL DEFAULT '0',
  `submodul` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `submodul`
--

INSERT INTO `submodul` (`id`, `id_modul`, `nama`, `url`, `isparent`, `submodul`) VALUES
(1, 2, 'Data PPU', 'datappu.php', 0, 0),
(2, 2, 'Dokumen Investasi', 'databerkas.php', 0, 0),
(3, 3, 'Surat Masuk', 'suratmasuk.php', 0, 0),
(4, 3, 'Surat Keluar', 'suratkeluar.php', 0, 0),
(5, 5, 'Input Pelunasan', 'inputpelunasan.php', 0, 0),
(6, 5, 'Riwayat Pelunasan', 'riwayatpelunasan.php', 0, 0),
(7, 6, 'Pengaturan Sistem', 'pengaturansistem.php', 0, 0),
(8, 6, 'Data Fasilitas', 'dataorganisasi.php', 0, 0),
(9, 6, 'Kategori Jaminan', 'jenisjaminan.php', 0, 0),
(10, 2, 'Tambah PPU', 'tambahppu.php', 0, 0),
(11, 2, 'Tambah Dokumen', 'tambahberkas.php', 0, 0),
(12, 6, 'Tambah Fasilitas', 'tambahfasilitas.php', 0, 0),
(13, 6, 'Tambah Kategori Dokumen', 'tambahjenisdokinv.php', 0, 0),
(14, 6, 'Kategori Dokumen', 'jenisdokinv.php', 0, 0),
(15, 6, 'Tambah Kategori Jaminan', 'tambahjenisjaminan.php', 0, 0),
(16, 6, 'Tambah Kategori Dokumen Jaminan', 'tambahjenisdokjam.php', 0, 0),
(17, 6, 'Kategori Dokumen Jaminan', 'jenisdokjam.php', 0, 0),
(18, 3, 'Tambah Surat', 'tambahsurat.php', 0, 0),
(19, 3, 'Data Surat Menyurat', 'datasurat.php', 0, 0),
(20, 8, 'Data Jaminan', 'tambahjaminan.php', 0, 0),
(21, 8, 'Upload Jaminan', 'uploadjaminan.php', 0, 0),
(22, 4, 'Tambah Peminjaman', 'tambahpinjaman.php', 0, 0),
(23, 4, 'Data Peminjaman', 'datapeminjaman.php', 0, 0),
(24, 2, 'Upload Dokumen', 'uploadberkas.php', 0, 0),
(25, 5, 'Pelunasan', 'pengeluaranjaminan.php', 0, 0),
(26, 5, 'Riwayat Pengeluaran', 'riwayatpengeluaran.php', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratmenyurat`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suratmenyurat`
--

INSERT INTO `suratmenyurat` (`id`, `jenis_surat`, `kode_ppu`, `nomor_surat`, `tanggal_surat`, `perihal`, `keterangan`, `filename`) VALUES
(1, 'Surat Masuk', 'PPU002', '01/II/JKV/2018/01/001', '2019-03-03', 'Perihal Ini Bapak Sumaryono', 'Surat Untuk Bapak Sumaryono', 'opd_all.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokinvestasi`
--
ALTER TABLE `dokinvestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokjaminan`
--
ALTER TABLE `dokjaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fileinvestasi`
--
ALTER TABLE `fileinvestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filejaminan`
--
ALTER TABLE `filejaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisdokinvestasi`
--
ALTER TABLE `jenisdokinvestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisdokjaminan`
--
ALTER TABLE `jenisdokjaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisfasilitas`
--
ALTER TABLE `jenisfasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenisjaminan`
--
ALTER TABLE `jenisjaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idmodulmenu` (`id_modul`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengeluaranjaminan`
--
ALTER TABLE `pengeluaranjaminan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjamandokumen`
--
ALTER TABLE `pinjamandokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ppu`
--
ALTER TABLE `ppu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsubmodulmenu` (`id_submodul`);

--
-- Indexes for table `submodul`
--
ALTER TABLE `submodul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idmodul` (`id_modul`);

--
-- Indexes for table `suratmenyurat`
--
ALTER TABLE `suratmenyurat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jenisjaminan`
--
ALTER TABLE `jenisjaminan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
-- AUTO_INCREMENT for table `ppu`
--
ALTER TABLE `ppu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `submodul`
--
ALTER TABLE `submodul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `suratmenyurat`
--
ALTER TABLE `suratmenyurat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `idmodulmenu` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`);

--
-- Ketidakleluasaan untuk tabel `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `idsubmodulmenu` FOREIGN KEY (`id_submodul`) REFERENCES `submodul` (`id`);

--
-- Ketidakleluasaan untuk tabel `submodul`
--
ALTER TABLE `submodul`
  ADD CONSTRAINT `idmodul` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
