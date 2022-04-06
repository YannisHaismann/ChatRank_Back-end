INSERT INTO `type` (`id`, `name`) VALUES (1, 'Viewer'), (2, 'Streamer');

INSERT INTO `sex` (`id`, `name`) VALUES (1, 'Man'), (2, 'Woman'), (3, 'Other');

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `username`, `date_of_birthday`, `url_profile_img`, `phone_number`, `type_id`, `sex_id`, `viewers`, `streamers`, `date_of_update`)
VALUES
(1, 'pierrick02732@gmail.com', '[\"ROLE_STREAMER\"]', '$2y$13$kks/47aJrCpa8LZhP9NeyOrlmBZd4picEIJ6yQ6WxeSlZMVkfE/8m', 'pierrick', 'communier', 'Vitalik', '1990-04-03 00:00:00', 'default-profile-picture.jpg', '0600000000', 2, 1, '2,3,5', '2,3,5', '2022-03-09 16:03:39'),
(2, 'aprille02732@gmail.com', '[\"ROLE_STREAMER\"]', '$2y$13$nN3Wt1LvTLtmRV8P9TvY8.eqakxjZOpyi9aklQFusFHG.TAWmvh56', 'marion', 'communier', 'Aprille', '1990-04-03 00:00:00', 'default-profile-picture.jpg', '0600000000', 2, 2, '1', '1', '2022-03-11 16:03:50'),
(3, 'yannis02732@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$Hx.WZRB3q51NTBxCj/KiP.MF1BZBEsA8VHSevF8RH8Q442vISfL/2', 'yannis', 'haismann', 'The Rock', '1990-09-17 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 1, '1', '1', '2022-03-14 16:04:00'),
(4, 'bfbgbrtyn@gmail.com', '[\"ROLE_STREAMER\"]', '$2y$13$I7RHndavIzmVqyEZAgg5h.uUHDGinNbZJtwrMZ50lzDifJ95nDh3K', 'string', 'string', 'vitos', '2022-03-15 16:19:44', 'default-profile-picture.jpg', '0600000000', 2, 1, NULL, NULL, '2022-03-16 16:04:08'),
(5, 'vbifbvufbtb@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$LWMfxbOf0oZWfhPW5NrmReatojfye79XTkFNPOP.eIP9vGXTb7jES', 'marie', 'lemarchand', 'Mimi', '1991-05-08 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 2, '1', '1', '2022-03-21 14:11:55'),
(6, 'vghyfbtb@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$p2CUaPhyRYD163fgm/nyz.opCr07scCUQvjP1FsEiUwyQWDf3/7j.', 'fgthyrjyj', 'tnzyjnyjuk,', 'Mimifhthz', '1991-05-08 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 2, NULL, NULL, '2022-03-31 08:10:55'),
(7, 'vghyffffbtb@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$gUfTwGiGKfYPBSUokGmc1.y/0r.NYE4RSreYcLHMnF5nYE5CU9JRS', 'fgthyrjyj', 'tnzyjnyjuk,', 'Mimifhthzg', '1991-05-08 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 2, NULL, NULL, '2022-03-31 08:33:45'),
(8, 'v1ghyffffbntb@gmail.com', '[\"ROLE_VIEWER\"]', '$2y$13$6.GMEsgkQJB.gSefAAYq8O/N6hfvek1quqEXLgsokGUsrAgAQkrzq', 'fgthyrjyj', 'tnzyjnyjuk,', 'Mimifhthzgk1', '1991-05-08 00:00:00', 'default-profile-picture.jpg', '0600000000', 1, 2, NULL, NULL, '2022-04-01 16:26:48');

INSERT INTO `league_of_legend` (`id`, `user_id`, `username`, `level`, `actual_season`, `ranked_solo`, `ranked_flex`, `win`, `loose`)
VALUES
(1, 1, 'Vitalik2732', 30, 2022, 'Gold', 'Gold', 50, 20),
(2, 2, 'Aprille027', 20, 2022, 'Silver', 'Gold', 40, 35),
(3, 3, 'The BG', 80, 2022, 'Platine', 'Platine', 100, 30);

INSERT INTO `line_lol` (`id`, `league_of_legend_id`, `name`, `played_rate`, `win_rate`)
VALUES
(1, 1, 'Middle', 60, 70),
(2, 1, 'Top', 30, 40),
(3, 2, 'Bottom', 70, 50),
(4, 2, 'Middle', 20, 60),
(5, 3, 'Jungle', 80, 75),
(6, 3, 'Top', 12, 60);

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
(9, 3, 'Renekton', 9, 7);