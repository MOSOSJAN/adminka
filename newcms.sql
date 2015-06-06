-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 06 2015 г., 08:58
-- Версия сервера: 5.6.24
-- Версия PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `newcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(250) CHARACTER SET armscii8 NOT NULL,
  `lang` varchar(250) CHARACTER SET armscii8 DEFAULT NULL,
  `paret_id` int(11) NOT NULL,
  `img` varchar(50) CHARACTER SET armscii8 DEFAULT NULL,
  `description` text CHARACTER SET armscii8
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `lang`, `paret_id`, `img`, `description`) VALUES
(2, 'parent cat', '', 0, '', ''),
(5, 'second childe', NULL, 2, NULL, NULL),
(6, 'asd', NULL, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `local` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `default` smallint(6) NOT NULL DEFAULT '0',
  `date_update` int(11) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lang`
--

INSERT INTO `lang` (`id`, `url`, `local`, `name`, `default`, `date_update`, `date_create`) VALUES
(1, 'en', 'en-EN', 'English', 0, 1430754453, 1430754453),
(2, 'ru', 'ru-RU', 'Русский', 0, 1431428627, 1430754453),
(3, 'am', 'am-AM', 'Հայերեն', 1, 1431428613, 1430901563);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1433340074),
('m130524_201442_init', 1433340078);

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `img` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `lang` varchar(10) NOT NULL,
  `parrent_id` int(11) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `img`, `date`, `cat_id`, `lang`, `parrent_id`, `slug`) VALUES
(1, 'asd', '', '', '', 6, 'am', 1, 'asd');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Karine', 'EGduA5ZvCiKyHzoKgByqgOc5BOiYF--t', '$2y$13$hQqklyqsGRRr6GpmeW/s7evI0WjYlQKbEUQ2Xmxtd6GwO2nJtPjom', NULL, 'karine.margaryan116@gmail.com', 10, 1433340178, 1433340178);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `lang`
--
ALTER TABLE `lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
