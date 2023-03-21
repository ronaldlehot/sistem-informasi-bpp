-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2020 pada 18.16
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bebas`
--

CREATE TABLE `bebas` (
  `bebas_id` int(11) NOT NULL,
  `student_student_id` int(11) DEFAULT NULL,
  `payment_payment_id` int(11) DEFAULT NULL,
  `bebas_bill` decimal(10,0) DEFAULT NULL,
  `bebas_total_pay` decimal(10,0) DEFAULT '0',
  `bebas_input_date` timestamp NULL DEFAULT NULL,
  `bebas_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bebas_pay`
--

CREATE TABLE `bebas_pay` (
  `bebas_pay_id` int(11) NOT NULL,
  `bebas_bebas_id` int(11) DEFAULT NULL,
  `bebas_pay_number` varchar(100) DEFAULT NULL,
  `bebas_pay_bill` decimal(10,0) DEFAULT NULL,
  `bebas_pay_desc` varchar(100) DEFAULT NULL,
  `user_user_id` int(11) DEFAULT NULL,
  `bebas_pay_input_date` date DEFAULT NULL,
  `bebas_pay_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `bulan_id` int(11) NOT NULL,
  `student_student_id` int(11) DEFAULT NULL,
  `payment_payment_id` int(11) DEFAULT NULL,
  `month_month_id` int(11) DEFAULT NULL,
  `bulan_bill` decimal(10,0) DEFAULT NULL,
  `bulan_status` tinyint(1) DEFAULT '0',
  `bulan_number_pay` varchar(100) DEFAULT NULL,
  `bulan_date_pay` date DEFAULT NULL,
  `user_user_id` int(11) DEFAULT NULL,
  `bulan_input_date` timestamp NULL DEFAULT NULL,
  `bulan_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`bulan_id`, `student_student_id`, `payment_payment_id`, `month_month_id`, `bulan_bill`, `bulan_status`, `bulan_number_pay`, `bulan_date_pay`, `user_user_id`, `bulan_input_date`, `bulan_last_update`) VALUES
(1, 1, 2, 1, '10000', 1, '20200600001', '2020-06-26', 1, '2020-06-26 14:12:34', '2020-06-26 14:13:42'),
(2, 1, 2, 2, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(3, 1, 2, 3, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(4, 1, 2, 4, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(5, 1, 2, 5, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(6, 1, 2, 6, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(7, 1, 2, 7, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(8, 1, 2, 8, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(9, 1, 2, 9, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(10, 1, 2, 10, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(11, 1, 2, 11, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(12, 1, 2, 12, '10000', 0, NULL, NULL, NULL, '2020-06-26 14:12:34', '2020-06-26 14:12:34'),
(13, 2, 2, 1, '30000', 1, '20200600002', '2020-06-26', 1, '2020-06-26 14:58:05', '2020-06-26 15:12:46'),
(14, 2, 2, 2, '30000', 1, '20200600003', '2020-06-26', 1, '2020-06-26 14:58:05', '2020-06-26 15:13:36'),
(15, 2, 2, 3, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(16, 2, 2, 4, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(17, 2, 2, 5, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(18, 2, 2, 6, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(19, 2, 2, 7, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(20, 2, 2, 8, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(21, 2, 2, 9, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(22, 2, 2, 10, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(23, 2, 2, 11, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46'),
(24, 2, 2, 12, '30000', 0, NULL, NULL, NULL, '2020-06-26 14:58:06', '2020-06-26 15:12:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(1, 'XII'),
(2, 'XI'),
(3, 'X'),
(4, 'IX MTs'),
(5, 'VIII MTs'),
(6, 'VII MTs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `debit`
--

CREATE TABLE `debit` (
  `debit_id` int(11) NOT NULL,
  `debit_date` date DEFAULT NULL,
  `debit_desc` varchar(100) DEFAULT NULL,
  `debit_value` decimal(10,0) DEFAULT NULL,
  `user_user_id` int(11) DEFAULT NULL,
  `debit_input_date` timestamp NULL DEFAULT NULL,
  `debit_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `debit`
--

