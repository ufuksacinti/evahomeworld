@echo off
echo ========================================
echo EVAHOME - Sunucu icin Build Olusturma
echo ========================================
echo.

echo [1/5] npm install calistiriliyor...
call npm install
echo.

echo [2/5] Frontend asset'leri derleniyor...
call npm run build
echo.

echo [3/5] public/build klasorundaki dosyalar olusturuldu
echo.

echo [4/5] Build dosyalari kontrol ediliyor...
if exist "public\build\manifest.json" (
    echo ✓ manifest.json bulundu
) else (
    echo ✗ manifest.json BULUNAMADI!
)

if exist "public\build\assets" (
    echo ✓ assets klasoru bulundu
    dir /B public\build\assets
) else (
    echo ✗ assets klasoru BULUNAMADI!
)

echo.
echo ========================================
echo TAMAMLANDI!
echo ========================================
echo.
echo Simdi sunucuya su klasorleri yukleyin:
echo.
echo  1. TUM PROJE DOSYALARI (vendor haric)
echo  2. public/build klasoru ve icindekiler
echo  3. .env dosyasi (kendi ayarlarinizla)
echo.
echo Ardindan sunucuda:
echo   php artisan migrate:fresh --force
echo   php artisan db:seed --force
echo   php artisan storage:link
echo   composer install --no-dev --optimize-autoloader
echo.
echo NOT: Vendor klasorunu sunucuda 'composer install' ile 
echo      olusturun, yuklemeyin (cok buyuk)!
echo.
pause

