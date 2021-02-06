-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2021 at 07:20 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `softtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serialnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brandname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `serialnumber`, `brandname`, `created_at`, `updated_at`) VALUES
(2, '2', 'Asus', '2021-01-05 12:00:58', '2021-01-05 12:00:58'),
(3, '3', 'HP', '2021-01-05 12:01:13', '2021-01-05 12:01:13'),
(4, '1', 'Gigabyte', '2021-01-08 02:21:23', '2021-01-08 02:21:23'),
(5, '4', 'Intel', '2021-01-12 08:39:55', '2021-01-12 08:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serialnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `serialnumber`, `categoryname`, `categoryimage`, `created_at`, `updated_at`) VALUES
(1, '1', 'Motherboard', 'public/images/categories/images/1688214398729446.png', '2021-01-07 02:05:12', '2021-01-07 02:05:12'),
(2, '2', 'Ram', 'public/images/categories/images/1688214500175868.png', '2021-01-07 02:06:49', '2021-01-07 02:06:49'),
(3, '3', 'Processor', 'public/images/categories/images/1688214585614694.png', '2021-01-07 02:08:10', '2021-01-07 02:08:10'),
(4, '4', 'Monitor', 'public/images/categories/images/1688214813918324.png', '2021-01-07 02:11:48', '2021-01-07 02:11:48'),
(5, '5', 'Casing', 'public/images/categories/images/1688215576085730.png', '2021-01-07 02:15:04', '2021-01-07 02:23:55'),
(6, '6', 'Laptop', 'public/images/categories/images/1688223507181028.png', '2021-01-07 04:29:59', '2021-01-07 04:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_09_055719_create_sellerdetails_table', 1),
(5, '2020_12_10_054628_create_brands_table', 1),
(6, '2020_12_10_102256_create_categories_table', 1),
(7, '2020_12_11_042341_create_shops_table', 1),
(8, '2020_12_11_163407_create_products_table', 1),
(9, '2020_12_18_102254_create_wishlists_table', 1),
(10, '2020_12_19_124007_create_otherimages_table', 1),
(11, '2020_12_20_100055_create_carts_table', 1),
(12, '2020_12_28_162144_create_orders_table', 1),
(13, '2020_12_29_030105_create_orderdetails_table', 1),
(14, '2021_01_03_030105_create_reviews_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shippingaddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `firstname`, `lastname`, `email`, `shippingaddress`, `phonenumber`, `color`, `quantity`, `total`, `status`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'Silver', '1', '62000', 'Canceled', 1, 1, '2021-01-07 09:46:52', '2021-01-07 09:47:06'),
(2, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'Red', '2', '136000', 'Canceled', 2, 2, '2021-01-07 10:15:58', '2021-01-29 14:00:32'),
(3, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'None', '1', '42000', 'Canceled', 3, 4, '2021-01-29 13:59:47', '2021-01-29 14:00:42'),
(4, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'None', '1', '42000', 'Canceled', 4, 4, '2021-01-29 14:01:11', '2021-01-30 02:08:48'),
(5, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'Black', '2', '124000', 'Canceled', 5, 1, '2021-01-30 02:08:41', '2021-01-30 02:18:21'),
(6, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'None', '1', '26000', 'Canceled', 6, 3, '2021-01-30 02:09:23', '2021-01-30 02:24:02'),
(7, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'None', '2', '52000', 'Canceled', 7, 3, '2021-01-30 02:34:58', '2021-01-30 02:36:11'),
(8, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'None', '2', '84000', 'Delivered', 8, 4, '2021-01-30 07:23:21', '2021-01-30 07:23:21'),
(9, 'User', 'One', 'userone@gmail.com', 'Manikganj, Dhaka, Bangladesh', '01900000000', 'Black', '1', '68000', 'Delivered', 8, 2, '2021-01-30 07:23:21', '2021-01-30 07:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `trx_id`, `total`, `type`, `status`, `note`, `currency`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'order-1610034412', '62000', 'OP', 'Processing', NULL, 'BDT', 3, '2021-01-07 09:46:52', '2021-01-07 09:47:06'),
(2, 'order-1610036158', '136000', 'COD', 'Processing', NULL, 'BDT', 3, '2021-01-07 10:15:58', '2021-01-07 10:15:58'),
(3, 'order-1611950387', '42000', 'COD', 'Processing', NULL, 'BDT', 3, '2021-01-29 13:59:47', '2021-01-29 13:59:47'),
(4, 'order-1611950471', '42000', 'OP', 'Processing', NULL, 'BDT', 3, '2021-01-29 14:01:11', '2021-01-29 14:01:25'),
(5, 'order-1611994121', '124000', 'COD', 'Processing', NULL, 'BDT', 3, '2021-01-30 02:08:41', '2021-01-30 02:08:41'),
(6, 'order-1611994163', '26000', 'OP', 'Processing', NULL, 'BDT', 3, '2021-01-30 02:09:23', '2021-01-30 02:09:39'),
(7, 'order-1611995698', '52000', 'COD', 'Processing', NULL, 'BDT', 3, '2021-01-30 02:34:58', '2021-01-30 02:34:58'),
(8, 'order-1612013001', '152000', 'COD', 'Processing', NULL, 'BDT', 3, '2021-01-30 07:23:21', '2021-01-30 07:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `otherimages`
--

CREATE TABLE `otherimages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `otherimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otherimages`
--

