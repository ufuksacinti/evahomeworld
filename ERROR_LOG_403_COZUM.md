# 🔥 ERROR LOG 403 HATASI ÇÖZÜMÜ

## 🚨 SORUN
`error_log` dosyasına tarayıcıdan erişilmiyor (403).

## ✅ ÇÖZÜM YOLLARI

---

## 🔧 YOL 1: cPanel Terminal (ÖNERİLEN)

cPanel → **Terminal**:

```bash
cd ~/public_html

# Error log son 50 satırı göster
tail -50 public/error_log

# VEYA

# Error log son 100 satırı göster
tail -100 public/error_log

# VEYA

# Error log'un tamamını göster
cat public/error_log
```

---

## 🔧 YOL 2: File Manager'dan Oku

cPanel → **File Manager**:

1. `public_html/public/` klasörüne gidin
2. `error_log` dosyasını bulun
3. Sağ tık → **View** veya **Edit**
4. En son satırları okuyun

---

## 🔧 YOL 3: Error Log İzinlerini Değiştir

cPanel → **Terminal**:

```bash
cd ~/public_html

# Error log izinlerini değiştir
chmod 644 public/error_log

# Tekrar kontrol et
tail -20 public/error_log
```

---

## 🔧 YOL 4: Laravel Log Dosyası

Laravel kendi log dosyasını kullanıyor olabilir:

```bash
cd ~/public_html

# Laravel log dosyasını kontrol et
tail -100 storage/logs/laravel.log
```

---

## 🧪 HIZLI TEST

Terminal'de bu komutu çalıştırın:

```bash
cd ~/public_html
tail -50 public/error_log
```

**Çıktıyı buraya kopyalayın!**

---

## 📋 ALTERNATİF: Laravel Artisan Test

Terminal'de:

```bash
cd ~/public_html

# Laravel artisan test
php83 artisan --version

# Eğer hata verirse, hatayı görürsünüz
```

---

## 🎯 EN HIZLI YOL

cPanel → **Terminal** → Şu komutu yapıştırın:

```bash
cd ~/public_html && tail -50 public/error_log
```

**Çıktıyı buraya yapıştırın!**

---

**Terminal'den error log'u okuyun ve sonuçları paylaşın!** 🔍
