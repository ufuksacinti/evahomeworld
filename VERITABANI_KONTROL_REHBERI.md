# Veritabanı Kontrol ve Düzeltme Rehberi

## 🔍 Durum Kontrolü

### Yöntem 1: Otomatik Kontrol Script'i (ÖNERİLEN)

1. **Script'i Çalıştırın:**
   ```
   https://evahomeworld.com/check-db.php
   ```
   
2. **Sonuçları İnceleyin:**
   - Script size hangi kolonların eksik olduğunu gösterecek
   - Gerekli SQL komutlarını otomatik oluşturacak

### Yöntem 2: phpMyAdmin'den Manuel Kontrol

1. phpMyAdmin'e giriş yapın
2. `xqxevaho_home54` veritabanını seçin
3. `products` tablosunu bulun
4. **"Yapı" (Structure)** sekmesine tıklayın
5. Şu kolonları arayın:
   - `rating` (decimal)
   - `view_count` (bigint unsigned)
   - `rating_count` (bigint unsigned)

---

## ⚠️ Eksik Kolonlar Varsa - Düzeltme

### Yöntem 1: SQL ile Manuel Ekleme (Hızlı)

phpMyAdmin'de **SQL** sekmesine gidin ve şu komutları çalıştırın:

```sql
-- view_count kolonunu ekle (eğer yoksa)
ALTER TABLE `products` 
ADD COLUMN `view_count` BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER `is_active`;

-- rating kolonunu ekle (eğer yoksa)
ALTER TABLE `products` 
ADD COLUMN `rating` DECIMAL(3,2) NOT NULL DEFAULT 0.00 AFTER `view_count`;

-- rating_count kolonunu ekle (eğer yoksa)
ALTER TABLE `products` 
ADD COLUMN `rating_count` BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER `rating`;
```

**Not:** Eğer `view_count` zaten varsa, `rating` kolonunu eklerken `AFTER view_count` kullanın.

### Yöntem 2: Migration Script'i ile

```
https://evahomeworld.com/db-migrate-only.php?password=EvaHome2024!Migrate
```

**Önemli:** Script'teki şifreyi önce değiştirin!

---

## 🚨 Siteye Ulaşılamama Sorunu

Eğer siteye hala ulaşılamıyorsa:

### 1. Log Dosyasını Kontrol Edin
`storage/logs/laravel.log` dosyasına bakın.

### 2. Apache/PHP Hata Loglarını Kontrol Edin
cPanel > Errors log

### 3. .env Dosyasını Kontrol Edin
Aşağıdaki ayarların doğru olduğundan emin olun:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://evahomeworld.com
```

### 4. Cache Temizleme
Eğer terminal erişiminiz varsa:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

---

## ✅ Kontrol Listesi

- [ ] `check-db.php` script'i çalıştırıldı
- [ ] Eksik kolonlar tespit edildi
- [ ] SQL komutları çalıştırıldı (veya migration script çalıştırıldı)
- [ ] `products` tablosunda `rating`, `view_count`, `rating_count` kolonları var
- [ ] Site erişilebilir durumda
- [ ] Ana sayfa hatasız yükleniyor

---

## 📞 Destek

Sorun devam ederse:
1. `storage/logs/laravel.log` dosyasını kontrol edin
2. Hata mesajını not edin
3. phpMyAdmin'de `products` tablosunun yapısını ekran görüntüsü alın

