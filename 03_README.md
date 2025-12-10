# PHP MVC Salamander Project

This project is a lightweight MVC (Model--View--Controller) framework
built in PHP for instructional purposes.\
Students use it to learn routing, controllers, models, database access,
and secure configuration practices.

------------------------------------------------------------------------

## 1. Project Structure

The project uses a clean, modern MVC layout:

    project-root/
    ├── config/              # Configuration files (non-public)
    │   └── db_credentials.php
    ├── public/              # Web root (only folder exposed to the browser)
    │   └── index.php        # Front controller (entry point)
    ├── src/
    │   ├── Controllers/
    │   ├── Models/
    │   ├── Views/
    │   └── Database.php     # Database connection class
    ├── vendor/              # Composer dependencies
    ├── .env                 # Environment variables (ignored by Git)
    └── .env.example         # Template env file students commit

The `public/` folder is the document root --- all HTTP requests flow
through\
`public/index.php`, which initializes routing and loads controllers.

------------------------------------------------------------------------

## 2. Protecting Credentials with `.env` and `.gitignore`

Your database credentials must **never** be stored directly in the
repository.

### Create a `.env` file (NOT committed)

Create this file at the project root:

    DB_HOST=localhost
    DB_NAME=salamanders
    DB_USER=root
    DB_PASS=root
    DB_CHARSET=utf8mb4

### Create `.env.example` for Git

This file *is* committed and shows others what variables they need:

    DB_HOST=localhost
    DB_NAME=your_database_name
    DB_USER=your_username
    DB_PASS=your_password
    DB_CHARSET=utf8mb4

### `.gitignore` protects real secrets

Make sure `.gitignore` contains:

    .env
    .env.*
    !.env.example
    vendor/

Your `public/index.php` loads the variables using **phpdotenv**:

``` php
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
```

`config/db_credentials.php` then reads values from `$_ENV`.

------------------------------------------------------------------------

## 3. Installing Dependencies

This project uses Composer for autoloading and environment handling.

Install dependencies from the project root:

``` bash
composer install
```

Or if you haven't yet required phpdotenv:

``` bash
composer require vlucas/phpdotenv
```

After installation, ensure `vendor/` exists --- this folder **should
not** be committed if you're sharing your repo with students (Composer
will create it on their machines).

------------------------------------------------------------------------

## 4. Running the MVC App Using PHP's Built-In Server

You can run the project without MAMP/XAMPP using:

``` bash
php -S localhost:8000 -t public
```

Then visit:

    http://localhost:8000

This works because:

-   `public/` is the document root\
-   `public/index.php` is the single entry point\
-   Your custom router handles all other paths (`/`, `/home`, `/about`,
    etc.)

------------------------------------------------------------------------

## Summary

This project teaches students how a real MVC workflow functions in PHP
while also following modern, secure practices:

-   `public/` as the web root\
-   Secure database credentials using `.env`\
-   Composer for autoloading\
-   MVC folder structure that scales\
-   Built-in PHP dev server for easy local testing

------------------------------------------------------------------------
