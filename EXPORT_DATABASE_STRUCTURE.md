# 🗄️ Veritabanı Yapısı ve Migration Dosyaları

## 📋 Tablo Listesi (27 Tablo)

1. migrations
2. sqlite_sequence
3. users
4. password_reset_tokens
5. sessions
6. cache
7. cache_locks
8. jobs
9. job_batches
10. failed_jobs
11. addresses
12. categories
13. product_images
14. product_attributes
15. carts
16. cart_items
17. favorites
18. orders
19. order_items
20. campaigns
21. campaign_products
22. blog_posts
23. blog_categories
24. blog_post_categories
25. bulk_orders
26. settings
27. collections
28. products
29. notifications

---

## 🚀 Sunucuda Veritabanını Kurma

### ADIM 1: Setup Database Dosyasını Çalıştır

Tarayıcıda:
```
http://evahomeworld.com/public/setup_database.php
```

Bu dosya:
- ✅ Tüm tabloları sıfırlar (DROP)
- ✅ Migration'ları yeniden çalıştırır
- ✅ Seeder'ları çalıştırır (admin user, categories, products vb.)

### ADIM 2: Manuel Migration (Alternatif)

Eğer `setup_database.php` çalışmazsa, Terminal'de:

```bash
cd ~/public_html
php83 artisan migrate:fresh --force
php83 artisan db:seed --force
```

---

## 📁 Migration Dosyaları

Tüm migration dosyaları `database/migrations/` klasöründe:

1. `0001_01_01_000000_create_users_table.php`
2. `0001_01_01_000001_create_cache_table.php`
3. `0001_01_01_000002_create_jobs_table.php`
4. `2025_10_14_181615_add_role_and_phone_to_users_table.php`
5. `2025_10_14_181631_create_addresses_table.php`
6. `2025_10_14_181636_create_categories_table.php`
7. `2025_10_14_181641_create_products_table.php`
8. `2025_10_14_181646_create_product_images_table.php`
9. `2025_10_14_181652_create_product_attributes_table.php`
10. `2025_10_14_181703_create_carts_table.php`
11. `2025_10_14_181708_create_cart_items_table.php`
12. `2025_10_14_181713_create_favorites_table.php`
13. `2025_10_14_181718_create_orders_table.php`
14. `2025_10_14_181723_create_order_items_table.php`
15. `2025_10_14_181735_create_campaigns_table.php`
16. `2025_10_14_181740_create_campaign_products_table.php`
17. `2025_10_14_181746_create_blog_posts_table.php`
18. `2025_10_14_181751_create_blog_categories_table.php`
19. `2025_10_14_181757_create_blog_post_categories_table.php`
20. `2025_10_14_181807_create_bulk_orders_table.php`
21. `2025_10_14_181812_create_settings_table.php`
22. `2025_10_14_200026_create_collections_table.php`
23. `2025_10_14_200056_add_collection_id_to_products_table.php`
24. `2025_10_14_201206_add_energy_fields_to_collections_table.php`
25. `2025_10_14_204431_create_notifications_table.php`
26. `2025_10_14_211410_add_color_system_to_collections_table.php`
27. `2025_10_14_300001_add_indexes_to_tables.php`

---

## ✅ Test

Migration'lar başarılı olursa:

```bash
# Tabloları kontrol et
php83 artisan migrate:status
```

Tarayıcıda:
```
http://evahomeworld.com/public/test_db.php
```

**Toplam 27+ tablo görünmeli!**

---

## 🔧 Sorun Giderme

### Migration hatası alıyorsanız:

1. `.env` dosyasını kontrol edin:
   ```env
   DB_DATABASE=xqxevaho_home54
   DB_USERNAME=xqxevaho_evahome
   DB_PASSWORD=B)G18T$1S+yg
   ```

2. Migration cache'i temizleyin:
   ```bash
   php83 artisan migrate:reset
   php83 artisan migrate:fresh --force
   ```

3. Seeder'ları çalıştırın:
   ```bash
   php83 artisan db:seed --force
   ```

---

**setup_database.php dosyasını çalıştırın, tüm tablolar otomatik oluşturulacak!** 🚀
