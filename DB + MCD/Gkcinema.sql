-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour gkcinema
CREATE DATABASE IF NOT EXISTS `gkcinema` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gkcinema`;

-- Listage de la structure de table gkcinema. actor
CREATE TABLE IF NOT EXISTS `actor` (
  `id_actor` int NOT NULL AUTO_INCREMENT,
  `person_id` int NOT NULL,
  PRIMARY KEY (`id_actor`) USING BTREE,
  KEY `FK_actor_person` (`person_id`) USING BTREE,
  CONSTRAINT `FK_actor_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.actor : ~7 rows (environ)
INSERT INTO `actor` (`id_actor`, `person_id`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6),
	(7, 7);

-- Listage de la structure de table gkcinema. appartenir
CREATE TABLE IF NOT EXISTS `appartenir` (
  `category_id` int NOT NULL,
  `film_id` int NOT NULL,
  KEY `Id_Category` (`category_id`) USING BTREE,
  KEY `FK_appartenir_film` (`film_id`) USING BTREE,
  CONSTRAINT `FK_appartenir_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_appartenir_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.appartenir : ~8 rows (environ)
INSERT INTO `appartenir` (`category_id`, `film_id`) VALUES
	(1, 1),
	(1, 5),
	(1, 8),
	(2, 2),
	(2, 6),
	(3, 3),
	(4, 4),
	(4, 7);

-- Listage de la structure de table gkcinema. casting
CREATE TABLE IF NOT EXISTS `casting` (
  `film_id` int NOT NULL,
  `actor_id` int NOT NULL,
  `role_id` int NOT NULL,
  KEY `FK_casting_actor` (`actor_id`) USING BTREE,
  KEY `FK_casting_role` (`role_id`) USING BTREE,
  KEY `FK_casting_film` (`film_id`) USING BTREE,
  CONSTRAINT `FK_casting_actor` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id_actor`),
  CONSTRAINT `FK_casting_film` FOREIGN KEY (`film_id`) REFERENCES `film` (`id_film`),
  CONSTRAINT `FK_casting_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.casting : ~10 rows (environ)
INSERT INTO `casting` (`film_id`, `actor_id`, `role_id`) VALUES
	(1, 1, 2),
	(5, 1, 2),
	(8, 1, 2),
	(2, 5, 1),
	(6, 2, 1),
	(3, 3, 3),
	(4, 4, 4),
	(7, 4, 4),
	(8, 7, 5);

-- Listage de la structure de table gkcinema. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `category_name`) VALUES
	(1, 'Science-fiction'),
	(2, 'Action'),
	(3, 'Thriller'),
	(4, 'Comédie'),
	(5, 'animalier');

-- Listage de la structure de table gkcinema. category_film
CREATE TABLE IF NOT EXISTS `category_film` (
  `id_category` int DEFAULT NULL,
  `id_film` int DEFAULT NULL,
  KEY `id_category` (`id_category`),
  KEY `id_film` (`id_film`),
  CONSTRAINT `FK_category_film_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  CONSTRAINT `FK_category_film_film` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.category_film : ~8 rows (environ)
INSERT INTO `category_film` (`id_category`, `id_film`) VALUES
	(1, 1),
	(4, 4),
	(4, 7),
	(2, 2),
	(2, 6),
	(3, 3),
	(1, 5),
	(1, 8);

