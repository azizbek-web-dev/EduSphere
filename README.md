# EduSphere

## 📚 About EduSphere

EduSphere is a modern educational platform built with Laravel and Telegram Web App, designed to provide a comprehensive learning management system through Telegram.

## 🚀 Features

- 🤖 **Telegram Bot Integration** - Seamless user interaction through Telegram
- 🌐 **Telegram Web App** - Beautiful and responsive web interface
- 👥 **User Management** - Automatic user registration via Telegram
- 📚 **Course Management** - Comprehensive course catalog
- 🎯 **Assignment Tracking** - Track student progress and assignments
- 🏆 **Certificates** - Issue certificates upon course completion
- 👨‍🏫 **Mentor Support** - Connect students with experienced mentors

## 💻 Tech Stack

- **Backend:** Laravel 11.x
- **Database:** MySQL
- **Frontend:** Blade Templates, Vite, Telegram Web App SDK
- **Bot Framework:** Telegram Bot API
- **Authentication:** Laravel Sanctum

## 📦 Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL
- Telegram Bot Token (Get from [@BotFather](https://t.me/botfather))

### Steps

```bash
# Clone repository
git clone https://github.com/azizbek-web-dev/EduSphere.git
cd EduSphere

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_DATABASE=edusphere
DB_USERNAME=root
DB_PASSWORD=your_password

# Configure Telegram Bot in .env
TELEGRAM_BOT_TOKEN=your_bot_token_here
TELEGRAM_BOT_USERNAME=your_bot_username

# Run migrations
php artisan migrate

# Start development server
php artisan serve

# Build assets
npm run dev
```

## 🤖 Telegram Bot Setup

1. Create a bot via [@BotFather](https://t.me/botfather)
2. Get your bot token
3. Add token to `.env` file
4. Set webhook:
```bash
# Visit this URL after starting your server
http://your-domain.com/api/telegram/set-webhook
```

5. Test your bot by sending `/start` command

## 📱 Web App Features

- ✅ User profile display
- ✅ Course catalog
- ✅ Assignment management
- ✅ Progress tracking
- ✅ Certificate viewing
- ✅ Mentor communication

## 🗂️ Project Structure

```
app/
├── Http/Controllers/
│   └── TelegramBotController.php  # Telegram bot logic
├── Models/
│   ├── User.php                   # Default user model
│   └── TelegramUser.php           # Telegram user model
database/
├── migrations/
│   └── create_telegram_users_table.php
routes/
├── web.php                        # Web routes
└── api.php                        # API routes (webhook)
resources/
└── views/
    └── webapp.blade.php           # Telegram Web App UI
```

## 🔧 Configuration

### Database
Update your `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edusphere
DB_USERNAME=root
DB_PASSWORD=
```

### Telegram Bot
```env
TELEGRAM_BOT_TOKEN=123456:ABC-DEF1234ghIkl-zyx57W2v1u123ew11
TELEGRAM_BOT_USERNAME=YourBotUsername
APP_URL=https://your-domain.com
```

## 🚀 Deployment

For production deployment:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Configure your domain in `APP_URL`
4. Set up SSL certificate (required for Telegram Web App)
5. Run `php artisan config:cache`
6. Run `php artisan route:cache`
7. Set webhook to your production URL

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

Developed with ❤️ by [Azizbek](https://github.com/azizbek-web-dev)

## 📞 Support

For support, contact us via:
- Telegram: [@YourUsername](https://t.me/YourUsername)
- Email: your-email@example.com

---

**Note:** This is an educational project. Make sure to follow Telegram's Terms of Service when deploying to production.