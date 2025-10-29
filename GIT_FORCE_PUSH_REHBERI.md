# Git Force Push Rehberi

## ⚠️ ÖNEMLİ UYARI

Force push yapmak, remote'taki tüm commit'leri local ile değiştirir. Bu işlem **geri alınamaz**! 
**Sadece kendi branch'inizde ve emin olduğunuz durumlarda kullanın.**

---

## 🔄 Local'deki Değişiklikleri Remote'a Force Push Etme

### Yöntem 1: Direkt Force Push (ÖNERİLEN)

```bash
git push --force origin ufuk
```

VEYA daha güvenli:

```bash
git push --force-with-lease origin ufuk
```

**`--force-with-lease` farkı:**
- Eğer başka biri remote'a push yaptıysa, push'u reddeder
- Daha güvenlidir, başkalarının değişikliklerini yanlışlıkla silmenizi engeller

---

### Yöntem 2: Adım Adım

1. **Local değişiklikleri kontrol edin:**
   ```bash
   git status
   ```

2. **Eğer commit edilmemiş değişiklikler varsa, commit edin:**
   ```bash
   git add -A
   git commit -m "Local değişiklikler"
   ```

3. **Force push yapın:**
   ```bash
   git push --force-with-lease origin ufuk
   ```

---

## 🛡️ Force Push Öncesi Yedek Alma

Eğer remote'taki değişiklikleri kaybetmek istemiyorsanız:

```bash
# Remote'taki branch'i yedek olarak kaydedin
git branch backup-ufuk origin/ufuk

# Şimdi force push yapabilirsiniz
git push --force-with-lease origin ufuk
```

---

## 📋 Detaylı Adımlar

### 1. Mevcut Durumu Kontrol Edin

```bash
# Hangi branch'tesiniz?
git branch

# Remote'ta ne var?
git fetch origin
git log origin/ufuk --oneline -10

# Local'de ne var?
git log --oneline -10
```

### 2. Local Değişiklikleri Commit Edin (Eğer Varsa)

```bash
git status
git add -A
git commit -m "Local değişikliklerimi kaydet"
```

### 3. Force Push Yapın

```bash
# Güvenli yöntem (önerilen)
git push --force-with-lease origin ufuk

# VEYA direkt force (daha tehlikeli)
git push --force origin ufuk
```

---

## 🚨 Yaygın Senaryolar

### Senaryo 1: Sunucuda Yapılan Değişiklikleri Override Etmek

```bash
# 1. Remote'u kontrol et
git fetch origin

# 2. Local'i remote'a zorla gönder
git push --force-with-lease origin ufuk
```

### Senaryo 2: Remote'taki Son Commit'i İptal Edip Local'i Göndermek

```bash
# 1. Local'i en son commit'e alın (eğer geri almak istiyorsanız)
git reset --hard HEAD

# 2. Force push
git push --force-with-lease origin ufuk
```

### Senaryo 3: Remote Branch'ı Tamamen Local ile Değiştirmek

```bash
# 1. Remote'taki branch'ı silin (GitHub'dan veya)
git push origin --delete ufuk

# 2. Local branch'i tekrar push edin
git push -u origin ufuk
```

---

## ⚠️ DİKKAT EDİLMESİ GEREKENLER

1. **Force push yapmadan önce emin olun** - Geri alınamaz!
2. **Başkalarıyla çalışıyorsanız** - Onlara haber verin
3. **Production branch'lerde** - Mümkünse force push yapmayın
4. **`--force-with-lease` kullanın** - Daha güvenli

---

## 🔄 Alternatif: Merge Commit Oluşturma

Eğer remote'taki değişiklikleri korumak istiyorsanız:

```bash
# 1. Remote'u pull edin
git pull origin ufuk --no-rebase

# 2. Conflict'leri çözün

# 3. Normal push yapın
git push origin ufuk
```

---

## 📞 Sorun Giderme

### "Updates were rejected" hatası

```bash
# Bu durumda force push yapmanız gerekir
git push --force-with-lease origin ufuk
```

### Remote'taki değişiklikleri kaybetmek istemiyorum

```bash
# Önce remote'takini alın
git fetch origin

# Merge edin
git merge origin/ufuk

# Sonra push edin
git push origin ufuk
```

---

## ✅ İşlem Sonrası Kontrol

```bash
# Remote ile local'in aynı olduğunu kontrol edin
git fetch origin
git log --oneline --graph --all -10
```

