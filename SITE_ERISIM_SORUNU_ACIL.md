# 🚨 ACİL: Site Erişim Sorunu - Sayfa Ulaşılamıyor

## ❌ Sorun
Hem `test-php.php` hem de `check-db.php` sayfalarına ulaşılamıyor.

## ✅ ACİL ADIMLAR

### ADIM 1: Dosyalar Sunucuda Var mı?

**cPanel File Manager ile kontrol edin:**

1. cPanel → **File Manager**
2. `public_html` klasörüne gidin就可以
3. `public` klasörünü açın
4. Şu dosyalar var mı kontrol edin:
   - ✅ `info.php`
   - ✅ `test-php.php`
   - ✅ `check-db.php`
   - ✅ `index.php`

**Eğer bu dosyalar YOKSA:**
→ GitHub'dan pull yapmanız gerekiyor!

---

### ADIM 2: Basit PHP Dosyası Oluşturun

**File Manager'da manuel oluşturun:**

1. File Manager → `public_html/public/` klasörüne gidin
2. **+ File** butonuna tıklayın
3. Dosya adı: `info.php`
4. İçeriği yapıştırın:
   ```php
   <?php
   phpinfo();
   ?>
   ```
5. **Save** butonuna tıklayın

**Sonra tarayıcıda açın:**
```
https://evahomeworld.com/info.php
```

**Eğer çalışıyorsa:** PHP çalışıyor, sorun Laravel.

**Eğer çalışmıyorsa:** .htaccess veya sunucu yapılandırması sorunu.

---

### ADIM 3: Document Root Kontrolü

**cPanel'de:**

1. **Domains** → **evahomeworld.com** → **Manage**
2. **Document Root** değerini kontrol edin

**İki seçenek var:**

#### SEÇENEK A: Document Root = `public_html`
→ O zaman dosyalara şu şekilde erişin:
```
https://evahomeworld.com/public/info.php
https://evahomeworld.com/public/check-db.php
```

#### SEÇENEK B: Document Root = `public_html/public`
→ O zaman dosyalara şu şekilde erişin:
```
https://evahomeworld.com/info.php
https://evahomeworld.com/check-db.php
```

---

### ADIM 4: .htaccess'i Geçici Devre Dışı Bırak

**Eğer hala çalışmıyorsa:**

1. File Manager → `public_html/.htaccess` dosyasını bulun
2. Sağ tık → **Rename**
3. Yeni isim: `.htaccess.backup`
4. **Kaydet**

**Sonra tekrar deneyin:**
```
https://evahomeworld.com/public/info.php
```

**Eğer çalışıyorsa:** .htaccess rewrite kuralı sorunu var.

---

### ADIM 5: index.php Kontrolü

**File Manager'da:**

1. `public_html/public/index.php` dosyası var mı?
2. İçeriğini kontrol edin (Laravel standart index.php olmalı)

---

### ADIM 6: Alternatif Erişim Yolları

**Farklı URL'leri deneyin:**

```
https://evahomeworld.com/public/info.php
https://evahomeworld.com/public/test-php.php
https://evahomeworld.com/public/check-db.php
https://www.evahomeworld.com/info.php
http://evahomeworld.com/info.php (SSL olmadan)
```

---

### ADIM 7: cPanel Error Log Kontrolü

**cPanel'de:**

1. **Metrics** → **Errors**
2. **Son hataları** kontrol edin
3. **Apache Errors** sekmesine bakın

**VEYA**

File Manager → `public_html/public/error_log` dosyasını açın

---

### ADIM 8: PHP Handler Kontrolü

**cPanel'de:**

1. **Select PHP Version**
2. PHP Version: **8.3** seçili olmalı
3. **Set as current** butonuna tıklayın

---

### ADIM 9: Dosya İzinleri Kontrolü

**File Manager'da:**

1. `public_html/public/` klasörüne sağ tık
2. **Change Permissions**
3. Değerler:
   - **Folders:** 755
   - **Files:** 644
   - **Recurse into subdirectories:** ✅ işaretle
4. **Change Permissions** butonuna tıkla

---

## 🔍 TEŞHİS须

**Test sonuçlarını kontrol edin:**

| Test | URL | Sonuç | Anlamı |
|------|-----|-------|--------|
| 1 | `https://evahomeworld.com/` | ❌ 404 | Document root yanlış |
| 2 | `https://evahomeworld.com/public/` | ❌ 403 | İzin sorunu |
| 3 | `https://evahomeworld.com/public/info.php` | ❌ 404 | Dosya yok veya yol yanlış |
| 4 | `https://evahomeworld.com/info.php` | ✅ Çalışıyor | Document root = public_html/public |

---

## 💡 EN OLASIL ÇÖZÜM

**Durum:** Dosyalara ulaşılamıyor

**Muhtemel sebep:** Document root `public_html` olarak ayarlanmış ama dosyalar `public_html/public/` içinde.

**ÇÖZÜM 1:**
Dosyalara şu şekilde erişin:
```
https://evahomeworld.com/public/info.php
```

**ÇÖZÜM 2:**
cPanel → Domains → Document Root'u `public_html/public` olarak değiştirin.

---

## 🆘 HIZLI TEST

**File Manager'da:**

1. `public_html/info2.php` dosyası oluşturun (public klasörü DIŞINDA)
2. İçeriği: `<?php phpinfo(); ?>`
3. Tarayıcıda: `https://evahomeworld.com/info2.php`

**Eğer çalışıyorsa:**
→ Document root `public_html` ve dosyalar `public/` içinde.

**Eğer çalışmıyorsa:**
→ Daha ciddi bir sunucu yapılandırma sorunu var.

---

## 📞 BİZE GÖNDERİN

Lütfen şu bilgileri paylaşın:

1. ✅ Document Root değeri nedir? (`public_html` mi `public_html/public` mi?)
2. ✅ `public_html/public/info.php` dosyası var mı?
3. ✅ `https://evahomeworld.com/public/info.php` çalışıyor mu?
4. ✅ cPanel Error Log'da ne yazıyor?
5. ✅ `public_html/.htaccess` dosyası var mı?

Bu bilgilerle kesin çözümü bulabiliriz!

