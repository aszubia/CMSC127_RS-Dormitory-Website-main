-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2023 at 04:49 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dormdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`first_name`, `last_name`, `username`, `password`, `email`) VALUES
('Boss', 'Admin', 'boss', '12345', 'bossadmin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dorm_data`
--

CREATE TABLE `dorm_data` (
  `dorm_id` int(10) UNSIGNED NOT NULL,
  `dorm_name` text NOT NULL,
  `dorm_address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dorm_data`
--

INSERT INTO `dorm_data` (`dorm_id`, `dorm_name`, `dorm_address`) VALUES
(1, 'RS Dormitory Manila', 'Trio de Villa Residences, Baguio, Benguet'),
(2, 'RS Dormitory Baguio', 'Trio Haunted House, Baguio, Benguet'),
(3, 'RS Dormitory Quezon City', 'Novaliches, Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `log_data`
--

CREATE TABLE `log_data` (
  `log_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `log_status` varchar(3) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_data`
--

INSERT INTO `log_data` (`log_id`, `student_id`, `log_status`, `time`, `date`) VALUES
(86, 38, 'out', '2023-01-07 10:40:13', '2023-01-07 18:40:13'),
(87, 39, 'in', '2023-01-07 11:01:16', '2023-01-07 19:01:16'),
(88, 39, 'out', '2023-01-07 11:02:37', '2023-01-07 19:02:37'),
(89, 0, 'out', '2023-01-07 14:43:25', '2023-01-07 22:43:25'),
(90, 0, 'out', '2023-01-07 14:47:51', '2023-01-07 22:47:51'),
(93, 42, 'in', '2023-01-07 15:23:43', '2023-01-07 23:23:43'),
(94, 42, 'out', '2023-01-07 15:25:01', '2023-01-07 23:25:01'),
(95, 43, 'in', '2023-01-07 15:31:08', '2023-01-07 23:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `payment_data`
--

CREATE TABLE `payment_data` (
  `pay_id` int(10) UNSIGNED NOT NULL,
  `date_paid` date NOT NULL,
  `amount` float NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `modeOfPayment` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_data`
--

INSERT INTO `payment_data` (`pay_id`, `date_paid`, `amount`, `first_name`, `last_name`, `modeOfPayment`) VALUES
(5, '2023-01-19', 5000, 'Marwin', 'Matic', 'GCASH'),
(6, '2222-12-12', 5000, 'Achilles Joaquin', 'Zubia', 'GCASH');

-- --------------------------------------------------------

--
-- Table structure for table `room_data`
--

CREATE TABLE `room_data` (
  `room_id` int(10) UNSIGNED NOT NULL,
  `room_name` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `available_beds` int(10) NOT NULL,
  `room_occupants` int(10) NOT NULL,
  `dorm_id` int(10) UNSIGNED NOT NULL,
  `status` text NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_data`
--

INSERT INTO `room_data` (`room_id`, `room_name`, `price`, `available_beds`, `room_occupants`, `dorm_id`, `status`, `description`, `image`) VALUES
(41, 'Room M1', 5500, 5, 0, 1, 'Available', 'This room is a cozy and comfortable space with a warm, welcoming atmosphere. The walls are painted a soft shade of cream, and the hardwood floors are a rich, dark brown. There is a large window that allows natural light to flood into the room, creating a bright and cheerful space. Overall, this room is a perfect place to relax, unwind, and escape from the stresses of the outside world.', 'IMG-63b94871e95725.85660693.png'),
(42, 'Room M2', 3500, 4, 0, 1, 'Available', 'This student dorm room is a compact and efficient space designed to accommodate four residents. The room is divided into two separate sleeping areas, each with its own double deck bed. Overall, this room is a practical and functional place for students to study, sleep, and relax.', 'IMG-63b949441c8881.10777892.png'),
(43, 'Room M3', 8500, 1, 0, 1, 'Available', 'This student dorm room is a luxurious and private space designed for one resident. The bedroom is outfitted with a queen-sized bed with a plush, memory foam mattress and high-thread count linens.  The bedroom also has its own en-suite bathroom with a shower, sink, and toilet. ', 'IMG-63b949edae2f64.45578741.png'),
(48, 'Room M4', 7500, 4, 0, 1, 'Available', 'It\'s a spacious studio apartment with 4 adult bunk beds, designed to give you privacy despite being in one room.', 'IMG-63b94ae2182774.98590417.png'),
(49, 'Room M5', 10000, 0, 1, 1, 'N/A', 'This student dorm room is a compact and functional space designed for one resident. The bedroom is outfitted with a twin-sized bed, a desk and chair, and a small dresser for storage.  The kitchen is a small but well-equipped space with a sink, microwave, mini fridge, and a two-burner stovetop. There is a small table and chairs in the corner, providing a place to eat and work.', 'IMG-63b94b68bd2880.98647913.png'),
(50, 'Room B1', 9500, 3, 0, 2, 'Available', 'This student dorm room is a comfortable and convenient space designed for one resident. The bedroom is outfitted with a twin-sized bed, a desk and chair, and a small dresser for storage.  he room is cooled by a window-mounted air conditioning unit, which keeps the space comfortable and cool even on hot days. ', 'IMG-63b94d6fc8c6c7.34944985.png'),
(51, 'Room B2', 5500, 2, 1, 2, 'Available', 'This student dorm room is a spacious and functional space designed to accommodate three residents. The room is divided into three separate sleeping areas, each with its own twin-sized bed, desk, and chair. ', 'IMG-63b94e470d3aa0.11261063.png'),
(52, 'Room B3', 9500, 1, 0, 2, 'Available', 'This student dorm room is a cozy and efficient space designed for one resident. The bedroom is outfitted with a twin-sized bed, a desk and chair, and a small dresser for storage. ', 'IMG-63b94f0a326db2.29765087.png'),
(53, 'Room B4', 8500, 3, 0, 2, 'Available', 'This student dorm room is a spacious and fully furnished space designed to accommodate two residents. The room is divided into two separate sleeping areas, each with its own twin-sized bed, desk, and chair.', 'IMG-63b94f67c57476.20378109.jpg'),
(54, 'Room Q1', 8000, 2, 0, 3, 'Available', 'This student dorm room is a spacious and fully furnished space designed to accommodate two residents. The room is divided into two separate sleeping areas, each with its own twin-sized bed, desk, and chair. ', 'IMG-63b94fa4dd9037.90304606.jpg'),
(58, 'Room Q2', 12500, 1, 0, 3, 'Available', 'This student dorm room is a comfortable and fully furnished space designed for one resident. The bedroom is outfitted with a twin-sized bed, a desk and chair, and a small dresser for storage. The bed is dressed in crisp white linens and colorful throw pillows, and the desk is equipped with a reading lamp and plenty of storage space. ', 'IMG-63b9505eee4e78.72131671.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `student_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `sex` char(1) NOT NULL,
  `birth_date` date NOT NULL,
  `age` int(3) NOT NULL,
  `contact_number` varchar(13) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `home_address` varchar(250) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`student_id`, `first_name`, `last_name`, `sex`, `birth_date`, `age`, `contact_number`, `email_address`, `home_address`, `password`) VALUES
(38, 'Achilles Joaquin', 'Zubia', 'M', '2001-09-02', 21, '09199092527', 'achilleszubia@inamail.com', 'Ina Mansion, Legarda-Burnham-Kisad', '12345'),
(39, 'Deangelo', 'Enriquez', 'M', '2002-04-10', 20, '09612727145', 'deangeloenriquez@gmail.com', '4 Rosario Ave.  Hensonville Court, Angeles City, Pampanga 2009', 'Kalbonara123!'),
(42, 'nico', 'q', 'M', '0012-12-12', 1, '01234567891', 'nico@yahoo.com', 'Ina Mansion, Legarda-Burnham-Kisad', 'aa'),
(43, 'Cliff', 'Cezar', 'M', '2023-09-15', 21, '09708398415', 'clffczr@gmail.com', 'Valenzuela St, Salud Mitra, Baguio City', 'qwertyuiop');

-- --------------------------------------------------------

--
-- Table structure for table `student_dorm_data`
--

CREATE TABLE `student_dorm_data` (
  `student_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `dorm_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_dorm_data`
--

INSERT INTO `student_dorm_data` (`student_id`, `room_id`, `dorm_id`) VALUES
(38, 49, 1),
(39, 0, 0),
(42, 51, 2),
(43, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_log_data`
--

CREATE TABLE `student_log_data` (
  `student_id` int(11) NOT NULL,
  `last_login` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_logins` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_log_data`
--

INSERT INTO `student_log_data` (`student_id`, `last_login`, `total_logins`) VALUES
(38, '2023-01-07 10:38:51', 1),
(39, '2023-01-07 11:01:16', 1),
(42, '2023-01-07 15:23:43', 1),
(43, '2023-01-07 15:31:08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_stay_data`
--

CREATE TABLE `student_stay_data` (
  `student_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_stay_data`
--

INSERT INTO `student_stay_data` (`student_id`, `start_date`, `end_date`) VALUES
(38, '2023-01-10', '2024-01-13'),
(39, '2023-01-07', '2023-01-07'),
(42, '0012-12-12', '0000-00-00'),
(43, '2023-01-07', '2023-01-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dorm_data`
--
ALTER TABLE `dorm_data`
  ADD PRIMARY KEY (`dorm_id`);

--
-- Indexes for table `log_data`
--
ALTER TABLE `log_data`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `payment_data`
--
ALTER TABLE `payment_data`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `room_data`
--
ALTER TABLE `room_data`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `room_dorm_id` (`dorm_id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_dorm_data`
--
ALTER TABLE `student_dorm_data`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `dorm_id` (`dorm_id`);

--
-- Indexes for table `student_log_data`
--
ALTER TABLE `student_log_data`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_stay_data`
--
ALTER TABLE `student_stay_data`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dorm_data`
--
ALTER TABLE `dorm_data`
  MODIFY `dorm_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_data`
--
ALTER TABLE `log_data`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `payment_data`
--
ALTER TABLE `payment_data`
  MODIFY `pay_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room_data`
--
ALTER TABLE `room_data`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `student_dorm_data`
--
ALTER TABLE `student_dorm_data`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `student_log_data`
--
ALTER TABLE `student_log_data`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `student_stay_data`
--
ALTER TABLE `student_stay_data`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_data`
--
ALTER TABLE `room_data`
  ADD CONSTRAINT `room_data_ibfk_1` FOREIGN KEY (`dorm_id`) REFERENCES `dorm_data` (`dorm_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
