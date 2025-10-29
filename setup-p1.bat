@echo off
echo ==========================================
echo EvaHome P1 Geliştirmeleri Kurulum
echo ==========================================
echo.

echo [1/5] Composer paketleri yukleniyor...
call composer require iyzico/iyzipay-php
if errorlevel 1 (
    echo HATA: Composer paketi yuklenemedi!
    pause
    exit /b 1
)
echo ✓ Tamamlandi
echo.

echo [2/5] Migration'lar calistiriliyor...
call php artisan migrate
if errorlevel 1 (
    echo UYARI: Migration hatasi! Manuel kontrol edin.
)
echo ✓ Tamamlandi
echo.

echo [3/5] Notifications table olusturuluyor...
call php artisan notifications:table
call php artisan migrate
echo ✓ Tamamlandi
echo.

echo [4/5] Cache temizleniyor...
call php artisan cache:clear
call php artisan config:clear
call php artisan view:clear
call php artisan route:clear
echo ✓ Tamamlandi
echo.

echo [5/5] Optimize ediliyor...
call php artisan optimize
echo ✓ Tamamlandi
echo.

echo ==========================================
echo Kurulum Tamamlandi! 🎉
echo ==========================================
echo.
echo Sonraki adimlar:
echo 1. .env dosyaniza odeme API anahtarlarini ekleyin
echo 2. Mail ayarlarini yapin
echo 3. php artisan serve ile projeyi baslatin
echo 4. npm run dev ile frontend'i baslatin
echo.
echo Detayli bilgi icin: INSTALL_P1.md
echo.
pause

