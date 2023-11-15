-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 09:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `loc` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `desp` text NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `loc`, `date`, `time`, `desp`, `img`) VALUES
(21, 'Teacher\'s Day', 'SV auditorium, Central-Block, HITK', '2023-09-05', '10:30:00', 'Let us gather Together as we celebrate this day as a thanks giving to our respectful teachers', 'cover2.jpg'),
(23, '2020 Batch Reunion', 'Mariot, Bypass Road', '2023-12-11', '09:30:00', 'Let\'s Join together in this heart-warming reunion!', 'cover6.jpg'),
(24, 'The Winter Eve 2023', 'Atmosphere, Bypass Road', '2023-12-26', '15:30:00', 'Wonder what Santa has in store for us?? Join us in this beautiful eve! As we watch the sunset and enjoy a get together.', 'cover9.jpg'),
(25, 'Diwali Blast!!', 'The Ground, HITK', '2023-11-10', '15:00:00', 'We welcome you to join us in this festival of Light!', 'cover3.jpg'),
(32, 'The 77th Independence Day ', 'SV auditorium, Central-Block, HITK', '2023-08-15', '09:00:00', 'Let us join hands to celebrate 76 years of freedom. Vande Mataram!', 'cover7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(255) NOT NULL,
  `title` text NOT NULL,
  `p1` varchar(255) NOT NULL,
  `p2` varchar(255) NOT NULL,
  `p3` varchar(255) NOT NULL,
  `p4` varchar(255) NOT NULL,
  `p5` varchar(255) NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `p1`, `p2`, `p3`, `p4`, `p5`, `des`) VALUES
(10, 'Teacher\'s day', '', 'wapp 2.jpg', 'wapp 1.jpg', 'IMG_0257.JPG', '', 'A heart-warming performance from MCA department'),
(12, 'Random', 'IMG_0245.JPG', '', '', '', 'IMG_0265.JPG', 'A random upload to test css');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE `info` (
  `id` int(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fnm` varchar(255) NOT NULL,
  `lnm` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `exp` int(4) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `ph_no` varchar(25) NOT NULL,
  `about_me` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `uname`, `email`, `fnm`, `lnm`, `company`, `exp`, `dept`, `year`, `ph_no`, `about_me`) VALUES
(17, 'anym', 'aaaka21@gmail.com', 'aakash', 'gowala', 'TCS', 3, 'mca', 2019, '8638567105', 'herroo! ore wa nihongojin desu!'),
(19, 'kuroNeko', 'a1@gmail.com', 'Rhitajyoti', 'Mandal', 'Delloit', 5, 'MCA', 2019, '09836303097', 'Ore wa kuno neko..!! yoo Ningen!'),
(20, 'Bebbe', 'a2@gmail.com', 'Soumik', 'Sil', 'WIPRO', 1, 'cs', 2022, '7596996846', 'let/me/she/them/bazoonkas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `type`, `password`, `pic`) VALUES
(17, 'anym', 'aaaka21@gmail.com', 'student', '$2y$10$m4Ob/1g8ZOzvNcCXJQYlbuFwJTssRqrUoZFTEdugAQqEwcibc33MG', 'aaaka21@gmail.com654c6c5a1ae2f7.01533287.gif'),
(18, 'kinu', 'a3@gmail.com', 'staff', '$2y$10$fWHWgnMIdhfS02X50gJvcOLad3NXne1O.bCSY4jkr0iYkeQ/reZti', 'a3@gmail.com654cbd7a6fd361.29346763.jpg'),
(19, 'kuroNeko', 'a1@gmail.com', 'student', '$2y$10$oLCoT4Ox6W.e7I/O8rpf3e3d7ZGeBsrua65O8pKLZ2nBcBuM2k712', 'a1@gmail.com6550e39d3c9a47.93055844.gif'),
(20, 'Bebbe', 'a2@gmail.com', 'student', '$2y$10$TwtKFO15Dhy7woN2gGcHK.kVpyFCa9RLm1aA7I7JYyp.E3eglxSZm', 'a2@gmail.com655328f94127c6.43422903.gif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `ph_no` (`ph_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
