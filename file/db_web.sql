-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 04:04 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_ujian`
--

CREATE TABLE `acc_ujian` (
  `id` int(11) NOT NULL,
  `dosen_penguji` varchar(45) NOT NULL,
  `jadwal_ujian` varchar(45) NOT NULL,
  `acc_ujian` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anggota_kelompok`
--

CREATE TABLE `anggota_kelompok` (
  `id` int(11) NOT NULL,
  `nama_anggota` varchar(45) NOT NULL,
  `nim` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama_dosen` varchar(45) NOT NULL,
  `nik` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lembar_kerja`
--

CREATE TABLE `lembar_kerja` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `file` varchar(45) NOT NULL,
  `anggota_kelompok_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `nim` varchar(45) NOT NULL,
  `kelas` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `alamat` varchar(45) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `anggota_kelompok_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`, `kelas`, `email`, `alamat`, `user_id`, `anggota_kelompok_id`) VALUES
(1, 'Mahasiswa 1', '301', '1B', 'mahasiswa1@gmail.com', 'jalan jalan', NULL, NULL),
(2, 'Mahasiswa 2', '302', '1A', 'mahasiswa2@gmail.com', 'jalan jalan', NULL, NULL),
(3, 'Mahasiswa 3', '303', '1C', 'mahasiswa3@gmail.com', 'jalan jalan', NULL, NULL),
(4, 'Mahasiswa 4', '304', '1D', 'mahasiswa4@gmail.com', 'jalan jalan', NULL, NULL),
(5, 'Mahasiswa 5', '305', '1E', 'mahasiswa5@gmail.com', 'jalan jalan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nilai_pembimbing_lapangan` varchar(45) NOT NULL,
  `nilai_pembimbing_kp` varchar(45) NOT NULL,
  `nilai_penguji` varchar(45) NOT NULL,
  `bukti_nilai_pembimbing_lapangan` varchar(45) NOT NULL,
  `pendaftaran_ujian_kp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_kp`
--

CREATE TABLE `pendaftaran_kp` (
  `id` int(11) NOT NULL,
  `tempat_kp` varchar(45) NOT NULL,
  `alamat_kp` varchar(45) NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `proposal` varchar(45) NOT NULL,
  `anggota_kelompok_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `perusahaan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_ujian_kp`
--

CREATE TABLE `pendaftaran_ujian_kp` (
  `id` int(11) NOT NULL,
  `laporan_kp` varchar(45) NOT NULL,
  `jadwal_ujian` varchar(45) NOT NULL,
  `pendaftaran_kp_id` int(11) NOT NULL,
  `acc_ujian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(45) NOT NULL,
  `alamat` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telephone` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `id_role`) VALUES
(1, 'dosen', 'dosen', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'dosen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_ujian`
--
ALTER TABLE `acc_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `lembar_kerja`
--
ALTER TABLE `lembar_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_lembar_kerja_kelompok` (`anggota_kelompok_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_mhs` (`user_id`),
  ADD KEY `fk_kelompok_mhs` (`anggota_kelompok_id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran_kp`
--
ALTER TABLE `pendaftaran_kp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_daftar_kelompok` (`anggota_kelompok_id`),
  ADD KEY `fk_daftar_dosen` (`dosen_id`),
  ADD KEY `fk_daftar_perusahaan` (`perusahaan_id`);

--
-- Indexes for table `pendaftaran_ujian_kp`
--
ALTER TABLE `pendaftaran_ujian_kp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_daftar_ujian` (`pendaftaran_kp_id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`id_role`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_ujian`
--
ALTER TABLE `acc_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lembar_kerja`
--
ALTER TABLE `lembar_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran_kp`
--
ALTER TABLE `pendaftaran_kp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran_ujian_kp`
--
ALTER TABLE `pendaftaran_ujian_kp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `lembar_kerja`
--
ALTER TABLE `lembar_kerja`
  ADD CONSTRAINT `fk_lembar_kerja_kelompok` FOREIGN KEY (`anggota_kelompok_id`) REFERENCES `anggota_kelompok` (`id`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_kelompok_mhs` FOREIGN KEY (`anggota_kelompok_id`) REFERENCES `anggota_kelompok` (`id`),
  ADD CONSTRAINT `fk_user_mhs` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `pendaftaran_kp`
--
ALTER TABLE `pendaftaran_kp`
  ADD CONSTRAINT `fk_daftar_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `fk_daftar_kelompok` FOREIGN KEY (`anggota_kelompok_id`) REFERENCES `anggota_kelompok` (`id`),
  ADD CONSTRAINT `fk_daftar_perusahaan` FOREIGN KEY (`perusahaan_id`) REFERENCES `perusahaan` (`id`);

--
-- Constraints for table `pendaftaran_ujian_kp`
--
ALTER TABLE `pendaftaran_ujian_kp`
  ADD CONSTRAINT `fk_daftar_ujian` FOREIGN KEY (`pendaftaran_kp_id`) REFERENCES `pendaftaran_kp` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
