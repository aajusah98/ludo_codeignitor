-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 24, 2021 at 05:13 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ludobattles`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(100) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `match_details`
--

CREATE TABLE `match_details` (
  `M_id` int(255) NOT NULL,
  `Match_SetBy` int(255) NOT NULL,
  `play_requested_By` int(255) NOT NULL DEFAULT 0,
  `Bet_Amount` int(255) NOT NULL,
  `Match_Set_On` timestamp NOT NULL DEFAULT current_timestamp(),
  `Match_Update_On` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Match_Status` int(255) NOT NULL DEFAULT 1,
  `match_requested` int(100) NOT NULL DEFAULT 0,
  `match_accept_status` int(11) NOT NULL DEFAULT 0,
  `result_of_match` int(255) NOT NULL DEFAULT 0,
  `play_status` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `match_result`
--

CREATE TABLE `match_result` (
  `reslt_id` int(255) NOT NULL,
  `win_status` varchar(255) DEFAULT NULL,
  `Loss_Status` varchar(255) DEFAULT NULL,
  `Result_updated_by` varchar(255) NOT NULL,
  `match_id` varchar(255) NOT NULL,
  `screenshot_link` varchar(255) DEFAULT NULL,
  `cancle_status` varchar(255) DEFAULT NULL,
  `cancle_reason` varchar(255) DEFAULT NULL,
  `result_status` int(255) NOT NULL DEFAULT 0,
  `paymet_check_flag` int(255) NOT NULL DEFAULT 0,
  `fault_result_flag` int(255) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `uid` int(255) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `whatsapp_num` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `refferal` varchar(200) NOT NULL,
  `money_wallet` varchar(255) NOT NULL DEFAULT '0',
  `expiry_pass_token` varchar(255) DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `players_login_deatils`
--

CREATE TABLE `players_login_deatils` (
  `login_details_id` int(255) NOT NULL,
  `player_id` int(255) NOT NULL,
  `last_activity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `refferal_earning`
--

CREATE TABLE `refferal_earning` (
  `id` int(200) NOT NULL,
  `referrer_owner` int(200) NOT NULL,
  `Bet_Amount` int(200) NOT NULL,
  `Referral_Earning` varchar(200) NOT NULL,
  `referred_user` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room_ids`
--

CREATE TABLE `room_ids` (
  `id` int(255) NOT NULL,
  `room_ID` varchar(255) NOT NULL,
  `Room_created_By` varchar(255) NOT NULL,
  `match_id` int(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `roomId_update_flag` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_transaction_history`
--

CREATE TABLE `user_transaction_history` (
  `tid` int(255) NOT NULL,
  `userId` int(200) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `ORDERID` varchar(255) NOT NULL,
  `MID` varchar(255) NOT NULL,
  `TXNID` varchar(255) NOT NULL,
  `TXNAMOUNT` varchar(255) NOT NULL,
  `PAYMENTMODE` varchar(255) NOT NULL,
  `CURRENCY` varchar(255) NOT NULL,
  `TXNDATE` varchar(255) NOT NULL,
  `STATUS` varchar(255) NOT NULL,
  `RESPCODE` varchar(255) NOT NULL,
  `RESPMSG` varchar(255) NOT NULL,
  `GATEWAYNAME` varchar(255) NOT NULL,
  `BANKTXNID` varchar(255) NOT NULL,
  `BANKNAME` varchar(255) NOT NULL,
  `CHECKSUMHASH` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_request`
--

CREATE TABLE `withdrawal_request` (
  `withdrawal_id` int(100) NOT NULL,
  `ORDER_ID` varchar(255) NOT NULL,
  `USR_ID` int(255) NOT NULL,
  `withdrawalAmount` varchar(255) NOT NULL,
  `Upi_id` int(255) NOT NULL,
  `status` int(100) NOT NULL DEFAULT 0,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `match_details`
--
ALTER TABLE `match_details`
  ADD PRIMARY KEY (`M_id`);

--
-- Indexes for table `match_result`
--
ALTER TABLE `match_result`
  ADD PRIMARY KEY (`reslt_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `players_login_deatils`
--
ALTER TABLE `players_login_deatils`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `refferal_earning`
--
ALTER TABLE `refferal_earning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_ids`
--
ALTER TABLE `room_ids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transaction_history`
--
ALTER TABLE `user_transaction_history`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `withdrawal_request`
--
ALTER TABLE `withdrawal_request`
  ADD PRIMARY KEY (`withdrawal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_details`
--
ALTER TABLE `match_details`
  MODIFY `M_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_result`
--
ALTER TABLE `match_result`
  MODIFY `reslt_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players_login_deatils`
--
ALTER TABLE `players_login_deatils`
  MODIFY `login_details_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refferal_earning`
--
ALTER TABLE `refferal_earning`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_ids`
--
ALTER TABLE `room_ids`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_transaction_history`
--
ALTER TABLE `user_transaction_history`
  MODIFY `tid` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawal_request`
--
ALTER TABLE `withdrawal_request`
  MODIFY `withdrawal_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_transaction_history`
--
ALTER TABLE `user_transaction_history`
  ADD CONSTRAINT `user_transaction_history_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `players` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
