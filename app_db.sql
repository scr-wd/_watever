-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 06 2018 г., 11:37
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `app_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `agency`
--

CREATE TABLE `agency` (
  `agency_id` int(11) NOT NULL,
  `sponsor` varchar(50) NOT NULL,
  `registration_fee` decimal(10,0) NOT NULL,
  `consular_fee` decimal(10,0) NOT NULL,
  `additional_fee` decimal(10,0) NOT NULL,
  `working_fee` decimal(10,0) NOT NULL,
  `deposit_fee` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `agency`
--

INSERT INTO `agency` (`agency_id`, `sponsor`, `registration_fee`, `consular_fee`, `additional_fee`, `working_fee`, `deposit_fee`) VALUES
(1, 'ЦМО - Центр Международного Обмена', '5000', '10800', '5900', '0', '0'),
(2, 'StarTravel', '13500', '9900', '0', '24000', '4000'),
(3, 'Молодежный интернациональный кадровый центр', '10000', '11000', '0', '20000', '6500'),
(4, 'Global Vision', '12500', '9900', '2200', '17000', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `program`
--

CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `base_cost` decimal(10,0) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `agency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `program`
--

INSERT INTO `program` (`program_id`, `name`, `base_cost`, `description`, `agency_id`) VALUES
(1, 'Self-Arranged Standard', '100000', 'Самостоятельная организация без билета от агентства', 1),
(2, 'Self-Arranged Standard + Flight', '140000', 'Самостоятельная организация с билетом от агентства', 1),
(3, 'Full-Service', '108000', 'Организация от агентства, включая поиск работы, без билета от агентства', 1),
(4, 'Full-Service + Flight', '146000', 'Организация от агентства, включая поиск работы, с билетом от агентства', 1),
(5, 'Usual', '65000', 'Организация от агентства без поиска работы и авиабилета', 2),
(6, '2в1', '89000', 'Организация от агентства с поиском работы без авиабилета', 2),
(7, 'Work and Travel Basic', '78200', 'Организация и оформление от агентства', 3),
(8, 'Work and Travel Basic', '76000', 'Организация и оформление от агентства', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `avg_salary` float NOT NULL,
  `flight` decimal(10,0) NOT NULL,
  `transfer` decimal(10,0) NOT NULL,
  `housing` decimal(10,0) NOT NULL,
  `meal` decimal(10,0) NOT NULL,
  `entertainment` decimal(10,0) NOT NULL,
  `living` decimal(10,0) NOT NULL,
  `salary_tax` float NOT NULL,
  `purchases_tax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `state`
--

INSERT INTO `state` (`state_id`, `name`, `avg_salary`, `flight`, `transfer`, `housing`, `meal`, `entertainment`, `living`, `salary_tax`, `purchases_tax`) VALUES
(1, 'Айдахо', 500, '45000', '14000', '19000', '800', '2000', '1000', 0.093, 0.06),
(2, 'Алабама', 500, '45000', '10000', '25000', '950', '1500', '750', 0.087, 0.04),
(3, 'Аляска', 600, '45000', '18000', '25000', '1050', '1900', '950', 0.065, 0),
(4, 'Аризона', 500, '45000', '10000', '19000', '700', '1500', '750', 0.088, 0.056),
(5, 'Арканзас', 500, '45000', '15000', '19000', '750', '1500', '750', 0.101, 0.065),
(6, 'Вайоминг', 320, '45000', '20000', '25000', '700', '1500', '750', 0.071, 0.04),
(7, 'Вашингтон', 600, '45000', '1000', '25000', '700', '1500', '750', 0.093, 0.065),
(8, 'Вермонт', 600, '45000', '6000', '31500', '1000', '1900', '950', 0.103, 0.06),
(9, 'Виргиния', 600, '45000', '6000', '25000', '800', '1750', '900', 0.093, 0.053),
(10, 'Висконсин', 450, '45000', '12000', '25000', '850', '1500', '750', 0.11, 0.05),
(11, 'Дакота', 500, '45000', '12000', '19000', '600', '1500', '750', 0.08, 0.045),
(12, 'Джорджия', 350, '45000', '20000', '31500', '1000', '1900', '950', 0.091, 0.04),
(13, 'Иллинойс', 500, '45000', '10000', '19000', '700', '1500', '750', 0.11, 0.0625),
(14, 'Индиана', 500, '45000', '14000', '25000', '1000', '1500', '750', 0.095, 0.07),
(15, 'Калифорния', 650, '45000', '1000', '19000', '1200', '1500', '750', 0.11, 0.0725),
(16, 'Канзас', 450, '45000', '1000', '19000', '750', '1500', '750', 0.095, 0.065),
(17, 'Каролина', 450, '45000', '16000', '25000', '750', '1750', '900', 0.09, 0.055),
(18, 'Кентукки', 500, '45000', '8000', '19000', '750', '1400', '700', 0.095, 0.06),
(19, 'Колорадо', 500, '45000', '20000', '19000', '950', '1500', '750', 0.089, 0.029),
(20, 'Коннектикут', 600, '45000', '4000', '25000', '1000', '1900', '900', 0.126, 0.0635),
(21, 'Массачусетс', 600, '45000', '4000', '31500', '1000', '2100', '1050', 0.103, 0.0625),
(22, 'Миннесота', 550, '45000', '16000', '31500', '1000', '1800', '900', 0.103, 0.0685),
(23, 'Миссури', 500, '45000', '20000', '31500', '1000', '1800', '900', 0.093, 0.04225),
(24, 'Мичиган', 550, '45000', '18000', '25000', '800', '1900', '950', 0.094, 0.06),
(25, 'Монтана', 500, '45000', '10000', '19000', '800', '1500', '750', 0.087, 0),
(26, 'Мэн', 500, '45000', '10000', '25000', '1100', '1500', '750', 0.102, 0.055),
(27, 'Нью-Гэмпшир', 500, '45000', '6000', '25000', '600', '1500', '750', 0.079, 0),
(28, 'Нью-Джерси', 500, '45000', '4000', '31500', '1000', '1900', '950', 0.122, 0.06625),
(29, 'Нью-Йорк', 500, '45000', '2000', '25000', '800', '1500', '750', 0.127, 0.04),
(30, 'Нью-Мексико', 500, '45000', '14000', '19000', '750', '1500', '750', 0.087, 0.05125),
(31, 'Орегон', 550, '45000', '14000', '19000', '750', '1500', '750', 0.103, 0),
(32, 'Род-Айленд', 600, '45000', '10000', '25000', '650', '1750', '900', 0.108, 0.07),
(33, 'Теннесси', 500, '45000', '24000', '31500', '750', '1900', '950', 0.073, 0.07),
(34, 'Техас', 450, '45000', '24000', '25000', '700', '1000', '500', 0.076, 0.0625),
(35, 'Юта', 450, '45000', '24000', '25000', '750', '1750', '900', 0.096, 0.0595);

-- --------------------------------------------------------

--
-- Структура таблицы `visa`
--

CREATE TABLE `visa` (
  `visa_id` int(11) NOT NULL,
  `name_of_city` varchar(20) NOT NULL,
  `housing` decimal(10,0) NOT NULL,
  `meal` decimal(10,0) NOT NULL,
  `living` decimal(10,0) NOT NULL,
  `trans_avia` int(11) NOT NULL,
  `trans_rail` int(11) NOT NULL,
  `trans_auto` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `visa`
--

INSERT INTO `visa` (`visa_id`, `name_of_city`, `housing`, `meal`, `living`, `trans_avia`, `trans_rail`, `trans_auto`, `description`) VALUES
(1, 'Екатеринбург', '800', '800', '400', 5000, 4000, 10000, 'Указаны средние расценки на апрель 2018 года'),
(2, 'Москва', '1500', '1200', '600', 10000, 10000, 22000, 'Указаны средние расценки на апрель 2018 года'),
(3, 'Владивосток', '700', '700', '300', 35000, 18000, 36000, 'Указаны средние расценки на апрель 2018 года');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`agency_id`);

--
-- Индексы таблицы `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `agency_id_idx` (`agency_id`);

--
-- Индексы таблицы `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Индексы таблицы `visa`
--
ALTER TABLE `visa`
  ADD PRIMARY KEY (`visa_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `agency`
--
ALTER TABLE `agency`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT для таблицы `visa`
--
ALTER TABLE `visa`
  MODIFY `visa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `agency_id` FOREIGN KEY (`agency_id`) REFERENCES `agency` (`agency_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
