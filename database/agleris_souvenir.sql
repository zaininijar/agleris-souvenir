-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 08:11 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agleris_souvenir`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `souvenirs`
--

CREATE TABLE `souvenirs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `unit` bigint(20) NOT NULL,
  `price` double NOT NULL,
  `picture_path` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `souvenirs`
--

INSERT INTO `souvenirs` (`id`, `name`, `description`, `unit`, `price`, `picture_path`, `created_at`, `updated_at`) VALUES
(1, 'Gantungan Kunci Eiffel Tower', 'Gantungan kunci dengan bentuk Menara Eiffel.', 100, 15000, 'gantungan_eiffel.webp', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(2, 'Topi Pantai Tropis', 'Topi pantai dengan desain tropis dan warna cerah.', 50, 20000, 'topi_pantai.jpg', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(3, 'Patung Liberty Mini', 'Miniatur Patung Liberty dengan tinggi 10 cm.', 30, 25000, 'patung_liberti.webp', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(4, 'Gelang Batu Laut', 'Gelang dengan batu laut asli dan desain unik.', 80, 18000, 'gelang_batu.jpg', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(5, 'Kaos Desa Pesisir', 'Kaos dengan gambar desa pesisir yang indah.', 120, 30000, 'kaos_pesisir.jpg', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(6, 'Magnet Kulkas Klasik', 'Magnet kulkas dengan gambar klasik kota.', 200, 8000, 'magnet_kulkas.webp', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(7, 'Keramik Gaya Maroko', 'Keramik dengan motif Maroko yang artistik.', 60, 35000, 'keramik_maroko.jpg', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(8, 'Topeng Tradisional', 'Topeng tradisional dengan detail ukiran tangan.', 40, 45000, 'topeng_tradisional.jpg', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(9, 'Kemeja Batik Bali', 'Kemeja batik asli dari Bali dengan desain eksklusif.', 70, 55000, 'kemeja_batik.avif', '2023-10-17 21:26:51', '2023-10-17 21:26:51'),
(10, 'Kalung Mutiara Laut', 'Kalung mutiara laut asli dengan gantungan berlian.', 20, 75000, 'kalung_mutiara.jpg', '2023-10-17 21:26:51', '2023-10-17 21:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `souvenir_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `status` enum('REJECT','SUCCESS','CHART','SHIPPED') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', 'hashed_password_1', '123 Main Street, City', '2023-10-17 22:14:59', '2023-10-17 22:14:59'),
(2, 'Jane Smith', 'jane.smith@example.com', 'hashed_password_2', '456 Elm Street, Town', '2023-10-17 22:14:59', '2023-10-17 22:14:59'),
(3, 'Alice Johnson', 'alice.johnson@example.com', 'hashed_password_3', '789 Oak Street, Village', '2023-10-17 22:14:59', '2023-10-17 22:14:59'),
(4, 'Bob Wilson', 'bob.wilson@example.com', 'hashed_password_4', '101 Pine Street, Suburb', '2023-10-17 22:14:59', '2023-10-17 22:14:59'),
(5, 'Eve Davis', 'eve.davis@example.com', 'hashed_password_5', '202 Cedar Street, County', '2023-10-17 22:14:59', '2023-10-17 22:14:59'),
(9, 'Ahmad Zaini Nijar', 'zaininijar7610@gmail.com', '$2y$10$JrGpY/hBLNQmvX4kTe4EXucxYC6Qh2ofkmn9tXBIobUBSfejYSO4.', 'Rao, Pasaman\r\n', '2023-10-17 22:39:26', '2023-10-17 22:39:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `souvenirs`
--
ALTER TABLE `souvenirs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `souvenir_id` (`souvenir_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `souvenirs`
--
ALTER TABLE `souvenirs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
