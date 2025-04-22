
# 🎙️ Podcast Platform API

This is a Laravel-based RESTful API for a podcast platform. The system supports managing podcasts, categories, and episodes. It follows clean architecture principles and uses Swagger for full API documentation.

---

## 🚀 Tech Stack

- PHP 8.x  
- Laravel 10+  
- MySQL (with proper indexing and foreign keys)  
- Docker & Docker Compose  
- Swagger (OpenAPI via L5-Swagger)  
- Eloquent ORM  

---

## 📦 Setup Instructions

Follow these steps to get the project running locally:

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/podcast-platform-api.git
cd podcast-platform-api
```

### 2. Copy `.env` File

```bash
cp .env.example .env
```

Update `.env` as needed (especially DB and APP_URL settings).

---

### 3. Install PHP Dependencies

```bash
composer install
```

---

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

### 5. Set Permissions (Linux/macOS)

```bash
chmod -R 775 storage bootstrap/cache
```

---

### 6. Run with Docker

Make sure Docker is installed, then run:

```bash
docker-compose up -d
```

This starts:
- Laravel app container (`app`)
- MySQL database container (`db`)
- phpMyAdmin (accessible at [http://localhost:8080](http://localhost:8080))

---

### 7. Run Migrations and Seeders

```bash
docker exec -it app bash
php artisan migrate:fresh --seed
```

This will create the tables and populate them with sample data (categories, podcasts, episodes).

---

### 8. Generate Swagger Documentation

```bash
php artisan l5-swagger:generate
```

Once complete, open:

```
http://localhost:8000/api/documentation
```

to view the interactive Swagger UI.

---

## 📘 API Endpoints Overview

### 🏠 Landing Page

| Method | Endpoint       | Description                    |
|--------|----------------|--------------------------------|
| GET    | `/api/landing` | Featured and recent podcasts   |

---

### 📚 Categories

| Method | Endpoint                          | Description                        |
|--------|-----------------------------------|------------------------------------|
| GET    | `/api/categories`                | List all categories                |
| GET    | `/api/categories/{id}`           | Get a category by ID               |
| GET    | `/api/categories/{id}/podcasts`  | Get podcasts under a category      |

---

### 🎙️ Podcasts

| Method | Endpoint                         | Description                          |
|--------|----------------------------------|--------------------------------------|
| GET    | `/api/podcasts`                 | List all podcasts                    |
| GET    | `/api/podcasts/{id}`            | Get podcast details with episodes    |
| GET    | `/api/podcasts/{id}/episodes`   | Get episodes under a podcast         |

---

### 🔊 Episodes

| Method | Endpoint                 | Description                     |
|--------|--------------------------|---------------------------------|
| GET    | `/api/episodes`         | List all episodes               |
| GET    | `/api/episodes/{id}`    | Get episode details             |

---

## ✅ Features

- Clean RESTful architecture  
- Eloquent relationships: Podcast ↔ Category, Podcast ↔ Episodes  
- Swagger documentation (OpenAPI Spec)  
- Dockerized environment  
- Database seeding for test data  
- Modular controller, request, and resource structure  

---

## 🧾 License

This project is open-sourced under the [MIT license](LICENSE).

---

## 🙌 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you’d like to change or add.

---
