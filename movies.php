<?php
session_start();
require_once __DIR__ . '/php/db.php';
$movies = $pdo->query("SELECT * FROM movies ORDER BY title")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Movies | CineBook</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<header class="navbar"><a class="brand" href="index.php"><span>CB</span> CineBook</a><nav>
<a href="index.php">Home</a><a class="active" href="movies.php">Movies</a>
<?php if(isset($_SESSION['user_id'])): ?><a href="my-bookings.php">My Bookings</a><a class="nav-user"><?= htmlspecialchars($_SESSION['user_name']) ?></a><a href="php/logout.php">Logout</a>
<?php else: ?><a href="login.php">Login</a><a class="btn btn-small" href="register.php">Register</a><?php endif; ?>
</nav></header>
<main class="page">
<div class="page-title"><span class="eyebrow">CINEBOOK COLLECTION</span><h1>Movies</h1><p>Choose something you would love to watch.</p></div>
<div class="movie-grid movie-grid-wide">
<?php foreach($movies as $movie): ?>
<article class="movie-card">
<div class="poster poster-image"><img src="<?= htmlspecialchars($movie['poster_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?> poster" loading="lazy"><div class="poster-overlay"></div><span class="poster-tag"><?= htmlspecialchars($movie['genre']) ?></span><div class="poster-bottom"><div class="poster-title"><?= htmlspecialchars($movie['title']) ?></div><small><?= htmlspecialchars($movie['language']) ?></small></div></div>
<div class="movie-info"><h3><?= htmlspecialchars($movie['title']) ?></h3><p><?= htmlspecialchars($movie['genre']) ?> · <?= htmlspecialchars($movie['duration']) ?> · <?= htmlspecialchars($movie['language']) ?></p><a href="movie-details.php?id=<?= $movie['id'] ?>" class="btn btn-small full">View & Book</a></div>
</article>
<?php endforeach; ?>
</div></main><footer><div><strong>CineBook</strong> — Online Movie Ticket Booking System</div><div>© 2026 CineBook</div></footer>
</body></html>