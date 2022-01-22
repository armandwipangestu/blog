-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2022 at 06:51 AM
-- Server version: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'demo', '$2y$10$gcINa1LtAekedyTXACUt5.Oy4DIzeISpxljLoK/2MhjOQ5yDUZ7za');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `tag` text NOT NULL,
  `konten` text NOT NULL,
  `thumbnail` text NOT NULL,
  `tanggal_dibuat` text NOT NULL,
  `tanggal_diubah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `judul`, `tag`, `konten`, `thumbnail`, `tanggal_dibuat`, `tanggal_diubah`) VALUES
(1, 'Demo Postingan', 'demo', '```php\r\nclass FooBar {\r\n   private $demo = \"Hello World!\";\r\n\r\n   public function __construct() {\r\n      echo $this->demo;\r\n   }\r\n}\r\n\r\nnew FooBar();\r\n```\r\n\r\n- Output\r\n\r\n```php\r\nHello World!\r\n```\r\n\r\n<a href=\"https://i.ibb.co/dQrcKps/image.png\" target=\"_blank\">\r\n   <img src=\"https://i.ibb.co/dQrcKps/image.png\" class=\"img-fluid rounded mx-auto d-block\" />\r\n</a>', 'default.png', '20 Januari 2022 09:54', '20 Januari 2022 21:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
