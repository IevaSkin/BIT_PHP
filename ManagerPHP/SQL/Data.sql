use darbuotoju_duombaze;
CREATE TABLE `darbuotojai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `proj_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `proj_id_idx` (`proj_id`),
  CONSTRAINT `proj_id` FOREIGN KEY (`proj_id`) REFERENCES `projektai` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

INSERT INTO `darbuotojai` VALUES (1,'Ieva',1),(2,'Tomas',1),(3,'Linas',2),(4,'Rita',NULL),(5,'Darius',5),(6,'Matas',3),(7,'Tadas',5),(8,'Nojus',1);

CREATE TABLE `projektai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_lithuanian_ci;

INSERT INTO `projektai` VALUES (1,'PHP Kursas'),(2,'Java Kursas'),(3,'HTML Kursas'),(4,'SEO kursas'),(5,'Python kursas');


