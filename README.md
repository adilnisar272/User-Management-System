# 🛡️ Laravel Role & Permission Management System

This is a complete **User Management System** developed using Laravel 10. It features manual role and permission handling using Groups (Roles) and User-specific overrides. Users can be assigned organizational Units and Departments, with dynamic dropdown filtering and Ajax-powered data management.

---

## 🚀 Features

- User creation with proper validation
- Group-based Role Permissions (CRUD)
- User-specific Permission overrides
- Units and Departments with dynamic assignment
- Blade UI with clean, reusable partials
- DataTables (AJAX) for:
    - Users List
    - User Groups
    - Rights Assignments
- Manual Role & Permission system (no third-party ACL)
- Clean and modular code structure
- Policy & Gate-based permission control
- Laravel Form Requests, Service Layer, Repository Pattern

---

## 🧰 Tech Stack

| Layer            | Technology              |
|------------------|--------------------------|
| Framework         | Laravel 10               |
| Language          | PHP 8.1+                 |
| Frontend          | Blade Templates (Bootstrap) |
| Permissions       | Manual via Policies & Gates |
| ORM               | Eloquent ORM             |
| Ajax Tables       | Yajra Laravel DataTables |
| Architecture      | Repository + Service + Traits |
| Database          | MySQL / MariaDB          |

---

## 🧱 Folder Structure Overview

| Layer         | Description                        | Example File               |
|---------------|-------------------------------------|----------------------------|
| Controller     | Handles HTTP requests              | `UserController.php`       |
| Request        | Validates incoming data            | `UserStoreRequest.php`     |
| Service        | Business logic                     | `UserService.php`          |
| Repository     | DB queries (via Eloquent)          | `UserRepository.php`       |
| Model          | Data model with relationships      | `User.php`, `Group.php`    |
| Traits         | Reusable logic                     | `HasPermissions.php`       |
| Views          | Blade templates                    | `resources/views/users/`   |

---

## ⚙️ Setup Instructions (New Machine)

### 1. Clone the Repository

```bash
git clone https://github.com/adilnisar272/User-Management-System.git
cd User-Management-System
```
### 2. Install Backend & Frontend Dependencies

```bash
composer install
npm install
```

### 3. Configure Environment

```bash
cp .env.example .env
php artisan key:generate

```
Edit .env and update your database credentials accordingly.


### 4. Run Migrations & Seeders

```bash
php artisan migrate --seed
```
This command will:

* Create all required tables
* Seed default user groups, permissions
* Create one default Admin user

### 5. Start the Server

```bash
php artisan serve
npm run dev
```
Visit: http://localhost:8000

### 🧪 Default Admin Login
```bash
Email:    admin@example.com
Password: password
```
> You can update credentials in the database or seeders.

### ✅ Modules Completed
* User CRUD (with Form Request Validation)
* Role Management with Permissions
* Unit & Department Assignment
* Admin Dashboard
* Blade UI with Components & Partials
* DataTables with Search, Filter, Pagination
* Fully Laravel 10 Compatible (PHP 8.1+)

## 🧑‍💻 Author
Mohammad Adil Khan | Laravel Developer | PHP Enthusiast

### 📜 License
This project is licensed under the MIT License.

# 📝 Notes
* This is a custom implementation of a Role/Permission system (not using packages like Spatie).
* Policies and Gates are applied on routes and controllers for permission checks.
* If you wish to integrate Spatie later, the structure allows refactoring.
