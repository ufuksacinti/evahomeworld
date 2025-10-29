# Build Assets Deployment Guide

## Sorun
Sunucuda `ViteManifestNotFoundException` hatası aldınız çünkü frontend build dosyaları eksikti.

## Çözüm
Frontend build dosyalarını GitHub'a yükledik ve deploy ettik.

## Yapılan İşlemler

### 1. Build Dosyaları Eklendi
- `public/build/assets/app-BEWoWtpm.css`
- `public/build/assets/app-BwqMFh-s.css`
- `public/build/assets/app-CXDpL9bK.js`
- `public/build/manifest.json`

### 2. GitHub'a Push
```bash
git add -f public/build
git commit -m "Add frontend build assets for production"
git push origin main
```

## Sunucuda Yapılacaklar

### Adım 1: cPanel Git Version Control
1. cPanel'e giriş yapın
2. **Git Version Control** bölümüne gidin
3. **Pull or Deploy** butonuna tıklayın
4. Commit: `58d1a49`

### Adım 2: Kontrol
1. Tarayıcıda şu dosyayı kontrol edin:
   ```
   http://evahomeworld.com/public/build/manifest.json
   ```
   
   Bu dosya görünmeli ve JSON içerik göstermeli.

2. Ana siteyi test edin:
   ```
   http://evahomeworld.com
   ```

## Beklenen Sonuç
✅ Vite manifest hatası düzeldi
✅ Site düzgün yükleniyor
✅ CSS ve JavaScript dosyaları yükleniyor
✅ 500 hatası yok

## Notlar

### Neden `.gitignore`'da vardı?
Laravel'de normalde `public/build` klasörü `.gitignore`'da olur çünkü:
- Her developer kendi build'ini oluşturur
- Ama production deployment için gereklidir

### Build Dosyaları Nedir?
- **manifest.json**: Hangi asset dosyalarının yükleneceğini belirtir
- **app.css**: Tüm CSS dosyaları birleştirilmiş halde
- **app.js**: Tüm JavaScript dosyaları birleştirilmiş halde

### Gelecek Değişiklikler İçin
Frontend dosyalarında değişiklik yaptığınızda:
```bash
npm run build
git add -f public/build
git commit -m "Update frontend assets"
git push origin main
```

## Sorun Devam Ederse

1. **Build klasörü yoksa:**
   - Git pull'u kontrol edin
   - `public/build` klasörünün izinlerini kontrol edin

2. **Manifest bulunamazsa:**
   - `public_html/public/build/manifest.json` dosyasını kontrol edin
   - Dosya izinleri: `644`

3. **Hala 500 hatası varsa:**
   - Laravel log'u kontrol edin
   - Debug mode açıkken hatayı görün
