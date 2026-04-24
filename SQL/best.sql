-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2025 at 02:16 PM
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
-- Database: `cravix`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `type` varchar(255) NOT NULL DEFAULT 'after_about',
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcategories`
--

CREATE TABLE `bcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bcategories`
--

INSERT INTO `bcategories` (`id`, `name`, `description`, `slug`, `status`, `serial_number`, `created_at`, `updated_at`) VALUES
(1, 'Online Education', NULL, 'Online-Education', 1, 1, '2025-11-12 17:28:30', '2025-11-12 18:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `block_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `block_features`
--

CREATE TABLE `block_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `block_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bcategory_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `bcategory_id`, `title`, `content`, `slug`, `image`, `status`, `meta_keywords`, `meta_description`, `serial_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'Why Online Education is the Future for Working Professionals', '<p data-start=\"369\" data-end=\"541\">Balancing work and study used to be difficult, but now online education makes it possible. You can study anytime, anywhere — without leaving your job.</p>\r\n<p data-start=\"543\" data-end=\"561\"><strong data-start=\"543\" data-end=\"559\">Main Points:</strong></p>\r\n<ul data-start=\"562\" data-end=\"774\"><li data-start=\"562\" data-end=\"609\">\r\n<p data-start=\"564\" data-end=\"609\">Flexible schedule that fits your lifestyle.</p>\r\n</li><li data-start=\"610\" data-end=\"669\">\r\n<p data-start=\"612\" data-end=\"669\">Access to study materials and recorded classes anytime.</p>\r\n</li><li data-start=\"670\" data-end=\"720\">\r\n<p data-start=\"672\" data-end=\"720\">Recognized degrees from approved universities.</p>\r\n</li><li data-start=\"721\" data-end=\"774\">\r\n<p data-start=\"723\" data-end=\"774\">Upgrade your qualifications and grow your career.</p>\r\n</li></ul>\r\n<p data-start=\"776\" data-end=\"890\"><strong data-start=\"776\" data-end=\"791\">Conclusion:</strong><br data-start=\"791\" data-end=\"794\">\r\nOnline education is not just convenient — it’s the smarter way to move forward in your career.</p><p><br></p>', 'why-online-education-is-the-future-for-working-professionals', '17629714841964604665.webp', 1, '[{\"value\":\"one line\"}]', 'Labore ex vel ea dol', 0, '2025-11-12 17:27:43', '2025-11-12 18:18:04'),
(2, 1, 'Fast-Track Degree – A Smart Choice for Busy Professionals', '<p data-start=\"974\" data-end=\"1100\"><br data-start=\"991\" data-end=\"994\">\r\nIf you missed completing your degree or want to finish faster, Fast-Track programs are designed for you.</p>\r\n<p data-start=\"1102\" data-end=\"1120\"><strong data-start=\"1102\" data-end=\"1118\">Main Points:</strong></p>\r\n<ul data-start=\"1121\" data-end=\"1319\"><li data-start=\"1121\" data-end=\"1159\">\r\n<p data-start=\"1123\" data-end=\"1159\">Complete your degree in less time.</p>\r\n</li><li data-start=\"1160\" data-end=\"1208\">\r\n<p data-start=\"1162\" data-end=\"1208\">Specially created for working professionals.</p>\r\n</li><li data-start=\"1209\" data-end=\"1256\">\r\n<p data-start=\"1211\" data-end=\"1256\">Recognized by approved Indian universities.</p>\r\n</li><li data-start=\"1257\" data-end=\"1319\">\r\n<p data-start=\"1259\" data-end=\"1319\">Study at your own pace through online or recorded classes.</p>\r\n</li></ul>\r\n<p data-start=\"1321\" data-end=\"1438\"><strong data-start=\"1321\" data-end=\"1336\">Conclusion:</strong><br data-start=\"1336\" data-end=\"1339\">\r\nFast-Track programs help you save time, continue your career, and still earn a recognized degree.</p><p><br></p>', 'fast-track-degree-a-smart-choice-for-busy-professionals', '1762971710512604656.webp', 1, NULL, NULL, 0, '2025-11-12 18:14:29', '2025-11-12 18:21:50'),
(3, 1, 'Benefits of Distance Education for All Age Groups', '<p data-start=\"1514\" data-end=\"1627\">Learning has no age limit! Distance education gives everyone a chance to grow academically.</p>\r\n<p data-start=\"1629\" data-end=\"1647\"><strong data-start=\"1629\" data-end=\"1645\">Main Points:</strong></p>\r\n<ul data-start=\"1648\" data-end=\"1828\"><li data-start=\"1648\" data-end=\"1702\">\r\n<p data-start=\"1650\" data-end=\"1702\">Ideal for professionals, homemakers, and retirees.</p>\r\n</li><li data-start=\"1703\" data-end=\"1740\">\r\n<p data-start=\"1705\" data-end=\"1740\">Study from anywhere in the world.</p>\r\n</li><li data-start=\"1741\" data-end=\"1777\">\r\n<p data-start=\"1743\" data-end=\"1777\">Affordable and flexible options.</p>\r\n</li><li data-start=\"1778\" data-end=\"1828\">\r\n<p data-start=\"1780\" data-end=\"1828\">Same recognition as regular on-campus degrees.</p>\r\n</li></ul>\r\n<p data-start=\"1830\" data-end=\"1930\"><strong data-start=\"1830\" data-end=\"1845\">Conclusion:</strong><br data-start=\"1845\" data-end=\"1848\">\r\nNo matter your age or background, distance education opens new doors to success.</p><p><br></p>', 'benefits-of-distance-education-for-all-age-groups', '17629717472016259464.webp', 1, NULL, NULL, 0, '2025-11-12 18:15:11', '2025-11-12 18:22:27'),
(4, 1, 'How to Choose the Right Course for Your Career', '<p data-start=\"2003\" data-end=\"2090\">Choosing the right course is the first step toward career growth.</p>\r\n<p data-start=\"2092\" data-end=\"2110\"><strong data-start=\"2092\" data-end=\"2108\">Main Points:</strong></p>\r\n<ul data-start=\"2111\" data-end=\"2323\"><li data-start=\"2111\" data-end=\"2155\">\r\n<p data-start=\"2113\" data-end=\"2155\">Identify your interest and career goals.</p>\r\n</li><li data-start=\"2156\" data-end=\"2210\">\r\n<p data-start=\"2158\" data-end=\"2210\">Check if the course is recognized by UGC or AICTE.</p>\r\n</li><li data-start=\"2211\" data-end=\"2268\">\r\n<p data-start=\"2213\" data-end=\"2268\">Look for flexibility and monthly installment options.</p>\r\n</li><li data-start=\"2269\" data-end=\"2323\">\r\n<p data-start=\"2271\" data-end=\"2323\">Prefer online classes that fit your work schedule.</p>\r\n</li></ul>\r\n<p data-start=\"2325\" data-end=\"2432\"><strong data-start=\"2325\" data-end=\"2340\">Conclusion:</strong><br data-start=\"2340\" data-end=\"2343\">\r\nA well-chosen program helps you gain skills, recognition, and better job opportunities.</p><p><br></p>', 'how-to-choose-the-right-course-for-your-career', '17629713561370664969.webp', 0, NULL, NULL, 0, '2025-11-12 18:15:56', '2025-11-12 18:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `blog_blocks`
--

CREATE TABLE `blog_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `type` enum('R-2-L','L-2-R') NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_block_features`
--

CREATE TABLE `blog_block_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_block_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_c_t_a_s`
--

CREATE TABLE `blog_c_t_a_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `button_text_1` varchar(255) NOT NULL,
  `button_link_1` varchar(255) NOT NULL,
  `button_text_2` varchar(255) DEFAULT NULL,
  `button_link_2` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_sections`
--

CREATE TABLE `blog_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('R-2-L','L-2-R') NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_settings`
--

CREATE TABLE `blog_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `call_to_actions`
--

CREATE TABLE `call_to_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) NOT NULL,
  `button_link` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_jobs`
--

