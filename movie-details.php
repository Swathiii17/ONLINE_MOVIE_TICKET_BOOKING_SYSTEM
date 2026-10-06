<?php
session_start();
require_once __DIR__ . '/php/db.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch();
if (!$movie) { header("Location: movies.php"); exit; }
$shows = $pdo->prepare("SELECT * FROM shows WHERE movie_id = ? ORDER BY show_date, show_time");
$shows->execute([$movie['id']]);
$shows = $shows->fetchAll();
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($movie['title']) ?> | CineBook</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<header class="navbar"><a class="brand" href="index.php"><span>CB</span> CineBook</a><nav><a href="index.php">Home</a><a href="movies.php">Movies</a><?php if(isset($_SESSION['user_id'])):?><a href="my-bookings.php">My Bookings</a><a href="php/logout.php">Logout</a><?php else:?><a href="login.php">Login</a><a class="btn btn-small" href="register.php">Register</a><?php endif;?></nav></header>
<main class="page">
<div class="detail-layout">
<div class="poster poster-large poster-image"><img src="<?= htmlspecialchars($movie['poster_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?> poster"><div class="poster-overlay"></div><span class="poster-tag"><?= htmlspecialchars($movie['genre']) ?></span><div class="poster-bottom"><div class="poster-title"><?= htmlspecialchars($movie['title']) ?></div><small><?= htmlspecialchars($movie['language']) ?></small></div></div>
<div class="detail-copy"><span class="eyebrow"><?= htmlspecialchars($movie['language']) ?> · <?= htmlspecialchars($movie['duration']) ?></span><h1><?= htmlspecialchars($movie['title']) ?></h1><p><?= htmlspecialchars($movie['description']) ?></p>
<div class="facts"><div><small>Genre</small><strong><?= htmlspecialchars($movie['genre']) ?></strong></div><div><small>Duration</small><strong><?= htmlspecialchars($movie['duration']) ?></strong></div><div><small>Rating</small><strong><?= htmlspecialchars($movie['rating']) ?>/10</strong></div></div>
<h2>Choose a show</h2>
<div class="show-list"><?php foreach($shows as $show): ?><a class="show-chip" href="booking.php?show_id=<?= $show['id'] ?>"><strong><?= date('d M', strtotime($show['show_date'])) ?></strong><span><?= date('h:i A', strtotime($show['show_time'])) ?></span><small>Screen <?= htmlspecialchars($show['screen']) ?> · ₹<?= number_format($show['price'],2) ?></small></a><?php endforeach; ?></div>
<?php if(!$shows): ?><div class="notice">No shows are currently available for this movie.</div><?php endif; ?>
</div></div></main><footer><div><strong>CineBook</strong> — Online Movie Ticket Booking System</div><div>© 2026 CineBook</div></footer>
</body></html>