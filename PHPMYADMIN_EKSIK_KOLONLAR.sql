-- ============================================
-- phpMyAdmin'de Çalıştırılacak SQL Komutları
-- Eksik Kolonları Ekle
-- ============================================
-- ÖNEMLİ: Bu komutları çalıştırmadan önce veritabanınızı yedekleyin!
-- cPanel → phpMyAdmin → Veritabanını seçin (xqxevaho_home54) → SQL sekmesi
-- ============================================

-- ============================================
-- ÖNCE: Mevcut Kolonları Kontrol Edin
-- ============================================
-- Bu sorguyu çalıştırarak products tablosundaki mevcut kolonları görebilirsiniz:

SELECT COLUMN_NAME, DATA_TYPE, COLUMN_DEFAULT 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE()
AND TABLE_NAME = 'products' 
ORDER BY ORDINAL_POSITION;

-- ============================================
-- 1. PRODUCTS TABLOSU EKSİK KOLONLAR
-- ============================================

-- sort_order kolonunu ekle (is_featured'dan sonra)
-- Eğer "Duplicate column name" hatası alırsanız, bu kolon zaten var demektir, atlayın.
ALTER TABLE `products` 
ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_featured`;

-- view_count kolonunu ekle (is_active'dan sonra)
ALTER TABLE `products` 
ADD COLUMN `view_count` BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER `is_active`;

-- rating kolonunu ekle (view_count'tan sonra)
ALTER TABLE `products` 
ADD COLUMN `rating` DECIMAL(3,2) NOT NULL DEFAULT 0.00 AFTER `view_count`;

-- rating_count kolonunu ekle (rating'den sonra)
ALTER TABLE `products` 
ADD COLUMN `rating_count` BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER `rating`;

-- ============================================
-- 2. ENERGY_COLLECTIONS TABLOSU EKSİK KOLON
-- ============================================

-- sort_order kolonunu ekle (is_active'dan sonra)
ALTER TABLE `energy_collections` 
ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_active`;

-- ============================================
-- KONTROL: Kolonlar Başarıyla Eklendi mi?
-- ============================================

-- Products tablosundaki tüm kolonları listele
SELECT COLUMN_NAME, DATA_TYPE, COLUMN_DEFAULT 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE()
AND TABLE_NAME = 'products' 
AND COLUMN_NAME IN ('sort_order', 'rating', 'view_count', 'rating_count')
ORDER BY ORDINAL_POSITION;

-- Energy_collections tablosundaki sort_order kolonunu kontrol et
SELECT COLUMN_NAME, DATA_TYPE, COLUMN_DEFAULT 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE()
AND TABLE_NAME = 'energy_collections' 
AND COLUMN_NAME = 'sort_order';

-- ============================================
-- NOT: Hata Alırsanız
-- ============================================
-- Eğer "Duplicate column name" hatası alırsanız, o kolon zaten mevcut demektir.
-- O komutu atlayın ve diğerlerini çalıştırın.

-- ============================================
-- İŞLEM TAMAMLANDI!
-- ============================================
-- Artık site hatasız çalışmalı. Test edin:
-- https://evahomeworld.com
