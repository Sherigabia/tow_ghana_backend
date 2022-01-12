-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2021 at 06:15 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tow_ghana`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `firstname`, `lastname`, `phone_number`, `email`, `password`) VALUES
(1, 'test', 'test', '0553164027', 'test1@gmail.com', '$2y$12$d1RcboirjdVtNOFoDq2fTu5ISZ1kW61XrUmwiHQc/a9ouq9RNrTlS'),
(2, 'pambo', 'sheriga', '0553164027', 'sherigabia@gmail.com', '$2y$12$zih4iMjRI8tQmpcA8X9w3OeZ6NrUrh6ncqv8taAJDEXiUX63B.X/u'),
(3, 'pambo', 'sheriga', '0553164027', 'email@email.com', '$2y$12$tU7exCdReLH8Hb2ASXowPO6DuMluTu.p8KzRSnTLG/qe45jF6s6BW'),
(4, 'pambo', 'sheriga', '0553164027', 'emaile@email.com', '$2y$12$IG7OT8m93nJd94Sz8krfT./1wy.AJTWHGT/IGhy1M2e8XzMVh5f/K'),
(5, 'pambo', 'sheriga', '0553164027', 'frompostman@email.com', '$2y$12$8Xh.FuZMpFKpvUyfyFCQu.1Pb7DzKsRKrxdy.QNiHCg/dcsThIK3S'),
(6, 'testing', 'postman', '0553164027', 'frompostman2@email.com', '$2y$12$TodSZ.ioUu1Rd35St1T23.4o1JSxQFW7keSZNoUYT.snBKJxgnejG'),
(7, 'testing', 'postman', '0553164027', 'frompostman4@email.com', '$2y$12$Z.jTCuW0LHk6GWjadcnhQOkwvBDggEBdAoOWmnblbOWaYkuGPulQe'),
(8, 'user', 'user', '0557309758', 'user@user.com', '$2y$12$Zlj9ynyvQ/M4SSCATmJAWOdsVAz5j9hYZhlikhg9YFkcpc/FRFARi'),
(9, 'felix', 'dumong', '0557309758', 'felix@dumong.com', '$2y$12$fz46kePir91r.5oylqlzKOTH3Nk7XgAM9XZQrsDppsJp5t1MqjpTu'),
(10, 'felix', 'dumong', '0557309758', 'felix2@dumong.com', '$2y$12$bVkLs6gd2zD7VaI4Q78UB.Mm4Cr.53Agfg.ARvvfo3y25UbsFaqgK'),
(11, 'grace', 'working', '0200995882', 'grace@work.com', '$2y$12$mxrD224ypSGRQXc8mn5LAecVtiklOYA.Yz.g3uD3bkH73h0JLXfQO'),
(12, 'test', 'test', '0200995882', 'test@test.com', '$2y$12$RfSbd24VGybVLMwVqlk5Ue5YAdhfOMFgLa3jA9COlfINMN8xh1bWm'),
(13, 'test', 'test', '0200995882', 'test1@test.com', '$2y$12$QlR2Fw7FKnXt3I/dG.fdEOLDTFif7AodklG8ibZDiXE5LdF/hz3BW'),
(14, 'Pambo', 'Sheriga', '055316407256989', 'pambo@sheriga.com', '$2y$12$f./qK.aFFaAT6kMqAGkLWOgzhxLSX1TBDSWXx/i/x9oGLtPqS4yQ.');

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE `user_location` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL COMMENT 'Foreign Key linking to user tabel',
  `longitude` double NOT NULL,
  `latitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_location`
--

INSERT INTO `user_location` (`id`, `userID`, `longitude`, `latitude`) VALUES
(0, 2, 7.214514854, -2.1452616564);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
