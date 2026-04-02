-- DevAfrica Arena — Backup 2026-03-18 18:06:01

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE `activity_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) unsigned DEFAULT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `subject_detail` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_admin_id_foreign` (`admin_id`),
  CONSTRAINT `activity_logs_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activity_logs` VALUES ('12', '1', 'Adjété Alex WILSON', 'envoyé', 'Newsletter', 'Sujet: Actualités DevAfrica Arena — 1 envois', '127.0.0.1', '2026-03-18 17:36:10', '2026-03-18 17:36:10');

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('super','sub') NOT NULL DEFAULT 'super',
  `can_edit` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  KEY `admins_created_by_foreign` (`created_by`),
  CONSTRAINT `admins_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admins` VALUES ('1', 'Adjété Alex WILSON', 'admin@devafrica.arena', 'super', '0', '$2y$12$OCf4hqxmvbgbSRMDlTNS8uxhH//na5/P87UDuO9luvGDqeKxokwaG', NULL, NULL, NULL, '2026-03-11 13:39:07', '2026-03-11 13:39:07', NULL);
INSERT INTO `admins` VALUES ('2', 'Juliette ALOKPA', 'alokpajuliettejuju@gmail.com', 'sub', '0', '$2y$12$YEiX7ip.R0XX3cdu7DxyTO6KLr4AbnOXHXg5zxRWpSd8YTIy1cuke', NULL, NULL, NULL, '2026-03-18 17:14:11', '2026-03-18 17:14:27', '1');

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` VALUES ('devafrica_5c785c036466adea360111aa28563bfd556b5fba', 'i:2;', '1773853705');
INSERT INTO `cache` VALUES ('devafrica_5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1773853705;', '1773853705');
INSERT INTO `cache` VALUES ('devafrica_setting_maintenance_mode', 's:1:\"0\";', '1773860598');
INSERT INTO `cache` VALUES ('devafrica_setting_nb_finalistes', 's:1:\"6\";', '1773860598');
INSERT INTO `cache` VALUES ('devafrica_setting_newsletter_subject', 's:27:\"Actualités DevAfrica Arena\";', '1773856933');
INSERT INTO `cache` VALUES ('devafrica_setting_site_name', 's:15:\"DevAfrica Arena\";', '1773856933');

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `candidatures`;
CREATE TABLE `candidatures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` tinyint(4) NOT NULL,
  `niveau` enum('Junior','Intermédiaire','Senior') NOT NULL,
  `pays` varchar(255) NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `diplome` varchar(255) NOT NULL,
  `motivation` text NOT NULL,
  `vision` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `note` tinyint(4) DEFAULT NULL,
  `commentaire_admin` text DEFAULT NULL,
  `finaliste` tinyint(1) NOT NULL DEFAULT 0,
  `statut` varchar(255) NOT NULL DEFAULT 'en_attente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `editions`;
CREATE TABLE `editions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `date_selection` date NOT NULL,
  `date_finale` date NOT NULL,
  `lieu` varchar(255) NOT NULL DEFAULT 'Lomé, Togo',
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `editions` VALUES ('1', 'Édition #1 — Saison 2026', '2026-09-12', '2026-09-13', 'Lomé, Togo', '1', '2026-03-11 13:39:07', '2026-03-11 13:39:07');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` bigint(20) unsigned NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'general',
  `uploaded_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `media_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` VALUES ('1', '0001_01_01_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` VALUES ('3', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2026_01_01_100000_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('5', '2026_01_01_100001_create_editions_table', '1');
INSERT INTO `migrations` VALUES ('6', '2026_01_01_100002_create_candidatures_table', '1');
INSERT INTO `migrations` VALUES ('7', '2026_01_01_100003_create_partenaires_table', '1');
INSERT INTO `migrations` VALUES ('8', '2026_01_01_100004_create_contact_messages_table', '1');
INSERT INTO `migrations` VALUES ('9', '2026_01_01_100005_create_newsletters_table', '1');
INSERT INTO `migrations` VALUES ('10', '2026_01_01_100006_update_admins_table', '2');
INSERT INTO `migrations` VALUES ('11', '2026_03_14_000001_add_read_at_to_messages_and_candidatures', '3');
INSERT INTO `migrations` VALUES ('12', '2026_03_14_000002_create_activity_logs_table', '3');
INSERT INTO `migrations` VALUES ('13', '2026_03_14_000003_add_reset_token_to_admins', '3');
INSERT INTO `migrations` VALUES ('14', '2026_03_14_000004_create_media_table', '4');
INSERT INTO `migrations` VALUES ('15', '2026_03_14_000005_create_settings_table', '5');
INSERT INTO `migrations` VALUES ('16', '2026_03_14_000006_add_fields_to_candidatures', '5');
INSERT INTO `migrations` VALUES ('17', '2026_03_18_174017_add_email_to_partenaires_table', '6');

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE `newsletters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 1,
  `token` varchar(255) DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `newsletters_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `newsletters` VALUES ('1', 'alokpajuliettejuju@gmail.com', NULL, '1', 'KzhRr6UcfhEF2Q7gJzn11fpZMMbgX3DzrZXq3Eph', '2026-03-11 14:37:03', '2026-03-11 14:37:03', '2026-03-11 14:37:03');

DROP TABLE IF EXISTS `partenaires`;
CREATE TABLE `partenaires` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `responsable` varchar(255) NOT NULL,
  `entreprise` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `type` enum('financier','technique','sponsor') NOT NULL,
  `pack` varchar(255) DEFAULT NULL,
  `type_apport` varchar(255) DEFAULT NULL,
  `niveau_sponsor` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` VALUES ('615Xosqofp2spW6NV8nj9Mb39O7xrwJvDoF9cxKA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZmVYM3lXQ3FkMmVWUzVCWE85b2x2M0xPZDJzRU1qSjJ3TFg4UDRyUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', '1773856998');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` VALUES ('1', 'site_name', 'DevAfrica Arena', 'general', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('2', 'site_slogan', 'Propulser l\'Afrique par le numérique', 'general', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('3', 'site_email', 'wilsoncodemosaic@gmail.com', 'general', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('4', 'site_phone', '+228 71 15 50 55', 'general', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('5', 'site_address', 'Lomé, Togo', 'general', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('6', 'cash_prize', '350 000', 'competition', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('7', 'max_candidats', '100', 'competition', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('8', 'nb_finalistes', '6', 'competition', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('9', 'nb_jours', '2', 'competition', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('10', 'facebook', '', 'social', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('11', 'linkedin', '', 'social', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('12', 'instagram', '', 'social', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('13', 'twitter', '', 'social', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('14', 'maintenance_mode', '0', 'system', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('15', 'maintenance_msg', 'Site en maintenance. Revenez bientôt !', 'system', '2026-03-14 17:33:55', '2026-03-14 17:33:55');
INSERT INTO `settings` VALUES ('16', 'newsletter_subject', 'Actualités DevAfrica Arena', 'newsletter', '2026-03-14 17:33:55', '2026-03-14 17:33:55');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


