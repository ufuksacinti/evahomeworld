# 🔧 MultiPHP INI Editor - 500 Hatası Çözümü

## 📍 Konum
cPanel → **MultiPHP INI Editor**

## ✅ ADIM ADIM ÇÖZÜM

### ADIM 1: display_errors Açın

MultiPHP INI Editor'da şu satırı bulun:
```ini
display_errors = Off
```

Şu şekilde değiştirin:
```ini
display_errors = On
```

**NOT:** Bu, hataları görmenizi sağlar. Sorun çözüldükten sonra tekrar `Off` yapın.

### ADIM 2: Memory Limit Artırın

Şu satırı bulun:
```ini
memory_limit = 128M
```

Şu şekilde değiştirin:
```ini
memory_limit = 256M
```

### ADIM 3: max_execution_time Artırın

Şu satırı bulun:
```ini
max_execution_time = 30
```

Şu şekilde değiştirin:
```ini
max_execution_time = 60
```

### ADIM 4: Save Butonuna Tıklayın

Sayfanın sağ üstünde mavi **Save** butonuna tıklayın.

---

## 🧪 TEST ET

Tarayıcıda tekrar deneyin:
- http://evahomeworld.com

**Eğer hata mesajı görürseniz**, artık gerçek hatayı göreceksiniz!

---

## 📝 ÖRNEK PHP.INI AYARLARI (Laravel için)

```ini
display_errors = On
error_reporting = E_ALL
memory_limit = 256M
max_execution_time = 60
max_input_vars = 10000
post_max_size = 16M
upload_max_filesize = 16M
allow_url_fopen = On
```

---

## ❌ GÜVENLİK UYARISI

Production'da **MUTLAKA** şunları kapatın:
```ini
display_errors = Off
```

---

**Test edin ve hatayı görün! 🔍**
