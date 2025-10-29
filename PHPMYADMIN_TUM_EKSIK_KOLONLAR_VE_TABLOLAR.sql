-- ============================================
-- TÜM EKSİK KOLONLAR VE TABLOLAR
-- phpMyAdmin'de Çalıştırılacak SQL Komutları
-- ============================================
-- ÖNEMLİ: Bu komutları çalıştırmadan önce veritabanınızı yedekleyin!
-- cPanel → phpMyAdmin → Veritabanını seçin (xqxevaho_home54) → SQL sekmesi
-- ============================================

-- ============================================
-- 1. ENERGY_COLLECTIONS TABLOSUNU OLUŞTUR
-- ============================================
CREATE TABLE IF NOT EXISTS `energy_collections` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `color_code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `energy_collections_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. TRANSLATIONS TABLOSUNU OLUŞTUR
-- ============================================
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

-- ============================================
-- 3. CATEGORIES TABLOSUNA EKSİK KOLON EKLE
-- ============================================
-- sort_order kolonunu ekle (eğer yoksa)
-- Hata: "Duplicate column name 'sort_order'" - zaten var, atlayın
ALTER TABLE `categories` 
ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_active`;

-- ============================================
-- 4. PRODUCTS TABLOSUNA EKSİK KOLONLARI EKLE
-- ============================================
-- sort_order kolonunu ekle (eğer yoksa)
ALTER TABLE `products` 
ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_featured`;

-- view_count kolonunu ekle (eğer yoksa)
ALTER TABLE `products` 
ADD COLUMN `view_count` BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER `is_active`;

-- rating kolonunu ekle (eğer yoksa)
ALTER TABLE `products` 
ADD COLUMN `rating` DECIMAL(3,2) NOT NULL DEFAULT 0.00 AFTER `view_count`;

-- rating_count kolonunu ekle (eğer yoksa)
ALTER TABLE `products` 
ADD COLUMN `rating_count` BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER `rating`;

-- ============================================
-- KONTROL: Kolonları Doğrula
-- ============================================
DESCRIBE `categories`;
DESCRIBE `products`;
DESCRIBE `energy_collections`;
DESCRIBE `translations`;

-- ============================================
-- NOT: Hata Alırsanız
-- ============================================
-- "Duplicate column name" hatası = Kolon zaten var, atlayın
-- "Table already exists" hatası = Tablo zaten var, atlayın
-- ============================================

