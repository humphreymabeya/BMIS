-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2019 at 03:50 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BMIS`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id` int(10) NOT NULL,
  `route` int(10) NOT NULL,
  `busregno` varchar(40) NOT NULL,
  `bustype` varchar(30) NOT NULL,
  `capacity` int(10) NOT NULL,
  `available` int(10) NOT NULL,
  `traveldate` varchar(30) NOT NULL,
  `departure` varchar(50) NOT NULL,
  `arrival` varchar(50) NOT NULL,
  `delete_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id`, `route`, `busregno`, `bustype`, `capacity`, `available`, `traveldate`, `departure`, `arrival`, `delete_status`) VALUES
(1, 3, 'KCR 111K', 'Business', 49, 41, '2019-04-23', '9:00 AM', '4:00 PM', '0'),
(2, 4, 'KCR 119K', 'Executive', 49, 49, '2019-04-23', '9:00 AM', '4:00 PM', '0'),
(3, 4, 'KCA 123B', 'Executive', 49, 49, '2019-04-23', '8:00 PM', '4:00 AM', '0'),
(4, 3, 'KCA 123W', 'Executive', 49, 47, '2019-04-23', '9:00 AM', '4:00 PM', '0'),
(5, 5, 'KCC 737M', 'Business', 49, 49, '2019-04-23', '9:00 AM', '4:00 AM', '0'),
(6, 7, 'KCR 112K', 'Business', 49, 49, '2019-04-23', '9:00 AM', '6:00 PM', '0'),
(7, 8, 'KCR 113K', 'Business', 49, 49, '2019-04-23', '10:00 PM', '5:00 AM', '0'),
(8, 1, 'KCR 122A', 'Business', 49, 46, '2019-04-23', '9:00am', '7:00pm', '0'),
(9, 3, 'KCT 508N', 'Business', 49, 49, '2019-04-23', '10: 00 PM', '4:00 AM', '0');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `dname` varchar(100) NOT NULL,
  `idno` varchar(14) NOT NULL,
  `lno` varchar(12) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `bus` varchar(40) NOT NULL,
  `delete_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `dname`, `idno`, `lno`, `mobile`, `bus`, `delete_status`) VALUES
(1, 'Daniel Momanyi', '30090012', '12345678', '0709312465', '1', '0'),
(2, 'Kamau Kamotho', '6543323', '40098', '0712909567', '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mpesa_payments`
--

