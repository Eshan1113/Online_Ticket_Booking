-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 05:42 PM
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
-- Database: `ticketsystem`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `login_admin` (IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    DECLARE user_count INT;

    SELECT COUNT(*) INTO user_count 
    FROM admin 
    WHERE username = p_username AND password = p_password;

    IF user_count = 1 THEN
        SELECT 'Login Successful' AS message;
    ELSE
        SELECT 'Invalid username or password' AS message;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_user` (IN `p_username` VARCHAR(255), IN `p_email` VARCHAR(255), IN `p_password` VARCHAR(255))   BEGIN
    DECLARE existing_user INT;
    
    SELECT COUNT(*) INTO existing_user FROM users WHERE username = p_username;
    
    IF existing_user > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Username already exists';
    ELSE
        INSERT INTO users (username, email, password) VALUES (p_username, p_email, p_password);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TopFiveAirlinesWithMaxSeats` ()   BEGIN
    SELECT 
        name AS airline_name,
        seats AS total_seats
    FROM 
        airlines
    ORDER BY 
        seats DESC
    LIMIT 5;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TopThreeTravelledPassengers` ()   BEGIN
    SELECT 
        pp.passenger_id,
        pp.user_id,
        COUNT(pp.flight_id) AS total_flights
    FROM 
        passenger_profile pp
    GROUP BY 
        pp.passenger_id, pp.user_id
    ORDER BY 
        total_flights DESC
    LIMIT 3;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TopThreeUsedAirlines` ()   BEGIN
    SELECT
        airline,
        COUNT(*) AS num_flights
    FROM
        flight
    GROUP BY
        airline
    ORDER BY
        num_flights DESC
    LIMIT 3;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePaymentAmount` ()   BEGIN
    START TRANSACTION;

    UPDATE payment
    SET amount = amount + 100
    WHERE amount > 300;

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_login` (IN `p_username` VARCHAR(255), IN `p_password` VARCHAR(255), OUT `p_login_success` BOOLEAN)   BEGIN
    DECLARE v_password VARCHAR(255);
    
    SELECT password INTO v_password FROM users WHERE username = p_username;
    
    IF v_password IS NOT NULL AND BINARY v_password = p_password THEN
        SET p_login_success = TRUE;
    ELSE
        SET p_login_success = FALSE;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'eshan123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `airline_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `seats` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`airline_id`, `name`, `seats`) VALUES
(1, 'Core Airways', 165),
(2, 'Echo Airline', 220),
(3, 'Spark Airways', 125),
(4, 'Peak Airways', 210),
(5, 'Homelander Airways', 185),
(9, 'Blue Airlines', 200),
(10, 'GoldStar Airways', 205),
(11, 'Novar Airways', 158),
(12, 'Aero Airways', 210),
(13, 'Nep Airways', 215),
(14, 'Delta Airlines', 135),
(19, 'airline', -7);

--
-- Triggers `airlines`
--
DELIMITER $$
CREATE TRIGGER `prevent_negative_seats` BEFORE INSERT ON `airlines` FOR EACH ROW BEGIN
    IF NEW.seats < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot insert negative value into seats column';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city`) VALUES
('San Jose'),
('Chicago'),
('Olisphis'),
('Shiburn'),
('Weling'),
('Chiby'),
('Odonhull'),
('Hegan'),
('Oriaridge'),
('Flerough'),
('Yleigh'),
('Oyladnard'),
('Trerdence'),
('Zhotrora'),
('Otiginia'),
('Plueyby'),
('Vrexledo'),
('Ariosey');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `flight_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `departure` datetime NOT NULL,
  `arrivale` datetime NOT NULL,
  `source` varchar(20) NOT NULL,
  `Destination` varchar(20) NOT NULL,
  `airline` varchar(20) NOT NULL,
  `Seats` varchar(110) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `status` varchar(6) DEFAULT NULL,
  `issue` varchar(50) DEFAULT NULL,
  `last_seat` varchar(5) DEFAULT '',
  `bus_seats` int(11) DEFAULT 20,
  `last_bus_seat` varchar(5) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`flight_id`, `id`, `departure`, `arrivale`, `source`, `Destination`, `airline`, `Seats`, `duration`, `Price`, `status`, `issue`, `last_seat`, `bus_seats`, `last_bus_seat`) VALUES
(1, 1, '2024-04-01 10:03:00', '2024-04-02 11:01:00', 'Chicago', 'San', 'Core Airways', '63', '1', 175, '', '', '21B', 20, ''),
(2, 1, '2024-04-02 11:15:00', '2024-04-02 11:59:00', 'Shiburn', 'Olisphis', 'Core Airways', '61', '1', 185, 'arr', '', '21D', 20, ''),
(3, 1, '2024-04-03 12:13:00', '2024-04-03 12:57:00', 'Weling', 'Olisphis', 'Spark Airways', '123', '2', 205, 'arr', '', '21B', 20, ''),
(8, 1, '2024-04-05 00:55:00', '2024-04-05 05:00:00', 'Oyladnard', 'Odonhull', 'Homelander Airways', '183', '7', 615, 'arr', '', '21B', 20, ''),
(20, 1, '2024-04-12 23:58:00', '2024-04-13 00:01:00', 'Zhotrora', 'Trerdence', 'Aero Airways', '208', '1', 185, 'dep', '', '21B', 20, ''),
(33, 1, '2024-03-24 01:34:00', '2024-03-24 05:34:00', 'Chicago', 'Chiby', 'Novar Airways', '158', '3', 90, '', '', '', 20, ''),
(34, 1, '2024-03-24 20:24:00', '2024-03-25 21:24:00', 'Plueyby', 'Zhotrora', 'Nep Airways', '215', '12', 10000, '', '', '', 20, '');

--
-- Triggers `flight`
--
DELIMITER $$
CREATE TRIGGER `prevent_negative_price_insert` BEFORE INSERT ON `flight` FOR EACH ROW BEGIN
    IF NEW.Price < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot insert negative value into Price column';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `prevent_negative_seats_insert` BEFORE INSERT ON `flight` FOR EACH ROW BEGIN
    IF NEW.Seats < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot insert negative value into Seats column';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `passenger_flight_info`
-- (See below for the actual view)
--
CREATE TABLE `passenger_flight_info` (
`passenger_id` int(11)
,`passenger_user_id` int(11)
,`passenger_flight_id` int(11)
,`mobile` varchar(110)
,`dob` datetime
,`f_name` varchar(20)
,`m_name` varchar(20)
,`l_name` varchar(20)
,`flight_id` int(11)
,`departure` datetime
,`arrivale` datetime
,`source` varchar(20)
,`Destination` varchar(20)
,`airline` varchar(20)
,`Seats` varchar(110)
,`duration` varchar(20)
,`Price` int(11)
,`status` varchar(6)
,`issue` varchar(50)
,`last_seat` varchar(5)
,`bus_seats` int(11)
,`last_bus_seat` varchar(5)
,`user_id` int(11)
,`username` varchar(20)
,`email` varchar(50)
,`password` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `passenger_profile`
--

CREATE TABLE `passenger_profile` (
  `passenger_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `mobile` varchar(110) NOT NULL,
  `dob` datetime NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `m_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `passenger_profile`
--

INSERT INTO `passenger_profile` (`passenger_id`, `user_id`, `flight_id`, `mobile`, `dob`, `f_name`, `m_name`, `l_name`) VALUES
(1, 1, 1, '2147483647', '1995-01-01 00:00:00', 'Christine', 'M', 'Moore'),
(2, 2, 3, '2147483647', '1995-02-13 00:00:00', 'Henry', 'l', 'Stuart'),
(3, 3, 2, '2147483647', '1994-06-21 00:00:00', 'Andre', 'J', 'Atkins'),
(4, 4, 2, '2147483647', '1995-05-16 00:00:00', 'James', 'K', 'Harbuck'),
(5, 2, 8, '7854444411', '1995-02-13 00:00:00', 'Henry', 'l', 'Stuart'),
(6, 2, 20, '7412585555', '1995-02-13 00:00:00', 'Henry', 'l', 'Stuart'),
(18, 5, 33, '2222222222222', '2024-03-31 00:00:00', 'es', 'dananajaya', '3ttt'),
(19, 5, 33, '333333', '2024-04-17 00:00:00', 'eshan', 'd', 'esh'),
(20, 7, 33, '0778819383', '2024-05-01 00:00:00', 'eshan', 'd', 'Dananjaya');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `card_no` varchar(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `expire_date` varchar(5) DEFAULT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`card_no`, `user_id`, `flight_id`, `expire_date`, `amount`) VALUES
('1010555677851111', 4, 2, '10/26', 570),
('1020445869651011', 2, 20, '12/25', 570),
('1111888889897778', 2, 3, '12/25', 205),
('1400565800004478', 2, 8, '12/25', 1430),
('1458799990001450', 3, 2, '12/25', 185),
('4204558500014587', 1, 1, '02/25', 550),
('4235467854654789', 7, 33, '01/24', 90);

--
-- Triggers `payment`
--
DELIMITER $$
CREATE TRIGGER `prevent_long_card_no_insert` BEFORE INSERT ON `payment` FOR EACH ROW BEGIN
    DECLARE card_length INT;
    SET card_length = CHAR_LENGTH(NEW.card_no);
   
    IF card_length > 16 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot insert more than 16 characters into card_no column';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `payment_flight_info`
-- (See below for the actual view)
--
CREATE TABLE `payment_flight_info` (
`card_no` varchar(16)
,`payment_user_id` int(11)
,`payment_flight_id` int(11)
,`expire_date` varchar(5)
,`amount` int(11)
,`flight_id` int(11)
,`departure` datetime
,`arrivale` datetime
,`source` varchar(20)
,`Destination` varchar(20)
,`airline` varchar(20)
,`Seats` varchar(110)
,`duration` varchar(20)
,`Price` int(11)
,`status` varchar(6)
,`issue` varchar(50)
,`last_seat` varchar(5)
,`bus_seats` int(11)
,`last_bus_seat` varchar(5)
,`user_user_id` int(11)
,`username` varchar(20)
,`email` varchar(50)
,`password` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seat_no` varchar(10) NOT NULL,
  `cost` int(11) NOT NULL,
  `class` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `passenger_id`, `flight_id`, `user_id`, `seat_no`, `cost`, `class`) VALUES
