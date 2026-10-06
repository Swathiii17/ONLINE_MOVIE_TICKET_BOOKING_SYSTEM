# CineBook — Online Movie Ticket Booking System

A clean and beginner-friendly Internet Programming mini project built using PHP, MySQL, HTML, CSS and JavaScript.

## Features
- User registration and login
- Movie listing and details
- Show/date/time selection
- Interactive seat selection
- Booking confirmation
- My Bookings page
- Profile page
- MySQL database

## Requirements
- XAMPP
- Apache
- MySQL
- PHP 8+ recommended
- VS Code (optional)

## Setup

1. Copy the `Online-Movie-Ticket-Booking` folder into:
   `C:\xampp\htdocs\`

2. Start **Apache** from XAMPP. If MySQL is already installed as a Windows service (for example MySQL80), it can be used instead of XAMPP MySQL.

3. Open phpMyAdmin:
   `http://localhost/phpmyadmin/`

4. Database setup:
   - For a fresh database, import `database/movie_booking.sql`.
   - If you already have the original CineBook database and want to keep existing users/bookings, import `database/update_movie_posters.sql` instead.
   - Movie posters are loaded from TMDB image URLs, so the browser needs internet access to display them.

5. Open:
   `http://localhost/Online-Movie-Ticket-Booking/`

6. Register a new account and start booking.

## Database settings
Default XAMPP settings are used:
- Host: localhost
- Database: movie_booking
- Username: root
- Password: empty

If your MySQL password is different, edit `php/db.php`.

## Project flow
Home → Register/Login → Movies → Movie Details → Select Show → Select Seats → Confirm Booking → Ticket

## Notes
This project intentionally uses a simulated booking confirmation rather than a real payment gateway, making it suitable for a college mini project and local demonstration.
