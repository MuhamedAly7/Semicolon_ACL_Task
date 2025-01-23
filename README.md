# Semicolon ACL Task

This is a Laravel-based project for managing users and roles using ACL (Access Control List). Follow the steps below to set up and run the project locally.

## Prerequisites

-   PHP >= 8.0
-   Composer
-   MySQL database
-   Git

## Installation Steps

1. Clone the repository:

    ```bash
    git clone git@github.com:MuhamedAly7/Semicolon_ACL_Task.git
    ```

2. Navigate to the project directory:

    ```bash
    cd Semicolon_ACL_Task/
    ```

3. Copy the example environment file:

    ```bash
    cp .env.example .env
    ```

4. Open the `.env` file and update the database configuration based on your MySQL credentials:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=semicolon_co_task
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Install the dependencies:

    ```bash
    composer install
    ```

6. Run the database migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

7. Generate the application key:

    ```bash
    php artisan key:generate
    ```

8. Start the local development server:

    ```bash
    php artisan serve
    ```

9. Open the application in your browser:
   [http://localhost:8000](http://localhost:8000)

## Admin Credentials

-   **Email**: admin@admin.com
-   **Password**: password123

## User Credentials

A default user is also provided:

-   **Email**: user@example.com
-   **Password**: password

## Notes

-   Once logged in as an admin, you can create additional users.
-   Ensure your MySQL server is running before proceeding with the installation.
