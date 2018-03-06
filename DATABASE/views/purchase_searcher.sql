-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2018 at 12:38 PM
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
-- Structure for view `purchase_searcher`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchase_searcher`  AS  select `tbl_purchase_order`.`purchase_id` AS `purchase_id`,group_concat(`tbl_supplier`.`supplier_name` separator ', ') AS `supplier_name`,`tbl_purchase_order`.`Date_Ordered` AS `Date_Ordered`,group_concat(`tbl_product`.`product_name` separator ', ') AS `product_name`,`tbl_purchase_order`.`total_amount` AS `total_amount`,`tbl_purchase_order`.`total_payment` AS `total_payment`,`tbl_purchase_order`.`total_balance` AS `total_balance` from (((`tbl_purchase_detail` join `tbl_purchase_order` on((`tbl_purchase_detail`.`purchase_id` = `tbl_purchase_order`.`purchase_id`))) join `tbl_supplier` on((`tbl_purchase_detail`.`supplier_id` = `tbl_supplier`.`supplier_id`))) join `tbl_product` on((`tbl_purchase_detail`.`product_id` = `tbl_product`.`product_id`))) group by `tbl_purchase_order`.`purchase_id` ;

--
-- VIEW  `purchase_searcher`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
