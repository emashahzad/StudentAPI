# Student Management API

This is a Laravel API project I built to practice API development, authentication, permissions, and validation.

The project manages students, courses, and enrollments. I used Postman to test the API endpoints and check how authentication and permissions work.

## Features

- User registration and login
- Laravel Sanctum for token-based authentication
- Admin and user roles using Spatie Laravel Permission
- CRUD operations for students, courses, and enrollments
- Form Request classes for validation
- Forgot-password and reset-password functionality
- Welcome email functionality

## Technologies

- PHP
- Laravel 13
- MySQL
- Laravel Sanctum
- Spatie Laravel Permission
- Postman

## Installation and Setup

### 1. Clone the repository

```bash
git clone https://github.com/emashahzad/StudentAPI.git
cd StudentAPI
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Set up the environment

Create a local `.env` file:

```bash
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the database

Create a MySQL database in phpMyAdmin. Update the database settings in your `.env` file according to your local setup.

Example:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studentapi
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run migrations

```bash
php artisan migrate
```

Seed the roles and permissions if your project uses the `RolePermissionSeeder`:

```bash
php artisan db:seed --class=RolePermissionSeeder
```

### 6. Start the server

```bash
php artisan serve
```

The local server will usually run at:

`http://127.0.0.1:8000`

## API Authentication

I used Laravel Sanctum to protect the API endpoints.

1. Register a user or log in using Postman.
2. Copy the token returned after login.
3. Open the Authorization tab in Postman.
4. Select **Bearer Token** and paste the token.
5. Send requests to protected endpoints.

Protected routes should reject requests that do not have a valid token.

## API Resources

The project includes three main resources:

- **Students:** Create, view, update, and delete student records.
- **Courses:** Manage course records.
- **Enrollments:** Manage the relationship between students and courses.

The available endpoints and HTTP methods can be checked in `routes/api.php`.

## Form Request Validation

I moved validation rules into separate Form Request classes instead of keeping them directly in the controllers.

The classes are:

- `StoreStudentRequest`
- `UpdateStudentRequest`
- `StoreCourseRequest`
- `UpdateCourseRequest`
- `StoreEnrollmentRequest`
- `UpdateEnrollmentRequest`

This makes the validation code easier to organize and maintain.

## Testing

I used Postman to test registration, login, token-based authentication, and CRUD operations for students, courses, and enrollments. I also worked on role-based access using Spatie Laravel Permission.

## What I Learned

While building this project, I practised working with REST APIs, database relationships, Sanctum authentication, role-based permissions, Form Request validation, and API testing with Postman.

## Author

Ema Shahzad

GitHub: https://github.com/emashahzad