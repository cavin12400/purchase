-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2018 at 12:37 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cleanDetail` ()  BEGIN

DELETE from tbl_purchase_detail where tbl_purchase_detail.qty_IN=0;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatetotal` (IN `purchase_id` INT(8) UNSIGNED ZEROFILL)  BEGIN
UPDATE tbl_purchase_order SET total_payment=total_amount-total_balance WHERE purchase_id=purchase_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `purchase_detailed_view`
-- (See below for the actual view)
--
CREATE TABLE `purchase_detailed_view` (
`purchase_id` int(8) unsigned zerofill
,`supplier_id` text
,`notes` text
,`total_amount` int(50)
,`Date_Ordered` date
,`Added_by` varchar(50)
,`Date_updated` date
,`Update_by` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `purchase_searcher`
-- (See below for the actual view)
--
CREATE TABLE `purchase_searcher` (
`purchase_id` int(8) unsigned zerofill
,`supplier_name` text
,`Date_Ordered` date
,`product_name` text
,`total_amount` int(50)
,`total_payment` int(50)
,`total_balance` int(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `customer_name` text NOT NULL,
  `address` text NOT NULL,
  `age` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emploeequota`
--

CREATE TABLE `tbl_emploeequota` (
  `employee_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `worked` int(8) NOT NULL,
  `quota_date` date NOT NULL,
  `quota` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employee_id`, `employee_name`, `position`, `contact`, `address`) VALUES
(00000000, 'CEO', 'SUPERUSER', '', ''),
(00000001, 'Cavin Pabua', 'Cashier', '09161510922', 'zone 6 Bulua');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderline`
--

CREATE TABLE `tbl_orderline` (
  `orderline_ID` int(8) UNSIGNED ZEROFILL NOT NULL,
  `order_ID` int(8) UNSIGNED ZEROFILL NOT NULL,
  `qty` int(11) NOT NULL,
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `orderID` int(8) UNSIGNED ZEROFILL NOT NULL,
  `discount` varchar(8) NOT NULL,
  `date_purchased` date NOT NULL,
  `customer_id` int(8) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` int(8) NOT NULL,
  `description` text NOT NULL,
  `supplier_id` int(8) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_price`, `description`, `supplier_id`) VALUES
(00000001, 'Piatos', 15, 'This is a large piatos. Yummy', 00000000),
(00000002, 'muncher', 100, 'mucher ni sita', 00000000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_inventory`
--

CREATE TABLE `tbl_product_inventory` (
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `expiry_date` date NOT NULL,
  `reorder_point` int(8) NOT NULL,
  `DateArrived` date NOT NULL,
  `DateOUT` date NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `retail_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_detail`
--

CREATE TABLE `tbl_purchase_detail` (
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `supplier_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `purchase_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `qty_IN` int(11) NOT NULL,
  `total_amount` int(50) NOT NULL,
  `purchase_price` int(50) NOT NULL,
  `selling_price` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_detail`
--

INSERT INTO `tbl_purchase_detail` (`product_id`, `supplier_id`, `purchase_id`, `qty_IN`, `total_amount`, `purchase_price`, `selling_price`) VALUES
(00000001, 00000002, 00000002, 32, 96, 3, 3),
(00000002, 00000000, 00000003, 4, 16, 4, 4),
(00000002, 00000000, 00000004, 1, 1, 1, 1),
(00000002, 00000000, 00000006, 1, 34, 34, 2),
(00000002, 00000000, 00000007, 1, 2, 2, 2),
(00000002, 00000000, 00000008, 1, 3, 3, 3),
(00000002, 00000000, 00000009, 23, 483, 21, 23),
(00000002, 00000000, 00000011, 3, 9, 3, 3),
(00000002, 00000000, 00000012, 4, 16, 4, 4),
(00000002, 00000000, 00000013, 4, 176, 44, 4),
(00000002, 00000000, 00000015, 6, 36, 6, 6),
(00000002, 00000000, 00000017, 1, 1, 1, 0),
(00000002, 00000000, 00000018, 2, 6, 3, 3),
(00000001, 00000002, 00000019, 24, 576, 24, 55),
(00000002, 00000000, 00000019, 55, 3025, 55, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order`
--

CREATE TABLE `tbl_purchase_order` (
  `purchase_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `Date_Ordered` date NOT NULL,
  `employee_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `Date_updated` date NOT NULL,
  `Updated_by` int(8) UNSIGNED ZEROFILL NOT NULL,
  `total_amount` int(50) NOT NULL,
  `total_payment` int(50) NOT NULL,
  `total_balance` int(50) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_purchase_order`
--

INSERT INTO `tbl_purchase_order` (`purchase_id`, `Date_Ordered`, `employee_id`, `Date_updated`, `Updated_by`, `total_amount`, `total_payment`, `total_balance`, `notes`) VALUES
(00000001, '2018-03-20', 00000001, '2018-03-13', 00000000, 0, 0, 0, 'dummy DATA'),
(00000002, '2018-03-17', 00000001, '2018-03-04', 00000000, 96, 50, 46, 'NOTED SHIT!'),
(00000003, '2018-03-17', 00000001, '2018-03-03', 00000000, 16, 16, 0, '4'),
(00000004, '2018-03-31', 00000001, '2018-03-03', 00000000, 1, 1, 0, 'YAWA KA!'),
(00000006, '2018-03-31', 00000001, '2018-03-03', 00000000, 34, 34, 0, '2'),
(00000007, '2018-03-31', 00000001, '2018-03-03', 00000000, 2, 2, 0, '2'),
(00000008, '2018-03-24', 00000001, '2018-03-03', 00000000, 3, 3, 0, '3'),
(00000009, '2018-05-18', 00000001, '2018-03-04', 00000000, 483, 483, 0, '2321'),
(00000011, '2018-03-23', 00000001, '2018-03-03', 00000000, 9, 3, 6, '33'),
(00000012, '2018-03-17', 00000001, '2018-03-03', 00000000, 16, 14, 2, '3'),
(00000013, '2018-03-31', 00000001, '2018-03-03', 00000000, 176, 176, 0, '4234'),
(00000014, '2018-03-23', 00000001, '2018-03-04', 00000000, 2, 2, 0, '75'),
(00000015, '2018-03-30', 00000001, '2018-03-04', 00000000, 36, 35, 1, 'NEW NEW NEW!'),
(00000016, '2018-03-15', 00000001, '2018-03-04', 00000000, 9, 9, 0, 'CAVIN CAVIN CAVIN!'),
(00000017, '2018-03-24', 00000001, '2018-03-04', 00000000, 1, 1, 0, 'ttyu'),
(00000018, '2018-03-31', 00000001, '2018-03-04', 00000000, 6, 6, 0, 'NEW SET!'),
(00000019, '2018-04-26', 00000001, '2018-03-04', 00000000, 3601, 3601, 0, 'Double supplier');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `sale_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `employee_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `orderline_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `TotalSales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `supplier_name`, `contact`, `email`, `address`) VALUES
(00000000, 'jack n jill', '09264534963', 'jacknjill@off.com', 'Zone 5 Bulua, CDO'),
(00000002, 'Nestle', '452458575', 'nestle@gmail.com', 'Terrific!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_agent`
--

CREATE TABLE `tbl_supplier_agent` (
  `agent_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `supplier_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `agent_name` varchar(50) NOT NULL,
  `agent_email` varchar(50) NOT NULL,
  `agent_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `purchase_detailed_view`
--
DROP TABLE IF EXISTS `purchase_detailed_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_detailed_view`  AS  select `tbl_purchase_order`.`purchase_id` AS `purchase_id`,group_concat(distinct `tbl_purchase_detail`.`supplier_id` separator ', ') AS `supplier_id`,`tbl_purchase_order`.`notes` AS `notes`,`tbl_purchase_order`.`total_amount` AS `total_amount`,`tbl_purchase_order`.`Date_Ordered` AS `Date_Ordered`,`tbl_employee`.`employee_name` AS `Added_by`,`tbl_purchase_order`.`Date_updated` AS `Date_updated`,`tbl_employee`.`employee_name` AS `Update_by` from ((`tbl_purchase_order` join `tbl_employee` on((`tbl_purchase_order`.`employee_id` = `tbl_employee`.`employee_id`))) join `tbl_purchase_detail` on((`tbl_purchase_order`.`purchase_id` = `tbl_purchase_detail`.`purchase_id`))) group by `tbl_purchase_order`.`purchase_id` ;

-- --------------------------------------------------------

--
-- Structure for view `purchase_searcher`
--
DROP TABLE IF EXISTS `purchase_searcher`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_searcher`  AS  select `tbl_purchase_order`.`purchase_id` AS `purchase_id`,group_concat(`tbl_supplier`.`supplier_name` separator ', ') AS `supplier_name`,`tbl_purchase_order`.`Date_Ordered` AS `Date_Ordered`,group_concat(`tbl_product`.`product_name` separator ', ') AS `product_name`,`tbl_purchase_order`.`total_amount` AS `total_amount`,`tbl_purchase_order`.`total_payment` AS `total_payment`,`tbl_purchase_order`.`total_balance` AS `total_balance` from (((`tbl_purchase_detail` join `tbl_purchase_order` on((`tbl_purchase_detail`.`purchase_id` = `tbl_purchase_order`.`purchase_id`))) join `tbl_supplier` on((`tbl_purchase_detail`.`supplier_id` = `tbl_supplier`.`supplier_id`))) join `tbl_product` on((`tbl_purchase_detail`.`product_id` = `tbl_product`.`product_id`))) group by `tbl_purchase_order`.`purchase_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_emploeequota`
--
ALTER TABLE `tbl_emploeequota`
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_orderline`
--
ALTER TABLE `tbl_orderline`
  ADD PRIMARY KEY (`orderline_ID`),
  ADD KEY `order_ID` (`order_ID`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `tbl_product_inventory`
--
ALTER TABLE `tbl_product_inventory`
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_purchase_detail`
--
ALTER TABLE `tbl_purchase_detail`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `purchase_id` (`purchase_id`);

--
-- Indexes for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `Updated_by` (`Updated_by`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `orderline_id` (`orderline_id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tbl_supplier_agent`
--
ALTER TABLE `tbl_supplier_agent`
  ADD PRIMARY KEY (`agent_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_orderline`
--
ALTER TABLE `tbl_orderline`
  MODIFY `orderline_ID` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `orderID` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  MODIFY `purchase_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `sale_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_supplier_agent`
--
ALTER TABLE `tbl_supplier_agent`
  MODIFY `agent_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_emploeequota`
--
ALTER TABLE `tbl_emploeequota`
  ADD CONSTRAINT `tbl_emploeequota_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_orderline`
--
ALTER TABLE `tbl_orderline`
  ADD CONSTRAINT `tbl_orderline_ibfk_1` FOREIGN KEY (`order_ID`) REFERENCES `tbl_order_details` (`orderID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_orderline_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`customer_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_product_inventory`
--
ALTER TABLE `tbl_product_inventory`
  ADD CONSTRAINT `tbl_product_inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_purchase_detail`
--
ALTER TABLE `tbl_purchase_detail`
  ADD CONSTRAINT `tbl_purchase_detail_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_purchase_detail_ibfk_4` FOREIGN KEY (`purchase_id`) REFERENCES `tbl_purchase_order` (`purchase_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD CONSTRAINT `tbl_purchase_order_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD CONSTRAINT `tbl_sales_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `tbl_employee` (`employee_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sales_ibfk_2` FOREIGN KEY (`orderline_id`) REFERENCES `tbl_orderline` (`orderline_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_supplier_agent`
--
ALTER TABLE `tbl_supplier_agent`
  ADD CONSTRAINT `tbl_supplier_agent_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `tbl_supplier` (`supplier_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
