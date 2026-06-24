# Course Management

A Laravel application for managing courses, students, and student course enrollments from a simple administrative dashboard.

## Features

- Course listing with pagination
- Create, edit, and delete courses
- Student listing with pagination
- Create, edit, and delete students
- Assign courses to students using an enrollment checklist
- Responsive Blade interface styled with Tailwind CSS
- Seeded development data for courses, students, and enrollments

## Requirements

- PHP 8.3 or later
- Composer
- Node.js and npm
- A supported database such as MySQL

## Setup

1. Clone the repository and enter the project directory:

   ```bash
   git clone https://github.com/SujalMainali/Laravel---Student-Course-Management-.git
   cd Laravel---Student-Course-Management-
   ```

2. Install the PHP dependencies:

   ```bash
   composer install
   ```

3. Create the environment file:

   ```bash
   cp .env.example .env
   ```

4. Generate the application key:

   ```bash
   php artisan key:generate
   ```

5. Create a valid database for the application using MySQL or another supported database system.

6. Fill in the database configuration in `.env` with the correct database name and credentials:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=course_management
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```

   The database must already exist before running the migrations.

7. Run the migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

8. Install and build the frontend dependencies:

   ```bash
   npm install
   npm run build
   ```

9. Start the application:

   ```bash
   composer run dev
   ```

Open the URL shown by Laravel, usually `http://127.0.0.1:8000`.


## Main Routes

| URL | Purpose |
| --- | --- |
| `/manage` | Management dashboard |
| `/courses` | Course listing |
| `/courses/create` | Create a course |
| `/students` | Student listing |
| `/students/create` | Create a student |
| `/students/{student}/courses` | Manage a student's course enrollments |

