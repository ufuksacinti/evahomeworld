# PHP Version Sorunu - Nihai Çözüm

## Sorun
PHP versiyonu tekrar 7.4.33'e düştü ve şu hatayı alıyorsunuz:
```
Your Composer dependencies require a PHP version ">= 8.2.0". You are running 7.4.33.
```

## Çözüm: Üç Katmanlı Koruma

### 1. cPanel'de PHP Ayarları

**Adım 1: cPanel → Select PHP Version**
1. cPanel'e giriş yapın
2. **Select PHP Version** bölümüne gidin
3. **PHP Version** dropdown'dan **ea-php83** seçin
4. **Set as current** butonuna basın

**Adım 2: MultiPHP INI Editor**
1. cPanel → **MultiPHP INI Editor**
2. **Manage** → `public_html` seçin
3. **php_value display_errors** → `Off` olarak ayarlayın
4. **Apply** butonuna basın

### 2. Dosya Bazlı Ayarlar (GitHub'a Push Edildi)

İki dosya eklendi/güncellendi:

#### `.user.ini`
```ini
php_version=83
max_execution_time=300
upload_max_filesize=256M
post_max_size=256M
memory_limit=512M
```

#### `.htaccess`
```apache
# PHP 8.3 Handler - FORCE
AddHandler application/x-httpd-ea-php83 .php
php_value display_errors 0
```

### 3. Sunucuda Yapılacaklar

**Git Pull:**
1. cPanel → **Git Version Control**
2. **Pull or Deploy** butonuna basın
3. Commit: `34ab736`

**Dosya İzinleri:**
```bash
chmod 644 public_html/.user.ini
chmod 644 public_html/.htaccess
```

## Test

### 1. PHP Info Kontrolü
```
http://evahomeworld.com/public/phpinfo.php
```

Bu dosya yoksa oluşturun:
```php
<?php
echo "PHP Version: " . PHP_VERSION;
phpinfo();
?>
```

**Beklenen:** PHP 8.3.x görünmeli

### 2. Ana Site Testi
```
http://evahomeworld.com
```

**Beklenen:** 500 hatası OLMAMALI

## Sorun Devam Ederse

### Kontrol Listesi

1. **cPanel → Select PHP Version**
   - `ea-php83` seçili mi?
   - `Set as current` yapıldı mı?

2. **Dosyalar:**
   - `.user.ini` var mı? (public_html klasöründe)
   - `.htaccess` var mı? (public_html klasöründe)
   - İçerik doğru mu?

3. **Git Pull:**
   - Son commit çekildi mi?
   - Dosyalar güncel mi?

4. **Sunucu Restart:**
   - Cpanel'de **Apache Restart** yapılabilir
   - Hosting firmanıza restart isteyin

### Manuel PHP Kontrolü

Sunucuda bir PHP dosyası oluşturun (`test_php.php`):
```php
<?php
header('Content-Type: text/plain');
echo "PHP Version: " . PHP_VERSION . "\n";
echo "PHP SAPI: " . php_sapi_name() . "\n";
echo "Loaded PHP: " . PHP_BINARY . "\n";
?>
```

Erişin: `http://evahomeworld.com/public/test_php.php`

## Neden Tekrar Düştü?

Olası nedenler:
1. **cPanel Ayarı Değişti:** Hosting firmanız sıfırlamış olabilir
2. **Apache Restart:** Sunucu restart sonrası ayarlar kaybolmuş olabilir
3. **Override Ayarları:** `.htaccess` veya `.user.ini` override edilmiş olabilir

## Kalıcı Çözüm

Üç katmanlı koruma ile:
- ✅ cPanel ayarı (manuel)
- ✅ `.user.ini` (otomatik)
- ✅ `.htaccess` (otomatik)

Her restart'tan sonra PHP 8.3 kullanılacak.

## Sonraki Adım

1. **Git pull yapın** (commit: 34ab736)
2. **PHP version kontrol edin**
3. **Ana siteyi test edin**
4. **Sonucu bildirin**
