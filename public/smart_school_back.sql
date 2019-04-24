-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Апр 23 2019 г., 02:51
-- Версия сервера: 5.7.25-0ubuntu0.18.04.2
-- Версия PHP: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `smart_school_back`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accesses`
--

CREATE TABLE `accesses` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `direction` tinyint(3) UNSIGNED NOT NULL,
  `cause` tinyint(3) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED DEFAULT NULL,
  `access_point_id` int(10) UNSIGNED DEFAULT NULL,
  `system_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `accesses`
--

INSERT INTO `accesses` (`id`, `time`, `date`, `direction`, `cause`, `child_id`, `access_point_id`, `system_id`) VALUES
(1, '17:59:45', '2018-12-07', 2, 2, 1, 1, 543),
(2, '19:02:37', '2018-12-10', 2, 2, 1, 1, 556),
(3, '19:33:29', '2018-12-10', 0, 1, 1, 1, 557),
(4, '19:34:49', '2018-12-10', 0, 1, 1, 1, 558),
(5, '19:41:08', '2018-12-10', 2, 2, 1, 1, 559),
(6, '19:44:28', '2018-12-10', 0, 1, 1, 1, 560),
(7, '19:48:42', '2018-12-10', 2, 2, 1, 1, 562),
(8, '19:48:46', '2018-12-10', 2, 2, 1, 1, 563),
(9, '19:48:49', '2018-12-10', 2, 2, 1, 1, 564),
(10, '19:48:53', '2018-12-10', 2, 2, 1, 1, 565),
(11, '19:49:41', '2018-12-10', 2, 2, 1, 1, 568),
(12, '19:49:44', '2018-12-10', 2, 2, 1, 1, 569),
(13, '19:51:34', '2018-12-10', 2, 2, 1, 1, 573),
(14, '19:51:37', '2018-12-10', 2, 2, 1, 1, 574),
(15, '19:54:04', '2018-12-10', 2, 2, 1, 1, 585),
(16, '18:15:35', '2018-12-11', 0, 1, 1, 1, 654),
(17, '18:20:53', '2018-12-11', 0, 1, 1, 1, 669),
(18, '10:06:13', '2018-12-17', 2, 0, 1, 1, 754),
(19, '10:10:41', '2018-12-17', 2, 0, 1, 1, 755),
(20, '10:12:35', '2018-12-17', 2, 0, 1, 1, 756),
(21, '10:15:17', '2018-12-17', 2, 0, 1, 1, 757),
(22, '10:15:52', '2018-12-17', 2, 0, 1, 1, 758),
(23, '10:17:59', '2018-12-17', 2, 0, 1, 1, 759),
(24, '10:20:21', '2018-12-17', 2, 0, 1, 1, 760),
(25, '10:21:11', '2018-12-17', 2, 0, 1, 1, 761),
(26, '10:31:01', '2018-12-17', 2, 0, 1, 1, 762),
(27, '10:31:44', '2018-12-17', 2, 1, 1, 1, 763),
(28, '10:32:18', '2018-12-17', 2, 1, 1, 1, 765),
(29, '10:32:26', '2018-12-17', 1, 1, 1, 1, 766),
(30, '10:33:34', '2018-12-17', 1, 1, 1, 1, 767),
(31, '10:34:35', '2018-12-17', 1, 1, 1, 1, 768),
(32, '10:34:53', '2018-12-17', 2, 1, 1, 1, 769),
(33, '10:56:44', '2018-12-17', 1, 1, 1, 1, 770),
(34, '11:01:45', '2018-12-17', 2, 1, 1, 1, 771),
(35, '11:03:47', '2018-12-17', 1, 1, 1, 1, 772),
(36, '11:29:13', '2018-12-17', 1, 1, 1, 1, 773),
(37, '11:29:57', '2018-12-17', 2, 1, 1, 1, 774),
(38, '16:25:31', '2018-12-17', 1, 1, 1, 1, 776),
(39, '16:26:05', '2018-12-17', 2, 1, 1, 1, 777),
(40, '16:29:52', '2018-12-17', 1, 1, 1, 1, 780),
(41, '16:36:27', '2018-12-17', 1, 1, 1, 1, 781),
(42, '16:36:47', '2018-12-17', 2, 1, 1, 1, 785),
(43, '16:36:50', '2018-12-17', 1, 1, 1, 1, 786),
(44, '16:37:11', '2018-12-17', 2, 1, 1, 1, 788),
(45, '16:37:14', '2018-12-17', 1, 1, 1, 1, 789),
(46, '16:37:17', '2018-12-17', 2, 1, 1, 1, 790),
(47, '16:38:18', '2018-12-17', 2, 1, 1, 2, 791),
(48, '16:39:02', '2018-12-17', 1, 1, 1, 2, 792),
(49, '16:39:09', '2018-12-17', 2, 1, 1, 1, 794),
(50, '16:40:49', '2018-12-17', 2, 1, 1, 1, 795),
(51, '18:21:16', '2018-12-17', 1, 1, 1, 1, 804),
(52, '18:21:23', '2018-12-17', 2, 1, 1, 1, 805),
(53, '18:21:30', '2018-12-17', 1, 1, 1, 1, 806),
(54, '18:22:05', '2018-12-17', 1, 1, 1, 1, 811),
(55, '18:22:44', '2018-12-17', 2, 1, 1, 2, 815),
(56, '18:22:53', '2018-12-17', 1, 1, 1, 1, 816),
(57, '18:51:50', '2018-12-17', 2, 1, 1, 1, 821),
(58, '18:52:01', '2018-12-17', 1, 1, 1, 1, 823),
(59, '18:55:45', '2018-12-17', 1, 1, 1, 1, 828),
(60, '18:55:49', '2018-12-17', 2, 1, 1, 1, 829),
(61, '18:56:10', '2018-12-17', 1, 1, 1, 1, 830),
(62, '18:56:16', '2018-12-17', 2, 1, 1, 1, 831),
(63, '09:48:07', '2018-12-18', 1, 1, 1, 1, 839),
(64, '09:48:40', '2018-12-18', 2, 1, 1, 1, 843),
(65, '09:49:14', '2018-12-18', 1, 1, 1, 1, 844),
(66, '09:49:19', '2018-12-18', 2, 1, 1, 1, 845),
(67, '09:53:26', '2018-12-18', 2, 1, 1, 1, 846),
(68, '09:53:34', '2018-12-18', 1, 1, 1, 1, 848),
(69, '09:57:44', '2018-12-18', 2, 1, 1, 1, 849),
(70, '09:59:00', '2018-12-18', 1, 1, 1, 1, 850),
(71, '10:01:17', '2018-12-18', 1, 1, 1, 1, 851),
(72, '10:01:23', '2018-12-18', 2, 1, 1, 1, 852),
(73, '10:01:34', '2018-12-18', 1, 1, 1, 1, 853),
(74, '10:01:40', '2018-12-18', 2, 1, 1, 1, 854),
(75, '10:05:28', '2018-12-18', 1, 1, 1, 1, 855),
(76, '10:05:33', '2018-12-18', 2, 1, 1, 1, 856),
(77, '10:13:19', '2018-12-18', 1, 1, 1, 1, 857),
(78, '10:13:27', '2018-12-18', 2, 1, 1, 1, 858),
(79, '10:52:51', '2018-12-18', 2, 1, 1, 1, 859),
(80, '10:52:56', '2018-12-18', 1, 1, 1, 1, 860),
(81, '10:56:36', '2018-12-18', 2, 1, 1, 1, 861),
(82, '10:56:44', '2018-12-18', 1, 1, 1, 1, 862),
(83, '12:21:04', '2018-12-18', 2, 1, 1, 1, 863),
(84, '12:34:02', '2018-12-18', 1, 1, 1, 1, 864),
(85, '16:28:09', '2018-12-18', 2, 1, 2, 1, 867),
(86, '16:45:09', '2018-12-18', 2, 1, 2, 1, 870),
(87, '16:45:18', '2018-12-18', 1, 1, 2, 1, 871),
(88, '09:29:12', '2018-12-19', 2, 1, 2, 1, 876),
(89, '09:30:08', '2018-12-19', 1, 1, 2, 1, 877),
(90, '09:36:12', '2018-12-19', 2, 1, 2, 1, 878),
(91, '09:36:18', '2018-12-19', 1, 1, 2, 1, 879),
(92, '09:38:46', '2018-12-19', 2, 1, 1, 1, 880),
(93, '09:38:54', '2018-12-19', 1, 1, 1, 1, 881),
(94, '09:46:56', '2018-12-19', 2, 1, 1, 1, 882),
(95, '09:47:01', '2018-12-19', 2, 1, 2, 1, 883),
(96, '09:47:07', '2018-12-19', 1, 1, 1, 1, 884),
(97, '09:47:09', '2018-12-19', 1, 1, 2, 1, 885),
(98, '09:48:08', '2018-12-19', 2, 1, 1, 1, 886),
(99, '09:48:12', '2018-12-19', 2, 1, 2, 1, 887),
(100, '10:27:10', '2018-12-19', 1, 1, 1, 1, 888),
(101, '10:27:13', '2018-12-19', 2, 1, 1, 1, 889),
(102, '10:28:39', '2018-12-19', 1, 1, 1, 1, 890),
(103, '10:28:44', '2018-12-19', 2, 1, 1, 1, 891),
(104, '10:31:55', '2018-12-19', 1, 1, 1, 1, 892),
(105, '10:31:59', '2018-12-19', 2, 1, 1, 1, 893),
(106, '10:34:11', '2018-12-19', 1, 1, 1, 1, 894),
(107, '10:34:15', '2018-12-19', 2, 1, 1, 1, 895),
(108, '10:37:43', '2018-12-19', 1, 1, 1, 1, 896),
(109, '10:37:46', '2018-12-19', 2, 1, 1, 1, 897),
(110, '18:46:59', '2018-12-25', 2, 1, 1, 2, 903),
(111, '18:47:07', '2018-12-25', 1, 1, 1, 2, 904),
(112, '18:47:37', '2018-12-25', 2, 1, 1, 1, 905),
(113, '18:47:46', '2018-12-25', 1, 1, 1, 2, 908),
(114, '18:51:15', '2018-12-25', 2, 1, 1, 1, 914),
(115, '14:26:12', '2018-12-26', 2, 1, 1, 1, 948),
(116, '14:26:49', '2018-12-26', 2, 1, 1, 1, 958),
(117, '14:26:55', '2018-12-26', 1, 1, 1, 1, 959),
(118, '14:29:21', '2018-12-26', 2, 1, 1, 1, 971),
(119, '14:31:20', '2018-12-26', 1, 1, 1, 2, 980),
(120, '14:31:52', '2018-12-26', 2, 1, 1, 2, 981),
(121, '09:39:04', '2018-12-28', 2, 1, 1, 1, 987),
(122, '09:21:45', '2018-12-29', 2, 1, 1, 1, 992),
(123, '09:21:50', '2018-12-29', 1, 1, 1, 1, 993),
(124, '09:52:50', '2018-12-29', 2, 1, 1, 1, 994),
(125, '09:52:56', '2018-12-29', 1, 1, 1, 2, 995),
(126, '13:16:55', '2018-12-29', 2, 1, 1, 1, 1000),
(127, '13:17:08', '2018-12-29', 1, 1, 1, 1, 1004),
(128, '13:17:32', '2018-12-29', 2, 1, 1, 2, 1007),
(129, '13:26:24', '2019-01-09', 2, 1, 1, 1, 1013),
(130, '13:26:29', '2019-01-09', 1, 1, 1, 2, 1014),
(131, '13:27:02', '2019-01-09', 2, 1, 1, 1, 1015),
(132, '13:27:06', '2019-01-09', 1, 1, 1, 2, 1016),
(133, '13:27:25', '2019-01-09', 2, 1, 2, 1, 1017),
(134, '13:27:30', '2019-01-09', 1, 1, 2, 2, 1018),
(135, '13:27:54', '2019-01-09', 1, 1, 1, 2, 1020),
(136, '13:28:03', '2019-01-09', 2, 1, 2, 1, 1021),
(137, '12:35:11', '2019-01-16', 2, 1, 1, 1, 1066),
(138, '12:41:24', '2019-01-16', 2, 1, 1, 1, 1067),
(139, '12:50:06', '2019-01-16', 2, 1, 1, 1, 1068),
(140, '12:53:07', '2019-01-16', 2, 1, 1, 1, 1069),
(141, '12:53:51', '2019-01-16', 1, 1, 1, 2, 1071),
(142, '13:18:53', '2019-01-16', 2, 1, 2, 1, 1072),
(143, '13:20:31', '2019-01-16', 2, 1, 2, 1, NULL),
(144, '13:21:06', '2019-01-16', 2, 1, 2, 1, 1075),
(145, '16:45:22', '2019-01-17', 1, 1, 1, 1, 1080),
(146, '16:45:28', '2019-01-17', 2, 1, 1, 2, NULL),
(147, '16:45:38', '2019-01-17', 1, 1, 1, 2, 1082),
(148, '16:45:46', '2019-01-17', 2, 1, 1, 2, 1084),
(149, '18:13:19', '2019-01-17', 2, 1, 1, 1, 1085),
(150, '18:13:29', '2019-01-17', 1, 1, 1, 1, 1088),
(151, '12:28:44', '2019-01-21', 2, 1, 1, 1, 1093),
(152, '12:28:48', '2019-01-21', 1, 1, 1, 2, NULL),
(153, '12:28:59', '2019-01-21', 1, 1, 2, 2, 1096),
(154, '12:29:05', '2019-01-21', 2, 1, 2, 1, 1097),
(155, '12:29:18', '2019-01-21', 2, 1, 1, 1, 1098),
(156, '12:29:24', '2019-01-21', 1, 1, 1, 2, NULL),
(157, '12:29:30', '2019-01-21', 1, 1, 2, 2, NULL),
(158, '12:29:36', '2019-01-21', 2, 1, 2, 1, 1101),
(159, '13:25:50', '2019-01-22', 2, 1, 1, 2, 1154),
(160, '13:26:23', '2019-01-22', 1, 1, 1, 2, NULL),
(161, '13:26:37', '2019-01-22', 2, 1, 1, 2, 1163),
(162, '13:26:45', '2019-01-22', 1, 1, 1, 1, 1164),
(163, '13:31:43', '2019-01-22', 2, 1, 1, 2, NULL),
(164, '13:31:50', '2019-01-22', 1, 1, 1, 1, 1166),
(165, '13:32:57', '2019-01-22', 1, 1, 1, 2, 1171),
(166, '14:08:08', '2019-01-22', 2, 1, 1, 2, 1176),
(167, '14:08:17', '2019-01-22', 1, 1, 1, 1, 1177),
(168, '14:08:55', '2019-01-22', 2, 1, 1, 2, NULL),
(169, '14:09:01', '2019-01-22', 1, 1, 1, 2, 1179),
(170, '14:17:36', '2019-01-22', 2, 1, 1, 2, NULL),
(171, '14:17:45', '2019-01-22', 1, 1, 1, 2, 1181),
(172, '15:44:14', '2019-01-22', 2, 1, 1, 2, 1186),
(173, '15:53:51', '2019-01-22', 2, 1, 1, 2, 1190),
(174, '15:54:08', '2019-01-22', 1, 1, 1, 1, NULL),
(175, '15:54:13', '2019-01-22', 2, 1, 1, 1, 1192),
(176, '18:19:37', '2019-01-23', 2, 1, 1, 1, 1224),
(177, '18:44:23', '2019-01-23', 2, 1, 1, 1, 1237),
(178, '18:45:30', '2019-01-23', 2, 1, 1, 1, 1238),
(179, '10:30:10', '2019-01-24', 2, 1, 1, 1, 1249),
(180, '10:30:16', '2019-01-24', 1, 1, 1, 1, 1250),
(181, '10:30:31', '2019-01-24', 2, 1, 1, 1, NULL),
(182, '13:36:49', '2019-01-24', 2, 1, 1, 1, 1264),
(183, '12:07:02', '2019-01-28', 2, 1, 2, 1, 1278),
(184, '12:11:43', '2019-01-28', 1, 1, 2, 1, 1279),
(185, '12:16:20', '2019-01-28', 2, 1, 1, 1, NULL),
(186, '12:16:53', '2019-01-28', 1, 1, 1, 1, 1281),
(187, '12:17:54', '2019-01-28', 2, 1, 2, 1, 1282),
(188, '12:22:58', '2019-01-28', 1, 1, 2, 1, 1283),
(189, '16:15:37', '2019-01-28', 2, 1, 2, 1, 1284),
(190, '16:15:44', '2019-01-28', 1, 1, 2, 1, 1285),
(191, '16:34:02', '2019-01-28', 1, 1, 2, 1, 1291),
(192, '16:58:59', '2019-01-28', 2, 1, 2, 1, 1292),
(193, '17:07:04', '2019-01-28', 2, 1, 2, 1, 1295),
(194, '18:03:00', '2019-01-28', 1, 1, 2, 1, 1296),
(195, '18:03:38', '2019-01-28', 2, 1, 2, 1, 1297),
(196, '18:03:47', '2019-01-28', 2, 1, 1, 1, NULL),
(197, '18:03:52', '2019-01-28', 1, 1, 1, 1, NULL),
(198, '15:59:33', '2019-01-29', 2, 1, 1, 1, 1314),
(199, '15:59:38', '2019-01-29', 2, 1, 2, 1, 1315),
(200, '16:33:22', '2019-01-29', 2, 1, 1, 1, 1320),
(201, '16:35:19', '2019-01-29', 2, 1, 1, 1, 1322);

