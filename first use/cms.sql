CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `mail` mediumtext,
  `debug` text NOT NULL,
  `version` varchar(10) NOT NULL,
  `build` varchar(10) NOT NULL,
  `theme` varchar(128) NOT NULL DEFAULT 'default'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `config` (`id`, `name`, `mail`, `debug`, `version`, `build`, `theme`) VALUES
(1, 'HeinCMS', 'user@server.com', '1', '0.1.2', '4313', 'bootstrap');


CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `position` varchar(3) NOT NULL,
  `included` tinyint(1) NOT NULL DEFAULT '0',
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `pages` (`id`, `name`, `date_created`, `position`, `included`, `content`) VALUES
(0, 'Admin', '2015-06-19 10:46:11', '99', 1, NULL),
(1, 'Home', '2015-06-18 06:41:52', '1', 0, '<p>Herzlich willkommen, beim neuen HeinCMS v2!<br /><br />Dieses CMS ist momentan im Aufbau und wird regelm&auml;&szlig;ig &uuml;berarbeitet.</p>\r\n<p>Mehr auf dem Git Repo unter: <a title="Github" href="https://github.com/marchein/cms">github.com/marchein/cms</a></p>'),
(2, 'News', '2015-06-20 15:59:52', '2', 1, NULL);


CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `full_name` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `rights` varchar(128) DEFAULT NULL,
  `password` text,
  `length` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- default user = dummy
-- default user password = bla

INSERT INTO `user` (`ID`, `full_name`, `name`, `email`, `rights`, `password`, `length`) VALUES
(1, NULL, 'dummy', 'user@server.com', '1', '5372abca182d7a06992ce1d428ff5d4a20e56b4e6e3e637b1fe9817a0c3affbdd9336ed9ee968f905eddf8c2d40c9c49d073ab046bc46ee932ba7fbb098f060f', '3');

ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
