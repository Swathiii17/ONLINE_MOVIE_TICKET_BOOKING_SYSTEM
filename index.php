<?php
session_start();
require_once __DIR__ . '/php/db.php';

$movies = $pdo->query("SELECT * FROM movies ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineBook | Online Movie Ticket Booking</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="navbar">
    <a class="brand" href="index.php"><span>CB</span> CineBook</a>
    <nav>
        <a href="index.php">Home</a>
        <a href="movies.php">Movies</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="my-bookings.php">My Bookings</a>
            <a class="nav-user" href="profile.php"><?= htmlspecialchars($_SESSION['user_name']) ?></a>
            <a href="php/logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a class="btn btn-small" href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

<main>
<section class="hero">
    <div class="hero-content">
        <span class="eyebrow">YOUR MOVIE NIGHT, MADE EASY</span>
        <h1>Book your next<br><span>movie experience.</span></h1>
        <p>Discover movies, choose your show, pick your seats and get your ticket in just a few clicks.</p>
        <div class="hero-actions">
            <a href="movies.php" class="btn">Browse Movies</a>
            <a href="#how-it-works" class="btn btn-ghost">How it works</a>
        </div>
    </div>
    <div class="hero-card">
        <div class="ticket-top">
            <span>CINEBOOK</span><span>001</span>
        </div>
        <div class="ticket-icon">🎬</div>
        <h3>Movie Night</h3>
        <p>Pick a seat. Grab a snack. Enjoy the show.</p>
        <div class="ticket-line"></div>
        <div class="ticket-meta"><span>SCREEN</span><strong>01</strong><span>SEATS</span><strong>A1 A2</strong></div>
    </div>
</section>

<section class="section" id="movies">
    <div class="section-heading">
        <div>
            <span class="eyebrow">NOW SHOWING</span>
            <h2>Popular movies</h2>
        </div>
        <a href="movies.php" class="text-link">View all →</a>
    </div>
    <div class="movie-grid">
        <?php foreach (array_slice($movies, 0, 4) as $movie): ?>
        <article class="movie-card">
            <div class="poster poster-image"><img src="<?= htmlspecialchars($movie['poster_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?> poster" loading="lazy"><div class="poster-overlay"></div><span class="poster-tag"><?= htmlspecialchars($movie['genre']) ?></span><div class="poster-bottom"><div class="poster-title"><?= htmlspecialchars($movie['title']) ?></div><small><?= htmlspecialchars($movie['language']) ?></small></div></div>
            <div class="movie-info">
                <h3><?= htmlspecialchars($movie['title']) ?></h3>
                <p><?= htmlspecialchars($movie['genre']) ?> · <?= htmlspecialchars($movie['duration']) ?></p>
                <a href="movie-details.php?id=<?= $movie['id'] ?>" class="btn btn-small full">Book now</a>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="how section" id="how-it-works">
    <div class="section-heading">
        <div><span class="eyebrow">SIMPLE PROCESS</span><h2>Book in 4 easy steps</h2></div>
    </div>
    <div class="steps">
        <div class="step"><b>01</b><h3>Choose a movie</h3><p>Explore the movies currently available.</p></div>
        <div class="step"><b>02</b><h3>Select a show</h3><p>Pick a convenient date and show time.</p></div>
        <div class="step"><b>03</b><h3>Pick your seats</h3><p>Select your preferred available seats.</p></div>
        <div class="step"><b>04</b><h3>Get your ticket</h3><p>Confirm your booking and view the ticket.</p></div>
    </div>
</section>
</main>

<footer><div><strong>CineBook</strong> — Online Movie Ticket Booking System</div><div>© 2026 CineBook</div></footer>
<script src="js/script.js"></script>
</body>
</html>