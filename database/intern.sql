-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2023 lúc 04:28 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `intern`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hash_id` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `employee`
--

INSERT INTO `employee` (`id`, `name`, `hash_id`) VALUES
(158, 'test2', 'MTU4'),
(159, 'test2', 'MTU5'),
(160, 'test1', 'MTYw'),
(164, 'test1', 'MTY0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `userType` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `hashed_data` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `pwd`, `userType`, `email`, `description`, `token`, `hashed_data`) VALUES
(476, 'anhBao', 'd63fe187906006f1dd9d0292e5a20cbf4b8e2480d4007d65c8f399f333e5aa3d', 'admin', 'anhBao@gmail.com', '', NULL, 'e73cb135243c08ab2c2adc333b150b9237093315f6b38e3361f07caf2bfb4d6b'),
(477, 'Khoi123', '4b6ffdd74c02baca6e0f6c0396e6a539fc8e935d404fd758c07b6e27d86e4827', 'admin', 'Khoi123@gmail.com', '', NULL, '6e82b8197ce29396936a07b1eb951c88650a2fc0fe1201a51b15b6ca8a73318a'),
(478, 'Test1', '8a863b145dc6e4ed7ac41c08f7536c476ebac7509e028ed2b49f8bd5a3562b9f', 'admin', 'Test1@gmail.com', '', NULL, '200dd69b70a88134b3a939de5f0b10c44a1675344329b9d9a5ad6b7342f978b2'),
(479, 'Test2', '32e6e1e134f9cc8f14b05925667c118d19244aebce442d6fecd2ac38cdc97649', 'admin', 'Test2@gmail.com', '', NULL, '9869a8a3a11a33284dc2bcc3d2e6ffd52cad30e2009c11dfe604e74dc21a887e'),
(480, 'Test3', '68235f4551b9c6423df2af7ead63c90cdd4201ac08525bc3a41cd4755c6c86cb', 'user', 'Test3@gmail.com', '', NULL, 'ddfe0e8d462af661f81db36589c39882dc0f2330785b5d80cd34f2f520ad618f'),
(481, 'Test4', '68235f4551b9c6423df2af7ead63c90cdd4201ac08525bc3a41cd4755c6c86cb', 'user', 'Test4@gmail.com', '', NULL, '51d089cdaf0c968c94b80671489d22b6f79b1c57de80df880b008e9b37b49788'),
(482, 'Test5', 'f9ca438226aae2a1aa8503da8fe3aa57aca7036ca0ad8a2a381bec25e188c48b', 'user', 'Test5@gmail.com', '', NULL, 'd4679c618f1af07ee8570edd4b931e2e68e1c2d4b7d3c2f1033a9b597f85d4b0');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
