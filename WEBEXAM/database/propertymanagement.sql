-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propertymanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `Expense_id` int(11) NOT NULL,
  `Property_id` int(11) DEFAULT NULL,
  `Expense_type` varchar(50) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Date_incurred` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`Expense_id`, `Property_id`, `Expense_type`, `Amount`, `Date_incurred`) VALUES
(1, 1, 'washing', 10000.00, '2024-05-07'),
(2, 2, 'Electricity', 20000.00, '2024-05-06'),
(3, 2, 'Electricity', 20000.00, '2024-05-06'),
(4, 1, 'Water', 30900.00, '2024-05-06'),
(5, 1, 'Water', 350000.00, '2024-05-06'),
(6, 1, 'Water', 300000.00, '2024-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `payment_id`, `invoice_date`, `amount`, `description`) VALUES
(2, 1, '2024-05-09', 256688.00, 'Security Deposit Refund'),
(3, 2, '2024-05-10', 80000.00, 'Late Fee for Missed Payment'),
(5, 2, '2024-05-10', 260000.00, 'Invoice for February 2024 rent'),
(7, 2, '2024-05-09', 46000.00, 'Invoice for January 2024 rent'),
(23, 4, '2024-05-10', 380000.00, 'invoice for May 2024 rent');

-- --------------------------------------------------------

--
-- Table structure for table `leases`
--

CREATE TABLE `leases` (
  `Lease_id` int(11) NOT NULL,
  `Unit_id` int(11) DEFAULT NULL,
  `Tenant_id` int(11) DEFAULT NULL,
  `Lease_start_date` date DEFAULT NULL,
  `Lease_end_date` date DEFAULT NULL,
  `Monthly_rent` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leases`
--

INSERT INTO `leases` (`Lease_id`, `Unit_id`, `Tenant_id`, `Lease_start_date`, `Lease_end_date`, `Monthly_rent`) VALUES
(1, 1, 1, '2024-05-10', '2024-05-23', 4000000.00),
(2, 2, 1, '2024-05-06', '2024-05-23', 50000.00),
(3, 2, 1, '2024-05-17', '2024-05-30', 75000.00),
(4, 2, 2, '0000-00-00', '2024-06-07', 30000.00),
(5, 3, 2, '0000-00-00', '2024-05-24', 500000.00),
(7, 2, 3, '0000-00-00', '2024-06-04', 567000.00);

-- --------------------------------------------------------

--
-- Table structure for table `maintenancerequests`
--

CREATE TABLE `maintenancerequests` (
  `Request_id` int(11) NOT NULL,
  `Unit_id` int(11) DEFAULT NULL,
  `Tenant_id` int(11) DEFAULT NULL,
  `Request_date` date DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL,
  `Assigned_to` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenancerequests`
--

INSERT INTO `maintenancerequests` (`Request_id`, `Unit_id`, `Tenant_id`, `Request_date`, `Description`, `Status`, `Assigned_to`) VALUES
(1, 1, 1, '2024-05-01', 'Destruction of batterry', 'occupied', 0),
(2, 2, 1, '2024-05-07', 'Leaking pipe under the kitchen sink', 'Open', 2),
(3, 1, 1, '2024-05-09', 'Removed of hause. Needs replacement of new', 'open', 1),
(5, 1, 1, '2024-05-06', 'Electrical outlets in the bedroom are not working', 'completed', 4),
(6, 1, 1, '2024-05-05', 'Ceiling fan in the living room is wobbling', 'closed', 5),
(7, 3, 2, '2024-05-09', 'Ceiling fan wobbling. Needs balancing or replacement.', 'Open', 1),
(8, 1, 2, '2024-05-09', 'Electrical outlets in bedroom not working. Suspected wiring issue.', 'In Progress', 1),
(12, 2, 1, '2024-05-09', 'Air conditioning not cooling properly', 'Open', 8),
(13, 1, 2, '2024-05-23', 'Ceiling fan wobbling. Needs balancing or replacement.', 'Open', 8);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `Owner_id` int(11) NOT NULL,
  `First_name` varchar(50) DEFAULT NULL,
  `Last_name` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Company` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`Owner_id`, `First_name`, `Last_name`, `Email`, `Phone`, `Address`, `Company`) VALUES
