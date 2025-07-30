-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 05:43 PM
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
-- Database: `db_job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `activity_type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `activity_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 8, 'Pendaftaran Pelamar', 'abel mendaftar sebagai pelamar baru.', '2025-07-26 01:55:45', '2025-07-26 01:55:45'),
(2, 9, 'Pendaftaran Pelamar', 'rizki mendaftar sebagai pelamar baru.', '2025-07-26 04:28:37', '2025-07-26 04:28:37'),
(3, 10, 'Pendaftaran Pelamar', 'muna mendaftar sebagai pelamar baru.', '2025-07-29 12:48:26', '2025-07-29 12:48:26'),
(4, 11, 'Pendaftaran Pelamar', 'lia mendaftar sebagai pelamar baru.', '2025-07-29 12:58:19', '2025-07-29 12:58:19'),
(5, 12, 'Pendaftaran Pelamar', 'branzz mendaftar sebagai pelamar baru.', '2025-07-29 13:33:24', '2025-07-29 13:33:24'),
(6, 13, 'Pendaftaran Pelamar', 'abdul mendaftar sebagai pelamar baru.', '2025-07-29 13:49:23', '2025-07-29 13:49:23'),
(7, 14, 'Pendaftaran Pelamar', 'karim mendaftar sebagai pelamar baru.', '2025-07-29 13:51:56', '2025-07-29 13:51:56'),
(8, 15, 'Pendaftaran Pelamar', 'akmal mendaftar sebagai pelamar baru.', '2025-07-29 13:52:54', '2025-07-29 13:52:54'),
(9, 16, 'Pendaftaran Pelamar', 'tegar mendaftar sebagai pelamar baru.', '2025-07-29 13:53:53', '2025-07-29 13:53:53'),
(10, 17, 'Pendaftaran Pelamar', 'abel mendaftar sebagai pelamar baru.', '2025-07-30 03:08:38', '2025-07-30 03:08:38'),
(11, 18, 'Pendaftaran Pelamar', 'merlin mendaftar sebagai pelamar baru.', '2025-07-30 03:16:37', '2025-07-30 03:16:37'),
(12, 19, 'Pendaftaran Pelamar', 'bono mendaftar sebagai pelamar baru.', '2025-07-30 03:20:44', '2025-07-30 03:20:44'),
(13, 20, 'Pendaftaran Pelamar', 'ikmil mendaftar sebagai pelamar baru.', '2025-07-30 03:38:40', '2025-07-30 03:38:40'),
(14, 21, 'Pendaftaran Pelamar', 'ikmil mendaftar sebagai pelamar baru.', '2025-07-30 03:42:15', '2025-07-30 03:42:15'),
(15, 22, 'Pendaftaran Pelamar', 'nafa mendaftar sebagai pelamar baru.', '2025-07-30 03:55:17', '2025-07-30 03:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `bidang_keahlians`
--

CREATE TABLE `bidang_keahlians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bidang` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidang_keahlians`
--

