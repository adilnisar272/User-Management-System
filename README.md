```markdown
# 🛡️ Laravel 10 Role & Permission Management System

This project is a full-featured User Management System with Group-based and User-specific permission assignments. It includes dynamic unit and department assignments, and uses a clean architecture with modern Laravel 11 features.

---

## 🚀 Features

- User creation with validations
- Role-based access control using manual group-permission management
- User-specific permission overrides
- Assign users to Units and Departments
- Dynamic dropdowns for Units & Departments
- Ajax-powered DataTables for:
  - Users list
  - User Groups
  - Permission Assignments
- Group CRUD permissions (Create, Read, Update, Delete)
- Clean architecture (Repository + Service + Form Request)
- UI built using Blade Templates
- Permission control via Laravel Policies & Gates

---

## 🧰 Tech Stack

| Layer           | Technology         |
|----------------|--------------------|
| Framework       | Laravel 10         |
| Language        | PHP 8.0+           |
| Frontend        | Blade Templates    |
| Permissions     | Manual with Policies & Gates |
| ORM             | Eloquent ORM       |
| Ajax Tables     | Yajra Laravel DataTables |
| Architecture    | Repository + Service + Traits |
| Database        | MySQL / MariaDB    |

---
## Structure Explanation:

| Layer           | Responsibility           |          Example Files |
|----------------|---------------------------|-------------------------|
| Controller     | HTTP handling, validation    | UserController.php    |
| Service        | Business logic               | UserService.php       |
| Repository     | Database operations          | UserRepository.php    |
| Request        | Validation rules             | UserStoreRequest.php  |
| Model          | Data structure & relationships| User.php             |

## ⚙️ Setup Instructions (Fresh Machine)

### 1. Clone the Repository

```bash
git clone https://github.com/adilnisar272/User-Management-System.git
cd User-Management-System
```

### 2. Install Dependencies

```bash
composer install
npm install
npm run build
```

### 3. Set Up Environment File

```bash
cp .env.example .env
php artisan key:generate
```

> Update `.env` with your DB credentials.

### 4. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

This will:
- Create necessary tables
- Seed default user groups, permissions, and one admin user

### 5. Serve the Application

```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## 🧪 Default Admin Login

```txt
Email: admin@example.com
Password: password
```

> You can change this in the seeder or directly in the database.
---

## ✅ Completed Functional Modules

- [x] Create/Edit/Delete Users
- [x] Group & User-specific Permissions
- [x] Unit & Department Management
- [x] Admin Dashboard
- [x] Blade-based UI
- [x] Dynamic Dropdowns
- [x] AJAX-powered Tables
- [x] Full Laravel 11 Compliance

---

## 📩 Contribution

This is an assignment-ready Laravel 11 project. Fork it or customize it as needed.

---

## 🧑‍💻 Author

**Mohammad Adil Khan**  
_Laravel Developer | PHP Enthusiast_

---

## 📜 License

This project is open-source and available for use or modification under [MIT License](LICENSE).
```
