-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `ticketid` int(2) NOT NULL AUTO_INCREMENT,
  `train_no` int(4) NOT NULL,
  `username` varchar(25) NOT NULL,
  `Name` tinytext NOT NULL,
  `age` int(11) NOT NULL,
  `seat` int(5) NOT NULL,
  `source` varchar(25) NOT NULL,
  `destination` varchar(25) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`ticketid`),
  KEY `username` (`username`),
  KEY `train_no` (`train_no`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`train_no`) REFERENCES `trains_info` (`train_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ticket` (`ticketid`, `train_no`, `username`, `Name`, `age`, `seat`, `source`, `destination`, `type`) VALUES
(53,	1003,	'reserve',	'asd',	12,	4,	'asd',	'asq',	'sl'),
(54,	1003,	'reserve',	'asw',	12,	2,	'asd',	'asd',	'thirdtier');

DROP TABLE IF EXISTS `trainseat`;
CREATE TABLE `trainseat` (
  `train_no` int(4) NOT NULL,
  `thirdtier` int(4) DEFAULT NULL,
  `secondtier` int(4) DEFAULT NULL,
  `firsttier` int(4) DEFAULT NULL,
  `sl` int(4) DEFAULT NULL,
  KEY `train_no` (`train_no`),
  KEY `thirdtier` (`thirdtier`),
  KEY `secondtier` (`secondtier`),
  KEY `firsttier` (`firsttier`),
  KEY `sl` (`sl`),
  CONSTRAINT `trainseat_ibfk_1` FOREIGN KEY (`train_no`) REFERENCES `trains_info` (`train_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trainseat_ibfk_4` FOREIGN KEY (`thirdtier`) REFERENCES `trains_info` (`thirdtier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trainseat_ibfk_5` FOREIGN KEY (`secondtier`) REFERENCES `trains_info` (`secondtier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trainseat_ibfk_6` FOREIGN KEY (`firsttier`) REFERENCES `trains_info` (`firsttier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trainseat_ibfk_7` FOREIGN KEY (`sl`) REFERENCES `trains_info` (`sl`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `trainseat` (`train_no`, `thirdtier`, `secondtier`, `firsttier`, `sl`) VALUES
(1003,	48,	50,	50,	46);

DROP TABLE IF EXISTS `trains_info`;
CREATE TABLE `trains_info` (
  `train_no` int(4) NOT NULL,
  `train_name` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `s_station_id` int(4) NOT NULL,
  `d_station_id` int(4) NOT NULL,
  `sl` int(4) DEFAULT NULL,
  `thirdtier` int(4) DEFAULT NULL,
  `secondtier` int(4) DEFAULT NULL,
  `firsttier` int(4) DEFAULT NULL,
  PRIMARY KEY (`train_no`),
  KEY `s_station_id` (`s_station_id`),
  KEY `d_station_id` (`d_station_id`),
  KEY `sl` (`sl`),
  KEY `firsttier` (`firsttier`),
  KEY `secondtier` (`secondtier`),
  KEY `thirdtier` (`thirdtier`),
  CONSTRAINT `trains_info_ibfk_3` FOREIGN KEY (`s_station_id`) REFERENCES `train_route` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trains_info_ibfk_4` FOREIGN KEY (`d_station_id`) REFERENCES `train_route` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `trains_info` (`train_no`, `train_name`, `type`, `s_station_id`, `d_station_id`, `sl`, `thirdtier`, `secondtier`, `firsttier`) VALUES
(1001,	'SANGHMITRA EX',	'SF',	5001,	5004,	1,	50,	50,	50),
(1002,	'SBC-PNBE SF-EX',	'SF',	5003,	5004,	2,	50,	50,	50),
(1003,	'SHRAMJEEVI EXP',	'EX',	5003,	5001,	46,	48,	50,	50),
(1005,	'SANGHMITRA SF',	'SF',	5002,	5001,	45,	50,	50,	50),
(1006,	'ALLAPHUJA EX',	'SF',	5002,	5003,	50,	50,	50,	50),
(1007,	'ERS-PNBE EX',	'SF',	5002,	5004,	1,	50,	50,	50),
(1008,	'CHENNAI CENTRAL',	'SF',	5002,	5005,	50,	50,	50,	50),
(1010,	'SBC-PNBE SF',	'SF',	5003,	5001,	50,	50,	50,	50),
(1011,	'DELHI SF-EXP',	'SF',	5001,	5003,	50,	50,	50,	50),
(1013,	'SBC-MAS EX',	'SF',	5003,	5005,	50,	50,	50,	50),
(1122,	'SJC EX',	'SF',	5001,	5005,	50,	50,	50,	50),
(1232,	'Janshadaran exp',	'SF',	5001,	5005,	50,	50,	50,	50);

DROP TABLE IF EXISTS `train_route`;
CREATE TABLE `train_route` (
  `station_id` int(4) NOT NULL,
  `station_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`station_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `train_route` (`station_id`, `station_name`) VALUES
(5001,	'DELHI'),
(5002,	'ALUVA'),
(5003,	'BANGLORE'),
(5004,	'PATNA'),
(5005,	'MADRAS');

DROP TABLE IF EXISTS `train_schedule`;
CREATE TABLE `train_schedule` (
  `train_no` int(4) NOT NULL,
  `station_id` int(4) NOT NULL,
  `arr_time` varchar(10) DEFAULT NULL,
  `dep_time` varchar(10) DEFAULT NULL,
  KEY `station_id` (`station_id`),
  KEY `train_no` (`train_no`),
  CONSTRAINT `train_schedule_ibfk_5` FOREIGN KEY (`station_id`) REFERENCES `train_route` (`station_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `train_schedule_ibfk_6` FOREIGN KEY (`train_no`) REFERENCES `trains_info` (`train_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `datejoined` timestamp NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `avatar` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`id`, `username`, `password`, `email`, `datejoined`, `activated`, `avatar`) VALUES
(1,	'reserve',	'3ae9d8799d1bb5e201e5704293bb54ef',	'er@gf',	'2016-10-14 19:23:52',	'0',	'link.png'),
(2,	'admin',	'8f96e4f5fcff936298f13a4b8db8a242',	'admin@orrs',	'2016-10-21 09:15:24',	'0',	NULL),
(3,	'student',	'cd73502828457d15655bbd7a63fb0bc8',	'e@werw',	'2016-10-30 20:33:20',	'0',	NULL);

-- 2016-11-01 10:23:33
