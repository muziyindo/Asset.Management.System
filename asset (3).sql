-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2016 at 05:09 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `asset`
--

-- --------------------------------------------------------

--
-- Table structure for table `d2rs_unique_id`
--

CREATE TABLE IF NOT EXISTS `d2rs_unique_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `d2rs_id` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `d2rs_unique_id`
--

INSERT INTO `d2rs_unique_id` (`id`, `d2rs_id`) VALUES
(1, '2033');

-- --------------------------------------------------------

--
-- Table structure for table `decommissioned`
--

CREATE TABLE IF NOT EXISTS `decommissioned` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `deploy_id` varchar(200) NOT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `office_type` varchar(100) DEFAULT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `employee_no` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `user_approval` varchar(50) DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `dept_manager_name` varchar(100) DEFAULT NULL,
  `dept_manager_approval` varchar(100) DEFAULT NULL,
  `dept_approval_date` date DEFAULT NULL,
  `it_manager_name` varchar(100) DEFAULT NULL,
  `it_manager_approval` varchar(100) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT NULL,
  `tag_no` varchar(100) DEFAULT NULL,
  `hostname` varchar(50) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `owned_by` varchar(100) DEFAULT NULL,
  `specifications` varchar(100) DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `decommissioned_by` varchar(200) NOT NULL,
  `deployed_by` varchar(200) NOT NULL,
  `project` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_decommissioned` date NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(200) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `decommissioned_audit`
--

CREATE TABLE IF NOT EXISTS `decommissioned_audit` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` varchar(200) DEFAULT NULL,
  `deploy_id` varchar(200) NOT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `office_type` varchar(100) DEFAULT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `employee_no` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `user_approval` varchar(50) DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `dept_manager_name` varchar(100) DEFAULT NULL,
  `dept_manager_approval` varchar(100) DEFAULT NULL,
  `dept_approval_date` date DEFAULT NULL,
  `it_manager_name` varchar(100) DEFAULT NULL,
  `it_manager_approval` varchar(100) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT NULL,
  `tag_no` varchar(100) DEFAULT NULL,
  `hostname` varchar(50) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `owned_by` varchar(100) DEFAULT NULL,
  `specifications` varchar(100) DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `decommissioned_by` varchar(200) NOT NULL,
  `deployed_by` varchar(200) NOT NULL,
  `project` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_decommissioned` date NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(200) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `deduction_report`
--

CREATE TABLE IF NOT EXISTS `deduction_report` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `oracle_number` int(200) DEFAULT NULL,
  `employee_name` varchar(200) NOT NULL,
  `ministry_name` varchar(200) DEFAULT NULL,
  `credit` varchar(200) DEFAULT NULL,
  `ledger_balance` varchar(200) NOT NULL,
  `principal_from_credited` varchar(200) NOT NULL,
  `interest_from_credited` varchar(200) NOT NULL,
  `interest` varchar(200) NOT NULL,
  `principal_amount` varchar(200) NOT NULL,
  `repayment_amount` varchar(200) NOT NULL,
  `balance` varchar(200) NOT NULL,
  `booked_amount` varchar(200) NOT NULL,
  `tenure` varchar(50) NOT NULL,
  `narration` varchar(500) NOT NULL,
  `element_name` varchar(200) NOT NULL,
  `entry_date` date DEFAULT NULL,
  `checked` varchar(200) DEFAULT '0',
  `month_year` varchar(200) NOT NULL,
  `month` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `first_repayment_date` date NOT NULL,
  `last_repayment_date` date NOT NULL,
  `due_date` date NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `deduction_report`
--

