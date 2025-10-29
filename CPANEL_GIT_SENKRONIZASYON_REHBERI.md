# 📡 cPanel Git Versiyon Kontrol - Sunucu Eşitleme Rehberi

## 🎯 Amaç
Local'deki (bilgisayarınızdaki) kod ile sunucudaki kodu tam olarak eşitlemek.

---

## 🔄 Yöntem 1: cPanel Git Version Control ile (ÖNERİLEN)

### Adım 1: cPanel'e Giriş
1. cPanel'e giriş yapın
2. **Files** bölümünde **Git Version Control** menüsünü bulun

### Adım 2: Repository Ayarları
1. **Git Version Control** sekmesine tıklayın
2. Repository URL: `https://github.com/ufuksacinti/evahomeworld.git`
3. Repository Branch: `ufuk`
4. Repository Path: `public_html` (veya projenizin bulunduğu klasör)

### Adım 3: Pull İşlemi
1. **Pull or Deploy** butonuna tıklayın
2. veya **Update from Remote** butonuna tıklayın
3. İşlem tamamlanana kadar bekleyin

---

## 🔧 Yöntem 2: Terminal ile (SSH Erişimi Varsa)

### Sunucuda Tirmin aldığınızda:

```bash
# 1. Proje klasörüne gidin
cd ~/public_html

# 2. Remote repository'yi kontrol edin
git remote -v

# 3. Remote'tan en son değişiklikleri çekin
git fetch origin

# 4. Ufuk branch'ine geçin (eğer değilseniz)
git checkout ufuk

# 5. Pull yapın (merge ile)
git pull origin ufuk

# Senegal VEYA force pull (local değişiklikleri göz ardı et)
git reset --hard origin/ufuk
```

---

## 🚨 Sorun Giderme

### Sorun 1: "Your local changes would be overwritten"

**Çözüm:**
```bash
# Yerel değişiklikleri stash'le (geçici kaydet)
git stash

# Pull yap
git pull origin ufuk

# Stash'lenen değişiklikleri geri getir (istenirse)
git stash pop
```

**VEYA local değişiklikleri silip remote ile eşitle:**
```bash
git reset --hard origin/ufuk
git clean -fd
```

### Sorun 2: "Conflict" hatası

**Çözüm:**
```bash
# Remote'u tamamen local ile değiştir
git fetch origin
git reset --hard origin/ufuk
```

### Sorun 3: Sunucudaki dosyal değişti, Git pull çalışmıyor

**Çözüm:**
```bash
# Tüm local değişiklikleri sil ve remote ile eşitle
cd ~/public_html
git fetch origin
git reset --hard origin/ufuk
git clean -fd
```

---

## 🔄 Yöntem 3: Otomatik Pull Script (Web Üzerinden)

Sunucuya bir PHP script'i oluşturun ki tarayıcıdan pull yapabilesiniz:

```php
<?php
// public_html/git-pull.php
$SECURE_PASSWORD = 'GUVENLI_SIFRE'; // Değiştirin!

if (!isset($_GET['password']) || $_GET['password'] !== $SECURE_PASSWORD) {
    die('Unauthorized');
}

$output = [];
$return_var = 0;

chdir(__DIR__);

// Git pull
exec('git fetch origin 2>&1', $output, $return_var);
exec('git reset --hard origin/ufuk 2>&1', $output, $return_var);
exec('git clean -fd 2>&1', $output, $return_var);

header('Content-Type: text/html; charset=utf-8');
echo '<h1>Git Pull Sonucu</h1>';
echo '<pre>';
echo implode("\n", $output);
echo '</pre>';
?>
```

Kullanım: `https://evahomeworld.com/git-pull.php?password=GUVENLI_SIFRE`

---

## ✅ Adım Adım Senkronizasyon Süreci

### 1. Local'de Değişiklik Yapın
```bash
# Local'de kodunuzu düzenleyin
# ...
```

### 2. Local'de Commit ve Push Yapın
```bash
git add -A
git commit -m "Değişiklik açıklaması"
git push origin ufuk
```

### 3. Sunucuda Pull Yapın

**cPanel'den:**
- Git Version Control → Pull or Deploy

**VEYA Terminal'den:**
```bash
cd ~/public_html
git pull origin ufuk
```

---

## 🎯 Tam Eşitleme İçin Komutlar

### Sunucuda (SSH veya Terminal ile):

```bash
# 1. Proje klasörüne git
cd ~/public_html

# 2. Remote'taki en son durumu al
git fetch origin

# 3. Local branch'i remote ile tam olarak eşitle
git reset --hard origin/ufuk

# 4. Takip edilmeyen dosyaları temizle (isteğe bağlı)
git clean -fd

# 5. Durumu kontrol et
git status
git log --oneline -5
```

---

## ⚠️ ÖNEMLİ NOTLAR

1. **`git reset --hard`** kullanmak tüm local değişiklikleri siler!
2. **Önce yedek alın** - Sunucudaki önemli dosyaları yedekleyin
3. **.env dosyası** - Git pull `.env` dosyasını silmez (genelde gitignore'da)
4. **vendor klasörü** - Composer install yapmanız gerekebilir

---

## 🔐 Güvenlik

- Git pull script'inde mutlaka şifre koruması kullanın
- Script'i kullanımdan sonra silin
- `.env` dosyasını Git'e commit etmeyin

---

## 📋 Kontrol Listesi

- [ ] Local'de commit ve push yapıldı
- [ ] cPanel Git Version Control ayarları doğru
- [ ] Pull işlemi başarıyla tamamlandı
- [ ] Sunucuda dosyalar güncellendi
- [ ] `.env` dosyası korundu
- [ ] `vendor/` klasörü var mı kontrol edildi
- [ ] Site çalışıyor mu test edildi

---

## 🔄 Hızlı Senkronizasyon Komutu

Sunucuda tek komutla eşitleme:

```bash
cd ~/public_html && git fetch origin && git reset --hard origin/ufuk && git clean -fd
```

---

## 🆘 Yaygın Hatalar ve Çözümleri

### Hata: "Permission denied"
```bash
# Dosya izinlerini düzelt
chmod -R 755 ~/public_html
chmod -R 775 ~/public_html/storage
chmod -R 775 ~/public_html/bootstrap/cache
```

### Hata: "Not a git repository"
```bash
# Git repository'yi yeniden başlat
cd ~/public_html
git init
git remote add origin https://github.com/ufuksacinti/evahomeworld.git
git fetch origin
git checkout -b ufuk origin/ufuk
```

### Hata: ".env dosyası silindi"
```bash
# .env'i yeniden oluştur (eğer silindiyse)
# cPanel File Manager'dan veya SSH'dan
```

