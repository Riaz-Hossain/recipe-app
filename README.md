# 🍲 Recipe App (Laravel)

A simple but powerful recipe management web application built with Laravel.  
Users can create, manage, and browse recipes with ingredients, cooking steps, and images.

---

## 🚀 Features

- 🔐 User authentication (Login / Register)
- 🍽️ Create, edit, delete recipes
- 📂 Category system for recipes
- 🧂 Add multiple ingredients per recipe
- 👨‍🍳 Step-by-step cooking instructions
- 🖼️ Image upload for recipes
- 👤 User-based recipe ownership
- 📋 Recipe listing with relationships
- 🔍 Clean relational database structure

---

## 🛠️ Tech Stack

- Laravel 10+
- MySQL
- Blade Templates
- Bootstrap / Basic HTML
- Laravel Breeze (Authentication)
- PHP 8+

---

## 📦 Installation Guide

### 1. Clone the repository
```bash
git clone https://github.com/your-username/recipe-app.git
cd recipe-app
cp .env.example .env
php artisan key:generate
php artisan storage:link
composer install
npm install
npm run dev

php artisan migrate:fresh --seed

📁 Database Structure
users
recipes
categories
ingredients
recipe_steps
favorites (optional feature)
🧠 Key Concepts Used
MVC Architecture
Eloquent Relationships (hasMany, belongsTo)
Form validation
File upload handling
Dynamic forms (ingredients & steps)
Authentication middleware
📸 Screenshots

(Add screenshots here later)

🔥 Future Improvements
Recipe search & filters
Recipe rating system ⭐
Comments system 💬
API for mobile app
Admin dashboard
Meal planner feature
👨‍💻 Author

Md. Riaz Hossain
Web Developer (Laravel)

📜 License

This project is open-source and available under the MIT License.