INSERT INTO `deduction_report` (`rid`, `oracle_number`, `employee_name`, `ministry_name`, `credit`, `ledger_balance`, `principal_from_credited`, `interest_from_credited`, `interest`, `principal_amount`, `repayment_amount`, `balance`, `booked_amount`, `tenure`, `narration`, `element_name`, `entry_date`, `checked`, `month_year`, `month`, `year`, `first_repayment_date`, `last_repayment_date`, `due_date`, `file_id`) VALUES
(1, 135970, 'ABESIN, Mr. RAFIU ABAYOMI', 'LAGOS STATE TRAFFIC MANAGEMENT AUTHORITY (074)', '13333.92', '60990.594594595', '9009.4054054054', '4324.5145945946', '2800', '5833.3333333333', '8633.3333333333', '60990.594594595', '70000', '12', 'March deductions', 'LASG MOW Cooperative Loan', '2016-03-14', 'yes', 'march_2016', 'march', '2016', '2016-03-22', '2016-03-22', '2016-04-22', 1),
(2, 764, 'ABIKOYE, Mr. OLATUNJI', 'LAGOS STATE TRAFFIC MANAGEMENT AUTHORITY (074)', '6531.69', '-6531.69', '6531.69', '0', '0', '0', '0', '-6531.69', '0', '12', 'March deductions', 'LASG MOW Cooperative Loan', '2016-03-14', 'yes', 'march_2016', 'march', '2016', '0000-00-00', '0000-00-00', '0000-00-00', 1),
(3, 128216, 'IDOWU, Mr. BABATUNDE OLUMIDE', 'LAGOS STATE TRAFFIC MANAGEMENT AUTHORITY (074)', '11714.08', '-11714.08', '11714.08', '0', '0', '0', '0', '-11714.08', '0', '12', 'March deductions', 'LASG MOW Cooperative Loan', '2016-03-14', 'yes', 'march_2016', 'march', '2016', '0000-00-00', '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deployed`
--

CREATE TABLE IF NOT EXISTS `deployed` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `install_id` varchar(200) NOT NULL,
  `return_id` varchar(200) NOT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `office_type` varchar(100) DEFAULT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `employee_no` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `user_approval` varchar(50) DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `dept_manager_name` varchar(100) DEFAULT NULL,
  `dept_manager_approval` varchar(100) DEFAULT NULL,
  `dept_approval_date` date DEFAULT NULL,
  `it_manager_name` varchar(100) DEFAULT NULL,
  `it_manager_approval` varchar(100) DEFAULT NULL,
  `it_approval_date` date DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT NULL,
  `tag_no` varchar(100) DEFAULT NULL,
  `hostname` varchar(50) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `owned_by` varchar(100) DEFAULT NULL,
  `specifications` varchar(100) DEFAULT NULL,
  `date_deployed` date DEFAULT NULL,
  `engineer` varchar(200) NOT NULL,
  `deployed_by` varchar(200) NOT NULL,
  `project` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `log_date` date NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(200) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `deployed_audit`
--

CREATE TABLE IF NOT EXISTS `deployed_audit` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `did` varchar(200) DEFAULT NULL,
  `install_id` varchar(200) NOT NULL,
  `return_id` varchar(200) NOT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `office_type` varchar(100) DEFAULT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `employee_no` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `user_approval` varchar(50) DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `dept_manager_name` varchar(100) DEFAULT NULL,
  `dept_manager_approval` varchar(100) DEFAULT NULL,
  `dept_approval_date` date DEFAULT NULL,
  `it_manager_name` varchar(100) DEFAULT NULL,
  `it_manager_approval` varchar(100) DEFAULT NULL,
  `it_approval_date` date DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT NULL,
  `tag_no` varchar(100) DEFAULT NULL,
  `hostname` varchar(50) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `owned_by` varchar(100) DEFAULT NULL,
  `specifications` varchar(100) DEFAULT NULL,
  `date_deployed` date DEFAULT NULL,
  `engineer` varchar(200) NOT NULL,
  `deployed_by` varchar(200) NOT NULL,
  `project` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `log_date` date NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(200) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `oracle_number` varchar(30) DEFAULT NULL,
  `document_type` varchar(100) DEFAULT NULL,
  `path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lasg_staff_info`
--

CREATE TABLE IF NOT EXISTS `lasg_staff_info` (
  `lsid` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(200) DEFAULT NULL,
  `installer_name` varchar(200) DEFAULT NULL,
  `project` varchar(200) DEFAULT NULL,
  `department` varchar(300) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `lg` varchar(200) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT NULL,
  `asset_name` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `serial` varchar(300) DEFAULT NULL,
  `specification` varchar(200) DEFAULT NULL,
  `po_number` varchar(200) DEFAULT NULL,
  `vendor` varchar(200) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty` varchar(200) DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `date_installed` date DEFAULT NULL,
  `posted_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `install_type` varchar(50) NOT NULL,
  `available` varchar(50) NOT NULL,
  `l2_approved` varchar(200) NOT NULL,
  `last_updated` date NOT NULL,
  `date_applied` date DEFAULT NULL,
  `log_date` date NOT NULL,
  `last_modified` date NOT NULL,
  `view_mode` varchar(100) NOT NULL,
  `user_viewing` varchar(100) NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(100) NOT NULL,
  `qlip_id` varchar(300) NOT NULL,
  PRIMARY KEY (`lsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lasg_staff_info`
--

INSERT INTO `lasg_staff_info` (`lsid`, `unique_id`, `installer_name`, `project`, `department`, `state`, `city`, `lg`, `category`, `asset_type`, `asset_name`, `model`, `serial`, `specification`, `po_number`, `vendor`, `purchase_date`, `warranty`, `expiry_date`, `date_installed`, `posted_by`, `status`, `install_type`, `available`, `l2_approved`, `last_updated`, `date_applied`, `log_date`, `last_modified`, `view_mode`, `user_viewing`, `action_type`, `action_user`, `qlip_id`) VALUES
(1, 20162025, 'level2 level2', 'ACIS', '0', 'LAGOS', 'VI', 'SARE', 'hardware', 'laptop', 'HP PROBOOK', '640 G1', '5CG5200MHR', 'CORE i5,2.5GHZ,RAM 4GB,HDD 500GB', '', '', '2016-06-04', '5', '2021-05-30', '2016-06-06', 'level2', 'installed', 'bulk', 'yes', 'no', '0000-00-00', '2016-06-22', '0000-00-00', '0000-00-00', '', '', 'insert', 'level2', '800223'),
(2, 20162026, 'level2 level2', 'ACIS', '0', 'LAGOS', 'VI', 'SARE', 'hardware', 'laptop', 'HP PROBOOK', '640 G1', '5CG5200MB9', 'CORE i5,2.5GHZ,RAM 4GB,HDD 500GB', '', '', '2016-06-04', '5', '2021-05-30', '2016-06-06', 'level2', 'installed', 'bulk', 'yes', 'no', '0000-00-00', '2016-06-22', '0000-00-00', '0000-00-00', '', '', 'insert', 'level2', '800224'),
(3, 20162027, 'level2 level2', 'ACIS', '0', 'LAGOS', 'VI', 'SARE', 'hardware', 'laptop', 'HP PROBOOK', '640 G1', '5CG5200M6W', 'CORE i5,2.5GHZ,RAM 4GB,HDD 500GB', '', '', '2016-06-04', '5', '2021-05-30', '2016-06-06', 'level2', 'installed', 'bulk', 'yes', 'no', '0000-00-00', '2016-06-22', '0000-00-00', '0000-00-00', '', '', 'insert', 'level2', '800225');

-- --------------------------------------------------------

--
-- Table structure for table `lasg_staff_info_audit`
--

CREATE TABLE IF NOT EXISTS `lasg_staff_info_audit` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `lsid` varchar(200) DEFAULT NULL,
  `unique_id` int(200) DEFAULT NULL,
  `installer_name` varchar(200) DEFAULT NULL,
  `project` varchar(200) DEFAULT NULL,
  `department` varchar(300) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `lg` varchar(200) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `asset_type` varchar(200) DEFAULT NULL,
  `asset_name` varchar(200) DEFAULT NULL,
  `model` varchar(200) DEFAULT NULL,
  `serial` varchar(300) DEFAULT NULL,
  `specification` varchar(200) DEFAULT NULL,
  `po_number` varchar(200) DEFAULT NULL,
  `vendor` varchar(200) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `warranty` varchar(200) DEFAULT NULL,
  `expiry_date` date NOT NULL,
  `date_installed` date DEFAULT NULL,
  `posted_by` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `install_type` varchar(50) NOT NULL,
  `available` varchar(50) NOT NULL,
  `l2_approved` varchar(200) NOT NULL,
  `last_updated` date NOT NULL,
  `date_applied` date DEFAULT NULL,
  `log_date` date NOT NULL,
  `last_modified` date NOT NULL,
  `view_mode` varchar(100) NOT NULL,
  `user_viewing` varchar(100) NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(100) NOT NULL,
  `qlip_id` varchar(300) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lasg_staff_info_audit`
--

INSERT INTO `lasg_staff_info_audit` (`log_id`, `lsid`, `unique_id`, `installer_name`, `project`, `department`, `state`, `city`, `lg`, `category`, `asset_type`, `asset_name`, `model`, `serial`, `specification`, `po_number`, `vendor`, `purchase_date`, `warranty`, `expiry_date`, `date_installed`, `posted_by`, `status`, `install_type`, `available`, `l2_approved`, `last_updated`, `date_applied`, `log_date`, `last_modified`, `view_mode`, `user_viewing`, `action_type`, `action_user`, `qlip_id`) VALUES
(1, '1', 20162025, 'level2 level2', 'ACIS', '0', 'LAGOS', 'VI', 'SARE', 'hardware', 'laptop', 'HP PROBOOK', '640 G1', '5CG5200MHR', 'CORE i5,2.5GHZ,RAM 4GB,HDD 500GB', '', '', '2016-06-04', '5', '2021-05-30', '2016-06-06', 'level2', 'installed', 'bulk', 'yes', 'no', '0000-00-00', '2016-06-22', '2016-06-22', '0000-00-00', '', '', 'insert', 'level2', '800223'),
(2, '2', 20162026, 'level2 level2', 'ACIS', '0', 'LAGOS', 'VI', 'SARE', 'hardware', 'laptop', 'HP PROBOOK', '640 G1', '5CG5200MB9', 'CORE i5,2.5GHZ,RAM 4GB,HDD 500GB', '', '', '2016-06-04', '5', '2021-05-30', '2016-06-06', 'level2', 'installed', 'bulk', 'yes', 'no', '0000-00-00', '2016-06-22', '2016-06-22', '0000-00-00', '', '', 'insert', 'level2', '800224'),
(3, '3', 20162027, 'level2 level2', 'ACIS', '0', 'LAGOS', 'VI', 'SARE', 'hardware', 'laptop', 'HP PROBOOK', '640 G1', '5CG5200M6W', 'CORE i5,2.5GHZ,RAM 4GB,HDD 500GB', '', '', '2016-06-04', '5', '2021-05-30', '2016-06-06', 'level2', 'installed', 'bulk', 'yes', 'no', '0000-00-00', '2016-06-22', '2016-06-22', '0000-00-00', '', '', 'insert', 'level2', '800225');

-- --------------------------------------------------------

--
-- Table structure for table `qlip_id`
--

CREATE TABLE IF NOT EXISTS `qlip_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_series` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `qlip_id`
--

INSERT INTO `qlip_id` (`id`, `id_series`) VALUES
(1, '800225');

-- --------------------------------------------------------

--
-- Table structure for table `qusers`
--

CREATE TABLE IF NOT EXISTS `qusers` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(200) DEFAULT NULL,
  `lname` varchar(200) DEFAULT NULL,
  `oname` varchar(200) DEFAULT NULL,
  `email` varchar(300) NOT NULL,
  `uname` varchar(200) DEFAULT NULL,
  `pword` varchar(200) DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL,
  `date_created` date DEFAULT NULL,
  `project` varchar(200) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `qusers`
--

INSERT INTO `qusers` (`uid`, `fname`, `lname`, `oname`, `email`, `uname`, `pword`, `role`, `date_created`, `project`) VALUES
(61, 'level1', 'level1', '', '', 'level1', 'GJzw/t4gKJLxpm+c3O2v0hFZxLW4xCBOhiEuiJFDQ+Ie/imyoTsNIuCQ8hJGiCDUJOW/23Yi6J9OVo4JfTC8lQ==', 'level1', '2016-05-29', 'ACIS'),
(63, 'level2', 'level2', '', '', 'level2', '1VSvgE7cfHjWJRal9fFqwB2gVEd5D0REuzGlofrWzeDfbkE3Np6g4XHetiFF/tlYal7A24O2W52KachKPkLjHg==', 'level2', '2016-06-02', 'ACIS');

-- --------------------------------------------------------

--
-- Table structure for table `returned`
--

CREATE TABLE IF NOT EXISTS `returned` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `deploy_id` varchar(200) NOT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `office_type` varchar(100) DEFAULT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `employee_no` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `user_approval` varchar(50) DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `dept_manager_name` varchar(100) DEFAULT NULL,
  `dept_manager_approval` varchar(100) DEFAULT NULL,
  `dept_approval_date` date DEFAULT NULL,
  `it_manager_name` varchar(100) DEFAULT NULL,
  `it_manager_approval` varchar(100) DEFAULT NULL,
  `it_approval_date` date DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT NULL,
  `tag_no` varchar(100) DEFAULT NULL,
  `hostname` varchar(50) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `owned_by` varchar(100) DEFAULT NULL,
  `specifications` varchar(100) DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `engineer` varchar(200) NOT NULL,
  `deployed_by` varchar(200) NOT NULL,
  `project` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `log_date` date NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(200) NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `returned_audit`
--

CREATE TABLE IF NOT EXISTS `returned_audit` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` varchar(200) DEFAULT NULL,
  `deploy_id` varchar(200) NOT NULL,
  `serial_no` varchar(100) DEFAULT NULL,
  `organisation` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `office_type` varchar(100) DEFAULT NULL,
  `room_no` varchar(100) DEFAULT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `employee_no` varchar(100) NOT NULL,
  `contact_no` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `user_approval` varchar(50) DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `dept_manager_name` varchar(100) DEFAULT NULL,
  `dept_manager_approval` varchar(100) DEFAULT NULL,
  `dept_approval_date` date DEFAULT NULL,
  `it_manager_name` varchar(100) DEFAULT NULL,
  `it_manager_approval` varchar(100) DEFAULT NULL,
  `it_approval_date` date DEFAULT NULL,
  `asset_type` varchar(100) DEFAULT NULL,
  `tag_no` varchar(100) DEFAULT NULL,
  `hostname` varchar(50) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `owned_by` varchar(100) DEFAULT NULL,
  `specifications` varchar(100) DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `engineer` varchar(200) NOT NULL,
  `deployed_by` varchar(200) NOT NULL,
  `project` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL,
  `log_date` date NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(200) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files_audit`
--

CREATE TABLE IF NOT EXISTS `uploaded_files_audit` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` varchar(200) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `upload_month` varchar(100) DEFAULT NULL,
  `upload_year` varchar(100) NOT NULL,
  `upload_month_year` varchar(200) NOT NULL,
  `narration` varchar(500) DEFAULT NULL,
  `total_amount` varchar(200) NOT NULL,
  `upload_date` date DEFAULT NULL,
  `statement_id` varchar(100) NOT NULL,
  `credit_bank` varchar(200) NOT NULL,
  `value_date` date NOT NULL,
  `narration_bank` varchar(300) NOT NULL,
  `status` varchar(100) NOT NULL,
  `recon` varchar(5) NOT NULL,
  `entry_date_primera` date NOT NULL,
  `rejection_reason` varchar(300) NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_user` varchar(100) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `uploaded_files_audit`
--

INSERT INTO `uploaded_files_audit` (`log_id`, `file_id`, `filename`, `upload_month`, `upload_year`, `upload_month_year`, `narration`, `total_amount`, `upload_date`, `statement_id`, `credit_bank`, `value_date`, `narration_bank`, `status`, `recon`, `entry_date_primera`, `rejection_reason`, `action_type`, `action_user`) VALUES
(1, '1', 'march_1457952474April 2015 Oracle deduction report.xlsx', 'march', '2016', 'march_2016', 'March deductions', '31579.69', '2016-03-14', '', '', '0000-00-00', '', 'pending', '', '0000-00-00', '', 'insert', 'otandt'),
(2, '1', 'march_1457952474April 2015 Oracle deduction report.xlsx', 'march', '2016', 'march_2016', 'March deductions', '31579.69', '2016-03-14', '1347876542', '50124', '2016-03-14', 'March', 'approved', 'yes', '2016-03-14', '', 'update', 'primera');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
