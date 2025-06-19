# Pingy

Pingy is a backend project built using the Laravel 11 framework, inspired by the social media platform Twitter/X. It was developed as part of a final semester assignment, focusing on building a clean and organized backend structure. This project also served as a way to apply backend development concepts in a more practical and structured context, and it’s designed to be further developed in the future.

---

## 👨‍💻 Created By

| No  | Name                  | NIM       |
| --- | --------------------- | --------- |
| 1   | Natanael Vine Djapri  | 535240042 |
| 2   | Ryan Prasetya Arjuna  | 535240043 |
| 3   | Vivian Carolina       | 535240060 |
| 4   | Stanley Varian Rahman | 535240061 |

## 🚀 Features

- 🔐 User authentication (register, login, logout, and forgot password)
- ✍️ Post tweets (with optional image attachments)
- 💬 Comment on tweets
- 🔁 Retweet tweets from other users
- ❤️ Like and unlike tweets
- 👤 Follow and unfollow other users
- 🔖 Bookmark Tweet
- 🧵 Personalized home showing tweets from followed and public users
- 🔍 Explore page to discover public users
- 📸 User profiles
- 📥 Private messaging (DMs) between users
- 🔔 Notification

---

## 🛠️ Prerequisites

- **PHP 8.1 or higher**
- **Composer**
- **Laravel 10 or higher**
- **Node.js 16.x or higher**
- **MySQL 8.0 or higher**

---

## ⚙️ Local Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/laravel-twitter-clone.git
cd laravel-twitter-clone
```

### 2. Install PHP dependencies
```bash
composer install
```

### 3. Install Node.js dependencies
```bash
npm install
```

### 4. Create environment file and generate app key
```bash
cp .env.example .env  
php artisan key:generate
```

### 5. Database setup
```bash
php artisan migrate
php artisan db:seed
```

### 6. Link the storage for images
```bash
php artisan storage:link
```

### 7. Run the server
```bash
php artisan serve
```
