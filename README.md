# DoorStep 🚪

## Full-Stack Home Services Marketplace Platform

DoorStep is a modern full-stack web application that connects customers with trusted local service providers for home services such as plumbing, home cleaning, beauty & spa, electrical work, repairs, and more.

Built using Laravel 12, Tailwind CSS, PostgreSQL, Docker, and deployed on Render, the platform provides role-based dashboards, booking management, provider analytics, and a responsive SaaS-style user experience.

---

# 🌐 Live Demo

- Live Demo: https://doorstep-1ghu.onrender.com

---

# ✨ Features

## 👤 Authentication & Authorization
- Role-based authentication
- Customer & Provider login system
- Middleware-protected routes
- Secure session handling

---

## 🧑‍🔧 Provider Features
- Create and manage provider profile
- Add and manage services
- Booking management system
- Confirm or reject customer bookings
- Availability management
- Revenue analytics dashboard
- Booking insights and statistics

---

## 👨‍💼 Customer Features
- Browse available providers
- View provider details
- Book services
- Track booking status
- Cancel bookings
- Personalized customer dashboard

---

## 📊 Dashboard Analytics
- Active services count
- Total bookings
- Pending requests
- Confirmed bookings
- Revenue insights graph
- Real-time dashboard updates

---

## 🎨 UI/UX
- Modern SaaS-inspired design
- Tailwind CSS styling
- Glassmorphism effects
- Responsive layout
- Fixed sidebar dashboard
- Smooth animations and transitions

---

# 🛠️ Tech Stack

## Frontend
- Blade Templates
- Tailwind CSS
- JavaScript
- Alpine.js
- Vite

## Backend
- Laravel 12
- PHP 8.2
- RESTful Routing
- Middleware Authentication

## Database
- PostgreSQL
- MySQL (local development)

## Deployment & DevOps
- Docker
- Render
- Git & GitHub

---

# 📂 Project Structure

```bash
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│
├── Models/
│
resources/
├── views/
├── css/
├── js/

routes/
├── web.php

database/
├── migrations/

```

### ⚙️ Installation & Setup

1️⃣ Clone Repository
```bash
git clone https://github.com/YOUR_USERNAME/DoorStep.git
cd DoorStep
```
2️⃣ Install Dependencies

PHP Dependencies
```bash
composer install
```
Node Dependencies

```bash
npm install
```
3️⃣ Configure Environment

Copy .env.example
```bash
cp .env.example .env
```
Generate app key:

```bash
php artisan key:generate
```

4️⃣ Configure Database

Update .env
```bash
DB_CONNECTION=pgsql
DB_HOST=YOUR_HOST
DB_PORT=5432
DB_DATABASE=YOUR_DATABASE
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD
```

5️⃣ Run Migrations
```bash
php artisan migrate
```
6️⃣ Start Development Server

Terminal 1
```bash
npm run dev
```
Terminal 2
```bash
php artisan serve
```
### 🐳 Docker Deployment

Build Docker Image
```bash
docker build -t doorstep .
```
Run Container
```bash
docker run -p 10000:10000 doorstep
```
## Deployment

The application is deployed using:

* Docker
* Render
* PostgreSQL

### 📌 Future Improvements

* Real-time notifications
* Payment gateway integration
* Reviews & ratings system
* Service chat system
* AI-based service recommendations
* Location-based provider discovery
* Email & SMS notifications

### 🧠 Learning Outcomes

* Laravel MVC Architecture
* Dockerized deployments
* PostgreSQL production integration
* Tailwind CSS optimization
* Vite asset management
* Middleware-based authorization
* Role-based application architecture
* Render cloud deployment
* Full-stack debugging & optimization

📄 License

This project is developed for learning, portfolio, and educational purposes.