(1, 'Paul', 'Habimana', 'paul7@gm.com', '078945678', 'Kigali', 'RDB'),
(2, 'Aline', 'Akeza', 'akeza@gmail.com', '078234567', 'Huye', 'GP campany ltd'),
(4, 'Fidele', 'Kamana', 'kamana@gmail.com', '0789357878', 'Kirehe', 'ASPK'),
(5, 'Rashid', 'Kalisa', 'kalisa@gmail.com', '078934567', 'Karongi', 'RHY'),
(7, 'Anne', 'Uwimana', 'anne12@gmail.com', '07267668879', 'Kicukiro', 'QWE'),
(8, 'Samson', 'Kaneza', 'samson@gmail.com', '0781737890', 'Nyarugenge', 'FGYU ltd'),
(9, 'Agnes', 'uwineza', 'uwineza@gmail.com', '0723444567', 'Rusizi', 'CUP campany ltd');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `Property_id` int(11) NOT NULL,
  `Owner_id` int(11) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Property_type` varchar(50) DEFAULT NULL,
  `Number_of_units` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`Property_id`, `Owner_id`, `Address`, `Property_type`, `Number_of_units`) VALUES
(1, 1, 'Rulindo Lf', 'Car', 34),
(2, 2, 'Kigali', 'Hause', 4),
(3, 2, 'Kayonza', 'Computer', 23),
(4, 5, 'nyanza', 'hauses', 30),
(5, 1, 'Nyagatare', 'motorclycle', 60),
(8, 5, 'Nyarugenge', 'hauses', 60),
(9, 2, 'Muhanga', 'Computer', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `propertyinspections`
--

CREATE TABLE `propertyinspections` (
  `Inspection_id` int(11) NOT NULL,
  `Property_id` int(11) DEFAULT NULL,
  `Inspection_date` date DEFAULT NULL,
  `Inspector` varchar(50) DEFAULT NULL,
  `Notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propertyinspections`
--

INSERT INTO `propertyinspections` (`Inspection_id`, `Property_id`, `Inspection_date`, `Inspector`, `Notes`) VALUES
(2, 3, '2024-05-10', 'MN', 'great great'),
(3, 1, '2024-05-08', 'JRDTTYE', 'Nice'),
(4, 2, '2024-05-23', 'JEPK', 'EWRG'),
(5, 3, '2024-05-24', 'MGOP', 'well '),
(6, 4, '2024-05-14', 'OOPP', 'ggggg');

-- --------------------------------------------------------

--
-- Table structure for table `rentpayments`
--

CREATE TABLE `rentpayments` (
  `Payment_id` int(11) NOT NULL,
  `Lease_id` int(11) DEFAULT NULL,
  `Payment_date` date DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Payment_method` varchar(20) DEFAULT NULL,
  `Payment_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentpayments`
--

INSERT INTO `rentpayments` (`Payment_id`, `Lease_id`, `Payment_date`, `Amount`, `Payment_method`, `Payment_status`) VALUES
(1, 1, '2024-05-02', 40000.00, 'credit card', 'Paid'),
(2, 2, '2024-05-01', 50000.00, 'Airtel Money', 'Inacctive'),
(4, 2, '2024-04-30', 30000.00, 'Momo Pay', 'Paid'),
(5, 2, '2024-05-07', 56000.00, 'credit card', 'complited'),
(6, 2, '2024-05-07', 56000.00, 'credit card', 'Pending'),
(7, 1, '2024-05-08', 40000.00, 'Bank Transfer', 'complited');

-- --------------------------------------------------------

--
-- Table structure for table `re_users`
--

