CREATE DATABASE IF NOT EXISTS movie_booking;
USE movie_booking;

DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS shows;
DROP TABLE IF EXISTS movies;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    genre VARCHAR(80) NOT NULL,
    language VARCHAR(50) NOT NULL,
    duration VARCHAR(30) NOT NULL,
    rating DECIMAL(3,1) DEFAULT 8.0,
    description TEXT NOT NULL,
    poster_color VARCHAR(30) NOT NULL,
    poster_url VARCHAR(500) NOT NULL
);

CREATE TABLE shows (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT NOT NULL,
    show_date DATE NOT NULL,
    show_time TIME NOT NULL,
    screen VARCHAR(30) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    show_id INT NOT NULL,
    seat_number VARCHAR(5) NOT NULL,
    booking_code VARCHAR(30) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    booking_status VARCHAR(30) DEFAULT 'Confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (show_id) REFERENCES shows(id) ON DELETE CASCADE,
    UNIQUE KEY unique_show_seat (show_id, seat_number)
);

INSERT INTO movies(title,genre,language,duration,rating,description,poster_color,poster_url) VALUES
('Interstellar','Sci-Fi','English','2h 49m',8.7,'A team of explorers travels through a wormhole in space in search of a new home for humanity.','#1b263b','https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg'),
('Inception','Sci-Fi / Thriller','English','2h 28m',8.8,'A skilled thief who steals secrets through dreams is given a chance to erase his past with one impossible mission.','#111827','https://image.tmdb.org/t/p/w500/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg'),
('Avengers: Endgame','Action','English','3h 01m',8.4,'The Avengers make one final attempt to undo the devastating events that changed their universe.','#7f1d1d','https://image.tmdb.org/t/p/w500/or06FN3Dka5tukK1e9sl16pB3iy.jpg'),
('Avatar: The Way of Water','Adventure','English','3h 12m',7.6,'The Sully family returns to Pandora and finds a new home among the ocean clans.','#075985','https://image.tmdb.org/t/p/w500/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg'),
('Spider-Man: No Way Home','Action','English','2h 28m',8.2,'Peter Parker faces the consequences of a spell that opens the door to villains from other worlds.','#991b1b','https://image.tmdb.org/t/p/w500/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg'),
('Oppenheimer','Drama','English','3h 00m',8.6,'The story of the scientist whose work helped create the first atomic bomb.','#292524','https://image.tmdb.org/t/p/w500/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg'),
('Dune: Part Two','Sci-Fi','English','2h 46m',8.5,'Paul Atreides unites with Chani and the Fremen while seeking revenge against the conspirators who destroyed his family.','#92400e','https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2CZjjYVvJ.jpg'),
('Top Gun: Maverick','Action','English','2h 11m',8.2,'A legendary pilot returns to train a new generation for a dangerous mission.','#1e3a5f','https://image.tmdb.org/t/p/w500/62HCnUTziyWcpDaBO2i1iT9XZig.jpg'),
('Joker','Crime / Drama','English','2h 02m',8.1,'A troubled man begins a dark transformation that changes the city around him.','#713f12','https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg'),
('Barbie','Comedy','English','1h 54m',6.8,'Barbie leaves her perfect world for an unexpected journey into the real world.','#be185d','https://image.tmdb.org/t/p/w500/iuFNMS8U5cb6xfzi51Dbkovj7vM.jpg'),
('Parasite','Drama / Thriller','Korean','2h 12m',8.5,'A struggling family gradually enters the life of a wealthy household with unexpected consequences.','#365314','https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg'),
('The Batman','Action / Crime','English','2h 56m',7.8,'Batman investigates a series of brutal crimes that expose corruption at the heart of Gotham.','#111827','https://image.tmdb.org/t/p/w500/74xTEgt7R36Fpooo50r9T25onhq.jpg');

INSERT INTO shows(movie_id,show_date,show_time,screen,price) VALUES
(1,DATE_ADD(CURDATE(),INTERVAL 1 DAY),'10:30:00','01',180),(1,DATE_ADD(CURDATE(),INTERVAL 1 DAY),'18:30:00','02',220),
(2,DATE_ADD(CURDATE(),INTERVAL 1 DAY),'13:00:00','02',190),(2,DATE_ADD(CURDATE(),INTERVAL 2 DAY),'20:00:00','03',240),
(3,DATE_ADD(CURDATE(),INTERVAL 1 DAY),'16:00:00','01',200),(3,DATE_ADD(CURDATE(),INTERVAL 3 DAY),'20:30:00','02',240),
(4,DATE_ADD(CURDATE(),INTERVAL 2 DAY),'11:00:00','03',190),(4,DATE_ADD(CURDATE(),INTERVAL 2 DAY),'18:00:00','01',230),
(5,DATE_ADD(CURDATE(),INTERVAL 1 DAY),'14:00:00','02',200),(5,DATE_ADD(CURDATE(),INTERVAL 3 DAY),'19:30:00','03',240),
(6,DATE_ADD(CURDATE(),INTERVAL 2 DAY),'10:00:00','01',180),(6,DATE_ADD(CURDATE(),INTERVAL 4 DAY),'19:00:00','02',220),
(7,DATE_ADD(CURDATE(),INTERVAL 1 DAY),'12:00:00','03',210),(7,DATE_ADD(CURDATE(),INTERVAL 3 DAY),'20:00:00','01',250),
(8,DATE_ADD(CURDATE(),INTERVAL 2 DAY),'15:00:00','02',190),(8,DATE_ADD(CURDATE(),INTERVAL 4 DAY),'21:00:00','03',230),
(9,DATE_ADD(CURDATE(),INTERVAL 1 DAY),'17:30:00','01',180),(9,DATE_ADD(CURDATE(),INTERVAL 3 DAY),'21:15:00','02',220),
(10,DATE_ADD(CURDATE(),INTERVAL 2 DAY),'13:30:00','03',170),(10,DATE_ADD(CURDATE(),INTERVAL 4 DAY),'18:45:00','01',200),
(11,DATE_ADD(CURDATE(),INTERVAL 1 DAY),'11:30:00','02',180),(11,DATE_ADD(CURDATE(),INTERVAL 3 DAY),'19:15:00','03',220),
(12,DATE_ADD(CURDATE(),INTERVAL 2 DAY),'14:30:00','01',190),(12,DATE_ADD(CURDATE(),INTERVAL 4 DAY),'20:15:00','02',230);
