-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 02:19 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ommydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `registration_date` datetime NOT NULL,
  `role_id` int(11) NOT NULL,
  `profile` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `username`, `password`, `amount`, `registration_date`, `role_id`, `profile`) VALUES
(1, 'Godwin', 'John ', 'go@gmail.com', '0753720642', '0753720642', '$2y$10$kNswt21ugAqEG6OLMdUDkuEwgvl0dMi9ynMYu1hU4MweWhRDMredG', '599997.00', '2023-09-27 19:24:56', 2, 0x696d616765732f315f313730303233323230325f6f7269656e74616c2d74696c65732e706e67),
(3, 'yehoshaphati', 'joshua', 'yehoshaphat@gmail.com', '0672725612', '0672725612', '$2y$10$IYeLKXoJ0ks5tDKLr7gt..y3NXiZ.D/6wHh0/bifTo.dhzM/o.SY6', '1800000.00', '2023-09-27 18:26:05', 1, ''),
(4, 'Anna', 'Joshua', 'anna@gmail.com', '0656683334', '0656683334', '$2y$10$tdmVOTPHGcuEQAOoJImcvuhhjQEed.xgOlMAKMvsS51qeNYUkxBxm', '600000.00', '2023-09-27 19:32:19', 2, ''),
(8, 'theo', 'lui', 'theo@gmail.com', '0656683335', '0656683335', '$2y$10$WNXC6dn5Ef1GnK9Kep7LV.om0t2JFFmFjPTbVPpzBpQaE/lWpQEW2', '50000.00', '2023-10-04 14:39:34', 2, 0x385f313639373332343432365f64617650726f6f664865736c622e6a7067),
(10, 'daaa', 'doooo', 'daaa@yahoo.com', '0123456789', '0123456789', '$2y$10$NPTeeK9OJFr4wKZP7NXYjuX0/3MbjGlKyhaZJNrwng9mhiKjZ90..', '1.00', '2023-10-12 22:18:48', 2, 0x31305f313639373133383932385f50584c5f32303233303631395f3136343034353732342e6a7067),
(12, 'amina', 'jumanne', 'ammy@yahoo.com', '1234567891', '1234567891', '$2y$10$vg71qs.lWmczmMAYT0M6geobVDVuRvEljrr40pQwsMgz/ykpOAznC', '4500.00', '2023-10-14 22:14:39', 2, 0x31325f313639373332343330355f73616d706c65312e706e67),
(14, 'benadetha', 'kileo', 'kileo@gmail.com', '0624244422', '0624244422', '$2y$10$npSqIpUDr0vlb.IvK6SsZe2aOlYb.lxzem45gShmvKbXXpzS7AYm6', '7000000.00', '2023-10-15 05:57:07', 2, 0x696d616765732f31345f313639383134343035375f6d795f6c6f676f2e706e67),
(15, 'benson', 'lusese', 'ben@yahoo.com', '0655123321', '0655123321', '$2y$10$zKNLPSf7UwaU/pqHC84cSelvey9BJg0FUJlssEwIsS2e24I1dZmgK', '4500000.00', '2023-10-15 05:58:45', 2, 0x696d616765732f31355f313639383736343335335f6d795f70686f746f2e6a7067),
(16, 'azaria', 'steve', 'az@azz.com', '1234567898', '1234567898', '$2y$10$2Tsx8VNi.sJg/B2JHh8oQ.qhiZTaAd38hcNLxes3Cnarvr1ueNsBy', '234888.00', '2023-10-15 10:41:23', 2, ''),
(18, 'ommy', 'ommy', 'qw@gmail.com', '0987654321', '0987654321', '$2y$10$zULXyHDCuCa9NWl58v3uYeiEg1O282Soy60Cs62z4CJWKojU6a0Ru', '200000.00', '2023-10-29 17:54:14', 2, 0x696d616765732f31385f313639383635353434385f32303233313032385f3131333531312e6a7067),
(19, 'Elishadai', 'Haroub', 'omarharoub1@gmail.com', '0779785645', '0779785645', '$2y$10$uKXHnRYoD/8MUnA5iiMOt.NR7eF4u1kqrf74qe3yYOQjTRQZHvqCm', '20300.00', '2023-10-30 11:46:43', 2, ''),
(20, 'suzzy', 'caleb', 'suzzy@gmail.com', '071766777', '071766777', '$2y$10$LLCVH/FNgVdwxBogDLDu4.5WLEtok75c5LBxg.Wb8kCpmjLxjJSGi', '200000.00', '2023-11-14 09:00:11', 2, 0x696d616765732f32305f313639393934313739315f2e747261736865642d313638393738343839312d50584c5f32303233303631395f3136343032353836352e6a7067);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