INSERT INTO `bidang_keahlians` (`id`, `nama_bidang`, `created_at`, `updated_at`) VALUES
(1, 'Teknologi & Informasi', '2025-07-30 03:50:26', '2025-07-30 03:50:26'),
(2, 'Pemasaran & Penjualan', '2025-07-30 03:50:26', '2025-07-30 03:50:26'),
(3, 'Administrasi & Kantor', '2025-07-30 03:50:26', '2025-07-30 03:50:26'),
(4, 'Desain & Kreatif', '2025-07-30 03:50:26', '2025-07-30 03:50:26'),
(5, 'Keuangan & Akuntansi', '2025-07-30 03:50:26', '2025-07-30 03:50:26'),
(6, 'Manufaktur & Teknik', '2025-07-30 03:50:26', '2025-07-30 03:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keahlian`
--

CREATE TABLE `keahlian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bidang_keahlian_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_keahlian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keahlian`
--

INSERT INTO `keahlian` (`id`, `bidang_keahlian_id`, `nama_keahlian`) VALUES
(1, 1, 'HTML & CSS'),
(2, 1, 'JavaScript'),
(3, 1, 'PHP'),
(4, 1, 'Laravel'),
(5, 1, 'React.js'),
(6, 1, 'Vue.js'),
(7, 1, 'Node.js'),
(8, 1, 'Python'),
(9, 1, 'Java'),
(10, 1, 'Go'),
(11, 1, 'Database (MySQL/PostgreSQL)'),
(12, 1, 'API Development'),
(13, 1, 'UI/UX Design'),
(14, 1, 'Mobile Development (Android/iOS)'),
(15, 1, 'Cyber Security'),
(16, 2, 'Digital Marketing'),
(17, 2, 'Social Media Marketing'),
(18, 2, 'SEO/SEM'),
(19, 2, 'Content Marketing'),
(20, 2, 'Email Marketing'),
(21, 2, 'Sales & Negosiasi'),
(22, 2, 'Market Research'),
(23, 2, 'Branding'),
(24, 2, 'Customer Relationship Management (CRM)'),
(25, 2, 'Copywriting'),
(26, 3, 'Microsoft Office (Word, Excel, PowerPoint)'),
(27, 3, 'Google Workspace'),
(28, 3, 'Data Entry'),
(29, 3, 'Manajemen Arsip'),
(30, 3, 'Pengetikan Cepat'),
(31, 3, 'Administrasi Perkantoran'),
(32, 3, 'Customer Service'),
(33, 3, 'Manajemen Jadwal'),
(34, 4, 'Desain Grafis'),
(35, 4, 'Adobe Photoshop'),
(36, 4, 'Adobe Illustrator'),
(37, 4, 'Adobe Premiere Pro'),
(38, 4, 'Videografi'),
(39, 4, 'Fotografi'),
(40, 4, 'Animasi'),
(41, 4, 'Content Creation'),
(42, 5, 'Akuntansi Dasar'),
(43, 5, 'Perpajakan'),
(44, 5, 'Software Akuntansi (Accurate/Zahir)'),
(45, 5, 'Analisis Keuangan'),
(46, 5, 'Manajemen Anggaran'),
(47, 5, 'Audit'),
(48, 6, 'Mesin Produksi'),
(49, 6, 'Otomotif'),
(50, 6, 'Kelistrikan'),
(51, 6, 'Quality Control'),
(52, 6, 'Manajemen Gudang'),
(53, 6, 'K3 (Keselamatan dan Kesehatan Kerja)');

-- --------------------------------------------------------

--
-- Table structure for table `lamaran`
--

CREATE TABLE `lamaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelamar_id` bigint(20) UNSIGNED NOT NULL,
  `lowongan_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','dilihat','diterima','ditolak') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_keahlian_dibutuhkan`
--

CREATE TABLE `lowongan_keahlian_dibutuhkan` (
  `lowongan_id` bigint(20) UNSIGNED NOT NULL,
  `keahlian_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_pekerjaan`
--

CREATE TABLE `lowongan_pekerjaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `perusahaan_id` bigint(20) UNSIGNED NOT NULL,
  `judul_lowongan` varchar(255) NOT NULL,
  `deskripsi_pekerjaan` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2025_07_16_183400_create_sessions_table', 1),
(4, '2025_07_22_183554_create_profiles_perusahaan_table', 1),
(5, '2025_07_22_183607_create_profiles_pelamar_table', 1),
(6, '2025_07_22_183617_create_keahlian_table', 1),
(7, '2025_07_22_183627_create_pelamar_keahlian_table', 1),
(8, '2025_07_22_183634_create_lowongan_pekerjaan_table', 1),
(9, '2025_07_22_183641_create_lowongan_keahlian_dibutuhkan_table', 1),
(10, '2025_07_26_002818_create_activity_logs_table', 2),
(11, '2025_07_26_105512_update_fields_in_profiles_pelamar_table', 3),
(12, '2025_07_26_120921_create_lamaran_table', 4),
(13, '2025_07_30_104518_create_bidang_keahlians_table', 5),
(14, '2025_07_30_104825_add_bidang_to_keahlian_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelamar_keahlian`
--

CREATE TABLE `pelamar_keahlian` (
  `pelamar_id` bigint(20) UNSIGNED NOT NULL,
  `keahlian_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelamar_keahlian`
--

INSERT INTO `pelamar_keahlian` (`pelamar_id`, `keahlian_id`) VALUES
(13, 31),
(13, 49),
(13, 51),
(17, 26),
(17, 27),
(17, 48),
(17, 53);

-- --------------------------------------------------------

--
-- Table structure for table `profiles_pelamar`
--

CREATE TABLE `profiles_pelamar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `domisili` varchar(255) NOT NULL,
  `lulusan` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `pengalaman_kerja` varchar(255) DEFAULT NULL,
  `file_cv` varchar(255) DEFAULT NULL,
  `tentang_saya` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles_pelamar`
--

INSERT INTO `profiles_pelamar` (`id`, `user_id`, `nama_lengkap`, `nik`, `alamat`, `domisili`, `lulusan`, `no_hp`, `tanggal_lahir`, `gender`, `tahun_lulus`, `pengalaman_kerja`, `file_cv`, `tentang_saya`, `created_at`, `updated_at`) VALUES
(4, 9, 'rizki', '2345671829384776', 'Mranggen', 'Semarang', 'SMA/SMK Sederajat', '082328872084', '2003-01-14', 'Laki-laki', '2022', '1-3 Tahun', NULL, NULL, '2025-07-26 04:28:37', '2025-07-26 04:28:37'),
(5, 10, 'muna', '2345671829384789', 'demak', 'Semarang', 'SMP/Sederajat', '082328872084', '2025-07-18', 'Perempuan', '2023', '< 1 Tahun', NULL, NULL, '2025-07-29 12:48:26', '2025-07-29 12:48:26'),
(6, 11, 'lia', '2345671829384790', 'lamongan', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-18', 'Perempuan', '2021', 'Fresh Graduate', NULL, NULL, '2025-07-29 12:58:19', '2025-07-29 12:58:19'),
(7, 12, 'branzz', '2345671829384780', 'lamongan', 'lamongan', 'S1', '082328872084', '2025-07-18', 'Laki-laki', '2016', '> 5 Tahun', NULL, NULL, '2025-07-29 13:33:24', '2025-07-29 13:33:24'),
(8, 13, 'abdul', '2345671829384798', 'lamongan', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-03', 'Laki-laki', '2022', '1-3 Tahun', NULL, NULL, '2025-07-29 13:49:23', '2025-07-29 13:49:23'),
(9, 14, 'karim', '2345671829384707', 'lamongan', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-16', 'Laki-laki', '2021', 'Fresh Graduate', NULL, NULL, '2025-07-29 13:51:56', '2025-07-29 13:51:56'),
(10, 15, 'akmal', '2345671829384777', 'semarang', 'semarang', 'SMA/SMK Sederajat', '082328872084', '2025-07-24', 'Laki-laki', '2009', '< 1 Tahun', NULL, NULL, '2025-07-29 13:52:54', '2025-07-29 13:52:54'),
(11, 16, 'tegar', '2345671829384708', 'semarang', 'Semarang', 'SMA/SMK Sederajat', '082328872084', '2025-07-17', 'Laki-laki', '1986', '3-5 Tahun', NULL, NULL, '2025-07-29 13:53:53', '2025-07-29 13:53:53'),
(12, 17, 'abel', '2345671829363539', 'banyumanik', 'Semarang', 'D3', '082328872084', '2025-07-15', 'Laki-laki', '2011', 'Fresh Graduate', NULL, NULL, '2025-07-30 03:08:38', '2025-07-30 03:08:38'),
(13, 18, 'merlin', '2345671829384705', 'lamongan', 'lamongan', 'S1', '082328872084', '2025-07-01', 'Perempuan', '2013', '< 1 Tahun', 'cv/cnc4CjWEmeD9tMHHRCBYpEdgUigWu8g6Mjzsu0CZ.pdf', NULL, '2025-07-30 03:16:37', '2025-07-30 08:21:03'),
(14, 19, 'bono', '2345671829384730', 'lamongan', 'lamongan', 'D2', '082328872084', '2025-07-09', 'Laki-laki', '2009', 'Fresh Graduate', NULL, NULL, '2025-07-30 03:20:44', '2025-07-30 03:20:44'),
(15, 20, 'ikmil', '2345671829384722', 'semarang', 'Semarang', 'SMA/SMK Sederajat', '082328872084', '2025-07-15', 'Laki-laki', '2011', 'Fresh Graduate', NULL, NULL, '2025-07-30 03:38:40', '2025-07-30 03:38:40'),
(16, 21, 'ikmil', '2345671829384723', 'semarang', 'Semarang', 'SMA/SMK Sederajat', '082328872084', '2025-07-15', 'Laki-laki', '2011', 'Fresh Graduate', NULL, NULL, '2025-07-30 03:42:15', '2025-07-30 03:42:15'),
(17, 22, 'nafa', '2345671829384887', 'lamongan', 'Semarang', 'D2', '082328872084', '2025-07-24', 'Perempuan', '2008', '< 1 Tahun', NULL, NULL, '2025-07-30 03:55:17', '2025-07-30 03:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_perusahaan`
--

CREATE TABLE `profiles_perusahaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat_perusahaan` text DEFAULT NULL,
  `situs_web` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ws0jK6SExV6iDhY0AG8fyLAPspGW3rsyAyieOx8p', 18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieEVwV3RrZEd0SjR6ckIzQWxqSVZKNDhIM2RRWDRPSjZ2RTFwOW5IYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZWxhbWFyL3Byb2ZpbGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxODt9', 1753889977);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pelamar','perusahaan') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Mas Admin', 'admin@messari.com', '2025-07-24 17:02:14', '$2y$12$wft2UfJgDYHDEf2NM4uZlOYL0CRsaGmN6UuRDO1L9TZZNx/h4cBVa', 'admin', NULL, '2025-07-24 17:02:14', '2025-07-24 10:04:11'),
(3, 'akmal', 'akmalzaid24@gmail.com', NULL, '$2y$12$D.1QZlQ1dHG7ikg.gprZ4.qGFyLbb9VHJgLFS7/ASQSW93uKsNiB2', 'pelamar', NULL, '2025-07-24 11:43:24', '2025-07-24 11:43:24'),
(7, 'arryaduta', 'duta23@gmail.com', NULL, '$2y$12$gvOvbZvi4D5ndvMB5qEeU.gdP7JjxSYctz0xIdXuycgSsPTMzOZh.', 'pelamar', NULL, '2025-07-26 01:44:14', '2025-07-26 01:44:14'),
(8, 'abel', 'abel.24@gmail.com', NULL, '$2y$12$uQkOu8AMkd2UASxiH/X27.29jjbwBDRxVNMe/1O0RwPcrYBPndc7C', 'pelamar', NULL, '2025-07-26 01:55:45', '2025-07-26 01:55:45'),
(9, 'rizki', 'rizki.gaming@gmail.com', NULL, '$2y$12$Pq5W2d35lroeCrErLErH0uLuaJpQM3aqxxybZpUtDiQWD83UqEbVK', 'pelamar', NULL, '2025-07-26 04:28:37', '2025-07-26 04:28:37'),
(10, 'muna', 'muna@gmail.com', NULL, '$2y$12$OrItEZ8dPWb1fgMx.qL0t.fzTwY.pH7pnmeX8rw4tNF.fr.gswg6q', 'pelamar', NULL, '2025-07-29 12:48:25', '2025-07-29 12:48:25'),
(11, 'lia', 'lia@gmail.com', NULL, '$2y$12$A5PLPTnZwPe6sZVbuFwzCeoj47YQHJvtSVLFvlOwHtWZBK/Ks2Rt.', 'pelamar', NULL, '2025-07-29 12:58:19', '2025-07-29 12:58:19'),
(12, 'branzz', 'branzz@gmail.com', NULL, '$2y$12$g2yhM1Obfotf1sWDDInpM.KXVenq0YjqnmJeHkN7hvmB0alAC2iTu', 'pelamar', NULL, '2025-07-29 13:33:24', '2025-07-29 13:33:24'),
(13, 'abdul1', 'abdul@gmail.com', NULL, '$2y$12$jTEvrSlu0JLR3aKk1z4Vgeig3pK6kRbytzlqxxwvd5P.67uO2xOk6', 'pelamar', NULL, '2025-07-29 13:49:23', '2025-07-30 07:25:53'),
(14, 'karim', 'karim@gmail.com', NULL, '$2y$12$rUooEISy1mjEq9EHBCQvku7rUyopvqLk5n8p60nfNXDqejK7YcyKC', 'pelamar', NULL, '2025-07-29 13:51:56', '2025-07-29 13:51:56'),
(15, 'akmal', 'akmal.tbn@gmail.com', NULL, '$2y$12$pehlfVDJ3hEeRGwNjuTNaOIOJ3zx7Si737.BR0QP6ExjizteQopmq', 'pelamar', NULL, '2025-07-29 13:52:54', '2025-07-29 13:52:54'),
(16, 'tegar', 'tegar@gmail.com', NULL, '$2y$12$nzdH2cHiHgmio8h3N5XSZO7D9VJg9NI7iGnM3qXn8BjPw8qis7mkW', 'pelamar', NULL, '2025-07-29 13:53:53', '2025-07-29 13:53:53'),
(17, 'abel', 'abel24@gmail.com', NULL, '$2y$12$JKnXr/T5Tj5axkln.oTWH.Ot0HE3lKWD7AbHZPuG81079qcLitoW6', 'pelamar', NULL, '2025-07-30 03:08:37', '2025-07-30 03:08:37'),
(18, 'merlin', 'merlin@gmail.com', NULL, '$2y$12$W1YlIZhiLCR5IAoyzKWk/uMan2gUDNBhNLToAngzF0txpE8MY.4WO', 'pelamar', NULL, '2025-07-30 03:16:37', '2025-07-30 08:15:10'),
(19, 'bono', 'bono@gmail.com', NULL, '$2y$12$27iKGYAEgnGa/m2tyF8QQeJ/X9jSZd2eao7jkjAOx1ZOoEkJwnuUq', 'pelamar', NULL, '2025-07-30 03:20:44', '2025-07-30 03:20:44'),
(20, 'ikmil', 'ikmil@gmail.com', NULL, '$2y$12$An/Jz.AKu/lErWUr69hvQ./0USlOotGHnAr1wwPeQepws4.yTSKR6', 'pelamar', NULL, '2025-07-30 03:38:40', '2025-07-30 03:38:40'),
(21, 'ikmil', 'ikmal@gmail.com', NULL, '$2y$12$KwrHGey6/JPpLGq2iljeQetvfE/VsHCaIKDWdlRNtPvf4Irv6EToy', 'pelamar', NULL, '2025-07-30 03:42:15', '2025-07-30 03:42:15'),
(22, 'nafa', 'nafa@gmail.com', NULL, '$2y$12$DqoPQByfJBfjMhfe5SUG6OLjqfhY3bTzFnmfBeKGFSekRLfIrnpV.', 'pelamar', NULL, '2025-07-30 03:55:16', '2025-07-30 03:55:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `bidang_keahlians`
--
ALTER TABLE `bidang_keahlians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `keahlian`
--
ALTER TABLE `keahlian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keahlian_nama_keahlian_unique` (`nama_keahlian`);

--
-- Indexes for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lamaran_pelamar_id_foreign` (`pelamar_id`),
  ADD KEY `lamaran_lowongan_id_foreign` (`lowongan_id`);

--
-- Indexes for table `lowongan_keahlian_dibutuhkan`
--
ALTER TABLE `lowongan_keahlian_dibutuhkan`
  ADD PRIMARY KEY (`lowongan_id`,`keahlian_id`),
  ADD KEY `lowongan_keahlian_dibutuhkan_keahlian_id_foreign` (`keahlian_id`);

--
-- Indexes for table `lowongan_pekerjaan`
--
ALTER TABLE `lowongan_pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lowongan_pekerjaan_perusahaan_id_foreign` (`perusahaan_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelamar_keahlian`
--
ALTER TABLE `pelamar_keahlian`
  ADD PRIMARY KEY (`pelamar_id`,`keahlian_id`),
  ADD KEY `pelamar_keahlian_keahlian_id_foreign` (`keahlian_id`);

--
-- Indexes for table `profiles_pelamar`
--
ALTER TABLE `profiles_pelamar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_pelamar_nik_unique` (`nik`),
  ADD KEY `profiles_pelamar_user_id_foreign` (`user_id`);

--
-- Indexes for table `profiles_perusahaan`
--
ALTER TABLE `profiles_perusahaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_perusahaan_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bidang_keahlians`
--
ALTER TABLE `bidang_keahlians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `keahlian`
--
ALTER TABLE `keahlian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lowongan_pekerjaan`
--
ALTER TABLE `lowongan_pekerjaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profiles_pelamar`
--
ALTER TABLE `profiles_pelamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `profiles_perusahaan`
--
ALTER TABLE `profiles_perusahaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD CONSTRAINT `lamaran_lowongan_id_foreign` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan_pekerjaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lamaran_pelamar_id_foreign` FOREIGN KEY (`pelamar_id`) REFERENCES `profiles_pelamar` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lowongan_keahlian_dibutuhkan`
--
ALTER TABLE `lowongan_keahlian_dibutuhkan`
  ADD CONSTRAINT `lowongan_keahlian_dibutuhkan_keahlian_id_foreign` FOREIGN KEY (`keahlian_id`) REFERENCES `keahlian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lowongan_keahlian_dibutuhkan_lowongan_id_foreign` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan_pekerjaan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lowongan_pekerjaan`
--
ALTER TABLE `lowongan_pekerjaan`
  ADD CONSTRAINT `lowongan_pekerjaan_perusahaan_id_foreign` FOREIGN KEY (`perusahaan_id`) REFERENCES `profiles_perusahaan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelamar_keahlian`
--
ALTER TABLE `pelamar_keahlian`
  ADD CONSTRAINT `pelamar_keahlian_keahlian_id_foreign` FOREIGN KEY (`keahlian_id`) REFERENCES `keahlian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pelamar_keahlian_pelamar_id_foreign` FOREIGN KEY (`pelamar_id`) REFERENCES `profiles_pelamar` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles_pelamar`
--
ALTER TABLE `profiles_pelamar`
  ADD CONSTRAINT `profiles_pelamar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles_perusahaan`
--
ALTER TABLE `profiles_perusahaan`
  ADD CONSTRAINT `profiles_perusahaan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
