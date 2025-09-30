<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSphere - Ta'lim Platformasi</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: var(--tg-theme-bg-color, #ffffff);
            color: var(--tg-theme-text-color, #000000);
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            color: white;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            font-size: 14px;
            opacity: 0.95;
        }

        .user-info {
            background: var(--tg-theme-secondary-bg-color, #f0f0f0);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .user-info h2 {
            font-size: 18px;
            margin-bottom: 15px;
            color: var(--tg-theme-text-color, #000000);
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: var(--tg-theme-hint-color, #999999);
        }

        .info-value {
            font-weight: 500;
            color: var(--tg-theme-text-color, #000000);
        }

        .features {
            margin-top: 20px;
        }

        .feature-card {
            background: var(--tg-theme-secondary-bg-color, #f0f0f0);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .feature-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-card h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: var(--tg-theme-text-color, #000000);
        }

        .feature-card p {
            font-size: 14px;
            color: var(--tg-theme-hint-color, #999999);
            line-height: 1.5;
        }

        .icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: var(--tg-theme-hint-color, #999999);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎓 EduSphere</h1>
            <p>Ta'lim platformasiga xush kelibsiz!</p>
        </div>

        <div class="user-info" id="userInfo">
            <h2>👤 Foydalanuvchi ma'lumotlari</h2>
            <div class="loading">Ma'lumotlar yuklanmoqda...</div>
        </div>

        <div class="features">
            <div class="feature-card">
                <h3><span class="icon">📚</span>Kurslar</h3>
                <p>Turli sohalarda 100+ ta professional kurslar</p>
            </div>

            <div class="feature-card">
                <h3><span class="icon">🎯</span>Topshiriqlar</h3>
                <p>Amaliy topshiriqlar va testlar orqali o'rganing</p>
            </div>

            <div class="feature-card">
                <h3><span class="icon">🏆</span>Sertifikatlar</h3>
                <p>Kursni muvaffaqiyatli yakunlang va sertifikat oling</p>
            </div>

            <div class="feature-card">
                <h3><span class="icon">👨‍🏫</span>Mentorlar</h3>
                <p>Tajribali ustozlar yordami va qo'llab-quvvatlash</p>
            </div>
        </div>

        <button class="btn" onclick="exploreCourses()">🚀 Kurslarni ko'rish</button>
    </div>

    <script>
        // Initialize Telegram Web App
        let tg = window.Telegram.WebApp;
        tg.expand();
        tg.enableClosingConfirmation();

        // Get user data
        const user = tg.initDataUnsafe?.user;

        // Display user information
        if (user) {
            const userInfoHtml = `
                <h2>👤 Foydalanuvchi ma'lumotlari</h2>
                <div class="info-item">
                    <span class="info-label">Ism:</span>
                    <span class="info-value">${user.first_name || 'N/A'}</span>
                </div>
                ${user.last_name ? `
                <div class="info-item">
                    <span class="info-label">Familiya:</span>
                    <span class="info-value">${user.last_name}</span>
                </div>
                ` : ''}
                ${user.username ? `
                <div class="info-item">
                    <span class="info-label">Username:</span>
                    <span class="info-value">@${user.username}</span>
                </div>
                ` : ''}
                <div class="info-item">
                    <span class="info-label">User ID:</span>
                    <span class="info-value">${user.id}</span>
                </div>
                ${user.language_code ? `
                <div class="info-item">
                    <span class="info-label">Til:</span>
                    <span class="info-value">${user.language_code.toUpperCase()}</span>
                </div>
                ` : ''}
            `;
            document.getElementById('userInfo').innerHTML = userInfoHtml;
        } else {
            document.getElementById('userInfo').innerHTML = `
                <h2>👤 Foydalanuvchi ma'lumotlari</h2>
                <div class="loading">Ma'lumotlar topilmadi</div>
            `;
        }

        // Button action
        function exploreCourses() {
            tg.showAlert('Kurslar bo\'limi ishlab chiqilmoqda! 🚀', () => {
                console.log('Alert closed');
            });
        }

        // Set main button
        tg.MainButton.setText('Asosiy sahifa');
        tg.MainButton.show();
        tg.MainButton.onClick(() => {
            tg.close();
        });

        // Log initialization
        console.log('Telegram Web App initialized:', tg.initDataUnsafe);
    </script>
</body>
</html>
