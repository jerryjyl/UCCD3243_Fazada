-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2024 at 09:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fazada2`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`) VALUES
(189, 23, 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `orderDate` datetime NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `recipientName` varchar(50) NOT NULL,
  `phone_no` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `orderDate`, `subtotal`, `address`, `email`, `recipientName`, `phone_no`) VALUES
(59, 19, '2024-03-29 18:02:36', 284.00, '2018, Jalan Seksyen 2/2, 31900 Kampar, Perak', 'liongjunyong2002@gmail.com', 'Liong Jun Yong', '010-3999937'),
(60, 19, '2024-03-29 18:08:45', 255.00, '2018, Jalan Seksyen 2/2, 31900 Kampar, Perak', 'liongjunyong2002@gmail.com', 'Liong Jun Yong', '010-3999937'),
(61, 20, '2024-03-29 18:09:57', 147.00, '2022, Jalan Seksyen 2/3, 31900 Kampar, Perak', 'kawweixin@gmail.com', 'Kaw Wei Xin', '010-8768990'),
(62, 20, '2024-03-29 18:11:07', 272.00, '2022, Jalan Seksyen 2/3, 31900 Kampar, Perak', 'kawweixin@gmail.com', 'Kaw Wei Xin', '010-8768990'),
(63, 21, '2024-03-29 18:12:32', 452.00, '2122, Jalan Seksyen 2/4, 31900 Kampar, Perak', 'leeshengjiet@gmail.com', 'Lee Sheng Jiet', '012-3456789'),
(64, 21, '2024-03-29 18:13:39', 154.00, '2122, Jalan Seksyen 2/4, 31900 Kampar, Perak', 'leeshengjiet@gmail.com', 'Lee Sheng Jiet', '012-3456789'),
(65, 23, '2024-03-30 05:21:32', 315.00, '1, Kampung Air, 70000 Perak', 'martin@gmail.com', 'Martin', '011-2222222'),
(66, 23, '2024-03-30 16:03:51', 862.00, '1, Kampung Air, 70000 Perak', 'martin@gmail.com', 'Martin', '011-2222222');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` decimal(10,2) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `item_id`, `quantity`, `unitPrice`, `user_id`) VALUES
(59, 4, 1, 152.00, 19),
(59, 11, 1, 120.00, 19),
(59, 6, 1, 12.00, 19),
(60, 3, 1, 155.00, 19),
(60, 12, 1, 100.00, 19),
(61, 7, 1, 13.00, 20),
(61, 11, 1, 120.00, 20),
(61, 8, 1, 14.00, 20),
(62, 5, 1, 160.00, 20),
(62, 13, 1, 112.00, 20),
(63, 3, 1, 155.00, 21),
(63, 4, 1, 152.00, 21),
(63, 2, 1, 145.00, 21),
(64, 8, 1, 14.00, 21),
(64, 12, 1, 100.00, 21),
(64, 9, 1, 40.00, 21),
(65, 5, 1, 160.00, 23),
(65, 3, 1, 155.00, 23),
(66, 2, 1, 145.00, 23),
(66, 6, 1, 12.00, 23),
(66, 3, 1, 155.00, 23),
(66, 2, 1, 145.00, 23),
(66, 2, 1, 145.00, 23),
(66, 2, 1, 145.00, 23),
(66, 10, 1, 15.00, 23),
(66, 12, 1, 100.00, 23);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_number` varchar(19) NOT NULL,
  `card_exp_month` varchar(12) NOT NULL,
  `card_exp_year` int(4) NOT NULL,
  `cvv` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `card_name`, `card_number`, `card_exp_month`, `card_exp_year`, `cvv`) VALUES
