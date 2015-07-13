-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 13 2015 г., 23:42
-- Версия сервера: 5.5.35
-- Версия PHP: 5.4.4-14+deb7u7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `wincalc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(10) NOT NULL,
  `mult` double DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `nam`, `mult`) VALUES
(1, 'EUR1', 100),
(2, 'EUR2', 100),
(3, 'USD', 100),
(4, 'UAH', 1),
(5, 'RUR', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `curs`
--

CREATE TABLE IF NOT EXISTS `curs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dat` date NOT NULL,
  `cur_nam` varchar(10) NOT NULL,
  `price` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `glass`
--

CREATE TABLE IF NOT EXISTS `glass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nam` varchar(50) NOT NULL,
  `description` varchar(150) DEFAULT '',
  `cur_name` varchar(10) DEFAULT 'UAH',
  `price` decimal(15,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `glass`
--

INSERT INTO `glass` (`id`, `nam`, `description`, `cur_name`, `price`) VALUES
(1, '4/10/4/10/4', '', 'UAH', 56.00),
(2, '4/16/4', '', 'UAH', 61.30),
(3, '4/2Ar/4i', '', 'UAH', 75.00),
(4, '4/8/4', '', 'UAH', 50.00);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(1) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `psw` varchar(32) NOT NULL,
  `isadmin` bit(1) NOT NULL,
  `description` varchar(300) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей' AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `psw`, `isadmin`, `description`) VALUES
(1, 'log', 'ee95a16d763ab0d26ee62c53056df928', b'1', 'дилер Александр Коваленко, г.Смила'),
(7, 'log1', '99b654c04b4e3da5edd254243374d0ad', b'1', 'дилер Ольга Геращенко, г.Каменка'),
(15, 'admin', '698d51a19d8a121ce581499d7b701668', b'0', '1122');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
