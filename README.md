# Web App Project

## Setup Instructions

### Requirements:

-   PHP (version 7.x or higher)
-   Composer
-   MySQL or a compatible database
-   Laravel

### Steps to Setup the Project

1. **Clone the repository:**
   git clone https://github.com/loretaimerii/webApp.git
   cd webApp

2. **Install dependencies: Use Composer to install all required packages:**
   composer install

3. **Configure environment variables: Copy the .env.example file to .env:**
   cp .env.example .env

4. **Generate application key: Run the following command to generate an application key:**
   php artisan key:generate

5. **Set up the database: Run the migrations to create the necessary database tables:**
   php artisan migrate

6. **Run the application: Start the application locally using:**
   php artisan serve

### Project Structure

app/: Contains the application's core logic, including models and controllers.
resources/views/: Contains the Blade template views for rendering the HTML.
routes/web.php: Defines the routes for the application (e.g., home, profile, login).
database/migrations/: Contains the migration files used to create and update the database schema.

### Features implemented

1. Authentication
   User registration
   User login and logout
   Laravel's built-in authentication via Laravel Breeze
   Session-based access control

2. Post Management
   Authenticated users can: create new posts, view a list of all posts, delete only their own posts

3. User Profile Page
   Each user has a dedicated profile page and can modify their personal data

4. Homepage
   Lists all posts from all users
   Each post has: a title, body content, name of the creator and timestamps

5. Pagination
   Posts should be displayed in a paginated table
   Show 5 posts per page

### Notes

Make sure to update the .env file with your correct database configuration before running the migrations.
This project uses Laravel's built-in authentication system and blade templating engine for dynamic content rendering.
The app is designed to handle user profiles, allowing users to update their details and view posts dynamically.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
