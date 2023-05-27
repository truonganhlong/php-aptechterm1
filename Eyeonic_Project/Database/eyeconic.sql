-- phpMyAdmin SQL Dump
-- version 5.2.2-dev+20230321.ac52485973
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2023 at 04:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eyeconic`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` int(11) NOT NULL,
  `BrandName` varchar(50) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `CategoryFor` tinyint(1) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`, `Description`, `CategoryFor`, `Status`) VALUES
(1, 'Calvin Klein', 'Calvin Klein is a fashion lifestyle brand with bold, progressive ideals and a sensual aesthetic that is recognized worldwide. With a modern and minimalist approach to design, the brand elevates everyday essentials to globally iconic status.', 0, 1),
(2, 'Nike', 'The Nike eyewear collection combines the science of vision with an expertise in sport to make superior optics and eyewear for athletes.', 0, 1),
(3, 'Ray-Ban', 'Since 1937, Ray-Ban has been known for being authentic, cool and timeless with deep roots in music\nand pop culture. Iconic styles such as the Aviator, Wayfarer and Clubmaster as well as innovative lenses\nsuch as Chromance and Polar make it the most loved eyewear brand in the world.', 0, 1),
(4, 'Ferragamo', 'Unique heritage, iconic elements and exquisite craftmanship meet innovation and design: welcome to the world of Salvatore Ferragamo, one of the world’s best known Made in Italy luxury brands.', 1, 1),
(5, 'Maui Jim', 'Created on the Hawaiian islands to make the colors shine, all Maui Jim\nsunglasses feature patented PolarizedPlus2® technology.', 2, 1),
(6, 'Acuvue', 'Easy to use and convenient to wear, ACUVUE® contact lenses offer you flexibility and freedom from one day to the next. Whether you’re nearsighted, farsighted, astigmatic or presbyopic, you\'ll find an ACUVUE® contact lens that meets your needs for comfort, clarity, and price.', 3, 1),
(7, 'Biotrue', 'Biotrue® ONEday is the daily disposable lens that matches the moisture level\nof your eyes to bring you comfortable vision throughout the day.', 3, 1),
(8, 'Freshlook', 'Enhance or transform your eye color with FreshLook contact lenses. Choose a light tint or vivid new color for a natural look, even if you have perfect vision.', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Color` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `ColorID` int(11) NOT NULL,
  `ColorName` varchar(50) NOT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`ColorID`, `ColorName`, `Status`) VALUES
