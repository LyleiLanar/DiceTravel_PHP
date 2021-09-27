-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dice_travel
-- ------------------------------------------------------
-- Server version	8.0.19

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'User azonoító.\n',
  `login_name` varchar(20) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'A  user egyedi neve a rendszerben.',
  `pswd` varchar(32) COLLATE utf8_hungarian_ci NOT NULL DEFAULT '' COMMENT 'A user jelszavának md5  hash kódja.',
  `sur_name` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL COMMENT 'A user keresztneve.\n',
  `first_name` varchar(20) COLLATE utf8_hungarian_ci DEFAULT NULL COMMENT 'A user vezetékneve.\\n',
  `birth_date` date DEFAULT NULL COMMENT 'A user születési dátuma',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_name_UNIQUE` (`login_name`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='A userekkel kapcsolatos információkat tartalmazó tábla.';

--
-- Table structure for table `journeys`
--

DROP TABLE IF EXISTS `journeys`;
CREATE TABLE `journeys` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Journey azonosító\n',
  `user_id` int NOT NULL COMMENT 'User azonosítója\n',
  `title` varchar(50) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'Új Utazás',
  `start_location` varchar(20) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'journey kiindulópontja\n',
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'journey indulási dátuma\\n',
  `closed` int NOT NULL DEFAULT '0' COMMENT 'Megmutatja, hogy véget ért-e a journey.\n',
  `visibility` int NOT NULL DEFAULT '0' COMMENT 'A journey láthatósága. (2: public, 1: friendOnly, 0: private)\\n',
  PRIMARY KEY (`id`),
  KEY `creatorUser_idx` (`user_id`),
  CONSTRAINT `creatorUser` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Journey tábla, ez tárolja a journey indulási adatait\n';

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
CREATE TABLE `trips` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Trip adatai\n',
  `journey_id` int NOT NULL COMMENT 'A triphez tartozó journey_id\n',
  `serial_number` int NOT NULL COMMENT 'Ez határozza meg az egy journeybe tartozó tripek sorrendjét.\n',
  `end_location` varchar(20) COLLATE utf8_hungarian_ci NOT NULL COMMENT 'Itt van eltárolva a trip célállomása.\n',
  `end_date` datetime DEFAULT NULL COMMENT 'Ez mutatja meg, hogy vége van-e a tripnek. Ha a Journeynek van olyan tripje, ami null, akkor az az aktív.\\n',
  `visibility` int NOT NULL DEFAULT '0' COMMENT 'A trip láthatósága. (2: public, 1: friendOnly, 0: private)\n',
  PRIMARY KEY (`id`),
  KEY `journey_id_idx` (`journey_id`),
  CONSTRAINT `journey_id` FOREIGN KEY (`journey_id`) REFERENCES `journeys` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Trips tábla, ez tárolja a tripek adatait.\n';

--
-- Table structure for table `entries`
--

DROP TABLE IF EXISTS `entries`;
CREATE TABLE `entries` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'Entry azonosítója\n',
  `trip_id` int NOT NULL COMMENT 'Az entry-hez tartozó trip-id \n',
  `entry_date` timestamp(1) NOT NULL COMMENT 'Az entry bejegyzésének az ideje.\n',
  `picture` mediumblob COMMENT 'Az entry-hez tartozó kép.\\n',
  `comment` varchar(1024) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'Üres comment!' COMMENT 'Az entry-hez tartozó szöveg.\\n',
  `visibility` int NOT NULL DEFAULT '0' COMMENT 'A trip lĂˇthatĂłsĂˇga. (2: public, 1: friendOnly, 0: private)\n',
  `title` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trip_id_idx` (`trip_id`),
  CONSTRAINT `trip_id` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Entry tábla itt vannak az entry-k eltárolva.\n';

--
-- Table structure for table `joureny_participants`
--

DROP TABLE IF EXISTS `joureny_participants`;
CREATE TABLE `joureny_participants` (
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'User azonosító\n',
  `journey_id` int NOT NULL DEFAULT '-1' COMMENT 'Journey azonosító\n(-1 esetlben nem lett létrehozva neki journey. ez baj)',
  `accepted` int NOT NULL DEFAULT '0' COMMENT 'Ez mutatja meg, hogy az adott felhasználó elfogadta-e már a journey invitációt. (1:elfogadta; 0: elutasította)\n',
  PRIMARY KEY (`user_id`),
  KEY `journey_id_connect_idx` (`journey_id`),
  CONSTRAINT `journey_id_connect` FOREIGN KEY (`journey_id`) REFERENCES `journeys` (`id`),
  CONSTRAINT `user_id_connect` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='User - Journey kapcsolótábla, hogy kik melyik Journey-n vesznek, vettek részt. Egy usernek egyszerre csak egy aktív journey-je lehet.\n';

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `sender_id` int NOT NULL,
  `getter_id` int NOT NULL,
  `accepted` int DEFAULT NULL COMMENT '- Null: Még nem került elbírálásra.\n- 0: elutasítva\n- 1: elfogadva\n',
  PRIMARY KEY (`sender_id`,`getter_id`),
  KEY `getter_id_idx` (`getter_id`),
  CONSTRAINT `getter_id` FOREIGN KEY (`getter_id`) REFERENCES `users` (`id`),
  CONSTRAINT `sender_id` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci COMMENT='Barátok kapcsolata vannak eltárolva ebben a táblában\n';