INSERT INTO `otherimages` (`id`, `otherimage`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'public/images/products/images/otherimages/1688223341048739.png', 1, '2021-01-07 04:27:20', '2021-01-07 04:27:20'),
(2, 'public/images/products/images/otherimages/1688223341117145.png', 1, '2021-01-07 04:27:20', '2021-01-07 04:27:20'),
(3, 'public/images/products/images/otherimages/1688223341200084.png', 1, '2021-01-07 04:27:20', '2021-01-07 04:27:20'),
(4, 'public/images/products/images/otherimages/1688244617465876.png', 2, '2021-01-07 10:05:31', '2021-01-07 10:05:31'),
(5, 'public/images/products/images/otherimages/1688244617552923.png', 2, '2021-01-07 10:05:31', '2021-01-07 10:05:31'),
(6, 'public/images/products/images/otherimages/1688244617656916.png', 2, '2021-01-07 10:05:31', '2021-01-07 10:05:31'),
(7, 'public/images/products/images/otherimages/1688305877663323.png', 3, '2021-01-08 02:19:13', '2021-01-08 02:19:13'),
(8, 'public/images/products/images/otherimages/1688305877742179.png', 3, '2021-01-08 02:19:14', '2021-01-08 02:19:14'),
(9, 'public/images/products/images/otherimages/1688305877912560.png', 3, '2021-01-08 02:19:14', '2021-01-08 02:19:14'),
(10, 'public/images/products/images/otherimages/1688306522950116.png', 4, '2021-01-08 02:29:29', '2021-01-08 02:29:29'),
(11, 'public/images/products/images/otherimages/1688306523065997.png', 4, '2021-01-08 02:29:29', '2021-01-08 02:29:29'),
(12, 'public/images/products/images/otherimages/1688306523163658.png', 4, '2021-01-08 02:29:29', '2021-01-08 02:29:29');

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `productid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productmodel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productcolor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coverimage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regularprice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discountedprice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `newly` tinyint(1) NOT NULL,
  `productquantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `productdescription` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productid`, `productname`, `productmodel`, `productcolor`, `coverimage`, `regularprice`, `discountedprice`, `newly`, `productquantity`, `productdescription`, `sales`, `user_id`, `brand_id`, `category_id`, `shop_id`, `created_at`, `updated_at`) VALUES
(1, 'Laptop-SO1', 'HP Probook 450 G7', 'Probook 450 G7', 'Black, Red, Silver', 'public/images/products/images/1688223340955516.png', '69000', '62000', 1, '2', 'jvfjyhgbvjhgb,\r\njhvjhygvuyhcfvhg,\r\nhjkv jhvhgfvhgyv,\r\njhgbuyhvyhvyhvj,\r\njhbgjhbgjkbnj', '0', 2, 3, 6, 1, '2021-01-07 04:27:20', '2021-01-30 02:08:41'),
(2, 'Laptop-SO2', 'ASUS Expert Book P1440FA sadasd', 'Expert Book P1440FA', 'Black, Red', 'public/images/products/images/1688244617376975.png', '72000', '68000', 1, '5', 'dsfadsfdsf,\r\nsdfdsgetgdfbh,\r\nasc dfgbvsrafe,\r\nagedwiquhfrdcn,\r\nadfjwifhzvoi', '1', 2, 2, 6, 2, '2021-01-07 10:05:31', '2021-01-30 07:23:21'),
(3, 'Motherboard-SO1', 'Asus ROG Strix Z490-F Gaming', 'ROG Strix Z490-F Gaming', 'None', 'public/images/products/images/1688305877326364.png', '29000', '26000', 1, '7', 'hsbfciuasjhiufd,\r\nsaidhnciouahswn,\r\nasdnjhiuaswhd,\r\nsanjhdfcioasjh,\r\nasjndhfoiksjnhi,\r\nasdjnoiswajimcsj', '0', 2, 2, 1, 1, '2021-01-08 02:19:13', '2021-01-30 02:36:11'),
(4, 'Motherboard-SO2', 'Gigabyte Z490 Aorus Master', 'Z490 Aorus Master', 'None', 'public/images/products/images/1688306522845279.png', '46000', '42000', 1, '5', 'sajbnchldiuwah,\r\nasiudhiausw,\r\ndaoijnwodijws,\r\naodijwuoqaijudi,\r\nasoidjhiowjadjk,\r\naiosdjhioujhidos', '2', 2, 4, 1, 2, '2021-01-08 02:29:29', '2021-01-30 07:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `orderdetail_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellerdetails`
--

CREATE TABLE `sellerdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bkashnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rocketnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellerdetails`
--

INSERT INTO `sellerdetails` (`id`, `bkashnumber`, `rocketnumber`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '01700000000', '017000000003', 2, '2021-01-05 18:28:41', '2021-01-05 18:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serialnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `serialnumber`, `shopname`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '1', 'A-Tech', 2, '2021-01-05 12:34:53', '2021-01-05 12:34:53'),
(2, '2', 'B-Shop', 2, '2021-01-05 12:34:57', '2021-01-05 12:34:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public/images/users/images/default.png',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `gender`, `dob`, `email`, `phonenumber`, `image`, `type`, `approved`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nafiul', 'Islam', 'Male', '1995-10-09', 'nafiul1351@gmail.com', '01992775545', 'public/images/users/images/1688070589602617.jpg', 'Admin', 1, '2021-01-05 11:59:59', '$2y$10$CzbM8XJhtEW9G3JhX24b1OswAMUqNXFnkK2dcpLHa.IigL9pxEPoi', 'VnhveRkEN6Wb7rYfgG0WQFVkkhgmbUftrQi4KMVbrDmu1Ap4oVOLP462ReMf', '2021-01-05 11:59:25', '2021-01-05 11:59:59'),
(2, 'Seller', 'One', 'Male', '', 'sellerone@gmail.com', '01700000000', 'public/images/users/images/default.png', 'Seller', 1, '2021-01-05 18:27:02', '$2y$10$CzbM8XJhtEW9G3JhX24b1OswAMUqNXFnkK2dcpLHa.IigL9pxEPoi', 'E90HYMOT9DVSh0PVCaugC1Yz5NGw9l6tbk2EbN5T9dshNWxUJK3nHLcT3Mzl', '2021-01-05 18:21:22', '2021-01-14 01:43:00'),
(3, 'User', 'One', 'Male', '', 'userone@gmail.com', '01900000000', 'public/images/users/images/default.png', 'Buyer', 1, '2021-01-07 15:43:35', '$2y$10$CzbM8XJhtEW9G3JhX24b1OswAMUqNXFnkK2dcpLHa.IigL9pxEPoi', 'e2g8Pmh6AmTMART8Xm03MuWLAkwOkqMT2KxKEQXmpHnbPLFmtRI3F6qmwkiN', '2021-01-07 15:43:35', '2021-01-07 15:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_serialnumber_unique` (`serialnumber`),
  ADD UNIQUE KEY `brands_brandname_unique` (`brandname`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_serialnumber_unique` (`serialnumber`),
  ADD UNIQUE KEY `categories_categoryname_unique` (`categoryname`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderdetails_order_id_foreign` (`order_id`),
  ADD KEY `orderdetails_product_id_foreign` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `otherimages`
--
ALTER TABLE `otherimages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otherimages_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_productid_unique` (`productid`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_shop_id_foreign` (`shop_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_orderdetail_id_foreign` (`orderdetail_id`);

--
-- Indexes for table `sellerdetails`
--
ALTER TABLE `sellerdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellerdetails_bkashnumber_unique` (`bkashnumber`),
  ADD UNIQUE KEY `sellerdetails_rocketnumber_unique` (`rocketnumber`),
  ADD KEY `sellerdetails_user_id_foreign` (`user_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shops_serialnumber_unique` (`serialnumber`),
  ADD KEY `shops_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phonenumber`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `otherimages`
--
ALTER TABLE `otherimages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellerdetails`
--
ALTER TABLE `sellerdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderdetails_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `otherimages`
--
ALTER TABLE `otherimages`
  ADD CONSTRAINT `otherimages_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`),
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_orderdetail_id_foreign` FOREIGN KEY (`orderdetail_id`) REFERENCES `orderdetails` (`id`),
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sellerdetails`
--
ALTER TABLE `sellerdetails`
  ADD CONSTRAINT `sellerdetails_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
