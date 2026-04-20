# Mini Project E2E - Backend API

A simple RESTful API for task management built using Laravel 11 and PostgreSQL.

---

## 🚀 Tech Stack

* **Framework**: Laravel 11
* **Language**: PHP
* **Database**: PostgreSQL
* **Authentication**: Laravel Sanctum
* **Architecture**: RESTful JSON API

---

## 📦 Features

### 🔐 Authentication

* Register
* Login
* Logout

### 📝 Task Management

* Create task
* Get all tasks
* Get task detail
* Update task
* Delete task

### ⚡ Task Actions

* Start task
* Complete task

### 🔍 Filtering, Search & Sorting

The `/tasks` endpoint supports:

* **Search**

  ```
  GET /tasks?search=task
  ```

* **Filter**

  ```
  GET /tasks?status=completed
  GET /tasks?priority=high
  ```

* **Sorting**

  ```
  GET /tasks?sort_by=due_date&order=asc
  ```

---

## 🔐 Authentication

This API uses **Laravel Sanctum (token-based authentication)**.

### Flow:

1. Login via `/api/login`
2. API returns an access token
3. Include token in every protected request:

```
Authorization: Bearer {token}
```

---

## 🌐 Base URL

```
http://localhost:8000/api
```

---

## 📄 API Documentation (Postman)

This project includes a Postman Collection for easy API testing.

### How to use:

1. Import `docs/postman_collection.json` into Postman
2. Set environment variables:

   * `base_url = http://localhost:8000`
3. Login to get `access_token`
4. Use other endpoints (token will be used automatically)

---

## 🧪 Dummy Accounts (Seeder)

**Admin**

* Email: [admin@test.com](mailto:admin@test.com)
* Password: admin123

**User**

* Email: [user@test.com](mailto:user@test.com)
* Password: user123

---

## 🔌 API Endpoints

### Auth

* `POST /register`
* `POST /login`
* `POST /logout` *(protected)*

### Tasks (Protected)

* `GET /tasks`
* `POST /tasks`
* `GET /tasks/{id}`
* `PUT /tasks/{id}`
* `DELETE /tasks/{id}`

### Task Actions (Protected)

* `POST /tasks/{task}/start`
* `POST /tasks/{task}/complete`

---

## ⚙️ Installation

### 1. Clone Repository

```
git clone <your-repo-url>
cd <project-folder>
```

### 2. Install Dependencies

```
composer install
```

### 3. Setup Environment

```
cp .env.example .env
```

### 4. Configure Database (PostgreSQL)

Edit `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate App Key

```
php artisan key:generate
```

### 6. Run Migration & Seeder

```
php artisan migrate --seed
```

### 7. Run Server

```
php artisan serve
```

---

## 📤 API Response Format

### ✅ Success Response

```json
{
  "data": {
    "id": 1,
    "title": "Sample Task"
  },
  "message": "Success"
}
```

### ❌ Validation Error

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "title": ["The title field is required."]
  }
}
```

---

## 📂 Project Structure (Simplified)

* `app/Http/Controllers` → API Controllers
* `app/Models` → Eloquent Models
* `app/Http/Requests` → Validation (FormRequest)
* `routes/api.php` → API Routes

---

## 🧪 API Testing

You can test the API using:

* Postman (recommended)
* Insomnia

Make sure to include **Bearer Token** for protected endpoints.

---

## 📌 Notes

* Email verification is not implemented
* Rate limiting is not implemented
* Task action endpoints (`start`, `complete`) are available
* Postman collection is provided for easier testing

---

## ⚠️ Requirements

Make sure:

* PostgreSQL is running
* Database is created before migration
* Seeder runs successfully
