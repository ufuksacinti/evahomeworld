# Site Test Checklist

## ✅ Build Assets Testi - TAMAM!
Manifest dosyası başarıyla yüklendi:
- `manifest.json` ✅
- `app.css` ✅
- `app.js` ✅

## 🧪 Şimdi Yapılacak Testler

### 1. Ana Sayfa Testi
```
http://evahomeworld.com
```
**Beklenen:** Site açılmalı, 500 hatası OLMAMALI

### 2. CSS/JS Yükleme Testi
Tarayıcıda F12 → Network sekmesi → Sayfayı yenileyin

**Kontrol edin:**
- `app-BEWoWtpm.css` yükleniyor mu?
- `app-CXDpL9bK.js` yükleniyor mu?
- Status: 200 OK?

### 3. Laravel Log Kontrol
Eğer hala sorun varsa:
```
http://evahomeworld.com/public/test_laravel.php
```
veya
```
http://evahomeworld.com/public/debug.php
```

## 🎯 Beklenen Sonuçlar

### ✅ Başarılı Deploy
- Ana sayfa açılıyor
- CSS stilleri görünüyor
- JavaScript çalışıyor
- 500 hatası yok

### ❌ Sorun Varsa
- Debug script'leri çalıştırın
- Laravel log'una bakın
- Bana hata mesajını gönderin

## 📊 Manifest Açıklaması

Gönderdiğiniz manifest'te:
```json
{
  "resources/css/app.css": {
    "file": "assets/app-BEWoWtpm.css",  ← CSS dosyası
    ...
  },
  "resources/js/app.js": {
    "file": "assets/app-CXDpL9bK.js",   ← JS dosyası
    ...
  }
}
```

Bu dosyalar sunucuda olmalı:
- `/public/build/assets/app-BEWoWtpm.css`
- `/public/build/assets/app-CXDpL9bK.js`

## 🔍 Sonraki Adımlar

1. **Ana siteyi açın:** http://evahomeworld.com
2. **Görünüm kontrol edin:** Sayfa düzgün görünüyor mu?
3. **F12 → Console:** Hata var mı?
4. **Sonucu bildirin:** Çalışıyor mu, hata alıyor musunuz?
