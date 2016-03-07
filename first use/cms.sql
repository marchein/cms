SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `config` (
`id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `mail` mediumtext,
  `debug` text NOT NULL,
  `version` varchar(10) NOT NULL,
  `build` varchar(10) NOT NULL,
  `theme` varchar(128) NOT NULL DEFAULT 'default'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `config` (`id`, `name`, `mail`, `debug`, `version`, `build`, `theme`) VALUES
(1, 'HeinCMS', 'user@server.com', '0', '0.1.0', '4268', 'bootstrap');

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `pages` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `position` varchar(3) NOT NULL,
  `included` tinyint(1) NOT NULL DEFAULT '0',
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `pages` (`id`, `name`, `date_created`, `position`, `included`, `content`) VALUES
(0, 'Admin', '2015-06-19 10:46:11', '99', 1, 'Interner Bereich'),
(1, 'Home', '2015-06-18 06:41:52', '1', 0, '<p>Herzlich willkommen, beim neuen HeinCMS v2!<br /><br />Dieses CMS ist momentan im Aufbau und wird regelm&auml;&szlig;ig &uuml;berarbeitet.</p>\r\n<p>Mehr auf dem Git Repo unter: <a title="Github" href="https://github.com/marchein/cms">github.com/marchein/cms</a></p>'),
(2, 'News', '2015-06-20 15:59:52', '2', 1, '');

CREATE TABLE IF NOT EXISTS `user` (
`ID` int(11) NOT NULL,
  `full_name` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `rechte` varchar(128) DEFAULT NULL,
  `password` text,
  `length` varchar(128) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`ID`, `full_name`, `name`, `email`, `rechte`, `password`, `length`) VALUES
(1, NULL, 'dummy', 'user@server.com', '1', '6ba028366ebcdcef1ce3d73883c3475def4b7925f80e800bc82d91aa4430093622f9f95d20894022864dfa55d9c901ff520e070132eafabdae62a73e5ceeaed1', '3');


ALTER TABLE `config`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `pages`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `user`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `ID` (`ID`);


ALTER TABLE `config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `pages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
ALTER TABLE `user`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
