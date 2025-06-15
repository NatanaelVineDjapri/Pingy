# Pingy

Pingy is a Laravel 11-based backend project inspired by Twitter/X, developed for a final exam. It showcases core backend skills like API design, data handling, and scalable architecture, ready for frontend integration and future feature expansion.

---
## 👨‍💻 Created By


| No | Name                  | NIM         |
|----|-----------------------|-------------|
| 1  | Natanael Vine Djapri  | 535240042   |
| 2  | Ryan Prasetya Arjuna  | 535240043   |
| 3  | Vivian Carolina       | 535240060   |
| 4  | Stanley Varian Rahman | 535240061   |

## 🚀 Features

- ✍️ Post tweets (with optional image attachments)
- 💬 Comment on tweets
- 🔁 Retweet tweets from other users
- ❤️ Like and unlike tweets
- 👤 Follow and unfollow other users
- 🧵 Personalized home showing tweets from followed and public users
- 🔍 Explore page to discover public users
- 📸 User profiles 
- 📥 Private messaging (DMs) between users
- 🔐 User authentication (register, login, logout, and forgot password)


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

`git clone https://github.com/your-username/laravel-twitter-clone.git`  
`cd laravel-twitter-clone`

### 2. Install PHP dependencies

`composer install`

### 3. Install Node.js dependencies

`npm install`  

### 4. Create environment file and generate app key

`cp .env.example .env`  
`php artisan key:generate`

### 5. Database setup

`php artisan migrate`
`php artisan db:seed`

### 6. Link the storage for images

`php artisan storage:link`

### 7. Run the server

`php artisan serve`

