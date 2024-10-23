# Basic-Hotel-System---PHP-MVC-Framework
This is a basic version of Hotel System - PHP MVC Framework.

## Description
A web application built with PHP and a basic custom MVC framework for managing hotel reservations. This system allows users to search for available rooms, make reservations, and manage their bookings. The admin panel provides features for room management and viewing reservations.

## Features
- User registration and login
- Room reservation management
- Admin panel for creating, editing rooms, and viewing all reservations
- Search and filter functionality for users to find rooms easily

## Requirements
- PHP (7.4 or higher)
- MySQL
- Composer
- A local server environment - in my case XAMPP

## Setup Instructions
1. Clone the repository
2. Navigate to the project directory
3. Install dependencies (If you already have Composer installed), run the following command to install dependencies:
   "composer install"
4. Set up Database:
   - Create database named "hotel" - I'm using MySQL server from XAMPP
   - Use this SQL code to create the tables:
     ##User table:
     
     CREATE TABLE `users` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `email` VARCHAR(100) NOT NULL UNIQUE,
      `password` VARCHAR(255) NOT NULL
    );

     ##Rooms table:
     CREATE TABLE `rooms` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `room_type` VARCHAR(50) NOT NULL,
        `price` DECIMAL(10, 2) NOT NULL,
        `is_reserved` BOOLEAN DEFAULT 0,
        `reserved_by` INT DEFAULT NULL,
        FOREIGN KEY (reserved_by) REFERENCES users(id)
    );

    ##Insert some rooms:
    INSERT INTO rooms (room_type, price, is_reserved) VALUES
    ('Single Room', 50, 0),
    ('Double Room', 80, 0),
    ('Suite', 120, 0),
    ('Family Room', 100, 0),
    ('Single Room', 80, 0),
    ('Double Room', 97, 0),
    ('Suite', 150, 0),
    ('Family Room', 114, 0);

5. Ensure that the database connection is correctly set up in app/models/UserModel.php and app/models/RoomModel.php - PDO connection settings should match your database credentials
6. Set up environment variables:
   - Create a .env file in the root directory of your project
   - Add the following configuration (adjust according to your setup):
     DB_HOST=localhost
     DB_NAME=hotel
     DB_USER=root
     DB_PASS=
7. Run the application
   - Start your local server (XAMPP)
   - Access the application in your browser - (In my case: http://localhost/hotel-reservation/public/index.php), in your maybe it will be (http://localhost/Basic-Hotel-System---PHP-MVC-Framework/public/index.php)
  
## Usage
- User Registration: Go to the registration page and create a new account. (http://localhost/Basic-Hotel-System---PHP-MVC-Framework/public/index.php/register)
- Login: Use your registered credentials to log in. (http://localhost/Basic-Hotel-System---PHP-MVC-Framework/public/index.php/login)
- Room Reservation: Search for available rooms and make reservations.
- Admin Panel: Access the admin panel by logging in with the following credentials:
    Email: admin@admin.com
    Password: admin123

