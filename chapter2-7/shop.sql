-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: ********
-- 生成日時: 2026 年 8 月 04 日 05:07
-- サーバのバージョン： 8.0.40
-- PHP のバージョン: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: ********
--

-- --------------------------------------------------------

--
-- テーブルの構造 `customer`
--

CREATE TABLE `customer` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `coupon_count` int DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- テーブルのデータのダンプ `customer`
--

INSERT INTO `customer` (`id`, `name`, `address`, `login`, `password`, `coupon_count`) VALUES
(1, '********', '********', '********_1', '********', 0),
(2, '********', '********', '********_2', '********', 0),
(3, '********', '********', '********_3', '********', 0),
(4, '********', '********', '********_4', '********', 0),
(5, '********', '********', '********_5', '********', 0),
(6, '********', '********', '********_6', '********', 0),
(7, '********', '********', '********_7', '********', 0),
(8, '********', '********', '********_8', '********', 0),
(9, '********', '********', '********_9', '********', 0),
(10, '********', '********', '********_10', '********', 0),
(11, '********', '********', '********_11', '********', 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite`
--

CREATE TABLE `favorite` (
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- テーブルの構造 `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` int NOT NULL,
  `stock` int DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- テーブルのデータのダンプ `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `stock`) VALUES
(1, '松の実', 700, 100),
(2, 'くるみ', 270, 100),
(3, 'ひまわりの種', 210, 100),
(4, 'アーモンド', 220, 100),
(5, 'カシューナッツ', 250, 100),
(6, 'ジャイアントコーン', 180, 100),
(7, 'ピスタチオ', 310, 100),
(8, 'マカダミアナッツ', 600, 100),
(9, 'かぼちゃの種', 180, 100),
(10, 'ピーナッツ', 150, 100),
(11, 'クコの実', 400, 100);

-- --------------------------------------------------------

--
-- テーブルの構造 `purchase`
--

CREATE TABLE `purchase` (
  `id` int NOT NULL,
  `customer_id` int NOT NULL,
  `purchase_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- テーブルのデータのダンプ `purchase`
--

INSERT INTO `purchase` (`id`, `customer_id`, `purchase_date`) VALUES
(1, 1, '2026-07-21 13:45:28'),
(2, 1, '2026-07-21 13:45:28'),
(3, 1, '2026-07-21 13:45:28'),
(4, 1, '2026-07-21 13:45:28'),
(5, 1, '2026-07-21 13:45:28'),
(6, 1, '2026-07-21 13:45:28'),
(7, 1, '2026-07-21 13:45:28'),
(8, 1, '2026-07-21 13:45:28'),
(9, 1, '2026-07-21 13:45:28'),
(10, 1, '2026-07-21 13:45:28'),
(11, 1, '2026-07-21 13:45:28'),
(12, 1, '2026-07-21 13:45:28'),
(13, 1, '2026-07-21 13:45:28'),
(14, 1, '2026-07-21 13:45:28'),
(15, 1, '2026-07-21 13:45:28'),
(16, 1, '2026-07-21 13:45:28'),
(17, 1, '2026-07-21 13:45:28'),
(18, 1, '2026-07-21 13:45:28'),
(19, 1, '2026-07-21 13:45:28'),
(20, 1, '2026-07-21 13:45:28'),
(21, 2, '2026-07-21 13:45:28'),
(22, 2, '2026-07-21 13:45:28'),
(23, 2, '2026-07-21 13:45:28'),
(24, 2, '2026-07-21 13:45:28'),
(25, 2, '2026-07-21 13:45:28'),
(26, 2, '2026-07-21 13:45:28'),
(27, 1, '2026-07-21 13:45:28'),
(28, 3, '2026-07-21 13:45:28'),
(29, 1, '2026-07-21 13:45:28'),
(30, 2, '2026-07-21 13:45:28'),
(31, 1, '2026-07-21 13:45:28'),
(32, 1, '2026-07-21 16:00:27'),
(33, 1, '2026-07-21 16:28:42'),
(34, 1, '2026-07-21 16:31:31'),
(35, 1, '2026-07-21 16:34:41'),
(36, 1, '2026-07-21 16:38:01'),
(37, 1, '2026-07-21 16:40:23'),
(38, 1, '2026-07-21 16:40:35'),
(39, 1, '2026-07-21 16:42:25'),
(40, 1, '2026-07-21 16:43:11'),
(41, 1, '2026-07-21 16:43:17'),
(42, 1, '2026-07-21 16:43:37'),
(43, 1, '2026-07-21 16:43:42'),
(44, 1, '2026-07-21 16:43:47'),
(45, 1, '2026-07-21 16:44:06'),
(46, 1, '2026-07-21 16:45:00'),
(47, 1, '2026-07-21 16:45:25'),
(48, 1, '2026-07-21 16:46:37'),
(49, 1, '2026-07-21 16:47:45'),
(50, 1, '2026-07-21 16:49:44'),
(51, 1, '2026-07-21 16:50:09'),
(52, 1, '2026-07-21 16:57:26'),
(53, 2, '2026-07-28 18:41:40'),
(54, 1, '2026-08-04 13:01:25'),
(55, 1, '2026-08-04 13:01:47'),
(56, 1, '2026-08-04 13:43:26'),
(57, 1, '2026-08-04 13:44:41'),
(58, 1, '2026-08-04 13:45:21');

-- --------------------------------------------------------

--
-- テーブルの構造 `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `purchase_id` int NOT NULL,
  `product_id` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- テーブルのデータのダンプ `purchase_detail`
--

INSERT INTO `purchase_detail` (`purchase_id`, `product_id`, `count`) VALUES
(1, 1, 1),
(1, 9, 1),
(2, 2, 1),
(3, 1, 1),
(3, 6, 1),
(6, 1, 1),
(7, 1, 10),
(8, 1, 1),
(9, 1, 1),
(10, 3, 1),
(11, 3, 1),
(12, 3, 8),
(12, 8, 5),
(12, 11, 1),
(13, 3, 1),
(14, 3, 1),
(15, 3, 1),
(17, 1, 1),
(18, 1, 2),
(19, 1, 11),
(20, 1, 1),
(21, 1, 1),
(22, 1, 1),
(23, 1, 1),
(24, 1, 10),
(25, 1, 10),
(26, 1, 1),
(27, 1, 2),
(28, 1, 9),
(29, 11, 1),
(30, 3, 49),
(30, 9, 100),
(31, 11, 8),
(32, 1, 11),
(32, 2, 1),
(33, 1, 1),
(33, 2, 1),
(34, 1, 1),
(35, 1, 4),
(36, 1, 1),
(37, 1, 1),
(38, 1, 1),
(39, 1, 10),
(40, 9, 1),
(41, 9, 1),
(42, 9, 1),
(43, 9, 1),
(44, 9, 1),
(45, 1, 10),
(46, 1, 10),
(47, 1, 10),
(48, 1, 10),
(49, 1, 10),
(50, 1, 1),
(51, 1, 9),
(52, 8, 9),
(53, 1, 1),
(53, 2, 1),
(54, 1, 1),
(55, 1, 1),
(56, 1, 1),
(57, 1, 1),
(57, 2, 1),
(58, 1, 11);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- テーブルのインデックス `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`customer_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- テーブルのインデックス `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- テーブルのインデックス `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`purchase_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- テーブルの制約 `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- テーブルの制約 `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD CONSTRAINT `purchase_detail_ibfk_1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`),
  ADD CONSTRAINT `purchase_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
