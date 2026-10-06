<?php
session_start(); require_once __DIR__ . '/php/db.php';
if(!isset($_SESSION['user_id'])){header("Location: login.php");exit;}
$stmt=$pdo->prepare("SELECT name,email,created_at FROM users WHERE id=?"); $stmt->execute([$_SESSION['user_id']]); $u=$stmt->fetch();
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Profile | CineBook</title><link rel="stylesheet" href="css/style.css"></head>
<body><header class="navbar"><a class="brand" href="index.php"><span>CB</span> CineBook</a><nav><a href="index.php">Home</a><a href="movies.php">Movies</a><a href="my-bookings.php">My Bookings</a><a href="php/logout.php">Logout</a></nav></header>
<main class="page"><div class="page-title"><span class="eyebrow">ACCOUNT</span><h1>Your profile</h1></div><div class="profile-card"><div class="avatar"><?= strtoupper(substr($u['name'],0,1)) ?></div><div><h2><?= htmlspecialchars($u['name']) ?></h2><p><?= htmlspecialchars($u['email']) ?></p><p class="muted">Member since <?= date('d M Y',strtotime($u['created_at'])) ?></p></div></div></main><footer><div><strong>CineBook</strong> — Online Movie Ticket Booking System</div><div>© 2026 CineBook</div></footer></body></html>