-- --------------------------------------------------------

--
-- Структура таблицы `access_denials`
--

CREATE TABLE `access_denials` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `direction` tinyint(3) UNSIGNED NOT NULL,
  `cause` tinyint(3) UNSIGNED NOT NULL,
  `key_id` int(10) UNSIGNED DEFAULT NULL,
  `access_point_id` int(10) UNSIGNED DEFAULT NULL,
  `system_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `access_points`
--

CREATE TABLE `access_points` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zonea` int(10) UNSIGNED DEFAULT NULL,
  `zoneb` int(10) UNSIGNED DEFAULT NULL,
  `school_id` int(10) UNSIGNED DEFAULT NULL,
  `system_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `access_points`
--

INSERT INTO `access_points` (`id`, `name`, `zonea`, `zoneb`, `school_id`, `system_id`) VALUES
(1, 'Основной проход', 0, 0, 1, 1),
(2, 'Основной проход', 0, 0, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `school_id` int(10) UNSIGNED DEFAULT NULL,
  `locality_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `profile_id`, `user_id`, `school_id`, `locality_id`) VALUES
(1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `children`
--

CREATE TABLE `children` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED DEFAULT NULL,
  `class_id` int(10) UNSIGNED DEFAULT NULL,
  `photo_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `inn` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `system_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `children`
--

INSERT INTO `children` (`id`, `profile_id`, `class_id`, `photo_id`, `user_id`, `inn`, `system_id`) VALUES
(1, 1, 1, NULL, NULL, 'A000000001', 5),
(2, 2, 1, NULL, NULL, 'A000000002', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `children_keys`
--

CREATE TABLE `children_keys` (
  `id` int(10) UNSIGNED NOT NULL,
  `codekey` varbinary(8) DEFAULT NULL,
  `short_codekey` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codekeytime` datetime NOT NULL,
  `expires` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `child_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `children_keys`
--

INSERT INTO `children_keys` (`id`, `codekey`, `short_codekey`, `codekeytime`, `expires`, `status`, `child_id`) VALUES
(1, 0x20634075b6000000, '20001', '2018-12-26 14:31:00', NULL, 1, 1),
(2, 0x20c248eba6000000, '20002', '2018-12-19 09:37:57', NULL, 1, 2),
(3, NULL, '00001', '2019-04-23 00:00:00', NULL, 1, NULL),
(4, NULL, '00002', '2019-04-23 00:00:00', NULL, 1, NULL),
(5, NULL, '00003', '2019-04-23 00:00:00', NULL, 1, NULL),
(6, NULL, '00004', '2019-04-23 00:00:00', NULL, 1, NULL),
(7, NULL, '00005', '2019-04-23 00:00:00', NULL, 1, NULL),
(8, NULL, '00006', '2019-04-23 00:00:00', NULL, 1, NULL),
(9, NULL, '00007', '2019-04-23 00:00:00', NULL, 1, NULL),
(10, NULL, '00008', '2019-04-23 00:00:00', NULL, 1, NULL),
(11, NULL, '00009', '2019-04-23 00:00:00', NULL, 1, NULL),
(12, NULL, '00010', '2019-04-23 00:00:00', NULL, 1, NULL),
(13, NULL, '00011', '2019-04-23 00:00:00', NULL, 1, NULL),
(14, NULL, '00012', '2019-04-23 00:00:00', NULL, 1, NULL),
(15, NULL, '00013', '2019-04-23 00:00:00', NULL, 1, NULL),
(16, NULL, '00014', '2019-04-23 00:00:00', NULL, 1, NULL),
(17, NULL, '00015', '2019-04-23 00:00:00', NULL, 1, NULL),
(18, NULL, '00016', '2019-04-23 00:00:00', NULL, 1, NULL),
(19, NULL, '00017', '2019-04-23 00:00:00', NULL, 1, NULL),
(20, NULL, '00018', '2019-04-23 00:00:00', NULL, 1, NULL),
(21, NULL, '00019', '2019-04-23 00:00:00', NULL, 1, NULL),
(22, NULL, '00020', '2019-04-23 00:00:00', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `children_parents`
--

CREATE TABLE `children_parents` (
  `id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `children_parents`
--

INSERT INTO `children_parents` (`id`, `child_id`, `parent_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 1),
(5, 2, 2),
(6, 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
--

CREATE TABLE `classes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `school_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `classes`
--

INSERT INTO `classes` (`id`, `name`, `admin_id`, `school_id`) VALUES
(1, '5-А', NULL, 1),
(2, '6-А', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `localities`
--

CREATE TABLE `localities` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locality_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `localities`
--

INSERT INTO `localities` (`id`, `type`, `name`, `locality_id`) VALUES
(1, 0, 'Донецкая Народная Республика', NULL),
(2, 0, 'Докучаевск', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(33, '2014_09_27_155321_create_profiles', 1),
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_resets_table', 1),
(36, '2018_11_17_160005_create_localities', 1),
(37, '2018_11_18_105307_create_schools', 1),
(38, '2018_12_07_201113_create_parents', 1),
(39, '2018_12_07_203510_create_photos', 1),
(40, '2018_12_07_203511_create_classes', 1),
(41, '2018_12_07_203512_create_children', 1),
(42, '2018_12_07_203513_create_children_keys', 1),
(43, '2018_12_07_214420_create_children_parents', 1),
(44, '2018_12_07_214526_create_access_points', 1),
(45, '2018_12_07_214817_create_accesses', 1),
(46, '2018_12_07_220000_create_access_denials', 1),
(47, '2018_12_21_235854_create_settings', 1),
(48, '2019_03_19_152052_create_admins', 1),
(49, '2019_04_19_043257_create_jobs_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `parents`
--

CREATE TABLE `parents` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `inn` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `parents`
--

INSERT INTO `parents` (`id`, `profile_id`, `user_id`, `inn`, `parent_id`) VALUES
(1, 3, 1, '000000000A', NULL),
(2, 4, 2, '000000000B', NULL),
(3, 5, 3, '000000000C', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`id`, `surname`, `name`, `patronymic`) VALUES
(1, 'Иванов', 'Иван', 'Иванович'),
(2, 'Петров', 'Пётр', 'Петрович'),
(3, 'Родителев', 'Сидор', 'Сидорович'),
(4, 'Фёдоров', 'Фёдор', 'Фёдорович'),
(5, 'Васильев', 'Василий', 'Васильевич');

-- --------------------------------------------------------

--
-- Структура таблицы `schools`
--

CREATE TABLE `schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locality_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `schools`
--

INSERT INTO `schools` (`id`, `address`, `name`, `locality_id`) VALUES
(1, 'г. Докучаевск, ул. Ленина, 65', 'Докучаевская общеобразовательная школа I-II ступеней, №3', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `user_id`) VALUES
(1, 'notification_of_access', '1', 1),
(2, 'notification_of_access', '1', 2),
(3, 'notification_of_access', '0', 3),
(4, 'notification_of_access_telegram', '1', 1),
(5, 'notification_of_access_telegram', '1', 2),
(6, 'notification_of_access_telegram', '1', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `enabled` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `roles`, `email`, `phone`, `password`, `email_verified_at`, `enabled`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '0,12', '@bbldn05', '380713250323', '$2y$10$x/1NT8vlKwky744CDnhxHuqbBuL9caOtNFD5cXOy3oyNm.1Xk9iGW', NULL, 1, 'S2n257f00sJZBIXfT9gyeNCHCSzxOhyQNledkQLVAYq4HzWTrVyLqlGb3Ok3', '2018-12-12 00:20:01', '2019-04-01 11:30:10'),
(2, '0,12', '@morgan', '380713007850', '$2y$10$x/1NT8vlKwky744CDnhxHuqbBuL9caOtNFD5cXOy3oyNm.1Xk9iGW', NULL, 1, NULL, '2018-12-12 09:00:00', '2019-01-12 07:05:41'),
(3, '0,12', '@genadiy', '380713577843', '$2y$10$x/1NT8vlKwky744CDnhxHuqbBuL9caOtNFD5cXOy3oyNm.1Xk9iGW', NULL, 1, NULL, '2018-12-12 09:00:00', '2019-01-11 03:54:42'),
(4, '0,12', '@shepard', '380713961217', '$2y$10$7SVUfDANa6eoSWSGhfUItedAi7wLdu0nDffGmlByewlZ7KJktQFHK', NULL, 1, NULL, '2019-03-26 12:30:49', '2019-03-26 12:30:16');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accesses`
--
ALTER TABLE `accesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_child_id_foreign` (`child_id`),
  ADD KEY `access_access_point_id_foreign` (`access_point_id`);

--
-- Индексы таблицы `access_denials`
--
ALTER TABLE `access_denials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_denials_key_id_foreign` (`key_id`),
  ADD KEY `access_denials_access_point_id_foreign` (`access_point_id`);

--
-- Индексы таблицы `access_points`
--
ALTER TABLE `access_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_points_school_id_foreign` (`school_id`);

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_user_id_unique` (`user_id`),
  ADD KEY `admins_profile_id_foreign` (`profile_id`),
  ADD KEY `admins_locality_id_foreign` (`locality_id`),
  ADD KEY `admins_school_id_foreign` (`school_id`);

--
-- Индексы таблицы `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inn` (`inn`),
  ADD UNIQUE KEY `children_user_id_unique` (`user_id`),
  ADD KEY `children_profile_id_foreign` (`profile_id`),
  ADD KEY `children_class_id_foreign` (`class_id`),
  ADD KEY `children_photo_id_foreign` (`photo_id`);

--
-- Индексы таблицы `children_keys`
--
ALTER TABLE `children_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_codekey` (`short_codekey`),
  ADD KEY `children_keys_child_id_foreign` (`child_id`);

--
-- Индексы таблицы `children_parents`
--
ALTER TABLE `children_parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `children_parents_child_id_foreign` (`child_id`),
  ADD KEY `children_parents_parent_id_foreign` (`parent_id`);

--
-- Индексы таблицы `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_school_id_foreign` (`school_id`),
  ADD KEY `classes_admin_id_foreign` (`admin_id`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `localities`
--
ALTER TABLE `localities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `localities_locality_id_foreign` (`locality_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inn` (`inn`),
  ADD UNIQUE KEY `parents_user_id_unique` (`user_id`),
  ADD KEY `parents_profile_id_foreign` (`profile_id`),
  ADD KEY `parents_parent_id_foreign` (`parent_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schools_locality_id_foreign` (`locality_id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `settings_user_id_unique` (`user_id`) USING BTREE;

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accesses`
--
ALTER TABLE `accesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
--
-- AUTO_INCREMENT для таблицы `access_denials`
--
ALTER TABLE `access_denials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `access_points`
--
ALTER TABLE `access_points`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `children`
--
ALTER TABLE `children`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `children_keys`
--
ALTER TABLE `children_keys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `children_parents`
--
ALTER TABLE `children_parents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `localities`
--
ALTER TABLE `localities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT для таблицы `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accesses`
--
ALTER TABLE `accesses`
  ADD CONSTRAINT `access_access_point_id_foreign` FOREIGN KEY (`access_point_id`) REFERENCES `access_points` (`id`),
  ADD CONSTRAINT `access_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`);

--
-- Ограничения внешнего ключа таблицы `access_denials`
--
ALTER TABLE `access_denials`
  ADD CONSTRAINT `access_denials_access_point_id_foreign` FOREIGN KEY (`access_point_id`) REFERENCES `access_points` (`id`),
  ADD CONSTRAINT `access_denials_key_id_foreign` FOREIGN KEY (`key_id`) REFERENCES `children_keys` (`id`);

--
-- Ограничения внешнего ключа таблицы `access_points`
--
ALTER TABLE `access_points`
  ADD CONSTRAINT `access_points_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ограничения внешнего ключа таблицы `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_locality_id_foreign` FOREIGN KEY (`locality_id`) REFERENCES `localities` (`id`),
  ADD CONSTRAINT `admins_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  ADD CONSTRAINT `admins_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`),
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `children_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`),
  ADD CONSTRAINT `children_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  ADD CONSTRAINT `children_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `children_keys`
--
ALTER TABLE `children_keys`
  ADD CONSTRAINT `children_keys_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`);

--
-- Ограничения внешнего ключа таблицы `children_parents`
--
ALTER TABLE `children_parents`
  ADD CONSTRAINT `children_parents_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`),
  ADD CONSTRAINT `children_parents_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`);

--
-- Ограничения внешнего ключа таблицы `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `classes_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`);

--
-- Ограничения внешнего ключа таблицы `localities`
--
ALTER TABLE `localities`
  ADD CONSTRAINT `localities_locality_id_foreign` FOREIGN KEY (`locality_id`) REFERENCES `localities` (`id`);

--
-- Ограничения внешнего ключа таблицы `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`),
  ADD CONSTRAINT `parents_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`),
  ADD CONSTRAINT `parents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `schools`
--
ALTER TABLE `schools`
  ADD CONSTRAINT `schools_locality_id_foreign` FOREIGN KEY (`locality_id`) REFERENCES `localities` (`id`);

--
-- Ограничения внешнего ключа таблицы `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
