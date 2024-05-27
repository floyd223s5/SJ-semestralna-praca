-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: db.websupport.sk:3306
-- Čas generovania: Po 27.Máj 2024, 15:26
-- Verzia serveru: 8.0.32-24
-- Verzia PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `v2d3hhpm`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `bundles`
--

CREATE TABLE `bundles` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `download_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `bundles`
--

INSERT INTO `bundles` (`id`, `name`, `img_path`, `price`, `sale_price`, `download_link`) VALUES
(1, 'Bundle Package 50 Designs', '/img/bundles/50.png', 100.00, 59.00, 'https://mega.nz/file/fsQGzS6Q#2K9PV6lE6q672aaclBJXxWBns48zupft4FlKMjxEg1E'),
(2, 'Bundle Package 100 Designs', '/img/bundles/100.jpg', 199.00, 114.00, 'https://mega.nz/file/ixBAgKbA#MX6AHqfWyhkwlPOcHlRVUqE_3FXamuZO6CLoFNliiNk'),
(3, 'Bundle Package 200 Designs', '/img/bundles/200.png', 299.00, 199.00, 'https://mega.nz/file/j5JEEYYR#WXSKvQ47WsYGyrlIRYwnO6w1JjqXMFYTHgRxLpAjFkg'),
(41, 'Jujxtsu Kxisen Bundle', '/img/bundles/Jujutsu Kaisen bundle.png', 80.00, 60.00, 'https://mega.nz/file/ixYhkZgQ#aUsM2K_Lyp7yIUtCF8ptlEpj_lO5qQKtB_F9OPxuWWo'),
(42, 'Nxruto Bundle', '/img/bundles/Naruto Bundle.png', 100.00, 80.00, 'https://mega.nz/file/zpIWUR6L#G0coKEhaCYYndwGYwr27SXlZHG9sSqYDkKvaiYxvP_U'),
(43, 'One Pxce Bundle', '/img/bundles/One Piece Bundle.png', 65.00, 50.00, 'https://mega.nz/file/D9IWDBqL#BQb-0WBsrAc0ZBcs-CSNd_uW_5TEJd9bId38HY1XUDQ'),
(44, 'Dxmon Slayxr Bundle', '/img/bundles/Demon Slayer Bundle.png', 100.00, 80.00, 'https://mega.nz/file/XxIGDILC#H5AOm_W3Wmuxjmh0ns4gDN796iPx8V8xfgEzE8ppBeM');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `discount`
--

CREATE TABLE `discount` (
  `id` int NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(10) NOT NULL,
  `max_uses` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Sťahujem dáta pre tabuľku `discount`
--

INSERT INTO `discount` (`id`, `code`, `value`, `max_uses`) VALUES
(1, 'jj', '20', NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_general_ci DEFAULT 'PayPal',
  `transaction_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `download_token` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `orders`
--