(1, 'HAVANA / GOLD', 1),
(2, 'GOLD', 1),
(3, 'LIGHT GUNMETAL', 1),
(4, 'CRYSTAL SMOKE', 1),
(5, 'CRYSTAL BLUE', 1),
(6, 'Red', 1),
(7, '', 1),
(8, 'Blue', 1),
(9, 'Purple', 1),
(10, 'Brown', 1),
(11, 'Violet', 1),
(12, 'MATTE CRYSTAL VOLT', 1),
(13, 'MATTE BLACK', 1),
(14, 'DARK HAVANA', 1),
(15, 'TRANSPARENT DEEP GREY', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frameshape`
--

CREATE TABLE `frameshape` (
  `FrameShapeID` int(11) NOT NULL,
  `FrameShapeName` varchar(45) NOT NULL,
  `Description` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frameshape`
--

INSERT INTO `frameshape` (`FrameShapeID`, `FrameShapeName`, `Description`, `Status`) VALUES
(1, 'Aviator', 'The classic gets an optical update. Worn by generals, celebrities, and civilians alike, aviator glasses are here to stay. You may also love aviator sunglasses.', 1),
(2, 'Round', 'Elegant and stylish, circle frames have maintained their appeal over the decades.', 1),
(3, 'Oversized', 'Inspired by ‘70s fashion, this glamorous trend features whimsical\nshapes and colors. You may also love oversized sunglasses.', 1),
(4, 'Rectangle', 'Rectangular frames complement many face shapes and come in a variety of colors and materials to create a sophisticated or casual appearance.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `framestyle`
--

CREATE TABLE `framestyle` (
  `FrameStyleID` int(11) NOT NULL,
  `FrameStyleName` varchar(45) NOT NULL,
  `Description` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1,
  `IsGlasses` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `framestyle`
--

INSERT INTO `framestyle` (`FrameStyleID`, `FrameStyleName`, `Description`, `Status`, `IsGlasses`) VALUES
(1, 'Designer', 'Choose sophisticated and stylish frames from top brands like Gucci, Salvatore Ferragamo, Saint Laurent, and more.', 1, 1),
(2, 'Clear', 'Both subtle and on-trend, clear glasses might be just the thing to complete the perfect look. You may also love clear frame sunglasses.', 1, 1),
(3, 'Tortoise Shell', 'The classic material gets an upgrade with interesting glasses shapes\nand colorations that go with just about everything.', 1, 1),
(4, 'Single Vision', 'Single vision contacts are tailored for a single prescription strength.', 1, 0),
(5, 'Multifocal/Bifocal', 'Multifocal contacts provide clear vision across a range of distances. Eye doctors commonly prescribe multifocal lenses to correct for presbyopia, or age-related farsightedness.', 1, 0),
(6, 'Color and Enhancing', 'Color and enhancing contacts are designed for people looking to change or enhance eye color. Save up to $120 on your annual supply of color contacts.', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `glassfor`
--

CREATE TABLE `glassfor` (
  `GlassForID` int(11) NOT NULL,
  `GlassForName` varchar(45) NOT NULL,
  `Description` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `glassfor`
--

INSERT INTO `glassfor` (`GlassForID`, `GlassForName`, `Description`, `Status`) VALUES
(1, 'For Men', 'Browse hundreds of frames and update your look with a new pair of men\'s glasses. Free shipping and returns.', 1),
(2, 'For Women', 'Shop women\'s frames from top designers and budget brands alike. Free shipping and returns.', 1),
(3, 'For Kid', 'Shop for glasses online for teens, tweens, and littles.\nReduce your blue light exposure by adding TechShield Blue.', 1),
(4, 'For All', 'Shop glasses and sunglasses for men, women, and kids.\nReduce your blue light exposure by adding TechShield Blue.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ImageID` int(11) NOT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `ImageLink` varchar(250) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ImageID`, `ProductID`, `ImageLink`, `Status`) VALUES
(1, 1, 'images/CALVINKLEIN_CK22109T.jpg', 1),
(2, 2, 'images/CALVINKLEIN_CK22526T.jpg', 1),
(3, 3, 'images/NIKE_7090.jpg', 1),
(4, 4, 'images/NIKE_7304.jpg', 1),
(5, 5, 'images/RAYBAN_RX5154.jpg', 1),
(6, 6, 'images/RAYBAN_RX5279.jpg', 1),
(7, 7, 'images/FERRAGAMO_SF2894.jpg', 1),
(8, 8, 'images/FERRAGAMO_SF2941.jpg', 1),
(9, 9, 'images/ACUVUE_OASYS_with_HYDRACLEAR_PLUS_12pk.png', 1),
(10, 10, 'images/Biotrue_ONEday_30pk.png', 1),
(11, 11, 'images/FreshLook_ColorBlends_6pk.png', 1),
(12, 12, 'images/CALVINKLEIN_CK22110TS.jpg', 1),
(13, 13, 'images/CALVINKLEIN_CK22112TS.jpg', 1),
(14, 14, 'images/CALVINKLEIN_CK23500S.jpg', 1),
(15, 15, 'images/NIKE_CLUB_NINE_DQ0799.jpg', 1),
(16, 16, 'images/NIKE_CLUB_PREMIER_P_DQ0920.jpg', 1),
(17, 17, 'images/NIKE_NEO_RD_M_DV2297.jpg', 1),
(18, 18, 'images/RAYBAN_RB3025.jpg', 1),
(19, 19, 'images/RAYBAN_RB3447.png', 1),
(20, 20, 'images/RAYBAN_RB3016.png', 1),
(21, 22, 'images/MAUIJIM_Two_Steps.jpg', 1),
(22, 23, 'images/MAUIJIM_Keokea.jpg', 1),
(23, 24, 'images/MAUIJIM_Wiki_Wiki.png', 1),
(24, 1, 'images/CALVINKLEIN_CK22109T_2.jpg', 1),
(42, 2, 'images/CALVINKLEIN_CK22526T_2.jpg', 1),
(45, 4, 'images/NIKE_7304_2.jpg', 1),
(46, 5, 'images/RAYBAN_RX5154_2.jpg', 1),
(47, 8, 'images/FERRAGAMO_SF2941_2.jpg', 1),
(48, 13, 'images/CALVIN KLEIN_CK22112TS_2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationID` int(11) NOT NULL,
  `LocationName` varchar(50) NOT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationID`, `LocationName`, `Status`) VALUES
(1, 'Hanoi City', 1),
(2, 'Danang City', 1),
(3, 'Ho Chi Minh City', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `RequiredDate` datetime DEFAULT NULL,
  `ShippedDate` datetime DEFAULT NULL,
  `ShipVia` int(11) DEFAULT NULL,
  `TotalPrice` double DEFAULT NULL,
  `ShipName` varchar(50) DEFAULT NULL,
  `ShipAddress` varchar(50) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `UserID`, `OrderDate`, `RequiredDate`, `ShippedDate`, `ShipVia`, `TotalPrice`, `ShipName`, `ShipAddress`, `Status`) VALUES
(1, 23, NULL, NULL, NULL, 1, 123, 'test', 'test', 1),
(2, 23, '2023-03-17 19:23:58', NULL, NULL, 2, 2188, 'test', 'test', 1),
(3, 23, '2023-03-17 19:44:44', NULL, NULL, 2, 2188, 'test', 'test', 1),
(4, 23, '2023-03-17 20:23:03', NULL, NULL, 2, 2188, 'test', 'test', 1),
(5, 23, '2023-03-18 01:51:43', NULL, NULL, 2, 1318, 'test', 'test', 1),
(6, 23, '2023-03-19 18:11:10', NULL, NULL, 2, 1753, 'test', 'test', 1),
(7, 23, '2023-03-20 23:20:11', NULL, NULL, 2, 1318, 'test', 'test', 0),
(8, 23, '2023-03-21 13:26:37', NULL, NULL, 2, 1318, 'abc', 'abc', 0),
(9, 23, '2023-03-21 14:09:37', NULL, NULL, 1, 3045, 'de', 'de', 0),
(10, 24, '2023-03-21 21:49:53', NULL, NULL, 3, 2193, 'demo', 'demo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderDetailID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `UnitPrice` double NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`OrderDetailID`, `OrderID`, `ProductID`, `UnitPrice`, `Quantity`) VALUES
(1, 5, 1, 435, 1),
(2, 5, 1, 435, 2),
(3, 6, 1, 435, 4),
(4, 7, 1, 435, 3),
(5, 8, 1, 435, 3),
(6, 9, 1, 435, 3),
(7, 9, 2, 435, 4),
(8, 10, 1, 435, 2),
(9, 10, 2, 435, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `LocationID` int(11) DEFAULT NULL,
  `BrandID` int(11) DEFAULT NULL,
  `ProductTypeID` int(11) DEFAULT NULL,
  `GlassForID` int(11) DEFAULT NULL,
  `FrameStyleID` int(11) DEFAULT NULL,
  `FrameShapeID` int(11) DEFAULT NULL,
  `ProductName` varchar(100) NOT NULL,
  `UnitPrice` double DEFAULT NULL,
  `UnitsInStock` int(11) DEFAULT NULL,
  `UnitsOnOrder` int(11) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `LocationID`, `BrandID`, `ProductTypeID`, `GlassForID`, `FrameStyleID`, `FrameShapeID`, `ProductName`, `UnitPrice`, `UnitsInStock`, `UnitsOnOrder`, `CreatedAt`, `UpdatedAt`, `Status`) VALUES
(1, 1, 1, 1, 1, NULL, 4, 'CALVINKLEIN CK22109T', 435, 100, 0, NULL, NULL, 1),
(2, 1, 1, 1, 1, NULL, 4, 'CALVINKLEIN CK22526T', 435, 100, 0, NULL, NULL, 1),
(3, 1, 2, 1, 1, NULL, 4, 'NIKE 7090', 245, 100, 0, NULL, NULL, 1),
(4, 1, 2, 1, 4, NULL, 4, 'NIKE 7304', 199, 100, 0, NULL, NULL, 1),
(5, 1, 3, 1, 4, NULL, NULL, 'RAYBAN RX5154', 206, 100, 0, NULL, NULL, 1),
(6, 1, 3, 1, 1, NULL, NULL, 'RAYBAN RX5279', 167, 100, 0, NULL, NULL, 1),
(7, 1, 4, 1, 1, NULL, 4, 'FERRAGAMO SF2894', 294, 100, 0, NULL, NULL, 1),
(8, 1, 4, 1, 1, NULL, 4, 'FERRAGAMO SF2941', 378, 100, 0, NULL, NULL, 1),
(9, 1, 6, 3, NULL, 4, NULL, 'ACUVUE OASYS with HYDRACLEAR PLUS 12pk', 385.16, 100, 0, NULL, NULL, 1),
(10, 1, 7, 3, NULL, 4, NULL, 'Biotrue ONEday 30pk', 39.99, 100, 0, NULL, NULL, 1),
(11, 1, 8, 3, NULL, 6, NULL, 'FreshLook ColorBlends 6pk', 82.99, 100, 0, NULL, NULL, 1),
(12, 1, 1, 2, 4, NULL, 2, 'CALVIN KLEIN CK22110TS', 499, 100, 0, NULL, NULL, 1),
(13, 1, 1, 2, 4, NULL, 2, 'CALVIN KLEIN CK22112TS', 499, 100, 0, NULL, NULL, 1),
(14, 1, 1, 2, 2, NULL, 4, 'CALVIN KLEIN CK23500S', 219, 100, 0, NULL, NULL, 1),
(15, 1, 2, 2, 4, NULL, 1, 'NIKE CLUB NINE DQ0799', 177, 100, 0, NULL, NULL, 1),
(16, 1, 2, 2, 4, NULL, 1, 'NIKE CLUB PREMIER P DQ0920', 221, 100, 0, NULL, NULL, 1),
(17, 1, 2, 2, 4, NULL, 2, 'NIKE NEO RD M DV2297', 327, 100, 0, NULL, NULL, 1),
(18, 1, 3, 2, 1, NULL, 1, 'RAY-BAN RB3025 AVIATOR', 196, 100, 0, NULL, NULL, 1),
(19, 1, 3, 2, 1, NULL, 2, 'RAY-BAN RB3447', 169, 100, 0, NULL, NULL, 1),
(20, 1, 3, 2, 1, NULL, NULL, 'RAY-BAN RB3016 CLUBMASTER', 169, 100, 0, NULL, NULL, 1),
(22, 1, 5, 2, 2, NULL, NULL, 'MAUI JIM TWO STEPS', 293, 100, 0, NULL, NULL, 1),
(23, 1, 5, 2, 4, NULL, 1, 'MAUI JIM KEOKEA', 261, 100, 0, NULL, NULL, 1),
(24, 1, 5, 2, 4, NULL, 1, 'MAUI JIM WIKI WIKI', 335, 100, 0, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productcolor`
--

CREATE TABLE `productcolor` (
  `ProductID` int(11) NOT NULL,
  `ColorID` int(11) NOT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productcolor`
--

INSERT INTO `productcolor` (`ProductID`, `ColorID`, `Status`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(2, 4, 1),
(2, 6, 1),
(3, 12, 1),
(3, 13, 1),
(4, 8, 1),
(4, 12, 1),
(5, 14, 1),
(7, 5, 1),
(8, 15, 1),
(12, 2, 1),
(13, 2, 1),
(14, 2, 1),
(15, 2, 1),
(16, 2, 1),
(17, 2, 1),
(18, 2, 1),
(19, 2, 1),
(20, 2, 1),
(22, 2, 1),
(23, 2, 1),
(24, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `ProductTypeID` int(11) NOT NULL,
  `ProductTypeName` varchar(45) NOT NULL,
  `Description` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`ProductTypeID`, `ProductTypeName`, `Description`, `Status`) VALUES
(1, 'Eyeglasses', 'Eyeconic makes it easy to shop for glasses online. Free shipping and returns on all orders.', 1),
(2, 'Sunglasses', 'Find the perfect shades to show off your\nstyle & shield your eyes from harmful UV rays.', 1),
(3, 'Contact Lenses', 'Shop daily disposables, toric lenses, multifocal contacts, and more.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `RoleName`, `Status`) VALUES
(1, 'Admin', 1),
(2, 'Customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipper`
--

CREATE TABLE `shipper` (
  `ShipperID` int(11) NOT NULL,
  `ShipperName` varchar(45) DEFAULT NULL,
  `Fee` float DEFAULT NULL,
  `CompanyName` varchar(50) NOT NULL,
  `Phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipper`
--

INSERT INTO `shipper` (`ShipperID`, `ShipperName`, `Fee`, `CompanyName`, `Phone`) VALUES
(1, 'Standard Shipping', 0, '', NULL),
(2, '2nd Day Shipping', 13, '', NULL),
(3, 'Next Day Shipping', 18, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Fullname` varchar(50) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `CreatedAt` datetime DEFAULT NULL,
  `UpdatedAt` datetime DEFAULT NULL,
  `Status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Fullname`, `Email`, `Phone`, `CreatedAt`, `UpdatedAt`, `Status`) VALUES
(1, 'Admin', 'admin', 'Admin', '', '', NULL, NULL, 1),
(23, 'test', '$2y$10$EiH3HRdNHaiF0eksOdBo1.K/8L.lHszAdUKtTs7s6dkqmAB0XXHP6', 'test', 'test@gmail.com', '1234', NULL, NULL, 1),
(24, 'demo', '$2y$10$AQ3Jf3nAdRWxiswm1VN.ku5Y11abfvf0c5uWm6yr48Axxu1yQm.4m', 'demo', 'demo@gmail.com', '12334', NULL, NULL, 1),
(25, 'test1', '$2y$10$F0UJ4YojU543oANuHNd4g.uNXQFOK80DRc7m3USOofeuw4T91IEZi', 'test1', 'test1@gmail.com', '23232', NULL, NULL, 1),
(26, 'test2', '$2y$10$g/nUBK5NnrxEax1X91j9pucD0onxF5ofoBYV83vj5A.kS/3Scgu/e', 'test2', 'test2@gmail.com', '32314', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userrole`
--

CREATE TABLE `userrole` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userrole`
--

INSERT INTO `userrole` (`UserID`, `RoleID`) VALUES
(1, 1),
(23, 2),
(24, 2),
(25, 2),
(26, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `FK_Cart_User` (`UserID`),
  ADD KEY `FK_Cart_Product` (`ProductID`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`ColorID`);

--
-- Indexes for table `frameshape`
--
ALTER TABLE `frameshape`
  ADD PRIMARY KEY (`FrameShapeID`);

--
-- Indexes for table `framestyle`
--
ALTER TABLE `framestyle`
  ADD PRIMARY KEY (`FrameStyleID`);

--
-- Indexes for table `glassfor`
--
ALTER TABLE `glassfor`
  ADD PRIMARY KEY (`GlassForID`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `FK_Image_Product` (`ProductID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_Order_User` (`UserID`),
  ADD KEY `FK_Order_Shipper` (`ShipVia`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD KEY `FK_OrderDetail_Order` (`OrderID`),
  ADD KEY `FK_OrderDetail_Product` (`ProductID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `FK_Product_FrameShape` (`FrameShapeID`),
  ADD KEY `FK_Product_Brand` (`BrandID`),
  ADD KEY `FK_Product_FrameStyle` (`FrameStyleID`),
  ADD KEY `FK_Product_Glassfor` (`GlassForID`),
  ADD KEY `FK_Product_Location` (`LocationID`),
  ADD KEY `FK_Product_Producttype` (`ProductTypeID`);

--
-- Indexes for table `productcolor`
--
ALTER TABLE `productcolor`
  ADD PRIMARY KEY (`ProductID`,`ColorID`),
  ADD KEY `FK_ProductColor_Color` (`ColorID`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`ProductTypeID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`ShipperID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `userrole`
--
ALTER TABLE `userrole`
  ADD PRIMARY KEY (`UserID`,`RoleID`),
  ADD KEY `FK_UserRole_Role` (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `BrandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `ColorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `frameshape`
--
ALTER TABLE `frameshape`
  MODIFY `FrameShapeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `framestyle`
--
ALTER TABLE `framestyle`
  MODIFY `FrameStyleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `glassfor`
--
ALTER TABLE `glassfor`
  MODIFY `GlassForID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `ProductTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `ShipperID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_Cart_Product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Cart_User` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_Image_Product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_Order_Shipper` FOREIGN KEY (`ShipVia`) REFERENCES `shipper` (`ShipperID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Order_User` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `FK_OrderDetail_Order` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_OrderDetail_Product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_Product_Brand` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`BrandID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Product_FrameShape` FOREIGN KEY (`FrameShapeID`) REFERENCES `frameshape` (`FrameShapeID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Product_FrameStyle` FOREIGN KEY (`FrameStyleID`) REFERENCES `framestyle` (`FrameStyleID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Product_Glassfor` FOREIGN KEY (`GlassForID`) REFERENCES `glassfor` (`GlassForID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Product_Location` FOREIGN KEY (`LocationID`) REFERENCES `location` (`LocationID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Product_Producttype` FOREIGN KEY (`ProductTypeID`) REFERENCES `producttype` (`ProductTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productcolor`
--
ALTER TABLE `productcolor`
  ADD CONSTRAINT `FK_ProductColor_Color` FOREIGN KEY (`ColorID`) REFERENCES `color` (`ColorID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ProductColor_Product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userrole`
--
ALTER TABLE `userrole`
  ADD CONSTRAINT `FK_UserRole_Role` FOREIGN KEY (`RoleID`) REFERENCES `role` (`RoleID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_UserRole_User` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