(40, 59, 'Liong Jun Yong', '1111-1111-1111-1111', 'February', 2032, 534),
(41, 60, 'Liong Jun Yong', '2222-2222-2222-2222', 'April', 2040, 545),
(42, 61, 'Kaw Wei Xin', '3333-3333-3333-3333', 'September', 2037, 454),
(43, 62, 'Kaw Wei Xin', '3333-3333-3333-3333', 'June', 2038, 342),
(44, 63, 'Lee Sheng Jiet', '4444-4444-4444-4444', 'July', 2031, 675),
(45, 64, 'Lee Sheng Jiet', '5555-5555-5555-5555', 'February', 2033, 896),
(46, 65, 'Martin', '0000-0000-0000-0000', 'December', 2042, 11),
(47, 66, 'Martin', '8888-8888-8888-8888', 'January', 2043, 888);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `item_id` int(11) NOT NULL,
  `item_type` varchar(200) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `item_description` varchar(2000) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_register` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`item_id`, `item_type`, `item_name`, `item_price`, `item_description`, `item_image`, `item_register`) VALUES
(1, 'Headphone', 'Sony WH-1000XM4 Wireless', 150.00, 'Dual noise sensor technology, featuring two microphones on each earcup, captures ambient noise and passes the data to the HD Noise Cancelling Processor QN1. Using a new algorithm, the HD Noise Cancelling Processor QN1 then applies noise cancelling processing in real time to a range of acoustic environments. Working together with a new Bluetooth® Audio SoC (System on Chip), it senses and adjusts to music and noise signals, as well as acoustic characteristics between the driver unit and ears, at over 700 times per second.', './assets/products/Sony.png', '2024-03-23 11:08:57'),
(2, 'Headphone', 'Sennheiser HD 800 S', 145.00, 'The Sennheiser HD 800 S are top-of-the-line audiophile headphones. Their open-back design ensures a natural and spacious soundstage for your audio, while their 56mm Ring Radiator dynamic drivers deliver a satisfyingly neutral and reference-grade sound. Even though they\'re quite large, their fit is comfortable enough for long listening sessions. That said, you\'ll want to consider using a good amp and DAC to get the most out of them, which can be an added cost on top of the high price tag of these cans.', './assets/products/Sennheiser.jpg', '2020-03-28 11:08:57'),
(3, 'Headphone', 'Bose QuietComfort Ultra Headphones Wireless', 155.00, 'The Bose QuietComfort Ultra Headphones Wireless are top-of-the-line noise cancelling (ANC) headphones. While they look similar to the Bose QuietComfort 45/QC45 Wireless, they have CustomTune technology; the headphones can adjust their sound profile and noise cancelling based on your unique hearing capabilities and environment. Like the Bose QuietComfort Ultra Earbuds Truly Wireless, they also have Immersive Audio, which offers head tracking to give you a more exciting audio experience. They even support aptX Adaptive, a codec that dynamically adjusts its performance based on your usage, whether you\'re streaming high-quality audio or watching video.', './assets/products/Bose.png', '2020-03-28 11:08:57'),
(4, 'Headphone', 'Audio-Technica ATH-M50x', 152.00, 'Audio-Technica is a Japanese brand with a wide selection of headphones, and other audio products like microphones and turntables. They\'re perhaps best known for the M-Series headphones, closed-back studio headphones for professional use. This lineup includes many options, and it\'s not always obvious which model provides the best value for the price, especially because the differences are small between each tier. However, their best products are go-to\'s for audiophiles and audio professionals, who laud them for their build and sound quality. In addition to the M-Series, they produce active noise cancelling and Bluetooth models for when you\'re out and about, but we haven\'t tested as many of them.', './assets/products/Audio.jpg', '2020-03-28 11:08:57'),
(5, 'Headphone', 'Beats Studio Pro Wireless', 160.00, 'Beats, or Beats By Dre, is an American audio company founded by rapper and record producer Dr. Dre. Their over-ear headphones are easy to spot in a crowd, thanks to their eye-catching colorways and iconic designs that prominently display the brand\'s logo. When they first emerged in the market, they were made by Monster (the brand famous for cables) and had the reputation of producing overly bass-heavy headphones. The chunky designs diverged drastically from conventional headphone styles and became increasingly plasticky in build. However, since being acquired by Apple Inc. in 2014, Beats have made several strides to improve their products and build quality. Most of their headphones now have an H1 or W1 chip, making it easy to pair them with Apple devices seamlessly, and some offer spatial audio with head-tracking. While they\'re still Apple-oriented, select products have seen Android app compatibility as well. Newer headphones and true wireless earbuds have a more neutral sound profile, though some still lack sound customization features to help you adjust their sound to your tastes.', './assets/products/Beats.jpg', '2020-03-28 11:08:57'),
(6, 'Cable', 'CB-AKC1 USB A To USB C Quick Charge 3.0 Kevlar Cable - 1.2M', 12.00, '- Fast Charging: Support up to 5V/3A, compatible for Qualcomm Quick Charge 2.0/3.0 , Huawei FCP and Samsung AFC.\r\n\r\n- Compatible Devices: Samsung Note 8 , the new MacBook 2015, ChromeBook Pixel 2015, Nexus 6P, Lenovo Zuk Z1 and other type c supported devices including PC, Tablets, and smartphone.\r\n\r\n- Data Sync and Charging: the data transmission speed is up to 480 Mbps, and also can fast and stable data transmission.\r\n\r\n- Kevlar Design: Premium materials by Kevlar, strengthened stress points, not easy intertwined and knotted, enhanced durability testing and safety technology ensure it used for long-term.\r\n\r\n- USB C Reversible connector design (plugs in both ways) allows you to conveniently connect cable in any orientation.', './assets/products/Aukey1.png', '2020-03-28 11:08:57'),
(7, 'Cable', 'CB-AKC3 USB C To USB C 60W PD Quick Charge Kevlar Cable - 1.2M', 13.00, '- Fast Charging: Support up to 60W power delivery high speed charging.\r\n\r\n- Compatible Devices: This cable charges your 13-inch MacBook Pro or MacBook with USB-C. It also fast charges your Google Pixel 3 / 3 XL, Nintendo Switch, or other compatible device.\r\n\r\n- Data Sync and Charging: the data transmission speed is up to 480 Mbps, and also can fast and stable data transmission.\r\n\r\n- Kevlar Design: Premium materials by Kevlar, strengthened stress points, not easy intertwined and knotted, enhanced durability testing and safety technology ensure it used for long-term.\r\n\r\n- USB C Reversible connector design (plugs in both ways) allows you to conveniently connect cable in any orientation.', './assets/products/Aukey2.png', '2020-03-28 11:08:57'),
(8, 'Cable', 'CB-AKC4 USB C To USB C 60W PD Quick Charge Kevlar Cable - 2M', 14.00, '- Fast Charging: Support up to 60W power delivery high speed charging.\r\n\r\n- Compatible Devices: This cable charges your 13-inch MacBook Pro or MacBook with USB-C. It also fast charges your Google Pixel 3 / 3 XL, Nintendo Switch, or other compatible device.\r\n\r\n- Data Sync and Charging: the data transmission speed is up to 480 Mbps, and also can fast and stable data transmission.\r\n\r\n- Kevlar Design: Premium materials by Kevlar, strengthened stress points, not easy intertwined and knotted, enhanced durability testing and safety technology ensure it used for long-term.\r\n\r\n- USB C Reversible connector design (plugs in both ways) allows you to conveniently connect cable in any orientation.', './assets/products/Aukey3.png', '2020-03-28 11:08:57'),
(9, 'Cable', 'CB-CMD1 1M USB A To USB C Quick Charge 3.0 Durable Braided Nylon Cable (3 Pack)', 40.00, '-Fast Charging: Support up to 5V/3A, compatible for Qualcomm Quick Charge 2.0/3.0 , Huawei FCP and Samsung AFC.\r\n\r\n-Data Transfer & Charging: USB 3.1 Gen 1 (USB 3.0) supports data transfer at up to 5Gbps, which is 8 times faster than USB 2.0. Safe charging at up to 3A is ensured by high-standard components, including a 56k ohm resistor\r\n\r\n-Extensive Compatibility: When used with a charger or power bank that supports Adaptive Fast Charging or Quick Charge, this cable will Fast Charge your Samsung Galaxy S8/S8+ or will Quick Charge your LG G5/G6/V20, HTC 10, or other compatible model (refer to Product Description for details)\r\n\r\n-Tough & Flexible Design: Durable braided nylon A to C cable with reversible, aluminum alloy-housed USB-C connector and 6000+ bend lifespan to conveniently connect and withstand wear & tear\r\n\r\n-Optimum Length: 1 meter meets most of your charging and data transfer needs. Keep a cable in your car, home, and office as a back-up', './assets/products/Aukey4.png', '2020-03-28 11:08:57'),
(10, 'Cable', 'CB-AC1 Braided Nylon USB 3.1 USB A To USB C Cable 1.2 meter', 15.00, 'FAST CHARGING: Support up to 5V/3A, compatible for Qualcomm Quick Charge 2.0/3.0 , Huawei FCP and Samsung AFC.\r\n\r\nPREMIUM QUALITY: Extra-Strong USB C Cable with special tangle-free design, and woven nylon braid sleeve jacket for long-term, rugged durability.\r\n\r\nThe AUKEY® Edge: High quality internal with thinker power wire increase charging speed up to 20%, more efficient and saves power.\r\n\r\nBUILT TO LAST: Eco-friendly premium materials, strengthened stress points, enhanced durability testing and safety technology ensure it outlasts most cables on the market.\r\n\r\n Date Sync and Charging: the data transmission speed of USB 3.1 to USB C can up to 5 Gbps, it is 10 times faster than USB 2.0, and also can fast and stable data transmission.', './assets/products/Aukey5.jpg', '2020-03-28 11:08:57'),
(11, 'PowerBank', 'UGREEN 20W PD QC 3.0 Fast Charging PowerBank 10000mAh', 120.00, 'Built-in Cable: Type-C \r\nInput Port: USB-C\r\nOutput options: 3 ( x2 USB-A, x1 USB-C)\r\nBattery Capacity: 10000mAh\r\nWeight: 181g\r\nDimension: 4.1 x 2.1 x 0.8 inch\r\nWarranty: 12 months', './assets/products/Pb1.png', '2020-03-28 11:08:57'),
(12, 'PowerBank', 'KUULAA 5000mAh Powerbank Mini 20W/18W', 100.00, 'Input Port: USB-C\r\nBuilt-in Output Plugs: 1 (Type-C or Lightning)\r\nDisplay: Digital\r\nBattery Capacity: 5000mAh\r\nDimension: (L) 81mm x (W) 28mm x (H) 50mm', './assets/products/Pb2.png', '2020-03-28 11:08:57'),
(13, 'PowerBank', 'Baseus Qpow Pro 20000mAh Power Bank', 112.00, '    -Input Ports: 2 (x1 USB-C, x1 Lightning port)\r\n    -Output: 3 (x1 USB-A, x1 USB-C, x1 in-built USB-C cable)\r\n    -Built-in Cable: Type-C\r\n    -Battery Capacity: 20000mAh\r\n    -Weight: 360g\r\n\r\nThis 20,000 mAh power bank is large, bulky, but cute, with the ability to charge up to three devices at the same time. For extra portability and convenience points, it also comes with an inbuilt cable that also doubles as a strap. ', './assets/products/Pb3.png', '2020-03-28 11:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staffname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staffname`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `register_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `register_date`) VALUES
(19, 'liong', 'liong@gmail.com', '0d5d01a37ec3629743e297852dde4fe0', '2024-03-29 04:48:38'),
(20, 'kaw', 'kaw@gmail.com', '9ce357fac7e32b396c7b6350b6dfa7d4', '2024-03-29 04:49:03'),
(21, 'lee', 'lee@gmail.com', 'b0f8b49f22c718e9924f5b1165111a67', '2024-03-29 04:49:16'),
(23, 'Martin', 'martin@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-03-30 05:18:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