CREATE TABLE `mpesa_payments` (
  `auto` int(11) NOT NULL,
  `TransactionType` varchar(40) NOT NULL,
  `TransID` varchar(40) NOT NULL,
  `TransTime` varchar(40) NOT NULL,
  `TransAmount` double NOT NULL,
  `BusinessShortCode` varchar(15) NOT NULL,
  `BillRefNumber` varchar(40) NOT NULL,
  `InvoiceNumber` varchar(40) NOT NULL,
  `ThirdPartyTransID` varchar(40) NOT NULL,
  `MSISDN` varchar(20) NOT NULL,
  `FirstName` varchar(60) NOT NULL,
  `MiddleName` varchar(60) NOT NULL,
  `LastName` varchar(60) NOT NULL,
  `OrgAccountBalance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reserves`
--

CREATE TABLE `reserves` (
  `id` int(4) NOT NULL,
  `bid` int(30) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `idno` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `seatnum` int(11) NOT NULL,
  `seat_xy` varchar(4) NOT NULL,
  `ticketID` varchar(40) NOT NULL,
  `quantity` enum('1') DEFAULT '1',
  `bdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Booked','Cancelled') NOT NULL DEFAULT 'Booked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserves`
--

INSERT INTO `reserves` (`id`, `bid`, `fullname`, `mobile`, `idno`, `email`, `seatnum`, `seat_xy`, `ticketID`, `quantity`, `bdate`, `status`) VALUES
(1, 1, 'Vokes', '0710', '1234', 'test@test.com', 3, '1_4', 'ENA0001', '1', '2019-04-15 06:56:12', 'Booked'),
(2, 1, 'Mike', '0716', '1234', 'test@test.com', 4, '1_5', 'ENA0002', '1', '2019-04-15 06:56:40', 'Booked'),
(3, 1, 'Mabeya', '0716', '1234', 'test@test.com', 1, '1_1', 'ENA0003', '1', '2019-04-15 06:58:17', 'Booked'),
(4, 1, 'Juliet', '0710', '1234', 'test@test.com', 5, '2_1', 'ENA0004', '1', '2019-04-15 07:01:11', 'Booked'),
(5, 1, 'Minoo', '0710', '1234', 'test@test.com', 6, '2_2', 'ENA0005', '1', '2019-04-15 07:01:11', 'Booked'),
(6, 1, 'Abdi', '0710', '1234', 'test@test.com', 2, '1_2', 'ENA0006', '1', '2019-04-15 07:11:56', 'Booked'),
(7, 1, 'Tony', '0710', '1234', 'test@test.com', 7, '2_4', 'ENA0007', '1', '2019-04-15 07:40:13', 'Booked'),
(8, 4, 'Allan Shearer', '0711', '32154312', 'allan.shearer@yahoo.com', 7, '2_4', 'ENA0008', '1', '2019-04-15 08:01:51', 'Booked'),
(9, 8, 'John Nyakeya', '0725804958', '6552134', 'john@test.test', 5, '2_1', 'ENA0009', '1', '2019-04-15 09:06:13', 'Booked'),
(10, 8, 'Mary Magdaline', '079820016', '34590987', 'test@test.com', 3, '1_4', 'ENA0010', '1', '2019-04-15 09:22:46', 'Booked'),
(11, 4, 'juliet minoo', '0715447509', '34576809', 'test@test.com', 3, '1_4', 'ENA0011', '1', '2019-04-15 11:01:16', 'Booked'),
(12, 8, 'kjiu', 'rt', '675', 're@uu', 11, '3_4', 'ENA0012', '1', '2019-04-15 13:06:05', 'Booked'),
(13, 1, 'Mabeya Ndere', '0719136107', '32653546', 'mabeya.ndere@gmail.com', 8, '2_5', 'ENA0013', '1', '2019-04-22 15:52:56', 'Booked');

--
-- Triggers `reserves`
--
DELIMITER $$
CREATE TRIGGER `seat_after_reserve` AFTER INSERT ON `reserves` FOR EACH ROW begin
   declare qty int;
   declare busid int;
   if(strcmp(new.status,"Booked")=0) then
      set qty=new.quantity;
      set busid=new.bid;
      update bus b set b.available=b.available-qty where b.id=busid;
   end if;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ticketID_insert` BEFORE INSERT ON `reserves` FOR EACH ROW BEGIN
  INSERT INTO ticket VALUES (NULL);
  SET NEW.ticketID = CONCAT('ENA', LPAD(LAST_INSERT_ID(), 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `id` int(10) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `price` int(6) NOT NULL,
  `routename` varchar(50) NOT NULL,
  `delete_status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`id`, `origin`, `destination`, `price`, `routename`, `delete_status`) VALUES
(1, 'Nairobi', 'Mombasa', 1200, 'Nairobi-Mombasa', '0'),
(2, 'Mombasa ', 'Nairobi', 1200, 'Mombasa-Nairobi', '0'),
(3, 'Migori', 'Nairobi', 800, 'Migori-Nairobi', '0'),
(4, 'Migori', 'Mombasa', 1600, 'Migori-Mombasa', '0'),
(5, 'Mombasa ', 'Migori', 1600, 'Mombasa-Migori', '0'),
(6, 'Nairobi', 'Migori', 800, 'Nairobi-Migori', '0'),
(7, 'Nairobi', 'Kisumu', 1200, 'Nairobi-Kisumu', '0'),
(8, 'Kisumu', 'Nairobi', 1200, 'Kisumu-Nairobi', '0');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Mabeya', 'mabeya@test.com', '$2y$10$m7M8sMHf0QuRhONaJic1JOKqggAJLtx0mc084P3YzAUuwnKBlfXh.', '2019-03-28 13:59:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mpesa_payments`
--
ALTER TABLE `mpesa_payments`
  ADD PRIMARY KEY (`auto`);

--
-- Indexes for table `reserves`
--
ALTER TABLE `reserves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mpesa_payments`
--
ALTER TABLE `mpesa_payments`
  MODIFY `auto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reserves`
--
ALTER TABLE `reserves`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