CREATE TABLE `re_users` (
  `registration_user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `referral_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `re_users`
--

INSERT INTO `re_users` (`registration_user_id`, `first_name`, `last_name`, `date_of_birth`, `username`, `email`, `password`, `phone`, `referral_code`) VALUES
(4, 'Omeli', 'Kaneza', '2000-02-04', 'kanaeza', 'kaneza@gmail.com', '$2y$10$ItNNLGcfEdzsFB9NZKvtg.78MedhgnH8qIquT3LdvW6wndzx/5Mue', '0784567899', '22333'),
(5, 'Anne', 'Iradukunda', '1999-12-04', 'anne', 'iradukunda@gmail.com', '$2y$10$l79sfD.47WKzhSBkZoBojeoXAo3cK63SpIeBgQO2Ny7CAZWD8Eqdm', '0728944839', '34563'),
(6, 'Anitha', 'Umuhoza', '2006-12-03', 'anitha', 'umuhoza@gmail.com', '$2y$10$tj1zyzknkFSWlqsANCm5M.Y5lpbbw37lAueRThpCQKwkS9d3CRad.', '0789366767', '11111'),
(7, 'Chris', 'Kamana', '2000-02-03', 'chris', 'kamana12@gmail.com', '$2y$10$4xhBxl06iQ6/5RsT0lOZDuFUL2g0ixHhUn0U7HcGKJXG7VCV8TZVO', '0789034679', '56789'),
(8, 'Samson', 'Kaneza', '1999-12-04', 'kaneza', 'samson@gmail.com', '$2y$10$fr4gmWoF3WcUCP0lTUbaden2hTuWKKBC1vVt6P9QuvOEYK2PnNjQq', '0781737890', '5656'),
(9, 'Emile', 'Habimana', '1999-02-21', 'emile', 'emile12@7gmail.com', '$2y$10$rIKDg6B1jvWaefhhH8Qujun9dNc5v3II7Zia3sicJbXCBWgNBBLAy', '0738956784', '23674'),
(10, 'Eugene', 'Hakizimana', '2003-02-04', 'hakizimana', 'hakizimznz@gmail.com', '$2y$10$pstG/SvE4l3/JPKeILkHR.D.ejY59K1gqoeuJVKcTSnxEGpP0nWqa', '0788834567', '5500'),
(11, 'iijop[p9u', 'uyio[up90', '1670-01-01', 'ertyn', 'damourjean@gmail.com', '$2y$10$iFNDysorjQLdRu2TXIETTup5m3muXRVVBNHQhxkLCgQK7OkayBvju', '0789567890', '222333'),
(12, 'Hakim', 'Habineza', '2005-03-04', 'hakim', 'habineza@gmail.com', '$2y$10$J8K9MSbVgZAXiLg2/gA/QuucQOMflAphVpoN9cbyjTPRVn9LZOJ.6', '0788455678', '89000'),
(13, 'Agnes ', 'uwineza', '1998-01-02', 'uwineza', 'uwineza@gmail.com', '$2y$10$u6Vz0par.Du7N4IAbnr7nOl.tzWOX7ks0V6GL25HHuDsFAbU1DhDC', '0723444567', '2200'),
(14, 'Anne', 'Kamaliza', '2000-02-04', 'anne', 'kamaliza@gmail.com', '$2y$10$I/I7U2qZBXDXzq.0wp4hDetAKgsZogsUCBo5UHhauDMXCeqJj.zhW', '0788888888', '40000'),
(15, 'Anne', 'Kamaliza', '2000-02-04', 'anne', 'kamaliza12@gmail.com', '$2y$10$SnXWFksGnl/6IZLfVOY7du8qVuYNsfWRpROuhz0o0YmZta2Allk4e', '0788888888', '40000');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `Technician_id` int(11) NOT NULL,
  `First_name` varchar(50) DEFAULT NULL,
  `Last_name` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Specialty` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`Technician_id`, `First_name`, `Last_name`, `Email`, `Phone`, `Specialty`) VALUES
(1, 'Maria', 'Kaliza', 'kaliza@gmail.come', '0789235677', 'plumbling'),
(2, 'Jeannette', 'Kam', 'kam@gmail.com', '078345566', 'Electrical'),
(3, 'Anitha', 'Umuhoza', 'umuhoza@gmail.com', '0789366767', 'Mechanic'),
(4, 'Emile', 'Habimana', 'emile12@7gmail.com', '0738956784', 'Constructing');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `Tenant_id` int(11) NOT NULL,
  `First_name` varchar(50) DEFAULT NULL,
  `Last_name` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `Lease_start_date` date DEFAULT NULL,
  `Lease_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`Tenant_id`, `First_name`, `Last_name`, `Email`, `Phone`, `Address`, `Lease_start_date`, `Lease_end_date`) VALUES
