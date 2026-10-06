<?php
session_start(); require_once __DIR__ . '/php/db.php';
if(!isset($_SESSION['user_id'])){header("Location: login.php");exit;}
$code=preg_replace('/[^A-Z0-9]/','',strtoupper($_GET['code'] ?? ''));
$stmt=$pdo->prepare("SELECT b.*,m.title,s.show_date,s.show_time,s.screen FROM bookings b JOIN shows s ON s.id=b.show_id JOIN movies m ON m.id=s.movie_id WHERE b.booking_code=? AND b.user_id=?");
$stmt->execute([$code,$_SESSION['user_id']]); $b=$stmt->fetch();
if(!$b){header("Location: my-bookings.php");exit;}
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Booking Confirmed | CineBook</title><link rel="stylesheet" href="css/style.css"></head>
<body><header class="navbar"><a class="brand" href="index.php"><span>CB</span> CineBook</a><nav><a href="index.php">Home</a><a href="movies.php">Movies</a><a href="my-bookings.php">My Bookings</a><a href="php/logout.php">Logout</a></nav></header>
<main class="page"><div class="confirmation"><div class="success-icon">✓</div><span class="eyebrow">BOOKING CONFIRMED</span><h1>Your movie ticket is ready!</h1><p>Show this booking code at the cinema counter.</p>
<div class="ticket"><div><small>BOOKING CODE</small><strong><?= htmlspecialchars($b['booking_code']) ?></strong></div><div class="ticket-divider"></div><div class="ticket-grid"><div><small>MOVIE</small><strong><?= htmlspecialchars($b['title']) ?></strong></div><div><small>DATE & TIME</small><strong><?= date('d M Y',strtotime($b['show_date'])) ?> · <?= date('h:i A',strtotime($b['show_time'])) ?></strong></div><div><small>SCREEN</small><strong><?= htmlspecialchars($b['screen']) ?></strong></div><div><small>SEAT</small><strong><?= htmlspecialchars($b['seat_number']) ?></strong></div></div><div class="ticket-total"><span>Total paid</span><strong>₹<?= number_format($b['total_amount'],2) ?></strong></div></div>
<div class="hero-actions centered-actions"><a class="btn" href="my-bookings.php">My bookings</a><a class="btn btn-ghost" href="movies.php">Book another</a></div></div></main><footer><div><strong>CineBook</strong> — Online Movie Ticket Booking System</div><div>© 2026 CineBook</div></footer></body></html>