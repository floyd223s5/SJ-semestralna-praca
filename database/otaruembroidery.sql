-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: St 29.Máj 2024, 12:22
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `otaruembroidery`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `bundles`
--

CREATE TABLE `bundles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(10) NOT NULL,
  `max_uses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `id` int(11) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_mode` varchar(191) DEFAULT 'PayPal',
  `transaction_id` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `download_token` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `download_link` varchar(255) DEFAULT NULL
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
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pre tabuľku `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pre tabuľku `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
