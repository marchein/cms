SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cms`;

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `mail` mediumtext,
  `debug` text NOT NULL,
  `version` varchar(10) NOT NULL,
  `build` varchar(10) NOT NULL,
  `theme` varchar(128) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `config` (`id`, `name`, `mail`, `debug`, `version`, `build`, `theme`) VALUES
(1, 'HeinCMS', 'user@server.com', '1', '0.1.2', '4320', 'bootstrap');

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `position` varchar(3) NOT NULL,
  `included` tinyint(1) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `pages` (`id`, `name`, `date_created`, `position`, `included`, `content`) VALUES
(0, 'Admin', '2015-06-19 08:46:11', '99', 1, ''),
(1, 'Home', '2015-06-18 04:41:52', '1', 0, '<p>Herzlich willkommen, beim neuen HeinCMS v2!<br /><br />Dieses CMS ist momentan im Aufbau und wird regelm&auml;&szlig;ig &uuml;berarbeitet.</p>\r\n<p>Mehr auf dem Git Repo unter: <a title=\"Github\" href=\"https://github.com/marchein/cms\">github.com/marchein/cms</a></p>'),
(2, 'News', '2015-06-20 13:59:52', '2', 1, '');

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `rights` varchar(128) DEFAULT NULL,
  `password` text,
  `length` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`ID`, `full_name`, `name`, `email`, `rights`, `password`, `length`) VALUES
(1, NULL, 'dummy', 'user@server.com', '1', '5372abca182d7a06992ce1d428ff5d4a20e56b4e6e3e637b1fe9817a0c3affbdd9336ed9ee968f905eddf8c2d40c9c49d073ab046bc46ee932ba7fbb098f060f', '3');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
