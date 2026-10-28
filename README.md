# Student Management API

A RESTful Student Management API built with **Laravel 13**, featuring token-based authentication, role-based access control, and validation using Laravel Form Requests.

## Features

- **Authentication:** User registration and login using Laravel Sanctum.
- **Token-based security:** Protected API endpoints require a valid Bearer token.
- **Role-based permissions:** Admins can create, view, update, and delete records; regular users have view-only access.
- **Student Management:** CRUD operations for students.
- **Course Management:** CRUD operations for courses.
- **Enrollment Management:** Manage student-course enrollments with relationships.
- **Form Request Validation:** Separate validation classes for storing and updating students, courses, and enrollments.
- **Password Reset:** Forgot-password and password-reset functionality.
- **Welcome Email:** Email notification functionality.
- **API Testing:** Endpoints tested using Postman.

## Technologies Used

- PHP
- Laravel 13
- MySQL
- Laravel Sanctum
- Spatie Laravel Permission
- Laravel Form Requests
- Postman

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/StudentAPI.git
cd StudentAPI
```

Replace `YOUR_USERNAME` with your GitHub username.

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Configure environment

Create your local environment file:

```bash
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the database

Create a MySQL database in phpMyAdmin, then update these values in your local `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

Use the database credentials configured on your own computer.

### 5. Run migrations and seed roles

```bash
php artisan migrate
php artisan db:seed --class=RolePermissionSeeder
```

Run the seeder command if it is not already executed automatically by your project setup.

### 6. Start the Laravel server

```bash
php artisan serve
```

The API will normally be available at:

`http://127.0.0.1:8000`

## Authentication

Register or log in to obtain an authentication token. For protected endpoints, select **Authorization → Bearer Token** in Postman and enter the token returned by the login endpoint.

Example header:

```http
Authorization: Bearer YOUR_ACCESS_TOKEN
Accept: application/json
```

Requests without a valid token should not be able to access protected endpoints.

## Main API Endpoints

| Method | Endpoint | Purpose |
|---|---|---|
| POST | `/api/register` | Register a user |
| POST | `/api/login` | Log in and obtain a token |
| POST | `/api/logout` | Log out |
| GET | `/api/students` | List students |
| POST | `/api/students` | Create a student |
| GET | `/api/students/{id}` | View a student |
| PUT/PATCH | `/api/students/{id}` | Update a student |
| DELETE | `/api/students/{id}` | Delete a student |
| GET | `/api/courses` | List courses |
| POST | `/api/courses` | Create a course |
| GET | `/api/courses/{id}` | View a course |
| PUT/PATCH | `/api/courses/{id}` | Update a course |
| DELETE | `/api/courses/{id}` | Delete a course |
| GET | `/api/enrollments` | List enrollments |
| POST | `/api/enrollments` | Create an enrollment |
| GET | `/api/enrollments/{id}` | View an enrollment |
| PUT/PATCH | `/api/enrollments/{id}` | Update an enrollment |
| DELETE | `/api/enrollments/{id}` | Delete an enrollment |

Protected endpoints require a valid Bearer token. Admin-only operations require the appropriate permissions. Verify endpoint methods and access rules against `routes/api.php` in this project.

## Validation

Dedicated Laravel Form Request classes handle validation:

- `StoreStudentRequest`
- `UpdateStudentRequest`
- `StoreCourseRequest`
- `UpdateCourseRequest`
- `StoreEnrollmentRequest`
- `UpdateEnrollmentRequest`

This keeps validation logic separate from controller methods.

## Testing

The API endpoints were tested using Postman, including authentication, CRUD operations, token-based access, and role-based permissions.

## Security Notes

- Keep your `.env` file private.
- Never commit real passwords, API keys, mail credentials, or access tokens.
- Use `.env.example` to document environment variables without exposing secrets.

## Author

Ema Shahzad

