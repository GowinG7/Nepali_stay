-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2024 at 08:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nepali_stay`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `sr_no` int(11) NOT NULL,
  `admin_name` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`sr_no`, `admin_name`, `admin_pass`) VALUES
(1, 'Stay', '123'),
(2, 'Nepali', '123'),
(3, 'yogi', 'babu');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(7, 'IMG_82545.png'),
(8, 'IMG_73056.png'),
(9, 'IMG_55650.png'),
(10, 'IMG_43352.png'),
(11, 'IMG_23461.png'),
(12, 'IMG_86051.png'),
(13, 'IMG_78346.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `iframe`) VALUES
(1, 'Ratnanagar-5, Chitwan', 'https://maps.app.goo.gl/EFNDWwCtMuyfn2Pg9', 9869610199, 9861598780, 'saurahalodge@gmail.com', 'https://www.facebook.com', 'https://Instagram.com', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3534.9901086216614!2d84.395303!3d27.624823!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3994fb7c551279b1:0x8ee7bd7338e56fbe!2sGodhuli Chulo!5e0!3m2!1sen!2snp!4v1729409715164!5m2!1sen!2snp');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desc` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `icon`, `name`, `desc`) VALUES
(10, 'IMG_73822.svg', 'TV', 'Smart TV with internet connection'),
(11, 'IMG_53552.svg', 'AC', 'High quality Ac connection in the rooms'),
(12, 'IMG_12276.svg', 'Massage', 'Massage list will be given and have to select by the customer'),
(13, 'IMG_92333.svg', 'Cooler', 'In place of AC cooler can be selected as it is budget friendly than AC'),
(14, 'IMG_16000.svg', 'Geyser', 'Equipment that makes the water warmth in usually used in the kitchen and the bathroom'),
(15, 'IMG_30809.svg', 'Heater', 'Room heater for making the room warmth');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(7, 'bedroom'),
(8, 'balcony'),
(9, 'kitchen'),
(10, 'Sofa'),
(11, 'Desktop table'),
(19, 'Bathroom'),
(21, 'wifi');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `description`, `status`, `removed`) VALUES
(3, 'Simple room 1', 712, 777, 2, 'This is the testing phase ...testing 8\r\nsuccessfully testing finally', 1, 1),
(4, 'Simple Room', 441, 800, 10, 'This is the simple room with the most affordable one having only bedroom and cooler.', 1, 0),
(5, 'Simple Room', 2020, 487, 1, 'Checking whether the room will be deleted or not', 1, 1),
(6, 'Luxury Room', 14400, 1500, 1, 'The most standard room that our hotel has.', 1, 0),
(7, 'Single room', 1200, 550, 5, 'It is the simple room with a single bed having tv and AC', 1, 0),
(8, 'Doubled bed room', 1600, 700, 4, 'This is the doubled bed room which is preferable for the one that need the doubled bed in a room as well as there are some features and facilities with that room that makes the room experience better and good.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(79, 6, 10),
(80, 6, 11),
(81, 6, 12),
(82, 6, 14),
(83, 6, 15),
(84, 7, 10),
(85, 7, 11),
(91, 4, 13),
(92, 8, 10),
(93, 8, 11),
(94, 8, 14);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(60, 6, 7),
(61, 6, 9),
(62, 6, 10),
(63, 6, 11),
(64, 6, 19),
(65, 7, 7),
(76, 4, 7),
(77, 4, 21),
(78, 8, 7),
(79, 8, 10),
(80, 8, 19),
(81, 8, 21);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(16, 4, 'IMG_78000.png', 1),
(20, 6, 'IMG_77601.png', 0),
(21, 6, 'IMG_52748.png', 1),
(22, 7, 'IMG_17444.png', 1),
(23, 7, 'IMG_61046.png', 0),
(25, 4, 'IMG_32203.png', 0),
(26, 4, 'IMG_36397.png', 0),
(27, 8, 'IMG_65895.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(300) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'NEPALI STAY', 'NEPALI STAY is the online hotel room booking sytem that offers the different types of rooms available in the hotels with the attached features and services according to the rooms types and the cost.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(23, 'Gobin', 'IMG_91407.jpg'),
(27, 'Yogesh', 'IMG_32109.jpg'),
(28, 'Yogesh', 'IMG_45370.jpg'),
(29, 'Gobinda', 'IMG_99314.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user_creden`
--

CREATE TABLE `user_creden` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_creden`
--

INSERT INTO `user_creden` (`id`, `name`, `username`, `email`, `phone`, `pass`, `is_verified`, `status`, `datentime`) VALUES
(30, 'Gobin', '@Gobi', 'Gobin@gmail.com', '9869610199', '45645645', 1, 1, '2024-11-28 22:20:11'),
(33, 'Laptop', '_Lap', 'lap1@gmail.com', '2222222222', '1231231231', 0, 1, '2024-11-28 22:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms COLLATE=eucjpms_japanese_nopad_ci;

--
-- Dumping data for table `user_queries`
--

INSERT INTO `user_queries` (`sr_no`, `name`, `email`, `subject`, `message`, `date`, `seen`) VALUES
(54, 'Gobinda Ghimire', 'bhaigobinda1@gmail.com', 'Checking code', 'Checking if the code work as expected or not', '2024-11-05', 1),
(55, 'Yogesh', 'yogesh1@gmail.com', 'Submitting queries', 'I found this site to be used  a bit difficult so help me out', '2024-11-10', 1),
(56, 'Gobin da', 'ghimirebhai1@gmail.com', 'Rooms details', 'Carousel images haru move bayena', '2024-11-19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room id` (`room_id`),
  ADD KEY `facilities id` (`facilities_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `features id` (`features_id`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_creden`
--
ALTER TABLE `user_creden`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_creden`
--
ALTER TABLE `user_creden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `facilities id` FOREIGN KEY (`facilities_id`) REFERENCES `facilities` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `features id` FOREIGN KEY (`features_id`) REFERENCES `features` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
