-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 02:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bacapoint`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_list`
--

CREATE TABLE `book_list` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `tahun` int(4) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `cover_path` varchar(255) DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_list`
--

INSERT INTO `book_list` (`id`, `judul`, `author`, `tahun`, `genre`, `cover_path`, `pdf_path`, `created_at`) VALUES
(1, '48 Hukum Kekuasaan', 'Robert Greene', 1998, 'Self-Development', 'assets/buku/48hukumkekuasaan.png', 'assets/buku/48hukumkekuasaan.pdf', '2025-04-14 06:15:45'),
(2, 'Sejarah Dunia Kuno', 'Susan Wise Bauer', 2010, 'Sejarah', 'assets/buku/Sejarahduniakunodaricer.png', 'assets/buku/Sejarahduniakunodaricer.pdf', '2025-04-14 07:08:25'),
(3, 'Building a Second Brain', 'Tiago Forte', 2022, 'Productivity', 'assets/buku/BuildingaSecondBrainAP.png', 'assets/buku/BuildingaSecondBrainAP.pdf', '2025-04-14 07:10:22'),
(4, 'Storyworthy', 'Matthew Dicks', 2018, 'Self-Development', 'assets/buku/Storyworthy.png', 'assets/buku/Storyworthy.pdf', '2025-04-14 07:12:26'),
(5, 'Retorika Seni Berbicara', 'Aristoteles', 2000, 'Filsafat', 'assets/buku/RetorikaSeniBerbicara.png', 'assets/buku/RetorikaSeniBerbicara.pdf', '2025-04-14 07:15:19'),
(6, 'The Art Of War Sun Tzu', 'James Clavell', 2002, 'Self-Development', 'assets/buku/TheArtOfWarSunTzuSeni.png', 'assets/buku/TheArtOfWarSunTzuSeni.pdf', '2025-04-14 07:17:23'),
(9, 'Jangan Membuat Masalah Kecil dalam Hubungan Cinta Menjadi Masalah Besar', 'Richard Carlson and Kristine Carlson', 2020, 'Self-Love', 'assets/buku/JanganMembuatMasalahKecildalamHubunganCintaMenjadiMasalahBesar.png', 'assets/buku/JanganMembuatMasalahKecildalamHubunganCintaMenjadiMasalahBesar.pdf', '2025-04-17 04:43:53'),
(10, 'Jangan Membuat Masalah Kecil Jadi Masalah Besar', 'Richard Carlson and Kristine Carlson', 2020, 'Self-Love', 'assets/buku/JanganMembuatMasalahKecilJadiMasalahBesar.png', 'assets/buku/JanganMembuatMasalahKecilJadiMasalahBesar.pdf', '2025-04-17 04:45:01'),
(11, '30 Hari Jago Jualan', 'Dewa Eka Prayoga', 2014, 'Financial', 'assets/buku/30HariJagoJualan.png', 'assets/buku/30HariJagoJualan.pdf', '2025-04-17 04:45:56'),
(12, 'English Grammar for Dummies', 'Geraldine Woods', 2014, 'English', 'assets/buku/EnglishGrammarforDummies.png', 'assets/buku/EnglishGrammarforDummies.pdf', '2025-04-17 04:48:12'),
(13, 'ENSIKLOPEDI ALIRAN DAN MADZHAB DI DUNIA ISLAM', 'Tim Riset Majelis Tinggi Urusan Islam Mesir', 2000, 'Religion', 'assets/buku/ENSIKLOPEDI_ALIRAN_DAN_MADZHAB_DI_DUNIA_ISLAM.png', 'assets/buku/ENSIKLOPEDI_ALIRAN_DAN_MADZHAB_DI_DUNIA_ISLAM.pdf', '2025-04-17 04:49:48'),
(14, 'Kitab Anti-Bodoh Terampil Berpikir Benar Terhindar dari Cacat Logika & Sesat Pikir', 'Bo Bennett, Ph.D', 2015, 'Self-Development', 'assets/buku/KitabAnti-BodohTerampilBerpikirBenarTerhindardariCacatLogika&SesatPikir.png', 'assets/buku/KitabAnti-BodohTerampilBerpikirBenarTerhindardariCacatLogika&SesatPikir.pdf', '2025-04-17 04:51:22'),
(15, 'Last Human Vol. 001-010', 'Wen Qing', 2000, 'Comic', 'assets/buku/LastHumanVol001-010.png', 'assets/buku/LastHumanVol001-010.pdf', '2025-04-17 04:52:28'),
(16, 'Bumi', 'TereLiye', 2014, 'Novel', 'assets/buku/TereLiyeBumi.png', 'assets/buku/TereLiyeBumi.pdf', '2025-04-17 04:53:48'),
(17, 'Terjemah Mukhtashar Ihya Ulumuddin Ringkasan Ihya Ulumuddin', 'Imam Al-Ghazali', 2009, 'Religion', 'assets/buku/Terjemah_Mukhtashar_Ihya_Ulumuddin_Ringkasan_Ihya_Ulumuddin.png', 'assets/buku/Terjemah_Mukhtashar_Ihya_Ulumuddin_Ringkasan_Ihya_Ulumuddin.pdf', '2025-04-17 04:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'zakky', 'actvtymhs@gmail.com', '$2y$10$UYZ2GyfjWxHe3ySqiY8vIOFuClNmZ0kvhutnUbqL50pt9Qhv8K42e', '2025-04-13 18:56:18', 'user'),
(2, 'Admin', 'admin@example.com', '$2y$10$TNa2MVFM2cvPWGV8pltKwey.XDswiVwPef9L0JfEX1Iz7l1mVPaLq', '2025-04-17 03:36:09', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_list`
--
ALTER TABLE `book_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_list`
--
ALTER TABLE `book_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
