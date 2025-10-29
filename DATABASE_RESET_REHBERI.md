# Veritabanı Reset ve Güncelleme Rehberi

Terminal erişimi olmadan sunucudaki veritabanını güncellemek için iki yöntem:

## 🚀 Yöntem 1: Web Script ile (ÖNERİLEN - Kolay)

### Adımlar:

1. **Dosyayı Hazırlayın:**
   - `public/db-reset.php` dosyasını GitHub'dan sunucuya yükleyin
   - Dosyanın içindeki `$SECURE_PASSWORD` değerini güçlü bir şifre ile değiştirin

2. **Script'i Çalıştırın:**
   - Tarayıcınızda şu adresi açın:
   ```
   https://evahomeworld.com/db-reset.php?password=GUVENLI_SIFRE
   ```
   - `GUVENLI_SIFRE` yerine dosyada belirlediğiniz şifreyi yazın

3. **Sonuçları Kontrol Edin:**
   - Script tüm adımları gösterecek:
     - ✅ Eski tablolar silinecek
     - ✅ Yeni tablolar oluşturulacak (migration)
     - ✅ Demo veriler yüklenecek (seed)

4. **Güvenlik - ÖNEMLİ:**
   - İşlem tamamlandıktan sonra mutlaka `public/db-reset.php` dosyasını silin!
   - FTP veya cPanel File Manager ile silebilirsiniz

---

## 🗄️ Yöntem 2: phpMyAdmin ile (Manuel)

Eğer script çalışmazsa veya daha kontrolü bir işlem istiyorsanız:

### Adım 1: phpMyAdmin'e Giriş
1. cPanel > phpMyAdmin
2. Veritabanınızı seçin: `xqxevaho_home54`

### Adım 2: Eski Tabloları Sil
1. Tüm tabloları seçin (En üstteki checkbox)
2. Açılır menüden "Drop" (Sil) seçin
3. Onaylayın

### Adım 3: Yeni Tabloları Oluştur
Bu kısım biraz karmaşık çünkü migration dosyalarını SQL'e çevirmeniz gerekiyor.

**En pratik yol:**
1. Local'de (kendi bilgisayarınızda) projeyi çalıştırın
2. `.env` dosyasını sunucudaki bilgilerle güncelleyin
3. Şu komutu çalıştırın:
   ```bash
   php artisan migrate:status
   php artisan migrate --pretend
   ```
4. Veya local'de SQL export alın:
   ```bash
   php artisan migrate:refresh --seed
   ```
   Sonra local veritabanınızdan SQL export alıp phpMyAdmin'e import edin

---

## ⚙️ Alternatif: cPanel Cron Job ile Artisan Komutları

cPanel'in Terminal erişimi varsa (bazı hosting'lerde vardır):

1. cPanel > Advanced > Terminal (veya SSH Access)
2. Aşağıdaki komutları çalıştırın:

```bash
cd ~/public_html  # veya projenizin bulunduğu klasör
php artisan migrate:fresh --seed --force
```

---

## 📋 Kontrol Listesi

- [ ] `public/db-reset.php` dosyası sunucuya yüklendi
- [ ] Script'teki şifre değiştirildi
- [ ] `.env` dosyası güncel ve doğru (veritabanı bilgileri)
- [ ] Script tarayıcıdan çalıştırıldı
- [ ] İşlem başarıyla tamamlandı
- [ ] **GÜVENLİK:** `db-reset.php` dosyası silindi

---

## 🆘 Sorun Giderme

### Hata: "Class not found" veya "Autoload error"
- `vendor/` klasörünün sunucuda olup olmadığını kontrol edin
- Composer install yapılmış olmalı

### Hata: "Connection refused" veya Veritabanı hatası
- `.env` dosyasındaki veritabanı bilgilerini kontrol edin
- cPanel'den veritabanı kullanıcısının yetkilerini kontrol edin

### Migration hatası
- `storage/logs/laravel.log` dosyasına bakın
- Hata detaylarını kontrol edin

---

## 📝 Mevcut .env Bilgileri (Sunucu)

```
DB_DATABASE=xqxevaho_home54
DB_USERNAME=xqxevaho_evahome
DB_PASSWORD=B)G18T$1S+yg
DB_HOST=localhost
```

Bu bilgiler `.env` dosyasında zaten mevcut, sadece yeni migration'ları çalıştırmanız yeterli.

---

**ÖNEMLİ NOT:** Bu işlem **TÜM VERİLERİ SİLEREK** veritabanını sıfırdan oluşturur. Canlı veri varsa önce yedek alın!

