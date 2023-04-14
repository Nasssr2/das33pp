-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-05 07:55:08
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `testdb`
--
DROP DATABASE IF EXISTS `testDB`;

--
-- Database: `testDB`
--
CREATE DATABASE IF NOT EXISTS `testDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `testDB`;
-- --------------------------------------------------------

--
-- 資料表結構 `get_post`
--

CREATE TABLE `get_post` (
  `lost_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Pet_ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `area` varchar(50) NOT NULL,
  `Place` varchar(50) NOT NULL,
  `Details` varchar(50) NOT NULL,
  `coordinate1` varchar(50) NOT NULL,
  `coordinate2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `get_post`
--

INSERT INTO `get_post` (`lost_ID`, `User_ID`, `Pet_ID`, `date`, `time`, `area`, `Place`, `Details`, `coordinate1`, `coordinate2`) VALUES
(1, 2, 5, '2023-01-01', '13:21:00', '沙田', 'd大樓', '從窗口跳下', '22.331584', '114.181373'),
(2, 2, 6, '2023-01-02', '13:22:00', '屯門', 'c大樓', '從窗口跳下', '22.337041', '114.180490'),
(3, 2, 7, '2023-01-03', '13:23:00', '荃灣', 'b大樓', '從窗口跳下', '22.342334', '114.7675434'),
(4, 2, 8, '2023-01-04', '13:24:00', '荃灣', 'a大樓', '從窗口跳下', '22.111122', '114.4534454');

-- --------------------------------------------------------

--
-- 資料表結構 `lost_post`
--

CREATE TABLE `lost_post` (
  `lost_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Pet_ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `area` varchar(50) NOT NULL,
  `Place` varchar(50) NOT NULL,
  `Details` varchar(50) NOT NULL,
  `coordinate1` varchar(50) NOT NULL,
  `coordinate2` varchar(50) NOT NULL,
  `latitude` varchar(13) NOT NULL,
  `longitude` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `lost_post`
--

INSERT INTO `lost_post` (`lost_ID`, `User_ID`, `Pet_ID`, `date`, `time`, `area`, `Place`, `Details`, `coordinate1`, `coordinate2`, `latitude`, `longitude`) VALUES
(1, 1, 1, '2023-01-01', '13:21:00', '沙田', '河畔花園', '從窗口跳下', '22.331584', '114.181373', '22.3800816', '114.1938698'),
(2, 1, 2, '2023-01-02', '13:22:00', '屯門', '美樂花園', '從窗口跳下', '22.337041', '114.180490', '22.3732693', '113.9612688'),
(3, 1, 3, '2023-01-03', '13:23:00', '荃灣', '福來邨', '從窗口跳下', '22.342334', '114.7675434', '22.3739958', '114.113446'),
(4, 2, 4, '2023-01-04', '13:24:00', '荃灣', 'a大樓', '荃灣綠楊新邨N座', '22.111122', '114.4534454', '22.3737324', '114.1190201');

-- --------------------------------------------------------

--
-- 資料表結構 `pet`
--

