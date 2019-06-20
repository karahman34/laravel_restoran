-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2019 at 03:52 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auditable_id` bigint(20) UNSIGNED NOT NULL,
  `old_values` text COLLATE utf8mb4_unicode_ci,
  `new_values` text COLLATE utf8mb4_unicode_ci,
  `url` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audits`
--

INSERT INTO `audits` (`id`, `user_type`, `user_id`, `event`, `auditable_type`, `auditable_id`, `old_values`, `new_values`, `url`, `ip_address`, `user_agent`, `tags`, `created_at`, `updated_at`) VALUES
(1, 'App\\User', 1, 'updated', 'App\\Masakan', 2, '{\"harga\":50000}', '{\"harga\":\"35000\"}', 'http://localhost:8000/masakan/2?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 16:46:33', '2019-06-18 16:46:33'),
(2, 'App\\User', 1, 'updated', 'App\\Masakan', 4, '{\"deskripsi\":\"Memakai Jeruk muda\",\"harga\":7000}', '{\"deskripsi\":\"Es Kelapa Jeruk Dengan kelapa muda\",\"harga\":\"7500\"}', 'http://localhost:8000/masakan/4?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 17:41:57', '2019-06-18 17:41:57'),
(3, 'App\\User', 1, 'updated', 'App\\User', 2, '{\"avatar\":\"img\\/avatars\\/3HsarRviUhh5GCEP53j3Z816HvTLemHvpHPkH2Hu.jpeg\"}', '{\"avatar\":\"img\\/avatars\\/f9wXTAc39SYvgHVhBQIDJw6ch0Jj6fKbh7cKeLm1.jpeg\"}', 'http://localhost:8000/user_management/user/2?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 18:00:22', '2019-06-18 18:00:22'),
(7, 'App\\User', 1, 'updated', 'App\\Role', 5, '{\"name\":\"pelanggan\"}', '{\"name\":\"pelanggann\"}', 'http://localhost:8000/user_management/role/5?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:02:47', '2019-06-18 19:02:47'),
(8, 'App\\User', 1, 'updated', 'App\\Role', 5, '{\"name\":\"pelanggann\"}', '{\"name\":\"pelanggan\"}', 'http://localhost:8000/user_management/role/5?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:02:52', '2019-06-18 19:02:52'),
(11, 'App\\User', 1, 'updated', 'App\\Permission', 25, '{\"name\":\"cart-add\"}', '{\"name\":\"cart-addm\"}', 'http://localhost:8000/user_management/permission/25?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:09:07', '2019-06-18 19:09:07'),
(12, 'App\\User', 1, 'updated', 'App\\Permission', 25, '{\"name\":\"cart-addm\"}', '{\"name\":\"cart-add\"}', 'http://localhost:8000/user_management/permission/25?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:09:25', '2019-06-18 19:09:25'),
(13, 'App\\User', 1, 'created', 'App\\Permission', 35, '[]', '{\"name\":\"sat\",\"guard_name\":\"web\",\"id\":35}', 'http://localhost:8000/user_management/permission?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:12:44', '2019-06-18 19:12:44'),
(14, 'App\\User', 1, 'deleted', 'App\\Permission', 35, '{\"id\":35,\"name\":\"sat\",\"guard_name\":\"web\"}', '[]', 'http://localhost:8000/user_management/permission/35?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:12:55', '2019-06-18 19:12:55'),
(15, 'App\\User', 1, 'created', 'App\\Role', 6, '[]', '{\"name\":\"role baru\",\"guard_name\":\"web\",\"id\":6}', 'http://localhost:8000/user_management/role?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:13:26', '2019-06-18 19:13:26'),
(16, 'App\\User', 1, 'updated', 'App\\Role', 6, '{\"name\":\"role baru\"}', '{\"name\":\"baru\"}', 'http://localhost:8000/user_management/role/6?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:13:33', '2019-06-18 19:13:33'),
(17, 'App\\User', 1, 'deleted', 'App\\Role', 6, '{\"id\":6,\"name\":\"baru\",\"guard_name\":\"web\"}', '[]', 'http://localhost:8000/user_management/role/6?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:13:39', '2019-06-18 19:13:39'),
(18, 'App\\User', 1, 'created', 'App\\Transaksi', 1, '[]', '{\"user_id\":1,\"order_id\":\"1\",\"total_bayar\":\"150000\",\"id\":1}', 'http://localhost:8000/transaksi?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:20:17', '2019-06-18 19:20:17'),
(19, 'App\\User', 1, 'updated', 'App\\Order', 1, '{\"status_order\":0}', '{\"status_order\":1}', 'http://localhost:8000/transaksi?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-18 19:20:17', '2019-06-18 19:20:17'),
(20, 'App\\User', 1, 'created', 'App\\Order', 2, '[]', '{\"no_meja\":\"7\",\"user_id\":1,\"id\":2}', 'http://localhost:8000/order?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-19 16:44:57', '2019-06-19 16:44:57'),
(21, 'App\\User', 1, 'created', 'App\\detOrder', 4, '[]', '{\"order_id\":2,\"masakan_id\":8,\"keterangan\":\"yang cepet ya dah lapar\",\"jumlah\":\"2\",\"id\":4}', 'http://localhost:8000/order?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-19 16:44:57', '2019-06-19 16:44:57'),
(22, 'App\\User', 1, 'updated', 'App\\User', 2, '{\"nama_user\":\"user baru\"}', '{\"nama_user\":\"user pertama\"}', 'http://localhost:8000/user_management/user/2?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-19 16:45:41', '2019-06-19 16:45:41'),
(23, 'App\\User', 1, 'created', 'App\\Transaksi', 2, '[]', '{\"user_id\":1,\"order_id\":\"2\",\"total_bayar\":\"50000\",\"id\":2}', 'http://localhost:8000/transaksi?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-19 16:46:26', '2019-06-19 16:46:26'),
(24, 'App\\User', 1, 'updated', 'App\\Order', 2, '{\"status_order\":0}', '{\"status_order\":1}', 'http://localhost:8000/transaksi?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-19 16:46:26', '2019-06-19 16:46:26'),
(25, 'App\\User', 1, 'updated', 'App\\User', 1, '{\"remember_token\":\"wt0HnR0edqNWvGIL43WVjymFb1msrqy6CDJVtoKABkJbJyxDquQPMg7EqWGp\"}', '{\"remember_token\":\"xDKtGcImFhxgnO80mJUEGHHePQgutrunkUKMcRyUM6PtPXUy4sfndxrGy1kk\"}', 'http://localhost:8000/logout?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-19 16:47:53', '2019-06-19 16:47:53'),
(26, 'App\\User', 1, 'created', 'App\\Order', 3, '[]', '{\"no_meja\":\"7\",\"user_id\":1,\"id\":3}', 'http://localhost:8000/order?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-19 19:10:16', '2019-06-19 19:10:16'),
(27, 'App\\User', 1, 'created', 'App\\detOrder', 5, '[]', '{\"order_id\":3,\"masakan_id\":4,\"keterangan\":null,\"jumlah\":\"1\",\"id\":5}', 'http://localhost:8000/order?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', NULL, '2019-06-19 19:10:17', '2019-06-19 19:10:17'),
(28, 'App\\User', 1, 'created', 'App\\Transaksi', 3, '[]', '{\"user_id\":1,\"order_id\":\"3\",\"total_bayar\":\"7500\",\"id\":3}', 'http://localhost:8000/transaksi?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 00:49:05', '2019-06-20 00:49:05'),
(29, 'App\\User', 1, 'updated', 'App\\Order', 3, '{\"status_order\":0}', '{\"status_order\":1}', 'http://localhost:8000/transaksi?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 00:49:05', '2019-06-20 00:49:05'),
(30, 'App\\User', 1, 'updated', 'App\\Masakan', 1, '{\"image\":\"img\\/masakans\\/NDPlfz6fNXfrVAznQl4UZ2Wbs60yndgqmln69JUi.jpeg\"}', '{\"image\":\"img\\/masakans\\/pIMA9EYxkUHTgN2pIicOGCmJyrOtnyeJgWV5NkQ2.jpeg\"}', 'http://localhost:8000/masakan/1?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:45:58', '2019-06-20 06:45:58'),
(31, 'App\\User', 1, 'updated', 'App\\Masakan', 2, '{\"image\":\"img\\/masakans\\/F0wocxqoGULmknIeFdGGJVTc4g5VrXJ7lNwJI93K.jpeg\"}', '{\"image\":\"img\\/masakans\\/SbS30ZFfFSleVxcwuS8dYHhYIzRETmosW1xVrxYb.jpeg\"}', 'http://localhost:8000/masakan/2?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:46:07', '2019-06-20 06:46:07'),
(32, 'App\\User', 1, 'created', 'App\\Permission', 35, '[]', '{\"name\":\"kn\",\"guard_name\":\"web\",\"id\":35}', 'http://localhost:8000/user_management/permission?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:49:09', '2019-06-20 06:49:09'),
(33, 'App\\User', 1, 'deleted', 'App\\Permission', 35, '{\"id\":35,\"name\":\"kn\",\"guard_name\":\"web\"}', '[]', 'http://localhost:8000/user_management/permission/35?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:49:18', '2019-06-20 06:49:18'),
(34, 'App\\User', 1, 'created', 'App\\Permission', 36, '[]', '{\"name\":\"masakan-import\",\"guard_name\":\"web\",\"id\":36}', 'http://localhost:8000/user_management/permission?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:50:15', '2019-06-20 06:50:15'),
(35, 'App\\User', 1, 'created', 'App\\Permission', 37, '[]', '{\"name\":\"user-import\",\"guard_name\":\"web\",\"id\":37}', 'http://localhost:8000/user_management/permission?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:50:27', '2019-06-20 06:50:27'),
(36, 'App\\User', 1, 'created', 'App\\Permission', 38, '[]', '{\"name\":\"permission-import\",\"guard_name\":\"web\",\"id\":38}', 'http://localhost:8000/user_management/permission?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:50:40', '2019-06-20 06:50:40'),
(37, 'App\\User', 1, 'created', 'App\\Permission', 39, '[]', '{\"name\":\"role-import\",\"guard_name\":\"web\",\"id\":39}', 'http://localhost:8000/user_management/permission?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:50:45', '2019-06-20 06:50:45'),
(38, 'App\\User', 1, 'created', 'App\\Permission', 40, '[]', '{\"name\":\"order-import\",\"guard_name\":\"web\",\"id\":40}', 'http://localhost:8000/user_management/permission?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:51:01', '2019-06-20 06:51:01'),
(39, 'App\\User', 1, 'created', 'App\\Permission', 41, '[]', '{\"name\":\"transaksi-import\",\"guard_name\":\"web\",\"id\":41}', 'http://localhost:8000/user_management/permission?', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', NULL, '2019-06-20 06:51:07', '2019-06-20 06:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `detail_orders`
--

CREATE TABLE `detail_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `masakan_id` int(10) UNSIGNED NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `status_detail_order` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_orders`
--

INSERT INTO `detail_orders` (`id`, `order_id`, `masakan_id`, `keterangan`, `jumlah`, `status_detail_order`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, 2, 1, '2019-06-18 15:56:32', '2019-06-18 15:57:54'),
(2, 1, 1, 'Sausnya yang banyak ya', 1, 1, '2019-06-18 15:56:32', '2019-06-18 15:57:54'),
(3, 1, 7, NULL, 2, 1, '2019-06-18 15:56:32', '2019-06-18 15:57:54'),
(4, 2, 8, 'yang cepet ya dah lapar', 2, 1, '2019-06-19 16:44:57', '2019-06-19 16:45:55'),
(5, 3, 4, NULL, 1, 0, '2019-06-19 19:10:16', '2019-06-19 19:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `masakans`
--

CREATE TABLE `masakans` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_masakan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `status_masakan` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masakans`
--

INSERT INTO `masakans` (`id`, `image`, `nama_masakan`, `deskripsi`, `kategori`, `harga`, `status_masakan`, `created_at`, `updated_at`) VALUES
(1, 'img/masakans/pIMA9EYxkUHTgN2pIicOGCmJyrOtnyeJgWV5NkQ2.jpeg', 'Gurame Saus Asam Manis', 'Gurame yang dibuat dengan cinta..', 'makanan', 95000, 1, '2019-06-19 07:39:19', '2019-06-20 06:45:58'),
(2, 'img/masakans/SbS30ZFfFSleVxcwuS8dYHhYIzRETmosW1xVrxYb.jpeg', 'Cumi Saus Tiram', 'Cumi dari laut', 'makanan', 35000, 1, '2019-06-19 07:41:04', '2019-06-20 06:46:07'),
(3, 'img/masakans/d0DPzX7pdwSO0LDzmOrlNNUcRBlVcDdVkb1c8Ce7.jpeg', 'Es Kelapa Muda', 'Es Kelapa Muda Dingin', 'minuman', 5000, 1, '2019-06-19 07:42:05', '2019-06-19 07:42:05'),
(4, 'img/masakans/bQQSIXlWXc4CIdd2CN9EnUz49SiHjfIzP7LGG7Q0.jpeg', 'Es Kelapa Jeruk', 'Es Kelapa Jeruk Dengan kelapa muda', 'minuman', 7500, 1, '2019-06-19 07:43:46', '2019-06-18 17:41:57'),
(5, 'img/masakans/gGZGCmpYcSdyceGjB90NeeolEA9YiiFxXTUhhWRh.jpeg', 'Ayam Goreng', '3 pcs ayam goreng', 'makanan', 4000, 1, '2019-06-19 07:44:40', '2019-06-19 07:44:40'),
(6, 'img/masakans/RyQ0xmHSLiInnh9oFYzVn52svl2vhfIBFp36RIJE.jpeg', 'Smashburger', 'awd', 'makanan', 45000, 1, '2019-06-19 07:45:54', '2019-06-19 07:45:54'),
(7, 'img/masakans/JuntT0SFpcMLj0b1HJIBgeRPGNZoqOmZfPHBNxCI.jpeg', 'Cheeseburger', '1 pcs Cheese burger', 'makanan', 20000, 1, '2019-06-19 07:46:37', '2019-06-19 07:46:37'),
(8, 'img/masakans/kYjzinYjd1q6jjWYkNTaRavTErraDSgaIqLT9BBB.jpeg', 'Ayam Geprek Yogja', '1pcs ayam geprek', 'makanan', 25000, 1, '2019-06-19 07:47:34', '2019-06-19 07:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_09_055202_create_masakans_table', 1),
(4, '2019_02_09_055214_create_orders_table', 1),
(5, '2019_02_09_055226_create_det_orders_table', 1),
(6, '2019_02_09_055237_create_transaksis_table', 1),
(7, '2019_06_18_001252_create_permission_tables', 1),
(8, '2019_06_18_234120_create_audits_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 2),
(5, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `no_meja` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status_order` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `no_meja`, `user_id`, `status_order`, `created_at`, `updated_at`) VALUES
(1, '3', 3, 1, '2019-06-18 15:56:32', '2019-06-18 19:20:17'),
(2, '7', 1, 1, '2019-06-19 16:44:57', '2019-06-19 16:46:26'),
(3, '7', 1, 1, '2019-06-19 19:10:16', '2019-06-20 00:49:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-add', 'web', '2019-06-18 15:31:27', '2019-06-18 15:31:27'),
(2, 'role-view', 'web', '2019-06-18 15:31:34', '2019-06-18 15:31:34'),
(3, 'role-edit', 'web', '2019-06-18 15:31:41', '2019-06-18 15:31:41'),
(4, 'role-delete', 'web', '2019-06-18 15:31:47', '2019-06-18 15:31:47'),
(5, 'role-export', 'web', '2019-06-18 15:31:53', '2019-06-18 15:31:53'),
(6, 'user-add', 'web', '2019-06-18 15:32:35', '2019-06-18 15:32:35'),
(7, 'user-edit', 'web', '2019-06-18 15:32:41', '2019-06-18 15:32:41'),
(8, 'user-delete', 'web', '2019-06-18 15:32:49', '2019-06-18 15:32:49'),
(9, 'user-export', 'web', '2019-06-18 15:32:54', '2019-06-18 15:32:54'),
(10, 'user-view', 'web', '2019-06-18 15:33:05', '2019-06-18 15:33:05'),
(11, 'permission-add', 'web', '2019-06-18 15:33:12', '2019-06-18 15:33:12'),
(12, 'permission-edit', 'web', '2019-06-18 15:33:21', '2019-06-18 15:33:21'),
(13, 'permission-delete', 'web', '2019-06-18 15:33:31', '2019-06-18 15:33:31'),
(14, 'permission-view', 'web', '2019-06-18 15:33:47', '2019-06-18 15:33:47'),
(15, 'permission-export', 'web', '2019-06-18 15:33:55', '2019-06-18 15:33:55'),
(16, 'masakan-add', 'web', '2019-06-18 15:34:04', '2019-06-18 15:34:04'),
(17, 'masakan-edit', 'web', '2019-06-18 15:34:10', '2019-06-18 15:34:10'),
(18, 'masakan-export', 'web', '2019-06-18 15:34:18', '2019-06-18 15:34:18'),
(19, 'masakan-delete', 'web', '2019-06-18 15:34:24', '2019-06-18 15:34:24'),
(20, 'masakan-view', 'web', '2019-06-18 15:34:32', '2019-06-18 15:34:32'),
(21, 'order-add', 'web', '2019-06-18 15:34:46', '2019-06-18 15:34:46'),
(22, 'order-view', 'web', '2019-06-18 15:35:07', '2019-06-18 15:35:07'),
(23, 'order-edit', 'web', '2019-06-18 15:35:15', '2019-06-18 15:35:15'),
(24, 'cart-view', 'web', '2019-06-18 15:35:36', '2019-06-18 15:35:36'),
(25, 'cart-add', 'web', '2019-06-18 15:35:42', '2019-06-18 19:09:25'),
(26, 'cart-delete', 'web', '2019-06-18 15:35:48', '2019-06-18 19:03:11'),
(27, 'cart-edit', 'web', '2019-06-18 15:35:57', '2019-06-18 15:35:57'),
(28, 'detail_order-edit', 'web', '2019-06-18 15:36:16', '2019-06-18 15:36:16'),
(29, 'transaksi-add', 'web', '2019-06-18 15:36:54', '2019-06-18 15:36:54'),
(30, 'transaksi-edit', 'web', '2019-06-18 15:37:03', '2019-06-18 15:37:03'),
(31, 'transaksi-delete', 'web', '2019-06-18 15:37:10', '2019-06-18 15:37:10'),
(32, 'transaksi-export', 'web', '2019-06-18 15:37:16', '2019-06-18 15:37:16'),
(33, 'transaksi-view', 'web', '2019-06-18 15:37:33', '2019-06-18 15:37:33'),
(34, 'order-export', 'web', '2019-06-18 15:45:29', '2019-06-18 15:45:29'),
(36, 'masakan-import', 'web', '2019-06-20 06:50:15', '2019-06-20 06:50:15'),
(37, 'user-import', 'web', '2019-06-20 06:50:27', '2019-06-20 06:50:27'),
(38, 'permission-import', 'web', '2019-06-20 06:50:40', '2019-06-20 06:50:40'),
(39, 'role-import', 'web', '2019-06-20 06:50:45', '2019-06-20 06:50:45'),
(40, 'order-import', 'web', '2019-06-20 06:51:01', '2019-06-20 06:51:01'),
(41, 'transaksi-import', 'web', '2019-06-20 06:51:07', '2019-06-20 06:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2019-06-18 15:24:58', '2019-06-18 15:24:58'),
(2, 'waiter', 'web', '2019-06-18 15:25:07', '2019-06-18 15:25:07'),
(3, 'kasir', 'web', '2019-06-18 15:25:12', '2019-06-18 15:25:12'),
(4, 'owner', 'web', '2019-06-18 15:25:15', '2019-06-18 15:25:15'),
(5, 'pelanggan', 'web', '2019-06-18 15:25:18', '2019-06-18 19:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 4),
(3, 1),
(4, 1),
(5, 1),
(5, 4),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(10, 1),
(10, 2),
(10, 3),
(10, 4),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(14, 4),
(15, 1),
(15, 3),
(15, 4),
(16, 1),
(17, 1),
(18, 1),
(18, 2),
(18, 3),
(18, 4),
(19, 1),
(20, 1),
(20, 2),
(20, 3),
(20, 4),
(21, 1),
(21, 2),
(21, 5),
(22, 1),
(22, 2),
(22, 3),
(22, 4),
(23, 1),
(24, 1),
(24, 2),
(24, 3),
(24, 4),
(24, 5),
(25, 1),
(25, 2),
(25, 5),
(26, 1),
(26, 2),
(26, 5),
(27, 1),
(27, 2),
(27, 5),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(29, 3),
(30, 1),
(30, 3),
(31, 1),
(31, 3),
(32, 1),
(32, 2),
(32, 3),
(32, 4),
(33, 1),
(33, 2),
(33, 3),
(33, 4),
(34, 1),
(34, 2),
(34, 3),
(34, 4),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `total_bayar` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `user_id`, `order_id`, `total_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 150000, '2019-06-18 19:20:17', '2019-06-18 19:20:17'),
(2, 1, 2, 50000, '2019-06-19 16:46:26', '2019-06-19 16:46:26'),
(3, 1, 3, 7500, '2019-06-20 00:49:04', '2019-06-20 00:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `avatar`, `username`, `password`, `nama_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'img/avatars/zero.png', 'admin12', '$2y$10$kraz3x1ws3Ab7jxbwS4LIuC10S25ktCJT3KfmPp2Q5YYpe/ICRVpm', 'Administrator', 'xDKtGcImFhxgnO80mJUEGHHePQgutrunkUKMcRyUM6PtPXUy4sfndxrGy1kk', '2019-06-18 15:23:28', '2019-06-18 15:23:28'),
(2, 'img/avatars/f9wXTAc39SYvgHVhBQIDJw6ch0Jj6fKbh7cKeLm1.jpeg', 'baru12', '$2y$10$RO6AyxtYjN.r/41mfJ3U/.jR27chvnuVOiVWiwTJL7iVKg1Bw2nfi', 'user pertama', NULL, '2019-06-18 15:40:31', '2019-06-19 16:45:41'),
(3, 'img/avatars/y7CEE2IE4QrAeEVSaBjOXZfwqdQDkmE8xZQmPl4M.jpeg', 'pelanggan1', '$2y$10$9Qfr2UKEa2xcNN2nD8P4Se10hd2C2XeDogv0WEkuIjYdFZmPg6P1e', 'Pelanggan1', NULL, '2019-06-18 15:41:20', '2019-06-18 15:41:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  ADD KEY `audits_user_id_user_type_index` (`user_id`,`user_type`);

--
-- Indexes for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_orders_order_id_foreign` (`order_id`),
  ADD KEY `detail_orders_masakan_id_foreign` (`masakan_id`);

--
-- Indexes for table `masakans`
--
ALTER TABLE `masakans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_user_id_foreign` (`user_id`),
  ADD KEY `transaksis_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `masakans`
--
ALTER TABLE `masakans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD CONSTRAINT `detail_orders_masakan_id_foreign` FOREIGN KEY (`masakan_id`) REFERENCES `masakans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