INSERT INTO `debit` (`debit_id`, `debit_date`, `debit_desc`, `debit_value`, `user_user_id`, `debit_input_date`, `debit_last_update`) VALUES
(2, '2020-06-26', 'spp', '10000', 1, '2020-06-26 14:54:07', '2020-06-26 14:54:07'),
(3, '2020-06-26', 'seragam pesantren', '10000', 1, '2020-06-26 14:54:07', '2020-06-26 14:54:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `information`
--

CREATE TABLE `information` (
  `information_id` int(11) NOT NULL,
  `information_title` varchar(100) DEFAULT NULL,
  `information_desc` text,
  `information_img` varchar(255) DEFAULT NULL,
  `information_publish` tinyint(1) DEFAULT '0',
  `user_user_id` int(11) DEFAULT NULL,
  `information_input_date` timestamp NULL DEFAULT NULL,
  `information_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `information`
--

INSERT INTO `information` (`information_id`, `information_title`, `information_desc`, `information_img`, `information_publish`, `user_user_id`, `information_input_date`, `information_last_update`) VALUES
(1, 'segara lunasi', '<p>segera lunasi spp dan seragam Pesantren</p>', 'segara_lunasi.jpg', 1, 1, '2020-06-26 14:50:52', '2020-06-26 14:51:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kredit`
--

CREATE TABLE `kredit` (
  `kredit_id` int(11) NOT NULL,
  `kredit_date` date DEFAULT NULL,
  `kredit_desc` varchar(100) DEFAULT NULL,
  `kredit_value` decimal(10,0) DEFAULT NULL,
  `user_user_id` int(11) DEFAULT NULL,
  `kredit_input_date` timestamp NULL DEFAULT NULL,
  `kredit_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `letter`
--

CREATE TABLE `letter` (
  `letter_id` int(11) NOT NULL,
  `letter_number` varchar(100) DEFAULT NULL,
  `letter_month` int(11) DEFAULT NULL,
  `letter_year` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `letter`
--

INSERT INTO `letter` (`letter_id`, `letter_number`, `letter_month`, `letter_year`) VALUES
(1, '00001', 6, 2020),
(2, '00002', 6, 2020),
(3, '00003', 6, 2020);

-- --------------------------------------------------------

--
-- Struktur dari tabel `logs`
--

CREATE TABLE `logs` (
  `log_id` int(11) NOT NULL,
  `log_date` timestamp NULL DEFAULT NULL,
  `log_action` varchar(45) DEFAULT NULL,
  `log_module` varchar(45) DEFAULT NULL,
  `log_info` text,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `logs`
--

INSERT INTO `logs` (`log_id`, `log_date`, `log_action`, `log_module`, `log_info`, `user_id`) VALUES
(1, '2020-06-23 06:13:54', 'Tambah', 'Tahun Ajaran', 'ID:null;Title:2020/2021', NULL),
(2, '2020-06-26 14:02:06', 'Tambah', 'Jenis Pembayaran', 'ID:null;Title:', NULL),
(3, '2020-06-26 14:02:14', 'Tambah', 'Jenis Pembayaran', 'ID:null;Title:', NULL),
(4, '2020-06-26 14:06:42', 'Sunting', 'Student', 'ID:1;Name:Sofie Giska Nuraudila', 1),
(5, '2020-06-26 14:50:52', 'Tambah', 'Pengeluaran', 'ID:null;Title:<p>segera lunasi spp dan seragam Pesantren</p>', NULL),
(6, '2020-06-26 14:51:02', 'Sunting', 'Pengeluaran', 'ID:null;Title:<p>segera lunasi spp dan seragam Pesantren</p>', NULL),
(7, '2020-06-26 14:54:17', 'Hapus', 'Jurnal Penerimaan', 'ID:1;Title:spp', 1),
(8, '2020-06-26 14:59:17', 'Sunting', 'Jenis Pembayaran', 'ID:null;Title:', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_trx`
--

CREATE TABLE `log_trx` (
  `log_trx_id` int(11) NOT NULL,
  `student_student_id` int(11) DEFAULT NULL,
  `bulan_bulan_id` int(11) DEFAULT NULL,
  `bebas_pay_bebas_pay_id` int(11) DEFAULT NULL,
  `log_trx_input_date` timestamp NULL DEFAULT NULL,
  `log_trx_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_trx`
--

INSERT INTO `log_trx` (`log_trx_id`, `student_student_id`, `bulan_bulan_id`, `bebas_pay_bebas_pay_id`, `log_trx_input_date`, `log_trx_last_update`) VALUES
(1, 1, 1, NULL, '2020-06-26 14:13:42', '2020-06-26 14:13:42'),
(2, 2, 13, NULL, '2020-06-26 15:02:39', '2020-06-26 15:02:39'),
(3, 2, 14, NULL, '2020-06-26 15:13:36', '2020-06-26 15:13:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `majors`
--

CREATE TABLE `majors` (
  `majors_id` int(11) NOT NULL,
  `majors_name` varchar(100) DEFAULT NULL,
  `majors_short_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `month`
--

CREATE TABLE `month` (
  `month_id` int(11) NOT NULL,
  `month_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `month`
--

INSERT INTO `month` (`month_id`, `month_name`) VALUES
(1, 'Juli'),
(2, 'Agustus'),
(3, 'September'),
(4, 'Oktober'),
(5, 'November'),
(6, 'Desember'),
(7, 'Januari'),
(8, 'Februari'),
(9, 'Maret'),
(10, 'April'),
(11, 'Mei'),
(12, 'Juni');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `payment_type` enum('BEBAS','BULAN') DEFAULT NULL,
  `period_period_id` int(11) DEFAULT NULL,
  `pos_pos_id` int(11) DEFAULT NULL,
  `payment_input_date` timestamp NULL DEFAULT NULL,
  `payment_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_type`, `period_period_id`, `pos_pos_id`, `payment_input_date`, `payment_last_update`) VALUES
(1, 'BULAN', 1, 2, '2020-06-26 14:02:06', '2020-06-26 14:02:06'),
(2, 'BULAN', 1, 1, '2020-06-26 14:02:14', '2020-06-26 14:59:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `period`
--

CREATE TABLE `period` (
  `period_id` int(11) NOT NULL,
  `period_start` year(4) DEFAULT NULL,
  `period_end` year(4) DEFAULT NULL,
  `period_status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `period`
--

INSERT INTO `period` (`period_id`, `period_start`, `period_end`, `period_status`) VALUES
(1, 2020, 2021, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos`
--

CREATE TABLE `pos` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(100) DEFAULT NULL,
  `pos_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos`
--

INSERT INTO `pos` (`pos_id`, `pos_name`, `pos_description`) VALUES
(1, 'SPP', 'Iuran Pesantren'),
(2, 'Seragam Santri', 'Seragam Santri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(255) DEFAULT NULL,
  `setting_value` text,
  `setting_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`setting_id`, `setting_name`, `setting_value`, `setting_last_update`) VALUES
(1, 'setting_school', 'Pondok Pesantren', '2020-06-23 05:07:07'),
(2, 'setting_address', 'Pontianak', '2020-06-23 05:07:07'),
(3, 'setting_phone', '085787802312', '2020-06-23 05:07:07'),
(4, 'setting_district', 'Sungai Raya', '2020-06-23 05:07:07'),
(5, 'setting_city', 'Kubu Raya', '2020-06-23 05:07:07'),
(6, 'setting_logo', 'Pondok_Pesantren.jpg', '2020-06-23 05:07:07'),
(7, 'setting_level', 'primary', '2020-06-23 05:07:07'),
(8, 'setting_user_sms', '-', '2020-06-23 05:07:07'),
(9, 'setting_pass_sms', 'password', '2020-06-23 05:07:07'),
(10, 'setting_sms', 'N', '2020-06-23 05:07:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_nis` varchar(45) DEFAULT NULL,
  `student_nisn` varchar(45) DEFAULT NULL,
  `student_password` varchar(100) DEFAULT NULL,
  `student_full_name` varchar(255) DEFAULT NULL,
  `student_gender` enum('L','P') DEFAULT NULL,
  `student_born_place` varchar(45) DEFAULT NULL,
  `student_born_date` date DEFAULT NULL,
  `student_img` varchar(255) DEFAULT NULL,
  `student_phone` varchar(45) DEFAULT NULL,
  `student_hobby` varchar(100) DEFAULT NULL,
  `student_address` text,
  `student_name_of_mother` varchar(255) DEFAULT NULL,
  `student_name_of_father` varchar(255) DEFAULT NULL,
  `student_parent_phone` varchar(45) DEFAULT NULL,
  `class_class_id` int(11) DEFAULT NULL,
  `majors_majors_id` int(11) DEFAULT NULL,
  `student_status` tinyint(1) DEFAULT '1',
  `student_input_date` timestamp NULL DEFAULT NULL,
  `student_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`student_id`, `student_nis`, `student_nisn`, `student_password`, `student_full_name`, `student_gender`, `student_born_place`, `student_born_date`, `student_img`, `student_phone`, `student_hobby`, `student_address`, `student_name_of_mother`, `student_name_of_father`, `student_parent_phone`, `class_class_id`, `majors_majors_id`, `student_status`, `student_input_date`, `student_last_update`) VALUES
(1, '1122334455', '12096398', '883f2f05e19e81690ca3887b985de3160a86ab51', 'Sofie Giska Nuraudila', 'P', 'Bogor', '1994-12-10', NULL, '0816299081', 'Menyanyi', 'Bogor', 'Ibu 1', 'Ayah 1', '0816299081', 3, NULL, 1, '2020-06-26 14:05:19', '2020-06-26 14:06:42'),
(2, '1112222333', '121323424', '39adb8d1fba094029b87edf3f794b2e8dca196de', 'Fauzan', 'L', 'Pontianak', '2000-12-12', NULL, '085787802312', 'Volly Ball', 'Pontianak', 'Radei', 'Sunaidah', '0867765434', 4, NULL, 1, '2020-06-26 14:49:02', '2020-06-26 14:49:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_full_name` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_description` text,
  `user_role_role_id` int(11) DEFAULT NULL,
  `user_is_deleted` tinyint(1) DEFAULT '0',
  `user_input_date` timestamp NULL DEFAULT NULL,
  `user_last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_full_name`, `user_image`, `user_description`, `user_role_role_id`, `user_is_deleted`, `user_input_date`, `user_last_update`) VALUES
(1, 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', NULL, 'Administrator', 1, 0, '2018-01-16 03:19:33', '2018-01-16 03:19:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
(1, 'SUPERUSER'),
(2, 'USER');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bebas`
--
ALTER TABLE `bebas`
  ADD PRIMARY KEY (`bebas_id`),
  ADD KEY `fk_bebas_payment1_idx` (`payment_payment_id`),
  ADD KEY `fk_bebas_student1_idx` (`student_student_id`);

--
-- Indeks untuk tabel `bebas_pay`
--
ALTER TABLE `bebas_pay`
  ADD PRIMARY KEY (`bebas_pay_id`),
  ADD KEY `fk_bebas_pay_bebas1_idx` (`bebas_bebas_id`),
  ADD KEY `fk_bebas_pay_users1_idx` (`user_user_id`);

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`bulan_id`),
  ADD KEY `fk_bulan_payment1_idx` (`payment_payment_id`),
  ADD KEY `fk_bulan_month1_idx` (`month_month_id`),
  ADD KEY `fk_bulan_student1_idx` (`student_student_id`),
  ADD KEY `fk_bulan_users1_idx` (`user_user_id`);

--
-- Indeks untuk tabel `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indeks untuk tabel `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indeks untuk tabel `debit`
--
ALTER TABLE `debit`
  ADD PRIMARY KEY (`debit_id`),
  ADD KEY `fk_jurnal_debit_users1_idx` (`user_user_id`);

--
-- Indeks untuk tabel `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`information_id`),
  ADD KEY `fk_information_users1_idx` (`user_user_id`);

--
-- Indeks untuk tabel `kredit`
--
ALTER TABLE `kredit`
  ADD PRIMARY KEY (`kredit_id`),
  ADD KEY `fk_jurnal_kredit_users1_idx` (`user_user_id`);

--
-- Indeks untuk tabel `letter`
--
ALTER TABLE `letter`
  ADD PRIMARY KEY (`letter_id`);

--
-- Indeks untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_g_activity_log_g_user1_idx` (`user_id`);

--
-- Indeks untuk tabel `log_trx`
--
ALTER TABLE `log_trx`
  ADD PRIMARY KEY (`log_trx_id`),
  ADD KEY `fk_log_trx_bebas_pay1_idx` (`bebas_pay_bebas_pay_id`),
  ADD KEY `fk_log_trx_bulan1_idx` (`bulan_bulan_id`),
  ADD KEY `fk_log_trx_student1_idx` (`student_student_id`);

--
-- Indeks untuk tabel `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`majors_id`);

--
-- Indeks untuk tabel `month`
--
ALTER TABLE `month`
  ADD PRIMARY KEY (`month_id`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_pos1_idx` (`pos_pos_id`),
  ADD KEY `fk_payment_period1_idx` (`period_period_id`);

--
-- Indeks untuk tabel `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`period_id`);

--
-- Indeks untuk tabel `pos`
--
ALTER TABLE `pos`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indeks untuk tabel `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_student_class1_idx` (`class_class_id`),
  ADD KEY `fk_student_majors1_idx` (`majors_majors_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_user_user_role1_idx` (`user_role_role_id`);

--
-- Indeks untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bebas`
--
ALTER TABLE `bebas`
  MODIFY `bebas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bebas_pay`
--
ALTER TABLE `bebas_pay`
  MODIFY `bebas_pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bulan`
--
ALTER TABLE `bulan`
  MODIFY `bulan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `debit`
--
ALTER TABLE `debit`
  MODIFY `debit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `information`
--
ALTER TABLE `information`
  MODIFY `information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kredit`
--
ALTER TABLE `kredit`
  MODIFY `kredit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `letter`
--
ALTER TABLE `letter`
  MODIFY `letter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `log_trx`
--
ALTER TABLE `log_trx`
  MODIFY `log_trx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `majors`
--
ALTER TABLE `majors`
  MODIFY `majors_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `month`
--
ALTER TABLE `month`
  MODIFY `month_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `period`
--
ALTER TABLE `period`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pos`
--
ALTER TABLE `pos`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bebas`
--
ALTER TABLE `bebas`
  ADD CONSTRAINT `fk_bebas_payment1` FOREIGN KEY (`payment_payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_bebas_student1` FOREIGN KEY (`student_student_id`) REFERENCES `student` (`student_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `bebas_pay`
--
ALTER TABLE `bebas_pay`
  ADD CONSTRAINT `fk_bebas_pay_bebas1` FOREIGN KEY (`bebas_bebas_id`) REFERENCES `bebas` (`bebas_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_bebas_pay_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD CONSTRAINT `fk_bulan_month1` FOREIGN KEY (`month_month_id`) REFERENCES `month` (`month_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bulan_payment1` FOREIGN KEY (`payment_payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_bulan_student1` FOREIGN KEY (`student_student_id`) REFERENCES `student` (`student_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_bulan_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `debit`
--
ALTER TABLE `debit`
  ADD CONSTRAINT `fk_jurnal_debit_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `fk_information_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `kredit`
--
ALTER TABLE `kredit`
  ADD CONSTRAINT `fk_jurnal_kredit_users1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_g_activity_log_g_user1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `log_trx`
--
ALTER TABLE `log_trx`
  ADD CONSTRAINT `fk_log_trx_bebas_pay1` FOREIGN KEY (`bebas_pay_bebas_pay_id`) REFERENCES `bebas_pay` (`bebas_pay_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_log_trx_bulan1` FOREIGN KEY (`bulan_bulan_id`) REFERENCES `bulan` (`bulan_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_log_trx_student1` FOREIGN KEY (`student_student_id`) REFERENCES `student` (`student_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_period1` FOREIGN KEY (`period_period_id`) REFERENCES `period` (`period_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_payment_pos1` FOREIGN KEY (`pos_pos_id`) REFERENCES `pos` (`pos_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_class1` FOREIGN KEY (`class_class_id`) REFERENCES `class` (`class_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_student_majors1` FOREIGN KEY (`majors_majors_id`) REFERENCES `majors` (`majors_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_user_role1` FOREIGN KEY (`user_role_role_id`) REFERENCES `user_roles` (`role_id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