CREATE TABLE `company_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `introduction` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', 'Cookies accept or not accept', '2025-11-12 06:24:53', '2025-11-12 06:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_category_id` bigint(20) UNSIGNED NOT NULL,
  `study_program_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon_font` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `duration` text DEFAULT NULL,
  `mode` enum('online','offline','both') DEFAULT NULL,
  `elegibility` text DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `banner_keywords` text DEFAULT NULL,
  `banner_description` text DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_category_id`, `study_program_id`, `title`, `content`, `slug`, `image`, `icon_font`, `icon`, `duration`, `mode`, `elegibility`, `banner_image`, `status`, `banner_keywords`, `banner_description`, `serial_number`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'B.Com (General)', 'Bachelor of Commerce general program covering fundamental business and commerce subjects.', 'bcom-general', '1762962229798668017.webp', 'B.Com (General)', '1762960603122509559.png', NULL, 'online', NULL, 'bcom-banner.jpg', 1, 'B.Com, Commerce, Undergraduate', 'Bachelor of Commerce general program for business education.', 1, '2025-11-12 06:24:53', '2025-11-12 15:43:49'),
(2, 1, 1, 'B.Com in International Finance & Accounting', 'Specialized B.Com program in International Finance & Accounting accredited by ACCA, UK.', 'bcom-in-international-finance-accounting', '17629611591275945694.webp', 'B.Com in International Finance & Accounting', '17629609282012036824.png', NULL, 'online', NULL, 'bcom-international-banner.jpg', 1, 'B.Com, International Finance, ACCA, Accounting', 'ACCA accredited B.Com in International Finance & Accounting.', 2, '2025-11-12 06:24:53', '2025-11-12 15:25:59'),
(3, 1, 2, 'BBA (General)', 'Bachelor of Business Administration general program covering management principles.', 'bba-general', '17629614801955053190.webp', 'BBA (General)', '1762961480906105409.png', NULL, 'online', NULL, 'bba-banner.jpg', 1, 'BBA, Business Administration, Management', 'Bachelor of Business Administration general program.', 3, '2025-11-12 06:24:53', '2025-11-12 15:31:20'),
(4, 1, 2, 'BBA in Healthcare Management', 'Specialized BBA program focusing on healthcare administration and management.', 'bba-in-healthcare-management', '1762961698280741385.webp', 'BBA in Healthcare Management', '17629616981731112834.png', NULL, 'online', NULL, 'bba-healthcare-banner.jpg', 1, 'BBA, Healthcare Management, Hospital Administration', 'BBA specialization in Healthcare Management.', 4, '2025-11-12 06:24:53', '2025-11-12 15:34:58'),
(5, 1, 3, 'BCA in Computer Science & Information Technology', 'BCA program specializing in Computer Science and Information Technology.', 'bca-in-computer-science-information-technology', '1762962114445125502.webp', 'BCA in Computer Science & Information Technology', '1762962114456837564.png', NULL, 'online', NULL, 'bca-csit-banner.jpg', 1, 'BCA, Computer Science, IT', 'BCA in Computer Science & Information Technology.', 5, '2025-11-12 06:24:53', '2025-11-12 15:41:54'),
(6, 1, 3, 'BCA in Data Science & Analytics', 'BCA program focusing on Data Science, Analytics and Big Data technologies.', 'bca-in-data-science-analytics', '1762962137153008473.webp', 'BCA in Data Science & Analytics', '17629621372116931094.png', NULL, 'online', NULL, 'bca-data-science-banner.jpg', 1, 'BCA, Data Science, Analytics, Big Data', 'BCA specialization in Data Science & Analytics.', 6, '2025-11-12 06:24:53', '2025-11-12 15:42:17'),
(7, 1, 3, 'BCA in Cloud Computing', 'BCA program specializing in Cloud Computing technologies and platforms.', 'bca-cloud-computing', '1762961698280741385.webp', 'fa-cloud', '17629616981731112834.png', NULL, NULL, NULL, 'bca-cloud-banner.jpg', 1, 'BCA, Cloud Computing, AWS, Azure', 'BCA in Cloud Computing technologies.', 7, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(8, 1, 3, 'BCA in Cyber Security', 'BCA program focusing on Cyber Security, Network Security and Ethical Hacking.', 'bca-cyber-security', '1762961698280741385.webp', 'fa-shield-alt', '17629616981731112834.png', NULL, NULL, NULL, 'bca-cyber-security-banner.jpg', 1, 'BCA, Cyber Security, Network Security, Ethical Hacking', 'BCA specialization in Cyber Security.', 8, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(9, 1, 3, 'BCA in Artificial Intelligence', 'BCA program specializing in Artificial Intelligence and Machine Learning.', 'bca-artificial-intelligence', '1762961698280741385.webp', 'fa-robot', '17629616981731112834.png', NULL, NULL, NULL, 'bca-ai-banner.jpg', 1, 'BCA, Artificial Intelligence, AI, Machine Learning', 'BCA in Artificial Intelligence and Machine Learning.', 9, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(10, 2, 4, 'M.Com in Accounting & Finance', 'Master of Commerce program specializing in Accounting and Finance.', 'mcom-accounting-finance', '1762961698280741385.webp', 'fa-file-invoice-dollar', '17629616981731112834.png', NULL, NULL, NULL, 'mcom-accounting-banner.jpg', 1, 'M.Com, Accounting, Finance, Postgraduate', 'M.Com specialization in Accounting & Finance.', 10, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(11, 2, 4, 'M.Com in International Finance', 'M.Com program in International Finance accredited by ACCA, UK.', 'mcom-international-finance', '1762961698280741385.webp', 'fa-globe-americas', '17629616981731112834.png', NULL, NULL, NULL, 'mcom-international-banner.jpg', 1, 'M.Com, International Finance, ACCA', 'ACCA accredited M.Com in International Finance.', 11, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(12, 2, 5, 'MBA in Supply Chain, Production and Operations Management', 'MBA specialization in Supply Chain, Production and Operations Management.', 'mba-supply-chain-production-operations-management', '1762961698280741385.webp', 'fa-truck-loading', '17629616981731112834.png', NULL, NULL, NULL, 'mba-supply-chain-banner.jpg', 1, 'MBA, Supply Chain, Operations Management', 'MBA in Supply Chain and Operations Management.', 12, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(13, 2, 5, 'MBA in Human Resource Management', 'MBA program specializing in Human Resource Management and Organizational Behavior.', 'mba-human-resource-management', '1762961698280741385.webp', 'fa-users', '17629616981731112834.png', NULL, NULL, NULL, 'mba-hr-banner.jpg', 1, 'MBA, Human Resource, HR Management', 'MBA specialization in Human Resource Management.', 13, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(14, 2, 5, 'MBA in Finance', 'MBA program focusing on Financial Management, Investment and Corporate Finance.', 'mba-finance', '1762961698280741385.webp', 'fa-money-bill-wave', '17629616981731112834.png', NULL, NULL, NULL, 'mba-finance-banner.jpg', 1, 'MBA, Finance, Financial Management', 'MBA specialization in Finance.', 14, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(15, 2, 5, 'MBA in Marketing', 'MBA program specializing in Marketing Strategies, Brand Management and Digital Marketing.', 'mba-marketing', '1762961698280741385.webp', 'fa-bullhorn', '17629616981731112834.png', NULL, NULL, NULL, 'mba-marketing-banner.jpg', 1, 'MBA, Marketing, Brand Management', 'MBA specialization in Marketing.', 15, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(16, 2, 5, 'MBA in General Management', 'MBA program with comprehensive coverage of general management principles.', 'mba-general-management', '1762961698280741385.webp', 'fa-chart-pie', '17629616981731112834.png', NULL, NULL, NULL, 'mba-general-banner.jpg', 1, 'MBA, General Management, Business Administration', 'MBA in General Management.', 16, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(17, 2, 5, 'MBA in Retail Management and Quick Commerce', 'MBA program focusing on Retail Management and Quick Commerce business models.', 'mba-retail-management-quick-commerce', '1762961698280741385.webp', 'fa-shopping-cart', '17629616981731112834.png', NULL, NULL, NULL, 'mba-retail-banner.jpg', 1, 'MBA, Retail Management, Quick Commerce', 'MBA in Retail Management and Quick Commerce.', 17, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(18, 2, 5, 'MBA in Finance and Marketing', 'Dual specialization MBA program in Finance and Marketing.', 'mba-finance-and-marketing', '1762961698280741385.webp', 'fa-hand-holding-usd', '17629616981731112834.png', NULL, NULL, NULL, 'mba-finance-marketing-banner.jpg', 1, 'MBA, Finance, Marketing, Dual Specialization', 'MBA with dual specialization in Finance and Marketing.', 18, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(19, 2, 5, 'MBA in Human Resource Management and Finance', 'Dual specialization MBA program in Human Resource Management and Finance.', 'mba-human-resource-management-and-finance', '1762961698280741385.webp', 'fa-user-tie', '17629616981731112834.png', NULL, NULL, NULL, 'mba-hr-finance-banner.jpg', 1, 'MBA, HR, Finance, Dual Specialization', 'MBA with dual specialization in HR and Finance.', 19, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(20, 2, 5, 'MBA in Marketing and Human Resource Management', 'Dual specialization MBA program in Marketing and Human Resource Management.', 'mba-marketing-and-human-resource-management', '1762961698280741385.webp', 'fa-bullseye', '17629616981731112834.png', NULL, NULL, NULL, 'mba-marketing-hr-banner.jpg', 1, 'MBA, Marketing, HR, Dual Specialization', 'MBA with dual specialization in Marketing and HR.', 20, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(21, 2, 5, 'MBA in Project Management', 'MBA program specializing in Project Management methodologies and practices.', 'mba-project-management', '1762961698280741385.webp', 'fa-tasks', '17629616981731112834.png', NULL, NULL, NULL, 'mba-project-banner.jpg', 1, 'MBA, Project Management, PMP', 'MBA specialization in Project Management.', 21, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(22, 2, 5, 'MBA in Information Technology Management', 'MBA program focusing on IT Management, Systems Analysis and Technology Strategy.', 'mba-information-technology-management', '1762961698280741385.webp', 'fa-server', '17629616981731112834.png', NULL, NULL, NULL, 'mba-it-banner.jpg', 1, 'MBA, IT Management, Technology Management', 'MBA in Information Technology Management.', 22, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(23, 2, 5, 'MBA in Healthcare Management', 'MBA program specializing in Healthcare Administration and Hospital Management.', 'mba-healthcare-management', '1762961698280741385.webp', 'fa-hospital-user', '17629616981731112834.png', NULL, NULL, NULL, 'mba-healthcare-banner.jpg', 1, 'MBA, Healthcare Management, Hospital Administration', 'MBA specialization in Healthcare Management.', 23, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(24, 2, 5, 'MBA in Marketing and Business Analytics', 'MBA program combining Marketing with Business Analytics and Data-driven decision making.', 'mba-marketing-and-business-analytics', '1762961698280741385.webp', 'fa-chart-line', '17629616981731112834.png', NULL, NULL, NULL, 'mba-marketing-analytics-banner.jpg', 1, 'MBA, Marketing, Business Analytics, Data Analysis', 'MBA with Marketing and Business Analytics.', 24, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(25, 2, 5, 'MBA in Business Intelligence & Analytics', 'MBA program specializing in Business Intelligence, Analytics and Data Visualization.', 'mba-business-intelligence-analytics', '1762961698280741385.webp', 'fa-database', '17629616981731112834.png', NULL, NULL, NULL, 'mba-bi-banner.jpg', 1, 'MBA, Business Intelligence, Analytics, BI', 'MBA in Business Intelligence & Analytics.', 25, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(26, 2, 5, 'MBA in Entrepreneurship and Venture Creation', 'MBA program focusing on Entrepreneurship, Startup Creation and Venture Development.', 'mba-entrepreneurship-and-venture-creation', '1762961698280741385.webp', 'fa-lightbulb', '17629616981731112834.png', NULL, NULL, NULL, 'mba-entrepreneurship-banner.jpg', 1, 'MBA, Entrepreneurship, Startup, Venture Creation', 'MBA in Entrepreneurship and Venture Creation.', 26, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(27, 2, 5, 'MBA in International Finance', 'MBA program in International Finance accredited by ACCA, UK.', 'mba-international-finance', '1762961698280741385.webp', 'fa-globe', '17629616981731112834.png', NULL, NULL, NULL, 'mba-international-finance-banner.jpg', 1, 'MBA, International Finance, ACCA', 'ACCA accredited MBA in International Finance.', 27, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(28, 2, 5, 'MBA in Finance and Business Analytics', 'MBA program combining Finance with Business Analytics for data-driven financial decisions.', 'mba-finance-and-business-analytics', '1762961698280741385.webp', 'fa-chart-pie', '17629616981731112834.png', NULL, NULL, NULL, 'mba-finance-analytics-banner.jpg', 1, 'MBA, Finance, Business Analytics, Financial Analytics', 'MBA with Finance and Business Analytics.', 28, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(29, 2, 5, 'MBA in Human Resource and Business Analytics', 'MBA program combining Human Resource Management with Business Analytics.', 'mba-human-resource-and-business-analytics', '1762961698280741385.webp', 'fa-user-chart', '17629616981731112834.png', NULL, NULL, NULL, 'mba-hr-analytics-banner.jpg', 1, 'MBA, HR, Business Analytics, HR Analytics', 'MBA with Human Resource and Business Analytics.', 29, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(30, 2, 6, 'MCA in Computer Science & IT', 'Master of Computer Applications program in Computer Science and Information Technology.', 'mca-computer-science-it', '1762961698280741385.webp', 'fa-laptop-code', '17629616981731112834.png', NULL, NULL, NULL, 'mca-csit-banner.jpg', 1, 'MCA, Computer Science, IT, Postgraduate', 'MCA in Computer Science & Information Technology.', 30, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(31, 2, 6, 'MCA in Cyber Security', 'MCA program specializing in Cyber Security, Network Defense and Security Management.', 'mca-cyber-security', '1762961698280741385.webp', 'fa-shield-alt', '17629616981731112834.png', NULL, NULL, NULL, 'mca-cyber-security-banner.jpg', 1, 'MCA, Cyber Security, Network Security', 'MCA specialization in Cyber Security.', 31, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(32, 2, 6, 'MCA in Data Analytics', 'MCA program focusing on Data Analytics, Big Data technologies and Data Mining.', 'mca-data-analytics', '1762961698280741385.webp', 'fa-chart-bar', '17629616981731112834.png', NULL, NULL, NULL, 'mca-data-analytics-banner.jpg', 1, 'MCA, Data Analytics, Big Data, Data Mining', 'MCA in Data Analytics.', 32, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(33, 2, 6, 'MCA in DevOps', 'MCA program specializing in DevOps practices, CI/CD pipelines and Cloud Infrastructure.', 'mca-devops', '1762961698280741385.webp', 'fa-code-branch', '17629616981731112834.png', NULL, NULL, NULL, 'mca-devops-banner.jpg', 1, 'MCA, DevOps, CI/CD, Cloud', 'MCA specialization in DevOps.', 33, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(34, 2, 6, 'MCA in NLP & LLM Development', 'MCA program focusing on Natural Language Processing and Large Language Model Development.', 'mca-nlp-llm-development', '1762961698280741385.webp', 'fa-brain', '17629616981731112834.png', NULL, NULL, NULL, 'mca-nlp-banner.jpg', 1, 'MCA, NLP, Large Language Models, AI', 'MCA in NLP & LLM Development.', 34, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(35, 2, 7, 'M.A in English', 'Master of Arts program in English Literature and Language Studies.', 'ma-english', '1762961698280741385.webp', 'fa-book', '17629616981731112834.png', NULL, NULL, NULL, 'ma-english-banner.jpg', 1, 'M.A, English, Literature, Arts', 'M.A in English Literature and Language.', 35, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(36, 2, 7, 'M.A in Public Policy', 'Master of Arts program in Public Policy, Governance and Administration.', 'ma-public-policy', '1762961698280741385.webp', 'fa-landmark', '17629616981731112834.png', NULL, NULL, NULL, 'ma-public-policy-banner.jpg', 1, 'M.A, Public Policy, Governance', 'M.A in Public Policy.', 36, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(37, 2, 7, 'M.A in Economics', 'Master of Arts program in Economics, Economic Theory and Policy Analysis.', 'ma-economics', '1762961698280741385.webp', 'fa-chart-line', '17629616981731112834.png', NULL, NULL, NULL, 'ma-economics-banner.jpg', 1, 'M.A, Economics, Economic Theory', 'M.A in Economics.', 37, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(38, 2, 7, 'M.A in Jainology and Comparative Religion & Philosophy', 'Master of Arts program in Jainology, Comparative Religion and Philosophical Studies.', 'ma-jainology-comparative-religion-philosophy', '1762961698280741385.webp', 'fa-om', '17629616981731112834.png', NULL, NULL, NULL, 'ma-jainology-banner.jpg', 1, 'M.A, Jainology, Comparative Religion, Philosophy', 'M.A in Jainology and Comparative Religion & Philosophy.', 38, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(39, 3, 8, 'Web Development Fundamentals', 'Short-term course covering HTML, CSS, JavaScript and basic web development concepts.', 'web-development-fundamentals', '1762961698280741385.webp', 'fa-code', '17629616981731112834.png', NULL, NULL, NULL, 'web-dev-banner.jpg', 1, 'Web Development, HTML, CSS, JavaScript, Short Term', 'Short-term course in Web Development Fundamentals.', 39, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(40, 3, 8, 'Python Programming', 'Short-term course in Python programming language for beginners and intermediates.', 'python-programming', '1762961698280741385.webp', 'fa-python', '17629616981731112834.png', NULL, NULL, NULL, 'python-banner.jpg', 1, 'Python, Programming, Short Term', 'Short-term course in Python Programming.', 40, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(41, 3, 8, 'Cloud Computing Basics', 'Introduction to cloud computing concepts, AWS, Azure and cloud deployment.', 'cloud-computing-basics', '1762961698280741385.webp', 'fa-cloud', '17629616981731112834.png', NULL, NULL, NULL, 'cloud-basics-banner.jpg', 1, 'Cloud Computing, AWS, Azure, Short Term', 'Short-term course in Cloud Computing Basics.', 41, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(42, 3, 9, 'Digital Marketing Fundamentals', 'Comprehensive course covering SEO, SEM, Social Media Marketing and Content Marketing.', 'digital-marketing-fundamentals', '1762961698280741385.webp', 'fa-hashtag', '17629616981731112834.png', NULL, NULL, NULL, 'digital-marketing-banner.jpg', 1, 'Digital Marketing, SEO, SEM, Social Media', 'Short-term course in Digital Marketing Fundamentals.', 42, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(43, 3, 9, 'Social Media Marketing', 'Specialized course in Social Media Marketing strategies and campaign management.', 'social-media-marketing', '1762961698280741385.webp', 'fa-share-alt', '17629616981731112834.png', NULL, NULL, NULL, 'social-media-banner.jpg', 1, 'Social Media, Marketing, Facebook, Instagram', 'Short-term course in Social Media Marketing.', 43, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(44, 3, 9, 'Search Engine Optimization (SEO)', 'Comprehensive SEO course covering on-page, off-page and technical SEO techniques.', 'search-engine-optimization-seo', '1762961698280741385.webp', 'fa-search', '17629616981731112834.png', NULL, NULL, NULL, 'seo-banner.jpg', 1, 'SEO, Search Engine Optimization, Digital Marketing', 'Short-term course in Search Engine Optimization.', 44, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(45, 3, 10, 'Introduction to Artificial Intelligence', 'Fundamental course covering AI concepts, machine learning basics and AI applications.', 'introduction-to-artificial-intelligence', '1762961698280741385.webp', 'fa-robot', '17629616981731112834.png', NULL, NULL, NULL, 'ai-intro-banner.jpg', 1, 'AI, Artificial Intelligence, Machine Learning', 'Short-term course in Artificial Intelligence fundamentals.', 45, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(46, 3, 10, 'Machine Learning Basics', 'Introduction to machine learning algorithms, data preprocessing and model training.', 'machine-learning-basics', '1762961698280741385.webp', 'fa-brain', '17629616981731112834.png', NULL, NULL, NULL, 'ml-basics-banner.jpg', 1, 'Machine Learning, ML, AI, Data Science', 'Short-term course in Machine Learning Basics.', 46, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(47, 3, 10, 'Natural Language Processing', 'Course covering NLP techniques, text processing and language model applications.', 'natural-language-processing', '1762961698280741385.webp', 'fa-language', '17629616981731112834.png', NULL, NULL, NULL, 'nlp-banner.jpg', 1, 'NLP, Natural Language Processing, AI', 'Short-term course in Natural Language Processing.', 47, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(48, 5, 8, 'Website Development', '<p>A complete hands-on course that teaches students how to design and develop modern responsive websites using industry-standard web technologies. Ideal for beginners who want to start a career in web development or build websites professionally.</p><p><b><br>Content:<br></b></p><ul><li data-start=\"528\" data-end=\"566\"><ul><li>Introduction to the Internet &amp; Web</li></ul>\r\n</li><li data-start=\"567\" data-end=\"588\">\r\n<ul><li>HTML Fundamentals</li></ul>\r\n</li><li data-start=\"589\" data-end=\"606\">\r\n<ul><li>CSS &amp; Styling</li></ul>\r\n</li><li data-start=\"607\" data-end=\"642\">\r\n<ul><li>Layout Techniques (Flex &amp; Grid)</li></ul>\r\n</li><li data-start=\"643\" data-end=\"664\">\r\n<ul><li>JavaScript Basics</li></ul>\r\n</li><li data-start=\"665\" data-end=\"685\">\r\n<ul><li>DOM Manipulation</li></ul>\r\n</li><li data-start=\"686\" data-end=\"725\">\r\n<ul><li>Responsive &amp; Mobile-Friendly Design</li></ul>\r\n</li><li data-start=\"726\" data-end=\"755\">\r\n<ul><li>Introduction to Databases</li></ul>\r\n</li><li data-start=\"756\" data-end=\"822\">\r\n<ul><li>Backend Basics (PHP / Laravel / Node.js )</li></ul>\r\n</li><li data-start=\"823\" data-end=\"856\">\r\n<ul><li>Connecting Frontend &amp; Backend</li></ul>\r\n</li><li data-start=\"857\" data-end=\"889\">\r\n<ul><li>Website Deployment &amp; Hosting</li></ul>\r\n</li><li data-start=\"890\" data-end=\"916\">\r\n<ul><li>Basic Website Security</li></ul></li><li data-start=\"917\" data-end=\"957\">\r\n<ul><li>Real Project Work &amp; Portfolio Building</li></ul></li></ul>', 'website-development', '1763634683624292781.webp', 'Website Development', '17636346831949936173.png', '<p>2–3 Months (Regular)</p>', 'online', '<li data-start=\"979\" data-end=\"1013\"><p data-start=\"981\" data-end=\"1013\">Matric / Intermediate students</p>\r\n</li><li data-start=\"1014\" data-end=\"1063\">\r\n<p data-start=\"1016\" data-end=\"1063\">Anyone interested in learning web development</p>\r\n</li><p>\r\n\r\n</p><li data-start=\"1064\" data-end=\"1100\">\r\n<p data-start=\"1066\" data-end=\"1100\">No programming experience required</p></li>', '17636358002031489636.webp', 1, NULL, NULL, 1, '2025-11-20 10:31:23', '2025-11-20 10:50:00'),
(49, 5, 8, 'Website Designing (WordPress)', '<p data-start=\"1166\" data-end=\"1400\">A practical course that teaches students how to create dynamic websites using WordPress without needing coding experience. Suitable for freelancers, small business owners, and beginners who want to build professional websites quickly.</p><h3 data-start=\"1402\" data-end=\"1417\"><strong data-start=\"1406\" data-end=\"1417\">Content</strong></h3><p>\r\n\r\n</p><ul data-start=\"1418\" data-end=\"1834\">\r\n<li data-start=\"1418\" data-end=\"1441\">\r\n<p data-start=\"1420\" data-end=\"1441\">Introduction to CMS</p>\r\n</li>\r\n<li data-start=\"1442\" data-end=\"1491\">\r\n<p data-start=\"1444\" data-end=\"1491\">Installing WordPress on Local &amp; Online Server</p>\r\n</li>\r\n<li data-start=\"1492\" data-end=\"1526\">\r\n<p data-start=\"1494\" data-end=\"1526\">WordPress Dashboard &amp; Settings</p>\r\n</li>\r\n<li data-start=\"1527\" data-end=\"1554\">\r\n<p data-start=\"1529\" data-end=\"1554\">Themes (Free &amp; Premium)</p>\r\n</li>\r\n<li data-start=\"1555\" data-end=\"1601\">\r\n<p data-start=\"1557\" data-end=\"1601\">Using Page Builders (Elementor / WPBakery)</p>\r\n</li>\r\n<li data-start=\"1602\" data-end=\"1640\">\r\n<p data-start=\"1604\" data-end=\"1640\">Creating Pages, Menus &amp; Navigation</p>\r\n</li>\r\n<li data-start=\"1641\" data-end=\"1675\">\r\n<p data-start=\"1643\" data-end=\"1675\">Working with Plugins &amp; Widgets</p>\r\n</li>\r\n<li data-start=\"1676\" data-end=\"1701\">\r\n<p data-start=\"1678\" data-end=\"1701\">Contact Forms &amp; Blogs</p>\r\n</li>\r\n<li data-start=\"1702\" data-end=\"1726\">\r\n<p data-start=\"1704\" data-end=\"1726\">WordPress SEO Basics</p>\r\n</li>\r\n<li data-start=\"1727\" data-end=\"1764\">\r\n<p data-start=\"1729\" data-end=\"1764\">E-commerce Setup with WooCommerce</p>\r\n</li>\r\n<li data-start=\"1765\" data-end=\"1794\">\r\n<p data-start=\"1767\" data-end=\"1794\">Website Backup &amp; Security</p>\r\n</li>\r\n<li data-start=\"1795\" data-end=\"1834\">\r\n<p data-start=\"1797\" data-end=\"1834\">Launching and Managing a Live Website</p></li></ul>', 'website-designing-wordpress', '17636350791318469442.webp', 'Website Designing (WordPress)', '17636350798979498.png', '<p>1.5–2 Months</p>', 'online', '<ul data-start=\"1856\" data-end=\"1974\"><li data-start=\"1856\" data-end=\"1881\"><p data-start=\"1858\" data-end=\"1881\">Matric / Intermediate</p>\r\n</li>\r\n<li data-start=\"1882\" data-end=\"1918\">\r\n<p data-start=\"1884\" data-end=\"1918\">No technical experience required</p>\r\n</li>\r\n<li data-start=\"1919\" data-end=\"1974\">\r\n<p data-start=\"1921\" data-end=\"1974\">Suitable for students, entrepreneurs, and freelancers</p>\r\n</li>\r\n</ul>', '17636357651305604345.webp', 1, NULL, NULL, 2, '2025-11-20 10:37:59', '2025-11-20 10:49:25'),
(50, 5, 8, 'MS Office (Word, Excel, PowerPoint, Outlook)', '<p data-start=\"2055\" data-end=\"2265\">A professional course designed to improve computer literacy and productivity skills using Microsoft Office applications. Ideal for office workers, students, and beginners looking to improve their job-readiness.</p><h3 data-start=\"2267\" data-end=\"2282\"><strong data-start=\"2271\" data-end=\"2282\">Content</strong></h3><h4 data-start=\"2283\" data-end=\"2299\"><strong data-start=\"2288\" data-end=\"2299\">MS Word</strong></h4><ul data-start=\"2300\" data-end=\"2396\">\r\n<li data-start=\"2300\" data-end=\"2323\">\r\n<p data-start=\"2302\" data-end=\"2323\">Document Formatting</p>\r\n</li>\r\n<li data-start=\"2324\" data-end=\"2349\">\r\n<p data-start=\"2326\" data-end=\"2349\">Styling &amp; Page Layout</p>\r\n</li>\r\n<li data-start=\"2350\" data-end=\"2369\">\r\n<p data-start=\"2352\" data-end=\"2369\">Tables &amp; Images</p>\r\n</li>\r\n<li data-start=\"2370\" data-end=\"2384\">\r\n<p data-start=\"2372\" data-end=\"2384\">Mail Merge</p>\r\n</li>\r\n<li data-start=\"2385\" data-end=\"2396\">\r\n<p data-start=\"2387\" data-end=\"2396\">Templates</p>\r\n</li>\r\n</ul><h4 data-start=\"2398\" data-end=\"2415\"><strong data-start=\"2403\" data-end=\"2415\">MS Excel</strong></h4><ul data-start=\"2416\" data-end=\"2527\">\r\n<li data-start=\"2416\" data-end=\"2438\">\r\n<p data-start=\"2418\" data-end=\"2438\">Spreadsheet Basics</p>\r\n</li>\r\n<li data-start=\"2439\" data-end=\"2463\">\r\n<p data-start=\"2441\" data-end=\"2463\">Formulas &amp; Functions</p>\r\n</li>\r\n<li data-start=\"2464\" data-end=\"2492\">\r\n<p data-start=\"2466\" data-end=\"2492\">Data Sorting &amp; Filtering</p>\r\n</li>\r\n<li data-start=\"2493\" data-end=\"2512\">\r\n<p data-start=\"2495\" data-end=\"2512\">Charts &amp; Graphs</p>\r\n</li>\r\n<li data-start=\"2513\" data-end=\"2527\">\r\n<p data-start=\"2515\" data-end=\"2527\">Pivot Tables</p>\r\n</li>\r\n</ul><h4 data-start=\"2529\" data-end=\"2548\"><strong data-start=\"2534\" data-end=\"2548\">PowerPoint</strong></h4><ul data-start=\"2549\" data-end=\"2670\">\r\n<li data-start=\"2549\" data-end=\"2567\">\r\n<p data-start=\"2551\" data-end=\"2567\">Slide Creation</p>\r\n</li>\r\n<li data-start=\"2568\" data-end=\"2596\">\r\n<p data-start=\"2570\" data-end=\"2596\">Animations &amp; Transitions</p>\r\n</li>\r\n<li data-start=\"2597\" data-end=\"2620\">\r\n<p data-start=\"2599\" data-end=\"2620\">Presentation Themes</p>\r\n</li>\r\n<li data-start=\"2621\" data-end=\"2637\">\r\n<p data-start=\"2623\" data-end=\"2637\">Slide Master</p>\r\n</li>\r\n<li data-start=\"2638\" data-end=\"2670\">\r\n<p data-start=\"2640\" data-end=\"2670\">Professional Presentation Tips</p>\r\n</li>\r\n</ul><h4 data-start=\"2672\" data-end=\"2688\"><strong data-start=\"2677\" data-end=\"2688\">Outlook</strong></h4><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><ul data-start=\"2689\" data-end=\"2771\">\r\n<li data-start=\"2689\" data-end=\"2709\">\r\n<p data-start=\"2691\" data-end=\"2709\">Email Management</p>\r\n</li>\r\n<li data-start=\"2710\" data-end=\"2735\">\r\n<p data-start=\"2712\" data-end=\"2735\">Calendar &amp; Scheduling</p>\r\n</li>\r\n<li data-start=\"2736\" data-end=\"2755\">\r\n<p data-start=\"2738\" data-end=\"2755\">Rules &amp; Filters</p>\r\n</li>\r\n<li data-start=\"2756\" data-end=\"2771\">\r\n<p data-start=\"2758\" data-end=\"2771\">Meeting Setup</p></li></ul>', 'ms-office-word-excel-powerpoint-outlook', '17636353031915188051.webp', 'MS Office (Word, Excel, PowerPoint, Outlook)', '1763635303550186718.png', '<p>1 - 3 months</p>', 'online', '<ul data-start=\"2793\" data-end=\"2921\"><li data-start=\"2793\" data-end=\"2840\"><p data-start=\"2795\" data-end=\"2840\">Anyone who wants to improve computer skills</p>\r\n</li>\r\n<li data-start=\"2841\" data-end=\"2896\">\r\n<p data-start=\"2843\" data-end=\"2896\">Ideal for office workers, job seekers, and students</p>\r\n</li>\r\n<li data-start=\"2897\" data-end=\"2921\">\r\n<p data-start=\"2899\" data-end=\"2921\">No experience required</p>\r\n</li>\r\n</ul>', '1763635732351636328.webp', 1, NULL, NULL, 3, '2025-11-20 10:41:43', '2025-11-20 10:48:52'),
(51, 5, 8, 'Digital Marketing', '<p data-start=\"2975\" data-end=\"3181\">A career-focused course that teaches students how to promote businesses and brands online using modern digital marketing platforms. Students learn real-world advertising, analytics, and campaign management.</p><h3 data-start=\"3183\" data-end=\"3198\"><strong data-start=\"3187\" data-end=\"3198\">Content</strong></h3><p>\r\n\r\n</p><ul data-start=\"3199\" data-end=\"3587\">\r\n<li data-start=\"3199\" data-end=\"3236\">\r\n<p data-start=\"3201\" data-end=\"3236\">Introduction to Digital Marketing</p>\r\n</li>\r\n<li data-start=\"3237\" data-end=\"3274\">\r\n<p data-start=\"3239\" data-end=\"3274\">Understanding the Online Customer</p>\r\n</li>\r\n<li data-start=\"3275\" data-end=\"3311\">\r\n<p data-start=\"3277\" data-end=\"3311\">Search Engine Optimization (SEO)</p>\r\n</li>\r\n<li data-start=\"3312\" data-end=\"3338\">\r\n<p data-start=\"3314\" data-end=\"3338\">Social Media Marketing</p>\r\n</li>\r\n<li data-start=\"3339\" data-end=\"3374\">\r\n<p data-start=\"3341\" data-end=\"3374\">Meta Ads (Facebook &amp; Instagram)</p>\r\n</li>\r\n<li data-start=\"3375\" data-end=\"3417\">\r\n<p data-start=\"3377\" data-end=\"3417\">Google Ads (Search, Display &amp; YouTube)</p>\r\n</li>\r\n<li data-start=\"3418\" data-end=\"3437\">\r\n<p data-start=\"3420\" data-end=\"3437\">Email Marketing</p>\r\n</li>\r\n<li data-start=\"3438\" data-end=\"3459\">\r\n<p data-start=\"3440\" data-end=\"3459\">Content Marketing</p>\r\n</li>\r\n<li data-start=\"3460\" data-end=\"3490\">\r\n<p data-start=\"3462\" data-end=\"3490\">Lead Generation Strategies</p>\r\n</li>\r\n<li data-start=\"3491\" data-end=\"3521\">\r\n<p data-start=\"3493\" data-end=\"3521\">Creating Marketing Funnels</p>\r\n</li>\r\n<li data-start=\"3522\" data-end=\"3555\">\r\n<p data-start=\"3524\" data-end=\"3555\">Analytics &amp; Campaign Tracking</p>\r\n</li>\r\n<li data-start=\"3556\" data-end=\"3587\">\r\n<p data-start=\"3558\" data-end=\"3587\">Freelancing &amp; Career Guidance</p></li></ul>', 'digital-marketing', '1763635462152047720.webp', 'Digital Marketing', '17636354622049722397.png', '<p>2 - 4 months</p>', 'online', '<li data-start=\"3609\" data-end=\"3628\"><p data-start=\"3611\" data-end=\"3628\">Matric or above</p>\r\n</li><li data-start=\"3629\" data-end=\"3687\">\r\n<p data-start=\"3631\" data-end=\"3687\">Business owners, freelancers, students, or job seekers</p>\r\n</li><p>\r\n\r\n</p><li data-start=\"3688\" data-end=\"3722\">\r\n<p data-start=\"3690\" data-end=\"3722\">No marketing background required</p></li>', '17636355831249885335.webp', 1, NULL, NULL, 6, '2025-11-20 10:44:22', '2025-11-20 10:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `course_blocks`
--

CREATE TABLE `course_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `type` enum('R-2-L','L-2-R') NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_blocks`
--

INSERT INTO `course_blocks` (`id`, `title`, `subtitle`, `description`, `image`, `icon`, `type`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'What You Will Learn', 'Master the skills needed to build real websites from scratch.', '<p>This block highlights the core parts of the learning journey—covering basic structure, front-end design, and interactive functionality.</p>', 'assets/admin/uploads/course/block/thumb/1763728471421697860.webp', 'assets/admin/uploads/course/block/icons/1763728471662429882.png', 'L-2-R', 48, '2025-11-21 07:34:31', '2025-11-21 07:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `course_block_features`
--

CREATE TABLE `course_block_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_block_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_block_features`
--

INSERT INTO `course_block_features` (`id`, `course_block_id`, `title`, `order_no`, `created_at`, `updated_at`) VALUES
(1, 1, 'Learn how to create clean, semantic web page layouts.', 1, '2025-11-21 07:34:31', '2025-11-21 07:34:31'),
(2, 1, 'Use layout techniques such as Flexbox and Grid to design beautiful interfaces.', 2, '2025-11-21 07:34:31', '2025-11-21 07:34:31'),
(3, 1, 'Add real interactivity and dynamic behavior to your websites.', 3, '2025-11-21 07:34:31', '2025-11-21 07:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `course_categories`
--

CREATE TABLE `course_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `order_no` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` enum('publish','draft') NOT NULL DEFAULT 'draft',
  `isfeature` enum('featured','unfeatured') NOT NULL DEFAULT 'featured',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `font_awesome_icon` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_categories`
--

