-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2026 at 12:43 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_pdt`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_buku` (IN `judul_buku` VARCHAR(100), IN `stok_buku` INT, IN `id_kat` INT)   BEGIN
    INSERT INTO buku (judul, stok, id_kategori)
    VALUES (judul_buku, stok_buku, id_kat);
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cek_stok` (`stok` INT) RETURNS VARCHAR(20) CHARSET utf8mb4 DETERMINISTIC BEGIN
    IF stok > 0 THEN
        RETURN 'Tersedia';
    ELSE
        RETURN 'Habis';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama`) VALUES
(1, 'Budi'),
(2, 'Siti'),
(3, 'Andi'),
(4, 'Rina'),
(5, 'Dewi'),
(6, 'Agus'),
(7, 'Putri'),
(8, 'Joko'),
(9, 'Lina'),
(10, 'Rudi'),
(11, 'Nina'),
(12, 'Fajar');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `stok` int NOT NULL,
  `id_kategori` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `stok`, `id_kategori`) VALUES
(1, 'Laskar Pelangi', 4, 1),
(2, 'Bumi', 6, 1),
(3, 'Dilan 1990', 4, 1),
(4, 'Belajar SQL Dasar', 3, 2),
(5, 'Pemrograman C++', 2, 2),
(6, 'Dasar Python', 5, 2),
(7, 'Jaringan Komputer', 3, 2),
(8, 'Sejarah Indonesia', 4, 3),
(9, 'Sejarah Dunia', 2, 3),
(10, 'Perang Dunia II', 3, 3),
(11, 'Matematika Dasar', 6, 4),
(12, 'Fisika SMA', 4, 4),
(13, 'Kimia Dasar', 3, 4),
(14, 'Naruto Vol 1', 5, 5),
(15, 'One Piece Vol 1', 6, 5),
(16, 'Attack on Titan', 4, 5),
(17, 'Dragon Ball', 5, 5),
(18, 'Detective Conan', 3, 5),
(19, 'Buku Baru', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pinjam`
--

CREATE TABLE `detail_pinjam` (
  `id_detail` int NOT NULL,
  `id_pinjam` int DEFAULT NULL,
  `id_buku` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pinjam`
--

INSERT INTO `detail_pinjam` (`id_detail`, `id_pinjam`, `id_buku`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 2, 2),
(4, 2, 5),
(5, 3, 3),
(6, 3, 6),
(7, 4, 7),
(8, 5, 8),
(9, 6, 9),
(10, 7, 10),
(11, 8, 11);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(1, 'Novel'),
(2, 'Teknologi'),
(3, 'Sejarah'),
(4, 'Pendidikan'),
(5, 'Komik');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int NOT NULL,
  `id_anggota` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_anggota`, `tanggal`) VALUES
(1, 1, '2025-04-01'),
(2, 2, '2025-04-01'),
(3, 3, '2025-04-02'),
(4, 4, '2025-04-02'),
(5, 5, '2025-04-03'),
(6, 6, '2025-04-03'),
(7, 7, '2025-04-04'),
(8, 8, '2025-04-04'),
(9, 1, '2026-04-02');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_peminjaman`
-- (See below for the actual view)
--
CREATE TABLE `view_peminjaman` (
`id_pinjam` int
,`nama_anggota` varchar(100)
,`judul` varchar(100)
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Structure for view `view_peminjaman`
--
DROP TABLE IF EXISTS `view_peminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_peminjaman`  AS SELECT `p`.`id_pinjam` AS `id_pinjam`, `a`.`nama` AS `nama_anggota`, `b`.`judul` AS `judul`, `p`.`tanggal` AS `tanggal` FROM (((`peminjaman` `p` join `anggota` `a` on((`p`.`id_anggota` = `a`.`id_anggota`))) join `detail_pinjam` `d` on((`p`.`id_pinjam` = `d`.`id_pinjam`))) join `buku` `b` on((`d`.`id_buku` = `b`.`id_buku`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pinjam` (`id_pinjam`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `detail_pinjam`
--
ALTER TABLE `detail_pinjam`
  ADD CONSTRAINT `detail_pinjam_ibfk_1` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_pinjam`),
  ADD CONSTRAINT `detail_pinjam_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
