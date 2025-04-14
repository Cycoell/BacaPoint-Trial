-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 10:16 AM
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
(2, 'Sejarah Dunia Kuno', 'Susan Wise Bauer', 2010, 'Sejarah', 'assets/buku/Sejarahduniakunodaricer.png', 'assets/buku/Sejarahduniakunodaricer.df', '2025-04-14 07:08:25'),
(3, 'Building a Second Brain', 'Tiago Forte', 2022, 'Productivity', 'assets/buku/BuildingaSecondBrainAP.png', 'assets/buku/BuildingaSecondBrainAP.pdf', '2025-04-14 07:10:22'),
(4, 'Storyworthy', 'Matthew Dicks', 2018, 'Self-Development', 'assets/buku/Storyworthy.png', 'assets/buku/Storyworthy.pdf', '2025-04-14 07:12:26'),
(5, 'Retorika Seni Berbicara', 'Aristoteles', 2000, 'Filsafat', 'assets/buku/RetorikaSeniBerbicara.png', 'assets/buku/RetorikaSeniBerbicara.pdf', '2025-04-14 07:15:19'),
(6, 'The Art Of War Sun Tzu', 'James Clavell', 2002, 'Self-Development', 'assets/buku/TheArtOfWarSunTzuSeni.png', 'assets/buku/TheArtOfWarSunTzuSeni.pdf', '2025-04-14 07:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'zakky', 'actvtymhs@gmail.com', '$2y$10$UYZ2GyfjWxHe3ySqiY8vIOFuClNmZ0kvhutnUbqL50pt9Qhv8K42e', '2025-04-13 18:56:18');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
