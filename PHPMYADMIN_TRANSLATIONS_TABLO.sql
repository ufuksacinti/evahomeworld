-- TRANSLATIONS TABLOSUNU OLUŞTUR
-- Bu komutu phpMyAdmin'de SQL sekmesinde çalıştırın

CREATE TABLE IF NOT EXISTS `translations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `tr` text DEFAULT NULL,
  `en` text DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_key_unique` (`key`),
  KEY `translations_key_index` (`key`),
  KEY `translations_group_index` (`group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

