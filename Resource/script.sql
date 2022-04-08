/*
    Script qui permet la création de la BDD
*/

CREATE DATABASE `chatRank_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `chatRank_db`;

CREATE TABLE `user`(
    `id` int NOT NULL AUTO_INCREMENT,
    `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
    `roles` json NOT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `date_of_birthday` datetime NOT NULL,
    `url_profile_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `type_id` int NOT NULL,
    `sex_id` int NOT NULL,
    `viewers` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
    `streamers` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
    `date_of_update` datetime NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
    KEY `IDX_8D93D649C54C8C93` (`type_id`),
    KEY `IDX_8D93D6495A2DB2A0` (`sex_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `type` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sex` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `league_of_legend` (
    `id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL,
    `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `level` int NOT NULL,
    `actual_season` int NOT NULL,
    `ranked_solo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `ranked_flex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `win` int NOT NULL,
    `loose` int NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `UNIQ_832D2162A76ED395` (`user_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `line_lol` (
    `id` int NOT NULL AUTO_INCREMENT,
    `league_of_legend_id` int NOT NULL,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `played_rate` int NOT NULL,
    `win_rate` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_EBA68217E452936B` (`league_of_legend_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `champion_lol` (
    `id` int NOT NULL AUTO_INCREMENT,
    `league_of_legend_id` int NOT NULL,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `loose` int NOT NULL,
    `win` int NOT NULL,
    PRIMARY KEY (`id`),
    KEY `IDX_441B9DF9E452936B` (`league_of_legend_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `user` ADD CONSTRAINT `FK_8D93D6495A2DB2A0` FOREIGN KEY (`sex_id`) REFERENCES `sex` (`id`);
ALTER TABLE `user` ADD CONSTRAINT `FK_8D93D649C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);

ALTER TABLE `league_of_legend` ADD CONSTRAINT `FK_832D2162A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `line_lol` ADD CONSTRAINT `FK_EBA68217E452936B` FOREIGN KEY (`league_of_legend_id`) REFERENCES `league_of_legend` (`id`);

ALTER TABLE `champion_lol` ADD CONSTRAINT `FK_441B9DF9E452936B` FOREIGN KEY (`league_of_legend_id`) REFERENCES `league_of_legend` (`id`);