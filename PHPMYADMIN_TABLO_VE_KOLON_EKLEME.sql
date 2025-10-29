-- ============================================
-- phpMyAdmin'de Çalıştırılacak SQL Komutları
-- Eksik Tablo ve Kolonları Ekle
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
-- 2. PRODUCTS TABLOSUNA EKSİK KOLONLARI EKLE
-- ============================================

-- sort_order kolonunu ekle (eğer yoksa)
-- Hata alırsanız: "Duplicate column name 'sort_order'" - zaten var, atlayın
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
-- 3. KOLONLARI KONTROL ET (Basit Yöntem)
-- ============================================

-- Products tablosunun yapısını göster
DESCRIBE `products`;

-- Energy_collections tablosunun yapısını göster
DESCRIBE `energy_collections`;

-- ============================================
-- 4. HATA ALIRSANIZ
-- ============================================
-- Eğer "Duplicate column name" hatası alırsanız, o kolon zaten var demektir.
-- O komutu atlayın ve diğerlerini çalıştırın.

-- Eğer "Table already exists" hatası alırsanız, tablo zaten var demektir.
-- O komutu atlayın.

-- ============================================
-- İŞLEM TAMAMLANDI!
-- ============================================
-- Artık site hatasız çalışmalı. Test edin:
-- https://evahomeworld.com
