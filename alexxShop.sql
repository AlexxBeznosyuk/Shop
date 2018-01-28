-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 03 2018 г., 17:24
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `alexxShop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Arhives`
--

CREATE TABLE `Arhives` (
  `id` int(11) NOT NULL,
  `customername` varchar(32) DEFAULT NULL,
  `itemname` varchar(128) DEFAULT NULL,
  `pricein` int(11) DEFAULT NULL,
  `pricesale` int(11) DEFAULT NULL,
  `datesale` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Arhives`
--

INSERT INTO `Arhives` (`id`, `customername`, `itemname`, `pricein`, `pricesale`, `datesale`) VALUES
(1, 'User', 'Scott Aspect', 30000, 40000, '2018-01-03'),
(2, 'User', 'Шлем велосипедный женский Cyclotech', 500, 1000, '2018-01-03'),
(3, 'User', 'Покрышка Stern 29 x 2,1', 800, 1300, '2018-01-03'),
(4, 'User', 'Scott Aspect', 30000, 40000, '2018-01-03'),
(5, 'User', 'Trek 4500', 25000, 35000, '2018-01-03');

-- --------------------------------------------------------

--
-- Структура таблицы `Carts`
--

CREATE TABLE `Carts` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `datain` datetime DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Carts`
--

INSERT INTO `Carts` (`id`, `userid`, `itemid`, `datain`, `price`, `orderid`) VALUES
(7, 2, 2, '2018-01-03 17:04:24', 35000, 1),
(8, 3, 5, '2018-01-03 17:04:46', 1300, 2),
(11, 3, 2, '2018-01-03 17:05:01', 35000, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Categories`
--

CREATE TABLE `Categories` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Categories`
--

INSERT INTO `Categories` (`id`, `category`) VALUES
(1, 'Велосипеды'),
(5, 'Защита'),
(3, 'Инструменты'),
(2, 'Компоненты'),
(4, 'Снаряжение');

-- --------------------------------------------------------

--
-- Структура таблицы `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `customername` varchar(32) DEFAULT NULL,
  `itemname` varchar(128) DEFAULT NULL,
  `datecomm` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Images`
--

CREATE TABLE `Images` (
  `id` int(11) NOT NULL,
  `itemid` int(11) DEFAULT NULL,
  `imagepath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `Items`
--

CREATE TABLE `Items` (
  `id` int(11) NOT NULL,
  `itemname` varchar(128) NOT NULL,
  `catid` int(11) DEFAULT NULL,
  `pricein` int(11) NOT NULL,
  `pricesale` int(11) NOT NULL,
  `info` varchar(2048) NOT NULL,
  `rate` double DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `imagepath` varchar(256) NOT NULL,
  `action` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Items`
--

INSERT INTO `Items` (`id`, `itemname`, `catid`, `pricein`, `pricesale`, `info`, `rate`, `count`, `imagepath`, `action`) VALUES
(2, 'Trek 4500', 1, 25000, 35000, 'велосипед для кросс-кантри\r\nразмер рамы: 13.0, 16.0, 18.0, 19.5, 21.0, 22.5 дюйм\r\nрама: алюминиевый сплав\r\nколеса 26 дюймов\r\nHard tail\r\n24 скорости\r\nРама / Рост велосипедиста, см: 21\" (180-190), 22\" (185-195)', 0, 4, 'images/trek-4500-disc-2011.jpg', 0),
(4, 'Шлем велосипедный женский Cyclotech', 5, 500, 1000, 'Женский велосипедный шлем, изготовленный по технологии OutMold, которая обеспечивает хорошее сочетание невысокой цены и достаточной технологичности. Увеличенное количество вентиляционных отверстий гарантирует отличную циркуляцию воздуха при любой скорости передвижения, сохраняя при этом жесткость шлема. Шлем соответствует международным стандартам безопасности и надежности.', 0, 9, 'images/12492100299.jpg', 0),
(5, 'Велосипедные перчатки Dainese Guanto Rock Solid-С', 5, 1000, 1300, 'Длиннопалые перчатки предназначены для катания на велосипеде в прохладную погоду. Верхняя часть перчатки сделана из эластичной воздухопроницаемой ткани, украшенной графикой. Ладонь выполнена из материала Clarino с силиконовыми вставками для лучшего сцепления. Неопреновая манжета на липучке.', 0, 5, 'images/6651730299.jpg', 0),
(6, 'Мультиключ Cyclotech, 10 функций', 3, 300, 600, 'Мультиключ на 10 инструментов, среди которых - набор шестигранных ключей, плоская и крестовая отвертки', 0, 3, 'images/8561240299.jpg', 0),
(7, 'Седло велосипедное Stern', 2, 1000, 1250, 'Велосипедное седло повышенного комфорта. \r\n\r\nОсобенности модели: \r\nнаполнитель обеспечивает мягкость и сохранение формы седла; \r\nувеличенная ширина и каучуковые амортизаторы вибрации снизят неприятные ощущения от неровностей дороги.', 0, 8, 'images/12264450299.jpg', 0),
(10, 'Фонарь велосипедный передний Cyclotech', 4, 1000, 1500, 'Передний велосипедный фонарь Cyclotech.\r\n\r\nОсобенности модели:\r\n\r\nколичество светодиодов: 1;\r\nколичество режимов работы: 3;\r\nвлагозащитный корпус;\r\nкрепеж на руль в комплекте;\r\nзарядка через USB;\r\nсветопоток: 180 люмен.', 0, 5, 'images/12219250299.jpg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `Roles`
--

CREATE TABLE `Roles` (
  `id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Roles`
--

INSERT INTO `Roles` (`id`, `role`) VALUES
(2, 'admin'),
(3, 'boss'),
(1, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `roleid` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `imagepath` varchar(255) DEFAULT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `login`, `pass`, `roleid`, `discount`, `total`, `imagepath`, `email`) VALUES
(1, 'user', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 0, 'images/avatar/user.anonym.jpg', 'test@test.ru'),
(2, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 2, 5, 0, 'images/avatar/admin.Jellyfish.jpg', ' User@user.ru '),
(3, 'user1', '827ccb0eea8a706c4c34a16891f84e7b', 3, 10, 0, 'images/avatar/user1.Koala.jpg', ' test@test.ru ');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Arhives`
--
ALTER TABLE `Arhives`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Carts`
--
ALTER TABLE `Carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `itemid` (`itemid`);

--
-- Индексы таблицы `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Индексы таблицы `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`);

--
-- Индексы таблицы `Items`
--
ALTER TABLE `Items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catid` (`catid`);

--
-- Индексы таблицы `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `roleid` (`roleid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Arhives`
--
ALTER TABLE `Arhives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `Carts`
--
ALTER TABLE `Carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Images`
--
ALTER TABLE `Images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `Items`
--
ALTER TABLE `Items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `Roles`
--
ALTER TABLE `Roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Carts`
--
ALTER TABLE `Carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`itemid`) REFERENCES `Items` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Images`
--
ALTER TABLE `Images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `Items` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Items`
--
ALTER TABLE `Items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `Categories` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `Roles` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
