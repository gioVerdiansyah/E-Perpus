-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 02:54 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(255) NOT NULL,
  `judul_buku` varchar(74) NOT NULL,
  `kategori` varchar(144) NOT NULL,
  `penulis` varchar(144) NOT NULL,
  `penerbit` varchar(144) NOT NULL,
  `image` varchar(64) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `isbn` varchar(144) NOT NULL,
  `jumlah_halaman` int(18) NOT NULL,
  `link` text NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul_buku`, `kategori`, `penulis`, `penerbit`, `image`, `tahun_terbit`, `isbn`, `jumlah_halaman`, `link`, `sinopsis`) VALUES
(12, 'Filosifi Teras', 'Filsafat', 'Henry Manampiring', 'Buku Kompas', '643f44932cc1d.png', '2018-11-26', '978-602-412-518-9', 346, 'https://drive.google.com/file/d/114pby3w2kujnpq7UWN7-38caAp-h8M1o/view?usp=sharing', 'Filosofi Teras menjelaskan tentang filsafat Yunani-Romawi kuno yang bisa membantu Anda mengatasi emosi negatif dan menghasilkan mental yang tangguh dalam menghadapi masalah hidup. Di dalam pimtar ini Anda akan mempelajari definisi Filosofi Teras dan penerapannya dalam kehidupan sehari-hari.'),
(13, 'Sebuah Seni Untuk Bersikap Bodo Amat', 'Self Improvement', 'Mark Manson', 'PT. Gramedia Widiasarana Indonesia (Grasindo).', '643f6a8794065.jpg', '2016-09-13', '978-602-452-698-6', 246, 'https://drive.google.com/file/d/1bitklEzVDb825o2-ABeN8ZlDm0vkOgTS/view?usp=sharing', 'Sebuah Seni untuk Bersikap Bodo Amat (2018) menjelaskan kunci agar Anda menjadi lebih kuat dan lebih bahagia. Di dalam buku ini, Anda akan mendapatkan pemahaman tentang sumber kekuatan yang paling nyata, yaitu mengetahui batasan-batasan yang ada dalam diri dan menerimanya. Sehingga Anda mampu menghadapi kenyataan-kenyataan dan mulai menemukan keberanian yang selama ini Anda cari.'),
(16, 'testttttttttttttttttttststtststtsttsttsststtststtttttttttttttttttttttttttt', 'testing', '-', '-', '644a81264da4f.png', '2023-04-27', '-', 123, '../component/Not-Found.php', 'ntahlah');

-- --------------------------------------------------------

--
-- Table structure for table `loginadmin`
--

CREATE TABLE `loginadmin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginadmin`
--

INSERT INTO `loginadmin` (`id`, `username`, `password`, `gambar`) VALUES
(6, 'verdi', '$2y$10$RmWyR8x7xNT5GFW8wk/OpebaY5.naqnkXHe0wx7/S.Z5N35AkWYJq', '6433ee9dcef97.jpg'),
(7, 'adi', '$2y$10$kT3TAFRjDcPgVeWIpZcu1Ov49gZLC/Uacdcqzn1Bx3qSHHvILHZ1G', '6434097854649.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `loginuser`
--

CREATE TABLE `loginuser` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `pass` varchar(144) NOT NULL,
  `gambar` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginuser`
--

INSERT INTO `loginuser` (`id`, `username`, `pass`, `gambar`) VALUES
(28, 'verdi', '$2y$10$hiew46.aJ5BeMdoX6D3JE.E/kjF29FtU74evO20rFMvIuCS3P5iDW', '643b410968d19.jpg'),
(32, 'verdiansyah_', '$2y$10$mGpTGE87O79WioCIQC8SLOf0kssWN0udWSgBw4i4/Lb51SZXWX24C', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembaca`
--

CREATE TABLE `pembaca` (
  `id` int(11) NOT NULL,
  `pp_user` varchar(64) NOT NULL,
  `username` varchar(144) NOT NULL,
  `bukunya` varchar(144) NOT NULL,
  `kategori` varchar(144) NOT NULL,
  `tanggal_baca` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembaca`
--

INSERT INTO `pembaca` (`id`, `pp_user`, `username`, `bukunya`, `kategori`, `tanggal_baca`) VALUES
(29, '643b410968d19.jpg', 'verdi', 'Filosifi Teras', 'Filsafat', '19:02/02/05/2023'),
(31, '643b410968d19.jpg', 'verdi', 'testttttttttttttttttttststtststtsttsttsststtststtttttttttttttttttttttttttt', 'testing', '19:04/02/05/2023'),
(32, 'default.jpg', 'verdiansyah_', 'testttttttttttttttttttststtststtsttsttsststtststtttttttttttttttttttttttttt', 'testing', '20:16/02/05/2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginadmin`
--
ALTER TABLE `loginadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginuser`
--
ALTER TABLE `loginuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembaca`
--
ALTER TABLE `pembaca`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `loginadmin`
--
ALTER TABLE `loginadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loginuser`
--
ALTER TABLE `loginuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pembaca`
--
ALTER TABLE `pembaca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
