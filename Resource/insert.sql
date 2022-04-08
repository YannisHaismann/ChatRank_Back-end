/*
    Jeu de données
    Le MDP de chaque utilisateur correspond à : test1234
*/

INSERT INTO `type` (`id`, `name`) VALUES (1, 'Viewer'), (2, 'Streamer');

INSERT INTO `sex` (`id`, `name`) VALUES (1, 'Man'), (2, 'Woman'), (3, 'Other');

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `username`, `date_of_birthday`, `url_profile_img`, `phone_number`, `type_id`, `sex_id`, `viewers`, `streamers`, `date_of_update`)
VALUES
(1, 'pierre@gmail.com', '[\"ROLE_STREAMER\"]', '$2y$13$kks/47aJrCpa8LZhP9NeyOrlmBZd4picEIJ6yQ6WxeSlZMVkfE/8m', 'pierre', 'leblanc', 'pierre51', '1990-04-03 00:00:00', 'default-profile-picture.jpg', '0600000000', 2, 1, '2,3,5', '2,3,5', '2022-03-09 16:03:39'),
(2, 'marion@gmail.com', '[\"ROLE_STREAMER\"]', '$2y$13$nN3Wt1LvTLtmRV8P9TvY8.eqakxjZOpyi9aklQFusFHG.TAWmvh56', 'marion', 'leroy', 'marion37', '1992-09-22 00:00:00', 'default-profile-picture.jpg', '0600000000', 2, 2, '1', '1', '2022-03-11 16:03:50'),
(3, 'vincent@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$Hx.WZRB3q51NTBxCj/KiP.MF1BZBEsA8VHSevF8RH8Q442vISfL/2', 'vincent', 'mercier', 'vincent44', '1990-09-17 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 1, '1', '1', '2022-03-14 16:04:00'),
(4, 'kevin@gmail.com', '[\"ROLE_STREAMER\"]', '$2y$13$Hx.WZRB3q51NTBxCj/KiP.MF1BZBEsA8VHSevF8RH8Q442vISfL/2', 'kevin', 'caron', 'kevin13', '1994-03-15 16:19:44', 'default-profile-picture.jpg', '0600000000', 2, 1, NULL, NULL, '2022-03-16 16:04:08'),
(5, 'marie@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$LWMfxbOf0oZWfhPW5NrmReatojfye79XTkFNPOP.eIP9vGXTb7jES', 'marie', 'lemarchand', 'marie60', '1991-05-08 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 2, '1', '1', '2022-03-21 14:11:55'),
(6, 'julie@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$p2CUaPhyRYD163fgm/nyz.opCr07scCUQvjP1FsEiUwyQWDf3/7j.', 'julie', 'guichard,', 'julie94', '1991-12-16 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 2, NULL, NULL, '2022-03-31 08:10:55'),
(7, 'vick@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$gUfTwGiGKfYPBSUokGmc1.y/0r.NYE4RSreYcLHMnF5nYE5CU9JRS', 'vick', 'leclerc,', 'vick34', '1989-02-27 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 2, NULL, NULL, '2022-03-31 08:33:45'),
(8, 'sarah@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$6.GMEsgkQJB.gSefAAYq8O/N6hfvek1quqEXLgsokGUsrAgAQkrzq', 'sarah', 'monnier,', 'sarah', '1991-05-08 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 2, NULL, NULL, '2022-04-01 16:26:48');

INSERT INTO `league_of_legend` (`id`, `user_id`, `username`, `level`, `actual_season`, `ranked_solo`, `ranked_flex`, `win`, `loose`)
VALUES
(1, 1, 'pierrot51', 30, 2022, 'Gold', 'Gold', 50, 20),
(2, 2, 'mimi37', 20, 2022, 'Silver', 'Gold', 40, 35),
(3, 3, 'vinc44', 80, 2022, 'Platine', 'Platine', 100, 30),
(4, 6, 'juju94', 72, 2022, 'Master', 'Bronze', 88, 34);

INSERT INTO `line_lol` (`id`, `league_of_legend_id`, `name`, `played_rate`, `win_rate`)
VALUES
(1, 1, 'Middle', 60, 70),
(2, 1, 'Top', 30, 40),
(3, 2, 'adc', 70, 50),
(4, 2, 'Middle', 20, 60),
(5, 3, 'Jungle', 80, 75),
(6, 3, 'Top', 12, 60),
(7, 4, 'support', 73, 76),
(8, 4, 'adc', 19, 50);

INSERT INTO `champion_lol` (`id`, `league_of_legend_id`, `name`, `loose`, `win`)
VALUES
(1, 1, 'Ahri', 12, 40),
(2, 1, 'Lux', 4, 6),
(3, 1, 'Séraphine', 4, 4),
(4, 2, 'Zyra', 10, 20),
(5, 2, 'Yuumi', 14, 14),
(6, 2, 'Ekko', 11, 6),
(7, 3, 'Nasus', 9, 77),
(8, 3, 'Jinx', 12, 16),
(9, 3, 'Renekton', 9, 7),
(10, 4, 'Ashe', 51, 13),
(11, 4, 'Caitlyn', 23, 12),
(12, 4, 'Lillia', 14, 9);