(1, 'Jean Paul', 'NJP', 'jean12@gmail.com', '078345689', 'Karongi', '2024-05-18', '2024-06-08'),
(2, 'Orala', 'Akamikazi', 'oral@gmail.com', '072345678', 'Rubavu', '2024-08-31', '2025-03-29'),
(3, 'Peter', 'Uwimana', '222015155bit@gmail.com', '078956567', 'Musanze', '2024-05-21', '2024-09-06'),
(6, 'Angelique', 'uwayezu', 'uwayezu@gmail.com', '0723556588', 'Huye', '2024-05-15', '2024-06-08'),
(7, 'Eugene', 'Hakizimana', 'hakizimznz@gmail.com', 'o788834567', 'Musanze', '2024-05-23', '2024-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `Unit_id` int(11) NOT NULL,
  `Property_id` int(11) DEFAULT NULL,
  `Unit_number` varchar(10) DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`Unit_id`, `Property_id`, `Unit_number`, `Status`) VALUES
(1, 2, '2', 'Complete'),
(2, 1, '4', 'cars'),
(3, 1, '6', 'Complete'),
(5, 1, '5', 'occupied'),
(6, 2, '12', 'occupied'),
(7, 4, '1', 'occupied'),
(8, 1, '4', 'occupied'),
(10, 1, '23', 'occupied');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`Expense_id`),
  ADD KEY `Property_id` (`Property_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `leases`
--
ALTER TABLE `leases`
  ADD PRIMARY KEY (`Lease_id`),
  ADD KEY `Unit_id` (`Unit_id`),
  ADD KEY `Tenant_id` (`Tenant_id`);

--
-- Indexes for table `maintenancerequests`
--
ALTER TABLE `maintenancerequests`
  ADD PRIMARY KEY (`Request_id`),
  ADD KEY `Unit_id` (`Unit_id`),
  ADD KEY `Tenant_id` (`Tenant_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`Owner_id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`Property_id`),
  ADD KEY `Owner_id` (`Owner_id`);

--
-- Indexes for table `propertyinspections`
--
ALTER TABLE `propertyinspections`
  ADD PRIMARY KEY (`Inspection_id`),
  ADD KEY `Property_id` (`Property_id`);

--
-- Indexes for table `rentpayments`
--
ALTER TABLE `rentpayments`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `Lease_id` (`Lease_id`);

--
-- Indexes for table `re_users`
--
ALTER TABLE `re_users`
  ADD PRIMARY KEY (`registration_user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`Technician_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`Tenant_id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`Unit_id`),
  ADD KEY `Property_id` (`Property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `Expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `leases`
--
ALTER TABLE `leases`
  MODIFY `Lease_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `maintenancerequests`
--
ALTER TABLE `maintenancerequests`
  MODIFY `Request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `Owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `Property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `propertyinspections`
--
ALTER TABLE `propertyinspections`
  MODIFY `Inspection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rentpayments`
--
ALTER TABLE `rentpayments`
  MODIFY `Payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `re_users`
--
ALTER TABLE `re_users`
  MODIFY `registration_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `Technician_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `Tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `Unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`Property_id`) REFERENCES `properties` (`Property_id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `rentpayments` (`Payment_id`);

--
-- Constraints for table `leases`
--
ALTER TABLE `leases`
  ADD CONSTRAINT `leases_ibfk_1` FOREIGN KEY (`Unit_id`) REFERENCES `units` (`Unit_id`),
  ADD CONSTRAINT `leases_ibfk_2` FOREIGN KEY (`Tenant_id`) REFERENCES `tenants` (`Tenant_id`);

--
-- Constraints for table `maintenancerequests`
--
ALTER TABLE `maintenancerequests`
  ADD CONSTRAINT `maintenancerequests_ibfk_1` FOREIGN KEY (`Unit_id`) REFERENCES `units` (`Unit_id`),
  ADD CONSTRAINT `maintenancerequests_ibfk_2` FOREIGN KEY (`Tenant_id`) REFERENCES `tenants` (`Tenant_id`);

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`Owner_id`) REFERENCES `owners` (`Owner_id`);

--
-- Constraints for table `propertyinspections`
--
ALTER TABLE `propertyinspections`
  ADD CONSTRAINT `propertyinspections_ibfk_1` FOREIGN KEY (`Property_id`) REFERENCES `properties` (`Property_id`);

--
-- Constraints for table `rentpayments`
--
ALTER TABLE `rentpayments`
  ADD CONSTRAINT `rentpayments_ibfk_1` FOREIGN KEY (`Lease_id`) REFERENCES `leases` (`Lease_id`);

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_ibfk_1` FOREIGN KEY (`Property_id`) REFERENCES `properties` (`Property_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
