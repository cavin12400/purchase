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

-- --------------------------------------------------------

--
-- Structure for view `purchase_detailed_view`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_detailed_view`  AS  select `tbl_purchase_order`.`purchase_id` AS `purchase_id`,group_concat(distinct `tbl_purchase_detail`.`supplier_id` separator ', ') AS `supplier_id`,`tbl_purchase_order`.`notes` AS `notes`,`tbl_purchase_order`.`total_amount` AS `total_amount`,`tbl_purchase_order`.`Date_Ordered` AS `Date_Ordered`,`tbl_employee`.`employee_name` AS `Added_by`,`tbl_purchase_order`.`Date_updated` AS `Date_updated`,`tbl_employee`.`employee_name` AS `Update_by` from ((`tbl_purchase_order` join `tbl_employee` on((`tbl_purchase_order`.`employee_id` = `tbl_employee`.`employee_id`))) join `tbl_purchase_detail` on((`tbl_purchase_order`.`purchase_id` = `tbl_purchase_detail`.`purchase_id`))) group by `tbl_purchase_order`.`purchase_id` ;

--
-- VIEW  `purchase_detailed_view`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
