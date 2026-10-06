USE movie_booking;

ALTER TABLE movies ADD COLUMN poster_url VARCHAR(500) NOT NULL DEFAULT '';

UPDATE movies SET title='Interstellar',genre='Sci-Fi',language='English',duration='2h 49m',rating=8.7,description='A team of explorers travels through a wormhole in space in search of a new home for humanity.',poster_color='#1b263b',poster_url='https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg' WHERE id=1;
UPDATE movies SET title='Inception',genre='Sci-Fi / Thriller',language='English',duration='2h 28m',rating=8.8,description='A skilled thief who steals secrets through dreams is given a chance to erase his past with one impossible mission.',poster_color='#111827',poster_url='https://image.tmdb.org/t/p/w500/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg' WHERE id=2;
UPDATE movies SET title='Avengers: Endgame',genre='Action',language='English',duration='3h 01m',rating=8.4,description='The Avengers make one final attempt to undo the devastating events that changed their universe.',poster_color='#7f1d1d',poster_url='https://image.tmdb.org/t/p/w500/or06FN3Dka5tukK1e9sl16pB3iy.jpg' WHERE id=3;
UPDATE movies SET title='Avatar: The Way of Water',genre='Adventure',language='English',duration='3h 12m',rating=7.6,description='The Sully family returns to Pandora and finds a new home among the ocean clans.',poster_color='#075985',poster_url='https://image.tmdb.org/t/p/w500/t6HIqrRAclMCA60NsSmeqe9RmNV.jpg' WHERE id=4;
UPDATE movies SET title='Spider-Man: No Way Home',genre='Action',language='English',duration='2h 28m',rating=8.2,description='Peter Parker faces the consequences of a spell that opens the door to villains from other worlds.',poster_color='#991b1b',poster_url='https://image.tmdb.org/t/p/w500/1g0dhYtq4irTY1GPXvft6k4YLjm.jpg' WHERE id=5;
UPDATE movies SET title='Oppenheimer',genre='Drama',language='English',duration='3h 00m',rating=8.6,description='The story of the scientist whose work helped create the first atomic bomb.',poster_color='#292524',poster_url='https://image.tmdb.org/t/p/w500/8Gxv8gSFCU0XGDykEGv7zR1n2ua.jpg' WHERE id=6;

INSERT INTO movies(title,genre,language,duration,rating,description,poster_color,poster_url) SELECT * FROM (
SELECT 'Dune: Part Two','Sci-Fi','English','2h 46m',8.5,'Paul Atreides unites with Chani and the Fremen while seeking revenge against the conspirators who destroyed his family.','#92400e','https://image.tmdb.org/t/p/w500/1pdfLvkbY9ohJlCjQH2CZjjYVvJ.jpg' UNION ALL
SELECT 'Top Gun: Maverick','Action','English','2h 11m',8.2,'A legendary pilot returns to train a new generation for a dangerous mission.','#1e3a5f','https://image.tmdb.org/t/p/w500/62HCnUTziyWcpDaBO2i1iT9XZig.jpg' UNION ALL
SELECT 'Joker','Crime / Drama','English','2h 02m',8.1,'A troubled man begins a dark transformation that changes the city around him.','#713f12','https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg' UNION ALL
SELECT 'Barbie','Comedy','English','1h 54m',6.8,'Barbie leaves her perfect world for an unexpected journey into the real world.','#be185d','https://image.tmdb.org/t/p/w500/iuFNMS8U5cb6xfzi51Dbkovj7vM.jpg' UNION ALL
SELECT 'Parasite','Drama / Thriller','Korean','2h 12m',8.5,'A struggling family gradually enters the life of a wealthy household with unexpected consequences.','#365314','https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg' UNION ALL
SELECT 'The Batman','Action / Crime','English','2h 56m',7.8,'Batman investigates a series of brutal crimes that expose corruption at the heart of Gotham.','#111827','https://image.tmdb.org/t/p/w500/74xTEgt7R36Fpooo50r9T25onhq.jpg'
) AS new_movies
WHERE NOT EXISTS (SELECT 1 FROM movies WHERE title=new_movies.title);

INSERT INTO shows(movie_id,show_date,show_time,screen,price) SELECT m.id,DATE_ADD(CURDATE(),INTERVAL d.day_offset DAY),d.show_time,d.screen,d.price FROM movies m JOIN (
SELECT 'Dune: Part Two' title,1 day_offset,'12:00:00' show_time,'03' screen,210 price UNION ALL SELECT 'Dune: Part Two',3,'20:00:00','01',250 UNION ALL
SELECT 'Top Gun: Maverick',2,'15:00:00','02',190 UNION ALL SELECT 'Top Gun: Maverick',4,'21:00:00','03',230 UNION ALL
SELECT 'Joker',1,'17:30:00','01',180 UNION ALL SELECT 'Joker',3,'21:15:00','02',220 UNION ALL
SELECT 'Barbie',2,'13:30:00','03',170 UNION ALL SELECT 'Barbie',4,'18:45:00','01',200 UNION ALL
SELECT 'Parasite',1,'11:30:00','02',180 UNION ALL SELECT 'Parasite',3,'19:15:00','03',220 UNION ALL
SELECT 'The Batman',2,'14:30:00','01',190 UNION ALL SELECT 'The Batman',4,'20:15:00','02',230
) d ON d.title=m.title WHERE NOT EXISTS (SELECT 1 FROM shows s WHERE s.movie_id=m.id AND s.show_date=DATE_ADD(CURDATE(),INTERVAL d.day_offset DAY) AND s.show_time=d.show_time);
