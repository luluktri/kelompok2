-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 08:19 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `dosen_penguji` int(11) NOT NULL,
  `jadwal_ujian` varchar(45) NOT NULL,
  `acc_ujian` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acc_ujian`
--

INSERT INTO `acc_ujian` (`id`, `dosen_penguji`, `jadwal_ujian`, `acc_ujian`) VALUES
(1, 1, '2022-09-10', NULL),
(2, 1, '2022-09-10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `anggota_kelompok`
--

CREATE TABLE `anggota_kelompok` (
  `id` int(11) NOT NULL,
  `nama_anggota` varchar(45) DEFAULT NULL,
  `nim` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota_kelompok`
--

INSERT INTO `anggota_kelompok` (`id`, `nama_anggota`, `nim`) VALUES
(27, '1', '362155401099'),
(28, '2', '362155401103'),
(29, '3', '362155401113'),
(30, '4', '362155401097'),
(31, '5', '362155401110');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama_dosen` varchar(45) NOT NULL,
  `nik` varchar(45) NOT NULL,
  `foto` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nama_dosen`, `nik`, `foto`, `user_id`) VALUES
(1, 'Lutfi Hakim S.Pd.,M.T.', '199203302019031012', 'tom.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lembar_kerja`
--

CREATE TABLE `lembar_kerja` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `file` varchar(45) NOT NULL,
  `revisi` varchar(255) DEFAULT NULL,
  `anggota_kelompok_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lembar_kerja`
--

INSERT INTO `lembar_kerja` (`id`, `tanggal`, `file`, `revisi`, `anggota_kelompok_id`) VALUES
(2, '2022-08-25', 'we.jpg', 'Salah file ', 27),
(3, '2022-08-27', 'we.jpg', NULL, 27),
(4, '2022-08-27', 'bob.jpg', NULL, 28),
(7, '2022-08-27', 'bob.jpg', NULL, 27);

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
(1, 'Luluk Triyani', '362155401099', '1D', 'mahasiswa1@gmail.com', 'jalan jalan', 2, 27),
(2, 'Andini Diska Anggraini', '362155401103', '1D', 'mahasiswa2@gmail.com', 'jalan jalan', 5, 28),
(3, 'Risma Riski Amalia', '362155401113', '1D', 'mahasiswa3@gmail.com', 'jalan jalan', 6, 29),
(4, 'Fauziah Putri Ramadhani', '362155401097', '1D', 'mahasiswa4@gmail.com', 'jalan jalan', 9, 30),
(5, 'Zeiniyatul Fitriyah', '362155401110', '1D', 'mahasiswa5@gmail.com', 'jalan jalan', 10, 31);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nilai_pembimbing_lapangan` varchar(45) DEFAULT NULL,
  `nilai_pembimbing_kp` varchar(45) DEFAULT NULL,
  `nilai_penguji` varchar(45) DEFAULT NULL,
  `bukti_nilai_pembimbing_lapangan` varchar(45) DEFAULT NULL,
  `pendaftaran_ujian_kp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nilai_pembimbing_lapangan`, `nilai_pembimbing_kp`, `nilai_penguji`, `bukti_nilai_pembimbing_lapangan`, `pendaftaran_ujian_kp_id`) VALUES
(1, NULL, '91', '90', NULL, 2),
(2, NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_kp`
--

CREATE TABLE `pendaftaran_kp` (
  `id` int(11) NOT NULL,
  `tempat_kp` varchar(45) NOT NULL,
  `alamat_kp` varchar(45) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `proposal` varchar(45) NOT NULL,
  `anggota_kelompok_id` int(11) DEFAULT NULL,
  `dosen_id` int(11) NOT NULL,
  `perusahaan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran_kp`
--

INSERT INTO `pendaftaran_kp` (`id`, `tempat_kp`, `alamat_kp`, `tanggal_mulai`, `tanggal_selesai`, `proposal`, `anggota_kelompok_id`, `dosen_id`, `perusahaan_id`) VALUES
(23, 'Politeknik Negeri Banyuwangi', 'Jalan Raya Jember No.KM13 Labanasem', '2022-08-27', '2022-08-27', 'create.php', 27, 1, NULL),
(24, 'Politeknik Negeri Banyuwangi', 'Jalan Raya Jember No.KM13 Labanasem', '2022-08-27', '2022-08-27', '', 28, 1, NULL),
(25, 'Politeknik Negeri Banyuwangi', 'Jalan Raya Jember No.KM13 Labanasem', '2022-08-27', '2022-08-27', '', 29, 1, NULL),
(26, 'Politeknik Negeri Banyuwangi', 'Jalan Raya Jember No.KM13 Labanasem', '2022-08-27', '2022-08-27', '', 30, 1, NULL),
(27, 'Politeknik Negeri Banyuwangi', 'Jalan Raya Jember No.KM13 Labanasem', '2022-08-27', '2022-08-27', '', 31, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_ujian_kp`
--

CREATE TABLE `pendaftaran_ujian_kp` (
  `id` int(11) NOT NULL,
  `laporan_kp` varchar(45) NOT NULL,
  `jadwal_ujian` varchar(45) DEFAULT NULL,
  `pendaftaran_kp_id` int(11) NOT NULL,
  `acc_ujian_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran_ujian_kp`
--

INSERT INTO `pendaftaran_ujian_kp` (`id`, `laporan_kp`, `jadwal_ujian`, `pendaftaran_kp_id`, `acc_ujian_id`) VALUES
(2, 'DAFTAR HADIR KELAS 1D 2022-3.docx', '2022-09-10', 23, 1),
(3, 'word.docx', '2022-09-10', 24, 2),
(4, 'worddoc.docx', NULL, 26, NULL);

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
(1, 'dosen', 'dosen', 1),
(2, 'luluk', 'luluk', 2),
(3, 'koor', 'koor', 4),
(4, 'admin', 'admin', 3),
(5, 'andini', 'andini', 2),
(6, 'risma', 'risma', 2),
(9, 'fau', 'fau', 2),
(10, 'jeni', 'jeni', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_user` int(11) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_user`, `role`) VALUES
(1, 'dosen'),
(2, 'mahasiswa'),
(3, 'admin'),
(4, 'koordinator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_ujian`
--
ALTER TABLE `acc_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dosen_penguji` (`dosen_penguji`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pendaftaran_ujian` (`pendaftaran_ujian_kp_id`);

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
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_ujian`
--
ALTER TABLE `acc_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `anggota_kelompok`
--
ALTER TABLE `anggota_kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lembar_kerja`
--
ALTER TABLE `lembar_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pendaftaran_kp`
--
ALTER TABLE `pendaftaran_kp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pendaftaran_ujian_kp`
--
ALTER TABLE `pendaftaran_ujian_kp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acc_ujian`
--
ALTER TABLE `acc_ujian`
  ADD CONSTRAINT `fk_dosen_penguji` FOREIGN KEY (`dosen_penguji`) REFERENCES `dosen` (`id`);

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
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_pendaftaran_ujian` FOREIGN KEY (`pendaftaran_ujian_kp_id`) REFERENCES `pendaftaran_ujian_kp` (`id`);

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
  ADD CONSTRAINT `fk` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
