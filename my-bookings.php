<?php
session_start(); require_once __DIR__ . '/php/db.php';
if(!isset($_SESSION['user_id'])){header("Location: login.php");exit;}
$stmt=$pdo->prepare("SELECT b.*, m.title, s.show_date, s.show_time, s.screen FROM bookings b JOIN shows s ON s.id=b.show_id JOIN movies m ON m.id=s.movie_id WHERE b.user_id=? ORDER BY b.created_at DESC");
$stmt->execute([$_SESSION['user_id']]); $bookings=$stmt->fetchAll();
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>My Bookings | CineBook</title><link rel="stylesheet" href="css/style.css"></head>
<body><header class="navbar"><a class="brand" href="index.php"><span>CB</span> CineBook</a><nav><a href="index.php">Home</a><a href="movies.php">Movies</a><a class="active" href="my-bookings.php">My Bookings</a><a href="php/logout.php">Logout</a></nav></header>
<main class="page"><div class="page-title"><span class="eyebrow">YOUR TICKETS</span><h1>My bookings</h1><p>All your confirmed movie tickets in one place.</p></div>
<?php if(!$bookings): ?><div class="empty"><div>🎟️</div><h2>No bookings yet</h2><p>Choose a movie and book your first ticket.</p><a class="btn" href="movies.php">Browse Movies</a></div>
<?php else: ?><div class="booking-list"><?php foreach($bookings as $b): ?><div class="booking-card"><div><span class="eyebrow">BOOKING #<?= htmlspecialchars($b['booking_code']) ?></span><h2><?= htmlspecialchars($b['title']) ?></h2><p><?= date('d M Y',strtotime($b['show_date'])) ?> · <?= date('h:i A',strtotime($b['show_time'])) ?> · Screen <?= htmlspecialchars($b['screen']) ?></p></div><div class="booking-right"><strong><?= htmlspecialchars($b['seat_number']) ?></strong><span>₹<?= number_format($b['total_amount'],2) ?></span><span class="status">Confirmed</span></div></div><?php endforeach; ?></div><?php endif;?>
</main><footer><div><strong>CineBook</strong> — Online Movie Ticket Booking System</div><div>© 2026 CineBook</div></footer></body></html>