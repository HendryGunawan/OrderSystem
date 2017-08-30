-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2017 at 04:23 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order`
--

-- --------------------------------------------------------

--
-- Table structure for table `folding_gates`
--

CREATE TABLE `folding_gates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `folding_gate_orders`
--

CREATE TABLE `folding_gate_orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `folding_gate_order_details`
--

CREATE TABLE `folding_gate_order_details` (
  `id` int(11) NOT NULL,
  `folding_gate_order_id` int(11) NOT NULL,
  `folding_gate_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `folding_gate_spareparts`
--

CREATE TABLE `folding_gate_spareparts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `folding_gate_sparepart_orders`
--

CREATE TABLE `folding_gate_sparepart_orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `folding_gate_sparepart_order_details`
--

CREATE TABLE `folding_gate_sparepart_order_details` (
  `id` int(11) NOT NULL,
  `folding_gate_sparepart_order_id` int(11) NOT NULL,
  `folding_gate_sparepart_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `good_receipt_folding_gates`
--

CREATE TABLE `good_receipt_folding_gates` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `thick` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `delete_flag` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `item_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `good_receipt_folding_gates`
--

INSERT INTO `good_receipt_folding_gates` (`id`, `item_id`, `thick`, `width`, `weight`, `length`, `delete_flag`, `created_at`, `updated_at`, `item_code`) VALUES
(1, 1, '0.4', '915', '600', '1.72386', 0, '2017-08-28 05:10:26', '2017-08-28 05:10:26', 'COIL A-04-915'),
(2, 2, '0.4', '913', '400', '1.1467280000000002', 0, '2017-08-28 05:10:41', '2017-08-28 05:10:41', 'COIL B-04-913');

-- --------------------------------------------------------

--
-- Table structure for table `good_receipt_rolling_doors`
--

CREATE TABLE `good_receipt_rolling_doors` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `thick` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `delete_flag` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `item_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `good_receipt_rolling_doors`
--

INSERT INTO `good_receipt_rolling_doors` (`id`, `item_id`, `thick`, `width`, `weight`, `length`, `delete_flag`, `created_at`, `updated_at`, `item_code`) VALUES
(1, 1, '0.4', '915', '500', '1.43655', 0, '2017-08-28 05:21:44', '2017-08-28 05:21:44', 'COIL A-04-915');

-- --------------------------------------------------------

--
-- Table structure for table `good_usage_folding_gates`
--

CREATE TABLE `good_usage_folding_gates` (
  `id` int(11) NOT NULL,
  `folding_gate_order_id` int(11) DEFAULT NULL,
  `delete_flag` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `good_usage_folding_gates`
--

INSERT INTO `good_usage_folding_gates` (`id`, `folding_gate_order_id`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-08-28 12:16:03', '2017-08-28 05:16:03'),
(2, 2, 0, '2017-08-28 05:15:50', '2017-08-28 05:15:50'),
(3, 1, 1, '2017-08-28 12:17:47', '2017-08-28 05:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `good_usage_folding_gate_details`
--

CREATE TABLE `good_usage_folding_gate_details` (
  `id` int(11) NOT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `length` double DEFAULT NULL,
  `good_usage_folding_gate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `good_usage_folding_gate_details`
--

INSERT INTO `good_usage_folding_gate_details` (`id`, `item_code`, `length`, `good_usage_folding_gate_id`) VALUES
(1, 'COIL A-04-915', 1, 1),
(2, 'COIL B-04-913', 0, 1),
(3, 'COIL B-04-913', 1, 2),
(4, 'COIL B-04-913', 0.02, 3);

-- --------------------------------------------------------

--
-- Table structure for table `good_usage_rolling_doors`
--

CREATE TABLE `good_usage_rolling_doors` (
  `id` int(11) NOT NULL,
  `rolling_door_order_id` int(11) DEFAULT NULL,
  `delete_flag` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `good_usage_rolling_doors`
--

INSERT INTO `good_usage_rolling_doors` (`id`, `rolling_door_order_id`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2017-08-28 05:22:33', '2017-08-28 05:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `good_usage_rolling_door_details`
--

CREATE TABLE `good_usage_rolling_door_details` (
  `id` int(11) NOT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `length` double DEFAULT NULL,
  `good_usage_rolling_door_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `good_usage_rolling_door_details`
--

INSERT INTO `good_usage_rolling_door_details` (`id`, `item_code`, `length`, `good_usage_rolling_door_id`) VALUES
(1, 'COIL A-04-915', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `delete_flag` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Coil A', 0, '2017-08-25 09:31:56', '2017-08-25 09:31:56'),
(2, 'Coil B', 0, '2017-08-25 09:32:00', '2017-08-25 09:32:00'),
(3, 'Coil C', 0, '2017-08-25 09:32:13', '2017-08-25 09:32:13'),
(4, 'Coil D', 0, '2017-08-25 09:32:15', '2017-08-25 09:32:15'),
(5, 'Coil E', 0, '2017-08-25 09:32:13', '2017-08-25 09:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 1),
(15, '2017_08_21_094544_create_folding_gate_table', 2),
(16, '2017_08_21_094708_create_folding_gate_spareparts_table', 2),
(17, '2017_08_21_094729_create_rolling_doors_spareparts_table', 2),
(18, '2017_08_21_094741_create_rolling_doors_table', 2),
(19, '2017_08_21_094902_create_units_table', 2),
(28, '2017_08_22_082724_create_folding_gate_orders_table', 3),
(29, '2017_08_22_082739_create_folding_gate_sparepart_orders_table', 3),
(30, '2017_08_22_082754_create_rolling_door_sparepart_orders_table', 3),
(31, '2017_08_22_082808_create_rolling_door_orders_table', 3),
(32, '2017_08_22_141001_create_folding_gate_order_details', 4),
(33, '2017_08_22_141223_create_folding_gate_sparepart_order_details', 4),
(34, '2017_08_22_141246_create_rolling_door_sparepart_order_details', 4),
(35, '2017_08_22_141306_create_rolling_door_order_details', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `delete_flag` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 0, '2017-08-26 17:50:41', '2017-08-26 17:50:52'),
(2, 'Admin Kasir', 0, '2017-08-26 17:50:41', '2017-08-26 17:50:41'),
(3, 'Admin Gudang Folding Gate', 0, '2017-08-26 17:50:41', '2017-08-26 17:50:41'),
(4, 'Admin Gudang Rolling Door', 0, '2017-08-26 17:50:42', '2017-08-26 17:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `rolling_doors`
--

CREATE TABLE `rolling_doors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rolling_door_orders`
--

CREATE TABLE `rolling_door_orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rolling_door_order_details`
--

CREATE TABLE `rolling_door_order_details` (
  `id` int(11) NOT NULL,
  `rolling_door_order_id` int(11) NOT NULL,
  `rolling_door_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rolling_door_spareparts`
--

CREATE TABLE `rolling_door_spareparts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rolling_door_sparepart_orders`
--

CREATE TABLE `rolling_door_sparepart_orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `grand_total` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rolling_door_sparepart_order_details`
--

CREATE TABLE `rolling_door_sparepart_order_details` (
  `id` int(11) NOT NULL,
  `rolling_door_sparepart_order_id` int(11) NOT NULL,
  `rolling_door_sparepart_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `delete_flag`) VALUES
(1, 'Meter', 0),
(2, 'Btg', 0),
(3, 'Bh', 0),
(4, 'Set', 0),
(5, 'Roll', 0),
(6, 'Kantong', 0),
(7, 'Dus', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Super Admin', 'super_admin', '$2y$10$Tz21JUp9BOgX3c1u3.t57erhdgnauLvV6cQI4yQ1hd518sae0ud76', 'qEyMsrhlK3un5feZoj2MfAIQykMma63wk7wc9PFRQ1AJT4oyKOFJ1PEVVuV7', '2017-08-21 09:58:53', '2017-08-28 04:56:34', 1),
(2, 'Admin', 'admin', '$2y$10$1Yl98hNTSfKniLt4A5QV1uyXAE6uYWZ0gAzHIaySRWsqVE67g/E/O', 'wSeVfFpQingb1BAn25XYsidlq3cQ8J3qbIGzSZwEUGalJbyDIurnhkPkwaSB', '2017-08-23 07:42:16', '2017-08-23 08:11:12', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `folding_gates`
--
ALTER TABLE `folding_gates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folding_gate_orders`
--
ALTER TABLE `folding_gate_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folding_gate_order_details`
--
ALTER TABLE `folding_gate_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folding_gate_spareparts`
--
ALTER TABLE `folding_gate_spareparts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folding_gate_sparepart_orders`
--
ALTER TABLE `folding_gate_sparepart_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folding_gate_sparepart_order_details`
--
ALTER TABLE `folding_gate_sparepart_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_receipt_folding_gates`
--
ALTER TABLE `good_receipt_folding_gates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_receipt_rolling_doors`
--
ALTER TABLE `good_receipt_rolling_doors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_usage_folding_gates`
--
ALTER TABLE `good_usage_folding_gates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_usage_folding_gate_details`
--
ALTER TABLE `good_usage_folding_gate_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_usage_rolling_doors`
--
ALTER TABLE `good_usage_rolling_doors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_usage_rolling_door_details`
--
ALTER TABLE `good_usage_rolling_door_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolling_doors`
--
ALTER TABLE `rolling_doors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolling_door_orders`
--
ALTER TABLE `rolling_door_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolling_door_order_details`
--
ALTER TABLE `rolling_door_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolling_door_spareparts`
--
ALTER TABLE `rolling_door_spareparts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolling_door_sparepart_orders`
--
ALTER TABLE `rolling_door_sparepart_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolling_door_sparepart_order_details`
--
ALTER TABLE `rolling_door_sparepart_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
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
-- AUTO_INCREMENT for table `folding_gates`
--
ALTER TABLE `folding_gates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `folding_gate_orders`
--
ALTER TABLE `folding_gate_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `folding_gate_order_details`
--
ALTER TABLE `folding_gate_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `folding_gate_spareparts`
--
ALTER TABLE `folding_gate_spareparts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `folding_gate_sparepart_orders`
--
ALTER TABLE `folding_gate_sparepart_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `folding_gate_sparepart_order_details`
--
ALTER TABLE `folding_gate_sparepart_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `good_receipt_folding_gates`
--
ALTER TABLE `good_receipt_folding_gates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `good_receipt_rolling_doors`
--
ALTER TABLE `good_receipt_rolling_doors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `good_usage_folding_gates`
--
ALTER TABLE `good_usage_folding_gates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `good_usage_folding_gate_details`
--
ALTER TABLE `good_usage_folding_gate_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `good_usage_rolling_doors`
--
ALTER TABLE `good_usage_rolling_doors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `good_usage_rolling_door_details`
--
ALTER TABLE `good_usage_rolling_door_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rolling_doors`
--
ALTER TABLE `rolling_doors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rolling_door_orders`
--
ALTER TABLE `rolling_door_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rolling_door_order_details`
--
ALTER TABLE `rolling_door_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rolling_door_spareparts`
--
ALTER TABLE `rolling_door_spareparts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rolling_door_sparepart_orders`
--
ALTER TABLE `rolling_door_sparepart_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rolling_door_sparepart_order_details`
--
ALTER TABLE `rolling_door_sparepart_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
