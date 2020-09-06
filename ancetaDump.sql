-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.3.13-MariaDB-log - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных anceta
CREATE DATABASE IF NOT EXISTS `anceta` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `anceta`;

-- Дамп структуры для таблица anceta.allresult
CREATE TABLE IF NOT EXISTS `allresult` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sex` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thirdName` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthDate` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perseverance` tinyint(4) DEFAULT NULL,
  `neatness` tinyint(4) DEFAULT NULL,
  `selflearning` tinyint(4) DEFAULT NULL,
  `photos2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos4` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos5` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hardworking` tinyint(4) DEFAULT NULL,
  `photos1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `characters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы anceta.allresult: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `allresult` DISABLE KEYS */;
REPLACE INTO `allresult` (`id`, `sex`, `lastName`, `username`, `thirdName`, `birthDate`, `avatar`, `color`, `perseverance`, `neatness`, `selflearning`, `photos2`, `photos3`, `photos4`, `photos5`, `hardworking`, `photos1`, `characters`) VALUES
	(105, 'male', 'Иванов', 'Иван', 'Иваныч', '2020-09-04', '/uploads/users/avatar/388fe3ed6a385c435ff82bcba26d3792(3).png', '#1bbb76', 1, 0, 1, '/uploads/users/photos/chrome-73-mode-sombre-android_large(7).jpg', '/uploads/users/photos/logo(7).png', '/uploads/users/photos/388fe3ed6a385c435ff82bcba26d3792(7).png', '/uploads/users/photos/ru_badge_web_generic(7).png', 0, '/uploads/users/photos/0_8eb56_842bba74_XL-640x400(6).jpg', 'молодец'),
	(106, 'female', 'Петрова', 'Валентина', 'Ивановна', '2020-09-04', '/uploads/users/avatar/shok01(1).jpg', '#dcf901', 1, 1, 1, '/uploads/users/photos/0_8eb56_842bba74_XL-640x400(7).jpg', '/uploads/users/photos/chrome-73-mode-sombre-android_large(8).jpg', '', '', 1, '/uploads/users/photos/shok01.jpg', 'тоже молодец'),
	(107, 'male', 'Сидоров', 'Петр', 'Петрович', '2020-09-04', '/uploads/users/avatar/388fe3ed6a385c435ff82bcba26d3792(4).png', '#094dec', 1, 0, 0, '', '', '', '', 0, '/uploads/users/photos/388fe3ed6a385c435ff82bcba26d3792(8).png', ''),
	(108, 'male', 'Петров', 'Сидор', 'Владимирович', '2020-09-04', '/uploads/users/avatar/chrome-73-mode-sombre-android_large(1).jpg', '#2d9a98', 0, 0, 0, '/uploads/users/photos/388fe3ed6a385c435ff82bcba26d3792(9).png', '/uploads/users/photos/ru_badge_web_generic(8).png', '', '', 0, '/uploads/users/photos/chrome-73-mode-sombre-android_large(9).jpg', 'качества'),
	(109, 'male', 'Konovalov', 'Sergey', 'Alexandrovich', '2020-09-06', '/uploads/users/avatar/388fe3ed6a385c435ff82bcba26d3792(5).png', '#87d90d', 1, 0, 1, '/uploads/users/photos/chrome-73-mode-sombre-android_large(10).jpg', '/uploads/users/photos/logo(8).png', '/uploads/users/photos/388fe3ed6a385c435ff82bcba26d3792(10).png', '', 0, '/uploads/users/photos/0_8eb56_842bba74_XL-640x400(8).jpg', 'lorem ipsum');
/*!40000 ALTER TABLE `allresult` ENABLE KEYS */;

-- Дамп структуры для таблица anceta.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_hash` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_ip` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы anceta.users: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`user_id`, `user_login`, `user_password`, `user_hash`, `user_ip`) VALUES
	(3, 'admin2', 'fe3a0eada6dae0fbcf04f4968076b3e1', '25b713e0597f93bff2371511a9af4b41', 0),
	(4, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 'a11e04d56596633655eecee43b28cd1b', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
