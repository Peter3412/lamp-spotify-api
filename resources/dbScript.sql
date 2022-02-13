--users
  CREATE TABLE `users` (
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `user_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `user_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--history
  CREATE TABLE `history` (
    `id` int(200) NOT NULL AUTO_INCREMENT,
    `user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `track_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `artist_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `track_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `played_at` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `context` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--auth/refresh tokens
  CREATE TABLE `tokens` (
    `id` int(200) NOT NULL AUTO_INCREMENT,
    `user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `auth_token` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `refresh_token` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;