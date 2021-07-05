-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 11:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ubi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `branch_id`, `updated_at`, `created_at`) VALUES
(1, 'admin', '6eb6f861643e1dd0cd69a71f90428414', 1, '2021-06-29 05:46:38', '0000-00-00 00:00:00'),
(2, 'kopi', 'd6e631248c899248f50290423fa1e697', 4, '2021-06-28 22:46:49', '2021-06-28 22:46:49'),
(3, 'pontren', '92eaf261c301b16e6b3b9ea568fe6bbb', 5, '2021-06-28 22:52:11', '2021-06-28 22:52:11'),
(4, 'esa', '92eaf261c301b16e6b3b9ea568fe6bbb', 1, '2021-06-29 00:14:37', '2021-06-28 22:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_head` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `branch_head`, `branch_address`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'Ubiku', 'Esa', 'Taman Indah V', 2, '2021-06-15 23:42:47', '2021-06-30 03:45:13'),
(4, 'Kopi Q', '-', '-', 2, '2021-06-16 01:20:19', '2021-06-28 20:14:39'),
(5, 'Koppontren', '-', '-', 2, '2021-06-17 20:52:21', '2021-06-28 20:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `branch_stocks`
--

CREATE TABLE `branch_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `no_telp`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'adit', '0813726271819', 1, '2021-07-01 10:18:17', '2021-07-01 10:22:25'),
(2, 'esa', '0928771028710', 1, '2021-07-01 10:18:17', '2021-07-01 10:22:32'),
(3, 'Alexandros', '08123456789', 0, '2021-07-01 22:31:52', '2021-07-01 22:31:52'),
(4, 'Giring Nidji', '08147217427', 0, '2021-07-02 02:29:58', '2021-07-02 02:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ubiku', '2021-06-15 23:48:55', '2021-06-16 06:49:09'),
(2, 'Batata', '2021-06-09 21:08:49', '2021-06-09 23:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` int(11) NOT NULL,
  `nama_stock` varchar(100) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `peritem` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `nama_stock`, `stock_id`, `peritem`, `created_at`, `updated_at`) VALUES
(1, 'Bungkus', 0, 0, '2021-06-10 07:02:25', '2021-06-15 08:10:19'),
(2, 'Box', 1, 24, '2021-06-13 20:08:50', '2021-06-13 20:08:50'),
(3, 'Dus', 2, 2, '2021-06-15 00:10:43', '2021-06-15 00:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `variant_name` varchar(50) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `branch_id`, `product_code`, `variant_name`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'UBI001', 'Ubiku rasa jagung bakar', 'aktif', '2021-06-30 21:07:42', '2021-06-30 21:07:42'),
(7, 4, 'KQ001', 'Kopi Kapucino', 'aktif', '2021-06-30 21:08:23', '2021-06-30 21:08:23'),
(8, 5, 'KP001', 'Kopi Santri', 'aktif', '2021-06-30 21:08:38', '2021-06-30 23:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `gender`, `email`, `phone`, `ktp`, `status`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Franata', 'Laki-Laki', 'nata@gmail.com', '082106150324', '20210701074233_franata.jpg', 'aktif', 1, '2021-06-14 20:24:41', '2021-07-01 00:42:33'),
(2, 'Fando', 'Laki-Laki', 'fando@gmail.com', '082105214242', '20210701074012_fando.jpg', 'aktif', 4, '2021-06-14 20:32:25', '2021-07-01 00:40:12'),
(5, 'Hari Thanos', 'Laki-Laki', 'thanos@gmail.com', '082125291292', '20210701073902_hari-thanos.jpg', 'aktif', 5, '2021-06-14 20:37:22', '2021-07-01 00:39:02'),
(6, 'Adit', 'Perempuan', 'adit@gmail.com', '082157175901', '20210701074101_adit', 'aktif', 4, '2021-06-15 01:27:24', '2021-07-01 00:41:01'),
(7, 'Cak Hasan', 'Laki-Laki', 'nurhasan@gmail.com', '081295210529', '20210701073957_cak-hasan.jpg', 'aktif', 1, '2021-06-29 21:20:07', '2021-07-01 00:39:57'),
(8, 'Fando II', 'Perempuan', 'fando@gmail.com', '081275191299', '20210701072549_fando-ii.jpg', 'aktif', 5, '2021-07-01 00:25:49', '2021-07-01 00:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `product_stock_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `real_stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `variant_id`, `product_stock_id`, `price`, `stock`, `real_stock`, `created_at`, `updated_at`) VALUES
(17, 6, 1, 0, 0, 0, '2021-06-30 21:07:42', '2021-06-30 21:07:42'),
(18, 7, 1, 0, 0, 0, '2021-06-30 21:08:23', '2021-06-30 21:08:23'),
(19, 8, 1, 0, 0, 0, '2021-06-30 21:08:38', '2021-06-30 21:08:38'),
(20, 6, 3, 20000, 2, 96, '2021-06-30 21:41:51', '2021-07-01 22:35:52'),
(22, 6, 2, 10000, 1, 24, '2021-06-30 23:40:22', '2021-07-02 02:29:58'),
(23, 7, 2, 22000, 20, 480, '2021-06-30 23:41:59', '2021-07-01 01:26:46'),
(24, 7, 1, 15000, 100, 100, '2021-07-01 01:10:37', '2021-07-01 01:28:44'),
(25, 8, 3, 70000, 40, 1920, '2021-07-02 01:48:06', '2021-07-02 01:48:06'),
(26, 8, 3, 400000, 12, 576, '2021-07-02 01:49:38', '2021-07-02 02:26:34'),
(27, 6, 1, 17000, 36, 36, '2021-07-02 02:32:01', '2021-07-02 02:32:01'),
(28, 6, 2, 20000, 24, 576, '2021-07-02 02:37:41', '2021-07-02 02:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `stock_histories`
--

CREATE TABLE `stock_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_id` int(11) NOT NULL,
  `status` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_histories`
--

INSERT INTO `stock_histories` (`id`, `stock_id`, `status`, `quantity`, `created_at`, `updated_at`) VALUES
(47, 21, 'masuk', 2, '2021-06-30 21:43:08', '2021-06-30 21:43:08'),
(50, 22, 'masuk', 2, '2021-06-30 23:40:22', '2021-06-30 23:40:22'),
(55, 23, 'masuk', 20, '2021-07-01 01:26:46', '2021-07-01 01:26:46'),
(56, 24, 'masuk', 100, '2021-07-01 01:28:44', '2021-07-01 01:28:44'),
(57, 20, 'masuk', 14, '2021-07-01 01:29:45', '2021-07-01 01:29:45'),
(59, 20, 'keluar', 2, '2021-07-01 22:33:11', '2021-07-01 22:33:11'),
(60, 20, 'keluar', 10, '2021-07-01 22:35:52', '2021-07-01 22:35:52'),
(61, 25, 'masuk', 40, '2021-07-02 01:48:06', '2021-07-02 01:48:06'),
(66, 26, 'masuk', 12, '2021-07-02 02:26:34', '2021-07-02 02:26:34'),
(67, 22, 'keluar', 1, '2021-07-02 02:29:58', '2021-07-02 02:29:58'),
(68, 27, 'masuk', 36, '2021-07-02 02:32:01', '2021-07-02 02:32:01'),
(69, 28, 'masuk', 24, '2021-07-02 02:37:41', '2021-07-02 02:37:41'),
(70, 29, 'masuk', 24, '2021-07-02 02:38:08', '2021-07-02 02:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `branch_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_no`, `customer_id`, `date`, `time`, `branch_id`, `sales_id`, `admin_id`, `total`, `created_at`, `updated_at`) VALUES
(2, 'SO/0001', 3, '2021-07-02', '18:37:00', 1, 7, 1, 40000, '2021-07-01 22:33:11', '2021-07-01 22:33:11'),
(3, 'SO/0002', 3, '2021-07-02', '14:00:00', 1, 1, 1, 200000, '2021-07-01 22:35:51', '2021-07-01 22:35:51'),
(4, 'SO/0003', 4, '2021-07-02', '16:29:00', 1, 1, 1, 10000, '2021-07-02 02:29:58', '2021-07-02 02:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `variant_id`, `quantity`, `total`, `stock_id`, `transaction_id`, `created_at`, `updated_at`) VALUES
(2, 6, 2, 40000, 20, 2, '2021-07-01 22:33:11', '2021-07-01 22:33:11'),
(3, 6, 10, 200000, 20, 3, '2021-07-01 22:35:51', '2021-07-01 22:35:51'),
(4, 6, 1, 10000, 22, 4, '2021-07-02 02:29:58', '2021-07-02 02:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'adit', 'admin@ubi.com', NULL, '$2y$10$IPFsFU0jpcl2PB3cCcpdsuczwHTZG6cJykSMKcpH/2rnkl9CpkW06', NULL, '2021-06-07 23:00:07', '2021-06-07 23:00:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_stocks`
--
ALTER TABLE `branch_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_histories`
--
ALTER TABLE `stock_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `branch_stocks`
--
ALTER TABLE `branch_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `stock_histories`
--
ALTER TABLE `stock_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
