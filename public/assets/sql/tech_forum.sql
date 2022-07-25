-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2022 at 02:23 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tech_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Hardware', '2022-04-08 15:19:34', '2022-04-08 15:19:34'),
(2, 'Software', '2022-04-08 15:19:34', '2022-04-08 15:19:34'),
(3, 'Laptops and mobile devices', '2022-04-08 15:19:34', '2022-04-08 15:19:34');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_04_08_111445_create_categories_table', 1),
(3, '2022_04_08_113647_create_topics_table', 1),
(7, '2022_04_11_103234_create_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notified_user` int(11) NOT NULL,
  `trigger_user` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `response_id` int(11) DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notified_user`, `trigger_user`, `event_id`, `response_id`, `viewed`, `created_at`, `updated_at`) VALUES
(2, 3, 4, 1, 13, 0, '2022-04-21 11:53:49', '2022-04-21 11:53:49'),
(3, 3, 4, 1, 14, 0, '2022-04-21 13:27:36', '2022-04-21 13:27:36'),
(4, 4, 3, 3, 4, 0, '2022-04-22 10:53:38', '2022-04-22 10:53:38'),
(5, 3, 4, 1, 15, 0, '2022-04-22 10:55:35', '2022-04-22 10:55:35'),
(20, 7, 3, 1, 34, 0, '2022-05-04 14:17:12', '2022-05-04 14:17:12'),
(21, 7, 4, 1, 35, 0, '2022-05-04 14:18:57', '2022-05-04 14:18:57'),
(22, 7, 4, 1, 36, 0, '2022-05-04 14:19:43', '2022-05-04 14:19:43'),
(23, 7, 4, 1, 37, 0, '2022-05-04 14:19:54', '2022-05-04 14:19:54'),
(24, 7, 4, 1, 38, 0, '2022-05-04 14:19:58', '2022-05-04 14:19:58'),
(26, 6, 3, 1, 40, 0, '2022-05-04 14:29:25', '2022-05-04 14:29:25'),
(27, 6, 5, 1, 41, 0, '2022-05-04 14:30:46', '2022-05-04 14:30:46'),
(28, 6, 5, 1, 42, 0, '2022-05-04 14:30:53', '2022-05-04 14:30:53'),
(29, 6, 5, 1, 43, 0, '2022-05-04 14:31:33', '2022-05-04 14:31:33'),
(31, 5, 3, 1, 45, 0, '2022-05-04 14:37:54', '2022-05-04 14:37:54'),
(32, 5, 3, 1, 46, 0, '2022-05-04 14:38:26', '2022-05-04 14:38:26'),
(33, 5, 3, 1, 47, 0, '2022-05-04 14:39:10', '2022-05-04 14:39:10'),
(34, 5, 3, 1, 53, 0, '2022-05-04 14:56:51', '2022-05-04 14:56:51'),
(36, 5, 3, 1, 54, 0, '2022-05-04 14:58:18', '2022-05-04 14:58:18'),
(39, 3, 6, 1, 56, 0, '2022-05-04 14:59:25', '2022-05-04 14:59:25'),
(40, 3, 6, 1, 57, 0, '2022-05-04 14:59:38', '2022-05-04 14:59:38'),
(43, 4, 3, 1, 59, 0, '2022-05-04 15:01:23', '2022-05-04 15:01:23'),
(44, 4, 3, 1, 60, 0, '2022-05-04 15:01:35', '2022-05-04 15:01:35'),
(46, 4, 3, 1, 61, 0, '2022-05-04 15:01:45', '2022-05-04 15:01:45'),
(47, 4, 3, 1, 62, 0, '2022-05-04 15:01:53', '2022-05-04 15:01:53'),
(49, 5, 6, 1, 64, 0, '2022-05-04 15:05:57', '2022-05-04 15:05:57'),
(50, 5, 6, 1, 65, 0, '2022-05-04 15:06:13', '2022-05-04 15:06:13'),
(51, 5, 6, 1, 66, 0, '2022-05-04 15:06:36', '2022-05-04 15:06:36'),
(52, 5, 6, 1, 67, 0, '2022-05-04 15:06:46', '2022-05-04 15:06:46'),
(69, 4, 3, 1, 84, 0, '2022-06-06 11:22:50', '2022-06-06 11:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_event`
--

CREATE TABLE `notifications_event` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `text` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications_event`
--

INSERT INTO `notifications_event` (`id`, `name`, `text`, `created_at`, `updated_at`) VALUES
(1, 'reply', 'has replied to your post', '2022-04-20 15:09:02', '2022-04-20 15:09:02'),
(2, 'removal', 'has removed your post', '2022-04-20 15:09:02', '2022-04-20 15:09:02'),
(3, 'edit', 'has edited your post', '2022-04-22 10:29:58', '2022-04-22 10:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `type` varchar(200) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `type`, `views`) VALUES
(1, 'Home', 'Browsing', 352),
(2, 'Search', 'Browsing', 15),
(3, 'Panel', 'Options', 121),
(4, 'Register', 'Authentication', 63),
(5, 'Login', 'Authentication', 171);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `response_id` int(11) DEFAULT NULL,
  `main` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`id`, `thread_id`, `user_id`, `content`, `response_id`, `main`, `created_at`, `updated_at`) VALUES
(33, 48, 7, 'It’s really more of an economics question at this point. My 3090 runs well, but I’m trying to maximize performance per dollar. Are GPU prices expected to plummet anytime soon?\r\nThe 3090 ti probably won’t maintain value once the 4xxx series is released, but neither will the 3090.', NULL, 1, '2022-05-04 12:55:59', '2022-05-04 12:55:59'),
(34, 48, 3, 'The price will go down when/if talk is not that strong too (2080TI will plummet once the Ampere launch and so on really did not happen), depend on the price point and obviously actually possibility to buy Lovelace, if it feels like it is not certain to be something you can buy in spring 3-4 months after launch, price could maintain.\r\n\r\nDoes the $300 spending include taxes ? Is still possible to sell an used (with all that could mean warrenty wise) 3090 that much $1900 or so when you can buy a new full under warranty TI version for \"only\" $2000+taxes ? If so that would make sense, performance boost and you\'re relaunching the warranty to zero with such big item.', 33, 0, '2022-05-04 14:17:12', '2022-05-05 11:47:24'),
(35, 48, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 0, '2022-05-04 14:18:57', '2022-05-05 11:47:26'),
(36, 48, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 0, '2022-05-04 14:19:43', '2022-05-04 14:19:43'),
(37, 48, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 0, '2022-05-04 14:19:54', '2022-05-04 14:19:54'),
(38, 48, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 0, '2022-05-04 14:19:58', '2022-05-04 14:19:58'),
(39, 49, 6, 'So I\'ve had a NZXT G12 AIO bracket on my 2080ti for a couple of years now. It\'s been working great and generally still does with gaming but when mining the temp will quickly climb up to 90c (even with underclocking and a 65% power limit). I am using an old Corsair H100 on it and when I shake the radiator it sounds like there\'s a lot of splashing so I\'m guessing a lot of the coolant has evaporated by now. The problem is that there are very few radiators compatible with the G12 now as it was made for the old Asetek \"twist to lock\" units that have been discontinued for a while now.\r\n\r\nAny one have any suggestions on GPU AIOs or air coolers that are compatible?', NULL, 1, '2022-05-04 14:25:39', '2022-05-04 14:25:39'),
(40, 49, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 39, 0, '2022-05-04 14:29:25', '2022-05-05 11:45:56'),
(41, 49, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 0, '2022-05-04 14:30:46', '2022-05-04 14:30:46'),
(42, 49, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 0, '2022-05-04 14:30:53', '2022-05-04 14:30:53'),
(43, 49, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 0, '2022-05-04 14:31:33', '2022-05-04 14:31:33'),
(44, 50, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 1, '2022-05-04 14:33:22', '2022-05-04 14:33:22'),
(45, 50, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 44, 0, '2022-05-04 14:37:54', '2022-05-04 14:58:05'),
(46, 50, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, 0, '2022-05-04 14:38:26', '2022-05-04 14:38:26'),
(47, 50, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate.', NULL, 0, '2022-05-04 14:39:10', '2022-05-04 14:39:10'),
(54, 50, 3, 'Random response', 47, 0, '2022-05-04 14:58:18', '2022-05-04 14:58:18'),
(55, 51, 3, 'First message', NULL, 1, '2022-05-04 14:58:53', '2022-05-04 14:58:53'),
(56, 51, 6, 'New reply', NULL, 0, '2022-05-04 14:59:25', '2022-05-04 14:59:25'),
(57, 51, 6, 'Reply to a reply', 56, 0, '2022-05-04 14:59:38', '2022-05-04 14:59:38'),
(58, 52, 4, 'Main message', NULL, 1, '2022-05-04 15:00:48', '2022-05-04 15:00:48'),
(59, 52, 3, 'Frist reply', NULL, 0, '2022-05-04 15:01:23', '2022-05-04 15:01:23'),
(60, 52, 3, 'Replyyyyy', 59, 0, '2022-05-04 15:01:35', '2022-05-04 15:01:35'),
(63, 53, 5, 'Adassadasdasdasdasd', NULL, 1, '2022-05-04 15:04:54', '2022-05-04 15:04:54'),
(64, 53, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor \r\nincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation \r\nullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', 63, 0, '2022-05-04 15:05:57', '2022-05-04 15:05:57'),
(65, 53, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor \r\nincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation \r\nullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in \r\nreprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, 0, '2022-05-04 15:06:13', '2022-05-04 15:06:13'),
(66, 53, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor \r\nincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation', NULL, 0, '2022-05-04 15:06:36', '2022-05-04 15:06:36'),
(67, 53, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor \r\nincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation', NULL, 0, '2022-05-04 15:06:46', '2022-05-04 15:06:46'),
(68, 54, 6, 'Texttttt', NULL, 1, '2022-05-04 15:08:40', '2022-05-04 15:08:40'),
(69, 54, 6, 'ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in \r\nreprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', NULL, 0, '2022-05-04 15:08:50', '2022-05-04 15:08:50'),
(70, 55, 6, 'Text text text', NULL, 1, '2022-05-04 15:09:09', '2022-05-04 15:09:09'),
(71, 55, 6, 'Reply', 70, 0, '2022-05-04 15:09:20', '2022-05-04 15:09:20'),
(72, 56, 6, 'Thread text', NULL, 1, '2022-05-04 15:09:39', '2022-05-04 15:09:39'),
(73, 56, 6, 'Aaasdas', 72, 0, '2022-05-04 15:09:53', '2022-05-04 15:09:53'),
(74, 57, 7, 'Sed esse odio est laboriosam corrupti aut alias culpa. Vel totam aperiam et ipsum veritatis et molestiae illum ut aspernatur consequatur eos exercitationem aliquid ex omnis corrupti.', NULL, 1, '2022-05-04 15:12:44', '2022-05-04 15:12:44'),
(75, 58, 7, 'Lorem ipsum', NULL, 1, '2022-05-04 15:14:25', '2022-05-04 15:14:25'),
(76, 58, 7, 'Reply', 75, 0, '2022-05-04 15:14:30', '2022-05-04 15:14:30'),
(77, 59, 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro et quidem in atque fuga, quisquam optio commodi harum dolorem voluptas aspernatur accusamus.', NULL, 1, '2022-05-04 15:16:44', '2022-05-04 15:16:44'),
(78, 60, 7, 'New text', NULL, 1, '2022-05-04 15:17:42', '2022-05-04 15:17:42'),
(79, 61, 7, 'Incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation \r\nullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', NULL, 1, '2022-05-04 15:19:10', '2022-05-04 15:19:10'),
(80, 62, 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro et quidem in atque fuga, quisquam optio commodi harum dolorem voluptas aspernatur accusamus.', NULL, 1, '2022-05-04 15:19:26', '2022-05-04 15:19:26'),
(81, 63, 7, 'Text', NULL, 1, '2022-05-04 15:20:11', '2022-05-04 15:20:11'),
(82, 64, 7, 'New question', NULL, 1, '2022-05-04 15:20:27', '2022-05-04 15:20:27'),
(83, 65, 6, 'Whatever', NULL, 1, '2022-05-05 11:27:21', '2022-05-05 11:27:21'),
(84, 52, 3, 'Another reply', 60, 0, '2022-06-06 11:22:50', '2022-06-06 11:22:50'),
(85, 51, 3, 'One More', NULL, 0, '2022-06-06 11:24:00', '2022-06-06 11:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `response_image`
--

CREATE TABLE `response_image` (
  `id` int(11) NOT NULL,
  `response_id` int(11) NOT NULL,
  `image_name` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `response_image`
--

INSERT INTO `response_image` (`id`, `response_id`, `image_name`, `created_at`, `updated_at`) VALUES
(3, 6, '16499462900.jpg', '2022-04-14 14:24:50', '2022-04-14 14:24:50'),
(4, 6, '16499462901.png', '2022-04-14 14:24:50', '2022-04-14 14:24:50'),
(5, 8, '16499625730.png', '2022-04-14 18:56:13', '2022-04-14 18:56:13'),
(9, 33, '16516689590.png', '2022-05-04 12:55:59', '2022-05-04 12:55:59'),
(10, 33, '16516689591.jpg', '2022-05-04 12:55:59', '2022-05-04 12:55:59'),
(11, 40, '16516745650.jpg', '2022-05-04 14:29:25', '2022-05-04 14:29:25'),
(12, 43, '16516746930.jpg', '2022-05-04 14:31:33', '2022-05-04 14:31:33'),
(13, 44, '16516748020.jpg', '2022-05-04 14:33:22', '2022-05-04 14:33:22'),
(14, 44, '16516748021.jpg', '2022-05-04 14:33:22', '2022-05-04 14:33:22'),
(15, 45, '16516750740.jpg', '2022-05-04 14:37:54', '2022-05-04 14:37:54'),
(16, 46, '16516751060.jpg', '2022-05-04 14:38:26', '2022-05-04 14:38:26'),
(17, 46, '16516751061.jpg', '2022-05-04 14:38:26', '2022-05-04 14:38:26'),
(18, 46, '16516751062.jpg', '2022-05-04 14:38:26', '2022-05-04 14:38:26'),
(19, 47, '16516751500.jpg', '2022-05-04 14:39:10', '2022-05-04 14:39:10'),
(20, 47, '16516751501.jpg', '2022-05-04 14:39:10', '2022-05-04 14:39:10'),
(21, 57, '16516763780.jpg', '2022-05-04 14:59:38', '2022-05-04 14:59:38'),
(22, 58, '16516764480.jpg', '2022-05-04 15:00:48', '2022-05-04 15:00:48'),
(23, 58, '16516764481.jpg', '2022-05-04 15:00:48', '2022-05-04 15:00:48'),
(24, 64, '16516767570.jpg', '2022-05-04 15:05:57', '2022-05-04 15:05:57'),
(25, 66, '16516767960.jpg', '2022-05-04 15:06:36', '2022-05-04 15:06:36'),
(26, 73, '16516769930.png', '2022-05-04 15:09:53', '2022-05-04 15:09:53'),
(27, 81, '16516776110.jpg', '2022-05-04 15:20:11', '2022-05-04 15:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `topic_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `title`, `topic_id`, `user_id`, `views`, `created_at`, `updated_at`) VALUES
(48, 'Upgrade to 3090 ti or wait for 4090?', 18, 7, 28, '2022-05-04 12:55:59', '2022-05-05 12:15:27'),
(49, '2080ti cooling options', 18, 6, 19, '2022-05-04 14:25:39', '2022-07-12 10:09:24'),
(50, 'Lorem ipsum', 18, 5, 19, '2022-05-04 14:33:22', '2022-06-13 09:41:19'),
(51, 'Ipsum', 18, 3, 8, '2022-05-04 14:58:53', '2022-06-13 09:14:04'),
(52, 'New title', 18, 4, 48, '2022-05-04 15:00:48', '2022-06-13 09:42:41'),
(53, 'Amd GPU', 19, 5, 7, '2022-05-04 15:04:54', '2022-05-04 15:06:58'),
(54, 'Titleee', 19, 6, 2, '2022-05-04 15:08:40', '2022-05-04 15:08:50'),
(55, 'More text', 19, 6, 2, '2022-05-04 15:09:09', '2022-05-04 15:09:20'),
(56, 'Another thread', 19, 6, 2, '2022-05-04 15:09:39', '2022-05-04 15:09:54'),
(57, 'New title', 19, 7, 3, '2022-05-04 15:12:44', '2022-05-04 15:13:26'),
(58, 'Titleee', 20, 7, 3, '2022-05-04 15:14:25', '2022-05-04 15:18:16'),
(59, 'Lorem ipsum dolor', 20, 7, 4, '2022-05-04 15:16:44', '2022-05-04 15:18:27'),
(60, 'Dolor ipsum lorem', 20, 7, 1, '2022-05-04 15:17:42', '2022-05-04 15:17:42'),
(61, 'Brand new title', 20, 7, 1, '2022-05-04 15:19:10', '2022-05-04 15:19:11'),
(62, 'Titleee', 20, 7, 1, '2022-05-04 15:19:26', '2022-05-04 15:19:26'),
(63, 'AMD CPU', 21, 7, 1, '2022-05-04 15:20:11', '2022-05-04 15:20:11'),
(64, 'Question about storage', 10, 7, 2, '2022-05-04 15:20:27', '2022-06-08 13:24:23'),
(65, 'New question', 21, 6, 1, '2022-05-05 11:27:21', '2022-05-05 11:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `category_id`, `parent_id`, `views`, `created_at`, `updated_at`) VALUES
(1, 'Graphics cards', 1, NULL, 34, '2022-04-08 15:19:34', '2022-06-12 09:36:37'),
(3, 'CPUs', 1, NULL, 2, '2022-04-08 15:19:34', '2022-05-04 15:20:13'),
(10, 'Storage', 1, NULL, 12, '2022-04-08 15:19:34', '2022-06-08 13:24:21'),
(11, 'Displays', 1, NULL, 1, '2022-04-08 15:19:34', '2022-05-04 15:10:46'),
(18, 'Nvidia', 1, 1, 115, '2022-05-04 12:32:19', '2022-07-12 10:00:36'),
(19, 'AMD', 1, 1, 19, '2022-05-04 12:33:39', '2022-05-04 15:15:48'),
(20, 'Intel', 1, 3, 14, '2022-05-04 12:33:39', '2022-06-06 17:00:31'),
(21, 'AMD', 1, 3, 2, '2022-05-04 12:33:39', '2022-05-05 11:27:05'),
(22, 'Operative systems', 2, NULL, 0, '2022-05-04 12:35:50', '2022-05-04 12:41:06'),
(23, 'Antivirus/Security', 2, NULL, 0, '2022-05-04 12:35:50', '2022-05-04 12:35:50'),
(24, 'PC Gaming', 2, NULL, 0, '2022-05-04 12:35:50', '2022-05-04 12:35:50'),
(25, 'Windows', 2, 22, 0, '2022-05-04 12:36:29', '2022-05-04 12:36:29'),
(26, 'Linux', 2, 22, 0, '2022-05-04 12:36:29', '2022-05-04 12:36:29'),
(27, 'macOS', 2, 22, 1, '2022-05-04 12:36:52', '2022-06-13 09:09:02'),
(28, 'Laptops', 3, NULL, 0, '2022-05-04 12:38:57', '2022-05-04 12:38:57'),
(29, 'Mobile', 3, NULL, 0, '2022-05-04 12:38:57', '2022-05-04 12:38:57'),
(30, 'iOS', 3, 29, 0, '2022-05-04 12:40:13', '2022-05-04 12:40:13'),
(31, 'Android', 3, 29, 0, '2022-05-04 12:40:13', '2022-05-04 12:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `topics_sort_options`
--

CREATE TABLE `topics_sort_options` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `val` varchar(150) NOT NULL,
  `default_selection` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics_sort_options`
--

INSERT INTO `topics_sort_options` (`id`, `name`, `val`, `default_selection`, `created_at`, `updated_at`) VALUES
(1, 'name', 'threads.title', 0, '2022-04-17 16:07:16', '2022-04-17 16:23:13'),
(2, 'age', 'threads.created_at', 1, '2022-04-17 16:07:16', '2022-04-17 17:11:11'),
(3, 'replies', 'countReplies', 0, '2022-04-17 16:07:16', '2022-04-17 16:17:31'),
(4, 'views', 'threads.views', 0, '2022-04-17 16:07:16', '2022-04-17 16:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default_avatar.jpg',
  `location` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_privilege_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `location`, `signature`, `user_privilege_id`, `created_at`, `updated_at`) VALUES
(3, 'User12', 'useremail@gmail.com', 'f1dc735ee3581693489eaf286088b916', '1651751017.jpg', 'Nis, Serbia', 'Kokoda', 1, '2022-04-11 15:14:44', '2022-04-11 15:14:44'),
(4, 'admin22', 'admin22@gmail.com', 'f1dc735ee3581693489eaf286088b916', 'default_avatar.jpg', NULL, NULL, 2, '2022-04-21 09:52:09', '2022-04-21 09:52:09'),
(5, 'ForumUser', 'forumuser@gmail.com', 'f1dc735ee3581693489eaf286088b916', 'default_avatar.jpg', NULL, NULL, 1, '2022-05-04 12:47:53', '2022-05-04 12:47:53'),
(6, 'Newcomer221', 'newcomer@gmail.com', 'f1dc735ee3581693489eaf286088b916', '1651750010.jpg', NULL, NULL, 1, '2022-05-04 12:51:02', '2022-05-04 12:51:02'),
(7, 'AnotherUser', 'anotherone@gmail.com', 'f1dc735ee3581693489eaf286088b916', '1651685236.jpg', NULL, NULL, 1, '2022-05-04 12:53:01', '2022-05-04 12:53:01'),
(8, 'novoime', 'imejl@gmail.com', 'f1dc735ee3581693489eaf286088b916', 'default_avatar.jpg', NULL, NULL, 1, '2022-05-06 10:26:14', '2022-05-06 10:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege`
--

CREATE TABLE `user_privilege` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_privilege`
--

INSERT INTO `user_privilege` (`id`, `name`) VALUES
(1, 'user'),
(2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_event`
--
ALTER TABLE `notifications_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `response_image`
--
ALTER TABLE `response_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics_sort_options`
--
ALTER TABLE `topics_sort_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `notifications_event`
--
ALTER TABLE `notifications_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `response_image`
--
ALTER TABLE `response_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `topics_sort_options`
--
ALTER TABLE `topics_sort_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_privilege`
--
ALTER TABLE `user_privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