-- Listage de la structure de table gkcinema. director
CREATE TABLE IF NOT EXISTS `director` (
  `id_director` int NOT NULL AUTO_INCREMENT,
  `person_id` int NOT NULL,
  `url_img` varchar(255) COLLATE utf8mb3_swedish_ci NOT NULL,
  PRIMARY KEY (`id_director`) USING BTREE,
  KEY `FK_director_person` (`person_id`) USING BTREE,
  CONSTRAINT `FK_director_person` FOREIGN KEY (`person_id`) REFERENCES `person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.director : ~5 rows (environ)
INSERT INTO `director` (`id_director`, `person_id`, `url_img`) VALUES
	(1, 8, 'https://cfj.org/wp-content/uploads/2021/04/George-Clooney-scaled.jpg'),
	(2, 9, 'https://cfj.org/wp-content/uploads/2021/04/George-Clooney-scaled.jpg'),
	(3, 10, 'https://cfj.org/wp-content/uploads/2021/04/George-Clooney-scaled.jpg'),
	(4, 11, 'https://cfj.org/wp-content/uploads/2021/04/George-Clooney-scaled.jpg'),
	(5, 6, 'https://cfj.org/wp-content/uploads/2021/04/George-Clooney-scaled.jpg');

-- Listage de la structure de table gkcinema. film
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `film_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci DEFAULT NULL,
  `dt_release` int DEFAULT NULL,
  `film_length` int DEFAULT NULL,
  `synopsis` text CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci,
  `url_img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci DEFAULT NULL,
  `director_id` int DEFAULT NULL,
  `note` int DEFAULT NULL,
  PRIMARY KEY (`id_film`) USING BTREE,
  KEY `FK_film_director` (`director_id`) USING BTREE,
  CONSTRAINT `FK_film_director` FOREIGN KEY (`director_id`) REFERENCES `director` (`id_director`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.film : ~8 rows (environ)
INSERT INTO `film` (`id_film`, `film_name`, `dt_release`, `film_length`, `synopsis`, `url_img`, `director_id`, `note`) VALUES
	(1, 'Star Wars 1', 1999, 216, 'Avant de devenir un célèbre chevalier Jedi, et bien avant de se révéler l\'âme la plus noire de la galaxie, Anakin Skywalker est un jeune esclave sur la planète Tatooine. La Force est déjà puissante en lui et il est un remarquable pilote de Podracer. Le maître Jedi Qui-Gon Jinn le découvre et entrevoit alors son immense potentiel. Pendant ce temps, l\'armée de droïdes de l\'insatiable Fédération du Commerce a envahi Naboo dans le cadre d\'un plan secret des Sith visant à accroître leur pouvoir.', 'https://www.ecranlarge.com/media/cache/1600x1200/uploads/image/001/120/affiche-1120453.jpg', 1, 3),
	(2, 'Batman Begins', 1997, 220, 'Comment un homme seul peut-il changer le monde ? Telle est la question qui hante Bruce Wayne depuis cette nuit tragique où ses parents furent abattus sous ses yeux, dans une ruelle de Gotham City. Torturé par un profond sentiment de colère et de culpabilité, le jeune héritier de cette richissime famille fuit Gotham pour un long et discret voyage à travers le monde. Le but de ses pérégrinations : sublimer sa soif de vengeance en trouvant de nouveaux moyens de lutter contre l\'injustice.', 'https://fr.web.img3.acsta.net/pictures/22/10/04/08/52/2484953.jpg', 2, 4),
	(3, 'Monster', 2000, 115, 'Aileen zone depuis des années et survit en se prostituant. Un jour, elle rencontre dans un bar Selby, une jeune lesbienne un peu immature, dont elle tombe vite amoureuse. Les deux jeunes filles tentent alors d\'échapper à leur quotidien. Pourtant, parce que la situation financière n\'est pas facile, Aileen retourne se prostituer. Une nuit, elle se fait agresser par un client qu\'elle parvient in extremis à tuer. Un premier crime. D\'autres, alors, suivront.', 'https://www.ecranlarge.com/uploads/image/001/190/aevmntjcng4zlfeeegz79frmues-424.jpg', 3, 3),
	(4, 'Le Smoking', 2010, 216, 'Jimmy Tong, chauffeur de taxi à New York, a pour client un richissime homme d\'affaires nommé Clark Devlin. Clark propose à Jimmy de l\'engager comme chauffeur, à condition que ce dernier ne touche jamais à son smoking. Vint le jour où les deux hommes tombent dans une embuscade. Clark Devlin, sérieusement blessé durant l\'attaque, demande à Jimmy de porter le fameux smoking.\r\n\r\n', 'https://fr.web.img2.acsta.net/medias/nmedia/00/02/54/65/affiche.jpg', 4, 2),
	(5, 'Star Wars 2', 1994, 220, 'Depuis le blocus de la planète Naboo, la République, gouvernée par le Chancelier Palpatine, connaît une crise. Un groupe de dissidents, mené par le sombre Jedi comte Dooku, manifeste son mécontentement. Le Sénat et la population intergalactique se montrent pour leur part inquiets. Certains sénateurs demandent à ce que la République soit dotée d\'une armée pour empêcher que la situation ne se détériore. Padmé Amidala, devenue sénatrice, est menacée par les séparatistes et échappe à un attentat.', 'https://fr.web.img5.acsta.net/medias/nmedia/00/02/34/81/affclones.jpg', 1, 4),
	(6, 'Batman returns', 1992, 206, 'Non seulement Batman doit affronter le Pingouin, monstre génétique doté d\'une intelligence à toute épreuve, qui sème la terreur mais, plus difficile encore, il doit faire face à la séduction de deux super-femmes, la douce Selina Kyle et la féline Catwoman qui va lui donner bien du fil a retordre. Si Bruce Wayne apprécie Selina, Batman n\'est pas insensible au charme de Catwoman.', 'https://m.media-amazon.com/images/M/MV5BOGZmYzVkMmItM2NiOS00MDI3LWI4ZWQtMTg0YWZkODRkMmViXkEyXkFqcGdeQXVyODY0NzcxNw@@._V1_.jpg', 2, 2),
	(7, 'Rush Hour 1', 1998, 95, 'Rien ne prédisposait l\'inspecteur Lee et le détective James Carter à faire équipe un jour. Pourtant, lorsque la fille du consul de Chine aux États-Unis est victime d\'un enlèvement, le FBI ordonne aux deux limiers de collaborer. Les relations entre Lee, héros de la police royale de Hong Kong, et Carter, personnage prétentieux et incontrôlable, brebis galeuse de la police de Los Angeles, s\'annoncent tendues.', 'https://fr.web.img2.acsta.net/medias/03/77/86/037786_af.jpg', 4, 1),
	(8, 'Stars Wars 3', 2005, 220, 'La Guerre des Clones fait rage. Une franche hostilité oppose désormais le Chancelier Palpatine au Conseil Jedi. Anakin Skywalker, jeune Chevalier Jedi pris entre deux feux, hésite sur la conduite à tenir. Séduit par la promesse d\'un pouvoir sans précédent, tenté par le côté obscur de la Force, il prête allégeance au maléfique Darth Sidious et devient Dark Vador.Les Seigneurs Sith s\'unissent alors pour préparer leur revanche, qui commence par l\'extermination des Jedi.', 'https://fr.web.img3.acsta.net/medias/nmedia/18/35/53/23/18423997.jpg', 1, 4);

-- Listage de la structure de table gkcinema. person
CREATE TABLE IF NOT EXISTS `person` (
  `id_person` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `lname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `bdate` date NOT NULL,
  `sexe` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `url_img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  PRIMARY KEY (`id_person`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.person : ~11 rows (environ)
INSERT INTO `person` (`id_person`, `fname`, `lname`, `bdate`, `sexe`, `url_img`) VALUES
	(1, 'Ford', 'Harisson', '1942-07-13', 'homme', 'https://static1.purebreak.com/people/3/45/3/@/76382-36550-harrison-ford-fullscreen-1-624x0-1.jpg'),
	(2, 'Bale', 'Christian', '1974-01-30', 'homme', 'https://www.fredzone.org/wp-content/uploads/2022/02/christian_bale_meilleurs_films-scaled.jpg'),
	(3, 'Theron', 'Charlize', '1975-08-07', 'femme', 'https://file1.closermag.fr/var/closermag/storage/images/article/charlize-theron-10-choses-etonnantes-sur-l-actrice-de-the-last-face-697160/5583270-1-fre-FR/Charlize-Theron-10-choses-etonnantes-sur-l-actrice-de-The-last-face.jpg?alias=exact540x405_l'),
	(4, 'Chan', 'Jackie', '1954-04-07', 'homme', 'https://fr.web.img6.acsta.net/pictures/16/01/07/16/44/109721.jpg'),
	(5, 'Kilmer', 'Val', '1959-12-31', 'homme', 'https://aws.vdkimg.com/artist/1/2/5/5/12555_photo_scale_160x200.jpg'),
	(6, 'Clooney', 'George', '1961-05-06', 'homme', 'https://cfj.org/wp-content/uploads/2021/04/George-Clooney-scaled.jpg'),
	(7, 'Hamill', 'Luke', '1951-09-25', 'homme', 'https://upload.wikimedia.org/wikipedia/commons/6/68/Mark_Hamill_by_Gage_Skidmore_2.jpg'),
	(8, 'Lucas', 'George', '1944-05-14', 'homme', 'https://upload.wikimedia.org/wikipedia/commons/a/a0/George_Lucas_cropped_2009.jpg'),
	(9, 'Reeves', 'Matt', '1966-04-27', 'homme', 'https://m.media-amazon.com/images/M/MV5BYmM5NTA4ZGMtMGJhYy00YzlhLThlM2QtZjFjY2Y5YmJjOTE2XkEyXkFqcGdeQXVyNzg5MzIyOA@@._V1_.jpg'),
	(10, 'Jenkins', 'Patty', '1971-07-24', 'femme', 'https://cinepassion34.fr/wp-content/uploads/2017/06/Patty-Jenkins-cinepassion34.jpg'),
	(11, 'Donovan', 'Kevin', '1971-12-17', 'homme', 'https://m.media-amazon.com/images/M/MV5BNTQ2MjMyNTQwN15BMl5BanBnXkFtZTgwNTM1MDU4NTE@._V1_.jpg');

-- Listage de la structure de table gkcinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  PRIMARY KEY (`id_role`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

-- Listage des données de la table gkcinema.role : ~5 rows (environ)
INSERT INTO `role` (`id_role`, `role_name`) VALUES
	(1, 'Batman'),
	(2, 'Han Solo'),
	(3, 'Aileen'),
	(4, 'Jimmy Tong'),
	(5, 'Skywalker Luke');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
