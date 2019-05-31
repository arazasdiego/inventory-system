-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2017 at 11:34 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto_po`
--

CREATE TABLE `auto_po` (
  `ID` int(11) NOT NULL,
  `OrdersID` varchar(30) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `PendingQty` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `SupplierID` varchar(30) NOT NULL,
  `DateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `BankID` int(11) NOT NULL,
  `BankName` varchar(60) NOT NULL,
  `AccountName` varchar(60) NOT NULL,
  `AccountNumber` varchar(50) NOT NULL,
  `BankDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`BankID`, `BankName`, `AccountName`, `AccountNumber`, `BankDelete`) VALUES
(2, 'BDO', 'LPGVILLE', '43412-1233-1231', 0),
(3, 'UCPB', 'LGPVILLE', '2432-2231-3123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `billing_detail`
--

CREATE TABLE `billing_detail` (
  `BillingID` varchar(30) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `CompleteAddress` varchar(255) NOT NULL,
  `OrdersID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_detail`
--

INSERT INTO `billing_detail` (`BillingID`, `CustomerName`, `Mobile`, `Email`, `CompleteAddress`, `OrdersID`) VALUES
('BILL-18-2', 'Fritz Tuna', '639198240155', 'fritz_tuna@gmail.com', 'Caloocan, Metro Manila-Pandacan', 'ORD-79-2'),
('BILL-25-0', 'Daniel Desario', '934 1213', 'Null', 'Espana Manila', 'ORD-48-0'),
('BILL-57-1', 'Fritz Tuna', '639198240155', 'fritz_tuna@gmail.com', 'Caloocan, Metro Manila-', 'ORD-36-1');

-- --------------------------------------------------------

--
-- Table structure for table `business_profile`
--

CREATE TABLE `business_profile` (
  `ID` int(5) NOT NULL,
  `BusinessName` varchar(100) NOT NULL,
  `BusinessAddress` varchar(100) NOT NULL,
  `BusinessContact` varchar(30) NOT NULL,
  `BusinessEmail` varchar(50) NOT NULL,
  `BusinessOwner` varchar(70) NOT NULL,
  `TIN` varchar(50) NOT NULL,
  `ORNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_profile`
--

INSERT INTO `business_profile` (`ID`, `BusinessName`, `BusinessAddress`, `BusinessContact`, `BusinessEmail`, `BusinessOwner`, `TIN`, `ORNumber`) VALUES
(1, 'LPGVILLE ', 'Espana Manila, Philippines', '923-3414', 'lpgville@gmail.com', 'Katrina Tang', '234-234-349-000', '234523');

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_order`
--

CREATE TABLE `cancelled_order` (
  `ID` int(11) NOT NULL,
  `OrdersID` varchar(30) NOT NULL,
  `ReasonID` varchar(30) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `DateCancelled` date NOT NULL,
  `CancelledBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `ProductID` varchar(20) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Total` bigint(11) NOT NULL,
  `UserID` varchar(20) NOT NULL,
  `DateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `CategoryReturned` int(5) NOT NULL,
  `CategoryDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `CategoryReturned`, `CategoryDelete`) VALUES
(29, 'LPG 11KG', 1, 0),
(30, 'LPG 2.5KG', 1, 0),
(33, 'LPG 22KG', 1, 0),
(34, 'LPG 7KG', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `CityID` int(11) NOT NULL,
  `CityName` varchar(100) NOT NULL,
  `CityFee` int(11) NOT NULL,
  `CityDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CityID`, `CityName`, `CityFee`, `CityDelete`) VALUES
(1, 'Binondo', 5, 0),
(2, 'Ermita', 10, 0),
(3, 'Intramuros', 11, 0),
(4, 'Malate', 15, 0),
(5, 'Paco', 10, 0),
(6, 'Pandacan', 20, 0),
(7, 'Port Area', 6, 0),
(8, 'Quiapo', 10, 0),
(9, 'Sampaloc', 6, 0),
(10, 'San Miguel', 7, 0),
(11, 'San Nicolas', 8, 0),
(12, 'Santa Ana', 15, 0),
(13, 'Santa Cruz', 12, 0),
(14, 'Quezon Avenue', 30, 0),
(15, 'asdasd', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `ID` int(11) NOT NULL,
  `footer` varchar(200) NOT NULL,
  `about` text NOT NULL,
  `contact_text` varchar(255) NOT NULL,
  `contact_address` varchar(200) NOT NULL,
  `slider1` varchar(200) NOT NULL,
  `slider2` varchar(200) NOT NULL,
  `home_title1` varchar(200) NOT NULL,
  `home_title2` varchar(200) NOT NULL,
  `home_title3` varchar(200) NOT NULL,
  `home_text1` varchar(125) NOT NULL,
  `home_text2` varchar(125) NOT NULL,
  `home_text3` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`ID`, `footer`, `about`, `contact_text`, `contact_address`, `slider1`, `slider2`, `home_title1`, `home_title2`, `home_title3`, `home_text1`, `home_text2`, `home_text3`) VALUES
