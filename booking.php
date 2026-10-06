<?php
session_start();
require_once __DIR__ . '/php/db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php?redirect=booking.php"); exit; }
$show_id = filter_input(INPUT_GET, 'show_id', FILTER_VALIDATE_INT);
$stmt = $pdo->prepare("SELECT s.*, m.title, m.poster_color FROM shows s JOIN movies m ON m.id=s.movie_id WHERE s.id=?");
$stmt->execute([$show_id]); $show=$stmt->fetch();
if(!$show){ header("Location: movies.php"); exit; }

$stmt=$pdo->prepare("SELECT seat_number FROM bookings WHERE show_id=? AND booking_status='Confirmed'");
$stmt->execute([$show_id]); $booked=array_column($stmt->fetchAll(), 'seat_number');
$rows=['A','B','C','D','E','F']; $seat_count=0;
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Select Seats | CineBook</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<header class="navbar"><a class="brand" href="index.php"><span>CB</span> CineBook</a><nav><a href="movies.php">Movies</a><a href="my-bookings.php">My Bookings</a><a href="php/logout.php">Logout</a></nav></header>
<main class="page">
<div class="booking-header"><div><span class="eyebrow">SELECT YOUR SEATS</span><h1><?= htmlspecialchars($show['title']) ?></h1><p><?= date('d M Y',strtotime($show['show_date'])) ?> · <?= date('h:i A',strtotime($show['show_time'])) ?> · Screen <?= htmlspecialchars($show['screen']) ?></p></div><a href="movie-details.php?id=<?= $show['movie_id'] ?>" class="text-link">← Change show</a></div>
<form method="post" action="php/book_ticket.php" id="bookingForm">
<input type="hidden" name="show_id" value="<?= $show['id'] ?>">
<div class="seat-layout">
<div class="screen">SCREEN</div>
<div class="seats">
<?php foreach($rows as $row): ?><div class="seat-row"><span class="row-label"><?= $row ?></span><?php for($n=1;$n<=8;$n++): $seat=$row.$n; $isBooked=in_array($seat,$booked); $seat_count++; ?>
<label class="seat <?= $isBooked?'booked':'' ?>"><input type="checkbox" name="seats[]" value="<?= $seat ?>" <?= $isBooked?'disabled':'' ?>><span><?= $n ?></span></label>
<?php endfor; ?></div><?php endforeach; ?>
</div>
<div class="seat-legend"><span><i class="legend available"></i> Available</span><span><i class="legend selected"></i> Selected</span><span><i class="legend booked"></i> Booked</span></div>
</div>
<aside class="booking-summary"><h2>Booking summary</h2><div class="summary-row"><span>Movie</span><strong><?= htmlspecialchars($show['title']) ?></strong></div><div class="summary-row"><span>Show</span><strong><?= date('d M',strtotime($show['show_date'])) ?> · <?= date('h:i A',strtotime($show['show_time'])) ?></strong></div><div class="summary-row"><span>Seats</span><strong id="selectedSeats">None</strong></div><div class="summary-row total"><span>Total</span><strong>₹<span id="totalPrice">0.00</span></strong></div><button class="btn full" type="submit">Confirm Booking</button><p class="small-note">Select at least one available seat.</p></aside>
</form></main>
<footer><div><strong>CineBook</strong> — Online Movie Ticket Booking System</div><div>© 2026 CineBook</div></footer>
<script>window.ticketPrice=<?= json_encode((float)$show['price']) ?>;</script><script src="js/script.js"></script>
</body></html>