-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 08.Apr 2024, 21:43
-- Verzia serveru: 10.4.28-MariaDB
-- Verzia PHP: 8.2.4

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
  `sale_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `bundles`
--

INSERT INTO `bundles` (`id`, `name`, `img_path`, `price`, `sale_price`) VALUES
(1, 'Bundle Package 50 Designs', '/img/bundles/50.png', 99.00, 59.00),
(2, 'Bundle Package 100 Designs', '/img/bundles/100.jpg', 199.00, 114.00),
(3, 'Bundle Package 200 Designs', '/img/bundles/200.png', 299.00, 199.00);

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
  `download_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `products`
--

INSERT INTO `products` (`id`, `name`, `img_path`, `price`, `sale_price`, `download_path`) VALUES
(1, 'Akxza Eyes Embroidery', '/img/products/Akaza Eyes.jpg', 9.99, NULL, NULL),
(2, 'Aluxard Hellxing Embroidery', '/img/products/Alucard Hellsing.jpg', 6.99, NULL, NULL),
(3, 'Blxach Kuchxki Captain Embroidery', '/img/products/Bleach Kuchiki Captain.jpg', 3.99, NULL, NULL),
(4, 'Blxach Kanxme Tosen Embroidery', '/img/products/Kaname Tosen.jpg', 9.99, NULL, NULL),
(5, 'David Martxnez Embroidery', '/img/products/David Martinez Cyberpunk.jpg', 6.99, NULL, NULL),
(6, 'Nxruto Gaxra Embroidery', '/img/products/Gaara.jpg', 6.99, NULL, NULL),
(7, 'Grimxjow Swoosh Embroidery', '/img/products/Grimmjow Swoosh.jpg', 9.99, NULL, NULL),
(8, 'Itxchi Swoosh Embroidery', '/img/products/Itachi Swoosh.jpg', 6.99, NULL, NULL),
(9, 'Kanxki Swoosh Embroidery', '/img/products/Kaneki Swoosh.jpg', 9.99, NULL, NULL),
(10, 'Kirishxma Embroidery', '/img/products/Kirishima.jpg', 6.99, NULL, NULL),
(11, 'Lxffy Embroidery', '/img/products/Luffy.jpg', 9.99, NULL, NULL),
(12, 'Nxruto x Sasxke Embroidery', '/img/products/NarutoxSasuke fight.jpg', 9.99, NULL, NULL),
(13, 'Odxn Embroidery', '/img/products/Oden.jpg', 9.99, NULL, NULL),
(14, 'One Pixce Embrodiery', '/img/products/OP Logo.jpg', 3.99, NULL, NULL),
(15, 'Quagsxre Pokxmon Embroidery', '/img/products/Quagsire Pokemon.jpg', 6.99, NULL, NULL),
(16, 'Rage Gxn Embroidery', '/img/products/Rage Gon.jpg', 9.99, NULL, NULL),
(17, 'Samurai Champlxo Embroidery', '/img/products/Samurai Champloo.jpg', 9.99, NULL, NULL),
(18, 'Sasxke Swoosh Embroidery', '/img/products/Sasuke Swoosh.jpg', 6.99, NULL, NULL),
(19, 'Severxs Snxpe Embroidery', '/img/products/Severus Snape.jpg', 9.99, NULL, NULL),
(20, 'Tanxiro Kamxdo Embroidery', '/img/products/Tanjiro Kamado.jpg', 9.99, NULL, NULL),
(21, 'Txge Inumxki Embroidery', '/img/products/Toge Inumaki.jpg', 9.99, NULL, NULL),
(22, 'Txkyo Ghxul Juxzo Embroidery', '/img/products/Toky Ghoul Juuzou.jpg', 9.99, NULL, NULL),
(23, 'Yhwxch Blxach Embroidery', '/img/products/Yhwach Bleach.jpg', 9.99, NULL, NULL);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `bundles`
--
ALTER TABLE `bundles`
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
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `bundles`
--
ALTER TABLE `bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
