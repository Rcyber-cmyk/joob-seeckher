-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2025 at 01:07 PM
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
-- Database: `db_job_portal_update`
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
(15, 22, 'Pendaftaran Pelamar', 'nafa mendaftar sebagai pelamar baru.', '2025-07-30 03:55:17', '2025-07-30 03:55:17'),
(16, 23, 'Pendaftaran Pelamar', 'zaid mendaftar sebagai pelamar baru.', '2025-07-30 09:06:25', '2025-07-30 09:06:25'),
(17, 24, 'Pendaftaran Pelamar', 'zaid mendaftar sebagai pelamar baru.', '2025-07-30 09:13:20', '2025-07-30 09:13:20'),
(18, 25, 'Pendaftaran Pelamar', 'zaid mendaftar sebagai pelamar baru.', '2025-07-30 09:15:16', '2025-07-30 09:15:16'),
(19, 26, 'Pendaftaran Pelamar', 'zaid mendaftar sebagai pelamar baru.', '2025-07-30 09:20:29', '2025-07-30 09:20:29'),
(20, 27, 'Pendaftaran Pelamar', 'stel mendaftar sebagai pelamar baru.', '2025-07-30 09:21:30', '2025-07-30 09:21:30'),
(21, 28, 'Pendaftaran Pelamar', 'baba mendaftar sebagai pelamar baru.', '2025-07-30 09:24:09', '2025-07-30 09:24:09'),
(22, 29, 'Pendaftaran Pelamar', 'mama mendaftar sebagai pelamar baru.', '2025-07-30 09:27:15', '2025-07-30 09:27:15'),
(23, 30, 'Pendaftaran Pelamar', 'mimi mendaftar sebagai pelamar baru.', '2025-07-30 09:33:50', '2025-07-30 09:33:50'),
(24, 31, 'Pendaftaran Pelamar', 'momo mendaftar sebagai pelamar baru.', '2025-07-30 09:48:49', '2025-07-30 09:48:49'),
(25, 32, 'Pendaftaran Pelamar', 'mumu mendaftar sebagai pelamar baru.', '2025-07-30 10:16:31', '2025-07-30 10:16:31'),
(26, 34, 'Pendaftaran Pelamar', 'dika mendaftar sebagai pelamar baru.', '2025-07-31 08:26:19', '2025-07-31 08:26:19'),
(27, 35, 'Pendaftaran Pelamar', 'ini mendaftar sebagai pelamar baru.', '2025-07-31 08:39:27', '2025-07-31 08:39:27'),
(28, 36, 'Pendaftaran Pelamar', 'inu mendaftar sebagai pelamar baru.', '2025-07-31 09:17:11', '2025-07-31 09:17:11'),
(29, 37, 'Pendaftaran Pelamar', 'unu mendaftar sebagai pelamar baru.', '2025-07-31 10:21:31', '2025-07-31 10:21:31'),
(30, 38, 'Pendaftaran Pelamar', 'ono mendaftar sebagai pelamar baru.', '2025-07-31 10:54:27', '2025-07-31 10:54:27'),
(31, 40, 'Pendaftaran Perusahaan', 'telkom mendaftar sebagai perusahaan baru.', '2025-07-31 11:12:30', '2025-07-31 11:12:30'),
(32, 41, 'Pendaftaran Perusahaan', 'telkom mendaftar sebagai perusahaan baru.', '2025-07-31 11:23:43', '2025-07-31 11:23:43'),
(33, 42, 'Pendaftaran Perusahaan', 'indo mendaftar sebagai perusahaan baru.', '2025-07-31 11:28:40', '2025-07-31 11:28:40'),
(34, 43, 'Pendaftaran Pelamar', 'ine mendaftar sebagai pelamar baru.', '2025-07-31 11:29:55', '2025-07-31 11:29:55'),
(35, 44, 'Pendaftaran Perusahaan', 'indu mendaftar sebagai perusahaan baru.', '2025-07-31 11:34:53', '2025-07-31 11:34:53'),
(36, 45, 'Pendaftaran Pelamar', 'stel2 mendaftar sebagai pelamar baru.', '2025-07-31 11:37:23', '2025-07-31 11:37:23'),
(37, 46, 'Pendaftaran Pelamar', 'Anda mendaftar sebagai pelamar baru.', '2025-08-01 02:56:12', '2025-08-01 02:56:12'),
(38, 47, 'Pendaftaran Perusahaan', 'RAquaticus mendaftar sebagai perusahaan baru.', '2025-08-01 02:57:40', '2025-08-01 02:57:40'),
(39, 48, 'Pendaftaran Pelamar', 'Maulana Aditia mendaftar sebagai pelamar baru.', '2025-08-01 06:43:06', '2025-08-01 06:43:06'),
(40, 49, 'Pendaftaran Perusahaan', 'PT.ABADI mendaftar sebagai perusahaan baru.', '2025-08-01 07:53:30', '2025-08-01 07:53:30'),
(41, 50, 'Pendaftaran Perusahaan', 'PT.RAMKOM mendaftar sebagai perusahaan baru.', '2025-08-01 16:40:39', '2025-08-01 16:40:39'),
(42, 51, 'Pendaftaran Pelamar', 'Mayamaria mendaftar sebagai pelamar baru.', '2025-08-02 11:24:13', '2025-08-02 11:24:13'),
(43, 52, 'Pendaftaran Perusahaan', 'BataRingan mendaftar sebagai perusahaan baru.', '2025-08-05 06:13:47', '2025-08-05 06:13:47'),
(44, 53, 'Pendaftaran Perusahaan', 'PT.VictorRacket mendaftar sebagai perusahaan baru.', '2025-08-06 05:37:44', '2025-08-06 05:37:44'),
(45, NULL, 'Pendaftaran Pelamar', 'Arrya Duta mendaftar sebagai pelamar baru.', '2025-08-07 13:41:27', '2025-08-07 13:41:27'),
(46, 55, 'Pendaftaran UMKM', 'cilok (pemilik: branzz) mendaftar sebagai UMKM baru.', '2025-08-13 02:32:15', '2025-08-13 02:32:15'),
(47, 56, 'Pendaftaran Pelamar', 'uhuy mendaftar sebagai pelamar baru.', '2025-08-13 02:45:19', '2025-08-13 02:45:19'),
(48, 57, 'Pendaftaran UMKM', 'bakso (pemilik: akmal) mendaftar sebagai UMKM baru.', '2025-08-13 10:50:33', '2025-08-13 10:50:33'),
(49, 58, 'Pendaftaran UMKM', 'pukis (pemilik: kempung) mendaftar sebagai UMKM baru.', '2025-08-13 10:53:07', '2025-08-13 10:53:07'),
(50, 59, 'Pendaftaran Pelamar', 'uhuy mendaftar sebagai pelamar baru.', '2025-08-13 11:04:03', '2025-08-13 11:04:03'),
(51, 61, 'Pendaftaran Pelamar', 'ahah mendaftar sebagai pelamar baru.', '2025-08-13 12:28:17', '2025-08-13 12:28:17'),
(52, 62, 'Pendaftaran Pelamar', 'mumu mendaftar sebagai pelamar baru.', '2025-08-13 12:32:12', '2025-08-13 12:32:12'),
(53, 63, 'Pendaftaran Pelamar', 'mami mendaftar sebagai pelamar baru.', '2025-08-13 12:36:01', '2025-08-13 12:36:01'),
(54, 64, 'Pendaftaran Perusahaan', 'branzzstudio mendaftar sebagai perusahaan baru.', '2025-08-13 12:36:53', '2025-08-13 12:36:53'),
(55, 65, 'Pendaftaran UMKM', 'burjo mendaftar sebagai UMKM baru.', '2025-08-13 12:38:07', '2025-08-13 12:38:07'),
(56, 66, 'Pendaftaran Pelamar', 'mimo mendaftar sebagai pelamar baru.', '2025-08-13 12:57:21', '2025-08-13 12:57:21'),
(57, 67, 'Pendaftaran UMKM', 'angkringan mendaftar sebagai UMKM baru.', '2025-08-15 07:09:18', '2025-08-15 07:09:18'),
(58, 68, 'Pendaftaran Pelamar', 'mumi mendaftar sebagai pelamar baru.', '2025-08-18 21:51:51', '2025-08-18 21:51:51'),
(59, NULL, 'Pendaftaran Pelamar', 'cuci mendaftar sebagai pelamar baru.', '2025-08-19 03:28:20', '2025-08-19 03:28:20'),
(60, 70, 'Pendaftaran Pelamar', 'merlina mendaftar sebagai pelamar baru.', '2025-08-19 03:54:54', '2025-08-19 03:54:54'),
(61, 71, 'Pendaftaran Pelamar', 'dutaedan mendaftar sebagai pelamar baru.', '2025-08-19 03:59:57', '2025-08-19 03:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kutipan` text NOT NULL,
  `isi_berita` longtext NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `kategori_id`, `judul`, `slug`, `gambar`, `kutipan`, `isi_berita`, `is_featured`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Prospek Pekerjaan Telkom Beserta Gajinya yang Ditawarkan Sekarang', 'prospek-pekerjaan-telkom-beserta-gajinya-yang-ditawarkan-sekarang', 'berita/telkom.jpg', 'Telkom Indonesia membuka berbagai peluang karir di bidang teknologi dan digital. Temukan posisi yang sesuai dengan keahlian Anda.', '<p>Telkom Indonesia sebagai salah satu BUMN terbesar di tanah air terus berinovasi dan membuka pintu bagi talenta-talenta terbaik bangsa. Dengan transformasi digital yang masif, peluang karir di Telkom tidak hanya terbatas pada bidang telekomunikasi, tetapi juga merambah ke dunia digital seperti cloud computing, data science, dan keamanan siber.</p><p>Gaji yang ditawarkan pun sangat kompetitif, disesuaikan dengan jenjang karir dan keahlian yang dimiliki. Program pengembangan diri yang terstruktur juga menjadi daya tarik utama bagi para pencari kerja.</p>', 1, '2025-08-05 08:11:35', '2025-08-05 08:11:35', '2025-08-05 08:11:35'),
(2, 1, '5 Cara Efektif Menjawab Pertanyaan \"Kelemahan Diri\" Saat Wawancara', '5-cara-efektif-menjawab-pertanyaan-kelemahan-diri-saat-wawancara', 'berita/interview.jpg', 'Pertanyaan tentang kelemahan diri seringkali menjebak. Pelajari cara menjawabnya dengan jujur namun tetap profesional.', '<p>Menjawab pertanyaan ini membutuhkan strategi. Kuncinya adalah menunjukkan kesadaran diri dan kemauan untuk berkembang. Sebutkan kelemahan yang nyata namun tidak krusial untuk posisi yang dilamar, dan jelaskan langkah-langkah yang sudah Anda ambil untuk memperbaikinya.</p>', 0, '2025-08-04 08:11:35', '2025-08-05 08:11:35', '2025-08-05 08:11:35'),
(3, 2, 'Gojek dan Tokopedia Terus Buka Lowongan di Sektor Teknologi', 'gojek-dan-tokopedia-terus-buka-lowongan-di-sektor-teknologi', 'berita/gojek.jpg', 'Sebagai entitas GoTo, kedua raksasa teknologi ini terus mencari talenta di bidang software engineering, product management, dan data analytics.', '<p>Ekosistem GoTo yang luas menawarkan tantangan dan peluang karir yang menarik. Bekerja di sini berarti menjadi bagian dari inovasi yang berdampak pada kehidupan jutaan orang setiap harinya.</p>', 0, '2025-08-03 08:11:35', '2025-08-05 08:11:35', '2025-08-05 08:11:35'),
(4, 1, 'Pentingnya Personal Branding di LinkedIn untuk Karir Anda', 'pentingnya-personal-branding-di-linkedin-untuk-karir-anda', 'berita/linkedin.jpg', 'LinkedIn bukan hanya CV online. Manfaatkan platform ini untuk membangun citra profesional dan memperluas jaringan Anda.', '<p>Profil LinkedIn yang optimal dapat menarik perhatian perekrut. Bagikan pencapaian, tulis artikel singkat, dan aktif berinteraksi di industri Anda untuk membangun personal brand yang kuat.</p>', 0, '2025-08-02 08:11:35', '2025-08-05 08:11:35', '2025-08-05 08:11:35'),
(5, 2, 'Industri Manufaktur Kembali Bergeliat, Simak Lowongan Terbaru', 'industri-manufaktur-kembali-bergeliat-simak-lowongan-terbaru', 'berita/manufaktur.jpg', 'Seiring dengan pemulihan ekonomi, sektor manufaktur kembali membuka banyak lowongan untuk posisi operator, teknisi, hingga supervisor.', '<p>Banyak perusahaan manufaktur kini mengadopsi teknologi Industri 4.0, membuka peluang bagi para pekerja dengan keahlian di bidang otomasi dan robotika.</p>', 0, '2025-08-01 08:11:35', '2025-08-05 08:11:35', '2025-08-05 08:11:35');

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
-- Table structure for table `bidang_pekerjaan`
--

CREATE TABLE `bidang_pekerjaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_bidang` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidang_pekerjaan`
--

INSERT INTO `bidang_pekerjaan` (`id`, `nama_bidang`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Teknologi', 'teknologi', '2025-08-05 09:32:23', '2025-08-05 09:32:23'),
(2, 'E-Commerce', 'e-commerce', '2025-08-05 09:32:23', '2025-08-05 09:32:23'),
(3, 'Edukasi', 'edukasi', '2025-08-05 09:32:23', '2025-08-05 09:32:23'),
(4, 'Retail', 'retail', '2025-08-05 10:41:09', '2025-08-05 10:41:09'),
(5, 'Perbankan', 'perbankan', '2025-08-05 10:41:09', '2025-08-05 10:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('a72b20062ec2c47ab2ceb97ac1bee818f8b6c6cb', 'i:1;', 1755599672),
('a72b20062ec2c47ab2ceb97ac1bee818f8b6c6cb:timer', 'i:1755599672;', 1755599672),
('branzzgaming94@gmail.com|127.0.0.1', 'i:2;', 1755600802),
('branzzgaming94@gmail.com|127.0.0.1:timer', 'i:1755600802;', 1755600802),
('maya@gmail.com|127.0.0.1', 'i:3;', 1754637757),
('maya@gmail.com|127.0.0.1:timer', 'i:1754637757;', 1754637757);

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
-- Table structure for table `jadwal_wawancara`
--

CREATE TABLE `jadwal_wawancara` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lowongan_id` bigint(20) UNSIGNED NOT NULL,
  `pelamar_id` bigint(20) UNSIGNED NOT NULL,
  `metode_wawancara` varchar(255) NOT NULL,
  `lokasi_interview` varchar(255) DEFAULT NULL,
  `link_zoom` varchar(255) DEFAULT NULL,
  `tanggal_interview` date NOT NULL,
  `waktu_interview` time NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'terjadwal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_wawancara`
--

INSERT INTO `jadwal_wawancara` (`id`, `lowongan_id`, `pelamar_id`, `metode_wawancara`, `lokasi_interview`, `link_zoom`, `tanggal_interview`, `waktu_interview`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 38, 'Walk In Interview', 'a', NULL, '2025-08-15', '03:56:00', 'gass', 'terjadwal', '2025-08-07 13:58:07', '2025-08-07 13:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Tips Karir', 'tips-karir', '2025-08-05 08:11:35', '2025-08-05 08:11:35'),
(2, 'Info Industri', 'info-industri', '2025-08-05 08:11:35', '2025-08-05 08:11:35');

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

--
-- Dumping data for table `lamaran`
--

INSERT INTO `lamaran` (`id`, `pelamar_id`, `lowongan_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 38, 5, 'pending', '2025-08-07 13:24:05', '2025-08-07 13:24:05');

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
  `domisili` varchar(255) DEFAULT NULL,
  `tipe_pekerjaan` varchar(255) DEFAULT NULL,
  `deskripsi_pekerjaan` text NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) DEFAULT NULL,
  `usia` varchar(255) DEFAULT NULL,
  `nilai_pendidikan_terakhir` varchar(255) DEFAULT NULL,
  `pengalaman_kerja` varchar(255) DEFAULT NULL,
  `keahlian_bidang_pekerjaan` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lowongan_pekerjaan`
--

INSERT INTO `lowongan_pekerjaan` (`id`, `perusahaan_id`, `judul_lowongan`, `domisili`, `tipe_pekerjaan`, `deskripsi_pekerjaan`, `gender`, `pendidikan_terakhir`, `usia`, `nilai_pendidikan_terakhir`, `pengalaman_kerja`, `keahlian_bidang_pekerjaan`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 7, 'Manager Development', 'Semarang', NULL, 'Mampu salto belakang', 'Laki-laki', 'SMK/SMA', '20', '85,6', '1-3 tahun', 'Menguasai 5 elemen', 1, '2025-08-06 05:29:00', '2025-08-06 05:29:00'),
(6, 9, 'Service Area', 'Semarang', NULL, 'Mampu Smash kepala sekolah', 'Semua', 'S3 Profesor', '25', '3.7', '5 tahun', 'asasa', 1, '2025-08-06 05:40:43', '2025-08-06 05:41:07'),
(7, 7, 'Design WEB', 'semarang', NULL, 'handal dalam css dan punya jiwa seni tinggi', 'Semua', 'S1 Teknik Informatika', '22', '3.6', '1-3 tahun', 'css, javascript', 1, '2025-08-07 13:46:40', '2025-08-07 13:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_tersimpan`
--

CREATE TABLE `lowongan_tersimpan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelamar_id` bigint(20) UNSIGNED NOT NULL,
  `lowongan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lowongan_tersimpan`
--

INSERT INTO `lowongan_tersimpan` (`id`, `pelamar_id`, `lowongan_id`, `created_at`, `updated_at`) VALUES
(2, 7, 3, '2025-08-05 10:14:55', '2025-08-05 10:14:55'),
(3, 7, 1, '2025-08-05 10:19:03', '2025-08-05 10:19:03'),
(11, 7, 5, '2025-08-05 12:58:11', '2025-08-05 12:58:11'),
(12, 7, 7, '2025-08-05 12:58:13', '2025-08-05 12:58:13'),
(13, 7, 4, '2025-08-06 05:04:22', '2025-08-06 05:04:22'),
(14, 7, 8, '2025-08-06 05:04:24', '2025-08-06 05:04:24'),
(15, 38, 6, NULL, NULL),
(16, 38, 7, NULL, NULL);

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
(16, '2025_07_31_155100_adjust_profiles_perusahaan_for_registration', 6),
(17, '2025_08_04_034549_add_logo_perusahaan_to_profiles_perusahaan_table', 7),
(18, '2025_08_05_174912_add_kualifikasi_to_lowongan_pekerjaan_table', 8),
(19, '2025_08_06_220032_create_jadwal_wawancara_table', 9),
(20, '2025_08_07_213736_update_profiles_pelamar_for_ktp', 10),
(21, '2025_08_08_073011_add_foto_profil_to_profiles_pelamar_table', 11),
(23, '2025_08_08_172728_update_profiles_pelamar_table', 12),
(24, '2025_07_30_104825_add_bidang_to_keahlian_table', 12),
(25, '2025_07_30_104453_add_bidang_to_keahlian_table', 13),
(26, '2025_08_13_084657_create_profiles_umkm_table', 13),
(27, '2025_08_13_183100_rename_no_hp_in_profiles_umkm_table', 14),
(28, '2025_08_13_195021_add_nilai_akhir_to_profiles_pelamar_table', 15),
(29, '2025_08_19_103630_add_otp_to_users_table', 16);

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
(13, 1),
(13, 24),
(13, 31),
(13, 48),
(17, 26),
(17, 27),
(17, 48),
(17, 53),
(24, 26),
(24, 29),
(24, 44),
(24, 45),
(25, 24),
(25, 48),
(25, 52),
(26, 28),
(26, 29),
(27, 39),
(27, 41),
(27, 48),
(30, 26),
(30, 27),
(31, 29),
(31, 34),
(31, 44),
(32, 28),
(32, 29),
(33, 28),
(33, 29),
(33, 45),
(34, 28),
(34, 29),
(34, 50),
(34, 51),
(35, 14),
(35, 15),
(36, 1),
(36, 14),
(36, 24),
(36, 26),
(36, 42),
(38, 11),
(38, 42),
(38, 43),
(38, 44),
(38, 45),
(38, 46),
(38, 47),
(38, 53),
(42, 48),
(45, 31),
(46, 28),
(46, 30),
(46, 33),
(48, 29),
(48, 33),
(49, 19),
(49, 33),
(49, 34);

-- --------------------------------------------------------

--
-- Table structure for table `profiles_pelamar`
--

CREATE TABLE `profiles_pelamar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `nik` varchar(16) NOT NULL,
  `alamat` text NOT NULL,
  `domisili` varchar(255) NOT NULL,
  `lulusan` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `pengalaman_kerja` varchar(255) DEFAULT NULL,
  `tentang_saya` text DEFAULT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles_pelamar`
--

INSERT INTO `profiles_pelamar` (`id`, `user_id`, `nama_lengkap`, `foto_profil`, `nik`, `alamat`, `domisili`, `lulusan`, `no_hp`, `tanggal_lahir`, `gender`, `tahun_lulus`, `nilai_akhir`, `pengalaman_kerja`, `tentang_saya`, `foto_ktp`, `created_at`, `updated_at`) VALUES
(4, 9, 'rizki', NULL, '2345671829384776', 'Mranggen', 'Semarang', 'SMA/SMK Sederajat', '082328872084', '2003-01-14', 'Laki-laki', '2022', NULL, NULL, NULL, NULL, '2025-07-26 04:28:37', '2025-07-26 04:28:37'),
(5, 10, 'muna', NULL, '2345671829384789', 'demak', 'Semarang', 'SMP/Sederajat', '082328872084', '2025-07-18', 'Perempuan', '2023', NULL, NULL, NULL, NULL, '2025-07-29 12:48:26', '2025-07-29 12:48:26'),
(6, 11, 'lia', NULL, '2345671829384790', 'lamongan', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-18', 'Perempuan', '2021', NULL, NULL, NULL, NULL, '2025-07-29 12:58:19', '2025-07-29 12:58:19'),
(7, 12, 'branzz', NULL, '2345671829384780', 'lamongan', 'lamongan', 'S1', '082328872084', '2025-07-18', 'Laki-laki', '2016', NULL, NULL, NULL, NULL, '2025-07-29 13:33:24', '2025-07-29 13:33:24'),
(8, 13, 'abdul', NULL, '2345671829384798', 'lamongan', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-03', 'Laki-laki', '2022', NULL, NULL, NULL, NULL, '2025-07-29 13:49:23', '2025-07-29 13:49:23'),
(9, 14, 'karim', NULL, '2345671829384707', 'lamongan', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-16', 'Laki-laki', '2021', NULL, NULL, NULL, NULL, '2025-07-29 13:51:56', '2025-07-29 13:51:56'),
(10, 15, 'akmal', NULL, '2345671829384777', 'semarang', 'semarang', 'SMA/SMK Sederajat', '082328872084', '2025-07-24', 'Laki-laki', '2009', NULL, NULL, NULL, NULL, '2025-07-29 13:52:54', '2025-07-29 13:52:54'),
(11, 16, 'tegar', NULL, '2345671829384708', 'semarang', 'Semarang', 'SMA/SMK Sederajat', '082328872084', '2025-07-17', 'Laki-laki', '1986', NULL, NULL, NULL, NULL, '2025-07-29 13:53:53', '2025-07-29 13:53:53'),
(12, 17, 'abel', NULL, '2345671829363539', 'banyumanik', 'Semarang', 'D3', '082328872084', '2025-07-15', 'Laki-laki', '2011', NULL, NULL, NULL, NULL, '2025-07-30 03:08:38', '2025-07-30 03:08:38'),
(13, 18, 'merlin', NULL, '2345671829384705', 'lamongan', 'lamongan', 'S1', '082328872084', '2025-07-01', 'Perempuan', '2013', NULL, NULL, NULL, NULL, '2025-07-30 03:16:37', '2025-07-30 08:21:03'),
(14, 19, 'bono', NULL, '2345671829384730', 'lamongan', 'lamongan', 'D2', '082328872084', '2025-07-09', 'Laki-laki', '2009', NULL, NULL, NULL, NULL, '2025-07-30 03:20:44', '2025-07-30 03:20:44'),
(15, 20, 'ikmil', NULL, '2345671829384722', 'semarang', 'Semarang', 'SMA/SMK Sederajat', '082328872084', '2025-07-15', 'Laki-laki', '2011', NULL, NULL, NULL, NULL, '2025-07-30 03:38:40', '2025-07-30 03:38:40'),
(16, 21, 'ikmil', NULL, '2345671829384723', 'semarang', 'Semarang', 'SMA/SMK Sederajat', '082328872084', '2025-07-15', 'Laki-laki', '2011', NULL, NULL, NULL, NULL, '2025-07-30 03:42:15', '2025-07-30 03:42:15'),
(17, 22, 'nafa', NULL, '2345671829384887', 'lamongan', 'Semarang', 'D2', '082328872084', '2025-07-24', 'Perempuan', '2008', NULL, NULL, NULL, NULL, '2025-07-30 03:55:17', '2025-07-30 03:55:17'),
(18, 23, 'zaid', NULL, '2345671829384765', 'semarang', 'Semarang', 'S1', '082328872084', '2025-07-04', 'Laki-laki', '2013', NULL, NULL, NULL, NULL, '2025-07-30 09:06:25', '2025-07-30 09:06:25'),
(19, 24, 'zaid', NULL, '2345671829384754', 'semarang', 'Semarang', 'S1', '082328872084', '2025-07-04', 'Laki-laki', '2013', NULL, NULL, NULL, NULL, '2025-07-30 09:13:20', '2025-07-30 09:13:20'),
(20, 25, 'zaid', NULL, '2345671829384741', 'semarang', 'Semarang', 'S1', '082328872084', '2025-07-04', 'Laki-laki', '2013', NULL, NULL, NULL, NULL, '2025-07-30 09:15:16', '2025-07-30 09:15:16'),
(21, 26, 'zaid', NULL, '2345671829384778', 'semarang', 'Semarang', 'S1', '082328872084', '2025-07-04', 'Laki-laki', '2013', NULL, NULL, NULL, NULL, '2025-07-30 09:20:29', '2025-07-30 09:20:29'),
(22, 27, 'stel', NULL, '2345671829384742', 'semarang', 'lamongan', 'S2', '082328872084', '2025-07-04', 'Laki-laki', '2010', NULL, NULL, NULL, NULL, '2025-07-30 09:21:30', '2025-07-30 09:21:30'),
(23, 28, 'baba', NULL, '2345671829384782', 'lamongan', 'lamongan', 'D1', '082328872084', '2025-07-16', 'Laki-laki', '2015', NULL, NULL, NULL, NULL, '2025-07-30 09:24:09', '2025-07-30 09:24:09'),
(24, 29, 'mama', NULL, '2345671829384743', 'lamongan', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-09', 'Laki-laki', '2024', NULL, NULL, NULL, NULL, '2025-07-30 09:27:15', '2025-07-30 09:27:15'),
(25, 30, 'mimi', NULL, '2345671829384721', 'lamongan', 'lamongan', 'SMA/SMK Sederajat', '082328872084', '2025-07-10', 'Laki-laki', '2011', NULL, NULL, NULL, NULL, '2025-07-30 09:33:50', '2025-07-30 09:33:50'),
(26, 31, 'momo', NULL, '2345671829384542', 'banyumanik', 'semarang', 'S2', '082328872084', '2025-07-15', 'Laki-laki', '2011', NULL, NULL, NULL, NULL, '2025-07-30 09:48:49', '2025-07-30 09:48:49'),
(27, 32, 'mumu', NULL, '2345671829384745', 'gubug', 'semarang', 'D3', '082328872084', '2025-07-15', 'Perempuan', '2010', NULL, NULL, NULL, NULL, '2025-07-30 10:16:31', '2025-07-30 10:16:31'),
(29, 34, 'dika', NULL, '2345671829384842', 'jl.rayon kusuman', 'Demak', 'SMA/SMK Sederajat', '082328872084', '2025-07-10', 'Laki-laki', '2019', NULL, NULL, NULL, NULL, '2025-07-31 08:26:19', '2025-07-31 08:26:19'),
(30, 35, 'ini', NULL, '2345671829384452', 'ini', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-10', 'Laki-laki', '2023', NULL, NULL, NULL, NULL, '2025-07-31 08:39:27', '2025-07-31 08:39:27'),
(31, 36, 'inu', NULL, '2345671829384641', 'semarang', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-07-09', 'Perempuan', '2022', NULL, NULL, NULL, NULL, '2025-07-31 09:17:11', '2025-07-31 09:17:11'),
(32, 37, 'unu', NULL, '2345671829384761', 'kudus', 'kudus', 'SMP/Sederajat', '082328872084', '2025-08-08', 'Laki-laki', '2022', NULL, NULL, NULL, NULL, '2025-07-31 10:21:31', '2025-07-31 10:21:31'),
(33, 38, 'ono', NULL, '2345671829384797', 's', 'Semarang', 'SMP/Sederajat', '082328872084', '2025-08-13', 'Laki-laki', '2022', NULL, NULL, NULL, NULL, '2025-07-31 10:54:27', '2025-07-31 10:54:27'),
(34, 43, 'ine', NULL, '2345671829384123', 'semarang', 'lamongan', 'SMP/Sederajat', '082328872084', '2025-08-08', 'Laki-laki', '2023', NULL, NULL, NULL, NULL, '2025-07-31 11:29:55', '2025-07-31 11:29:55'),
(35, 45, 'stel2', NULL, '2345671829384321', 'kudus', 'kudus', 'SMA/SMK Sederajat', '082328872084', '2025-07-31', 'Perempuan', '2022', NULL, NULL, NULL, NULL, '2025-07-31 11:37:23', '2025-07-31 11:37:23'),
(36, 46, 'Anda', NULL, '3321219873816256', 'BENGKAH', 'Kendal', 'SMA/SMK Sederajat', '084934283423', '2025-08-28', 'Laki-laki', '2022', NULL, NULL, NULL, NULL, '2025-08-01 02:56:12', '2025-08-01 02:56:12'),
(37, 48, 'Maulana Aditia', NULL, '3321219873816023', 'Jl.kelinci', 'Demak', 'S1', '084934283423', '1998-10-22', 'Laki-laki', '2025', NULL, NULL, NULL, NULL, '2025-08-01 06:43:06', '2025-08-01 06:43:06'),
(38, 51, 'Mayamaria jelek', NULL, '3321219873839211', 'Jl.Kretek', 'Kudus', 'S1', '084934283403', '2000-11-30', 'Perempuan', '2025', NULL, NULL, NULL, 'ktp/M2ixJ6S9TOOESQlZrqjdSPwPKv783pBlly1LsEUv.jpg', '2025-08-02 11:24:13', '2025-08-07 15:10:53'),
(40, 56, 'uhuy', NULL, '2345671829384755', 'Girikusumo', 'Demak', 'SMA/SMK Sederajat', '082328872084', '2025-08-09', 'Laki-laki', '1988', NULL, '1-3 Tahun', NULL, NULL, '2025-08-13 02:45:19', '2025-08-13 02:45:19'),
(41, 59, 'uhuy', NULL, '2345671829384766', 'Girikusumo', 'Demak', 'SMA/SMK Sederajat', '082328872084', '2025-08-19', 'Laki-laki', '1987', NULL, '1-3 Tahun', NULL, NULL, '2025-08-13 11:04:03', '2025-08-13 11:04:03'),
(42, 61, 'ahah', NULL, '2345671829384734', 'Girikusumo', 'Demak', 'SMA/SMK Sederajat', '082328872084', '2025-08-15', 'Laki-laki', '1988', NULL, '1-3 Tahun', NULL, NULL, '2025-08-13 12:28:17', '2025-08-13 12:28:17'),
(43, 62, 'mumu', NULL, '2345671829384744', 'Girikusumo', 'Demak', 'SMP/Sederajat', '082328872084', '2025-08-13', 'Perempuan', '1988', NULL, '< 1 Tahun', NULL, NULL, '2025-08-13 12:32:12', '2025-08-13 12:32:12'),
(44, 63, 'mami', NULL, '2345671829384751', 'Girikusumo', 'Demak', 'SMA/SMK Sederajat', '082328872084', '2025-08-15', 'Perempuan', '1988', NULL, '3-5 Tahun', NULL, NULL, '2025-08-13 12:36:01', '2025-08-13 12:36:01'),
(45, 66, 'mimo', NULL, '2345671829384433', 'Girikusumo', 'Demak', 'SMA/SMK Sederajat', '082328872084', '2025-08-07', 'Laki-laki', '1991', 85.50, '3-5 Tahun', NULL, NULL, '2025-08-13 12:57:21', '2025-08-13 12:57:21'),
(46, 68, 'mumi', NULL, '2345671829384862', 'Girikusumo', 'Demak', 'SMA/SMK Sederajat', '082328872077', '2008-05-20', 'Laki-laki', '1991', 85.50, '1-3 Tahun', NULL, NULL, '2025-08-18 21:51:51', '2025-08-18 21:51:51'),
(48, 70, 'merlina', NULL, '2345671829384444', 'Lamongan', 'Lamongan', 'S1', '082328872084', '2003-02-20', 'Perempuan', '2025', 3.78, '1-3 Tahun', NULL, NULL, '2025-08-19 03:54:54', '2025-08-19 03:54:54'),
(49, 71, 'dutaedan', NULL, '2345671829384666', 'Girikusumo', 'Demak', 'SMA/SMK Sederajat', '082328872084', '2004-03-20', 'Laki-laki', '2023', 85.50, '1-3 Tahun', NULL, NULL, '2025-08-19 03:59:57', '2025-08-19 03:59:57');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_perusahaan`
--

CREATE TABLE `profiles_perusahaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `alamat_jalan` text DEFAULT NULL,
  `alamat_kota` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `no_telp_perusahaan` varchar(20) DEFAULT NULL,
  `npwp_perusahaan` varchar(25) DEFAULT NULL,
  `situs_web` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `logo_perusahaan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles_perusahaan`
--

INSERT INTO `profiles_perusahaan` (`id`, `user_id`, `nama_perusahaan`, `alamat_jalan`, `alamat_kota`, `kode_pos`, `no_telp_perusahaan`, `npwp_perusahaan`, `situs_web`, `deskripsi`, `logo_perusahaan`, `created_at`, `updated_at`) VALUES
(2, 41, 'telkom', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 11:23:43', '2025-07-31 11:23:43'),
(3, 42, 'indo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-31 11:28:40', '2025-07-31 11:28:40'),
(4, 44, 'indu', 'semarang', 'semarang', '1234', '08123456789', '1234', NULL, NULL, NULL, '2025-07-31 11:34:53', '2025-07-31 11:34:53'),
(5, 47, 'RAquaticus', 'Jl.PucangAnom', 'Semarang', '20821', '084934283423', '11.345.678.9-012.152', NULL, NULL, NULL, '2025-08-01 02:57:40', '2025-08-01 02:57:40'),
(6, 49, 'PT.ABADI', 'Jl.Bandungrejo', 'Demak', '20822', '084934283421', '11.345.678.9-012.333', NULL, NULL, NULL, '2025-08-01 07:53:30', '2025-08-01 07:53:30'),
(7, 50, 'PT.RAMKOM', 'BENGKAH', 'Semarang', '20891', '084934283411', '11.345.678.9-012.225', NULL, 'Perusahaan bekerja dibidang IT', 'logos/1vmEyvB0qMWGpzwgVcfTT9B5QB2fdoIvqjjsgwTl.png', '2025-08-01 16:40:39', '2025-08-06 17:16:00'),
(8, 52, 'BataRingan', 'Desa.karangayu', 'Kendal', '50198', '084934283821', '11.345.678.9-012.600', NULL, NULL, 'logos/e81zxnTA1VQtwnF2vH2YIKgZ0t3wYDuMPOzi09ka.jpg', '2025-08-05 06:13:47', '2025-08-05 06:35:04'),
(9, 53, 'PT.VictorRacket', 'Jl.Pandansari IV', 'Semarang Utara', '50199', '088342648414', '11.345.678.8-012.102', NULL, NULL, 'logos/YjvDGNHHnmZHUYcRHNhybKCD22Ez1aAovGuQSMwN.jpg', '2025-08-06 05:37:44', '2025-08-06 05:39:00'),
(10, 64, 'branzzstudio', 'Girikusumo', 'Demak', '59567', '08123456789', '12345', NULL, NULL, NULL, '2025-08-13 12:36:53', '2025-08-13 12:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_umkm`
--

CREATE TABLE `profiles_umkm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `alamat_usaha` text NOT NULL,
  `kota` varchar(255) NOT NULL,
  `no_hp_umkm` varchar(255) NOT NULL,
  `kategori_usaha` varchar(255) NOT NULL,
  `deskripsi_usaha` text DEFAULT NULL,
  `situs_web_atau_medsos` varchar(255) DEFAULT NULL,
  `logo_usaha` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles_umkm`
--

INSERT INTO `profiles_umkm` (`id`, `user_id`, `nama_usaha`, `nama_pemilik`, `alamat_usaha`, `kota`, `no_hp_umkm`, `kategori_usaha`, `deskripsi_usaha`, `situs_web_atau_medsos`, `logo_usaha`, `created_at`, `updated_at`) VALUES
(1, 55, 'cilok', 'branzz', 'Girikusumo', 'Demak', '082328872084', 'kuliner', NULL, NULL, NULL, '2025-08-13 02:32:15', '2025-08-13 02:32:15'),
(2, 57, 'bakso', 'akmal', 'Girikusumo', 'Demak', '082328872084', 'kuliner', NULL, NULL, NULL, '2025-08-13 10:50:33', '2025-08-13 10:50:33'),
(3, 58, 'pukis', 'kempung', 'Girikusumo', 'Demak', '082328872084', 'kuliner', NULL, NULL, NULL, '2025-08-13 10:53:07', '2025-08-13 10:53:07'),
(4, 65, 'burjo', 'branzz', 'Girikusumo', 'Demak', '0812345678', 'kuliner', NULL, NULL, NULL, '2025-08-13 12:38:06', '2025-08-13 12:38:06'),
(5, 67, 'angkringan', 'prass', 'Girikusumo', 'Demak', '0812345678', 'kuliner', NULL, NULL, NULL, '2025-08-15 07:09:18', '2025-08-15 07:09:18');

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
('Z9gEfvQ5QNlUDN1yiFspWUvzzIkZ3Z3MimxkxJDL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUJVUGg0OTk4dmMxU3MwVGYwSEtVbkFBZjRWeVZncEd0NmZsU3VMdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1755601246);

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
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','pelamar','perusahaan','umkm') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `otp_code`, `otp_expires_at`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Mas Admin', 'admin@messari.com', '2025-07-24 17:02:14', '$2y$12$wft2UfJgDYHDEf2NM4uZlOYL0CRsaGmN6UuRDO1L9TZZNx/h4cBVa', NULL, NULL, 'admin', NULL, '2025-07-24 17:02:14', '2025-07-24 10:04:11'),
(3, 'akmal', 'akmalzaid24@gmail.com', NULL, '$2y$12$D.1QZlQ1dHG7ikg.gprZ4.qGFyLbb9VHJgLFS7/ASQSW93uKsNiB2', NULL, NULL, 'pelamar', NULL, '2025-07-24 11:43:24', '2025-07-24 11:43:24'),
(7, 'arryaduta', 'duta23@gmail.com', NULL, '$2y$12$gvOvbZvi4D5ndvMB5qEeU.gdP7JjxSYctz0xIdXuycgSsPTMzOZh.', NULL, NULL, 'pelamar', NULL, '2025-07-26 01:44:14', '2025-07-26 01:44:14'),
(8, 'abel', 'abel.24@gmail.com', NULL, '$2y$12$uQkOu8AMkd2UASxiH/X27.29jjbwBDRxVNMe/1O0RwPcrYBPndc7C', NULL, NULL, 'pelamar', NULL, '2025-07-26 01:55:45', '2025-07-26 01:55:45'),
(9, 'rizki', 'rizki.gaming@gmail.com', NULL, '$2y$12$Pq5W2d35lroeCrErLErH0uLuaJpQM3aqxxybZpUtDiQWD83UqEbVK', NULL, NULL, 'pelamar', NULL, '2025-07-26 04:28:37', '2025-07-26 04:28:37'),
(10, 'muna', 'muna@gmail.com', NULL, '$2y$12$OrItEZ8dPWb1fgMx.qL0t.fzTwY.pH7pnmeX8rw4tNF.fr.gswg6q', NULL, NULL, 'pelamar', NULL, '2025-07-29 12:48:25', '2025-07-29 12:48:25'),
(11, 'lia', 'lia@gmail.com', NULL, '$2y$12$A5PLPTnZwPe6sZVbuFwzCeoj47YQHJvtSVLFvlOwHtWZBK/Ks2Rt.', NULL, NULL, 'pelamar', NULL, '2025-07-29 12:58:19', '2025-07-29 12:58:19'),
(12, 'branzz', 'branzz@gmail.com', NULL, '$2y$12$g2yhM1Obfotf1sWDDInpM.KXVenq0YjqnmJeHkN7hvmB0alAC2iTu', NULL, NULL, 'pelamar', NULL, '2025-07-29 13:33:24', '2025-07-29 13:33:24'),
(13, 'abdul1', 'abdul@gmail.com', NULL, '$2y$12$jTEvrSlu0JLR3aKk1z4Vgeig3pK6kRbytzlqxxwvd5P.67uO2xOk6', NULL, NULL, 'pelamar', NULL, '2025-07-29 13:49:23', '2025-07-30 07:25:53'),
(14, 'karim', 'karim@gmail.com', NULL, '$2y$12$rUooEISy1mjEq9EHBCQvku7rUyopvqLk5n8p60nfNXDqejK7YcyKC', NULL, NULL, 'pelamar', NULL, '2025-07-29 13:51:56', '2025-07-29 13:51:56'),
(15, 'akmal', 'akmal.tbn@gmail.com', NULL, '$2y$12$pehlfVDJ3hEeRGwNjuTNaOIOJ3zx7Si737.BR0QP6ExjizteQopmq', NULL, NULL, 'pelamar', NULL, '2025-07-29 13:52:54', '2025-07-29 13:52:54'),
(16, 'tegar', 'tegar@gmail.com', NULL, '$2y$12$nzdH2cHiHgmio8h3N5XSZO7D9VJg9NI7iGnM3qXn8BjPw8qis7mkW', NULL, NULL, 'pelamar', NULL, '2025-07-29 13:53:53', '2025-07-29 13:53:53'),
(17, 'abel', 'abel24@gmail.com', NULL, '$2y$12$JKnXr/T5Tj5axkln.oTWH.Ot0HE3lKWD7AbHZPuG81079qcLitoW6', NULL, NULL, 'pelamar', NULL, '2025-07-30 03:08:37', '2025-07-30 03:08:37'),
(18, 'merlin', 'merlin@gmail.com', NULL, '$2y$12$W1YlIZhiLCR5IAoyzKWk/uMan2gUDNBhNLToAngzF0txpE8MY.4WO', NULL, NULL, 'pelamar', NULL, '2025-07-30 03:16:37', '2025-07-30 08:15:10'),
(19, 'bono', 'bono@gmail.com', NULL, '$2y$12$27iKGYAEgnGa/m2tyF8QQeJ/X9jSZd2eao7jkjAOx1ZOoEkJwnuUq', NULL, NULL, 'pelamar', NULL, '2025-07-30 03:20:44', '2025-07-30 03:20:44'),
(20, 'ikmil', 'ikmil@gmail.com', NULL, '$2y$12$An/Jz.AKu/lErWUr69hvQ./0USlOotGHnAr1wwPeQepws4.yTSKR6', NULL, NULL, 'pelamar', NULL, '2025-07-30 03:38:40', '2025-07-30 03:38:40'),
(21, 'ikmil', 'ikmal@gmail.com', NULL, '$2y$12$KwrHGey6/JPpLGq2iljeQetvfE/VsHCaIKDWdlRNtPvf4Irv6EToy', NULL, NULL, 'pelamar', NULL, '2025-07-30 03:42:15', '2025-07-30 03:42:15'),
(22, 'nafa', 'nafa@gmail.com', NULL, '$2y$12$DqoPQByfJBfjMhfe5SUG6OLjqfhY3bTzFnmfBeKGFSekRLfIrnpV.', NULL, NULL, 'pelamar', NULL, '2025-07-30 03:55:16', '2025-07-30 03:55:16'),
(23, 'zaid', 'zaid@gmail.com', NULL, '$2y$12$f00nk9z/XQrM/NaLHec4H.VAvwh561NHtAosD2luXlv0WIYBbS3aa', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:06:25', '2025-07-30 09:06:25'),
(24, 'zaid', 'zaid2@gmail.com', NULL, '$2y$12$z2XvMNr0aAYWwuwENGpPZudxoOfO7rVQumVIHnSBQfV48YOoThc5C', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:13:20', '2025-07-30 09:13:20'),
(25, 'zaid', 'zaid1@gmail.com', NULL, '$2y$12$nvEeEURapCkpOnscigYpHe3Wzbp1rzd3bMb6f2CLenu0dGGF93Nd2', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:15:16', '2025-07-30 09:15:16'),
(26, 'zaid', 'zaid3@gmail.com', NULL, '$2y$12$c0dK96eLlJBdVEQmjIuKUe/MmL2Iqr7WU.Eo405skSOCB/FuybDHy', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:20:29', '2025-07-30 09:20:29'),
(27, 'stel', 'stel@gmail.com', NULL, '$2y$12$RvOgYGX.LRei2RGMU8wz8.2Fm3XziU8VeebFVJ4m8.6zS8KjXgsG2', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:21:30', '2025-07-30 09:21:30'),
(28, 'baba', 'baba@gmail.com', NULL, '$2y$12$jf4xSh/H9VsLT7U5dBga0.f4iDdiwTh.CZEXSCZd6Pnjrk67RPGoO', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:24:09', '2025-07-30 09:24:09'),
(29, 'mama', 'mama@gmail.com', NULL, '$2y$12$GQsYn5C/L9y1QrTtOKpU8e3vn/oXBHXRWzk1HGAGHqZpdBg.UwqI2', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:27:15', '2025-07-30 09:27:15'),
(30, 'mimi', 'mimi@gmail.com', NULL, '$2y$12$DxGsHJwNOHiQ7nrKUQZ7gO6aVfJUD7AogtCToCF2.G65Icy0YNL7G', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:33:50', '2025-07-30 09:33:50'),
(31, 'momo', 'momo@gmail.com', NULL, '$2y$12$gVN2onkWC2m2t3gneilNDe3lvrQKnLLRTmPIVEpglGjbI0oUSVuN6', NULL, NULL, 'pelamar', NULL, '2025-07-30 09:48:49', '2025-07-30 09:48:49'),
(32, 'mumu', 'mumu@gmail.com', NULL, '$2y$12$BvolmG7.psD/8kIzSTLye.Xj.1KrNTaCpINE1BG63C7P5q7FL8aLW', NULL, NULL, 'pelamar', NULL, '2025-07-30 10:16:31', '2025-07-30 10:16:31'),
(34, 'dika', 'dika@gmail.com', NULL, '$2y$12$gJyCNbEnmIOAj6UBkjSjceqZ3HTl3Gu2V6.pfJH7BnU77U9IfWBVa', NULL, NULL, 'pelamar', NULL, '2025-07-31 08:26:19', '2025-07-31 08:26:19'),
(35, 'ini', 'ini@gmail.com', NULL, '$2y$12$9enIpIlzSM4x0Soe56Kgbemk.5DA/a8936JRlIGW1iiWHxPsPumGS', NULL, NULL, 'pelamar', NULL, '2025-07-31 08:39:27', '2025-07-31 08:39:27'),
(36, 'inu', 'inu@gmail.com', NULL, '$2y$12$0MezNTFv2J3aM9gbU8s9Uuj6xSD3OIyzV0EAmvO3mAeavkaDI5Ydi', NULL, NULL, 'pelamar', NULL, '2025-07-31 09:17:11', '2025-07-31 09:17:11'),
(37, 'unu', 'unu@gmail.com', NULL, '$2y$12$kofOw6vS2TJ9J7MT0kyacutLO341QAj1g55CKiPulTug87CIqbKKq', NULL, NULL, 'pelamar', NULL, '2025-07-31 10:21:31', '2025-07-31 10:21:31'),
(38, 'ono', 'ono@gmail.com', NULL, '$2y$12$xg9ukxNLYzd2EX5Fcjqkh.fR4nFXn3GfgXb/8bt3KFQS1hL8sKLpG', NULL, NULL, 'pelamar', NULL, '2025-07-31 10:54:27', '2025-07-31 10:54:27'),
(40, 'telkom', 'telkom@gmail.com', NULL, '$2y$12$oeTAgmYPfp77nGkerrFQ/uGbiRDRyXYPzc9uSHEk1Ig2n1cJyW3Li', NULL, NULL, 'perusahaan', NULL, '2025-07-31 11:12:30', '2025-07-31 11:12:30'),
(41, 'telkom', 'telkom1@gmail.com', NULL, '$2y$12$Ntp81160h0COtOydPUpa7ut2LrgTo7t.nhrKtBgCHcj28BVudwAmC', NULL, NULL, 'perusahaan', NULL, '2025-07-31 11:23:42', '2025-07-31 11:23:42'),
(42, 'indo', 'indo@gmail.com', NULL, '$2y$12$RnRrDCI35uduNjfeBkFdBebcbRsZfEIWewUtShQXwYZzWbf.KOKZ6', NULL, NULL, 'perusahaan', NULL, '2025-07-31 11:28:40', '2025-07-31 11:28:40'),
(43, 'ine', 'ine@gmail.com', NULL, '$2y$12$H6jY2G44278wWC4UDHgMMuqPhAHY6mEhj.C5BsZA/8bg06fAeZ.qC', NULL, NULL, 'pelamar', NULL, '2025-07-31 11:29:55', '2025-07-31 11:29:55'),
(44, 'indu', 'indu@gmail.com', NULL, '$2y$12$oJaPVOY4dEf9umt7y39sb.ZEZST6ira4Ut6c.0igYL7wbxLx8QPyq', NULL, NULL, 'perusahaan', NULL, '2025-07-31 11:34:53', '2025-07-31 11:34:53'),
(45, 'stel2', 'stel2@gmail.com', NULL, '$2y$12$yKSxpgA9Yf.2UPbADCULnuLsgRbn5MVJnF.CQYjZQpG7o0eP3y.ge', NULL, NULL, 'pelamar', NULL, '2025-07-31 11:37:23', '2025-07-31 11:37:23'),
(46, 'Anda', 'ramtech12@gmail.com', NULL, '$2y$12$eamY6WQZtPXlmfSHLgtNR.LebJ6uPtPcmb.hUExff1fup6GLlbOQ2', NULL, NULL, 'pelamar', NULL, '2025-08-01 02:56:12', '2025-08-01 02:56:12'),
(47, 'RAquaticus', 'ramtech17@gmail.com', NULL, '$2y$12$vnRtupr8NpdmfxxinvftMuBxespgM.6allBOVITBsRzEecC1DQ43S', NULL, NULL, 'perusahaan', NULL, '2025-08-01 02:57:40', '2025-08-01 02:57:40'),
(48, 'Maulana Aditia', 'maulana@gmail.com', NULL, '$2y$12$d3Uh6umdYNnByrg2Z/gzPers7bI5SLnMRPehSxL3aHml0vlf8C.ge', NULL, NULL, 'pelamar', NULL, '2025-08-01 06:43:06', '2025-08-01 06:43:06'),
(49, 'PT.ABADI', 'abadi@gmail.com', NULL, '$2y$12$FsYr/1jL4mzWdjkW36K.B.pYhGLxIPVknurUT07SnXAqdo22rMUji', NULL, NULL, 'perusahaan', NULL, '2025-08-01 07:53:30', '2025-08-01 07:53:30'),
(50, 'Mas Rizqi ganteng', 'ramstore1@gmail.com', NULL, '$2y$12$Z0JY3MQluoKGk1O6jCedsurFnEbZyJ3ngLMn2jnQWAL2kqmcslED2', NULL, NULL, 'perusahaan', NULL, '2025-08-01 16:40:39', '2025-08-05 06:08:25'),
(51, 'Mayamaria jelek', 'maya1@gmail.com', NULL, '$2y$12$W07uZnlllmy1ot30z.ppSOFxROPumE1whAc4CP3du9Z2mo.y7lvfu', NULL, NULL, 'pelamar', NULL, '2025-08-02 11:24:13', '2025-08-07 15:10:53'),
(52, 'BataRingan', 'bata@gmail.com', NULL, '$2y$12$Kf1zAoTsAeqe/pU3hVI/IuQWhN9uwC/1BAOZTc/dw0rnOCQjW6/oa', NULL, NULL, 'perusahaan', NULL, '2025-08-05 06:13:47', '2025-08-05 06:13:47'),
(53, 'PT.VictorRacket', 'viktor@gmail.com', NULL, '$2y$12$Eks5pcPBWkp4rDrmAb4feen.mfKUVDLik/DlZ42iVebj57TMD8bXy', NULL, NULL, 'perusahaan', NULL, '2025-08-06 05:37:44', '2025-08-06 05:37:44'),
(55, 'branzz', 'cilok@gmail.com', NULL, '$2y$12$47mKh5W22oZC0A2ibEJblu38fQthmojJJ5lGsjyIAU9XmQrAed/EO', NULL, NULL, 'umkm', NULL, '2025-08-13 02:32:15', '2025-08-13 02:32:15'),
(56, 'uhuy', 'uhuy@gmail.com', NULL, '$2y$12$Gsnpgkgg8HTdAl6X0eRMEeGgVPXpuFlxKg9BewrZLZqJABxjnIt1e', NULL, NULL, 'pelamar', NULL, '2025-08-13 02:45:19', '2025-08-13 02:45:19'),
(57, 'akmal', 'bakso@gmail.com', NULL, '$2y$12$K0so6Jj0m/E/QvOPS83IZ.WlBLNl4xaTRhfGPWAcGEsgXjhoddkpK', NULL, NULL, 'umkm', NULL, '2025-08-13 10:50:32', '2025-08-13 10:50:32'),
(58, 'kempung', 'pukis@gmail.com', NULL, '$2y$12$FVY1eyABy8QWAXN/oKK2k.wJHPSHLCEYWlKeRgnoAGdPTT0UJtzNq', NULL, NULL, 'umkm', NULL, '2025-08-13 10:53:07', '2025-08-13 10:53:07'),
(59, 'uhuy', 'uhiy@gmail.com', NULL, '$2y$12$gucBD.cSsJpNrCvbr6S9Z.upPjl/eY9NzoLBPrXpDhRXGZDdrq74m', NULL, NULL, 'pelamar', NULL, '2025-08-13 11:04:03', '2025-08-13 11:04:03'),
(61, 'ahah', 'ahah@gmail.com', NULL, '$2y$12$V2728IE702rbKxB0xzRt7OGG2BWQCulmNCkspJjS3zxCXg5JEosei', NULL, NULL, 'pelamar', NULL, '2025-08-13 12:28:17', '2025-08-13 12:28:17'),
(62, 'mumu', 'mumu1@gmail.com', NULL, '$2y$12$mGJn75.tAw4xQ2UEDUOwye/fOGA/Q0WsSEkpzsSMgkRkqZpgUSueq', NULL, NULL, 'pelamar', NULL, '2025-08-13 12:32:12', '2025-08-13 12:32:12'),
(63, 'mami', 'mami@gmail.com', NULL, '$2y$12$ex/jhSb0vO.LQzYS6XRNmeByOYLmSm62Tcxsk23xRWmFLLEz/9keS', NULL, NULL, 'pelamar', NULL, '2025-08-13 12:36:01', '2025-08-13 12:36:01'),
(64, 'branzzstudio', 'branzzstudio@gmail.com', NULL, '$2y$12$rgqkdhJRFWJUfDt6spk4xeI1ZXax5E8gk/6XfwKZcuj6siU5HZVqy', NULL, NULL, 'perusahaan', NULL, '2025-08-13 12:36:53', '2025-08-13 12:36:53'),
(65, 'burjo', 'burjo@gmail.com', NULL, '$2y$12$9rfdwK9AWZD3WnD9UpjGdu66A6YMcS8j9JhRsqkeFEkc9iY3RgMkS', NULL, NULL, 'umkm', NULL, '2025-08-13 12:38:06', '2025-08-13 12:38:06'),
(66, 'mimo', 'mimo@gmail.com', NULL, '$2y$12$KydMU9HgqFI0dBK74pFUtOTmOT/g8xmlHs0pqaOQ/AvrnUg9dh2M6', NULL, NULL, 'pelamar', NULL, '2025-08-13 12:57:21', '2025-08-13 12:57:21'),
(67, 'angkringan', 'angkringan@gmail.com', NULL, '$2y$12$ffCo0AdlwZEOKMFHMV2KUOvvS4DD6OIFUZYQkwa6OGitLr31Lj6Ty', NULL, NULL, 'umkm', NULL, '2025-08-15 07:09:18', '2025-08-15 07:09:18'),
(68, 'mumi', 'mumi@gmail.com', NULL, '$2y$12$d.cTw8eRFLZz8xxb5d0HJuAvjA9VhosAyVrH9IaBx8QQCLvAOu6LO', NULL, NULL, 'pelamar', NULL, '2025-08-18 21:51:51', '2025-08-18 21:51:51'),
(70, 'merlina', 'branzzgaming94@gmail.com', '2025-08-19 03:55:23', '$2y$12$An46m0T2Oa0ZGUVSc574ZurfoqFhdiwOOWNgBg0zhv0veouxAYoii', NULL, NULL, 'pelamar', NULL, '2025-08-19 03:54:54', '2025-08-19 03:55:23'),
(71, 'dutaedan', 'dutaarryaduta98@gmail.com', '2025-08-19 04:00:15', '$2y$12$VBIAINovZLk4JsYskK0.9OBr3fFcl0sfS9U4lt0y7pyKCUaSrT59i', NULL, NULL, 'pelamar', NULL, '2025-08-19 03:59:57', '2025-08-19 04:00:15');

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
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `berita_slug_unique` (`slug`),
  ADD KEY `berita_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `bidang_keahlians`
--
ALTER TABLE `bidang_keahlians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidang_pekerjaan`
--
ALTER TABLE `bidang_pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bidang_pekerjaan_slug_unique` (`slug`);

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
-- Indexes for table `jadwal_wawancara`
--
ALTER TABLE `jadwal_wawancara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_wawancara_lowongan_id_foreign` (`lowongan_id`),
  ADD KEY `jadwal_wawancara_pelamar_id_foreign` (`pelamar_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_slug_unique` (`slug`);

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
-- Indexes for table `lowongan_tersimpan`
--
ALTER TABLE `lowongan_tersimpan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lowongan_tersimpan_pelamar_id_foreign` (`pelamar_id`),
  ADD KEY `lowongan_tersimpan_lowongan_id_foreign` (`lowongan_id`);

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
-- Indexes for table `profiles_umkm`
--
ALTER TABLE `profiles_umkm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_umkm_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bidang_keahlians`
--
ALTER TABLE `bidang_keahlians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bidang_pekerjaan`
--
ALTER TABLE `bidang_pekerjaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_wawancara`
--
ALTER TABLE `jadwal_wawancara`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keahlian`
--
ALTER TABLE `keahlian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lowongan_pekerjaan`
--
ALTER TABLE `lowongan_pekerjaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lowongan_tersimpan`
--
ALTER TABLE `lowongan_tersimpan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `profiles_pelamar`
--
ALTER TABLE `profiles_pelamar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `profiles_perusahaan`
--
ALTER TABLE `profiles_perusahaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `profiles_umkm`
--
ALTER TABLE `profiles_umkm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jadwal_wawancara`
--
ALTER TABLE `jadwal_wawancara`
  ADD CONSTRAINT `jadwal_wawancara_lowongan_id_foreign` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan_pekerjaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_wawancara_pelamar_id_foreign` FOREIGN KEY (`pelamar_id`) REFERENCES `profiles_pelamar` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `profiles_umkm`
--
ALTER TABLE `profiles_umkm`
  ADD CONSTRAINT `profiles_umkm_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
