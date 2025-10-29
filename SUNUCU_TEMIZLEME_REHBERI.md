# 🧹 Sunucu Temizleme ve Senkronizasyon Rehberi

## 📋 Problem
Sunucudaki eski kodlar ile GitHub'taki yeni kodlar çakışıyor ve senkronizasyon sorunları yaşanıyor.

## ✅ Çözüm

### Yöntem 1: Gelişmiş Git Pull Script (ÖNERİLEN)

Güncellenmiş `git-pull.php` script'i artık daha agresif temizleme yapıyor:

1. **Local değişiklikleri stash eder**
2. **Doğru branch'e geçer** (ufuk)
3. **Tüm değişiklikleri fetch eder**
4. **Hard reset yapar** (GitHub ile tam eşitleme)
5. **Untracked dosyaları siler** (git clean -fdx)
6. **Gereksiz script dosyalarını temizler**

---

## 🚀 Kullanım Adımları

### Adım 1: Script'i GitHub'a Push Edin

Local'de değişiklikleri commit ve push edin:

```bash
git add public/git-pull.php
git commit -m "Git pull script'i agresif temizleme ile güncellendi"
git push origin ufuk
```

### Adım 2: Sunucuda Script'i Çalıştırın

Tarayı广为da şu URL'yi açın:

```
https://evahomeworld.com/git-pull.php?password=EvaHome2024Pull
```

**Bu script şunları yapacak:**

✅ Local değişiklikleri stash eder  
✅ `ufuk` branch'ine geçer  
✅ GitHub'tan tüm değişiklikleri çeker  
✅ Sunucuyu GitHub ile tam eşitler (hard reset)  
✅ Untracked dosyaları temizler  
✅ Gereksiz script dosyalarını siler  

### Adım 3: Sonraki İşlemler

Script çalıştıktan sonra terminal veya cPanel Terminal ile:

```bash
cd ~/public_html

# 1. Composer bağımlılıklarını yükle
composer install --no-dev --optimize-autoloader

# 2. Cache temizle
php artisan optimize:clear

# 3. Assets build (eğer npm kuruluysa)
npm install
npm run build

# 4. Config cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## ⚠️ ÖNEMLİ GÜVENLİK NOTLARI

### Korunan Dosyalar (.gitignore'da)

Script şu dosyaları **SİLMEZ** (güvenli):

- ✅ `.env` - Veritabanı ayarları korunur
- ✅ `vendor/` - Composer paketleri korunur
- ✅ `node_modules/` - NPM paketleri korunur
- ✅ `storage/` - Log ve cache dosyaları korunur
- ✅ `public/build/` - Vite build dosyaları (yeniden build edilmeli)

### Silinen Dosyalar

Script şu dosyaları temizler:

- ❌ Untracked dosyalar (Git tarafından takip edilmeyen)
- ❌ Local değişiklikler (stash'lenir)
- ❌ Eski script dosyaları (`check-db.php`, `test-php.php`, `info.php`)

---

## 🔍 Çakışma Çözümü

### Problem 1: "Your local changes would be overwritten"

**Çözüm:** Script otomatik olarak `git stash` yapıyor, bu sorunu çözer.

### Problem 2: "Branch mismatch"

**Çözüm:** Script otomatik olarak `ufuk` branch'ine geçiyor.

### Problem 3: "Untracked files"

**Çözüm:** Script `git clean -fdx` ile tüm untracked dosyaları siliyor.

### Problem 4: Eski dosyalar hala görünüyor

**Çözüm:** Script'in "Ek Temizlik İşlemleri" bölümü gereksiz dosyaları siler.

---

## 📊 Script Çıktısı

Script çalıştığında şunları göreceksiniz:

1. ✅ Mevcut durum
2. ✅ Local değişiklikleri stash
3. ✅ Remote bilgisi
4. ✅ Branch kontrolü
5. ✅ Fetch işlemi
6. ✅ Hard reset
7. ✅ Clean işlemi
8. ✅ Untracked dosyalar listesi
9. ✅ Son durum
10. ✅ Son commit'ler

---

## 🔄 Alternatif: Manuel Temizleme

Eğer script çalışmazsa, cPanel Terminal ile:

```bash
cd ~/public_html

# 1. Local değişiklikleri sakla
git stash

# 2. Branch kontrolü
git checkout ufuk

# 3. GitHub'tan çek
git fetch origin --prune

# 4. Hard reset
git reset --hard origin/ufuk

# 5. Temizlik
git clean -fdx

# 6. Durum kontrolü
git status
```

---

## 🎯 Başarı Kontrolü

Senkronizasyon başarılı olmuşsa:

```bash
git status
```

Çıktı şöyle olmalı:

```
On branch ufuk
Your branch is up to date with 'origin/ufuk'.
nothing to commit, working tree clean
```

---

## 🆘 Sorun Giderme

### Script "Unauthorized" hatası veriyor

✅ Doğru şifreyi kullandığınızdan emin olun: `EvaHome2024Pull`

### Git repository bulunamıyor

✅ cPanel Git Version Control'den repository'nin doğru dizine kurulduğundan emin olun.

### .env dosyası silindi

❌ Bu olmamalı! `.env` dosyası `.gitignore`'da olduğu için korunmalı.  
✅ Eğer silindi ise, cPanel File Manager'dan `.env` dosyasını yeniden oluşturun.

### Vendor klasörü silindi

❌ Bu normal! `vendor/` `.gitignore`'da olduğu için silinir.  
✅ Script'ten sonra `composer install` çalıştırmanız gerekir.

---

## 📝 Özet

1. ✅ `git-pull.php` script'i GitHub'a push edildi
2. ✅ Script'te agresif temizleme özelliği eklendi
3. ✅ Script şifre ile korumalı: `EvaHome2024Pull`
4. ✅ Güvenli dosyalar korunuyor (.env, vendor, etc.)
5. ✅ Gere Stage dosyalar temizleniyor

**Sonraki Adım:** Script'i sunucuda çalıştırın ve sonuçları kontrol edin!

