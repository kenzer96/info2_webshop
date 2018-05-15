DROP database IF EXISTS mobile_webshop;

CREATE database mobile_webshop
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;
	
USE `mobile_webshop`;


CREATE TABLE `customer` (
  `Id` int(11) AUTO_INCREMENT NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(1024) NOT NULL
)

CREATE TABLE `phone` (
  `Id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `IMEI_number` varchar(31) DEFAULT NULL,
  `guarantee_length` int(11) DEFAULT NULL,
  `ROM` int(11) NOT NULL,
  `RAM` int(11) NOT NULL,
  `display` varchar(50) DEFAULT NULL,
  `image` varchar(1024) NOT NULL,
  `in_stock` int(11) NOT NULL
)

INSERT INTO `phone` (`Id`, `manufacturer`, `name`, `IMEI_number`, `guarantee_length`, `ROM`, `RAM`, `display`, `image`, `in_stock`) VALUES(1, 'Homtom', 'Zoji Z8', '456456312486', 12, 16, 2, '5,0\" HD IPS 1280x720px', 'img/zoji_z8.png', 9);
INSERT INTO `phone` (`Id`, `manufacturer`, `name`, `IMEI_number`, `guarantee_length`, `ROM`, `RAM`, `display`, `image`, `in_stock`) VALUES(2, 'Samsung', 'Galaxy S8', '456165132', 6, 64, 4, '5,8\" QHD Super AMOLED 2960x1440px', 'img/samsung_s8.jpg', 3);
INSERT INTO `phone` (`Id`, `manufacturer`, `name`, `IMEI_number`, `guarantee_length`, `ROM`, `RAM`, `display`, `image`, `in_stock`) VALUES(3, 'Samsung', 'Galaxy S7', '489708798795', 12, 32, 4, '5,1\" QHD Super AMOLED 2560x1440px', '/img/samsung_s7.png', 5);


CREATE TABLE `purchase` (
  `Id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `phoneId` int(11) DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  `purchase_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY phoneId REFERENCES phone(Id),
  FOREIGN KEY customerId REFERENCES customer(Id)
)