INSERT INTO `orders` (`id`, `first_name`, `last_name`, `email`, `total_price`, `payment_mode`, `transaction_id`, `status`, `comments`, `created_at`, `download_token`) VALUES
(1, 'Brian', 'Krawczyk', 'briankrawczyk93@googlemail.com', 199.00, 'PayPal', '8J684213C96504049', 'PAID', NULL, '2024-01-28 20:17:22', NULL),
(2, 'Mariana', 'Solis Medrano', 'marianasmsolismedrano@gmail.com', 59.00, 'PayPal', '0GM55959M1696980G', 'PAID', NULL, '2024-01-30 20:31:12', NULL),
(3, 'Jordan', 'Williams', 'noloosethreads1@gmail.com', 199.00, 'PayPal', '51M96671FP4496649', 'PAID', NULL, '2024-02-03 04:25:08', NULL),
(4, 'Andres', 'Orozco', 'orozcoandres0903@gmail.com', 199.00, 'PayPal', '9UX90949NS508001B', 'PAID', NULL, '2024-02-10 01:32:37', NULL),
(5, 'henrueta', 'solcany', 'henrieta.solcanyova@gmail.com', 3.99, 'PayPal', '6JW44845W0448390Y', 'PAID', NULL, '2024-02-11 20:02:02', NULL),
(6, 'Bryan', 'Larin', 'blarin42@icloud.com', 59.00, 'PayPal', '2NB547659X859140U', 'PAID', NULL, '2024-02-14 17:54:39', NULL),
(7, 'Maathir ', 'Al hilali', 'maather99.m@gmail.com', 199.00, 'PayPal', '0TW40384N4837823U', 'PAID', NULL, '2024-02-15 06:09:37', NULL),
(8, 'BRODERIE', '-EA', 'elmokhsami92@gmail.com', 59.00, 'PayPal', '01B74356BM011552V', 'PAID', NULL, '2024-02-20 12:26:31', NULL),
(11, 'Jocelyn', 'Lara', 'jocelyn1232111@gmail.com', 59.00, 'PayPal', '2DY68379AC560841Y', 'PAID', NULL, '2024-03-02 16:52:30', NULL),
(12, 'MEJHAD', 'MUSTAPHA', 'mustapha241984@gmail.com', 6.99, 'PayPal', '39A51487FY111535C', 'PAID', NULL, '2024-03-09 16:24:13', NULL),
(13, 'Zhanuzak', 'Asangaziev', 'johngazi@yahoo.com', 6.99, 'PayPal', '5EE62159V2300683U', 'PAID', NULL, '2024-03-11 14:03:49', NULL),
(14, 'Omer', 'Alpsoy', 'omer_black@live.nl', 199.00, 'PayPal', '2HU54556W1509503N', 'PAID', NULL, '2024-03-28 21:55:30', NULL),
(15, 'andre', 'igland', 'lyngdal1999@hotmail.no', 6.99, 'PayPal', '4A371995H5519021T', 'PAID', NULL, '2024-04-07 01:05:01', NULL),
(16, 'Brandi', 'Smith', 'brandistwocents@gmail.com', 59.00, 'PayPal', '4S27751103161951M', 'PAID', NULL, '2024-04-10 19:17:56', NULL),
(17, 'Yach', 'Valdez ', 'yachv45@gmail.com', 59.00, 'PayPal', '9GT24698037818647', 'PAID', NULL, '2024-04-15 18:44:36', NULL),
(18, 'Marcela', 'Chaves Martins', 'marcelacmartins03@hotmail.com', 114.00, 'PayPal', '5V824203H2600641B', 'PAID', NULL, '2024-04-30 21:47:51', NULL),
(19, 'Liridon', 'Hulaj', 'Liridonhulaj07@gmail.com', 7.99, 'PayPal', '7AS8584425998062S', 'PAID', NULL, '2024-05-03 04:39:48', NULL),
(20, 'Marco', 'Cogo', 'cogomarcoebay@gmail.com', 13.98, 'PayPal', '2EW25241YK6628501', 'PAID', NULL, '2024-05-03 13:31:00', NULL),
(26, 'Mustafa ', 'Jabber', 'Odayjabber31@gmail.com', 7.99, 'PayPal', '0S729048LU274421F', 'PAID', NULL, '2024-05-03 18:04:08', NULL),
(27, 'Andrija', 'Stankovic', 'stankovicandrija001@gmail.com', 199.00, 'PayPal', '8K0756701J621092C', 'PAID', NULL, '2024-05-04 21:46:05', NULL),
(28, 'Jolan', 'MÃ¶bus', 'hallojolan@gmail.com', 530.00, 'PayPal', '67A45856U8797563B', 'PAID', NULL, '2024-05-16 20:30:44', NULL),
(29, 'Ismael', 'Gutierrez', 'ismaelgutierrrez18@gmail.com', 45.00, 'PayPal', '6E189515LE5884742', 'PAID', NULL, '2024-05-17 17:19:36', NULL),
(30, 'Niko', 'Klimenta', 'niko.klimenta@hotmail.de', 6.99, 'PayPal', '65480255A2122910X', 'PAID', NULL, '2024-05-18 15:06:54', NULL),
(31, 'rida', 'errifi', 'redar8019@gmail.com', 8.99, 'PayPal', '6R890422M2843574N', 'PAID', NULL, '2024-05-22 13:04:58', NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `bundle_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Sťahujem dáta pre tabuľku `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `bundle_id`) VALUES
(1, 1, NULL, 3),
(2, 2, NULL, 1),
(3, 3, NULL, 3),
(4, 4, NULL, 3),
(5, 5, 14, NULL),
(6, 6, NULL, 1),
(7, 7, NULL, 3),
(8, 8, NULL, 1),
(11, 11, NULL, 1),
(12, 12, 5, NULL),
(13, 13, 18, NULL),
(14, 14, NULL, 3),
(15, 15, 6, NULL),
(16, 16, NULL, 1),
(17, 17, NULL, 1),
(18, 18, NULL, 2),
(19, 19, 29, NULL),
(20, 20, 14, NULL),
(21, 20, 11, NULL),
(22, 21, 1, NULL),
(23, 22, 1, NULL),
(24, 22, 5, NULL),
(25, 22, 4, NULL),
(26, 23, 4, NULL),
(27, 23, 5, NULL),
(28, 23, 1, NULL),
(29, 23, NULL, 2),
(30, 24, 4, NULL),
(31, 24, 1, NULL),
(32, 24, NULL, 2),
(33, 25, 40, NULL),
(34, 26, 40, NULL),
(35, 27, NULL, 3),
(36, 28, 45, NULL),
(37, 29, NULL, 45),
(38, 30, 18, NULL),
(39, 31, 33, NULL);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `download_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `products`
--

INSERT INTO `products` (`id`, `name`, `img_path`, `price`, `sale_price`, `download_link`) VALUES
(1, 'Akxza Eyes Embroidery', '/img/products/Akaza Eyes.jpg', 6.99, NULL, 'https://mega.nz/file/zlogVYKT#LAQ0bjBPjQBhCB7YKcCuc5ztnGjPc6sXuZHFwbJQXNY'),
(2, 'Aluxard Hellxing Embroidery', '/img/products/Alucard Hellsing.jpg', 7.99, NULL, 'https://mega.nz/file/qloAHaIZ#-lDnYv8H5FL7RwLldOH466mKh5dtyzejV8HA4N0TZ60'),
(3, 'Blxach Kuchxki Captain Embroidery', '/img/products/Bleach Kuchiki Captain.jpg', 3.99, NULL, 'https://mega.nz/file/z14WTCwQ#53_d_FIccjYNgJgv6v5NYf9SGiR3g2zqqy_D6oA4AOc'),
(4, 'Blxach Kanxme Tosen Embroidery', '/img/products/Kaname Tosen.jpg', 9.99, NULL, 'https://mega.nz/file/asxU0BLT#S2RixmofSKdhdGki_ex6_bOmwtUgoCZqySdcVaMZ-bA'),
(5, 'David Martxnez Embroidery', '/img/products/David Martinez Cyberpunk.jpg', 6.99, NULL, 'https://mega.nz/file/rtZwAKDA#AowN5MSoKYZhOBI4Bt8hNl0E7NPARCv76MZ9yrjUVvY'),
(6, 'Nxruto Gaxra Embroidery', '/img/products/Gaara.jpg', 6.99, NULL, 'https://mega.nz/file/WxRwQaaR#lP7kszujFeQ2IRm_LocQv7mUWF9-37ORL1Lp1Wqu9ec'),
(7, 'Grimxjow Swoosh Embroidery', '/img/products/Grimmjow Swoosh.jpg', 9.99, NULL, 'https://mega.nz/file/WgQVmKSZ#y7kkg9Sn3flUAmvg4qFAIaAeZQ7OpSBhNITbEQsk4RM'),
(8, 'Itxchi Swoosh Embroidery', '/img/products/Itachi Swoosh.jpg', 6.99, NULL, 'https://mega.nz/file/atwmFJIC#6TMcqJX1dKBikbDskcWEBWY8RVLv9dptVPWREiZlVlM'),
(9, 'Kanxki Swoosh Embroidery', '/img/products/Kaneki Swoosh.jpg', 9.99, NULL, 'https://mega.nz/file/egYhCbCJ#67IeB8BxKFXJPiDgtNxBgeV-JGQnQe_sAsy1pCFgdnY'),
(10, 'Kirishxma Embroidery', '/img/products/Kirishima.jpg', 6.99, NULL, 'https://mega.nz/file/O4hCyDRb#lACK-wSRRfFG8881EGNtDDaYhXPqQu-HRr9-5fICjhw'),
(11, 'Lxffy Embroidery', '/img/products/Luffy.jpg', 9.99, NULL, 'https://mega.nz/file/G1YU1bKD#uIo7F7IOS4ZiSqsnm567rYnC7WAhfhyxGOAfZCv_v78'),
(12, 'Nxruto x Sasxke Embroidery', '/img/products/NarutoxSasuke fight.jpg', 9.99, NULL, 'https://mega.nz/file/HxIXFbyD#Ih81pY7Gbm_dtYf6unf9F59Ekkzyu4DBFcIJQ8wgE_w'),
(13, 'Odxn Embroidery', '/img/products/Oden.jpg', 9.99, NULL, 'https://mega.nz/file/rsx3BYYT#2_rBL8lbnAGqONvoyN9uaEUWWuHq41C7QLPPq7gXNRE'),
(14, 'One Pixce Embrodiery', '/img/products/OP Logo.jpg', 3.99, NULL, 'https://mega.nz/file/zsQX3Jib#8UnUNbAKDRqeZlV1c5XB2MhT4iMWc1hNxwDMc45cDR4'),
(15, 'Quagsxre Pokxmon Embroidery', '/img/products/Quagsire Pokemon.jpg', 6.99, NULL, 'https://mega.nz/file/T9Ym1Zib#LH0Ku69dzZ4yJfwjyPsVOewH8vTAhaGO55EOUflnR6g'),
(16, 'Rage Gxn Embroidery', '/img/products/Rage Gon.jpg', 9.99, NULL, 'https://mega.nz/file/LpIXiA4Q#QHVcWgcEuOpTE_AG1rjfdxwR8j_bqkRH6I7xVSdu40g'),
(17, 'Samurai Champlxo Embroidery', '/img/products/Samurai Champloo.jpg', 9.99, NULL, 'https://mega.nz/file/XsQy2T4K#X19OQaJIJ9vE4l7r7AH2TJSfPFUMgw1kkc5KM2fJZHA'),
(18, 'Sasxke Swoosh Embroidery', '/img/products/Sasuke Swoosh.jpg', 6.99, NULL, 'https://mega.nz/file/HkIWDRyY#0eGizFZKoi2jcLr-dl1aDKUGpDrxugsKG4FFsNgDRPM'),
(19, 'Severxs Snxpe Embroidery', '/img/products/Severus Snape.jpg', 9.99, NULL, 'https://mega.nz/file/fggw3CoK#snGY5mUCVseesgl_vm_hDejNIRMJy8wWwqB89wwMz20'),
(20, 'Tanxiro Kamxdo Embroidery', '/img/products/Tanjiro Kamado.jpg', 9.99, NULL, 'https://mega.nz/file/XwgihKAD#s2F8HER_Mf7Z6eXbRf5VHoEn4QiBJdBeDU_8meFnZNI'),
(21, 'Txge Inumxki Embroidery', '/img/products/Toge Inumaki.jpg', 9.99, NULL, 'https://mega.nz/file/ywBxiIAT#au9Zp8K-ueqMgjav8dmA7SmcZon41zXyxJwhYuDITJY'),
(22, 'Txkyo Ghxul Juxzo Embroidery', '/img/products/Toky Ghoul Juuzou.jpg', 9.99, NULL, 'https://mega.nz/file/m1JAEQRQ#LIUb0srwoTyZmN4Zrn1sF8-TstJ52c6sbKiAAzPtsag'),
(23, 'Yhwxch Blxach Embroidery', '/img/products/Yhwach Bleach.jpg', 9.99, NULL, 'https://mega.nz/file/CkwVFBLA#HyseqojW80y7x6Yjf3nVuHuB_CYSKdl5P-5asU7IpIE'),
(29, 'Sxkuna Ryomen Embroidery', '/img/products/Sxkuna Ryomen.png', 7.99, NULL, 'https://mega.nz/file/nxAXTTAY#wkN_bEScvaeDHLBiYyv4iWOhAYRBAQVZvPF75vPLFJ0'),
(32, 'Txshiro Hitsugxya Embroidery', '/img/products/Toshiro Hitsugaya.png', 9.99, NULL, 'https://mega.nz/file/r1Bi0ayA#2aMgmV9eAXd1M7cH0ViMvuWvKMUydER2BpfJ-fEK6QY'),
(33, 'Sxkuna Ryoiki Tenkai', '/img/products/Sukuna Ryoiki Tenkai.png', 8.99, NULL, 'https://mega.nz/file/blwHiTJT#19MC3H0KOKMASUYUVfb31hAoExAREEnARZYVeXYAXJY'),
(34, 'Shxnsui Kyorakx Embroidery', '/img/products/Shunsui Kyoraku.png', 9.99, NULL, 'https://mega.nz/file/v4IXzbJI#DmdajPJVuS0aQy3uEKp-2JulQycOEEU4yE-96HYefBo'),
(35, 'Gxjo Eyes Embroidery', '/img/products/Gojo Eyes.png', 8.99, NULL, 'https://mega.nz/file/Kkx2kZ7a#TYQP5OwLD8aJfe8QH4vzblWthFBITKEQ1ns1A98SRoc'),
(37, 'Obxto Six Paths Embroidery', '/img/products/Obito Six Paths.png', 6.99, NULL, 'https://mega.nz/file/ak4ASIiZ#yvnQNTl-7SLbIdKZmma7nkPkFkeVVxIVMjBcBwnT4Bo'),
(39, 'Bxrserk Gxts Embroidery', '/img/products/Berserk GUTS.png', 4.99, NULL, 'https://mega.nz/file/r5oCUK6D#subWH0EodrFUa7GtlHKXHrtZ9cGCtjxt5-BVs9GENV0'),
(40, 'Sugxru Gxto Embroidery', '/img/products/Suguru Geto.png', 7.99, NULL, 'https://mega.nz/file/vkolVJyD#0Km7y8JQmD3eYxrd_9LRCnNBYB-VLkeNV1cSc_LNONA'),
(41, 'Sxtoru Gxjo Embroidery', '/img/products/Satoru Gojo.png', 7.99, NULL, 'https://mega.nz/file/flZ1ECRT#18typDPupo30BpcGzMJBhIyVrYd-iTZ228w76zneZhk');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'otaruembroidery', '$2y$10$OjdFUzI5N9jDclPUVessX.ClYta8vtMlgNiB.cxmq6RgbvcLnranK');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `bundle_id` (`bundle_id`);

--
-- Indexy pre tabuľku `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `bundles`
--
ALTER TABLE `bundles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pre tabuľku `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pre tabuľku `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pre tabuľku `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pre tabuľku `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`bundle_id`) REFERENCES `bundles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