(1, 1, 1, 1, '21A', 350, 'E'),
(2, 2, 3, 2, '21A', 205, 'E'),
(4, 3, 2, 3, '21A', 185, 'E'),
(6, 4, 2, 4, '21C', 370, 'E'),
(8, 5, 8, 2, '21A', 1230, 'E'),
(12, 20, 33, 7, '21A', 90, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'christine', 'christine@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(2, 'henry', 'henry@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(3, 'andre', 'andre@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(4, 'james', 'james@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(5, 'eshan123', 'eshandananjaya99@gmail.com', '$2y$10$68psgawXC4sHZ6GMw0E4P.hXmNEhAfiMDHl9CqEwrukYhhG5hcYrC'),
(6, 'eshan1234', 'eshandananjaya99@gmail.com', '$2y$10$F5Z4Nrt9wR9I8Xu4A97WWeuan6rAgfqoCI32m1ITh7gE3QZ1c5c5q'),
(7, 'eshan12345', 'mg1998tharu@gmail.com', '$2y$10$1jFaVxG1rd.2dWnNfbGFF.ZAULAsuRXejTeYonj3aBYZ0TKWg8Xr6');

-- --------------------------------------------------------

--
-- Structure for view `passenger_flight_info`
--
DROP TABLE IF EXISTS `passenger_flight_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `passenger_flight_info`  AS SELECT `pp`.`passenger_id` AS `passenger_id`, `pp`.`user_id` AS `passenger_user_id`, `pp`.`flight_id` AS `passenger_flight_id`, `pp`.`mobile` AS `mobile`, `pp`.`dob` AS `dob`, `pp`.`f_name` AS `f_name`, `pp`.`m_name` AS `m_name`, `pp`.`l_name` AS `l_name`, `f`.`id` AS `flight_id`, `f`.`departure` AS `departure`, `f`.`arrivale` AS `arrivale`, `f`.`source` AS `source`, `f`.`Destination` AS `Destination`, `f`.`airline` AS `airline`, `f`.`Seats` AS `Seats`, `f`.`duration` AS `duration`, `f`.`Price` AS `Price`, `f`.`status` AS `status`, `f`.`issue` AS `issue`, `f`.`last_seat` AS `last_seat`, `f`.`bus_seats` AS `bus_seats`, `f`.`last_bus_seat` AS `last_bus_seat`, `u`.`user_id` AS `user_id`, `u`.`username` AS `username`, `u`.`email` AS `email`, `u`.`password` AS `password` FROM ((`passenger_profile` `pp` join `flight` `f` on(`pp`.`flight_id` = `f`.`flight_id`)) join `users` `u` on(`pp`.`user_id` = `u`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `payment_flight_info`
--
DROP TABLE IF EXISTS `payment_flight_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `payment_flight_info`  AS SELECT `p`.`card_no` AS `card_no`, `p`.`user_id` AS `payment_user_id`, `p`.`flight_id` AS `payment_flight_id`, `p`.`expire_date` AS `expire_date`, `p`.`amount` AS `amount`, `f`.`id` AS `flight_id`, `f`.`departure` AS `departure`, `f`.`arrivale` AS `arrivale`, `f`.`source` AS `source`, `f`.`Destination` AS `Destination`, `f`.`airline` AS `airline`, `f`.`Seats` AS `Seats`, `f`.`duration` AS `duration`, `f`.`Price` AS `Price`, `f`.`status` AS `status`, `f`.`issue` AS `issue`, `f`.`last_seat` AS `last_seat`, `f`.`bus_seats` AS `bus_seats`, `f`.`last_bus_seat` AS `last_bus_seat`, `u`.`user_id` AS `user_user_id`, `u`.`username` AS `username`, `u`.`email` AS `email`, `u`.`password` AS `password` FROM ((`payment` `p` join `flight` `f` on(`p`.`flight_id` = `f`.`flight_id`)) join `users` `u` on(`p`.`user_id` = `u`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`airline_id`),
  ADD KEY `idx_airlines_seats_desc` (`seats`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flight_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `passenger_profile`
--
ALTER TABLE `passenger_profile`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `idx_passenger_profile_f_name` (`f_name`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`card_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `passenger_id` (`passenger_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `passenger_profile`
--
ALTER TABLE `passenger_profile`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`id`) REFERENCES `admin` (`id`);

--
-- Constraints for table `passenger_profile`
--
ALTER TABLE `passenger_profile`
  ADD CONSTRAINT `passenger_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `passenger_profile_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`passenger_id`) REFERENCES `passenger_profile` (`passenger_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
