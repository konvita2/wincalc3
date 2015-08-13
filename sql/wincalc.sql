-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 13 2015 г., 22:52
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
(2, 'EUR', 100),
(3, 'USD', 100),
(4, 'UAH', 1),
(5, 'EUR0', 100);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `curs`
--

INSERT INTO `curs` (`id`, `dat`, `cur_nam`, `price`) VALUES
(2, '2015-07-05', 'EUR0', 2550),
(5, '2015-07-25', '', 2650),
(6, '2015-07-24', '', 2610),
(7, '2015-07-25', 'EUR', 2600),
(8, '2015-07-18', 'EUR', 2650),
(9, '1980-01-01', 'UAH', 1),
(10, '2015-07-25', 'USD', 2150);

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
(4, '4/8/4', '', 'UAH', 50.00),
(5, '4-16-4-16-4', 'двухкамерный обычный', 'UAH', 50.00);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Структура таблицы `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1439490547, 1, 'Admin', 'Adminenko', 'ADMIN', '0'),
(2, '192.168.1.46', 'tom', '$2y$08$XTH1H3Ueg3S5XrwVSRX2Leyo9Vfu/t0wERrfmYX4w5OJqq8poRjBq', NULL, 'to@a.b', NULL, NULL, NULL, NULL, 1439298318, NULL, 1, 'tom', 'smith', 'tom_smith', '123456'),
(22, '192.168.1.46', 'www', '$2y$08$cnrpcKwNcQoJYD96tlEXP.oQuCer9CMJvyers7WGgd/TT205k66fC', NULL, 'www@a.b', NULL, NULL, NULL, NULL, 1439377818, NULL, 1, '', '', '', ''),
(23, '192.168.1.46', 'wwwa', '$2y$08$urrd.p/L/3nnR3RVlM6rS./AmQFQKNs3r2cRVWpwi1zUeSUfNZmNC', NULL, 'wwwa@a.b', NULL, NULL, NULL, NULL, 1439377845, 1439377872, 1, 'Вася', 'Сидоров', 'АРКА', '123456');

-- --------------------------------------------------------

--
-- Структура таблицы `users_calc`
--

CREATE TABLE IF NOT EXISTS `users_calc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mater` decimal(10,2) DEFAULT '0.00',
  `prod` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(28, 2, 1),
(3, 2, 2),
(23, 22, 2),
(27, 23, 1),
(25, 23, 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
