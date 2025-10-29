-- CATEGORIES TABLOSUNA sort_order KOLONU EKLE
-- Bu komutu phpMyAdmin'de SQL sekmesinde çalıştırın

-- sort_order kolonunu ekle (eğer yoksa)
-- Hata: "Duplicate column name 'sort_order'" - zaten var, atlayın
ALTER TABLE `categories` 
ADD COLUMN `sort_order` INT NOT NULL DEFAULT 0 AFTER `is_active`;

-- Kontrol
DESCRIBE `categories`;

