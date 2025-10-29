# 🔧 .env Dosyası Güncelleme

## ADIM 1: File Manager'dan .env Dosyasını Aç

cPanel → File Manager → `public_html/.env` dosyasını açın.

## ADIM 2: Şu Satırı Güncelleyin

**Eski:**
```env
DB_PASSWORD=]3Zhem*
```

**Yeni:**
```env
DB_PASSWORD=B{-xw2vR0QiM
```

## ADIM 3: Kaydedin ve Test Edin

1. Dosyayı kaydedin
2. Tarayıcıda şu adresi açın:
   ```
   http://evahomeworld.com/public/test_db.php
   ```

**Şimdi bağlantı başarılı olmalı!**

---

## Eğer Hala Sorun Varsa

### Kontrol Listesi:
- ✅ `DB_DATABASE=xqxevaho_homedb`
- ✅ `DB_USERNAME=xqxevaho_ufuk38`
- ✅ `DB_PASSWORD=B{-xw2vR0QiM`
- ✅ `DB_HOST=localhost`
- ✅ `DB_CONNECTION=mysql`

---

## Test Sonrası

Database bağlantısı başarılı olursa, ana siteyi test edin:
```
http://evahomeworld.com
```

Eğer hala 500 hatası alıyorsanız, migration'ları çalıştırmanız gerekebilir.
