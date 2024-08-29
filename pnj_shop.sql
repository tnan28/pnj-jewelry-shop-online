-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 26, 2024 lúc 10:11 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pnj_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `AdminID` varchar(36) NOT NULL,
  `USERNAME` varchar(256) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`AdminID`, `USERNAME`, `PASSWORD`) VALUES
('61d4099b-0f4c-11ef-a5be-7c10c9285457', 'Admin', 'e64b78fc3bc91bcbc7dc232ba8ec59e0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `CATEGORYID` int(11) NOT NULL,
  `CATEGORYNAME` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`CATEGORYID`, `CATEGORYNAME`) VALUES
(1, 'Trang Sức'),
(2, 'Trang Sức Cưới'),
(3, 'Đồng Hồ'),
(4, 'Quà Tặng'),
(5, 'Thương Hiệu');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_attributes`
--

CREATE TABLE `category_attributes` (
  `CATEGORY_ATTRIBUTEID` int(11) NOT NULL,
  `CATEGORY_ATTRIBUTENAME` varchar(256) NOT NULL,
  `CATEGORYID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category_attributes`
--

INSERT INTO `category_attributes` (`CATEGORY_ATTRIBUTEID`, `CATEGORY_ATTRIBUTENAME`, `CATEGORYID`) VALUES
(1, 'Chủng Loại', 1),
(2, 'Chất Liệu', 1),
(3, 'Dòng Hàng', 1),
(4, 'Bộ Sưu Tập', 1),
(5, 'Theo Mục Đích', 2),
(6, 'Chủng Loại', 2),
(7, 'Dòng Trang Sức', 2),
(8, 'Chất Liệu', 2),
(9, 'Bộ Sưu Tập', 2),
(10, 'Thương Hiệu Thụy Sỹ', 3),
(11, 'Thương Hiệu Nhật Bản', 3),
(12, 'Thương Hiệu Thời Trang', 3),
(13, 'Thương Hiệu Khác', 3),
(14, 'Giới Tính', 3),
(15, 'Chủng Loại', 3),
(16, 'Bộ Máy', 3),
(17, 'Gợi Ý Quà Tặng', 4),
(18, 'Quà Tặng Mỹ Nghệ', 4),
(19, 'Thương Hiệu', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_attributes_detail`
--