(1, '2016 LPGVILLE Trading. All Rights Reserved.\r\n    \r\n    \r\n    ', 'If your server has activated support for PHP you do not need to do anything.\r\n\r\nJust create some .php files, place them in your web directory, and the server will automatically parse them for you.\r\n\r\nYou do not need to compile anything or install any extra tools.\r\n\r\nBecause PHP is free, most web hosts offer PHP support.\r\n    \r\n    \r\n    ', 'Please feel free to contact us, our customer service center is working for you 8-6.\r\n    \r\n    \r\n    ', 'D.Tuazon Espana Manila Metro Manila, NCR Philippines\r\n    \r\n    \r\n    ', 'slider2.jpg', 'slider3.jpg', 'WE LOVE OUR CUSTOMERS\r\n    \r\n    \r\n    ', 'BEST PRICES\r\n    \r\n    \r\n    ', '100% SATISFACTION GUARANTEED\r\n    \r\n    \r\n    ', 'We are known to provide best possible service ever.', 'One of the fair and affordable lpg retailer and wholesaler.', 'Free returns on everything.');

-- --------------------------------------------------------

--
-- Table structure for table `damaged_reason`
--

CREATE TABLE `damaged_reason` (
  `ReasonID` int(11) NOT NULL,
  `ReasonName` varchar(50) NOT NULL,
  `ReasonDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `damaged_reason`
--

INSERT INTO `damaged_reason` (`ReasonID`, `ReasonName`, `ReasonDelete`) VALUES
(1, 'Mismatch', 0),
(2, 'Defective', 0),
(3, 'Not Working Well', 0),
(4, 'Tampered Seal', 0),
(5, 'Tae Ni Roman', 1),
(6, 'Incompatible', 0),
(7, 'Sign Of Leakage', 0),
(8, 'Old Mechanism', 0);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `DiscountID` int(11) NOT NULL,
  `DiscountName` varchar(30) NOT NULL,
  `DiscountValue` int(11) NOT NULL,
  `DiscountDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`DiscountID`, `DiscountName`, `DiscountValue`, `DiscountDelete`) VALUES
