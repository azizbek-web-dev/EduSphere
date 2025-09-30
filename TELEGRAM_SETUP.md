# 🤖 Telegram Bot & Web App O'rnatish Ko'rsatmasi

## 1. Telegram Bot Yaratish

### BotFather orqali bot yaratish:

1. Telegram'da [@BotFather](https://t.me/botfather) ni oching
2. `/start` buyrug'ini yuboring
3. `/newbot` buyrug'ini yuboring
4. Bot uchun ism kiriting (masalan: `EduSphere Learning`)
5. Bot username kiriting (masalan: `EduSphere_bot`)
6. BotFather sizga **Bot Token** beradi, uni saqlang!

### Bot sozlamalari:

```
/setdescription - Bot tavsifini o'zgartirish
/setabouttext - Bot haqida ma'lumot
/setuserpic - Bot rasmini o'rnatish
```

## 2. Loyihani Sozlash

### .env faylini yaratish:

```bash
cp .env.example .env
```

### .env da quyidagilarni o'zgartiring:

```env
APP_URL=http://localhost:8000  # Yoki sizning domeningiz

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edusphere
DB_USERNAME=root
DB_PASSWORD=sizning_parolingiz

# Telegram Bot
TELEGRAM_BOT_TOKEN=123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11
TELEGRAM_BOT_USERNAME=YourBot_username
```

### Database yaratish:

```sql
CREATE DATABASE edusphere CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Migration ishga tushirish:

```bash
php artisan migrate
```

## 3. Serverni Ishga Tushirish

### Local development:

```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite (agar frontend ishlatsangiz)
npm run dev
```

## 4. Webhook O'rnatish

### Local development uchun (ngrok kerak):

1. **ngrok** o'rnating: https://ngrok.com/download
2. Ngrok ishga tushiring:
```bash
ngrok http 8000
```

3. Ngrok bergan HTTPS URL ni `.env` ga qo'shing:
```env
APP_URL=https://your-ngrok-url.ngrok.io
```

4. Brauzerda webhook o'rnating:
```
https://your-ngrok-url.ngrok.io/api/telegram/set-webhook
```

Javob:
```json
{
  "ok": true,
  "result": true,
  "description": "Webhook was set"
}
```

### Production uchun:

1. SSL sertifikat o'rnating (Let's Encrypt)
2. `.env` da production URL ni kiriting:
```env
APP_URL=https://yourdomain.com
```

3. Webhook o'rnating:
```
https://yourdomain.com/api/telegram/set-webhook
```

## 5. Bot Ishlayotganini Tekshirish

### Webhook ma'lumotlarini ko'rish:

```
http://your-url/api/telegram/webhook-info
```

### Bot bilan test:

1. Telegram'da botingizni toping
2. `/start` buyrug'ini yuboring
3. Siz salom xabari va inline tugmalarni olishingiz kerak:
   - 🌐 Web App ni ochish
   - 🤖 Bot haqida

## 6. Web App Ochish

1. Bot'dan "Web App ni ochish" tugmasini bosing
2. Telegram Web App ochiladi
3. Foydalanuvchi ma'lumotlari ko'rsatiladi
4. Kurslar, topshiriqlar bo'limlari mavjud

## 7. Muammolarni Hal Qilish

### Webhook ishlamayapti:

1. Webhook ma'lumotlarini tekshiring:
```
/api/telegram/webhook-info
```

2. Log fayllarni ko'ring:
```bash
tail -f storage/logs/laravel.log
```

3. HTTPS ishlatayotganingizni tekshiring (Telegram HTTPS talab qiladi)

### Database xatosi:

```bash
# Migration qayta ishga tushirish
php artisan migrate:fresh
```

### Bot javob bermayapti:

1. `.env` da `TELEGRAM_BOT_TOKEN` to'g'riligini tekshiring
2. Webhook o'rnatilganini tekshiring
3. Server ishlab turganini tekshiring

## 8. Keyingi Qadamlar

- [ ] Callback query handler qo'shish (Bot haqida tugmasi uchun)
- [ ] Kurslar CRUD qo'shish
- [ ] Foydalanuvchi autentifikatsiyasi
- [ ] API endpoints yaratish
- [ ] Admin panel
- [ ] To'lov integratsiyasi

## 9. Foydali Resurslar

- [Telegram Bot API](https://core.telegram.org/bots/api)
- [Telegram Web App API](https://core.telegram.org/bots/webapps)
- [Laravel Documentation](https://laravel.com/docs)

---

**Eslatma:** Production'ga chiqarishdan oldin:
- SSL sertifikat o'rnating
- `.env` da `APP_DEBUG=false` qiling
- Cache'larni optimize qiling:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