INSERT INTO `course_categories` (`id`, `title`, `slug`, `thumbnail`, `description`, `icon`, `order_no`, `banner_image`, `status`, `isfeature`, `meta_title`, `meta_description`, `font_awesome_icon`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Undergraduate Programs', 'undergraduate-programs', '1763123035213771132.jpg', 'B.A. (General) • B.Com • B.Sc (IT) • BBA • BCA • BSW • B.Sc (Psychology) • B.Sc (Computer Science)', '1762959964760912644.png', 1, '1762958587701195700.webp', 'publish', 'featured', 'Undergraduate Degree Programs', 'Suggested Category Description:\r\nOur Undergraduate Programs provide a strong academic foundation across business, technology, and management disciplines. Students can choose from commerce-focused degrees like B.Com (General) and B.Com in International Finance & Accounting, enter the world of management with BBA (General) and BBA in Healthcare Management, or dive into IT and computing through multiple BCA specializations. These include:\r\n\r\nBCA in Computer Science & IT: Core programming, databases, networks.\r\n\r\nBCA in Data Science & Analytics: Statistics, machine learning, data tools.\r\n\r\nBCA in Cloud Computing: Virtualization, cloud platforms, deployment.\r\n\r\nBCA in Cyber Security: Ethical hacking, network defense, digital forensics.\r\n\r\nBCA in Artificial Intelligence: AI models, deep learning, intelligent systems.\r\n\r\nThese programs build job-ready skills and prepare students for industry roles or advanced studies.', NULL, NULL, '2025-11-12 06:24:53', '2025-11-14 12:23:55'),
(2, 'Postgraduate Programs', 'postgraduate-programs', '17631230631074799764.jpg', 'M.A (Education) • M.A (History) • M.A (Jainology &amp; Comparative Religion &amp; Philosophy) • MBA in International Finance (ACCA, UK) ...', '1762960271755971241.png', 2, '1762958716192436236.webp', 'publish', 'featured', 'Postgraduate Degree Programs', 'Suggested Category Description:\r\nOur Postgraduate Programs are designed for graduates looking to specialize, upskill, or accelerate their career paths in business, finance, technology, or arts. The offerings include:\r\n\r\nCommerce & Finance\r\n\r\nM.Com in Accounting & Finance\r\n\r\nM.Com in International Finance (ACCA-aligned)\r\nA deep dive into modern accounting, global finance, auditing, taxation, and financial strategy.\r\n\r\nMaster of Business Administration (MBA) – Multiple Specializations\r\n\r\nIncluding:\r\n\r\nSupply Chain, Production & Operations\r\n\r\nHuman Resource Management\r\n\r\nFinance\r\n\r\nMarketing\r\n\r\nRetail & Quick Commerce\r\n\r\nProject Management\r\n\r\nInformation Technology Management\r\n\r\nHealthcare Management\r\n\r\nEntrepreneurship & Venture Creation\r\n\r\nInternational Finance\r\n\r\nFinance + Marketing\r\n\r\nHR + Finance\r\n\r\nMarketing + HR\r\n\r\nMarketing + Business Analytics\r\n\r\nBusiness Intelligence & Analytics\r\n\r\nFinance + Business Analytics\r\n\r\nHR + Business Analytics\r\n\r\nThese programs focus on leadership, strategic thinking, market insights, digital transformation, and analytics-driven decision-making.\r\n\r\nMaster of Computer Applications (MCA)\r\n\r\nMCA in Computer Science & IT\r\n\r\nMCA in Cyber Security\r\n\r\nMCA in Data Analytics\r\n\r\nMCA in DevOps\r\n\r\nMCA in NLP & LLM Development\r\n\r\nPerfect for learners aiming for advanced IT careers, software engineering, AI-driven development, cloud engineering, cybersecurity, or data roles.\r\n\r\nMaster of Arts (M.A)\r\n\r\nM.A in English\r\n\r\nM.A in Public Policy\r\n\r\nM.A in Economics\r\n\r\nM.A in Jainology & Comparative Religion\r\n\r\nThese programs explore literature, governance, economics, culture, ethics, and public systems.', NULL, NULL, '2025-11-12 06:24:53', '2025-11-14 12:24:23'),
(3, 'Short Term & Certificate Programs', 'short-term-certificate-programs', '17631230771604151779.jpg', 'Web Development Fundamentals • Python Programming • Cloud Computing Basics • Digital Marketing Fundamentals ...', '1762960325144133048.png', 3, '176295880553617670.webp', 'publish', 'featured', 'Short Term Courses & Certificates', 'Suggested Category Description:\r\nOur Short-Term and Certificate Programs deliver practical, industry-oriented training designed for quick upskilling. These compact courses cover both IT and digital business domains, including:\r\n\r\nTechnology & IT Skills\r\n\r\nWeb Development Fundamentals\r\n\r\nPython Programming\r\n\r\nCloud Computing Basics\r\n\r\nIntroduction to Artificial Intelligence\r\n\r\nMachine Learning Basics\r\n\r\nNatural Language Processing (NLP)\r\n\r\nDigital Marketing & Growth Skills\r\n\r\nDigital Marketing Fundamentals\r\n\r\nSocial Media Marketing\r\n\r\nSearch Engine Optimization (SEO)\r\n\r\nThese programs are ideal for beginners, working professionals, or students who want to enhance their skillset quickly and gain in-demand technical or marketing expertise.', NULL, NULL, '2025-11-12 06:24:53', '2025-11-14 12:24:37'),
(5, 'Information Technology (IT Courses)', 'information-technology-it-courses', '1763580491499703286.webp', '<p>Website development&nbsp;<span style=\"font-size: 1rem;\">•</span><span style=\"font-size: 1rem;\">&nbsp;Website Desiging ( Wordpress )&nbsp;</span><span style=\"font-size: 1rem;\">•&nbsp;</span><span style=\"font-size: 1rem;\">MS Office&nbsp;</span><span style=\"font-size: 1rem;\">•</span><span style=\"font-size: 1rem;\">&nbsp;</span><span style=\"font-size: 1rem;\">Digital Marketing</span></p>', '1763579606562552109.png', 5, '17635796061944641758.webp', 'publish', 'featured', NULL, 'Information Technology (IT Courses) – This category focuses on developing practical digital skills required in today’s professional world. Students gain hands-on experience in website development, website design, productivity software, and digital marketing, preparing them for real industry roles. Courses offered include:\r\n\r\nWebsite Development – learning HTML, CSS, JavaScript, Laravel, and deployment\r\n\r\nWebsite Designing (WordPress) – building fully functional websites using WordPress, themes, plugins, and page builders\r\n\r\nMS Office (Word, Excel, PowerPoint, Outlook) – mastering essential tools for office productivity\r\n\r\nDigital Marketing – covering Meta Ads, SEO, Google Ads, social media marketing, email marketing, and content strategies', NULL, NULL, '2025-11-19 19:13:26', '2025-11-19 19:31:07'),
(6, 'Health & Safety (Healthcare) Courses', 'health-safety-healthcare-courses', '1763581429191515417.webp', '<p>10 hours&nbsp;<span style=\"font-size: 1rem;\">• 15 hours&nbsp;</span><span style=\"font-size: 1rem;\">• 20 hours Health &amp; Safety Courses</span></p>', '1763581429350367343.png', 6, '17635814292107558311.webp', 'publish', 'featured', NULL, 'This category focuses on improving workplace safety within hospitals, clinics, labs, rehabilitation centers, and other healthcare environments. The courses are designed to help staff understand workplace risks, apply safety regulations, prevent injuries, and ensure a safe working environment for both patients and medical professionals.\r\n\r\n1️⃣ Hospital ICU Safety (10 Hours)\r\n\r\nDesigned for ICU nurses, technicians, and support staff. This course covers:\r\n\r\nRecognizing common ICU workplace hazards\r\n\r\nInfection control & exposure prevention\r\n\r\nSafe patient handling techniques\r\n\r\nEmergency response awareness\r\n\r\n2️⃣ Housekeeping Safety in Healthcare (10 Hours)\r\n\r\nFocused on cleaning and sanitation staff working in medical environments. Students learn:\r\n\r\nSafe chemical handling\r\n\r\nPersonal protective equipment (PPE) usage\r\n\r\nWaste disposal protocols\r\n\r\nReducing slips, trips, and fall incidents\r\n\r\n3️⃣ Emergency Department Safety (10 Hours)\r\n\r\nThis course teaches staff how to remain safe in high-pressure emergency environments, including:\r\n\r\nIdentifying patient & equipment hazards\r\n\r\nPreventing workplace violence\r\n\r\nStress & fatigue management\r\n\r\nMaintaining hygiene standards\r\n\r\n4️⃣ Physical Therapy & Rehabilitation Safety (10 Hours)\r\n\r\nDesigned for physiotherapy and rehabilitation staff. Topics include:\r\n\r\nPreventing musculoskeletal injuries\r\n\r\nSafe patient movement & lifting\r\n\r\nTreatment area hazard awareness\r\n\r\nReducing workplace strain and fatigue\r\n\r\n5️⃣ Hospital Safety Specialist Program (15 Hours)\r\n\r\nAn advanced program providing a broader understanding of hospital safety systems, including:\r\n\r\nFacility-wide hazard identification\r\n\r\nReporting & documentation standards\r\n\r\nStaff awareness and training systems\r\n\r\nEstablishing safety protocols across departments\r\n\r\n6️⃣ Medical & Laboratory Safety (15 Hours)\r\n\r\nA course for lab technicians and clinical lab staff covering:\r\n\r\nLab-specific chemical, biological, and equipment risks\r\n\r\nSafe handling, labeling & storage\r\n\r\nSpill response and decontamination\r\n\r\nMaintaining a safe lab workflow\r\n\r\n7️⃣ Healthcare Administration Safety (20 Hours)\r\n\r\nA course for office and management staff in healthcare institutions. Students learn:\r\n\r\nWorkplace ergonomics\r\n\r\nSafety documentation & reporting\r\n\r\nAdministrative compliance requirements\r\n\r\nBuilding a safety-first environment\r\n\r\n8️⃣ Workplace Stress & Violence Prevention\r\n\r\nFocused on healthcare professionals encountering high-stress environments. Covers:\r\n\r\nRecognizing workplace stress triggers\r\n\r\nEarly signs of harassment or aggression\r\n\r\nIncident reporting\r\n\r\nDe-escalation strategies\r\n\r\n9️⃣ Common Hospital Hazard Awareness\r\n\r\nA general introduction suitable for all healthcare staff, including:\r\n\r\nPhysical, chemical, biological, and organizational hazards\r\n\r\nSafe work habits and preventive measures\r\n\r\nUnderstanding near-miss reporting\r\n\r\nBasic regulatory guidelines', NULL, NULL, '2025-11-19 19:43:49', '2025-11-19 19:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `course_c_t_a_s`
--

CREATE TABLE `course_c_t_a_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `button_text_1` varchar(255) NOT NULL,
  `button_link_1` varchar(255) NOT NULL,
  `button_text_2` varchar(255) DEFAULT NULL,
  `button_link_2` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_c_t_a_s`
--

INSERT INTO `course_c_t_a_s` (`id`, `course_id`, `title`, `subtitle`, `description`, `button_text_1`, `button_link_1`, `button_text_2`, `button_link_2`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 48, 'Ready To Work With Us?', 'Feel free to Contact us', '+92 123 45678', 'Contact Us', 'http://127.0.0.1:8000/contact-us', NULL, NULL, 'assets/admin/uploads/course/cta/1763729562852413966.webp', 'active', '2025-11-21 07:37:47', '2025-11-21 07:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `course_elements`
--

CREATE TABLE `course_elements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_elements`
--

INSERT INTO `course_elements` (`id`, `title`, `subtitle`, `description`, `image`, `icon`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'Tools and Technologies You Will Use', 'Learn industry-standard tools used by professional developers.', '<p>Students gain practical experience with powerful development tools that make building websites easier and faster.</p>', 'assets/admin/uploads/element/thumb/1763728562325972677.webp', 'assets/admin/uploads/element/icons/1763728562248537794.png', 48, '2025-11-21 07:36:02', '2025-11-21 07:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `course_element_features`
--

CREATE TABLE `course_element_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_element_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_element_features`
--

INSERT INTO `course_element_features` (`id`, `course_element_id`, `title`, `description`, `order_no`, `created_at`, `updated_at`) VALUES
(4, 1, 'VS Code', 'A professional code editor widely used in the industry.', 1, '2025-11-21 07:59:26', '2025-11-21 07:59:26'),
(5, 1, 'Git & GitHub', 'Learn how to manage project versions and publish code online.', 2, '2025-11-21 07:59:26', '2025-11-21 07:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `course_faqs`
--

CREATE TABLE `course_faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_faqs`
--

INSERT INTO `course_faqs` (`id`, `title`, `subtitle`, `description`, `status`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 'Frequently Asked Questions', 'Answers to common questions about the Web Development course.', '<p data-start=\"313\" data-end=\"469\">This section covers the most common queries students have regarding admissions, course structure, requirements, learning outcomes, and career opportunities.</p>', 'active', 48, '2025-11-21 08:13:36', '2025-11-21 08:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `course_faq_details`
--

CREATE TABLE `course_faq_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_faq_id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_faq_details`
--

INSERT INTO `course_faq_details` (`id`, `course_faq_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 'Do I need any prior programming experience?', 'No. This course is designed for complete beginners. You will start from the basics and move step-by-step to advanced concepts.', '2025-11-21 08:13:36', '2025-11-21 08:13:36'),
(2, 1, 'What will I be able to build after completing the course?', 'You will be able to build responsive, modern websites including landing pages, business websites, portfolio websites, and more. You’ll also learn how to publish websites online.', '2025-11-21 08:13:36', '2025-11-21 08:13:36'),
(3, 1, 'What tools or software will I need?', 'A computer or laptop  Internet connection  Free tools like VS Code, Git, and browser DevTools All tools taught in the course are free and easy to install.', '2025-11-21 08:13:36', '2025-11-21 08:13:36'),
(4, 1, 'Will I receive a certificate after completion?', 'Yes. Students who successfully complete the course and required assignments will receive a recognized completion certificate.', '2025-11-21 08:13:36', '2025-11-21 08:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `course_features`
--

CREATE TABLE `course_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_features`
--

INSERT INTO `course_features` (`id`, `course_id`, `title`, `subtitle`, `description`, `image`, `created_at`, `updated_at`) VALUES
(2, 48, 'What Makes This Course Stand Out', 'Designed for complete beginners and future professionals.', 'The course is structured to ensure every student learns step-by-step, with support, real practice, and weekly evaluations.', 'assets/admin/uploads/course_feature/17637288821579219524.webp', '2025-11-21 07:41:22', '2025-11-21 07:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `course_feature_details`
--

CREATE TABLE `course_feature_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_feature_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_feature_details`
--

INSERT INTO `course_feature_details` (`id`, `course_feature_id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'assets/admin/uploads/feature_details/17637288821129627501.png', 'Structured Learning', 'A progressive learning roadmap from zero to advanced.', '2025-11-21 07:41:22', '2025-11-21 07:41:22'),
(2, 2, 'assets/admin/uploads/feature_details/176372888235562803.png', 'Concept Understanding', 'Clear explanations and visual teaching methods.', '2025-11-21 07:41:22', '2025-11-21 07:41:22'),
(3, 2, 'assets/admin/uploads/feature_details/17637288821040490154.png', 'Hands-On Experience', 'Every topic includes assignments, mini-projects, and exercises.', '2025-11-21 07:41:22', '2025-11-21 07:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `course_materials`
--

CREATE TABLE `course_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_materials`
--

INSERT INTO `course_materials` (`id`, `course_id`, `title`, `document_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 48, 'Course Material Included', 'assets/admin/uploads/course/material/thumb/17637293661403854526.pdf', 'active', '2025-11-21 07:49:26', '2025-11-21 07:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `course_outlines`
--

CREATE TABLE `course_outlines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_outlines`
--

INSERT INTO `course_outlines` (`id`, `course_id`, `title`, `subtitle`, `description`, `created_at`, `updated_at`) VALUES
(1, 48, 'Web Development Course Outline', 'From basics to professional-level website building.', '<p>A structured outline covering everything from the first line of code to real-world deployment.</p>', '2025-11-21 07:46:04', '2025-11-21 07:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `course_outline_units`
--

CREATE TABLE `course_outline_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_outline_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_outline_units`
--

INSERT INTO `course_outline_units` (`id`, `course_outline_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'Introduction to Web Development', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(2, 1, 'HTML (HyperText Markup Language)', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(3, 1, 'CSS (Cascading Style Sheets)', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(4, 1, 'JavaScript Basics', '2025-11-21 07:46:04', '2025-11-21 07:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `course_outline_unit_topics`
--

CREATE TABLE `course_outline_unit_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_outline_unit_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_outline_unit_topics`
--

INSERT INTO `course_outline_unit_topics` (`id`, `course_outline_unit_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'What is the Web?', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(2, 1, 'How websites work', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(3, 1, 'Client vs Server', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(4, 1, 'Project folder structure', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(5, 2, 'Basic tags and elements', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(6, 2, 'Headings, paragraphs, lists', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(7, 2, 'Links and images', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(8, 3, 'Selectors and properties', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(9, 3, 'Colors, margins, padding', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(10, 3, 'Flexbox and Grid', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(11, 4, 'Variables and data types', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(12, 4, 'Functions and events', '2025-11-21 07:46:04', '2025-11-21 07:46:04'),
(13, 4, 'Loops', '2025-11-21 07:46:04', '2025-11-21 07:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `course_requirements`
--

CREATE TABLE `course_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `document_file` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_requirements`
--

INSERT INTO `course_requirements` (`id`, `course_id`, `title`, `document_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 48, 'Basic Requirements', 'assets/admin/uploads/course/requirement/thumb/176372930518193862.pdf', 'active', '2025-11-21 07:48:25', '2025-11-21 07:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `course_sections`
--

CREATE TABLE `course_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('R-2-L','L-2-R') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_sections`
--

INSERT INTO `course_sections` (`id`, `course_id`, `title`, `subtitle`, `description`, `image`, `type`, `created_at`, `updated_at`) VALUES
(1, 48, 'Become a Professional Web Developer from Scratch', 'Learn to build modern and responsive websites using industry-standard tools.', 'This course offers a hands-on learning experience that starts with the basics of web technologies and gradually moves toward complete front-end development, responsive layouts, and deploying real websites online. Students work on live projects, helping them gain practical experience and professional confidence.', 'assets/admin/uploads/CourseSection/thumb/17637283811910757674.webp', 'R-2-L', '2025-11-21 07:33:01', '2025-11-21 07:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `course_settings`
--

CREATE TABLE `course_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_settings`
--

INSERT INTO `course_settings` (`id`, `course_id`, `reference_type`, `reference_id`, `order_no`, `created_at`, `updated_at`) VALUES
(1, 48, 'App\\Models\\CourseSection', 1, 1, '2025-11-21 07:33:01', '2025-11-21 08:04:39'),
(2, 48, 'App\\Models\\CourseBlock', 1, 2, '2025-11-21 07:34:31', '2025-11-21 08:04:39'),
(3, 48, 'App\\Models\\CourseElement', 1, 3, '2025-11-21 07:36:02', '2025-11-21 08:04:39'),
(4, 48, 'App\\Models\\CourseWhyChooseUs', 1, 4, '2025-11-21 07:36:38', '2025-11-21 08:04:39'),
(5, 48, 'App\\Models\\CourseCTA', 1, 6, '2025-11-21 07:37:47', '2025-11-21 08:04:39'),
(6, 48, 'App\\Models\\CourseFeature', 2, 5, '2025-11-21 07:41:22', '2025-11-21 08:04:39'),
(7, 48, 'App\\Models\\CourseOutline', 1, 7, '2025-11-21 07:46:04', '2025-11-21 08:04:39'),
(8, 48, 'App\\Models\\CourseRequirement', 1, 8, '2025-11-21 07:48:25', '2025-11-21 08:04:39'),
(9, 48, 'App\\Models\\CourseFaq', 1, 9, '2025-11-21 08:13:36', '2025-11-21 08:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `course_why_choose_us`
--

CREATE TABLE `course_why_choose_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_why_choose_us`
--

INSERT INTO `course_why_choose_us` (`id`, `course_id`, `title`, `subtitle`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 48, 'Why Choose Our Web Development Course?', 'Practical, modern, professional training for real-world careers.', 'Our training focuses on real projects, practical learning, and building professional-level websites that prepare students for freelancing, job markets, and portfolio development.', 'assets/admin/uploads/course_why_choose_us/1763728598608796744.webp', '2025-11-21 07:36:38', '2025-11-21 07:36:38');

-- --------------------------------------------------------

--
-- Table structure for table `course_why_choose_us_details`
--

CREATE TABLE `course_why_choose_us_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_why_choose_us_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_why_choose_us_details`
--

INSERT INTO `course_why_choose_us_details` (`id`, `course_why_choose_us_id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'assets/admin/uploads/why_choose_us_details/17637287512039239558.png', 'Industry-Relevant Skills', 'Learn technologies that companies use today.', '2025-11-21 07:39:11', '2025-11-21 07:39:11'),
(2, 1, 'assets/admin/uploads/why_choose_us_details/1763728751265259531.png', 'Practical Projects', 'Build portfolio-ready websites and deploy them online.', '2025-11-21 07:39:11', '2025-11-21 07:39:11'),
(3, 1, 'assets/admin/uploads/why_choose_us_details/1763728751247388038.png', 'Career Support', 'Guidance for freelancing, interviews, and professional growth.', '2025-11-21 07:39:11', '2025-11-21 07:39:11'),
(4, 1, 'assets/admin/uploads/why_choose_us_details/17637295311594972967.png', 'Social Media Marketing', 'Best Social Media Marketing Company', '2025-11-21 07:52:11', '2025-11-21 07:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `document_requireds`
--

CREATE TABLE `document_requireds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE `elements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `element_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `element_features`
--

CREATE TABLE `element_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `element_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `enquiry_message` text NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','follow-up','completed') NOT NULL DEFAULT 'pending',
  `type` enum('general','course') NOT NULL DEFAULT 'general',
  `followup_date` varchar(255) DEFAULT NULL,
  `followup_type` enum('call','whatsapp','message','email','info-required','docs-required') DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `phone_no`, `subject`, `enquiry_message`, `course_name`, `course_id`, `status`, `type`, `followup_date`, `followup_type`, `remarks`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hafiz', 'attamuhammad619@gmail.com', '0044 753 450 3523', 'Walk the Path of Faith — Join the Sacred Journey 2025 and Relive the Prophet’s ﷺ Hijrah', 'af asf d sf', NULL, NULL, 'pending', 'general', NULL, NULL, NULL, '2025-11-14 07:25:22', '2025-11-14 07:25:22', NULL),
(2, 'ahmad', 'aneef123@gmail.com', '234567', '23456', 'r43f43f4e', NULL, NULL, 'pending', 'general', NULL, NULL, NULL, '2025-11-14 12:00:28', '2025-11-14 12:00:28', NULL),
(3, 'ali', 'Ali@gmail.com', '+971 50 40 6786', 'want to enroll', 'af asdfasd f', NULL, NULL, 'pending', 'general', '2025-11-14', 'call', NULL, '2025-11-16 08:31:07', '2025-11-16 08:32:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_comments`
--

CREATE TABLE `enquiry_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enquiry_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiry_comments`
--

INSERT INTO `enquiry_comments` (`id`, `enquiry_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'call him after 2 days', '2025-11-16 08:31:48', NULL),
(2, 3, 1, 'need some resources about web', '2025-11-16 08:32:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `question` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`question`)),
  `answer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`answer`)),
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_details`
--

CREATE TABLE `faq_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_section_id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_sections`
--

CREATE TABLE `faq_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_images`
--

CREATE TABLE `feature_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_sections`
--

CREATE TABLE `feature_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_section_details`
--

CREATE TABLE `feature_section_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_section_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gcategories`
--

CREATE TABLE `gcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('hero','section_title','intro_section','features','why_us_img','feature_img','faq','why_choose_us','testimonials','documents_required','procedure','cta') NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hero_sections`
--

CREATE TABLE `hero_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industry_jobs`
--

CREATE TABLE `industry_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `introduction` text NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_blocks`
--

CREATE TABLE `info_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `description2` text DEFAULT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `text1` varchar(255) DEFAULT NULL,
  `text2` varchar(255) DEFAULT NULL,
  `text3` varchar(255) DEFAULT NULL,
  `show_on` enum('home','about_us') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_blocks`
--

INSERT INTO `info_blocks` (`id`, `title`, `subtitle`, `description`, `description2`, `image1`, `image2`, `image3`, `text1`, `text2`, `text3`, `show_on`, `created_at`, `updated_at`) VALUES
(1, 'Quality Online Education for Working Professionals', 'Empowering Minds, Shaping Futures', '<p>We offer flexible, accredited programs from approved Indian universities — from 10th to PhD levels.<br data-start=\"375\" data-end=\"378\">\r\nStudy online or through recorded classes, get study materials, and earn recognized degrees — all while continuing your job.</p>', NULL, 'assets/admin/uploads/info_blocks/1762951719968868767.webp', 'assets/admin/uploads/info_blocks/17629720391987407959.png', NULL, '8+|Years of Experience', NULL, NULL, 'home', '2025-11-12 07:48:39', '2025-11-16 08:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `info_block_features`
--

CREATE TABLE `info_block_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `info_block_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_block_features`
--

INSERT INTO `info_block_features` (`id`, `info_block_id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(21, 1, NULL, 'Flexible Learning – Online & recorded classes.', '', '2025-11-16 08:10:43', '2025-11-16 08:10:43'),
(22, 1, NULL, 'Easy Payment – Monthly installment options.', '', '2025-11-16 08:10:43', '2025-11-16 08:10:43'),
(23, 1, NULL, 'For Everyone – All ages & nationalities welcome.', '', '2025-11-16 08:10:43', '2025-11-16 08:10:43'),
(24, 1, NULL, 'Approved Universities – UGC, AICTE, NAAC, DEB certified.', '', '2025-11-16 08:10:43', '2025-11-16 08:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `info_sections`
--

CREATE TABLE `info_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `description2` text DEFAULT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `text1` varchar(255) DEFAULT NULL,
  `text2` varchar(255) DEFAULT NULL,
  `text3` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_section_features`
--

CREATE TABLE `info_section_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `info_section_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `introduction_sections`
--

CREATE TABLE `introduction_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jcategories`
--

CREATE TABLE `jcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jcategories`
--

INSERT INTO `jcategories` (`id`, `name`, `slug`, `status`, `serial_number`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'web-development', 1, 0, '2025-11-14 06:08:44', '2025-11-14 06:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_applicants`
--

CREATE TABLE `job_applicants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jcategory_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `vacancy` int(11) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `employment_status` varchar(255) DEFAULT NULL,
  `job_location` text DEFAULT NULL,
  `salary` text DEFAULT NULL,
  `other_benefits` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `job_responsibility` text DEFAULT NULL,
  `education_requirement` text DEFAULT NULL,
  `job_context` text DEFAULT NULL,
  `experience_requirement` text DEFAULT NULL,
  `additional_requirement` text DEFAULT NULL,
  `meta_tags` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_number` int(11) NOT NULL DEFAULT 0,
  `thumbnail_img` varchar(255) DEFAULT NULL,
  `banner_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `jcategory_id`, `title`, `slug`, `position`, `company_name`, `vacancy`, `deadline`, `employment_status`, `job_location`, `salary`, `other_benefits`, `email`, `job_responsibility`, `education_requirement`, `job_context`, `experience_requirement`, `additional_requirement`, `meta_tags`, `meta_description`, `status`, `serial_number`, `thumbnail_img`, `banner_img`, `created_at`, `updated_at`) VALUES
(1, 1, 'Senior Laravel Developer', 'senior-laravel-developer', 'Laravel Developer', 'TechNova Solutions Ltd.', 3, '11/14/2025', 'Full-Time', 'Dhaka, Bangladesh', 'BDT 80,000 - 120,000 (Negotiable)', '<p>Festival Bonus, Health Insurance, Flexible Working Hours</p>', NULL, '<p>• Develop and maintain web applications using Laravel framework. • Collaborate with front-end developers and project managers. • Write clean, secure, and testable code. • Optimize applications for maximum speed and scalability.</p>', '<p>• Bachelor’s degree in CSE or related field. • Strong understanding of PHP and OOP. • Knowledge of MVC architectural patterns.</p>', '<p>You will work in an agile environment and collaborate closely with cross-functional teams to build high-quality software applications.</p>', '<p>• Minimum 3 years experience in Laravel. • Strong experience with REST APIs, MySQL, and Git. • Experience with Vue.js is a plus.</p>', '<p>• Strong problem-solving skills. • Ability to work under pressure. • Good communication skills.</p>', '[{\"value\":\"Laravel\"},{\"value\":\"PHP Developer\"},{\"value\":\"Software Jobs BD\"}]', 'Apply now for the Senior Laravel Developer position at TechNova Solutions Ltd. Competitive salary with great work environment.', 1, 1, 'assets/admin/img/job_applications/176310067996019000_thumb.jpg', 'assets/admin/img/job_applications/176310067933420582_banner.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_candidates`
--

CREATE TABLE `job_candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `cover_letter` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_cities`
--

CREATE TABLE `job_cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_countries`
--

CREATE TABLE `job_countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_experiences`
--

CREATE TABLE `job_experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_vacancies`
--

CREATE TABLE `job_vacancies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_jobs_id` bigint(20) UNSIGNED NOT NULL,
  `industry_jobs_id` bigint(20) UNSIGNED NOT NULL,
  `job_types_id` bigint(20) UNSIGNED NOT NULL,
  `job_cities_id` bigint(20) UNSIGNED NOT NULL,
  `job_countries_id` bigint(20) UNSIGNED NOT NULL,
  `job_experiences_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','both') NOT NULL DEFAULT 'both',
  `min_age` int(11) DEFAULT NULL,
  `max_age` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `job_vacancy` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `salary_min` decimal(10,2) DEFAULT NULL,
  `salary_max` decimal(10,2) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `whatsapp_no` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `post_date` date NOT NULL,
  `deadline` date NOT NULL,
  `job_details` longtext NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2021_01_01_123620_create_bcategories_table', 1),
(5, '2021_01_01_123640_create_blogs_table', 1),
(6, '2021_06_02_102013_create_gcategories_table', 1),
(7, '2021_06_02_102316_create_galleries_table', 1),
(8, '2021_06_03_153757_create_jcategories_table', 1),
(9, '2021_06_03_154131_create_job_applications_table', 1),
(10, '2024_11_01_121944_create_partners_table', 1),
(11, '2024_11_04_115441_create_service_categories_table', 1),
(12, '2024_11_04_115723_create_services_table', 1),
(13, '2024_11_04_134132_create_service_features_table', 1),
(14, '2024_11_08_113706_create_settings_table', 1),
(15, '2024_11_08_124807_create_service_sections_table', 1),
(16, '2024_11_09_113547_create_notifications_table', 1),
(17, '2025_03_21_214247_create_groups_table', 1),
(18, '2025_03_21_214301_create_page_categories_table', 1),
(19, '2025_03_21_214302_create_pages_table', 1),
(20, '2025_03_22_081253_create_procedures_table', 1),
(21, '2025_03_22_090836_create_call_to_actions_table', 1),
(22, '2025_03_22_091429_create_section_titles_table', 1),
(23, '2025_03_22_091441_create_introduction_sections_table', 1),
(24, '2025_03_22_091454_create_hero_sections_table', 1),
(25, '2025_03_22_145147_create_features_table', 1),
(26, '2025_03_23_190503_create_faqs_table', 1),
(27, '2025_03_23_201031_create_testimonials_table', 1),
(28, '2025_03_24_055736_create_why_choose_us_table', 1),
(29, '2025_03_24_061928_create_document_requireds_table', 1),
(30, '2025_03_24_070129_create_why_us_images_table', 1),
(31, '2025_03_24_070149_create_feature_images_table', 1),
(32, '2025_04_29_084808_create_page_sections_table', 1),
(33, '2025_05_03_095955_create_package_categories_table', 1),
(34, '2025_05_22_073001_create_packages_table', 1),
(35, '2025_05_22_075808_create_package_details_table', 1),
(36, '2025_05_29_010703_create_sliders_table', 1),
(37, '2025_05_29_014813_create_clients_table', 1),
(38, '2025_05_29_095338_create_elements_table', 1),
(39, '2025_05_29_095628_create_element_features', 1),
(40, '2025_05_29_104803_create_blocks_table', 1),
(41, '2025_05_29_112205_create_tempelate_files_table', 1),
(42, '2025_05_30_075559_create_block_features_table', 1),
(43, '2025_08_01_073215_create_teams_table', 1),
(44, '2025_08_01_110042_create_privacy_policies_table', 1),
(45, '2025_08_01_113127_create_terms_and_conditions_table', 1),
(46, '2025_08_22_064504_create_industry_jobs_table', 1),
(47, '2025_08_22_104952_create_job_types_table', 1),
(48, '2025_08_22_115751_create_job_countries_table', 1),
(49, '2025_08_23_045811_create_job_cities_table', 1),
(50, '2025_08_24_000000_create_company_jobs_table', 1),
(51, '2025_08_24_072844_create_job_experiences_table', 1),
(52, '2025_08_25_000100_create_job_vacancies_table', 1),
(53, '2025_09_02_111222_create_info_sections_table', 1),
(54, '2025_09_02_111248_create_info_section_features_table', 1),
(55, '2025_09_15_041935_create_blog_sections_table', 1),
(56, '2025_09_15_041950_create_blog_c_t_a_s_table', 1),
(57, '2025_09_15_042000_create_blog_blocks_table', 1),
(58, '2025_09_15_054347_create_blog_block_features_table', 1),
(59, '2025_09_15_061822_create_blog_settings_table', 1),
(60, '2025_09_15_100422_create_job_applicants_table', 1),
(61, '2025_09_19_113550_create_course_categories_table', 1),
(62, '2025_09_19_113552_create_study_programs_table', 1),
(63, '2025_09_19_113558_create_courses_table', 1),
(64, '2025_09_19_113559_create_enquiries_table', 1),
(65, '2025_09_19_113560_create_enquiry_comments_table', 1),
(66, '2025_09_19_113561_add_deleted_at_field_to_enquiries', 1),
(67, '2025_09_19_113617_create_course_sections_table', 1),
(68, '2025_09_19_113630_create_course_c_t_a_s_table', 1),
(69, '2025_09_19_113639_create_course_blocks_table', 1),
(70, '2025_09_19_113649_create_course_block_features_table', 1),
(71, '2025_09_19_113701_create_course_settings_table', 1),
(72, '2025_09_20_055056_create_cookies_table', 1),
(73, '2025_09_20_060547_create_course_elements_table', 1),
(74, '2025_09_20_060619_create_course_why_choose_us_table', 1),
(75, '2025_09_20_060948_create_course_element_features_table', 1),
(76, '2025_09_20_063713_create_course_why_choose_us_details_table', 1),
(77, '2025_09_20_070108_create_service_projects_table', 1),
(78, '2025_09_22_064828_create_seo_metas_table', 1),
(79, '2025_09_22_083049_create_seo_globals_table', 1),
(80, '2025_09_24_164715_create_we_serves_table', 1),
(81, '2025_09_24_165458_create_we_serve_details_table', 1),
(82, '2025_09_25_023258_create_testimonial_sections_table', 1),
(83, '2025_09_25_023834_create_testimonial_details_table', 1),
(84, '2025_09_25_093153_create_faq_sections_table', 1),
(85, '2025_09_25_094654_create_faq_details_table', 1),
(86, '2025_09_26_051720_create_why_choose_us_sections_table', 1),
(87, '2025_09_26_051744_create_why_choose_us_section_details_table', 1),
(88, '2025_09_26_060035_create_course_outlines_table', 1),
(89, '2025_09_26_060114_create_course_outline_units_table', 1),
(90, '2025_09_26_060133_create_course_outline_unit_topics_table', 1),
(91, '2025_09_26_070854_create_features_sections_table', 1),
(92, '2025_09_26_070950_create_features_sections_details_table', 1),
(93, '2025_09_26_071631_create_course_features_table', 1),
(94, '2025_09_26_071739_create_course_feature_details_table', 1),
(95, '2025_09_27_062314_create_service_blocks_table', 1),
(96, '2025_09_27_062325_create_service_block_features_table', 1),
(97, '2025_09_27_062444_create_service_elements_table', 1),
(98, '2025_09_27_062459_create_service_element_features_table', 1),
(99, '2025_09_27_062533_create_service_feature_details_table', 1),
(100, '2025_09_27_062604_create_service_settings_table', 1),
(101, '2025_09_30_070131_create_info_blocks_table', 1),
(102, '2025_09_30_070240_create_info_block_features_table', 1),
(103, '2025_09_30_095713_create_section_headers_table', 1),
(104, '2025_10_07_064042_update_settings', 1),
(105, '2025_10_07_070210_create_banners_table', 1),
(106, '2025_10_11_064211_create_job_candidates_table', 1),
(107, '2025_11_10_073245_create_newsletters_table', 1),
(108, '2025_11_10_101331_create_webinars_table', 1),
(109, '2025_11_10_184743_add_columns_in_courses_table', 1),
(110, '2025_11_10_194607_create_course_materials_table', 1),
(111, '2025_11_10_202603_create_course_requirements_table', 1),
(112, '2025_11_21_111456_create_course_faqs_table', 2),
(113, '2025_11_21_111505_create_course_faq_details_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'shahida@gmail.com', 0, '2025-11-14 07:25:40', '2025-11-14 07:25:40', NULL),
(2, 'a@a.com', 0, '2025-11-14 07:26:02', '2025-11-14 07:26:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `discounted_amount` decimal(10,2) DEFAULT NULL,
  `currency_symbol` varchar(255) NOT NULL DEFAULT '$',
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `publish` enum('draft','published') NOT NULL DEFAULT 'draft',
  `order_no` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_categories`
--

CREATE TABLE `package_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `order_no` int(11) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` enum('included','excluded') NOT NULL DEFAULT 'included',
  `order_no` int(11) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `hero_title` varchar(255) DEFAULT NULL,
  `hero_sub_title` varchar(255) DEFAULT NULL,
  `hero_description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `type` enum('website','marketing','seo','whatsapp-Marketing') NOT NULL,
  `route_name` varchar(255) DEFAULT NULL,
  `page_link_for` enum('header','footer','services','none') NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_category_id`, `title`, `description`, `hero_title`, `hero_sub_title`, `hero_description`, `slug`, `image`, `icon`, `hero_image`, `status`, `type`, `route_name`, `page_link_for`, `order_no`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'home', 'website-pages', NULL, NULL, NULL, 'home', NULL, NULL, 'assets/admin/img/page/hero_image/17629695111589691538.jpg', 'draft', 'website', NULL, 'header', 1, NULL, NULL, NULL, '2025-11-12 17:45:11', '2025-11-12 17:45:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_categories`
--

CREATE TABLE `page_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `hero_title` varchar(255) DEFAULT NULL,
  `hero_sub_title` varchar(255) DEFAULT NULL,
  `hero_description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `order_no` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_categories`
--

INSERT INTO `page_categories` (`id`, `title`, `description`, `hero_title`, `hero_sub_title`, `hero_description`, `slug`, `image`, `icon`, `hero_image`, `status`, `order_no`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'website-pages', 'website-pages', NULL, NULL, NULL, 'website-pages', NULL, NULL, 'assets/admin/img/page_category/hero_image/1762969476772796727.jpg', 'draft', 1, NULL, NULL, NULL, '2025-11-12 17:44:36', '2025-11-12 17:44:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page_sections`
--

CREATE TABLE `page_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('R-2-L','L-2-R') NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('published','draft') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `title`, `order_no`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Abc', '1', '17629704971587149945.png', 'published', '2025-11-12 18:01:37', '2025-11-12 18:01:37'),
(2, 'abc', '2', '1762970511767384780.png', 'published', '2025-11-12 18:01:51', '2025-11-12 18:01:51'),
(3, '1w2', '3', '17629705251537921560.png', 'published', '2025-11-12 18:02:05', '2025-11-12 18:02:05'),
(4, 'adsa', '5', '1762970538849869591.png', 'published', '2025-11-12 18:02:18', '2025-11-12 18:02:18'),
(5, '123', '6', '17629705521025756948.png', 'published', '2025-11-12 18:02:32', '2025-11-12 18:02:32'),
(6, '13', '7', '1762970564757519922.png', 'published', '2025-11-12 18:02:44', '2025-11-12 18:02:44'),
(7, '32', '8', '17629705751557729758.png', 'published', '2025-11-12 18:02:55', '2025-11-12 18:02:55'),
(8, 'ddf', '9', '17629705861693708438.png', 'published', '2025-11-12 18:03:06', '2025-11-12 18:03:06'),
(9, 'dfsdf', '10', '17629705972077620250.png', 'published', '2025-11-12 18:03:17', '2025-11-12 18:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `title`, `page_title`, `description`, `order_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy', 'Privacy Policy', '<p data-start=\"140\" data-end=\"158\"><strong data-start=\"140\" data-end=\"158\">Privacy Policy</strong></p>\r\n<ul data-start=\"160\" data-end=\"1386\"><li data-start=\"160\" data-end=\"325\">\r\n<p data-start=\"162\" data-end=\"325\">We collect personal information such as your name, email address, phone number, course preferences, and any details you submit through enquiry forms or WhatsApp.</p>\r\n</li><li data-start=\"326\" data-end=\"493\">\r\n<p data-start=\"328\" data-end=\"493\">Information is used to process your enquiries, guide you with course options, complete your admission process, provide study materials, and offer customer support.</p>\r\n</li><li data-start=\"494\" data-end=\"638\">\r\n<p data-start=\"496\" data-end=\"638\">We may use your data to send important updates, reminders, study material links, and promotional offers related to our educational services.</p>\r\n</li><li data-start=\"639\" data-end=\"833\">\r\n<p data-start=\"641\" data-end=\"833\">Your personal information is <strong data-start=\"670\" data-end=\"684\">never sold</strong> to third parties. It is only shared with trusted service providers who help us deliver our classes, payment processing, or communication services.</p>\r\n</li><li data-start=\"834\" data-end=\"967\">\r\n<p data-start=\"836\" data-end=\"967\">We use cookies and analytics tools to understand website performance, improve user experience, and enhance our marketing efforts.</p>\r\n</li><li data-start=\"968\" data-end=\"1094\">\r\n<p data-start=\"970\" data-end=\"1094\">All data is stored securely, and we follow strict measures to protect your information from unauthorized access or misuse.</p>\r\n</li><li data-start=\"1095\" data-end=\"1203\">\r\n<p data-start=\"1097\" data-end=\"1203\">You may request access, correction, or deletion of your data at any time by contacting our support team.</p>\r\n</li><li data-start=\"1204\" data-end=\"1304\">\r\n<p data-start=\"1206\" data-end=\"1304\">Continued use of this website means you agree to the practices described in this Privacy Policy.</p>\r\n</li><li data-start=\"1305\" data-end=\"1386\">\r\n<p data-start=\"1307\" data-end=\"1386\">We may update this policy when needed; any changes will be posted on this page.</p></li></ul>', 1, 'active', '2025-11-14 14:45:08', '2025-11-15 14:08:47'),
(2, 'Terms & Conditions', 'Terms & Conditions', '<p data-start=\"101\" data-end=\"123\"><strong data-start=\"101\" data-end=\"123\">Terms &amp; Conditions</strong></p>\r\n<ul data-start=\"125\" data-end=\"1516\"><li data-start=\"125\" data-end=\"262\">\r\n<p data-start=\"127\" data-end=\"262\">By using this website and enrolling in any course, you agree to follow all rules, policies, and guidelines set by BestQualityEdu.com.</p>\r\n</li><li data-start=\"263\" data-end=\"380\">\r\n<p data-start=\"265\" data-end=\"380\">All course details, fees, and schedules are subject to change based on university guidelines or internal updates.</p>\r\n</li><li data-start=\"381\" data-end=\"489\">\r\n<p data-start=\"383\" data-end=\"489\">Enrollment is confirmed only after completing the required documentation and fee payments as instructed.</p>\r\n</li><li data-start=\"490\" data-end=\"628\">\r\n<p data-start=\"492\" data-end=\"628\">Students are responsible for providing accurate information during registration, including name, contact details, and selected course.</p>\r\n</li><li data-start=\"629\" data-end=\"771\">\r\n<p data-start=\"631\" data-end=\"771\">Study materials, online classes, and recorded lessons are provided solely for personal use and must not be shared, copied, or distributed.</p>\r\n</li><li data-start=\"772\" data-end=\"937\">\r\n<p data-start=\"774\" data-end=\"937\">Certificates and degrees are issued by the respective universities. BestQualityEdu.com acts only as a facilitator for guidance, support, and learning assistance.</p>\r\n</li><li data-start=\"938\" data-end=\"1049\">\r\n<p data-start=\"940\" data-end=\"1049\">Refunds, if applicable, follow specific university or institute rules and may vary depending on the course.</p>\r\n</li><li data-start=\"1050\" data-end=\"1157\">\r\n<p data-start=\"1052\" data-end=\"1157\">Monthly installment plans must be paid on time; delays may affect access to classes or study materials.</p>\r\n</li><li data-start=\"1158\" data-end=\"1281\">\r\n<p data-start=\"1160\" data-end=\"1281\">We are not responsible for delays caused by external authorities, universities, or technical issues beyond our control.</p>\r\n</li><li data-start=\"1282\" data-end=\"1398\">\r\n<p data-start=\"1284\" data-end=\"1398\">Misuse of the website, false information, or abusive behaviour may lead to permanent cancellation of enrollment.</p>\r\n</li><li data-start=\"1399\" data-end=\"1516\">\r\n<p data-start=\"1401\" data-end=\"1516\">By continuing to use this website, you accept these Terms &amp; Conditions and agree to any updates made in the future.</p></li></ul><p><br></p>', 2, 'active', '2025-11-15 14:09:33', '2025-11-15 14:09:33'),
(3, 'Cookie Policy', 'Cookie Policy', '<p data-start=\"113\" data-end=\"130\"><strong data-start=\"113\" data-end=\"130\">Cookie Policy</strong></p>\r\n<ul data-start=\"132\" data-end=\"999\"><li data-start=\"132\" data-end=\"244\">\r\n<p data-start=\"134\" data-end=\"244\"><strong data-start=\"134\" data-end=\"155\">What Are Cookies:</strong> Cookies are small files stored on your device to help improve your website experience.</p>\r\n</li><li data-start=\"245\" data-end=\"387\">\r\n<p data-start=\"247\" data-end=\"387\"><strong data-start=\"247\" data-end=\"270\">Purpose of Cookies:</strong> We use cookies to enhance site performance, remember user preferences, analyze traffic, and optimize our services.</p>\r\n</li><li data-start=\"388\" data-end=\"597\">\r\n<p data-start=\"390\" data-end=\"418\"><strong data-start=\"390\" data-end=\"416\">Types of Cookies Used:</strong></p>\r\n<ul data-start=\"421\" data-end=\"597\"><li data-start=\"421\" data-end=\"468\">\r\n<p data-start=\"423\" data-end=\"468\">Essential cookies for website functionality</p>\r\n</li><li data-start=\"471\" data-end=\"528\">\r\n<p data-start=\"473\" data-end=\"528\">Analytics cookies to track usage and improve services</p>\r\n</li><li data-start=\"531\" data-end=\"597\">\r\n<p data-start=\"533\" data-end=\"597\">Optional marketing cookies to show relevant content and offers</p>\r\n</li></ul>\r\n</li><li data-start=\"598\" data-end=\"733\">\r\n<p data-start=\"600\" data-end=\"733\"><strong data-start=\"600\" data-end=\"624\">Third-Party Cookies:</strong> Some features may use trusted third-party services (like Google Analytics) that may set their own cookies.</p>\r\n</li><li data-start=\"734\" data-end=\"899\">\r\n<p data-start=\"736\" data-end=\"899\"><strong data-start=\"736\" data-end=\"757\">Managing Cookies:</strong> You can choose to disable cookies via your browser settings. Note that some website features may not work properly if cookies are disabled.</p>\r\n</li><li data-start=\"900\" data-end=\"999\">\r\n<p data-start=\"902\" data-end=\"999\"><strong data-start=\"902\" data-end=\"914\">Consent:</strong> By using our website, you agree to our use of cookies as described in this policy.</p></li></ul><p><br></p>', 3, 'active', '2025-11-15 14:10:24', '2025-11-15 14:10:24'),
(4, 'GDPR Notice', 'GDPR Notice', '<p data-start=\"106\" data-end=\"123\"><strong data-start=\"106\" data-end=\"121\">GDPR Notice</strong></p>\r\n<ul data-start=\"125\" data-end=\"1472\"><li data-start=\"125\" data-end=\"232\">\r\n<p data-start=\"127\" data-end=\"232\"><strong data-start=\"127\" data-end=\"147\">Data Controller:</strong> Best Quality Education (bestqualityedu.com) is responsible for your personal data.</p>\r\n</li><li data-start=\"233\" data-end=\"384\">\r\n<p data-start=\"235\" data-end=\"384\"><strong data-start=\"235\" data-end=\"254\">Data Collected:</strong> We may collect your name, email, phone number, course preferences, uploaded documents, and communication via WhatsApp or forms.</p>\r\n</li><li data-start=\"385\" data-end=\"571\">\r\n<p data-start=\"387\" data-end=\"571\"><strong data-start=\"387\" data-end=\"413\">Purpose of Processing:</strong> Your data is used to process enrollments, provide study materials, communicate updates, improve services, and for marketing purposes (if consent is given).</p>\r\n</li><li data-start=\"572\" data-end=\"700\">\r\n<p data-start=\"574\" data-end=\"700\"><strong data-start=\"574\" data-end=\"590\">Legal Basis:</strong> We process your data with your consent, for performance of a contract, or to comply with legal obligations.</p>\r\n</li><li data-start=\"701\" data-end=\"865\">\r\n<p data-start=\"703\" data-end=\"865\"><strong data-start=\"703\" data-end=\"720\">Data Sharing:</strong> Your personal information is only shared with trusted service providers (universities, payment processors, analytics tools) and is never sold.</p>\r\n</li><li data-start=\"866\" data-end=\"995\">\r\n<p data-start=\"868\" data-end=\"995\"><strong data-start=\"868\" data-end=\"887\">Data Retention:</strong> We store your personal data only as long as necessary to provide services and fulfill legal requirements.</p>\r\n</li><li data-start=\"996\" data-end=\"1202\">\r\n<p data-start=\"998\" data-end=\"1027\"><strong data-start=\"998\" data-end=\"1025\">Your Rights under GDPR:</strong></p>\r\n<ul data-start=\"1030\" data-end=\"1202\"><li data-start=\"1030\" data-end=\"1059\">\r\n<p data-start=\"1032\" data-end=\"1059\">Access your personal data</p>\r\n</li><li data-start=\"1062\" data-end=\"1109\">\r\n<p data-start=\"1064\" data-end=\"1109\">Request correction or deletion of your data</p>\r\n</li><li data-start=\"1112\" data-end=\"1144\">\r\n<p data-start=\"1114\" data-end=\"1144\">Withdraw consent at any time</p>\r\n</li><li data-start=\"1147\" data-end=\"1171\">\r\n<p data-start=\"1149\" data-end=\"1171\">Object to processing</p>\r\n</li><li data-start=\"1174\" data-end=\"1202\">\r\n<p data-start=\"1176\" data-end=\"1202\">Request data portability</p>\r\n</li></ul>\r\n</li><li data-start=\"1203\" data-end=\"1334\">\r\n<p data-start=\"1205\" data-end=\"1334\"><strong data-start=\"1205\" data-end=\"1227\">How to Contact Us:</strong> For any GDPR-related requests, contact:<br data-start=\"1267\" data-end=\"1270\">\r\n<strong data-start=\"1272\" data-end=\"1282\">Email:</strong> <a data-start=\"1283\" data-end=\"1306\" class=\"decorated-link cursor-pointer\" rel=\"noopener\">info@bestqualityedu.com<span aria-hidden=\"true\" class=\"ms-0.5 inline-block align-middle leading-none\"><svg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\" data-rtl-flip=\"\" class=\"block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]\"></svg></span></a></p></li></ul>', 4, 'active', '2025-11-15 14:11:33', '2025-11-15 14:11:33'),
(5, 'Anti-Money Laundering (AML) Policy', 'Anti-Money Laundering (AML) Policy', '<p data-start=\"173\" data-end=\"213\"><strong data-start=\"173\" data-end=\"211\">Anti-Money Laundering (AML) Policy</strong></p>\r\n<ul data-start=\"215\" data-end=\"1418\"><li data-start=\"215\" data-end=\"392\">\r\n<p data-start=\"217\" data-end=\"392\"><strong data-start=\"217\" data-end=\"229\">Purpose:</strong> Best Quality Education is committed to preventing any form of money laundering or terrorist financing in compliance with UAE laws and international regulations.</p>\r\n</li><li data-start=\"393\" data-end=\"527\">\r\n<p data-start=\"395\" data-end=\"527\"><strong data-start=\"395\" data-end=\"405\">Scope:</strong> This policy applies to all students, staff, and third-party partners who make or receive payments through our platform.</p>\r\n</li><li data-start=\"528\" data-end=\"714\">\r\n<p data-start=\"530\" data-end=\"714\"><strong data-start=\"530\" data-end=\"556\">Customer Verification:</strong> We may require verification of identity (KYC) for all students enrolling in courses, including government-issued ID, contact details, and proof of payment.</p>\r\n</li><li data-start=\"715\" data-end=\"871\">\r\n<p data-start=\"717\" data-end=\"871\"><strong data-start=\"717\" data-end=\"740\">Payment Monitoring:</strong> All transactions are monitored for suspicious activity, unusual payment patterns, or transactions involving high-risk countries.</p>\r\n</li><li data-start=\"872\" data-end=\"1012\">\r\n<p data-start=\"874\" data-end=\"1012\"><strong data-start=\"874\" data-end=\"908\">Reporting Suspicious Activity:</strong> Any suspicious activity will be reported to the relevant authorities in accordance with UAE AML laws.</p>\r\n</li><li data-start=\"1013\" data-end=\"1139\">\r\n<p data-start=\"1015\" data-end=\"1139\"><strong data-start=\"1015\" data-end=\"1043\">Prohibited Transactions:</strong> Cash or third-party payments intended to conceal the origin of funds are strictly prohibited.</p>\r\n</li><li data-start=\"1140\" data-end=\"1277\">\r\n<p data-start=\"1142\" data-end=\"1277\"><strong data-start=\"1142\" data-end=\"1167\">Staff Responsibility:</strong> All employees and agents must follow this AML Policy and report any concerns immediately to the management.</p>\r\n</li><li data-start=\"1278\" data-end=\"1418\">\r\n<p data-start=\"1280\" data-end=\"1418\"><strong data-start=\"1280\" data-end=\"1304\">Compliance &amp; Review:</strong> This policy is regularly reviewed and updated to ensure compliance with applicable AML laws and best practices.</p>\r\n</li></ul>\r\n<p data-start=\"1420\" data-end=\"1513\"><strong data-start=\"1420\" data-end=\"1432\">Contact:</strong><br data-start=\"1432\" data-end=\"1435\">\r\nFor any questions regarding this policy, contact <strong data-start=\"1484\" data-end=\"1511\"><a data-start=\"1486\" data-end=\"1509\" class=\"decorated-link cursor-pointer\" rel=\"noopener\">info@bestqualityedu.com<span aria-hidden=\"true\" class=\"ms-0.5 inline-block align-middle leading-none\"><svg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\" data-rtl-flip=\"\" class=\"block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]\"></svg></span></a></strong></p><p><br></p>', 5, 'active', '2025-11-15 14:13:02', '2025-11-15 14:13:02'),
(6, 'Legal Compliance Policy', 'Legal Compliance Policy', '<p data-start=\"124\" data-end=\"153\"><strong data-start=\"124\" data-end=\"151\">Legal Compliance Policy</strong></p>\r\n<ul data-start=\"155\" data-end=\"1311\"><li data-start=\"155\" data-end=\"318\">\r\n<p data-start=\"157\" data-end=\"318\"><strong data-start=\"157\" data-end=\"169\">Purpose:</strong> Best Quality Education is committed to adhering to all applicable laws, regulations, and industry standards to ensure ethical and legal operation.</p>\r\n</li><li data-start=\"319\" data-end=\"426\">\r\n<p data-start=\"321\" data-end=\"426\"><strong data-start=\"321\" data-end=\"331\">Scope:</strong> This policy applies to all employees, students, partners, and third-party service providers.</p>\r\n</li><li data-start=\"427\" data-end=\"582\">\r\n<p data-start=\"429\" data-end=\"582\"><strong data-start=\"429\" data-end=\"459\">Education &amp; Accreditation:</strong> We comply with all university and accreditation requirements, including UGC, AICTE, NAAC, DEB, AIU, and IAU regulations.</p>\r\n</li><li data-start=\"583\" data-end=\"758\">\r\n<p data-start=\"585\" data-end=\"758\"><strong data-start=\"585\" data-end=\"615\">Data Protection &amp; Privacy:</strong> We follow local and international data protection laws, including GDPR and UAE data privacy requirements, to safeguard personal information.</p>\r\n</li><li data-start=\"759\" data-end=\"888\">\r\n<p data-start=\"761\" data-end=\"888\"><strong data-start=\"761\" data-end=\"786\">Financial Compliance:</strong> All payments, transactions, and refunds follow applicable financial and anti-money laundering laws.</p>\r\n</li><li data-start=\"889\" data-end=\"1020\">\r\n<p data-start=\"891\" data-end=\"1020\"><strong data-start=\"891\" data-end=\"917\">Intellectual Property:</strong> All content, study materials, and digital resources respect copyright laws and licensing agreements.</p>\r\n</li><li data-start=\"1021\" data-end=\"1173\">\r\n<p data-start=\"1023\" data-end=\"1173\"><strong data-start=\"1023\" data-end=\"1048\">Reporting Violations:</strong> Any employee or stakeholder who becomes aware of a legal or regulatory violation must report it immediately to management.</p>\r\n</li><li data-start=\"1174\" data-end=\"1311\">\r\n<p data-start=\"1176\" data-end=\"1311\"><strong data-start=\"1176\" data-end=\"1198\">Continuous Review:</strong> This policy is reviewed regularly to ensure ongoing compliance with new laws, regulations, and best practices.</p>\r\n</li></ul>\r\n<p data-start=\"1313\" data-end=\"1419\"><strong data-start=\"1313\" data-end=\"1325\">Contact:</strong><br data-start=\"1325\" data-end=\"1328\">\r\nFor questions about this policy or compliance matters, email: <strong data-start=\"1390\" data-end=\"1417\"><a data-start=\"1392\" data-end=\"1415\" class=\"decorated-link cursor-pointer\" rel=\"noopener\">info@bestqualityedu.com<span aria-hidden=\"true\" class=\"ms-0.5 inline-block align-middle leading-none\"><svg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\" data-rtl-flip=\"\" class=\"block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]\"></svg></span></a></strong></p><p><br></p>', 6, 'active', '2025-11-15 14:14:01', '2025-11-15 14:14:01'),
(7, 'Corporate Social Responsibility (CSR) Policy', 'Corporate Social Responsibility (CSR) Policy', '<p data-start=\"157\" data-end=\"207\"><strong data-start=\"157\" data-end=\"205\">Corporate Social Responsibility (CSR) Policy</strong></p>\r\n<ul data-start=\"209\" data-end=\"1223\"><li data-start=\"209\" data-end=\"370\">\r\n<p data-start=\"211\" data-end=\"370\"><strong data-start=\"211\" data-end=\"223\">Purpose:</strong> Best Quality Education is committed to contributing positively to society by supporting education, skill development, and community empowerment.</p>\r\n</li><li data-start=\"371\" data-end=\"725\">\r\n<p data-start=\"373\" data-end=\"391\"><strong data-start=\"373\" data-end=\"389\">Focus Areas:</strong></p>\r\n<ul data-start=\"394\" data-end=\"725\"><li data-start=\"394\" data-end=\"499\">\r\n<p data-start=\"396\" data-end=\"499\"><strong data-start=\"396\" data-end=\"417\">Education Access:</strong> Promote online learning for working professionals and underprivileged learners.</p>\r\n</li><li data-start=\"502\" data-end=\"609\">\r\n<p data-start=\"504\" data-end=\"609\"><strong data-start=\"504\" data-end=\"526\">Skill Development:</strong> Provide resources and programs to enhance employability and professional growth.</p>\r\n</li><li data-start=\"612\" data-end=\"725\">\r\n<p data-start=\"614\" data-end=\"725\"><strong data-start=\"614\" data-end=\"636\">Community Support:</strong> Engage in initiatives that create social impact and awareness about lifelong learning.</p>\r\n</li></ul>\r\n</li><li data-start=\"726\" data-end=\"880\">\r\n<p data-start=\"728\" data-end=\"880\"><strong data-start=\"728\" data-end=\"754\">Sustainable Practices:</strong> Operate in a responsible and ethical manner, ensuring environmental, social, and economic sustainability in all activities.</p>\r\n</li><li data-start=\"881\" data-end=\"993\">\r\n<p data-start=\"883\" data-end=\"993\"><strong data-start=\"883\" data-end=\"901\">Collaboration:</strong> Partner with universities, NGOs, and educational institutions to expand reach and impact.</p>\r\n</li><li data-start=\"994\" data-end=\"1115\">\r\n<p data-start=\"996\" data-end=\"1115\"><strong data-start=\"996\" data-end=\"1023\">Monitoring &amp; Reporting:</strong> Regularly assess the outcomes of CSR initiatives and report achievements to stakeholders.</p>\r\n</li><li data-start=\"1116\" data-end=\"1223\">\r\n<p data-start=\"1118\" data-end=\"1223\"><strong data-start=\"1118\" data-end=\"1143\">Employee Involvement:</strong> Encourage staff participation in social initiatives and educational programs.</p>\r\n</li></ul>\r\n<p data-start=\"1225\" data-end=\"1320\"><strong data-start=\"1225\" data-end=\"1237\">Contact:</strong><br data-start=\"1237\" data-end=\"1240\">\r\nFor CSR-related inquiries or collaboration, email: <strong data-start=\"1291\" data-end=\"1318\"><a data-start=\"1293\" data-end=\"1316\" class=\"decorated-link cursor-pointer\" rel=\"noopener\">info@bestqualityedu.com<span aria-hidden=\"true\" class=\"ms-0.5 inline-block align-middle leading-none\"><svg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\" data-rtl-flip=\"\" class=\"block h-[0.75em] w-[0.75em] stroke-current stroke-[0.75]\"></svg></span></a></strong></p><p><br></p>', 7, 'active', '2025-11-15 14:14:50', '2025-11-15 14:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Privacy Policy ', 'Cookies accept or not accept', '2025-11-12 06:24:53', '2025-11-12 06:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `procedures`
--

CREATE TABLE `procedures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_headers`
--

CREATE TABLE `section_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `use_for` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_editable` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleteable` varchar(255) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_titles`
--

CREATE TABLE `section_titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('testimonial','faq','feature','procedure','why_choose_us','document','feature_image','hero_section','intro_section','why_us_image','call_to_action','residency-visa') NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_globals`
--

CREATE TABLE `seo_globals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `default_meta_title` varchar(255) DEFAULT NULL,
  `default_meta_description` text DEFAULT NULL,
  `default_meta_keywords` varchar(255) DEFAULT NULL,
  `default_meta_image` varchar(255) DEFAULT NULL,
  `global_canonical` varchar(255) DEFAULT NULL,
  `robots_default` varchar(255) NOT NULL DEFAULT 'index,follow',
  `robots_txt` text DEFAULT NULL,
  `google_site_verification` varchar(255) DEFAULT NULL,
  `bing_site_verification` varchar(255) DEFAULT NULL,
  `sitemap_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `sitemap_urls` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sitemap_urls`)),
  `google_analytics_id` varchar(255) DEFAULT NULL,
  `google_tag_manager_id` varchar(255) DEFAULT NULL,
  `facebook_pixel_id` varchar(255) DEFAULT NULL,
  `other_tracking_scripts` longtext DEFAULT NULL,
  `default_og_type` varchar(255) NOT NULL DEFAULT 'website',
  `default_twitter_card` varchar(255) NOT NULL DEFAULT 'summary_large_image',
  `structured_data_global` longtext DEFAULT NULL,
  `global_header_scripts` longtext DEFAULT NULL,
  `global_body_end_scripts` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_globals`
--

INSERT INTO `seo_globals` (`id`, `site_name`, `default_meta_title`, `default_meta_description`, `default_meta_keywords`, `default_meta_image`, `global_canonical`, `robots_default`, `robots_txt`, `google_site_verification`, `bing_site_verification`, `sitemap_enabled`, `sitemap_urls`, `google_analytics_id`, `google_tag_manager_id`, `facebook_pixel_id`, `other_tracking_scripts`, `default_og_type`, `default_twitter_card`, `structured_data_global`, `global_header_scripts`, `global_body_end_scripts`, `created_at`, `updated_at`) VALUES
(1, 'My Website', 'Welcome to My Website', 'This is the default meta description', 'website, laravel, seo', NULL, NULL, 'index,follow', NULL, NULL, NULL, 1, '[]', NULL, NULL, NULL, NULL, 'website', 'summary_large_image', NULL, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `seo_metas`
--

CREATE TABLE `seo_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_slug` varchar(255) DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_global` enum('global','local') NOT NULL DEFAULT 'global',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `robots_tag` varchar(255) DEFAULT NULL,
  `meta_author` varchar(255) DEFAULT NULL,
  `meta_image` varchar(255) DEFAULT NULL,
  `meta_type` varchar(255) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `og_url` varchar(255) DEFAULT NULL,
  `og_type` varchar(255) DEFAULT NULL,
  `twitter_card` varchar(255) DEFAULT NULL,
  `twitter_title` varchar(255) DEFAULT NULL,
  `twitter_description` text DEFAULT NULL,
  `twitter_image` varchar(255) DEFAULT NULL,
  `schema_json` longtext DEFAULT NULL,
  `structured_data_type` varchar(255) DEFAULT NULL,
  `header_top` longtext DEFAULT NULL,
  `header_bottom` longtext DEFAULT NULL,
  `body_start` longtext DEFAULT NULL,
  `body_end` longtext DEFAULT NULL,
  `custom_css` longtext DEFAULT NULL,
  `custom_js` longtext DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `status` enum('publish','draft') NOT NULL,
  `isfeature` enum('featured','unfeatured') NOT NULL DEFAULT 'featured',
  `font_awesome_icon` varchar(255) DEFAULT NULL,
  `service_title` varchar(255) NOT NULL,
  `service_subtitle` varchar(255) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_subtitle` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `other_description` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_category_id`, `name`, `slug`, `order_no`, `status`, `isfeature`, `font_awesome_icon`, `service_title`, `service_subtitle`, `banner_title`, `banner_subtitle`, `thumbnail`, `icon`, `banner_image`, `short_description`, `description`, `other_description`, `meta_title`, `meta_keywords`, `meta_description`, `meta_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'HVAC systems', 'hvac-systems', '1', 'publish', 'featured', 'fa-solid fa-wrench', 'HVAC systems', 'HVAC systems services', 'HVAC systems banner', 'Professional HVAC systems', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'HVAC systems - short description.', 'HVAC systems - detailed description and scope.', NULL, 'HVAC systems', 'HVAC, systems', 'HVAC systems meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(2, 1, 'Electrical systems maintenance', 'electrical-systems-maintenance', '2', 'publish', 'featured', 'fa-solid fa-wrench', 'Electrical systems maintenance', 'Electrical systems maintenance services', 'Electrical systems maintenance banner', 'Professional Electrical systems maintenance', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Electrical systems maintenance - short description.', 'Electrical systems maintenance - detailed description and scope.', NULL, 'Electrical systems maintenance', 'Electrical, systems, maintenance', 'Electrical systems maintenance meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(3, 1, 'Building management systems (BMS)', 'building-management-systems-bms', '3', 'publish', 'featured', 'fa-solid fa-wrench', 'Building management systems (BMS)', 'Building management systems (BMS) services', 'Building management systems (BMS) banner', 'Professional Building management systems (BMS)', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Building management systems (BMS) - short description.', 'Building management systems (BMS) - detailed description and scope.', NULL, 'Building management systems (BMS)', 'Building, management, systems, (BMS)', 'Building management systems (BMS) meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(4, 1, 'Computer-aided facilities management (CAFM)', 'computer-aided-facilities-management-cafm', '4', 'publish', 'featured', 'fa-solid fa-wrench', 'Computer-aided facilities management (CAFM)', 'Computer-aided facilities management (CAFM) services', 'Computer-aided facilities management (CAFM) banner', 'Professional Computer-aided facilities management (CAFM)', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Computer-aided facilities management (CAFM) - short description.', 'Computer-aided facilities management (CAFM) - detailed description and scope.', NULL, 'Computer-aided facilities management (CAFM)', 'Computer-aided, facilities, management, (CAFM)', 'Computer-aided facilities management (CAFM) meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(5, 1, 'Plumbing and drainage systems', 'plumbing-and-drainage-systems', '5', 'publish', 'featured', 'fa-solid fa-wrench', 'Plumbing and drainage systems', 'Plumbing and drainage systems services', 'Plumbing and drainage systems banner', 'Professional Plumbing and drainage systems', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Plumbing and drainage systems - short description.', 'Plumbing and drainage systems - detailed description and scope.', NULL, 'Plumbing and drainage systems', 'Plumbing, and, drainage, systems', 'Plumbing and drainage systems meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(6, 1, 'Air conditioning systems', 'air-conditioning-systems', '6', 'publish', 'featured', 'fa-solid fa-wrench', 'Air conditioning systems', 'Air conditioning systems services', 'Air conditioning systems banner', 'Professional Air conditioning systems', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Air conditioning systems - short description.', 'Air conditioning systems - detailed description and scope.', NULL, 'Air conditioning systems', 'Air, conditioning, systems', 'Air conditioning systems meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(7, 1, 'Building maintenance services', 'building-maintenance-services', '7', 'publish', 'featured', 'fa-solid fa-wrench', 'Building maintenance services', 'Building maintenance services services', 'Building maintenance services banner', 'Professional Building maintenance services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Building maintenance services - short description.', 'Building maintenance services - detailed description and scope.', NULL, 'Building maintenance services', 'Building, maintenance, services', 'Building maintenance services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(8, 1, 'LV systems (CCTV, access control, barriers)', 'lv-systems-cctv-access-control-barriers', '8', 'publish', 'featured', 'fa-solid fa-wrench', 'LV systems (CCTV, access control, barriers)', 'LV systems (CCTV, access control, barriers) services', 'LV systems (CCTV, access control, barriers) banner', 'Professional LV systems (CCTV, access control, barriers)', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'LV systems (CCTV, access control, barriers) - short description.', 'LV systems (CCTV, access control, barriers) - detailed description and scope.', NULL, 'LV systems (CCTV, access control, barriers)', 'LV, systems, (CCTV,, access, control,, barriers)', 'LV systems (CCTV, access control, barriers) meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(9, 1, 'Interior fit-out and refurbishment', 'interior-fit-out-and-refurbishment', '9', 'publish', 'featured', 'fa-solid fa-wrench', 'Interior fit-out and refurbishment', 'Interior fit-out and refurbishment services', 'Interior fit-out and refurbishment banner', 'Professional Interior fit-out and refurbishment', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Interior fit-out and refurbishment - short description.', 'Interior fit-out and refurbishment - detailed description and scope.', NULL, 'Interior fit-out and refurbishment', 'Interior, fit-out, and, refurbishment', 'Interior fit-out and refurbishment meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(10, 1, 'Remote monitoring systems', 'remote-monitoring-systems', '10', 'publish', 'featured', 'fa-solid fa-wrench', 'Remote monitoring systems', 'Remote monitoring systems services', 'Remote monitoring systems banner', 'Professional Remote monitoring systems', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Remote monitoring systems - short description.', 'Remote monitoring systems - detailed description and scope.', NULL, 'Remote monitoring systems', 'Remote, monitoring, systems', 'Remote monitoring systems meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(11, 1, 'Asset management', 'asset-management', '11', 'publish', 'featured', 'fa-solid fa-wrench', 'Asset management', 'Asset management services', 'Asset management banner', 'Professional Asset management', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Asset management - short description.', 'Asset management - detailed description and scope.', NULL, 'Asset management', 'Asset, management', 'Asset management meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(12, 1, 'Water tank cleaning and disinfection', 'water-tank-cleaning-and-disinfection', '12', 'publish', 'featured', 'fa-solid fa-wrench', 'Water tank cleaning and disinfection', 'Water tank cleaning and disinfection services', 'Water tank cleaning and disinfection banner', 'Professional Water tank cleaning and disinfection', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Water tank cleaning and disinfection - short description.', 'Water tank cleaning and disinfection - detailed description and scope.', NULL, 'Water tank cleaning and disinfection', 'Water, tank, cleaning, and, disinfection', 'Water tank cleaning and disinfection meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(13, 1, 'Fire safety management', 'fire-safety-management', '13', 'publish', 'featured', 'fa-solid fa-wrench', 'Fire safety management', 'Fire safety management services', 'Fire safety management banner', 'Professional Fire safety management', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Fire safety management - short description.', 'Fire safety management - detailed description and scope.', NULL, 'Fire safety management', 'Fire, safety, management', 'Fire safety management meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(14, 1, 'Health and safety systems', 'health-and-safety-systems', '14', 'publish', 'featured', 'fa-solid fa-wrench', 'Health and safety systems', 'Health and safety systems services', 'Health and safety systems banner', 'Professional Health and safety systems', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Health and safety systems - short description.', 'Health and safety systems - detailed description and scope.', NULL, 'Health and safety systems', 'Health, and, safety, systems', 'Health and safety systems meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(15, 1, 'Auditing', 'auditing', '15', 'publish', 'featured', 'fa-solid fa-wrench', 'Auditing', 'Auditing services', 'Auditing banner', 'Professional Auditing', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Auditing - short description.', 'Auditing - detailed description and scope.', NULL, 'Auditing', 'Auditing', 'Auditing meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(16, 1, 'Fire alarm and firefighting systems', 'fire-alarm-and-firefighting-systems', '16', 'publish', 'featured', 'fa-solid fa-wrench', 'Fire alarm and firefighting systems', 'Fire alarm and firefighting systems services', 'Fire alarm and firefighting systems banner', 'Professional Fire alarm and firefighting systems', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Fire alarm and firefighting systems - short description.', 'Fire alarm and firefighting systems - detailed description and scope.', NULL, 'Fire alarm and firefighting systems', 'Fire, alarm, and, firefighting, systems', 'Fire alarm and firefighting systems meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(17, 1, 'Generator maintenance', 'generator-maintenance', '17', 'publish', 'featured', 'fa-solid fa-wrench', 'Generator maintenance', 'Generator maintenance services', 'Generator maintenance banner', 'Professional Generator maintenance', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Generator maintenance - short description.', 'Generator maintenance - detailed description and scope.', NULL, 'Generator maintenance', 'Generator, maintenance', 'Generator maintenance meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(18, 1, 'Design and build service', 'design-and-build-service', '18', 'publish', 'featured', 'fa-solid fa-wrench', 'Design and build service', 'Design and build service services', 'Design and build service banner', 'Professional Design and build service', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Design and build service - short description.', 'Design and build service - detailed description and scope.', NULL, 'Design and build service', 'Design, and, build, service', 'Design and build service meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(19, 2, 'Commissioning management', 'commissioning-management', '19', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Commissioning management', 'Commissioning management services', 'Commissioning management banner', 'Professional Commissioning management', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Commissioning management - short description.', 'Commissioning management - detailed description.', NULL, 'Commissioning management', 'Commissioning, management', 'Commissioning management meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(20, 2, 'Pre-commissioning', 'pre-commissioning', '20', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Pre-commissioning', 'Pre-commissioning services', 'Pre-commissioning banner', 'Professional Pre-commissioning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Pre-commissioning - short description.', 'Pre-commissioning - detailed description.', NULL, 'Pre-commissioning', 'Pre-commissioning', 'Pre-commissioning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(21, 2, 'Performance testing', 'performance-testing', '21', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Performance testing', 'Performance testing services', 'Performance testing banner', 'Professional Performance testing', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Performance testing - short description.', 'Performance testing - detailed description.', NULL, 'Performance testing', 'Performance, testing', 'Performance testing meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(22, 2, 'Air measurement & balancing', 'air-measurement-balancing', '22', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Air measurement & balancing', 'Air measurement & balancing services', 'Air measurement & balancing banner', 'Professional Air measurement & balancing', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Air measurement & balancing - short description.', 'Air measurement & balancing - detailed description.', NULL, 'Air measurement & balancing', 'Air, measurement, &, balancing', 'Air measurement & balancing meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(23, 2, 'Chilled water measurement & balancing', 'chilled-water-measurement-balancing', '23', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Chilled water measurement & balancing', 'Chilled water measurement & balancing services', 'Chilled water measurement & balancing banner', 'Professional Chilled water measurement & balancing', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Chilled water measurement & balancing - short description.', 'Chilled water measurement & balancing - detailed description.', NULL, 'Chilled water measurement & balancing', 'Chilled, water, measurement, &, balancing', 'Chilled water measurement & balancing meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(24, 2, 'Temperature & humidity analysis', 'temperature-humidity-analysis', '24', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Temperature & humidity analysis', 'Temperature & humidity analysis services', 'Temperature & humidity analysis banner', 'Professional Temperature & humidity analysis', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Temperature & humidity analysis - short description.', 'Temperature & humidity analysis - detailed description.', NULL, 'Temperature & humidity analysis', 'Temperature, &, humidity, analysis', 'Temperature & humidity analysis meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(25, 2, 'Sound level testing (Noise Criteria)', 'sound-level-testing-noise-criteria', '25', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Sound level testing (Noise Criteria)', 'Sound level testing (Noise Criteria) services', 'Sound level testing (Noise Criteria) banner', 'Professional Sound level testing (Noise Criteria)', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Sound level testing (Noise Criteria) - short description.', 'Sound level testing (Noise Criteria) - detailed description.', NULL, 'Sound level testing (Noise Criteria)', 'Sound, level, testing, (Noise, Criteria)', 'Sound level testing (Noise Criteria) meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(26, 2, 'Operation & maintenance manuals', 'operation-maintenance-manuals', '26', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Operation & maintenance manuals', 'Operation & maintenance manuals services', 'Operation & maintenance manuals banner', 'Professional Operation & maintenance manuals', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Operation & maintenance manuals - short description.', 'Operation & maintenance manuals - detailed description.', NULL, 'Operation & maintenance manuals', 'Operation, &, maintenance, manuals', 'Operation & maintenance manuals meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(27, 2, 'Building audit & energy management', 'building-audit-energy-management', '27', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Building audit & energy management', 'Building audit & energy management services', 'Building audit & energy management banner', 'Professional Building audit & energy management', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Building audit & energy management - short description.', 'Building audit & energy management - detailed description.', NULL, 'Building audit & energy management', 'Building, audit, &, energy, management', 'Building audit & energy management meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(28, 2, 'Technical advising services', 'technical-advising-services', '28', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Technical advising services', 'Technical advising services services', 'Technical advising services banner', 'Professional Technical advising services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Technical advising services - short description.', 'Technical advising services - detailed description.', NULL, 'Technical advising services', 'Technical, advising, services', 'Technical advising services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(29, 2, 'Air quality test', 'air-quality-test', '29', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Air quality test', 'Air quality test services', 'Air quality test banner', 'Professional Air quality test', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Air quality test - short description.', 'Air quality test - detailed description.', NULL, 'Air quality test', 'Air, quality, test', 'Air quality test meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(30, 2, 'Duct leakage test', 'duct-leakage-test', '30', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Duct leakage test', 'Duct leakage test services', 'Duct leakage test banner', 'Professional Duct leakage test', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Duct leakage test - short description.', 'Duct leakage test - detailed description.', NULL, 'Duct leakage test', 'Duct, leakage, test', 'Duct leakage test meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(31, 2, 'Smoke test for the rooms and HVAC ducts', 'smoke-test-for-the-rooms-and-hvac-ducts', '31', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Smoke test for the rooms and HVAC ducts', 'Smoke test for the rooms and HVAC ducts services', 'Smoke test for the rooms and HVAC ducts banner', 'Professional Smoke test for the rooms and HVAC ducts', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Smoke test for the rooms and HVAC ducts - short description.', 'Smoke test for the rooms and HVAC ducts - detailed description.', NULL, 'Smoke test for the rooms and HVAC ducts', 'Smoke, test, for, the, rooms, and, HVAC, ducts', 'Smoke test for the rooms and HVAC ducts meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(32, 2, 'Electrical live test', 'electrical-live-test', '32', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Electrical live test', 'Electrical live test services', 'Electrical live test banner', 'Professional Electrical live test', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Electrical live test - short description.', 'Electrical live test - detailed description.', NULL, 'Electrical live test', 'Electrical, live, test', 'Electrical live test meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(33, 2, 'Electrical continuity test', 'electrical-continuity-test', '33', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Electrical continuity test', 'Electrical continuity test services', 'Electrical continuity test banner', 'Professional Electrical continuity test', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Electrical continuity test - short description.', 'Electrical continuity test - detailed description.', NULL, 'Electrical continuity test', 'Electrical, continuity, test', 'Electrical continuity test meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(34, 2, 'Room pressure test', 'room-pressure-test', '34', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Room pressure test', 'Room pressure test services', 'Room pressure test banner', 'Professional Room pressure test', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Room pressure test - short description.', 'Room pressure test - detailed description.', NULL, 'Room pressure test', 'Room, pressure, test', 'Room pressure test meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(35, 2, 'Fume hood air balancing', 'fume-hood-air-balancing', '35', 'publish', 'featured', 'fa-solid fa-screwdriver-wrench', 'Fume hood air balancing', 'Fume hood air balancing services', 'Fume hood air balancing banner', 'Professional Fume hood air balancing', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Fume hood air balancing - short description.', 'Fume hood air balancing - detailed description.', NULL, 'Fume hood air balancing', 'Fume, hood, air, balancing', 'Fume hood air balancing meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(36, 3, 'Security services', 'security-services', '36', 'publish', 'featured', 'fa-solid fa-broom', 'Security services', 'Security services services', 'Security services banner', 'Professional Security services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Security services - short description.', 'Security services - detailed description.', NULL, 'Security services', 'Security, services', 'Security services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(37, 3, 'General administration', 'general-administration', '37', 'publish', 'featured', 'fa-solid fa-broom', 'General administration', 'General administration services', 'General administration banner', 'Professional General administration', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'General administration - short description.', 'General administration - detailed description.', NULL, 'General administration', 'General, administration', 'General administration meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(38, 3, 'Staffing services', 'staffing-services', '38', 'publish', 'featured', 'fa-solid fa-broom', 'Staffing services', 'Staffing services services', 'Staffing services banner', 'Professional Staffing services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Staffing services - short description.', 'Staffing services - detailed description.', NULL, 'Staffing services', 'Staffing, services', 'Staffing services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(39, 3, 'Pest control', 'pest-control', '39', 'publish', 'featured', 'fa-solid fa-broom', 'Pest control', 'Pest control services', 'Pest control banner', 'Professional Pest control', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Pest control - short description.', 'Pest control - detailed description.', NULL, 'Pest control', 'Pest, control', 'Pest control meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(40, 3, '24/7 helpdesk', '247-helpdesk', '40', 'publish', 'featured', 'fa-solid fa-broom', '24/7 helpdesk', '24/7 helpdesk services', '24/7 helpdesk banner', 'Professional 24/7 helpdesk', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', '24/7 helpdesk - short description.', '24/7 helpdesk - detailed description.', NULL, '24/7 helpdesk', '24/7, helpdesk', '24/7 helpdesk meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(41, 3, 'Integrated management systems', 'integrated-management-systems', '41', 'publish', 'featured', 'fa-solid fa-broom', 'Integrated management systems', 'Integrated management systems services', 'Integrated management systems banner', 'Professional Integrated management systems', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Integrated management systems - short description.', 'Integrated management systems - detailed description.', NULL, 'Integrated management systems', 'Integrated, management, systems', 'Integrated management systems meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(42, 3, 'Swimming pool maintenance', 'swimming-pool-maintenance', '42', 'publish', 'featured', 'fa-solid fa-broom', 'Swimming pool maintenance', 'Swimming pool maintenance services', 'Swimming pool maintenance banner', 'Professional Swimming pool maintenance', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Swimming pool maintenance - short description.', 'Swimming pool maintenance - detailed description.', NULL, 'Swimming pool maintenance', 'Swimming, pool, maintenance', 'Swimming pool maintenance meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(43, 3, 'Gardening and landscaping', 'gardening-and-landscaping', '43', 'publish', 'featured', 'fa-solid fa-broom', 'Gardening and landscaping', 'Gardening and landscaping services', 'Gardening and landscaping banner', 'Professional Gardening and landscaping', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Gardening and landscaping - short description.', 'Gardening and landscaping - detailed description.', NULL, 'Gardening and landscaping', 'Gardening, and, landscaping', 'Gardening and landscaping meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(44, 3, 'Grease trap cleaning services', 'grease-trap-cleaning-services', '44', 'publish', 'featured', 'fa-solid fa-broom', 'Grease trap cleaning services', 'Grease trap cleaning services services', 'Grease trap cleaning services banner', 'Professional Grease trap cleaning services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Grease trap cleaning services - short description.', 'Grease trap cleaning services - detailed description.', NULL, 'Grease trap cleaning services', 'Grease, trap, cleaning, services', 'Grease trap cleaning services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(45, 3, 'Duct cleaning services', 'duct-cleaning-services', '45', 'publish', 'featured', 'fa-solid fa-broom', 'Duct cleaning services', 'Duct cleaning services services', 'Duct cleaning services banner', 'Professional Duct cleaning services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Duct cleaning services - short description.', 'Duct cleaning services - detailed description.', NULL, 'Duct cleaning services', 'Duct, cleaning, services', 'Duct cleaning services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(46, 3, 'Water tank cleaning services', 'water-tank-cleaning-services', '46', 'publish', 'featured', 'fa-solid fa-broom', 'Water tank cleaning services', 'Water tank cleaning services services', 'Water tank cleaning services banner', 'Professional Water tank cleaning services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Water tank cleaning services - short description.', 'Water tank cleaning services - detailed description.', NULL, 'Water tank cleaning services', 'Water, tank, cleaning, services', 'Water tank cleaning services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(47, 3, 'Hygiene services', 'hygiene-services', '47', 'publish', 'featured', 'fa-solid fa-broom', 'Hygiene services', 'Hygiene services services', 'Hygiene services banner', 'Professional Hygiene services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Hygiene services - short description.', 'Hygiene services - detailed description.', NULL, 'Hygiene services', 'Hygiene, services', 'Hygiene services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(48, 3, 'Cleaning services', 'cleaning-services', '48', 'publish', 'featured', 'fa-solid fa-broom', 'Cleaning services', 'Cleaning services services', 'Cleaning services banner', 'Professional Cleaning services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Cleaning services - short description.', 'Cleaning services - detailed description.', NULL, 'Cleaning services', 'Cleaning, services', 'Cleaning services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(49, 4, 'Total energy management and conservation', 'total-energy-management-and-conservation', '49', 'publish', 'featured', 'fa-solid fa-leaf', 'Total energy management and conservation', 'Total energy management and conservation services', 'Total energy management and conservation banner', 'Professional Total energy management and conservation', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Total energy management and conservation - short description.', 'Total energy management and conservation - detailed description.', NULL, 'Total energy management and conservation', 'Total, energy, management, and, conservation', 'Total energy management and conservation meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(50, 4, 'Full energy audits', 'full-energy-audits', '50', 'publish', 'featured', 'fa-solid fa-leaf', 'Full energy audits', 'Full energy audits services', 'Full energy audits banner', 'Professional Full energy audits', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Full energy audits - short description.', 'Full energy audits - detailed description.', NULL, 'Full energy audits', 'Full, energy, audits', 'Full energy audits meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(51, 4, 'Application of latest energy-saving techniques & technologies', 'application-of-latest-energy-saving-techniques-technologies', '51', 'publish', 'featured', 'fa-solid fa-leaf', 'Application of latest energy-saving techniques & technologies', 'Application of latest energy-saving techniques & technologies services', 'Application of latest energy-saving techniques & technologies banner', 'Professional Application of latest energy-saving techniques & technologies', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Application of latest energy-saving techniques & technologies - short description.', 'Application of latest energy-saving techniques & technologies - detailed description.', NULL, 'Application of latest energy-saving techniques & technologies', 'Application, of, latest, energy-saving, techniques, &, technologies', 'Application of latest energy-saving techniques & technologies meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(52, 4, 'Energy benchmarking with proprietary internet-based tools', 'energy-benchmarking-with-proprietary-internet-based-tools', '52', 'publish', 'featured', 'fa-solid fa-leaf', 'Energy benchmarking with proprietary internet-based tools', 'Energy benchmarking with proprietary internet-based tools services', 'Energy benchmarking with proprietary internet-based tools banner', 'Professional Energy benchmarking with proprietary internet-based tools', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Energy benchmarking with proprietary internet-based tools - short description.', 'Energy benchmarking with proprietary internet-based tools - detailed description.', NULL, 'Energy benchmarking with proprietary internet-based tools', 'Energy, benchmarking, with, proprietary, internet-based, tools', 'Energy benchmarking with proprietary internet-based tools meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(53, 4, 'Waste management', 'waste-management', '53', 'publish', 'featured', 'fa-solid fa-leaf', 'Waste management', 'Waste management services', 'Waste management banner', 'Professional Waste management', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Waste management - short description.', 'Waste management - detailed description.', NULL, 'Waste management', 'Waste, management', 'Waste management meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(54, 4, 'Hotel optimizer', 'hotel-optimizer', '54', 'publish', 'featured', 'fa-solid fa-leaf', 'Hotel optimizer', 'Hotel optimizer services', 'Hotel optimizer banner', 'Professional Hotel optimizer', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Hotel optimizer - short description.', 'Hotel optimizer - detailed description.', NULL, 'Hotel optimizer', 'Hotel, optimizer', 'Hotel optimizer meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(55, 4, 'FM consultancy', 'fm-consultancy', '55', 'publish', 'featured', 'fa-solid fa-leaf', 'FM consultancy', 'FM consultancy services', 'FM consultancy banner', 'Professional FM consultancy', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'FM consultancy - short description.', 'FM consultancy - detailed description.', NULL, 'FM consultancy', 'FM, consultancy', 'FM consultancy meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(56, 4, 'Lighting and water-saving solutions', 'lighting-and-water-saving-solutions', '56', 'publish', 'featured', 'fa-solid fa-leaf', 'Lighting and water-saving solutions', 'Lighting and water-saving solutions services', 'Lighting and water-saving solutions banner', 'Professional Lighting and water-saving solutions', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Lighting and water-saving solutions - short description.', 'Lighting and water-saving solutions - detailed description.', NULL, 'Lighting and water-saving solutions', 'Lighting, and, water-saving, solutions', 'Lighting and water-saving solutions meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(57, 4, 'Solar technology', 'solar-technology', '57', 'publish', 'featured', 'fa-solid fa-leaf', 'Solar technology', 'Solar technology services', 'Solar technology banner', 'Professional Solar technology', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Solar technology - short description.', 'Solar technology - detailed description.', NULL, 'Solar technology', 'Solar, technology', 'Solar technology meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(58, 4, 'Waste solutions', 'waste-solutions', '58', 'publish', 'featured', 'fa-solid fa-leaf', 'Waste solutions', 'Waste solutions services', 'Waste solutions banner', 'Professional Waste solutions', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Waste solutions - short description.', 'Waste solutions - detailed description.', NULL, 'Waste solutions', 'Waste, solutions', 'Waste solutions meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(59, 5, 'Villa and apartment annual maintenance contracts', 'villa-and-apartment-annual-maintenance-contracts', '59', 'publish', 'featured', 'fa-solid fa-house', 'Villa and apartment annual maintenance contracts', 'Villa and apartment annual maintenance contracts services', 'Villa and apartment annual maintenance contracts banner', 'Professional Villa and apartment annual maintenance contracts', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Villa and apartment annual maintenance contracts - short description.', 'Villa and apartment annual maintenance contracts - detailed description.', NULL, 'Villa and apartment annual maintenance contracts', 'Villa, and, apartment, annual, maintenance, contracts', 'Villa and apartment annual maintenance contracts meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(60, 5, 'Handyman services', 'handyman-services', '60', 'publish', 'featured', 'fa-solid fa-house', 'Handyman services', 'Handyman services services', 'Handyman services banner', 'Professional Handyman services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Handyman services - short description.', 'Handyman services - detailed description.', NULL, 'Handyman services', 'Handyman, services', 'Handyman services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(61, 5, 'Air conditioning services', 'air-conditioning-services', '61', 'publish', 'featured', 'fa-solid fa-house', 'Air conditioning services', 'Air conditioning services services', 'Air conditioning services banner', 'Professional Air conditioning services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Air conditioning services - short description.', 'Air conditioning services - detailed description.', NULL, 'Air conditioning services', 'Air, conditioning, services', 'Air conditioning services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(62, 5, 'Plumbing and electrical services', 'plumbing-and-electrical-services', '62', 'publish', 'featured', 'fa-solid fa-house', 'Plumbing and electrical services', 'Plumbing and electrical services services', 'Plumbing and electrical services banner', 'Professional Plumbing and electrical services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Plumbing and electrical services - short description.', 'Plumbing and electrical services - detailed description.', NULL, 'Plumbing and electrical services', 'Plumbing, and, electrical, services', 'Plumbing and electrical services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(63, 5, 'Villa & apartment cleaning', 'villa-apartment-cleaning', '63', 'publish', 'featured', 'fa-solid fa-house', 'Villa & apartment cleaning', 'Villa & apartment cleaning services', 'Villa & apartment cleaning banner', 'Professional Villa & apartment cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Villa & apartment cleaning - short description.', 'Villa & apartment cleaning - detailed description.', NULL, 'Villa & apartment cleaning', 'Villa, &, apartment, cleaning', 'Villa & apartment cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(64, 5, 'Gardening', 'gardening', '64', 'publish', 'featured', 'fa-solid fa-house', 'Gardening', 'Gardening services', 'Gardening banner', 'Professional Gardening', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Gardening - short description.', 'Gardening - detailed description.', NULL, 'Gardening', 'Gardening', 'Gardening meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(65, 5, 'Pest control', 'pest-control', '65', 'publish', 'featured', 'fa-solid fa-house', 'Pest control', 'Pest control services', 'Pest control banner', 'Professional Pest control', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Pest control - short description.', 'Pest control - detailed description.', NULL, 'Pest control', 'Pest, control', 'Pest control meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(66, 5, 'Swimming pool maintenance and cleaning', 'swimming-pool-maintenance-and-cleaning', '66', 'publish', 'featured', 'fa-solid fa-house', 'Swimming pool maintenance and cleaning', 'Swimming pool maintenance and cleaning services', 'Swimming pool maintenance and cleaning banner', 'Professional Swimming pool maintenance and cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Swimming pool maintenance and cleaning - short description.', 'Swimming pool maintenance and cleaning - detailed description.', NULL, 'Swimming pool maintenance and cleaning', 'Swimming, pool, maintenance, and, cleaning', 'Swimming pool maintenance and cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(67, 5, 'Smart home Wi-Fi and lifestyle products', 'smart-home-wi-fi-and-lifestyle-products', '67', 'publish', 'featured', 'fa-solid fa-house', 'Smart home Wi-Fi and lifestyle products', 'Smart home Wi-Fi and lifestyle products services', 'Smart home Wi-Fi and lifestyle products banner', 'Professional Smart home Wi-Fi and lifestyle products', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Smart home Wi-Fi and lifestyle products - short description.', 'Smart home Wi-Fi and lifestyle products - detailed description.', NULL, 'Smart home Wi-Fi and lifestyle products', 'Smart, home, Wi-Fi, and, lifestyle, products', 'Smart home Wi-Fi and lifestyle products meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(68, 5, 'Business and office services', 'business-and-office-services', '68', 'publish', 'featured', 'fa-solid fa-house', 'Business and office services', 'Business and office services services', 'Business and office services banner', 'Professional Business and office services', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Business and office services - short description.', 'Business and office services - detailed description.', NULL, 'Business and office services', 'Business, and, office, services', 'Business and office services meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(69, 5, 'Kitchen exhaust cleaning', 'kitchen-exhaust-cleaning', '69', 'publish', 'featured', 'fa-solid fa-house', 'Kitchen exhaust cleaning', 'Kitchen exhaust cleaning services', 'Kitchen exhaust cleaning banner', 'Professional Kitchen exhaust cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Kitchen exhaust cleaning - short description.', 'Kitchen exhaust cleaning - detailed description.', NULL, 'Kitchen exhaust cleaning', 'Kitchen, exhaust, cleaning', 'Kitchen exhaust cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(70, 5, 'Ecological unit cleaning', 'ecological-unit-cleaning', '70', 'publish', 'featured', 'fa-solid fa-house', 'Ecological unit cleaning', 'Ecological unit cleaning services', 'Ecological unit cleaning banner', 'Professional Ecological unit cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Ecological unit cleaning - short description.', 'Ecological unit cleaning - detailed description.', NULL, 'Ecological unit cleaning', 'Ecological, unit, cleaning', 'Ecological unit cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(71, 5, 'Mist/smoke filter cleaning', 'mistsmoke-filter-cleaning', '71', 'publish', 'featured', 'fa-solid fa-house', 'Mist/smoke filter cleaning', 'Mist/smoke filter cleaning services', 'Mist/smoke filter cleaning banner', 'Professional Mist/smoke filter cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Mist/smoke filter cleaning - short description.', 'Mist/smoke filter cleaning - detailed description.', NULL, 'Mist/smoke filter cleaning', 'Mist/smoke, filter, cleaning', 'Mist/smoke filter cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(72, 5, 'Laundry duct cleaning', 'laundry-duct-cleaning', '72', 'publish', 'featured', 'fa-solid fa-house', 'Laundry duct cleaning', 'Laundry duct cleaning services', 'Laundry duct cleaning banner', 'Professional Laundry duct cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Laundry duct cleaning - short description.', 'Laundry duct cleaning - detailed description.', NULL, 'Laundry duct cleaning', 'Laundry, duct, cleaning', 'Laundry duct cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(73, 5, 'Garbage chute cleaning', 'garbage-chute-cleaning', '73', 'publish', 'featured', 'fa-solid fa-house', 'Garbage chute cleaning', 'Garbage chute cleaning services', 'Garbage chute cleaning banner', 'Professional Garbage chute cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Garbage chute cleaning - short description.', 'Garbage chute cleaning - detailed description.', NULL, 'Garbage chute cleaning', 'Garbage, chute, cleaning', 'Garbage chute cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(74, 5, 'Drain-line jetting', 'drain-line-jetting', '74', 'publish', 'featured', 'fa-solid fa-house', 'Drain-line jetting', 'Drain-line jetting services', 'Drain-line jetting banner', 'Professional Drain-line jetting', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Drain-line jetting - short description.', 'Drain-line jetting - detailed description.', NULL, 'Drain-line jetting', 'Drain-line, jetting', 'Drain-line jetting meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(75, 5, 'Sewage tank cleaning', 'sewage-tank-cleaning', '75', 'publish', 'featured', 'fa-solid fa-house', 'Sewage tank cleaning', 'Sewage tank cleaning services', 'Sewage tank cleaning banner', 'Professional Sewage tank cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Sewage tank cleaning - short description.', 'Sewage tank cleaning - detailed description.', NULL, 'Sewage tank cleaning', 'Sewage, tank, cleaning', 'Sewage tank cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(76, 5, 'Grease trap cleaning', 'grease-trap-cleaning', '76', 'publish', 'featured', 'fa-solid fa-house', 'Grease trap cleaning', 'Grease trap cleaning services', 'Grease trap cleaning banner', 'Professional Grease trap cleaning', 'default-thumbnail.jpg', 'default-icon.png', 'default-banner.jpg', 'Grease trap cleaning - short description.', 'Grease trap cleaning - detailed description.', NULL, 'Grease trap cleaning', 'Grease, trap, cleaning', 'Grease trap cleaning meta description.', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `service_blocks`
--

CREATE TABLE `service_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `type` enum('R-2-L','L-2-R') NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_block_features`
--

CREATE TABLE `service_block_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_block_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `order_no` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `banner_image` varchar(255) DEFAULT NULL,
  `status` enum('publish','draft') NOT NULL DEFAULT 'draft',
  `isfeature` enum('featured','unfeatured') NOT NULL DEFAULT 'featured',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `font_awesome_icon` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `title`, `slug`, `thumbnail`, `description`, `icon`, `order_no`, `banner_image`, `status`, `isfeature`, `meta_title`, `meta_description`, `font_awesome_icon`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Hard Services', 'hard-services', 'default-thumbnail.jpg', 'Hard Services description here.', 'default-icon.png', 1, NULL, 'publish', 'featured', 'Hard Services', 'Hard Services meta description here.', 'fa-solid fa-cogs', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(2, 'Third Party Testing, Commissioning', 'third-party-testing-commissioning', 'default-thumbnail.jpg', 'Third Party Testing, Commissioning description here.', 'default-icon.png', 2, NULL, 'publish', 'featured', 'Third Party Testing, Commissioning', 'Third Party Testing, Commissioning meta description here.', 'fa-solid fa-cogs', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(3, 'Soft Services', 'soft-services', 'default-thumbnail.jpg', 'Soft Services description here.', 'default-icon.png', 3, NULL, 'publish', 'featured', 'Soft Services', 'Soft Services meta description here.', 'fa-solid fa-cogs', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(4, 'Sustainability Management', 'sustainability-management', 'default-thumbnail.jpg', 'Sustainability Management description here.', 'default-icon.png', 4, NULL, 'publish', 'featured', 'Sustainability Management', 'Sustainability Management meta description here.', 'fa-solid fa-cogs', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(5, 'Home & Property Maintenance', 'home-property-maintenance', 'default-thumbnail.jpg', 'Home & Property Maintenance description here.', 'default-icon.png', 5, NULL, 'publish', 'featured', 'Home & Property Maintenance', 'Home & Property Maintenance meta description here.', 'fa-solid fa-cogs', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `service_elements`
--

CREATE TABLE `service_elements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `type` enum('style1','style2','style3') NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_element_features`
--

CREATE TABLE `service_element_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_element_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_features`
--

CREATE TABLE `service_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_feature_details`
--

CREATE TABLE `service_feature_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_feature_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_projects`
--

CREATE TABLE `service_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `image_gallery` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `isfeature` enum('featured','unfeatured') NOT NULL DEFAULT 'featured',
  `show_on_home` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_sections`
--

CREATE TABLE `service_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` enum('R-2-L','L-2-R') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_settings`
--

CREATE TABLE `service_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `order_no` int(11) NOT NULL,
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
('wk1AVZ3kFnoWErxjEMUiO3wFSAignVaWvW0UJdbh', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ2RJMTRuTldoWmxpcDBXZUhrbUpZZnY0Vzl0bnMwY0drNmZPSEo4aiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb3Vyc2Uvd2Vic2l0ZS1kZXZlbG9wbWVudCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1763730866);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `home_beadcrum_img` varchar(255) DEFAULT NULL,
  `footer_logo` varchar(255) DEFAULT NULL,
  `fav_icon` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `phone_no_2` varchar(255) DEFAULT NULL,
  `whatsapp_no` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `setting_profile` varchar(255) DEFAULT NULL,
  `fb_link` varchar(255) DEFAULT NULL,
  `insta_link` varchar(255) DEFAULT NULL,
  `yt_link` varchar(255) DEFAULT NULL,
  `tiktok_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `telegram_link` varchar(255) DEFAULT NULL,
  `whatsapp_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `home_beadcrum_img`, `footer_logo`, `fav_icon`, `phone_no`, `phone_no_2`, `whatsapp_no`, `email`, `address`, `setting_profile`, `fb_link`, `insta_link`, `yt_link`, `tiktok_link`, `linkedin_link`, `telegram_link`, `whatsapp_link`, `created_at`, `updated_at`) VALUES
(1, 'assets/admin/uploads/setting/logo/1763121534158591860.png', 'uploads/home_breadcrumb.jpg', 'assets/admin/uploads/setting/footer_logo/17631215341329982705.png', 'assets/admin/uploads/setting/fav_icon/17629650541207918164.png', '+971 50 40 6786', '+971 50 40 6786', '+971 50 40 6786', 'info@bestqualityedu.com', 'Abu Dhabi , United Arab Emirates', NULL, 'https://facebook.com/example', 'https://instagram.com/example', 'https://youtube.com/example', 'https://tiktok.com/@example', NULL, NULL, 'https://wa.me/+97150406786', '2025-11-12 06:24:52', '2025-11-14 11:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `image` text NOT NULL,
  `button_title` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `serial_no` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `sub_title`, `image`, `button_title`, `button_url`, `serial_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Accelerate your <span class=\"in\">Career</span>', 'earn your degree online without leaving your job <br>Flexible • Recognised • Designed for working professionals', 'assets/admin/img/slider/17629577695617615.webp', 'Get Enrolled', 'https://bestqualityeducation/contact-us', 2, 1, '2025-11-12 14:29:29', '2025-11-16 08:08:40'),
(2, 'Complete Your <span class=\"in\">Degree </span>Faster', 'Choose our Fast-Track programs to earn your degree in less time — without compromising your work.', 'assets/admin/img/slider/17629582761673752324.webp', 'View Fast-Track Courses', 'https://bestqualityeducation.com/courses', 1, 1, '2025-11-12 14:37:56', '2025-11-14 07:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `study_programs`
--

CREATE TABLE `study_programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `order_no` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(255) DEFAULT NULL,
  `font_icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `study_programs`
--

INSERT INTO `study_programs` (`id`, `name`, `slug`, `status`, `order_no`, `icon`, `font_icon`, `created_at`, `updated_at`) VALUES
(1, 'Bachelor of Commerce (B.Com)', 'bachelor-of-commerce-bcom', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(2, 'Bachelor of Business Administration (BBA)', 'bachelor-of-business-administration-bba', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(3, 'Bachelor of Computer Applications (BCA)', 'bachelor-of-computer-applications-bca', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(4, 'Master of Commerce (M.Com)', 'master-of-commerce-mcom', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(5, 'Master of Business Administration (MBA)', 'master-of-business-administration-mba', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(6, 'Master of Computer Applications (MCA)', 'master-of-computer-applications-mca', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(7, 'Master of Arts (M.A)', 'master-of-arts-ma', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(8, 'Short Term IT Courses', 'short-term-it-courses', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(9, 'Digital Marketing Courses', 'digital-marketing-courses', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53'),
(10, 'Artificial Intelligence Courses', 'artificial-intelligence-courses', 'active', 0, NULL, NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tempelate_files`
--

CREATE TABLE `tempelate_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `long_description` text DEFAULT NULL,
  `icon` varchar(255) NOT NULL,
  `tempelate_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms_and_conditions`
--

CREATE TABLE `terms_and_conditions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_and_conditions`
--

INSERT INTO `terms_and_conditions` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', 'Terms and  Condition  ', '2025-11-12 06:24:53', '2025-11-12 06:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `page_id`, `name`, `feedback`, `designation`, `order_no`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ayesha Khan,', 'As a full-time employee, I always thought earning a degree would be impossible. Thanks to their online classes and flexible schedule, I completed my MBA in just one year. The support team was always available whenever I needed help.', 'MBA Graduate', 1, 'active', 'assets/admin/uploads/testimonial/1762969783376865060.webp', '2025-11-12 17:47:32', '2025-11-12 17:49:43'),
(2, 1, 'Imran Sheikh', 'The study materials were simple, clear, and easy to follow. I could study after work at my own pace. The degree I received is recognized and helped me get a promotion in my company.', 'BBA (Regular Program)', 1, 'active', 'assets/admin/uploads/testimonial/1763123449481529330.jpg', '2025-11-12 17:50:45', '2025-11-14 12:30:49'),
(3, 1, 'Ramesh Patel', 'Completing my graduation online through this platform was one of the best decisions I made. The classes were flexible, the mentors were experienced, and I saved a lot of time.', 'BA Graduate (Online Learning Program)', 3, 'active', 'assets/admin/uploads/testimonial/17631236041224442529.png', '2025-11-12 17:51:44', '2025-11-14 12:33:24'),
(4, 1, 'Sana Rahman', 'Being in a full-time job, I needed a fast-track option to complete my degree. This platform made it possible with complete guidance and official university certification.', 'B.Sc (Fast Track Degree Program)', 4, 'active', 'assets/admin/uploads/testimonial/1762969978.webp', '2025-11-12 17:52:58', '2025-11-12 17:52:58'),
(5, 1, 'Adnan Hussain', 'I highly recommend their programs to anyone who couldn’t complete their studies earlier. The process was smooth, professional, and completely online.', 'Diploma in Business Management', 5, 'active', 'assets/admin/uploads/testimonial/1763123666977559802.jpg', '2025-11-12 17:53:42', '2025-11-14 12:34:26');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_details`
--

CREATE TABLE `testimonial_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testimonial_section_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `feedback` text NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonial_sections`
--

CREATE TABLE `testimonial_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `icon` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `whatsapp_no` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('approved','pending','blocked') NOT NULL DEFAULT 'pending',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `icon`, `phone_no`, `whatsapp_no`, `address`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$12$fosekpXOE71gsQdYOKvC2u/sZn/blep1djD9RsiYycuIyAvV3wea.', 'admin', '1763130071950872083.png', '+923758365729', '+923758365729', 'Gujranwala', 'approved', 'nPgP7waeBpKkPT1nBJyPQH0tUtBgfH7JU7fD2Y56WZsre1Tw1u3PmBWyZhZG', '2025-11-12 06:24:53', '2025-11-14 14:21:12'),
(2, 'User', 'user@user.com', NULL, '$2y$12$IytUCtQticZ7M9J/0nWQ0ObBW8qhNWkWKPU1PRk9cB4lVWrFgqphW', 'user', 'icon', '+923758365729', '+923758365729', 'Gujranwala', 'approved', NULL, '2025-11-12 06:24:53', '2025-11-12 06:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `webinars`
--

CREATE TABLE `webinars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hostName` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `meeting_date` date NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `meetingLink` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `detail` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `webinars`
--

INSERT INTO `webinars` (`id`, `hostName`, `topic`, `meeting_date`, `start_time`, `end_time`, `meetingLink`, `banner`, `detail`, `status`, `order_no`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Sudhakar', 'Entrepreneurship Devlopment', '2025-11-14', '21:00', '23:00', 'https://best.mhow.org', '1762968878_t6_08bc546fed.jpg', 'Entrepreneurship Devlopment', 1, 1, '2025-11-12 17:34:38', '2025-11-12 17:34:38'),
(2, 'Prof. Sudhakar', 'Entrepreneurship Devlopment', '2025-11-14', '21:00', '23:00', 'https://best.mhow.org', '1762968878_t6_08bc546fed.jpg', 'Entrepreneurship Devlopment', 1, 1, '2025-11-12 17:34:38', '2025-11-12 17:34:38'),
(3, 'Prof. Sudhakar', 'Entrepreneurship Devlopment', '2025-11-14', '21:00', '23:00', 'https://best.mhow.org', '1762968878_t6_08bc546fed.jpg', 'Entrepreneurship Devlopment', 1, 1, '2025-11-12 17:34:38', '2025-11-12 17:34:38'),
(4, 'Prof. Sudhakar', 'Entrepreneurship Devlopment', '2025-11-14', '21:00', '23:00', 'https://best.mhow.org', '1762968878_t6_08bc546fed.jpg', 'Entrepreneurship Devlopment', 1, 1, '2025-11-12 17:34:38', '2025-11-12 17:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `we_serves`
--

CREATE TABLE `we_serves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `we_serve_details`
--

CREATE TABLE `we_serve_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `we_serve_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us`
--

CREATE TABLE `why_choose_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us_sections`
--

CREATE TABLE `why_choose_us_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `show_on` enum('home','about_us') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_choose_us_sections`
--

INSERT INTO `why_choose_us_sections` (`id`, `title`, `subtitle`, `description`, `image`, `show_on`, `created_at`, `updated_at`) VALUES
(2, 'Why Choose Us', 'flexible, recognized, and supportive.', NULL, NULL, 'home', '2025-11-12 17:16:28', '2025-11-12 17:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `why_choose_us_section_details`
--

CREATE TABLE `why_choose_us_section_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `why_choose_us_section_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `why_choose_us_section_details`
--

INSERT INTO `why_choose_us_section_details` (`id`, `why_choose_us_section_id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(4, 2, 'assets/admin/uploads/why_choose_us_details/17629680762042777113.png', 'Flexible Learning', 'Study anytime, anywhere — perfectly suited for working professionals balancing work and study.', '2025-11-12 17:16:28', '2025-11-12 17:21:16'),
(5, 2, 'assets/admin/uploads/why_choose_us_details/1762968076936394970.png', 'Recognized Degrees', 'All programs are offered through Indian government-approved and recognized universities for credibility.', '2025-11-12 17:16:28', '2025-11-12 17:21:16'),
(6, 2, 'assets/admin/uploads/why_choose_us_details/1762968076798412466.png', 'Dedicated Support', 'From enrollment to graduation, our team provides guidance and academic support every step of the way.', '2025-11-12 17:16:28', '2025-11-12 17:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `why_us_images`
--

CREATE TABLE `why_us_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bcategories`
--
ALTER TABLE `bcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blocks_page_id_foreign` (`page_id`);

--
-- Indexes for table `block_features`
--
ALTER TABLE `block_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `block_features_block_id_foreign` (`block_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_blocks`
--
ALTER TABLE `blog_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_blocks_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `blog_block_features`
--
ALTER TABLE `blog_block_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_block_features_blog_block_id_foreign` (`blog_block_id`);

--
-- Indexes for table `blog_c_t_a_s`
--
ALTER TABLE `blog_c_t_a_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_c_t_a_s_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `blog_sections`
--
ALTER TABLE `blog_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_sections_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `blog_settings`
--
ALTER TABLE `blog_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_settings_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_settings_reference_type_reference_id_index` (`reference_type`,`reference_id`);

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
-- Indexes for table `call_to_actions`
--
ALTER TABLE `call_to_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_jobs`
--
ALTER TABLE `company_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_jobs_email_unique` (`email`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_course_category_id_foreign` (`course_category_id`),
  ADD KEY `courses_study_program_id_foreign` (`study_program_id`);

--
-- Indexes for table `course_blocks`
--
ALTER TABLE `course_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_blocks_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_block_features`
--
ALTER TABLE `course_block_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_block_features_course_block_id_foreign` (`course_block_id`);

--
-- Indexes for table `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_categories_slug_unique` (`slug`);

--
-- Indexes for table `course_c_t_a_s`
--
ALTER TABLE `course_c_t_a_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_c_t_a_s_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_elements`
--
ALTER TABLE `course_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_elements_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_element_features`
--
ALTER TABLE `course_element_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_element_features_course_element_id_foreign` (`course_element_id`);

--
-- Indexes for table `course_faqs`
--
ALTER TABLE `course_faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_faqs_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_faq_details`
--
ALTER TABLE `course_faq_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_faq_details_course_faq_id_foreign` (`course_faq_id`);

--
-- Indexes for table `course_features`
--
ALTER TABLE `course_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_features_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_feature_details`
--
ALTER TABLE `course_feature_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_feature_details_course_feature_id_foreign` (`course_feature_id`);

--
-- Indexes for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_materials_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_outlines`
--
ALTER TABLE `course_outlines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_outlines_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_outline_units`
--
ALTER TABLE `course_outline_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_outline_units_course_outline_id_foreign` (`course_outline_id`);

--
-- Indexes for table `course_outline_unit_topics`
--
ALTER TABLE `course_outline_unit_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_outline_unit_topics_course_outline_unit_id_foreign` (`course_outline_unit_id`);

--
-- Indexes for table `course_requirements`
--
ALTER TABLE `course_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_requirements_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_sections`
--
ALTER TABLE `course_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_sections_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_settings`
--
ALTER TABLE `course_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_settings_course_id_foreign` (`course_id`),
  ADD KEY `course_settings_reference_type_reference_id_index` (`reference_type`,`reference_id`);

--
-- Indexes for table `course_why_choose_us`
--
ALTER TABLE `course_why_choose_us`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_why_choose_us_course_id_foreign` (`course_id`);

--
-- Indexes for table `course_why_choose_us_details`
--
ALTER TABLE `course_why_choose_us_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_why_choose_us_details_course_why_choose_us_id_foreign` (`course_why_choose_us_id`);

--
-- Indexes for table `document_requireds`
--
ALTER TABLE `document_requireds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `elements_page_id_foreign` (`page_id`);

--
-- Indexes for table `element_features`
--
ALTER TABLE `element_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `element_features_element_id_foreign` (`element_id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry_comments`
--
ALTER TABLE `enquiry_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enquiry_comments_enquiry_id_foreign` (`enquiry_id`),
  ADD KEY `enquiry_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_details`
--
ALTER TABLE `faq_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faq_details_faq_section_id_foreign` (`faq_section_id`);

--
-- Indexes for table `faq_sections`
--
ALTER TABLE `faq_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_images`
--
ALTER TABLE `feature_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_sections`
--
ALTER TABLE `feature_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_section_details`
--
ALTER TABLE `feature_section_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_section_details_feature_section_id_foreign` (`feature_section_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gcategories`
--
ALTER TABLE `gcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `hero_sections`
--
ALTER TABLE `hero_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industry_jobs`
--
ALTER TABLE `industry_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_blocks`
--
ALTER TABLE `info_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_block_features`
--
ALTER TABLE `info_block_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_block_features_info_block_id_foreign` (`info_block_id`);

--
-- Indexes for table `info_sections`
--
ALTER TABLE `info_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_sections_page_id_foreign` (`page_id`);

--
-- Indexes for table `info_section_features`
--
ALTER TABLE `info_section_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `info_section_features_info_section_id_foreign` (`info_section_id`);

--
-- Indexes for table `introduction_sections`
--
ALTER TABLE `introduction_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jcategories`
--
ALTER TABLE `jcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_applicants`
--
ALTER TABLE `job_applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applicants_job_id_foreign` (`job_id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_candidates`
--
ALTER TABLE `job_candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_cities`
--
ALTER TABLE `job_cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `job_countries`
--
ALTER TABLE `job_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_experiences`
--
ALTER TABLE `job_experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_vacancies`
--
ALTER TABLE `job_vacancies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_vacancies_company_jobs_id_foreign` (`company_jobs_id`),
  ADD KEY `job_vacancies_industry_jobs_id_foreign` (`industry_jobs_id`),
  ADD KEY `job_vacancies_job_types_id_foreign` (`job_types_id`),
  ADD KEY `job_vacancies_job_cities_id_foreign` (`job_cities_id`),
  ADD KEY `job_vacancies_job_countries_id_foreign` (`job_countries_id`),
  ADD KEY `job_vacancies_job_experiences_id_foreign` (`job_experiences_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_email_unique` (`email`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_package_category_id_foreign` (`package_category_id`);

--
-- Indexes for table `package_categories`
--
ALTER TABLE `package_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_categories_slug_unique` (`slug`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_details_package_id_foreign` (`package_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_page_category_id_foreign` (`page_category_id`),
  ADD KEY `pages_type_index` (`type`),
  ADD KEY `pages_status_index` (`status`),
  ADD KEY `pages_route_name_index` (`route_name`);

--
-- Indexes for table `page_categories`
--
ALTER TABLE `page_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_categories_slug_unique` (`slug`),
  ADD KEY `page_categories_status_index` (`status`);

--
-- Indexes for table `page_sections`
--
ALTER TABLE `page_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_sections_page_id_foreign` (`page_id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procedures`
--
ALTER TABLE `procedures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_headers`
--
ALTER TABLE `section_headers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_headers_use_for_unique` (`use_for`);

--
-- Indexes for table `section_titles`
--
ALTER TABLE `section_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_globals`
--
ALTER TABLE `seo_globals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_metas`
--
ALTER TABLE `seo_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seo_metas_page_slug_unique` (`page_slug`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_service_category_id_foreign` (`service_category_id`);

--
-- Indexes for table `service_blocks`
--
ALTER TABLE `service_blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_blocks_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_block_features`
--
ALTER TABLE `service_block_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_block_features_service_block_id_foreign` (`service_block_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_categories_slug_unique` (`slug`);

--
-- Indexes for table `service_elements`
--
ALTER TABLE `service_elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_elements_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_element_features`
--
ALTER TABLE `service_element_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_element_features_service_element_id_foreign` (`service_element_id`);

--
-- Indexes for table `service_features`
--
ALTER TABLE `service_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_features_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_feature_details`
--
ALTER TABLE `service_feature_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_feature_details_service_feature_id_foreign` (`service_feature_id`);

--
-- Indexes for table `service_projects`
--
ALTER TABLE `service_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_projects_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_sections`
--
ALTER TABLE `service_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_sections_service_id_foreign` (`service_id`);

--
-- Indexes for table `service_settings`
--
ALTER TABLE `service_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_settings_service_id_foreign` (`service_id`),
  ADD KEY `service_settings_reference_type_reference_id_index` (`reference_type`,`reference_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_programs`
--
ALTER TABLE `study_programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `study_programs_slug_unique` (`slug`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tempelate_files`
--
ALTER TABLE `tempelate_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial_details`
--
ALTER TABLE `testimonial_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonial_details_testimonial_section_id_foreign` (`testimonial_section_id`);

--
-- Indexes for table `testimonial_sections`
--
ALTER TABLE `testimonial_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `webinars`
--
ALTER TABLE `webinars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `we_serves`
--
ALTER TABLE `we_serves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `we_serve_details`
--
ALTER TABLE `we_serve_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `we_serve_details_we_serve_id_foreign` (`we_serve_id`);

--
-- Indexes for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_choose_us_sections`
--
ALTER TABLE `why_choose_us_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `why_choose_us_section_details`
--
ALTER TABLE `why_choose_us_section_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `why_choose_us_section_details_why_choose_us_section_id_foreign` (`why_choose_us_section_id`);

--
-- Indexes for table `why_us_images`
--
ALTER TABLE `why_us_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bcategories`
--
ALTER TABLE `bcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `block_features`
--
ALTER TABLE `block_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_blocks`
--
ALTER TABLE `blog_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_block_features`
--
ALTER TABLE `blog_block_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_c_t_a_s`
--
ALTER TABLE `blog_c_t_a_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_sections`
--
ALTER TABLE `blog_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_settings`
--
ALTER TABLE `blog_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `call_to_actions`
--
ALTER TABLE `call_to_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_jobs`
--
ALTER TABLE `company_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `course_blocks`
--
ALTER TABLE `course_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_block_features`
--
ALTER TABLE `course_block_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_c_t_a_s`
--
ALTER TABLE `course_c_t_a_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_elements`
--
ALTER TABLE `course_elements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_element_features`
--
ALTER TABLE `course_element_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_faqs`
--
ALTER TABLE `course_faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_faq_details`
--
ALTER TABLE `course_faq_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_features`
--
ALTER TABLE `course_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_feature_details`
--
ALTER TABLE `course_feature_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_materials`
--
ALTER TABLE `course_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_outlines`
--
ALTER TABLE `course_outlines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_outline_units`
--
ALTER TABLE `course_outline_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_outline_unit_topics`
--
ALTER TABLE `course_outline_unit_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_requirements`
--
ALTER TABLE `course_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_sections`
--
ALTER TABLE `course_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_settings`
--
ALTER TABLE `course_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `course_why_choose_us`
--
ALTER TABLE `course_why_choose_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_why_choose_us_details`
--
ALTER TABLE `course_why_choose_us_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `document_requireds`
--
ALTER TABLE `document_requireds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `element_features`
--
ALTER TABLE `element_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enquiry_comments`
--
ALTER TABLE `enquiry_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_details`
--
ALTER TABLE `faq_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_sections`
--
ALTER TABLE `faq_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_images`
--
ALTER TABLE `feature_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_sections`
--
ALTER TABLE `feature_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_section_details`
--
ALTER TABLE `feature_section_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gcategories`
--
ALTER TABLE `gcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero_sections`
--
ALTER TABLE `hero_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industry_jobs`
--
ALTER TABLE `industry_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_blocks`
--
ALTER TABLE `info_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `info_block_features`
--
ALTER TABLE `info_block_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `info_sections`
--
ALTER TABLE `info_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_section_features`
--
ALTER TABLE `info_section_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `introduction_sections`
--
ALTER TABLE `introduction_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jcategories`
--
ALTER TABLE `jcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_applicants`
--
ALTER TABLE `job_applicants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_candidates`
--
ALTER TABLE `job_candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_cities`
--
ALTER TABLE `job_cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_countries`
--
ALTER TABLE `job_countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_experiences`
--
ALTER TABLE `job_experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_vacancies`
--
ALTER TABLE `job_vacancies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_categories`
--
ALTER TABLE `package_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_categories`
--
ALTER TABLE `page_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page_sections`
--
ALTER TABLE `page_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `procedures`
--
ALTER TABLE `procedures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section_headers`
--
ALTER TABLE `section_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section_titles`
--
ALTER TABLE `section_titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_globals`
--
ALTER TABLE `seo_globals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seo_metas`
--
ALTER TABLE `seo_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `service_blocks`
--
ALTER TABLE `service_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_block_features`
--
ALTER TABLE `service_block_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_elements`
--
ALTER TABLE `service_elements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_element_features`
--
ALTER TABLE `service_element_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_features`
--
ALTER TABLE `service_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_feature_details`
--
ALTER TABLE `service_feature_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_projects`
--
ALTER TABLE `service_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_sections`
--
ALTER TABLE `service_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_settings`
--
ALTER TABLE `service_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `study_programs`
--
ALTER TABLE `study_programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tempelate_files`
--
ALTER TABLE `tempelate_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms_and_conditions`
--
ALTER TABLE `terms_and_conditions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonial_details`
--
ALTER TABLE `testimonial_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonial_sections`
--
ALTER TABLE `testimonial_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `webinars`
--
ALTER TABLE `webinars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `we_serves`
--
ALTER TABLE `we_serves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `we_serve_details`
--
ALTER TABLE `we_serve_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `why_choose_us`
--
ALTER TABLE `why_choose_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `why_choose_us_sections`
--
ALTER TABLE `why_choose_us_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `why_choose_us_section_details`
--
ALTER TABLE `why_choose_us_section_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `why_us_images`
--
ALTER TABLE `why_us_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `blocks_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `block_features`
--
ALTER TABLE `block_features`
  ADD CONSTRAINT `block_features_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_blocks`
--
ALTER TABLE `blog_blocks`
  ADD CONSTRAINT `blog_blocks_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_block_features`
--
ALTER TABLE `blog_block_features`
  ADD CONSTRAINT `blog_block_features_blog_block_id_foreign` FOREIGN KEY (`blog_block_id`) REFERENCES `blog_blocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_c_t_a_s`
--
ALTER TABLE `blog_c_t_a_s`
  ADD CONSTRAINT `blog_c_t_a_s_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_sections`
--
ALTER TABLE `blog_sections`
  ADD CONSTRAINT `blog_sections_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_settings`
--
ALTER TABLE `blog_settings`
  ADD CONSTRAINT `blog_settings_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_categories` (`id`),
  ADD CONSTRAINT `courses_study_program_id_foreign` FOREIGN KEY (`study_program_id`) REFERENCES `study_programs` (`id`);

--
-- Constraints for table `course_blocks`
--
ALTER TABLE `course_blocks`
  ADD CONSTRAINT `course_blocks_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_block_features`
--
ALTER TABLE `course_block_features`
  ADD CONSTRAINT `course_block_features_course_block_id_foreign` FOREIGN KEY (`course_block_id`) REFERENCES `course_blocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_c_t_a_s`
--
ALTER TABLE `course_c_t_a_s`
  ADD CONSTRAINT `course_c_t_a_s_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_elements`
--
ALTER TABLE `course_elements`
  ADD CONSTRAINT `course_elements_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_element_features`
--
ALTER TABLE `course_element_features`
  ADD CONSTRAINT `course_element_features_course_element_id_foreign` FOREIGN KEY (`course_element_id`) REFERENCES `course_elements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_faqs`
--
ALTER TABLE `course_faqs`
  ADD CONSTRAINT `course_faqs_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_faq_details`
--
ALTER TABLE `course_faq_details`
  ADD CONSTRAINT `course_faq_details_course_faq_id_foreign` FOREIGN KEY (`course_faq_id`) REFERENCES `course_faqs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_features`
--
ALTER TABLE `course_features`
  ADD CONSTRAINT `course_features_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_feature_details`
--
ALTER TABLE `course_feature_details`
  ADD CONSTRAINT `course_feature_details_course_feature_id_foreign` FOREIGN KEY (`course_feature_id`) REFERENCES `course_features` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_materials`
--
ALTER TABLE `course_materials`
  ADD CONSTRAINT `course_materials_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_outlines`
--
ALTER TABLE `course_outlines`
  ADD CONSTRAINT `course_outlines_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_outline_units`
--
ALTER TABLE `course_outline_units`
  ADD CONSTRAINT `course_outline_units_course_outline_id_foreign` FOREIGN KEY (`course_outline_id`) REFERENCES `course_outlines` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_outline_unit_topics`
--
ALTER TABLE `course_outline_unit_topics`
  ADD CONSTRAINT `course_outline_unit_topics_course_outline_unit_id_foreign` FOREIGN KEY (`course_outline_unit_id`) REFERENCES `course_outline_units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_requirements`
--
ALTER TABLE `course_requirements`
  ADD CONSTRAINT `course_requirements_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_sections`
--
ALTER TABLE `course_sections`
  ADD CONSTRAINT `course_sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_settings`
--
ALTER TABLE `course_settings`
  ADD CONSTRAINT `course_settings_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `course_why_choose_us`
--
ALTER TABLE `course_why_choose_us`
  ADD CONSTRAINT `course_why_choose_us_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_why_choose_us_details`
--
ALTER TABLE `course_why_choose_us_details`
  ADD CONSTRAINT `course_why_choose_us_details_course_why_choose_us_id_foreign` FOREIGN KEY (`course_why_choose_us_id`) REFERENCES `course_why_choose_us` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `elements`
--
ALTER TABLE `elements`
  ADD CONSTRAINT `elements_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `element_features`
--
ALTER TABLE `element_features`
  ADD CONSTRAINT `element_features_element_id_foreign` FOREIGN KEY (`element_id`) REFERENCES `elements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enquiry_comments`
--
ALTER TABLE `enquiry_comments`
  ADD CONSTRAINT `enquiry_comments_enquiry_id_foreign` FOREIGN KEY (`enquiry_id`) REFERENCES `enquiries` (`id`),
  ADD CONSTRAINT `enquiry_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `faq_details`
--
ALTER TABLE `faq_details`
  ADD CONSTRAINT `faq_details_faq_section_id_foreign` FOREIGN KEY (`faq_section_id`) REFERENCES `faq_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_section_details`
--
ALTER TABLE `feature_section_details`
  ADD CONSTRAINT `feature_section_details_feature_section_id_foreign` FOREIGN KEY (`feature_section_id`) REFERENCES `feature_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_block_features`
--
ALTER TABLE `info_block_features`
  ADD CONSTRAINT `info_block_features_info_block_id_foreign` FOREIGN KEY (`info_block_id`) REFERENCES `info_blocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `info_sections`
--
ALTER TABLE `info_sections`
  ADD CONSTRAINT `info_sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`);

--
-- Constraints for table `info_section_features`
--
ALTER TABLE `info_section_features`
  ADD CONSTRAINT `info_section_features_info_section_id_foreign` FOREIGN KEY (`info_section_id`) REFERENCES `info_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_applicants`
--
ALTER TABLE `job_applicants`
  ADD CONSTRAINT `job_applicants_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `job_vacancies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_cities`
--
ALTER TABLE `job_cities`
  ADD CONSTRAINT `job_cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `job_countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_vacancies`
--
ALTER TABLE `job_vacancies`
  ADD CONSTRAINT `job_vacancies_company_jobs_id_foreign` FOREIGN KEY (`company_jobs_id`) REFERENCES `company_jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_vacancies_industry_jobs_id_foreign` FOREIGN KEY (`industry_jobs_id`) REFERENCES `industry_jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_vacancies_job_cities_id_foreign` FOREIGN KEY (`job_cities_id`) REFERENCES `job_cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_vacancies_job_countries_id_foreign` FOREIGN KEY (`job_countries_id`) REFERENCES `job_countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_vacancies_job_experiences_id_foreign` FOREIGN KEY (`job_experiences_id`) REFERENCES `job_experiences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_vacancies_job_types_id_foreign` FOREIGN KEY (`job_types_id`) REFERENCES `job_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_package_category_id_foreign` FOREIGN KEY (`package_category_id`) REFERENCES `package_categories` (`id`);

--
-- Constraints for table `package_details`
--
ALTER TABLE `package_details`
  ADD CONSTRAINT `package_details_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_page_category_id_foreign` FOREIGN KEY (`page_category_id`) REFERENCES `page_categories` (`id`);

--
-- Constraints for table `page_sections`
--
ALTER TABLE `page_sections`
  ADD CONSTRAINT `page_sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_service_category_id_foreign` FOREIGN KEY (`service_category_id`) REFERENCES `service_categories` (`id`);

--
-- Constraints for table `service_blocks`
--
ALTER TABLE `service_blocks`
  ADD CONSTRAINT `service_blocks_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_block_features`
--
ALTER TABLE `service_block_features`
  ADD CONSTRAINT `service_block_features_service_block_id_foreign` FOREIGN KEY (`service_block_id`) REFERENCES `service_blocks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_elements`
--
ALTER TABLE `service_elements`
  ADD CONSTRAINT `service_elements_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_element_features`
--
ALTER TABLE `service_element_features`
  ADD CONSTRAINT `service_element_features_service_element_id_foreign` FOREIGN KEY (`service_element_id`) REFERENCES `service_elements` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_features`
--
ALTER TABLE `service_features`
  ADD CONSTRAINT `service_features_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_feature_details`
--
ALTER TABLE `service_feature_details`
  ADD CONSTRAINT `service_feature_details_service_feature_id_foreign` FOREIGN KEY (`service_feature_id`) REFERENCES `service_features` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_projects`
--
ALTER TABLE `service_projects`
  ADD CONSTRAINT `service_projects_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_sections`
--
ALTER TABLE `service_sections`
  ADD CONSTRAINT `service_sections_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `service_settings`
--
ALTER TABLE `service_settings`
  ADD CONSTRAINT `service_settings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `testimonial_details`
--
ALTER TABLE `testimonial_details`
  ADD CONSTRAINT `testimonial_details_testimonial_section_id_foreign` FOREIGN KEY (`testimonial_section_id`) REFERENCES `testimonial_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `we_serve_details`
--
ALTER TABLE `we_serve_details`
  ADD CONSTRAINT `we_serve_details_we_serve_id_foreign` FOREIGN KEY (`we_serve_id`) REFERENCES `we_serves` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `why_choose_us_section_details`
--
ALTER TABLE `why_choose_us_section_details`
  ADD CONSTRAINT `why_choose_us_section_details_why_choose_us_section_id_foreign` FOREIGN KEY (`why_choose_us_section_id`) REFERENCES `why_choose_us_sections` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
