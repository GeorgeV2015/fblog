-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 23 2018 г., 19:13
-- Версия сервера: 5.7.16
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fblog`
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `is_admin`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$H0UvDt8GdyD76ZVNtu/kle6uiHDChiQqsOWRurxa12cLw0T9Hi7HO', NULL, 1, 1, 'hDrCf0X6X90kAfmPA3t4safDNv0OEkF2YnHBKVrkKyJgffO45atKYeOOyFe6', '2018-02-18 18:09:02', '2018-02-18 18:09:02'),
(2, 'Petr', 'petr@gmail.com', '$2y$10$1fpM4rIN6J/o.RwXy9dtj.NUxfJSsBc9uXUtg6UQyVEtY5KBo01xq', NULL, 1, 0, '0lPHl6b93K3brrouUpHUWnUx5Hb6PfO0oqfT6Sqet4hUdv5ne7u7u76BTavy', '2018-02-18 18:10:40', '2018-02-22 09:51:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