CREATE TABLE `pet` (
  `Pet_ID` int(11) NOT NULL,
  `Pet_Types` varchar(255) DEFAULT NULL,
  `Pet_Name` varchar(255) DEFAULT NULL,
  `Pet_Sex` varchar(255) DEFAULT NULL,
  `Pet_Age` int(11) DEFAULT NULL,
  `Pet_weight` int(11) DEFAULT NULL,
  `Pet_chip` text DEFAULT NULL,
  `Pet_Description` text DEFAULT NULL,
  `Pet_feature` text DEFAULT NULL,
  `Pet_color` text DEFAULT NULL,
  `Pet_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `pet`
--

INSERT INTO `pet` (`Pet_ID`, `Pet_Types`, `Pet_Name`, `Pet_Sex`, `Pet_Age`, `Pet_weight`, `Pet_chip`, `Pet_Description`, `Pet_feature`, `Pet_color`, `Pet_image`) VALUES
(1, 'cat', 'Oliver', 'M', 1, 1, 'Y', 'this are so cat', 'so big', 'red', 'slampe1.jpg'),
(2, 'dog', 'Barker', 'F', 2, 2, 'N', 'this are so sdfs dog', 'so some', 'black', 'slampe2.jpg'),
(3, 'other', 'Barker', 'NG', 3, 3, 'NG', 'this are so other', 'so sad', 'red and white', 'slampe3.jpg'),
(4, 'other', 'sdfsdf', 'NG', 5, 6, 'NG', 'this are so 444', 'so 4444', '4 and 4', 'slampe4.jpg'),
(5, 'dog', '小狗', 'NG', 5, 6, 'NG', 'this are so 55', 'so 4444', '4 and 4', 'slampe5.jpg'),
(6, 'other', '比比鳥', 'NG', 5, 6, 'NG', 'this are so 66', 'so 4444', '4 and 4', 'slampe6.jpg'),
(7, 'cat', '小貓', 'NG', 5, 6, 'NG', 'this are so 777', 'so 4444', '4 and 4', 'slampe7.jpg'),
(8, 'other', 'Keroro', 'NG', 5, 6, 'NG', 'this are so 888', 'so 4444', '4 and 4', 'slampe8.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL,
  `textContent` text NOT NULL,
  `reply_status` int(1) NOT NULL,
  `reply_dateTime` text DEFAULT NULL,
  `Send_person` int(11) NOT NULL,
  `send_person_name` text NOT NULL,
  `receive_person` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `reply`
--

INSERT INTO `reply` (`reply_id`, `textContent`, `reply_status`, `reply_dateTime`, `Send_person`, `send_person_name`, `receive_person`, `post_id`) VALUES
(3, '好像在\r\n圓洲角公園看過', 2, '27-02-23 10:20:00pm', 2, 'Tom', 1, 1),
(6, '對，在那裡看到過', 2, '27-02-23 10:47:54pm', 2, 'Tom', 1, 1),
(7, '試試', 2, '28-02-23 12:47:08pm', 1, 'Mary', 1, 1),
(20, '.\r\n', 2, '04-03-23 03:43:32pm', 1, 'Mary', 1, 1),
(21, '1', 2, '04-03-23 09:29:15pm', 1, 'Mary', 1, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `User_Name` varchar(100) NOT NULL,
  `phone_Number` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`User_ID`, `User_Name`, `phone_Number`, `password`, `name`) VALUES
(1, 'Mary', '58674321', 'asd222', 'Ela'),
(2, 'Tom', '57568291', 'asd2224', 'elias');

--
-- 已傾印資料表的索引
--
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- 資料表索引 `get_post`
--
ALTER TABLE `get_post`
  ADD PRIMARY KEY (`lost_ID`),
  ADD KEY `FK1_2` (`User_ID`),
  ADD KEY `FK2_2` (`Pet_ID`);

--
-- 資料表索引 `lost_post`
--
ALTER TABLE `lost_post`
  ADD PRIMARY KEY (`lost_ID`),
  ADD KEY `FK1` (`User_ID`),
  ADD KEY `FK2` (`Pet_ID`);

--
-- 資料表索引 `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`Pet_ID`);

--
-- 資料表索引 `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `receive_person` (`receive_person`),
  ADD KEY `Send_person` (`Send_person`),
  ADD KEY `post_id` (`post_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `get_post`
--
ALTER TABLE `get_post`
  ADD CONSTRAINT `FK1_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `FK2_2` FOREIGN KEY (`Pet_ID`) REFERENCES `pet` (`Pet_ID`);

--
-- 資料表的限制式 `lost_post`
--
ALTER TABLE `lost_post`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `FK2` FOREIGN KEY (`Pet_ID`) REFERENCES `pet` (`Pet_ID`);

--
-- 資料表的限制式 `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`receive_person`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`Send_person`) REFERENCES `user` (`User_ID`),
  ADD CONSTRAINT `reply_ibfk_3` FOREIGN KEY (`post_id`) REFERENCES `lost_post` (`lost_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