CREATE TABLE `category_attributes_detail` (
  `CATEGORY_ATTRIBUTES_DETAILID` int(11) NOT NULL,
  `CATEGORY_ATTRIBUTES_DETAILNAME` varchar(256) NOT NULL,
  `CATEGORY_ATTRIBUTEID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category_attributes_detail`
--

INSERT INTO `category_attributes_detail` (`CATEGORY_ATTRIBUTES_DETAILID`, `CATEGORY_ATTRIBUTES_DETAILNAME`, `CATEGORY_ATTRIBUTEID`) VALUES
(1, 'Nhẫn', 1),
(2, 'Dây Chuyền', 1),
(3, 'Mặt Dây Chuyền', 1),
(4, 'Bông Tai', 1),
(5, 'Lắc', 1),
(6, 'Vòng', 1),
(7, 'Charm', 1),
(8, 'Dây Cổ', 1),
(9, 'Kiềng', 1),
(10, 'Vòng Tài Lộc', 1),
(11, 'Vàng', 2),
(12, 'Bạc', 2),
(13, 'Platinum', 2),
(14, 'Trang Sức Đính Kim Cương\r\n', 3),
(15, 'Trang Sức Đính ECZ\r\n', 3),
(16, 'Trang Sức Đính Đá Quý Và Bán Quý\r\n', 3),
(17, 'Trang Sức Công Nghệ Ý\r\n', 3),
(18, 'Trang Sức Đính Ngọc Trai\r\n', 3),
(19, 'Trang Sức Đính CZ\r\n', 3),
(20, 'Trang Sức Không Đính Đá\r\n', 3),
(21, 'Kim Cương Viên', 3),
(22, 'You\'re The Apple Of My Eyesale\r\n', 4),
(23, 'The Shining Princesssale\r\n', 4),
(24, 'Love Potionsale\r\n', 4),
(25, 'Lucky Mesale\r\n', 4),
(26, 'Sunnyva\r\n', 4),
(27, 'Audax Rosa\r\n', 4),
(28, 'Kim Bảo Như Ý\r\n', 4),
(29, 'Kim Long Trường Cửu\r\n', 4),
(30, 'The Story In Your Rings\r\n', 4),
(31, 'The Heart Of Gold\r\n', 4),
(32, 'Masterpiece\r\n', 4),
(33, 'Timeless Diamond', 4),
(34, 'Cầu Hôn', 5),
(35, 'Kết Hôn', 5),
(36, 'Kỷ Niệm', 5),
(46, 'Nhẫn Cặp\r\n', 6),
(47, 'Nhẫn\r\n', 6),
(48, 'Dây Cổ\r\n', 6),
(49, 'Kiềng\r\n', 6),
(50, 'Vòng Tay\r\n', 6),
(51, 'Lắc\r\n', 6),
(52, 'Bông Tai\r\n', 6),
(53, 'Mặt Dây Chuyền\r\n', 6),
(54, 'Charm', 6),
(55, 'Kim Cương\r\n', 7),
(56, 'ECZ-CZ\r\n', 7),
(57, 'Không Đính Đá\r\n', 7),
(58, 'Đá Màu', 7),
(64, 'Vàng 24K\r\n', 8),
(65, 'Vàng 22K\r\n', 8),
(66, 'Vàng 18K\r\n', 8),
(67, 'Vàng 14K\r\n', 8),
(68, 'Vàng 10K', 8),
(69, 'Trầu Cau PNJsale\r\n', 9),
(70, 'The Heart Of Goldsale\r\n', 9),
(71, 'The Story In Your Rings\r\n', 9),
(72, 'The Moment\r\n', 9),
(73, 'Báu Vật Phu Thê\r\n', 9),
(74, 'Hạnh Phúc\r\n', 9),
(75, 'Long Phụng Sum Vầy\r\n', 9),
(76, 'Vũ Khúc Tình Yêu\r\n', 9),
(77, 'Thiên Duyên\r\n', 9),
(78, 'Bốn Mùa Yêu Thương\r\n', 9),
(79, 'Hoa Tình Yêu', 9),
(80, 'Longines\r\n', 10),
(81, 'Tissot sale\r\n', 10),
(82, 'Jowissa \r\n', 10),
(83, 'Silvana \r\n', 10),
(84, 'Jacques Du Manoir\r\n', 10),
(85, 'Claude Bernard', 10),
(86, 'Citizen\r\n', 11),
(87, 'Casio\r\n', 11),
(88, 'Orient', 11),
(89, 'Titan\r\n', 12),
(90, 'Daniel Wellington\r\n', 12),
(91, 'Calvin Klein\r\n', 12),
(92, 'Michael Kors\r\n', 12),
(93, 'Fossil\r\n', 12),
(94, 'Skagen', 12),
(95, '', 12),
(96, 'Emily Carter \r\n', 13),
(97, 'Avi-8 \r\n', 13),
(98, 'Olivia Burton\r\n', 13),
(99, 'Kenneth Cole\r\n', 13),
(100, 'Just Cavalli\r\n', 13),
(101, 'Lancaster \r\n', 13),
(102, 'Hamilton', 13),
(103, 'Nam', 14),
(104, 'Nữ', 14),
(105, 'Unisex', 14),
(106, 'Đồng Hồ\r\n', 15),
(107, 'Đồng Hồ Cặp\r\n', 15),
(108, 'Phụ Kiện\r\n', 15),
(109, 'Mắt Kính', 15),
(111, 'Quartz (Pin)\r\n', 16),
(112, 'Automatic (Cơ Tự Động)\r\n', 16),
(113, 'Eco-Drive\r\n', 16),
(114, 'Powermatic 80\r\n', 16),
(115, 'Solar (Pin Mặt Trời)', 16),
(116, 'Cho Nàng\r\n', 17),
(117, 'Cho Chàng\r\n', 17),
(118, 'Cho Cha\r\n', 17),
(119, 'Cho Mẹ\r\n', 17),
(120, 'Cho Bé', 17),
(121, 'Tượng Phong Thủy\r\n', 18),
(122, 'Tranh Phong Thủy', 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `CUSTOMERID` varchar(36) NOT NULL,
  `CUSTOMERNAME` varchar(256) DEFAULT NULL,
  `PHONENUMBER` varchar(10) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`CUSTOMERID`, `CUSTOMERNAME`, `PHONENUMBER`, `EMAIL`) VALUES
('6653552e3261c', 'Nguyễn Xuân Trường', '0971758902', 'truongtamcobra@gmail.com'),
('665381c730afb', 'Nguyễn A', '0971758903', 'truong123@gmail.com'),
('6653873fd1e68', 'Nguyễn A', '0971758904', 'truong123'),
('665387a864dee', 'Nguyễn B', '0971758906', 'truong123@gmail.com'),
('66538ff556ae1', 'Nguyễn C', '0971758908', 'truong123@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `EMPLOYEEID` varchar(36) NOT NULL,
  `FULLNAME` varchar(256) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONENUMBER` varchar(10) DEFAULT NULL,
  `SALARY` decimal(10,2) DEFAULT NULL,
  `HIRE_DATE` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employee`
--

INSERT INTO `employee` (`EMPLOYEEID`, `FULLNAME`, `EMAIL`, `PHONENUMBER`, `SALARY`, `HIRE_DATE`) VALUES
('3e2ecc5d-f411-11ee-99ea-7c10c9285457', 'Trần Nguyễn Ánh Nhi', 'tnan@gmail.com', '0396979034', 50000000.00, '2020-10-28 00:00:00.000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `ORDERDETAILID` varchar(36) NOT NULL,
  `QUANTITY` int(11) DEFAULT NULL,
  `TOTAL` decimal(10,2) DEFAULT NULL,
  `ORDERID` varchar(36) NOT NULL,
  `PRODUCT_SIZEID` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`ORDERDETAILID`, `QUANTITY`, `TOTAL`, `ORDERID`, `PRODUCT_SIZEID`) VALUES
('ad51e2fe-1b97-11ef-9900-7c10c9285457', 2, 99999999.99, '66538ff5575b9', 'f4e6851e-1b69-11ef-9362-7c10c9285457'),
('fee7f9de-1b95-11ef-9900-7c10c9285457', 2, 700000.00, '66538d2338d33', 'e37ec50e-1b67-11ef-9362-7c10c9285457');

--
-- Bẫy `orderdetail`
--
DELIMITER $$
CREATE TRIGGER `calculate_orderdetail_total` BEFORE INSERT ON `orderdetail` FOR EACH ROW BEGIN
    DECLARE detail_total DECIMAL(10, 2);

    -- Tính toán tổng giá trị của chi tiết đơn hàng
    SET detail_total = NEW.quantity * (SELECT price FROM product_size WHERE PRODUCT_SIZEID = NEW.PRODUCT_SIZEID);

    -- Gán giá trị tổng cho NEW.total
    SET NEW.total = detail_total;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `reduce_stock_after_purchase` AFTER INSERT ON `orderdetail` FOR EACH ROW BEGIN
    DECLARE product_id VARCHAR(36);
    DECLARE quantity_purchased INT;

    SELECT orderdetail.PRODUCT_SIZEID, orderdetail.QUANTITY INTO product_id, quantity_purchased
    FROM orderdetail
    WHERE orderdetail.PRODUCT_SIZEID = NEW.PRODUCT_SIZEID;

    UPDATE product_size
    SET product_size.QUANTITY = product_size.QUANTITY - quantity_purchased
    WHERE product_size.PRODUCT_SIZEID = product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_order_total` AFTER INSERT ON `orderdetail` FOR EACH ROW BEGIN
    DECLARE order_total DECIMAL(10, 2);

    -- Tính toán tổng giá trị của tất cả các chi tiết đơn hàng trong đơn hàng này
    SET order_total = (SELECT SUM(total) FROM orderdetail WHERE ORDERID = NEW.ORDERID);

    -- Cập nhật tổng giá trị vào cột total của bảng order
    UPDATE `orders` SET total = order_total WHERE ORDERS.ORDERID = NEW.ORDERID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `ORDERID` varchar(36) NOT NULL,
  `TOTAL` decimal(10,2) DEFAULT NULL,
  `CREATEAT` datetime(3) DEFAULT current_timestamp(3),
  `STATUS` int(11) DEFAULT NULL,
  `ADDRESS` longtext DEFAULT NULL,
  `CUSTOMERID` varchar(36) NOT NULL,
  `SHIPPINGMETHODID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`ORDERID`, `TOTAL`, `CREATEAT`, `STATUS`, `ADDRESS`, `CUSTOMERID`, `SHIPPINGMETHODID`) VALUES
('66538d2338d33', 700000.00, '2024-05-27 02:27:31.000', 2, NULL, '665381c730afb', 1),
('66538ff5575b9', 99999999.99, '2024-05-27 02:39:33.000', 2, NULL, '66538ff556ae1', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `PAYMENTMETHODID` int(11) NOT NULL,
  `PAYMENTMETHODNAME` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `paymentmethods`
--

INSERT INTO `paymentmethods` (`PAYMENTMETHODID`, `PAYMENTMETHODNAME`) VALUES
(1, 'Ngân Hàng'),
(2, 'Thanh Toán Khi Nhân Hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `paymentmethod_order`
--

CREATE TABLE `paymentmethod_order` (
  `PAYMENTMETHODID` int(11) NOT NULL,
  `ORDERID` varchar(36) NOT NULL,
  `STATUS` datetime(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `paymentmethod_order`
--

INSERT INTO `paymentmethod_order` (`PAYMENTMETHODID`, `ORDERID`, `STATUS`) VALUES
(2, '66538d2338d33', '2024-05-27 02:44:26.000'),
(2, '66538ff5575b9', '2024-05-27 02:44:33.000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `PRODUCTID` varchar(36) NOT NULL,
  `PRODUCTNAME` varchar(255) DEFAULT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `IS_DELETE` int(11) DEFAULT NULL,
  `IMAGE_1` varchar(255) DEFAULT NULL,
  `IMAGE_2` varchar(255) DEFAULT NULL,
  `IMAGE_3` varchar(255) DEFAULT NULL,
  `IMAGE_4` varchar(255) DEFAULT NULL,
  `IMAGE_5` varchar(255) DEFAULT NULL,
  `CATEGORY_ATTRIBUTES_DETAILID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`PRODUCTID`, `PRODUCTNAME`, `PRICE`, `IS_DELETE`, `IMAGE_1`, `IMAGE_2`, `IMAGE_3`, `IMAGE_4`, `IMAGE_5`, `CATEGORY_ATTRIBUTES_DETAILID`) VALUES
('66533fc8632d2', 'Nhẫn trẻ em Bạc đính đá PNJSilver XMXMW060163', 350000.00, 0, '66533fc85ece3.png', '66533fc85f1fd.png', '66533fc85f992.png', '66533fc85fea7.png', '66533fc86069b.png', 1),
('66534161955ce', 'Nhẫn Kim cương Vàng trắng 14K PNJ DDMXW060002', 14030000.00, 0, '665341618dada.png', '665341618df81.png', '665341618e8c7.png', '665341618f232.png', '665341618f90a.png', 1),
('665341f681b37', 'Dây chuyền Vàng Ý 18K PNJ 0000Y012000', 12409000.00, 0, '665341f675806.png', '665341f675dad.png', '665341f6762d7.png', '665341f6768ab.png', '665341f6773b3.png', 2),
('66534260662a6', 'Dây chuyền Vàng 14K PNJ 0000Y060532', 15390000.00, 0, '66534260579c3.png', '6653426057fa5.png', '66534260584d5.png', '6653426058bf2.png', '6653426059697.png', 2),
('665342e1a5c5c', 'Dây chuyền Vàng 14K PNJ 0000Y060531', 33650000.00, 0, '665342e1a2f28.png', '665342e1a3583.png', '665342e1a397b.png', '665342e1a3c82.png', '665342e1a4189.png', 2),
('6653434092658', 'Cặp nhẫn cưới Vàng 24K PNJ Long phụng 02373-02374', 51499500.00, 0, '665343408e0f8.png', '665343408e815.png', '665343408ed62.png', '665343408f27d.png', '665343408f8a8.png', 46),
('66534386e1ea1', 'Cặp nhẫn cưới Kim cương Vàng trắng 14K Disney|PNJ 04375-04374', 16878000.00, 0, '66534386df76a.png', '66534386dfc35.png', '66534386e0182.png', '66534386e0544.png', '66534386e0820.png', 46),
('665343d4c1291', 'Cặp Nhẫn cưới Kim cương Vàng 18K Disney|PNJ 01107-01108', 23453000.00, 0, '665343d4bdf42.png', '665343d4be6c3.png', '665343d4beb5f.png', '665343d4bf29b.png', '665343d4bf81c.png', 46),
('66534423a272a', 'Cặp nhẫn cưới Kim cương Vàng 18K PNJ 00923-00924', 27026000.00, 0, '665344239fc4e.png', '66534423a0321.png', '66534423a0809.png', '66534423a0afe.png', '66534423a0dc8.png', 46),
('6653448fdd6b5', 'Cặp nhẫn cưới Vàng 18K PNJ 01984-01985', 19137000.00, 0, '6653448fd787d.png', '6653448fd7c09.png', '6653448fd8105.png', '6653448fd863b.png', '6653448fd8bdb.png', 46),
('66534623cd571', 'Cặp nhẫn cưới Vàng 18K PNJ The moment 01037-00622', 26703000.00, 0, '66534623c51e7.png', '66534623c57ed.png', '66534623c5c4f.png', '66534623c5ff0.png', '66534623c6381.png', 46),
('66534623d2693', 'Cặp nhẫn cưới Kim cương Vàng trắng 14K PNJ Long Phụng 01311-00640', 22865000.00, 0, '66534623ce95e.png', '66534623cf025.png', '66534623cf76c.png', '66534623cff06.png', '66534623d02cc.png', 46),
('665346e04b06d', 'Cặp nhẫn cưới Kim cương Vàng 18K PNJ Vàng Son 00633-00313', 11971000.00, 0, '665346e045aa8.png', '665346e04622b.png', '665346e046c99.png', '665346e0473f0.png', '665346e047aa0.png', 46),
('6653474057748', 'Cặp nhẫn cưới Kim cương Vàng 18K PNJ Chung Đôi 00009-00004', 20655000.00, 0, '665347404a80a.png', '665347404b3d4.png', '665347404bd28.png', '665347404c8c4.png', '665347404d63c.png', 46),
('665391bfbe1b0', 'Nhẫn Kim cương Vàng 14K PNJ DDMXW060002', 50000000.00, 0, '665391bfac7c8.png', '665391bfacdcd.png', '665391bfad6ec.png', '665391bfae444.png', '665391bfaefb0.png', 46);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_size`
--

CREATE TABLE `product_size` (
  `PRODUCT_SIZEID` varchar(36) NOT NULL,
  `PRICE` decimal(10,2) DEFAULT NULL,
  `QUANTITY` int(11) DEFAULT NULL,
  `SIZEID` int(11) NOT NULL,
  `PRODUCTID` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_size`
--

INSERT INTO `product_size` (`PRODUCT_SIZEID`, `PRICE`, `QUANTITY`, `SIZEID`, `PRODUCTID`) VALUES
('1ddb7009-1b6c-11ef-9362-7c10c9285457', 11971000.00, 50, 57, '665346e04b06d'),
('1ed110fa-1b6a-11ef-9362-7c10c9285457', 16878000.00, 50, 57, '66534386e1ea1'),
('3029c7b6-1b69-11ef-9362-7c10c9285457', 11992000.00, 50, 42, '665341f681b37'),
('302a52d5-1b69-11ef-9362-7c10c9285457', 11992000.00, 50, 43, '665341f681b37'),
('302a93af-1b69-11ef-9362-7c10c9285457', 12717000.00, 50, 45, '665341f681b37'),
('4d3ac70b-1b6a-11ef-9362-7c10c9285457', 23453000.00, 50, 57, '665343d4c1291'),
('571b786d-1b6c-11ef-9362-7c10c9285457', 20655000.00, 50, 57, '6653474057748'),
('6f4750cd-1b69-11ef-9362-7c10c9285457', 15390000.00, 50, 42, '66534260662a6'),
('6f4782d8-1b69-11ef-9362-7c10c9285457', 15390000.00, 50, 45, '66534260662a6'),
('7c3dbd51-1b6a-11ef-9362-7c10c9285457', 27026000.00, 50, 57, '66534423a272a'),
('ad85b553-1b6b-11ef-9362-7c10c9285457', 26703000.00, 50, 57, '66534623cd571'),
('ad88b9b2-1b6b-11ef-9362-7c10c9285457', 22865000.00, 50, 57, '66534623d2693'),
('bc52805d-1b69-11ef-9362-7c10c9285457', 33650000.00, 48, 55, '665342e1a5c5c'),
('bcc25b47-1b6a-11ef-9362-7c10c9285457', 19137000.00, 50, 57, '6653448fdd6b5'),
('be8f55e2-1b98-11ef-9900-7c10c9285457', 51000000.00, 100, 57, '665391bfbe1b0'),
('d766ce80-1b68-11ef-9362-7c10c9285457', 14030000.00, 50, 11, '66534161955ce'),
('d767032d-1b68-11ef-9362-7c10c9285457', 14030000.00, 50, 12, '66534161955ce'),
('d7676cb2-1b68-11ef-9362-7c10c9285457', 14030000.00, 50, 13, '66534161955ce'),
('e37ec50e-1b67-11ef-9362-7c10c9285457', 350000.00, 50, 6, '66533fc8632d2'),
('e37f0442-1b67-11ef-9362-7c10c9285457', 350000.00, 50, 7, '66533fc8632d2'),
('f4e6851e-1b69-11ef-9362-7c10c9285457', 51499500.00, 50, 56, '6653434092658');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchaseinvoices`
--

CREATE TABLE `purchaseinvoices` (
  `PURCHASEINVOICEID` varchar(36) NOT NULL,
  `TOTAL` decimal(15,2) DEFAULT NULL,
  `CREATEAT` datetime(3) DEFAULT NULL,
  `STATUS` int(11) NOT NULL,
  `SUPPLIERID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `purchaseinvoices`
--

INSERT INTO `purchaseinvoices` (`PURCHASEINVOICEID`, `TOTAL`, `CREATEAT`, `STATUS`, `SUPPLIERID`) VALUES
('665358a360e897.72298819', 99999999.99, '2024-05-26 17:43:31.000', 1, 1),
('665358c64a4ed4.38328330', 99999999.99, '2024-05-26 17:44:06.000', 1, 1),
('66535a898e5f47.04813762', 99999999.99, '2024-05-26 17:51:37.000', 1, 1),
('66535ae1ef4dd8.00924487', 50000000.00, '2024-05-26 17:53:05.000', 1, 1),
('665394b6030998.71807868', 50000000.00, '2024-05-26 21:59:50.000', 1, 1),
('66539549f32bd4.82326022', 99999999.99, '2024-05-26 22:02:17.000', 1, 1),
('6653972933f3c5.01514709', 4000000.00, '2024-05-26 22:10:17.000', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchaseinvoice_detail`
--

CREATE TABLE `purchaseinvoice_detail` (
  `PURCHASEINVOICE_DETAILID` varchar(36) NOT NULL,
  `TOTAL` decimal(10,2) DEFAULT NULL,
  `QUANTITY` int(11) DEFAULT NULL,
  `PURCHASEINVOICEID` varchar(36) DEFAULT NULL,
  `PRODUCT_SIZEID` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `purchaseinvoice_detail`
--

INSERT INTO `purchaseinvoice_detail` (`PURCHASEINVOICE_DETAILID`, `TOTAL`, `QUANTITY`, `PURCHASEINVOICEID`, `PRODUCT_SIZEID`) VALUES
('665358a361be53.71395037', 19000000.00, 50, '665358a360e897.72298819', 'e37ec50e-1b67-11ef-9362-7c10c9285457'),
('665358a362ad86.32182202', 19000000.00, 50, '665358a360e897.72298819', 'e37f0442-1b67-11ef-9362-7c10c9285457'),
('665358c64abd67.98651326', 50000000.00, 50, '665358c64a4ed4.38328330', 'd766ce80-1b68-11ef-9362-7c10c9285457'),
('665358c64b91d7.49562998', 50000000.00, 50, '665358c64a4ed4.38328330', 'd767032d-1b68-11ef-9362-7c10c9285457'),
('66535a898ec051.14517347', 300000.00, 50, '66535a898e5f47.04813762', 'd7676cb2-1b68-11ef-9362-7c10c9285457'),
('66535a898fea22.87099557', 3000000.00, 50, '66535a898e5f47.04813762', '3029c7b6-1b69-11ef-9362-7c10c9285457'),
('66535a8990bc33.58922329', 1000000.00, 50, '66535a898e5f47.04813762', '302a52d5-1b69-11ef-9362-7c10c9285457'),
('66535a899103a9.28843505', 100000.00, 50, '66535a898e5f47.04813762', '302a93af-1b69-11ef-9362-7c10c9285457'),
('66535ae1efba90.64030577', 500000.00, 50, '66535ae1ef4dd8.00924487', '6f4750cd-1b69-11ef-9362-7c10c9285457'),
('66535ae1f09448.39281788', 500000.00, 50, '66535ae1ef4dd8.00924487', '6f4782d8-1b69-11ef-9362-7c10c9285457'),
('665394b603bdb0.74818214', 1000000.00, 50, '665394b6030998.71807868', 'be8f55e2-1b98-11ef-9900-7c10c9285457'),
('66539549f383f2.02210602', 50000000.00, 8, '66539549f32bd4.82326022', 'e37ec50e-1b67-11ef-9362-7c10c9285457'),
('66539549f3cc99.95294838', 10000000.00, 2, '66539549f32bd4.82326022', 'd767032d-1b68-11ef-9362-7c10c9285457'),
('66539729345de9.69186634', 1000000.00, 2, '6653972933f3c5.01514709', 'f4e6851e-1b69-11ef-9362-7c10c9285457'),
('6653972935a4b4.67556537', 1000000.00, 2, '6653972933f3c5.01514709', 'e37f0442-1b67-11ef-9362-7c10c9285457');

--
-- Bẫy `purchaseinvoice_detail`
--
DELIMITER $$
CREATE TRIGGER `update_invoice_total` AFTER INSERT ON `purchaseinvoice_detail` FOR EACH ROW BEGIN
    DECLARE total DECIMAL(10, 2);
    
    -- Tính tổng tiền mới của hóa đơn
    SELECT SUM(purchaseinvoice_detail.TOTAL * purchaseinvoice_detail.QUANTITY) INTO total 
    FROM purchaseinvoice_detail 
    WHERE purchaseinvoice_detail.PURCHASEINVOICEID = NEW.PURCHASEINVOICEID;
    
    UPDATE purchaseinvoices 
    SET purchaseinvoices.TOTAL = total 
    WHERE PURCHASEINVOICEID = NEW.PURCHASEINVOICEID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shippingmethods`
--

CREATE TABLE `shippingmethods` (
  `SHIPPINGMETHODID` int(11) NOT NULL,
  `SHIPPINGMETHODNAME` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shippingmethods`
--

INSERT INTO `shippingmethods` (`SHIPPINGMETHODID`, `SHIPPINGMETHODNAME`) VALUES
(1, 'Nhận tại cửa hàng'),
(2, 'Giao Hàng Tận Nơi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `SIZEID` int(11) NOT NULL,
  `SizeName` int(11) NOT NULL,
  `DESCRIPTION_SIZE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`SIZEID`, `SizeName`, `DESCRIPTION_SIZE`) VALUES
(1, 1, '1'),
(2, 2, '2'),
(3, 3, '3'),
(4, 4, '4'),
(5, 5, '5'),
(6, 6, '6'),
(7, 7, '7'),
(8, 8, '8'),
(9, 9, '9'),
(10, 10, '10'),
(11, 11, '11'),
(12, 12, '12'),
(13, 13, '13'),
(14, 14, '14'),
(15, 15, '15'),
(16, 16, '16'),
(17, 17, '17'),
(18, 18, '18'),
(19, 19, '19'),
(20, 20, '20'),
(21, 21, '21'),
(22, 22, '22'),
(23, 23, '23'),
(24, 24, '24'),
(25, 25, '25'),
(26, 26, '26'),
(27, 27, '27'),
(28, 28, '28'),
(29, 29, '29'),
(30, 30, '30'),
(31, 31, '31'),
(32, 32, '32'),
(33, 33, '33'),
(34, 34, '34'),
(35, 35, '35'),
(36, 36, '36'),
(37, 37, '37'),
(38, 38, '38'),
(39, 39, '39'),
(40, 40, '40'),
(41, 41, '41'),
(42, 42, '42'),
(43, 43, '43'),
(44, 44, '44'),
(45, 45, '45'),
(46, 46, '46'),
(47, 47, '47'),
(48, 48, '48'),
(49, 49, '49'),
(50, 50, '50'),
(51, 51, '51'),
(52, 52, '52'),
(53, 52, '53'),
(54, 54, '54'),
(55, 55, '55'),
(56, 56, 'Over Size'),
(57, 57, 'Not Size');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `SUPPLIERID` int(11) NOT NULL,
  `SUPPLIERNAME` varchar(255) DEFAULT NULL,
  `ADDRESS` varchar(256) DEFAULT NULL,
  `PHONUMBER` varchar(12) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `suppliers`
--

INSERT INTO `suppliers` (`SUPPLIERID`, `SUPPLIERNAME`, `ADDRESS`, `PHONUMBER`, `EMAIL`) VALUES
(1, 'Tiffany & Co.', '727 Fifth Avenue, New York, NY 10022, Hoa Kỳ', '1212755800', 'TiffanyCo@gmail.com'),
(2, 'Cartier', '653 Fifth Avenue, New York, NY 10022, Hoa Kỳ', '1212446340', 'Cartier@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CATEGORYID`);

--
-- Chỉ mục cho bảng `category_attributes`
--
ALTER TABLE `category_attributes`
  ADD PRIMARY KEY (`CATEGORY_ATTRIBUTEID`),
  ADD KEY `CATEGORYID` (`CATEGORYID`);

--
-- Chỉ mục cho bảng `category_attributes_detail`
--
ALTER TABLE `category_attributes_detail`
  ADD PRIMARY KEY (`CATEGORY_ATTRIBUTES_DETAILID`),
  ADD KEY `CATEGORY_ATTRIBUTEID` (`CATEGORY_ATTRIBUTEID`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CUSTOMERID`);

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EMPLOYEEID`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`ORDERDETAILID`),
  ADD KEY `ORDERID` (`ORDERID`),
  ADD KEY `PRODUCT_SIZEID` (`PRODUCT_SIZEID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ORDERID`),
  ADD KEY `CUSTOMERID` (`CUSTOMERID`),
  ADD KEY `SHIPPINGMETHODID` (`SHIPPINGMETHODID`);

--
-- Chỉ mục cho bảng `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`PAYMENTMETHODID`);

--
-- Chỉ mục cho bảng `paymentmethod_order`
--
ALTER TABLE `paymentmethod_order`
  ADD PRIMARY KEY (`PAYMENTMETHODID`,`ORDERID`),
  ADD KEY `ORDERID` (`ORDERID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCTID`),
  ADD KEY `CATEGORY_ATTRIBUTES_DETAILID` (`CATEGORY_ATTRIBUTES_DETAILID`);

--
-- Chỉ mục cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`PRODUCT_SIZEID`),
  ADD UNIQUE KEY `UC_Product_Size` (`PRODUCTID`,`SIZEID`),
  ADD KEY `SIZEID` (`SIZEID`);

--
-- Chỉ mục cho bảng `purchaseinvoices`
--
ALTER TABLE `purchaseinvoices`
  ADD PRIMARY KEY (`PURCHASEINVOICEID`),
  ADD KEY `SUPPLIERID` (`SUPPLIERID`);

--
-- Chỉ mục cho bảng `purchaseinvoice_detail`
--
ALTER TABLE `purchaseinvoice_detail`
  ADD PRIMARY KEY (`PURCHASEINVOICE_DETAILID`),
  ADD KEY `PRODUCT_SIZEID` (`PRODUCT_SIZEID`),
  ADD KEY `PURCHASEINVOICEID` (`PURCHASEINVOICEID`);

--
-- Chỉ mục cho bảng `shippingmethods`
--
ALTER TABLE `shippingmethods`
  ADD PRIMARY KEY (`SHIPPINGMETHODID`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`SIZEID`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`SUPPLIERID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `CATEGORYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `category_attributes`
--
ALTER TABLE `category_attributes`
  MODIFY `CATEGORY_ATTRIBUTEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `category_attributes_detail`
--
ALTER TABLE `category_attributes_detail`
  MODIFY `CATEGORY_ATTRIBUTES_DETAILID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT cho bảng `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `PAYMENTMETHODID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `shippingmethods`
--
ALTER TABLE `shippingmethods`
  MODIFY `SHIPPINGMETHODID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `size`
--
ALTER TABLE `size`
  MODIFY `SIZEID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `SUPPLIERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `category_attributes`
--
ALTER TABLE `category_attributes`
  ADD CONSTRAINT `category_attributes_ibfk_1` FOREIGN KEY (`CATEGORYID`) REFERENCES `category` (`CATEGORYID`);

--
-- Các ràng buộc cho bảng `category_attributes_detail`
--
ALTER TABLE `category_attributes_detail`
  ADD CONSTRAINT `category_attributes_detail_ibfk_1` FOREIGN KEY (`CATEGORY_ATTRIBUTEID`) REFERENCES `category_attributes` (`CATEGORY_ATTRIBUTEID`);

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`ORDERID`) REFERENCES `orders` (`ORDERID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`PRODUCT_SIZEID`) REFERENCES `product_size` (`PRODUCT_SIZEID`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CUSTOMERID`) REFERENCES `customer` (`CUSTOMERID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`SHIPPINGMETHODID`) REFERENCES `shippingmethods` (`SHIPPINGMETHODID`);

--
-- Các ràng buộc cho bảng `paymentmethod_order`
--
ALTER TABLE `paymentmethod_order`
  ADD CONSTRAINT `paymentmethod_order_ibfk_1` FOREIGN KEY (`ORDERID`) REFERENCES `orders` (`ORDERID`),
  ADD CONSTRAINT `paymentmethod_order_ibfk_2` FOREIGN KEY (`PAYMENTMETHODID`) REFERENCES `paymentmethods` (`PAYMENTMETHODID`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CATEGORY_ATTRIBUTES_DETAILID`) REFERENCES `category_attributes_detail` (`CATEGORY_ATTRIBUTES_DETAILID`);

--
-- Các ràng buộc cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`PRODUCTID`) REFERENCES `products` (`PRODUCTID`),
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`SIZEID`) REFERENCES `size` (`SIZEID`);

--
-- Các ràng buộc cho bảng `purchaseinvoices`
--
ALTER TABLE `purchaseinvoices`
  ADD CONSTRAINT `purchaseinvoices_ibfk_1` FOREIGN KEY (`SUPPLIERID`) REFERENCES `suppliers` (`SUPPLIERID`);

--
-- Các ràng buộc cho bảng `purchaseinvoice_detail`
--
ALTER TABLE `purchaseinvoice_detail`
  ADD CONSTRAINT `purchaseinvoice_detail_ibfk_1` FOREIGN KEY (`PRODUCT_SIZEID`) REFERENCES `product_size` (`PRODUCT_SIZEID`),
  ADD CONSTRAINT `purchaseinvoice_detail_ibfk_2` FOREIGN KEY (`PURCHASEINVOICEID`) REFERENCES `purchaseinvoices` (`PURCHASEINVOICEID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