(1, 'Regular', 10, 0),
(2, 'Senior Citizen', 20, 0),
(3, 'None', 0, 0),
(5, 'Student', 20, 0),
(6, 'Exclusive', 25, 0),
(7, 'Tae mo roman ni migue', 233, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Email` varchar(120) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `Fullname`, `Email`, `Message`, `DateCreated`) VALUES
(1, 'James Harder', 'jameshardern@gmail.com', 'Your site is stunning and easy to use.', '2017-03-09 05:57:16'),
(2, 'Fritz Tuna', 'fritz_tuna@gmail.com', 'Nice setup and good job Diego.', '2017-03-09 06:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `inventorylog`
--

CREATE TABLE `inventorylog` (
  `InventoryLogID` int(11) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `TotalReceivedPO` int(11) NOT NULL,
  `TotalDamaged` int(11) NOT NULL,
  `TotalStockSold` int(11) NOT NULL,
  `TotalSales` bigint(11) NOT NULL,
  `TotalStock` int(11) NOT NULL,
  `DateCreated` date NOT NULL,
  `CreatedBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `limit_orders`
--

CREATE TABLE `limit_orders` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `limit_orders`
--

INSERT INTO `limit_orders` (`ID`, `Name`, `Value`) VALUES
(1, 'No. of orders allowed (Not paid)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `OrdersID` varchar(30) NOT NULL,
  `ProductID` varchar(20) NOT NULL,
  `OrderedQty` int(11) NOT NULL,
  `Price` bigint(11) NOT NULL,
  `TotalPrice` bigint(11) NOT NULL,
  `DeliveredQty` int(11) NOT NULL,
  `PickedupQty` int(11) NOT NULL,
  `ReturnedQty` int(11) NOT NULL,
  `DeliveryStatus` varchar(30) NOT NULL,
  `PickedupStatus` varchar(40) NOT NULL,
  `PaymentStatus` varchar(30) NOT NULL,
  `WalkinQty` int(11) NOT NULL,
  `WalkinStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders_total`
--

CREATE TABLE `orders_total` (
  `OrdersID` varchar(20) NOT NULL,
  `SubAmount` bigint(11) NOT NULL,
  `DeliveryCharge` int(11) NOT NULL,
  `DiscountedAmount` int(11) NOT NULL,
  `GrandAmount` bigint(11) NOT NULL,
  `AmountPayable` bigint(11) NOT NULL,
  `AmountChange` double NOT NULL,
  `BillingID` varchar(30) NOT NULL,
  `PaymentType` varchar(30) NOT NULL,
  `AmountPaid` bigint(11) NOT NULL,
  `DiscountID` varchar(30) NOT NULL,
  `DateOrdered` date NOT NULL,
  `OrderStatus` varchar(100) NOT NULL,
  `PaymentStatus` varchar(20) NOT NULL,
  `DeliveryStatus` varchar(20) NOT NULL,
  `PickedupStatus` varchar(40) NOT NULL,
  `TransactionType` varchar(20) NOT NULL,
  `PreparedBy` varchar(30) NOT NULL,
  `OrderBy` varchar(30) NOT NULL,
  `OrderType` varchar(30) NOT NULL,
  `ReturnedStatus` int(5) NOT NULL,
  `WalkinStatus` varchar(50) NOT NULL,
  `OrdersDelete` int(5) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DateFinished` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ID` int(11) NOT NULL,
  `OrdersID` varchar(30) NOT NULL,
  `Amount` bigint(11) NOT NULL,
  `PaymentType` varchar(30) NOT NULL,
  `DatePaid` date NOT NULL,
  `ReceivedBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_slip`
--

CREATE TABLE `payment_slip` (
  `ID` int(11) NOT NULL,
  `OrdersID` varchar(30) NOT NULL,
  `DepositSlip` varchar(255) NOT NULL,
  `DatePaid` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `ID` int(11) NOT NULL,
  `POID` varchar(30) NOT NULL,
  `ProductID` varchar(20) NOT NULL,
  `RequestedQty` int(11) NOT NULL,
  `Price` bigint(11) NOT NULL,
  `TotalPrice` bigint(11) NOT NULL,
  `ReceivedQty` int(11) NOT NULL,
  `ReturnedQty` int(11) NOT NULL,
  `POStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `po_cart`
--

CREATE TABLE `po_cart` (
  `ID` int(11) NOT NULL,
  `ProductID` varchar(20) NOT NULL,
  `Qty` int(11) NOT NULL,
  `Price` bigint(11) NOT NULL,
  `TotalPrice` bigint(11) NOT NULL,
  `SupplierID` varchar(20) NOT NULL,
  `UserID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `po_total`
--

CREATE TABLE `po_total` (
  `POID` varchar(30) NOT NULL,
  `SupplierID` varchar(20) NOT NULL,
  `TotalAmount` bigint(11) NOT NULL,
  `DeliveryDate` date NOT NULL,
  `DateCreated` date NOT NULL,
  `Status` varchar(20) NOT NULL,
  `UserID` varchar(30) NOT NULL,
  `OrdersID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` varchar(20) NOT NULL,
  `CategoryID` varchar(20) NOT NULL,
  `QtyID` varchar(20) NOT NULL,
  `ProdName` varchar(100) NOT NULL,
  `Stock` int(11) NOT NULL,
  `CostPrice` bigint(11) NOT NULL,
  `MarkUp` int(11) NOT NULL,
  `RetailPrice` bigint(11) NOT NULL,
  `Threshold` int(11) NOT NULL,
  `ProdDetail` text NOT NULL,
  `ProdImage` varchar(100) NOT NULL,
  `ProdStatus` varchar(10) NOT NULL,
  `DateAdded` date NOT NULL,
  `ProductDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quantity_type`
--

CREATE TABLE `quantity_type` (
  `QtyID` int(11) NOT NULL,
  `QtyName` varchar(50) NOT NULL,
  `QtyDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quantity_type`
--

INSERT INTO `quantity_type` (`QtyID`, `QtyName`, `QtyDelete`) VALUES
(1, 'Piece', 0),
(2, 'Box', 0),
(3, 'Set', 0);

-- --------------------------------------------------------

--
-- Table structure for table `returned_orders`
--

CREATE TABLE `returned_orders` (
  `ID` int(11) NOT NULL,
  `OrdersID` varchar(30) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `Qty` int(11) NOT NULL,
  `ReasonID` varchar(30) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `DateAdded` date NOT NULL,
  `Received` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returned_orders2`
--

CREATE TABLE `returned_orders2` (
  `OrdersID` varchar(30) NOT NULL,
  `DateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returned_po`
--

CREATE TABLE `returned_po` (
  `ID` int(11) NOT NULL,
  `POID` varchar(30) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `Qty` int(11) NOT NULL,
  `ReasonID` varchar(30) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `DateAdded` date NOT NULL,
  `AddedBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `returned_po2`
--

CREATE TABLE `returned_po2` (
  `POID` varchar(30) NOT NULL,
  `SupplierID` varchar(30) NOT NULL,
  `DateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_cart`
--

CREATE TABLE `sales_cart` (
  `ID` int(11) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `Price` bigint(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `TotalPrice` bigint(11) NOT NULL,
  `UserID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` varchar(20) NOT NULL,
  `SupplierName` varchar(60) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Contact` varchar(30) NOT NULL,
  `SupplierStatus` varchar(10) NOT NULL,
  `SupplierDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `Email`, `Contact`, `SupplierStatus`, `SupplierDelete`) VALUES
('SUP-40-1', 'Shell Philippines', 'shell-ph@gmail.com', '432 5343', 'Active', 0),
('SUP-94-0', 'Petron Philippines', 'petron@gmail.com', '932 3234', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_product`
--

CREATE TABLE `supplier_product` (
  `ID` int(11) NOT NULL,
  `SupplierID` varchar(30) NOT NULL,
  `ProductID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tanks`
--

CREATE TABLE `tanks` (
  `ID` int(11) NOT NULL,
  `OrdersID` varchar(30) NOT NULL,
  `ProductID` varchar(30) NOT NULL,
  `Qty` int(11) NOT NULL,
  `ReturnedQty` int(5) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tanks_total`
--

CREATE TABLE `tanks_total` (
  `OrdersID` varchar(30) NOT NULL,
  `DateAdded` date NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_member`
--

CREATE TABLE `temp_member` (
  `ID` int(11) NOT NULL,
  `confirm_code` varchar(255) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Contact` varchar(30) NOT NULL,
  `Address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_member`
--

INSERT INTO `temp_member` (`ID`, `confirm_code`, `Email`, `Password`, `Fullname`, `Contact`, `Address`) VALUES
(1, '3771dfefa71bad3b19c4d34f862c2074', 'mikedantoni@gmail.com', 'password', 'Mike Dantoni', '639065538209', 'Espana Manila'),
(2, '12fd69884e8248af9930517c30ffecff', 'mike@gmail.com', 'password', 'Mike Dantoni', '639065538209', 'Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `trail`
--

CREATE TABLE `trail` (
  `TrailID` int(11) NOT NULL,
  `ID` varchar(20) NOT NULL,
  `UserID` varchar(20) NOT NULL,
  `Message` text NOT NULL,
  `DateCreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trail`
--

INSERT INTO `trail` (`TrailID`, `ID`, `UserID`, `Message`, `DateCreated`) VALUES
(240, 'reasonid', 'SUPERADMIN', 'Added a new reason (Old Mechanism).', '2017-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_setting`
--

CREATE TABLE `transaction_setting` (
  `ID` int(11) NOT NULL,
  `TransactionName` varchar(100) NOT NULL,
  `Status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_setting`
--

INSERT INTO `transaction_setting` (`ID`, `TransactionName`, `Status`) VALUES
(1, 'Pickup Order', 1),
(2, 'Delivery Order', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` varchar(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Role` varchar(15) NOT NULL,
  `UserStatus` varchar(10) NOT NULL,
  `DateAdded` date NOT NULL,
  `UserDelete` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Role`, `UserStatus`, `DateAdded`, `UserDelete`) VALUES
('SUPERADMIN', 'admin', 'password', 'Superadmin', 'Active', '2016-12-02', 0),
('USER-249-6', 'jenolabilles', 'password', 'Admin', 'Active', '2017-02-08', 1),
('USER-528-4', 'aaronmayugba', 'password', 'Admin', 'Active', '2017-02-08', 0),
('USER-884-5', 'jamesmalinao', 'jamesmalinao', 'Admin', 'Active', '2017-02-08', 0),
('USER-95-3', 'fritz_tuna@gmail.com', 'password', 'User', 'Active', '2017-02-25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `UserID` varchar(30) NOT NULL,
  `Inventory` int(5) NOT NULL,
  `PO` int(5) NOT NULL,
  `Orders` int(5) NOT NULL,
  `Reports` int(5) NOT NULL,
  `Settings` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`UserID`, `Inventory`, `PO`, `Orders`, `Reports`, `Settings`) VALUES
('SUPERADMIN', 1, 1, 1, 1, 1),
('USER-249-6', 1, 1, 0, 0, 0),
('USER-528-4', 1, 1, 1, 0, 0),
('USER-884-5', 1, 1, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `UserID` varchar(20) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Contact` varchar(50) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`UserID`, `Fullname`, `Contact`, `Email`, `Address`) VALUES
('SUPERADMIN', 'Superadmin', '09065538209', 'arazasdiego@gmail.com', 'Grass Residences Tower 1 1619B Brgy. Sto. Cristo North Avenue Quezon City'),
('USER-528-4', 'Aaron Mayugba', '09156934053', 'aaronmayugba@gmail.com', 'Quezon City'),
('USER-884-5', 'James Malinao', '09242124955', 'james_malinao@gmail.com', 'Espana, Manila City'),
('USER-95-3', 'Fritz Tuna', '639198240155', 'fritz_tuna@gmail.com', 'Caloocan, Metro Manila');

-- --------------------------------------------------------

--
-- Table structure for table `vat`
--

CREATE TABLE `vat` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vat`
--

INSERT INTO `vat` (`ID`, `Name`, `Value`) VALUES
(1, 'VAT', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto_po`
--
ALTER TABLE `auto_po`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`BankID`);

--
-- Indexes for table `billing_detail`
--
ALTER TABLE `billing_detail`
  ADD PRIMARY KEY (`BillingID`);

--
-- Indexes for table `business_profile`
--
ALTER TABLE `business_profile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cancelled_order`
--
ALTER TABLE `cancelled_order`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`CityID`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `damaged_reason`
--
ALTER TABLE `damaged_reason`
  ADD PRIMARY KEY (`ReasonID`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`DiscountID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inventorylog`
--
ALTER TABLE `inventorylog`
  ADD PRIMARY KEY (`InventoryLogID`);

--
-- Indexes for table `limit_orders`
--
ALTER TABLE `limit_orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders_total`
--
ALTER TABLE `orders_total`
  ADD PRIMARY KEY (`OrdersID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payment_slip`
--
ALTER TABLE `payment_slip`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `po_cart`
--
ALTER TABLE `po_cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `po_total`
--
ALTER TABLE `po_total`
  ADD PRIMARY KEY (`POID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `quantity_type`
--
ALTER TABLE `quantity_type`
  ADD PRIMARY KEY (`QtyID`);

--
-- Indexes for table `returned_orders`
--
ALTER TABLE `returned_orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `returned_orders2`
--
ALTER TABLE `returned_orders2`
  ADD PRIMARY KEY (`OrdersID`);

--
-- Indexes for table `returned_po`
--
ALTER TABLE `returned_po`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `returned_po2`
--
ALTER TABLE `returned_po2`
  ADD PRIMARY KEY (`POID`);

--
-- Indexes for table `sales_cart`
--
ALTER TABLE `sales_cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Indexes for table `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tanks`
--
ALTER TABLE `tanks`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tanks_total`
--
ALTER TABLE `tanks_total`
  ADD PRIMARY KEY (`OrdersID`);

--
-- Indexes for table `temp_member`
--
ALTER TABLE `temp_member`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trail`
--
ALTER TABLE `trail`
  ADD PRIMARY KEY (`TrailID`);

--
-- Indexes for table `transaction_setting`
--
ALTER TABLE `transaction_setting`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vat`
--
ALTER TABLE `vat`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_po`
--
ALTER TABLE `auto_po`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `BankID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cancelled_order`
--
ALTER TABLE `cancelled_order`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `CityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `damaged_reason`
--
ALTER TABLE `damaged_reason`
  MODIFY `ReasonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `DiscountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `inventorylog`
--
ALTER TABLE `inventorylog`
  MODIFY `InventoryLogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `limit_orders`
--
ALTER TABLE `limit_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `payment_slip`
--
ALTER TABLE `payment_slip`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `po_cart`
--
ALTER TABLE `po_cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `quantity_type`
--
ALTER TABLE `quantity_type`
  MODIFY `QtyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `returned_orders`
--
ALTER TABLE `returned_orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `returned_po`
--
ALTER TABLE `returned_po`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sales_cart`
--
ALTER TABLE `sales_cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `supplier_product`
--
ALTER TABLE `supplier_product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tanks`
--
ALTER TABLE `tanks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_member`
--
ALTER TABLE `temp_member`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `trail`
--
ALTER TABLE `trail`
  MODIFY `TrailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT for table `transaction_setting`
--
ALTER TABLE `transaction_setting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vat`
--
ALTER TABLE `vat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
