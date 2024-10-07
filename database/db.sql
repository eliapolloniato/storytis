DROP TABLE IF EXISTS `Chapters`;
CREATE TABLE `Chapters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `storyId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `storyId` (`storyId`),
  CONSTRAINT `Chapters_ibfk_3` FOREIGN KEY (`storyId`) REFERENCES `Stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Characters`;
CREATE TABLE `Characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `classId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  CONSTRAINT `Characters_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Choices`;
CREATE TABLE `Choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `optionText` varchar(255) NOT NULL,
  `rewardId` int(11) DEFAULT NULL,
  `chapterId` int(11) NOT NULL,
  `nextChapterId` int(11) NOT NULL,
  `requiredSkillType` int(11) NOT NULL,
  `requiredSkillLevel` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `chapterId` (`chapterId`),
  KEY `nextChapterId` (`nextChapterId`),
  CONSTRAINT `Choices_ibfk_1` FOREIGN KEY (`chapterId`) REFERENCES `Chapters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Choices_ibfk_2` FOREIGN KEY (`nextChapterId`) REFERENCES `Chapters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Games`;
CREATE TABLE `Games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `storyId` int(11) NOT NULL,
  `characterId` int(11) NOT NULL,
  `startDate` date NOT NULL,
  `chapterId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `characterId` (`characterId`),
  KEY `chapterId` (`chapterId`),
  KEY `storyId` (`storyId`),
  KEY `userId` (`userId`),
  CONSTRAINT `Games_ibfk_11` FOREIGN KEY (`characterId`) REFERENCES `Characters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Games_ibfk_12` FOREIGN KEY (`chapterId`) REFERENCES `Chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Games_ibfk_13` FOREIGN KEY (`storyId`) REFERENCES `Stories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Games_ibfk_14` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `InventoryItems`;
CREATE TABLE `InventoryItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemId` int(11) NOT NULL,
  `characterId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `itemId` (`itemId`),
  KEY `characterId` (`characterId`),
  CONSTRAINT `InventoryItems_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `Rewards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `InventoryItems_ibfk_2` FOREIGN KEY (`characterId`) REFERENCES `Characters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Rewards`;
CREATE TABLE `Rewards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `affectedSkillType` int(11) NOT NULL,
  `value` varchar(32) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Skills`;
CREATE TABLE `Skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `characterId` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  `value` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `characterId` (`characterId`),
  CONSTRAINT `Skills_ibfk_1` FOREIGN KEY (`characterId`) REFERENCES `Characters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Stories`;
CREATE TABLE `Stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `firstChapterId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `firstChapterId` (`firstChapterId`),
  CONSTRAINT `Stories_ibfk_1` FOREIGN KEY (`firstChapterId`) REFERENCES `Chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
