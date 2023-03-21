-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2018 at 09:07 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blog`
--
INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
(1, 'SUPERUSER'),
(2, 'USER');
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_full_name`, `user_image`, `user_description`, `user_role_role_id`, `user_is_deleted`, `user_input_date`, `user_last_update`) VALUES
(1, 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', NULL, 'Administrator', 1, 0, '2018-01-16 03:19:33', '2018-01-16 03:19:44');

--
-- Dumping data for table `user_roles`
--

INSERT INTO `setting` (`setting_id`, `setting_name`, `setting_value`, `setting_last_update`) VALUES
(1, 'setting_school', '-', NOW()),
(2, 'setting_address', '-', NOW()),
(3, 'setting_phone', '-', NOW()),
(4, 'setting_district', '-', NOW()),
(5, 'setting_city', '-', NOW()),
(6, 'setting_logo', NULL, NOW()),
(7, 'setting_level', 'primary', NOW()),
(8, 'setting_user_sms', '-', NOW()),
(9, 'setting_pass_sms', 'password', NOW()),
(10, 'setting_sms', 'N', NOW());

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